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
                    <li><a class="parent-item" :href="'/classe/index'"> Classe</a>&nbsp;<i
                            class="fa fa-angle-right"></i>
                    </li>
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
                        <li class="nav-item"><a href="#tab1" class="nav-link active" data-bs-toggle="tab">Classe</a>
                        </li>

                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active fontawesome-demo" id="tab1">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card card-box">
                                        <div class="card-head">
                                            <header>Toutes les classes</header>
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
                                                        <a :href="'/classe/create'" id="addRow" class="btn btn-primary">
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
                                                        <th>#</th>
                                                        <th>Nom</th>
                                                        <th>Type Classe</th>
                                                        <th>Niveau</th>
                                                        <th>Type de Formation</th>
                                                        <th>Filiere</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="odd gradeX" v-for="(classe, index) in classes" :key="index">
                                                        <td> {{ index + 1 }} </td>
                                                        <td> {{ classe.classe }} </td>
                                                        <td> {{ classe.type_classe }} </td>
                                                        <td> {{ classe.niveau }}</td>
                                                        <td> {{ classe.type_de_formation }} </td>
                                                        <td> {{ classe.unite_de_formation }} </td>

                                                        <td>
                                                            <a class="tblEditBtn" @click="openModal(classe)">
                                                                <i class="fa fa-pencil"></i>
                                                            </a>
                                                            <a class="tblDelBtn" @click="deleteClasse(classe)">
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
                        <div class="page-title">Nouvelle Classe</div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-right">
                        <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="{{ route('admin_index') }}">Tableau
                                de Bord</a>&nbsp;<i class="fa fa-angle-right"></i>
                        </li>
                        <li><a class="parent-item" href="{{ route('classe_create') }}">Classe</a>&nbsp;<i
                                class="fa fa-angle-right"></i>
                        </li>
                        <li class="active">Modifier Classe</li>
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
import FormulaireModification from './createClasseComponent.vue';




export default {
    name: "listeClasseCompenent",
    components: {
        FormulaireModification,
    },
    data() {
        return {
            form: new Form({
                'nom_classe':"",
                'type_classe':"",
                'niveau':"",
                'id_type_formation':"",
                'id_unite_de_formation':"",


            }),
            classes: [],
            editModal: false,
            idClasse: "",

        }
    },
    mounted() {
        this.get_classe();
        bus.on('classeAjoutee', () => { // Écouter l'événement de nouvelle utilisateur ajoutée
            this.get_classe(); // Mettre à jour la liste des utilisateurs
            
        });
        bus.on('classeDejaModifier', (eventData) => {
            this.editModal = eventData.editModal;
            this.get_classe();
        });
    },

    methods: {
        initDataTable() {
            this.$nextTick(() => {
                if (!$.fn.DataTable.isDataTable('#example47')) {
                    $('#example47').DataTable({
                        responsive: true,

                        // ... (autres options)
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
        get_classe() {
            axios.get('/classe/all')
                .then(response => {
                    const allclasse = response.data.classe
                    //console.log(allclasse);
                    const formattedClasse = allclasse.map(cl => {
                        return {
                            
                            id: cl.id,
                            classe: cl.nom_classe,
                            type_classe: cl.type_classe,
                            niveau: cl.niveau,
                            type_de_formation: cl.type_formation.intitule,
                            unite_de_formation: cl.unite_de_formation.nom_unite_formation,
                            id_type_formation: cl.id_type_formation,
                            id_unite_de_formation: cl.id_unite_de_formation,
                            editModal: true,
                            
                            
                        };
                      
                    });
                    console.log(formattedClasse);
                    this.classes = formattedClasse;
                    this.initDataTable();
                    console.log(this.classes);


                }).catch(error => {
                    Swal.fire('Erreur!', 'Une erreur est survenue lors de la recuperation des classes', 'error')
                });
        },

        changement(event) {
            this.interesser = event;
        },

        resetForm() {
            this.form.input = "";
            this.form.nom_classe="";
            this.form.type_classe="";
            this.form.niveau="";
            this.form.id_type_formation="";
            this.form.id_unite_de_formation=""; 
        },

        async deleteClasse(type) {
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
                    axios.delete(`/classe/delete/${type.id}`).then(resp => {
                        showDialog6("Classe supprimée avec succés")
                        this.get_classe();

                    }).catch(function (error) {
                        console.log(error);
                        showDialog3("Erreur lors de la suppression de la classe")
                    })
                }
            });
        },
        openModal(classe) {

            /*   this.idService = classe.id; */

            this.editModal = true;

            // Créez un objet avec les données à envoyer
            const eventData = {
                classe: classe,
                editModal: true
            };

            bus.emit('classeModifier', eventData);
            console.log("message envoyé")

        },


    }
}
</script>
