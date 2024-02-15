<template>
    <div class="col-lg-6 p-t-20">
        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
            <label class="mdl-textfield__label" for="txtFirstName" v-show="!form.intitule">Nom Service</label>
            <input class="mdl-textfield__input" type="text" id="txtFirstName" v-model="form.intitule"
                @input="validatedata('intitule')">
            <span class="erreur">{{ this.intitule_erreur }}</span>
        </div>
    </div>

    <div class="col-lg-6 p-t-20 mt-1">
        <div
            class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label getmdl-select getmdl-select__fix-height txt-full-width">

            <label class="mdl-textfield__label" for="livreSelect" v-show="!form.id_livre"> Choisissez la livre
            </label>
            <select class="mdl-textfield__input" id="livreSelect" readonly tabIndex="-1" v-model="form.id_livre"
                @change="validatedata('id_livre')">

                <option v-for="(livre, index) in livres" :value="livre.id" :key="index">{{
                    livre.titre }}</option>
            </select>
            <span class="erreur">{{ id_livre_erreur }}</span>
        </div>
    </div>

    <div class="col-lg-6 p-t-20">
         <div
            class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label getmdl-select getmdl-select__fix-height txt-full-width">

            <label class="mdl-textfield__label" for="rayonSelect" v-show="!form.id_rayon"> Choisissez le rayon
            </label>
            <select class="mdl-textfield__input" id="rayonSelect" readonly tabIndex="-1" v-model="form.id_rayon"
                @change="validatedata('id_rayon')">

                <option v-for="(rayon, index) in rayons" :value="rayon.id" :key="index">{{
                    rayon.nom_rayon }}</option>
            </select>
            <span class="erreur">{{ id_rayon_erreur }}</span>
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
            <header>Liste des derniers exemplaires</header>
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
                        <th>Identifiant</th>
                        <th> Service </th>
                        <th> livre </th>
                        <th> rayon </th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="odd gradeX" v-for="(exemplaire, index) in exemplaires" :key="index">
                        <td> {{ index + 1 }} </td>
                        <td> {{ exemplaire.intitule }} </td>
                        <td> {{ exemplaire.livre.titre }}</td>
                        <td> {{ exemplaire.rayon.nom_rayon }}</td>
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
    props: ['exemplaire'],
    name: "createExemplaireCompenent",
    components: {
        flatPickr,
    },
    data() {
        return {
            rayons: [],
            livres: [],
            exemplaires: [],
            form: new Form({
                'intitule': "",
                'id_rayon': "",
                'id_livre': ""
            }),
            intitule_erreur: "",
            id_livre_erreur: "",
            id_rayon_erreur: "",
            etatForm: false,
            editModal: false,
            idExemplaire: "",
        }
    },

    mounted() {
        this.get_livre();
        this.get_rayon();
        this.get_exemplaire();
        bus.on('exemplaireModifier', (eventData) => {
            this.editModal = eventData.editModal;
            this.monterToupdate(eventData.exemplaire);
        });

    },

    methods: {
        async soumettre() {
            const formdata = new FormData();
            formdata.append('intitule', this.form.intitule);
            formdata.append('id_livre', this.form.id_livre);
            formdata.append('id_rayon', this.form.id_rayon);
            try {
                const user_store = await axios.post('/exemplaire/store', formdata, {});
                showDialog6("exemplaire ajouté avec succès");
                bus.emit('exemplaireAjoutee;')
                this.resetForm();
                window.location.href = '/exemplaire/accueil';
            }
            catch (e) {
                /* console.log(e.request.status) */
                if (e.request.status === 404) {
                    showDialog3("Cet exemplaire existe déjà");
                }
                else {
                    //Swal.fire('Erreur !', 'Une erreur est survenue lors de l\'enregistrement', 'error')
                    showDialog3("Une erreur est survenue lors de l\'enregistrement");
                }

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
                    this.form.intitule = this.form.intitule.toUpperCase();
                    this.update_exemplaire(this.idExemplaire);
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

        resetForm() {
            this.form.intitule = "";
            this.form.id_rayon = "";
            this.form.id_livre = ""
            this.intitule_erreur = "";
            this.id_rayon_erreur = "";
            this.id_livre_erreur = "";
            this.editModal = false;
            const eventData = {
                editModal: false,
            };
            bus.emit('exemplaireDejaModifier', eventData);
        },



        verifCaratere(nom) {
            const valeur = /^[a-zA-ZÀ-ÿ\s]*$/;
            return valeur.test(nom);
        },



        validatedata(champ) {
            switch (champ) {
                case 'intitule':
                    this.intitule_erreur = "";
                    // Effectuez la validation pour le champ 'nom'
                    if (this.form.intitule === "") {
                        this.intitule_erreur = "Ce champ est obligatoire"
                        //this.coloration_erreur_rouge(this.intitule_erreur);
                        return true
                    }
                    if (!this.verifCaratere(this.form.intitule)) {
                        this.intitule_erreur = "Ce champ ne peut comporter que des lettres et des espaces"
                        /* this.erreur= "Ce champ ne peut comporter que des lettres et des espaces" */
                        // this.coloration_erreur_rouge(this.intitule_erreur);
                        return true
                    }
                    if (this.form.intitule.length < 12) {
                        this.intitule_erreur = "Ce champ doit contenir au moins 12 Caractères"
                            ;
                        // this.coloration_erreur_rouge(this.intitule_erreur);
                        return true
                    }
                    break;

                case 'livre':
                    this.id_livre_erreur = "";
                    //pour livre
                    if (this.editModal) {
                        if (this.form.id_livre === "") {
                            this.id_livre_erreur = "Vous avez oublié de sélectionner le livre'"
                            return true
                        }
                    }
                    break;

                case 'rayon':
                    //pour rayon
                    this.id_rayon_erreur = "";
                    if (this.form.id_rayon === "") {
                        this.id_rayon_erreur = "Vous avez oublié de sélectionner  le chef de direction'"
                        return true
                    }
                    break;

                case 'id_livre':
                    //pour dlivre
                    this.id_livre_erreur = "";
                    if (this.editModal) {
                        if (this.form.id_livre === "") {
                            this.id_livre_erreur = "Vous avez oublié de sélectionner le chef de service"
                            return true
                        }
                    }
                    break;

                case 'id_rayon':
                    //pour rayon
                    this.id_rayon_erreur = "";
                    if (this.form.id_rayon === "") {
                        this.id_rayon_erreur = "Vous avez oublié de sélectionner la rayon concernée"
                        return true;
                    }
                    break;

                default:
                    break;
            }
            return false;
        },

        validatedataOld() {
            this.intitule_erreur = "";
            this.id_livre_erreur = "";
            this.id_rayon_erreur = "";
            var i = 0;


            if (this.form.intitule === "") {
                this.intitule_erreur = "Ce champ est obligatoire"

                i = 1;
            }
            if (!this.verifCaratere(this.form.intitule)) {
                this.intitule_erreur = "Ce champ ne peut comporter que des lettres et des espaces"
                    ;
                i = 1;
            }

            /* if(this.form.intitule.length < 12){
                this.intitule_erreur= "Ce champ doit contenir au moins 12 Caratères"
                ;
                i=1;
            } */

            if (this.form.intitule.length < 12) {
                this.intitule_erreur = "Ce champ doit contenir au moins 12 Caratères"
                    ;
                i = 1;
            }

            if (this.editModal) {
                if (this.form.id_rayon === "") {
                    this.id_rayon_erreur = "Vous avez oublié de sélectionner le rayon"
                        ;
                    i = 1;
                }
            }
            if (this.form.id_livre === "") {
                this.id_livre_erreur = "Vous avez oublié de sélectionner la livre concernée"
                    ;
                i = 1;
            }
            if (i == 1) return true;

            return false;
        },

        get_livre() {
            axios.get('/livre/index')
                .then(response => {
                    this.livres = response.data.livre

                }).catch(error => {
                    Swal.fire('Erreur!', 'Une erreur est survenue lors de la recupération des livres', 'error')
                });
        },

        get_rayon() {
            axios.get('/rayon/index')
                .then(response => {
                    this.rayons = response.data.rayon

                }).catch(error => {
                    Swal.fire('Erreur!', 'Une erreur est survenue lors de la recupération des rayons', 'error')
                });
        },
        get_exemplaire() {
            axios.get('/exemplaire/index/get/last')
                .then(response => {
                    this.exemplaires = response.data.exemplaire;
                    console.log(this.exemplaires)

                }).catch(error => {
                    Swal.fire('Erreur!', 'Une erreur est survenue lors de la recupération des exemplaires', 'error')
                });
        },

        async update_exemplaire(id) {
            const formdata = new FormData();
            formdata.append('intitule', this.form.intitule);
            formdata.append('id_livre', this.form.id_livre);
            formdata.append('id_rayon', this.form.id_rayon);

            //if(this.form.nom!==""){
            try {
                await axios.post('/exemplaire/update/' + id, formdata);
                showDialog6("Exemplaire modifié avec succès");
                bus.emit('exemplaireAjoutee');
                const eventData = {
                    editModal: false,
                };
                bus.emit('exemplaireDejaModifier', eventData);
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

        monterToupdate(exemplaire) {
            this.idExemplaire = exemplaire.id;
            this.editModal = exemplaire.editModal;
            this.form.intitule = exemplaire.exemplaire;
            this.form.titre = exemplaire.livre;
            this.form.id_livre = exemplaire.id_livre;
            this.form.id_rayon = exemplaire.id_rayon;
        },
    }
}
</script>
     
     