<template>
    <dialog data-modal-ajout class="modal">
        <div class="cote_droit contenu">
            <form @submit.prevent="validerAvantAjout()" method="">
                <h1 class="sous_titre">Ajout Personnel Administratif</h1>
                <!--Informations personnelles-->
                <div class="personnel">
                    <div>
                        <input type="text" v-model="form.intitule" id="nom" placeholder="Personnel administratif"
                            @input="validatedata('intitule')">
                        <span class="erreur" v-if="this.intitule_erreur !== ''">{{ this.intitule_erreur }}</span>
                    </div>


                </div>


                <div class="boutons">
                    <input type="submit" value="Ajouter" :class="{ 'data-close-modal': (this.etatForm) }">
                    <!-- :class="{ 'data-close-modal': !(this.etatForm) } " -->
                    <button type="button" class="texte annuler data-close-modal">Annuler</button>
                </div>
            </form>
        </div>
    </dialog>
</template>

<script>
import bus from '../../eventBus';
import axios from 'axios';
import Form from 'vform';

export default {
    name: "createPersonnelAdministratifCompenent",
    data() {
        return {
            users: [],
            form: new Form({
                'intitule': "",


            }),

            intitule_erreur: "",
            etatForm: false,
        }
    },


    methods: {
        async soumettre() {
            const formdata = new FormData();
            formdata.append('intitule', this.form.intitule);

            try {
                const create_store = await axios.post('/personnel_administratif/store', formdata);

                this.resetForm();
                bus.emit('personnelAdministratifAjoutee');

                var ajout = document.querySelector('[data-modal-ajout]');
                var confirmation = document.querySelector('[data-modal-confirmation]');


                /* console.log(ajout); */
                var actif = document.querySelectorAll('.actif');
                actif.forEach(item => {
                    item.classList.remove("actif");
                });
                //ajout.classList.remove("actif");
                ajout.close();


                confirmation.style.backgroundColor = 'white';
                confirmation.style.color = 'var(--clr)';



                //setTimeout(function(){
                confirmation.showModal();
                confirmation.classList.add("actif");
                //confirmation.close();  
                //}, 1000);  

                setTimeout(function () {
                    confirmation.close();

                    setTimeout(function () {
                        confirmation.classList.remove("actif");
                    }, 100);

                }, 1700);



            }
            catch (e) {
                /* console.log(e.request.status) */
                if (e.request.status === 404) {
                    Swal.fire('Erreur !', 'Ce personnel existe déjà', 'error')
                }
                else {
                    Swal.fire('Erreur !', 'Une erreur est survenue lors de l\'enregistrement', 'error')
                }
            }
        },

        verifCaratere(nom) {
            const valeur = /^[a-zA-ZÀ-ÿ\s]*$/;
            return valeur.test(nom);
        },


        validatedata(champ) {
            this.intitule_erreur = "";

            var i = 0;

            switch (champ) {
                case 'intitule':
                    // Effectuez la validation pour le champ 'nom'
                    if (this.form.intitule === "") {
                        this.intitule_erreur = "Ce champ est obligatoire"
                        i = 1;
                        return true

                    }
                    if (!this.verifCaratere(this.form.intitule)) {
                        this.intitule_erreur = "Ce champ ne peut comporter que des lettres et des espaces"
                        /* this.erreur= "Ce champ ne peut comporter  que des lettres et des espaces" */
                        i = 1;
                        return true
                    }

                    break;


                default:
                    break;
            }
        },


        validatedataOld() {
            this.intitule = "";

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
            // Exécutez la validation des champs
            /*  const isNomChampValid = this.validatedata(); */
            const isIdChampValid = this.validatedataOld();

            /*   console.log(isNomChampValid); */
            if (isIdChampValid) {
                this.etatForm = false;
                return 0;
            } else {
                this.form.intitule = this.form.intitule.toUpperCase();
                this.soumettre();
                this.etatForm = true;
            }

        },

        resetForm() {

            this.form.intitule = "";


        },



    }
}
</script>

<style></style>
