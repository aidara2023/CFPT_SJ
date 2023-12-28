<template>
   
   <div class="liste-alerte-container">
    <strong id="alerteTitre"></strong>
    <span id="alerteMessage"></span>
  </div>   
</template>

<script>
import bus from '../../eventBus';
import axios from 'axios';
import Form from 'vform';
import Swal from 'sweetalert2';

export default {
    name: "createAlerteCompenent",
    data() {
        return {
            alertes: "",
       
        }
    },

    mounted() {
       this.get_alert();
    },



    methods: {

        get_alert() {
            axios.get('/alerte/showLatestAlert')
                .then(response => {
                    this.alertes = response.data.alerte
                    console.log(this.alertes)
                    if (this.alertes) {
                        // Mettez à jour les éléments HTML avec les données de l'alerte
                        document.getElementById('alerteTitre').innerText = this.alertes.titre;
                        document.getElementById('alerteMessage').innerText = this.alertes.message;
                        document.getElementById('messageDeroulant').style.display = 'block';
                    }
                  

                })

                .catch(error => {
                    console.error('Erreur lors de la récupération de la dernière alerte', error);
                });
        }


    }
}
</script>

<style scoped>
.liste-alerte-container {
  white-space: nowrap;   /* Empêche le texte de passer à la ligne */
  overflow: hidden;      /* Masque tout contenu qui dépasse */
  animation: scrollToLeft 20s linear infinite; /* Animation de défilement */
}

@keyframes scrollToLeft {
  0% {
    transform: translateX(100%);
  }
  100% {
    transform: translateX(-130%);
  }
}
</style>
