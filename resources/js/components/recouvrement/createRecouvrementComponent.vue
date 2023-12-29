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
                <span class="erreur">{{ id_annee_academique_erreur }}</span>
            </div>

            <div class="champ">
                <label for="mois" :class="{ 'couleur_rouge': (this.id_mois_erreur) }">Mois</label>
                <select v-model="form.id_mois" @change="validatedata('mois')"
                    :class="{ 'bordure_rouge': (this.id_mois_erreur) }">

                    <option v-for="mois in mois" :value="mois.id">{{ mois.intitule }}</option>

                </select>
                <span class="erreur">{{ id_mois_erreur }}</span>
            </div>




            <div class="champ">
                <label for="departement" :class="{ 'couleur_rouge': (this.id_departement_erreur) }">Département</label>
                <select v-model="form.id_departement" @change="get_filiere(form.id_departement)"
                    :class="{ 'bordure_rouge': (this.id_departement_erreur) }">
                    <option v-for="departement in departements" :value="departement.id">{{ departement.nom_departement }}
                    </option>
                </select>
                <span class="erreur">{{ id_departement_erreur }}</span>
            </div>

            <div class="champ">
                <label for="unite_de_formation"
                    :class="{ 'couleur_rouge': (this.id_unite_de_formation_erreur) }">Filiére</label>
                <select v-model="form.id_unite_de_formation" @change="get_classe(form.id_unite_de_formation)"
                    :class="{ 'bordure_rouge': (this.id_unite_de_formation_erreur) }">
                    <option v-for="unite_de_formation in unite_de_formations" :value="unite_de_formation.id">{{
                        unite_de_formation.nom_unite_formation }}</option>

                </select>
                <span class="erreur">{{ id_unite_de_formation_erreur }}</span>
            </div>

            <div class="champ">
                <label for="classe" :class="{ 'couleur_rouge': (this.id_classe_erreur) }">Classe</label>
                <select v-model="form.id_classe" @change="validatedata('classe')"
                    :class="{ 'bordure_rouge': (this.id_classe_erreur) }">
                    <option v-for="classe in classes" :value="classe.id">{{ classe.type_formation.intitule }} {{
                        classe.nom_classe }} {{ classe.niveau }} {{ classe.type_classe }}</option>
                </select>
                <span class="erreur">{{ id_classe_erreur }}</span>
            </div>


            <div class="groupe_champs validation">
                <button type="button" @click="closeModal()" class="texte annuler">Annuler</button>
                <button type="submit" :class="{ 'data-close-modal': (this.etatForm) }">Appliquer</button>
            </div>
        </div>
    </form>
</template>

