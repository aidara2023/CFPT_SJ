<template>
    <div class="liste ">
        <div class="table-container">
            <table>
                <thead>
                    <th>Formation</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                    <tr v-for="(formation, index) in formations">
                        <td><span>{{ formation.intitule }}</span></td>
                        <td>
                            <div class="boutons_actions">
                                <i class="fi fi-rr-edit modifier mdl" @click="openModal(formation)" title="Modifier"></i>
                                <i class="fi fi-rr-comment-alt-dots details mdl" title="Détails"></i>
                                <i class="fi fi-rr-trash supprimer mdl" @click="deleteTypeFormation(formation)"
                                    title="Supprimer"></i>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!--       <div class="avant" style=" margin-left: 80%;">
           
            <a href="#">
                <button class="texte ajout mdl" id="openModal" > <i class="fi fi-rr-plus"></i><span>Ajouter</span></button>
            </a>
        </div>
        <h1 class="texte">Type De Formation </h1>

    <div class="sections" v-for="(formation, index) in formations" :key="index">

            <div class="utilisateur">
               
                <p class="texte" id="n">{{ formation.intitule }}</p>
                <div  class="presences">
                    <a href="#" class="texte b">
                        <i class="fi fi-rr-bars-sort"></i>
                        <span class="modifier">Actions</span>
                    </a>

                    <a href="#" class="texte b"  @click="openModal(formation)">
                        <i class="fi fi-rr-edit"></i>
                        <span class="modifier mdl">Modifier</span>
                    </a>
                    <a href="" class="texte b">
                        <i class="fi fi-rr-comment-alt-dots"></i>
                        <span class="details">Détails</span>
                    </a>
                    <a href="#" class="texte b" @click="deleteTypeFormation(formation)">
                        <i class="fi fi-rr-cross"></i>
                        <span class="supprimer mdl">Supprimer</span>
                    </a>
                </div>
            </div>
        </div>



    </div>
 <span class="fond "></span> -->

    </div>
</template>


<script>
import bus from '../../eventBus';
import axios from 'axios';
import Form from 'vform';



export default {
    name: "listeTypeFormationCompenent",
    data() {
        return {
            form: new Form({
                'intitule': ""

            }),
            formations: [],
            editModal: false,
            idTypeformation: "",


        }
    },
    mounted() {
        this.get_formation();
        bus.on('formationAjoutee', () => { // Écouter l'événement de nouvelle formation ajoutée
            this.get_formation(); // Mettre à jour la liste des formations
        });
    },

    methods: {
        get_formation() {
            axios.get('/type_formation/all')
                .then(response => {
                    this.formations = response.data.type_formation


                }).catch(error => {
                    Swal.fire('Erreur!', 'Une erreur est survenue lors de la recuperation des formations', 'error')
                });
        },

        changement(event) {
            this.interesser = event;
        },

        resetForm() {
            this.form.input = "";
            this.form.intitule = "";
        },

        async deleteTypeFormation(type) {
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
                    axios.delete(`/type_formation/delete/${type.id}`).then(resp => {
                        this.get_formation();
                        var confirmation = document.querySelector('[data-modal-suppression]');
                        confirmation.style.backgroundColor = 'white';
                        confirmation.style.color = 'var(--clr)';

                        confirmation.showModal();
                        confirmation.classList.add("actif");
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
        openModal(formation) {

            this.idTypeformation = formation.id;

            this.editModal = true;

            // Créez un objet avec les données à envoyer
            const eventData = {
                idTypeformation: this.idTypeformation,
                nom: formation.intitule,
                editModal: this.editModal,
                // Ajoutez d'autres propriétés si nécessaire
            };

            bus.emit('formationModifier', eventData);

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




