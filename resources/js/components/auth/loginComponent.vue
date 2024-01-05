<template>
  <form action="" method="">
    <h1>Connexion</h1>

    <div class="informationsLogin">
      <div class="champ">
        <label for="matricule"><span>Matricule</span></label>
        <input type="text" id="matricule" name="matricule" placeholder="Matricule" v-model="form.matricule">
      </div>
      <div class="champ">
        <label for="mdp">Mot de passe</label>
        <input type="password" id="mdp" name="mdp" placeholder="Mot de passe" v-model="form.password">
      </div>
    </div>

    <div class="groupe_champs">
      <p class="b">{{ message }}</p>
      <button type="submit" class="suivant" @click.prevent="verification()">
        <span data-statut="visible">Je me connecte</span>
      </button>
      <p class="text-danger" v-if="erreur" style="color: white;">{{ errorMessage }}</p>
    </div>
  </form>
</template>

<script>
import Form from 'vform';
import axios from 'axios';

export default {
  name: "loginComponent",
  data() {
    return {
      form: new Form({
        matricule: "",
        password: ""
      }),
      message: "",
      errorMessage: "",
      erreur: false,
      bouton: ""
    };
  },
  methods: {
    async verification() {
      this.message = document.querySelector('.b');
      this.bouton = document.querySelector('.suivant');

      if (this.form.matricule !== "" && this.form.password !== "") {
        await this.form.post('/connexion').then(({ data }) => {
          this.message = "";
          this.bouton.innerHTML = "<span data-statut='visible'> Vérification</span><div class='roue'></div>";
          if (data.statut !== "Error") {
            window.location.href = data.url;
          } else {
            if (data.message === "L'utilisateur est bloqué") {
              this.errorMessage = "Vous avez été bloqué. Rapprochez-vous de votre administrateur pour plus d'informations.";
            } else {
              this.errorMessage = "Matricule ou mot de passe incorrect";
            }
            this.bouton.style.backgroundColor = 'var(--rouge)';
            this.bouton.innerHTML = "<span data-statut='visible' > Réessayer</span>";
            this.bouton.style.color = 'white';

            this.erreur = true;

            setTimeout(() => {
              this.erreur = false;
              this.errorMessage = "";
            }, 5000);
          }
        }).catch(error => {
          // Gestion des erreurs
        });
      } else {
        this.erreur = true;
        this.errorMessage = "Tous les champs sont obligatoires";
      }
    }
  }
};
</script>

<style>
.text-danger {
  color: red;
}
</style>
