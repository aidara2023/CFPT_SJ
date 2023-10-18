<template>
    <div class="cote_droit">
        <form @submit.prevent="soumettre">
            <h1 class="sous_titre">Ajout de ressource pedagogique</h1>
            
            <div class="personnel">
            <input type="text" name="libelle" id="libelle" placeholder="Libelle" v-model="form.libelle">
            <input type="text" name="contenu" id="contenu" placeholder="contenu" v-model="form.contenu">
        </div>

            <div class="formateurs">
                <select name="formateur" id="formateur" v-model="form.id_formateur">
                        <option value=""> Formateur</option>
                        <option v-for="formateur in formateurs" :value="formateur.id">{{ formateur.type }}</option>
                </select>
            </div>

            <div class="eleves">
                <select name="eleve" id="eleve" v-model="form.id_eleve">
                        <option value=""> Eleve</option>
                        <option v-for="eleve in eleves" :value="eleve.id">{{ eleve.nom_eleve }}</option>
                </select>
            </div>

            <div class="cours">
                <select name="cour" id="cour" v-model="form.id_cour">
                        <option value="">Cour</option>
                        <option v-for="cour in cours" :value="cour.id">{{ cour.nom_cour }}</option>
                </select>
            </div>

            <div class="unite_de_formations">
                <select name="unite_de_formation" id="unite_de_formation" v-model="form.id_unite_de_formation">
                        <option value=""> Unite de formation</option>
                        <option v-for="unite_de_formation in unite_de_formations" :value="unite_de_formation.id">{{ unite_de_formation.nom_unite_de_formation }}</option>
                </select>
            </div>

            

             <!-- <div class="identifiants">
                <input type="text" name="matricule" id="matricule" placeholder="Matricule" v-model="form.contact_urgence_2">
                <input type="password" name="mot_de_passe" id="mot_de_passe" placeholder="Mot de passe" v-model="form.contact_urgence_2">
            </div> --> 

            
            
            <!--paiement-->
    
    
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
    name:"createRessourcePedagogiqueCompenent",
    data(){
        return {
            filieres:[],
            form:new Form({
                'libelle':"",
                'contenu':"",
                'id_cour':"",
                'id_unite_de_formation':"",
                'id_formateur':"",
                'id_eleve':""
            }),
            photo:"",
            formateurs:[],
            eleves:[],
            cours:[],
            unite_de_formation:[],

        }
    },

    mounted(){
        this.get_formateur();
        this.get_eleve();
        this.get_cour();
        this.get_unite_de_formation();

    },
    
    methods:{
        async soumettre(){
            const formdata = new FormData();
            formdata.append('libelle', this.form.libelle  );
            formdata.append('contenu', this.form.contenu  );
            formdata.append('id_cour', this.form.id_cour);
            formdata.append('id_unite_de_formation', this.form.id_unite_de_formation);
            formdata.append('id_formateur', this.form.id_formateur);
            formdata.append('id_eleve', this.form.id_eleve);
           
            if(this.form.libelle!=="" && this.form.contenu!=="" ){
                try{
                    const create_store=await axios.post('/ressource_pedagogique/store', formdata, {

                    });
                    Swal.fire('Succes!','ressource pedagogique ajouté avec succés','succes')
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
        

         get_formateur(){
            
             axios.get('/formateur/index')
             .then(response => {
                 this.formateurs=response.data.formateur
                 
                
            }).catch(error=>{
                Swal.fire('Erreur!','Une erreur est survenue lors de la recuperation des formateurs','error')
            });
        },

        get_eleve(){
            
            axios.get('/eleve/index')
            .then(response => {
                this.eleves=response.data.eleve
                
               
           }).catch(error=>{
               Swal.fire('Erreur!','Une erreur est survenue lors de la recuperation des eleves','error')
           });
       },

       get_cour(){
            
            axios.get('/cour/index')
            .then(response => {
                this.cours=response.data.cour
                
               
           }).catch(error=>{
               Swal.fire('Erreur!','Une erreur est survenue lors de la recuperation des cours','error')
           });
       },

       get_unite_de_formation(){
           
           axios.get('/unite_de_formation/index')
           .then(response => {
               this.unite_de_formations=response.data.unite_de_formation
               
              
          }).catch(error=>{
              Swal.fire('Erreur!','Une erreur est survenue lors de la recuperation des unite_de_formations','error')
          });
      },
      
        resetForm(){
            this.form.libelle="";
            this.form.contenu="";
            this.form.id_cour="";
            this.form.id_unite_de_formation="";
            this.form.id_formateur="";
            this.form.id_eleve="";
           
        }

    }
   }
</script>

