import './bootstrap';
import { createApp } from 'vue/dist/vue.esm-bundler.js';
import { Form } from 'vform';


import createTypeFormationComponent from './components/type_formation/createTypeFormationComponent.vue';
import listeTypeFormationComponent from './components/type_formation/listeTypeFormationComponent.vue';





import Swal from 'sweetalert2';
window.Form=Form;
window.Swal=Swal;

const app2=createApp({})


app2.component("type-formation-create", createTypeFormationComponent);
app2.component("type-formation-liste",listeTypeFormationComponent);




app2.mount('#app2')
