<template>
    <div class="cote_droit">
        <form @submit.prevent="soumettre">
            <h1 class="sous_titre">Ajout classe</h1>
           
            <div class="personnel">
            <input type="text" name="type_classe" id="type_classe" placeholder="type_classe" v-model="form.type_classe">
            <input type="text" name="nom_classe" id="nom_classe" placeholder="nom_classe" v-model="form.nom_classe">
            <input type="text" name="niveau" id="niveau" placeholder="niveau" v-model="form.niveau">
        </div>

        <div class="type_formation">
                <select name="type_formation" id="type_formation" v-model="form.id_type_formation">
                        <option value=""> Type de formation </option>
                        <option v-for="type_formation in type_formations" :value="type_formation.id">{{ type_formation.intitule }}</option>
                </select>
            </div>

            <div class="unite_de_formation">
                <select name="unite_de_formation" id="unite_de_formation" v-model="form.id_unite_de_formation">
                        <option value=""> Unite de formation </option>
                        <option v-for="unite_de_formation in unite_de_formations" :value="unite_de_formation.id">{{ unite_de_formation.nom_unite_formation }}</option>
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
    name:"matiereCompenent",
    data(){
        return {
            form:new Form({
                'nom_classe':"",
                'type_classe':"",
                'niveau':"",
                'id_type_formation':"",
                'id_unite_de_formation':"",
                
            }),
            type_formations:[],
          unite_de_formations:[]
        

        }
    },
    mounted(){
        this.get_type_formation();
        this.get_unite_de_formation();
    },

    
    methods:{
        async soumettre(){
            const formdata = new FormData();
            formdata.append('nom_classe', this.form.nom_classe );
            formdata.append('type_classe', this.form.type_classe  );
            formdata.append('niveau', this.form.niveau );
            formdata.append('type_formation', this.form.type_formation );
            formdata.append('unite_de_formation', this.form.unite_de_formation );

            
            if(this.form.nom_classe!=="" && this.form.type_classe!==""  && this.form.niveau!==""){
                try{
                    const create_store=await axios.post('/classe/store', formdata, {

                    });
                    Swal.fire('Succes!','classe ajouté avec succés','succes')
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
        

         get_type_formation(){
            
             axios.get('/type_formation/index')
             .then(response => {
                 this.type_formations=response.data.type_Formations
                 
                
            }).catch(error=>{
                Swal.fire('Erreur!','Une erreur est survenue lors de la recuperation du type de formation','error')
            });
        },
        
        get_unite_de_formation(){
            
            axios.get('/unite_de_formation/index')
            .then(response => {
                this.unite_de_formations=response.data.unite_de_formation
                
               
           }).catch(error=>{
               Swal.fire('Erreur!','Une erreur est survenue lors de la recuperation de lunite de formation','error')
           });
       },
       

        resetForm(){
            this.nom_classe="";
            this.type_classe="";
            this.niveau="";
            this.form.id_type_formation="";
            this.form.id_unite_de_formation="";
            
           
        }


    }
   }
</script>

