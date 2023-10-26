<template>
    <div class="cote_droit contenu">
        <form @submit.prevent="soumettre" method="dialog">
            <h1 class="sous_titre">Ajout de departement</h1>

            <div class="personnel">
            <input type="text" name="nom" id="nom" placeholder="Nom departement" v-model="form.nom">
        </div>

            <div class="directions">
                <select name="direction" id="direction" v-model="form.id_direction">
                        <option value=""> Direction</option>
                        <option v-for="direction in directions" :value="direction.id">{{ direction.nom_direction }}</option>
                </select>
            </div>




             <!-- <div class="identifiants">
                <input type="text" name="matricule" id="matricule" placeholder="Matricule" v-model="form.contact_urgence_2">
                <input type="password" name="mot_de_passe" id="mot_de_passe" placeholder="Mot de passe" v-model="form.contact_urgence_2">
            </div> -->



            <!--paiement-->


            <div class="boutons">
                <input  type="submit" data-close-modal  value="Ajouter">
                <button type="button" data-close-modal class="texte annuler" >Annuler</button>
            </div>
        </form>
    </div>
</template>

<script>
import bus from '../../eventBus';
import axios from 'axios';
import Form from 'vform';

   export default {
    name:"createDepartementCompenent",
    data(){
        return {
            filieres:[],
            form:new Form({
                'nom':"",
                'id_direction':""
            }),

            directions:[],

        }
    },

    mounted(){
        this.get_direction();


    },

    methods:{
        async soumettre(){
            const formdata = new FormData();
            formdata.append('nom_departement', this.form.nom  );
            formdata.append('id_direction', this.form.id_direction);

            if(this.form.nom!==""){
                try{
                    const create_store=await axios.post('/departement/store', formdata, {

                    });
                    this.resetForm();
                    Swal.fire('Succes!','departement ajouté avec succés','success')
                    this.resetForm();
                    bus.emit('departementAjoutee');
                }
                catch(e){
                    console.log(e)
                    this.resetForm();
                    Swal.fire('Erreur!','Une erreur est survenue lors de l\'enregistrement','error')
                }

            }else{
                this.resetForm();
                Swal.fire('Erreur!','Veillez remplir tous les champs obligatoires','error')
            }


        },


         get_direction(){

             axios.get('/direction/index')
             .then(response => {
                 this.directions=response.data.direction


            }).catch(error=>{
                this.resetForm();
                Swal.fire('Erreur!','Une erreur est survenue lors de la recuperation de la direction','error')
            });
        },

        resetForm(){
            this.form.nom="";
            this.form.id_direction="";
        },

    }


   }

</script>

