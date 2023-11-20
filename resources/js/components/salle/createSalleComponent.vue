<template>
    <dialog data-modal-ajout class="modal">
        <div class="cote_droit contenu">
            <form @submit.prevent="validerAvantAjout()" method="">
                <h1 class="sous_titre">Ajout Salle</h1>
                <!--Informations personnelles-->
                <div class="personnel">
                    <div>
                        <input type="text" v-model="form.intitule" id="nom" placeholder="Intitule" @input="validatedata('intitule')">
                        <span class="erreur" v-if="this.nom_salle_erreur !== ''">{{this.nom_salle_erreur}}</span>
                    </div>

                    <div>
                        <input type="text" v-model="form.nombre_place" id="nom_place" placeholder="Nombre de place" @input="validatedata('nombre_place')">
                        <span class="erreur" v-if="this.nombre_place_erreur !== ''">{{this.nombre_place_erreur}}</span>
                    </div>
    
                    <div class="batiments">
                        <div>
                               <select name="batiment" id="batiment" v-model="form.id_batiment"  @change="verifIdBatiment()" >
                                    <option value=""> Batiment</option>
                                    <option v-for="batiment in batiments" :value="batiment.id">{{ batiment.intitule }} </option>
                                </select>
                                <span class="erreur" v-if="id_batiment_erreur !== ''">{{id_batiment_erreur}}</span>
                        </div>
                    </div>
                </div>
    
                <div class="boutons">
                    <input  type="submit" value="Ajouter" :class="{ 'data-close-modal': (this.etatForm) } "> <!-- :class="{ 'data-close-modal': !(this.etatForm) } " -->
                    <button type="button" class="texte annuler data-close-modal" @click="resetForm"  >Annuler</button>
                </div>
            </form>
        </div>
    </dialog>
    </template>
    
    <script>
    import bus from '../../eventBus';
    import axios from 'axios';
    import Form from 'vform';
    import Swal from 'sweetalert2';
    
       export default {
        name:"createSalleCompenent",
        data(){
            return {
                users:[],
                form:new Form({
                    'intitule':"",
                    'nombre_place':"",
                    'id_batiment':"",
                }),
                nom_salle_erreur:"",
                nombre_place_erreur:"",
                id_batiment_erreur:"",
                etatForm: false,
            }
        },
    
        mounted(){
            this.get_batiment();
        },
    
        
    
        methods:{
            async soumettre(){
                const formdata = new FormData();
                formdata.append('intitule', this.form.intitule );
                formdata.append('nombre_place', this.form.nombre_place);
                formdata.append('id_batiment', this.form.id_batiment  );
               /*  console.log(this.verifIdUser);
                console.log(this.validatedata); */
    
           /*      if(this.form.nom_salle!=="" && this.form.id_user!==""){ */
               /*  if(this.validatedata()!==true && this.verifIdUser()!==true){ */
                    try{
                        await axios.post('/salle/store', formdata, {});
                        //Swal.fire('Réussi !', 'Salle ajouté avec succès','success');
                       
                    
                        this.resetForm();
                        bus.emit('salleAjoutee');
                        
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
                        Swal.fire('Erreur !','Ce salle existe déjà','error')
                      }
                      else{
                        Swal.fire('Erreur !','Une erreur est survenue lors de l\'enregistrement','error')
                      }
    
                    }
    
             /*    } */
    
            },
    
            validerAvantAjout() {
                // Exécutez la validation des champs
                const isNomSalleValid = this.verifIdBatiment();
                const isIdBatimentValid = this.validatedataold();
    
              /*   console.log(isNomSalleValid); */
                if (isNomSalleValid || isIdBatimentValid) {
                    this.etatForm= false;
                    return 0;
                }else{
                    this.soumettre();
                    this.etatForm= true;
                }
               
            }, 
    
            resetForm(){
                this.form.intitule="";
                this.form.nombre_place="";
                this.form.id_batiment="";
                this.nom_salle_erreur= "";
                this.nombre_place_erreur="";
                this.id_batiment_erreur= "";
            },
    
            verifCaratere(nom){
                const valeur= /^[a-zA-ZÀ-ÿ\s]*$/;
                return valeur.test(nom);
            },
    
        validatedataold(){
            this.nom_salle_erreur= "";
            this.nombre_place_erreur="";
            this.id_batiment_erreur= "";
            var i=0;
            if(this.form.id_batiment=== ""){
                this.id_batiment_erreur= "Vous avez oublié de sélectionner la salle"
                return true;
            }
           
            
            if(this.form.intitule=== ""){
                this.nom_salle_erreur= "Ce champ est obligatoire"
                i=1;
                 
            }
            if(!this.verifCaratere(this.form.intitule)){
                this.nom_salle_erreur= "Ce champ ne peut comporter que des lettres et des espaces"
                i=1;
                
            }
            if(this.form.intitule.length < 12){
                this.nom_salle_erreur= "Ce champ doit contenir au moins 12 Caratères"
                i=1;
                
            }
            
            if(i===1)
            return true;
            return false;
           
        },
        validatedata(champ) {
    // Réinitialiser les erreurs pour le champ actuel
        this.nom_salle_erreur= "";
        this.nombre_place_erreur="";
        this.id_batiment_erreur="";
        var i= 0;

    switch (champ) {
        case 'intitule':
            // Effectuez la validation pour le champ 'nom'
            if(this.form.intitule=== ""){
            this.nom_salle_erreur= "Ce champ est obligatoire"
            i= 1;
            return true
            
            }
            if(!this.verifCaratere(this.form.intitule)){
                this.nom_salle_erreur= "Ce champ ne peut comporter que des lettres et des espaces"
                /* this.erreur= "Ce champ ne peut comporter que des lettres et des espaces" */
                i= 1;
                return true
            }
            // Ajoutez d'autres validations si nécessaire
            break;
        case 'nombre_place':
            //pour prenom
            if(this.form.nombre_place=== ""){
            this.nombre_place_erreur= "Ce champ est obligatoire" 
            i= 1;
            return true
            }
            if(!/^\d+$/.test(this.form.nombre_place)) {
                this.nombre_place_erreur = "Le nombre de place ne peut contenir que des chiffres";
                
            i= 1;
            return true
            }
            break;
        default:
           break;
    }
},
        verifIdBatiment(){
            this.id_batiment_erreur= "";
    
            if(this.form.id_batiment=== ""){
                this.id_batiment_erreur= "Vous avez oublié de sélectionner la salle"
                return true;
            }
            return false;
        },
    
            get_batiment(){
                axios.get('/batiment/index')
                .then(response => {
                    this.batiments=response.data.batiment
                 }).catch(error=>{
                   Swal.fire('Erreur!','Une erreur est survenue lors de la recuperation des membres administratifs','error')
               });
           },
    
        }
    }
    </script>