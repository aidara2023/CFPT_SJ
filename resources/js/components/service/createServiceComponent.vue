<template>
     <dialog data-modal-ajout class="modal ">
         
         <div class="titres">
             <h1>Nouveau Service</h1>
            <!--  <h3>Informations Personnelles</h3> -->
         </div>
         <!-- <div class="contenu"> -->
             <form @submit.prevent="validerAvantAjout()" action="" method="dialog" >
                 
                     
                 <!-- mettre class = "informations" uniquement pour un modal qui n'a pas de photo
                 Et enlever la div au dessus -->
                 <div class="informations">
                     <div class="titres">
                         <h1>Nouveau Service</h1>
                     </div>
 
                     <div class="champ">
                         <label for="nom" :class="{ 'couleur_rouge': (this.nom_service_erreur)} ">Nom Service</label>
                         <input  v-model="form.nom_service" id="nom"  @input="validatedata('nom_service')" type="text" name="nom" :class="{ 'bordure_rouge': (this.nom_service_erreur)} ">
                         <span class="erreur" >{{this.nom_service_erreur}}</span>
                     </div>
                 
                     <div class="groupe_champs">
 
                     
                     <div class="champ">
                         <label for="nom" :class="{ 'couleur_rouge': (this.id_user_erreur)} ">Chef Service</label>
                         <select v-model="form.id_user"  @change="validatedata('id_user')" :class="{ 'bordure_rouge': (this.id_user_erreur)} ">
                             <option v-for="user in users" :value="user.id">{{ user.nom }} {{ user.prenom }} </option>
                         </select>
                         <span class="erreur" v-if="id_user_erreur !== ''">{{id_user_erreur}}></span>
                     </div>
 
                     <div class="champ">
                         <label for="nom" :class="{ 'couleur_rouge': (this.id_direction_erreur)} ">Direction</label>
                         <select  v-model="form.id_direction" @change="validatedata('id_direction')" :class="{ 'bordure_rouge': (this.id_direction_erreur)} ">
                             <option v-for="(direction, index) in directions" :value="direction.id" :key="index">{{ direction.nom_direction }}</option>
                         </select>
                         <span class="erreur" v-if="id_direction_erreur !== ''">{{id_direction_erreur}}></span>
                     </div>
                 </div>                
 
                     <!-- Le groupe qui contient les boutons -->
                <div class="groupe_champs validation">
                        <!-- Mettre la valeur 1 dans le data-close-modal pour qu'il soit actif -->
                        <button type="button" data-close-modal="1" class="annuler"><span data-statut="visible" @click="resetForm">Annuler</span></button> 
                        <button v-if="this.editModal===false" type="submit" data-close-modal="0" class="suivant"><span data-statut="visible">Ajouter</span></button>
                        <button  v-if="this.editModal===true" type="submit" data-close-modal="0" class="suivant"><span data-statut="visible">Modifier</span></button>
                    </div>
 
                     </div>
                 
               
             </form>
 
 
        <!--  </div> -->
     
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
                 directions:[],
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
 
  /*        var erreur = document.querySelectorAll('.erreur');
         console.log(erreur); */
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
             
             /*   console.log(isNomChampValid); */
             if (isVerifIdValid===true) {
                 this.etatForm = false;
                 this.editModal=false;
                 console.log("erreur")
                 return 0;
             }else{
 
                 if(this.editModal===true){
                     this.etatForm= true;
                     this.form.nom_service = this.form.nom_service.toUpperCase();
                     this.update_service(this.idService);
                     this.closeModal('[data-modal-confirmation-modifier]');  
                     this.editModal=false;
                 }
             
             else{
                this.form.nom_service = this.form.nom_service.toUpperCase();
                 this.soumettre();
                 this.etatForm = true;
                 this.closeModal('[data-modal-confirmation]');
                 this.editModal=false;
                 console.log("Tokkos");
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
 
             if(this.etatForm==true){
                 var actif = document.querySelectorAll('.actif');
                 actif.forEach(item => {
                 item.classList.remove("actif");
             });
                 ajout.close();
             }
             /* console.log(ajout); */
           
             //ajout.classList.remove("actif");
             
            
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
                 //this.coloration_erreur_rouge(this.nom_service_erreur);
                 return true
             }
             if(!this.verifCaratere(this.form.nom_service)){
                 this.nom_service_erreur= "Ce champ ne peut comporter que des lettres et des espaces"
                 /* this.erreur= "Ce champ ne peut comporter que des lettres et des espaces" */
                // this.coloration_erreur_rouge(this.nom_service_erreur);
                 return true
             }
             if(this.form.nom_service.length < 12){
                 this.nom_service_erreur= "Ce champ doit contenir au moins 12 Caractères"
                 ;
                // this.coloration_erreur_rouge(this.nom_service_erreur);
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
     
     