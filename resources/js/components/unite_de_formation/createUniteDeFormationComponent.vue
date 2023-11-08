<template>
    <dialog data-modal-ajout class="modal">
    <div class="cote_droit contenu">
        <form @submit="validerAvantAjout()" method="dialog">
            <h1 class="sous_titre">Ajout de unite de formation</h1>
        
        <div class="personnel">
           <div>
              <input type="text" name="nom_unite_formation" id="nom_unite_formation" placeholder="Nom Unite de formation" @input="validatedata()">``
              <span class="erreur" v-if="this.nom_unite_erreur !== ''">{{this.nom_unite_erreur}}</span>
            </div>

        <div class="roles">
                <select name="formateur" id="formateur" v-model="form.id_formateur" @change="verifIdFormateur()">
                        <option value=""> Formateur</option>
                        <option v-for="formateur in formateurs" :key="formateur.id" :value="formateur.id">{{ formateur.user.nom }} {{ formateur.user.prenom }}</option>

                </select>
                <span class="erreur" v-if="id_formateur_erreur !== ''">{{id_formateur_erreur}}</span>

            </div>

            <div class="roles">
                <select name="departement" id="departement" v-model="form.id_departement" @change="verifIdDepartement()">
                        <option value=""> Departement</option>
                        <option v-for="departement in departements" :key="departement.id" :value="departement.id">{{ departement.nom_departement }}</option>

                </select>
                <span class="erreur" v-if="id_departement_erreur !== ''">{{id_departement_erreur}}</span>

            </div>
        </div>



             <!-- <div class="identifiants">
                <input type="text" name="matricule" id="matricule" placeholder="Matricule" v-model="form.contact_urgence_2">
                <input type="password" name="mot_de_passe" id="mot_de_passe" placeholder="Mot de passe" v-model="form.contact_urgence_2">
            </div> -->



            <!--paiement-->


            <div class="boutons">
                <input  type="submit" value="Ajouter" :class="{ 'data-close-modal': !(this.etatForm) } ">
                <button type="button" class="texte annuler data-close-modal" >Annuler</button>
            </div>
        </form>
    </div>
</dialog>
</template>

<script>
import axios from 'axios';
import Form from 'vform';

   export default {
    name:"createUniteDeFormationComponent",
    data(){
        return {
            filieres:[],
            form:new Form({
                'nom_unite_formation':"",
                'id_formateur':"",
                'id_departement':""
            }),
        
            formateurs:[],
            departements:[],
            nom_unite_erreur:"",
            id_formateur_erreur:"",
            id_departement_erreur:"",
            etatForm: true,

        }
        
    },

    mounted(){
        this.get_formateur();
        this.get_departement();
        // this.rafraichissementAutomatique();

    },

    methods:{
        async soumettre(){
            const formdata = new FormData();
            formdata.append('nom_unite_formation', this.form.nom_unite_formation  );
            formdata.append('id_formateur', this.form.id_formateur);
            formdata.append('id_departement', this.form.id_departement);


            if(this.form.nom_unite_formation!=="" ){
                try{
                    const create_store=await axios.post('/unite_de_formation/store', formdata, {

                    });
                    /* this.resetForm(); */
                    //Swal.fire('Succes!','unite de formation ajoutée avec succées','success')

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
                    console.log(e)
                    if(e.request.status===404){
                    Swal.fire('Erreur!','Cette unite de formation existe déjà','error')
                  }
                  else{
                    Swal.fire('Erreur!','Une erreur est survenue lors de l\'enregistrement','error')
                  }
                }

            }else{
                // this.resetForm();
                Swal.fire('Erreur!','Veillez remplir tous les champs obligatoires','error')
            }


        },


         get_formateur(){

             axios.get('/formateur/index')
             .then(response => {
                 this.formateurs=response.data.formateur


            }).catch(error=>{
                // this.resetForm();
                Swal.fire('Erreur!','Une erreur est survenue lors de la recuperation des formateurs','error')
            });
        },

        get_departement(){

            axios.get('/departement/all')
            .then(response => {
                this.departements=response.data.departement


           }).catch(error=>{
            // this.resetForm();
               Swal.fire('Erreur!','Une erreur est survenue lors de la recuperation des departements','error')
           });
       },
       validerAvantAjout() {
            // Exécutez la validation des champs
            const isNomUniteValid = this.validatedata();
            const isIdFormateurValid = this.verifIdFormateur();
            const isIdDepartementValid = this.verifIdDepartement();

          /*   console.log(isNomUniteValid); */
            if (isNomUniteValid || isIdFormateurValid || isIdDepartementValid ) {
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
            this.form.nom_unite_formation="";
            this.form.id_formateur="";
            this.form.id_departement="";

        },
        verifCaratere(nom){
            const valeur= /^[a-zA-ZÀ-ÿ\s]*$/;
            return valeur.test(nom);
        },

    validatedata(){
        this.nom_unite_erreur= "";
        
        if(this.form.nom_unite_formation=== ""){
            this.nom_unite_erreur= "Ce champ est obligatoire"
            return true;
        }
        if(!this.verifCaratere(this.form.nom_unite_formation)){
            this.nom_unite_erreur= "Ce champ ne peut comporter que des lettres et des espaces"
            return true;
        }
        if(this.form.nom_unite_formation.length < 12){
            this.nom_unite_erreur= "Ce champ doit contenir au moins 12 Caratères"
            return true;
        }

        return false;
       
    },
    verifIdFormateur(){
        this.id_formateur_erreur= "";

        if(this.form.id_formateur=== ""){
            this.id_formateur_erreur= "Vous avez oublié de sélectionner le formateur responsable"
            return true;
        }
        return false;
    },
    verifIdDepartement(){
        this.id_departement_erreur= "";

        if(this.form.id_departement=== ""){
            this.id_departement_erreur= "Vous avez oublié de sélectionner le departement"
            return true;
        }
        return false;
    },

    //     rafraichissementAutomatique() {
    //         document.addEventListener("DOMContentLoaded", this.resetForm());
    // },


    }
   }
</script>

