<template>
    <dialog data-modal-ajout class="modal">
      <div class="cote_droit contenu">
        <form @submit.prevent="validerAvantAjout()">
            <h1 class="sous_titre">Ajout de departement</h1>

            <div class="personnel">
                <div>
                    <input type="text" v-model="form.nom" id="nom" placeholder="Nom du Departement" @input="validatedata()">
                    <span class="erreur" v-if="this.nom_departement_erreur !== ''">{{this.nom_departement_erreur}}</span>
                </div>
            </div>

            <div class="directions">
                <div>
                    <select name="direction" id="direction" v-model="form.id_direction"  @change="verifIdDirection()" >
                        <option value=""> Direction</option>
                        <option v-for="direction in directions" :value="direction.id">{{ direction.nom_direction }} </option>
                    </select>
                    <span class="erreur" v-if="id_direction_erreur !== ''">{{id_direction_erreur}}</span>
                </div>
            </div>


            <div class="boutons">
                <input v-if="this.editModal===false"  type="submit" value="Ajouter" :class="{ 'data-close-modal': (this.etatForm) } ">
                <input v-if="this.editModal===true"  type="submit" value="Modifier" :class="{ 'data-close-modal': (this.etatForm) } ">
                <!-- <input v-if="this.editModal===true" type="submit" value="Modifier" :class="{ 'data-close-modal': (etatForm) } "> :class="{ 'data-close-modal': !(this.etatForm) } " :class="{ 'data-close-modal': !(validatedata() && verifIdUser()) } "  -->
                <button type="button" class="texte annuler data-close-modal" >Annuler</button>
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
    name:"createDepartementCompenent",
    data(){
        return {
            filieres:[],
            form:new Form({
                'nom':"",
                'id_direction':""
            }),

            directions:[],
            nom_departement_erreur:"",
            id_direction_erreur:"",
            etatForm: false,
            editModal: false,
            idDepartement: "",


        }
    },

    mounted(){

        this.get_direction();
        bus.on('departementModifier', (eventData) => {
            this.idDepartement = eventData.idDepartement;
            this.editModal = eventData.editModal;
            this.form.nom = eventData.nom;
            this.form.id_direction = eventData.id_direction;
        });
    },


    methods:{
        async soumettre(){
            const formdata = new FormData();
            formdata.append('nom_departement', this.form.nom  );
            formdata.append('id_direction', this.form.id_direction);

             //if(this.form.nom!==""){
            try{
                await axios.post('/departement/store', formdata);
                this.resetForm();
                bus.emit('departementAjoutee');

            }
            catch(e){
                /* console.log(e.request.status) */
                if(e.request.status===404){
                Swal.fire('Erreur !','Ce département existe déjà','error')
                }
                else{
                Swal.fire('Erreur !','Une erreur est survenue lors de l\'enregistrement','error')
                }
            }

        },


        validerAvantAjout() {
            const isNomDepartementValid = this.validatedata();
            const isIdDirectionValid = this.verifIdDirection();

            console.log(isNomDepartementValid);
            console.log(isIdDirectionValid);

            if ( isNomDepartementValid===true || isIdDirectionValid===true ) {
                this.etatForm= false;
                return 0;
            }else{

                if(this.editModal===true){
                    this.etatForm= true;
                    this.update_departement(this.idDepartement);
                    this.closeModal('[data-modal-confirmation-modifier]');
                    
                }
                else{
                    this.etatForm= true;
                    this.soumettre();
                    this.closeModal('[data-modal-confirmation]');
                }
            }

        },

        resetForm(){
            this.form.nom="";
            this.form.id_direction="";
            this.editModal===false;
        },

        closeModal(selector){
            var ajout=document.querySelector('[data-modal-ajout]');
            var confirmation = document.querySelector(selector);

            /* console.log(ajout); */
            var actif = document.querySelectorAll('.actif');
                actif.forEach(item => {
                item.classList.remove("actif");
            });
            //ajout.classList.remove("actif");
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

        verifCaratere(nom){
            const valeur= /^[a-zA-ZÀ-ÿ\s]*$/;
            return valeur.test(nom);
        },

        validatedata(){
            this.nom_departement_erreur= "";

            if(this.form.nom=== ""){
                this.nom_departement_erreur= "Ce champ est obligatoire"
                return true;
            }
            if(!this.verifCaratere(this.form.nom)){
                this.nom_departement_erreur= "Ce champ ne peut comporter que des lettres et des espaces"
                return true;
            }
            if(this.form.nom.length <14 ){
                this.nom_departement_erreur= "Ce champ doit contenir au moins 14 Caratères"
                return true;
            }
            return false;

        },

        verifIdDirection(){
            this.id_direction_erreur= "";

            if(this.form.id_direction=== ""){
                this.id_direction_erreur= "Vous avez oublié de sélectionner la direction"
                return true;
            }
            return false;
        },

        get_direction(){
            axios.get('/direction/index')
            .then(response => {
                this.directions=response.data.direction
            }).catch(error=>{
            this.resetForm();
            Swal.fire('Erreur!','Une erreur est survenue lors de la recuperation de la direction','error')
            });
        },

    async update_departement(id){
         const formdata = new FormData();
            formdata.append('nom_departement', this.form.nom  );
            formdata.append('id_direction', this.form.id_direction);

             //if(this.form.nom!==""){
            try{
                await axios.post('/departement/update/'+id, formdata);
                bus.emit('departementAjoutee');
                this.resetForm();
            }
            catch(e){
                /* console.log(e.request.status) */
                if(e.request.status===404){
                    Swal.fire('Erreur !','Ce département existe déjà','error')
                }
                else{
                    Swal.fire('Erreur !','Une erreur est survenue lors de l\'enregistrement','error')
                }
            }
    }

    }


   }

</script>

