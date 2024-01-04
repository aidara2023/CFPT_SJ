<template>
    <div class="liste">
        <!--   <div class="avant" style=" margin-left: 80%;">
          
           <a href="#">
               <button class="texte ajout mdl" id="openModal" > <i class="fi fi-rr-plus"></i><span>Ajouter</span></button>
           </a>
       </div>
       <div class="avant">
           <h1 class="texte">Inscription Non Payé</h1>
           <a href="#">
              
           </a>
       </div>



        <div class="sections" v-for="(inscription, index) in inscriptions" :key="index">
          
           <div class="utilisateur" v-if="inscription.statut===0">
               <img src="/assetsCFPT/image/image1.png" alt="Etu" class="petite">
               <p class="texte" id="n">{{ inscription.eleve.user.prenom}} {{ inscription.eleve.user.nom }} </p>
               <p class="texte" id="n"> {{ inscription.classe.type_formation.intitule }} {{ inscription.classe.nom_classe}} {{ inscription.classe.niveau }} {{ inscription.classe.type_classe }}</p>
               <p class="texte" id="n">{{ inscription.annee_academique.intitule }}</p>
               <div  class="presences">
                   <a href="#" class="texte b">
                       <i class="fi fi-rr-edit"></i>
                       <span class="modifier mdl">Modifier</span>
                   </a>
                   <a href="" class="texte b">
                       <i class="fi fi-rr-comment-alt-dots"></i>
                       <span class="details">Détails</span>
                   </a>
                   <a href="#" class="texte b" @click="deleteDirection(inscription)">
                       <i class="fi fi-rr-cross"></i>
                       <span class="supprimer mdl">Supprimer</span>
                   </a>
               </div>
           </div>
       </div>

       <div class="avant">
           <h1 class="texte">Inscription valide</h1>
           <a href="#">
              
           </a>
       </div>


        <div class="sections" v-for="(inscription, index) in inscriptions" :key="index">
          
           <div class="utilisateur" v-if="inscription.statut===1">
               <img src="/assetsCFPT/image/image1.png" alt="Etu" class="petite">
               <p class="texte" id="n">{{ inscription.eleve.user.prenom}} {{ inscription.eleve.user.nom }}  </p>
               <p class="texte" id="n">  {{ inscription.classe.type_formation.intitule }} {{ inscription.classe.nom_classe}} {{ inscription.classe.niveau }} {{ inscription.classe.type_classe }}</p>
               <p class="texte" id="n">{{ inscription.annee_academique.intitule }}</p>
               <div  class="presences">
                   <a href="#" class="texte b">
                       <i class="fi fi-rr-edit"></i>
                       <span class="modifier mdl">Modifier</span>
                   </a>
                   <a href="" class="texte b">
                       <i class="fi fi-rr-comment-alt-dots"></i>
                       <span class="details">Détails</span>
                   </a>
                   <a href="#" class="texte b" @click="deleteDirection(inscription)">
                       <i class="fi fi-rr-cross"></i>
                       <span class="supprimer mdl">Supprimer</span>
                   </a>
               </div>
           </div>
       </div> -->
       <div class="avant">
           <h1 class="texte">Inscription Non Payé</h1>
           <a href="#">
              
           </a>
       </div>

        <div class="table-container">
            <table>
                <thead>
                    <th>Photo</th>
                    <th>Matricule</th>
                    <th>Nom Complet</th>
                    <th>Date et Lieu de Naissance</th>
                    <th>Classe</th>
                    <th>Année Académique</th>
                    <th>Actions</th>
                </thead>
                <tbody>


                    <tr v-for="(inscription, index) in inscriptions" :key="index">
                         <template class="utilisateur" v-if="inscription.statut === 0"> 
                            <td><span><img :src="getImageUrl(inscription.eleve.user.photo)" alt="Etu"
                                        style="width: 30px; height: 30px;"></span> </td>
                                        <td><span>{{ inscription.eleve.user.matricule }}</span></td>
                            <td><span>{{ inscription.eleve.user.prenom }} {{ inscription.eleve.user.nom }}</span></td>
                            <td><span>{{ inscription.eleve.user.date_naissance}} {{ inscription.eleve.user.lieu_naissance }}</span></td>
                            <td> <span>{{ inscription.classe.type_formation.intitule }} {{ inscription.classe.nom_classe }}
                                    {{ inscription.classe.niveau }} {{ inscription.classe.type_classe }}</span></td>
                            <td><span>{{ inscription.annee_academique.intitule }}</span></td>
                            <td>
                                <div class="boutons_actions">
                                    <i class="fi fi-rr-edit modifier mdl" @click="openModal(inscription)" title="Modifier"></i>
                                    <i class="fi fi-rr-comment-alt-dots details mdl" title="Détails"></i>
                                    <i class="fi fi-rr-trash supprimer mdl" @click="deleteInscription(inscription)"
                                        title="Supprimer"></i>
                                </div>
                            </td>

                        </template> 

                    </tr>

                </tbody>
            </table>
        </div>

        <div class="avant">
           <h1 class="texte">Inscription valide</h1>
           <a href="#">
              
           </a>
       </div>

        <div class="table-container">
            <table>
                <thead>
                    <th>Photo</th>
                    <th>Matricule</th>
                    <th>Nom Complet</th>
                    <th>Date et Lieu de Naissance</th>
                    <th>Classe</th>
                    <th>Année Académique</th>
                    <th>Actions</th>
                </thead>
                <tbody>

                    <tr v-for="(inscription, index) in inscriptions" :key="index">
                        <template class="utilisateur" v-if="inscription.statut === 1">
                            <td><span><img :src="getImageUrl(inscription.eleve.user.photo)" alt="Etu"
                                        style="width: 30px; height: 30px;"></span> </td>
                                        <td><span>{{ inscription.eleve.user.matricule }}</span></td>
                            <td><span>{{ inscription.eleve.user.prenom }} {{ inscription.eleve.user.nom }}</span></td>
                            <td><span>{{ inscription.eleve.user.date_naissance}} {{ inscription.eleve.user.lieu_naissance }}</span></td>
                            <td> <span>{{ inscription.classe.type_formation.intitule }} {{ inscription.classe.nom_classe }}
                                    {{ inscription.classe.niveau }} {{ inscription.classe.type_classe }}</span></td>
                            <td><span>{{ inscription.annee_academique.intitule }}</span></td>
                            <td>
                                <div class="boutons_actions">
                                    <i class="fi fi-rr-edit modifier mdl" @click="openModal(inscription)" title="Modifier"></i>
                                    <i class="fi fi-rr-comment-alt-dots details mdl" title="Détails"></i>
                                    <i class="fi fi-rr-trash supprimer mdl" @click="deleteInscription(inscription)"
                                        title="Supprimer"></i>
                                </div>
                            </td>

                        </template>
                        
                    </tr>

                </tbody>
            </table>
        </div>
    </div>

