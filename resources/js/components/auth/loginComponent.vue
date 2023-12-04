<template>
<!-- <form>
    <div class="connexion">
        <input type=""  v-model="form.matricule" id="matricule" placeholder="Matricule">
        <input type="password"  v-model="form.password" id="mot_de_passe" placeholder="Mot de passe">
    </div>

    <div class="bloc">
        <input type="submit"  @click.prevent="verification()" value="Je me connecte">
        <input type="submit" value="Mot de passe oublié ?" id="mot_de_passe_oublie">
    </div>
</form> -->

<form class="" action="" method="">
          <h1>connexion</h1>

          <div class="informations">

          
            <div class="champ">
              <label for="matricule"><span >Matricule</span></label>
              <input type="text" id="matricule" name="matricule" v-model="form.matricule">
            </div>
            <div class="champ">
              <label for="mdp">Mot de passe</label>
              <input type="password" id="mdp" name="mdp" v-model="form.password">
            </div>

          </div>
            <div class="groupe_champs">
                <p  class="b">{{message}}</p>
                <!--               <span v-if="erreur===true" class="danger b">{{ message }}</span>
 -->          <button type="submit" class="suivant"  @click.prevent="verification()"><span data-statut="visible" > Je me connecte</span></button>
              <button type="submit" class="mdp_oublie"><span data-statut="visible">Mot de passe oublié ?</span></button>
            </div>
        </form>
</template>


<script>
import Form from 'vform';

export default {
    name: "loginComponent",
    data(){
        return{
            form: new Form({
                'matricule':"",
                'password':""
            }),
            message:"",
            erreur:false,
            bouton:""
        
        }
    },
    methods: { 
        async verification(){
                    this.message = document.querySelector('.b');
                    this.bouton = document.querySelector('.suivant');

            if(this.form.matricule!="" && this.form.password!=""){
                await this.form.post('/connexion').then(({data})=>{
                    this.message= "";
                    this.bouton.innerHTML = "<span data-statut='visible'> Vérification</span><div class='roue'></div>"
                    if(data.statut!="Error"){
                    
                        window.location.href=data.url;
                    }else{

                    
                    
                   /*  this.message.classList.add('danger'); */
                    //this.message.style.color = 'red';
                    this.bouton.style.backgroundColor = 'var(--rouge)';
                    this.bouton.innerHTML = "<span data-statut='visible' > Réessayer</span>";
                    this.bouton.style.color = 'white';

                   /*  alert(this.message.textContent)  */
                   this.message = "Matricule ou mot de passe incorrect";
                        this.erreur=true;
                    }
                }).catch(error=>{
                    alert(error);
                    if(error.response.status===500){
                        this.erreur=true;
                        this.message="Page introuvable";
                    }
                    if(error.response.status===404){
                        this.erreur=true;
                        this.message="Erreur 419";
                    }
                })
            }else{
                this.erreur=true;
                this.message.style.color = 'var(--rouge)';
                this.message="Tous les champs sont obligatoires";
            }

        },
     },
}



    
</script>

<style>
 .text-danger {
    color: red;
}

</style>
