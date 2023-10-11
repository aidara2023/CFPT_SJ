<template>
    <div class="cote_droit">
        <form @submit.prevent="soumettre">
            <h1 class="sous_titre">Ajout de livre</h1>
            <div>

            </div>

            <div class="personnel">
            <input type="text" name="titre" id="titre" placeholder="Titre" v-model="form.titre">
           
        </div>

            <div class="categories">
                <select name="categorie" id="categorie" v-model="form.id_categorie">
                        <option value=""> Categorie</option>
                        <option v-for="categorie in categories" :value="categorie.id">{{ categorie.intitule }}</option>
                </select>
            </div>

            <div class="auteurs">
                <select name="auteur" id="auteur" v-model="form.id_auteur">
                        <option value=""> Auteur</option>
                        <option v-for="auteur in auteurs" :value="auteur.id">{{ auteur.nom_auteur }}</option>
                </select>
            </div>

            <div class="editions">
                <select name="edition" id="edition" v-model="form.id_edition">
                        <option value=""> Edition</option>
                        <option v-for="edition in editions" :value="edition.id">{{ edition.nom_edition }}</option>
                </select>
            </div>

    
            <div class="boutons">
                <input type="submit" value="Ajouter">
                <button type="button">Annuler</button>
            </div>
        </form>
    </div>
</template>

<script>
import axios from 'axios';
import Form from 'vform';

   export default {
    name:"createLivreCompenent",
    data(){
        return {
            filieres:[],
            form:new Form({
                'titre':"",
                'id_categorie':"",
                'id_auteur':"",
                'id_edition':""
            }),

            categories:[],
            editions:[],
            auteurs:[],

        }
    },

    mounted(){
        this.get_categorie();
        this.get_auteur();
        this.get_edition();

    },
    
    methods:{
        async soumettre(){
            const formdata = new FormData();
            formdata.append('titre_livre', this.form.titre);
            formdata.append('id_auteur', this.form.id_auteur);
            formdata.append('id_edition', this.form.id_edition);
            formdata.append('id_categorie', this.form.id_categorie);
            
            if(this.form.titre!==""){
                try{
                    const create_store=await axios.post('/livre/store', formdata, {

                    });
                    Swal.fire('Succes!','livre ajouté avec succés','succes')
                    this.resetForm();
                }
                catch(e){
                    console.log(e)
                    Swal.fire('Erreur!','Une erreur est survenue lors de l\'enregistrement','error')
                }

            }else{
                Swal.fire('Erreur!','Veillez remplir tous les champs obligatoires','error')
            }


        },
        

         get_categorie(){
            
             axios.get('/categorie/index')
             .then(response => {
                 this.categories=response.data.categorie
                 
                
            }).catch(error=>{
                Swal.fire('Erreur!','Une erreur est survenue lors de la recuperation des categories','error')
            });
        },

        get_auteur(){
            
            axios.get('/auteur/index')
            .then(response => {
                this.auteurs=response.data.auteur
                
               
           }).catch(error=>{
               Swal.fire('Erreur!','Une erreur est survenue lors de la recuperation des auteurs','error')
           });
       },

       get_edition(){
            
            axios.get('/edition/index')
            .then(response => {
                this.editions=response.data.edition
                
               
           }).catch(error=>{
               Swal.fire('Erreur!','Une erreur est survenue lors de la recuperation des editions','error')
           });
       },

        resetForm(){
            this.form.titre="";
            this.form.id_categorie="";
            this.form.id_edition="";
            this.form.id_auteur="";
           
        }

    }
   }
</script>

