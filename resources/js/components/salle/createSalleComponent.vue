<template>
    <dialog data-modal-ajout class="modal">
        <div class="titres">
            <h1>Nouvelle Salle</h1>
        </div>

        <form @submit.prevent="validerAvantAjout()" action="" method="dialog">

            <div class="informations">
                <div class="titres">
                    <h1>Nouvelle Salle</h1>
                </div>

                <div class="champ">
                    <label for="nom" :class="{ 'couleur_rouge': (this.nom_salle_erreur) }">Intitule</label>
                    <input type="text" name="nom" id="nom" v-model="form.intitule" @input="validatedata('intitule')"
                        :class="{ 'bordure_rouge': (this.nom_salle_erreur) }">
                    <span class="erreur">{{ this.nom_salle_erreur }}</span>
                </div>

                <div class="champ">
                    <label for="nom" :class="{ 'couleur_rouge': (this.nombre_place_erreur) }">Nombre de place</label>
                    <input type="text" v-model="form.nombre_place" id="nom_place" @input="validatedata('nombre_place')"
                        :class="{ 'bordure_rouge': (this.nombre_place_erreur) }">
                    <span class="erreur">{{ this.nombre_place_erreur }}</span>
                </div>


                <div class="champ">

                    <label for="nom" :class="{ 'couleur_rouge': (this.id_batiment_erreur) }">Batiment</label>
                    <select v-model="form.id_batiment" @change="validatedata('id_batiment')"
                        :class="{ 'bordure_rouge': (this.id_batiment_erreur) }">
                        <option v-for="batiment in batiments" :value="batiment.id">{{ batiment.intitule }} </option>
                    </select>
                    <span class="erreur" v-if="id_batiment_erreur !== ''">{{ id_batiment_erreur }}</span>
                </div>


                <div class="groupe_champs validation">
                    <!-- Mettre la valeur 1 dans le data-close-modal pour qu'il soit actif -->
                    <button type="button" data-close-modal="1" class="annuler"><span data-statut="visible"
                            @click="resetForm">Annuler</span></button>
                    <button v-if="this.editModal === false" type="submit" data-close-modal="0" class="suivant"><span
                            data-statut="visible">Ajouter</span></button>
                    <button v-if="this.editModal === true" type="submit" data-close-modal="0" class="suivant"><span
                            data-statut="visible">Modifier</span></button>

                </div>
            </div>

        </form>
    </dialog>
</template>
    
<script>
import bus from '../../eventBus';
import axios from 'axios';
import Form from 'vform';
import Swal from 'sweetalert2';

