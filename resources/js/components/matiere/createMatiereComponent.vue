<template>
    <div class="cote_droit">
        <form @submit.prevent="soumettre">
            <h1 class="sous_titre">Ajout matiére</h1>
           
            <div class="personnel">
            <input type="text" name="intitulé" id="intitulé" placeholder="Intitulé" v-model="form.intitulé">
            <input type="text" name="durée" id="durée" placeholder="Durée" v-model="form.durée">
        </div>

    
            <div class="boutons">
                <input type="submit" value="Ajouter">
                <button type="button">Annuler</button>
            </div>
        </form>
    </div>
</template>

<script>
import axios from 'axios';
import Form from 'vform';

   export default {
    name:"matiereCompenent",
    data(){
        return {
            filieres:[],
            form:new Form({
                'intitulé':"",
                'durée':"",
                
            }),
        

        }
    },

    
    methods:{
        async soumettre(){
            const formdata = new FormData();
            formdata.append('intitule', this.form.intitulé );
            formdata.append('duree', this.form.durée  );
          
            

            

            if(this.form.intitulé!=="" && this.form.durée!=="" ){
                try{
                    const create_store=await axios.post('/matiere/store', formdata, {

                    });
                    Swal.fire('Succes!','matiere ajouté avec succés','succes')
                    this.resetForm();
                }
                catch(e){
                    console.log(e)
                    Swal.fire('Erreur!','Une erreur est survenue lors de l\'enregistrement','error')
                }

            }else{
                Swal.fire('Erreur!','Veuillez remplir tous les champs obligatoires','error')
            }


        },
        

         get_role(){
            
             axios.get('/roles/index')
             .then(response => {
                 this.roles=response.data.role
                 
                
            }).catch(error=>{
                Swal.fire('Erreur!','Une erreur est survenue lors de la recuperation des roles','error')
            });
        },

       

        resetForm(){
            this.form.input="";
            this.form.durée="";
            
           
        }


    }
   }
</script>

