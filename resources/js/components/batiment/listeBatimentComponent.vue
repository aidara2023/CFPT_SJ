<template>

    <div class="affichage">
       <div class="avant">
           <h1 class="texte">Batiment</h1>
           <a href="#">
               <button class="texte ajout mdl" id="openModal" > <i class="fi fi-rr-plus"></i><span>Ajouter</span></button>
           </a>
       </div>


   <div class="sections" v-for="(batiment, index) in batiments" :key="index">
           <!-- Répéter la div utilisateur pour un autre utilisateur -->
           <div class="utilisateur">
               <img src="/assetsCFPT/image/image1.png" alt="Etu" class="petite">
               <p class="texte" id="n">{{ batiment.intitule }} </p>
<!--                <p class="texte" id="n">{{ classe.type_formation.intitule }} {{ classe.unite_de_formation.nom_unite_formation }}</p>
 -->               
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
                   <a href="#" class="texte b" @click="deleteBatiment(batiment)">
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
   name:"listeBatimentComponent",
   data(){
       return {
           form:new Form({
               'intitule':""

           }),
           classes: [],


       }
   },
   mounted(){
       this.get_batiment();
       bus.on('batimentAjoutee', () => { // Écouter l'événement de nouvelle utilisateur ajoutée
           this.get_batiment(); // Mettre à jour la liste des utilisateurs
       });
   },

   methods:{
       get_batiment(){
           axios.get('/batiment/index')
           .then(response => {
               this.batiments=response.data.batiment


           }).catch(error=>{
           Swal.fire('Erreur!','Une erreur est survenue lors de la recuperation des classes','error')
           });
       },

       changement(event){
           this.interesser= event;
       },

       resetForm(){
           this.form.input="";
           this.form.intitule="";
       },

       async deleteBatiment(type) {
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
                   axios.delete(`/batiment/delete/${type.id}`).then(resp => {
                       this.get_batiment();

                       Swal.fire(
                           'Supprimé!',
                           'Le batiment a été supprimé avec succès.',
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
