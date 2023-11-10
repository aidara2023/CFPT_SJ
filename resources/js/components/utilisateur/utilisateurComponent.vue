<template>
    <div class=" cote_droit contenu">
        <form @submit.prevent="Uniquevalidate('soumettre')" method="">
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
                    <input type="text" name="nom" id="nom" placeholder="Nom" v-model="form.nom" @input="Uniquevalidate( 'nom')">
                    <span class="erreur" v-if="this.nom_user_erreur !== ''">{{this.nom_user_erreur}}</span>
                    <!-- <span class="erreur" >{{this.erreur}}</span> --><!-- v-if="this.erreur !== ''" -->
             </div>

             <div>
                    <input type="text" name="prenom" id="prenom" placeholder="Prenom" v-model="form.prenom"  @input="Uniquevalidate('prenom')">
                    <span class="erreur" v-if="this.prenom_user_erreur !== ''">{{this.prenom_user_erreur}}</span>
                    <!-- <span class="erreur" v-if="this.erreur !== ''">{{this.erreur}}</span> -->
            </div>

            <div>
                    <input type="date" name="date_naissance" id="date_naissance" placeholder="Date de naissance" v-model="form.date_naissance"  @input="validatedata('date_naissance')" >
                    <span class="erreur" v-if="this.date_erreur !== ''">{{this.date_erreur}}</span>
            </div>

            <div>
                    <input type="text" name="lieu_naissance" id="lieu_naissance" placeholder="Lieu de Naissance" v-model="form.lieu_naissance"  @input="validatedata('naissance')">
                    <span class="erreur" v-if="this.lieu_naissance_erreur !== ''">{{this.lieu_naissance_erreur}}</span>
            </div>

            <div>
                   <input type="text" name="nationalite" id="nationalite" placeholder="Nationalité" v-model="form.nationalite"  @input="validatedata('nationalite')">
                   <span class="erreur" v-if="this.nationalite_erreur !== ''">{{this.nationalite_erreur}}</span>
            </div>
              
          </div>

            <div class="sexe">
                <span class="b">Sexe</span>
                
                    <label for="masculin">Masculin
                        <input type="radio" name="sexe" id="masculin" value="masculin" v-model="form.genre" @change="validatedata('genre')">
                       
                    </label>
                
                    <label for="feminin">Feminin
                   
                        <input type="radio" name="sexe" id="feminin" value="feminin" v-model="form.genre" @change="validatedata('genre')">
                      
                    </label>
                    <span class="erreur" v-if="genre_erreur !== ''">{{this.genre_erreur}}</span>
                
            </div>
            <div class="num-addr">

                <div>
                    <input type="tel" name="telephone" id="telephone" placeholder="Tel : 77 234 48 43" v-model="form.telephone"  @input="validatedata('telephone')">
                    <span class="erreur" v-if="this.telephone_erreur !== ''">{{this.telephone_erreur}}</span>
                </div>

                <div>

                    <input type="text" name="adresse" id="adresse" placeholder="Adresse" v-model="form.adresse"  @input="validatedata('adresse')">
                    <span class="erreur" v-if="this.adresse_erreur !== ''">{{this.adresse_erreur}}</span>

                </div>

                <div>
                    <input type="mail" name="email" id="email" placeholder="Email" v-model="form.email"  @input="validatedata('email')">
                    <span class="erreur" v-if="this.email_user_erreur !== ''">{{this.email_user_erreur}}</span>
                </div>
                

            </div>


            <div class="roles">
                <div>
                    <select name="role" id="role" v-model="form.id_role"  @change="changement(form.id_role)" >
                            <option value=""> Role</option>
                    
                            <option v-for="(role, index) in roles" :value="role.id" :key="index">{{ role.intitule }}</option>

                        </select>
                    <span class="erreur" v-if="id_role_erreur !== ''">{{id_role_erreur}}</span>
                </div>
            </div>

            <div class="personnel" v-if="this.interesser=== 6">
              
                    <!-- <input type="text" name="type" id="type" placeholder="Type" v-model="form.type"> -->
                    
                        <div>
                            <select name="" id="" v-model="form.type" @change="validatedata('type')">
                                <option value="">Type Professeur</option>
                                <option  value="Etat">Fonctionnaire</option>
                                <option  value="Recruter">Recruter</option>
                            </select>
                            <span class="erreur" v-if="type_erreur !== ''">{{type_erreur}}</span>
                        </div>
                    

                
                    <div>
                        <select name="" id="" v-model="form.situation_matrimoniale"  @change="validatedata('situation_matrimoniale')">
                            <option value="">Selectioner Statut</option>
                            <option  value="Niveau 1">Célibataire</option>
                            <option  value="Niveau 2">Marié</option>
                            <option  value="Niveau 2">Divorcé</option>
                        </select>
                        <span class="erreur" v-if="situation_matrimoniale_erreur !== ''">{{situation_matrimoniale_erreur}}</span>
                    </div>
                
                <div>
                    <select name="id_specialite" id="id_specialite" v-model="form.id_specialite"  @change="validatedata('specialite')">
                            <option value=""> Spécialite</option>
                            <option v-for="(specialite, index) in specialites" :value="specialite.id" :key="index">{{ specialite.intitule }}</option>
                    </select>
                    <span class="erreur" v-if="id_specialite_erreur !== ''">{{id_specialite_erreur}}</span>

                </div>

                <div>
                    <select name="id_departement" id="id_departement" v-model="form.id_departement" @change="validatedata('departement')">
                            <option value=""> Departement</option>
                            <option v-for="(departement, index) in departements" :value="departement.id" :key="index">{{ departement.nom_departement }}</option>
                    </select>
                    <span class="erreur" v-if="id_departement_erreur !== ''">{{id_departement_erreur}}</span>
                </div>

            </div>
            <div class="personnel" v-if="this.interesser=== 4">


                <div>
                    <select name="id_service" id="id_service" v-model="form.id_service" @change="validatedata('service')">
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
            champ:"",
            i:0,
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
                    bus.emit('utilisateurAjoutee');
                    
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
            /* const isNomChampValid = this.validatedata('nom');
           
            const isPrenomChampValid = this.validatedata('prenom');
            const isAdresseChampValid = this.validatedata('adresse');
            const isNaissanceValid = this.validatedata('naissance');
            const isNationaliteValid = this.validatedata('nationalite');
            const isEmailValid = this.validatedata('email');
            const isDateNaissanceValid = this.validatedata('date_naissance');
            const isTelephoneValid = this.validatedata('telephone');
          const isRoleValid = this.validatedata('role');
            const isServiceValid = this.validatedata('service');
            const isSpecialiteValid = this.validatedata('specialite');
            const isSituationValid = this.validatedata('situation');
            const isDepartementValid = this.validatedata('departement');
            const isTypeValid = this.validatedata('type');
            const isGenreValid =this.validatedata('genre');  */
            const isNomChampValid = this.Uniquevalidate('nom');
           
            const isPrenomChampValid = this.Uniquevalidate('prenom');/* 
            const isRoleValid = this.validatedata('role');
            const isGenreValid =this.validatedata('genre');  

            const isIdChampValid = this.validatedataold();*/

          /*   console.log(isNomChampValid); */
            if (/* isIdChampValid || isRoleValid || isGenreValid */ isNomChampValid || isPrenomChampValid) {
                this.etatForm = false;
                return 0;
            }else{
                this.soumettre();
                this.etatForm = true;
            }
           
        }, 

        controleDeSaisie(){
            var champ = this.value;
            console.log(champ);
            this.erreur = champ;
        },

        resetForm(){

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
    const phoneRegex = /^\d{10}$/; // Format : 10 chiffres

    return phoneRegex.test(phoneNumber);
},

