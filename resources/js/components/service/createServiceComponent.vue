<template>
      <div class="cote_droit contenu">
        <form  @submit.prevent="soumettre" method="dialog">
            <h1 class="sous_titre">Ajout Service</h1>
            <!--Informations personnelles-->
            <div class="personnel">
                <div>
                    <input type="text" v-model="form.nom_service" @input="validatedata()" id="nom" placeholder="Nom du Service" spellcheck="true">
                    <span class="erreur" v-if="this.nom_service_erreur !== 0 ">{{this.nom_service_erreur}}</span>
                </div>

                <div>
                    <select name="classe" id="classe" placeholder="Niveau" v-model="form.id_user" @click="verifIdUser()">
                        <option value="">Personnel Administratif</option>
                        <option v-for="(user, index) in users" :value="user.id"> {{user.nom}} {{ user.prenom }}</option>
                    </select>
                    <span class="erreur" v-if="id_user_erreur">{{id_user_erreur}}</span>
                </div>
        </div>


        <div class="boutons">
                <input  type="submit" data-close-modal  value="Ajouter" :disabled="!validatedata() && !verifIdUser()">
                <button type="button" data-close-modal class="texte annuler" >Annuler</button>
            </div>
        </form>
    </div>
</template>

<script>
import bus from '../../eventBus';
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
            nom_service_erreur:0,
            id_user_erreur:0,
        }
    },

    mounted(){
        this.get_user();
    },

    

    methods:{
        async soumettre(){
            const formdata = new FormData();
            formdata.append('nom_service', this.form.nom_service  );
            formdata.append('id_user', this.form.id_user  );

            if(this.form.nom_service!=="" && this.form.id_user!==""){
                try{
                    const create_store=await axios.post('/service/store', formdata, {});
                    this.resetForm();
                    Swal.fire('Réussi!','Service ajouté avec succés','success')
                    bus.emit('formationAjoutee');

                }
                catch(e){
                    console.log(e.request.status)
                  if(e.request.status===404){
                    Swal.fire('Erreur!','Ce service existe déjà','error')
                  }
                  else{
                    Swal.fire('Erreur!','Une erreur est survenue lors de l\'enregistrement','error')
                  }

                }

            }else{

                Swal.fire('Erreur!','Veuillez remplir tous les champs ','error')
            }


        },

        resetForm(){
    
            this.form.nom_service="";
            this.form.id_user="";
        },

        verifCaratere(nom){
            const valeur= /^[a-zA-ZÀ-ÿ\s]*$/;
            return valeur.test(nom);
        },

    validatedata(){
        this.nom_service_erreur= "";
        
        if(this.form.nom_service=== ""){
            this.nom_service_erreur= "Ce champ est obligatoire"
            /* console.log(this.nom_service_erreur); */
            return ;
        }
        if(!this.verifCaratere(this.form.nom_service)){
            this.nom_service_erreur= "Ce champ ne peut comporter que des lettres et des espaces"
            return ;
        }
        if(this.form.nom_service.length < 12){
            this.nom_service_erreur= "Ce champ doit contenir au moins 12 Caratères"
            return ;
        }

       
    },
    verifIdUser(){
        this.id_user_erreur= "";

        if(!this.form.id_user){
            this.id_user_erreur= "Vous avez oublié de sélectionner le chef de service"
            return ;
        }
    },

        get_user(){
            axios.get('/user/getPersonnel')
            .then(response => {
                this.users=response.data.user


           }).catch(error=>{
               Swal.fire('Erreur!','Une erreur est survenue lors de la recuperation des membres administratifs','error')
           });
       },

    }
   }
</script>

<style>
</style>
