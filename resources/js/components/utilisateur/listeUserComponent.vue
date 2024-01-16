<template >
    <!--  <div class="liste ">
        <div class="table-container">
            <div class="rechercheOnglet onglets grand_ecran_seulement" style="margin-top: 0px;">
                <div data-fenetre="actif"><a href="#" @click="goToStep(1)">Formateur</a></div>
                <div data-fenetre=""><a href="#" @click="goToStep(2)">Personnel Administratif</a></div>
                <div data-fenetre=""><a href="#" @click="goToStep(3)">Personnel d'appui</a></div>

            </div>
            <br>

            <table>
                <thead>
                    <th>Image</th>
                    <th>Matricule</th>
                    <th>Nom Complet</th>
                    <th>Telephone</th>
                    <th>Email</th>
                    <th>Fonction</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </thead>
                <tbody>

                    <tr v-for="(utilisateur, index) in utilisateurs" :key="index">
                        <template v-if="this.activePhase === 1 && utilisateur.role.id === 2">
                            <td><span><img :src="getImageUrl(utilisateur.photo)" alt="Etu"
                                        style="width: 30px; height: 30px;"></span> </td>
                                        <td><span> {{ utilisateur.matricule }}</span></td>
                            <td> <span>{{ utilisateur.prenom }} {{ utilisateur.nom }}</span></td>
                            <td><span> {{ utilisateur.telephone }}</span></td>
                            <td><span>{{ utilisateur.email }} </span></td>
                            <td><span>{{ utilisateur.role.intitule }} </span></td>
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
                            <td><span> {{ utilisateur.matricule }}</span></td>
                            <td> <span>{{ utilisateur.prenom }} {{ utilisateur.nom }}</span></td>
                            <td><span>{{ utilisateur.telephone }}</span></td>
                            <td><span>{{ utilisateur.email }} </span></td>
                            <td><span>{{ utilisateur.role.intitule }} </span></td>
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
                        <template v-if="activePhase === 3 && utilisateur.role.categorie_personnel === 'Personnel Appui'">
                            <td> <img :src="getImageUrl(utilisateur.photo)" alt="Etu" style="width: 30px; height: 30px;">
                            </td>
                            <td><span> {{ utilisateur.matricule }}</span></td>
                            <td> <span>{{ utilisateur.prenom }} {{ utilisateur.nom }}</span></td>
                            <td><span> {{ utilisateur.telephone }}</span></td>
                            <td><span>{{ utilisateur.email }} </span></td>
                            <td><span>{{ utilisateur.role.intitule }} </span></td>
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
                    </tr>

                </tbody>
            </table>
        </div>


    </div>
 -->
    <div class="page-content" v-if="!this.editModal">
        <div class="page-bar">
            <div class="page-title-breadcrumb">
                <div class=" pull-left">
                    <div class="page-title">Liste utilisateur</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" :href="'/admin/index'">Accueil</a>&nbsp;<i
                            class="fa fa-angle-right"></i>
                    </li>
                    <li><a class="parent-item" :href="'/utilisateur/index'">Utilisateur</a>&nbsp;<i
                            class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">Liste utilisateur</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tabbable-line">
                    <!-- <ul class="nav nav-tabs">
                                <li class="active">
                                    <a href="#tab1" data-bs-toggle="tab"> List View </a>
                                </li>
                                <li>
                                    <a href="#tab2" data-bs-toggle="tab"> Grid View </a>
                                </li>
                            </ul> -->
                    <ul class="nav customtab nav-tabs" role="tablist">
                        <li class="nav-item"><a href="#tab1" class="nav-link active" data-bs-toggle="tab">Formateurs</a>
                        </li>
                        <li class="nav-item"><a href="#tab2" class="nav-link" data-bs-toggle="tab">Personnel
                                Administratif</a></li>
                        <li class="nav-item"><a href="#tab3" class="nav-link" data-bs-toggle="tab">Personnel d'appui</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active fontawesome-demo" id="tab1">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card card-box">
                                        <div class="card-head">
                                            <header>Tous les formateurs</header>
                                            <div class="tools">
                                                <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                                                <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                                                <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                                            </div>
                                        </div>
                                        <div class="card-body ">
                                            <div class="row">
                                                <div class="col-md-6 col-sm-6 col-6">
                                                    <div class="btn-group">
                                                        <a :href="'/utilisateur/create'" id="addRow"
                                                            class="btn btn-primary">
                                                            Ajouter <i class="fa fa-plus"></i>
                                                        </a>

                                                    </div>
                                                </div>
                                            </div>
                                            <table
                                                class="table table-striped table-bordered table-hover table-checkable order-column valign-middle"
                                                id="example47" style="width: 100%;">
                                                <thead>
                                                    <tr>
                                                        <th></th>
                                                        <th> Matricule </th>
                                                        <th> Prénom </th>
                                                        <th> Nom </th>
                                                        <th> Email </th>
                                                        <th> Téléphone </th>
                                                        <th> Unité de formation </th>
                                                        <th> Département </th>
                                                        <th> Action </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="odd gradeX" v-for="(utilisateur, index) in utilisateurProf">
                                                        <td class="patient-img"> <img :src="getImageUrl(utilisateur.photo)"
                                                                alt="Etu">
                                                        </td>
                                                        <td> {{ utilisateur.matricule }}</td>
                                                        <td class="left"> {{ utilisateur.prenom }}</td>
                                                        <td class="left"> {{ utilisateur.nom }}</td>
                                                        <td><a :href="'mailto:' + utilisateur.email">{{ utilisateur.email }}
                                                            </a></td>
                                                        <td><a :href="'tel:' + utilisateur.telephone">{{
                                                            utilisateur.telephone }}</a></td>
                                                        <td class="left">{{ utilisateur.filiere }} </td>

                                                        <td>{{ utilisateur.departement }} </td>

                                                        <td>
                                                            <a  class="tblEditBtn" @click="openModal(utilisateur)">
                                                                <i class="fa fa-pencil"></i>
                                                            </a>
                                                            <a href="javascript:void(0)" class="tblDelBtn">
                                                                <i class="fa fa-trash-o"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fontawesome-demo" id="tab2">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card card-box">
                                        <div class="card-head">
                                            <header>Tout le personnel administratif</header>
                                            <div class="tools">
                                                <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                                                <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                                                <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                                            </div>
                                        </div>
                                        <div class="card-body ">
                                            <div class="row">
                                                <div class="col-md-6 col-sm-6 col-6">
                                                    <div class="btn-group">
                                                        <a :href="'/utilisateur/create'" id="addRow"
                                                            class="btn btn-primary">
                                                            Ajouter <i class="fa fa-plus"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <table
                                                class="table table-striped table-bordered table-hover table-checkable order-column valign-middle"
                                                id="exemple1" style="width: 100%;">
                                                <thead>
                                                    <tr>
                                                        <th></th>
                                                        <th> Matricule </th>
                                                        <th> Prénom </th>
                                                        <th> Nom </th>
                                                        <th> Email </th>
                                                        <th> Téléphone </th>
                                                        <th> Fonction </th>
                                                        <th> Service </th>
                                                        <th> Action </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="odd gradeX" v-for="(utilisateur, index) in utilisateurs">
                                                        <td class="patient-img"> <img :src="getImageUrl(utilisateur.photo)"
                                                                alt="Etu">
                                                        </td>
                                                        <td> {{ utilisateur.matricule }}</td>
                                                        <td class="left"> {{ utilisateur.prenom }}</td>
                                                        <td class="left"> {{ utilisateur.nom }}</td>
                                                        <td><a :href="'mailto:' + utilisateur.email">{{ utilisateur.email }}
                                                            </a></td>
                                                        <td><a :href="'tel:' + utilisateur.telephone">{{
                                                            utilisateur.telephone }}</a></td>
                                                        <td class="left">{{ utilisateur.fonction }} </td>
                                                        <td>{{ utilisateur.nom_service }} </td>

                                                        <td>

                                                            <a class="tblEditBtn" @click="openModal(utilisateur)">
                                                                <i class="fa fa-pencil"></i>
                                                            </a>
                                                            <a href="javascript:void(0)" class="tblDelBtn">
                                                                <i class="fa fa-trash-o"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane" id="tab3">
                            <div class="row" v-for="(utilisateur, index) in utilisateursPer" :key="index">
                                <div class="col-md-4" v-if="utilisateur.role.categorie_personnel === 'Personnel Appui'">
                                    <div class="card card-box">
                                        <div class="card-body no-padding ">

                                            <div class="doctor-profile">

                                                <img :src="getImageUrl(utilisateur.photo)" class="doctor-pic" alt="">
                                                <div class="profile-usertitle">
                                                    <div class="doctor-name">{{ utilisateur.prenom }} {{ utilisateur.nom }}
                                                    </div>
                                                    <div class="name-center"> {{ utilisateur.role.intitule }} </div>
                                                    <!-- </div>
                                                <p>A-103, shyam gokul flats, Mahatma Road <br />Mumbai</p>
                                                <div> -->
                                                    <p><i class="fa fa-phone"> </i> <a :href="utilisateur.telephone">
                                                            {{ utilisateur.telephone }}</a></p>
                                                </div>
                                                <div class="profile-userbuttons">
                                                    <a href="professor_profile.html"
                                                        class="btn btn-circle deepPink-bgcolor btn-sm">Read
                                                        More</a>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="page-content-wrapper" v-if="this.editModal">
        <div class="page-content">
            <div class="page-bar">
                <div class="page-title-breadcrumb">
                    <div class=" pull-left">
                        <div class="page-title">Nouvel Utilisateur</div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-right">
                        <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="{{ route('admin_index') }}">Tableau
                                de Bord</a>&nbsp;<i class="fa fa-angle-right"></i>
                        </li>
                        <li><a class="parent-item" href="{{ route('utilisateur_create') }}">Utilisateur</a>&nbsp;<i
                                class="fa fa-angle-right"></i>
                        </li>
                        <li class="active">Modifier Utilisateur</li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card-box">
                        <div class="card-head">
                            <header>Information</header>
                            <button id="panel-button" class="mdl-button mdl-js-button mdl-button--icon pull-right"
                                data-upgraded=",MaterialButton">
                                <i class="material-icons">more_vert</i>
                            </button>
                            <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect"
                                data-mdl-for="panel-button">
                                <li class="mdl-menu__item"><i class="material-icons">assistant_photo</i>Action
                                </li>
                                <li class="mdl-menu__item"><i class="material-icons">print</i>Another action
                                </li>
                                <li class="mdl-menu__item"><i class="material-icons">favorite</i>Something else
                                    here</li>
                            </ul>
                        </div>
                        <div class="card-body row">
                            <FormulaireModification :utilisateur="userEnCoursDeModification"  />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import bus from '../../eventBus';
