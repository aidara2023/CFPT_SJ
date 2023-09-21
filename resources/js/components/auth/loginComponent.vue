<template>
<form>
    <input type="text" name="matricule" v-model="form.matricule" id="matricule" placeholder="Matricule">
    <input type="password" name="mdp" v-model="form.password" id="mot_de_passe" placeholder="Mot de passe">
    <input type="submit" value="Je me connecte">
    <input type="submit" @click="verification()" value="Mot de passe oublié ?" id="mot_de_passe_oublie">
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
        }
    },
    methods: { 
        async verification(){
            if(this.form.matricule!=null && this.form.password!=null){
                await this.form.post('/connexion').then(({data})=>{
                    if(data.statut!="Error"){
                        window.location.href=data.url;
                    }else{
                        alert("matricule ou mot de passe incorrect");
                    }
                }).catch(error=>{
                    alert(error);
                    if(error.response.status===500){
                        alert("page introuvable");
                    }
                    if(error.response.status===404){
                        alert("Erreur 419");
                    }
                })
            }else{
                alert("Tous les champs sont obligatoires");
            }

        },
     },
}
</script>


<style>

</style>