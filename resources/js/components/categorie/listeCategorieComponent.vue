<template>
    <div class="page-content" v-if="!this.editModal">
        <div class="page-bar">
            <div class="page-title-breadcrumb">

                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" :href="'/bibliothecaire/accueil'">Accueil</a>&nbsp;<i
                            class="fa fa-angle-right"></i>
                    </li>
                    <li class="active"> Paramétres &nbsp;<i class="fa fa-angle-right"></i></li>
                    <li><a class="parent-item" :href="'/categorie/accueil'"> categorie</a>&nbsp;<i
                            class="fa fa-angle-right"></i>
                    </li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tabbable-line">
                    <ul class="nav customtab nav-tabs" role="tablist">
                        <li class="nav-item"><a href="#tab1" class="nav-link active" data-bs-toggle="tab">Categorie</a>
                        </li>

                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active fontawesome-demo" id="tab1">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card card-box">
                                        <div class="card-head">
                                            <header>Toutes les catégories</header>
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
                                                        <a :href="'/categorie/create'" id="addRow" class="btn btn-primary">
                                                            Ajouter <i class="fa fa-plus text-white"></i>
                                                        </a>

                                                    </div>
                                                </div>
                                            </div>
                                            <table
                                                class="table table-striped table-bordered table-hover table-checkable order-column valign-middle"
                                                id="example47">
                                                <thead>
                                                    <tr>
                                                        <th> # </th>
                                                        <th> Catégorie</th>
                                                        <th> Date de création</th>
                                                        <th> Action </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="odd gradeX" v-for="(categorie, index) in categories"
                                                        :key="index">

                                                        <td> {{ index + 1 }} </td>
                                                        <td> {{ categorie.categorie }} </td>
                                                        <td>{{ this.formatDateTime(categorie.date) }}</td>


                                                        <td>
                                                            <a class="tblEditBtn" @click="openModal(categorie)">
                                                                <i class="fa fa-pencil"></i>
                                                            </a>
                                                            <a class="tblDelBtn" @click="deleteCategorie(categorie)">
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
                        <div class="page-title">Nouvelle Categorie</div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-right">
                        <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="{{ route('bibliothecaire_accueil') }}">Tableau
                                de Bord</a>&nbsp;<i class="fa fa-angle-right"></i>
                        </li>
                        <li class="active">Paramétres</li>
                        <li><a class="parent-item" :href="'/categorie/create'">Categorie</a>&nbsp;<i
                                class="fa fa-angle-right"></i>
                        </li>
                        <li class="active">Modifier Categorie</li>
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
import FormulaireModification from './createCategorieComponent.vue';



export default {
    name: "listeCategorieComponent",
    components: {
        FormulaireModification,
    },
    data() {
        return {
            form: new Form({
                'intitule': "",
                

            }),
            categories: [],
            idCategorie: "",
            editModal: false,


        }
    },
    mounted() {
        this.get_categorie();
        bus.on('categorieAjoutee', () => { // Écouter l'événement de nouvelle utilisateur ajoutée
            this.get_categorie(); // Mettre à jour la liste des utilisateurs
        });
        bus.on('categorieDejaModifier', (eventData) => {
            this.editModal = eventData.editModal;
            this.get_categorie();
        });
    },

    methods: {
        initDataTable() {
            this.$nextTick(() => {
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
        formatDateTime(dateTime) {
            // Utilisez une fonction pour formater la date
            return this.formatDate(new Date(dateTime));
        },
        formatDate(date) {
            const day = date.getDate();
            const monthNumber = date.getMonth() + 1;
            const year = date.getFullYear();

            // Tableau des trois premières lettres des mois en français
            const monthAbbreviations = [
                "Jan", "Fév", "Mar", "Avr", "Mai", "Juin",
                "Juil", "Aoû", "Sep", "Oct", "Nov", "Déc"
            ];

            // Obtenez les trois premières lettres du mois correspondant au numéro du mois
            const month = monthAbbreviations[monthNumber - 1];

            return `${day} ${month} ${year}`;

        },
        get_categorie() {
            axios.get('/categorie/index')
                .then(response => {
                    const allcategorie = response.data.categorie;
                    const formattedCategorie = allcategorie.map(direct => {
                        return {
                            id: direct.id,
                            categorie: direct.intitule,
                            editModal: true,
                            date: direct.created_at,
                        };
                    });
                    this.categories = formattedCategorie;
                    this.initDataTable();
                    console.log(this.categories);
                }).catch(error => {
                    Swal.fire('Erreur!', 'Une erreur est survenue lors de la récupération des categories', 'error');
                });
        },


        resetForm() {
            this.form.input = "";
            this.form.intitule = "";
        },

        async deleteCategorie(type) {
            Swal.fire({
                title: 'Voulez-vous confirmer la suppression?',
                text: "Cette action sera irréversible!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Oui',
                cancelButtonText: 'Non'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete(`/categorie/delete/${type.id}`).then(resp => {
                        showDialog6("Categorie supprimée avec succés")
                        this.get_categorie();
                    }).catch(function (error) {
                        console.log(error);
                        showDialog3("Erreur lors de la suppression de la categorie")
                    })
                }
            });
        },
        openModal(categorie) {
            this.editModal = true;
            // Créez un objet avec les données à envoyer
            const eventData = {
                categorie: categorie,
                editModal: this.editModal,
                // Ajoutez d'autres propriétés si nécessaire
            };
            bus.emit('categorieModifier', eventData);
        },



    }
}
</script>