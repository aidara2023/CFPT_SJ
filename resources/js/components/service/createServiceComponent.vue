<template>
      <div class="cote_droit contenu">
        <form  @submit.prevent="soumettre" method="dialog">
            <h1 class="sous_titre">Ajout Services</h1>
            <!--Informations personnelles-->
            <div class="personnel">
                <div>
                    <input type="text" v-model="form.nom_service" id="nom" placeholder="Nom du Service">
                </div>

            <select name="classe" id="classe" placeholder="Niveau" v-model="form.id_user">
                <option value="">Personnel Administratif</option>
                <option v-for="(user, index) in users" :value="user.id"> {{user.nom}} {{ user.prenom }}</option>
            </select>
        </div>


        <div class="boutons">
                <input  type="submit" data-close-modal  value="Ajouter">
                <button type="button" data-close-modal class="texte annuler" >Annuler</button>
            </div>
        </form>
    </div>
</template>

<script>
import axios from 'axios';
import Form from 'vform';

   export default {
    name:"createServiceCompenent",
    data(){
        return {
            users:[],
            form:new Form({
                'nom_service':"",
                'id_user':"",

            }),
        }
    },

    mounted(){

        this.get_user();
        this.rafraichissementAutomatique();


    },

    methods:{
        async soumettre(){
            const formdata = new FormData();
            formdata.append('nom_service', this.form.nom_service  );
            formdata.append('id_user', this.form.id_user  );

            if(this.form.nom_service!=="" && this.form.id_user!==""){
                try{
                    const create_store=await axios.post('/service/store', formdata, {});
                    this.resetForm();
                    Swal.fire('Succes!','Service ajouté avec succés','success')
                   
                }
                catch(e){
                    console.log(e)
            
                    Swal.fire('Erreur!','Une erreur est survenue lors de l\'enregistrement','error')
                }

            }else{
               
                Swal.fire('Erreur!','Veuillez remplir tous les champs ','error')
            }


        },

        resetForm(){
            var ajout = document.querySelector("[data-modal-ajout]");
            var fermemod = document.querySelectorAll('[data-close-modal]');
            //Fermeture des modals
            fermemod.forEach(item => {
                item.addEventListener('click', () => {
                var actif = document.querySelectorAll('.actif');
                    actif.forEach(item => {
                        item.classList.remove("actif");
                    });
                        ajout.close();
                        modification.close();
                        suppression.close();

            })
       /*    ajout.remove("active");  */

            });
            this.form.nom_service="";
            this.form.id_user="";
        },

        get_user(){
            axios.get('/user/getPersonnel')
            .then(response => {
                this.users=response.data.user


           }).catch(error=>{
               Swal.fire('Erreur!','Une erreur est survenue lors de la recuperation des membres administratifs','error')
           });
       },
       rafraichissementAutomatique() {
            document.addEventListener("DOMContentLoaded", this.resetForm());
    },


    }
   }
</script>

<style>
</style>
