<template>
 <div class="col-lg-12 p-t-20">
        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
            <label class="mdl-textfield__label" for="txtFirstName" v-show="!form.nom">Nom De L'Auteur</label>
            <input class="mdl-textfield__input" type="text" id="txtFirstName" v-model="form.nom"
                @input="validatedata('nom')">
            <span class="erreur">{{ this.nom_auteur_erreur }}</span>
        </div>
    </div>
    <div class="col-lg-6 p-t-20">

        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
            <label class="mdl-textfield__label" for="txtLastName" v-show="!form.prenom">Prénom de l'auteur</label>
            <input class="mdl-textfield__input" type="text" id="txtLastName" v-model="form.prenom"
                @input="validatedata('prenom')">
            <span class="erreur">{{ this.prenom_auteur_erreur }}</span>
        </div>
    </div>
    <div class="col-lg-6 p-t-20">
        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
            <label class="mdl-textfield__label" for="dateOfBirth" v-show="!form.date_naissance">Date de Naissance</label>
                <flat-pickr v-model="form.date_naissance" class="mdl-textfield__input" @input="validatedata('date_naissance')"></flat-pickr>
            <span class="erreur">{{ this.date_erreur }}</span>
        </div>
    </div>
    <div class="col-lg-6 p-t-20">

<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
    <label class="mdl-textfield__label" for="list2" v-show="!form.nationalite">Nationalité</label>
    <input class="mdl-textfield__input" type="text" id="list2" v-model="form.nationalite"
        @input="validatedata('nationalite')">
    <span class="erreur">{{ this.nationalite_erreur }}</span>
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
            <header>Liste des derniers auteurs ajoutés</header>
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
                        <th>Auteur</th>
                        <th>Nombre de Livre Ecrit</th>
                    </tr>
                </thead>  
                <tbody>
                    <tr class="odd gradeX" v-for="(auteur, index) in auteurs" :key="index">
                        <td>{{ index + 1 }}</td>
                        <td class="left"> {{ auteur.nom_auteur }} </td>
                        <td class="left"> {{ auteur.livre.length }} </td>

                       
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
    name:"createAuteurCompenent",
    components: {
        flatPickr,
    },
    data(){
        return {
            filieres:[],
            form:new Form({
                'nom':"",
                'prenom':"",
                'date_naissance':"",
                'nationalite':""
               
            }),
            nom_auteur_erreur:"",
            prenom_auteur_erreur:"",
            date_erreur:"",
            nationalite_erreur:"",
            etatForm:false,
            editModal:false,
            idAuteur:"",
            auteurs: [],
        }
    },
    mounted(){
       
       //this.get_user();
       this.get_auteur();
       bus.on('auteurModifier', (eventData) => {
           this.idAuteur = eventData.idAuteur;
           this.editModal = eventData.editModal;
           this.monterToupdate(eventData.auteur);
        });
       },

    methods:{
        async soumettre(){
            const formdata = new FormData();
            formdata.append('nom_auteur', this.form.nom  );
            formdata.append('prenom', this.form.prenom);
            formdata.append('date_naissance', this.form.date_naissance);            formdata.append('nationalite', this.form.nationalite);
            formdata.append('nationalite', this.form.nationalite);

        
            try{
                const create_store=await axios.post('/auteur/store', formdata);
                showDialog6("Auteur ajouté avec succès");
                bus.emit('auteurAjoutee');
                this.resetForm();
                window.location.href = '/auteur/accueil';
            }
            catch (e) {
                if (e.request.status === 404) {
                    showDialog3("le nom de l'auteur existe déjà");
                }
                else {
                    showDialog3("Une erreur est survenue lors de l\'enregistrement");
                }
            }
        },
        get_auteur() {
            axios.get('/auteur/index/last/values')
                .then(response => {
                    this.auteurs = response.data.auteur
                   
                }).catch(error => {
                    Swal.fire('Erreur!', 'Une erreur est survenue lors de la recuperation des dernier departements', 'error')
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
                    this.form.nom = this.form.nom.toUpperCase();
                    this.form.prenom = this.form.prenom.charAt(0).toUpperCase() + this.form.prenom.slice(1).toLowerCase();

                    this.form.nationalite = this.form.nationalite.toUpperCase();

                    this.update_auteur(this.idAuteur);
                    this.editModal = false;
                }

                else {
                    this.form.nom = this.form.nom.toUpperCase();    
                    this.form.prenom = this.form.prenom.charAt(0).toUpperCase() + this.form.prenom.slice(1).toLowerCase();
                    this.form.nationalite = this.form.nationalite.toUpperCase();

                    this.soumettre();
                    this.etatForm = true;
                    this.editModal = false;
                    console.log("Tokkos");
                }

            }
        },
        validatedata(champ) {
            var i = 0;
            switch (champ) {
                case 'auteur':
                    this.nom_auteur_erreur = "";
                    if (this.form.nom === "") {
                        this.nom_auteur_erreur = "Ce champ est obligatoire"
                       i = 1;

                        return true
                    }
                    if (!this.verifCaratere(this.form.nom)) {
                        this.nom_auteur_erreur = "Ce champ ne peut comporter que des lettres et des espaces"
                        /* this.erreur= "Ce champ ne peut comporter que des lettres et des espaces" */
                        i = 1;
                        return true
                    }
                    break;
                case 'prenom':
                    this.prenom_auteur_erreur = "";
                    //pour prenom
                    if (this.form.prenom === "") {
                        this.prenom_auteur_erreur = "Ce champ est obligatoire"
                        i = 1;
                        return true
                    }
                    if (!this.verifCaratere(this.form.prenom)) {
                        this.prenom_user_erreur = "Ce champ ne peut comporter que des lettres et des espaces"
                        /*  this.erreur= "Ce champ ne peut comporter que des lettres et des espaces" */
                        i = 1;
                        return true
                    }
                    break;
                case 'nationalite':
                    this.nationalite_erreur = "";
                    //pour nationalite
                    if (this.form.nationalite === "") {
                        this.nationalite_erreur = "Ce champ est obligatoire"
                        i = 1;
                        return true
                    }
                    if (!this.verifCaratere(this.form.nationalite)) {
                        this.nationalite_erreur = "Ce champ ne peut comporter que des lettres et des espaces"
                        i = 1;
                        return true
                    }
                    break;
                case 'date_naissance':
                    this.date_erreur = "";
                    // Vérification de la date de naissance
                    if (this.form.date_naissance === "") {
                        this.date_erreur = "La date de naissance est obligatoire";
                        i = 1;
                        return true
                    } else {
                        const dateNaissance = new Date(this.form.date_naissance);
                        const dateLimite = new Date();
                        const dateActuelle = new Date();
                        dateLimite.setFullYear(dateLimite.getFullYear() - 19); // 18 ans avant la date actuelle
                        let annee = dateLimite.getFullYear();
                        console.log(annee);

                        if (dateNaissance > dateLimite) {
                            this.date_erreur = "La date de naissance ne peut pas être supérieure à " + annee;
                            i = 1;
                            return true
                        } if (dateNaissance > dateActuelle) {
                            this.date_erreur = "La date de naissance ne peut pas être dans le futur";
                            i = 1;
                            return true
                        }

                    }


                    break;
                default:
                    break;
            }
            return false;
        },
        validatedataOld() {
            this.nom_auteur_erreur = "";
            this.prenom_auteur_erreur = "";
            this.nationalite_erreur = "";
            this.date_erreur = "";
            var i = 0;
            if (this.form.nom === "") {
                this.nom_auteur_erreur = "Ce champ est obligatoire"

                i = 1;
            }
            if (!this.verifCaratere(this.form.nom)) {
                this.nom_auteur_erreur = "Ce champ ne peut comporter que des lettres et des espaces"
                /* this.erreur= "Ce champ ne peut comporter que des lettres et des espaces" */
                i = 1;
            }

             //pour prenom
             if (this.form.prenom === "") {
                this.prenom_auteur_erreur = "Ce champ est obligatoire"
                /*     this.erreur= "Ce champ est obligatoire" */
                i = 1;
            }
            if (!this.verifCaratere(this.form.prenom)) {
                this.prenom_auteur_erreur = "Ce champ ne peut comporter que des lettres et des espaces"
                /*  this.erreur= "Ce champ ne peut comporter que des lettres et des espaces" */
                i = 1;
            }
              //pour nationalite
              if (this.form.nationalite === "") {
                this.nationalite_erreur = "Ce champ est obligatoire"
                i = 1;
            }
            if (!this.verifCaratere(this.form.nationalite)) {
                this.nationalite_erreur = "Ce champ ne peut comporter que des lettres et des espaces"
                i = 1;
            }
            // Vérification de la date de naissance

            if (this.form.date_naissance === "") {
                this.date_erreur = "La date de naissance est obligatoire";
                i = 1;
            } else {
                const dateNaissance = new Date(this.form.date_naissance);
                const dateLimite = new Date();
                const dateActuelle = new Date();
                dateLimite.setFullYear(dateLimite.getFullYear() - 19); // 18 ans avant la date actuelle
                let annee = dateLimite.getFullYear();
                console.log(annee);

                if (dateNaissance > dateLimite) {
                    this.date_erreur = "La date de naissance ne peut pas être supérieure à " + annee;
                    i = 1;
                } if (dateNaissance > dateActuelle) {
                    this.date_erreur = "La date de naissance ne peut pas être dans le futur";
                    i = 1;
                }

            }

            if (i == 1) return true;

            return false;
        },


        verifCaratere(nom){
            const valeur= /^[a-zA-ZÀ-ÿ\s]*$/;
            return valeur.test(nom);
        },

        resetForm(){
            this.form.input = "";
            this.form.nom="";
            this.form.nom_auteur_erreur = "";
            this.editModal = false;
            this.form.prenom ="";
            this.form.nationalite ="";
            this.form.date_naissance ="";

            this.nom_auteur_erreur = "";
            this.prenom_erreur = "";
            this.date_erreur = "";
            this.nationalite_erreur = "";





            const eventData = {
                editModal: false,
            };
            bus.emit('auteurDejaModifier', eventData);
        },
        
        async update_auteur(id) {
            const formdata = new FormData();
            formdata.append('nom_auteur', this.form.nom);
            formdata.append('prenom', this.form.prenom);
            formdata.append('nationalite', this.form.nationalite);
            formdata.append('date_naissance', this.form.date_naissance);

            try {
                await axios.post('/auteur/update/' + id, formdata);
                showDialog6("Auteur modifié avec succès");
                bus.emit('auteurAjoutee');
                this.resetForm();
                const eventData = {
                    editModal: false,
                };
                bus.emit('auteurDejaModifier', eventData);
            }
            catch (e) {
                if (e.request.status === 404) {
                    showDialog3("Ce auteur existe déjà");
                }
                else {
                    showDialog3("Une erreur est survenue lors de l\'enregistrement");
                }
            }
        },

        monterToupdate(auteur) {

            this.idAuteur = auteur.id;
            this.editModal = auteur.editModal;
            this.form.nom = auteur.nom;
            this.form.prenom = auteur.prenom;
            this.form.nationalite = auteur.nationalite;
            this.form.date_naissance = auteur.date_naissance;


        }
     


    }
   }
</script>

