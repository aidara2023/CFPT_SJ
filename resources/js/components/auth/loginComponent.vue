<template>
 <form action="" method="">
            <input type="text" name="matricule" id="matricule" placeholder="Matricule">
            <input type="password" name="mdp" id="mot_de_passe" placeholder="Mot de passe">
            <input type="submit" value="Je me connecte">
            <input type="submit" value="Mot de passe oublié ?" id="mot_de_passe_oublie">
 </form>
</template>


<script>
import Form from 'vform';

export default {
    name: "loginComponent",
    data(){
        return{
            form: new Form({
                'id':0,
                'password':""
            }),
        }
    },
    methods: { 
        async verification(){
            if(this.form.id!=null && this.form.password!=null){
                await this.form.post('/connexion').then(({data})=>{
                    if(data.statut!="Error"){
                        window.location.href=data.url;
                    }else{
                        console.log("matricule ou mot de passe incorrect");
                    }
                }).catch(error=>{
                    console.log(error);
                    if(error.response.status===500){
                        console.log("page introuvable");
                    }
                    if(error.response.status===404){
                        console.log("error 419");
                    }
                })
            }else{
                console.log("Tous les champs sont obligatoires");
            }

        },
     },
}
</script>


<style>

</style>