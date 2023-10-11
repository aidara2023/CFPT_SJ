<template>
    <div class="cote_droit">
        <form @submit.prevent="soumettre">
            <h1 class="sous_titre">Ajout Type Formation</h1>
           
            <div class="personnel">
            <input type="text" name="intitule" id="intitule" placeholder="intitule" v-model="form.intitule">
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
          
        

            if(this.form.intitule!=="" ){
                try{
                    const create_store=await axios.post('/type_formation/store', formdata, {

                    });
                    Swal.fire('Succes!','type_formation ajouté avec succés','succes')
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
            this.form.intitule="";
            
           
        }


    }
   }
</script>


