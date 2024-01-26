<template>
    <!--    <div class="affichage">
        <div class="sections">
            <div class="utilisateurnv"
                style="height: 60px;align-items: flex-start;border: none;">

                <div class="paiemen" style="display: flex;">
                    <button class="texte recherche mdl filtrer"
                        style="background-color: var(--clr); color: white;border: 1px solid;outline: none;gap: 0;">
                        <i class="fi fi-rr-bars-sort" style="color: white;"></i>
                        <span>Filtrer</span>
                    </button>
                </div>
                <div class="paiemen" style="display: flex;" v-if="this.viewbutton === true">
                    <button class="texte recherche filtrer"
                        style="background-color: var(--clr); color: white;border: 1px solid;outline: none;gap: 0;margin-left: 10%;"
                        @click="imprimerEnPDF()">
                        <i class="fi fi-rr-bars-sort" style="color: white;"></i>
                        <span>Imprimer en PDF</span>
                    </button>
                </div>
            </div>

            <div id="contenu-a-imprimer" style="margin-top: 0%;">

                <h1 style="color: var(--clr);outline: none;gap: 0;text-align: center;"
                    v-if="this.nom_classe_selected !== ''">
                    {{ nom_classe_selected.type_formation.intitule }} {{ nom_classe_selected.nom_classe }} {{
                        nom_classe_selected.niveau }} {{ nom_classe_selected.type_classe }}</h1>
                        <h1 style="color: var(--clr);outline: none;gap: 0;text-align: center;"
                    v-if="this.nom_classe_selected !== ''">
                    {{ nom_classe_selected.type_formation.intitule }} {{ nom_classe_selected.nom_classe }} {{
                        nom_classe_selected.niveau }} {{ nom_classe_selected.type_classe }}</h1>

                <div class="utilisateurnv" style="color: var(--clr);" v-if="eleves.length > 0">
                    <div class="info">
                        <p class="texte image">Image</p>
                        <p class="texte matricule">Matricule</p>
                        <p class="texte prenom">Prénom </p>
                        <p class="texte nom">Nom</p>

                    </div>
                    <div class="paiement">
                        <p class="texte date">Date</p>
                    </div>

                </div>

                <div class="utilisateurnv" v-if="eleves.length > 0" v-for="eleve in eleves">
                    <div class="info">
                        <img :src="getImageUrl(eleve.photo)" alt="" class="petite">
                        <p class="texte matricule">{{ eleve.matricule }}</p>
                        <p class="texte prenom">{{ eleve.prenom }}</p>
                        <p class="texte nom">{{ eleve.nom }}</p>
                        <p class="texte nom">{{ eleve.nom }}</p>
                    </div>

                    <div class="paiement">
                        <p class="texte date">12/11/2023</p>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <div class="page-content" v-if="this.viewListe">
        <div class="page-bar">
            <div class="page-title-breadcrumb">

                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" :href="'/caissier/accueil'">Tableau de
                            bord</a>&nbsp;<i class="fa fa-angle-right"></i>
                    </li>

                    <li class="active"> Récouvrement </li>

                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tabbable-line">
                    <ul class="nav customtab nav-tabs" role="tablist">
                        <button @click="filtre()"
                            class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn-info"
                            data-bs-toggle="tab">Filtre</button>



                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active fontawesome-demo" id="tab1">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card card-box">
                                        <div class="card-head">
                                            <header v-if="this.nom_classe_selected !== ''">Liste récouvrement {{
                                                nom_classe_selected.type_formation.intitule }} {{
        nom_classe_selected.nom_classe }} {{
        nom_classe_selected.niveau }} {{ nom_classe_selected.type_classe }}</header>

                                            <div class="tools">
                                                <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
                                                <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
                                                <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                                            </div>
                                        </div>
                                        <div class="card-body ">
                                            <!--  <div class="row">
                                                <div class="col-md-6 col-sm-6 col-6">
                                                    <div class="btn-group">
                                                        <a :href="'/service/create'" id="addRow" class="btn btn-primary">
                                                            Ajouter <i class="fa fa-plus text-white"></i>
                                                        </a>

                                                    </div>
                                                </div>
                                            </div> -->
                                            <table
                                                class="table table-striped table-bordered table-hover table-checkable order-column valign-middle"
                                                id="example47">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Image</th>
                                                        <th> Matricule </th>
                                                        <th> Nom</th>
                                                        <th> Prenom</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="odd gradeX" v-if="eleves.length > 0"
                                                        v-for="(eleve, index) in eleves" :key="index">
                                                        <td> {{ index + 1 }} </td>
                                                        <td class="patient-img"> <img :src="getImageUrl(eleve.photo)"
                                                                alt="Etu"></td>
                                                        <td>{{ eleve.matricule }} </td>
                                                        <td> {{ eleve.nom }}</td>
                                                        <td> {{ eleve.prenom }}</td>
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
</template>


<script>
import bus from '../../eventBus';
import html2pdf from 'html2pdf.js';
import datatable from 'datatables.net-bs5';

import axios from 'axios';
import Form from 'vform';



export default {
    name: "listeUserCompenent",
    data() {
        return {
            /*      form: new Form({
                     'nom_service': "",
                     'id_user': "",
                     'id_direction': ""
     
                 }), */
            eleves: [],
            viewbutton: false,
            nom_classe_selected: "",
            viewListe: false,
            /* idService: "", */
        }
    },
    mounted() {
        bus.on('nouveauFiltre', (eventData) => {
            this.eleves = eventData.eleve_non_payers;
            this.initDataTable();
            this.nom_classe_selected = eventData.nom_classe_selected;
            this.viewListe = eventData.viewListe;
            console.log("this.nom_classe_selected");
            console.log(this.nom_classe_selected);
            if (this.eleves.length > 0) {
                this.viewbutton = true;
            }
        });

        console.log(this.eleves)
    },

    methods: {
        initDataTable() {
            this.$nextTick(() => {
                if (!$.fn.DataTable.isDataTable('#example47')) {
                    $('#example47').DataTable({
                        responsive: true,
                        "autoWidth": true,
                        paginate: false,
                        searching: false, // Désactive la barre de recherche


                        dom: 'Bfrtip', // Affiche les boutons
                        buttons: [
                            'copy', 'csv', 'excel', 'pdf', 'print'
                        ],

                        language: {
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

        getImageUrl(url) {
            return url ? `${window.location.origin}/storage/${url}` : '';
        },

        imprimerEnPDF() {
            const element = document.getElementById('contenu-a-imprimer'); // Remplacez 'contenu-a-imprimer' par l'ID de votre élément
            html2pdf(element);
        },

        filtre() {
            const eventData = {
                viewListe: false
            };

            bus.emit('ancienFiltre', eventData);
        },

    }
}
</script>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             