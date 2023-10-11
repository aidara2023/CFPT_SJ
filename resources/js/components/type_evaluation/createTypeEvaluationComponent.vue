<template>
    <div class="cote_droit">
        <form @submit.prevent="soumettre">
            <h1 class="sous_titre">Ajout Type evaluation</h1>
           
            <div class="personnel">
            <input type="text" name="libelle" id="libelle" placeholder="libelle" v-model="form.libelle">
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
    name:"createTypeEvaluationCompenent",
    data(){
        return {
            form:new Form({
                'libelle':""
                
            }),
        

        }
    },

    
    methods:{
        async soumettre(){
            const formdata = new FormData();
            formdata.append('libelle', this.form.libelle );
          
        

            if(this.form.libelle!=="" ){
                try{
                    const create_store=await axios.post('/type_evaluation/store', formdata, {

                    });
                    Swal.fire('Succes!','type_evaluation ajouté avec succés','succes')
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
            this.form.libelle="";
            
           
        }


    }
   }
</script>


