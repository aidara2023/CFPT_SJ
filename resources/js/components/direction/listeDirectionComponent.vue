<template>

    <div class="affichage">
       <div class="avant">
           <h1 class="texte">Direction</h1>
           <a href="#">
               <button class="texte ajout mdl" id="openModal" > <i class="fi fi-rr-plus"></i><span>Ajouter</span></button>
           </a>
       </div>


   <div class="sections" v-for="(direction, index) in directions" :key="index">
           <!-- Répéter la div utilisateur pour un autre utilisateur -->
           <div class="utilisateur">
               <img src="/assetsCFPT/image/image1.png" alt="Etu" class="petite">
               <p class="texte" id="n">{{ direction.nom_direction}} </p>
              
               <p class="texte" id="n">{{ direction.user.prenom }} {{ direction.user.nom }} </p>

               <div  class="presences">
                    <a href="#" class="texte b">
                        <i class="fi fi-rr-bars-sort"></i>
                        <span class="modifier">Actions</span>
                    </a>
                   <a href="#" class="texte b" @click="openModal(direction)">
                       <i class="fi fi-rr-edit"></i>
                       <span class="modifier mdl">Modifier</span>
                   </a>
                   <a href="" class="texte b">
                       <i class="fi fi-rr-comment-alt-dots"></i>
                       <span class="details">Détails</span>
                   </a>
                   <a href="#" class="texte b" @click="deleteDirection(direction)">
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
   name:"listeDirectionComponent",
   data(){
       return {
           form:new Form({
               'nom_direction':""

           }),
           directions: [],
           idDirection: "",
           editModal: false,


       }
   },
   mounted(){
       this.get_direction();
       bus.on('directionAjoutee', () => { // Écouter l'événement de nouvelle utilisateur ajoutée
           this.get_direction(); // Mettre à jour la liste des utilisateurs
       });
   },

   methods:{
       get_direction(){
           axios.get('/direction/index')
           .then(response => {
               this.directions=response.data.direction;

           }).catch(error=>{
           Swal.fire('Erreur!','Une erreur est survenue lors de la recuperation des directions','error')
           });
       },

       resetForm(){
           this.form.input="";
           this.form.nom_direction="";
           this.form.id_user="";
       },

       async deleteDirection(type) {
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
                   axios.delete(`/direction/delete/${type.id}`).then(resp => {
                       this.get_direction();

                  /*      Swal.fire(
                           'Supprimé!',
                           'La direction a été supprimée avec succès.',
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
       openModal(direction) {
          
          this.idDirection=direction.id;

          this.editModal = true;

          // Créez un objet avec les données à envoyer
          const eventData = {
              idDirection: this.idDirection,
              nom: direction.nom_direction,
              id_direction: direction.id_direction,
              editModal: this.editModal,
              // Ajoutez d'autres propriétés si nécessaire
          };

          bus.emit('directionModifier', eventData);

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
