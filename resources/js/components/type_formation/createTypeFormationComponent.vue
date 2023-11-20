<template>
    <dialog data-modal-ajout class="modal" >
        <div class="cote_droit">
            <form @submit.prevent="validerAvantAjout()" method="dialog">

                <h1 class="sous_titre">Ajout Type Formation</h1>

                <div class="personnel">
                <input type="text" name="intitule" id="intitule" placeholder="intitule" v-model="form.intitule"  @input="validatedata('intitule')">
                <div>
                    <span class="erreur" v-if="this.intitule_erreur !== ''">{{this.intitule_erreur}}</span>
                </div>
        </div>

            <div class="boutons">
                        <input  type="submit" value="Ajouter" :class="{ 'data-close-modal': (this.etatForm) } "> <!-- :class="{ 'data-close-modal': !(this.etatForm) } " -->
                        <button type="button" class="texte annuler data-close-modal" @click="resetForm">Annuler</button>
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
    name:"createTypeFormationCompenent",
    data(){
        return {
            form:new Form({
                'intitule':""

            }),
            intitule_erreur:"",
            etatForm: false,


        }
    },

    methods:{
        async soumettre(){
            const formdata = new FormData();
            formdata.append('intitule', this.form.intitule );

            try{
                const create_store=await axios.post('/type_formation/store', formdata, {

                });

                // Swal.fire('Succes!','Type de formation ajouté avec succés','success')
                this.resetForm();
                bus.emit('formationAjoutee');
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
                         
                        setTimeout(function(){     
                            confirmation.close();  
    
                            setTimeout(function(){     
                                confirmation.classList.remove("actif");   
                        }, 100); 
    
                        }, 1700);  
                           


            }
            catch(e){
                console.log(e)
                Swal.fire('Erreur!','Une erreur est survenue lors de l\'enregistrement','error')
            }
        },
        changement(event){
            this.interesser= event;
        },

        verifCaratere(nom){
            const valeur= /^[a-zA-ZÀ-ÿ\s]*$/;
            return valeur.test(nom);
        },

        validatedata(champ){
            var i=0;
            this.intitule_erreur= "";
        

            switch (champ) {
            case 'intitule':
            // Effectuez la validation pour le champ 'nom'
            if(this.form.intitule=== ""){
            this.intitule_erreur= "Ce champ est obligatoire"
            i= 1;
            return true
            
            }
            if(!this.verifCaratere(this.form.intitule)){
                this.intitule_erreur= "Ce champ ne peut comporter que des lettres et des espaces"
                /* this.erreur= "Ce champ ne peut comporter que des lettres et des espaces" */
                i= 1;
                return true
            }
            
            break;

            default:
                break;
            }
        },

        validatedataOld(){
            this.intitule_erreur= "";
            var i=0;
    
    
            if(this.form.intitule=== ""){
                this.intitule_erreur= "Ce champ est obligatoire"
                
                i=1;
            }
            if(!this.verifCaratere(this.form.intitule)){
                this.intitule_erreur= "Ce champ ne peut comporter que des lettres et des espaces"
                ;
                i=1;
            }
            if(i==1) return true;       
    
    return false;
},

validerAvantAjout() {
           
            const isIdChampValid = this.validatedataOld();
            if ( isIdChampValid ) {
                this.etatForm = false;
                // console.log(erreur);
                return 0;
            }else{
                this.soumettre();
                this.etatForm = true;
                // console.log(Tokkos);
            }
        },
        resetForm(){
            this.form.input="";
            this.form.intitule="";
            this.form.intitule_erreur="";
        },

    }
   }
</script>


