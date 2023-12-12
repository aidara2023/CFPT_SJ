<template>
<dialog data-modal-ajout class="modal">

    <div class="titres">
        <h1>Ajout Auteur</h1>
    <!--  <h3>Informations Personnelles</h3> -->
    </div>

    <form @submit.prevent="validerAvantAjout()" action="" method="dialog" >
        <div class="informations">
            <div class="titres">
                <h1>Ajout Auteur</h1>
            </div>           
           
            <div class="champ">
                <label for="nom" :class="{ 'couleur_rouge': (this.nom_departement_erreur)} ">Nom Departement</label>
                <input  v-model="form.nom" id="nom"  @input="validatedata('nom_departement')" type="text" name="nom" :class="{ 'bordure_rouge': (this.nom_departement_erreur)} ">
                <span class="erreur" >{{this.nom_auteur_erreur}}</span>
            </div>     

            <div class="groupe_champs validation">
            <!-- Mettre la valeur 1 dans le data-close-modal pour qu'il soit actif -->
                <button type="button" data-close-modal="1" class="annuler"><span data-statut="visible" @click="resetForm">Annuler</span></button> 
                <button v-if="this.editModal===false" type="submit" data-close-modal="0" class="suivant"><span data-statut="visible">Ajouter</span></button>
                <button  v-if="this.editModal===true" type="submit" data-close-modal="0" class="suivant"><span data-statut="visible">Modifier</span></button>
            </div>
        </div>

        </form>
    </dialog>
</template>

<script>
import axios from 'axios';
import Form from 'vform';

   export default {
    name:"createAuteurCompenent",
    data(){
        return {
            filieres:[],
            form:new Form({
                'nom':"",
               
            }),
        }
    },
    
    methods:{
        async soumettre(){
            const formdata = new FormData();
            formdata.append('nom_auteur', this.form.nom  );
        
            if(this.form.nom!==""){
                try{
                    const create_store=await axios.post('/auteur/store', formdata, {

                    });
                    Swal.fire('Succes!','Auteur ajouté avec succés','succes')
                    this.resetForm();
                }
                catch(e){
                    console.log(e)
                    Swal.fire('Erreur!','Une erreur est survenue lors de l\'enregistrement','error')
                }

            }else{
                Swal.fire('Erreur!','Veillez remplir tous les champs ','error')
            }


        },

        resetForm(){
            this.form.nom="";
        }


    }
   }
</script>
x
