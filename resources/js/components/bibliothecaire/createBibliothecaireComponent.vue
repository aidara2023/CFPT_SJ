<template>
    <div class="cote_droit">
      <form @submit.prevent="soumettre">
          <h1 class="sous_titre">Informations bibliothecaire</h1>
          <!--Informations personnelles-->
          <div class="photo">
                <label for="dossiers">Glissez la photo ici <span></span>
                    <input type="file" name="dossiers" id="dossiers" @change="ajoutimage" accept="image/*">
                </label>
            </div>
          <div class="personnel">
          <input type="text" name="nom" id="nom" placeholder="Nom" v-model="form.nom_bibliothecaire">
          <input type="text" name="prenom" id="prenom" placeholder="Prenom" v-model="form.prenom_bibliothecaire">
          <input type="date" name="date_naissance" id="date_naissance" placeholder="Date de naissance" v-model="form.date_naissance_bibliothecaire">
          <input type="text" name="lieu_naissance" id="lieu_naissance" placeholder="Lieu de Naissance" v-model="form.lieu_naissance_bibliothecaire">
          <input type="text" name="nationalite" id="nationalite" placeholder="Nationalité" v-model="form.nationalite_bibliothecaire">
      </div>

          <div class="sexe">
              <span class="b">Sexe</span>
              <label for="masculin">Masculin
                 <span></span>
                  <input type="radio" name="sexe" id="masculin" value="masculin" v-model="form.genre_bibliothecaire">
              </label>
              <label for="feminin">Feminin
                 <span></span>
                  <input type="radio" name="sexe" id="feminin" value="feminin" v-model="form.genre_bibliothecaire">
              </label>
          </div>
          <div class="num-addr">
  
              <input type="tel" name="telephone" id="telephone" placeholder="Tel : 77 234 48 43" v-model="form.telephone_bibliothecaire">
              <input type="text" name="adresse" id="adresse" placeholder="Adresse" v-model="form.adresse_bibliothecaire">
          </div>


          <p><span class="str">*</span> Personnes à contacter en cas d'urgence</p>
          <div class="urgence">
              <input type="tel" name="contact_urgence_1" id="contact_urgence_1" placeholder="Contact d'urgence 1" v-model="form.contact_urgence_1">
              <input type="tel" name="contact_urgence_2" id="contact_urgence_2" placeholder="Contact d'urgence 2" v-model="form.contact_urgence_2">
          </div>

          <div class="roles">
                <select name="service" id="service" v-model="form.id_service">
                        <option value=""> Service </option>
                        <option v-for="service in services" :value="service.id">{{ service.nom_service }}</option>
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
  name:"createBibliothecaireCompenent",
  data(){
      return {
        //   filieres:[],
          form:new Form({
            
              'nom_bibliothecaire':"",
              'prenom_bibliothecaire':"",
              'date_naissance_bibliothecaire':"",
              'lieu_naissance_bibliothecaire':"",
              'nationalite_bibliothecaire':"",
              'genre_bibliothecaire':"",
              'telephone_bibliothecaire':"",
              'contact_urgence_1':"",
              'contact_urgence_2':"",
              'adresse_bibliothecaire':"",
          }),
          photo:"",
          services:[],

      }
  },
  methods:{
      async soumettre(){
          const formdata = new FormData(); 

          formdata.append('nom_bibliothecaire', this.form.nom_bibliothecaire  );
          formdata.append('prenom_bibliothecaire', this.form.prenom_bibliothecaire  );
          formdata.append('lieu_naissance_bibliothecaire', this.form.lieu_naissance_bibliothecaire );
          formdata.append('date_naissance_bibliothecaire', this.form.date_naissance_bibliothecaire  );
          formdata.append('genre_bibliothecaire', this.form.genre_bibliothecaire  );
          formdata.append('adresse_bibliothecaire', this.form.adresse_bibliothecaire);
          formdata.append('telephone_bibliothecaire', this.form.telephone_bibliothecaire  );
          formdata.append('nationalite_bibliothecaire', this.form.nationalite_bibliothecaire );
          formdata.append('contact_urgence_1', this.form.contact_urgence_1);
          formdata.append('contact_urgence_2', this.form.contact_urgence_2);


          if(this.form.nom_bibliothecaire!=="" && this.form.prenom_bibliothecaire!=="" && this.form.telephone_bibliothecaire!=="" && this.form.date_naissance_bibliothecaire!==""){
              try{
                  const inscription_store=await axios.post('/bibliothecaire/store', formdata, {

                  });
                  if(inscription_store){
                    Swal.fire('Succes!','bibliothecaire enregistrer avec success','succes');
                  this.resetForm();
                  }
                  
                  Swal.fire('Succes!','bibliothecaire enregistrer avec success','succes');
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
            this.nom_bibliothecaire="";
            this.prenom_bibliothecaire="";
            this.genre_bibliothecaire="";
            this.adresse_bibliothecaire="";
            this.telephone_bibliothecaire="";
            this.date_naissance_bibliothecaire="";
            this.lieu_naissance_bibliothecaire="";
            this.nationalite_bibliothecaire="";
            this.photo="";
            this.$(`#${name}`).modal('hide');
        },
        get_service(){
            
            axios.get('/services/index')
            .then(response => {
                this.services=response.data.service
                
               
           }).catch(error=>{
               Swal.fire('Erreur!','Une erreur est survenue lors de la recuperation des services','error')
           });
       },


        ajoutimage(event){
            this.photo=event.target.files[0];
        },

    }
 }
</script>

<style></style>