</template>
<!-- <span class="fond "></span> -->

<script>
import bus from '../../eventBus';
import axios from 'axios';
import Form from 'vform';



export default {
    name: "listeInscriptionCompenent",
    data() {
        return {
            form: new Form({
                'intitule': ""

            }),
            inscriptions: [],


        }
    },
    mounted() {
        this.get_inscription();
        bus.on('inscriptionAjoutee', () => { // Écouter l'événement de nouvelle utilisateur ajoutée
            this.get_inscription(); // Mettre à jour la liste des utilisateurs
        });
    },

    methods: {
        get_inscription() {
            axios.get('/inscription/all')
                .then(response => {
                    this.inscriptions = response.data.inscription


                }).catch(error => {
                    Swal.fire('Erreur!', 'Une erreur est survenue lors de la recuperation des inscrits', 'error')
                });
        },

        //    get_user(id){
        //        axios.get(`/user/show/${id}`)
        //        .then(response => {
        //           return response.data.user.nom;


        //        }).catch(error=>{
        //        Swal.fire('Erreur!','Une erreur est survenue lors de la recuperation de l\'utilisateur','error')
        //        });
        //    },

        changement(event) {
            this.interesser = event;
        },

        resetForm() {
            this.form.input = "";
            this.form.intitule = "";
        },

        async deleteInscription(type) {
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
                    axios.delete(`/inscription/delete/${type.id}`).then(resp => {
                        this.get_inscription();

                        //    Swal.fire(
                        //        'Supprimé!',
                        //        'L\'inscription a été supprimé avec succès.',
                        //        'success',
                        //    )
                        var confirmation = document.querySelector('[data-modal-confirmation-sup]');

                        confirmation.style.backgroundColor = 'white';
                        confirmation.style.color = 'var(--clr)';

                        //setTimeout(function(){
                        confirmation.showModal();
                        confirmation.classList.add("actif");
                        //confirmation.close();
                        //}, 1000);

                        setTimeout(function () {
                            confirmation.close();

                            setTimeout(function () {
                                confirmation.classList.remove("actif");
                            }, 100);

                        }, 2000);
                    }).catch(function (error) {
                        console.log(error);
                    })
                }
            });
        },
        getImageUrl(url) {
            return url ? `${window.location.origin}/storage/${url}` : '';
        },



    }
}
</script>
