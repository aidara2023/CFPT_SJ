<template>

    <div class="liste table-container">
      <!--  <div class="avant" style=" margin-left: 80%;">
          
           <a href="#">
               <button class="texte ajout mdl" > <i class="fi fi-rr-plus"></i><span>Ajouter</span></button>
           </a>
       </div>
       <h1 class="texte">Département</h1>

   <div class="sections" v-for="(departement, index) in departements" :key="index">
          
           <div class="utilisateur">
               <p class="texte" id="n">{{ departement.nom_departement }} </p>
               <p class="texte" id="n">{{ departement.direction.nom_direction }}</p>
               <p class="texte" id="n">{{ departement.user.nom }} {{ departement.user.prenom }}</p>
               <div  class="presences">
                    <a href="#" class="texte b">
                        <i class="fi fi-rr-bars-sort"></i>
                        <span class="modifier">Actions</span>

                    </a>
                   <a href="#" class="texte b" @click="openModal(departement)">
                       <i class="fi fi-rr-edit"></i>
                       <span class="modifier mdl" >Modifier</span>
                   </a>
                   <a href="" class="texte b">
                       <i class="fi fi-rr-comment-alt-dots"></i>
                       <span class="details">Détails</span>
                   </a>
                   <a href="#" class="texte b" @click="deleteDepartement(departement)">
                       <i class="fi fi-rr-cross"></i>
                       <span class="supprimer mdl">Supprimer</span>
                   </a>
               </div>
           </div>
       </div> -->
       <table>
            <thead>
                <th>Département</th>
                <th>Direction</th>
                <th>Chef de département</th>
                <th>Actions</th>
            </thead>
            <tbody v-for="(departement, index) in departements" :key="index">
                <td><span>{{ departement.nom_departement }}</span></td>
                <td> <span>{{ departement.direction.nom_direction }}</span></td>
                <td><span>{{ departement.user.prenom }} {{ departement.user.nom }}</span></td>
                <td>
                    <div class="boutons_actions">
                        <i class="fi fi-rr-edit modifier mdl" @click="openModal(departement)" title="Modifier"></i>
                        <i class="fi fi-rr-comment-alt-dots details mdl" title="Détails"></i>
                        <i class="fi fi-rr-trash supprimer mdl" @click="deleteDepartement(departement)" title="Supprimer"></i>
                    </div>
                </td>

            </tbody>
        </table>


   </div>



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
                'nom':"",
                'id_direction':"",
                'id_user':""
            }),
           departements: [],
           idDepartement: "",
           editModal: false,


       }
   },
   mounted(){
       this.get_departement();
       bus.on('departementAjoutee', () => { 
           this.get_departement(); 
       });
   },

   methods:{
       get_departement(){
           axios.get('/departement/all')
           .then(response => {
               this.departements=response.data.departement


           }).catch(error=>{
           Swal.fire('Erreur!','Une erreur est survenue lors de la recuperation des departements','error')
           });
       },

       changement(event){
           this.interesser= event;
       },

       resetForm(){
           this.form.nom="";
           this.form.id_direction="";
           this.form.id_user="";
       },

       async deleteDepartement(type) {
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
                   axios.delete(`/departement/delete/${type.id}`).then(resp => {
                       this.get_departement();
                    var confirmation = document.querySelector('[data-modal-suppression]');

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

        openModal(departement) {
          
            this.idDepartement=departement.id;

            this.editModal = true;

            // Créez un objet avec les données à envoyer
            const eventData = {
                idDepartement: this.idDepartement,
                nom: departement.nom_departement,
                id_direction: departement.id_direction,
                id_user: departement.id_user,
                editModal: this.editModal,
                // Ajoutez d'autres propriétés si nécessaire
            };

            bus.emit('departementModifier', eventData);

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