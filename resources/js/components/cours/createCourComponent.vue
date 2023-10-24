<template>
    <div class="cote_droit">
      <form @submit.prevent="soumettre">
          <h1 class="sous_titre">Ajout cours</h1>
          
          
          <div class="personnel">
          <input type="text" name="intitule" id="intitule" placeholder="Intitule" v-model="form.intitule">
          <input type="text" name="heure_debut" id="heure_debut" placeholder="Heure debut" v-model="form.heure_debut">
          <input type="text" name="heure_fin" id="heure_fin" placeholder="Heure fin" v-model="form.heure_fin">
          <input type="date" name="date_cour" id="date_cour" placeholder="Date cours" v-model="form.date_cour">
      </div>


          <div class="roles">
                <select name="classe" id="classe" v-model="form.id_classe">
                        <option value=""> Classe </option>
                        <option v-for="classe in classes" :value="classe.id">{{ classe.nom_classe }}</option>
                </select>
            </div>

            <div class="roles">
                <select name="formateur" id="formateur" v-model="form.id_formateur">
                        <option value=""> Formateur</option>
                        <option v-for="formateur in formateurs" :value="formateur.id">{{ formateur.user.nom }} {{ formateur.user.prenom }}</option>
                </select>
            </div>

            <div class="roles">
                <select name="matiere" id="matiere" v-model="form.id_matiere">
                        <option value=""> Matiere</option>
                        <option v-for="matiere in matieres" :value="matiere.id">{{ matiere.intitule }}</option>
                </select>
            </div>

            <div class="roles">
                <select name="salle" id="salle" v-model="form.id_salle">
                        <option value=""> Salle</option>
                        <option v-for="salle in salles" :value="salle.id">{{ salle.intitule }}</option>
                </select>
            </div>

            <div class="roles">
                <select name="semestre" id="semestre" v-model="form.id_semestre">
                        <option value=""> Semestre</option>
                        <option v-for="semestre in semestres" :value="semestre.id">{{ semestre.intitule }}</option>
                </select>
            </div>
        
          <div class="boutons">
              <button type="button">Retourner</button>
              <input type="submit" value="Enregistrer">
          </div>
      </form>
  </div>
</template>

<script>
import axios from 'axios';
import Form from 'vform';
import Swal from 'sweetalert2';
 export default {
  name:"createCourCompenent",
  data(){
      return {
        //   filieres:[],
          form:new Form({
            
              'intitule':"",
              'heure_debut':"",
              'heure_fin':"",
              'date_cour':"",
              'id_classe':"",
              'id_formateur':"",
              'id_matiere':"",
              'id_salle':"",
              'id_semestre':"",

        
          }),
          classes:[],
          formateurs:[],
          matieres:[],
          salles:[],
          semestres:[]


      }
  },
  mounted(){
        this.get_classe();
        this.get_formateur();
        this.get_matiere();
        this.get_salle();
        this.get_semestre();

    
    },



  methods:{
      async soumettre(){
          const formdata = new FormData(); 

          formdata.append('intitule', this.form.intitule );
          formdata.append('heure_debut', this.form.heure_debut );
          formdata.append('heure_fin', this.form.heure_debut);
          formdata.append('date_cour', this.form.date_cour );
          formdata.append('id_formateur', this.form.id_formateur);
          formdata.append('id_matiere', this.form.id_matiere);
          formdata.append('id_salle', this.form.id_salle);
          formdata.append('id_classe', this.form.id_classe);
          formdata.append('id_semestre', this.form.id_semestre);



          if(this.form.intitule!=="" && this.date_cour!=="" && this.form.heure_debut!=="" && this.form.heure_fin!==""){
              try{
                  const create_store=await axios.post('/cour/store', formdata, {

                  });
                  if(create_store){
                    Swal.fire('Succes!','Cours enregistrer avec success','succes');
                  this.resetForm();
                  }
                  
                  Swal.fire('Succes!','Cours enregistrer avec success','succes');
                  this.resetForm('formulaire')
              }
              catch(e){
                  console.log(e)
                  Swal.fire('Erreur!','Une erreur est survenue lors de l\'enregistrement','error')
              }

          }else{
              Swal.fire('Erreur!','Veuillez remplir tous les champs obligatoires','error')
          }


      },
        resetForm(name){
            this.intitule="";
            this.heure_debut="";
            this.heure_fin="";
            this.date_cour="";
            this.form.id_matiere="";
            this.form.id_classe="";
            this.form.id_salle="";
            this.form.id_formateur="";
            this.form.semestre="";

             
        },
        get_matiere(){
            
            axios.get('/matiere/index')
            .then(response => {
                this.matieres=response.data.matiere
                
               
           }).catch(error=>{
               Swal.fire('Erreur!','Une erreur est survenue lors de la recupération des matieres','error')
           });
       },


       get_classe(){
            
            axios.get('/classe/all')
            .then(response => {
                this.classes=response.data.classe
                
               
           }).catch(error=>{
               Swal.fire('Erreur!','Une erreur est survenue lors de la recuperation des classes','error')
           });
       },

       get_formateur(){
            
            axios.get('/formateur/index')
            .then(response => {
                this.formateurs=response.data.formateur
                
               
           }).catch(error=>{
               Swal.fire('Erreur!','Une erreur est survenue lors de la recuperation des formateurs','error')
           });
       },

       get_salle(){
            
            axios.get('/salle/index')
            .then(response => {
                this.salles=response.data.salle
                
               
           }).catch(error=>{
               Swal.fire('Erreur!','Une erreur est survenue lors de la recuperation des salles','error')
           });
       },

       get_semestre(){
            
            axios.get('/semestre/index')
            .then(response => {
                this.semestres=response.data.semestre
                
               
           }).catch(error=>{
               Swal.fire('Erreur!','Une erreur est survenue lors de la recuperation des semestres','error')
           });
       },



    }
 }
</script>

<style></style>