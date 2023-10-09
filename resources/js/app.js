import './bootstrap';
import { createApp } from 'vue/dist/vue.esm-bundler.js';
import { Form } from 'vform';
import loginComponent from './components/auth/loginComponent.vue';
import accueilFormateurComponent from './components/formateur/accueilComponent.vue' ;
import listeNoteComponent from './components/formateur/listeNoteComponent.vue';
import profilComponent from './components/formateur/profilComponent.vue';
import inscriptionComponent from './components/eleve/inscriptionComponent.vue';
import utilisateurComponent from './components/utilisateur/utilisateurComponent.vue';
import createEleveComponent from './components/eleve/createEleveComponent.vue';
import createCaissierComponent from './components/caissier/createCaissierComponent.vue';
import createBibliothecaireComponent from './components/bibliothecaire/createBibliothecaireComponent.vue';
import createTuteurComponent from './components/tuteur/createTuteurComponent.vue';
import createEditeurComponent from './components/editeur/createEditeurComponent.vue';
import createEditionComponent from './components/edition/createEditionComponent.vue';
import createCategorieComponent from './components/categorie/createcategorieComponent.vue';
import createAuteurComponent from './components/auteur/createauteurComponent.vue';
import createRayonComponent from './components/rayon/createrayonComponent.vue';
import createLivreComponent from './components/livre/createlivreComponent.vue';
import createPaiementComponent from './components/paiement/createpaiementComponent.vue';
import createAnneeComponent from './components/annee_academique/createAnneeComponent.vue';

import Swal from 'sweetalert2';
window.Form=Form;
window.Swal=Swal;

const app=createApp({})
app.component("user-login", loginComponent);
app.component("accueil-formateur", accueilFormateurComponent);
app.component("listenote-formateur", listeNoteComponent );
app.component("profil-formateur", profilComponent );
app.component("inscription-eleve", inscriptionComponent);
app.component("utilisateur-create", utilisateurComponent);
app.component("create-eleve", createEleveComponent);
app.component("caissier-create", createCaissierComponent);
app.component("tuteur-create", createTuteurComponent);
app.component("editeur-create", createEditeurComponent);
app.component("edition-create", createEditionComponent);
app.component("categorie-create", createCategorieComponent);
app.component("auteur-create", createAuteurComponent);
app.component("rayon-create", createRayonComponent);
app.component("livre-create", createLivreComponent);
app.component("paiement-create", createPaiementComponent);
app.component("annee-create", createAnneeComponent);

app.mount('#app')
