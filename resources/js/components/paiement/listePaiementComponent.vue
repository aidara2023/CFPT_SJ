<template>
    <!--     <div class="liste">
       <div class="table-container">
            <table>
                <thead>
                    <th>Matricule</th>
                    <th>Nom Complet</th>
                    <th>Classe</th>
                    <th>Année Académique</th>
                    <th>Mois</th>
                    <th>Montant</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                    <tr v-for="(paiement, index) in paiements" :key="index">
                        <td><span>{{ paiement.eleve.user.matricule }}</span></td>
                        <td> <span>{{ paiement.eleve.user.prenom }} {{ paiement.eleve.user.nom }}</span></td>
                        <td><span>{{ paiement.eleve.inscription.classe }} </span></td>
                        <td><span>{{ paiement.annee_academique }} </span></td>
                        <td><span>{{ paiement.mois }} </span></td>
                        <td><span>{{ paiement.montant }} </span></td>
                        <td>
                            <div class="boutons_actions">
                                <i class="fi fi-rr-edit modifier mdl" @click="openModal(paiement)" title="Modifier"></i>
                                <i class="fi fi-rr-comment-alt-dots details mdl" title="Détails"></i>
                                <i class="fi fi-rr-trash supprimer mdl" @click="deletepaiement(paiement)"
                                    title="Supprimer"></i>
                            </div>
                        </td>

                    </tr>
                </tbody>
            </table>
        </div>
   </div> -->
    <div class="page-content" v-if="!this.editModal">
        <div class="page-bar">
            <div class="page-title-breadcrumb">

                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" :href="'/admin/index'">Accueil</a>&nbsp;<i
                            class="fa fa-angle-right"></i>
                    </li>

                    <li class="active"> Paramétres &nbsp;<i class="fa fa-angle-right"></i> </li>
                    <li><a class="parent-item" :href="'/service/accueil'"> Salle</a>&nbsp;<i class="fa fa-angle-right"></i>
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
                        <li class="nav-item"><a href="#tab1" class="nav-link active" data-bs-toggle="tab">Paiement</a>
                        </li>

                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active fontawesome-demo" id="tab1">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card card-box">
                                        <div class="card-head">
                                            <header>Toutes les paiements</header>
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
                                                        <a :href="'/paiement/create'" id="addRow" class="btn btn-primary">
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
                                                        <th>Matricule</th>
                                                        <th>Nom</th>
                                                        <th>Prenom</th>
                                                        <th>Classe</th>
                                                        <th>Année Académique</th>
                                                        <th>Mois</th>
                                                        <th>Montant</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead> 
                                                <tbody>
                                                    <tr class="odd gradeX" v-for="(paiement, index) in paiements"
                                                        :key="index">
                                                        <td> {{ index + 1 }} </td>
                                                        <td> {{ paiement.matricule }} </td>
                                                        <td> {{ paiement.eleve_nom }}</td>
                                                        <td> {{ paiement.eleve_prenom }}</td>
                                                        <td> {{ paiement.classe }}</td>
                                                        <td> {{ paiement.annee }} </td>
                                                        <td> {{ paiement.mois }} </td>
                                                        <td> {{ paiement.montant }} </td>

                                                        <td>
                                                            <a class="tblEditBtn" @click="openModal(paiement)">
                                                                <i class="fa fa-pencil"></i>
                                                            </a>
                                                            <a class="tblDelBtn" @click="deletepaiement(paiement)">
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
                        <div class="page-title">Nouveau paiement</div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-right">
                        <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="{{ route('admin_index') }}">Tableau
                                de Bord</a>&nbsp;<i class="fa fa-angle-right"></i>
                        </li>
                        <li><a class="parent-item" href="{{ route('salle_create') }}">Salle</a>&nbsp;<i
                                class="fa fa-angle-right"></i>
                        </li>
                        <li class="active">Modifier Paiement</li>
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
import FormulaireModification from './createPaiementComponent.vue';



export default {
    name: "listeUserCompenent",
    components: {
        FormulaireModification,
    },
    data() {
        return {
            form: new Form({
                'nom_paiement': ""

            }),
            paiements: [],


        }
    },
    mounted() {
        this.get_paiement();
        bus.on('paiementAjoutee', () => { // Écouter l'événement de nouvelle utilisateur ajoutée
            this.get_paiement(); // Mettre à jour la liste des utilisateurs
        });

        bus.on('paiementDejaModifier', (eventData) => {
            this.editModal = eventData.editModal;
            this.get_paiement();
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
        get_paiement() {
            axios.get('/paiement/index')
                .then(response => {
                    const allpaiement = response.data.paiement;
                    console.log(allpaiement)
                    const formattedPaiement = allpaiement.map(paie => {
                        return {
                            id: paie.id,
                            matricule: paie.eleve.user.matricule,
                            eleve_prenom: paie.eleve.user.prenom,
                            eleve_nom: paie.eleve.user.nom,
                            //nom_service: utilisateur.personnel_admin_appui.map(ele => ele.service.nom_service).join(', '),
                            classe: paie.eleve.inscription.map(p => p.classe.nom_classe).join(', '),
                            annee: paie.concerner.map(p => p.annee_academique.intitule).join(', '),
                            mois: paie.concerner.map(p => p.mois.intitule).join(', '),
                            montant: paie.montant,
                            editModal: true,
                        };
                    });
                    this.paiements = formattedPaiement;
                    this.initDataTable();


                }).catch(error => {
                    Swal.fire('Erreur!', 'Une erreur est survenue lors de la recuperation des paiements', 'error')
                });
        },

        changement(event) {
            this.interesser = event;
        },

        resetForm() {
            this.form.input = "";
            this.form.nom_paiement = "";
        },

        async deletepaiement(type) {
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
                    axios.delete(`/paiement/delete/${type.id}`).then(resp => {
                        showDialog6("Paiment supprimée avec succés")
                        this.get_paiement();

                        /*  setTimeout(function(){
                             confirmation.close();
 
                             setTimeout(function(){
                                 confirmation.classList.remove("actif");
                         }, 100);
 
                         }, 2000); */

                    }).catch(function (error) {
                        console.log(error);
                        showDialog3("Erreur lors de la suppression du paiement")
                    })
                }
            });
        },

        openModal(paiement) {
            this.editModal = true;
            // Créez un objet avec les données à envoyer
            const eventData = {
                paiement: paiement,
                editModal: true
                // Ajoutez d'autres propriétés si nécessaire
            };
            bus.emit('paiementModifier', eventData);
        },




    }
}
</script>