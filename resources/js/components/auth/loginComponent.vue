<template>
  <!--
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
  </form>-->
  <!-- <form class="register-form" id="login-form">
    <div class="form-group">
      <div class="">
        <input name="uname" type="text" placeholder="Matricule" class="form-control input-height"
          v-model="form.matricule" />
      </div>
    </div>
    <div class="form-group">
      <div class="">
        <input name="pwd" type="password" placeholder="Mot de passe" class="form-control input-height"
          v-model="form.password" />
      </div>
    </div>
    <div class="form-group">
      <input type="checkbox" name="remember-me" id="remember-me" class="agree-term" v-model="rememberMe" />
      <label for="remember-me" class="label-agree-term"><span><span></span></span>Remember
        me</label>
    </div>
    <div class="form-group form-button">
      <button class="btn btn-round btn-primary" name="signin" id="signin" @click.prevent="verification()">Se
        Connecter</button>
    </div>
  </form> -->
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
          <!-- <i class="fi fi-rr-eye"></i>
          <i class="fi fi-rr-eye-crossed"></i> 
        btn-outline-secondary
        -->
      </button>
      <label for="floatingPassword"><i class="fa fa-lock"></i> Mot de passe</label>
    </div>





    <div style="width: 205px; height: 52px; left: 79px; top: 250px; position: absolute">
      <div
        style="width: 205px; height: 52px; left: 0px; top: 0px; position: absolute; background: linear-gradient(9deg, #9181F4 0%, #5038ED 100%); box-shadow: 0px 8px 21px rgb(80, 56, 237, .4); border-radius: 16px">
      </div>
      <a @click.prevent="verification()"
        style="width:100%;text-align:center; text-decoration:none; top: 8px; position: absolute; color: white; font-size: 20px; font-family: Poppins; font-weight: 400; word-wrap: break-word">
        Se connecterffffff</a>
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
        await this.form.post('connexion').then(({ data }) => {
          console.log(data.url)
          this.message = "";
          if (this.rememberMe) {
            // Stockez l'état dans un cookie ou localStorage
            // Exemple avec localStorage :
            localStorage.setItem('rememberMe', true);
          }
          if (data.statut !== "Error") {
  console.log("teste reussi");
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
