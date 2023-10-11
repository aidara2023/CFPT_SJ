<template>
    <div class="cote_droit">
        <form @submit.prevent="soumettre">
            <h1 class="sous_titre">Ajout retard</h1>
           
            <div class="personnel">
            <input type="date" name="date" id="date" placeholder="date" v-model="form.date">
            <input type="text" name="heure" id="heure" placeholder="heure" v-model="form.heure">
        </div>

        <div class="role">
                <select name="id_eleve" id="id_eleve" v-model="form.id_id_eleve">
                        <option value=""> Eleve </option>
                        <option v-for="id_eleve in id_eleves" :value="id_eleve.id">{{ eleve.user.nom }} {{ eleve.user.prenom }}</option>
                </select>
            </div>

            <div class="unite_de_formation">
                <select name="cour" id="cour" v-model="form.id_cour">
                        <option value=""> Cours </option>
                        <option v-for="cour in cours" :value="cour.id">{{ cour.intitule }}</option>
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
    name:"retardCompenent",
    data(){
        return {
            form:new Form({
                'date':"",
                'heure':"",
                'id_eleve':"",
                'id_cour':"",
                
            }),
            eleves:[],
         cours:[]
        

        }
    },
    mounted(){
        this.get_eleve();
        this.get_cour();
    },

    
    methods:{
        async soumettre(){
            const formdata = new FormData();
            formdata.append('date', this.form.date );
            formdata.append('heure', this.form.heure  );
            formdata.append('id_eleve', this.form.id_eleve );
            formdata.append('id_cour', this.form.id_cour );

            
            if(this.form.date!=="" && this.form.heure!=="" ){
                try{
                    const create_store=await axios.post('/retard/store', formdata, {

                    });
                    Swal.fire('Succes!','retard ajouté avec succés','succes')
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
        

         get_eleve(){
            
             axios.get('/eleve/index')
             .then(response => {
                 this.eleves=response.data.eleve
                 
                
            }).catch(error=>{
                Swal.fire('Erreur!','Une erreur est survenue lors de la recuperation de l eleve','error')
            });
        },
        
        get_cour(){
            
            axios.get('/cour/index')
            .then(response => {
                this.cours=response.data.cour
                
               
           }).catch(error=>{
               Swal.fire('Erreur!','Une erreur est survenue lors de la recuperation du cours','error')
           });
       },
       

        resetForm(){
            this.date="";
            this.heure="";
            this.form.id_eleve="";
            this.form.id_cour="";
            
           
        }


    }
   }
</script>

