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
import createMatiereComponent from './components/matiere/createMatiereComponent.vue';
import createClasseComponent from './components/classe/createClasseComponent.vue';
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
app.component("create-bibliothecaire", createBibliothecaireComponent);
app.component("create-matiere", createMatiereComponent);
app.component("create-classe", createClasseComponent);




app.mount('#app')
