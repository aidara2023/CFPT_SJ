<template>
<dialog data-modal-ajout class="modal">

    <div class="titres">
        <h1>Ajout Auteur</h1>
    <!--  <h3>Informations Personnelles</h3> -->
    </div>

    <form @submit.prevent="validerAvantAjout()" action="" method="dialog" >
        <div class="informations">
            <div class="titres">
                <h1>Ajout Auteur</h1>
            </div>           
           
            <div class="champ">
                <label for="nom" :class="{ 'couleur_rouge': (this.nom_auteur_erreur)} ">Nom Auteur</label>
                <input  v-model="form.nom" id="nom"  @input="validatedata('nom_auteur')" type="text" name="nom" :class="{ 'bordure_rouge': (this.nom_auteur_erreur)} ">
                <span class="erreur" >{{this.nom_auteur_erreur}}</span>
            </div>     

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
import axios from 'axios';
import Form from 'vform';

   export default {
    name:"createAuteurCompenent",
    data(){
        return {
            filieres:[],
            form:new Form({
                'nom':"",
               
            }),
            nom_auteur_erreur:"",
            etatForm:false,
            editModal:false,
            idAuteur:""
        }
    },
    mounted(){
       
       this.get_user();
       bus.on('ateurModifier', (eventData) => {
           this.idAteur = eventData.idAteur;
           this.editModal = eventData.editModal;
           this.form.nom_Ateur = eventData.nom;
       });
   },

    methods:{
        async soumettre(){
            const formdata = new FormData();
            formdata.append('nom_auteur', this.form.nom  );
        
            try{
                const create_store=await axios.post('/auteur/store', formdata);

                this.resetForm();
                bus.emit('auteurAjoutee');

                 } 
                 catch(e){

                /* console.log(e.request.status) */
                if(e.request.status===404){
                    Swal.fire('Erreur !','Cette auteur existe déjà','error')
                }
                else{
                    Swal.fire('Erreur !','Une erreur est survenue lors de l\'enregistrement','error')
                }
            }
        },
        verifCaratere(nom){
            const valeur= /^[a-zA-ZÀ-ÿ\s]*$/;
            return valeur.test(nom);
        },

        resetForm(){
            this.form.nom="";
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
            this.editModal=false;

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

     


    }
   }
</script>
x
