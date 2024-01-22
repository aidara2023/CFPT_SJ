<template>
   
    <div class="col-lg-6 p-t-20">
        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
            <label class="mdl-textfield__label" for="txtFirstName" v-show="!form.nom_service">Nom Service</label>
            <input class="mdl-textfield__input" type="text" id="txtFirstName" v-model="form.nom_service"
                @input="validatedata('nom_service')">
            <span class="erreur">{{ this.nom_service_erreur }}</span>
        </div>
    </div>
   
    <div class="col-lg-6 p-t-20 mt-1">
        <div
            class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label getmdl-select getmdl-select__fix-height txt-full-width">

            <label class="mdl-textfield__label" for="directionSelect" v-show="!form.id_direction"> Choisissez la direction </label>
            <select class="mdl-textfield__input" id="directionSelect" readonly tabIndex="-1" v-model="form.id_direction"
            @change="validatedata('id_direction')">

                <option v-for="(direction, index) in directions" :value="direction.id" :key="index">{{ direction.nom_direction }}</option>
            </select>
            <span class="erreur">{{ id_direction_erreur }}</span>
        </div>
    </div> 


   


    <div class="col-lg-6 p-t-20" >
        <div
            class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label getmdl-select getmdl-select__fix-height txt-full-width">
            <label for="list6" class="mdl-textfield__label" v-show="!form.id_user">Choisissez le chef de service</label>
            <select class="mdl-textfield__input" id="list6" readonly tabIndex="-1" v-model="form.id_user"
                @change="validatedata('user')">
                <option v-for="(user, index) in users" :value="user.id" :key="index">{{ user.prenom }} {{ user.nom }}</option>
            </select>
            <span class="erreur">{{ id_user_erreur }}</span>
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
</template>
     
<script>
import bus from '../../eventBus';
import axios from 'axios';
import Form from 'vform';
import Swal from 'sweetalert2';
import flatPickr from 'vue-flatpickr-component';
import 'flatpickr/dist/flatpickr.css';


