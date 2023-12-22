<template>

    <div class="affichage">
       <div class="avant" style=" margin-left: 80%;">
        
           <a href="#">
               <button class="texte ajout mdl" id="openModal" > <i class="fi fi-rr-plus"></i><span>Ajouter</span></button>
           </a>
       </div>
       <h1 class="texte">Auteur</h1>

   <div class="sections" v-for="(auteur, index) in auteurs" :key="index">
           <!-- Répéter la div utilisateur pour un autre utilisateur -->
           <div class="utilisateur">
               <p class="texte" id="n">{{ auteur.nom_auteur}} </p>
              

               <div  class="presences">
                    <a href="#" class="texte b">
                        <i class="fi fi-rr-bars-sort"></i>
                        <span class="modifier">Actions</span>
                    </a>
                   <a href="#" class="texte b" @click="openModal(auteur)">
                       <i class="fi fi-rr-edit"></i>
                       <span class="modifier mdl">Modifier</span>
                   </a>
                   <a href="" class="texte b">
                       <i class="fi fi-rr-comment-alt-dots"></i>
                       <span class="details">Détails</span>
                   </a>
                   <a href="#" class="texte b" @click="deleteAuteur(auteur)">
                       <i class="fi fi-rr-cross"></i>
                       <span class="supprimer mdl">Supprimer</span>
                   </a>
               </div>
           </div>
       </div>
   </div>


<!-- <span class="fond "></span> -->

</template>

<script>
import bus from '../../eventBus';
import axios from 'axios';
import Form from 'vform';



  export default {
   name:"listeAuteurComponent",
   data(){
       return {
           form:new Form({
               'nom_auteur':""

           }),
           auteurs: [],
           idAuteur: "",
           editModal: false,


       }
   },
   mounted(){
       this.get_auteur();
       bus.on('auteurAjoutee', () => { // Écouter l'événement de nouvelle utilisateur ajoutée
           this.get_auteur(); // Mettre à jour la liste des utilisateurs
       });
   },

   methods:{
       get_auteur(){
           axios.get('/auteur/index')
           .then(response => {
               this.auteurs=response.data.auteur;

           }).catch(error=>{
           Swal.fire('Erreur!','Une erreur est survenue lors de la recuperation des auteurs','error')
           });
       },

       resetForm(){
           this.form.input="";
           this.form.nom_auteur="";
          
       },

       async deleteAuteur(type) {
           Swal.fire({
               title: 'Êtes-vous sûr?',
               text: "Cette action sera irréversible!",
               icon: 'warning',
               showCancelButton: true,
               confirmButtonColor: '#3085d6',
               cancelButtonColor: '#d33',
               confirmButtonText: 'Oui, supprimer!',
               cancelButtonText: 'Annuler'
           }).then((result) => {
               if (result.isConfirmed) {
                   axios.delete(`/auteur/delete/${type.id}`).then(resp => {
                       this.get_auteur();

                  /*      Swal.fire(
                           'Supprimé!',
                           'La auteur a été supprimée avec succès.',
                           'success',
                       ) */

                       var confirmation = document.querySelector('[data-modal-confirmation-sup]');

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

                        }, 2000);
                   }).catch(function (error) {
                       console.log(error);
                   })
               }
           });
       },
       openModal(auteur) {
          
          this.idAuteur=auteur.id;

          this.editModal = true;

          // Créez un objet avec les données à envoyer
          const eventData = {
              idAuteur: this.idAuteur,
              nom: auteur.nom_auteur,
              editModal: this.editModal,
              // Ajoutez d'autres propriétés si nécessaire
          };

          bus.emit('auteurModifier', eventData);

          var fond = document.querySelector('.fond');
          var flou = document.querySelectorAll('.flou');
          var modification = document.querySelector("[data-modal-ajout]");

          flou.forEach(item => {
              item.classList.add("actif");
          });

          fond.classList.add("actif");
          modification.showModal();
          modification.classList.add("actif");

       
      },



   }
}
</script>
