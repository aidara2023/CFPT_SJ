<template>
    <dialog data-modal-ajout class="modal">
        <div class="cote_droit contenu">
            <form @submit.prevent="validerAvantAjout()" method="">
                <h1 class="sous_titre">Ajout Service</h1>
                <!--Informations personnelles-->
                <div class="personnel">
                    <div>
                        <input type="text" v-model="form.nom_service" id="nom" placeholder="Nom du Service" @input="validatedata('nom_service')">
                        <span class="erreur" v-if="this.nom_service_erreur !== ''">{{this.nom_service_erreur}}</span>
                    </div>
    
                    <div>
    
                        <select name="classe" id="classe" placeholder="Niveau" v-model="form.id_user" @change="validatedata('id_user')">
                            <option value="">Chef de service</option>
                            <option v-for="(user, index) in users" :value="user.id"> {{user.nom}} {{ user.prenom }}</option>
                        </select>
                        <span class="erreur" v-if="id_user_erreur !== ''">{{id_user_erreur}}</span>
                    </div>
    
                    
            
                    <div>
                        <select name="id_direction" id="id_direction" v-model="form.id_direction" @change="validatedata('id_direction')">
                                <option value=""> Direction</option>
                                <option v-for="(direction, index) in directions" :value="direction.id" :key="index">{{ direction.nom_direction }}</option>
                        </select>
                        <span class="erreur" v-if="id_direction_erreur !== ''">{{id_direction_erreur}}</span>
                    </div>
    
                </div>
    
                <div class="boutons">
                <input v-if="this.editModal===false"  type="submit" value="Ajouter" :class="{ 'data-close-modal': (this.etatForm) } ">
                <input v-if="this.editModal===true"  type="submit" value="Modifier" :class="{ 'data-close-modal': (this.etatForm) } ">
                <button type="button" class="texte annuler data-close-modal"  @click="resetForm">Annuler</button>
            </div>
            </form>
        </div>
    </dialog>
    </template>
    
    <script>
    import bus from '../../eventBus';
    import axios from 'axios';
    import Form from 'vform';
    import Swal from 'sweetalert2';
    
       export default {
        name:"createServiceCompenent",
        data(){
            return {
                users:[],
                form:new Form({
                    'nom_service':"",
                    'id_user':"",
                    'id_direction':""
                }),
                nom_service_erreur:"",
                id_user_erreur:"",
                id_direction_erreur:"",
                etatForm: false,
                editModal: false,
                idService: "",
            }
        },
    
        mounted(){
            this.get_user();
            this.get_direction();
            bus.on('serviceModifier', (eventData) => {
            this.idService = eventData.idService;
            this.editModal = eventData.editModal;
            this.form.nom_service = eventData.nom;
            this.form.id_user = eventData.id_user;
            this.form.id_direction = eventData.id_direction;
        });
        },
    
    
    
        methods:{
            async soumettre(){
                const formdata = new FormData();
                formdata.append('nom_service', this.form.nom_service  );
                formdata.append('id_user', this.form.id_user  );
                formdata.append('id_direction', this.form.id_direction  );
                try{
                    await axios.post('/service/store', formdata, {});
                    //Swal.fire('Réussi !', 'Service ajouté avec succès','success');
                    this.resetForm();
                    bus.emit('serviceAjoutee');

                }
                catch(e){
                    /* console.log(e.request.status) */
                    if(e.request.status===404){
                        Swal.fire('Erreur !','Ce service existe déjà','error')
                    }
                    else{
                        Swal.fire('Erreur !','Une erreur est survenue lors de l\'enregistrement','error')
                    }

                }
    
            },
    
        validerAvantAjout() {
            const isVerifIdValid = this.validatedataOld();
           /*  const isIdChampValid = this.verifIdUser(); */
            /*   console.log(isNomChampValid); */
            if (isVerifIdValid===true) {
                this.etatForm = false;
                this.editModal=false;
                return 0;
            }else{

                if(this.editModal===true){
                    this.etatForm= true;
                    this.update_service(this.idService);
                    this.closeModal('[data-modal-confirmation-modifier]');  
                    this.editModal=false;
                }
            
            else{
                this.soumettre();
                this.etatForm = true;
                this.closeModal('[data-modal-confirmation]');
                this.editModal=false;
                // console.log(Tokkos);
            }
            
            }
        },
    
        resetForm(){
            this.form.nom_service="";
            this.form.id_user="";
            this.form.id_direction=""
            this.nom_service_erreur= "";
            this.id_user_erreur= "";
            this.id_direction_erreur= "";
            this.editModal=false;
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

        verifCaratere(nom){
            const valeur= /^[a-zA-ZÀ-ÿ\s]*$/;
            return valeur.test(nom);
        },

        validatedata(champ){

            switch (champ) {
            case 'nom_service':
            this.nom_service_erreur= "";
            // Effectuez la validation pour le champ 'nom'
            if(this.form.nom_service=== ""){
                this.nom_service_erreur= "Ce champ est obligatoire"
                return true
            }
            if(!this.verifCaratere(this.form.nom_service)){
                this.nom_service_erreur= "Ce champ ne peut comporter que des lettres et des espaces"
                /* this.erreur= "Ce champ ne peut comporter que des lettres et des espaces" */
                return true
            }
            if(this.form.nom_service.length < 12){
                this.nom_service_erreur= "Ce champ doit contenir au moins 12 Caratères"
                ;
                return true
            }
            break;
            
            case 'user':
            this.id_user_erreur= "";
            //pour user
            if(this.form.id_user=== ""){
                this.id_user_erreur= "Vous avez oublié de sélectionner  le chef de service'"
                return true
            }
            break;
            
            case 'direction':
            //pour direction
            this.id_direction_erreur= "";
            if(this.form.id_direction=== ""){
                this.id_direction_erreur= "Vous avez oublié de sélectionner  le chef de direction'"
                return true
            }
            break;

            case 'id_user':
            //pour direction
            this.id_user_erreur= "";
            if(this.form.id_user=== ""){
                this.id_user_erreur= "Vous avez oublié de sélectionner le chef de service"
               return true
            }
            break;

            case 'id_direction':
            //pour direction
            this.id_direction_erreur= "";
            if(this.form.id_direction=== ""){
                this.id_direction_erreur= "Vous avez oublié de sélectionner la direction concernée"
                return true;
            }
            break;
            
            default:
                break;
            }
            return false;
        },
    
        validatedataOld(){
            this.nom_service_erreur= "";
            this.id_user_erreur= "";
            this.id_direction_erreur= "";
            var i=0;
    
    
            if(this.form.nom_service=== ""){
                this.nom_service_erreur= "Ce champ est obligatoire"
                
                i=1;
            }
            if(!this.verifCaratere(this.form.nom_service)){
                this.nom_service_erreur= "Ce champ ne peut comporter que des lettres et des espaces"
                ;
                i=1;
            }
            if(this.form.nom_service.length < 12){
                this.nom_service_erreur= "Ce champ doit contenir au moins 12 Caratères"
                ;
                i=1;
            }
            if(this.form.id_user=== ""){
                this.id_user_erreur= "Vous avez oublié de sélectionner le chef de service"
                ;
                i=1;
            }
            if(this.form.id_direction=== ""){
                this.id_direction_erreur= "Vous avez oublié de sélectionner la direction concernée"
                ;
                i=1;
            }
            if(i==1) return true;       
    
            return false;
        },

        get_user(){
            axios.get('/user/getpersoadminunique')
            .then(response => {
                this.users=response.data.user
                }).catch(error=>{
                Swal.fire('Erreur!','Une erreur est survenue lors de la recuperation des membres administratifs','error')
            });
        },

        get_direction(){
            axios.get('/direction/index')
            .then(response => {
                this.directions=response.data.direction
            
            
            }).catch(error=>{
            Swal.fire('Erreur!','Une erreur est survenue lors de la recupération des directions','error')
            });
        },

        async update_service(id){
         const formdata = new FormData();
            formdata.append('nom_service', this.form.nom_service  );
            formdata.append('id_user', this.form.id_user);
            formdata.append('id_direction', this.form.id_direction);

             //if(this.form.nom!==""){
            try{
                await axios.post('/service/update/'+id, formdata);
                bus.emit('serviceAjoutee');
                this.resetForm();
                this.editModal=false;
            }
            catch(e){
                /* console.log(e.request.status) */
                if(e.request.status===404){
                    Swal.fire('Erreur !','Ce service existe déjà','error')
                }
                else{
                    Swal.fire('Erreur !','Une erreur est survenue lors de l\'enregistrement','error')
                }
            }
        }
    
        }
    }
    </script>
    
    