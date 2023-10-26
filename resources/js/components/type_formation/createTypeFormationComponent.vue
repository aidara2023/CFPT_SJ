<template>
    <div class="cote_droit">
        <form @submit.prevent="soumettre()" method="dialog">

            <h1 class="sous_titre">Ajout Type Formation</h1>

            <div class="personnel">
            <input type="text" name="intitule" id="intitule" placeholder="intitule" v-model="form.intitule">
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
    name:"createTypeFormationCompenent",
    data(){
        return {
            form:new Form({
                'intitule':""

            }),


        }
    },
    // mounted(

    // ){

    //     this.rafraichissementAutomatique();

    // },


    methods:{
        async soumettre(){
            const formdata = new FormData();
            formdata.append('intitule', this.form.intitule );



            if(this.form.intitule!=="" ){
                try{
                    const create_store=await axios.post('/type_formation/store', formdata, {

                    });
                    Swal.fire('Succes!','type_formation ajouté avec succés','succes')
                    this.resetForm();
                }
                catch(e){
                    console.log(e)
                    Swal.fire('Erreur!','Une erreur est survenue lors de l\'enregistrement','error')
                }

            }else{
                Swal.fire('Erreur!','Veuillez remplir le champs obligatoirement','error')
            }


        },
        changement(event){
            this.interesser= event;
        },



        resetForm(){
            // var ajout = document.querySelector("[data-modal-ajout]");
            // var fermemod = document.querySelectorAll('[data-close-modal]');
            // //Fermeture des modals
            // fermemod.forEach(item => {
            //     item.addEventListener('click', () => {
            //     var actif = document.querySelectorAll('.actif');
            //         actif.forEach(item => {
            //             item.classList.remove("actif");
            //         });
            //             ajout.close();
            //             modification.close();
            //             suppression.close();

            // })
       /*    ajout.remove("active");  */

            // });
            this.form.input="";
            this.form.intitule="";


        },
    //     rafraichissementAutomatique() {
    //         document.addEventListener("DOMContentLoaded", this.resetForm());
    // },



    }
   }
</script>


