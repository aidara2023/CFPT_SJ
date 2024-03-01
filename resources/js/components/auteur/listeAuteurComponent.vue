<template>
<div class="page-content" v-if="!this.editModal">
        <div class="page-bar">
            <div class="page-title-breadcrumb">

                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" :href="'/bibliothecaire/accueil'">Accueil</a>&nbsp;<i
                            class="fa fa-angle-right"></i>
                    </li>

                    <li class="active"> Paramétres &nbsp;<i class="fa fa-angle-right"></i></li>
                    <li><a class="parent-item" :href="'/auteur/accueil'"> Auteur </a>&nbsp;<i
                            class="fa fa-angle-right"></i>
                    </li>
                    <li class="active">Liste auteur</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tabbable-line">

                    <ul class="nav customtab nav-tabs" role="tablist">
                        <li class="nav-item"><a href="#tab1" class="nav-link active" data-bs-toggle="tab">Auteur</a>
                        </li>

                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active fontawesome-demo" id="tab1">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card card-box">
                                        <div class="card-head">
                                            <header>Tous les auteurs</header>
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
                                                        <a :href="'/auteur/create'" id="addRow" class="btn btn-primary">
                                                            Ajouter <i class="fa fa-plus text-white"></i>
                                                        </a>

                                                    </div>
                                                </div>
                                            </div>
                                            <table
                                                class="table table-striped table-bordered table-hover table-checkable order-column valign-middle"
                                                id="example47"  style="width: 100%;">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th> Prénom </th>
                                                        <th> Nom </th>
                                                        <th>Nombre de Livre</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="odd gradeX" v-for="(auteur, index) in auteurs"
                                                        :key="index">
                                                        <td>{{ index + 1 }}</td>

                                                        <td class="left"> {{ auteur.intitule }} </td>
                                                        <td class="left"> {{ auteur.nbr_livre }} </td>


                                                        <td class="left">
                                                            <a class="tblEditBtn" @click="openModal(auteur)">
                                                                <i class="fa fa-pencil"></i>
                                                            </a>
                                                            <a class="tblDelBtn" @click="deleteAuteur(auteur)">
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
                        <div class="page-title">Nouveau auteur</div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-right">
                        <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="{{ route('bibliothecaire_accueil') }}">Tableau
                                de Bord</a>&nbsp;<i class="fa fa-angle-right"></i>
                        </li>
                        <li><a class="parent-item" :href="'/auteur/create'">Auteur</a>&nbsp;<i
                                class="fa fa-angle-right"></i>
                        </li>
                        <li class="active">Modifier Auteur</li>
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
import FormulaireModification from './createAuteurComponent.vue';



  export default {
   name:"listeAuteurComponent",
   components: {
        FormulaireModification,
    },
   data(){
       return {
           form:new Form({
               'nom':""

           }),
           auteurs: [],
           idAuteur: "",
           editModal: false,


       }
   },
   mounted(){
       this.get_auteur();
       bus.on('auteurAjoutee', () => { // Écouter l'événement de nouvelle utilisateur ajoutée
           this.get_auteur(); // Mettre à jour la liste des utilisateurs
       });
   },

   methods:{
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
       get_auteur(){
           axios.get('/auteur/index')
           .then(response => {
            const allauteur = response.data.auteur
            console.log( allauteur)
                    const formattedAuteur = allauteur.map(aut => {
                        return {
                            id: aut.id,
                            intitule: aut.nom_auteur,
                            nbr_livre:aut.livre.length,
                            editModal: true,
                        };
                    });

                    this.auteurs = formattedAuteur;
                    this.initDataTable();
                   

           }).catch(error=>{
           Swal.fire('Erreur!','Une erreur est survenue lors de la recuperation des auteurs','error')
           });
       },
       changement(event) {
            this.interesser = event;
        },

       resetForm(){
           this.form.input="";
           this.form.nom_auteur="";
          
       },

       async deleteAuteur(type) {
           Swal.fire({
               title: 'Êtes-vous sûr de vouloir supprimer?',
               text: "Cette action sera irréversible!",
               icon: 'warning',
               showCancelButton: true,
               confirmButtonColor: '#3085d6',
               cancelButtonColor: '#d33',
               confirmButtonText: 'Oui, supprimer!',
               cancelButtonText: 'Annuler'
           }).then((result) => {
               if (result.isConfirmed) {
                   axios.delete(`/auteur/delete/${type.id}`).then(resp => {
                    showDialog6("Auteur supprimé avec succés")
  
                    this.get_auteur();

                   }).catch(function (error) {
                       console.log(error);
                       showDialog3("Une erreur est survenue lors de la suppression de l'auteur")

                   })
               }
           });
       },
       openModal(auteur) {
          

          this.editModal = true;

          // Créez un objet avec les données à envoyer
          const eventData = {
             auteur: auteur,
              editModal: this.editModal,
              // Ajoutez d'autres propriétés si nécessaire
          };

          bus.emit('auteurModifier', eventData);

       
      },



   }
}
</script>
