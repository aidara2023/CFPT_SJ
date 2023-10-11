<template>
      <div class="cote_droit">
        <form action="" method="">
            <h1 class="sous_titre">Informations Personnelles</h1>
            <!--Informations personnelles-->
            <div class="personnel">
                <div>
                    <input type="text" v-model="form.nom_service" id="nom" placeholder="Nom du Service">
                </div>
            
            <select name="classe" id="classe" placeholder="Niveau" v-model="form.id_user">
                <option value="">Personnel Administratif</option>
                <option v-for="(user, index) in users" :value="user.id"> {{user.nom}} {{ user.prenom }}</option>
            </select>
        </div>
        
    
            <div class="boutons">
               <!--  <button type="button">Retourner</button> -->
                <input type="submit" value="Enregister" @click.prevent="soumettre"> 
            </div>
        </form>
    </div>
</template>

<script>
import axios from 'axios';
import Form from 'vform';

   export default {
    name:"createServiceCompenent",
    data(){
        return {
            users:[],
            form:new Form({
                'nom_service':"",
                'id_user':"",
               
            }),
        }
    },
    
    methods:{
        async soumettre(){
            const formdata = new FormData();
            formdata.append('nom_service', this.form.nom_service  );
            formdata.append('id_user', this.form.id_user  );
        
            if(this.form.nom_service!=="" && this.form.id_user!==""){
                try{
                    const create_store=await axios.post('/service/store', formdata, {});
                    Swal.fire('Succes!','Service ajouté avec succés','succes')
                    this.resetForm();
                }
                catch(e){
                    console.log(e)
                    Swal.fire('Erreur!','Une erreur est survenue lors de l\'enregistrement','error')
                }

            }else{
                Swal.fire('Erreur!','Veuillez remplir tous les champs ','error')
            }


        },

        resetForm(){
            this.form.nom_service="";
            this.form.id_user="";
        },

        get_user(){
            axios.get('/user/getPersonnel')
            .then(response => {
                this.users=response.data.user
                
               
           }).catch(error=>{
               Swal.fire('Erreur!','Une erreur est survenue lors de la recuperation des roles','error')
           });
       },


    }
   }
</script>

<style>
</style>