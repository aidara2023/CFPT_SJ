<template>

    <div class="affichage">
       <div class="avant">
           <h1 class="texte">Salle</h1>
           <a href="#">
               <button class="texte ajout mdl" > <i class="fi fi-rr-plus"></i><span>Ajouter</span></button>
           </a>
       </div>


   <div class="sections" v-for="(salle, index) in salles" :key="index">
           <!-- Répéter la div utilisateur pour un autre utilisateur -->
           <div class="utilisateur">
               <!-- <img src="/assetsCFPT/image/image1.png" alt="Etu" class="petite"> -->
               <p class="texte" id="n">{{ salle.intitule }}</p>
               <p class="texte" id="n">{{ salle.nombre_place }} </p>
               <p class="texte" id="n" v-if="salle.batiment.intitule">{{ salle.batiment.intitule}}</p>
               <div  class="presences">
                    <a href="#" class="texte b">
                        <i class="fi fi-rr-bars-sort"></i>
                        <span class="modifier">Actions</span>

                    </a>
                   <a href="#" class="texte b" @click="openModal(salle)">
                       <i class="fi fi-rr-edit"></i>
                       <span class="modifier mdl">Modifier</span>
                   </a>
                   <a href="#" class="texte b">
                       <i class="fi fi-rr-comment-alt-dots"></i>
                       <span class="details">Détails</span>
                   </a>
                   <a href="#" class="texte b" @click="deleteSalle(salle)" > 
                       <i class="fi fi-rr-cross"></i>
                       <span class="supprimer mdl">Supprimer</span>
                   </a>
                   <!-- <a href="#" class="texte b supprimer mdl">
                         <i class="fi fi-rr-cross"></i>
                         <span class="">Supprimer</span></a> -->
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
   name:"listeUserCompenent",
   data(){
       return {
           form:new Form({
               'intitule':"",
               'nombre_place':"",
               'id_batiment':"",

           }),
           salles: [],
           editModal: false,
           idSalle: "",


       }
   },
   mounted(){
       this.get_salle();
       bus.on('salleAjoutee', () => { // Écouter l'événement de nouvelle utilisateur ajoutée
           this.get_salle(); // Mettre à jour la liste des utilisateurs
       });
   },

   methods:{
       get_salle(){
           axios.get('/salle/index')
           .then(response => {
               this.salles=response.data.salle


           }).catch(error=>{
           Swal.fire('Erreur!','Une erreur est survenue lors de la recuperation des salles','error')
           });
       },

       changement(event){
           this.interesser= event;
       },

       resetForm(){
           this.form.input="";
           this.form.intitule="";
       },

       async deleteSalle(type) {
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
                   axios.delete(`/salle/delete/${type.id}`).then(resp => {
                       this.get_salle();

                   /*     Swal.fire(
                           'Supprimé!',
                           'Le salle a été supprimé avec succès.',
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
       openModal(salle) {
          
          this.idSalle=salle.id;

          this.editModal = true;

          // Créez un objet avec les données à envoyer
          const eventData = {
              idSalle: this.idSalle,
              nom: salle.intitule,
              nombre_place: salle.nombre_place,
              id_batiment: salle.id_batiment,
              editModal: this.editModal,
              // Ajoutez d'autres propriétés si nécessaire
          };

          bus.emit('salleModifier', eventData);

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
