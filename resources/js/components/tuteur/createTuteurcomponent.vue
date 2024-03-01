<template>
    <div class="cote_droit">
        <form @submit.prevent="soumettre">
            <h1 class="sous_titre">Ajout de tuteur</h1>
            <div>

            </div>
            <!--Informations personnelles-->
            <p><span class="str">*</span> Assurez vous que la photo est bien carrée</p>
            <div class="photo">
                <label for="dossiers">Glissez la photo ici <span></span>
                    <input type="file" name="dossiers" id="dossiers" @change="ajoutimage" accept="image/*">
                </label>
            </div>

            <div class="personnel">
            <input type="text" name="nom" id="nom" placeholder="Nom" v-model="form.nom">
            <input type="text" name="prenom" id="prenom" placeholder="Prenom" v-model="form.prenom">
            <input type="date" name="date_naissance" id="date_naissance" placeholder="Date de naissance" v-model="form.date_naissance">
            <input type="text" name="lieu_naissance" id="lieu_naissance" placeholder="Lieu de Naissance" v-model="form.lieu_naissance">
            <input type="text" name="nationalite" id="nationalite" placeholder="Nationalité" v-model="form.nationalite">
        </div>

            <div class="sexe">
                <span class="b">Sexe</span>
                <label for="masculin">Masculin
                   <span></span>
                    <input type="radio" name="sexe" id="masculin" value="masculin" v-model="form.genre">
                </label>
                <label for="feminin">Feminin
                   <span></span>
                    <input type="radio" name="sexe" id="feminin" value="feminin" v-model="form.genre">
                </label>
            </div>
            <div class="num-addr">
    
                <input type="tel" name="telephone" id="telephone" placeholder="Tel : 77 234 48 43" v-model="form.telephone">
                <input type="text" name="adresse" id="adresse" placeholder="Adresse" v-model="form.adresse">
                <input type="mail" name="email" id="email" placeholder="Email" v-model="form.email">
            </div>


            <div class="roles">
                <select name="role" id="role" v-model="form.id_role">
                        <option value=""> Role</option>
                        <option v-for="role in roles" :value="role.id">{{ role.intitule }}</option>
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
    name:"createTuteurcompenent",
    data(){
        return {
            filieres:[],
            form:new Form({
                'nom':"",
                'prenom':"",
                'genre':"",
                'adresse':"",
                'telephone':"",
                'email':"",
                'date_naissance':"",
                'lieu_naissance':"",
                'nationalite':"",
                'id_role':""
               
            }),
            photo:"",
            roles:[],
        

        }
    },

    mounted(){
        this.get_role();
       

    },
    
    methods:{
        async soumettre(){
            const formdata = new FormData();
            formdata.append('nom_tuteur', this.form.nom  );
            formdata.append('prenom_tuteur', this.form.prenom  );
            formdata.append('lieu_naissance_tuteur', this.form.lieu_naissance);
            formdata.append('date_naissance_tuteur', this.form.date_naissance);
            formdata.append('genre_tuteur', this.form.genre);
            formdata.append('adresse_tuteur', this.form.adresse);
            formdata.append('email_tuteur', this.form.email);
            formdata.append('telephone_tuteur', this.form.telephone);
            formdata.append('nationalite_tuteur', this.form.nationalite);
            formdata.append('id_role', this.form.id_role);
            formdata.append('photo', this.photo);

            

            

            if(this.form.nom!=="" && this.form.prenom!=="" && this.form.telephone!=="" && this.form.date_naissance!==""){
                try{
                    const create_store=await axios.post('/tuteur/store', formdata, {

                    });
                    Swal.fire('Succes!','tuteur ajouté avec succés','succes')
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
        

         get_role(){
            
             axios.get('/roles/index')
             .then(response => {
                 this.roles=response.data.role
                 
                
            }).catch(error=>{
                Swal.fire('Erreur!','Une erreur est survenue lors de la recuperation des roles','error')
            });
        },


        ajoutimage(event){
            this.photo=event.target.files[0];
        },
        resetForm(){
            this.form.nom="";
            this.form.prenom="";
            this.form.genre="";
            this.form.adresse="";
            this.form.telephone="";
            this.form.email="";
            this.form.date_naissance="";
            this.form.lieu_naissance="";
            this.form.nationalite="";
            this.form.id_role="";
           
           
        }


    }
   }
</script>

