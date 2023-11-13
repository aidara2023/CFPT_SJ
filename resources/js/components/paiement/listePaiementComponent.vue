<template>

    <div class="affichage">
       <div class="avant">
           <h1 class="texte">Paiement</h1>
           <a href="#">
               <button class="texte ajout mdl" > <i class="fi fi-rr-plus"></i><span>Ajouter</span></button>
           </a>
       </div>

        <div class="sections" v-for="(paiement, index) in paiements" :key="index">
           <!-- Répéter la div utilisateur pour un autre utilisateur -->
            <div class="utilisateur">
               <!-- <img src="/assetsCFPT/image/image1.png" alt="Etu" class="petite"> -->
               <p class="texte" id="n">{{ paiement.eleve.user.nom }} {{ paiement.eleve.user.prenom }} </p>
               <p class="texte" id="n" v-if="paiement.annee_academique">{{ paiement.eleve.inscription.classe }} {{ paiement.annee_academique.id}} </p>
              <!--  <p class="texte" id="n">{{ paiement.user.nom }}</p> -->
                <div  class="presences">
                    <a href="#" class="texte b">
                        <i class="fi fi-rr-bars-sort"></i>
                        <span class="modifier">Actions</span>

                    </a>
                   <a href="#" class="texte b">
                       <i class="fi fi-rr-edit"></i>
                       <span class="modifier mdl">Modifier</span>
                   </a>
                   <a href="#" class="texte b">
                       <i class="fi fi-rr-comment-alt-dots"></i>
                       <span class="details">Détails</span>
                   </a>
                   <a href="#" class="texte b" @click="deletepaiement(paiement)" >
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
               'nom_paiement':""

           }),
           paiements: [],


       }
   },
   mounted(){
       this.get_paiement();
       bus.on('paiementAjoutee', () => { // Écouter l'événement de nouvelle utilisateur ajoutée
           this.get_paiement(); // Mettre à jour la liste des utilisateurs
       });
   },

   methods:{
       get_paiement(){
           axios.get('/paiement/index')
           .then(response => {
               this.paiements=response.data.paiement
               console.log( this.paiements);


           }).catch(error=>{
           Swal.fire('Erreur!','Une erreur est survenue lors de la recuperation des paiements','error')
           });
       },

       changement(event){
           this.interesser= event;
       },

       resetForm(){
           this.form.input="";
           this.form.nom_paiement="";
       },

       async deletepaiement(type) {
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
                   axios.delete(`/paiement/delete/${type.id}`).then(resp => {
                       this.get_paiement();

                   /*     Swal.fire(
                           'Supprimé!',
                           'Le paiement a été supprimé avec succès.',
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



   }
}
</script>