<template>


<div class="col-lg-6 p-t-20">
        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
            <label class="mdl-textfield__label" for="txtFirstName" v-show="!form.nom_direction">Nom Direction</label>
            <input class="mdl-textfield__input" type="text" id="txtFirstName" v-model="form.nom_direction"
                @input="validatedata('nom_direction')">
            <span class="erreur">{{ this.nom_direction_erreur }}</span>
        </div>
    </div>
   
   
    <div class="col-lg-6 p-t-20" >
        <div
            class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label getmdl-select getmdl-select__fix-height txt-full-width">
            <label for="list6" class="mdl-textfield__label" v-show="!form.id_user">Choisissez le chef de direction</label>
            <select class="mdl-textfield__input" id="list6" readonly tabIndex="-1" v-model="form.id_user"
                @change="validatedata('user')">
                <option v-for="(user, index) in users" :value="user.id" :key="index">{{ user.prenom }} {{ user.nom }}</option>
            </select>
            <span class="erreur">{{ id_user_erreur }}</span>
        </div>
    </div>


    <div class="col-lg-12 p-t-20 text-center">

        <button type="submit" v-if="!this.editModal"
            class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-circle btn-primary"
            @click.prevent="validerAvantAjout()">Enregistrer</button>
        <button type="submit" v-if="this.editModal"
            class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-circle btn-primary"
            @click.prevent="validerAvantAjout()">Modifier</button>
        <button type="button"
            class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn-circle btn-danger"
            @click="resetForm">Annuler</button>

    </div>
</template>

<script>
import bus from '../../eventBus';
import axios from 'axios';
import Form from 'vform';
import Swal from 'sweetalert2';
import flatPickr from 'vue-flatpickr-component';
import 'flatpickr/dist/flatpickr.css';

 export default {
    props: ['direction'],
  name:"createDirectionCompenent",
  components: {
    flatPickr,
  },
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
            
            this.editModal = eventData.editModal;
            this.monterToupdate(eventData.direction);

        });
    },

    methods:{
        async soumettre(){
          const formdata = new FormData();
          formdata.append('nom_direction', this.form.nom_direction  );
          formdata.append('id_user', this.form.id_user  );

            try{
                const create_store=await axios.post('/direction/store', formdata);
                bus.emit('directionAjoutee;')
                showDialog6("Direction ajoutée avec succès");
                this.resetForm();
                bus.emit('directionAjoutee');
                 window.location.href = '/direction/index';
 
                 } 
                 catch(e){

                /* console.log(e.request.status) */
                if(e.request.status===404){
                    showDialog3("Ce service existe déjà");
                }
                else{
                    showDialog3("Une erreur est survenue lors de l\'enregistrement");
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
                    this.form.nom_direction = this.form.nom_direction.toUpperCase();
                    this.update_direction(this.idDirection);
                   
                    this.editModal=false;
                }
                else{
                    this.etatForm= true;
                    this.form.nom_direction = this.form.nom_direction.toUpperCase();
                    this.soumettre();
                  
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
     
      get_user(){
          axios.get('/user/getpersoadminunique')
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
                showDialog6("Direction modifiée avec succès");
                const eventData = {
                editModal: false,
            };
            bus.emit('directionDejaModifier', eventData);
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
    monterToupdate(direction) {
            console.log("MonterToupdate called");
         
            this.idDirection = direction.id;
            this.editModal = direction.editModal;
            this.form.nom_direction = direction.direction;
            this.form.id_user = direction.id_user;
           
            
        },
     
  }
 }
</script>


