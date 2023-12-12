<template>
    <div class="">

       <!--  <h1 class="sous_titre" v-if="activePhase === 1">Informations Personnelles</h1> -->
        <div v-if="activePhase === 1">
        </div>
        <form @submit.prevent="validerAvantAjout()" method="dialog">
            <!-- <div v-if="activePhase===1"> -->
            <div class="droit" >
                <div class="image">
                    <div class="roue">
                        <div class="roue">
                            <label for="photo" class="photo">
                                <i class="fi fi-rr-picture"></i>
                                Téléchargez votre photo ici
                                <input type="file" id="photo" @change="ajoutimage" accept="image/*">
                            </label>
                        </div>
                    </div>

                    <label for="photo" class="photo visible">
                        <i class="fi fi-rr-picture"></i>
                        téléchargez votre photo ici
                        <input type="file" id="photo" @change="ajoutimage" accept="image/*">
                    </label>
                    <img v-if="photo" :src="photoUrl" alt="Etu">

                </div>
                <label for="">photo</label>
                <div class="etapes">
                    <div class="cercles" data-etape="1">
                        <div class="actuel"><i class="fi fi-rr-check"></i></div>
                        <span></span>
                        <div class="actuel"><i class="fi fi-rr-check"></i></div> 
                    <span></span>
                    <div class="actuel"><i class="fi fi-rr-check"></i></div>
                    </div>
                    <label for="" class="positions" data-etape="1">ETApe 1</label>
                </div>
            </div>
            <!--Informations personnelles-->
            <div class="informations plus">
                <div class="titres" v-if="activePhase === 1">
                    <h1>INSCRIPTION ELEVE</h1>
                </div>
                <!--  <div class="champ" v-if="activePhase===1"> -->
                <div class="champ" v-if="activePhase === 1">
                    <label for="nom" :class="{ 'couleur_rouge': (this.nom_eleve_erreur) }">Nom</label>
                    <input type="text" name="nom" id="nom" v-model="form.nom_eleve" @input="validatedata('nom_eleve')"
                        :class="{ 'bordure_rouge': (this.nom_eleve_erreur) }">
                    <span class="erreur">{{ this.nom_eleve_erreur }}</span>
                </div>

                <div class="champ" v-if="activePhase === 1">
                    <label for="prenom" :class="{ 'couleur_rouge': (this.prenom_eleve_erreur) }">Prenom</label>
                    <input type="text" name="prenom" id="prenom" v-model="form.prenom_eleve"
                        @input="validatedata('prenom_eleve')" :class="{ 'bordure_rouge': (this.prenom_eleve_erreur) }">
                    <span class="erreur">{{ this.prenom_eleve_erreur }}</span>
                </div>
                <div class="groupe_champs" v-if="activePhase === 1">

                    <div class="champ">
                        <label for="date_naissance" :class="{ 'couleur_rouge': (this.date_naissance_eleve_erreur) }">Date de naissance
                        </label>
                        <input type="date" name="date_naissance" id="date_naissance" v-model="form.date_naissance_eleve"
                            @input="validatedata('date_naissance_eleve')"
                            :class="{ 'bordure_rouge': (this.date_naissance_eleve_erreur) }">
                        <span class="erreur">{{ this.date_naissance_eleve_erreur }}</span>
                    </div>

                    <div class="champ">
                        <label for="lieu_naissance" :class="{ 'couleur_rouge': (this.lieu_naissance_eleve_erreur) }">Lieu de
                            naissance</label>
                        <input type="text" name="lieu_naissance" id="lieu_naissance" v-model="form.lieu_naissance_eleve"
                            @input="validatedata('lieu_naissance_eleve')" :class="{ 'bordure_rouge': (this.lieu_naissance_eleve_erreur) }">
                        <span class="erreur">{{ this.lieu_naissance_eleve_erreur }}</span>
                    </div>
                </div>
                <div class="groupe_champs" v-if="activePhase === 1">
                    <div class="champ">
                        <label for="Nationalite"
                            :class="{ 'couleur_rouge': (this.nationalite_eleve_erreur) }">Nationalite</label>
                        <input type="text" name="nationalite" id="nationalite" v-model="form.nationalite_eleve"
                            @input="validatedata('nationalite_eleve')"
                            :class="{ 'bordure_rouge': (this.nationalite_eleve_erreur) }">
                        <span class="erreur">{{ this.nationalite_eleve_erreur }}</span>
                    </div>

                    <div class="champ">
                        <label for="Adresse" :class="{ 'couleur_rouge': (this.adresse_eleve_erreur) }">Adresse</label>
                        <input type="text" name="adresse" id="adresse" v-model="form.adresse_eleve"
                            @input="validatedata('adresse_eleve')"
                            :class="{ 'bordure_rouge': (this.adresse_eleve_erreur) }">
                        <span class="erreur">{{ this.adresse_eleve_erreur }}</span>
                    </div>
                </div>

                <!-- </div> -->

                <!-- <div v-if="activePhase===2"> -->
                <div class="groupe_champs" v-if="activePhase === 1">


                    <div class="champ">
                        <label for="Sexe" :class="{ 'couleur_rouge': (this.genre_eleve_erreur) }">Sexe</label>

                        <select name="role" id="role" v-model="form.genre_eleve" @change="validatedata('genre_eleve')"
                            :class="{ 'bordure_rouge': (this.genre_eleve_erreur) }">
                            <option class="option">Masculin</option>
                            <option class="option">Féminin</option>
                        </select>
                        <span class="erreur">{{ this.genre_eleve_erreur }}</span>
                    </div>

                    
                        <div class="champ">
                            <label for="Telephone"
                                :class="{ 'couleur_rouge': (this.telephone_eleve_erreur) }">Telephone</label>
                            <input type="tel" name="telephone" id="telephone" placeholder="Tel : 7X XXX XX XX"
                                v-model="form.telephone_eleve" @input="validatedata('telephone_eleve')"
                                :class="{ 'bordure_rouge': (this.telephone_eleve_erreur) }">
                            <span class="erreur">{{ this.telephone_eleve_erreur
                            }}</span>
                        </div>
                   
                </div>

                <div class="champ" v-if="activePhase === 1">
                    <label for="Adresse Email" :class="{ 'couleur_rouge': (this.mail_eleve_erreur) }">Adresse
                        Email</label>
                    <input type="email" name="mail_eleve" id="mail_eleve" v-model="form.mail_eleve"
                        @input="validatedata('mail_eleve')" :class="{ 'bordure_rouge': (this.mail_eleve_erreur) }">
                    <span class="erreur">{{ this.mail_eleve_erreur }}</span>
                </div>


                <div class="groupe_champs validation" v-if="activePhase === 1">
                    <button type="button" @click="closeModal()" class="texte annuler">Annuler</button>
                    <button type="button" class="texte annuler" @click.prevent="goToStep(2)">Suivant</button>
                </div>



                <h1 v-if="activePhase === 2"> Personnes à contacter en cas d'urgence</h1>
                <div class="groupe_champs" v-if="activePhase === 2">
                    <div class="champ">
                        <label for="contact_urgence_1"
                            :class="{ 'couleur_rouge': (this.telephone_urgence_1_erreur) }">Contact d'urgence 1</label>
                        <input type="tel" name="contact_urgence_1" id="contact_urgence_1" v-model="form.contact_urgence1"
                            @input="validatedata('telephone_urgence_1')"
                            :class="{ 'bordure_rouge': (this.telephone_urgence_1_erreur) }">
                        <span class="erreur">{{
                            this.telephone_urgence_1_erreur
                        }}</span>
                    </div>                                                                                                                                                                                                                                                              

                    <div class="champ">
                        <label for="contact_urgence_2"
                            :class="{ 'couleur_rouge': (this.telephone_urgence_2_erreur) }">Contact d'urgence 2</label>
                        <input type="tel" name="contact_urgence_2" id="contact_urgence_2" v-model="form.contact_urgence2"
                            @input="validatedata('telephone_urgence_2')"
                            :class="{ 'bordure_rouge': (this.telephone_urgence_2_erreur) }">
                        <span class="erreur">{{
                            this.telephone_urgence_2_erreur
                        }}</span>
                    </div>

                </div>

                <div class="groupe_champs validation" v-if="activePhase === 2">
                    <button type="button" @click="closeModal()" class="texte annuler">Annuler</button>
                    <button type="button" class="texte annuler" @click.prevent="goToStep(1)">Precedent</button>
                    <button type="button" class="texte annuler" @click.prevent="goToStep(3)">Suivant</button>
                </div>


                <!-- </div> -->
                <!-- Informations sur le tuteur -->
                <!-- <div v-if="activePhase===3"> -->
                    
                <div  v-if="activePhase === 3">
                    <h1 >Informations du tuteur</h1> 
                    <div class="champ">
                        <label for="nom_tuteur" :class="{ 'couleur_rouge': (this.nom_tuteur_erreur) }">Nom Tuteur</label>
                        <input type="text" name="nom_tuteur" id="nom_tuteur" v-model="form.nom_tuteur"
                            @input="validatedata('nom_tuteur')" :class="{ 'bordure_rouge': (this.nom_tuteur_erreur) }">
                        <span class="erreur">{{ this.nom_tuteur_erreur }}</span>
                    </div>

                    <div class="champ">
                        <label for="prenom_tuteur" :class="{ 'couleur_rouge': (this.prenom_tuteur_erreur) }">Prénom
                            Tuteur</label>
                        <input type="text" name="prenom_tuteur" id="prenom_tuteur" v-model="form.prenom_tuteur"
                            @input="validatedata('prenom_tuteur')"
                            :class="{ 'bordure_rouge': (this.prenom_tuteur_erreur) }">
                        <span class="erreur">{{ this.prenom_tuteur_erreur }}</span>
                    </div>

                    <!-- <div>
                        <input type="date" name="date_naissance" id="date_naissance" placeholder="Date de naissance" v-model="form.date_naissance_tuteur" @input="validatedata('date_naissance_tuteur')">
                        <span class="erreur" v-if="this.date_naissance_tuteur_erreur !== ''">{{this.date_naissance_tuteur_erreur}}</span>
                    </div>

                    <div>
                        <input type="text" name="lieu_naissance" id="lieu_naissance" placeholder="Lieu de Naissance" v-model="form.lieu_naissance_tuteur" @input="validatedata('lieu_naissance_tuteur')">
                        <span class="erreur" v-if="this.lieu_naissance_tuteur_erreur !== ''">{{this.lieu_naissance_tuteur_erreur}}</span>
                    </div> -->

                    <div class="champ">
                        <label for="Nationalite" :class="{ 'couleur_rouge': (this.nationalite_tuteur_erreur) }">Nationalité</label>
                        <input type="text" name="nationalite" id="nationalite" v-model="form.nationalite_tuteur"
                            @input="validatedata('nationalite_tuteur')"
                            :class="{ 'bordure_rouge': (this.nationalite_tuteur_erreur) }">
                        <span class="erreur">{{ this.nationalite_tuteur_erreur
                        }}</span>
                    </div>

                    <div class="champ">
                        <label for="Adresse" :class="{ 'couleur_rouge': (this.adresse_tuteur_erreur) }">Adresse
                            tuteur</label>
                        <input type="text" name="adresse_tuteur" id="adresse_tuteur" v-model="form.adresse_tuteur"
                            @input="validatedata('adresse_tuteur')"
                            :class="{ 'bordure_rouge': (this.adresse_tuteur_erreur) }">
                        <span class="erreur">{{ this.adresse_tuteur_erreur
                        }}</span>
                    </div>

                    <!-- A continuer -->
                    <div class="champ">
                        <label for="Adresse Email" :class="{ 'couleur_rouge': (this.mail_tuteur_erreur) }">Adresse
                            Email</label>
                        <input type="email" name="email" id="email" v-model="form.mail_tuteur"
                            @input="validatedata('mail_tuteur')" :class="{ 'bordure_rouge': (this.mail_tuteur_erreur) }">
                        <span class="erreur">{{ this.mail_tuteur_erreur }}</span>
                    </div>

                    <div class="champ">
                        <label for="Telephone"
                            :class="{ 'couleur_rouge': (this.telephone_tuteur_erreur) }">Telephone</label>
                        <input type="tel" name="telephone" id="telephone" placeholder="Tel : 7X XXX XX XX"
                            v-model="form.telephone_tuteur" @input="validatedata('telephone_tuteur')"
                            :class="{ 'bordure_rouge': (this.telephone_tuteur_erreur) }">
                        <span class="erreur" v-if="this.telephone_tuteur_erreur !== ''">{{ this.telephone_tuteur_erreur
                        }}</span>
                    </div>
                </div>

                <div class="champ" v-if="activePhase === 3">
                    <label for="Sexe" :class="{ 'couleur_rouge': (this.genre_tuteur_erreur) }">Sexe</label>

                    <select name="sexe" id="sexe" v-model="form.genre_tuteur" @change="validatedata('genre_tuteur')"
                        :class="{ 'bordure_rouge': (this.genre_tuteur_erreur) }">
                        <option class="option">Masculin</option>
                        <option class="option">Féminin</option>
                    </select>
                        <span class="erreur">{{ this.genre_tuteur_erreur }}</span>
                </div>
                    <div class="groupe_champs validation" v-if="activePhase === 3">
                        <button type="button" @click="closeModal()" class="texte annuler data-close-modal">Annuler</button>
                        <button type="button" class="texte annuler" @click.prevent="goToStep(2)">Precedent</button>
                        <button type="button" class="texte annuler" @click.prevent="goToStep(4)">Suivant</button>
                    </div>
                

                <!-- <div v-if="activePhase===4"> -->
                <div class="groupe-champs" v-if="activePhase === 4">
                    <h1>Informations Académiques</h1>
                    <div class="champ">
                        <label for="annee_accademique" :class="{ 'couleur_rouge': (this.id_annee_accademique_erreur) }">Année
                            Académique</label>
                        <select name="annee_accademique" id="annee_accademique" v-model="form. id_annee_accademique"
                            @change="validatedata('id_annee_accademique')">

                            <option v-for="annee_accademique in annee_accademiques" :value="annee_accademique.id">{{
                                annee_accademique.intitule }}</option>
                        </select>
                        <span class="erreur">{{ id_annee_accademique_erreur
                        }}</span>
                    </div>

                    <div class="champ">
                        <label for="classe" :class="{ 'couleur_rouge': (this.id_classe_erreur) }">Classe</label>
                        <select name="classe" id="classe" v-model="form.id_classe" @change="validatedata('id_classe')">
                            <option v-for="classe in classes" :value="classe.id">{{ classe.type_formation.intitule }} {{
                                classe.nom_classe }} {{ classe.niveau }} {{ classe.type_classe }}</option>
                        </select>
                        <span class="erreur">{{ id_classe_erreur }}</span>
                    </div>
                </div>

                <div class="groupe_champs validation" v-if="activePhase === 4">
                    <button type="button" @click="closeModal()" class="texte annuler">Annuler</button>
                    <button type="button" class="texte annuler" @click.prevent="goToStep(3)">Precedent</button>
                    <button type="submit"  :class="{ 'data-close-modal': (this.etatForm) }">Ajouter</button>
                </div>
                <!-- </div> -->
            </div>
        </form>
    </div>
