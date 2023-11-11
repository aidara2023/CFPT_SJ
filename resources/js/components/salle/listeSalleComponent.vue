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
               <p class="texte" id="n">{{ salle.nom_salle }} </p>
               <p class="texte" id="n">{{ salle.batiment.nom_batiment }}</p>
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
                   <a href="#" class="texte b" @click="deleteSalle(salle)">
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
   name:"listeSalleCompenent",
   data(){
       return {
           form:new Form({
               'intitule':""
              

           }),
           salles: [],


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
           axios.get('/salle/all')
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
                       this.get_dsalle();

                       Swal.fire(
                           'Supprimé!',
                           'La salle a été supprimée avec succès.',
                           'success',
                       )
                   }).catch(function (error) {
                       console.log(error);
                   })
               }
           });
       },



   }
}
</script>
