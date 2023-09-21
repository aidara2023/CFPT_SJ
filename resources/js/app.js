import './bootstrap';
import { createApp } from 'vue/dist/vue.esm-bundler.js';
import { Form } from 'vform';
import loginComponent from './components/auth/loginComponent.vue';

const app=createApp({})
app.component("user-login", loginComponent);
app.mount('#app')
