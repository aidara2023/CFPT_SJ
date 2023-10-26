<template>
      <div class="cote_droit contenu">
        <form @submit.prevent="soumettre()" method="dialog">
            <h1 class="sous_titre">Informations Personnelles</h1>
            <div>
                <p><span class="str">*</span> Assurez vous que la photo est bien carrée</p>
            </div>
            <div class="photo">
                <label for="dossiers">Glissez la photo ici <span></span>
                    <input type="file" name="dossiers" id="dossiers" @change="ajoutimage" accept="image/*">
                </label>
            </div>
            <!--Informations personnelles-->
            <div class="personnel">
            <input type="text" name="nom" id="nom" placeholder="Nom" v-model="form.nom_eleve">
            <input type="text" name="prenom" id="prenom" placeholder="Prenom" v-model="form.prenom_eleve">
            <input type="date" name="date_naissance" id="date_naissance" placeholder="Date de naissance" v-model="form.date_naissance_eleve">
            <input type="text" name="lieu_naissance" id="lieu_naissance" placeholder="Lieu de Naissance" v-model="form.lieu_naissance_eleve">
            <input type="text" name="nationalite" id="nationalite" placeholder="Nationalité" v-model="form.nationalite_eleve">
        </div>

            <div class="sexe">
                <span class="b">Sexe</span>
                <label for="masculin">Masculin
                   <span></span>
                    <input type="radio" name="sexe" id="masculin" value="Masculin" v-model="form.genre_eleve">
                </label>
                <label for="feminin">Feminin
                   <span></span>
                    <input type="radio" name="sexe" id="feminin" value="Feminin" v-model="form.genre_eleve">
                </label>
            </div>
            <div class="num-addr">

                <input type="tel" name="telephone" id="telephone" placeholder="Tel : 77 234 48 43" v-model="form.telephone_eleve">
                <input type="email" name="mail_eleve" id="mail_eleve" placeholder="Mail" v-model="form.mail_eleve">
                <input type="text" name="adresse" id="adresse" placeholder="Adresse" v-model="form.adresse_eleve">
            </div>

            <p><span class="str">*</span> Personnes à contacter en cas d'urgence</p>
            <div class="urgence">
                <input type="tel" name="contact_urgence_1" id="contact_urgence_1" placeholder="Contact d'urgence 1" v-model="form.contact_urgence1">
                <input type="tel" name="contact_urgence_2" id="contact_urgence_2" placeholder="Contact d'urgence 2" v-model="form.contact_urgence2">
            </div>
            <!-- Informations sur le tuteur -->

            <h1 class="sous_titre">Informations sur le tuteur</h1>
            <div class="tuteur">

                <input type="text" name="nom_tuteur" id="nom_tuteur" placeholder="Nom tuteur" v-model="form.nom_tuteur">
                <input type="text" name="prenom_tuteur" id="prenom_tuteur" placeholder="Prénom tuteur" v-model="form.prenom_tuteur">
                <input type="text" name="adresse_tuteur" id="adresse_tuteur" placeholder="Adresse tuteur" v-model="form.adresse_tuteur">
                <input type="email" name="mail_tuteur" id="mail_tuteur" placeholder="Mail tuteur" v-model="form.mail_tuteur">
                <input type="tel" name="telephone_tuteur" id="telephone_tuteur" placeholder="Telephone tuteur" v-model="form.telephone_tuteur">

            </div>
            <div class="sexe">
                <span class="b">Sexe tuteur</span>
                <label for="masculin_tuteur">Masculin
                   <span></span>
                    <input type="radio" name="sexe_tuteur" id="masculin_tuteur" value="Masculin" v-model="form.genre_tuteur">
                </label>
                <label for="feminin_tuteur">Feminin
                   <span></span>
                    <input type="radio" name="sexe_tuteur" id="feminin_tuteur" value="Feminin" v-model="form.genre_tuteur">
                </label>
                </div>

                <div>


                <input type="date" name="date_naissance" id="date_naissance" placeholder="Date de naissance" v-model="form.date_naissance_tuteur">
            <input type="text" name="lieu_naissance" id="lieu_naissance" placeholder="Lieu de Naissance" v-model="form.lieu_naissance_tuteur">
            <input type="text" name="nationalite" id="nationalite" placeholder="Nationalité" v-model="form.nationalite_tuteur">

                </div>


            <h1 class="sous_titre">Informations Académiques</h1>
            <!--Informations académiques-->
            <div class="academiques">
                <select name="annee_accademique" id="annee_accademique" v-model="form.id_annee_accademique">
                        <option value=""> Annee academique </option>
                        <option v-for="annee_accademique in annee_accademiques" :value="annee_accademique.id">{{ annee_accademique.intitule }}</option>
                </select>

                <select name="classe" id="classe" v-model="form.id_classe">
                        <option value=""> Classe </option>
                        <option v-for="classe in classes" :value="classe.id">{{ classe.type_formation.intitule }} {{ classe.nom_classe }} {{ classe.niveau }}  {{ classe.type_classe }}</option>
                </select>
                    <!-- <select name="niveau" id="niveau" v-model="form.niveau">
                        <optgroup label="Niveau">
                            <optgroup label="BTI">
                            <option value="">Niveau</option>
                            <option value="">BTI</option>
                            <option value="">BTI</option>
                            <option value="">BTI</option>
                        </optgroup>
                        <optgroup label="BTS">
                            <option value=""></option>
                        </optgroup>
                        <optgroup label="formations_continues">
                            <option value=""></option>
                        </optgroup>
                        </optgroup>
                    </select> -->

                <!-- <select name="classe" id="classe" >
                        <optgroup label="Classes">
                            <option value="prive"> Privée</option>
                        <option value="public"> Publique</option>
                        </optgroup>

                </select> -->
