<template>
    <div>
        <div class="titres">
            <h1 class="sous_titre">Nouveau Type Formation</h1>
        </div>

        <form @submit.prevent="validerAvantAjout()" method="">
            <div class="informations">
                <div class="titres">
                    <h1 class="sous_titre">Nouveau Type Formation</h1>
                </div>
                <div class="champ">
                    <label for="nom" :class="{ 'couleur_rouge': (this.nom_formation_erreur) }">Nom Service</label>
                    <input type="text" :class="{ 'bordure_rouge': (this.nom_formation_erreur) }" v-model="form.intitule" id="nom" placeholder="Intitule"
                        @input="validatedata('intitule')">
                    <span class="erreur" v-if="this.nom_formation_erreur !== ''">{{ this.nom_formation_erreur }}</span>
                </div>

                <div class="groupe_champs validation">
                    <button type="button" data-close-modal="1" class="annuler"><span data-statut="visible"
                            @click="resetForm">Annuler</span></button>
                    <button v-if="this.editModal === false" type="submit" data-close-modal="0" class="suivant"><span
                            data-statut="visible">Ajouter</span></button>
                    <button v-if="this.editModal === true" type="submit" data-close-modal="0" class="suivant"><span
                            data-statut="visible">Modifier</span></button>
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
    name: "createTypeFormationCompenent",
    data() {
        return {
            form: new Form({
                'intitule': ""
            }),
            nom_formation_erreur: "",
            editModal: false,
            idTypeformation: "",



        }
    },
    mounted() {
        bus.on('formationModifier', (eventData) => {
            this.idTypeformation = eventData.idTypeformation;
            this.editModal = eventData.editModal;
            this.form.intitule = eventData.nom;

        });
    },

    methods: {
        async soumettre() {
            const formdata = new FormData();
            formdata.append('intitule', this.form.intitule);

            try {
                const create_store = await axios.post('/type_formation/store', formdata, {});
                this.resetForm();
                bus.emit('formationAjoutee');

            }
            catch (e) {
                /* console.log(e.request.status) */
                if (e.request.status === 404) {
                    Swal.fire('Erreur !', 'Ce type de formation existe déjà', 'error')
                }
                else {
                    Swal.fire('Erreur !', 'Une erreur est survenue lors de l\'enregistrement', 'error')
                }

            }
        },
        validerAvantAjout() {
            const isVerifIdValid = this.validatedata();
            /*   console.log(isNomChampValid); */
            if (isVerifIdValid === true) {
                this.etatForm = false;
                this.editModal = false;
                return 0;
            } else {

                if (this.editModal === true) {
                    this.etatForm = true;
                    this.form.intitule = this.form.intitule.toUpperCase();
                    this.update_formation(this.idTypeformation);
                    this.closeModal('[data-modal-confirmation-modifier]');
                    this.editModal = false;
                }

                else {
                    this.form.intitule = this.form.intitule.toUpperCase();
                    this.soumettre();
                    this.etatForm = true;
                    this.closeModal('[data-modal-confirmation]');
                    this.editModal = false;
                    // console.log(Tokkos);
                }

            }
        },

        verifCaratere(nom) {
            const valeur = /^[a-zA-ZÀ-ÿ\s]*$/;
            return valeur.test(nom);
        },
        validatedata() {
            this.nom_formation_erreur = "";

            if (this.form.intitule === "") {
                this.nom_formation_erreur = "Ce champ est obligatoire"
                return true;
            }
            if (!this.verifCaratere(this.form.intitule)) {
                this.nom_formation_erreur = "Ce champ ne peut comporter que des lettres et des espaces"
                return true;
            }
            /* if(this.form.intitule.length <10 ){
                this.nom_formation_erreur= "Ce champ doit contenir au moins 10 Caratères"
                return true;
            } */
            return false;

        },

        changement(event) {
            this.interesser = event;
        },

        resetForm() {
            this.form.input = "";
            this.form.intitule = "";
            this.editModal === false;
            this.nom_formation_erreur = "";
        },
        closeModal(selector) {
            var ajout = document.querySelector('[data-modal-ajout]');
            var confirmation = document.querySelector(selector);

            /* console.log(ajout); */
            var actif = document.querySelectorAll('.actif');
            actif.forEach(item => {
                item.classList.remove("actif");
            });
            //ajout.classList.remove("actif");
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

        async update_formation(id) {
            const formdata = new FormData();
            formdata.append('intitule', this.form.intitule);
            //if(this.form.nom!==""){
            try {
                await axios.post('/type_formation/update/' + id, formdata);
                bus.emit('formationAjoutee');
                this.resetForm();
                this.editModal = false;
            }
            catch (e) {
                console.log(e)
                /* if(e.request.status===404){
                    Swal.fire('Erreur !','Cette type de formation existe déjà','error')
                }
                else{
                    Swal.fire('Erreur !','Une erreur est survenue lors de l\'enregistrement','error')
                } */
            }
        }


    }
}
</script>