export default {
    props: ['service'],
    name: "createServiceCompenent",
    components: {
    flatPickr,
  },
    data() {
        return {
            users: [],
            directions: [],
            form: new Form({
                'nom_service': "",
                'id_user': "",
                'id_direction': ""
            }),
            nom_service_erreur: "",
            id_user_erreur: "",
            id_direction_erreur: "",
            etatForm: false,
            editModal: false,
            idService: "",
        }
    },

    mounted() {
        this.get_user();
        this.get_direction();
        bus.on('serviceModifier', (eventData) => {
            this.editModal = eventData.editModal;
            this.monterToupdate(eventData.service);

           /*  this.idService = eventData.idService;
            this.editModal = eventData.editModal;
            this.form.nom_service = eventData.nom;
            this.form.id_user = eventData.id_user;
            this.form.id_direction = eventData.id_direction; */
        });

    },



    methods: {
        async soumettre() {
            const formdata = new FormData();
            formdata.append('nom_service', this.form.nom_service);
            formdata.append('id_user', this.form.id_user);
            formdata.append('id_direction', this.form.id_direction);
            try {
                const user_store = await axios.post('/service/store', formdata, {});
                //Swal.fire('Réussi !', 'Service ajouté avec succès','success');
                bus.emit('serviceAjoutee;')
                showDialog6("Service ajouté avec succès");
                this.resetForm();
                window.location.href = '/service/accueil';
                

            }
            catch (e) {
                /* console.log(e.request.status) */
                if (e.request.status === 404) {
                    showDialog3("Ce service existe déjà");
                }
                else {
                    //Swal.fire('Erreur !', 'Une erreur est survenue lors de l\'enregistrement', 'error')
                    showDialog3("Une erreur est survenue lors de l\'enregistrement");
                }

            }

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
                    this.form.nom_service = this.form.nom_service.toUpperCase();
                    this.update_service(this.idService);
                   /*  this.closeModal('[data-modal-confirmation-modifier]'); */
                    this.editModal = false;
                }

                else {


                    this.form.nom_service = this.form.nom_service.toUpperCase();

                    this.soumettre();
                    this.etatForm = true;

                    this.editModal = false;
                    console.log("Tokkos");
                }

            }
        },

        resetForm() {
            this.form.nom_service = "";
            this.form.id_user = "";
            this.form.id_direction = ""
            this.nom_service_erreur = "";
            this.id_user_erreur = "";
            this.id_direction_erreur = "";
            this.editModal = false;
            const eventData = {
                editModal: false,
            };
            bus.emit('serviceDejaModifier', eventData);
        },



        verifCaratere(nom) {
            const valeur = /^[a-zA-ZÀ-ÿ\s]*$/;
            return valeur.test(nom);
        },



        validatedata(champ) {

            switch (champ) {
                case 'nom_service':
                    this.nom_service_erreur = "";
                    // Effectuez la validation pour le champ 'nom'
                    if (this.form.nom_service === "") {
                        this.nom_service_erreur = "Ce champ est obligatoire"
                        //this.coloration_erreur_rouge(this.nom_service_erreur);
                        return true
                    }
                    if (!this.verifCaratere(this.form.nom_service)) {
                        this.nom_service_erreur = "Ce champ ne peut comporter que des lettres et des espaces"
                        /* this.erreur= "Ce champ ne peut comporter que des lettres et des espaces" */
                        // this.coloration_erreur_rouge(this.nom_service_erreur);
                        return true
                    }
                    if (this.form.nom_service.length < 12) {
                        this.nom_service_erreur = "Ce champ doit contenir au moins 12 Caractères"
                            ;
                        // this.coloration_erreur_rouge(this.nom_service_erreur);
                        return true
                    }
                    break;

                case 'user':
                    this.id_user_erreur = "";
                    //pour user
                  if(this.editModal){
                    if (this.form.id_user === "") {
                        this.id_user_erreur = "Vous avez oublié de sélectionner  le chef de service'"
                        return true
                    }
                  }
                    break;

                case 'direction':
                    //pour direction
                    this.id_direction_erreur = "";
                    if (this.form.id_direction === "") {
                        this.id_direction_erreur = "Vous avez oublié de sélectionner  le chef de direction'"
                        return true
                    }
                    break;

                case 'id_user':
                    //pour direction
                    this.id_user_erreur = "";
                   if(this.editModal){
                    if (this.form.id_user === "") {
                        this.id_user_erreur = "Vous avez oublié de sélectionner le chef de service"
                        return true
                    }
                   }
                    break;

                case 'id_direction':
                    //pour direction
                    this.id_direction_erreur = "";
                    if (this.form.id_direction === "") {
                        this.id_direction_erreur = "Vous avez oublié de sélectionner la direction concernée"
                        return true;
                    }
                    break;

                default:
                    break;
            }
            return false;
        },

        validatedataOld() {
            this.nom_service_erreur = "";
            this.id_user_erreur = "";
            this.id_direction_erreur = "";
            var i = 0;


            if (this.form.nom_service === "") {
                this.nom_service_erreur = "Ce champ est obligatoire"

                i = 1;
            }
            if (!this.verifCaratere(this.form.nom_service)) {
                this.nom_service_erreur = "Ce champ ne peut comporter que des lettres et des espaces"
                    ;
                i = 1;
            }

            /* if(this.form.nom_service.length < 12){
                this.nom_service_erreur= "Ce champ doit contenir au moins 12 Caratères"
                ;
                i=1;
            } */

            if (this.form.nom_service.length < 12) {
                this.nom_service_erreur = "Ce champ doit contenir au moins 12 Caratères"
                    ;
                i = 1;
            }

         if(this.editModal){
            if (this.form.id_user === "") {
                this.id_user_erreur = "Vous avez oublié de sélectionner le chef de service"
                    ;
                i = 1;
            }
         }
            if (this.form.id_direction === "") {
                this.id_direction_erreur = "Vous avez oublié de sélectionner la direction concernée"
                    ;
                i = 1;
            }
            if (i == 1) return true;

            return false;
        },

        get_user() {
            axios.get('/user/getpersoadminunique')
                .then(response => {
                    this.users = response.data.user
                }).catch(error => {
                    Swal.fire('Erreur!', 'Une erreur est survenue lors de la recuperation des membres administratifs', 'error')
                });
        },

        get_direction() {
            axios.get('/direction/index')
                .then(response => {
                    this.directions = response.data.direction

                }).catch(error => {
                    Swal.fire('Erreur!', 'Une erreur est survenue lors de la recupération des directions', 'error')
                });
        },

        async update_service(id) {
            const formdata = new FormData();
            formdata.append('nom_service', this.form.nom_service);
            formdata.append('id_user', this.form.id_user);
            formdata.append('id_direction', this.form.id_direction);

            //if(this.form.nom!==""){
            try {
                await axios.post('/service/update/' + id, formdata);
                bus.emit('serviceAjoutee');
                showDialog6("Service modifié avec succès");
                const eventData = {
                editModal: false,
            };
            bus.emit('serviceDejaModifier', eventData);
            }
            catch (e) {
                /* console.log(e.request.status) */
                if (e.request.status === 404) {
                    showDialog3("Une erreur est survenue lors de la modification");
    

                }
                else {
                    showDialog3("Une erreur est survenue lors de la modification");
                }
            }
        },

        monterToupdate(service) {
            console.log("MonterToupdate called");
         
            this.idService = service.id;
            this.editModal = service.editModal;
            this.form.nom_service = service.service;
            this.form.nom_direction = service.direction;
            this.form.id_direction = service.id_direction;
            this.form.id_user = service.id_user;
           
            
        },


    }
}
</script>
     
     