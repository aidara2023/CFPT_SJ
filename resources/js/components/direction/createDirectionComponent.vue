<template>
    <div class="cote_droit contenu">
        <form  @submit.prevent="soumettre" method="dialog">
          <h1 class="sous_titre">Ajout direction</h1>
          <!--Informations personnelles-->
    <div class="personnel">
              <div>
                  <input type="text" v-model="form.nom_direction" id="nom" placeholder="Nom de la direction">
              </div>
           <div class="roles">
              <select name="user" id="user" placeholder="Niveau" v-model="form.id_user">
              <option value="">Chef de direction</option>
              <option v-for="(user, index) in users" :key="index" :value="user.id"> {{user.nom}} {{ user.prenom }}</option>
              </select>
             </div>

           <div class="roles">
                 <select name="service" id="service" v-model="form.id_service">
                        <option value=""> Service </option>
                        <option v-for="(service, index) in services" :key="index" :value="service.id">{{ service.nom_service }}</option>
                </select>

            </div>
      </div>


      <div class="boutons">
                <input  type="submit" data-close-modal  value="Ajouter">
                <button type="button" data-close-modal class="texte annuler" >Annuler</button>
            </div>
      </form>
  </div>
</template>

<script>
import axios from 'axios';
import Form from 'vform';

 export default {
  name:"createDirectionCompenent",
  data(){
      return {
          users:[],
          form:new Form({
              'nom_direction':"",
              'id_service':"",
              'id_user':"",

          }),
          services:[],
      }
  },
  mounted(){
        this.get_service();
        this.get_user();
        this.rafraichissementAutomatique();


    },

  methods:{
      async soumettre(){
          const formdata = new FormData();
          formdata.append('nom_direction', this.form.nom_direction  );
          formdata.append('id_service', this.form.id_service  );
          formdata.append('id_user', this.form.id_user  );

          if(this.form.nom_direction!=="" && this.form.id_user!==""){
              try{
                  const create_store=await axios.post('/direction/store', formdata);
                  Swal.fire('Succes!','Direction ajouté avec succés','success')
                  this.resetForm();
              }
              catch(e){
                  console.log(e.request.status)
                  if(e.request.status===404){
                    Swal.fire('Erreur!','Cette direction existe déjà','error')
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
        var ajout = document.querySelector("[data-modal-ajout]");
            var fermemod = document.querySelectorAll('[data-close-modal]');
            //Fermeture des modals
            fermemod.forEach(item => {
                item.addEventListener('click', () => {
                var actif = document.querySelectorAll('.actif');
                    actif.forEach(item => {
                        item.classList.remove("actif");
                    });
                        ajout.close();
                        modification.close();
                        suppression.close();

            })
       /*    ajout.remove("active");  */

            });
          this.form.nom_direction="";
          this.form.id_user="";
          this.form.nom_service="";
      },

      get_user(){
          axios.get('/user/getPersonnel')
          .then(response => {
              this.users=response.data.user


         }).catch(error=>{
             Swal.fire('Erreur!','Une erreur est survenue lors de la recuperation des roles','error')
         });
     },
     get_service(){

            axios.get('/service/index')
            .then(response => {
                this.services=response.data.service


           }).catch(error=>{
               Swal.fire('Erreur!','Une erreur est survenue lors de la recupération des services','error')
           });
       },
       rafraichissementAutomatique() {
            document.addEventListener("DOMContentLoaded", this.resetForm());
    },


  }
 }
</script>

<style>
</style>