</template>

<script>
import bus from '../../eventBus';
import axios from 'axios';
import Form from 'vform';
export default {
    name: "inscriptionCompenent",
    data() {
        return {
            filieres: [],
            type_formations: [],
            annee_accademiques: [],
            classes: [],
            photo: "",
            dossier: "",
            form: new Form({
                'id_tuteur': "",
                'montant': "",
                'mail_tuteur': "",
                'mail_eleve': "",
                'date_inscription': "",
                'id_eleve': "",
                'id_classe': "",
                'id_annee_accademique': "",
                'nom_eleve': "",
                'prenom_eleve': "",
                'date_naissance_eleve': "",
                'lieu_naissance': "",
                'nationalite_eleve': "",
                'nationalite_tuteur': "",
                'nom_tuteur': "",
                'prenom_tuteur': "",
                'lieu_naissance_tuteur': "",
                'lieu_naissance_eleve': "",
                'date_naissance_tuteur': "",
                'genre_eleve': "",
                'genre_tuteur': "",
                'telephone_eleve': "",
                'telephone_tuteur': "",
                'contact_urgence1': "",
                'contact_urgence2': "",
                'telephone_tuteur': "",
                'adresse_eleve': "",
                'adresse_tuteur': "",
                'niveau': "",
                'filiere': "",
            }),

            nom_tuteur_erreur: "",
            prenom_tuteur_erreur: "",
            date_naissance_tuteur_erreur: "",
            lieu_naissance_tuteur_erreur: "",
            nationalite_tuteur_erreur: "",
            adresse_tuteur_erreur: "",
            genre_tuteur_erreur: "",

            nom_eleve_erreur: "",
            prenom_eleve_erreur: "",
            date_naissance_eleve_erreur: "",
            lieu_naissance_eleve_erreur: "",
            nationalite_eleve_erreur: "",
            genre_eleve_erreur: "",
            adresse_eleve_erreur: "",


            adresse_erreur: "",
            telephone_tuteur_erreur: "",
            telephone_eleve_erreur: "",
            telephone_urgence_1_erreur: "",
            telephone_urgence_2_erreur: "",
            mail_eleve_erreur: "",
            mail_tuteur_erreur: "",

            id_annee_accademique_erreur: "",
            id_classe_erreur: "",

            erreur: "",
            champ: "",
            i: 0,
            etatForm: false,
            activePhase: 1,
            off: "",
            i_1_2_3:"",

        }
    },

    mounted() {
        // this.get_filiere();
        this.get_classe();
        this.get_annee();
        // this.get_type_formation();
        this.variables_changement_etape();

    },

    computed: {
        photoUrl() {
            return this.photo ? URL.createObjectURL(this.photo) : '';
        },
    },

    methods: {
        async soumettre() {
            const formdata = new FormData();
            formdata.append('nom_tuteur', this.form.nom_tuteur);
            formdata.append('prenom_tuteur', this.form.prenom_tuteur);
            formdata.append('lieu_naissance_tuteur', this.form.lieu_naissance_tuteur);
            formdata.append('date_naissance_tuteur', this.form.date_naissance_tuteur);
            formdata.append('genre_tuteur', this.form.genre_tuteur);
            formdata.append('adresse_tuteur', this.form.adresse_tuteur);
            formdata.append('telephone_tuteur', this.form.telephone_tuteur);
            formdata.append('mail_tuteur', this.form.mail_tuteur);
            formdata.append('mail_eleve', this.form.mail_eleve);
            formdata.append('nationalite_tuteur', this.form.nationalite_tuteur);
            formdata.append('photo', this.photo);
            // formdata.append('dossier', this.dossier);

            formdata.append('nom_eleve', this.form.nom_eleve);
            formdata.append('prenom_eleve', this.form.prenom_eleve);
            formdata.append('lieu_naissance_eleve', this.form.lieu_naissance_eleve);
            formdata.append('date_naissance_eleve', this.form.date_naissance_eleve);
            formdata.append('date_inscription', this.form.date_inscription);
            formdata.append('genre_eleve', this.form.genre_eleve);
            formdata.append('adresse_eleve', this.form.adresse_eleve);
            formdata.append('telephone_eleve', this.form.telephone_eleve);
            formdata.append('nationalite_eleve', this.form.nationalite_eleve);


            // formdata.append('montant', this.form.montant);
            formdata.append('date_inscription', this.form.date_inscription);
            formdata.append('id_classe', this.form.id_classe);
            formdata.append('id_annee_accademique', this.form.id_annee_accademique);
            formdata.append('contact_urgence1', this.form.contact_urgence1);
            formdata.append('contact_urgence2', this.form.contact_urgence2);
            try {
                await axios.post('/inscription/store', formdata, {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                    },
                });
                this.form.reset();
                bus.emit('inscriptionAjoutee');
                this.resetForm();
                var ajout = document.querySelector('[data-modal-ajout]');
                var confirmation = document.querySelector('[data-modal-confirmation]');


                /* console.log(ajout); */
                var actif = document.querySelectorAll('.actif');
                actif.forEach(item => {
                    item.classList.remove("actif");
                });
                //ajout.classList.remove("actif");
                ajout.close();


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

                }, 1700);

            }
            catch (e) {
                console.log(e)
                Swal.fire('Erreur!', 'Une erreur est survenue lors de l\'enregistrement', 'error')
            }

        },

        resetForm() {
            this.form.id_tuteur = "";
            this.form.montant = "";
            this.form.mail_tuteur = "";
            this.form.mail_eleve = "";
            this.form.date_inscription = "";
            this.form.id_eleve = "";
            this.form.id_classe = "";
            this.form.id_annee_accademique = "";
            this.form.nom_eleve = "";
            this.form.prenom_eleve = "";
            this.form.date_naissance = "";
            this.form.lieu_naissance = "";
            this.form.nationalite_eleve = "";
            this.form.nationalite_tuteur = "";
            this.form.nom_tuteur = "";
            this.form.prenom_tuteur = "";
            this.form.lieu_naissance_tuteur = "";
            this.form.lieu_naissance_eleve = "";
            this.form.date_naissance_tuteur = "";
            this.form.genre_eleve = "";
            this.form.genre_tuteur = "";
            this.form.telephone_eleve = "";
            this.form.telephone_tuteur = "";
            this.form.contact_urgence1 = "";
            this.form.contact_urgence2 = "";
            this.form.telephone_tuteur = "";
            this.form.adresse_eleve = "";
            this.form.adresse_tuteur = "";
            this.form.niveau = "";
            this.form.filiere = "";
            this.photo = "";
            this.i = 0;
            this.etatForm = false;
            this.activePhase = 1;
        },

        goToStep: function (step) {
            if(step===2){
                if(!this.validatedata('nom_eleve') & !this.validatedata('prenom_eleve') & !this.validatedata('date_naissance_eleve') & !this.validatedata('lieu_naissance_eleve') & !this.validatedata('nationalite_eleve') & !this.validatedata('genre_eleve') & !this.validatedata('adresse_eleve') & !this.validatedata('telephone_eleve') & !this.validatedata('mail_eleve')){
                    this.activePhase= step;
                    this.i_1_2_3=step;
                    this.indicateur_etape();
                    
                }
            }
            if(step===3){
                if(!this.validatedata('telephone_urgence_1') & !this.validatedata('telephone_urgence_2')){
                    this.activePhase= step;
                    this.i_1_2_3=step;
                    this.indicateur_etape();
                }
            }
            if(step===4){
                if(!this.validatedata('nom_tuteur') & !this.validatedata('prenom_tuteur') & !this.validatedata('nationalite_tuteur') & !this.validatedata('genre_tuteur') & !this.validatedata('adresse_tuteur') & !this.validatedata('telephone_tuteur') & !this.validatedata('mail_tuteur')){
                    this.activePhase= step;
                    this.i_1_2_3=step;
                    this.indicateur_etape();
                }
            }
            if(step===1){
                this.activePhase = step;
                this.indicateur_etape();
            }

       
         
            //this.activePhase = step;
        },

        indicateur_etape(){
            this.cercles.dataset.etape = this.i_1_2_3 - 1;
            this.etape.dataset.etape = this.i_1_2_3;
            //if(this.i_1_2_3 == 2) this.off = 1;
            this.etape.textContent = "etape " + (this.i_1_2_3 - this.off);
            this.off = 0
        },

        variables_changement_etape() {
            this.suivant = document.querySelector('.suivant');
            this.precedent = document.querySelector('.annuler');
            this.i_1_2_3 = 1;
            this.off = 0;

            this.etape = document.querySelector('.positions');
            this.cercles = document.querySelector('.cercles');
        },

        closeModal() {
            var ajout = document.querySelector('[data-modal-ajout]');

            /* console.log(ajout); */
            var actif = document.querySelectorAll('.actif');
            actif.forEach(item => {
                item.classList.remove("actif");
            });
            //ajout.classList.remove("actif");
            ajout.close();
            this.resetForm();
        },

        // Méthode pour ajouter l'image
        ajoutimage(event) {
            const file = event.target.files[0];
            console.log(file.type.includes('image'));
            // Vérification du type de fichier pour s'assurer qu'il s'agit d'une image
            if (file.type.includes('image')) {
                this.photo = file;
                console.log(this.photo);
            }
        },

        // Méthode pour ajouter le dossier
        ajoutDossier(event) {
            const file = event.target.files[0];
            if (file.type === 'application/pdf' || file.name.toLowerCase().endsWith('.pdf')) {
                this.dossier = file;
                console.log(this.dossier);
            }
        },

        getImageUrl() {
            const timestamp = new Date().getTime();
            return this.photo ? `${window.location.origin}/image/${this.photo.name}?t=${timestamp}` : '';
        },

        async get_annee() {
            await axios.get('/annee_academique/index').then(response => {
                this.annee_accademiques = response.data.annee_academique;

            }).catch(error => {
                Swal.fire('Erreur!', 'une erreur est survenue lors de la recuperation des annee', 'error')
            });
        },



        async get_classe() {
            await axios.get('/classe/all').then(response => {
                this.classes = response.data.classe;

            }).catch(error => {
                Swal.fire('Erreur!', 'une erreur est survenue lors de la recuperation des classes', 'error')
            });
        },

        validerAvantAjout() {
            const isIdChampValid = this.validatedataold();
            if (isIdChampValid) {
                this.etatForm = false;
                console.log("erreur");
                return 0;
            } else {
                this.soumettre();
                this.etatForm = true;
                console.log("Tokkos");
            }

        },

        verifCaratere(nom) {
            const valeur = /^[a-zA-ZÀ-ÿ\s]*$/;
            return valeur.test(nom);
        },

        validateEmail(email) {
            // Utilisez une expression régulière pour vérifier si l'email est au bon format
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);

        },

        validatePhoneNumber(phoneNumber) {
            // Expression régulière pour vérifier le numéro de téléphone (format simple ici)
            const phoneRegex = /^\d{9}$/; // Format : 9 chiffres

            return phoneRegex.test(phoneNumber);
        },

        validatedata(champ) {
            // Réinitialiser les erreurs pour le champ actuel

            this.lieu_naissance_tuteur_erreur = "";

            var i = 0;

            switch (champ) {
                case 'nom_eleve':
                    this.nom_eleve_erreur = "";

                    // Effectuez la validation pour le champ 'nom'
                    if (this.form.nom_eleve === "") {
                        this.nom_eleve_erreur = "Ce champ est obligatoire"
                        i = 1;
                        return true

                    }
                    if (!this.verifCaratere(this.form.nom_eleve)) {
                        this.nom_eleve_erreur = "Ce champ ne peut comporter que des lettres et des espaces"
                        /* this.erreur= "Ce champ ne peut comporter que des lettres et des espaces" */
                        i = 1;
                        return true
                    }
                    // Ajoutez d'autres validations si nécessaire
                    break;
                case 'nom_tuteur':
                    this.nom_tuteur_erreur = "";
                    // Effectuez la validation pour le champ 'nom'
                    if (this.form.nom_tuteur === "") {
                        this.nom_tuteur_erreur = "Ce champ est obligatoire"
                        i = 1;
                        return true

                    }
                    if (!this.verifCaratere(this.form.nom_tuteur)) {
                        this.nom_tuteur_erreur = "Ce champ ne peut comporter que des lettres et des espaces"
                        /* this.erreur= "Ce champ ne peut comporter que des lettres et des espaces" */
                        i = 1;
                        return true
                    }
                    // Ajoutez d'autres validations si nécessaire
                    break;
                case 'prenom_eleve':
                    this.prenom_eleve_erreur = "";
                    // Effectuez la validation pour le champ 'nom'
                    if (this.form.prenom_eleve === "") {
                        this.prenom_eleve_erreur = "Ce champ est obligatoire"
                        i = 1;
                        return true

                    }
                    if (!this.verifCaratere(this.form.prenom_eleve)) {
                        this.prenom_eleve_erreur = "Ce champ ne peut comporter que des lettres et des espaces"
                        /* this.erreur= "Ce champ ne peut comporter que des lettres et des espaces" */
                        i = 1;
                        return true
                    }
                    // Ajoutez d'autres validations si nécessaire
                    break;
                case 'prenom_tuteur':
                    this.prenom_tuteur_erreur = "";
                    // Effectuez la validation pour le champ 'nom'
                    if (this.form.prenom_tuteur === "") {
                        this.prenom_tuteur_erreur = "Ce champ est obligatoire"
                        i = 1;
                        return true

                    }
                    if (!this.verifCaratere(this.form.prenom_tuteur)) {
                        this.prenom_tuteur_erreur = "Ce champ ne peut comporter que des lettres et des espaces"
                        /* this.erreur= "Ce champ ne peut comporter que des lettres et des espaces" */
                        i = 1;
                        return true
                    }
                    // Ajoutez d'autres validations si nécessaire
                    break;

                case 'adresse_eleve':
                    this.adresse_eleve_erreur = "";

                    //pour adresse
                    if (this.form.adresse_eleve === "") {
                        this.adresse_eleve_erreur = "Ce champ est obligatoire"
                        i = 1;
                        return true

                    }
                    break;
                case 'adresse_tuteur':
                    this.adresse_tuteur_erreur = "";
                    //pour adresse
                    if (this.form.adresse_tuteur === "") {
                        this.adresse_tuteur_erreur = "Ce champ est obligatoire"
                        i = 1;
                        return true

                    }
                    break;
                case 'lieu_naissance_eleve':
                    this.lieu_naissance_eleve_erreur = "";
                    //pour lieu de naissance
                    if (this.form.lieu_naissance_eleve === "") {
                        this.lieu_naissance_eleve_erreur = "Ce champ est obligatoire"
                        i = 1;
                        return true
                    }
                    if (!this.verifCaratere(this.form.lieu_naissance_eleve)) {
                        this.lieu_naissance_eleve_erreur = "Ce champ ne peut comporter que des lettres et des espaces"
                        i = 1;
                        return true
                    }
                    break;
                // case 'lieu_naissance_tuteur':
                //     //pour lieu de naissance
                //     if(this.form.lieu_naissance_tuteur=== ""){
                //         this.lieu_naissance_tuteur_erreur= "Ce champ est obligatoire"
                //         i= 1;
                //         return true
                //     }
                //     if(!this.verifCaratere(this.form.lieu_naissance_tuteur)){
                //         this.lieu_naissance_tuteur_erreur= "Ce champ ne peut comporter que des lettres et des espaces"
                //         i= 1;
                //         return true
                //     }
                //     break;
                case 'nationalite_eleve':
                    this.nationalite_eleve_erreur = "";
                    //pour nationalite
                    if (this.form.nationalite_eleve === "") {
                        this.nationalite_eleve_erreur = "Ce champ est obligatoire"
                        i = 1;
                        return true
                    }
                    if (!this.verifCaratere(this.form.nationalite_eleve)) {
                        this.nationalite_eleve_erreur = "Ce champ ne peut comporter que des lettres et des espaces"
                        i = 1;
                        return true
                    }
                    break;
                case 'nationalite_tuteur':
                    this.nationalite_tuteur_erreur = "";
                    //pour nationalite
                    if (this.form.nationalite_tuteur === "") {
                        this.nationalite_tuteur_erreur = "Ce champ est obligatoire"
                        i = 1;
                        return true
                    }
                    if (!this.verifCaratere(this.form.nationalite_tuteur)) {
                        this.nationalite_tuteur_erreur = "Ce champ ne peut comporter que des lettres et des espaces"
                        i = 1;
                        return true
                    }
                    break;
                case 'mail_eleve':
                    this.mail_eleve_erreur = "";
                    //Vérification de l' email
                    if (this.form.mail_eleve === "") {
                        this.mail_eleve_erreur= "L'email est obligatoire";
                        i = 1;
                        return true
                    } else {
                        if (!this.validateEmail(this.form.mail_eleve)) {
                            this.mail_eleve_erreur = "L'email n'est pas valide";
                            i = 1;
                            return true
                        }
                    }
                    break;
                case 'mail_tuteur':
                    this.mail_tuteur_erreur = "";
                    //Vérification de l' email
                    if (this.form.mail_tuteur === "") {
                        this.mail_tuteur_erreur = "L'email est obligatoire"
                        i = 1;
                        return true
                    } else {
                        if (!this.validateEmail(this.form.mail_tuteur)) {
                            this.mail_tuteur_erreur = "L'email n'est pas valide";
                            i = 1;
                            return true
                        }
                    }
                    break;
                case 'date_naissance_eleve':
                    this.date_naissance_eleve_erreur = "";
                    // Vérification de la date de naissance
                    if (this.form.date_naissance_eleve === "") {
                        this.date_naissance_eleve_erreur = "La date de naissance est obligatoire";
                        i = 1;
                        return true
                    } else {
                        const dateNaissance = new Date(this.form.date_naissance_eleve);
                        const dateLimite = new Date();
                        const dateActuelle = new Date();
                        dateLimite.setFullYear(dateLimite.getFullYear() - 19); // 18 ans avant la date actuelle
                        let annee = dateLimite.getFullYear();
                        console.log(annee);

                        if (dateNaissance > dateLimite) {
                            this.date_naissance_eleve_erreur = "La date de naissance ne peut pas être supérieure à " + annee;
                            i = 1;
                            return true
                        }
                        if (dateNaissance > dateActuelle) {
                            this.date_naissance_eleve_erreur = "La date de naissance ne peut pas être dans le futur";
                            i = 1;
                            return true
                        }
                    }
                    break;
                // case 'date_naissance_tuteur':
                /*  this.date_naissance_tuteur_erreur= ""; */
                // // Vérification de la date de naissance
                //     if(this.form.date_naissance_tuteur === ""){
                //         this.date_naissance_tuteur_erreur = "La date de naissance est obligatoire";
                //         i= 1;
                //         return true
                //     } else {
                //         const dateNaissance = new Date(this.form.date_naissance_tuteur);
                //         const dateLimite = new Date();
                //         const dateActuelle = new Date();
                //         dateLimite.setFullYear(dateLimite.getFullYear() - 19); // 18 ans avant la date actuelle
                //         let annee = dateLimite.getFullYear();
                //         console.log(annee);

                //         if(dateNaissance > dateLimite) {
                //             this.date_naissance_tuteur_erreur = "La date de naissance ne peut pas être supérieure à "+ annee;
                //             i=1;
                //             return true
                //         }if(dateNaissance > dateActuelle) {
                //             this.date_naissance_tuteur_erreur = "La date de naissance ne peut pas être dans le futur";
                //             i=1;
                //             return true
                //         }

                //     }
                //     break;
                case 'telephone_eleve':
                    this.telephone_eleve_erreur = "";
                    //Vérification du numero de telephone
                    if (this.form.telephone_eleve === "") {
                        this.telephone_eleve_erreur = "Le numéro de téléphone est obligatoire";
                        i = 1;
                        return true
                    } else if (!this.validatePhoneNumber(this.form.telephone_eleve)) {
                        this.telephone_eleve_erreur = "Le numéro de téléphone n'est pas valide";
                        i = 1;
                        return true
                    }
                    break;
                case 'telephone_tuteur':
                    this.telephone_tuteur_erreur = "";
                    //Vérification du numero de telephone
                    if (this.form.telephone_tuteur === "") {
                        this.telephone_tuteur_erreur = "Le numéro de téléphone est obligatoire";
                        i = 1;
                        return true
                    } else if (!this.validatePhoneNumber(this.form.telephone_tuteur)) {
                        this.telephone_tuteur_erreur = "Le numéro de téléphone n'est pas valide";
                        i = 1;
                        return true
                    }
                    break;
                case 'telephone_urgence_1':
                    this.telephone_urgence_1_erreur = "";
                    //Vérification du numero de telephone
                    if (this.form.contact_urgence1 === "") {
                        this.telephone_urgence_1_erreur = "Le numéro de téléphone est obligatoire";
                        i = 1;
                        return true
                    } else if (!this.validatePhoneNumber(this.form.contact_urgence1)) {
                        this.telephone_urgence_1_erreur = "Le numéro de téléphone n'est pas valide";
                        i = 1;
                        return true
                    }
                    break;
                case 'telephone_urgence_2':
                    this.telephone_urgence_2_erreur = "";
                    //Vérification du numero de telephone
                    if (this.form.contact_urgence2 === "") {
                        this.telephone_urgence_2_erreur = "Le numéro de téléphone est obligatoire";
                        i = 1;
                        return true
                    } else if (!this.validatePhoneNumber(this.form.contact_urgence2)) {
                        this.telephone_urgence_2_erreur = "Le numéro de téléphone n'est pas valide";
                        i = 1;
                        return true
                    }
                    break;

                case 'genre_eleve':
                    this.genre_eleve_erreur = "";
                    //Vérification de matrimoniale
                    if (this.form.genre_eleve === "") {
                        this.genre_eleve_erreur = "Vous avez oublié de sélectionner le genre "
                        i = 1;
                        return true
                    }
                    break;
                case 'genre_tuteur':
                    this.genre_tuteur_erreur = "";
                    //Vérification de matrimoniale
                    if (this.form.genre_tuteur === "") {
                        this.genre_tuteur_erreur = "Vous avez oublié de sélectionner le genre "
                        i = 1;
                        return true
                    }
                    break;
                case 'id_annee_accademique':
                    this.id_annee_accademique_erreur = "";
                    //Vérification de annee academique
                    if (this.form.id_annee_accademique === "") {
                        this.id_annee_accademique_erreur = "Vous avez oublié de sélectionner l'\Annee Academique "
                        i = 1;
                        return true
                    }
                    break;
                case 'id_classe':
                    this.id_classe_erreur = "";
                    //Vérification de annee academique
                    if (this.form.id_classe === "") {
                        this.id_classe_erreur = "Vous avez oublié de sélectionner le statut "
                        i = 1;
                        return true
                    }
                    break;
                default:
                    break;
            }
        },

        validatedataold() {
            this.nom_tuteur_erreur = "";
            this.prenom_tuteur_erreur = "";
            this.date_naissance_tuteur_erreur = "";
            this.lieu_naissance_tuteur_erreur = "";
            this.nationalite_tuteur_erreur = "";
            this.adresse_tuteur_erreur = "";
            this.genre_tuteur_erreur = "";

            this.nom_eleve_erreur = "";
            this.prenom_eleve_erreur = "";
            this.date_naissance_eleve_erreur = "";
            this.lieu_naissance_eleve_erreur = "";
            this.nationalite_eleve_erreur = "";
            this.genre_eleve_erreur = "";
            this.adresse_eleve_erreur = "";

            this.telephone_tuteur_erreur = "";
            this.telephone_eleve_erreur = "";
            this.telephone_urgence_1_erreur = "";
            this.telephone_urgence_2_erreur = "";
            this.mail_eleve_erreur = "";
            this.mail_tuteur_erreur = "";

            this.id_annee_accademique_erreur = "";
            this.id_classe_erreur = "";
            var i = 0;
            // Effectuez la validation pour le champ 'nom'
            if (this.form.nom_eleve === "") {
                this.nom_eleve_erreur = "Ce champ est obligatoire"
                i = 1;
                console.log("videnomeleve=" + i);
            }
            if (!this.verifCaratere(this.form.nom_eleve)) {
                this.nom_eleve_erreur = "Ce champ ne peut comporter que des lettres et des espaces"
                i = 1;
                console.log("nomeleve=" + i);
            }
            // Effectuez la validation pour le champ 'nom'
            if (this.form.nom_tuteur === "") {
                this.nom_tuteur_erreur = "Ce champ est obligatoire"
                i = 1;
                console.log("videnomtuteur=" + i);
            }
            if (!this.verifCaratere(this.form.nom_tuteur)) {
                this.nom_tuteur_erreur = "Ce champ ne peut comporter que des lettres et des espaces"
                i = 1;
                console.log("nomtuteur=" + i);
            }
            // Effectuez la validation pour le champ 'nom'
            if (this.form.prenom_eleve === "") {
                this.prenom_eleve_erreur = "Ce champ est obligatoire"
                i = 1;
                console.log("videprenomeleve=" + i);
            }
            if (!this.verifCaratere(this.form.prenom_eleve)) {
                this.prenom_eleve_erreur = "Ce champ ne peut comporter que des lettres et des espaces"
                i = 1;
                console.log("prenomeleve=" + i);
            }
            // Effectuez la validation pour le champ 'nom'
            if (this.form.prenom_tuteur === "") {
                this.prenom_tuteur_erreur = "Ce champ est obligatoire"
                i = 1;
                console.log("videprenomtuteur=" + i);
            }
            if (!this.verifCaratere(this.form.prenom_tuteur)) {
                this.prenom_tuteur_erreur = "Ce champ ne peut comporter que des lettres et des espaces"
                i = 1;
                console.log("prenomtuteur=" + i);
            }
            //pour adresse
            if (this.form.adresse_eleve === "") {
                this.adresse_eleve_erreur = "Ce champ est obligatoire"
                i = 1;
                console.log("videadresseeleve=" + i);
            }
            //pour adresse
            if (this.form.adresse_tuteur === "") {
                this.adresse_tuteur_erreur = "Ce champ est obligatoire"
                i = 1;
                console.log("videadressetutetur=" + i);
            }
            //pour lieu de naissance
            if (this.form.lieu_naissance_eleve === "") {
                this.lieu_naissance_eleve_erreur = "Ce champ est obligatoire"
                i = 1;
                console.log("videlieunaisseleve=" + i);
            }
            if (!this.verifCaratere(this.form.lieu_naissance_eleve)) {
                this.lieu_naissance_eleve_erreur = "Ce champ ne peut comporter que des lettres et des espaces"
                i = 1;
                console.log("lieunaisseleve=" + i);
            }
            //pour lieu de naissance
            // if(this.form.lieu_naissance_tuteur=== ""){
            //     this.lieu_naissance_tuteur_erreur= "Ce champ est obligatoire"
            //     i= 1;
            //     console.log("videlieunaisstutetur="+ i);
            // }
            // if(!this.verifCaratere(this.form.lieu_naissance_tuteur)){
            //     this.lieu_naissance_tuteur_erreur= "Ce champ ne peut comporter que des lettres et des espaces"
            //     i= 1;
            //     console.log("lieunaisstutetur="+ i);
            // }
            //pour nationalite
            if (this.form.nationalite_eleve === "") {
                this.nationalite_eleve_erreur = "Ce champ est obligatoire"
                i = 1;
                console.log("videnationaliteeleve=" + i);
            }
            if (!this.verifCaratere(this.form.nationalite_eleve)) {
                this.nationalite_eleve_erreur = "Ce champ ne peut comporter que des lettres et des espaces"
                i = 1;
                console.log("nationaliteeleve=" + i);
            }
            //pour nationalite
            if (this.form.nationalite_tuteur === "") {
                this.nationalite_tuteur_erreur = "Ce champ est obligatoire"
                i = 1;
                console.log("videnationalitetutetur=" + i);
            }
            if (!this.verifCaratere(this.form.nationalite_tuteur)) {
                this.nationalite_tuteur_erreur = "Ce champ ne peut comporter que des lettres et des espaces"
                i = 1;
                console.log("nationalitetutetur=" + i);
            }
            //Vérification de l' email
            if (this.form.mail_eleve === "") {
                this.mail_eleve_erreur = "L'email est obligatoire"
                i = 1;
                console.log("videemailtueleve=" + i);
            } else {
                if (!this.validateEmail(this.form.mail_eleve)) {
                    this.mail_eleve_erreur = "L'email n'est pas valide";
                    i = 1;
                    console.log("emaileleve=" + i);
                }
            }
            //Vérification de l' email
            if (this.form.mail_tuteur === "") {
                this.mail_tuteur_erreur = "L'email est obligatoire"
                i = 1;
                console.log("videemailtutetur=" + i);
            } else {
                if (!this.validateEmail(this.form.mail_tuteur)) {
                    this.mail_tuteur_erreur = "L'email n'est pas valide";
                    i = 1;
                    console.log("emailtutetur=" + i);
                }
            }
            // Vérification de la date de naissance
            if (this.form.date_naissance_eleve === "") {
                this.date_naissance_eleve_erreur = "La date de naissance est obligatoire";
                i = 1;
                console.log("videdatenaisseleve=" + i);
            } else {
                const dateNaissance = new Date(this.form.date_naissance_eleve);
                const dateLimite = new Date();
                const dateActuelle = new Date();
                dateLimite.setFullYear(dateLimite.getFullYear() - 19); // 18 ans avant la date actuelle
                let annee = dateLimite.getFullYear();

                if (dateNaissance > dateLimite) {
                    this.date_naissance_eleve_erreur = "La date de naissance ne peut pas être supérieure à " + annee;
                    i = 1;
                    console.log("datenaisseleve=" + i);
                }
                if (dateNaissance > dateActuelle) {
                    this.date_naissance_eleve_erreur = "La date de naissance ne peut pas être dans le futur";
                    i = 1;
                    console.log("datenaisseleve=" + i);
                }
            }
            // Vérification de la date de naissance
            // if(this.form.date_naissance_tuteur === ""){
            //     this.date_naissance_tuteur_erreur = "La date de naissance est obligatoire";
            //     i= 1;
            //     console.log("videdatenaisstutetur="+ i);
            // } else {
            //     const dateNaissance = new Date(this.form.date_naissance_tuteur);
            //     const dateLimite = new Date();
            //     const dateActuelle = new Date();
            //     dateLimite.setFullYear(dateLimite.getFullYear() - 19); // 18 ans avant la date actuelle
            //     let annee = dateLimite.getFullYear();

            //     if(dateNaissance > dateLimite) {
            //         this.date_naissance_tuteur_erreur = "La date de naissance ne peut pas être supérieure à "+ annee;
            //         i=1;
            //         console.log("datenaisstutetur="+ i);
            //     }if(dateNaissance > dateActuelle) {
            //         this.date_naissance_tuteur_erreur = "La date de naissance ne peut pas être dans le futur";
            //         i=1;
            //         console.log("datenaisstutetur="+ i);
            //     }

            // }
            //Vérification du numero de telephone
            if (this.form.telephone_eleve === "") {
                this.telephone_eleve_erreur = "Le numéro de téléphone est obligatoire";
                i = 1;
                console.log("videtelephoneeleve=" + i);
            } else if (!this.validatePhoneNumber(this.form.telephone_eleve)) {
                this.telephone_eleve_erreur = "Le numéro de téléphone n'est pas valide";
                i = 1;
                console.log("telephoneeleve=" + i);
            }
            //Vérification du numero de telephone
            if (this.form.telephone_tuteur === "") {
                this.telephone_tuteur_erreur = "Le numéro de téléphone est obligatoire";
                i = 1;
                console.log("videtelephonetuteur=" + i);
            } else if (!this.validatePhoneNumber(this.form.telephone_tuteur)) {
                this.telephone_tuteur_erreur = "Le numéro de téléphone n'est pas valide";
                i = 1;
                console.log("telephonetuteur=" + i);
            }
            //Vérification du numero de telephone
            if (this.form.contact_urgence1 === "") {
                this.telephone_urgence_1_erreur = "Le numéro de téléphone est obligatoire";
                i = 1;
                console.log("videcontacturgence1=" + i);
            } else if (!this.validatePhoneNumber(this.form.contact_urgence1)) {
                this.telephone_urgence_1_erreur = "Le numéro de téléphone n'est pas valide";
                i = 1;
                console.log("nombrecontacturgence1=" + i);
            }
            //Vérification du numero de telephone
            if (this.form.contact_urgence2 === "") {
                this.telephone_urgence_2_erreur = "Le numéro de téléphone est obligatoire";
                i = 1;
                console.log("videcontacturgence2=" + i);
            } else if (!this.validatePhoneNumber(this.form.contact_urgence2)) {
                this.telephone_urgence_2_erreur = "Le numéro de téléphone n'est pas valide";
                i = 1;
                console.log("nombrecontacturgence2=" + i);
            }
            //Vérification de matrimoniale
            if (this.form.genre_eleve === "") {
                this.genre_eleve_erreur = "Vous avez oublié de sélectionner le genre "
                i = 1;
                console.log("genreeleve=" + i);
            }
            //Vérification de matrimoniale
            if (this.form.genre_tuteur === "") {
                this.genre_tuteur_erreur = "Vous avez oublié de sélectionner le genre "
                i = 1;
                console.log("genretuteur=" + i);
            }

            //Vérification de annee academique
            if (this.form.id_annee_accademique === "") {
                this.id_annee_accademique_erreur = "Vous avez oublié de sélectionner l\'Annee Academique "
                i = 1;
                console.log("anneeacada=" + i);
            }

            //Vérification de annee academique
            if (this.form.id_classe === "") {
                this.id_classe_erreur = "Vous avez oublié de sélectionner le statut "
                i = 1;
                console.log("classe=" + i);
            }
            console.log(i);

            if (i == 1) return true;

            return false;

        },

    }
}
</script>

<style></style>
