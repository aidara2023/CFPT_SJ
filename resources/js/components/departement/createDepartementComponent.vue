<template>
  

<div class="col-lg-6 p-t-20">
        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
            <label class="mdl-textfield__label" for="txtFirstName" v-show="!form.nom">Nom Département</label>
            <input class="mdl-textfield__input" type="text" id="txtFirstName" v-model="form.nom"
                @input="validatedata('nom_departement')">
            <span class="erreur">{{ this.nom_departement_erreur }}</span>
        </div>
    </div>
   
    <div class="col-lg-6 p-t-20 mt-1">
        <div
            class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label getmdl-select getmdl-select__fix-height txt-full-width">

            <label class="mdl-textfield__label" for="directionSelect" v-show="!form.id_direction"> Choisissez la direction </label>
            <select class="mdl-textfield__input" id="directionSelect" readonly tabIndex="-1" v-model="form.id_direction"
            @change="validatedata('id_direction')">

                <option v-for="(direction, index) in directions" :value="direction.id" :key="index">{{ direction.nom_direction }}</option>
            </select>
            <span class="erreur">{{ id_direction_erreur }}</span>
        </div>
    </div> 


   


    <div class="col-lg-6 p-t-20" >
        <div
            class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label getmdl-select getmdl-select__fix-height txt-full-width">
            <label for="list6" class="mdl-textfield__label" v-show="!form.id_user">Choisissez le chef de département</label>
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
    props: ['departement'],
    name:"createDepartementCompenent",
    components: {
    flatPickr,
  },
    data(){
        return {
            filieres:[],
            form:new Form({
                'nom':"",
                'id_direction':"",
                'id_user':""
            }),

            directions:[],
            users:[],
            nom_departement_erreur:"",
            id_direction_erreur:"",
            id_user_erreur:"",
            etatForm: false,
            editModal: false,
            idDepartement: "",


        }
    },

    mounted(){

        this.get_direction();
        this.get_user();
        bus.on('departementModifier', (eventData) => {
            this.editModal = eventData.editModal;
            this.monterToupdate(eventData.departement);
        });
    },


    methods:{
        async soumettre(){
            const formdata = new FormData();
            formdata.append('nom', this.form.nom);
            formdata.append('id_direction', this.form.id_direction);
            formdata.append('id_user', this.form.id_user);

             //if(this.form.nom!==""){
            try{
                await axios.post('/departement/store', formdata);
                bus.emit('departementAjoutee');
                showDialog6("Departement ajouté avec succès");
                this.resetForm();
                window.location.href = '/departement/index';

            }
            catch(e){
                /* console.log(e.request.status) */
                if(e.request.status===404){
                    showDialog3("Ce département existe déjà");
                }
                else{
                    showDialog3("Une erreur est survenue lors de l\'enregistrement");
                }
            }

        },


        validerAvantAjout() {
            const isNomDepartementValid = this.validatedataOld();
          /*   const isIdDirectionValid = this.verifIdDirection();
 */
            console.log(isNomDepartementValid);

            if ( isNomDepartementValid===true  ) {
                this.etatForm= false;
                this.editModal=false;
                return 0;
            }else{

                if(this.editModal===true){
                    this.etatForm= true;
                    this.form.nom = this.form.nom.toUpperCase();
                    this.update_departement(this.idDepartement);
                   
                    this.editModal=false;
                    
                }
                else{
                    this.etatForm= true;
                    this.form.nom = this.form.nom.toUpperCase();
                    this.soumettre();
                   
                    this.editModal=false;
                }
            }

        },

        get_user(){
            axios.get('/user_formateur/index')
            .then(response => {
                this.users=response.data.user
                }).catch(error=>{
                Swal.fire('Erreur!','Une erreur est survenue lors de la recuperation des membres administratifs','error')
            });
        },

        resetForm(){
            this.form.nom="";
            this.form.id_direction="";
            this.form.id_user="";
            this.editModal===false;
            this.nom_departement_erreur="";
            this.id_direction_erreur="";
            this.id_user_erreur="";
            const eventData = {
                editModal: false,
            };
            bus.emit('departementDejaModifier', eventData);
        },

       

        verifCaratere(nom){
            const valeur= /^[a-zA-ZÀ-ÿ\s]*$/;
            return valeur.test(nom);
        },
        validatedata(champ){
            var i=0;
        switch (champ) {
            case 'nom_departement':
            this.nom_departement_erreur= "";
            // Effectuez la validation pour le champ 'nom'
            if(this.form.nom=== ""){
                this.nom_departement_erreur= "Ce champ est obligatoire"
                return true;
            }
            if(!this.verifCaratere(this.form.nom)){
                this.nom_departement_erreur= "Ce champ ne peut comporter que des lettres et des espaces"
                return true;
            }
            if(!this.verifCaratere(this.form.nom)){
                 this.nom_departement_erreur= "Ce champ ne peut comporter que des lettres et des espaces"
                 return true
             }
            if(this.form.nom.length <14 ){
                this.nom_departement_erreur= "Ce champ doit contenir au moins 14 Caratères"
                return true;
            }

            break;

            case 'user':
            this.id_user_erreur="";
            //pour user
           if(this.editModal){
            if(this.form.id_user=== ""){
                this.id_user_erreur= "Vous avez oublié de sélectionner  le chef de direction'"
                i= 1;
                return true

            }
           }
            break;

            case 'id_direction' :  
            this.id_direction_erreur= "";
            if(this.form.id_direction=== ""){
                this.id_direction_erreur= "Vous avez oublié de sélectionner la direction"
                return true;
            }
            break;
            default:
                break;
}


        },

        validatedataOld(){
            this.nom_departement_erreur= "";
            var i= 0;

            if(this.form.nom=== ""){
                this.nom_departement_erreur= "Ce champ est obligatoire"
                 i=1;
            }
            if(!this.verifCaratere(this.form.nom)){
                this.nom_departement_erreur= "Ce champ ne peut comporter que des lettres et des espaces"
                 i=1;
            }
            if(this.form.nom.length <14 ){
                this.nom_departement_erreur= "Ce champ doit contenir au moins 14 Caratères"
                 i=1;
            }
            if(!this.verifCaratere(this.form.nom)){
                 this.nom_departement_erreur= "Ce champ ne peut comporter que des lettres et des espaces"
                 ;
                 i=1;
             }
           if(this.editModal){
            if(this.form.id_user=== ""){
              this.id_user_erreur= "Vous avez oublié de sélectionner le chef de Departement"
                i=1;
            }
           }
            if(this.form.id_direction=== ""){
                this.id_direction_erreur= "Vous avez oublié de sélectionner la direction"
                i=1;
            }
            if(i==1) return true;

            return false;
          

        },

       

        get_direction(){
            axios.get('/direction/index')
            .then(response => {
                this.directions=response.data.direction
            }).catch(error=>{
            this.resetForm();
            Swal.fire('Erreur!','Une erreur est survenue lors de la recuperation de la direction','error')
            });
        },

    async update_departement(id){
         const formdata = new FormData();
            formdata.append('nom', this.form.nom  );
            formdata.append('id_direction', this.form.id_direction);
            formdata.append('id_user', this.form.id_user);

             //if(this.form.nom!==""){
            try{
                await axios.post('/departement/update/'+id, formdata);
                bus.emit('departementAjoutee');
                showDialog6("Département modifié avec succès");
                const eventData = {
                editModal: false,
            };
            bus.emit('departementDejaModifier', eventData);
            }
            catch(e){
                /* console.log(e.request.status) */
                if(e.request.status===404){
                    showDialog3("Une erreur est survenue lors de la modification");
                }
                else{
                    showDialog3("Une erreur est survenue lors de la modification");
                }
                }
            },
            monterToupdate(departement) {
            console.log("MonterToupdate called");
            console.log(departement);
         
            this.idDepartement = departement.id;
            this.editModal = departement.editModal;
            this.form.nom = departement.departement;
            this.form.nom_direction = departement.direction;
            this.form.id_direction = departement.id_direction;
            this.form.id_user = departement.id_user;
           
            
        
    }

    }


   }

</script>

