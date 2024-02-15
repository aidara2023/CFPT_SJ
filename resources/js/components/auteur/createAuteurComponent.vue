<template>
 <div class="col-lg-12 p-t-20">
        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
            <label class="mdl-textfield__label" for="txtFirstName" v-show="!form.nom">Nom De L'Auteur</label>
            <input class="mdl-textfield__input" type="text" id="txtFirstName" v-model="form.nom"
                @input="validatedata('auteur')">
            <span class="erreur">{{ this.nom_auteur_erreur }}</span>
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
    data(){
        return {
            filieres:[],
            form:new Form({
                'nom':"",
               
            }),
            nom_auteur_erreur:"",
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
                    this.update_auteur(this.idAuteur);
                    this.editModal = false;
                }

                else {
                    this.form.nom = this.form.nom.toUpperCase();
                    this.soumettre();
                    this.etatForm = true;
                    this.editModal = false;
                    console.log("Tokkos");
                }

            }
        },
        validatedata(champ) {
            switch (champ) {
                case 'auteur':
                    this.nom_auteur_erreur = "";
                    if (this.form.nom === "") {
                        this.nom_auteur_erreur = "Ce champ est obligatoire"
                        return true
                    }
                    break;
                default:
                    break;
            }
            return false;
        },
        validatedataOld() {
            this.nom_auteur_erreur = "";
            var i = 0;
            if (this.form.nom === "") {
                this.nom_auteur_erreur = "Ce champ est obligatoire"

                i = 1;
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
            this.form.nom=""; this.form.nom_auteur_erreur = "";
            this.editModal = false;
            const eventData = {
                editModal: false,
            };
            bus.emit('auteurDejaModifier', eventData);
        },
        
        async update_auteur(id) {
            const formdata = new FormData();
            formdata.append('nom_auteur', this.form.nom);
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

        }
     


    }
   }
</script>