import axios from 'axios';
import Form from 'vform';
import datatable from 'datatables.net-bs5';
import FormulaireModification from './utilisateurComponent.vue';



export default {
    name: "listeUserCompenent",
    components: {
  FormulaireModification,
},
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
            utilisateurs: null,
            utilisateurProf: null,
            utilisateursPer: [],
            idUser: "",
            editModal: false,
            activePhase: 1,
            idUser: "",
            userEnCoursDeModification: null,


        }
    },
    mounted() {
        this.get_utilisateur();
        bus.on('utilisateurAjoutee', () => { // Écouter l'événement de nouvelle utilisateur ajoutée
            this.get_utilisateur(); // Mettre à jour la liste des utilisateurs

        });



    },

    methods: {
        initDataTable() {
            this.$nextTick(() => {
                $('#exemple1').DataTable({
                    responsive: true,
                    language: {
                        // Messages pour la pagination
                        paginate: {
                            first: 'Premier',
                            previous: 'Précédent',
                            next: 'Suivant',
                            last: 'Dernier'
                        },
                        // Message d'affichage du nombre d'éléments par page
                        lengthMenu: 'Afficher _MENU_ entrées',
                        // Message d'information sur le nombre total d'entrées et le nombre affiché actuellement
                        info: 'Affichage de _START_ à _END_ sur _TOTAL_ entrées',
                        // Message lorsque le tableau est vide
                        emptyTable: 'Aucune donnée disponible dans le tableau',
                        // Message indiquant que la recherche est en cours
                        loadingRecords: 'Chargement en cours...',
                        // Message indiquant que la recherche n'a pas renvoyé de résultats
                        zeroRecords: 'Aucun enregistrement correspondant trouvé',
                        // Message indiquant le nombre total d'entrées
                        infoEmpty: 'Affichage de 0 à 0 sur 0 entrées',
                        // Message indiquant que la recherche est en cours dans le champ de recherche
                        search: 'Recherche :'
                    }
                });
                $('#example47').DataTable({
                    responsive: true,
                    language: {
                        // Messages pour la pagination
                        paginate: {
                            first: 'Premier',
                            previous: 'Précédent',
                            next: 'Suivant',
                            last: 'Dernier'
                        },
                        // Message d'affichage du nombre d'éléments par page
                        lengthMenu: 'Afficher _MENU_ entrées',
                        // Message d'information sur le nombre total d'entrées et le nombre affiché actuellement
                        info: 'Affichage de _START_ à _END_ sur _TOTAL_ entrées',
                        // Message lorsque le tableau est vide
                        emptyTable: 'Aucune donnée disponible dans le tableau',
                        // Message indiquant que la recherche est en cours
                        loadingRecords: 'Chargement en cours...',
                        // Message indiquant que la recherche n'a pas renvoyé de résultats
                        zeroRecords: 'Aucun enregistrement correspondant trouvé',
                        // Message indiquant le nombre total d'entrées
                        infoEmpty: 'Affichage de 0 à 0 sur 0 entrées',
                        // Message indiquant que la recherche est en cours dans le champ de recherche
                        search: 'Recherche :'
                    }
                });
            });
        },

        get_utilisateur() {
            axios.get('/user/getPersonnel')
                .then(response => {
                    this.utilisateursPer = response.data.user;

                    // const scriptTag = document.getElementById('tableDataScript');
                    /*  console.log("Données utilisateurs : ", this.utilisateurs); */
                    //scriptTag.setAttribute('data-mydata', JSON.stringify(this.utilisateurs));

                    //console.log("Chaîne JSON générée : ", JSON.stringify(this.utilisateurs));
                    // $(document).trigger('donnees-pretent');
                    // Obtenez toutes les données d'utilisateurs
                    const allUtilisateurs = response.data.user;

                    // Filtrer les utilisateurs en fonction de la catégorie du personnel
                    const filteredUtilisateurs = allUtilisateurs.filter(utilisateur => {
                        return utilisateur.role.categorie_personnel === 'Personnel Administratif';
                    });

                    // Filtrer les utilisateurs en fonction de la catégorie du personnel
                    const filteredProf = allUtilisateurs.filter(utilisateur => {
                        return utilisateur.role.id === 2;
                    });

                    // Formater les utilisateurs pour DataTables
                    const formattedUtilisateurs = filteredUtilisateurs.map(utilisateur => {
                        return {
                            photo: utilisateur.photo,
                            adresse: utilisateur.adresse,
                            date_naissance: utilisateur.date_naissance,
                            lieu_naissance: utilisateur.lieu_naissance,
                            id: utilisateur.id,
                            type: utilisateur.type,
                            genre: utilisateur.genre,
                            id_role: utilisateur.id_role,
                            nationalite: utilisateur.nationalite,
                            situation_matrimonial: utilisateur.situation_matrimonial,
                            matricule: utilisateur.matricule,
                            prenom: utilisateur.prenom,
                            nom: utilisateur.nom,
                            email: utilisateur.email,
                            telephone: utilisateur.telephone,
                            editModal: true,
                            fonction: utilisateur.role.intitule,
                            nom_service: utilisateur.personnel_admin_appui.map(ele => ele.service.nom_service).join(', '),
                            id_service: utilisateur.personnel_admin_appui.map(ele => ele.service.id).join(', '),
                        };
                    });
                    const formattedFormateur = filteredProf.map(utilisateur => {
                        return {
                            photo: utilisateur.photo,
                            adresse: utilisateur.adresse,
                            date_naissance: utilisateur.date_naissance,
                            lieu_naissance: utilisateur.lieu_naissance,
                            id: utilisateur.id,

                            genre: utilisateur.genre,
                            id_role: utilisateur.id_role,
                            nationalite: utilisateur.nationalite,
                            matricule: utilisateur.matricule,
                            prenom: utilisateur.prenom,
                            nom: utilisateur.nom,
                            email: utilisateur.email,
                            telephone: utilisateur.telephone,
                            editModal: true,
                            fonction: utilisateur.role.intitule,

                             situation_matrimoniale: utilisateur.formateur.map(ele => ele.situation_matrimoniale).join(', '),
                            type: utilisateur.formateur.map(ele => ele.type).join(', '),
                            specialite: utilisateur.formateur.map(ele => ele.specialite.id).join(', '),
                            type_formateur: utilisateur.formateur.map(ele => ele.type_formateur).join(', '),

                            filiere: utilisateur.formateur.map(ele => ele.unite_de_formation.nom_unite_formation).join(', '),
                            id_departement: utilisateur.formateur.map(eles => eles.unite_de_formation.departement.id).join(', '),
                            departement: utilisateur.formateur.map(eles => eles.unite_de_formation.departement.nom_departement).join(', '),

                        };
                    });

                    // Mettez à jour la liste des utilisateurs au format de tableau de dictionnaires
                    this.utilisateurs = formattedUtilisateurs;
                    this.utilisateurProf = formattedFormateur;
                    console.log(this.utilisateurProf)

                    this.initDataTable();

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

            this.userEnCoursDeModification = utilisateur;

        },

        getImageUrl(url) {
            return url ? `${window.location.origin}/storage/${url}` : '';
        },

    }
}
</script>
<style>
.small-image {
    width: 34px;
    /* Ajustez la taille comme nécessaire */
    height: 34px;
    border-radius: 50%;
}
</style>
