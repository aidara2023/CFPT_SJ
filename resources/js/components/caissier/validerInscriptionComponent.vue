<template>
    <!--  <div class="titres">
            <h1>Validation Inscription</h1>
        </div>
        <div>
            <form @submit.prevent="validerAvantAjout()" method="">
                <div class="informations">

                    <div class="titres">
                        <h1>Validation Inscription</h1>
                    </div>


                    <div class="champ">
                        <label for="nom" :class="{ 'couleur_rouge': (this.id_eleve_erreur) }">Code Inscription</label>
                        <input type="text" v-model="this.search_query" @input="performSearch"
                            :class="{ 'bordure_rouge': (this.id_eleve_erreur) }">
                        <span class="erreur">{{ this.id_eleve_erreur }}</span>
                    </div>




                    <div v-for="(inscription, key) in inscriptions" :key="key" @click="selectEleve(inscription)">
                        <a href="#"> {{ inscription.eleve.user.nom }} {{ inscription.eleve.user.prenom }} {{
                            inscription.eleve.user.matricule }}</a>
                    </div>



                    <div v-if="form.id_eleve !== '' && selectedEleve.id">

                        <div class="champ">
                            <label for="nom" :class="{ 'couleur_rouge': (this.id_eleve_erreur) }">Matricule</label>
                            <input type="text" v-model="selectedEleve.matricule" disabled
                                :class="{ 'bordure_rouge': (this.id_eleve_erreur) }">
                            <span class="erreur">{{ this.id_eleve_erreur }}</span>
                        </div>

                        <div class="champ">
                            <label for="classe">Prénom</label>
                            <input type="text" v-model="selectedEleve.nom" disabled>
                        </div>

                        <div class="champ">
                            <label for="classe">Nom</label>
                            <input type="text" v-model="selectedEleve.prenom" disabled>
                        </div>

                        <div class="champ">
                            <label for="classe" :class="{ 'couleur_rouge': (this.id_classe_erreur) }">Classe</label>
                            <select name="classe" id="classe" v-model="selectedEleve.id_classe"
                                @change="validatedata('id_classe')">
                                <option v-for="classe in classes" :value="classe.id">{{ classe.type_formation.intitule }} {{
                                    classe.nom_classe }} {{ classe.niveau }} {{ classe.type_classe }}</option>
                            </select>
                            <span class="erreur">{{ id_classe_erreur }}</span>

                        </div>


                        <div class="champ">
                            <label for="nom" :class="{ 'couleur_rouge': (this.id_annee_accademique_erreur) }">Année Académique</label>
                            <select name="annee_academique" id="annee_academique" v-model="form.id_annee_academique"
                                :class="{ 'bordure_rouge': (this.id_annee_accademique_erreur) }"
                                @change="validatedata('id_annee_accademique')">
                                <option v-for="annee_academique in annee_academiques" :value="annee_academique.id">{{
                                    annee_academique.intitule }}</option>
                            </select>
                            <span class="erreur">{{ id_annee_accademique_erreur }}</span>
                        </div>



                        <div class="champ">
                            <label for="nom" :class="{ 'couleur_rouge': (this.montant_erreur) }">Montant</label>

                            <select name="montant" id="montant" v-model="form.montant"
                                :class="{ 'bordure_rouge': (this.montant_erreur) }" @change="validatedata('montant')">
                                <option value="140000">140000</option>
                                <option value="50000">50000</option>
                            </select>
                            <span class="erreur">{{ montant_erreur }}</span>
                        </div>

                    </div>

                    <div class="groupe_champs validation">
                        <button type="button" data-close-modal class="texte annuler" @click="resetForm">Annuler</button>
                        <button type="submit" >Enregistrer</button>
                    </div>
                </div>
            </form>
        </div> -->
    <div class="col-lg-12 p-t-20" v-show="searchidInscription && !editModal">
        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
            <label class="mdl-textfield__label" for="txtCode" v-show="!search_query">Code Inscription</label>
            <input class="mdl-textfield__input" type="text" id="txtCode" v-model="this.search_query" @input="performSearch">
            <span class="erreur">{{ this.id_eleve_erreur }}</span>
        </div>
    </div>
    <div v-for="(inscription, key) in inscriptions" :key="key" @click="selectEleve(inscription)">
        <a href="#"> {{ inscription.eleve.user.nom }} {{ inscription.eleve.user.prenom }} {{
            inscription.eleve.user.matricule }}</a>
    </div>
    <div class="card-body row" v-show="form.id_eleve !== '' && selectedEleve.id">
        <div class="row">
            <div class="col-md-12">
                <div class="pull-left">
                    <p class=" ">
                        <b>Code :</b> {{ search_query }} <br>
                        <b>Matricule :</b> {{ selectedEleve.matricule }} <br>
                        <b>Nom complet :</b> {{ selectedEleve.prenom }} {{ selectedEleve.nom }}, <br> <b>Classe :</b> {{
                            selectedEleve.classe }} <br>
                        <b>Date Naissance :</b> {{ this.formatDateTime(selectedEleve.date_naissance) }},
                        <br> <b>Lieu de naissance :</b> {{
                            selectedEleve.lieu_de_naissance }} <br>
                    </p>


                </div>
            </div>
        </div>
        <div class="col-lg-6 p-t-20">
            <div
                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label getmdl-select getmdl-select__fix-height txt-full-width">
                <label for="list6" class="mdl-textfield__label" v-show="!form.id_annee_academique">Choisissez
                    l'année</label>
                <select class="mdl-textfield__input" id="list6" readonly tabIndex="-1" v-model="form.id_annee_academique"
                    @change="validatedata('id_annee_accademique')">
                    <option v-for="annee_academique in annee_academiques" :value="annee_academique.id" :key="index">
                        {{ annee_academique.intitule }}
                    </option>
                </select>
                <span class="erreur">{{ id_annee_accademique_erreur }}</span>
            </div>
        </div>
        <div class="col-lg-12 p-t-20">
            <div
                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label getmdl-select getmdl-select__fix-height txt-full-width">
                <label for="list3" class="mdl-textfield__label" v-show="!form.montant">Choisissez le montant
                </label>
                <select class="mdl-textfield__input" id="list3" readonly tabIndex="-1" v-model="form.montant"
                    @change="validatedata('montant')">
                    <option value="140000">140 000</option>
                    <option value="50000">50 000</option>
                </select>
                <span class="erreur">{{ this.montant_erreur }}</span>
            </div>
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
    props: ['inscription', 'index'],
    name: "validerInscriptionCompenent",

    components: {
        flatPickr,
    },
    data() {
        return {
            filieres: [],
            form: new Form({

                'id_eleve': "",
                'id_classe': "",
                'statut': "",
                'montant': "",
                'id_annee_academique': "",



            }),
            inscriptions: [],

            classes: [],

            annee_academiques: [],
            search_query: "",
            selectedEleve: {
                id: "",
                prenom: "",
                nom: "",
                classe: "",
                id_classe: ""
            },
            eleve_classe: "",
            id_eleve_erreur: "",
            id_annee_accademique_erreur: "",

            montant_erreur: "",
            id_eleve_erreur: "",
            id_classe_erreur: "",
            etatForm: false,
            searchidInscription: true,
            editModal: false,
            idInscription: "",

        }
    },

    mounted() {
        this.get_annee_academique();
        this.get_classe();
        bus.on('inscriptionModifier', (eventData) => {
            this.editModal = eventData.editModal;
            this.monterToupdate(eventData.inscription);
          this.form.id_eleve =  eventData.eleve.id;
          this.selectedEleve.id =  eventData.eleve.id;
          console.log(eventData.eleve.id);
          console.log(this.selectedEleve.id);
          console.log("eventData.eleve")
          console.log(eventData.eleve)
          this.selectEleve(eventData.eleve);
        });



    },

    methods: {
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

        async soumettre() {
            const formdata = new FormData();

            formdata.append('id_eleve', this.selectedEleve.id);
            formdata.append('id_classe', this.selectedEleve.id_classe);
            
            formdata.append('montant', this.form.montant);
            formdata.append('id_annee_academique', this.form.id_annee_academique);
            formdata.append('prenom_eleve',this.selectedEleve.prenom);
            formdata.append('nom_eleve',this.selectedEleve.nom);
            formdata.append('date_naissance_eleve', this.selectedEleve.date_naissance);
            formdata.append('lieu_naissance_eleve',this.selectedEleve.lieu_de_naissance);
         /*    formdata.append('id_user',this.selectedEleve.id_user); */

         if (this.selectEleve.montant > 0) {
                /*   this.closeModal('[data-modal-confirmation-inscription]'); */
                showDialog3("Cette inscription a été déjà effectuée.")
                window.location.href = '/caissier/inscription';
            }

            try {
                const create_store = await axios.post('/caissier/valider-inscription/' + this.search_query, formdata, {

                });
                showDialog6("Inscription effectuée avec succés");
                // Swal.fire('Succes!','paiement ajouté avec succes','success')
                bus.emit('inscriptionAjoutee');
                this.resetForm();
                /*    var ajout = document.querySelector('[data-modal-ajout]'); */


                window.location.href = '/caissier/inscription';
            }
            catch (e) {
                console.log(e)
                // this.resetForm();
                Swal.fire('Erreur!', 'Une erreur est survenue lors de l\'enregistrement', 'error')
            }

        },

        validerAvantAjout() {
            const isVerifIdValid = this.validatedataOld();

            if (isVerifIdValid === true) {
                this.etatForm = false;
                this.editModal = false;
                console.log("erreur")
                return 0;
            } else {

                if (this.editModal === true) {
                    this.etatForm = true;
                    /* this.form.nom = this.form.nom.toUpperCase(); */
                    this.update_inscription(this.idInscription);

                    this.editModal = false;

                }
                else {
                    this.etatForm = true;
                   /*  this.form.nom = this.form.nom.toUpperCase(); */
                    this.soumettre();
                    this.editModal = false;
                }
            }
        },

        validatedata(champ) {
            switch (champ) {
                case 'montant':
                    this.montant_erreur = "";
                    if (this.form.montant === "") {
                        this.montant_erreur = "Vous avez oublié de sélectionner le montant de l'inscription";
                        return true;
                    }
                    break;
                case 'id_annee_accademique':
                    this.id_annee_accademique_erreur = "";
                    //Vérification de annee academique
                    /*     if (this.form.id_annee_accademique === "") {
                            this.id_annee_accademique_erreur = "Vous avez oublié de sélectionner l'\Annee Academique "
                            i = 1;
                            return true
                        } */

                    if (this.form.id_annee_academique === "") {
                        this.id_annee_accademique_erreur = "Vous avez oublié de sélectionner l'\ année académique ";

                        return true;

                    }
                    break;

                case 'id_eleve':
                    this.id_eleve_erreur = "";
                    //Vérification de l'eleve selectionner
                    if (this.form.id_eleve === "") {
                        this.id_eleve_erreur = "Code invalide "

                        return true
                    }

                    break;
                default:
                    break;
            }
        },


        validatedataOld() {
            this.id_annee_accademique_erreur = "";
            this.id_eleve_erreur = "";
            this.montant_erreur = "";
            var i = 0;


            if (this.form.id_annee_academique === "") {
                this.id_annee_accademique_erreur = "Vous avez oublié de sélectionner l'\ annee academique";
                i = 1;
            }
            if (this.form.montant === "") {
                this.montant_erreur = "Vous avez oublié de sélectionner le montant de l'inscription";
                i = 1;
            }

            if (this.form.id_eleve === "") {
                this.id_eleve_erreur = "Code invalide "
                i = 1;
            }

            if (i == 1) return true;

            return false;
        },

        /*   closeModal(selector) {
              var ajout = document.querySelector('[data-modal-ajout]');
              var confirmation = document.querySelector(selector);
              this.resetForm();
  
              var actif = document.querySelectorAll('.actif');
              actif.forEach(item => {
                  item.classList.remove("actif");
              });
              ajout.close();
  
              confirmation.style.backgroundColor = 'white';
              confirmation.style.color = 'var(--clr)';
  
              confirmation.showModal();
              confirmation.classList.add("actif");
              setTimeout(function () {
                  confirmation.close();
  
                  setTimeout(function () {
                      confirmation.classList.remove("actif");
                  }, 100);
  
              }, 1700);
          }, */

        async performSearch() {
            this.id_eleve_erreur = "";
            try {
                const response = await axios.get('/recherche/code', {
                    params: {
                        query: this.search_query
                    }
                });
                this.inscriptions = response.data;
                console.log(this.inscriptions)
            } catch (error) {
                console.log(error);
            }
        },

        selectEleve(inscription) {
            console.log("inscription")
            console.log(inscription)
            this.form.id_eleve = inscription.eleve.id;
            this.search_query = inscription.id;
            this.selectedEleve.id = inscription.eleve.id;
            this.selectedEleve.nom = inscription.eleve.user.nom;
            this.selectedEleve.date_naissance = inscription.eleve.user.date_naissance;
            this.selectedEleve.lieu_de_naissance = inscription.eleve.user.lieu_naissance;
            this.selectedEleve.prenom = inscription.eleve.user.prenom;
            this.selectedEleve.matricule = inscription.eleve.user.matricule;
            this.selectedEleve.id_classe = inscription.classe.id;
            // this.selectedEleve.classe = eleve.eleves.inscription.classe.nom_classe;
            this.selectedEleve.classe = inscription.classe.type_formation + ' ' + inscription.classe.nom_classe + ' ' + inscription.classe.niveau + '' + inscription.classe.type_classe;
            this.selectEleve.montant = inscription.montant;
            



            this.inscriptions = [];
            console.log(this.selectedEleve.id_classe)
            this.inscriptions = [];
            this.searchidInscription = false;
            // Pour vider la liste après avoir sélectionné un élève
        },

        get_annee_academique() {
            axios.get('/annee_academique/index')
                .then(response => {
                    this.annee_academiques = response.data.annee_academique
                }).catch(error => {
                    Swal.fire('Erreur!', 'Une erreur est survenue lors de la recupération des année_academiques', 'error')
                });
        },

        /*  valider_inscription() {
             axios.post('/caissier/valider-inscription/'+this.search_query)
                 .then(response => {
                     this.inscriptions = response.data.inscriptionsearch;
                 }).catch(error => {
                     this.resetForm();
                     Swal.fire('Erreur!', 'Une erreur est survenue lors de la recuperation des inscriptions', 'error')
                 });
         }, */
        get_classe() {
            axios.get('/classe/all').then(response => {
                this.classes = response.data.classe;

            }).catch(error => {
                Swal.fire('Erreur!', 'une erreur est survenue lors de la recuperation des classes', 'error')
            });
        },


        async update_inscription(id) {
            const formdata = new FormData();
            formdata.append('id_annee_academique', this.form.id_annee_academique);
            formdata.append('montant', this.form.montant);
            

            try {
                // Effectuer une requête POST pour mettre à jour l'inscription avec l'ID spécifié
                await axios.post('/inscription/update/' + id, formdata);
                showDialog6("Inscription modifiée avec succès");
                // Émettre un événement pour indiquer que l'inscription a été modifiée
                bus.emit('inscriptionAjoutee');
                // Désactiver le mode d'édition
                const eventData = {
                    editModal: false,
                };
                bus.emit('inscriptionDejaModifier', eventData);
                // Réinitialiser le formulaire
                this.resetForm();
            } catch (error) {
                // Gérer les erreurs
                if (error.response.status === 404) {
                    console.log(error)
                    showDialog3("Une erreur est survenue lors de la modification");
                } else {
                    showDialog3("Une erreur est survenue lors de la modification");
                }
            }
        },

        monterToupdate(inscription) {
            console.log("MonterToupdate called");
            this.idInscription = inscription.id;
            this.editModal = inscription.editModal;
            this.form.id_annee_academique = inscription.id_annee_academique;
            this.form.montant = inscription.montant;
            this.form.id_user = inscription.id_user;
            this.form.prenom_eleve = inscription.prenom;
            this.form.nom_eleve = inscription.nom;
            this.form.date_naissance_eleve = inscription.date;
            this.form.lieu_naissance_eleve = inscription.lieu_naissance_eleve;
        },



        resetForm() {
            const eventData = {
                editModal: false,
            };
            bus.emit('inscriptionDejaModifier', eventData);
            this.form.id_eleve = "";
            this.form.statut = "";
            this.form.id_annee_academique = "";
            this.selectedEleve.id = "";
            this.selectedEleve.nom = "";
            this.selectedEleve.prenom = "";
            this.selectedEleve.classe = "";
            this.search_query = "";
            this.eleve_classe = ""
            this.id_annee_accademique_erreur = "";
            this.montant_erreur = "";
            this.searchidInscription = true;
        },

       

        


    }

}
</script>
