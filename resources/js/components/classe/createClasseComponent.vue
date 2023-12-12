<template>
      <dialog data-modal-ajout class="modal">

        <div class="titres">
            <h1 >Ajout classe</h1>
        </div>

        <form @submit.prevent="validerAvantAjout()" action="" method="dialog">
           

            <div class="informations">
                    <div class="titres">
                        <h1>Ajout classe</h1>
                    </div>

                    <div class="champ">
                        <label for="nom" :class="{ 'couleur_rouge': (this.nom_classe_erreur)} ">Nom classe</label>
                        <input  v-model="form.nom_classe" id="nom"  @input="validatedata('nom_classe')" type="text" name="nom" :class="{ 'bordure_rouge': (this.nom_classe_erreur)} ">
                        <span class="erreur" >{{this.nom_classe_erreur}}</span>
                    </div>

                <div class="groupe_champs">

                    <div class="champ">
                        <label for="nom" :class="{ 'couleur_rouge': (this.type_classe_erreur)} ">Type classe</label>
                        <select v-model="form.type_classe " @change="validatedata('type_classe')" :class="{ 'bordure_rouge': (this.type_classe_erreur)} ">
                                <option  value="CJ">CJ</option>
                                <option  value="FPJ">FPJ</option>
                                <option  value="CS">CS</option>
                            </select>
                            <span class="erreur" v-if="type_classe_erreur !== ''">{{type_classe_erreur}}</span>
                    </div>
                 <!-- <input type="text" name="niveau" id="niveau" placeholder="Niveau" v-model="form.niveau"> -->

                    <div class="champ">
                        <label for="nom" :class="{ 'couleur_rouge': (this.niveau_erreur)} ">Niveau</label>
                        <select v-model="form.niveau" @change="validatedata('niveau')" :class="{ 'bordure_rouge': (this.niveau_erreur)} ">
                            <option  value=" 1 ">Niveau 1 </option>
                            <option  value=" 2 ">Niveau 2 </option>
                            <option  value=" 3">Niveau 3</option>
                        </select>
                        <span class="erreur" v-if="niveau_erreur !== ''">{{niveau_erreur}}</span>
                    </div>
                </div>

                <div class="groupe_champs">

                    <div class="champ">
                        <label for="nom" :class="{ 'couleur_rouge': (this.id_type_formation_erreur)} ">Type de formation</label>
                        <select name="type_formation" id="type_formation" v-model="form.id_type_formation " @change="validatedata('type_formation')" :class="{ 'bordure_rouge': (this.id_type_formation_erreur)}  ">
                                <option v-for="type_formation in type_formations" :value="type_formation.id">{{ type_formation.intitule }}</option>
                        </select>
                        <span class="erreur" v-if="id_type_formation_erreur !== ''">{{id_type_formation_erreur}}</span>
                    </div>

                    <div class="champ">
                        <label for="nom" :class="{ 'couleur_rouge': (this.id_unite_de_formation_erreur)} ">Unité de formation</label>
                        <select name="unite_de_formation" id="unite_de_formation" v-model="form.id_unite_de_formation" @change="validatedata('unite_de_formation')" :class="{ 'bordure_rouge': (this.id_unite_de_formation_erreur)}  ">
                                <option v-for="unite_de_formation in unite_de_formations" :value="unite_de_formation.id">{{ unite_de_formation.nom_unite_formation }}</option>
                        </select>
                        <span class="erreur" v-if="id_unite_de_formation_erreur !== ''">{{id_unite_de_formation_erreur}}</span>
                   </div>

                </div>   


                <div class="groupe_champs validation">
                                <!-- Mettre la valeur 1 dans le data-close-modal pour qu'il soit actif -->
                        <button type="button" data-close-modal="1" class="annuler"><span data-statut="visible" @click="resetForm">Annuler</span></button> 
                        <button   v-if="this.editModal===false" type="submit" data-close-modal="0" class="suivant"><span data-statut="visible">Ajouter</span></button>
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
    name:"classeCompenent",
    data(){
        return {
            form:new Form({
                'nom_classe':"",
                'type_classe':"",
                'niveau':"",
                'id_type_formation':"",
                'id_unite_de_formation':"",

            }),
            type_formations:[],
          unite_de_formations:[],
          nom_classe_erreur:"",
          id_type_formation_erreur:"",
          id_unite_de_formation_erreur:"",
          type_classe_erreur:"",
          niveau_erreur:"",
          etatForm: false,
          editModal: false





        }
    },
    mounted(){
        this.get_type_formation();
        this.get_unite_de_formation();
    },



    methods:{
        async soumettre(){
            const formdata = new FormData();
            formdata.append('nom_classe', this.form.nom_classe );
            formdata.append('type_classe', this.form.type_classe  );
            formdata.append('niveau', this.form.niveau );
            formdata.append('id_type_formation', this.form.id_type_formation );
            formdata.append('id_unite_de_formation', this.form.id_unite_de_formation );


            /* if(this.form.nom_classe!=="" && this.form.type_classe!==""  && this.form.niveau!==""){ */
                try{
                    const create_store=await axios.post('/classe/store', formdata, {

                    });
                    this.resetForm();
                    bus.emit('classeAjoutee');
                    // var ajout = document.querySelector('[data-modal-ajout]');
                    // /* console.log(ajout); */
                    // var actif = document.querySelectorAll('.actif');
                    //     actif.forEach(item => {
                    //     item.classList.remove("actif");
                    // });
                    // //ajout.classList.remove("actif");
                    // ajout.close();

                }
                catch(e){
                    console.log(e)
                    if(e.request.status===404){
                    Swal.fire('Erreur!','Cette classe existe déjà','error')
                  }
                  else{
                    Swal.fire('Erreur!','Une erreur est survenue lors de l\'enregistrement','error')
                  }
                }

           /*  }else{
                this.resetForm();
                Swal.fire('Erreur!','Veuillez remplir tous les champs obligatoires','error')
            } */


        },


         get_type_formation(){

             axios.get('/type_formation/all')
             .then(response => {
                 this.type_formations=response.data.type_formation


            }).catch(error=>{
                this.resetForm();
                Swal.fire('Erreur!','Une erreur est survenue lors de la recuperation du type de formation','error')
            });
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

        get_unite_de_formation(){

            axios.get('/unite_de_formation/all')
            .then(response => {
                this.unite_de_formations=response.data.unite_de_formation


           }).catch(error=>{
            this.resetForm();
               Swal.fire('Erreur!','Une erreur est survenue lors de la recuperation de lunite de formation','error')
           });
       },
       verifCaratere(nom){
            const valeur= /^[a-zA-ZÀ-ÿ\s]*$/;
            return valeur.test(nom);
        },

    validatedata(champ){
       
        var i=0;

    switch (champ) {
        case 'nom_classe':
        this.nom_classe_erreur= "";
            // Effectuez la validation pour le champ 'nom'
            if(this.form.nom_classe=== ""){
            this.nom_classe_erreur= "Ce champ est obligatoire"
            i= 1;
            return true

            }
            if(!this.verifCaratere(this.form.nom_classe)){
                this.nom_classe_erreur= "Ce champ ne peut comporter que des lettres et des espaces"
                /* this.erreur= "Ce champ ne peut comporter que des lettres et des espaces" */
                i= 1;
                return true
            }
            // Ajoutez d'autres validations si nécessaire
            break;
        case 'niveau':
        this.niveau_erreur="";
            //pour niveau
            if(this.form.niveau=== ""){
            this.niveau_erreur= "Vous avez oublié de sélectionner le niveau "
            i= 1;
            return true
            }

            break;
        case 'unite_de_formation':
        this.id_unite_de_formation_erreur="";
            //pour unite_de_formation
            if(this.form.unite_de_formation=== ""){
                this.id_unite_de_formation_erreur= "Vous avez oublié de sélectionner  l'unite de formation'"
                i= 1;
                return true

            }
            break;
        case 'type_formation':
        this.id_type_formation_erreur="";
             //pour type de formation
            if(this.form.type_formation=== ""){
                this.type_formation_erreur= "Vous avez oublié de sélectionner le type de formation "
                i= 1;
                return true
            }

            break;
        case 'type_classe':
        this.type_classe_erreur="";
            //pour type classe
            if(this.form.type_classe=== ""){
                this.type_classe_erreur= "Vous avez oublié de sélectionner le type de classe "
                i= 1;
                return true
            }

            break;

            default:
           break;
        }
    },

    verifId(){
        this.id_type_formation_erreur="";
          this.id_unite_de_formation_erreur="";
          this.type_classe_erreur="";
          this.niveau_erreur="";
        var i=0;

        if(this.form.id_type_formation=== ""){
            this.id_type_formation_erreur= "Vous avez oublié de sélectionner le type de formation"
             i=1;
             return true
        }

        if(this.form.type_classe=== ""){
            this.type_classe_erreur= "Vous avez oublié de sélectionner le type de la classe "
             i=1;
             return true
        }
        if(this.form.niveau=== ""){
            this.niveau_erreur= "Vous avez oublié de sélectionner le niveau "
             i=1;
             return true
        }
        if(this.form.id_unite_de_formation=== ""){
            this.id_unite_de_formation_erreur= "Vous avez oublié de sélectionner l'unité de formation' "
             i=1;
             return true
        }

    if(i==1) return true;

        return false;

    },
    validatedataOld(){
        this.nom_classe_erreur= "";
        this.id_type_formation_erreur="";
          this.id_unite_de_formation_erreur="";
          this.type_classe_erreur="";
          this.niveau_erreur="";
        var i=0;

        if(this.form.nom_classe=== ""){
            this.nom_classe_erreur= "Ce champ est obligatoire"
            i=1;
        }else{
            if(!this.verifCaratere(this.form.nom_classe)){
            this.nom_classe_erreur= "Ce champ ne peut comporter que des lettres et des espaces"
           i=1;
        }

        }

        if(this.form.id_type_formation=== ""){
            this.id_type_formation_erreur= "Vous avez oublié de sélectionner le type de formation"
             i=1;
        }

        if(this.form.type_classe=== ""){
            this.type_classe_erreur= "Vous avez oublié de sélectionner le type de la classe "
             i=1;
        }
        if(this.form.niveau=== ""){
            this.niveau_erreur= "Vous avez oublié de sélectionner le niveau "
             i=1;
        }
        if(this.form.id_unite_de_formation=== ""){
            this.id_unite_de_formation_erreur= "Vous avez oublié de sélectionner l'unité de formation' "
             i=1;
        }


    if(i==1) return true;

        return false;
    },

    validerAvantAjout() {
            // Exécutez la validation des champs
           /*  const isNomChampValid = this.validatedata(); */
            const isIdChampValid = this.validatedataOld();

          /*   console.log(isNomChampValid); */
            if ( isIdChampValid) {
                this.etatForm= false;
                return 0;
            }else{
                this.soumettre();
                this.etatForm= true;
                this.closeModal('[data-modal-confirmation]')
            }

        },

        resetForm(){

            this.form.nom_classe="";
            this.form.type_classe="";
            this.form.niveau="";
            this.form.id_type_formation="";
            this.form.id_unite_de_formation=""; 
            this.nom_classe_erreur="";
            this.id_type_formation_erreur="";
            this.id_unite_de_formation_erreur="";
            this.type_classe_erreur="";
            this.niveau_erreur=""


        },



    }
   }
</script>

