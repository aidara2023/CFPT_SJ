<template>
    <div class="liste">
        <!-- <div class="avant">
           <h1 class="texte">Batiment</h1>
           <a href="#">
               <button class="texte ajout mdl" id="openModal" > <i class="fi fi-rr-plus"></i><span>Ajouter</span></button>
           </a>
       </div>


   <div class="sections" v-for="(batiment, index) in batiments" :key="index">
           <div class="utilisateur">
               <img src="/assetsCFPT/image/image1.png" alt="Etu" class="petite">
               <p class="texte" id="n">{{ batiment.intitule }} </p>
              
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
 -->
        <div class="table-container">
            <table>
                <thead>
                    <th>Batiment</th>

                    <th>Actions</th>
                </thead>
                <tbody>
                    <tr v-for="(batiment, index) in batiments" :key="index">
                        <td><span>{{ batiment.intitule }}</span></td>

                        <td>
                            <div class="boutons_actions">
                                <i class="fi fi-rr-edit modifier mdl" @click="openModal(batiment)" title="Modifier"></i>
                                <i class="fi fi-rr-comment-alt-dots details mdl" title="Détails"></i>
                                <i class="fi fi-rr-trash supprimer mdl" @click="deleteBatiment(batiment)"
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
    name: "listeBatimentComponent",
    data() {
        return {
            form: new Form({
                'intitule': ""

            }),
            batiments: [],
            idBatiment: "",

        }
    },
    mounted() {
        this.get_batiment();
        bus.on('batimentAjoutee', () => { // Écouter l'événement de nouvelle utilisateur ajoutée
            this.get_batiment(); // Mettre à jour la liste des utilisateurs
        });
    },

    methods: {
        get_batiment() {
            axios.get('/batiment/index')
                .then(response => {
                    this.batiments = response.data.batiment
                    console.log(this.batiments)


                }).catch(error => {
                    Swal.fire('Erreur!', 'Une erreur est survenue lors de la recuperation des batiments', 'error')
                });
        },

        changement(event) {
            this.interesser = event;
        },

        resetForm() {
            this.form.input = "";
            this.form.intitule = "";
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

                        /*  Swal.fire(
                             'Supprimé!',
                             'Le batiment a été supprimé avec succès.',
                             'success',
                         ) */
                        /*   }).catch(function (error) {
                              console.log(error);
                          })
                      }
                  });
              }, */
                        var confirmation = document.querySelector('[data-modal-suppression]');

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
        openModal(batiment) {

            this.idBatiment = batiment.id;

            this.editModal = true;

            // Créez un objet avec les données à envoyer
            const eventData = {
                idBatiment: this.idBatiment,
                intitule: batiment.intitule,
              
                editModal: this.editModal,
                // Ajoutez d'autres propriétés si nécessaire
            };

            bus.emit('batimentModifier', eventData);

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
