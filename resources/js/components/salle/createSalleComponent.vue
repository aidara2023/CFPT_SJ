<template>
    <dialog data-modal-ajout class="modal">
        <div class="cote_droit contenu">
            <form @submit.prevent="validerAvantAjout()" method="">
                <h1 class="sous_titre">Ajout Salle</h1>
                <!--Informations personnelles-->
                    <div class="personnel">
                
                  
                       <input type="text" name="nom" id="nom" placeholder="Intitule" v-model="form.intitule"  @input="validatedata('intitule')">
                       <span class="erreur" v-if="this.nom_salle_erreur !== ''">{{this.nom_salle_erreur}}</span>
                   </div>
                    <div>
                        <input type="text" v-model="form.nombre_place" id="nom_place" placeholder="Nombre de place" @input="validatedata('nombre_place')">
                        <span class="erreur" v-if="this.nombre_place_erreur !== ''">{{this.nombre_place_erreur}}</span>
                    </div>
    
                    <div class="batiments">
                        <div>
                               <select name="batiment" id="batiment" v-model="form.id_batiment"  @change="verifIdBatiment()" >
                                    <option value=""> Batiment</option>
                                    <option v-for="batiment in batiments" :value="batiment.id">{{ batiment.intitule }} </option>
                                </select>
                                <span class="erreur" v-if="id_batiment_erreur !== ''">{{id_batiment_erreur}}</span>
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
        name:"createSalleCompenent",
        data(){
            return {
                users:[],
                form:new Form({
                    'intitule':"",
                    'nombre_place':"",
                    'id_batiment':"",
                }),
                nom_salle_erreur:"",
                nombre_place_erreur:"",
                id_batiment_erreur:"",
                etatForm: false,
                editModal: false,
                idSalle: "",
            }
        },
    
        mounted(){
            this.get_batiment();
            bus.on('salleModifier', (eventData) => {
            this.idSalle = eventData.idSalle;
            this.editModal = eventData.editModal;
            this.form.intitule = eventData.nom;
            this.form.nombre_place = eventData.nombre_place;
            this.form.id_batiment = eventData.id_batiment;
        });
        },
    
        
    
        methods:{
            async soumettre(){
                const formdata = new FormData();
                formdata.append('intitule', this.form.intitule );
                formdata.append('nombre_place', this.form.nombre_place);
                formdata.append('id_batiment', this.form.id_batiment  );
                    try{
                        await axios.post('/salle/store', formdata, {});
                        this.resetForm();
                        bus.emit('salleAjoutee');
                    }
                    catch(e){
                        /* console.log(e.request.status) */
                      if(e.request.status===404){
                        Swal.fire('Erreur !','Ce salle existe déjà','error')
                      }
                      else{
                        Swal.fire('Erreur !','Une erreur est survenue lors de l\'enregistrement','error')
                      }
    
                    }
    
            },
    
            validerAvantAjout() {
                // Exécutez la validation des champs
                const isNomSalleValid = this.validatedataold();
                const isIdBatimentValid = this.verifIdBatiment();
    
              /*   console.log(isNomSalleValid); */
                if (isNomSalleValid===true || isIdBatimentValid===true ) {
                    this.etatForm= false;
                    return 0;
                }else{

                    if(this.editModal===true){
                        this.etatForm= true;
                        this.update_salle(this.idSalle);
                        this.closeModal('[data-modal-confirmation-modifier]');  
                    }

                    else{
                    this.soumettre();
                    this.etatForm = true;
                    this.closeModal('[data-modal-confirmation]');
                    // console.log(Tokkos);
                    }
                }
            }, 
    
            resetForm(){
                this.form.intitule="";
                this.form.nombre_place="";
                this.form.id_batiment="";
                this.nom_salle_erreur= "";
                this.nombre_place_erreur="";
                this.id_batiment_erreur= "";
            },
    
            verifCaratere(nom){
                const valeur= /^[a-zA-ZÀ-ÿ\s]*$/;
                return valeur.test(nom);
            },
    
        validatedataold(){
            this.nom_salle_erreur= "";
            this.nombre_place_erreur="";
            this.id_batiment_erreur= "";
            var i=0;
            if(this.form.id_batiment=== ""){
                this.id_batiment_erreur= "Vous avez oublié de sélectionner le batiment"
                i=1;
            }
           
            
            if(this.form.intitule=== ""){
                this.nom_salle_erreur= "Ce champ est obligatoire"
                i=1;
                 
            }
            if(!this.verifCaratere(this.form.intitule)){
                this.nom_salle_erreur= "Ce champ ne peut comporter que des lettres et des espaces"
                i=1;
                
            }
            if(this.form.intitule.length < 12){
                this.nom_salle_erreur= "Ce champ doit contenir au moins 12 Caratères"
                i=1;
                
            }
            if(this.form.id_batiment=== ""){
                this.id_batiment_erreur= "Vous avez oublié de sélectionner le batiment"
                ;
                i=1;
            }
            if(this.form.nombre_place=== ""){
                this.nombre_place_erreur= "Vous avez oublié de sélectionner le nombre de place"
                ;
                i=1;
            }
            
            if(i===1)
            return true;
            return false;
           
        },
        validatedata(champ) {
    // Réinitialiser les erreurs pour le champ actuel
        this.nom_salle_erreur= "";
        this.nombre_place_erreur="";
        this.id_batiment_erreur="";
        var i= 0;

    switch (champ) {
        case 'intitule':
            // Effectuez la validation pour le champ 'nom'
            if(this.form.intitule=== ""){
            this.nom_salle_erreur= "Ce champ est obligatoire"
            i= 1;
            return true
            
            }
            if(!this.verifCaratere(this.form.intitule)){
                this.nom_salle_erreur= "Ce champ ne peut comporter que des lettres et des espaces"
                /* this.erreur= "Ce champ ne peut comporter que des lettres et des espaces" */
                i= 1;
                return true
            }
            // Ajoutez d'autres validations si nécessaire
            break;
        case 'nombre_place':
            //pour prenom
            if(this.form.nombre_place=== ""){
            this.nombre_place_erreur= "Ce champ est obligatoire" 
            i= 1;
            return true
            }
            if(!/^\d+$/.test(this.form.nombre_place)) {
                this.nombre_place_erreur = "Ce champ ne peut contenir que des chiffres";
                
            i= 1;
            return true
            }
            break;
        default:
           break;
    }
},
        verifIdBatiment(){
            this.id_batiment_erreur= "";
    
            if(this.form.id_batiment=== ""){
                this.id_batiment_erreur= "Vous avez oublié de sélectionner la salle"
                return true;
            }
            return false;
        },
    
        get_batiment(){
                axios.get('/batiment/index')
                .then(response => {
                    this.batiments=response.data.batiment
                 }).catch(error=>{
                   Swal.fire('Erreur!','Une erreur est survenue lors de la recuperation des membres administratifs','error')
               });
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

        async update_sale(id){
         const formdata = new FormData();
            formdata.append('intitule', this.form.intitule  );
            formdata.append('nombre_place', this.form.nombre_place);
            formdata.append('id_batiment', this.form.id_batiment);

             //if(this.form.nom!==""){
            try{
                await axios.post('/sale/update/'+id, formdata);
                bus.emit('salleAjoutee');
                this.resetForm();
            }
            catch(e){
                /* console.log(e.request.status) */
                if(e.request.status===404){
                    Swal.fire('Erreur !','Cette sale existe déjà','error')
                }
                else{
                    Swal.fire('Erreur !','Une erreur est survenue lors de l\'enregistrement','error')
                }
            }
        }
    
        }
    }
    </script>