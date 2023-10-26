<template>
    <div class=" cote_droit contenu">
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
                <select name="role" id="role" v-model="form.id_role" @change="changement(form.id_role)">
                        <option value=""> Role</option>
                        <option v-for="(role, index) in roles" :value="role.id" :key="index">{{ role.intitule }}</option>
                </select>
            </div>

            <div class="personnel" v-if="this.interesser=== 6">
                <div>
                    <!-- <input type="text" name="type" id="type" placeholder="Type" v-model="form.type"> -->
                    <select name="" id="" v-model="form.type">
                        <option value="">Type Professeur</option>
                        <option  value="Etat">Fonctionnaire</option>
                        <option  value="Recruter">Recruter</option>
                    </select>

                    <select name="" id="" v-model="form.situation_matrimoniale">
                        <option value="">Selectioner Statut</option>
                        <option  value="Niveau 1">Célibataire</option>
                        <option  value="Niveau 2">Marié</option>
                        <option  value="Niveau 2">Divorsé</option>
                    </select>
                </div>

                <div>
                    <select name="id_specialite" id="id_specialite" v-model="form.id_specialite">
                            <option value=""> Spécialite</option>
                            <option v-for="(specialite, index) in specialites" :value="specialite.id" :key="index">{{ specialite.intitule }}</option>
                    </select>



                    <select name="id_departement" id="id_departement" v-model="form.id_departement">
                            <option value=""> Departement</option>
                            <option v-for="(departement, index) in departements" :value="departement.id" :key="index">{{ departement.nom_departement }}</option>
                    </select>
                </div>

            </div>
            <div class="personnel" v-if="this.interesser=== 4">


                <div>
                    <select name="id_specialite" id="id_specialite" v-model="form.id_service">
                            <option value=""> Service</option>
                            <option v-for="(service, index) in services" :value="service.id" :key="index">{{ service.nom_service }}</option>
                    </select>

                </div>

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
import bus from '../../eventBus';
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
                'id_specialite':"",
                'id_departement':"",
                'id_service':"",
                'type':"",
                'situation_matrimoniale':"",

            }),
            photo:"",
            interesser:"",
            roles:[],
            services:[],
            departements:[],
            specialites:[],

        }
    },

    mounted(){
        this.get_role();
        this.get_specialite();
        this.get_departement();
        this.get_service();
        // this.rafraichissementAutomatique();

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
            formdata.append('type', this.form.type);
            formdata.append('situation_matrimoniale', this.form.situation_matrimoniale);
            formdata.append('id_specialite', this.form.id_specialite);
            formdata.append('id_service', this.form.id_service);
            formdata.append('id_departement', this.form.id_departement);
            formdata.append('photo', this.photo);





            if(this.form.nom!=="" && this.form.prenom!=="" && this.form.telephone!=="" && this.form.date_naissance!==""){
                try{
                    const user_store=await axios.post('/user/store', formdata, {

                    });
                    this.resetForm();
                    Swal.fire('Succes!','utilisateur ajouté avec succés','success')
                    bus.emit('formationAjoutee');

                }
                catch(e){
                    // this.resetForm();
                    console.log(e)
                    Swal.fire('Erreur!','Une erreur est survenue lors de l\'enregistrement','error')

                }

            }else{

                // this.resetForm();
                Swal.fire('Erreur!','Veillez remplir tous les champs obligatoires','error');


            }


        },

        changement(event){
            this.interesser= event;
        },


        get_role(){

             axios.get('/roles/index')
             .then(response => {
                 this.roles=response.data.role


            }).catch(error=>{
                Swal.fire('Erreur!','Une erreur est survenue lors de la recuperation des roles','error')
            });
        },

        get_service(){

             axios.get('/service/index')
             .then(response => {
                 this.services=response.data.service


            }).catch(error=>{
                Swal.fire('Erreur!','Une erreur est survenue lors de la recuperation des services','error')
            });
        },

        get_specialite(){

             axios.get('/specialite/index')
             .then(response => {
                 this.specialites=response.data.specialite


            }).catch(error=>{
                Swal.fire('Erreur!','Une erreur est survenue lors de la recuperation des specialite','error')
            });
        },

        get_departement(){

             axios.get('/departement/all')
             .then(response => {
                 this.departements=response.data.departement


            }).catch(error=>{
                Swal.fire('Erreur!','Une erreur est survenue lors de la recuperation des departements','error')
            });
        },

        ajoutimage(event){
            this.photo=event.target.files[0];
        },

        resetForm(){
    //         var ajout = document.querySelector("[data-modal-ajout]");
    //         var fermemod = document.querySelectorAll('[data-close-modal]');
    //         //Fermeture des modals
    //         fermemod.forEach(item => {
    //             item.addEventListener('click', () => {
    //             var actif = document.querySelectorAll('.actif');
    //                 actif.forEach(item => {
    //                     item.classList.remove("actif");
    //                 });
    //                     ajout.close();
    //                     modification.close();
    //                     suppression.close();

    //         })
    //    /*    ajout.remove("active");  */

    //         });

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
            this.form.type="";
            this.form.situation_matrimoniale="";
            this.form.id_specialite="";
            this.form.id_departement="";

        },

    //     rafraichissementAutomatique() {
    //         document.addEventListener("DOMContentLoaded", this.resetForm());
    // },






    }
   }
</script>

