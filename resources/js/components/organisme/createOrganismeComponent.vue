<template>
    <div class="cote_droit">
        <form @submit.prevent="soumettre">
            <h1 class="sous_titre">Ajout Type Organisme</h1>
           
            <div class="personnel">
            <input type="text" name="organisme" id="organisme" placeholder="organisme" v-model="form.nom_organisme">
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
    name:"type_evaluationCompenent",
    data(){
        return {
            form:new Form({
                'nom_organisme':""
                
            }),
        

        }
    },

    
    methods:{
        async soumettre(){
            const formdata = new FormData();
            formdata.append('nom_organisme', this.form.nom_organisme );
          
        

            if(this.form.nom_organisme!=="" ){
                try{
                    const create_store=await axios.post('/organisme/store', formdata, {

                    });
                    Swal.fire('Succes!','organisme ajouté avec succés','succes')
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
        


        resetForm(){
            this.form.input="";
            this.form.nom_organisme="";
            
           
        }


    }
   }
</script>


