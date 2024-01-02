<template>
    <div class="liste table-container">
        <!--  <div class="item">
                <div class="renseignements">
                    <div></div>
                    <span>Nom Service</span>
                    <span>Direction</span>
                    <span>Chef de service</span>
                    
                </div>
                <span>Actions</span>
            </div> -->

        <!-- <div class="item" v-for="(service, index) in services" :key="index">
                <div class="renseignements">
                    <div class="cadre_photo">
                        
                        <img src="etudiant.png" alt="" class="petite_taille">
                        <div class="statut petit_ecran_seulement"></div>
                    </div>
                    <span>{{ service.nom_service }}</span>
                    <span>{{ service.direction.nom_direction }}</span>
                    <span>{{ service.user.prenom }} {{ service.user.nom }}</span>
                     <span class="grand_ecran_seulement">IIR 2</span> 
                     <div class="grand_ecran_seulement statut"></div> 
                </div>
                <button>
                    <i class="fi fi-rr-angle-small-left"></i>
                    
                    <div class="boutons_actions">
                        <i class="fi fi-rr-edit modifier mdl" @click="openModal(service)"></i>
                        <i class="fi fi-rr-comment-alt-dots details mdl"></i>
                        <i class="fi fi-rr-cross supprimer mdl" @click="deleteService(service)"></i>
                    </div>
                </button>
            </div> -->
        <table>
            <thead>
                <th>Service</th>
                <th>Direction</th>
                <th>Chef de service</th>
                <th>Actions</th>
            </thead>
            <tbody v-for="(service, index) in services" :key="index" :class="{ 'odd-row': index % 2 === 0 }">
                <tr>
                    <td><span>{{ service.nom_service }}</span></td>
                    <td> <span>{{ service.direction.nom_direction }}</span></td>
                    <td><span>{{ service.user.prenom }} {{ service.user.nom }}</span></td>
                    <td>
                        <div class="boutons_actions">
                            <i class="fi fi-rr-edit modifier mdl" @click="openModal(service)" title="Modifier"></i>
                            <i class="fi fi-rr-comment-alt-dots details mdl" title="Détails"></i>
                            <i class="fi fi-rr-trash supprimer mdl" @click="deleteService(service)" title="Supprimer"></i>
                        </div>
                    </td>

                </tr>

            </tbody>
        </table>
        <!--   <div class="item">
            <div class="renseignements">
                <div></div>
                <span>Matricule</span>
                <span>Prénom</span>
                <span>Nom</span>
                <span class="grand_ecran_seulement">Classe</span>
                <span class="grand_ecran_seulement">Statut</span>
            </div>
            <span>Actions</span>
        </div>

        <div class="item">
            <div class="renseignements">
                <div class="cadre_photo">
                    <img src="etudiant.png" alt="" class="petite_taille">
                    <div class="statut petit_ecran_seulement"></div>
                </div>
                <span>M1233235</span>
                <span>Prénom</span>
                <span>Aidara</span>
                <span class="grand_ecran_seulement">IIR 2</span>
                <div class="statut grand_ecran_seulement"></div>
            </div>
            <button>
                <i class="fi fi-rr-angle-small-left"></i>
               
                <div class="boutons_actions">
                    <i class="fi fi-rr-edit modifier mdl"></i>
                    <i class="fi fi-rr-comment-alt-dots details mdl"></i>
                    <i class="fi fi-rr-cross supprimer mdl"></i>

                </div>

            </button>
        </div> -->

    </div>
</template>

<script>
import bus from '../../eventBus';
import axios from 'axios';
import Form from 'vform';



export default {
    name: "listeUserCompenent",
    data() {
        return {
            form: new Form({
                'nom_service': "",
                'id_user': "",
                'id_direction': ""

            }),
            services: [],
            editModal: false,
            idService: "",
        }
    },
    mounted() {
        this.get_service();
        bus.on('serviceAjoutee', () => { // Écouter l'événement de nouvelle utilisateur ajoutée
            this.get_service(); // Mettre à jour la liste des utilisateurs
        });
    },

    methods: {
        get_service() {
            axios.get('/service/index')
                .then(response => {
                    this.services = response.data.service


                }).catch(error => {
                    Swal.fire('Erreur!', 'Une erreur est survenue lors de la recuperation des services', 'error')
                });
        },

        changement(event) {
            this.interesser = event;
        },

        resetForm() {
            this.form.input = "";
            this.form.nom_service = "";
        },

        async deleteService(type) {
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
                    axios.delete(`/service/delete/${type.id}`).then(resp => {
                        this.get_service();

                        /*     Swal.fire(
                                'Supprimé!',
                                'Le service a été supprimé avec succès.',
                                'success',
                            ) */
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
        openModal(service) {

            this.idService = service.id;

            this.editModal = true;

            // Créez un objet avec les données à envoyer
            const eventData = {
                idService: this.idService,
                nom: service.nom_service,
                id_user: service.id_user,
                id_direction: service.id_direction,
                editModal: this.editModal,
                // Ajoutez d'autres propriétés si nécessaire
            };

            bus.emit('serviceModifier', eventData);

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
