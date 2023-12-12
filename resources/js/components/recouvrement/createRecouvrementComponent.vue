<template>
    <div class="titres">
        <h1>Recouvrement</h1>
    </div>
    <form @submit.prevent="validerAvantAjout()" action="" method="">
        <div class="informations">
            <div class="titres">
                <h1> Recouvrement</h1>
            </div>
            
                <div class="champ">
                    <label for="annee_academique" :class="{ 'couleur_rouge': (this.id_annee_academique_erreur) }">Année
                        Academique</label>
                    <select v-model="form.id_annee_academique" @change="validatedata('annee_academique')"
                        :class="{ 'bordure_rouge': (this.id_annee_academique_erreur) }">

                        <option v-for="annee_academique in annee_academiques" :value="annee_academique.id">{{
                            annee_academique.intitule }}</option>
                    </select>
                    <span class="erreur" v-if="id_annee_academique_erreur !== ''">{{ id_annee_academique_erreur }}></span>
                </div>

                <div class="champ">
                    <label for="mois" :class="{ 'couleur_rouge': (this.id_mois_erreur) }">Mois</label>
                    <select v-model="form.id_mois" @change="validatedata('mois')"
                        :class="{ 'bordure_rouge': (this.id_mois_erreur) }">

                        <option v-for="mois in mois" :value="mois.id">{{ mois.intitule }}</option>

                    </select>
                    <span class="erreur" v-if="id_mois_erreur !== ''">{{ id_mois_erreur }}></span>
                </div>

         


            <div class="champ">
                <label for="departement" :class="{ 'couleur_rouge': (this.id_departement_erreur) }">Département</label>
                <select v-model="form.id_departement" @change="validatedata('departement')"
                    :class="{ 'bordure_rouge': (this.id_departement_erreur) }">
                    <option v-for="departement in departements" :value="departement.id">{{ departement.nom_departement }}
                    </option>
                </select>
                <span class="erreur" v-if="id_departement_erreur !== ''">{{ id_departement_erreur }}></span>
            </div>

            <div class="champ">
                <label for="unite_de_formation" :class="{ 'couleur_rouge': (this.id_unite_de_formation_erreur) }">Filiére</label>
                <select v-model="form.id_unite_de_formation" @change="validatedata('unite_de_formation')"
                    :class="{ 'bordure_rouge': (this.id_unite_de_formation_erreur) }">
                    <option v-for="unite_de_formation in unite_de_formations" :value="unite_de_formation.id">{{
                        unite_de_formation.nom_unite_formation }}</option>

                </select>
                <span class="erreur" v-if="id_unite_de_formation_erreur !== ''">{{ id_unite_de_formation_erreur }}></span>
            </div>

            <div class="champ">
                <label for="classe" :class="{ 'couleur_rouge': (this.id_classe_erreur) }">Classe</label>
                <select v-model="form.id_classe" @change="validatedata('classe')"
                    :class="{ 'bordure_rouge': (this.id_classe_erreur) }">
                    <option v-for="classe in classes" :value="classe.id">{{ classe.nom_classe }}</option>
                </select>
                <span class="erreur" v-if="id_classe_erreur !== ''">{{ id_classe_erreur }}></span>
            </div>


            <div class="groupe_champs validation">
                    <button type="button" @click="closeModal()" class="texte annuler">Annuler</button>
                    <button type="submit"  :class="{ 'data-close-modal': (this.etatForm) }">Appliquer</button>
                </div>
        </div>
    </form>
</template>

<script>
import axios from 'axios';
import Form from 'vform';
import Swal from 'sweetalert2';

