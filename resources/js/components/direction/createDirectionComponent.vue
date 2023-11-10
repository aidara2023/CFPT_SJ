<template>
    <div class="cote_droit contenu">
        <form  @submit.prevent="validerAvantAjout()" method="">
          <h1 class="sous_titre">Ajout direction</h1>
          <!--Informations personnelles-->
    <div class="personnel">
              <div>
                  <input type="text" v-model="form.nom_direction" id="nom" placeholder="Nom de la direction" @input="validatedata()"> 
                  <span class="erreur" v-if="this.nom_direction_erreur !== ''">{{this.nom_direction_erreur}}</span>
              </div>
           <div class="roles">
              <select name="user" id="user" placeholder="Niveau" v-model="form.id_user" @change="verifId()" >
              <option value="">Chef de direction</option>
              <option v-for="(user, index) in users" :key="index" :value="user.id"> {{user.nom}} {{ user.prenom }}</option>
              </select>
              <span class="erreur" v-if="id_user_erreur !== ''">{{id_user_erreur}}</span>
             </div>

           <div class="roles">
                 <select name="service" id="service" v-model="form.id_service"  @change="verifId()">
                        <option value=""> Service </option>
                        <option v-for="(service, index) in services" :key="index" :value="service.id">{{ service.nom_service }}</option>
                </select>
                <span class="erreur" v-if="id_service_erreur !== ''">{{id_service_erreur}}</span>

            </div>
      </div>


      <div class="boutons">
                <input  type="submit" value="Ajouter" :class="{ 'data-close-modal': (this.etatForm) } "> <!-- :class="{ 'data-close-modal': !(this.etatForm) } " -->
                <button type="button" class="texte annuler data-close-modal" >Annuler</button>
            </div>
      </form>
  </div>
</template>

<script>
import bus from '../../eventBus';
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
            nom_direction_erreur:"",
            id_service_erreur:"",
            id_user_erreur:"",
            etatForm:false,
        }
    },
    mounted(){
        this.get_service();
        this.get_user();
    },

    methods:{
      async soumettre(){
          const formdata = new FormData();
          formdata.append('nom_direction', this.form.nom_direction  );
          formdata.append('id_service', this.form.id_service  );
          formdata.append('id_user', this.form.id_user  );

         /*  if(this.form.nom_direction!=="" && this.form.id_user!==""){
             
                 
                 /*  Swal.fire('Succes!','Direction ajouté avec succés','success')
                  this.resetForm();
                  bus.emit('directionAjoutee'); */
                try{ 
                    const create_store=await axios.post('/direction/store', formdata);

                  this.resetForm();
                    bus.emit('directionAjoutee');

                    var ajout = document.querySelector('[data-modal-ajout]');
                    var confirmation = document.querySelector('[data-modal-confirmation]');

                   
                    /* console.log(ajout); */
                    var actif = document.querySelectorAll('.actif');
                        actif.forEach(item => {
                        item.classList.remove("actif");
                    }); 
                    //ajout.classList.remove("actif");
                    ajout.close();


                    confirmation.style.backgroundColor = 'white';
                    confirmation.style.color = 'var(--clr)';

                        

                    //setTimeout(function(){
                        confirmation.showModal();
                        confirmation.classList.add("actif");
                        //confirmation.close();  
                    //}, 1000);  
                     
                    setTimeout(function(){     
                        confirmation.close();  

                        setTimeout(function(){     
                            confirmation.classList.remove("actif");   
                    }, 100); 

                    }, 1700);  
                       
              }
              catch(e){
                    /* console.log(e.request.status) */
                  if(e.request.status===404){
                    Swal.fire('Erreur !','Ce service existe déjà','error')
                  }
                  else{
                    Swal.fire('Erreur !','Une erreur est survenue lors de l\'enregistrement','error')
                  }

                }


      },
      verifCaratere(nom){
            const valeur= /^[a-zA-ZÀ-ÿ\s]*$/;
            return valeur.test(nom);
        },

    validatedata(){
        this.nom_direction_erreur= "";
        var i=0;
        
        if(this.form.nom_direction=== ""){
            this.nom_direction_erreur= "Ce champ est obligatoire"
            i=1;
        }else{
            if(!this.verifCaratere(this.form.nom_direction)){
            this.nom_direction_erreur= "Ce champ ne peut comporter que des lettres et des espaces"
           i=1;
        }
        if(this.form.nom_direction.length < 15){
            this.nom_direction_erreur= "Ce champ doit contenir au moins 15 Caratères"
           i=1;
        }

        }
       

    if(i==1) return true;

        return false;
    },
    verifId(){
        this.id_service_erreur= "";
        this.id_user_erreur="";
        var i=0;

        if(this.form.id_service=== ""){
            this.id_service_erreur= "Vous avez oublié de sélectionner le service"
             i=1;
        }
       
        if(this.form.id_user=== ""){
            this.id_user_erreur= "Vous avez oublié de sélectionner le chef de direction "
             i=1;
        }

    if(i==1) return true;

        return false;
    
    },
    validerAvantAjout() {
            // Exécutez la validation des champs
            const isNomChampValid = this.validatedata();
            const isIdChampValid = this.verifId();

          /*   console.log(isNomChampValid); */
            if (isNomChampValid || isIdChampValid) {
                this.etatForm= false;
                return 0;
            }else{
                this.soumettre();
                this.etatForm= true;
            }
           
        }, 

      resetForm(){
    //     var ajout = document.querySelector("[data-modal-ajout]");
    //         var fermemod = document.querySelectorAll('[data-close-modal]');
    //         //Fermeture des modals
    //         fermemod.forEach(item => {
    //             item.addEventListener('click', () => {
    //             var actif = document.querySelectorAll('.actif');
    //                 actif.forEach(item => {
    //                     item.classList.remove("actif");
    //                 });
    //                     ajout.close();
    //                     modification.close();
    //                     suppression.close();

    //         })
    //    /*    ajout.remove("active");  */

    //         });
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
    //    rafraichissementAutomatique() {
    //         document.addEventListener("DOMContentLoaded", this.resetForm());
    // },


  }
 }
</script>

<style>
</style>
