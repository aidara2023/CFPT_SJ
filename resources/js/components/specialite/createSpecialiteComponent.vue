<template>
    <div class="cote_droit">
        <form @submit.prevent="soumettre">
            <h1 class="sous_titre">Ajout de Specialite</h1>
           
            <div class="personnel">
            <input type="text" name="nom" id="nom" placeholder="     Intitule" v-model="form.nom">
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
    name:"createSpecialiteCompenent",
    data(){
        return {
            filieres:[],
            form:new Form({
                'nom':"",
               
            }),
        }
    },
    
    methods:{
        async soumettre(){
            const formdata = new FormData();
            formdata.append('intitule', this.form.nom  );
        
            if(this.form.nom!==""){
                try{
                    const create_store=await axios.post('/specialite/store', formdata, {

                    });
                    Swal.fire('Succes!','Specialite ajouté avec succés','succes')
                    this.resetForm();
                }
                catch(e){
                    console.log(e)
                    Swal.fire('Erreur!','Une erreur est survenue lors de l\'enregistrement','error')
                }

            }else{
                Swal.fire('Erreur!','Veillez remplir tous les champs ','error')
            }


        },

        resetForm(){
            this.form.nom="";
        }


    }
   }
</script>

