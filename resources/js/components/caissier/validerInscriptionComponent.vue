<template>
    
        <div class="titres">
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
        </div>
    
</template>

<script>
import bus from '../../eventBus';
import axios from 'axios';
import Form from 'vform';
export default {
    name: "createPaiementCompenent",
    data() {
        return {
            filieres: [],
            form: new Form({

                'id_eleve': "",
                'id_classe': "",
                'statut': "",
                'montant': "",
                'id_annee_academique': ""

            }),
            inscriptions: [],
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

        }
    },

    mounted() {
        this.get_annee_academique();
        this.get_classe();



    },

    methods: {
        async soumettre() {
            const formdata = new FormData();

            formdata.append('id_eleve', this.selectedEleve.id);
            formdata.append('id_classe', this.selectedEleve.id_classe);
            formdata.append('montant', this.form.montant);
            formdata.append('id_annee_academique', this.form.id_annee_academique);

            try {
                const create_store = await axios.post('/caissier/valider-inscription/' + this.search_query, formdata, {

                });
                this.resetForm();
                // Swal.fire('Succes!','paiement ajouté avec succes','success')
                bus.emit('paiementAjoutee');
                var ajout = document.querySelector('[data-modal-ajout]');

                this.closeModal('[data-modal-confirmation]');
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
                this.soumettre();
                this.etatForm = true;
                this.closeModal('[data-modal-confirmation]');
                console.log("Tokkos");
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
                            this.id_annee_accademique_erreur = "Vous avez oublié de sélectionner l'\ année académique "  ;
                            
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
            this.id_eleve_erreur="";
            this.montant_erreur = "";
            var i = 0;


                if (this.form.id_annee_academique === "") {
                    this.id_annee_accademique_erreur = "Vous avez oublié de sélectionner l'\ annee academique" ;
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

        closeModal(selector) {
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
        },

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
            this.form.id_eleve = inscription.eleve.id;
            this.search_query = inscription.id;
            this.selectedEleve.id = inscription.eleve.id;
            this.selectedEleve.nom = inscription.eleve.user.nom;
            this.selectedEleve.prenom = inscription.eleve.user.prenom;
            this.selectedEleve.matricule = inscription.eleve.user.matricule;
            this.selectedEleve.id_classe = inscription.classe.id;
            // this.selectedEleve.classe = eleve.eleves.inscription.classe.nom_classe;
            this.selectedEleve.classe = inscription.classe.type_formation + ' ' + inscription.classe.nom_classe + ' ' + inscription.classe.niveau+ ''+inscription.classe.type_classe;
            this.selectEleve.montant  = inscription.montant;
            if(this.selectEleve.montant>0){
               this.closeModal('[data-modal-confirmation-inscription]');
            }



            this.inscriptions = [];
            console.log(this.selectedEleve.id_classe)
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





        resetForm() {
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
        },



    }

}
</script>
