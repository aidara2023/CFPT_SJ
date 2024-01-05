<template>
    <div class="liste-alerte-container">
      <span id="alerteMessage" class="scrolling-text">
        {{ alertes.statut }}: {{ alertes.titre }}, {{ alertes.message }}
      </span>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
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
    white-space: nowrap;
    overflow: hidden;
    display: flex;
    align-items: center;
  }
  
  .scrolling-text {
    animation: scrollToLeft 15s linear infinite;
    white-space: nowrap;
    width: 100%; /* Utilise toute la largeur disponible */
    font-size: 25px;
  }
  
  @keyframes scrollToLeft {
    0% {
      transform: translateX(100%);
    }
    100% {
      transform: translateX(-100%);
    }
  }
  
  @media (max-width: 600px) {
    .scrolling-text {
      animation: scrollToLeftResponsive 15s linear infinite;
    }
  
    @keyframes scrollToLeftResponsive {
      0% {
        transform: translateX(100%);
      }
      100% {
        transform: translateX(-100%);
      }
    }
  }
  </style>
  