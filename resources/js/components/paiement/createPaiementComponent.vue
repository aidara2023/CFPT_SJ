<template>
    <div class="cote_droit contenu">
        <form @submit.prevent="soumettre" method="dialog">
            <h1 class="sous_titre">Ajout de paiement</h1>
            <div>

            </div>

            <div class="personnel">
            <!-- <input type="text" name="mois" id="mois" placeholder="Mois" v-model="form.mois"> -->
    
                <select id="mois" name="mois" placeholder="Mois" v-model="form.mois">
                    <option value="">Mois</option>
                    <option :value="janvier">Janvier</option>
                    <option :value="février">Février</option>
                    <option :value="mars">Mars</option>
                    <option :value="avril">Avril</option>
                    <option :value="mai">Mai</option>
                    <option :value="juin">Juin</option>
                    <option ::value="juillet">Juillet</option>
                    <option :value="août">Août</option>
                    <option :value="septembre">Septembre</option>
                    <option :value="octobre">Octobre</option>
                    <option :value="novembre">Novembre</option>
                    <option :value="décembre">Décembre</option>
                </select>

        </div>

            <div class="eleves">
                <select name="eleve" id="eleve" v-model="form.id_eleve">
                        <option value=""> Eleve</option>
                        <option v-for="eleve in eleves" :value="eleve.id">{{ eleve.user.nom }}</option>
                 </select>
            </div>

            <div class="annee_academiques">
                <select name="annee_academique" id="annee_academique" v-model="form.id_annee_academique">
                        <option value=""> Annee_academique</option>
                        <option v-for="annee_academique in annee_academiques" :value="annee_academique.id">{{ annee_academique.intitule }}</option>
                </select>
            </div>                                                    

    
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
    name:"createLivreCompenent",
    data(){
        return {
            filieres:[],
            form:new Form({
                'mois':"",
                'id_eleve':"",
                'id_annee_academique':""
            }),
            eleves:[],
            annee_academiques:[],

        }
    },

    mounted(){
        this.get_annee_academique();
        this.get_eleve();
        this.rafraichissementAutomatique();

    },
    
    methods:{
        async soumettre(){
            const formdata = new FormData();
            formdata.append('mois', this.form.mois);
            formdata.append('id_annee_academique', this.form.id_annee_academique);
            formdata.append('id_eleve', this.form.id_eleve);
            
            if(this.form.titre!==""){
                try{
                    const create_store=await axios.post('/paiement/store', formdata, {

                    });
                    this.resetForm();
                    Swal.fire('Succes!','paiement ajouté avec succés','succes')
                   
                }
                catch(e){
                    console.log(e)
                    this.resetForm();
                    Swal.fire('Erreur!','Une erreur est survenue lors de l\'enregistrement','error')
                }

            }else{
                this.resetForm();
                Swal.fire('Erreur!','Veillez remplir tous les champs obligatoires','error')
                }


        },
        

        get_annee_academique(){
            
            axios.get('/annee_academique/index')
            .then(response => {
                this.annee_academiques=response.data.annee_academique
                
               
           }).catch(error=>{
               Swal.fire('Erreur!','Une erreur est survenue lors de la recuperation des année_academiques','error')
           });
       },

       get_eleve(){
            
            axios.get('/eleve/index')
            .then(response => {
                this.eleves=response.data.eleve
                
               
           }).catch(error=>{
               Swal.fire('Erreur!','Une erreur est survenue lors de la recuperation des editions','error')
           });
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

