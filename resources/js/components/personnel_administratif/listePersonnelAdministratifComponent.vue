<template>

    <div class="affichage">
       <div class="avant">
           <h1 class="texte">Personnel Administratif</h1>
           <a href="#">
               <button class="texte ajout mdl" id="openModal" > <i class="fi fi-rr-plus"></i><span>Ajouter</span></button>
           </a>
       </div>


   <div class="sections" v-for="(personnel_administratif, index) in personnel_administratifs" :key="index">
           <!-- Répéter la div utilisateur pour un autre utilisateur -->
           <div class="utilisateur">
               <img src="" alt="Etu" class="petite">
               <p class="texte" id="n">{{ personnel_administratif.intitule}} </p>
              
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
                   <a href="#" class="texte b" @click="deletePersonnelAdmin(personnel_administratif)">
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
   name:"listePersonnelAdministratifComponent",
   data(){
       return {
           form:new Form({
               'intitule':""

           }),
           personnel_administratifs: [],


       }
   },
   mounted(){
       this.get_personnel_administratif();
       bus.on('personnelAdministratifAjoutee', () => { // Écouter l'événement de nouvelle utilisateur ajoutée
           this.get_direction(); // Mettre à jour la liste des utilisateurs
       });
   },

   methods:{
       get_personnel_administratif(){
           axios.get('/personnel_administratif/index')
           .then(response => {
               this.personnel_administratifs=response.data.personnel_administratif;

           }).catch(error=>{
           Swal.fire('Erreur!','Une erreur est survenue lors de la recuperation du personnel administratif','error')
           });
       },

       resetForm(){
           this.form.input="";
           this.form.intitule="";
       },

       async deletePersonnelAdmin(type) {
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
                   axios.delete(`/personnel_administratif/delete/${type.id}`).then(resp => {
                       this.get_personnel_administratif();

                  
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
