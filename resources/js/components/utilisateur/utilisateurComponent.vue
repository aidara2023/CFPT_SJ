<template >
    <div class="titres">
        <h1>Nouvel utilisateur</h1>
    </div>

    <form @submit.prevent="validerAvantAjout()" action="" method="">
        <div class="droit">

            <div class="image">
                <div class="roue">
                    <div class="roue">
                        <label for="photo" class="photo">
                            <i class="fi fi-rr-picture"></i>
                            téléchargez votre photo ici
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
                    <div class="actuel"><i class="fi fi-rr-check"></i></div><!-- 
                    <span></span>
                    <div class="actuel"><i class="fi fi-rr-check"></i></div> -->
                </div>
                <label for="" class="positions" data-etape="1">ETApe 1</label>
            </div>
        </div>

        <div class="informations plus">
            <div class="titres">
                <h1>Nouvel utilisateur</h1>
            </div>

            <div class="champ " v-show="i_1_2_3 === 1">
                <label for="nom" :class="{ 'couleur_rouge': (this.nom_user_erreur) }">Nom</label>
                <input type="text" name="nom" id="nom" v-model="form.nom" @input="validatedata('nom')"
                    :class="{ 'bordure_rouge': (this.nom_user_erreur) }">
                <span class="erreur">{{ this.nom_user_erreur }}</span>
            </div>

            <div class="champ " v-show="i_1_2_3 === 1">
                <label for="prenom" :class="{ 'couleur_rouge': (this.prenom_user_erreur) }">Prenom</label>
                <input type="text" name="prenom" id="prenom" v-model="form.prenom" @input="validatedata('prenom')"
                    :class="{ 'bordure_rouge': (this.prenom_user_erreur) }">
                <span class="erreur">{{ this.prenom_user_erreur }}</span>
            </div>

            <div class="groupe_champs " v-show="i_1_2_3 === 1">
                <div class="champ">
                    <label for="date_naissance" :class="{ 'couleur_rouge': (this.date_erreur) }">Date de naissance</label>
                    <input type="date" name="date_naissance" id="date_naissance" v-model="form.date_naissance"
                        @input="validatedata('date_naissance')" :class="{ 'bordure_rouge': (this.date_erreur) }">
                    <span class="erreur">{{ this.date_erreur }}</span>
                </div>

                <div class="champ ">
                    <label for="lieu_naissance" :class="{ 'couleur_rouge': (this.lieu_naissance_erreur) }">Lieu de
                        naissance</label>
                    <input type="text" name="lieu_naissance" id="lieu_naissance" v-model="form.lieu_naissance"
                        @input="validatedata('naissance')" :class="{ 'bordure_rouge': (this.lieu_naissance_erreur) }">
                    <span class="erreur">{{ this.lieu_naissance_erreur }}</span>
                </div>
            </div>

            <div class="groupe_champs " v-show="i_1_2_3 === 1">

                <div class="champ">
                    <label for="Nationalite" :class="{ 'couleur_rouge': (this.nationalite_erreur) }">Nationalite</label>
                    <input type="text" name="nationalite" id="nationalite" v-model="form.nationalite"
                        @input="validatedata('nationalite')" :class="{ 'bordure_rouge': (this.nationalite_erreur) }">
                    <span class="erreur">{{ this.nationalite_erreur }}</span>
                </div>

                <div class="champ">
                    <label for="Sexe" :class="{ 'couleur_rouge': (this.genre_erreur) }">Sexe</label>

                    <select name="role" id="role" v-model="form.genre" @change="validatedata('genre')"
                        :class="{ 'bordure_rouge': (this.genre_erreur) }">
                        <option class="option">Masculin</option>
                        <option class="option">Féminin</option>
                    </select>
                    <span class="erreur">{{ this.genre_erreur }}</span>
                </div>

            </div>


            <div class="groupe_champs  " v-show="i_1_2_3 === 1">
                <div class="champ">
                    <label for="Telephone" :class="{ 'couleur_rouge': (this.telephone_erreur) }">Telephone</label>
                    <input type="tel" name="telephone" id="telephone" v-model="form.telephone"
                        @input="validatedata('telephone')" :class="{ 'bordure_rouge': (this.telephone_erreur) }">
                    <span class="erreur">{{ this.telephone_erreur }}</span>
                </div>

                <div class="champ">
                    <label for="Adresse" :class="{ 'couleur_rouge': (this.adresse_erreur) }">Adresse</label>
                    <input type="text" name="adresse" id="adresse" v-model="form.adresse" @input="validatedata('adresse')"
                        :class="{ 'bordure_rouge': (this.adresse_erreur) }">
                    <span class="erreur">{{ this.adresse_erreur }}</span>
                </div>
            </div>

            <div class="champ " v-show="i_1_2_3 === 3">
                <label for="Adresse Email" :class="{ 'couleur_rouge': (this.email_user_erreur) }">Adresse Email</label>
                <input type="mail" name="email" id="email" v-model="form.email" @input="validatedata('email')"
                    :class="{ 'bordure_rouge': (this.email_user_erreur) }">
                <span class="erreur">{{ this.email_user_erreur }}</span>
            </div>

            <div class="groupe_champs validation" v-show="i_1_2_3 === 1">
                <button type="button" data-close-modal @click="resetForm"><span
                        data-statut="visible">Annuler</span></button>

                <button type="button" @click.prevent="goToStep(3)"><span data-statut="visible">Suivant</span></button>
            </div>

            <div v-show="i_1_2_3 === 3">
                <div class="champ">
                    <label for="Role" :class="{ 'couleur_rouge': (this.id_role_erreur) }">Role</label>
                    <select name="role" id="role" v-model="form.id_role" @change="changement(form.id_role)"
                        :class="{ 'bordure_rouge': (this.id_role_erreur) }">
                        <option v-for="(role, index) in roles" :value="role.id" :key="index">{{ role.intitule }}</option>
                    </select>
                    <span class="erreur">{{ id_role_erreur }}</span>
                </div>
            </div>

            <div v-if="this.interesser === 2">
                <div class="groupe_champs">
                    <div class="champ">
                        <label for="Type Professeur" :class="{ 'couleur_rouge': (this.type_erreur) }">Type
                            Professeur</label>
                        <select name="" id="" v-model="form.type" @change="validatedata('type')"
                            :class="{ 'bordure_rouge': (this.type_erreur) }">
                            <!-- <option value="">Type Professeur</option> -->
                            <option value="Etat">Etat</option>
                            <option value="Etat">Recruté</option>
                            <option value="Recruter">Prestataire</option>
                        </select>
                        <span class="erreur">{{ type_erreur }}</span>
                    </div>

                    <div class="champ">
                        <label for="Statut"
                            :class="{ 'couleur_rouge': (this.situation_matrimoniale_erreur) }">Statut</label>
                        <select name="" id="" v-model="form.situation_matrimoniale"
                            @change="validatedata('situation_matrimoniale')"
                            :class="{ 'bordure_rouge': (this.situation_matrimoniale_erreur) }">
                            <!--   <option value="">Selectioner Statut</option> -->
                            <option value="Niveau 1">Célibataire</option>
                            <option value="Niveau 2">Marié</option>

                        </select>
                        <span class="erreur">{{ situation_matrimoniale_erreur
                        }}</span>
                    </div>
                </div>

                <div class="groupe_champs">

                    <div class="champ">
                        <label for="Spécialite" :class="{ 'couleur_rouge': (this.id_specialite_erreur) }">Spécialite</label>
                        <select name="id_specialite" id="id_specialite" v-model="form.id_specialite"
                            @change="validatedata('specialite')" :class="{ 'bordure_rouge': (this.id_specialite_erreur) }">

                            <option v-for="(specialite, index) in specialites" :value="specialite.id" :key="index">{{
                                specialite.intitule }}</option>
                        </select>
                        <span class="erreur">{{ id_specialite_erreur }}</span>
                    </div>

                    <div class="champ">
                        <label for="Departement"
                            :class="{ 'couleur_rouge': (this.id_departement_erreur) }">Departement</label>
                        <select name="id_departement" id="id_departement" v-model="form.id_departement"
                            @change="validatedata('departement')"
                            :class="{ 'bordure_rouge': (this.id_departement_erreur) }">

                            <option v-for="(departement, index) in departements" :value="departement.id" :key="index">{{
                                departement.nom_departement }}</option>
                        </select>
                        <span class="erreur">{{ id_departement_erreur }}</span>
                    </div>
                </div>
            </div>



            <div v-if="this.interesser === 4">
                <div class="champ">
                    <label for="Service" :class="{ 'couleur_rouge': (this.id_service_erreur) }">Service</label>
                    <select name="id_service" id="id_service" v-model="form.id_service" @change="validatedata('service')"
                        :class="{ 'bordure_rouge': (this.id_service_erreur) }">

                        <option v-for="(service, index) in services" :value="service.id" :key="index">{{ service.nom_service
                        }}</option>
                    </select>
                    <span class="erreur">{{ id_service_erreur }}</span>
                </div>
            </div>

            <div class="groupe_champs validation" v-show="i_1_2_3 === 3">
                <button type="button" @click="goToStep(1)"><span data-statut="visible">Precedent</span></button>

                <button type="submit" :class="{ 'data-close-modal': (etatForm) }"><span
                        data-statut="visible">Ajouter</span></button>
            </div>


            <div class="groupe_champs validation">
                <!-- 
                <input v-if="this.editModal === false" type="submit" value="Ajouter"
                    :class="{ 'data-close-modal': (this.etatForm) }">
                <input v-if="this.editModal === true" type="submit" value="Modifier"
                    :class="{ 'data-close-modal': (this.etatForm) }">
                 <input v-if="this.editModal===true" type="submit" value="Modifier" :class="{ 'data-close-modal': (etatForm) } "> :class="{ 'data-close-modal': !(this.etatForm) } " :class="{ 'data-close-modal': !(validatedata() && verifIdUser()) } "  
                <button type="submit" class="annuler data-close-modal" @click="resetForm">Annuler</button>
 -->
                <!--   <button v-show="i_1_2_3 === 1" type="button" data-close-modal><span data-statut="visible">Annuler</span></button> -->

                <!--          <button type="button"  class="data-close-modal annuler" @click="clic_precedent" ><span data-statut="visible">Annuler</span></button>

            <button type="button"  class="suivant" @click="clic_suivant" ><span data-statut="visible">Suivant</span></button> -->

            </div>
        </div>
    </form>
