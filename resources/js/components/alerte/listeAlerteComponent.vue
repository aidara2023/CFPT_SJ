<template>

    <div class="affichage">
       <!-- <div class="avant">
           <h1 class="texte">Alerte</h1>
           <a href="#">
               <button class="texte ajout mdl" id="openModal" > <i class="fi fi-rr-plus"></i><span>Ajouter</span></button>
           </a>
       </div> -->


   <div class="sections" v-for="(alerte, index) in alertes" :key="index">
           <!-- Répéter la div utilisateur pour un autre utilisateur -->
           <div class="utilisateur">
               <p class="texte" id="n">{{ alerte.titre }} {{ alerte.message }} {{ alerte.statut }}</p>
             
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
                   <a href="#" class="texte b" @click="deleteAlerte(alerte)">
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
   name:"listeAlerteComponent",
   data(){
       return {
           form:new Form({
               'titre':"",
               'message':"",
               'statut':""

           }),
           alertes:[]
           


       }
   },
   mounted(){
       this.get_alerte();
       bus.on('alerteAjoutee', () => { // Écouter l'événement de nouvelle utilisateur ajoutée
           this.get_alerte(); // Mettre à jour la liste des utilisateurs
       });
   },

   methods:{
       get_alerte(){
           axios.get('/alerte/index')
           .then(response => {
               this.alertes=response.data.alerte


           }).catch(error=>{
           Swal.fire('Erreur!','Une erreur est survenue lors de la recuperation des classes','error')
           });
       },

       changement(event){
           this.interesser= event;
       },

       resetForm(){
           this.form.input="";
           this.form.titre="";
           this.form.message="";
           this.form.statut="";
       },

       async deleteAlerte(type) {
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
                   axios.delete(`/alerte/delete/${type.id}`).then(resp => {
                       this.get_batiment();

                       Swal.fire(
                           'Supprimé!',
                           'Le message d alerte a été supprimé avec succès.',
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