<!--
                <select name="filiere" id="filiere" >
                    <optgroup label="Filières">
                        <optgroup label="Département Informatique">
                        <option value="iir">Informatique Industrielle et Réseaux</option>
                        <option value="auto">Automatique</option>
                    </optgroup>
                    <optgroup label="Département Mécanique">
                        <option value=""></option>
                    </optgroup>
                    <optgroup label="Département Electrique">
                        <option value=""></option>
                    </optgroup>
                    </optgroup>
                </select> -->
<!--
                <select name="annee_academique" id="annee_academique" placeholder="Niveau">
                    <optgroup label="Année académique">
                        <optgroup label="BTI">
                    </optgroup>
                    <optgroup label="BTS">
                        <option value=""></option>
                    </optgroup>
                    <optgroup label="formations_continues">
                        <option value=""></option>
                    </optgroup>
                    </optgroup>
                </select> -->
            </div>

           <!--  <div class="fichiers">
                <p><span class="str">*</span> Photocopie diplôme (Bac ou BFEM) </p>
                <p><span class="str">*</span> Photocopie carte nationale d'identité</p>
                <p><span class="str">*</span> Extrait de naissance</p>
                <label for="dossiers">Glissez vos fichiers ici <span> ( en pdf )</span>
                    <input type="file" name="dossier" id="dossier" @change="ajoutDossier" accept=".pdf">
                </label>
            </div> -->
            <!--paiement-->

            <!-- <p><span class="str">Valider <i>votre inscription</i></span> en choisissant votre moyen de paiement</p>
            <div class="paiement">
                <button>Wave</button>
                <button>Orange Money</button>
                <button>Mastercard</button>
                <button>Visa</button>
            </div> -->


            <!-- <div class="boutons">
                <button type="button">Retourner</button>
                <input type="submit" value="Valider">
            </div> -->
             <div class="boutons">
                <input  type="submit" data-close-modal  value="Ajouter">
                <button type="button" data-close-modal class="texte annuler" >Annuler</button>
            </div>
        </form>
    </div>
</template>