validatedata(champ) {
    // Réinitialiser les erreurs pour le champ actuel
        this.nom_user_erreur= "";
        this.prenom_user_erreur="";
        this.nationalite_erreur="";
        this.lieu_naissance_erreur="";
        this.adresse_erreur="";
        this.date_erreur="";
        this.email_user_erreur="";
        this.telephone_erreur=""; 
        this.erreur = "";
        this.id_role_erreur = "";
        this.genre_erreur = "";
        var i= 0;

    switch (champ) {
        case 'nom':
            // Effectuez la validation pour le champ 'nom'
            if(this.form.nom=== ""){
            this.nom_user_erreur= "Ce champ est obligatoire"
            i= 1;
            return true
            
            }
            if(!this.verifCaratere(this.form.nom)){
                this.nom_user_erreur= "Ce champ ne peut comporter que des lettres et des espaces"
                /* this.erreur= "Ce champ ne peut comporter que des lettres et des espaces" */
                i= 1;
                return true
            }
            // Ajoutez d'autres validations si nécessaire
            break;
        case 'prenom':
            //pour prenom
            if(this.form.prenom=== ""){
            this.prenom_user_erreur= "Ce champ est obligatoire" 
            i= 1;
            return true
            }
            if(!this.verifCaratere(this.form.prenom)){
                this.prenom_user_erreur= "Ce champ ne peut comporter que des lettres et des espaces"
            /*  this.erreur= "Ce champ ne peut comporter que des lettres et des espaces" */
            i= 1;
            return true
            }
            break;
        case 'adresse':
            //pour adresse
            if(this.form.adresse=== ""){
                this.adresse_erreur= "Ce champ est obligatoire"
                i= 1;
                return true
            
            }
            break;
        case 'naissance':
             //pour lieu de naissance
            if(this.form.lieu_naissance=== ""){
                this.lieu_naissance_erreur= "Ce champ est obligatoire"
                i= 1;
                return true
            } 
            if(!this.verifCaratere(this.form.lieu_naissance)){
                this.lieu_naissance_erreur= "Ce champ ne peut comporter que des lettres et des espaces"
                i= 1;
                return true
            }
            break;
        case 'nationalite':
            //pour nationalite
            if(this.form.nationalite=== ""){
                this.nationalite_erreur= "Ce champ est obligatoire"
                i= 1;
                return true
            } 
            if(!this.verifCaratere(this.form.nationalite)){
                this.nationalite_erreur= "Ce champ ne peut comporter que des lettres et des espaces"
                i= 1;
                return true
            }
            break;
        case 'email':
           //Vérification de l' email
            if(this.form.email=== ""){
                this.email_user_erreur= "L'email est obligatoire"
                i= 1;
                return true
            }else{
                if(!this.validateEmail(this.form.email)) {
                    this.email_user_erreur = "L'email n'est pas valide";
                    i= 1;
                    return true 
                }
            } 
            break;
        case 'date_naissance': 
           // Vérification de la date de naissance
            if(this.form.date_naissance === ""){
                this.date_erreur = "La date de naissance est obligatoire";
                i= 1;
                return true
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
            return true
            }if(dateNaissance > dateActuelle) {
               this.date_erreur = "La date de naissance ne peut pas être dans le futur";
                i=1;
                return true
                }   
                
            }  
            break;
        case 'telephone': 
            //Vérification du numero de telephone
            if(this.form.telephone === ""){
                this.telephone_erreur = "Le numéro de téléphone est obligatoire";
                i= 1;
                return true
            } else if(!this.validatePhoneNumber(this.form.telephone)) {
                this.telephone_erreur = "Le numéro de téléphone n'est pas valide";
                i= 1;
                return true
            } 
            break;
            case 'role':
                //Vérification de role
                if(this.form.id_role=== ""){
                this.id_role_erreur= "Vous avez oublié de sélectionner le role "
                i=1;
                return true
        }
            break;

            case 'genre': 
            //Vérification de matrimoniale
            if(this.form.genre=== ""){
            this.genre_erreur= "Vous avez oublié de sélectionner le genre "
            i=1;
            return true
        }
            break;

            case 'type':
                //Vérification de type
                if(this.form.id_type=== ""){
                this.id_type_erreur= "Vous avez oublié de sélectionner le type "
                i=1;
                return true
        }
            break;

        case 'service': 
            //Vérification deservice
            
              if(this.form.id_service=== ""){
                 this.id_service_erreur= "Vous avez oublié de sélectionner le chef de service"
                 i=1;
                 return true
                }
           
            break;
            
        case 'specialite': 
            //Vérification de spécialité
            if(this.form.id_specialite=== ""){
            this.id_specialite_erreur= "Vous avez oublié de sélectionner la specialité"
            i=1;
            return true
        }
            break;
        case 'situation_matrimoniale': 
            //Vérification de matrimoniale
            if(this.form.situation_matrimoniale=== ""){
            this.situation_matrimoniale_erreur= "Vous avez oublié de sélectionner le statut "
            i=1;
            return true
        }
            break;
        case 'departement': 
            //Vérification de departement
            if(this.form.id_departement=== ""){
            this.id_departement_erreur= "Vous avez oublié de sélectionner le départrement"
            i=1;
            return true
        }
        break;

        default:
           break;
    }
},


    validatedataold(){
        this.nom_user_erreur= "";
        this.prenom_user_erreur="";
        this.nationalite_erreur="";
        this.lieu_naissance_erreur="";
        this.adresse_erreur="";
        this.date_erreur="";
        this.email_user_erreur="";
        this.telephone_erreur=""; 
        this.erreur = "";
        this.id_service_erreur= "";
        this.id_specialite_erreur="";
        this.situation_matrimoniale_erreur="";
        this.id_departement_erreur="";
        this.type_erreur="";
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
            this.adresse_user_erreur= "Ce champ est obligatoire"
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

    Uniquevalidate(donnee){
        this.nom_user_erreur= "";
        this.prenom_user_erreur="";
        this.nationalite_erreur="";
        this.lieu_naissance_erreur="";
        this.adresse_erreur="";
        this.date_erreur="";
        this.email_user_erreur="";
        this.telephone_erreur=""; 
        this.erreur = "";
        this.id_role_erreur = "";
        this.genre_erreur = "";

        
        var i = 0;
        if(donnee === 'soumettre') i = 1;
        
        //Pour nom
        if(donnee === 'nom' || i === 1){
            // Effectuez la validation pour le champ 'nom'
            this.nom_user_erreur= ""
            if(this.form.nom=== ""){
                this.nom_user_erreur= "Ce champ est obligatoire"
            }
            if(!this.verifCaratere(this.form.nom)){
                this.nom_user_erreur= "Ce champ ne peut comporter que des lettres et des espaces"
                /* this.erreur= "Ce champ ne peut comporter que des lettres et des espaces" */ 
            }

            if(i !== 1) return true;
        }
        //Pour prénom
        if(donnee === 'prenom' || i === 1){
            // Effectuez la validation pour le champ 'nom'
            this.prenom_user_erreur= ""
            if(this.form.prenom=== ""){
                this.prenom_user_erreur= "Ce champ est obligatoire"
            }
            if(!this.verifCaratere(this.form.prenom)){
                this.prenom_user_erreur= "Ce champ ne peut comporter que des lettres et des espaces"
                /* this.erreur= "Ce champ ne peut comporter que des lettres et des espaces" */ 
            }

            if(i !== 1) return true;
        }

        if(donnee === 'soumettre'){
            //Code ajout
            console.log("Tout marche !!!!!!!!");
           this.validerAvantAjout();
        }
    },
   /*  verifId(){
        this.id_service_erreur= "";
        this.id_specialite_erreur="";
        this.situation_matrimoniale_erreur="";
        this.id_departement_erreur="";
        this.id_role_erreur="";
        this.type_erreur="";
        this.genre_erreur="";
        var i= 0;
//pour genre
        if(this.form.genre=== ""){
            this.genre_erreur= "Vous avez oublié de sélectionner le genre"
             i=1;
        }
       //pour role
        if(this.form.id_role=== ""){
            this.id_role_erreur= "Vous avez oublié de sélectionner le role "
             i=1;
        }

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
            this.id_departement_erreur= "Vous avez oublié de sélectionner le département"
            i=1;
        }
        if(this.form.type=== ""){
            this.type_erreur= "Vous avez oublié de sélectionner le type "
             i=1;
        }
}
    if(i==1) return true;

        return false;
}, */
       
       
       
    

    //     rafraichissementAutomatique() {
    //         document.addEventListener("DOMContentLoaded", this.resetForm());
    // },


    }
   }
</script>

