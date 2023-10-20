<template>
    <div class="cote_droit">
        <form @submit.prevent="soumettre">
            <h1 class="sous_titre">Ajout participation</h1>
           
            <div class="personnel">
            <input type="date" name="date" id="date_participation" placeholder="date_participation" v-model="form.date_participation">
        </div>

        <div class="roles">
                <select name="seminaire" id="seminaire" v-model="form.id_seminaire">
                        <option value=""> Seminaire </option>
                        <option v-for="seminaire in seminaires" :value="seminaire.id">{{ seminaire.titre }}</option>
                </select>
            </div>

            <div class="unite_de_formation">
                <select name="formateur" id="formateur" v-model="form.id_formateur">
                        <option value=""> Formateur </option>
                        <option v-for="formateur in formateurs" :value="formateur.id">{{ formateur.user.nom }} {{ formateur.user.prenom }}</option>
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
    name:"createParticiperComponent",
    data(){
        return {
            form:new Form({
                'date_participation':"",
                'id_seminaire':"",
                'id_formateur':"",
                
            }),
            seminaires:[],
         formateurs:[]
        

        }
    },
    mounted(){
        this.get_seminaire();
        this.get_formateur();
    },

    
    methods:{
        async soumettre(){
            const formdata = new FormData();
            formdata.append('date_participation', this.form.date_participation );
            formdata.append('id_seminaire', this.form.id_seminaire );
            formdata.append('id_formateur', this.form.id_formateur );

            
            if(this.form.date_participation!=="" && this.form.id_formateur!==""  && this.form.id_seminaire!==""  ){
                try{
                    const create_store=await axios.post('/participer/store', formdata, {

                    });
                    Swal.fire('Succes!','participation ajouté avec succés','succes')
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
        

         get_seminaire(){
            
             axios.get('/seminaire/index')
             .then(response => {
                 this.seminaires=response.data.seminaire
                 
                
            }).catch(error=>{
                Swal.fire('Erreur!','Une erreur est survenue lors de la recuperation du seminaire','error')
            });
        },
        
        get_formateur(){
            
            axios.get('/formateur/index')
            .then(response => {
                this.formateurs=response.data.formateur
                
               
           }).catch(error=>{
               Swal.fire('Erreur!','Une erreur est survenue lors de la recuperation du formateur','error')
           });
       },
       

        resetForm(){
            this.date_participation="";
            this.form.id_seminaire="";
            this.form.id_formateur="";
            
           
        }


    }
   }
</script>

