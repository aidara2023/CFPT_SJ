<template>
    <div class="col-lg-12 p-t-20" v-show="searchMatricule">
        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
            <label class="mdl-textfield__label" for="txtMatricule" v-show="!search_query">Matricule</label>
            <input class="mdl-textfield__input" type="text" id="txtMatricule" v-model="this.search_query"
                @input="performSearch">
            <span class="erreur">{{ this.id_eleve_erreur }}</span>
        </div>
    </div>
    <div v-for="(eleve, key) in eleves" :key="key" @click="selectEleve(eleve)">
        <a href="#"> {{ eleve.nom }} {{ eleve.prenom }}</a>
    </div>

    <div class="card-body row" v-show="form.id_eleve !== '' && selectedEleve.id">
        <div class="row">
            <div class="col-md-12">
                <div class="pull-left">
                    <address>
                        <img :src="getImageUrl(selectedEleve.photo)" alt="logo" class="logo-default"
                            style="width: 10%; height: 10%;" />
                        <p class=" ">
                            {{ search_query }} <br>
                            <b>Nom complet :</b> {{ selectedEleve.nom }} {{ selectedEleve.prenom }}, <br> <b>Classe :</b> {{
                                selectedEleve.classe }} <br>
                            <b>Date Naissance :</b> {{ selectedEleve.date_naissance }}, <br> <b>Adresse :</b> {{
                                selectedEleve.adresse }}
                        </p>

                    </address>
                </div>
            </div>
        </div>

        <div class="col-lg-2 p-t-20">
            <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-2">
                <input type="radio" id="option-2" class="mdl-radio__button" name="options" value="Mensuel" v-model="paie.paiement_type">
                <span class="mdl-radio__label">Mensuel</span>
            </label>
        </div>
        <div class="col-lg-2 p-t-20">
            <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-3">
                <input type="radio" id="option-3" class="mdl-radio__button" name="options" value="Annuel" checked v-model="paie.paiement_type">
                <span class="mdl-radio__label">Annuel</span>
            </label>
        </div>
