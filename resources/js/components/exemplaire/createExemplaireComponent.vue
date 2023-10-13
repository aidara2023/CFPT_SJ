<template>
    <div class="cote_droit">
        <form @submit.prevent="soumettre">
            <h1 class="sous_titre">Ajout de exemplaire</h1>
            <div>

            </div>
            
            <div class="personnel">
            <input type="text" name="nom" id="nom" placeholder="Intitule" v-model="form.nom">
        </div>

        

            <div class="livres">
                <select name="livre" id="livre" v-model="form.id_livre">
                        <option value=""> Livre</option>
                        <option v-for="livre in livres" :value="livre.id">{{ livre.titre_livre }}</option>
                </select>
            </div>

            <div class="rayons">
                <select name="rayon" id="rayon" v-model="form.id_rayon">
                        <option value=""> Rayon</option>
                        <option v-for="rayon in rayons" :value="rayon.id">{{ rayon.nom_service }}</option>
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
    name:"createExemplaireCompenent",
    data(){
        return {
            filieres:[],
            form:new Form({
                'nom':"",
                'id_livre':"",
                'id_rayon':""
            }),
            photo:"",
            livres:[],
            rayons:[],

        }
    },

    mounted(){
        this.get_livre();
        this.get_rayon();

    },
    
    methods:{
        async soumettre(){
            const formdata = new FormData();
            formdata.append('intitule', this.form.nom  );
            formdata.append('id_livre', this.form.id_livre);
            formdata.append('id_rayon', this.form.id_rayon);
           

            

            

            if(this.form.nom!==""){
                try{
                    const create_store=await axios.post('/exemplaire/store', formdata, {

                    });
                    Swal.fire('Succes!','exemplaire ajouté avec succés','succes')
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
        

         get_livre(){
            
             axios.get('/livres/index')
             .then(response => {
                 this.livres=response.data.livre
                 
                
            }).catch(error=>{
                Swal.fire('Erreur!','Une erreur est survenue lors de la recuperation des livres','error')
            });
        },

        get_rayon(){
            
            axios.get('/rayon/index')
            .then(response => {
                this.rayons=response.data.rayon
                
               
           }).catch(error=>{
               Swal.fire('Erreur!','Une erreur est survenue lors de la recuperation des rayons','error')
           });
       },
        resetForm(){
            this.form.nom="";
            this.form.id_livre="";
            this.form.id_rayon="";
           
        }


    }
   }
</script>

