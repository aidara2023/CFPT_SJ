<template>
    <div class="cote_droit">
        <form @submit.prevent="soumettre">
            <h1 class="sous_titre">Ajout de caissier</h1>
            <div>

            </div>
            <div class="personnel">
            <input type="text" name="nom" id="nom" placeholder="Nom Unite de formation" v-model="form.nom">
        </div>

            <div class="formateurs">
                <select name="formateur" id="formateur" v-model="form.id_formateur">
                        <option value=""> Formateur</option>
                        <option v-for="formateur in formateurs" :value="formateur.id">{{ formateur.type }}</option>
                </select>
            </div>

            <div class="departements">
                <select name="departement" id="departement" v-model="form.id_departement">
                        <option value=""> departement</option>
                        <option v-for="departement in departements" :value="departement.id">{{ departement.intitule }}</option>
                </select>
            </div>

            

             <!-- <div class="identifiants">
                <input type="text" name="matricule" id="matricule" placeholder="Matricule" v-model="form.contact_urgence_2">
                <input type="password" name="mot_de_passe" id="mot_de_passe" placeholder="Mot de passe" v-model="form.contact_urgence_2">
            </div> --> 

            
            
            <!--paiement-->
    
    
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
    name:"createUniteDeFormationCompenent",
    data(){
        return {
            filieres:[],
            form:new Form({
                'nom':"",
                'id_formateur':"",
                'id_departement':""
            }),
            photo:"",
            formateurs:[],
            departements:[],

        }
    },

    mounted(){
        this.get_formateur();
        this.get_departement();

    },
    
    methods:{
        async soumettre(){
            const formdata = new FormData();
            formdata.append('nom_caissier', this.form.nom  );
            formdata.append('id_formateur', this.form.id_formateur);
            formdata.append('id_departement', this.form.id_departement);
        

            if(this.form.nom!=="" ){
                try{
                    const create_store=await axios.post('/unite_de_formation/store', formdata, {

                    });
                    Swal.fire('Succes!','unite de formation ajoutée avec succées','succes')
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
        

         get_formateur(){
            
             axios.get('/formateurs/index')
             .then(response => {
                 this.formateurs=response.data.formateur
                 
                
            }).catch(error=>{
                Swal.fire('Erreur!','Une erreur est survenue lors de la recuperation des formateurs','error')
            });
        },

        get_departement(){
            
            axios.get('/departement/index')
            .then(response => {
                this.departements=response.data.departement
                
               
           }).catch(error=>{
               Swal.fire('Erreur!','Une erreur est survenue lors de la recuperation des departements','error')
           });
       },

        
        resetForm(){
            this.form.nom="";
            this.form.id_formateur="";
            this.form.id_departement="";
           
        }


    }
   }
</script>

