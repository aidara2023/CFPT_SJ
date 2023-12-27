<template>
    <dialog data-modal-ajout class="modal">
      <div class="cote_droit contenu">
        <form @submit.prevent="validerAvantAjout()">
            <h1 class="sous_titre">Ajout d'unité de formation</h1>

            <div class="personnel">
                <div>
                    <input type="text" v-model="form.nom_unite_formation" id="nom" placeholder="Nom de l'unité de formation" @input="validatedata('nom_unite_de_formation')">
                    <span class="erreur" v-if="this.nom_unite_erreur !== ''">{{this.nom_unite_erreur}}</span>
                </div>
            </div>

            <div class="departement">
                <div>
                    <select name="id_departement" id="id_departement" v-model="form.id_departement" @change="validatedata('departement')">
                            <option value=""> Département</option>
                            <option v-for="(departement, index) in departements" :value="departement.id" :key="index">{{ departement.nom_departement }}</option>
                    </select>
                    <span class="erreur" v-if="id_departement_erreur !== ''">{{id_departement_erreur}}</span>
                </div>
            </div>

            <div class="user">
                <div>
                    <select name="user" id="user" v-model="form.id_user"  @change="validatedata('user')" >
                        <option value=""> Chef filiére</option>
                        <option v-for="user in users" :value="user.id">{{user.nom }} {{ user.prenom }}</option>
                    </select>
                    <span class="erreur" v-if="id_user_erreur !== ''">{{id_user_erreur}}</span>
                </div>
            </div>


            <div class="boutons">
                <input v-if="this.editModal===false"  type="submit" value="Ajouter" :class="{ 'data-close-modal': (this.etatForm) } ">
                <input v-if="this.editModal===true"  type="submit" value="Modifier" :class="{ 'data-close-modal': (this.etatForm) } ">
                <button type="button" class="texte annuler data-close-modal"  @click="resetForm">Annuler</button>
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
    name:"createUniteDeFormationCompenent",
    data(){
        return {
            filieres:[],
            form:new Form({
                'nom_unite_formation':"",
                'id_departement':"",
                'id_user':""
            }),

            departements:[],
            users:[],
            nom_unite_erreur:"",
            id_departement_erreur:"",
            id_user_erreur:"",
            etatForm: false,
            editModal: false,
            idFormation: "",
            

        }
    },

    mounted(){
        this.get_departement();
        this.get_user();
        bus.on('formationModifier', (eventData) => {
            this.idFormation = eventData.idFormation;
            this.editModal = eventData.editModal;
            this.form.nom_unite_formation = eventData.nom;
            this.form.id_departement = eventData.id_departement;
            this.form.id_user = eventData.id_user;
        });
    },

    methods:{
        async soumettre(){
            const formdata = new FormData();
            formdata.append('nom_unite_formation', this.form.nom_unite_formation );
            formdata.append('id_departement', this.form.id_departement);
            formdata.append('id_user', this.form.id_user);

             //if(this.form.nom!==""){
                try{
                    await axios.post('/unite_de_formation/store', formdata, {});
                    //Swal.fire('Réussi !', 'formation ajouté avec succès','success');
                   
                    this.resetForm();
                    bus.emit('unite_formationAjoutee');
     
                }
                catch(e){
                    /* console.log(e.request.status) */
                  if(e.request.status===404){
                    Swal.fire('Erreur !','Cette unité existe déjà','error')
                  }
                  else{
                    Swal.fire('Erreur !','Une erreur est survenue lors de l\'enregistrement','error')
                  }

                }
        },

        get_departement(){

            axios.get('/departement/all')
            .then(response => {
                this.departements=response.data.departement
            }).catch(error=>{
            Swal.fire('Erreur!','Une erreur est survenue lors de la recuperation des departements','error')
            });
            },

            get_user(){

            axios.get('/user_formateur/index')
            .then(response => {
                this.users=response.data.user
            }).catch(error=>{
            Swal.fire('Erreur!','Une erreur est survenue lors de la recupération du chef de filiére','error')
            });
            },


        validerAvantAjout() {
            // Exécutez la validation des champs
            const isNomUniteValid = this.validatedataOld();
          /*   const isIdValid = this.verifId();
 */
            console.log(isNomUniteValid);
            if (isNomUniteValid===true ) {
                this.etatForm= true;
                this.editModal=false;
                return 0;
            }
            else{

                if(this.editModal===true){
                    this.etatForm= true;
                    this.form.nom_unite_formation = this.form.nom_unite_formation.toUpperCase();
                    this.update_formation(this.idFormation);
                    this.closeModal('[data-modal-confirmation-modifier]');  
                    this.editModal=false;
                }
            else{
                this.form.nom_unite_formation = this.form.nom_unite_formation.toUpperCase();
                 
                this.soumettre();
                this.etatForm= true;
                this.closeModal('[data-modal-confirmation]');
                this.editModal=false;
            }

            }
           
        }, 

        resetForm(){
            this.form.nom_unite_formation="";
            this.form.id_departement="";
            this.form.id_user="";
            this.nom_unite_erreur= "";
            this.id_departement_erreur= "";
            this.id_user_erreur= "";
            this.editModal===false;
        },

        verifCaratere(nom_unite_formation){
            const valeur= /^[a-zA-ZÀ-ÿ\s]*$/;
            return valeur.test(nom_unite_formation);
        },

        validatedata(champ){
           
            
           var i=0;

               switch (champ) {
           case 'nom_unite_de_formation':
           this.nom_unite_erreur= "";
               // Effectuez la validation pour le champ 'nom'
               if(this.form.nom_unite_formation=== ""){
                this.nom_unite_erreur= "Ce champ est obligatoire"
                i= 1;
                return true

               }else{
                if(this.form.nom_unite_formation.length <10 ){
                    this.nom_unite_erreur= "Ce champ doit contenir au moins 14 Caratères"
                        i=1;
                        return true
                }
                if(!this.verifCaratere(this.form.nom_unite_formation)){
                   this.nom_unite_erreur= "Ce champ ne peut comporter que des lettres et des espaces"
                   /* this.erreur= "Ce champ ne peut comporter que des lettres et des espaces" */
                   i= 1;
                   return true
               }
               }
               break;
           
           case 'user':
           this.id_user_erreur="";
               //pour user
               if(this.form.id_user=== ""){
                   this.id_user_erreur= "Vous avez oublié de sélectionner  le chef de  filiére'"
                   i= 1;
                   return true

               }
               break;

            case 'departement':
            this.id_departement_erreur="";
               if(this.form.id_departement=== ""){
                  this.id_departement_erreur= "Vous avez oublié de sélectionner le département"
                  i=1;
                  return true
                } 
                break;
            default:
           break;
       }
   },

    validatedataOld(){
        this.nom_unite_erreur= "";
        this.id_departement_erreur= "";
        this.id_user_erreur= "";
        var i= 0;

        if(this.form.nom_unite_formation=== ""){
            this.nom_unite_erreur= "Ce champ est obligatoire"
           i=1;
        }
        if(!this.verifCaratere(this.form.nom_unite_formation)){
            this.nom_unite_erreur= "Ce champ ne peut comporter que des lettres et des espaces"
            i=1;
        }
        if(this.form.nom_unite_formation.length <10 ){
            this.nom_unite_erreur= "Ce champ doit contenir au moins 14 Caratères"
           i=1;
        }
        if(this.form.id_departement=== ""){
            this.id_departement_erreur= "Vous avez oublié de sélectionner le département"
            i=1;
        }
        if(this.form.id_user=== ""){
            this.id_user_erreur= "Vous avez oublié de sélectionner le chef de filiére"
            i=1;
        }
        if(i==1)
        return true;

        return false;
       
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

    async update_formation(id){
            const formdata = new FormData();
            formdata.append('nom_unite_formation', this.form.nom_unite_formation );
            formdata.append('id_departement', this.form.id_departement);
            formdata.append('id_user', this.form.id_formateur);

             //if(this.form.nom!==""){
                try{
                    await axios.post('/unite_de_formation/update/'+id, formdata, {});
                    //Swal.fire('Réussi !', 'formation ajouté avec succès','success');
                   
                    this.resetForm();
                    bus.emit('unite_formationAjoutee');
                    this.editModal=false;
     
                }
                catch(e){
                 console.log(e) 
                  /* if(e.request.status===404){
                    Swal.fire('Erreur !','Cette unité existe déjà','error')
                  }
                  else{
                    Swal.fire('Erreur !','Une erreur est survenue lors de l\'enregistrement','error')
                  } */

                }
        },

   

    }


   }

</script>

