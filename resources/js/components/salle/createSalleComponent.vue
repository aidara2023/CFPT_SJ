<template>
    <div class="col-lg-6 p-t-20">
        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
            <label class="mdl-textfield__label" for="txtFirstName" v-show="!form.intitule">Nom Salle</label>
            <input class="mdl-textfield__input" type="text" id="txtFirstName" v-model="form.intitule"
                @input="validatedata('intitule')">
            <span class="erreur">{{ this.nom_salle_erreur }}</span>
        </div>
    </div>

    <div class="col-lg-6 p-t-20">
        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
            <label class="mdl-textfield__label" for="txtFirstName" v-show="!form.nombre_place">Nombre de Place</label>
            <input class="mdl-textfield__input" type="text" id="txtFirstName" v-model="form.nombre_place"
                @input="validatedata(' nombre_place')">
            <span class="erreur">{{ this.nombre_place_erreur }}</span>
        </div>
    </div>


    <div class="col-lg-6 p-t-20">
        <div
            class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label getmdl-select getmdl-select__fix-height txt-full-width">
            <label for="list6" class="mdl-textfield__label" v-show="!form.id_batiment">Choisissez le batiment</label>
            <select class="mdl-textfield__input" id="list6" readonly tabIndex="-1" v-model="form.id_batiment"
                @change="validatedata('id_batiment')">
                <option v-for="(batiment, index) in batiments" :value="batiment.id" :key="index">{{ batiment.intitule }}
                </option>
            </select>
            <span class="erreur">{{ id_batiment_erreur }}</span>
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
            <header>Liste des dernières salles</header>
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
                        <th>Salle</th>
                        <th>Nombre de place</th>
                        <th>Batiment</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="odd gradeX" v-for="(salle, index) in salles" :key="index">
                        <td> {{ index + 1 }} </td>
                        <td> {{ salle.intitule }} </td>
                        <td> {{ salle.nombre_place }}</td>
                        <td> {{ salle.batiment.intitule }} </td>
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
    props: ['salle'],
    name: "createSalleCompenent",
    components: {
        flatPickr,
    },
    data() {
        return {
            users: [],
            salles: [],
            batiments: [],
            form: new Form({
                'intitule': "",
                'nombre_place': "",
                'id_batiment': "",
            }),
            nom_salle_erreur: "",
            nombre_place_erreur: "",
            id_batiment_erreur: "",
            etatForm: false,
            editModal: false,
            idSalle: "",
        }
    },

    mounted() {
        this.get_batiment();
        this.get_salle();
        bus.on('salleModifier', (eventData) => {
            this.editModal = eventData.editModal;
            this.monterToupdate(eventData.salle);
        });
    },



    methods: {
        async soumettre() {
            const formdata = new FormData();
            formdata.append('intitule', this.form.intitule);
            formdata.append('nombre_place', this.form.nombre_place);
            formdata.append('id_batiment', this.form.id_batiment);
            try {
                await axios.post('/salle/store', formdata, {});
                showDialog6("Salle ajoutée avec succès");
                bus.emit('salleAjoutee');
                this.resetForm();
                window.location.href = '/salle/accueil';
            }
            catch (e) {
                /* console.log(e.request.status) */
                if (e.request.status === 404) {
                    showDialog3("Cette salle existe déjà");
                }
                else {
                    showDialog3("Une erreur est survenue lors de l\'enregistrement");
                }

            }

        },

        validerAvantAjout() {
            // Exécutez la validation des champs
            const isNomSalleValid = this.validatedataold();
            if (isNomSalleValid === true) {
                this.etatForm = false;
                this.editModal = false;
                return 0;
            } else {

                if (this.editModal === true) {
                    this.etatForm = true;
                    this.form.intitule = this.form.intitule.toUpperCase();
                    this.update_salle(this.idSalle);
                    this.closeModal('[data-modal-confirmation-modifier]');
                    this.editModal = false;
                }

                else {
                    this.form.intitule = this.form.intitule.toUpperCase();
                    this.soumettre();
                    this.etatForm = true;
                    this.closeModal('[data-modal-confirmation]');
                    this.editModal = false;

                }
            }
        },

        resetForm() {
            this.form.intitule = "";
            this.form.nombre_place = "";
            this.form.id_batiment = "";
            this.nom_salle_erreur = "";
            this.nombre_place_erreur = "";
            this.id_batiment_erreur = "";
            this.editModal === false;
        },

        verifCaratere(nom) {
            const valeur = /^[a-zA-ZÀ-ÿ\s]*$/;
            return valeur.test(nom);
        },

        validatedataold() {
            this.nom_salle_erreur = "";
            this.nombre_place_erreur = "";
            this.id_batiment_erreur = "";
            var i = 0;
            if (this.form.id_batiment === "") {
                this.id_batiment_erreur = "Vous avez oublié de sélectionner le batiment"
                i = 1;
            }


            if (this.form.intitule === "") {
                this.nom_salle_erreur = "Ce champ est obligatoire"
                i = 1;

            }
            /*  if (!this.verifCaratere(this.form.intitule)) {
                 this.nom_salle_erreur = "Ce champ ne peut comporter que des lettres et des espaces"
                 i = 1;
 
             } */
            if (this.form.intitule.length < 4) {
                this.nom_salle_erreur = "Ce champ doit contenir au moins 12 Caratères"
                i = 1;

            }
            if (this.form.id_batiment === "") {
                this.id_batiment_erreur = "Vous avez oublié de sélectionner le batiment"
                    ;
                i = 1;
            }
            if (this.form.nombre_place === "") {
                this.nombre_place_erreur = "Ce champ est obligatoire"
                    ;
                i = 1;
            }

            if (i === 1)
                return true;
            return false;

        },
        validatedata(champ) {
            switch (champ) {
                case 'intitule':
                    // Effectuez la validation pour le champ 'nom'
                    this.nom_salle_erreur = "";

                    if (this.form.intitule === "") {
                        this.nom_salle_erreur = "Ce champ est obligatoire"
                        return true

                    }
                    /*   if (!this.verifCaratere(this.form.intitule)) {
                          this.nom_salle_erreur = "Ce champ ne peut comporter que des lettres et des espaces"
  
                          return true
                      } */
                    // Ajoutez d'autres validations si nécessaire
                    break;
                case 'nombre_place':
                    //pour prenom
                    this.nombre_place_erreur = "";

                    if (this.form.nombre_place === "") {
                        this.nombre_place_erreur = "Ce champ est obligatoire"
                        return true
                    }
                    if (!/^\d+$/.test(this.form.nombre_place)) {
                        this.nombre_place_erreur = "Ce champ ne peut contenir que des chiffres";

                        return true
                    }
                    break;
                case 'id_batiment':
                    //pour prenom
                    this.id_batiment_erreur = "";

                    if (this.form.id_batiment === "") {
                        this.id_batiment_erreur = "Vous avez oublié de sélectionner la salle"
                        return true;
                    }
                    break;
                default:
                    break;
            }
        },

        get_batiment() {
            axios.get('/batiment/index')
                .then(response => {
                    this.batiments = response.data.batiment
                }).catch(error => {
                    Swal.fire('Erreur!', 'Une erreur est survenue lors de la recuperation des membres administratifs', 'error')
                });
        },

        get_salle() {
            axios.get('/salle/get/last')
                .then(response => {
                    this.salles = response.data.salle
                }).catch(error => {
                    Swal.fire('Erreur!', 'Une erreur est survenue lors de la recuperation des dernières salles', 'error')
                });
        },

        async update_salle(id) {
            const formdata = new FormData();
            formdata.append('intitule', this.form.intitule);
            formdata.append('nombre_place', this.form.nombre_place);
            formdata.append('id_batiment', this.form.id_batiment);

            //if(this.form.nom!==""){
            try {
                await axios.post('/salle/update/' + id, formdata);
                showDialog6("Salle modifiée avec succès");
                bus.emit('salleAjoutee');
                const eventData = {
                    editModal: false,
                };
                bus.emit('salleDejaModifier', eventData);
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
        monterToupdate(salle) {
            console.log("MonterToupdate called");

            this.idSalle = salle.id;
            this.editModal = salle.editModal;
            this.form.intitule = salle.salle;
            this.form.nombre_place = salle.nombre_de_place;
            this.form.id_batiment = salle.id_batiment;
            this.form.nom_batiment = salle.batiment;


        },

    }
}
</script>