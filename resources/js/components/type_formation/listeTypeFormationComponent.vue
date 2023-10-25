<template>
    <div class="sections" v-for="(formation, index) in formations" :key="index">
            <!-- Répéter la div utilisateur pour un autre utilisateur -->
            <div class="utilisateur">
                <img src="/assetsCFPT/image/image1.png" alt="Etu" class="petite">
                <p class="texte" id="n">{{ formation.intitule }}</p>
                <div  class="presences">
                    <a href="#" class="texte b">
                        <i class="fi fi-rr-edit"></i>
                        <span class="modifier mdl">Modifier</span>
                    </a>
                    <a href="" class="texte b">
                        <i class="fi fi-rr-comment-alt-dots"></i>
                        <span class="details">Détails</span>
                    </a>
                    <a href="#" class="texte b">
                        <i class="fi fi-rr-cross"></i>
                        <span class="supprimer mdl">Supprimer</span>
                    </a>
                </div>
            </div>
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
            formations: [],


        }
    },
    mounted(){
        this.get_formation();
    },


    methods:{
        get_formation(){
            axios.get('/type_formation/all')
            .then(response => {
                this.formations=response.data.type_formation


            }).catch(error=>{
            Swal.fire('Erreur!','Une erreur est survenue lors de la recuperation des formation','error')
            });
        },

        changement(event){
            this.interesser= event;
        },

        resetForm(){

            this.form.input="";
            this.form.intitule="";


        },



    }
}
</script>
