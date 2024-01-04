<template>
    <div class="liste ">
        <div class="table-container">
            <div class="rechercheOnglet onglets grand_ecran_seulement" style="margin-top: 0px;">
                <div data-fenetre="actif"><a href="#" @click="goToStep(1)">Formateur</a></div>
                <div data-fenetre=""><a href="#" @click="goToStep(2)">Personnel Administratif</a></div>
                <div data-fenetre=""><a href="#" @click="goToStep(3)">Personnel d'appui</a></div>
                <!-- <div data-fenetre="">Appui</div> -->
            </div>
            <br>

            <table>
                <thead>
                    <th>Image</th>
                    <th>Nom Complet</th>
                    <th>Telephone</th>
                    <th>Email</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </thead>
                <tbody>

                    <tr v-for="(utilisateur, index) in utilisateurs" :key="index">
                        <template v-if="this.activePhase === 1 && utilisateur.role.id === 2">
                            <td><span><img :src="getImageUrl(utilisateur.photo)" alt="Etu"
                                        style="width: 30px; height: 30px;"></span> </td>
                            <td> <span>{{ utilisateur.prenom }} {{ utilisateur.nom }}</span></td>
                            <td><span> {{ utilisateur.telephone }}</span></td>
                            <td><span>{{ utilisateur.email }} </span></td>
                            <td><span>{{ utilisateur.status }} </span></td>
                            <td>
                                <div class="boutons_actions">
                                    <i class="fi fi-rr-edit modifier mdl" @click="openModal(utilisateur)"
                                        title="Modifier"></i>
                                    <i class="fi fi-rr-comment-alt-dots details mdl" title="Détails"></i>
                                    <i :class="utilisateur.status === 1 ? 'fi fi-rr-comment-alt-dots details mdl' : 'fi fi-rr-comment-alt-dots details mdl'"
                                        title="Toggle Statut" @click="toggleUserStatus(utilisateur)">
                                    </i>

                                </div>
                            </td>
                        </template>
                        <template
                            v-if="activePhase === 2 && utilisateur.role.categorie_personnel === 'Personnel Administratif'">
                            <td> <img :src="getImageUrl(utilisateur.photo)" alt="Etu" style="width: 30px; height: 30px;">
                            </td>
                            <td> <span>{{ utilisateur.prenom }} {{ utilisateur.nom }}</span></td>
                            <td><span>{{ utilisateur.telephone }}</span></td>
                            <td><span>{{ utilisateur.email }} </span></td>
                            <td>
                                <div class="boutons_actions">
                                    <i class="fi fi-rr-edit modifier mdl" @click="openModal(utilisateur)"
                                        title="Modifier"></i>
                                    <i class="fi fi-rr-comment-alt-dots details mdl" title="Détails"></i>
                                    <i :class="utilisateur.status === 1 ? 'fi fi-rr-comment-alt-dots details mdl' : 'fi fi-rr-comment-alt-dots details mdl'"
                                        title="Toggle Statut" @click="toggleUserStatus(utilisateur)">
                                    </i>

                                </div>
                            </td>
                        </template>
                        <template v-if="activePhase === 3 && utilisateur.role.categorie_personnel === 'Personnel Appui'">
                            <td> <img :src="getImageUrl(utilisateur.photo)" alt="Etu" style="width: 30px; height: 30px;">
                            </td>
                            <td> <span>{{ utilisateur.prenom }} {{ utilisateur.nom }}</span></td>
                            <td><span> {{ utilisateur.telephone }}</span></td>
                            <td><span>{{ utilisateur.email }} </span></td>
                            <td>
                                <div class="boutons_actions">
                                    <i class="fi fi-rr-edit modifier mdl" @click="openModal(utilisateur)"
                                        title="Modifier"></i>
                                    <i class="fi fi-rr-comment-alt-dots details mdl" title="Détails"></i>
                                    <i :class="utilisateur.status === 1 ? 'fi fi-rr-comment-alt-dots details mdl' : 'fi fi-rr-comment-alt-dots details mdl'"
                                        title="Toggle Statut" @click="toggleUserStatus(utilisateur)">
                                    </i>

                                </div>
                            </td>
                        </template>
                    </tr>

                </tbody>
            </table>
        </div>

        <!--  <div class="avant" style=" margin-left: 80%;">
            <a href="#">
                <button class="texte ajout mdl" id="openModal"> <i class="fi fi-rr-plus"></i><span>Ajouter</span></button>
            </a>
        </div>

        <div class="avant" style="margin-top: 5%;">
            <h1 class="texte"><a href="#" @click="goToStep(1)">Formateur</a></h1>
            <h1 class="texte"><a href="#" @click="goToStep(2)">Personnel Administratif</a></h1>
            <h1 class="texte"><a href="#" @click="goToStep(3)">Personnel d'appui</a></h1>
        </div>


        <div v-if="activePhase == 1">

            <div class="" v-for="(utilisateur, index) in utilisateurs" :key="index">
               
                <div class="utilisateur" v-if="utilisateur.role.id === 2">
                    <img :src="getImageUrl(utilisateur.photo)" alt="Etu" class="petite">
                    <p class="texte" id="n">{{ utilisateur.prenom }} {{ utilisateur.nom }}</p>
                    <p class="texte" id="n">{{ utilisateur.email }} {{ utilisateur.telephone }}</p>
                    <div class="presences">
                        <a href="#" class="texte b">
                            <i class="fi fi-rr-bars-sort"></i>
                            <span class="modifier">Actions</span>
                        </a>
                        <a href="#" class="texte b" @click="openModal(utilisateur)">
                            <i class="fi fi-rr-edit"></i>
                            <button class="modifier mdl">Modifier</button>
                        </a>
                        <a href="" class="texte b">
                            <i class="fi fi-rr-comment-alt-dots"></i>
                            <span class="details">Détails</span>
                        </a>
                        <a href="#" class="texte b" @click="deleteUtilisateur(utilisateur)">
                            <i class="fi fi-rr-trash"></i>
                            <span class="supprimer mdl">Supprimer</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div v-if="activePhase == 2">
            <div class="" v-for="(utilisateur, index) in utilisateurs" :key="index">
              
                <div class="utilisateur" v-if="utilisateur.role.categorie_personnel === 'Personnel Administratif'">
                    <img :src="getImageUrl(utilisateur.photo)" alt="Etu" class="petite">
                    <p class="texte" id="n">{{ utilisateur.prenom }} {{ utilisateur.nom }}</p>
                    <p class="texte" id="n">{{ utilisateur.email }} {{ utilisateur.telephone }}</p>
                    <div class="presences">
                        <a href="#" class="texte b">
                            <i class="fi fi-rr-bars-sort"></i>
                            <span class="modifier">Actions</span>
                        </a>
                        <a href="#" class="texte b" @click="openModal(utilisateur)">
                            <i class="fi fi-rr-edit"></i>
                            <button class="modifier mdl">Modifier</button>
                        </a>
                        <a href="" class="texte b">
                            <i class="fi fi-rr-comment-alt-dots"></i>
                            <span class="details">Détails</span>
                        </a>
                        <a href="#" class="texte b" @click="deleteUtilisateur(utilisateur)">
                            <i class="fi fi-rr-trash"></i>
                            <span class="supprimer mdl">Supprimer</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div v-if="activePhase == 3">
            <div class="" v-for="(utilisateur, index) in utilisateurs" :key="index">
               
                <div class="utilisateur" v-if="utilisateur.role.categorie_personnel === 'Personnel Appui'">
                    <img :src="getImageUrl(utilisateur.photo)" alt="Etu" class="petite">
                    <p class="texte" id="n">{{ utilisateur.prenom }} {{ utilisateur.nom }}</p>
                    <p class="texte" id="n">{{ utilisateur.email }} {{ utilisateur.telephone }}</p>
                    <div class="presences">
                        <a href="#" class="texte b">
                            <i class="fi fi-rr-bars-sort"></i>
                            <span class="modifier">Actions</span>
                        </a>
                        <a href="#" class="texte b" @click="openModal(utilisateur)">
                            <i class="fi fi-rr-edit"></i>
                            <button class="modifier mdl">Modifier</button>
                        </a>
                        <a href="" class="texte b">
                            <i class="fi fi-rr-comment-alt-dots"></i>
                            <span class="details">Détails</span>
                        </a>
                        <a href="#" class="texte b" @click="deleteUtilisateur(utilisateur)">
                            <i class="fi fi-rr-trash"></i>
                            <span class="supprimer mdl">Supprimer</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>


    </div>
 -->

    </div>

    <!-- <span class="fond "></span> -->
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
                'nom': "",
                'prenom': "",
                'genre': "",
                'adresse': "",
                'telephone': "",
                'email': "",
                'date_naissance': "",
                'lieu_naissance': "",
                'nationalite': "",
                'id_role': "",
                'id_specialite': "",
                'id_departement': "",
                'id_service': "",
                'type': "",
                'situation_matrimoniale': ""
            }),
            utilisateurs: [],
            idUser: "",
            editModal: false,
            activePhase: 1,
            idUser: "",


        }
    },
    mounted() {
        this.get_utilisateur();
        bus.on('utilisateurAjoutee', () => { // Écouter l'événement de nouvelle utilisateur ajoutée
            this.get_utilisateur(); // Mettre à jour la liste des utilisateurs
        });
    },

    methods: {
        get_utilisateur() {
            axios.get('/user/getPersonnel')
                .then(response => {
                    this.utilisateurs = response.data.user


                }).catch(error => {
                    Swal.fire('Erreur!', 'Une erreur est survenue lors de la recupération des utilisateurs', 'error')
                });
        },
        async toggleUserStatus(user) {
            try {
                const response = await axios.put(`/user/toggle-status/${user.id}`);

                if (response.data.status === 200) {
                    // Succès, mettez à jour la liste des utilisateurs ou affichez un message
                    this.get_utilisateur();
                    console.log(response.data.message);
                } else {
                    // Échec, affichez un message d'erreur
                    console.error(response.data.message);
                }
            } catch (error) {
                // Gestion des erreurs
                console.error(error);
            }
        },

        shouldShowRow(utilisateur) {
            if (this.activePhase === 1 && utilisateur.role.id === 2) {
                return true;
            } else if (this.activePhase === 2 && utilisateur.role.categorie_personnel === 'Personnel Administratif') {
                return true;
            } else if (this.activePhase === 3 && utilisateur.role.categorie_personnel === 'Personnel Appui') {
                return true;
            } else {
                return false;
            }
        },

        changement(event) {
            this.interesser = event;
        },

        goToStep: function (step) {
            this.activePhase = step;
        },

        async deleteUtilisateur(user) {
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
                    axios.delete(`/user/disable/${user.id}`).then(resp => {
                        this.get_utilisateur();

                        var confirmation = document.querySelector('[data-modal-confirmation-sup]');

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

        openModal(utilisateur) {

            this.idUser = utilisateur.id;

            this.editModal = true;

            // Créez un objet avec les données à envoyer
            const eventData = {
                idUser: this.idUser,
                nom: utilisateur.nom,
                prenom: utilisateur.prenom,
                genre: utilisateur.genre,
                adresse: utilisateur.adresse,
                telephone: utilisateur.telephone,
                email: utilisateur.email,
                date_naissance: utilisateur.date_naissance,
                lieu_naissance: utilisateur.lieu_naissance,
                nationalite: utilisateur.nationalite,
                type: utilisateur.type,
                situation_matrimonial: utilisateur.situation_matrimonial,
                id_role: utilisateur.id_role,
                id_specialite: utilisateur.id_specialite,
                id_departement: utilisateur.id_departement,
                id_service: utilisateur.id_service,
                id_personnel_administratif: utilisateur.id_personnel_administratif,
                id_personnel_appui: utilisateur.id_personnel_appui,

                editModal: this.editModal,
                // Ajoutez d'autres propriétés si nécessaire
            };

            bus.emit('utilisateurModifier', eventData);

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

        getImageUrl(url) {
            return url ? `${window.location.origin}/storage/${url}` : '';
        },



    }
}
</script>