export default {
    name: "createRecouvrementCompenent",
    data() {
        return {
            filieres: [],
            form: new Form({
                'id_annee_academique': "",
                'id_mois': "",
                'id_departement': "",
                'id_unite_de_formation': "",
                'id_classe': "",

            }),
            annee_academiques: [],
            mois: [],
            departements: [],
            unite_de_formations: [],
            classes: [],
            
            id_annee_academique_erreur: "",
            id_mois_erreur: "",
            id_departement_erreur: "",
            id_unite_de_formation_erreur: "",
            id_classe_erreur: "",
            etatForm: false,
            i: 0,


        }
    },
    mounted() {
        this.get_annee_academique();
        this.get_mois();
        this.get_departement();
        this.get_unite_de_formation();
        this.get_classe();


    },

    methods: {
        async soumettre() {
            const formdata = new FormData();
            formdata.append('id_annee_academique', this.form.id_annee_academique);
            formdata.append('id_mois', this.form.id_mois);
            formdata.append('id_departement', this.form.id_departement);
            formdata.append('id_unite_de_formation', this.form.id_unite_de_formation);
            formdata.append('id_classe', this.form.id_classe);
            try {
                const response = await axios.post('/recouvrement/filtre', formdata);
                // Traitez la réponse de l'API selon vos besoins
                console.log(response.data);
            } catch (error) {
                console.error('Une erreur s\'est produite lors de la récupération des données filtrées.', error);
            }




        },

        get_annee_academique() {
            axios.get('/annee_academique/index').then(response => {
                this.annee_academiques = response.data.annee_academique
                console.log(response.data.annee_academique);
            }).catch(error => {
                Swal.fire('Erreur!', 'Une erreur est survenue lors de la recuperation des année_academiques', 'error')
            });
        },
        get_mois() {
            axios.get('/mois/index')
                .then(response => {
                    this.mois = response.data.mois
                }).catch(error => {
                    this.resetForm();
                    Swal.fire('Erreur!', 'Une erreur est survenue lors de la recuperation du mois', 'error')
                });
        },
        get_departement() {
            axios.get('/departement/all')
                .then(response => {
                    this.departements = response.data.departement
                }).catch(error => {
                    this.resetForm();
                    Swal.fire('Erreur!', 'Une erreur est survenue lors de la recuperation du departement', 'error')
                });
        },
        get_unite_de_formation() {
            axios.get('/unite_de_formation/all')
                .then(response => {
                    this.unite_de_formations = response.data.unite_de_formation
                }).catch(error => {
                    this.resetForm();
                    Swal.fire('Erreur!', 'Une erreur est survenue lors de la recuperation du filiere', 'error')
                });
        },
        get_classe() {
            axios.get('/classe/all')
                .then(response => {
                    this.classes = response.data.classe
                }).catch(error => {
                    this.resetForm();
                    Swal.fire('Erreur!', 'Une erreur est survenue lors de la recuperation de la classe', 'error')
                });
        },

        async filtre() {
          

        },
        validerAvantAjout() {
            const isIdChampValid = this.validatedataOld();
            if (isIdChampValid) {
                this.etatForm = false;
                console.log("erreur");
                return 0;
            } else {
                this.soumettre();
                this.etatForm = true;
                console.log("Tokkos");
            }

        },
       
        validatedata(champ) {
            var i = 0;

            switch (champ) {
                case 'annee_academique':
                    this.id_annee_academique_erreur = "";
                    //pour user
                    if (this.form.id_annee_academique === "") {
                        this.id_annee_academique = "Vous avez oublié de sélectionner  l'année académique"
                        i =1
                        return true
                    }
                    break;

                case 'mois':
                    this.id_mois_erreur = "";
                    //pour user
                    if (this.form.id_mois === "") {
                        this.id_mois = "Vous avez oublié de sélectionner  le mois"
                        i =1
                        return true
                    }
                    break;
                case 'departement':
                    this.id_departement_erreur = "";
                    //pour user
                    if (this.form.id_departement === "") {
                        this.id_departement = "Vous avez oublié de sélectionner  le departement"
                        i =1
                        return true
                    }
                    break;

                case 'unite_de_formation':
                    this.id_unite_de_formation_erreur = "";
                    //pour user
                    if (this.form.id_unite_de_formation === "") {
                        this.id_unite_de_formation = "Vous avez oublié de sélectionner  la filiére"
                        i =1
                        return true
                    }
                    break;

                case 'classe':
                    this.id_classe_erreur = "";
                    //pour user
                    if (this.form.id_classe === "") {
                        this.id_classe = "Vous avez oublié de sélectionner  la classe"
                        i =1
                        return true
                    }
                    break;

                default:
                    break;
            }
           /*  return false; */
        },

        validatedataOld() {
            var i = 0;
            this.id_annee_academique_erreur = "";
            this.id_mois_erreur = "";
            this.id_departement_erreur = "";
            this.id_unite_de_formation_erreur = "";
            this.id_classe_erreur = "";

            if (this.form.id_annee_academique === "") {
                this.id_annee_academique = "Vous avez oublié de sélectionner l'année académique'"
                    ;
                i = 1;
            }
            if (this.form.mois === "") {
                this.mois = "Vous avez oublié de sélectionner le mois"
                    ;
                i = 1;
            }
            if (this.form.departement === "") {
                this.departement = "Vous avez oublié de sélectionner le departement''"
                    ;
                i = 1;
            }
            if (this.form.unite_de_formation === "") {
                this.unite_de_formation = "Vous avez oublié de sélectionner la filiére"
                    ;
                i = 1;
            }
            if (this.form.classe === "") {
                this.classe = "Vous avez oublié de sélectionner la classe"
                    ;
                i = 1;
            }

            if (i == 1) return true;

            return false;

        },

        closeModal(selector) {
            var ajout = document.querySelector('[data-modal-ajout]');
            var confirmation = document.querySelector(selector);

            if (this.etatForm == true) {
                var actif = document.querySelectorAll('.actif');
                actif.forEach(item => {
                    item.classList.remove("actif");
                });
                ajout.close();
            }
            /* console.log(ajout); */

            //ajout.classList.remove("actif");


            this.editModal === false;

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



        resetForm() {
            this.form.id_annee_academique = "";
            this.form.id_mois = "";
            this.form.id_departement = "";
            this.form.id_unite_de_formation = "";
            this.form.id_classe = "";
            this.id_annee_academique_erreur = "";
            this.id_mois_erreur = "";
            this.id_departement_erreur = "";
            this.id_unite_de_formation_erreur = "";
            this.id_classe_erreur = "";
            this.etatForm = false;
            /* this.editModal=false; */
           /*  this.closeModal(); */



        },

    }
}
</script>