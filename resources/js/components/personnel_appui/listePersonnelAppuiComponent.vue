<template>

    <div class="affichage">
       <div class="avant">
           <h1 class="texte">Personnel Appui</h1>
           <a href="#">
               <button class="texte ajout mdl" id="openModal" > <i class="fi fi-rr-plus"></i><span>Ajouter</span></button>
           </a>
       </div>


   <div class="sections" v-for="(personnel_appui, index) in personnel_appuis" :key="index">
           <!-- Répéter la div utilisateur pour un autre utilisateur -->
           <div class="utilisateur">
               <img src="" alt="Etu" class="petite">
               <p class="texte" id="n">{{ personnel_appui.intitule}} </p>
              
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
                   <a href="#" class="texte b" @click="deletePersonnelAppui(personnel_appui)">
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
   name:"listePersonnelAppuiComponent",
   data(){
       return {
           form:new Form({
               'intitule':""

           }),
           personnel_appuis: [],


       }
   },
   mounted(){
       this.get_personnel_appui();
       bus.on('personnelAppuiAjoutee', () => { // Écouter l'événement de nouvelle utilisateur ajoutée
           this.get_personnel_appui(); // Mettre à jour la liste des utilisateurs
       });
   },

   methods:{
       get_personnel_appui(){
           axios.get('/personnel_appui/index')
           .then(response => {
               this.personnel_appuis=response.data.personnel_appui;

           }).catch(error=>{
           Swal.fire('Erreur!','Une erreur est survenue lors de la recuperation du personnel appui','error')
           });
       },

       resetForm(){
           this.form.input="";
           this.form.intitule="";
       },

       async deletePersonnelAppui(type) {
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
                   axios.delete(`/personnel_appui/delete/${type.id}`).then(resp => {
                       this.get_personnel_appui();

                  
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



   }
}
</script>
