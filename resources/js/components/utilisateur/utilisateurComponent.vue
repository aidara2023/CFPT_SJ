<template>
    <div class=" cote_droit contenu">
        <form @submit.prevent="validerAvantAjout()" method="">
            <h1 class="sous_titre">Ajout d'utilisateur</h1>
            <!--Informations personnelles-->
         <div>
                <p><span class="str">*</span> Assurez vous que la photo est bien carrée</p>
            </div>
            <div class="photo">
                <label for="dossiers">Glissez la photo ici <span></span>
                    <input type="file" name="dossiers" id="dossiers" @change="ajoutimage" accept="image/*">
                </label>
            </div>

            <div class="personnel">

             <div>
                    <input type="text" name="nom" id="nom" placeholder="Nom" v-model="form.nom" @input="validatedata()">
                    <span class="erreur" v-if="this.nom_user_erreur !== ''">{{this.nom_user_erreur}}</span>
                    <!-- <span class="erreur" >{{this.erreur}}</span> --><!-- v-if="this.erreur !== ''" -->
             </div>

             <div>
                    <input type="text" name="prenom" id="prenom" placeholder="Prenom" v-model="form.prenom"  @input="validatedata()">
                    <span class="erreur" v-if="this.prenom_user_erreur !== ''">{{this.prenom_user_erreur}}</span>
                    <!-- <span class="erreur" v-if="this.erreur !== ''">{{this.erreur}}</span> -->
            </div>

            <div>
                    <input type="date" name="date_naissance" id="date_naissance" placeholder="Date de naissance" v-model="form.date_naissance"  @input="validatedata()" >
                    <span class="erreur" v-if="this.date_erreur !== ''">{{this.date_erreur}}</span>
            </div>

            <div>
                    <input type="text" name="lieu_naissance" id="lieu_naissance" placeholder="Lieu de Naissance" v-model="form.lieu_naissance"  @input="validatedata()">
                    <span class="erreur" v-if="this.lieu_naissance_erreur !== ''">{{this.lieu_naissance_erreur}}</span>
            </div>

            <div>
                   <input type="text" name="nationalite" id="nationalite" placeholder="Nationalité" v-model="form.nationalite"  @input="validatedata()">
                   <span class="erreur" v-if="this.nationalite_erreur !== ''">{{this.nationalite_erreur}}</span>
            </div>
              
          </div>

            <div class="sexe">
                <span class="b">Sexe</span>
                
                    <label for="masculin">Masculin
                        <input type="radio" name="sexe" id="masculin" value="masculin" v-model="form.genre" @change="verifId()">
                       
                    </label>
                
                    <label for="feminin">Feminin
                   
                        <input type="radio" name="sexe" id="feminin" value="feminin" v-model="form.genre" @change="verifId()">
                      
                    </label>
                    <span class="erreur" v-if="genre_erreur !== ''">{{this.genre_erreur}}</span>
                
            </div>
            <div class="num-addr">

                <div>
                    <input type="tel" name="telephone" id="telephone" placeholder="Tel : 77 234 48 43" v-model="form.telephone"  @input="validatedata()">
                    <span class="erreur" v-if="this.telephone_erreur !== ''">{{this.telephone_erreur}}</span>
                </div>

                <div>
                    <input type="text" name="adresse" id="adresse" placeholder="Adresse" v-model="form.adresse"  @input="validatedata()">
                    <span class="erreur" v-if="this.adresse_erreur !== ''">{{this.adresse_erreur}}</span>
                </div>

                <div>
                    <input type="mail" name="email" id="email" placeholder="Email" v-model="form.email"  @input="validatedata()">
                    <span class="erreur" v-if="this.email_user_erreur !== ''">{{this.email_user_erreur}}</span>
                </div>
                

            </div>


            <div class="roles">
                <div>
                    <select name="role" id="role" v-model="form.id_role"  @change="changement(form.id_role)">
                            <option value=""> Role</option>
                    
                            <option v-for="(role, index) in roles" :value="role.id" :key="index">{{ role.intitule }}</option>

                        </select>
                    <span class="erreur" v-if="id_role_erreur !== ''">{{id_role_erreur}}</span>
                </div>
            </div>

            <div class="personnel" v-if="this.interesser=== 6">
              
                    <!-- <input type="text" name="type" id="type" placeholder="Type" v-model="form.type"> -->
                    
                        <div>
                            <select name="" id="" v-model="form.type" @change="verifId()">
                                <option value="">Type Professeur</option>
                                <option  value="Etat">Fonctionnaire</option>
                                <option  value="Recruter">Recruter</option>
                            </select>
                            <span class="erreur" v-if="type_erreur !== ''">{{type_erreur}}</span>
                        </div>
                    

                
                    <div>
                        <select name="" id="" v-model="form.situation_matrimoniale"  @change="verifId()">
                            <option value="">Selectioner Statut</option>
                            <option  value="Niveau 1">Célibataire</option>
                            <option  value="Niveau 2">Marié</option>
                            <option  value="Niveau 2">Divorcé</option>
                        </select>
                        <span class="erreur" v-if="situation_matrimoniale_erreur !== ''">{{situation_matrimoniale_erreur}}</span>
                    </div>
                
                <div>
                    <select name="id_specialite" id="id_specialite" v-model="form.id_specialite"  @change="verifId()">
                            <option value=""> Spécialite</option>
                            <option v-for="(specialite, index) in specialites" :value="specialite.id" :key="index">{{ specialite.intitule }}</option>
                    </select>
                    <span class="erreur" v-if="id_specialite_erreur !== ''">{{id_specialite_erreur}}</span>

                </div>

                <div>
                    <select name="id_departement" id="id_departement" v-model="form.id_departement" @change="verifId()">
                            <option value=""> Departement</option>
                            <option v-for="(departement, index) in departements" :value="departement.id" :key="index">{{ departement.nom_departement }}</option>
                    </select>
                    <span class="erreur" v-if="id_departement_erreur !== ''">{{id_departement_erreur}}</span>
                </div>

            </div>
            <div class="personnel" v-if="this.interesser=== 4">


                <div>
                    <select name="id_service" id="id_service" v-model="form.id_service" @change="verifId()">
                            <option value=""> Service</option>
                            <option v-for="(service, index) in services" :value="service.id" :key="index">{{ service.nom_service }}</option>
                    </select>
                    <span class="erreur" v-if="id_service_erreur !== ''">{{id_service_erreur}}</span>

                </div>

            </div>


            <!--
            <div class="identifiants">
                <input type="text" placeholder="Contact urgence 1" v-model="form.contact_urgence_2">
                <input type="password"  placeholder="Contact urgence 2" v-model="form.contact_urgence_2">
            </div>  -->

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
    name:"utilisateurCompenent",
    data(){
        return {
            filieres:[],
            form:new Form({
                'nom':"",
                'prenom':"",
                'genre':"",
                'adresse':"",
                'telephone':"",
                'email':"",
                'date_naissance':"",
                'lieu_naissance':"",
                'nationalite':"",
                'id_role':"",
                'id_specialite':"",
                'id_departement':"",
                'id_service':"",
                'type':"",
                'situation_matrimoniale':"",

            }),
            photo:"",
            interesser:"",
            roles:[],
            services:[],
            departements:[],
            specialites:[],
            nom_user_erreur:"",
            prenom_user_erreur:"",
            date_erreur:"",
            lieu_naissance_erreur:"",
            genre_erreur:"",
            adresse_erreur:"",
            telephone_erreur:"",
            email_user_erreur:"",
            nationalite_erreur:"",
            id_role_erreur:"",
            id_specialite_erreur:"",
            id_departement_erreur:"",
            id_service_erreur:"",
            type_erreur:"",
            situation_matrimoniale_erreur:"",
            erreur:"",
            etatForm: false,



        }
    },

    mounted(){
        this.get_role();
        this.get_specialite();
        this.get_departement();
        this.get_service();
        // this.rafraichissementAutomatique();

    },

    methods:{
        async soumettre(){
            const formdata = new FormData();
            formdata.append('nom', this.form.nom  );
            formdata.append('prenom', this.form.prenom  );
            formdata.append('lieu_naissance', this.form.lieu_naissance);
            formdata.append('date_naissance', this.form.date_naissance);
            formdata.append('genre', this.form.genre);
            formdata.append('adresse', this.form.adresse);
            formdata.append('email', this.form.email);
            formdata.append('telephone', this.form.telephone);
            formdata.append('nationalite', this.form.nationalite);
            formdata.append('id_role', this.form.id_role);
            formdata.append('type', this.form.type);
            formdata.append('situation_matrimoniale', this.form.situation_matrimoniale);
            formdata.append('id_specialite', this.form.id_specialite);
            formdata.append('id_service', this.form.id_service);
            formdata.append('id_departement', this.form.id_departement);
            formdata.append('photo', this.photo);



/*             if(this.form.nom!=="" && this.form.prenom!=="" && this.form.telephone!=="" && this.form.date_naissance!==""){
 */             try{
                    const user_store=await axios.post('/user/store', formdata, {

                    });
                   /*  this.resetForm();
                    Swal.fire('Succes!','utilisateur ajouté avec succés','success')
                    bus.emit('formationAjoutee'); */
                    this.resetForm();
                    bus.emit('formationAjoutee');
                    
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


        changement(event){
            this.interesser= event;
        },


        get_role(){

             axios.get('/roles/index')
             .then(response => {
                 this.roles=response.data.role


            }).catch(error=>{
                Swal.fire('Erreur!','Une erreur est survenue lors de la recuperation des roles','error')
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

        get_specialite(){

             axios.get('/specialite/index')
             .then(response => {
                 this.specialites=response.data.specialite


            }).catch(error=>{
                Swal.fire('Erreur!','Une erreur est survenue lors de la recuperation des specialite','error')
            });
        },

        get_departement(){

             axios.get('/departement/all')
             .then(response => {
                 this.departements=response.data.departement


            }).catch(error=>{
                Swal.fire('Erreur!','Une erreur est survenue lors de la recuperation des departements','error')
            });
        },

        ajoutimage(event){
            this.photo=event.target.files[0];
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
    //         var ajout = document.querySelector("[data-modal-ajout]");
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

            this.form.nom="";
            this.form.prenom="";
            this.form.genre="";
            this.form.adresse="";
            this.form.telephone="";
            this.form.email="";
            this.form.date_naissance="";
            this.form.lieu_naissance="";
            this.form.nationalite="";
            this.form.id_role="";
            this.form.type="";
            this.form.situation_matrimoniale="";
            this.form.id_specialite="";
            this.form.id_departement="";

        },
        verifCaratere(nom){
            const valeur= /^[a-zA-ZÀ-ÿ\s]*$/;
            return valeur.test(nom);
        },

        validateEmail(email) {
    // Utilisez une expression régulière pour vérifier si l'email est au bon format
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
    
},

validatePhoneNumber(phoneNumber) {
    // Expression régulière pour vérifier le numéro de téléphone (format simple ici)
    const phoneRegex = /^\d{9}$/; // Format : 10 chiffres

    return phoneRegex.test(phoneNumber);
},


    validatedata(){
        this.nom_user_erreur= "";
        this.prenom_user_erreur="";
        this.nationalite_erreur="";
        this.lieu_naissance_erreur="";
        this.adresse_erreur="";
        this.date_erreur="";
        this.email_user_erreur="";
        this.telephone_erreur=""; 
        this.erreur = "";
        var i= 0;
        // pour nom

        if(this.form.nom=== ""){
            this.nom_user_erreur= "Ce champ est obligatoire"
          /*   this.erreur= "Ce champ est obligatoire" */
            i= 1;
        }
        if(!this.verifCaratere(this.form.nom)){
            this.nom_user_erreur= "Ce champ ne peut comporter que des lettres et des espaces"
            /* this.erreur= "Ce champ ne peut comporter que des lettres et des espaces" */
            i= 1;
        }
       
        //pour prenom
        if(this.form.prenom=== ""){
            this.prenom_user_erreur= "Ce champ est obligatoire" 
        /*     this.erreur= "Ce champ est obligatoire" */
        i= 1;
        }
        if(!this.verifCaratere(this.form.prenom)){
            this.prenom_user_erreur= "Ce champ ne peut comporter que des lettres et des espaces"
           /*  this.erreur= "Ce champ ne peut comporter que des lettres et des espaces" */
           i= 1;
        }


        //pour adresse
        if(this.form.adresse=== ""){
            this.adresse_erreur= "Ce champ est obligatoire"
            i= 1;
           
        }
    
       
        //pour lieu de naissance
        if(this.form.lieu_naissance=== ""){
            this.lieu_naissance_erreur= "Ce champ est obligatoire"
            i= 1;
        }
        if(!this.verifCaratere(this.form.lieu_naissance)){
            this.lieu_naissance_erreur= "Ce champ ne peut comporter que des lettres et des espaces"
            i= 1;
        }
        
        //pour nationalite
        if(this.form.nationalite=== ""){
            this.nationalite_erreur= "Ce champ est obligatoire"
            i= 1;
        }
        if(!this.verifCaratere(this.form.nationalite)){
            this.nationalite_erreur= "Ce champ ne peut comporter que des lettres et des espaces"
            i= 1;
        }
       
        //Vérification de l' email
        if(this.form.email=== ""){
            this.email_user_erreur= "L'email est obligatoire"
            i= 1;
        }else{
            if(!this.validateEmail(this.form.email)) {
        this.email_user_erreur = "L'email n'est pas valide";
        i= 1;
    }
        }
        
     // Vérification de la date de naissance
     if(this.form.date_naissance === ""){
        this.date_erreur = "La date de naissance est obligatoire";
        i= 1;
    } else {
        const dateNaissance = new Date(this.form.date_naissance);
        const dateLimite = new Date();
        const dateActuelle = new Date();
        dateLimite.setFullYear(dateLimite.getFullYear() - 19); // 18 ans avant la date actuelle
        let annee = dateLimite.getFullYear();
        console.log(annee);

        if(dateNaissance > dateLimite) {
            this.date_erreur = "La date de naissance ne peut pas être supérieure à "+ annee;
           i=1;
        }if(dateNaissance > dateActuelle) {
            this.date_erreur = "La date de naissance ne peut pas être dans le futur";
          i=1;
        }
        
    }

    //Vérification du numero de telephone
    if(this.form.telephone === ""){
        this.telephone_erreur = "Le numéro de téléphone est obligatoire";
        i= 1;
    } else if(!this.validatePhoneNumber(this.form.telephone)) {
        this.telephone_erreur = "Le numéro de téléphone n'est pas valide";
        i= 1;
    }

    if(i==1) return true;

        return false;

    },
    verifId(){
        this.id_service_erreur= "";
        this.id_specialite_erreur="";
        this.situation_matrimoniale_erreur="";
        this.id_departement_erreur="";
        this.id_role_erreur="";
        this.type_erreur="";
        this.genre_erreur="";
        var i= 0;
if(this.interesser== 4){
    if(this.form.id_service=== ""){
            this.id_service_erreur= "Vous avez oublié de sélectionner le chef de service"
            i=1;
        }
}if(this.interesser== 6){
    if(this.form.id_specialite=== ""){
            this.id_specialite_erreur= "Vous avez oublié de sélectionner la specialité"
            i=1;
        }
        if(this.form.situation_matrimoniale=== ""){
            this.situation_matrimoniale_erreur= "Vous avez oublié de sélectionner le statut "
            i=1;
        }
        if(this.form.id_departement=== ""){
            this.id_departement_erreur= "Vous avez oublié de sélectionner le départrement"
            i=1;
        }
        if(this.form.type=== ""){
            this.type_erreur= "Vous avez oublié de sélectionner le type "
             i=1;
        }
}else{
    if(this.form.genre=== ""){
            this.genre_erreur= "Vous avez oublié de sélectionner le genre"
             i=1;
        }
       
        if(this.form.id_role=== ""){
            this.id_role_erreur= "Vous avez oublié de sélectionner le role "
             i=1;
        }

    if(i==1) return true;

        return false;
    }
},
       
       
       
    

    //     rafraichissementAutomatique() {
    //         document.addEventListener("DOMContentLoaded", this.resetForm());
    // },


    }
   }
</script>

