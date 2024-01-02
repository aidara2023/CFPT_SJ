<template>
    <div class="affichage">
        <div class="sections">
            <div class="utilisateurnv"
                style="height: 60px;align-items: flex-start;/* grid-template-columns: 2fr 1fr; */border: none;">


                <!-- Informations sur le paiement -->
                <!-- <div class="paiement"> -->


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
                <!-- actions -->
            </div>

            <div id="contenu-a-imprimer" style="margin-top: 0%;">

                <h1 style="color: var(--clr);outline: none;gap: 0;text-align: center;"
                    v-if="this.nom_classe_selected !== ''">
                    {{ nom_classe_selected.type_formation.intitule }} {{ nom_classe_selected.nom_classe }} {{
                        nom_classe_selected.niveau }} {{ nom_classe_selected.type_classe }}</h1>

                <div class="utilisateurnv" style="color: var(--clr);" v-if="eleves.length > 0">
                    <!-- informations sur l'utilisateur  -->
                    <div class="info">
                        <!-- <img src="" alt="" class="petite"> -->
                        <p class="texte image">Image</p>
                        <p class="texte matricule">Matricule</p>
                        <p class="texte prenom">Prénom </p>
                        <p class="texte nom">Nom</p>

                        <!-- <p class="texte classe">Classe</p> -->
                    </div>

                    <!-- Informations sur le paiement -->
                    <div class="paiement">
                        <!-- <p class="texte montant">Montant</p> -->
                        <!--  <p class="texte statut" style="background-color: transparent;height: auto;">Statut</p>
 -->
                        <p class="texte date">Date</p>
                    </div>

                    <!-- actions -->
                    <!-- <p class="actions texte" style="height: fit-content;">Actions</p> -->
                </div>

                <div class="utilisateurnv" v-if="eleves.length > 0" v-for="eleve in eleves">
                    <!-- informations sur l'utilisateur  -->
                    <div class="info">
                        <img :src="getImageUrl(eleve.photo)" alt="" class="petite">
                        <p class="texte matricule">{{ eleve.matricule }}</p>
                        <p class="texte prenom">{{ eleve.prenom }}</p>
                        <p class="texte nom">{{ eleve.nom }}</p>
                        <p class="texte nom">{{ eleve.nom }}</p>
                        <!-- <p class="texte classe">IIR1</p> -->
                    </div>

                    <!-- Informations sur le paiement -->
                    <div class="paiement">
                        <!-- <p class="texte b montant">700.000</p> -->
                        <!--  <div class="statut paye"></div> -->
                        <p class="texte date">12/11/2023</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import bus from '../../eventBus';
import html2pdf from 'html2pdf.js';

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
            nom_classe_selected: ""
            /* idService: "", */
        }
    },
    mounted() {
        bus.on('nouveauFiltre', (eventData) => {
            this.eleves = eventData.eleve_non_payers;
            this.nom_classe_selected = eventData.nom_classe_selected;
            console.log("this.nom_classe_selected");
            console.log(this.nom_classe_selected);
            if (this.eleves.length > 0) {
                this.viewbutton = true;
            }
        });

        console.log(this.eleves)
    },

    methods: {
        /*  getImageUrl(url){
             const timestamp= new Date().getTime();
             return url ? `${window.location.origin}/storage/app/${url}?t=${timestamp} ` : '';
         }, */

        getImageUrl(url) {
            return url ? `${window.location.origin}/storage/${url}` : '';
        },

        imprimerEnPDF() {
            const element = document.getElementById('contenu-a-imprimer'); // Remplacez 'contenu-a-imprimer' par l'ID de votre élément
            html2pdf(element);
        }

    }
}
</script>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             