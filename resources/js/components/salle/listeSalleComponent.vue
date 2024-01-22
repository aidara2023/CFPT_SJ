<template>
    <!--  <div class="liste"> -->
    <!--  <div class="affichage">
       <div class="avant" style=" margin-left: 80%;">
     
           <a href="#">
               <button class="texte ajout mdl" > <i class="fi fi-rr-plus"></i><span>Ajouter</span></button>
           </a>
       </div>
       <h1 class="texte">Salle</h1>

   <div class="sections" v-for="(salle, index) in salles" :key="index">
           <div class="utilisateur">
               <p class="texte" id="n">{{ salle.intitule }}</p>
               <p class="texte" id="n">{{ salle.nombre_place }} </p>
               <p class="texte" id="n" v-if="salle.batiment.intitule">{{ salle.batiment.intitule}}</p>
               <div  class="presences">
                    <a href="#" class="texte b">
                        <i class="fi fi-rr-bars-sort"></i>
                        <span class="modifier">Actions</span>

                    </a>
                   <a href="#" class="texte b" @click="openModal(salle)">
                       <i class="fi fi-rr-edit"></i>
                       <span class="modifier mdl">Modifier</span>
                   </a>
                   <a href="#" class="texte b">
                       <i class="fi fi-rr-comment-alt-dots"></i>
                       <span class="details">Détails</span>
                   </a>
                   <a href="#" class="texte b" @click="deleteSalle(salle)" > 
                       <i class="fi fi-rr-cross"></i>
                       <span class="supprimer mdl">Supprimer</span>
                   </a>
                  
               </div> -->
    <!--  </div>
       </div> -->

    <!-- <div class="table-container">
            <table>
                <thead>
                    <th>Salle</th>
                    <th>Nombre de place</th>
                    <th>Batiment</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                    <tr v-for="(salle, index) in salles" :key="index">
                        <td><span>{{ salle.intitule }}</span></td>
                        <td> <span>{{ salle.nombre_place }}</span></td>
                        <td><span>{{ salle.batiment.intitule }} </span></td>
                        <td>
                            <div class="boutons_actions">
                                <i class="fi fi-rr-edit modifier mdl" @click="openModal(salle)" title="Modifier"></i>
                                <i class="fi fi-rr-comment-alt-dots details mdl" title="Détails"></i>
                                <i class="fi fi-rr-trash supprimer mdl" @click="deleteSalle(salle)"
                                    title="Supprimer"></i>
                            </div>
                        </td>

                    </tr>

                </tbody>
            </table>
        </div>

   </div>
 -->

    <!-- <span class="fond "></span> -->
    <div class="page-content" v-if="!this.editModal">
        <div class="page-bar">
            <div class="page-title-breadcrumb">

                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" :href="'/admin/index'">Accueil</a>&nbsp;<i
                            class="fa fa-angle-right"></i>
                    </li>

                    <li class="active"> Paramétres &nbsp;<i
                            class="fa fa-angle-right"></i>  </li>  
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
                        <li class="nav-item"><a href="#tab1" class="nav-link active" data-bs-toggle="tab">Salle</a>
                        </li>

                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active fontawesome-demo" id="tab1">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card card-box">
                                        <div class="card-head">
                                            <header>Toutes les salles</header>
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
                                                        <a :href="'/salle/create'" id="addRow" class="btn btn-primary">
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
                                                        <th>Identifiant</th>
                                                        <th>Salle</th>
                                                        <th>Nombre de place</th>
                                                        <th>Batiment</th>

                                                        <th> Action </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="odd gradeX" v-for="(salle, index) in salles" :key="index">
                                                        <td> {{ index + 1 }} </td>
                                                        <td> {{ salle.salle }} </td>
                                                        <td> {{ salle.nombre_de_place }}</td>
                                                        <td> {{ salle.batiment }} </td>

                                                        <td>
                                                            <a class="tblEditBtn" @click="openModal(salle)">
                                                                <i class="fa fa-pencil"></i>
                                                            </a>
                                                            <a class="tblDelBtn" @click="deleteSalle(salle)">
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
                        <div class="page-title">Nouvelle Salle</div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-right">
                        <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="{{ route('admin_index') }}">Tableau
                                de Bord</a>&nbsp;<i class="fa fa-angle-right"></i>
                        </li>
                        <li><a class="parent-item" href="{{ route('salle_create') }}">Salle</a>&nbsp;<i
                                class="fa fa-angle-right"></i>
                        </li>
                        <li class="active">Modifier Salle</li>
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
import FormulaireModification from './createSalleComponent.vue';



export default {
    name: "listeUserCompenent",
    components: {
        FormulaireModification,
    },
    data() {
        return {
            form: new Form({
                'intitule': "",
                'nombre_place': "",
                'id_batiment': "",

            }),
            salles: [],
            editModal: false,
            idSalle: "",


        }
    },
    mounted() {
        this.get_salle();
        bus.on('salleAjoutee', () => { // Écouter l'événement de nouvelle utilisateur ajoutée
            this.get_salle(); // Mettre à jour la liste des utilisateurs
        });
        bus.on('salleDejaModifier', (eventData) => {
            this.editModal = eventData.editModal;
            this.get_salle();
        });
    },

    methods: {
        initDataTable() {

            this.$nextTick(() => {
                // Initialiser DataTable sur la table avec l'id 'exemple1' si elle n'a pas déjà été initialisée


                // Initialiser DataTable sur la table avec l'id 'example47' si elle n'a pas déjà été initialisée
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
        get_salle() {
            axios.get('/salle/index')
                .then(response => {

                    const allsalle = response.data.salle;

                    const formattedSalle = allsalle.map(salle => {
                        return {
                            id: salle.id,
                            salle: salle.intitule,
                           nombre_de_place: salle.nombre_place,
                            batiment: salle.batiment.intitule,
                            id_batiment: salle.batiment.id,
                            editModal: true,
                        };
                    });
                    this.salles = formattedSalle;
                    this.initDataTable();
                    console.log(this.salles);

                }).catch(error => {
                    Swal.fire('Erreur!', 'Une erreur est survenue lors de la recuperation des salles', 'error')
                });
        },

        changement(event) {
            this.interesser = event;
        },

        resetForm() {
            this.form.input = "";
            this.form.intitule = "";
            this.form.nombre_place = "";
            this.form.id_batiment = "";
        },

        async deleteSalle(type) {
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
                    axios.delete(`/salle/delete/${type.id}`).then(resp => {
                        this.get_salle();

                        showDialog6("Salle supprimée avec succés")

                    }).catch(function (error) {
                        console.log(error);
                        showDialog3("Erreur lors de la suppression du service")

                    })
                }
            });
        },
        openModal(salle) {

           /*  this.idSalle = salle.id; */

            this.editModal = true;

            // Créez un objet avec les données à envoyer
            const eventData = {
                salle: salle,
                editModal:true
                // Ajoutez d'autres propriétés si nécessaire
            };

            bus.emit('salleModifier', eventData);
            console.log("message envoyé")

           
        },



    }
}
</script>
