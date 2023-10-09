<template>
    <div class="cote_droit">
        <form @submit.prevent="soumettre">
            <h1 class="sous_titre">Ajout d'edition</h1>
            <div></div>

            <div class="personnel">
            <input type="text" name="nom" id="nom" placeholder="Nom edition" v-model="form.nom">
            
        </div>

            <div class="editeurs">
                <select name="editeur" id="editeur" v-model="form.id_editeur">
                        <option value=""> Editeur</option>
                        <option v-for="editeur in editeurs" :value="editeur.id">{{ editeur.nom_editeur }}</option>
                </select>
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
    name:"createEditionCompenent",
    data(){
        return {
            filieres:[],
            form:new Form({
                'nom':"",
                'id_editeur':""
            }),
            photo:"",
            editeurs:[],

        }
    },

    mounted(){
        this.get_editeur();

    },
    
    methods:{
        async soumettre(){
            const formdata = new FormData();
            formdata.append('nom_edition', this.form.nom  );
            formdata.append('id_editeur', this.form.id_editeur);
           

            

            

            if(this.form.nom!==""){
                try{
                    const create_store=await axios.post('/edition/store', formdata, {

                    });
                    Swal.fire('Succes!','edition ajouté avec succés','succes')
                    this.resetForm();
                }
                catch(e){
                    console.log(e)
                    Swal.fire('Erreur!','Une erreur est survenue lors de l\'enregistrement','error')
                }

            }else{
                Swal.fire('Erreur!','Veillez remplir tous les champs obligatoires','error')
            }


        },
        

         get_editeur(){
            
             axios.get('/editeur/index')
             .then(response => {
                 this.editeurs=response.data.editeur
                 
                
            }).catch(error=>{
                Swal.fire('Erreur!','Une erreur est survenue lors de la recuperation des editions','error')
            });
        },

        resetForm(){
            this.form.nom="";
            this.form.id_editeur="";
           
        }


    }
   }
</script>

