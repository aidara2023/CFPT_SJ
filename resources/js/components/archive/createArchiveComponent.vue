<template>
    <div class="cote_droit">
        <form @submit.prevent="soumettre">
            <h1 class="sous_titre">Ajout de archive</h1>
            
            <div class="personnel">
            <input type="text" name="titre" id="titre" placeholder="Titre" v-model="form.titre">
            <input type="text" name="type" id="type" placeholder="Type" v-model="form.type">
            <input type="text" name="statut" id="statut" placeholder="statut" v-model="form.statut">
            <input type="date" name="date_destruction" id="date_destruction" placeholder="Date de destruction" v-model="form.date_destruction">       
            <input type="text" name="contenu" id="contenu" placeholder="Contenu" v-model="form.contenu">
        </div>

            <div class="departements">
                <select name="departement" id="departement" v-model="form.id_departement">
                        <option value=""> Departement</option>
                        <option v-for="departement in departements" :key="departement.id">{{ departement.intitule }}</option>
                </select>
            </div>

            <div class="services">
                <select name="service" id="service" v-model="form.id_service">
                        <option value=""> Service</option>
                        <option v-for="service in services" :key="service.id">{{ service.nom_service }}</option>
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
    name:"createArchiveCompenent",
    data(){
        return {
            filieres:[],
            form:new Form({
                'titre':"",
                'type':"",
                'statut':"",
                'date_destruction':"",
                'contenu':"",
                'id_departement':"",
                'id_service':""
            }),
            photo:"",
            departements:[],
            services:[],

        }
    },

    mounted(){
        this.get_departement();
        this.get_service();

    },
    
    methods:{
        async soumettre(){
            const formdata = new FormData();
            formdata.append('titre', this.form.titre  );
            formdata.append('type', this.form.type  );
            formdata.append('statut', this.form.statut);
            formdata.append('date_destruction', this.form.date_destruction);
            formdata.append('id_departement', this.form.id_departement);
            formdata.append('id_service', this.form.id_service);
           
            if(this.form.titre!=="" && this.form.type!=="" && this.form.statut!=="" && this.form.date_destruction!=="" && this.form.contenu!==""){
                try{
                    const create_store=await axios.post('/archive/store', formdata, {

                    });
                    Swal.fire('Succes!','archive ajouté avec succés','succes')
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
        

         get_departement(){
            
             axios.get('/departement/index')
             .then(response => {
                 this.departements=response.data.departement
                 
                
            }).catch(error=>{
                Swal.fire('Erreur!','Une erreur est survenue lors de la recuperation des departements','error')
            });
        },

        get_service(){
            
            axios.get('/service/index')
            .then(response => {
                this.services=response.data.service
                
               
           }).catch(error=>{
               Swal.fire('Erreur!','Une erreur est survenue lors de la recuperation des services','error')
           });
       },
        resetForm(){
            this.form.titre="";
            this.form.type="";
            this.form.statut="";
            this.form.contenu="";
            this.form.date_destruction="";
            this.form.id_departement="";
            this.form.id_service="";
           
        }

    }
   }
</script>

