<template>
    <div class="cote_droit">
      <form action="" method="">
          <h1 class="sous_titre">Ajout seminaire</h1>
          <div class="personnel">

              <div>
                  <input type="text" v-model="form.titre" id="nom" placeholder="Titre seminaire"></div>

                  <div>
                  <input type="text" v-model="form.description" id="description" placeholder="Description">
              </div>

              <div>
                  <input type="date" v-model="form.date_debut" id="date_debut" placeholder="Date debut">
              </div>
             

              <div>
                  <input type="date" v-model="form.date_fin" id="date_fin" placeholder="Date fin">
              </div>
          
              <div class="roles">
                <select name="direction" id="direction" v-model="form.id_direction">
                        <option value=""> direction </option>
                        <option v-for="direction in directions" :value="direction.id">{{ direction.nom_direction }}</option>
                </select>
            </div>
      </div>
      
  
          <div class="boutons">
             <!--  <button type="button">Retourner</button> -->
              <input type="submit" value="Enregister" @click.prevent="soumettre"> 
          </div>
      </form>
  </div>
</template>

<script>
import axios from 'axios';
import Form from 'vform';

 export default {
  name:"createServiceCompenent",
  data(){
      return {
          users:[],
          form:new Form({
              'titre':"",
              'date_debut':"",
              'date_fin':"",
              'description':"",
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
          formdata.append('titre', this.form.titre  );
          formdata.append('date_debut', this.form.date_debut  );
          formdata.append('date_fin', this.form.date_fin  );
          formdata.append('description', this.form.description  );
          formdata.append('id_direction', this.form.id_direction  );


      
          if(this.form.titre!=="" && this.form.date_debut!=="" && this.form.date_fin!=="" && this.form.description!=="" && this.form.id_direction!==""){
              try{
                  const create_store=await axios.post('/seminaire/store', formdata, {});
                  Swal.fire('Succes!','Seminaire ajouté avec succés','succes')
                  this.resetForm();
              }
              catch(e){
                  console.log(e)
                  Swal.fire('Erreur!','Une erreur est survenue lors de l\'enregistrement','error')
              }

          }else{
              Swal.fire('Erreur!','Veuillez remplir tous les champs ','error')
          }


      },

      resetForm(){
          this.form.titre="";
          this.form.date_debut="";
          this.form.date_fin="";
          this.form.description="";
          this.form.id_direction="";


      },

      get_direction(){
            
            axios.get('/direction/index')
            .then(response => {
                this.directions=response.data.direction
                
               
           }).catch(error=>{
               Swal.fire('Erreur!','Une erreur est survenue lors de la recupération des directions','error')
           });
       },


  }
 }
</script>

<style>
</style>