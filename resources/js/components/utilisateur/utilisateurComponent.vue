<template >
    <!--  <div> -->
    <!--    <div class="titres">
            <h1>Nouvel utilisateur</h1>
        </div> -->

    <!--    <form @submit.prevent="validerAvantAjout()" action="" method="">
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
                        <div class="actuel"><i class="fi fi-rr-check"></i></div>
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
                        <label for="date_naissance" :class="{ 'couleur_rouge': (this.date_erreur) }">Date de
                            naissance</label>
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
                        <input type="text" name="adresse" id="adresse" v-model="form.adresse"
                            @input="validatedata('adresse')" :class="{ 'bordure_rouge': (this.adresse_erreur) }">
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
                            <option v-for="(role, index) in roles" :value="role.id" :key="index">{{ role.intitule }}
                            </option>
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

                                <option value="Niveau 1">Célibataire</option>
                                <option value="Niveau 2">Marié</option>

                            </select>
                            <span class="erreur">{{ situation_matrimoniale_erreur
                            }}</span>
                        </div>
                    </div>

                    <div class="groupe_champs">

                        <div class="champ">
                            <label for="Spécialite"
                                :class="{ 'couleur_rouge': (this.id_specialite_erreur) }">Spécialite</label>
                            <select name="id_specialite" id="id_specialite" v-model="form.id_specialite"
                                @change="validatedata('specialite')"
                                :class="{ 'bordure_rouge': (this.id_specialite_erreur) }">

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
                        <select name="id_service" id="id_service" v-model="form.id_service"
                            @change="validatedata('service')" :class="{ 'bordure_rouge': (this.id_service_erreur) }">

                            <option v-for="(service, index) in services" :value="service.id" :key="index">{{
                                service.nom_service
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
                </div>
            </div>
        </form> -->

    <!--  nouveau formulaire -->
    <!--  <form action="#" @submit.prevent="validerAvantAjout()" id="form_sample_1" class="form-horizontal"> -->
    <!--    <div style="">
            <img alt="image" v-if="photo" :src="photoUrl" style="width: 10%; height: 10%;">
        </div> -->
    <!--  <div class="form-body"> -->
    <!--  <div class="col-lg-6 p-t-20">
        <label class="control-label col-md-3">Photo
        </label>
        <div class="col-md-5">
            <input type="file" class="default" multiple @change="ajoutimage" accept="image/*">
        </div>
    </div> -->
    <div class="col-lg-6 p-t-20">
        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
            <label class="mdl-textfield__label" for="txtFirstName" v-show="!form.nom">Nom</label>
            <input class="mdl-textfield__input" type="text" id="txtFirstName" v-model="form.nom"
                @input="validatedata('nom')">
            <span class="erreur">{{ this.nom_user_erreur }}</span>
        </div>
    </div>
    <div class="col-lg-6 p-t-20">

        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
            <label class="mdl-textfield__label" for="txtLastName" v-show="!form.prenom">Prénom</label>
            <input class="mdl-textfield__input" type="text" id="txtLastName" v-model="form.prenom"
                @input="validatedata('prenom')">
            <span class="erreur">{{ this.prenom_user_erreur }}</span>
        </div>
    </div>

    <div class="col-lg-6 p-t-20">
        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
            <label class="mdl-textfield__label" for="dateOfBirth" v-show="!form.date_naissance">Date de Naissance</label>
            <!-- <input class="mdl-textfield__input" type="text" id="dateOfBirth" v-model="form.date_naissance"
                @change="validatedata('date_naissance')"> -->
                <flat-pickr v-model="form.date_naissance" class="mdl-textfield__input" @input="validatedata('date_naissance')"></flat-pickr>
            <span class="erreur">{{ this.date_erreur }}</span>
        </div>
    </div>

    <div class="col-lg-6 p-t-20">
        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
            <label class="mdl-textfield__label" for="designation" v-show="!form.lieu_naissance">Lieu de naissance</label>
            <input class="mdl-textfield__input" type="text" id="designation" v-model="form.lieu_naissance"
                @input="validatedata('naissance')">
            <span class="erreur">{{ this.lieu_naissance_erreur }}</span>
        </div>
    </div>

    <div class="col-lg-6 p-t-20">

        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
            <label class="mdl-textfield__label" for="list2" v-show="!form.nationalite">Nationalité</label>
            <input class="mdl-textfield__input" type="text" id="list2" v-model="form.nationalite"
                @input="validatedata('nationalite')">
            <span class="erreur">{{ this.nationalite_erreur }}</span>
        </div>

    </div>

    <div class="col-lg-6 p-t-20">
        <div
            class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label getmdl-select getmdl-select__fix-height txt-full-width">
            <label for="list3" class="mdl-textfield__label" v-show="!form.genre">Choisissez Genre</label>
            <select class="mdl-textfield__input" id="list3" readonly tabIndex="-1" v-model="form.genre"
                @change="validatedata('genre')">
                <option value="Masculin">Masculin</option>
                <option value="Féminin">Féminin</option>
            </select>
            <span class="erreur">{{ this.genre_erreur }}</span>
        </div>

    </div>


    <div class="col-lg-6 p-t-20">
        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
            <label class="mdl-textfield__label" for="text5" v-show="!form.telephone">Téléphone</label>
            <input class="mdl-textfield__input" type="text" pattern="-?[0-9]*(\.[0-9]+)?" id="text5"
                v-model="form.telephone" @input="validatedata('telephone')">
            <span class="erreur">{{ this.telephone_erreur }}</span>
        </div>
    </div>


    <div class="col-lg-6 p-t-20">
        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
            <label class="mdl-textfield__label" for="designation2" v-show="!form.adresse">Adresse</label>
            <input class="mdl-textfield__input" type="text" id="designation2" v-model="form.adresse"
                @input="validatedata('adresse')">
            <span class="erreur">{{ this.adresse_erreur }}</span>
        </div>
    </div>

    <div class="col-lg-12 p-t-20">
        <label class="control-label col-md-3" for="photo">Upload Photo</label>
        <div class="col-md-12 dropzone" @click="openFileInput">
            <input type="file" name="file" id="photo" ref="fileInput" style="display: none;" @change="ajoutimage" />
            <!-- Vous pouvez ajouter une icône ou du texte ici pour indiquer le téléchargement -->
            <div class="sidebar-user" v-if="!this.ancienPhoto">
                <div class="sidebar-user-picture">
                    <img v-if="photo" :src="photoUrl" alt="Etu" class="uploaded-image">
                </div>
            </div>
            <div class="sidebar-user" v-if="this.ancienPhoto">
                <div class="sidebar-user-picture">
                    <img :src="getImageUrl(this.ancienPhoto)" alt="Etu" class="uploaded-image">
                </div>
            </div>
            <div v-if="!urlPhoto">
                <i class="fa fa-upload"></i> Cliquez pour télécharger
            </div>
        </div>
        <span class="erreur">{{ photo_erreur }}</span>
    </div>


    <div class="col-lg-6 p-t-20">
        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label txt-full-width">
            <label class="mdl-textfield__label" for="txtemail" v-show="!form.email">Email</label>
            <input class="mdl-textfield__input" type="mail" id="txtemail" v-model="form.email"
                @input="validatedata('email')">
            <span class="erreur">{{ this.email_user_erreur }}</span>
        </div>
    </div>



    <div class="col-lg-6 p-t-20 mt-1">
        <div
            class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label getmdl-select getmdl-select__fix-height txt-full-width">

            <label class="mdl-textfield__label" for="roleSelect" v-show="!form.id_role"> Choisissez un role</label>
            <select class="mdl-textfield__input" id="roleSelect" readonly tabIndex="-1" v-model="form.id_role"
                @change="changement(form.id_role)">

                <option v-for="(role, index) in roles" :value="role.id" :key="index">{{ role.intitule }}</option>
            </select>
            <span class="erreur">{{ id_role_erreur }}</span>
        </div>
    </div>


    <div class="col-lg-6 p-t-20" v-show="this.interesser === 2 || this.form.id_role === 2">
        <div
            class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label getmdl-select getmdl-select__fix-height txt-full-width">
            <label for="list5" class="mdl-textfield__label" v-show="!form.type">Choisissez Type Professeur</label>
            <select class="mdl-textfield__input" id="list5" readonly tabIndex="-1" v-model="form.type"
                @change="validatedata('type')">
                <option value="Etat">Etat</option>
                <option value="Etat">Recruté</option>
                <option value="Recruter">Prestataire</option>
            </select>
            <span class="erreur">{{ type_erreur }}</span>
        </div>
    </div>



    <div class="col-lg-6 p-t-20" v-show="this.interesser === 2 || this.form.id_role === 2">
        <div
            class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label getmdl-select getmdl-select__fix-height txt-full-width">
            <label for="list6" class="mdl-textfield__label" v-show="!form.situation_matrimoniale">Choisissez Situation
                Matrimoniale</label>
            <select class="mdl-textfield__input" id="list6" readonly tabIndex="-1" v-model="form.situation_matrimoniale"
                @change="validatedata('situation_matrimoniale')">
                <option value="Célibataire">Célibataire</option>
                <option value="Marié">Marié(e)</option>
            </select>
            <span class="erreur">{{ situation_matrimoniale_erreur }}</span>
        </div>
    </div>



    <div class="col-lg-6 p-t-20" v-show="this.interesser === 2 || this.form.id_role === 2">
        <div
            class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label getmdl-select getmdl-select__fix-height txt-full-width">
            <label for="list7" class="mdl-textfield__label" v-show="!form.id_specialite">Choisissez Spécialité</label>
            <select class="mdl-textfield__input" id="list7" readonly tabIndex="-1" v-model="form.id_specialite"
                @change="validatedata('id_specialite')">
                <option v-for="(specialite, index) in specialites" :value="specialite.id" :key="index">{{
                    specialite.intitule }}</option>
            </select>
            <span class="erreur">{{ id_specialite_erreur }}</span>
        </div>
    </div>



    <div class="col-lg-6 p-t-20" v-show="this.interesser === 2 || this.form.id_role === 2">
        <div
            class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label getmdl-select getmdl-select__fix-height txt-full-width">

            <label for="list8" class="mdl-textfield__label" v-show="!form.id_departement">Choisissez Département</label>
            <select class="mdl-textfield__input" id="list8" readonly tabIndex="-1" v-model="form.id_departement"
                @change="validatedata('departement')">
                <option v-for="(departement, index) in departements" :value="departement.id" :key="index">{{
                    departement.nom_departement }}</option>
            </select>
            <span class="erreur">{{ id_departement_erreur }}</span>
        </div>
    </div>


    <div class="col-lg-6 p-t-20"
        v-show="(this.interesser !== 1 && this.interesser !== 2 && this.interesser !== '') || (this.form.id_role !== 2 & this.form.id_role !== 1 & this.form.id_role !== '')">
        <div
            class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label getmdl-select getmdl-select__fix-height txt-full-width">

            <label for="list9" class="mdl-textfield__label" v-show="!form.id_service">Choisissez Service</label>
            <select class="mdl-textfield__input" id="list9" readonly tabIndex="-1" v-model="form.id_service"
                @change="validatedata('service')">
                <option v-for="(service, index) in services" :value="service.id" :key="index">{{ service.nom_service }}
                </option>

            </select>
            <span class="erreur">{{ id_service_erreur }}</span>
        </div>
    </div>

    <div class="col-lg-6 p-t-20"
    v-show="this.interesser === 2 || this.form.id_role === 2">
        <div
            class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label getmdl-select getmdl-select__fix-height txt-full-width">

            <label for="list99" class="mdl-textfield__label" v-show="!form.id_unite_de_formation">Choisissez Filière</label>
            <select class="mdl-textfield__input" id="list99" readonly tabIndex="-1" v-model="form.id_unite_de_formation"
                @change="validatedata('filiere')">
                <option v-for="(filiere, index) in filieres" :value="filiere.id" :key="index">{{ filiere.nom_unite_formation }}
                </option>

            </select>
            <span class="erreur">{{ id_unite_de_formation_erreur }}</span>
        </div>
    </div>
    <div class="col-lg-12 p-t-20 text-center">

        <button type="submit" v-if="!this.editModal"
            class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-circle btn-primary"
            @click.prevent="validerAvantAjout()">Enregistrer</button>
        <button type="submit" v-if="this.editModal"
            class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 m-r-20 btn-circle btn-primary"
            @click.prevent="validerAvantAjout()">Modifier</button>
        <button type="button"
            class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect m-b-10 btn-circle btn-danger"
            @click="resetForm">Annuler</button>

    </div>
</template>

<script>
import bus from '../../eventBus';
import axios from 'axios';
import Form from 'vform';
import flatPickr from 'vue-flatpickr-component';
import 'flatpickr/dist/flatpickr.css';

export default {
    props: ['utilisateur'],
    name: "utilisateurCompenent",
    components: {
    flatPickr,
  },
    data() {
        return {
            countries: [],
            selectedNationality: '',
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
                'id_unite_de_formation': "",
            }),

            photo: "",
            interesser: "",
            roles: [],
            filieres: [],
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
            id_unite_de_formation_erreur: "",
            erreur: "",
            champ: "",
            get_id_perso_admin: "",
            get_id_perso_appui: "",
            i: 0,
            etatForm: false,
            editModal: false,
            idUser: "",
            urlPhoto: false,
            photo_erreur: "",
            ancienPhoto: "",
            utilisateurEnCoursDeModification: null,
        }
    },



    mounted() {
        this.get_role();
        this.get_specialite();
        this.get_departement();
        this.get_service();
        this.get_filiere();
        //this.monterToupdate();
       // componentHandler.upgradeAllRegistered();
     
        bus.on('userModifier', (eventData) => {
            this.editModal = eventData.editModal;
            this.monterToupdate(eventData.utilisateur);
           
        });

    },
    computed: {
        photoUrl() {
            this.urlPhoto = true;
            return this.photo ? URL.createObjectURL(this.photo) : '';
        },
    },

    methods: {

      
        openFileInput() {
            // Cliquez sur l'élément de fichier invisible
            this.$refs.fileInput.click();
        },

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
            formdata.append('id_unite_de_formation', this.form.id_unite_de_formation);
            formdata.append('photo', this.photo);

            try {
                const user_store = await axios.post('/user/store', formdata, {});
                bus.emit('utilisateurAjoutee');
                showDialog6("Utilisateur ajouter avec succès");
                this.resetForm();

            }
            catch (e) {
                /* console.log(e.request.status) */
                if (e.request.status === 404) {
                    showDialog3("Cet utilisateur existe déjà");
                }
                else {
                    Swal.fire('Erreur !', 'Une erreur est survenue lors de l\'enregistrement', 'error')
                    showDialog3("Une erreur est survenue lors de l\'enregistrement");
                }
            }
        },


        changement(event) {
            this.interesser = event;
            this.id_role_erreur = "";

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
        get_filiere() {
            axios.get('/unite_de_formation/all')
                .then(response => {
                    this.filieres = response.data.unite_de_formation


                }).catch(error => {
                    Swal.fire('Erreur!', 'Une erreur est survenue lors de la recuperation des filière', 'error')
                });
        },


        ajoutimage(event) {
            this.photo = event.target.files[0];
            this.photo_erreur = "";
        },

        getImageUrl(url) {
            return url ? `${window.location.origin}/storage/${url}` : '';
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
                    if(this.photo==""){
                        this.photo = this.ancienPhoto;
                    }
                    this.form.nom = this.form.nom.toUpperCase();
                    this.form.lieu_naissance = this.form.lieu_naissance.toUpperCase();
                    this.form.adresse = this.form.adresse.toUpperCase();
                    this.form.nationalite = this.form.nationalite.toUpperCase();
                    // Convertir la première lettre du prénom en majuscule et le reste en minuscules
                    this.form.prenom = this.form.prenom.charAt(0).toUpperCase() + this.form.prenom.slice(1).toLowerCase();
                    this.update_utilisateur(this.idUser);
                    this.resetForm();
                    

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
                    this.resetForm();
                   
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

            this.photo = "";
            this.editModal = false;

            this.nom_user_erreur = "";
            this.date_erreur = "";
            this.interesser = "";
            this.get_id_perso_admin = "";
            this.prenom_user_erreur = "";
      
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
            this.photo_erreur = "";
            this.situation_matrimoniale_erreur = "";
            this.id_personnel_appui_erreur = "";
            this.id_personnel_administratif_erreur = "";

        },
        fetchCountries() {
            // Utiliser Vue-resource pour effectuer la requête AJAX (vous pouvez également utiliser Axios)
            axios.get('https://restcountries.com/v3.1/all')
                .then(response => {
                    // Mettre à jour la liste des pays
                    this.countries = response.data;
                    console.log(this.countries)
                })
                .catch(error => {
                    console.error('Erreur lors de la récupération des pays :', error);
                });
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
                case 'photo':
                    this.photo_erreur = "";
                    //Vérification de matrimoniale

                    if (!this.editModal) {
                        if (this.photo === "") {
                            this.photo_erreur = "Ce champ est obligatoire"
                            i = 1;
                            return true;
                        }
                    } else {
                        this.photo = this.ancienPhoto;
                        return true
                    }
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
                case 'filiere':
                    this.id_unite_de_formation_erreur = "";
                    //Vérification de departement
                    if (this.form.id_unite_de_formation === "") {
                        this.id_unite_de_formation_erreur = "Vous avez oublié de sélectionner la filiere"
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
            this.id_unite_de_formation_erreur = "";
            this.photo_erreur = "";
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
            // Effectuez la validation pour le champ 'photo'
            if (!this.editModal) {
                if (this.photo === "") {
                    this.photo_erreur = "Ce champ est obligatoire"
                    i = 1;
                    console.log("videnomeleve=" + i);
                }
            } else {
                this.photo = this.ancienPhoto;
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
                this.email_user_erreur = "L'email est obligatoire";
                i = 1;
            } else if (!this.validateEmail(this.form.email)) {
                this.email_user_erreur = "L'email n'est pas valide";
                i = 1;
            } else if (!this.editModal) {
                // Si vous êtes en mode édition, ne faites pas la vérification côté client
                // Continuez avec le reste du traitement ou mettez à jour l'utilisateur
            } else {
                // Si vous êtes en mode ajout, effectuez la vérification côté client
                try {
                    const response = axios.post('/verif/mail', { email: this.form.email });

                    // Succès - faire quelque chose si nécessaire
                } catch (error) {
                    if (error.response.status === 422) {
                        const errors = error.response.data.errors;

                        // Vérifiez si l'erreur spécifique liée à l'e-mail existe
                        if (errors && errors.email) {
                            this.email_user_erreur = errors.email[0];
                            i = 1;
                            if (this.email_user_erreur == "The email has already been taken.") {
                                this.email_user_erreur = "Cet e-mail existe déjà";
                            }
                        }
                    }
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
                if (this.form.id_unite_de_formation === "") {
                        this.id_unite_de_formation_erreur = "Vous avez oublié de sélectionner la filière"
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

            if (this.interesser !== 1 && this.interesser !== 2 && this.interesser !== '') {
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
              formdata.append('id_unite_de_formation', this.form.id_unite_de_formation);
            formdata.append('photo', this.photo);

            try {
                const user_store = await axios.post('/user/update/' + id, formdata);
                bus.emit('utilisateurAjoutee');
                showDialog6("Utilisateur modifier avec succès");
                this.resetForm();

            }
            catch (e) {
                /* console.log(e.request.status) */
                if (e.request.status === 404) {
                    showDialog3("Une erreur est survenue lors de la modification");
                }
                else {
                    showDialog3("Une erreur est survenue lors de la modification");
                }
            }
        },

        monterToupdate(utilisateur) {
            console.log("MonterToupdate called");
           /*  if(this.utilisateur.editModal){ */
            this.idUser = utilisateur.id;
            this.editModal = utilisateur.editModal;
            this.form.nom = utilisateur.nom;
            this.form.prenom = utilisateur.prenom;
            this.form.genre = utilisateur.genre;
            this.form.adresse = utilisateur.adresse;
            this.form.telephone = utilisateur.telephone;
            this.form.email = utilisateur.email;
            this.form.lieu_naissance = utilisateur.lieu_naissance;
            this.form.date_naissance = utilisateur.date_naissance;
            this.form.nationalite = utilisateur.nationalite;
            this.form.type = utilisateur.type;
            this.form.situation_matrimoniale = utilisateur.situation_matrimoniale;
            this.form.id_role = utilisateur.id_role;
            this.form.id_departement = utilisateur.id_departement;
            this.form.id_service = utilisateur.id_service;
            this.form.id_specialite = utilisateur.specialite;
            this.form.id_departement = utilisateur.id_departement;
            this.form.id_service = utilisateur.id_service;
            this.form.id_unite_de_formation = utilisateur.id_filiere;
            this.ancienPhoto = utilisateur.photo;
            componentHandler.upgradeAllRegistered();
            console.log("yryryryryryrr");
            console.log(this.editModal);
           /*  } */


        },

    }
}
</script>
<style scoped>
.dropzone {
    border: 2px dashed #ccc;
    padding: 20px;
    text-align: center;
    cursor: pointer;
    /* Spécifiez les dimensions du dropzone */
    width: 100%;
    height: 80%;
}

.uploaded-image {
    /* Spécifiez les dimensions de l'image téléchargée */
    width: 100%;
    height: 100%;
    float: left;
    object-fit: cover;
    /* Garantit que l'image couvre complètement le conteneur */
}
</style>

