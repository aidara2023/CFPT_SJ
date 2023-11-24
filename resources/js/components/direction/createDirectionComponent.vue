<template>
    <dialog data-modal-ajout class="modal">
    <div class="cote_droit contenu">
        <form  @submit.prevent="validerAvantAjout()" method="">
          <h1 class="sous_titre">Ajout direction</h1>
          <!--Informations personnelles-->
    <div class="personnel">
              <div>
                  <input type="text" v-model="form.nom_direction" id="nom" placeholder="Nom de la direction" @input="validatedata('nom_direction')">
                  <span class="erreur" v-if="this.nom_direction_erreur !== ''">{{this.nom_direction_erreur}}</span>
              </div>
           <div class="roles">
              <select name="user" id="user" placeholder="Niveau" v-model="form.id_user" @change="validatedata('user')" >
                <option value="">Chef de direction</option>
                <option v-for="(user, index) in users" :key="index" :value="user.id"> {{user.nom}} {{ user.prenom }}</option>
              </select>
              <span class="erreur" v-if="id_user_erreur !== ''">{{id_user_erreur}}</span>
             </div>

          
      </div>


      <div class="boutons">
                <input v-if="this.editModal===false"  type="submit" value="Ajouter" :class="{ 'data-close-modal': (this.etatForm) } ">
                <input v-if="this.editModal===true"  type="submit" value="Modifier" :class="{ 'data-close-modal': (this.etatForm) } ">
                <!-- <input v-if="this.editModal===true" type="submit" value="Modifier" :class="{ 'data-close-modal': (etatForm) } "> :class="{ 'data-close-modal': !(this.etatForm) } " :class="{ 'data-close-modal': !(validatedata() && verifIdUser()) } "  -->
                <button type="button" class="texte annuler data-close-modal" @click="resetForm">Annuler</button>
            </div>
      </form>
  </div>
</dialog>
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
                'id_user':"",

            }),
           
            nom_direction_erreur:"",
            id_user_erreur:"",
            etatForm:false,
            editModal: false,
            idDirection: "",

        }
    },
    mounted(){
       
        this.get_user();
        bus.on('directionModifier', (eventData) => {
            this.idDirection = eventData.idDirection;
            this.editModal = eventData.editModal;
            this.form.nom_direction = eventData.nom;
            this.form.id_user = eventData.id_user;
        });
    },

    methods:{
        async soumettre(){
          const formdata = new FormData();
          formdata.append('nom_direction', this.form.nom_direction  );
          formdata.append('id_user', this.form.id_user  );

            try{
                const create_store=await axios.post('/direction/store', formdata);

                this.resetForm();
                bus.emit('directionAjoutee');

                 } 
                 catch(e){

                /* console.log(e.request.status) */
                if(e.request.status===404){
                    Swal.fire('Erreur !','Cette direction existe déjà','error')
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


        validatedata(champ){
           
            
            var i=0;

                switch (champ) {
            case 'nom_direction':
            this.nom_direction_erreur= "";
                // Effectuez la validation pour le champ 'nom'
                if(this.form.nom_direction=== ""){
                this.nom_direction_erreur= "Ce champ est obligatoire"
                i= 1;
                return true

                }
                if(!this.verifCaratere(this.form.nom_direction)){
                    this.nom_direction_erreur= "Ce champ ne peut comporter que des lettres et des espaces"
                    /* this.erreur= "Ce champ ne peut comporter que des lettres et des espaces" */
                    i= 1;
                    return true
                }

                break;
            
            case 'user':
            this.id_user_erreur="";
                //pour user
                if(this.form.id_user=== ""){
                    this.id_user_erreur= "Vous avez oublié de sélectionner  le chef de direction'"
                    i= 1;
                    return true

                }
                break;


                default:
            break;
        }
    },


    validatedataOld(){
        this.nom_direction_erreur= "";
      
        this.id_user_erreur="";
        var i=0;

        if(this.form.nom_direction=== ""){
            this.nom_direction_erreur= "Ce champ est obligatoire"
            i=1;
        }else{
            if(!this.verifCaratere(this.form.nom_direction)){
            this.nom_direction_erreur= "Ce champ ne peut comporter que des lettres et des espaces"
           i=1;
        } 
    }
        if(this.form.id_user=== ""){
            this.id_user_erreur= "Vous avez oublié de sélectionner le chef de direction "
             i=1;
        }



    if(i==1) return true;

        return false;
    },
    verifId(){
       
        this.id_user_erreur="";
        var i=0;

       

        if(this.form.id_user=== ""){
            this.id_user_erreur= "Vous avez oublié de sélectionner le chef de direction "
             i=1;
             return true
        }

    if(i==1) return true;

        return false;

    },
    validerAvantAjout() {
            
           //const isIdChampValid = this.validatedataOld();


            const isNomDirectionValid = this.validatedataOld();
            const isIdDirectionValid = this.verifId();
        

            console.log(isNomDirectionValid);
            console.log(isIdDirectionValid);

            if ( isNomDirectionValid===true || isIdDirectionValid===true ) {
                this.etatForm= false;
                this.editModal=false;
                return 0;
            }else{

                if(this.editModal===true){
                    this.etatForm= false;
                    this.update_direction(this.idDirection);
                    this.closeModal('[data-modal-confirmation-modifier]');
                    this.editModal=false;
                }
                else{
                    this.etatForm= true;
                    this.soumettre();
                    this.closeModal('[data-modal-confirmation]');
                    this.editModal=false;
                }
            }

            },

      resetForm(){
          this.form.nom_direction="";
          this.form.id_user="";
          this.editModal=false;
          this.nom_direction_erreur= "";
          this.id_user_erreur="";
         
      },
      closeModal(selector){
            var ajout=document.querySelector('[data-modal-ajout]');
            var confirmation = document.querySelector(selector);

            /* console.log(ajout); */
            var actif = document.querySelectorAll('.actif');
                actif.forEach(item => {
                item.classList.remove("actif");
            });
            //ajout.classList.remove("actif");
            ajout.close();
            this.editModal=false;

            confirmation.style.backgroundColor = 'white';
            confirmation.style.color = 'var(--clr)';

                confirmation.showModal();
                confirmation.classList.add("actif");
            setTimeout(function(){
                confirmation.close();

                setTimeout(function(){
                    confirmation.classList.remove("actif");
            }, 100);

            }, 1700);
        },

      get_user(){
          axios.get('/user/getPersonnel')
          .then(response => {
              this.users=response.data.user


         }).catch(error=>{
             Swal.fire('Erreur!','Une erreur est survenue lors de la recuperation des roles','error')
         });
     },

     async update_direction(id){
         const formdata = new FormData();
            formdata.append('nom_direction', this.form.nom_direction  );
            formdata.append('id_user', this.form.id_user);

             //if(this.form.nom!==""){
            try{
                await axios.post('/direction/update/'+id, formdata);
                bus.emit('directionAjoutee');
                this.resetForm();
                this.editModal=false;
            }
            catch(e){
                /* console.log(e.request.status) */
                if(e.request.status===404){
                    Swal.fire('Erreur !','Cette direction existe déjà','error')
                }
                else{
                    Swal.fire('Erreur !','Une erreur est survenue lors de l\'enregistrement','error')
                }
            }
    }
     
  }
 }
</script>

<style>
</style>
