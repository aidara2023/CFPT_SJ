<template>
    <dialog data-modal-ajout class="modal">
        <div class="titres">
            <h1>Nouveau paiement</h1>
         </div>
        <div>
            <form @submit.prevent="validerAvantAjout()" method="">
               <div class="informations">

                <div class="titres">
                    <h1 >Nouveau paiement</h1>
                </div>
                

                <div class="champ">
                    <label for="nom" :class="{ 'couleur_rouge': (this.id_eleve_erreur)} ">Matricule</label>
                    <input type="text" v-model="this.search_query" @input="performSearch" :class="{ 'bordure_rouge': (this.id_eleve_erreur)} ">
                     <span class="erreur" >{{this.id_eleve_erreur}}</span> 
                </div>

                <div v-for="(eleve, key) in eleves" :key="key" @click="selectEleve(eleve)">
                    <a href="#"> {{ eleve.nom }} {{ eleve.prenom }}</a>
                </div>



                <div v-if="form.id_eleve !== '' && selectedEleve.id">
                    <div class="champ">
                        <label for="nom" >Prenom</label>
                        <input type="text" v-model="selectedEleve.prenom" disabled>
                    </div>

                    <div class="champ">
                        <label for="nom" >Nom</label>
                        <input type="text" v-model="selectedEleve.nom" disabled>
                    </div>

                    <div class="champ">
                        <label for="nom" >Classe</label>
                        <input type="text" v-model="selectedEleve.classe" disabled>
                    </div>
                    <div v-for="(paie, index) in form_paiement.paiement" :key="index">

                        <div class="header col-sm-10 d-flex justify-content-end align-items-center">

                            <svg class="cursor-pointer"  @click.prevent="duplicatePaiement(index)" xmlns="hhtp://www.w3.org/200/svg" viewBox="0 0 24 24" width="24" height="24" style="margin-top: 30px; margin-left: 330px;">
                                <path fill="none" d="M0 0h24v24H0z" />
                            <path
                                fill="green"
                                d="M11 11V7h2v4h4v2h-4v4h-2v-4H7v-2h4zm1 11C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16z"
                            />
                            </svg>
                            <svg v-if="form_paiement.paiement.length > 1" class="cursor-pointer ml-2" @click.prevent="removePaiement(index)"  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                                <path fill="none" d="M0 0h24v24H0z" />
                                <path
                                    fill="#EC4899"
                                    d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm0-9.414l2.828-2.829 1.415 1.415L13.414 12l2.829 2.828-1.415 1.415L12 13.414l-2.828 2.829-1.415-1.415L10.586 12 7.757 9.172l1.415-1.415L12 10.586z"
                                />
                            </svg>
                        </div>

                        <div class="champ">
                            <label for="nom" :class="{ 'couleur_rouge': (this.id_annee_accademique_erreur)} ">Annee</label>
                            <select name="annee_academique" id="annee_academique" v-model="paie.id_annee_academique" :class="{ 'bordure_rouge': (this.id_annee_accademique_erreur)} " @change="validatedata('id_annee_accademique')">
                                <option v-for="annee_academique in annee_academiques" :value="annee_academique.id">{{ annee_academique.intitule }}</option>
                            </select>
                            <span class="erreur">{{id_annee_accademique_erreur}}</span>
                        </div>

                        <div class="champ">
                            <label for="nom" :class="{ 'couleur_rouge': (this.id_mois_erreur)} ">Mois</label>
                            <select name="mois" id="mois" v-model="paie.id_mois" :class="{ 'bordure_rouge': (this.id_mois_erreur)} " @change="validatedata('id_mois')">
                                <option v-for="m in mois" :value="m.id">{{ m.intitule }} </option>
                            </select>
                            <span class="erreur">{{id_mois_erreur}}</span>
                        </div>

                        <div class="champ">
                            <label for="nom" :class="{ 'couleur_rouge': (this.montant_erreur)} ">Montant</label>
                            <input type="number" v-model="paie.montant"   :class="{ 'bordure_rouge': (this.montant_erreur) }" @input="validatedata('montant')">
                            <span class="erreur">{{montant_erreur}}</span>
                        </div>
                </div>
                </div>

                <div class="groupe_champs validation">
                    <button type="button" data-close-modal class="texte annuler" @click="resetForm">Annuler</button>
                    <button  type="submit"  :class="{ 'data-close-modal': (this.etatForm) }">Enregistrer</button>
                </div>
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

                'id_eleve':"",

                'statut':"",

            }),
            form_paiement:new Form({
                paiement:[{
                id_mois:"",
                montant:"",
                id_annee_academique:""
                }]
            }),
            eleves:[],
            mois:[],
            annee_academiques:[],
            search_query:"",
            selectedEleve: {
                id: "",
                nom: "",
                prenom:"",
                classe: ""
            },
            eleve_classe:"",
            id_eleve_erreur:"",
            id_annee_accademique_erreur:"",
            id_mois_erreur:"",
            montant_erreur:"",
            id_eleve_erreur:"",
            etatForm : false,

        }
    },

    mounted(){
        this.get_annee_academique();
        this.get_mois();
        this.rafraichissementAutomatique();

    },

    methods:{
        async soumettre(){
            const formdata = new FormData();
            formdata.append('paiements', JSON.stringify(this.form_paiement.paiement));
            formdata.append('id_eleve', this.form.id_eleve);

            try{
                const create_store=await axios.post('/paiement/store', formdata, {

                });
                this.resetForm();
                // Swal.fire('Succes!','paiement ajouté avec succes','success')
                bus.emit('paiementAjoutee');
                var ajout = document.querySelector('[data-modal-ajout]');

                this.closeModal('[data-modal-confirmation]');
            }
            catch(e){
                console.log(e)
                // this.resetForm();
                Swal.fire('Erreur!','Une erreur est survenue lors de l\'enregistrement','error')
            }

        },

        validerAvantAjout() {
             const isVerifIdValid = this.validatedataOld();
             console.log("isVerifIdValid");
             console.log(isVerifIdValid);
             
             if (isVerifIdValid===true) {
                 this.etatForm = false;
                 this.editModal=false;
                 console.log("erreur")
                 return 0;
             }else{
                this.soumettre();
                this.etatForm = true;
                this.closeModal('[data-modal-confirmation]');
                console.log("Tokkos");
             }
         },

        validatedata(champ){
            switch (champ) {
                case 'montant':
                    this.montant_erreur = "";
                    for (let i = 0; i < this.form_paiement.paiement.length; i++) {
                        const paiement = this.form_paiement.paiement[i];
                        if (paiement.montant === "" || isNaN(paiement.montant) || paiement.montant <= 0) {
                            this.montant_erreur = "Le montant pour le paiement " + (i + 1) + " est invalide";
                            return true;
                        }
                    }
                break;
                case 'id_annee_accademique':
                    this.id_annee_accademique_erreur = "";
                    //Vérification de annee academique
                /*     if (this.form.id_annee_accademique === "") {
                        this.id_annee_accademique_erreur = "Vous avez oublié de sélectionner l'\Annee Academique "
                        i = 1;
                        return true
                    } */
                    for (let i = 0; i < this.form_paiement.paiement.length; i++) {
                        const paiement = this.form_paiement.paiement[i];
                        if (paiement.id_annee_academique === "") {
                            this.id_annee_accademique_erreur = "Vous avez oublié de sélectionner l'\Annee Academique pour le paiement " + (i + 1);
                            return true;
                        }
                    }
                break;
                case 'id_mois':
                    this.id_mois_erreur = "";
                    //Vérification de annee academique
                   /*  if (this.form.id_annee_accademique === "") {
                        this.id_mois_erreur = "Vous avez oublié de sélectionner le mois "
                        i = 1;
                        return true
                    } */
                    for (let i = 0; i < this.form_paiement.paiement.length; i++) {
                        const paiement = this.form_paiement.paiement[i];
                        if (paiement.id_mois === "") {
                            this.id_mois_erreur = "Vous avez oublié de sélectionner le mois pour le paiement " + (i + 1);
                            return true;
                        }
                    }
                break;
                case 'id_eleve':
                    this.id_eleve_erreur = "";
                    //Vérification de l'eleve selectionner
                    if (this.form.id_eleve === "") {
                        this.id_eleve_erreur = "Matricule invalide "
                        i = 1;
                        return true
                    }
                   
                break;
                default:
            break;
        }
    },


    validatedataOld(){
        this.id_annee_accademique_erreur= "";
        this.id_mois_erreur= "";
        this.montant_erreur="";
        this.id_eleve_erreur = "";
        var j=0;

        for (let i = 0; i < this.form_paiement.paiement.length; i++) {
            const paiement = this.form_paiement.paiement[i];
            if (paiement.id_mois === "") {
                this.id_mois_erreur = "Vous avez oublié de sélectionner le mois pour le paiement " + (i + 1);
                j=1;
               
            }
            if (paiement.id_annee_academique === "") {
                this.id_annee_accademique_erreur = "Vous avez oublié de sélectionner l'\Annee Academique pour le paiement " + (i + 1);
                j=1;
                
            }
            if (paiement.montant === "" || isNaN(paiement.montant) || paiement.montant <= 0) {
                this.montant_erreur = "Le montant pour le paiement " + (i + 1) + " est invalide";
                j=1;
                
            }
        }
        if (this.form.id_eleve === "") {
            this.id_eleve_erreur = "Matricule invalide "
            j = 1;
           
        }
      

        if(j==1) return true;

        return false;
    },

        closeModal(selector){
            var ajout=document.querySelector('[data-modal-ajout]');
            var confirmation = document.querySelector(selector);

            var actif = document.querySelectorAll('.actif');
                actif.forEach(item => {
                item.classList.remove("actif");
            });
            ajout.close();

            confirmation.style.backgroundColor = 'white';
            confirmation.style.color = 'var(--clr)';

            confirmation.showModal();
            confirmation.classList.add("actif");
            setTimeout(function(){
                confirmation.close();

                setTimeout(function(){
                    confirmation.classList.remove("actif");
            }, 100);

            }, 1700);
        },

        async performSearch(){
            this.id_eleve_erreur = "";
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
            this.form.id_eleve = eleve.id;
            this.search_query = eleve.matricule;
            this.selectedEleve.id = eleve.id;
            this.selectedEleve.nom = eleve.nom;
            this.selectedEleve.prenom = eleve.prenom;
            // this.selectedEleve.classe = eleve.eleves.inscription.classe.nom_classe;
            eleve.eleves.forEach((eleve) => {
                eleve.inscription.forEach((inscription) => {
                   this.selectedEleve.classe = inscription.classe.type_classe + ' ' + inscription.classe.nom_classe + ' ' + inscription.classe.niveau;
                });
            });
            this.eleves = [];
            console.log(this.selectedEleve.classe)
            this.eleves = []; // Pour vider la liste après avoir sélectionné un élève
        },

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

        resetForm(){
            this.form.id_eleve="";
            this.form.statut="";
            this.form_paiement.paiement.id_mois="";
            this.form_paiement.paiement.montant="";
            this.form_paiement.paiement.id_annee_academique="";
            this.selectedEleve.id="";
            this.selectedEleve.nom="";
            this.selectedEleve.prenom="";
            this.selectedEleve.classe="";
            this.search_query="";
            this.eleve_classe=""
            this.id_annee_accademique_erreur= "";
            this.id_mois_erreur= "";
            this.montant_erreur="";
        },

        rafraichissementAutomatique() {
            document.addEventListener("DOMContentLoaded", this.resetForm());
        },

        duplicatePaiement(index) {
            const newPaiement = { ...this.form_paiement.paiement[index] };
            this.form_paiement.paiement.splice(index + 1, 0, newPaiement);
        },

        removePaiement(index) {
            if (this.form_paiement.paiement.length > 1) {
                this.form_paiement.paiement.splice(index, 1);
            }
        },

    }

   }
</script>
