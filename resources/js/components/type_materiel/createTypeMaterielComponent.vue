<template>
    <div class="cote_droit">
        <form @submit.prevent="soumettre">
            <h1 class="sous_titre">Ajout Type materiel</h1>
           
            <div class="personnel">
            <input type="text" name="intitulé" id="intitulé" placeholder="Intitulé" v-model="form.intitulé">
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
    name:"type_materielCompenent",
    data(){
        return {
            form:new Form({
                'intitulé':""
                
            }),
        

        }
    },

    
    methods:{
        async soumettre(){
            const formdata = new FormData();
            formdata.append('intitule', this.form.intitulé );
          
        

            if(this.form.intitulé!=="" ){
                try{
                    const create_store=await axios.post('/type_materiel/store', formdata, {

                    });
                    Swal.fire('Succes!','type_materiel ajouté avec succés','succes')
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
            this.form.intitulé="";
            
           
        }


    }
   }
</script>


