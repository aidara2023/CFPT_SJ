<template>
    <div class="cote_droit">
        <form @submit.prevent="soumettre">
            <h1 class="sous_titre">Ajout Dossier medical</h1>
           
            <div class="personnel">
            <input type="text" name="user" id="user" placeholder="user" v-model="form.nom_user">
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
    name:"dossier_medicalCompenent",
    data(){
        return {
            form:new Form({
                'nom_user':""
                
            }),
        

        }
    },

    
    methods:{
        async soumettre(){
            const formdata = new FormData();
            formdata.append('id_user', this.form.id_user );
          
        

            if(this.form.id_user!=="" ){
                try{
                    const create_store=await axios.post('/dossier_medical/store', formdata, {

                    });
                    Swal.fire('Succes!','dossier_medical ajouté avec succés','succes')
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
            this.form.id_user="";
            
           
        }


    }
   }
</script>


