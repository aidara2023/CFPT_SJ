<template>
    <div class="item_bloc">


        <h3>Pages</h3>
        <div class="container">
            <div class="container page">
                <i class="fi fi-rr-chart-histogram"></i>
                <div>
                    <span>Taux de réussite</span>
                    <h2>  <CounterCard :targetNumber="82" />%</h2>
                </div>
            </div>
            <div class="container page">
                <i class="fi fi-rr-folder-minus"></i>
                <div>
                    <span>Unités de formation</span>
                    <h2>  <CounterCard :targetNumber="11" /></h2>
                </div>
            </div>
            <div class="container page">
                <i class="fi fi-rr-user"></i>
                <div>
                    <span>Formateurs</span>
                    <h2>  <CounterCard :targetNumber="48" /></h2>
                </div>
            </div>
            <div class="container page">
                <i class="fi fi-rr-user"></i>
                <div>
                    <span>Elèves</span>
                    <h2>  <CounterCard :targetNumber="1300" />+</h2>
                </div>
            </div>
        </div>

    </div>

    <br>

    <div class="item_bloc">
        <h3>Graphiques</h3>
        <div class="container">
            <div class="container graphique">
                <h4>Finance</h4>
                <div class="courbe">
                    <!-- lignes -->
                    <div class="ligne">
                        <span class="texte">20</span>
                        <hr>
                    </div>
                    <div class="ligne">
                        <span class="texte">15</span>
                        <hr>
                    </div>
                    <div class="ligne">
                        <span class="texte">15</span>
                        <hr>
                    </div>
                    <div class="ligne">
                        <span class="texte">15</span>
                        <hr>
                    </div>
                    <div class="ligne">
                        <span class="texte">15</span>
                        <hr>
                    </div>
                    <div class="ligne">
                        <span class="texte">15</span>
                        <hr>
                    </div>
                    <div class="ligne">
                        <span class="texte">15</span>
                        <hr>
                    </div>
                    <div class="ligne">
                        <span class="texte">10</span>
                        <hr>
                    </div>
                    <div class="diagramme">
                        <!-- barres du diagramme -->
                        <div class="barre"><span class="texte nts">mois</span></div>
                        <div class="barre"><span class="texte nts">mois</span></div>
                        <div class="barre"><span class="texte nts">mois</span></div>
                        <div class="barre"><span class="texte nts">mois</span></div>
                        <div class="barre"><span class="texte nts">mois</span></div>
                        <div class="barre"><span class="texte nts">mois</span></div>
                    </div>
                </div>
            </div>
            <div class="container graphique">
                <h4>Autre chose</h4>
                <div class="courbe">
                    <!-- lignes -->
                    <div class="ligne">
                        <span class="texte">20</span>
                        <hr>
                    </div>
                    <div class="ligne">
                        <span class="texte">15</span>
                        <hr>
                    </div>
                    <div class="ligne">
                        <span class="texte">15</span>
                        <hr>
                    </div>
                    <div class="ligne">
                        <span class="texte">15</span>
                        <hr>
                    </div>
                    <div class="ligne">
                        <span class="texte">15</span>
                        <hr>
                    </div>
                    <div class="ligne">
                        <span class="texte">15</span>
                        <hr>
                    </div>
                    <div class="ligne">
                        <span class="texte">15</span>
                        <hr>
                    </div>
                    <div class="ligne">
                        <span class="texte">10</span>
                        <hr>
                    </div>
                    <div class="diagramme">
                        <!-- barres du diagramme -->
                        <div class="barre"><span class="texte nts">mois</span></div>
                        <div class="barre"><span class="texte nts">mois</span></div>
                        <div class="barre"><span class="texte nts">mois</span></div>
                        <div class="barre"><span class="texte nts">mois</span></div>
                        <div class="barre"><span class="texte nts">mois</span></div>
                        <div class="barre"><span class="texte nts">mois</span></div>
                    </div>
                </div>
            </div>
            <div class="container graphique">
                <h4>Encore autre chose</h4>
                <div class="courbe">
                    <!-- lignes -->
                    <div class="ligne">
                        <span class="texte">20</span>
                        <hr>
                    </div>
                    <div class="ligne">
                        <span class="texte">15</span>
                        <hr>
                    </div>
                    <div class="ligne">
                        <span class="texte">15</span>
                        <hr>
                    </div>
                    <div class="ligne">
                        <span class="texte">15</span>
                        <hr>
                    </div>
                    <div class="ligne">
                        <span class="texte">15</span>
                        <hr>
                    </div>
                    <div class="ligne">
                        <span class="texte">15</span>
                        <hr>
                    </div>
                    <div class="ligne">
                        <span class="texte">15</span>
                        <hr>
                    </div>
                    <div class="ligne">
                        <span class="texte">10</span>
                        <hr>
                    </div>
                    <div class="diagramme">
                        <!-- barres du diagramme -->
                        <div class="barre"><span class="texte nts">mois</span></div>
                        <div class="barre"><span class="texte nts">mois</span></div>
                        <div class="barre"><span class="texte nts">mois</span></div>
                        <div class="barre"><span class="texte nts">mois</span></div>
                        <div class="barre"><span class="texte nts">mois</span></div>
                        <div class="barre"><span class="texte nts">mois</span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import bus from '../../eventBus';
import axios from 'axios';
import Form from 'vform';
import CounterCard from "@/components/dashboard/compteurComponent.vue"; // Ajoutez le chemin correct




export default {
    name: "listeDirectionComponent",
    components: {
        CounterCard,
    },
    data() {
        return {
            form: new Form({
                'nom_direction': "",
                'id_user': ""

            }),
            directions: [],
            idDirection: "",
            editModal: false,


        }
    },
    mounted() {

    },

    methods: {

    }
}
</script>

<style scoped>

h2{
  display: flex;
  font-size: 3rem; 

}

/* .digit {
  font-size: 3rem; 
  margin-right: 5px; 
} */
</style>
