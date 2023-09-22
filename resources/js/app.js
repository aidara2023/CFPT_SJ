import './bootstrap';
import { createApp } from 'vue/dist/vue.esm-bundler.js';
import { Form } from 'vform';
import loginComponent from './components/auth/loginComponent.vue';
import accueilFormateurComponent from './components/formateur/accueilComponent.vue' ;
window.Form=Form;

const app=createApp({})
app.component("user-login", loginComponent);
app.component("accueil-formateur", accueilFormateurComponent);
app.mount('#app')