<script>
import bus from '../../eventBus';
import axios from 'axios';
import Form from 'vform';
   export default {
    name:"inscriptionCompenent",
    data(){
        return {
            filieres:[],
            type_formations:[],
            annee_accademiques:[],
            classes:[],
            photo:"",
            dossier:"",
            form:new Form({
                'id_tuteur':"",
                'montant':"",
                'mail_tuteur':"",
                'mail_eleve':"",
                'date_inscription':"",
                'id_eleve':"",
                'id_classe':"",
                'id_annee_accademique':"",
                'nom_eleve':"",
                'prenom_eleve':"",
                'date_naissance':"",
                'lieu_naissance':"",
                'nationalite_eleve':"",
                'nationalite_tuteur':"",
                'nom_tuteur':"",
                'prenom_tuteur':"",
                'lieu_naissance_tuteur':"",
                'date_naissance_tuteur':"",
                'genre_eleve':"",
                'genre_tuteur':"",
                'telephone_eleve':"",
                'telephone_tuteur':"",
                'contact_urgence1':"",
                'contact_urgence2':"",
                'telephone_tuteur':"",
                'adresse_eleve':"",
                'adresse_tuteur':"",
                'niveau':"",
                'filiere':"",
            }),

        }
    },

    mounted(){
        // this.get_filiere();
        this.get_classe();
        this.get_annee();
        // this.get_type_formation();

    },

    methods:{
        async soumettre(){
            const formdata = new FormData();
            formdata.append('nom_tuteur', this.form.nom_tuteur  );
            formdata.append('prenom_tuteur', this.form.prenom_tuteur  );
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


            formdata.append('nom_eleve', this.form.nom_eleve  );
            formdata.append('prenom_eleve', this.form.prenom_eleve  );
            formdata.append('lieu_naissance_eleve', this.form.lieu_naissance_eleve );
            formdata.append('date_naissance_eleve', this.form.date_naissance_eleve  );
            formdata.append('date_inscription', this.form.date_inscription );
            formdata.append('genre_eleve', this.form.genre_eleve  );
            formdata.append('adresse_eleve', this.form.adresse_eleve);
            formdata.append('telephone_eleve', this.form.telephone_eleve  );
            formdata.append('nationalite_eleve', this.form.nationalite_eleve );


            // formdata.append('montant', this.form.montant);
            formdata.append('date_inscription', this.form.date_inscription);
            formdata.append('id_classe', this.form.id_classe);
            formdata.append('id_annee_accademique', this.form.id_annee_accademique);
            formdata.append('contact_urgence1', this.form.contact_urgence1);
            formdata.append('contact_urgence2', this.form.contact_urgence2);
            // formdata.append('niveau', this.form.niveau);
            // formdata.append('filiere', this.form.filiere);

            if(this.form.nom_tuteur!=="" && this.form.prenom_tuteur!=="" && this.form.telephone_tuteur!=="" && this.form.date_naissance_tuteur!==""){
                try{
                    await axios.post('/inscription/store', formdata, {
                        headers: {
                            'Content-Type': 'multipart/form-data',
                        },

                    });
                    Swal.fire('Succes!','Inscription validé avec succés','success')
                    this.form.reset();
                    bus.emit('inscriptionAjoutee');
                }
                catch(e){
                    console.log(e)
                    Swal.fire('Erreur!','Une erreur est survenue lors de l\'enregistrement','error')
                }

            }else{
                Swal.fire('Erreur!','Veillez remplir tous les champs obligatoires','error')
            }


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

        async get_annee(){

            await axios.get('/annee_academique/index').then(response=>{
                 this.annee_accademiques=response.data.annee_academique;

            }).catch(error=>{
                    Swal.fire('Erreur!','une erreur est survenue lors de la recuperation des annee','error')
            });
        },



        async get_classe(){

            await axios.get('/classe/all').then(response=>{
                 this.classes=response.data.classe;

            }).catch(error=>{
                    Swal.fire('Erreur!','une erreur est survenue lors de la recuperation des classes','error')
            });
        },

    }
   }
</script>

<style></style>
