<template>
<dialog data-modal-ajout class="modal">
    <div class="cote_droit contenu">
        <form @submit.prevent="validerAvantAjout()" method="">
            <h1 class="sous_titre">Ajout Service</h1>
            <!--Informations personnelles-->
            <div class="personnel">
                <div>
                    <input type="text" v-model="form.nom_service" id="nom" placeholder="Nom du Service" @input="validatedata()">
                    <span class="erreur" v-if="this.nom_service_erreur !== ''">{{this.nom_service_erreur}}</span>
                </div>

                <div>
                    
                    <select name="classe" id="classe" placeholder="Niveau" v-model="form.id_user" @change="verifIdUser()">
                        <option value="">Personnel Administratif</option>
                        <option v-for="(user, index) in users" :value="user.id"> {{user.nom}} {{ user.prenom }}</option>
                    </select>
                    <span class="erreur" v-if="id_user_erreur !== ''">{{id_user_erreur}}</span>
                </div>
            </div>

            <div class="boutons">
                <input  type="submit" value="Ajouter" :class="{ 'data-close-modal': (this.etatForm) } "> <!-- :class="{ 'data-close-modal': !(this.etatForm) } " -->
                <button type="button" class="texte annuler data-close-modal" >Annuler</button>
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
    name:"createServiceCompenent",
    data(){
        return {
            users:[],
            form:new Form({
                'nom_service':"",
                'id_user':"",
            }),
            nom_service_erreur:"",
            id_user_erreur:"",
            etatForm: false,
        }
    },

    mounted(){
        this.get_user();
    },

    

    methods:{
        async soumettre(){
            const formdata = new FormData();
            formdata.append('nom_service', this.form.nom_service  );
            formdata.append('id_user', this.form.id_user  );
           /*  console.log(this.verifIdUser);
            console.log(this.validatedata); */

       /*      if(this.form.nom_service!=="" && this.form.id_user!==""){ */
           /*  if(this.validatedata()!==true && this.verifIdUser()!==true){ */
                try{
                    await axios.post('/service/store', formdata, {});
                    //Swal.fire('Réussi !', 'Service ajouté avec succès','success');
                   
                
                    this.resetForm();
                    bus.emit('serviceAjoutee');
                    
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

         /*    } */

        },

        validerAvantAjout() {
            // Exécutez la validation des champs
            const isNomServiceValid = this.validatedata();
            const isIdUserValid = this.verifIdUser();

          /*   console.log(isNomServiceValid); */
            if (isNomServiceValid || isIdUserValid) {
                this.etatForm= false;
                return 0;
            }else{
                this.soumettre();
                this.etatForm= true;
            }
           
        }, 

        resetForm(){
            this.form.nom_service="";
            this.form.id_user="";
        },

        verifCaratere(nom){
            const valeur= /^[a-zA-ZÀ-ÿ\s]*$/;
            return valeur.test(nom);
        },

    validatedata(){
        this.nom_service_erreur= "";
        
        if(this.form.nom_service=== ""){
            this.nom_service_erreur= "Ce champ est obligatoire"
            return true;
        }
        if(!this.verifCaratere(this.form.nom_service)){
            this.nom_service_erreur= "Ce champ ne peut comporter que des lettres et des espaces"
            return true;
        }
        if(this.form.nom_service.length < 12){
            this.nom_service_erreur= "Ce champ doit contenir au moins 12 Caratères"
            return true;
        }

        return false;
       
    },
    verifIdUser(){
        this.id_user_erreur= "";

        if(this.form.id_user=== ""){
            this.id_user_erreur= "Vous avez oublié de sélectionner le chef de service"
            return true;
        }
        return false;
    },

        get_user(){
            axios.get('/user/getPersonnel')
            .then(response => {
                this.users=response.data.user
             }).catch(error=>{
               Swal.fire('Erreur!','Une erreur est survenue lors de la recuperation des membres administratifs','error')
           });
       },

    }
}
</script>