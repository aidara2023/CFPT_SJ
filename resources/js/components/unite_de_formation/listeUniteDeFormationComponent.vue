<template>
    <div class="liste">
        <div class="table-container">
            <table>
                <thead>
                    <th>Filiere</th>
                    <th>Departement</th>
                    <th>Chef de Filiere</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                    <tr v-for="(unite_de_formation, index) in unite_de_formations" :key="index">
                        <td><span>{{ unite_de_formation.nom_unite_formation }}</span></td>
                        <td> <span>{{ unite_de_formation.departement.nom_departement }}</span></td>
                        <td><span>{{ unite_de_formation.user.prenom }} {{ unite_de_formation.user.nom }}</span></td>
                        <td>
                            <div class="boutons_actions">
                                <i class="fi fi-rr-edit modifier mdl" @click="openModal(unite_de_formation)"
                                    title="Modifier"></i>
                                <i class="fi fi-rr-comment-alt-dots details mdl" title="Détails"></i>
                                <i class="fi fi-rr-trash supprimer mdl" @click="deleteUniteDeFormation(unite_de_formation)"
                                    title="Supprimer"></i>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!--  <div class="avant" style=" margin-left: 80%;">
           
            <a href="#">
                <button class="texte ajout mdl" > <i class="fi fi-rr-plus"></i><span>Ajouter</span></button>
            </a>
        </div>
        <h1 class="texte">Filiéres</h1>
        <div class="sections" v-for="(unite_de_formation, index) in unite_de_formations" :key="index">
           
            <div class="utilisateur">
             
                <p class="texte" id="n">{{ unite_de_formation.nom_unite_formation }} </p>
               <p class="texte" id="n">{{ unite_de_formation.departement.nom_departement }}</p>
             
                <div  class="presences">
                    <a href="#" class="texte b">
                        <i class="fi fi-rr-bars-sort"></i>
                        <span class="modifier">Actions</span>           
                    </a>

                    <a href="#" class="texte b" @click="openModal(unite_de_formation)">
                        <i class="fi fi-rr-edit"></i>
                        <span class="modifier mdl">Modifier</span>
                    </a>
                    <a href="" class="texte b">
                        <i class="fi fi-rr-comment-alt-dots"></i>

                        <span class="details">Détails</span>
                    </a>
                        <a href="#" class="texte b" @click="deleteUniteDeFormation(unite_de_formation)">

                        <i class="fi fi-rr-cross"></i>
                        <span class="supprimer mdl">Supprimer</span>
                    </a>
                </div>
            </div>
        </div>


    </div> -->

    </div>
</template>
<script>
import bus from '../../eventBus';
import axios from 'axios';
import Form from 'vform';



export default {
    name: "listeUniteDeFormationCompenent",
    data() {
        return {
            form: new Form({
                'nom_unite_formation': "",
                'id_formateur': "",
                'id_departement': ""

            }),
            unite_de_formations: [],
            editModal: false,
            idFormation: "",


        }
    },
    mounted() {
        this.get_unite_de_formation();
        bus.on('unite_formationAjoutee', () => { // Écouter l'événement de nouvelle unite de formation
            this.get_unite_de_formation(); // Mettre à jour la liste des unites de formations
        });
    },

    methods: {
        get_unite_de_formation() {
            axios.get('/unite_de_formation/all')
                .then(response => {
                    this.unite_de_formations = response.data.unite_de_formation


                }).catch(error => {
                    Swal.fire('Erreur!', 'Une erreur est survenue lors de la recuperation des unites de formations', 'error')
                });
        },

        changement(event) {
            this.interesser = event;
        },

        resetForm() {
            this.form.input = "";
            this.form.nom_unite_formation = "";
            this.form.id_formateur = "";
            this.form.id_departement = "";

        },

        async deleteUniteDeFormation(type) {
            Swal.fire({
                title: 'Êtes-vous sûr?',
                text: "Cette action sera irréversible!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Oui, supprimer!',
                cancelButtonText: 'Annuler'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete(`/unite_de_formation/delete/${type.id}`).then(resp => {
                        this.get_unite_de_formation();

                       /*  Swal.fire(
                            'Supprimé!',
                            'La filière a été supprimée avec succès.',
                            'success',
                        ) */

                   /*  }).catch(function (error) {
                        console.log(error);
                    }) */
              /*   }
            }); */
            var confirmation = document.querySelector('[data-modal-suppression]');

confirmation.style.backgroundColor = 'white';
confirmation.style.color = 'var(--clr)';

//setTimeout(function(){
confirmation.showModal();
confirmation.classList.add("actif");
//confirmation.close();
//}, 1000);

setTimeout(function () {
    confirmation.close();

    setTimeout(function () {
        confirmation.classList.remove("actif");
    }, 100);

}, 2000);

}).catch(function (error) {
console.log(error);
})
}
});
        },
        openModal(unite_de_formation) {

            this.idFormation = unite_de_formation.id;

            this.editModal = true;

            // Créez un objet avec les données à envoyer
            const eventData = {
                idFormation: this.idFormation,
                nom: unite_de_formation.nom_unite_formation,
                id_formateur: unite_de_formation.id_formateur,
                id_departement: unite_de_formation.id_departement,
                editModal: this.editModal,
                // Ajoutez d'autres propriétés si nécessaire
            };

            bus.emit('formationModifier', eventData);

            var fond = document.querySelector('.fond');
            var flou = document.querySelectorAll('.flou');
            var modification = document.querySelector("[data-modal-ajout]");

            flou.forEach(item => {
                item.classList.add("actif");
            });

            fond.classList.add("actif");
            modification.showModal();
            modification.classList.add("actif");


        },



    }
}
</script>
