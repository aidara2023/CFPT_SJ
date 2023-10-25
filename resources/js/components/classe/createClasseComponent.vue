<template>
    <div class="cote_droit contenu">
        <form @submit.prevent="soumettre" method="dialog">
            <h1 class="sous_titre">Ajout classe</h1>

            <div class="personnel">
             <!--    <input type="text" name="type_classe" id="type_classe" placeholder="Type de classe" v-model="form.type_classe"> -->
                <input type="text" name="nom_classe" id="nom_classe" placeholder="Nom classe" v-model="form.nom_classe">
            </div>
           <div>
            <select name="type_formation" id="type_formation" v-model="form.type_classe">
                    <option value="">Type Classe</option>
                    <option  value="Non payant">Public</option>
                    <option  value="Payant">Privé</option>
                </select>
           </div>
                <!-- <input type="text" name="niveau" id="niveau" placeholder="Niveau" v-model="form.niveau"> -->

                <div>
                <select name="type_formation" id="type_formation" v-model="form.niveau">
                    <option value="">Selectioner Niveau</option>
                    <option  value="Niveau 1 ">1 </option>
                    <option  value="Niveau 2 ">2 </option>
                    <option  value="Niveau 3">3</option>
                </select>
            </div>

        <div class="type_formation">
                <select name="type_formation" id="type_formation" v-model="form.id_type_formation">
                        <option value=""> Type de formation </option>
                        <option v-for="type_formation in type_formations" :value="type_formation.id">{{ type_formation.intitule }}</option>
                </select>
            </div>

            <div class="unite_de_formation">
                <select name="unite_de_formation" id="unite_de_formation" v-model="form.id_unite_de_formation">
                        <option value=""> Unite de formation </option>
                        <option v-for="unite_de_formation in unite_de_formations" :value="unite_de_formation.id">{{ unite_de_formation.nom_unite_formation }}</option>
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
    name:"classeCompenent",
    data(){
        return {
            form:new Form({
                'nom_classe':"",
                'type_classe':"",
                'niveau':"",
                'id_type_formation':"",
                'id_unite_de_formation':"",

            }),
            type_formations:[],
          unite_de_formations:[]


        }
    },
    mounted(){
        this.get_type_formation();
        this.get_unite_de_formation();
        this.rafraichissementAutomatique();

    },


    methods:{
        async soumettre(){
            const formdata = new FormData();
            formdata.append('nom_classe', this.form.nom_classe );
            formdata.append('type_classe', this.form.type_classe  );
            formdata.append('niveau', this.form.niveau );
            formdata.append('id_type_formation', this.form.id_type_formation );
            formdata.append('id_unite_de_formation', this.form.id_unite_de_formation );


            if(this.form.nom_classe!=="" && this.form.type_classe!==""  && this.form.niveau!==""){
                try{
                    const create_store=await axios.post('/classe/store', formdata, {

                    });
                    this.resetForm();
                    Swal.fire('Succes!','classe ajouté avec succés','success')
                    
                }
                catch(e){
                    console.log(e)
                    if(e.request.status===404){
                    Swal.fire('Erreur!','Cette classe existe déjà','error')
                  }
                  else{
                    Swal.fire('Erreur!','Une erreur est survenue lors de l\'enregistrement','error')
                  }
                }

            }else{
                this.resetForm();
                Swal.fire('Erreur!','Veuillez remplir tous les champs obligatoires','error')
            }


        },


         get_type_formation(){

             axios.get('/type_formation/all')
             .then(response => {
                 this.type_formations=response.data.type_formation


            }).catch(error=>{
                this.resetForm();
                Swal.fire('Erreur!','Une erreur est survenue lors de la recuperation du type de formation','error')
            });
        },

        get_unite_de_formation(){

            axios.get('/unite_de_formation/all')
            .then(response => {
                this.unite_de_formations=response.data.unite_de_formation


           }).catch(error=>{
            this.resetForm();
               Swal.fire('Erreur!','Une erreur est survenue lors de la recuperation de lunite de formation','error')
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

            this.nom_classe="";
            this.type_classe="";
            this.niveau="";
            this.form.id_type_formation="";
            this.form.id_unite_de_formation="";


        },
        rafraichissementAutomatique() {
            document.addEventListener("DOMContentLoaded", this.resetForm());
    },


    }
   }
</script>

