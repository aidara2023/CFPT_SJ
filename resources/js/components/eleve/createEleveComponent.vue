<template>
    <div class="cote_droit">
      <form @submit.prevent="soumettre">
          <h1 class="sous_titre">Informations Etudiant</h1>
          <!--Informations personnelles-->
          <div class="photo">
                <label for="dossiers">Glissez la photo ici <span></span>
                    <input type="file" name="dossiers" id="dossiers" @change="ajoutimage" accept="image/*">
                </label>
            </div>
        <div class="personnel">
            <input type="text" name="nom" id="nom" placeholder="Nom" v-model="form.nom_eleve">
            <input type="text" name="prenom" id="prenom" placeholder="Prenom" v-model="form.prenom_eleve">
            <input type="date" name="date_naissance" id="date_naissance" placeholder="Date de naissance" v-model="form.date_naissance_eleve">
            <input type="text" name="lieu_naissance" id="lieu_naissance" placeholder="Lieu de Naissance" v-model="form.lieu_naissance_eleve">
            <input type="text" name="nationalite" id="nationalite" placeholder="Nationalité" v-model="form.nationalite_eleve">
        </div>

          <div class="sexe">
              <span class="b">Sexe</span>
              <label for="masculin">Masculin
                 <span></span>
                  <input type="radio" name="sexe" id="masculin" value="masculin" v-model="form.genre_eleve">
              </label>
              <label for="feminin">Feminin
                 <span></span>
                  <input type="radio" name="sexe" id="feminin" value="feminin" v-model="form.genre_eleve">
              </label>
          </div>
          <div class="num-addr">
  
              <input type="tel" name="telephone" id="telephone" placeholder="Tel : 77 234 48 43" v-model="form.telephone_eleve">
              <input type="text" name="adresse" id="adresse" placeholder="Adresse" v-model="form.adresse_eleve">
          </div>

          <p><span class="str">*</span> Personnes à contacter en cas d'urgence</p>
          <div class="urgence">
              <input type="tel" name="contact_urgence_1" id="contact_urgence_1" placeholder="Contact d'urgence 1" v-model="form.contact_urgence_1">
              <input type="tel" name="contact_urgence_2" id="contact_urgence_2" placeholder="Contact d'urgence 2" v-model="form.contact_urgence_2">
          </div>
          <!-- Informations sur le tuteur -->

          <h1 class="sous_titre">Informations sur le tuteur</h1>
          <div class="tuteur">
              
              <input type="text" name="nom_tuteur" id="nom_tuteur" placeholder="Nom tuteur" v-model="form.nom_tuteur">
              <input type="text" name="prenom_tuteur" id="prenom_tuteur" placeholder="Prénom tuteur" v-model="form.prenom_tuteur">
              <input type="text" name="adresse_tuteur" id="adresse_tuteur" placeholder="Adresse tuteur" v-model="form.adresse_tuteur">
              <input type="mail" name="mail_tuteur" id="mail_tuteur" placeholder="Mail tuteur" v-model="form.mail_tuteur">
              <input type="tel" name="telephone_tuteur" id="telephone_tuteur" placeholder="Telephone tuteur" v-model="form.telephone_tuteur">

          </div>
          <div class="sexe">
              <span class="b">Sexe tuteur</span>
              <label for="masculin_tuteur">Masculin
                 <span></span>
                  <input type="radio" name="sexe_tuteur" id="masculin_tuteur" value="masculin_tuteur" v-model="form.genre_tuteur">
              </label>
              <label for="feminin_tuteur">Feminin
                 <span></span>
                  <input type="radio" name="sexe_tuteur" id="feminin_tuteur" value="feminin_tuteur" v-model="form.genre_tuteur">
              </label>
              </div>

              <div>
              

              <input type="date" name="date_naissance" id="date_naissance" placeholder="Date de naissance" v-model="form.date_naissance_tuteur">
          <input type="text" name="lieu_naissance" id="lieu_naissance" placeholder="Lieu de Naissance" v-model="form.lieu_naissance_tuteur">
          <input type="text" name="nationalite" id="nationalite" placeholder="Nationalité" v-model="form.nationalite_tuteur">

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
import Swal  from 'sweetalert2';
 export default {
  name:"createEleveCompenent",
  data(){
      return {
        /*   filieres:[], */
          form:new Form({
            
              'nom_eleve':"",
              'prenom_eleve':"",
              'date_naissance_eleve':"",
              'lieu_naissance_eleve':"",
              'nationalite_eleve':"",
              'nationalite_tuteur':"",
              'nom_tuteur':"",
              'prenom_tuteur':"",
              'lieu_naissance_tuteur':"",
              'date_naissance_tuteur':"",
              'genre_eleve':"",
              'genre_tuteur':"",
              'telephone_eleve':"",
              'telephone_tuteur':"",
              'contact_urgence_1':"",
              'contact_urgence_2':"",
              'adresse_eleve':"",
              'adresse_tuteur':"",
          }),
          photo:"",

      }
  },
  methods:{
      async soumettre(){
          const formdata = new FormData();
          formdata.append('nom_tuteur', this.form.nom_tuteur  );
          formdata.append('prenom_tuteur', this.form.prenom_tuteur  );
          formdata.append('lieu_naissance_tuteur', this.form.lieu_naissance_tuteur);
          formdata.append('date_naissance_tuteur', this.form.date_naissance_tuteur);
          formdata.append('genre_tuteur', this.form.genre_tuteur);
          formdata.append('adresse_tuteur', this.form.adresse_tuteur);
          formdata.append('telephone_tuteur', this.form.telephone_tuteur);
          formdata.append('nationalite_tuteur', this.form.nationalite_tuteur);
          formdata.append('photo', this.photo);
          

          formdata.append('nom_eleve', this.form.nom_eleve  );
          formdata.append('prenom_eleve', this.form.prenom_eleve  );
          formdata.append('lieu_naissance_eleve', this.form.lieu_naissance_eleve );
          formdata.append('date_naissance_eleve', this.form.date_naissance_eleve  );
          formdata.append('genre_eleve', this.form.genre_eleve  );
          formdata.append('adresse_eleve', this.form.adresse_eleve);
          formdata.append('telephone_eleve', this.form.telephone_eleve  );
          formdata.append('nationalite_eleve', this.form.nationalite_eleve );
          formdata.append('contact_urgence_1', this.form.contact_urgence_1);
          formdata.append('contact_urgence_2', this.form.contact_urgence_2);


          if(this.form.nom_tuteur!=="" && this.form.prenom_tuteur!=="" && this.form.telephone_tuteur!=="" && this.form.date_naissance_tuteur!==""){
              try{
                  const inscription_store=await axios.post('/eleve/store', formdata, {

                  });
                  if(inscription_store){
                    Swal.fire('Succes!','Eleve enregistrer avec success','succes');
                  this.resetForm();
                  }
              }
            catch(e){
                  console.log(e)
                  Swal.fire('Erreur!','Une erreur est survenue lors de l\'enregistrement','error')
              }

          }else{
              Swal.fire('Erreur!','Veuillez remplir tous les champs obligatoires','error')
          }


      },
        resetForm(){
            this.form.nom_eleve="";
            this.form.prenom_eleve="";
            this.form.genre_eleve="";
            this.form.adresse_eleve="";
            this.form.telephone_eleve="";
            this.form.email_tuteur="";
            this.form.date_naissance_eleve="";
            this.form.lieu_naissance_eleve="";
            this.form.nationalite_eleve="";
            this.form.nom_tuteur="";
            this.form.prenom_tuteur="";
            this.form.genre_tuteur="";
            this.form.adresse_tuteur="";
            this.form.telephone_tuteur="";
            this.form.email_tuteur="";
            this.form.date_naissance_tuteur="";
            this.form.lieu_naissance_tuteur="";
            this.form.nationalite_tuteur="";
            this.form.photo="";
        },

        ajoutimage(event){
            this.photo=event.target.files[0];
        },

    }
 }
</script>

<style></style>