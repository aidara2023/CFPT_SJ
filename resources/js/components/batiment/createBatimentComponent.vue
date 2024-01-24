<template>
    <div class="col-lg-12 p-t-20">
        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
            <label class="mdl-textfield__label" for="txtFirstName" v-show="!form.intitule">Nom Batiment</label>
            <input class="mdl-textfield__input" type="text" id="txtFirstName" v-model="form.intitule"
                @input="validatedata('batiment')">
            <span class="erreur">{{ this.intitule_erreur }}</span>
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

    <div class="card card-box mt-4">
        <div class="card-head">
            <header>Liste des derniers batiments</header>
            <div class="tools">
                <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
            </div>
        </div>
        <div class="card-body ">
            <table class="table table-striped table-bordered table-hover table-checkable order-column valign-middle w-2">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Batiment</th>
                        <th>Nombre de Salle</th>
                    </tr>
                </thead>  
                <tbody>
                    <tr class="odd gradeX" v-for="(batiment, index) in batiments" :key="index">
                        <td>{{ index + 1 }}</td>
                        <td class="left"> {{ batiment.intitule }} </td>
                        <td class="left"> {{ batiment.salle.length }} </td>

                       
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
    name: "batimentCompenent",
    components: {
        flatPickr,
    },
    data() {
        return {
            form: new Form({
                'intitule': "",
            }),
            intitule_erreur: "",
            etatForm: false,
            editModal: false,
            batiments: [],
            idBatiment: "",

        }
    },
    mounted() {
        this.get_batiment();
        bus.on('batimentModifier', (eventData) => {
            this.editModal = eventData.editModal;
            this.monterToupdate(eventData.batiment);
        });
    },


    methods: {
        async soumettre() {
            const formdata = new FormData();
            formdata.append('intitule', this.form.intitule);

            try {
                const create_store = await axios.post('/batiment/store', formdata);
                /*  Swal.fire('Succes!','batiment ajouté avec succés','succes') */
                bus.emit('batimentAjoutee');
                showDialog6("Batiment ajouté avec succès");
                this.resetForm();
                window.location.href = '/batiment/accueil';
            }
            catch (e) {
                if (e.request.status === 404) {
                    //Swal.fire('Erreur !', 'Ce batiment existe déjà', 'error')
                    showDialog3("Ce batiment existe déjà");
                }
                else {
                    // Swal.fire('Erreur !', 'Une erreur est survenue lors de l\'enregistrement', 'error')
                    showDialog3("Une erreur est survenue lors de l\'enregistrement");
                }
            }
        },

        get_batiment() {
            axios.get('/batiment/index/last/values')
                .then(response => {
                    this.batiments = response.data.batiment;

                }).catch(error => {
                    Swal.fire('Erreur!', 'Une erreur est survenue lors de la recupération des derniers batiments', 'error')
                });
        },

        validerAvantAjout() {
            const isVerifIdValid = this.validatedataOld();

            /*   console.log(isNomChampValid); */
            if (isVerifIdValid === true) {
                this.etatForm = false;
                this.editModal = false;
                console.log("erreur")
                return 0;
            } else {

                if (this.editModal === true) {
                    this.etatForm = true;
                    this.form.intitule = this.form.intitule.toUpperCase();
                    this.update_batiment(this.idBatiment);
                    this.editModal = false;
                }

                else {
                    this.form.intitule = this.form.intitule.toUpperCase();
                    this.soumettre();
                    this.etatForm = true;
                    this.editModal = false;
                    console.log("Tokkos");
                }

            }
        },

        validatedata(champ) {
            switch (champ) {
                case 'batiment':
                    this.intitule_erreur = "";
                    // Effectuez la validation pour le champ 'nom'
                    if (this.form.intitule === "") {
                        this.intitule_erreur = "Ce champ est obligatoire"
                        //this.coloration_erreur_rouge(this.nom_service_erreur);
                        return true
                    }
                    break;
                default:
                    break;
            }
            return false;
        },
        validatedataOld() {
            this.intitule_erreur = "";
            var i = 0;
            if (this.form.intitule === "") {
                this.intitule_erreur = "Ce champ est obligatoire"

                i = 1;
            }
            if (i == 1) return true;

            return false;
        },

        resetForm() {
            this.form.input = "";
            this.form.intitule = "";
            this.form.intitule_erreur = "";
            this.editModal = false;
            const eventData = {
                editModal: false,
            };
            bus.emit('batimentDejaModifier', eventData);
        },

        async update_batiment(id) {
            const formdata = new FormData();
            formdata.append('intitule', this.form.intitule);
            try {
                await axios.post('/batiment/update/' + id, formdata);
                showDialog6("Batiment modifié avec succès");
                bus.emit('batimentAjoutee');
                this.resetForm();
                const eventData = {
                    editModal: false,
                };
                bus.emit('batimentDejaModifier', eventData);
            }
            catch (e) {
                /* console.log(e.request.status) */
                if (e.request.status === 404) {
                    //Swal.fire('Erreur !', 'Ce batiment existe déjà', 'error')
                    showDialog3("Ce batiment existe déjà");
                }
                else {
                    //Swal.fire('Erreur !', 'Une erreur est survenue lors de l\'enregistrement', 'error')
                    showDialog3("Une erreur est survenue lors de l\'enregistrement");
                }
            }
        },

        monterToupdate(batiment) {

            this.idBatiment = batiment.id;
            this.editModal = batiment.editModal;
            this.form.intitule = batiment.intitule;

        }



    }
}
</script>


