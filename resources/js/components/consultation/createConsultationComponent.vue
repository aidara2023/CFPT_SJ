<template>
    <div class="cote_droit">
        <form @submit.prevent="soumettre">
            <h1 class="sous_titre">Ajout de cconsultation</h1>
            <div>

            </div>


            <div class="infirmiers">
                <select name="infirmier" id="infirmier" v-model="form.id_infirmier">
                        <option value=""> Infirmier</option>
                        <option v-for="infirmier in infirmiers" :value="infirmier.id">{{ infirmier.intitule }}</option>
                </select>
            </div>

            <div class="dossier_medicals">
                <select name="dossier_medical" id="dossier_medical" v-model="form.id_dossier_medical">
                        <option value=""> Dossier Medical</option>
                        <option v-for="dossier_medical in dossier_medicals" :value="dossier_medical.id">{{ dossier_medical.nom_dossier_medical }}</option>
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
    name:"createConsultationCompenent",
    data(){
        return {
            filieres:[],
            form:new Form({
                'id_infirmier':"",
                'id_dossier_medical':""
            }),
            photo:"",
            infirmiers:[],
            dossier_medicals:[],

        }
    },

    mounted(){
        this.get_infirmier();
        this.get_dossier_medical();

    },
    
    methods:{
        async soumettre(){
            const formdata = new FormData();
            formdata.append('id_infirmier', this.form.id_infirmier);
            formdata.append('id_dossier_medical', this.form.id_dossier_medical);
            

            

            

            if(this.form.id_infirmier!=="" && this.form.id_dossier_medical!=="" ){
                try{
                    const create_store=await axios.post('/cconsultation/store', formdata, {

                    });
                    Swal.fire('Succes!','cconsultation ajouté avec succés','succes')
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
        

         get_infirmier(){
            
             axios.get('/infirmier/index')
             .then(response => {
                 this.infirmiers=response.data.infirmier
                 
                
            }).catch(error=>{
                Swal.fire('Erreur!','Une erreur est survenue lors de la recuperation des infirmiers','error')
            });
        },

        get_dossier_medical(){
            
            axios.get('/dossier_medical/index')
            .then(response => {
                this.dossier_medicals=response.data.dossier_medical
                
               
           }).catch(error=>{
               Swal.fire('Erreur!','Une erreur est survenue lors de la recuperation des dossier_medicals','error')
           });
       },

        ajoutimage(event){
            this.photo=event.target.files[0];
        },
        resetForm(){
            this.form.id_infirmier="";
            this.form.id_dossier_medical="";
           
        }


    }
   }
</script>

