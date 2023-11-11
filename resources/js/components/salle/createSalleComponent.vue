<template>
    <div class="cote_droit">
        <form @submit.prevent="soumettre">
            <h1 class="sous_titre">Ajout salle</h1>
           
            <div class="personnel">
                <div>
                    <input type="text" v-model="form.intitule" placeholder="Intitule"  @input="validatedata()">
                    <span class="erreur" v-if="this.nom_salle_erreur !== ''">{{this.nom_salle_erreur}}</span>
               </div>

               <div>
                    <input type="text" placeholder="nombre_place" v-model="form.nombre_place"  @input="validatedata()">
                    <span class="erreur" v-if="this.nom_salle_erreur !== ''">{{this.nom_salle_erreur}}</span>
               </div>
    </div>

        <div class="type_formation">
                <select name="batiment" id="batiment" v-model="form.id_batiment"  @change="verifIdSalle()">
                        <option value=""> Batiment </option>
                        <option v-for="batiment in batiments" :value="batiment.id">{{ batiment.intitule }}</option>
                </select>
                <span class="erreur" v-if="id_batiment_erreur !== ''">{{id_batiment_erreur}}</span>
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
    name:"salleCompenent",
    data(){
        return {
            form:new Form({
                'intitule':"",
                'nombre_place':"",
                'id_batiment':""
                
            }),
            batiments:[],
            nom_salle_erreur:"",

            id_batiment_erreur:"",
            etatForm: false,
          
        

        }
    },
    mounted(){
        this.get_batiment();
       
    },

    
    methods:{
        async soumettre(){
            const formdata = new FormData();
            formdata.append('intitule', this.form.intitule );
            formdata.append('nombre_place', this.form.nombre_place  );
            formdata.append('id_batiment', this.form.id_batiment );

            
            if(this.form.intitule!=="" && this.form.nombre_place!=="" ){
                try{
                    const create_store=await axios.post('/salle/store', formdata, {

                    });
                    Swal.fire('Succes!','salle ajouté avec succés','succes')
                    this.resetForm();
                }
                catch(e){
                    console.log(e)
                    Swal.fire('Erreur!','Une erreur est survenue lors de l\'enregistrement','error')
                }

            }else{
                Swal.fire('Erreur!','Veuillez remplir tous les champs obligatoires','error')
            }


        },
        

         get_batiment(){
            
             axios.get('/batiment/index')
             .then(response => {
                 this.batiments=response.data.batiment
                 
                
            }).catch(error=>{
                Swal.fire('Erreur!','Une erreur est survenue lors de la recuperation du type de formation','error')
            });
        },
        
    

        resetForm(){
            this.intitule="";
            this.nombre_place="";
            this.form.id_batiment="";
            
           
        }


    }
   }
</script>

