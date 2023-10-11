<template>
    <div class="cote_droit">
      <form @submit.prevent="soumettre">
          <h1 class="sous_titre">Informations Infirmier</h1>
          <!--Informations personnelles-->
          <div class="photo">
                <label for="dossiers">Glissez la photo ici <span></span>
                    <input type="file" name="dossiers" id="dossiers" @change="ajoutimage" accept="image/*">
                </label>
            </div>
          <div class="personnel">
          <input type="text" name="nom" id="nom" placeholder="Nom" v-model="form.nom_infirmier">
          <input type="text" name="prenom" id="prenom" placeholder="Prenom" v-model="form.prenom_infirmier">
          <input type="date" name="date_naissance" id="date_naissance" placeholder="Date de naissance" v-model="form.date_naissance_infirmier">
          <input type="text" name="lieu_naissance" id="lieu_naissance" placeholder="Lieu de Naissance" v-model="form.lieu_naissance_infirmier">
          <input type="text" name="nationalite" id="nationalite" placeholder="Nationalité" v-model="form.nationalite_infirmier">
      </div>

          <div class="sexe">
              <span class="b">Sexe</span>
              <label for="masculin">Masculin
                 <span></span>
                  <input type="radio" name="sexe" id="masculin" value="masculin" v-model="form.genre_infirmier">
              </label>
              <label for="feminin">Feminin
                 <span></span>
                  <input type="radio" name="sexe" id="feminin" value="feminin" v-model="form.genre_infirmier">
              </label>
          </div>
          <div class="num-addr">
  
              <input type="tel" name="telephone" id="telephone" placeholder="Tel : 77 234 48 43" v-model="form.telephone_infirmier">
              <input type="text" name="adresse" id="adresse" placeholder="Adresse" v-model="form.adresse_infirmier">
          </div>

          <div class="roles">
            <select name="roles" id="role" v-model="form.id_role">
                <option value="">role</option>
                <option v-for="role in roles" :key="role.id">{{ role.intitule }}</option>
                
            </select>

          </div>

          <div class="services">
            <select name="services" id="service" v-model="form.id_service">
                <option value="">service</option>
                <option v-for="service in services"  :key="service.id">{{ service.nom_service }}</option>
                
            </select>

          </div>

          <!-- <p><span class="str">*</span> Personnes à contacter en cas d'urgence</p> -->
          <!-- <div class="urgence">
              <input type="tel" name="contact_urgence_1" id="contact_urgence_1" placeholder="Contact d'urgence 1" v-model="form.contact_urgence_1">
              <input type="tel" name="contact_urgence_2" id="contact_urgence_2" placeholder="Contact d'urgence 2" v-model="form.contact_urgence_2">
          </div> -->
          <!-- Informations sur le tuteur -->

          <!-- <h1 class="sous_titre">Informations sur le tuteur</h1>
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

              </div> -->
        
  
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
  name:"createinfirmierCompenent",
  data(){
      return {
        /*   filieres:[], */
          form:new Form({
            'nom_infirmier':"",
            'prenom_infirmier':"",
            'date_naissance_infirmier':"",
            'lieu_naissance_infirmier':"",
            'nationalite_infirmier':"",
            'genre_infirmier':"",
            'telephone_infirmier':"",
            'adresse_infirmier':"",
            'id_service':"",
            'id_role':""
            
            
          }),
          photo:"",
          roles:[],
          services: [],

      }
  },

  mounted(){
        this.get_role();
        this.get_service();

    },


  methods:{
      async soumettre(){
          const formdata = new FormData();
          formdata.append('nom', this.form.nom_infirmier  );
          formdata.append('prenom', this.form.prenom_infirmier  );
          formdata.append('lieu_naissance', this.form.lieu_naissance_infirmier);
          formdata.append('date_naissance', this.form.date_naissance_infirmier);
          formdata.append('genre', this.form.genre_infirmier);
          formdata.append('adresse', this.form.adresse_infirmier);
          formdata.append('telephone', this.form.telephone_infirmier);
          formdata.append('nationalite', this.form.nationalite_infirmier);
          formdata.append('id_role', this.form.id_role);
          formdata.append('photo', this.photo);
          

        //   formdata.append('nom_infirmier', this.form.nom_infirmier  );
        //   formdata.append('prenom_infirmier', this.form.prenom_infirmier  );
        //   formdata.append('lieu_naissance_infirmier', this.form.lieu_naissance_infirmier );
        //   formdata.append('date_naissance_infirmier', this.form.date_naissance_infirmier  );
        //   formdata.append('genre_infirmier', this.form.genre_infirmier  );
        //   formdata.append('adresse_infirmier', this.form.adresse_infirmier);
        //   formdata.append('telephone_infirmier', this.form.telephone_infirmier  );
        //   formdata.append('nationalite_infirmier', this.form.nationalite_infirmier );
         


          if(this.form.nom_infirmier!=="" && this.form.prenom_infirmier!=="" && this.form.telephone_infirmier!=="" && this.form.date_naissance_infirmier!==""){
              try{
                  const inscription_store=await axios.post('/infirmier/store', formdata, {

                  });
                  if(inscription_store){
                    Swal.fire('Succes!','infirmier  enregistrer avec success','succes');
                  this.resetForm();
                  }
              }
              catch(e){
                console.log(e);
                if (e.response) {
                    console.log("Status Code:", e.response.status);
                    console.log("Response Data:", e.response.data);
                }
                Swal.fire('Erreur!', 'Une erreur est survenue lors de l\'enregistrement', 'error');
            }
            // catch(e){
            //       console.log(e)
            //       Swal.fire('Erreur!','Une erreur est survenue lors de l\'enregistrement','error')
            //   }

          }else{
              Swal.fire('Erreur!','Veuillez remplir tous les champs obligatoires','error')
          }


      },
        resetForm(){
            this.form.nom_infirmier="";
            this.form.prenom_infirmier="";
            this.form.genre_infirmier="";
            this.form.adresse_infirmier="";
            this.form.telephone_infirmier="";
            this.form.email_tuteur="";
            this.form.date_naissance_infirmier="";
            this.form.lieu_naissance_infirmier="";
            this.form.nationalite_infirmier="";
            // this.form.nom="";
            // this.form.prenom="";
            // this.form.genre="";
            // this.form.adresse="";
            // this.form.telephone="";
            // this.form.email="";
            // this.form.date_naissance="";
            // this.form.lieu_naissance="";
            // this.form.nationalite="";
            this.form.id_role="";
            this.form.id_service="";
            
        },

        get_role(){
            axios.get('/roles/index')
            .then(response => {
                this.roles=response.data.role
            }).catch(error=>{
                Swal.fire('Erreur!', 'une erreur est survenue lors de la recupperation des roles')
            });
        },

        get_service(){
            axios.get('/services/index')
            .then(response =>{
                this.services=response.data.service
            }).catch(error=>{
                Swal.fire('Erreur!', 'une erreur est survenue lors de la recupperation des services', 'error')
            });
        },



        ajoutimage(event){
            this.photo=event.target.files[0];
        },

    }
 }
</script>