<script>
import bus from '../../eventBus';
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
            nom_classe_selected: "",
            etatForm: false,
            i: 0,


        }
    },
    mounted() {
        this.get_annee_academique();
        this.get_mois();
        this.get_departement();
        //this.get_unite_de_formation();
        //this.get_classe();
       
    


    },

    methods: {
        async soumettre() {
            const formdata = new FormData();
            formdata.append('id_annee_academique', this.form.id_annee_academique);
            formdata.append('id_mois', this.form.id_mois);
            formdata.append('id_departement', this.form.id_departement);
            formdata.append('id_unite_de_formation', this.form.id_unite_de_formation);
            formdata.append('id_classe', this.form.id_classe);

            this.get_classe_by_id(this.form.id_classe);
           
            try {
                const response = await axios.post('/recouvrement/filtre', formdata);
                // Traitez la réponse de l'API selon vos besoins
                console.log(response.data);
                //console.log(response.data.eleve_non_payer);

                if (response.data.statut === 200) {

                    const eventData = {
                        eleve_non_payers: response.data.eleve_non_payer,
                        nom_classe_selected: this.nom_classe_selected

                        //editModal: this.editModal,
                        // Ajoutez d'autres propriétés si nécessaire
                    };

                    bus.emit('nouveauFiltre', eventData);

                    this.closeModal();
                }

            } catch (error) {
                console.log(error);
                if (error.request.status === 500) {
                    console.log("erreur recouvrement");
                    this.closeModal('[data-modal-recouvrement-payer ]');
                    this.resetForm();
                    var ajout = document.querySelector('[data-modal-filtre]');
                    var confirmation = document.querySelector('[data-modal-recouvrement-payer ]');

                    // if (this.etatForm == true) {
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
                    //}


                    ajout.classList.remove("actif");


                    this.editModal === false;
                }
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
                    //this.resetForm();
                    Swal.fire('Erreur!', 'Une erreur est survenue lors de la recuperation du mois', 'error')
                });
        },
        async get_classe(id) {
            await axios.get('/find/classes/' + id).then(response => {
                //this.classes = response.data.classe;
                this.validatedata('unite_de_formation');
                 // Filtrer les classes par type d'intitulé (CS ou FPJ)
                 this.classes = response.data.classe.filter(classe => {
                        return classe.type_classe === 'CS' || classe.type_classe === 'FPJ';
                    });

            }).catch(error => {
                Swal.fire('Erreur!', 'une erreur est survenue lors de la recuperation des classes', 'error')
            });
        },

        async get_departement() {
            await axios.get('/departement/all').then(response => {
                this.departements = response.data.departement;

            }).catch(error => {
                Swal.fire('Erreur!', 'une erreur est survenue lors de la recuperation des Departements', 'error')
            });
        },

        async get_filiere(id) {
            await axios.get('/find/filieres/' + id).then(response => {
                this.unite_de_formations = response.data.filiere;
                this.validatedata('departement');

            }).catch(error => {
                Swal.fire('Erreur!', 'une erreur est survenue lors de la recuperation des filiere', 'error')
            });
        },
        /* get_departement() {
            axios.get('/departement/all')
                .then(response => {
                    this.departements = response.data.departement
                }).catch(error => {
                    //this.resetForm();
                    Swal.fire('Erreur!', 'Une erreur est survenue lors de la recuperation du departement', 'error')
                });
        }, */
       /*  get_unite_de_formation() {
            axios.get('/unite_de_formation/all')
                .then(response => {
                    this.unite_de_formations = response.data.unite_de_formation
                }).catch(error => {
                    //this.resetForm();
                    Swal.fire('Erreur!', 'Une erreur est survenue lors de la recuperation du filiere', 'error')
                });
        }, */

        get_classe_by_id(id) {
         
           if(this.form.id_classe){
            axios.get('/classe/show/'+id)
                .then(response => {
                    this.nom_classe_selected = response.data.classe
                }).catch(error => {
                    //this.resetForm();
                    Swal.fire('Erreur!', 'Une erreur est survenue lors de la recuperation du nom de la classe choisi', 'error')
                });
           }
        },

       /*  get_classe() {
            axios.get('/classe/all')
                .then(response => {
                    // Filtrer les classes par type d'intitulé (CS ou FPJ)
                    this.classes = response.data.classe.filter(classe => {
                        return classe.type_classe === 'CS' || classe.type_classe === 'FPJ';
                    });
                })
                .catch(error => {
                    // Gérer les erreurs
                    // this.resetForm();
                    Swal.fire('Erreur!', 'Une erreur est survenue lors de la récupération de la classe', 'error');
                });
        }, */


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
                        this.id_annee_academique_erreur = "Vous avez oublié de sélectionner  l'année académique"
                        i = 1
                        return true
                    }
                    break;

                case 'mois':
                    this.id_mois_erreur = "";
                    //pour user
                    if (this.form.id_mois === "") {
                        this.id_mois_erreur = "Vous avez oublié de sélectionner  le mois"
                        i = 1
                        return true
                    }
                    break;
                case 'departement':
                    this.id_departement_erreur = "";
                    //pour user
                    if (this.form.id_departement === "") {
                        this.id_departement_erreur = "Vous avez oublié de sélectionner  le departement"
                        i = 1
                        return true
                    }
                    break;

                case 'unite_de_formation':
                    this.id_unite_de_formation_erreur = "";
                    //pour user
                    if (this.form.id_unite_de_formation === "") {
                        this.id_unite_de_formation_erreur = "Vous avez oublié de sélectionner  la filiére"
                        i = 1
                        return true
                    }
                    break;

                case 'classe':
                    this.id_classe_erreur = "";
                    //pour user
                    if (this.form.id_classe === "") {
                        this.id_classe_erreur = "Vous avez oublié de sélectionner  la classe"
                        i = 1
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
                this.id_annee_academique_erreur = "Vous avez oublié de sélectionner l'année académique'"
                    ;
                i = 1;
            }
            if (this.form.id_mois === "") {
                this.id_mois_erreur = "Vous avez oublié de sélectionner le mois"
                    ;
                i = 1;
            }
            if (this.form.id_departement === "") {
                this.id_departement_erreur = "Vous avez oublié de sélectionner le departement''"
                    ;
                i = 1;
            }
            if (this.form.id_unite_de_formation === "") {
                this.id_unite_de_formation_erreur = "Vous avez oublié de sélectionner la filiére"
                    ;
                i = 1;
            }
            if (this.form.id_classe === "") {
                this.id_classe_erreur = "Vous avez oublié de sélectionner la classe"
                    ;
                i = 1;
            }

            if (i == 1) return true;

            return false;

        },

        closeModal() {
            this.resetForm();
            var ajout = document.querySelector('[data-modal-filtre]');
            //var confirmation = document.querySelector(selector);

            // if (this.etatForm == true) {
            var actif = document.querySelectorAll('.actif');
            actif.forEach(item => {
                item.classList.remove("actif");
            });
            ajout.close();
            //}


            ajout.classList.remove("actif");


            this.editModal === false;
        },



        resetForm() {
            /*  this.form.id_annee_academique = "";
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
             this.id_annee_academique_erreur = "";
             this.id_mois_erreur = "";
             this.id_departement_erreur = "";
             this.id_unite_de_formation_erreur = "";
             this.id_classe_erreur = ""; */

            /* this.editModal=false; */
            /*  this.closeModal(); */



        },

    }
}
</script>