</template>

<script>
import bus from '../../eventBus';
import axios from 'axios';
import Form from 'vform';

export default {
    name: "utilisateurCompenent",
    data() {
        return {
            filieres: [],
            form: new Form({
                'nom': "",
                'prenom': "",
                'genre': "",
                'adresse': "",
                'telephone': "",
                'email': "",
                'date_naissance': "",
                'lieu_naissance': "",
                'nationalite': "",
                'id_role': "",
                'id_specialite': "",
                'id_departement': "",
                'id_service': "",
                'type': "",
                'situation_matrimoniale': "",
            }),

            photo: "",
            interesser: "",
            roles: [],
            services: [],
            departements: [],
            specialites: [],
            personnel_administratifs: [],
            personnel_appuis: [],
            nom_user_erreur: "",
            prenom_user_erreur: "",
            date_erreur: "",
            lieu_naissance_erreur: "",
            genre_erreur: "",
            adresse_erreur: "",
            telephone_erreur: "",
            email_user_erreur: "",
            nationalite_erreur: "",
            id_role_erreur: "",
            id_specialite_erreur: "",
            id_departement_erreur: "",
            id_service_erreur: "",
            type_erreur: "",
            situation_matrimoniale_erreur: "",
            erreur: "",
            champ: "",
            get_id_perso_admin: "",
            get_id_perso_appui: "",
            i: 0,
            etatForm: false,
            editModal: false,
            idUser: "",
            suivant: "",
            precedent: "",
            visible: "",
            invisible: "",
            off: "",
            i_1_2_3: "",
        }
    },

    mounted() {
        this.get_role();
        this.get_specialite();
        this.get_departement();
        this.get_service();
        this.variables_changement_etape();

        bus.on('utilisateurModifier', (eventData) => {
            this.idUser = eventData.idUser;
            this.editModal = eventData.editModal;
            this.form.nom = eventData.nom;
            this.form.prenom = eventData.prenom;
            this.form.genre = eventData.genre;
            this.form.adresse = eventData.adresse;
            this.form.telephone = eventData.telephone;
            this.form.email = eventData.email;
            this.form.lieu_naissance = eventData.lieu_naissance;
            this.form.nationalite = eventData.nationalite;
            this.form.type = eventData.type;
            this.form.situation_matrimoniale = eventData.situation_matrimoniale;
            this.form.id_role = eventData.id_role;
            this.form.id_departement = eventData.id_departement;
            this.form.id_service = eventData.id_service;
            this.form.id_specialite = eventData.id_specialite;

        });

    },
    computed: {
        photoUrl() {
            return this.photo ? URL.createObjectURL(this.photo) : '';
        },
    },

    methods: {
        async soumettre() {
            const formdata = new FormData();
            formdata.append('nom', this.form.nom);
            formdata.append('prenom', this.form.prenom);
            formdata.append('lieu_naissance', this.form.lieu_naissance);
            formdata.append('date_naissance', this.form.date_naissance);
            formdata.append('genre', this.form.genre);
            formdata.append('adresse', this.form.adresse);
            formdata.append('email', this.form.email);
            formdata.append('telephone', this.form.telephone);
            formdata.append('nationalite', this.form.nationalite);
            formdata.append('id_role', this.form.id_role);
            formdata.append('type', this.form.type);
            formdata.append('situation_matrimoniale', this.form.situation_matrimoniale);
            formdata.append('id_specialite', this.form.id_specialite);
            formdata.append('id_service', this.form.id_service);
            formdata.append('id_departement', this.form.id_departement);
            formdata.append('photo', this.photo);

            try {
                const user_store = await axios.post('/user/store', formdata, {});
                this.resetForm();
                bus.emit('utilisateurAjoutee');
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
                /* console.log(e.request.status) */
                if (e.request.status === 404) {
                    Swal.fire('Erreur !', 'Cet utilisateur existe déjà', 'error')
                }
                else {
                    Swal.fire('Erreur !', 'Une erreur est survenue lors de l\'enregistrement', 'error')
                }
            }
        },


        changement(event) {
            this.interesser = event;
            this.id_role_erreur = "";
        },

        goToStep: function (step) {
            if (!this.validatedata('nom') & !this.validatedata('prenom') & !this.validatedata('date_naissance') & !this.validatedata('naissance') & !this.validatedata('nationalite') & !this.validatedata('genre') & !this.validatedata('adresse') & !this.validatedata('telephone')) {
                this.activePhase = step;
                this.i_1_2_3 = step;
            }



            this.cercles.dataset.etape = this.i_1_2_3 - 2;
            this.etape.dataset.etape = this.i_1_2_3;
            if (this.i_1_2_3 == 3) this.off = 1;
            this.etape.textContent = "etape " + (this.i_1_2_3 - this.off);
            this.off = 0
        },

        get_role() {
            axios.get('/roles/index')
                .then(response => {
                    this.roles = response.data.role


                }).catch(error => {
                    Swal.fire('Erreur!', 'Une erreur est survenue lors de la recuperation des roles', 'error')
                });
        },

        get_service() {
            axios.get('/service/index').then(response => {
                this.services = response.data.service
            }).catch(error => {
                Swal.fire('Erreur!', 'Une erreur est survenue lors de la recuperation des services', 'error')
            });
        },

        /* 
                get_personnel_administratif(){
                    axios.get('/personnel_administratif/index').then(response => {
                    this.personnel_administratifs=response.data.personnel_administratifs
                    console.log(this.personnel_administratifs)
                    }).catch(error=>{
                        Swal.fire('Erreur!','Une erreur est survenue lors de la recuperation des personnel administratifs','error')
                    });
                },
                get_personnel_appui(){
                    axios.get('/personnel_appui/index').then(response => {
                    this.personnel_appuis=response.data.personnel_appuis
                    console.log(this.personnel_appuis)
                    }).catch(error=>{
                        Swal.fire('Erreur!','Une erreur est survenue lors de la recuperation des personnel appuis','error')
                    });
                }, */




        get_specialite() {
            axios.get('/specialite/index').then(response => {
                this.specialites = response.data.specialite
            }).catch(error => {
                Swal.fire('Erreur!', 'Une erreur est survenue lors de la recuperation des specialite', 'error')
            });
        },

        get_departement() {
            axios.get('/departement/all')
                .then(response => {
                    this.departements = response.data.departement


                }).catch(error => {
                    Swal.fire('Erreur!', 'Une erreur est survenue lors de la recuperation des departements', 'error')
                });
        },


        ajoutimage(event) {
            this.photo = event.target.files[0];
        },

        getImageUrl() {
            const timestamp = new Date().getTime();
            return this.photo ? `${window.location.origin}/image/${this.photo.name}?t=${timestamp}` : '';
        },

        validerAvantAjout() {
            const isVerifIdValid = this.verifId();
            const isIdChampValid = this.validatedataOld();
            /*   console.log(isNomChampValid); */

            if (isIdChampValid || isVerifIdValid) {

                this.etatForm = false;
                console.log("erreur");
                this.editModal = false;
                return 0;
            } else {
                if (this.editModal === true) {
                    this.etatForm = true;
                    this.form.nom = this.form.nom.toUpperCase();
                    this.form.lieu_naissance = this.form.lieu_naissance.toUpperCase();
                    this.form.adresse = this.form.adresse.toUpperCase();
                    this.form.nationalite = this.form.nationalite.toUpperCase();
                    
                    // Convertir la première lettre du prénom en majuscule et le reste en minuscules
                    this.form.prenom = this.form.prenom.charAt(0).toUpperCase() + this.form.prenom.slice(1).toLowerCase();
                    this.update_utilisateur(this.idUser);
                    this.closeModal('[data-modal-confirmation-modifier]');
                    this.editModal = false;

                }
                else {
                    this.etatForm = true;

                    this.form.nom = this.form.nom.toUpperCase();
                    this.form.lieu_naissance = this.form.lieu_naissance.toUpperCase();
                    this.form.adresse = this.form.adresse.toUpperCase();
                    this.form.nationalite = this.form.nationalite.toUpperCase();

                    // Convertir la première lettre du prénom en majuscule et le reste en minuscules
                    this.form.prenom = this.form.prenom.charAt(0).toUpperCase() + this.form.prenom.slice(1).toLowerCase();
                    this.soumettre();
                    // this.closeModal('[data-modal-confirmation]');
                    this.editModal = false;
                }
            }
        },

        resetForm() {

            this.form.nom = "";
            this.form.prenom = "";
            this.form.genre = "";
            this.form.adresse = "";
            this.form.telephone = "";
            this.form.email = "";
            this.form.date_naissance = "";
            this.form.lieu_naissance = "";
            this.form.nationalite = "";
            this.form.id_role = "";
            this.form.type = "";
            this.form.situation_matrimoniale = "";
            this.form.id_specialite = "";
            this.form.id_departement = "";
            this.form.id_service = "";

            /*  this.form.id_personnel_administratif="";
             this.id_personnel_appui=""; */

            this.photo = "";
            this.editModal = false;

            this.nom_user_erreur = "";
            this.interesser = "";
            this.get_id_perso_admin = "";
            this.prenom_user_erreur = "";
            this.date_erreur = "";
            this.lieu_naissance_erreur = "";
            this.genre_erreur = "";
            this.adresse_erreur = "";
            this.telephone_erreur = "";
            this.email_user_erreur = "";
            this.nationalite_erreur = "";
            this.id_role_erreur = "";
            this.id_specialite_erreur = "";
            this.id_departement_erreur = "";
            this.id_service_erreur = "";
            this.type_erreur = "";
            this.situation_matrimoniale_erreur = "";
            this.id_personnel_appui_erreur = "";
            this.id_personnel_administratif_erreur = "";



            /* this.activePhase= 1; */

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
            this.erreur = "";
            var i = 0;

            switch (champ) {

                case 'nom':
                    this.nom_user_erreur = "";
                    // Effectuez la validation pour le champ 'nom'
                    if (this.form.nom === "") {
                        this.nom_user_erreur = "Ce champ est obligatoire"
                        i = 1;
                        return true

                    }
                    if (!this.verifCaratere(this.form.nom)) {
                        this.nom_user_erreur = "Ce champ ne peut comporter que des lettres et des espaces"
                        /* this.erreur= "Ce champ ne peut comporter que des lettres et des espaces" */
                        i = 1;
                        return true
                    }
                    // Ajoutez d'autres validations si nécessaire
                    break;
                case 'prenom':
                    this.prenom_user_erreur = "";
                    //pour prenom
                    if (this.form.prenom === "") {
                        this.prenom_user_erreur = "Ce champ est obligatoire"
                        i = 1;
                        return true
                    }
                    if (!this.verifCaratere(this.form.prenom)) {
                        this.prenom_user_erreur = "Ce champ ne peut comporter que des lettres et des espaces"
                        /*  this.erreur= "Ce champ ne peut comporter que des lettres et des espaces" */
                        i = 1;
                        return true
                    }
                    break;
                case 'adresse':
                    this.adresse_erreur = "";
                    //pour adresse
                    if (this.form.adresse === "") {
                        this.adresse_erreur = "Ce champ est obligatoire"
                        i = 1;
                        return true

                    }
                    break;
                case 'naissance':
                    this.lieu_naissance_erreur = "";
                    //pour lieu de naissance
                    if (this.form.lieu_naissance === "") {
                        this.lieu_naissance_erreur = "Ce champ est obligatoire"
                        i = 1;
                        return true
                    }
                    if (!this.verifCaratere(this.form.lieu_naissance)) {
                        this.lieu_naissance_erreur = "Ce champ ne peut comporter que des lettres et des espaces"
                        i = 1;
                        return true
                    }
                    break;
                case 'nationalite':
                    this.nationalite_erreur = "";
                    //pour nationalite
                    if (this.form.nationalite === "") {
                        this.nationalite_erreur = "Ce champ est obligatoire"
                        i = 1;
                        return true
                    }
                    if (!this.verifCaratere(this.form.nationalite)) {
                        this.nationalite_erreur = "Ce champ ne peut comporter que des lettres et des espaces"
                        i = 1;
                        return true
                    }
                    break;
                case 'email':
                    this.email_user_erreur = "";
                    //Vérification de l' email
                    if (this.form.email === "") {
                        this.email_user_erreur = "L'email est obligatoire"
                        i = 1;
                        return true
                    } else {
                        if (!this.validateEmail(this.form.email)) {
                            this.email_user_erreur = "L'email n'est pas valide";
                            i = 1;
                            return true
                        }
                    }
                    break;
                case 'date_naissance':
                    this.date_erreur = "";
                    // Vérification de la date de naissance
                    if (this.form.date_naissance === "") {
                        this.date_erreur = "La date de naissance est obligatoire";
                        i = 1;
                        return true
                    } else {
                        const dateNaissance = new Date(this.form.date_naissance);
                        const dateLimite = new Date();
                        const dateActuelle = new Date();
                        dateLimite.setFullYear(dateLimite.getFullYear() - 19); // 18 ans avant la date actuelle
                        let annee = dateLimite.getFullYear();
                        console.log(annee);

                        if (dateNaissance > dateLimite) {
                            this.date_erreur = "La date de naissance ne peut pas être supérieure à " + annee;
                            i = 1;
                            return true
                        } if (dateNaissance > dateActuelle) {
                            this.date_erreur = "La date de naissance ne peut pas être dans le futur";
                            i = 1;
                            return true
                        }

                    }
                    break;
                case 'telephone':
                    this.telephone_erreur = "";
                    //Vérification du numero de telephone
                    if (this.form.telephone === "") {
                        this.telephone_erreur = "Le numéro de téléphone est obligatoire";
                        i = 1;
                        return true
                    } else if (!this.validatePhoneNumber(this.form.telephone)) {
                        this.telephone_erreur = "Le numéro de téléphone n'est pas valide";
                        i = 1;
                        return true
                    }
                    break;
                case 'role':
                    this.id_role_erreur = "";
                    //Vérification de role
                    if (this.form.id_role === "") {
                        this.id_role_erreur = "Vous avez oublié de sélectionner le role "
                        i = 1;
                        return true
                    }
                    break;

                case 'genre':
                    this.genre_erreur = "";
                    //Vérification de matrimoniale
                    if (this.form.genre === "") {
                        this.genre_erreur = "Vous avez oublié de sélectionner le genre "
                        i = 1;
                        return true
                    }
                    break;

                case 'type':
                    this.type_erreur = "";
                    //Vérification de type
                    if (this.form.type === "") {
                        this.type_erreur = "Vous avez oublié de sélectionner le type "
                        i = 1;
                        return true
                    }
                    break;

                case 'service':
                    //Vérification deservice
                    this.id_service_erreur = "";
                    if (this.form.id_service === "") {
                        this.id_service_erreur = "Vous avez oublié de sélectionner le chef de service"
                        i = 1;
                        return true
                    }

                    break;

                case 'specialite':
                    this.id_specialite_erreur = "";
                    //Vérification de spécialité
                    if (this.form.id_specialite === "") {
                        this.id_specialite_erreur = "Vous avez oublié de sélectionner la specialité"
                        i = 1;
                        return true
                    }
                    break;
                case 'situation_matrimoniale':
                    this.situation_matrimoniale_erreur = "";
                    //Vérification de matrimoniale
                    if (this.form.situation_matrimoniale === "") {
                        this.situation_matrimoniale_erreur = "Vous avez oublié de sélectionner le statut "
                        i = 1;
                        return true
                    }
                    break;
                case 'departement':
                    this.id_departement_erreur = "";
                    //Vérification de departement
                    if (this.form.id_departement === "") {
                        this.id_departement_erreur = "Vous avez oublié de sélectionner le départrement"
                        i = 1;
                        return true
                    }
                    break;

                default:

                    break;
            }
        },


        validatedataOld() {
            this.nom_user_erreur = "";
            this.prenom_user_erreur = "";
            this.nationalite_erreur = "";
            this.lieu_naissance_erreur = "";
            this.adresse_erreur = "";
            this.date_erreur = "";
            this.email_user_erreur = "";
            this.telephone_erreur = "";
            this.erreur = "";
            this.id_service_erreur = "";
            this.id_specialite_erreur = "";
            this.situation_matrimoniale_erreur = "";
            this.id_departement_erreur = "";
            this.type_erreur = "";
            this.id_role_erreur = "";
            var i = 0;
            // pour nom

            if (this.form.nom === "") {
                this.nom_user_erreur = "Ce champ est obligatoire"
                /*   this.erreur= "Ce champ est obligatoire" */
                i = 1;

            }
            if (!this.verifCaratere(this.form.nom)) {
                this.nom_user_erreur = "Ce champ ne peut comporter que des lettres et des espaces"
                /* this.erreur= "Ce champ ne peut comporter que des lettres et des espaces" */
                i = 1;
            }

            //pour prenom
            if (this.form.prenom === "") {
                this.prenom_user_erreur = "Ce champ est obligatoire"
                /*     this.erreur= "Ce champ est obligatoire" */
                i = 1;
            }
            if (!this.verifCaratere(this.form.prenom)) {
                this.prenom_user_erreur = "Ce champ ne peut comporter que des lettres et des espaces"
                /*  this.erreur= "Ce champ ne peut comporter que des lettres et des espaces" */
                i = 1;
            }


            //pour adresse
            if (this.form.adresse === "") {
                this.adresse_erreur = "Ce champ est obligatoire"
                i = 1;
            }


            //pour lieu de naissance
            if (this.form.lieu_naissance === "") {
                this.lieu_naissance_erreur = "Ce champ est obligatoire"
                i = 1;
            }
            if (!this.verifCaratere(this.form.lieu_naissance)) {
                this.lieu_naissance_erreur = "Ce champ ne peut comporter que des lettres et des espaces"
                i = 1;
            }

            //pour nationalite
            if (this.form.nationalite === "") {
                this.nationalite_erreur = "Ce champ est obligatoire"
                i = 1;
            }
            if (!this.verifCaratere(this.form.nationalite)) {
                this.nationalite_erreur = "Ce champ ne peut comporter que des lettres et des espaces"
                i = 1;
            }

            //Vérification de l' email
            if (this.form.email === "") {
                this.email_user_erreur = "L'email est obligatoire"
                i = 1;
            } else {
                if (!this.validateEmail(this.form.email)) {
                    this.email_user_erreur = "L'email n'est pas valide";
                    i = 1;
                }
            }

            // Vérification de la date de naissance
            if (this.form.date_naissance === "") {
                this.date_erreur = "La date de naissance est obligatoire";
                i = 1;
            } else {
                const dateNaissance = new Date(this.form.date_naissance);
                const dateLimite = new Date();
                const dateActuelle = new Date();
                dateLimite.setFullYear(dateLimite.getFullYear() - 19); // 18 ans avant la date actuelle
                let annee = dateLimite.getFullYear();
                console.log(annee);

                if (dateNaissance > dateLimite) {
                    this.date_erreur = "La date de naissance ne peut pas être supérieure à " + annee;
                    i = 1;
                } if (dateNaissance > dateActuelle) {
                    this.date_erreur = "La date de naissance ne peut pas être dans le futur";
                    i = 1;
                }

            }
            //Verification pour role

            if (this.form.id_role === "") {
                this.id_role_erreur = "Vous avez oublié de sélectionner le role "
                i = 1;
            }

            //Vérification du numero de telephone
            if (this.form.telephone === "") {
                this.telephone_erreur = "Le numéro de téléphone est obligatoire";
                i = 1;
            } else if (!this.validatePhoneNumber(this.form.telephone)) {
                this.telephone_erreur = "Le numéro de téléphone n'est pas valide";
                i = 1;
            }

            if (this.interesser == 2) {
                if (this.form.id_specialite === "") {
                    this.id_specialite_erreur = "Vous avez oublié de sélectionner la specialité"
                    i = 1;
                }
                if (this.form.situation_matrimoniale === "") {
                    this.situation_matrimoniale_erreur = "Vous avez oublié de sélectionner le statut "
                    i = 1;
                }
                if (this.form.id_departement === "") {
                    this.id_departement_erreur = "Vous avez oublié de sélectionner le département"
                    i = 1;
                }
                if (this.form.type === "") {
                    this.type_erreur = "Vous avez oublié de sélectionner le type "
                    i = 1;
                }
            }

            if (i == 1) return true;

            return false;

        },


        verifId() {
            this.id_service_erreur = "";
            this.id_specialite_erreur = "";
            this.situation_matrimoniale_erreur = "";
            this.id_departement_erreur = "";
            this.id_role_erreur = "";
            this.type_erreur = "";
            this.genre_erreur = "";
            var i = 0;

            //pour genre
            if (this.form.genre === "") {
                this.genre_erreur = "Vous avez oublié de sélectionner le genre"
                i = 1;
            }

            // pour role
            if (this.form.id_role === "") {
                this.id_role_erreur = "Vous avez oublié de sélectionner le role "
                i = 1;
            }

            if (this.interesser == 4) {
                if (this.form.id_service === "") {
                    this.id_service_erreur = "Vous avez oublié de sélectionner le chef de service"
                    i = 1;
                }

            }

            if (this.interesser == 2) {
                if (this.form.id_specialite === "") {
                    this.id_specialite_erreur = "Vous avez oublié de sélectionner la specialité"
                    i = 1;
                }
                if (this.form.situation_matrimoniale === "") {
                    this.situation_matrimoniale_erreur = "Vous avez oublié de sélectionner le statut "
                    i = 1;
                }
                if (this.form.id_departement === "") {
                    this.id_departement_erreur = "Vous avez oublié de sélectionner le département"
                    i = 1;
                }
                if (this.form.type === "") {
                    this.type_erreur = "Vous avez oublié de sélectionner le type "
                    i = 1;
                }

            }
            if (i == 1) return true;

            return false;
        },

        closeModal(selector) {
            var ajout = document.querySelector('[data-modal-ajout]');
            var confirmation = document.querySelector(selector);


            /* console.log(ajout); */
            var actif = document.querySelectorAll('.actif');
            actif.forEach(item => {
                item.classList.remove("actif");
            });
            //ajout.classList.remove("actif");
            ajout.close();

            if (this.etatForm === false) {
                var actif = document.querySelectorAll('.actif');
                actif.forEach(item => {
                    item.classList.remove("actif");
                });
                ajout.classList.remove("actif");
                ajout.close();
            }

            this.editModal = false;

            confirmation.style.backgroundColor = 'white';
            confirmation.style.color = 'var(--clr)';

            confirmation.showModal();
            confirmation.classList.add("actif");
            setTimeout(function () {
                confirmation.close();

                setTimeout(function () {
                    confirmation.classList.remove("actif");
                }, 100);

            }, 1700);
        },

        async update_utilisateur(id) {
            const formdata = new FormData();
            formdata.append('nom', this.form.nom);
            formdata.append('prenom', this.form.prenom);
            formdata.append('lieu_naissance', this.form.lieu_naissance);
            formdata.append('date_naissance', this.form.date_naissance);
            formdata.append('genre', this.form.genre);
            formdata.append('adresse', this.form.adresse);
            formdata.append('email', this.form.email);
            formdata.append('telephone', this.form.telephone);
            formdata.append('nationalite', this.form.nationalite);
            formdata.append('id_role', this.form.id_role);
            formdata.append('type', this.form.type);
            formdata.append('situation_matrimoniale',
                this.form.situation_matrimoniale);
            formdata.append('id_specialite', this.form.id_specialite);
            formdata.append('id_service', this.form.id_service);
            formdata.append('id_departement', this.form.id_departement);
            formdata.append('photo', this.photo);
            formdata.append('photo', this.photo);

            try {
                const user_store = await axios.post('/user/update/' + id, formdata);
                this.resetForm();
                bus.emit('utilisateurAjoutee');

            }
            catch (e) {
                /* console.log(e.request.status) */
                if (e.request.status === 404) {
                    Swal.fire('Erreur !', 'Cet utilisateur existe déjà', 'error')
                }
                else {
                    Swal.fire('Erreur !', 'Une erreur est survenue lors de l\'enregistrement', 'error')
                }
            }
        },

        /* Méthode pour les variables */
        variables_changement_etape() {
            this.suivant = document.querySelector('.suivant');
            this.precedent = document.querySelector('.annuler');
            this.i_1_2_3 = 1;
            this.off = 0;

            this.etape = document.querySelector('.positions');
            this.cercles = document.querySelector('.cercles');
        },

        changement_etape(avancer) {
            if (avancer) {
                this.i_1_2_3 = this.i_1_2_3 + 2;
            }
            if (!avancer) {
                this.i_1_2_3 = this.i_1_2_3 - 2;
            }


            if (this.i_1_2_3 > 3) this.i_1_2_3 = 3;
            if (this.i_1_2_3 < 1) this.i_1_2_3 = 1;

            if (this.i_1_2_3 < 3) {
                this.suivant.firstChild.textContent = "Suivant";
                this.suivant.dataset.closeModal = "0";

            } else {
                this.suivant.firstChild.textContent = "Ajouter";
                this.suivant.dataset.closeModal = "1";
            }

            if (this.i_1_2_3 > 1) {
                this.precedent.firstChild.textContent = "Précédent";
                this.precedent.dataset.closeModal = "0";
            }
            else {

                this.precedent.firstChild.textContent = "Annuler";
                this.precedent.dataset.closeModal = "1";

            }

            this.cercles.dataset.etape = this.i_1_2_3 - 2;
            this.etape.dataset.etape = this.i_1_2_3;
            if (this.i_1_2_3 == 3) this.off = 1;
            this.etape.textContent = "etape " + (this.i_1_2_3 - this.off);
            this.off = 0

        },


        clic_suivant() {
            this.changement_etape(true);
        },

        clic_precedent() {
            this.changement_etape(false)
        }



    }
}
</script>

