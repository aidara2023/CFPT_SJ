<template>
    <div class="affichage">
        <div class="sections">
            <div class="utilisateurnv"
                style="height: 60px;align-items: flex-start;/* grid-template-columns: 2fr 1fr; */border: none;">


                <!-- Informations sur le paiement -->
                <!-- <div class="paiement"> -->
                <div class="recherche" style="width: auto;">
                    <i class="fi fi-rr-search"></i>
                    <input type="text" name="" placeholder="Rechercher">
                    <!-- </div> -->
                </div>

                <div class="paiemen">
                    <button class="texte recherche mdl filtrer"
                        style="background-color: var(--clr); color: white;border: 1px solid;outline: none;gap: 0;">
                        <i class="fi fi-rr-bars-sort" style="color: white;"></i>
                        <span>Filtrer</span>
                    </button>
                </div>
                <!-- actions -->


            </div>
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
                <div class="info" >
                    <img :src="getImageUrl(eleve.photo)" alt="" class="petite">
                    <p class="texte matricule">{{ eleve.matricule }}</p>
                    <p class="texte prenom">{{ eleve.prenom }}</p>
                    <p class="texte nom">{{ eleve.nom }}</p>
                    <!-- <p class="texte classe">IIR1</p> -->
                </div>

                <!-- Informations sur le paiement -->
                  <div class="paiement">
            <!-- <p class="texte b montant">700.000</p> -->
           <!--  <div class="statut paye"></div> -->
            <p class="texte date">12/11/2023</p>
        </div>

                <!-- actions -->
                <!--   <div class="actions">
            <a href="#" class="texte b">
                <i class="fi fi-rr-angle-small-down"></i>
                <span class="modifier">Actions</span>
            </a>
            <a href="#" class="texte b encaisser mdl">
                <i class="fi fi-rr-money-check-edit"></i>
                <span class="">Encaisser</span>
            </a>

            <a href="" class="texte b">
                <i class="fi fi-rr-comment-alt-dots"></i>
                <span class="details">Détails</span>
            </a>

            <a href="#" class="texte b supprimer mdl">
                <i class="fi fi-rr-cross "></i>
                <span class="">Supprimer</span></a>
        </div> -->


            </div>
        </div>

    </div>
</template>

<script>
import bus from '../../eventBus';
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
            /*  editModal: false,
             idService: "", */
        }
    },
    mounted() {
        bus.on('nouveauFiltre', (eventData) => {
            this.eleves=eventData.eleve_non_payers;
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
        }

    } 
}
</script>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             