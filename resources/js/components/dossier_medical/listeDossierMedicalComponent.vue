<template>

    <div class="affichage">
       <div class="avant">
           <h1 class="texte">dossier_medical</h1>
           <a href="#">
               <button class="texte ajout mdl" > <i class="fi fi-rr-plus"></i><span>Ajouter</span></button>
           </a>
       </div>


        <div class="sections" v-for="(dossier_medical, index) in dossier_medicals" :key="index">
           <!-- Répéter la div utilisateur pour un autre utilisateur -->
           <div class="utilisateur">
               <!-- <img src="/assetsCFPT/image/image1.png" alt="Etu" class="petite"> -->
               <p class="texte" id="n">{{ dossier_medical.nom_dossier_medical }} </p>
               <p class="texte" id="n">{{ dossier_medical.user.nom }}</p>
               <div  class="presences">
                    <a href="#" class="texte b">
                        <i class="fi fi-rr-bars-sort"></i>
                        <span class="modifier">Actions</span>

                    </a>
                   <a href="#" class="texte b" @click="openModal(dossier_medical)">
                       <i class="fi fi-rr-edit"></i>
                       <span class="modifier mdl">Modifier</span>
                   </a>
                   <a href="#" class="texte b">
                       <i class="fi fi-rr-comment-alt-dots"></i>
                       <span class="details">Détails</span>
                   </a>
                   <a href="#" class="texte b" @click="deletedossier_medical(dossier_medical)" >
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
               'nom_dossier_medical':"",
               'id_user':"",
               'id_direction':""

           }),
           dossier_medicals: [],
           editModal: false,
           iddossier_medical: "",
       }
   },
   mounted(){
       this.get_dossier_medical();
       bus.on('dossier_medicalAjoutee', () => { // Écouter l'événement de nouvelle utilisateur ajoutée
           this.get_dossier_medical(); // Mettre à jour la liste des utilisateurs
       });
   },

methods:{       
       get_dossier_medical(){
           axios.get('/dossier_medical/index')
           .then(response => {
               this.dossier_medicals=response.data.dossier_medical


           }).catch(error=>{
           Swal.fire('Erreur!','Une erreur est survenue lors de la recuperation des dossier_medicals','error')
           });
       },

       changement(event){
           this.interesser= event;
       },

       resetForm(){
           this.form.input="";
           this.form.nom_dossier_medical="";
       },

       async deletedossier_medical(type) {
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
                   axios.delete(`/dossier_medical/delete/${type.id}`).then(resp => {
                       this.get_dossier_medical();

                   /*     Swal.fire(
                           'Supprimé!',
                           'Le dossier_medical a été supprimé avec succès.',
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
       openModal(dossier_medical) {
          
          this.iddossier_medical=dossier_medical.id;

          this.editModal = true;

          // Créez un objet avec les données à envoyer
          const eventData = {
              iddossier_medical: this.iddossier_medical,
              nom: dossier_medical.nom_dossier_medical,
              id_user: dossier_medical.id_user,
              id_direction: dossier_medical.id_direction,
              editModal: this.editModal,
              // Ajoutez d'autres propriétés si nécessaire
          };

          bus.emit('dossier_medicalModifier', eventData);

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
