<template>
    <dialog data-modal-ajout class="modal">
      <div class="cote_droit contenu">
        <form @submit.prevent="validerAvantAjout()">
            <h1 class="sous_titre">Ajout d'unite de formation</h1>

            <div class="personnel">
                <div>
                    <input type="text" v-model="form.nom_unite_formation" id="nom" placeholder="Nom de l'unité de formation" @input="validatedata()">
                    <span class="erreur" v-if="this.nom_unite_erreur !== ''">{{this.nom_unite_erreur}}</span>
                </div>
            </div>

            <div class="departement">
                <div>
                    <select name="id_departement" id="id_departement" v-model="form.id_departement" @change="verifId()">
                            <option value=""> Departement</option>
                            <option v-for="(departement, index) in departements" :value="departement.id" :key="index">{{ departement.nom_departement }}</option>
                    </select>
                    <span class="erreur" v-if="id_departement_erreur !== ''">{{id_departement_erreur}}</span>
                </div>
            </div>

            <div class="formateur">
                <div>
                    <select name="formateur" id="formateur" v-model="form.id_formateur"  @change="verifId()" >
                        <option value=""> Formateur</option>
                        <option v-for="formateur in formateurs" :value="formateur.id">{{formateur.user.nom }} {{ formateur.user.prenom }}</option>
                    </select>
                    <span class="erreur" v-if="id_formateur_erreur !== ''">{{id_formateur_erreur}}</span>
                </div>
            </div>


            <div class="boutons">
                <input  type="submit" value="Ajouter" :class="{ 'data-close-modaldep': (this.etatForm) } "> <!-- :class="{ 'data-close-modal': !(this.etatForm) } " :class="{ 'data-close-modal': !(validatedata() && verifIdUser()) } "  -->
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

   export default {
    name:"createUniteDeFormationCompenent",
    data(){
        return {
            filieres:[],
            form:new Form({
                'nom_unite_formation':"",
                'id_departement':"",
                'id_formateur':""
            }),

            departements:[],
            formateurs:[],
            nom_unite_erreur:"",
            id_departement_erreur:"",
            id_formateur_erreur:"",
            etatForm: false,
            

        }
    },

    mounted(){
        this.get_departement();
        this.get_formateur();
    },

    methods:{
        async soumettre(){
            const formdata = new FormData();
            formdata.append('nom_unite_formation', this.form.nom_unite_formation );
            formdata.append('id_departement', this.form.id_departement);
            formdata.append('id_formateur', this.form.id_formateur);

             //if(this.form.nom!==""){
                try{
                    await axios.post('/unite_de_formation/store', formdata, {});
                    //Swal.fire('Réussi !', 'Service ajouté avec succès','success');
                   
                
                    this.resetForm();
                    bus.emit('unite_formationAjoutee');

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

            get_formateur(){

            axios.get('/formateur/index')
            .then(response => {
                this.formateurs=response.data.formateur
            }).catch(error=>{
            Swal.fire('Erreur!','Une erreur est survenue lors de la recuperation des formateurs','error')
            });
            },


        validerAvantAjout() {
            // Exécutez la validation des champs
            const isNomUniteValid = this.validatedata();
            const isIdValid = this.verifId();

            console.log(isNomUniteValid);
            if (isNomUniteValid || isIdValid) {
                this.etatForm= true;
                return 0;
            }else{
                this.soumettre();
                this.etatForm= true;
            }
           
        }, 
        controleDeSaisie(){
            var champ = this.value;
            console.log(champ);
            this.erreur = champ;
        },

        resetForm(){
            this.form.nom_unite_formation="";
            this.form.id_departement="";
            this.form.id_formateur="";
        },

        verifCaratere(nom_unite_formation){
            const valeur= /^[a-zA-ZÀ-ÿ\s]*$/;
            return valeur.test(nom_unite_formation);
        },

    validatedata(){
        this.nom_unite_erreur= "";
        this.id_departement_erreur= "";
        this.id_formateur_erreur= "";
        var i= 0;

        if(this.form.nom_unite_formation=== ""){
            this.nom_unite_erreur= "Ce champ est obligatoire"
           i=1;
        }
        if(!this.verifCaratere(this.form.nom_unite_formation)){
            this.nom_unite_erreur= "Ce champ ne peut comporter que des lettres et des espaces"
            i=1;
        }
        if(this.form.nom_unite_formation.length <14 ){
            this.nom_unite_erreur= "Ce champ doit contenir au moins 14 Caratères"
           i=1;
        }

        return false;
       
    },
    verifId(){
        this.id_departement_erreur= "";
        this.id_formateur_erreur= "";
        var i=0;

        if(this.form.id_departement=== ""){
            this.id_departement_erreur= "Vous avez oublié de sélectionner le département"
            i=1;
        }
        if(this.form.id_formateur=== ""){
            this.id_formateur_erreur= "Vous avez oublié de sélectionner le formateur"
            i=1;
        }
        if(i==1)
        return true;
        return false;
        
    },

   

    }


   }

</script>

