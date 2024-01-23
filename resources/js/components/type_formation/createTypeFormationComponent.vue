<template>
    <div class="col-lg-12 p-t-20">
        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
            <label class="mdl-textfield__label" for="txtFirstName" v-show="!form.intitule">Nom Type de formation</label>
            <input class="mdl-textfield__input" type="text" id="txtFirstName" v-model="form.intitule"
                @input="validatedata('intitule')">
            <span class="erreur">{{ this.nom_formation_erreur }}</span>
        </div>
    </div>


    <div class="col-lg-12 p-t-20 text-center">

        <button type="submit" v-if="!this.editModal"
            class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-circle btn-primary"
            @click.prevent="validerAvantAjout()">Enregistrer</button>
        <button type="submit" v-if="this.editModal"
            class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-circle btn-primary"
            @click.prevent="validerAvantAjout()">Modifier</button>
        <button type="button"
            class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn-circle btn-danger"
            @click="resetForm">Annuler</button>
    </div>

    <div class="card card-box">
        <div class="card-head">
            <header>Liste des dernières filières</header>
            <div class="tools">
                <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
            </div>
        </div>
        <div class="card-body ">
            <table class="table table-striped table-bordered table-hover table-checkable order-column valign-middle">
                <thead>
                    <tr>
                        <th>#</th>
                        <th> Nom </th>
                     
                    </tr>
                </thead>
                <tbody>
                    <tr class="odd gradeX" v-for="(formation, index) in type_formations" :key="index">
                        <td> {{ index + 1 }} </td>
                        <td> {{ formation.intitule }} </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
import bus from '../../eventBus';
import axios from 'axios';
import Form from 'vform';
import Swal from 'sweetalert2';
import flatPickr from 'vue-flatpickr-component';
import 'flatpickr/dist/flatpickr.css';



export default {
    props: ['type_formation'],
    name: "createTypeFormationCompenent",
    components: {
        flatPickr,
    },
    data() {
        return {
            form: new Form({
                'intitule': ""
            }),
            nom_formation_erreur: "",
            type_formations: [],
            editModal: false,
            idTypeformation: "",
        }
    },
    mounted() {
        bus.on('formationModifier', (eventData) => {
            this.editModal = eventData.editModal;
            this.monterToupdate(eventData.formation);
        });
        this.get_filiere();
    },

    methods: {
        async soumettre() {
            const formdata = new FormData();
            formdata.append('intitule', this.form.intitule);
            try {
                const create_store = await axios.post('/type_formation/store', formdata, {});
                showDialog6("Type de formation ajouté avec succès");
                bus.emit('formationAjoutee');
                this.resetForm();
                window.location.href = '/type_formation/index';
            }
            catch (e) {
                /* console.log(e.request.status) */
                if (e.request.status === 404) {
                    showDialog3("Ce type de formation existe déjà");
                }
                else {
                    showDialog3("Une erreur est survenue lors de l\'enregistrement");
                }

            }
        },
        validerAvantAjout() {
            const isVerifIdValid = this.validatedata();
            if (isVerifIdValid === true) {
                this.etatForm = false;
                this.editModal = false;
                return 0;
            } else {
                if (this.editModal === true) {
                    this.etatForm = true;
                    this.form.intitule = this.form.intitule.toUpperCase();
                    this.update_formation(this.idTypeformation);
                    this.editModal = false;
                }

                else {
                    this.form.intitule = this.form.intitule.toUpperCase();
                    this.soumettre();
                    this.etatForm = true;
                    this.editModal = false;
                }

            }
        },

        verifCaratere(nom) {
            const valeur = /^[a-zA-ZÀ-ÿ\s]*$/;
            return valeur.test(nom);
        },
        validatedata() {
            this.nom_formation_erreur = "";

            if (this.form.intitule === "") {
                this.nom_formation_erreur = "Ce champ est obligatoire"
                return true;
            }
            if (!this.verifCaratere(this.form.intitule)) {
                this.nom_formation_erreur = "Ce champ ne peut comporter que des lettres et des espaces"
                return true;
            }
            /* if(this.form.intitule.length <10 ){
                this.nom_formation_erreur= "Ce champ doit contenir au moins 10 Caratères"
                return true;
            } */
            return false;

        },

        changement(event) {
            this.interesser = event;
        },

        resetForm() {
            this.form.input = "";
            this.form.intitule = "";
            this.editModal === false;
            this.nom_formation_erreur = "";
        },


        async update_formation(id) {
            const formdata = new FormData();
            formdata.append('intitule', this.form.intitule);
            try {
                await axios.post('/type_formation/update/' + id, formdata);
                showDialog6("Type de Formation modifié avec succès");
                bus.emit('formationAjoutee');
                const eventData = {
                    editModal: false,
                };
                bus.emit('formationDejaModifier', eventData);
            }
            catch (e) {
                console.log(e)
                if (e.request.status === 404) {
                    showDialog3("Une erreur est survenue lors de la modification");
                }
                else {
                    showDialog3("Une erreur est survenue lors de la modification");
                }
            }
        },

        get_filiere() {
            axios.get('/type_formation/get/last')
                .then(response => {
                    this.type_formations = response.data.formation;

                }).catch(error => {
                    Swal.fire('Erreur!', 'Une erreur est survenue lors de la recupération des formation', 'error')
                });
        },

        monterToupdate(formation) {
            this.idTypeformation = formation.id;
            this.editModal = formation.editModal;
            this.form.intitule = formation.formation;
        },


    }
}
</script>


