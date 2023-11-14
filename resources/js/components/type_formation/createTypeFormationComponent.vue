<template>
    <div class="cote_droit">
        <form @submit.prevent="soumettre()" method="dialog">

            <h1 class="sous_titre">Ajout Type Formation</h1>

            <div class="personnel">
            <input type="text" name="intitule" id="intitule" placeholder="intitule" v-model="form.intitule">
        </div>

        <div class="boutons">
                <input  type="submit" data-close-modal  value="Ajouter">
                <button type="button" data-close-modal class="texte annuler" >Annuler</button>
            </div>
        </form>
    </div>
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

        resetForm(){
            this.form.input="";
            this.form.intitule="";
        },

    }
   }
</script>


