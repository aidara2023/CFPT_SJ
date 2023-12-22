<template>
    <dialog data-modal-ajout class="modal">

        <div class="titres">
            <h1>Ajout Service</h1>
           <!--  <h3>Informations Personnelles</h3> -->
        </div>
        
              <form @submit.prevent="validerAvantAjout()" action="" method="dialog" >
                
                    
                <!-- mettre class = "informations" uniquement pour un modal qui n'a pas de photo
                Et enlever la div au dessus -->
                <div class="informations">
                    <div class="titres">
                        <h1>Nouveau Département</h1>
                    </div>

                    <div class="champ">
                        <label for="nom" :class="{ 'couleur_rouge': (this.nom_departement_erreur)} ">Nom Departement</label>
                        <input  v-model="form.nom" id="nom"  @input="validatedata('nom_departement')" type="text" name="nom" :class="{ 'bordure_rouge': (this.nom_departement_erreur)} ">
                        <span class="erreur" >{{this.nom_departement_erreur}}</span>
                    </div>
                
                    <div class="groupe_champs">

                    
                    <div class="champ">
                        <label for="nom" :class="{ 'couleur_rouge': (this.id_user_erreur)} ">Chef Service</label>
                        <select v-model="form.id_user"  @change="validatedata('user')" :class="{ 'bordure_rouge': (this.id_user_erreur)} ">
                            <option v-for="user in users" :value="user.id">{{ user.nom }} {{ user.prenom }} </option>
                        </select>
                        <span class="erreur" v-if="id_user_erreur !== ''">{{id_user_erreur}}></span>
                    </div>

                    <div class="champ">
                        <label for="nom" :class="{ 'couleur_rouge': (this.id_direction_erreur)} ">Direction</label>
                        <select  v-model="form.id_direction" @change="validatedata('id_direction')" :class="{ 'bordure_rouge': (this.id_direction_erreur)} ">
                            <option v-for="(direction, index) in directions" :value="direction.id" :key="index">{{ direction.nom_direction }}</option>
                        </select>
                        <span class="erreur" v-if="id_direction_erreur !== ''">{{id_direction_erreur}}></span>
                    </div>
                </div>
                  <!--   <div class="champ">
                        <input type="text" class="select">
                        <div class="choix">
                            <p class="option">choix </p>
                            <p class="option">choix</p>
                            <p class="option">choix</p>
                        </div>
                    </div>

                    <div class="champ">
                            <label for="nom">Sexe</label>
                            
                            <input type="text" name="nom" id="nom" class="select">
                            <span class="erreur"></span>
                            <div class="choix">
                                <p class="option">Masculin</p>
                                <p class="option">Féminin</p>
                            </div>
                        </div> -->
<!-- 
                    <div class="groupe_champs">     

                        <div class="champ">
                            <label for="nom">Lieu de Naissance</label>
                            <input type="text" name="nom" id="nom">
                            <span class="erreur"></span>
                        </div>

                        <div class="champ">
                            <label for="nom">Date de naissance</label>
                            <input type="text" name="prenom" id="prenom">
                            <span class="erreur"></span>
                        </div>

                    </div> -->
<!--                     <div class="groupe_champs">     

                        <div class="champ">
                            <label for="nom">Sexe</label>
                            
                            <input type="text" name="nom" id="nom" class="select">
                            <span class="erreur"></span>
                            <div class="choix">
                                <p class="option">Masculin</p>
                                <p class="option">Féminin</p>
                            </div>
                        </div>

                        <div class="champ">
                            <label for="nom">nationalité</label>
                            <input type="text" name="prenom" id="prenom">
                            <span class="erreur"></span>
                        </div>

                    </div> -->
 <!--                    <div class="groupe_champs">     

                        <div class="champ">
                            <label for="nom">Adresse</label>
                            <input type="text" name="nom" id="nom">
                            <span class="erreur"></span>
                        </div>

                        <div class="champ">
                            <label for="nom">telephone</label>
                            <input type="text" name="prenom" id="prenom">
                            <span class="erreur"></span>
                        </div>

                    </div>

                    <div class="champ">
                        <label for="nom">Email</label>
                        <input type="text" name="prenom" id="prenom">
                        <span class="erreur"></span>
                    </div> -->

                    

                    <!-- Le groupe qui contient les boutons -->
                    <div class="groupe_champs validation">
                        <!-- Mettre la valeur 1 dans le data-close-modal pour qu'il soit actif -->
                        <button type="button" data-close-modal="1" class="annuler"><span data-statut="visible" @click="resetForm">Annuler</span></button> 
                        <button v-if="this.editModal===false" type="submit" data-close-modal="0" class="suivant"><span data-statut="visible">Ajouter</span></button>
                        <button  v-if="this.editModal===true" type="submit" data-close-modal="0" class="suivant"><span data-statut="visible">Modifier</span></button>
                    </div>

                </div>
                
              
            </form>
    
</dialog>
</template>


<script>
import bus from '../../eventBus';
import axios from 'axios';
import Form from 'vform';

   export default {
    name:"createDepartementCompenent",
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
            this.idDepartement = eventData.idDepartement;
            this.editModal = eventData.editModal;
            this.form.nom = eventData.nom;
            this.form.id_direction = eventData.id_direction;
            this.form.id_user = eventData.id_user;
        });
    },


    methods:{
        async soumettre(){
            const formdata = new FormData();
            formdata.append('nom_departement', this.form.nom  );
            formdata.append('id_direction', this.form.id_direction);
            formdata.append('id_user', this.form.id_user);

             //if(this.form.nom!==""){
            try{
                await axios.post('/departement/store', formdata);
                this.resetForm();
                bus.emit('departementAjoutee');

            }
            catch(e){
                /* console.log(e.request.status) */
                if(e.request.status===404){
                Swal.fire('Erreur !','Ce département existe déjà','error')
                }
                else{
                Swal.fire('Erreur !','Une erreur est survenue lors de l\'enregistrement','error')
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
                    this.update_departement(this.idDepartement);
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
            this.id_direction_erreur=""
            this.id_user_erreur=""
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
            this.editModal===false;

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
            if(this.form.id_user=== ""){
                this.id_user_erreur= "Vous avez oublié de sélectionner  le chef de direction'"
                i= 1;
                return true

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
            if(this.form.id_user=== ""){
              this.id_user_erreur= "Vous avez oublié de sélectionner le chef de Departement"
                i=1;
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
            formdata.append('nom_departement', this.form.nom  );
            formdata.append('id_direction', this.form.id_direction);
            formdata.append('id_user', this.form.id_user);

             //if(this.form.nom!==""){
            try{
                await axios.post('/departement/update/'+id, formdata);
                bus.emit('departementAjoutee');
                this.resetForm();
                this.editModal=false;
            }
            catch(e){
                /* console.log(e.request.status) */
                if(e.request.status===404){
                    Swal.fire('Erreur !','Ce département existe déjà','error')
                }
                else{
                    Swal.fire('Erreur !','Une erreur est survenue lors de l\'enregistrement','error')
                }
            }
    }

    }


   }

</script>