<!--         <div class="col-lg-2 p-t-20">
            <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-1">
                <input type="radio" id="option-1" class="mdl-radio__button" name="options" value="1" v-model="paie.paiement_type">
                <span class="mdl-radio__label">Session</span>
            </label>
        </div> -->

       <!--  <div class="col-lg-12 p-t-20">
            <div
                class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label getmdl-select getmdl-select__fix-height txt-full-width">
                <input class="mdl-textfield__input" type="text" id="list9" value="" readonly tabIndex="-1" v-model="paie.paiement_type" @change="validatedata('paiement_type')">
                <label for="list9" class="pull-right margin-0">
                    <i class="mdl-icon-toggle__label material-icons">keyboard_arrow_down</i>
                </label>
                <label for="list9" class="mdl-textfield__label">Payment Type</label>
                <ul data-mdl-for="list9" class="mdl-menu mdl-menu--bottom-left mdl-js-menu">
                    <li class="mdl-menu__item" data-val="DE">Cash</li>
                    <li class="mdl-menu__item" data-val="BY">Cheque</li>
                    <li class="mdl-menu__item" data-val="BY">Online Transfer</li>
                    <li class="mdl-menu__item" data-val="BY">Draft</li>
                    <li class="mdl-menu__item" data-val="OT">Other</li>
                </ul>
            </div>
        </div> -->
        <div class="col-lg-12 p-t-20">
        <div
            class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label getmdl-select getmdl-select__fix-height txt-full-width">
            <label for="list3" class="mdl-textfield__label" v-show="!paie.mode_paiement">Choisissez Genre</label>
            <select class="mdl-textfield__input" id="list3" readonly tabIndex="-1" v-model="paie.mode_paiement"
                @change="validatedata('paie.mode_paiement')">
                <option value="Masculin">Cash</option>
                <option value="Féminin">Cheque</option>
                <option value="Féminin">Orange</option>
                <option value="Féminin">Wave</option>
            </select>
            <span class="erreur">{{ this.mode_paiement_erreur }}</span>
        </div>

    </div>

        <div class="card-body row" v-for="(paie, index) in form_paiement.paiement" :key="index">
            <div class="header d-flex justify-content-end ">

                <svg class="cursor-pointer" @click.prevent="duplicatePaiement(index)" xmlns="hhtp://www.w3.org/200/svg"
                    viewBox="0 0 24 24" width="24" height="24" style="">
                    <path fill="none" d="M0 0h24v24H0z" />
                    <path fill="green"
                        d="M11 11V7h2v4h4v2h-4v4h-2v-4H7v-2h4zm1 11C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16z" />
                </svg>
                <svg v-show="form_paiement.paiement.length > 1" class="cursor-pointer ml-2"
                    @click.prevent="removePaiement(index)" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24"
                    height="24">
                    <path fill="none" d="M0 0h24v24H0z" />
                    <path fill="#EC4899"
                        d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm0-9.414l2.828-2.829 1.415 1.415L13.414 12l2.829 2.828-1.415 1.415L12 13.414l-2.828 2.829-1.415-1.415L10.586 12 7.757 9.172l1.415-1.415L12 10.586z" />
                </svg>
            </div>

            <div class="col-lg-6 p-t-20">
                <div
                    class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label getmdl-select getmdl-select__fix-height txt-full-width">
                    <label for="list6" class="mdl-textfield__label" v-show="!paie.id_annee_academique">Choisissez
                        l'année</label>
                    <select class="mdl-textfield__input" id="list6" readonly tabIndex="-1"
                        v-model="paie.id_annee_academique" @change="validatedata('id_annee_accademique')">
                        <option v-for="annee_academique in annee_academiques" :value="annee_academique.id" :key="index">
                            {{ annee_academique.intitule }}
                        </option>
                    </select>
                    <span class="erreur">{{ id_annee_accademique_erreur }}</span>
                </div>
            </div>

            <div class="col-lg-6 p-t-20">
                <div
                    class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label getmdl-select getmdl-select__fix-height txt-full-width">
                    <label for="list7" class="mdl-textfield__label" v-show="!paie.id_mois">Choisissez le mois</label>
                    <select class="mdl-textfield__input" id="list7" readonly tabIndex="-1" v-model="paie.id_mois"
                        @change="validatedata('id_mois')">
                        <option v-for="m in mois" :value="m.id" :key="index">{{ m.intitule }}
                        </option>
                    </select>
                    <span class="erreur">{{ id_mois_erreur }}</span>
                </div>
            </div>

            <div class="col-lg-12 p-t-20">
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
                    <label class="mdl-textfield__label" for="txtMontant" v-show="!paie.montant">Montant</label>
                    <input class="mdl-textfield__input" type="text" id="txtMontant" v-model="paie.montant"
                        @input="validatedata('montant')">
                </div>
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
export default {
    name: "createPaiementCompenent",
    data() {
        return {
            filieres: [],
            form: new Form({

                'id_eleve': "",

                'statut': "",

            }),
            form_paiement: new Form({
                paiement: [{
                    id_mois: "",
                    montant: "",
                    id_annee_academique: "",
                    mode_paiement:"",
                    paiement_type:""
                }]
            }),
            eleves: [],
            mois: [],
            annee_academiques: [],
            search_query: "",
            selectedEleve: {
                id: "",
                nom: "",
                prenom: "",
                classe: "",
                adresse: "",
                date_naissance: "",
                photo: ""
            },
            eleve_classe: "",
            id_eleve_erreur: "",
            id_annee_accademique_erreur: "",
            mode_paiement_erreur: "",
            paiement_type_erreur: "",
            id_mois_erreur: "",
            montant_erreur: "",
            id_eleve_erreur: "",
            etatForm: false,
            editModal: false,
            searchMatricule: true,

        }
    },

    mounted() {
        this.get_annee_academique();
        this.get_mois();
        this.rafraichissementAutomatique();
        bus.on('paiementModifier', (eventData) => {
            this.editModal = eventData.editModal;
            this.monterToupdate(eventData.salle);
        });
    },

    methods: {
        async soumettre() {
            const formdata = new FormData();
            formdata.append('paiements', JSON.stringify(this.form_paiement.paiement));
            formdata.append('id_eleve', this.form.id_eleve);

            try {
                const create_store = await axios.post('/paiement/store', formdata, {

                });
                showDialog6("Paiement effectué avec succès");
                bus.emit('paiementAjoutee');
                this.resetForm();
                window.location.href = '/paiement/accueil';
                bus.emit('paiementAjoutee');

            }
            catch (e) {
                console.log(e)
                showDialog3("Une erreur est survenue lors de l\'enregistrement");
            }

        },

        validerAvantAjout() {
            const isVerifIdValid = this.validatedataOld();
            console.log("isVerifIdValid");
            console.log(isVerifIdValid);

            if (isVerifIdValid === true) {
                this.etatForm = false;
                this.editModal = false;
                //console.log("erreur");
                return 0;
            } else {
                if (this.editModal === true) {
                    this.etatForm = true;
                    this.update_salle(this.idSalle);
                    this.editModal = false;
                }
                else {
                    this.soumettre();
                    this.etatForm = true;
                    this.editModal = false;

                }
            }
        },

        validatedata(champ) {
            switch (champ) {
                case 'montant':
                    this.montant_erreur = "";
                    for (let i = 0; i < this.form_paiement.paiement.length; i++) {
                        const paiement = this.form_paiement.paiement[i];
                        if (paiement.montant === "" || isNaN(paiement.montant) || paiement.montant <= 0) {
                            this.montant_erreur = "Le montant pour le paiement " + (i + 1) + " est invalide";
                            return true;
                        }
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
                    for (let i = 0; i < this.form_paiement.paiement.length; i++) {
                        const paiement = this.form_paiement.paiement[i];
                        if (paiement.id_annee_academique === "") {
                            this.id_annee_accademique_erreur = "Vous avez oublié de sélectionner l'\Annee Academique pour le paiement " + (i + 1);
                            return true;
                        }
                    }
                    break;
                case 'id_mois':
                    this.id_mois_erreur = "";
                    //Vérification de annee academique
                    /*  if (this.form.id_annee_accademique === "") {
                         this.id_mois_erreur = "Vous avez oublié de sélectionner le mois "
                         i = 1;
                         return true
                     } */
                    for (let i = 0; i < this.form_paiement.paiement.length; i++) {
                        const paiement = this.form_paiement.paiement[i];
                        if (paiement.id_mois === "") {
                            this.id_mois_erreur = "Vous avez oublié de sélectionner le mois pour le paiement " + (i + 1);
                            return true;
                        }
                    }
                    break;
                case 'id_eleve':
                    this.id_eleve_erreur = "";
                    //Vérification de l'eleve selectionner
                    if (this.form.id_eleve === "") {
                        this.id_eleve_erreur = "Matricule invalide "
                        i = 1;
                        return true
                    }

                    break;
                default:
                    break;
            }
        },


        validatedataOld() {
            this.id_annee_accademique_erreur = "";
            this.id_mois_erreur = "";
            this.montant_erreur = "";
            this.id_eleve_erreur = "";
            var j = 0;

            for (let i = 0; i < this.form_paiement.paiement.length; i++) {
                const paiement = this.form_paiement.paiement[i];
                if (paiement.id_mois === "") {
                    this.id_mois_erreur = "Vous avez oublié de sélectionner le mois pour le paiement " + (i + 1);
                    j = 1;

                }
                if (paiement.id_annee_academique === "") {
                    this.id_annee_accademique_erreur = "Vous avez oublié de sélectionner l'\Annee Academique pour le paiement " + (i + 1);
                    j = 1;

                }
                if (paiement.montant === "" || isNaN(paiement.montant) || paiement.montant <= 0) {
                    this.montant_erreur = "Le montant pour le paiement " + (i + 1) + " est invalide";
                    j = 1;

                }
            }
            if (this.form.id_eleve === "") {
                this.id_eleve_erreur = "Matricule invalide "
                j = 1;

            }


            if (j == 1) return true;

            return false;
        },

        closeModal(selector) {
            var ajout = document.querySelector('[data-modal-ajout]');
            var confirmation = document.querySelector(selector);

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
                const response = await axios.get('/recherche/eleve', {
                    params: {
                        query: this.search_query
                    }
                });
                this.eleves = response.data;
                console.log(this.eleves)
            } catch (error) {
                console.log(error);
            }
        },

        selectEleve(eleve) {
            this.form.id_eleve = eleve.id;
            this.search_query = eleve.matricule;
            this.selectedEleve.id = eleve.id;
            this.selectedEleve.nom = eleve.nom;
            this.selectedEleve.prenom = eleve.prenom;
            this.selectedEleve.adresse = eleve.adresse;
            this.selectedEleve.date_naissance = eleve.date_naissance;
            this.selectedEleve.photo = eleve.photo;
            // this.selectedEleve.classe = eleve.eleves.inscription.classe.nom_classe;
            eleve.eleves.forEach((eleve) => {
                eleve.inscription.forEach((inscription) => {
                    this.selectedEleve.classe = inscription.classe.type_classe + ' ' + inscription.classe.nom_classe + ' ' + inscription.classe.niveau;
                });
            });
            this.eleves = [];
            console.log(this.selectedEleve.classe)
            this.eleves = []; // Pour vider la liste après avoir sélectionné un élève
            this.searchMatricule = false;
        },
        getImageUrl(url) {
            return url ? `${window.location.origin}/storage/${url}` : '';
        },

        get_annee_academique() {
            axios.get('/annee_academique/index')
                .then(response => {
                    this.annee_academiques = response.data.annee_academique
                }).catch(error => {
                    Swal.fire('Erreur!', 'Une erreur est survenue lors de la recuperation des année_academiques', 'error')
                });
        },

        get_mois() {
            axios.get('/mois/index')
                .then(response => {
                    this.mois = response.data.mois
                }).catch(error => {
                    Swal.fire('Erreur!', 'Une erreur est survenue lors de la recuperation des mois', 'error')
                });
        },

        resetForm() {
            this.form.id_eleve = "";
            this.form.statut = "";
            this.form_paiement.paiement.id_mois = "";
            this.form_paiement.paiement.montant = "";
            this.form_paiement.paiement.id_annee_academique = "";
            this.selectedEleve.id = "";
            this.selectedEleve.nom = "";
            this.selectedEleve.prenom = "";
            this.selectedEleve.classe = "";
            this.selectedEleve.adresse = "";
            this.selectedEleve.date_naissance = "";
            this.selectedEleve.photo = "";
            this.search_query = "";
            this.eleve_classe = ""
            this.id_annee_accademique_erreur = "";
            this.id_mois_erreur = "";
            this.montant_erreur = "";
            this.searchMatricule = true;
        },

        rafraichissementAutomatique() {
            document.addEventListener("DOMContentLoaded", this.resetForm());
        },

        duplicatePaiement(index) {
            const newPaiement = { ...this.form_paiement.paiement[index] };
            this.form_paiement.paiement.splice(index + 1, 0, newPaiement);
        },

        removePaiement(index) {
            if (this.form_paiement.paiement.length > 1) {
                this.form_paiement.paiement.splice(index, 1);
            }
        },

        async update_paiement(id) {
            const formdata = new FormData();
            formdata.append('paiements', JSON.stringify(this.form_paiement.paiement));
            formdata.append('id_eleve', this.form.id_eleve);

            //if(this.form.nom!==""){
            try {
                await axios.post('/paiement/update/' + id, formdata);
                showDialog6("Paiement modifié avec succès");
                bus.emit('paiementAjoutee');
                const eventData = {
                    editModal: false,
                };
                bus.emit('paiementDejaModifier', eventData);
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

        monterToupdate(paiement) {
            console.log("MonterToupdate called");

            this.idPaiement = paiement.id;
            this.editModal = paiement.editModal;
            this.form.intitule = paiement.paiement;
            this.form.nombre_place = paiement.nombre_de_place;
            this.form.id_batiment = paiement.id_batiment;
            this.form.nom_batiment = paiement.batiment;


        },

    }

}
</script>
