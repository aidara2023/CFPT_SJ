<template>
    <dialog data-modal-ajout class="modal">
    <div class="cote_droit contenu">
        <form @submit.prevent="soumettre" method="">
            <h1 class="sous_titre">Ajout de paiement</h1>

            <div class="eleves">
             <!--    <select name="eleve" id="eleve" v-model="form.id_eleve">
                        <option value=""> Eleve</option>
                        <option v-for="eleve in eleves" :value="eleve.id">{{ eleve.user.nom }} {{ eleve.user.prenom }}</option>
                </select> -->
                <!-- <input type="text" v-model="form.id_eleve" @input="performSearch()">
                <ul>
                    <li v-for="(eleve, key) in eleves" :key="key" :value="eleve.id">{{ eleve.nom }} {{ eleve.prenom }}</li>
                </ul> -->
                <input type="text" v-model="this.search_query" @input="performSearch">

            </div>
            <div v-for="(eleve, key) in eleves" :key="key" @click="selectEleve(eleve)">
                   <a href="#"> {{ eleve.nom }} {{ eleve.prenom }}</a>
            </div>



             <div v-if="form.id_eleve !== '' && selectedEleve.id">

                <div class="eleve-details">
                    <input type="text" v-model="selectedEleve.nom" disabled>
                </div>

                <div class="eleve-details">
                    <input type="text" v-model="selectedEleve.classe" disabled>
                </div>

                <div class="annee_academiques">
                <select name="annee_academique" id="annee_academique" v-model="form.id_annee_academique">
                    <option value="">Annee_academique</option>
                    <option v-for="annee_academique in annee_academiques" :value="annee_academique.id">{{ annee_academique.intitule }}</option>
                </select>
                </div>

                <div class="personnel">
                <input type="number" v-model="form.montant">
                </div>
            </div>

            <!-- <div v-if="form.id_eleve!==''">
                <div class="annee_academiques">
                    <select name="annee_academique" id="annee_academique" v-model="form.id_annee_academique">
                            <option value=""> Annee_academique</option>
                            <option v-for="annee_academique in annee_academiques" :value="annee_academique.id">{{ annee_academique.intitule }}</option>
                    </select>
                </div>


                <div class="personnel">
                    <input type="number" v-model="form.montant">
                </div>

            </div> -->




            <div class="boutons">
                <input  type="submit" data-close-modal  value="Ajouter">
                <button type="button" data-close-modal class="texte annuler" >Annuler</button>
            </div>
        </form>
    </div>
</dialog>
</template>

<script>
import bus from '../../eventBus';
import axios from 'axios';
import Form from 'vform';

   export default {
    name:"createPaiementCompenent",
    data(){
        return {
            filieres:[],
            form:new Form({
                'id_mois':"",
                'id_eleve':"",
                'montant':"",
                'statut':"",
                'id_annee_academique':""
            }),
            eleves:[],
            mois:[],
            annee_academiques:[],
            search_query:"",
            selectedEleve: {
                id: "",
                nom: "",
                classe: ""
            },
            eleve_classe:"",

        }
    },

    mounted(){
        this.get_annee_academique();
        this.get_mois();
        // this.get_eleve();
        this.rafraichissementAutomatique();

    },

    methods:{
        async soumettre(){
            const formdata = new FormData();
            /* formdata.append('id_mois', this.form.id_mois); */
            formdata.append('montant', this.form.montant);
            formdata.append('statut', this.form.statut);
            formdata.append('id_annee_academique', this.form.id_annee_academique);
            formdata.append('id_eleve', this.form.id_eleve);

            if(this.form.titre!==""){
                try{
                    const create_store=await axios.post('/paiement/store', formdata, {

                    });
                    this.resetForm();
                    Swal.fire('Succes!','paiement ajouté avec succes','success')
                    bus.emit('formationAjoutee');

                }
                catch(e){
                    console.log(e)
                    // this.resetForm();
                    Swal.fire('Erreur!','Une erreur est survenue lors de l\'enregistrement','error')
                }

            }else{
                this.resetForm();
                Swal.fire('Erreur!','Veillez remplir tous les champs obligatoires','error')
                }


        },

        async performSearch(){
            try{
                const response= await axios.get('/recherche/eleve', {
                    params:{
                        query: this.search_query
                    }
                });
                this.eleves= response.data;
                console.log(this.eleves)
            }catch(error){
                console.log(error);
            }
        },

        selectEleve(eleve) {
            // console.log(eleve)
            // this.get_eleve(eleve.id);
            this.form.id_eleve = eleve.id;
            this.search_query = eleve.matricule;
            this.selectedEleve.id = eleve.id;
            this.selectedEleve.nom = eleve.nom;
            // this.selectedEleve.classe = eleve.eleves.inscription.classe.nom_classe;
            eleve.eleves.forEach((eleve) => {
                eleve.inscription.forEach((inscription) => {
                    this.selectedEleve.classe=inscription.classe.nom_classe;
                });
            });

            this.eleves = [];
            console.log(this.selectedEleve.classe)
            this.eleves = []; // Pour vider la liste après avoir sélectionné un élève
        },


    //     get_eleve(id){

    //         axios.get('/eleve/show_by_where/'+id)
    //         .then(response => {
    //             this.eleve_classe=response.data.eleve
    //             console.log(this.eleve_classe);


    //        }).catch(error=>{
    //            Swal.fire('Erreur!','Une erreur est survenue lors de la recuperation des année_academiques','error')
    //        });
    //    },
        get_annee_academique(){

            axios.get('/annee_academique/index')
            .then(response => {
                this.annee_academiques=response.data.annee_academique


           }).catch(error=>{
               Swal.fire('Erreur!','Une erreur est survenue lors de la recuperation des année_academiques','error')
           });
       },

        get_mois(){

            axios.get('/mois/index')
            .then(response => {
                this.mois=response.data.mois


           }).catch(error=>{
               Swal.fire('Erreur!','Une erreur est survenue lors de la recuperation des mois','error')
           });
       },

    //    get_eleve(){

    //         axios.get('/eleve/index')
    //         .then(response => {
    //             this.eleves=response.data.eleve


    //        }).catch(error=>{
    //            Swal.fire('Erreur!','Une erreur est survenue lors de la recuperation des eleves','error')
    //        });
    //    },

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
            this.form.mois="";
            this.form.id_eleve="";
            this.form.id_annee_academique="";




        },

        rafraichissementAutomatique() {
            document.addEventListener("DOMContentLoaded", this.resetForm());
    },

    }
   }
</script>

