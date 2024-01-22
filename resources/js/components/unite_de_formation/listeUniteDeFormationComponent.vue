<template>
    <div class="page-content" v-if="!this.editModal">
        <div class="page-bar">
            <div class="page-title-breadcrumb">

                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" :href="'/admin/index'">Accueil</a>&nbsp;<i
                            class="fa fa-angle-right"></i>
                    </li>

                    <li class="active"> Paramétres &nbsp;<i
                            class="fa fa-angle-right"></i></li>
                    <li><a class="parent-item" :href="'/unite_de_formation/index'"> Filière</a>&nbsp;<i
                            class="fa fa-angle-right"></i>
                    </li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tabbable-line">
                    <ul class="nav customtab nav-tabs" role="tablist">
                        <li class="nav-item"><a href="#tab1" class="nav-link active" data-bs-toggle="tab">Filière</a>
                        </li>

                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active fontawesome-demo" id="tab1">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card card-box">
                                        <div class="card-head">
                                            <header>Toutes les Filières</header>
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
                                                        <a :href="'/unite_de_formation/create'" id="addRow" class="btn btn-primary">
                                                            Ajouter <i class="fa fa-plus"></i>
                                                        </a>

                                                    </div>
                                                </div>
                                            </div>
                                            <table
                                                class="table table-striped table-bordered table-hover table-checkable order-column valign-middle"
                                                id="example47">
                                                <thead>
                                                    <tr>
                                                        <th class="pd-auto">Identifiant</th>
                                                        <th> Filière </th>
                                                        <th> Chef de filière </th>
                                                        <th> Département </th>
                                                        <th> Action </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="odd gradeX"
                                                        v-for="(unite_de_formation, index) in unite_de_formations"
                                                        :key="index">
                                                        <td> {{ index + 1 }} </td>
                                                        <td> {{ unite_de_formation.filiere }} </td>
                                                        <td>{{ unite_de_formation.user_prenom }} {{
                                                            unite_de_formation.user_nom }}</td>
                                                        <td> {{ unite_de_formation.departement }}</td>

                                                        <td>
                                                            <a class="tblEditBtn" @click="openModal(unite_de_formation)">
                                                                <i class="fa fa-pencil"></i>
                                                            </a>
                                                            <a class="tblDelBtn"
                                                                @click="deleteUniteDeFormation(unite_de_formation)">
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

                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="page-content-wrapper" v-show="editModal">
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
                        <li><a class="parent-item" href="{{ route('unite_deformation_create') }}">Filière</a>&nbsp;<i
                                class="fa fa-angle-right"></i>
                        </li>
                        <li class="active">Modifier Filière</li>
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
                            <FormulaireModification />
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
import Swal from 'sweetalert2';
import FormulaireModification from './createUniteDeFormationComponent.vue';




export default {
    name: "listeUniteDeFormationCompenent",
    components: {
        FormulaireModification,
    },
    data() {
        return {
            form: new Form({
                'nom_unite_formation': "",
                'id_formateur': "",
                'id_departement': ""

            }),
            unite_de_formations: [],
            editModal: false,
            idFormation: "",


        }
    },
    mounted() {
        this.get_unite_de_formation();
        bus.on('unite_formationAjoutee', () => { // Écouter l'événement de nouvelle unite de formation
            this.get_unite_de_formation(); // Mettre à jour la liste des unites de formations
        });
        bus.on('unite_formationDejaModifier', (eventData) => {
            this.editModal = eventData.editModal;
            /* this.get_service(); */
        });
    },

    methods: {
        initDataTable() {
            this.$nextTick(() => {
                // Initialiser DataTable sur la table avec l'id 'example47' si elle n'a pas déjà été initialisée
                if (!$.fn.DataTable.isDataTable('#example47')) {
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
                }
            });
        },
        get_unite_de_formation() {
            axios.get('/unite_de_formation/all')
                .then(response => {
                    const allfiliere = response.data.unite_de_formation;

                    const formattedFiliere = allfiliere.map(fil => {
                        return {
                            id: fil.id,
                            filiere: fil.nom_unite_formation,
                            departement: fil.departement.nom_departement,
                            id_departement: fil.departement.id,
                          /*   user_prenom: fil.user.prenom,
                            user_nom: fil.user.nom,
                            id_user: fil.user.id, */

                            user_prenom: fil.user ? fil.user.prenom : 'Non défini',
                            user_nom: fil.user ? fil.user.nom : 'Non défini',
                            id_user: fil.user ? fil.user.id : null,
                            editModal: true,
                        };
                    });
                    this.unite_de_formations=formattedFiliere;
                    this.initDataTable(); 


                }).catch(error => {
                    Swal.fire('Erreur!', 'Une erreur est survenue lors de la recuperation des unites de formations', 'error')
                });
        },

        changement(event) {
            this.interesser = event;
        },

        resetForm() {
            this.form.input = "";
            this.form.nom_unite_formation = "";
            this.form.id_formateur = "";
            this.form.id_departement = "";

        },

        async deleteUniteDeFormation(type) {
            Swal.fire({
                title: 'Voulez-vous confirmer la suppression ?',
                text: "Cette action sera irréversible!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Oui',
                cancelButtonText: 'Non'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete(`/unite_de_formation/delete/${type.id}`).then(resp => {
                        this.get_unite_de_formation();
                      showDialog6("La filière a été supprimée avec succès")

                    }).catch(function (error) {
                        console.log(error);
                    })
                }
            });
        },
        openModal(unite_de_formation) {
            this.editModal = true;
            // Créez un objet avec les données à envoyer
            const eventData = {
                filiere: unite_de_formation,
                editModal:true,
            };

            bus.emit('formationModifier', eventData);
            console.log("message envoyé")

        },



    }
}
</script>
