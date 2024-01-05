<template>
    <div >
        <div class="titres">
            <h1>Nouveau Batiment</h1>
        </div>
        <form @submit.prevent="validerAvantAjout()" action="" method="">
            <div class="informations">
                <div class="titres">
                    <h1>Nouveau Batiment</h1>
                </div>
           

                <div class="champ">
                    <label for="intitule" :class="{ 'couleur_rouge': (this.intitule_erreur) }">Batiment</label>
                    <input v-model="form.intitule" id="intitule" @input="validatedata('batiment')" type="text" name="nom"
                        :class="{ 'bordure_rouge': (this.intitule_erreur) }">
                    <span class="erreur">{{ this.intitule_erreur }}</span>
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
    </div>
</template>

<script>
import bus from '../../eventBus';
import axios from 'axios';
import Form from 'vform';

   export default {
    name:"batimentCompenent",
    data(){
        return {
            form:new Form({
                'intitule':"",
               
                
            }),
            intitule_erreur:"",
            etatForm: false,
            editModal: false,
            idBatiment: "",

        }
    },
    mounted(){
        bus.on('batimentModifier', (eventData) => {
            this.idBatiment = eventData.idBatiment;
            this.editModal = eventData.editModal;
        });
    },

    
    methods:{
        async soumettre(){
            const formdata = new FormData();
            formdata.append('intitule', this.form.intitule );
          
        

          
                try{
                    const create_store=await axios.post('/batiment/store', formdata, {

                    });
                   /*  Swal.fire('Succes!','batiment ajouté avec succés','succes') */
                    this.resetForm();
                    bus.emit('batimentAjoutee');
                }
                catch(e){
                    if (e.request.status === 404) {
                    Swal.fire('Erreur !', 'Ce batiment existe déjà', 'error')
                }
                else {
                    Swal.fire('Erreur !', 'Une erreur est survenue lors de l\'enregistrement', 'error')
                }
                }

           


        },
        validerAvantAjout() {
            const isVerifIdValid = this.validatedataOld();

            /*   console.log(isNomChampValid); */
            if (isVerifIdValid === true) {
                this.etatForm = false;
                this.editModal = false;
                console.log("erreur")
                return 0;
            } else {

                if (this.editModal === true) {
                    this.etatForm = true;
                    this.form.intitule = this.form.intitule.toUpperCase();
                    this.update_batiment(this.idBatiment);
                    this.closeModal('[data-modal-confirmation-modifier]');
                    this.editModal = false;
                }

                else {


                    this.form.intitule = this.form.intitule.toUpperCase();

                    this.soumettre();
                    this.etatForm = true;
                    this.closeModal('[data-modal-confirmation]');
                    this.editModal = false;
                    console.log("Tokkos");
                }

            }
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
        validatedata(champ) {

switch (champ) {
    case 'batiment':
        this.intitule_erreur = "";
        // Effectuez la validation pour le champ 'nom'
        if (this.form.intitule === "") {
            this.intitule_erreur = "Ce champ est obligatoire"
            //this.coloration_erreur_rouge(this.nom_service_erreur);
            return true
        }
        break;
        default:
                    break;
            }
            return false;
        },
        validatedataOld() {
            this.intitule_erreur = "";
            var i =0;
            if (this.form.intitule === "") {
                this.intitule_erreur = "Ce champ est obligatoire"

                i = 1;
            }
            if (i == 1) return true;

return false;
},

        resetForm(){
            this.form.input="";
            this.form.intitule="";
            this.form.intitule_erreur="";
            this.editModal = false;
            
           
        },
        async update_batiment(id) {
            const formdata = new FormData();
            formdata.append('intitule', this.form.intitule);
            
            //if(this.form.nom!==""){
            try {
                await axios.post('/batiment/update/' + id, formdata);
                bus.emit('batimentAjoutee');
                this.resetForm();
                this.editModal = false;
            }
            catch (e) {
                /* console.log(e.request.status) */
                if (e.request.status === 404) {
                    Swal.fire('Erreur !', 'Ce batiment existe déjà', 'error')
                }
                else {
                    Swal.fire('Erreur !', 'Une erreur est survenue lors de l\'enregistrement', 'error')
                }
            }
        }



    }
   }
</script>