export default {
    name: "createSalleCompenent",
    data() {
        return {
            users: [],
            batiments: [],
            form: new Form({
                'intitule': "",
                'nombre_place': "",
                'id_batiment': "",
            }),
            nom_salle_erreur: "",
            nombre_place_erreur: "",
            id_batiment_erreur: "",
            etatForm: false,
            editModal: false,
            idSalle: "",
        }
    },

    mounted() {
        this.get_batiment();
        bus.on('salleModifier', (eventData) => {
            this.idSalle = eventData.idSalle;
            this.editModal = eventData.editModal;
            this.form.intitule = eventData.nom;
            this.form.nombre_place = eventData.nombre_place;
            this.form.id_batiment = eventData.id_batiment;
        });
    },



    methods: {
        async soumettre() {
            const formdata = new FormData();
            formdata.append('intitule', this.form.intitule);
            formdata.append('nombre_place', this.form.nombre_place);
            formdata.append('id_batiment', this.form.id_batiment);
            try {
                await axios.post('/salle/store', formdata, {});
                this.resetForm();
                bus.emit('salleAjoutee');
            }
            catch (e) {
                /* console.log(e.request.status) */
                if (e.request.status === 404) {
                    Swal.fire('Erreur !', 'Ce salle existe déjà', 'error')
                }
                else {
                    Swal.fire('Erreur !', 'Une erreur est survenue lors de l\'enregistrement', 'error')
                }

            }

        },

        validerAvantAjout() {
            // Exécutez la validation des champs
            const isNomSalleValid = this.validatedataold();

            //console.log(isNomSalleValid);

            if (isNomSalleValid === true) {
                this.etatForm = false;
                this.editModal = false;
                return 0;
            } else {

                if (this.editModal === true) {
                    this.etatForm = true;
                    this.form.intitule = this.form.intitule.toUpperCase();
                    this.update_salle(this.idSalle);
                    this.closeModal('[data-modal-confirmation-modifier]');
                    this.editModal = false;
                }

                else {
                    this.form.intitule = this.form.intitule.toUpperCase();
                    this.soumettre();
                    this.etatForm = true;
                    this.closeModal('[data-modal-confirmation]');
                    this.editModal = false;

                }
            }
        },

        resetForm() {
            this.form.intitule = "";
            this.form.nombre_place = "";
            this.form.id_batiment = "";
            this.nom_salle_erreur = "";
            this.nombre_place_erreur = "";
            this.id_batiment_erreur = "";
            this.editModal === false;
        },

        verifCaratere(nom) {
            const valeur = /^[a-zA-ZÀ-ÿ\s]*$/;
            return valeur.test(nom);
        },

        validatedataold() {
            this.nom_salle_erreur = "";
            this.nombre_place_erreur = "";
            this.id_batiment_erreur = "";
            var i = 0;
            if (this.form.id_batiment === "") {
                this.id_batiment_erreur = "Vous avez oublié de sélectionner le batiment"
                i = 1;
            }


            if (this.form.intitule === "") {
                this.nom_salle_erreur = "Ce champ est obligatoire"
                i = 1;

            }
            if (!this.verifCaratere(this.form.intitule)) {
                this.nom_salle_erreur = "Ce champ ne peut comporter que des lettres et des espaces"
                i = 1;

            }
            if (this.form.intitule.length < 12) {
                this.nom_salle_erreur = "Ce champ doit contenir au moins 12 Caratères"
                i = 1;

            }
            if (this.form.id_batiment === "") {
                this.id_batiment_erreur = "Vous avez oublié de sélectionner le batiment"
                    ;
                i = 1;
            }
            if (this.form.nombre_place === "") {
                this.nombre_place_erreur = "Vous avez oublié de sélectionner le nombre de place"
                    ;
                i = 1;
            }

            if (i === 1)
                return true;
            return false;

        },
        validatedata(champ) {
            // Réinitialiser les erreurs pour le champ actuel

            switch (champ) {
                case 'intitule':
                    // Effectuez la validation pour le champ 'nom'
                    this.nom_salle_erreur = "";

                    if (this.form.intitule === "") {
                        this.nom_salle_erreur = "Ce champ est obligatoire"
                        return true

                    }
                    if (!this.verifCaratere(this.form.intitule)) {
                        this.nom_salle_erreur = "Ce champ ne peut comporter que des lettres et des espaces"

                        return true
                    }
                    // Ajoutez d'autres validations si nécessaire
                    break;
                case 'nombre_place':
                    //pour prenom
                    this.nombre_place_erreur = "";

                    if (this.form.nombre_place === "") {
                        this.nombre_place_erreur = "Ce champ est obligatoire"
                        return true
                    }
                    if (!/^\d+$/.test(this.form.nombre_place)) {
                        this.nombre_place_erreur = "Ce champ ne peut contenir que des chiffres";

                        return true
                    }
                    break;
                case 'id_batiment':
                    //pour prenom
                    this.id_batiment_erreur = "";

                    if (this.form.id_batiment === "") {
                        this.id_batiment_erreur = "Vous avez oublié de sélectionner la salle"
                        return true;
                    }
                    break;
                default:
                    break;
            }
        },

        get_batiment() {
            axios.get('/batiment/index')
                .then(response => {
                    this.batiments = response.data.batiment
                }).catch(error => {
                    Swal.fire('Erreur!', 'Une erreur est survenue lors de la recuperation des membres administratifs', 'error')
                });
        },
        closeModal(selector) {
            var ajout = document.querySelector('[data-modal-ajout]');
            var confirmation = document.querySelector(selector);

            /* console.log(ajout); */
            if (this.etatForm == true) {
                var actif = document.querySelectorAll('.actif');
                actif.forEach(item => {
                    item.classList.remove("actif");
                });
                //ajout.classList.remove("actif");
                ajout.close();
            }
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


        async update_salle(id) {
            const formdata = new FormData();
            formdata.append('intitule', this.form.intitule);
            formdata.append('nombre_place', this.form.nombre_place);
            formdata.append('id_batiment', this.form.id_batiment);

            //if(this.form.nom!==""){
            try {
                await axios.post('/salle/update/' + id, formdata);
                bus.emit('salleAjoutee');
                this.resetForm();
                this.editModal = false;
            }
            catch (e) {
                console.log(e)
                /*      if(e.request.status===404){
                         Swal.fire('Erreur !','Ce salle existe déjà','error')
                     }
                     else{
                         Swal.fire('Erreur !','Une erreur est survenue lors de l\'enregistrement','error')
                     } */
            }
        }

    }
}
</script>