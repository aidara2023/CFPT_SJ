<template>
    <div class="contenu">
        <form @submit.prevent="soumettre()" method="dialog">
            <h1 class="sous_titre">Ajout d'utilisateur</h1>
            <!--Informations personnelles-->
            <div>
                <p><span class="str">*</span> Assurez vous que la photo est bien carrée</p>
            </div>
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
                        <option v-for="(role, index) in roles" :value="role.id" :key="index">{{ role.intitule }}</option>
                </select>
            </div>

            
<!-- 
            <div class="identifiants">
                <input type="text" placeholder="Contact urgence 1" v-model="form.contact_urgence_2">
                <input type="password"  placeholder="Contact urgence 2" v-model="form.contact_urgence_2">
            </div>  -->
    
            <div class="boutons">
                <input  type="submit" data-close-modal  value="Ajouter">
                <button type="button" data-close-modal class="texte annuler" >Annuler</button>
            </div>

        </form>
    </div>
</template>

<script>
import axios from 'axios';
import Form from 'vform';

   export default {
    name:"utilisateurCompenent",
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
                'id_role':"",
            }),
            photo:"",
            roles:[],

        }
    },

    mounted(){
        this.get_role();
        this.rafraichissementAutomatique();

    },
    
    methods:{
        async soumettre(){
            const formdata = new FormData();
            formdata.append('nom', this.form.nom  );
            formdata.append('prenom', this.form.prenom  );
            formdata.append('lieu_naissance', this.form.lieu_naissance);
            formdata.append('date_naissance', this.form.date_naissance);
            formdata.append('genre', this.form.genre);
            formdata.append('adresse', this.form.adresse);
            formdata.append('email', this.form.email);
            formdata.append('telephone', this.form.telephone);
            formdata.append('nationalite', this.form.nationalite);
            formdata.append('id_role', this.form.id_role);
            formdata.append('photo', this.photo);

            

            

            if(this.form.nom!=="" && this.form.prenom!=="" && this.form.telephone!=="" && this.form.date_naissance!==""){
                try{
                    const user_store=await axios.post('/user/store', formdata, {

                    });
                    this.resetForm();
                    Swal.fire('Succes!','utilisateur ajouté avec succés','succes')
                    
                }
                catch(e){
                    this.resetForm();
                    console.log(e)
                    Swal.fire('Erreur!','Une erreur est survenue lors de l\'enregistrement','error')
                    
                }

            }else{
               
                this.resetForm();
                Swal.fire('Erreur!','Veillez remplir tous les champs obligatoires','error');
              
                
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
            var ajout = document.querySelector("[data-modal-ajout]");
            var fermemod = document.querySelectorAll('[data-close-modal]');
            //Fermeture des modals
            fermemod.forEach(item => {
                item.addEventListener('click', () => {
                var actif = document.querySelectorAll('.actif');
                    actif.forEach(item => {
                        item.classList.remove("actif");
                    });
                        ajout.close();
                        modification.close();
                        suppression.close(); 
                    
            })
       /*    ajout.remove("active");  */
           
            });

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
           
        },

        rafraichissementAutomatique() {
            document.addEventListener("DOMContentLoaded", this.resetForm());
    },

    

    


    }
   }
</script>

