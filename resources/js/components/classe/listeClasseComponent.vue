<template>

    <div class="liste">
      <!--  <div class="avant" style=" margin-left: 80%;">
          
           <a href="#">
               <button class="texte ajout mdl" id="openModal" > <i class="fi fi-rr-plus"></i><span>Ajouter</span></button>
           </a>
       </div>
       <h1 class="texte">Classe</h1>

   <div class="sections" v-for="(classe, index) in classes" :key="index">
          
           <div class="utilisateur">
              
               <p class="texte" id="n">{{ classe.type_formation_intitule }} {{ classe.nom_classe }} {{ classe.niveau }} {{ classe.type_classe }} </p>
               <p class="texte" id="n">{{ classe.type_formation.intitule }} {{ classe.unite_de_formation.nom_unite_formation }}</p>
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
                   <a href="#" class="texte b" @click="deleteClasse(classe)">
                       <i class="fi fi-rr-cross"></i>
                       <span class="supprimer mdl">Supprimer</span>
                   </a>
               </div>
           </div>
       </div>
 -->
 <div class="table-container">
            <table>
                <thead>
                    <th>Type de Formation</th>
                    <th>Nom</th>
                    <th>Niveau</th>
                    <th>Type Classe</th>
                    <th>Filiere</th>
                    <th>Actions</th>
                </thead>
                <tbody v-for="(classe, index) in classes" :key="index" :class="{ 'odd-row': index % 2 === 0 }">
                    <tr>
                        <td><span>{{ classe.type_formation.intitule }} </span></td>
                        <td><span> {{ classe.nom_classe }}  </span></td>
                        <td><span> {{ classe.niveau }} </span></td>
                        <td> <span>{{ classe.type_classe }}</span></td>
                        <td><span>{{ classe.unite_de_formation.nom_unite_formation }}</span></td>
                        <td>
                            <div class="boutons_actions">
                                <i class="fi fi-rr-edit modifier mdl" @click="openModal(classe)" title="Modifier"></i>
                                <i class="fi fi-rr-comment-alt-dots details mdl" title="Détails"></i>
                                <i class="fi fi-rr-trash supprimer mdl" @click="deleteClasse(classe)"
                                    title="Supprimer"></i>
                            </div>
                        </td>

                    </tr>

                </tbody>
            </table>
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
           classes: [],


       }
   },
   mounted(){
       this.get_classe();
       bus.on('classeAjoutee', () => { // Écouter l'événement de nouvelle utilisateur ajoutée
           this.get_classe(); // Mettre à jour la liste des utilisateurs
       });
   },

   methods:{
       get_classe(){
           axios.get('/classe/all')
           .then(response => {
               this.classes=response.data.classe


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

       async deleteClasse(type) {
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
                   axios.delete(`/classe/delete/${type.id}`).then(resp => {
                       this.get_classe();

                       /* Swal.fire(
                           'Supprimé!',
                           'La classe a été supprimé avec succès.',
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
