<template>
    <div class="liste-alerte-container">
      <strong id="alerteTitre">{{ alertes.titre }}</strong>
      <span id="alerteMessage" class="word">{{ alertes.message }}</span>
    </div>
  </template>
  
  <script>
  import bus from '../../eventBus';
  import axios from 'axios';
  import Form from 'vform';
  import Swal from 'sweetalert2';
  
  export default {
    name: "createAlerteComponent",
    data() {
      return {
        alertes: "",
      };
    },
    mounted() {
      this.get_alert();
    },
    methods: {
      get_alert() {
        axios.get('/alerte/showLatestAlert')
          .then(response => {
            this.alertes = response.data.alerte;
            console.log(this.alertes);
  
            if (this.alertes) {
              document.getElementById('messageDeroulant').style.display = 'block';
            }
          })
          .catch(error => {
            console.error('Erreur lors de la récupération de la dernière alerte', error);
          });
      }
    }
  };
  </script>
  
  <style scoped>
  .liste-alerte-container {
    white-space: nowrap;   /* Empêche le texte de passer à la ligne */
    overflow: hidden;      /* Masque tout contenu qui dépasse */
    animation: scrollMessage 10s linear infinite; /* Animation de défilement */
    font-size: 2vw; 
  }
  .cadre {
  border: 2px solid #000;  /* Style de bordure du cadre */
  padding: 10px;          /* Espace intérieur du cadre */
}
  
  @keyframes scrollMessage {
    0% {
      transform: translateX(100%);
    }
    100% {
      transform: translateX(-100%);
    }
  }
  </style>
  