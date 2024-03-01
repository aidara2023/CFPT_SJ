<template>
   <div class="col-lg-6 p-t-20">
        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
            <label class="mdl-textfield__label" for="txtFirstName" v-show="!form.intitule">Intitule Catégorie</label>
            <input class="mdl-textfield__input" type="text" id="txtFirstName" v-model="form.intitule"
                @input="validatedata('intitule')">
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
            <header>Liste des dernières catégories ajoutées</header>
            <div class="tools">
                <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
            </div>
        </div>
        <div class="card-body ">
            <table class="table table-striped table-bordered table-hover table-checkable order-column valign-middle"
                id="example47">
                <thead>
                    <tr>
                        <th> # </th>
                        <th> Intitule </th>
                        <th> Date de création</th>
                    </tr>
                </thead> 
                <tbody>
                    <tr class="odd gradeX" v-for="(categorie, index) in categories" :key="index">
                        <td> {{ index + 1 }} </td>
                        <td> {{ categorie.intitule }} </td>
                        <td>{{ this.formatDateTime(categorie.created_at) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

        
</template>

<script>
import axios from 'axios';
import Form from 'vform';
import Swal from 'sweetalert2';
import flatPickr from 'vue-flatpickr-component';
import 'flatpickr/dist/flatpickr.css';

   export default {
    props: ['categorie'],
    name:"createCategorieCompenent",
    components: {
        flatPickr,
    },
    data(){
        return {
            filieres:[],
            form:new Form({
                'intitule':""
            }),
            intitule_erreur: "",
            etatForm: false,
            editModal: false,
            categories: [],
           
        }
    },
    mounted() {
        this.get_categorie();
        bus.on('categorieModifier', (eventData) => {
            this.editModal = eventData.editModal;
            this.monterToupdate(eventData.categorie);
        });
        },
    
    methods:{
        async soumettre(){
            const formdata = new FormData();
            formdata.append('intitule', this.form.intitule  );
        
            try {
                const create_store = await axios.post('/categorie/store', formdata);
                showDialog6("Categorie ajoutée avec succès");
                bus.emit('categorieAjoutee;')
                this.resetForm();
                bus.emit('categorieAjoutee');
                window.location.href = '/categorie/accueil';

            }
            catch (e) {
                /* console.log(e.request.status) */
                if (e.request.status === 404) {
                    showDialog3("Cette categorie existe déjà");
                }
                else {
                    showDialog3("Une erreur est survenue lors de l\'enregistrement");
                }
            }
        },
        formatDateTime(dateTime) {
            // Utilisez une fonction pour formater la date
            return this.formatDate(new Date(dateTime));
        },

        formatDate(date) {
            const day = date.getDate();
            const monthNumber = date.getMonth() + 1;
            const year = date.getFullYear();

            // Tableau des trois premières lettres des mois en français
            const monthAbbreviations = [
                "Jan", "Fév", "Mar", "Avr", "Mai", "Juin",
                "Juil", "Aoû", "Sep", "Oct", "Nov", "Déc"
            ];

            // Obtenez les trois premières lettres du mois correspondant au numéro du mois
            const month = monthAbbreviations[monthNumber - 1];

            return `${day} ${month} ${year}`;

        },

        verifCaratere(nom) {
            const valeur = /^[a-zA-ZÀ-ÿ\s]*$/;
            return valeur.test(nom);
        },

        validatedata(champ) {
            var i = 0;
            switch (champ) {
                case 'intitule':
                    this.intitule_erreur = "";
                    
                    if (this.form.intitule === "") {
                        this.intitule_erreur = "Ce champ est obligatoire"
                        i = 1;
                        return true

                    }
                    if (!this.verifCaratere(this.form.intitule)) {
                        this.intitule_erreur = "Ce champ ne peut comporter que des lettres et des espaces"
                        i = 1;
                        return true
                    }
                    break;
                default:
                    break;
            }
        },

        validatedataOld() {
            this.intitule_erreur = "";
            var i = 0;

            if (this.form.intitule === "") {
                this.intitule_erreur = "Ce champ est obligatoire"
                i = 1;
            } else {
                if (!this.verifCaratere(this.form.intitule)) {
                    this.intitule_erreur = "Ce champ ne peut comporter que des lettres et des espaces"
                    i = 1;
                }
            }

            if (i == 1) return true;

            return false;
        },

        validerAvantAjout() {
            const isIdCategorieValid = this.validatedataOld();

            if (isIdCategorieValid  === true) {
                this.etatForm = false;
                this.editModal = false;
                console.log("erreur")
                return 0;
            } else {

                if (this.editModal === true) {
                    this.etatForm = false;
                    this.form.intitule = this.form.intitule.toUpperCase();
                    this.update_categorie(this.idCategorie);

                    this.editModal = false;
                }
                else {
                    this.etatForm = true;
                    this.form.intitule = this.form.intitule.toUpperCase();
                    this.soumettre();

                    this.editModal = false;
                }
            }

        },


        resetForm(){
            this.form.intitule="";
            this.editModal = false;
            this.intitule_erreur = "";
            const eventData = {
                editModal: false,
            };
            bus.emit('categorieDejaModifier', eventData);

        },
        get_categorie() {
            axios.get('/categorie/index/get/last')
                .then(response => {
                    this.categories = response.data.categorie
                }).catch(error => {
                    Swal.fire('Erreur!', 'Une erreur est survenue lors de la recuperation des dernieres directions', 'error')
                });
        },

        async update_categorie(id) {
            const formdata = new FormData();
            formdata.append('intitule', this.form.intitule);

            try {
                await axios.post('/categorie/update/' + id, formdata);
                showDialog6("Categorie modifiée avec succès");
                bus.emit('categorieAjoutee');
                const eventData = {
                    editModal: false,
                };
                bus.emit('categorieDejaModifier', eventData);
            }
            catch (e) {
                /* console.log(e.request.status) */
                if (e.request.status === 404) {
                    Swal.fire('Erreur !', 'Cette categorie existe déjà', 'error')
                }
                else {
                    Swal.fire('Erreur !', 'Une erreur est survenue lors de l\'enregistrement', 'error')
                }
            }
        },

        monterToupdate(categorie) {
            this.idCategorie = categorie.id;
            this.editModal = categorie.editModal;
            this.form.intitule = categorie.categorie;
        },

    }
   }
</script>
x
