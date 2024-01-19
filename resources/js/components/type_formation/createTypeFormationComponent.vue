<template>
   <div class="col-lg-6 p-t-20">
        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
            <label class="mdl-textfield__label" for="txtFirstName" v-show="!form.intitule">Nom Type de formation</label>
            <input class="mdl-textfield__input" type="text" id="txtFirstName" v-model="form.intitule"
                @input="validatedata('intitule')">
            <span class="erreur">{{ this.nom_formation_erreur }}</span>
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
    props: ['type_formation'],
    name: "createTypeFormationCompenent",
    components: {
    flatPickr,
  },
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
            this.editModal = eventData.editModal;
            this.monterToupdate(eventData.formation);
        });
    },

    methods: {
        async soumettre() {
            const formdata = new FormData();
            formdata.append('intitule', this.form.intitule);

            try {
                const create_store = await axios.post('/type_formation/store', formdata, {});
                bus.emit('formationAjoutee');
                showDialog6("Type de formation ajouté avec succès");
                this.resetForm();
                window.location.href = '/type_formation/index';

            }
            catch (e) {
                /* console.log(e.request.status) */
                if (e.request.status === 404) {
                    showDialog3("Ce type de formation existe déjà");
                }
                else {
                    showDialog3("Une erreur est survenue lors de l\'enregistrement");
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
                   
                    this.editModal = false;
                }

                else {
                    this.form.intitule = this.form.intitule.toUpperCase();
                    this.soumettre();
                    this.etatForm = true;
                   
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
        

        async update_formation(id) {
            const formdata = new FormData();
            formdata.append('intitule', this.form.intitule);
            //if(this.form.nom!==""){
            try {
                await axios.post('/type_formation/update/' + id, formdata);
                bus.emit('formationAjoutee');
                showDialog6("Type de Formation modifié avec succès");
                const eventData = {
                editModal: false,
            };
            bus.emit('formationDejaModifier', eventData);
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

        monterToupdate(formation) {
            console.log("MonterToupdate called");
         
            this.idTypeformation = formation.id;
            this.editModal = formation.editModal;
            this.form.intitule = formation.formation;
           
           
            
        },


    }
}
</script>


