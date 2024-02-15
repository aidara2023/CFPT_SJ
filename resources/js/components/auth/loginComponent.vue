<template>
  <form action="votre_action.php" method="post" id="login-form">

    <div class="form-floating mb-2 mt-4" style="margin-left: 9%;">

      <input v-model="form.matricule" type="email" class="form-control ml-6" id="floatingInput"
        placeholder="name@example.com"
        style="width: 88%; background: rgba(255, 255, 255, 0.66); box-shadow: -2px 5px 10.899999618530273px -2px #595353; border-radius: 16px; backdrop-filter: blur(29.50px)">
      <label for="floatingInput"><i class="fa fa-user"></i> Matricule</label>

    </div>
    <div class="form-floating mt-4 " style="margin-left: 9%;">
      <input v-model="form.password" :type="passwordFieldType" class="form-control" id="floatingPassword" placeholder="Password"
          style="width: 88%; background: rgba(255, 255, 255, 0.66); box-shadow: -2px 5px 10.899999618530273px -2px #59535300; border-radius: 16px; backdrop-filter: blur(29.50px)">
      <button class=" border-0 position-absolute top-50 end-0 translate-middle-y"
          @click.prevent="togglePasswordVisibility" type="button" id="togglePassword" style="margin-right: 15%; background-color: white;">
          <i class="fi" :class="passwordFieldType === 'password' ? 'fi-rr-eye' : 'fi-rr-eye-crossed'" ></i>
      </button>
      <label for="floatingPassword"><i class="fa fa-lock"></i> Mot de passe</label>
    </div>

    <div style="width: 205px; height: 52px; left: 79px; top: 250px; position: absolute">
      <div
        style="width: 205px; height: 52px; left: 0px; top: 0px; position: absolute; background: linear-gradient(9deg, #9181F4 0%, #5038ED 100%); box-shadow: 0px 8px 21px rgb(80, 56, 237, .4); border-radius: 16px">
      </div>
      <a @click.prevent="verification()" href=""
        style="width:100%;text-align:center; text-decoration:none; top: 8px; position: absolute; color: white; font-size: 20px; font-family: Poppins; font-weight: 400; word-wrap: break-word">
        Se connecter</a>
    </div>
  </form>
</template>

<script>
import Form from 'vform';

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
      bouton: "",
      rememberMe: false,
      passwordVisible: false,
      passwordFieldType: 'password'
    };
  },
 /*  computed: {
    passwordFieldType() {
      return this.passwordVisible ? 'text' : 'password';
    },
  }, */
  mounted() {
    //$(".tstWarning").on("click", this.afficherToastWarning);
    // ... Ajoutez des écouteurs pour les autres types de toast
  },
  methods: {
  
  
    togglePasswordVisibility() {
      this.passwordFieldType = this.passwordFieldType === 'password' ? 'text' : 'password';
    },
    afficherToastInfo(message) {
      $.toast({
        heading: 'Erreur',
        text: message,
        position: 'top-right',
        loaderBg: '#ff6849',
        icon: 'error',
        hideAfter: 3500
      });
    },
    async verification() {
      /*   this.message = document.querySelector('.b');
        this.bouton = document.querySelector('.suivant'); */

      if (this.form.matricule !== "" && this.form.password !== "") {
        await this.form.post('/connexion').then(({ data }) => {
          console.log("bonjour")
          this.message = "";
          if (this.rememberMe) {
            // Stockez l'état dans un cookie ou localStorage
            // Exemple avec localStorage :
            localStorage.setItem('rememberMe', true);
          }
          if (data.statut !== "Error") {
            window.location.href = data.url;
          } else {
            if (data.message === "L'utilisateur est bloqué") {
              this.message = "Vous avez été bloqué. Rapprochez-vous de votre administrateur pour plus d\'informations."
              this.afficherToastInfo(this.message);
            } else {
              this.message = "Matricule ou mot de passe incorrect."
              this.afficherToastInfo(this.message);
            }
          }
        }).catch(error => {
          // Gestion des erreurs
        });
      } else {
        this.message = "Tous les champs sont obligatoires."
        this.afficherToastInfo(this.message);
      }
    }
  }
};
</script>

<style>
.text-danger {
  color: red;
}

.flash-message {
  position: fixed;
  top: 10px;
  left: 10px;
  /* Modifier la propriété 'left' pour déplacer le message à gauche */
  padding: 10px;
  border-radius: 5px;
  z-index: 9999;

}

.error {
  background-color: #ce0404;
  color: #FFFFFF;
}
</style>
