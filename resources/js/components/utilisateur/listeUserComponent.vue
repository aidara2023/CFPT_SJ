<template>

    <div class="affichage">
       <div class="avant">
           <h1 class="texte">Utilisateur</h1>
           <a href="#">
               <button class="texte ajout mdl" id="openModal" > <i class="fi fi-rr-plus"></i><span>Ajouter</span></button>
           </a>
       </div>


   <div class="sections" v-for="(utilisateur, index) in utilisateurs" :key="index">
           <!-- Répéter la div utilisateur pour un autre utilisateur -->
           <div class="utilisateur">
               <img src="/assetsCFPT/image/image1.png" alt="Etu" class="petite">
               <p class="texte" id="n">{{ utilisateur.prenom }} {{ utilisateur.nom }}</p>
               <p class="texte" id="n">{{ utilisateur.email }} {{ utilisateur.telephone }}</p>
               <div  class="presences">
                    <a href="#" class="texte b">
                        <i class="fi fi-rr-bars-sort"></i>
                        <span class="modifier">Actions</span>
                    </a>
                   <a href="#" class="texte b">
                       <i class="fi fi-rr-edit"></i>
                       <span class="modifier mdl">Modifier</span>
                   </a>
                   <a href="" class="texte b">
                       <i class="fi fi-rr-comment-alt-dots"></i>
                       <span class="details">Détails</span>
                   </a>
                   <a href="#" class="texte b" @click="deleteTypeutilisateur(utilisateur)">
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
   name:"listeUserCompenent",
   data(){
       return {
           form:new Form({
               'intitule':""

           }),
           utilisateurs: [],


       }
   },
   mounted(){
       this.get_utilisateur();
       bus.on('utilisateurAjoutee', () => { // Écouter l'événement de nouvelle utilisateur ajoutée
           this.get_utilisateur(); // Mettre à jour la liste des utilisateurs
       });
   },

   methods:{
       get_utilisateur(){
           axios.get('/user/getPersonnel')
           .then(response => {
               this.utilisateurs=response.data.user


           }).catch(error=>{
           Swal.fire('Erreur!','Une erreur est survenue lors de la recupération des utilisateurs','error')
           });
       },

       changement(event){
           this.interesser= event;
       },

       resetForm(){
           this.form.input="";
           this.form.intitule="";
       },

       async deleteTypeutilisateur(type) {
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
                   axios.delete(`/user/delete/${type.id}`).then(resp => {
                       this.get_utilisateur();

                    var confirmation = document.querySelector('[data-modal-confirmation-sup]');

                    confirmation.style.backgroundColor = 'white';
                    confirmation.style.color = 'var(--clr)';

                        confirmation.showModal();
                        confirmation.classList.add("actif");
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



   }
}
</script>
