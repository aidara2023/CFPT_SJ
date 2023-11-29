<template>
        <div class="cote_droit">
            <form @submit.prevent="filtre()">
                <h1 class="sous_titre">Recouvrement</h1>

                <div class="annee_academiques">
                    <select name="annee_academique" id="annee_academique" v-model="form.id_annee_academique">
                                <option value="">Année academique</option>
                                <option v-for="annee_academique in annee_academiques" :value="annee_academique.id">{{ annee_academique.intitule }}</option>
                            </select>
                </div>

                <div class="mois">
                    <select name="mois" id="mois" v-model="form.id_mois">
                            <option value=""> Mois</option>
                            <option v-for="mois in mois" :value="mois.id">{{ mois.intitule }}</option>
                    </select>
                </div>

                <div class="departements">
                    <select name="departement" id="departement" v-model="form.id_departement">
                            <option value="">Département</option>
                            <option v-for="departement in departements" :value="departement.id">{{ departement.nom_departement }}</option>
                    </select>
                </div>

                <div class="unite_de_formations">
                    <select name="unite_de_formation" id="unite_de_formation" v-model="form.id_unite_de_formation">
                            <option value=""> Unité de formation</option>
                            <option v-for="unite_de_formation in unite_de_formations" :value="unite_de_formation.id">{{ unite_de_formation.nom_unite_formation }}</option>
                    </select>
                </div>

                <div class="classes">
                    <select name="classe" id="classe" v-model="form.id_classe">
                            <option value=""> Classe</option>
                            <option v-for="classe in classes" :value="classe.id">{{ classe.nom_classe }}</option>
                    </select>
                </div>

    
                <div class="boutons">
                    <input type="submit" value="Appliquer">
                    <input type="submit" value="OK" @click="closeModal">
                    <button type="button" @click="resetForm">Annuler</button>
                </div>
            </form>
        </div>
  
</template>

<script>
import axios from 'axios';
import Form from 'vform';

   export default {
    name:"createRecouvrementCompenent",
    data(){
        return {
            filieres:[],
            form:new Form({
                'id_annee_academique':"",
                'id_mois':"",
                'id_departement':"",
                'id_unite_de_formation':"",
                'id_classe':"",
                                                                                                                                                                                                     
            }),
            annee_academiques:[],
            mois:[],
            departements:[],
            unite_de_formations:[],
            classes:[],
           

        }
    },
    mounted(){
       this.get_annee_academique();
        this.get_mois();
        this.get_departement();
        this.get_unite_de_formation();
        this.get_classe(); 


    },
    
    methods:{
        async soumettre(){
            const formdata = new FormData();
            formdata.append('id_annee_academique', this.form.id_annee_academique  );
            formdata.append('id_mois', this.form.id_mois  );
            formdata.append('id_departement', this.form.id_departement);
            formdata.append('id_unite_de_formation', this.form.id_unite_de_formation);
            formdata.append('id_classe', this.form.id_classe);
            

           
          
            },

        get_annee_academique(){
            axios.get('/annee_academique/index').then(response => {
            this.annee_academiques=response.data.annee_academique
            console.log(response.data.annee_academique);
            }).catch(error=>{
                Swal.fire('Erreur!','Une erreur est survenue lors de la recuperation des année_academiques','error')
            });
        },
        get_mois(){
            axios.get('/mois/index')
            .then(response => {
                this.mois=response.data.mois
            }).catch(error=>{
            this.resetForm();
            Swal.fire('Erreur!','Une erreur est survenue lors de la recuperation du mois','error')
            });
        },
        get_departement(){
            axios.get('/departement/all')
            .then(response => {
                this.departements=response.data.departement
            }).catch(error=>{
            this.resetForm();
            Swal.fire('Erreur!','Une erreur est survenue lors de la recuperation du departement','error')
            });
        },
        get_unite_de_formation(){
            axios.get('/unite_de_formation/all')
            .then(response => {
                this.unite_de_formations=response.data.unite_de_formation
            }).catch(error=>{
            this.resetForm();
            Swal.fire('Erreur!','Une erreur est survenue lors de la recuperation du filiere','error')
            });
        },
        get_classe(){
            axios.get('/classe/all')
            .then(response => {
                this.classes=response.data.classe
            }).catch(error=>{
            this.resetForm();
            Swal.fire('Erreur!','Une erreur est survenue lors de la recuperation de la classe','error')
            });
        },

        async filtre(){
        try {
            const response = await axios.post('recouvrement/filtre', this.form.getData());
            // Traitez la réponse de l'API selon vos besoins
            console.log(response.data);
        } catch (error) {
            console.error('Une erreur s\'est produite lors de la récupération des données filtrées.', error);
        }
    
        },

        closeModal(){
            var ajout=document.querySelector('[data-modal-filtre]');
           
            /* console.log(ajout); */
            var actif = document.querySelectorAll('.actif');
                actif.forEach(item => {
                item.classList.remove("actif");
            });
            //ajout.classList.remove("actif");
            ajout.close();
            this.editModal===false;

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

        resetForm(){
            this.form.id_annee_academique="";
            this.form.id_mois="";
            this.form.id_departement="";
            this.form.id_unite_de_formation="";
            this.form.id_classe="";
            this.closeModal();
           
           
        
    },

}
   }
</script>