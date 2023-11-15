<template>

    <div class="affichage">
       <div class="avant">
           <h1 class="texte">Departement</h1>
           <a href="#">
               <button class="texte ajout mdl" > <i class="fi fi-rr-plus"></i><span>Ajouter</span></button>
           </a>
       </div>


   <div class="sections" v-for="(departement, index) in departements" :key="index">
           <!-- Répéter la div utilisateur pour un autre utilisateur -->
           <div class="utilisateur">
               <!-- <img src="/assetsCFPT/image/image1.png" alt="Etu" class="petite"> -->
               <p class="texte" id="n">{{ departement.nom_departement }} </p>
               <p class="texte" id="n">{{ departement.direction.nom_direction }}</p>
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
       </div>



   </div>


<!-- <span class="fond "></span> -->
<dialog data-modal-modification class="modal">
        <h1>Modification</h1>
        <div class="contenu">
            <form action="" method="dialog" >
                <h1 class="sous_titre">Ajout de departement</h1>

            <div class="personnel">
                <div>
                    <input type="text" v-model="form.nom" id="nom"  @input="validatedata()">
                    <span class="erreur" v-if="this.nom_departement_erreur !== ''">{{this.nom_departement_erreur}}</span>
                </div>
            </div>

            <div class="directions">
                <div>
                    <select name="direction" id="direction" v-model="form.id_direction"  @change="verifIdDirection()" >
                        <option value=""> Direction</option>
                        <option v-for="direction in directions" :value="direction.id">{{ direction.nom_direction }} </option>
                    </select>
                    <span class="erreur" v-if="id_direction_erreur !== ''">{{id_direction_erreur}}</span>
                </div>
            </div>


            <div class="boutons">
                <input  type="submit" value="Ajouter" :class="{ 'data-close-modaldep': (this.etatForm) } "> 
                <button type="button" class="texte annuler data-close-modal" >Annuler</button>
            </div>
            </form>                                                                                                                                                                                                                                                                                                                                   
        </div>
    </dialog>
   <!--  {{--  Fin modal pour modifier utilisateur --}} -->

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
                'id_direction':""
            }),
           departements: [],


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

                    //    Swal.fire(
                    //        'Supprimé!',
                    //        'Le departement a été supprimé avec succès.',
                    //        'success',
                    //    )
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

        openModal(departement) {
            this.form.nom=departement.nom_departement;
            this.form.id_direction=departement.id_direction;

            var fond = document.querySelector('.fond');
            var flou = document.querySelectorAll('.flou');
            var modification = document.querySelector("[data-modal-modification]");

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