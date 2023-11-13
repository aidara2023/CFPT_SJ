import bus from '../../eventBus';
import axios from 'axios';
import Form from 'vform';

export default (await import('vue')).defineComponent({
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
'date_naissance': "",
'lieu_naissance': "",
'nationalite_eleve': "",
'nationalite_tuteur': "",
'nom_tuteur': "",
'prenom_tuteur': "",
'lieu_naissance_tuteur': "",
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
telephone_urgence_1: "",
telephone_urgence_2: "",
mail_eleve: "",
mail_tuteur: "",

id_annee_accademique_erreur: "",
id_classe_erreur: "",

erreur: "",
champ: "",
i: 0,
etatForm: false,
};
},

mounted() {
// this.get_filiere();
this.get_classe();
this.get_annee();
// this.get_type_formation();
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
// formdata.append('niveau', this.form.niveau);
// formdata.append('filiere', this.form.filiere);
if (this.form.nom_tuteur !== "" && this.form.prenom_tuteur !== "" && this.form.telephone_tuteur !== "" && this.form.date_naissance_tuteur !== "") {
try {
await axios.post('/inscription/store', formdata, {
headers: {
'Content-Type': 'multipart/form-data',
},
});
/*  Swal.fire('Succes!','Inscription validé avec succés','success') */
this.form.reset();
bus.emit('inscriptionAjoutee');
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
console.log(e);
Swal.fire('Erreur!', 'Une erreur est survenue lors de l\'enregistrement', 'error');
}

} else {
Swal.fire('Erreur!', 'Veillez remplir tous les champs obligatoires', 'error');
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

getImageUrl() {
const timestamp = new Date().getTime();
return this.photo ? `${window.location.origin}/image/${this.photo.name}?t=${timestamp}` : '';
},

async get_annee() {

await axios.get('/annee_academique/index').then(response => {
this.annee_accademiques = response.data.annee_academique;

}).catch(error => {
Swal.fire('Erreur!', 'une erreur est survenue lors de la recuperation des annee', 'error');
});
},



async get_classe() {

await axios.get('/classe/all').then(response => {
this.classes = response.data.classe;

}).catch(error => {
Swal.fire('Erreur!', 'une erreur est survenue lors de la recuperation des classes', 'error');
});
},

validerAvantAjout() {
// Exécutez la validation des champs
const isIdChampValid = this.validatedataold();
/*   console.log(isNomChampValid); */
if (isVerifIdValid) {
this.etatForm = false;
console.log(erreur);
return 0;
} else {
this.soumettre();
this.etatForm = true;
console.log(Tokkos);
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
const phoneRegex = /^\d{10}$/; // Format : 10 chiffres

return phoneRegex.test(phoneNumber);
},

validatedata(champ) {
// Réinitialiser les erreurs pour le champ actuel
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


this.adresse_erreur = "";
this.telephone_tuteur_erreur = "";
this.telephone_eleve_erreur = "";
this.telephone_urgence_1 = "";
this.telephone_urgence_2 = "";
this.mail_eleve = "";
this.mail_tuteur = "";

this.id_annee_accademique_erreur = "";
this.id_classe_erreur = "";

var i = 0;

switch (champ) {
case 'nom_eleve':
// Effectuez la validation pour le champ 'nom'
if (this.form.nom_eleve === "") {
this.nom_eleve_erreur = "Ce champ est obligatoire";
i = 1;
return true;

}
if (!this.verifCaratere(this.form.nom_eleve)) {
this.nom_eleve_erreur = "Ce champ ne peut comporter que des lettres et des espaces";
/* this.erreur= "Ce champ ne peut comporter que des lettres et des espaces" */
i = 1;
return true;
}
// Ajoutez d'autres validations si nécessaire
break;
case 'nom_tuteur':
// Effectuez la validation pour le champ 'nom'
if (this.form.nom_tuteur === "") {
this.nom_tuteur_erreur = "Ce champ est obligatoire";
i = 1;
return true;

}
if (!this.verifCaratere(this.form.nom_tuteur)) {
this.nom_tuteur_erreur = "Ce champ ne peut comporter que des lettres et des espaces";
/* this.erreur= "Ce champ ne peut comporter que des lettres et des espaces" */
i = 1;
return true;
}
// Ajoutez d'autres validations si nécessaire
break;
case 'prenom_eleve':
// Effectuez la validation pour le champ 'nom'
if (this.form.prenom_eleve === "") {
this.prenom_eleve_erreur = "Ce champ est obligatoire";
i = 1;
return true;

}
if (!this.verifCaratere(this.form.prenom_eleve)) {
this.prenom_eleve_erreur = "Ce champ ne peut comporter que des lettres et des espaces";
/* this.erreur= "Ce champ ne peut comporter que des lettres et des espaces" */
i = 1;
return true;
}
// Ajoutez d'autres validations si nécessaire
break;
case 'prenom_tuteur':
// Effectuez la validation pour le champ 'nom'
if (this.form.prenom_tuteur === "") {
this.prenom_tuteur_erreur = "Ce champ est obligatoire";
i = 1;
return true;

}
if (!this.verifCaratere(this.form.prenom_tuteur)) {
this.prenom_tuteur_erreur = "Ce champ ne peut comporter que des lettres et des espaces";
/* this.erreur= "Ce champ ne peut comporter que des lettres et des espaces" */
i = 1;
return true;
}
// Ajoutez d'autres validations si nécessaire
break;

case 'adresse_eleve':
//pour adresse
if (this.form.adresse_eleve === "") {
this.adresse_eleve_erreur = "Ce champ est obligatoire";
i = 1;
return true;

}
break;
case 'adresse_tuteur':
//pour adresse
if (this.form.adresse_tuteur === "") {
this.adresse_tuteur_erreur = "Ce champ est obligatoire";
i = 1;
return true;

}
break;
case 'date_naissance_eleve':
// Vérification de la date de naissance
if (this.form.date_naissance_eleve === "") {
this.date_naissance_eleve_erreur = "La date de naissance est obligatoire";
i = 1;
return true;
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
return true;
} if (dateNaissance > dateActuelle) {
this.date_erreur = "La date de naissance ne peut pas être dans le futur";
i = 1;
return true;
}
break;
}
case 'date_naissance_tuteur':
//pour lieu de naissance
if (this.form.date_naissance_tuteur === "") {
this.date_naissance_tuteur_erreur = "Ce champ est obligatoire";
i = 1;
return true;
}
if (!this.verifCaratere(this.form.date_naissance_tuteur)) {
this.date_naissance_tuteur_erreur = "Ce champ ne peut comporter que des lettres et des espaces";
i = 1;
return true;
}
break;
case 'nationalite_eleve':
//pour nationalite
if (this.form.nationalite_eleve === "") {
this.nationalite_eleve_erreur = "Ce champ est obligatoire";
i = 1;
return true;
}
if (!this.verifCaratere(this.form.nationalite_eleve)) {
this.nationalite_eleve_erreur = "Ce champ ne peut comporter que des lettres et des espaces";
i = 1;
return true;
}
break;
case 'nationalite_tuteur':
//pour nationalite
if (this.form.nationalite_tuteur === "") {
this.nationalite_tuteur_erreur = "Ce champ est obligatoire";
i = 1;
return true;
}
if (!this.verifCaratere(this.form.nationalite_tuteur)) {
this.nationalite_tuteur_erreur = "Ce champ ne peut comporter que des lettres et des espaces";
i = 1;
return true;
}
break;
case 'email':
//Vérification de l' email
if (this.form.email === "") {
this.email_user_erreur = "L'email est obligatoire";
i = 1;
return true;
} else {
if (!this.validateEmail(this.form.email)) {
this.email_user_erreur = "L'email n'est pas valide";
i = 1;
return true;
}
}
break;
case 'date_naissance':
// Vérification de la date de naissance
if (this.form.date_naissance === "") {
this.date_erreur = "La date de naissance est obligatoire";
i = 1;
return true;
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
return true;
} if (dateNaissance > dateActuelle) {
this.date_erreur = "La date de naissance ne peut pas être dans le futur";
i = 1;
return true;
}

}
break;
case 'telephone':
//Vérification du numero de telephone
if (this.form.telephone === "") {
this.telephone_erreur = "Le numéro de téléphone est obligatoire";
i = 1;
return true;
} else if (!this.validatePhoneNumber(this.form.telephone)) {
this.telephone_erreur = "Le numéro de téléphone n'est pas valide";
i = 1;
return true;
}
break;
case 'role':
//Vérification de role
if (this.form.id_role === "") {
this.id_role_erreur = "Vous avez oublié de sélectionner le role ";
i = 1;
return true;
}
break;

case 'genre':
//Vérification de matrimoniale
if (this.form.genre === "") {
this.genre_erreur = "Vous avez oublié de sélectionner le genre ";
i = 1;
return true;
}
break;

case 'type':
//Vérification de type
if (this.form.id_type === "") {
this.id_type_erreur = "Vous avez oublié de sélectionner le type ";
i = 1;
return true;
}
break;

case 'service':
//Vérification deservice
if (this.form.id_service === "") {
this.id_service_erreur = "Vous avez oublié de sélectionner le chef de service";
i = 1;
return true;
}

break;

case 'specialite':
//Vérification de spécialité
if (this.form.id_specialite === "") {
this.id_specialite_erreur = "Vous avez oublié de sélectionner la specialité";
i = 1;
return true;
}
break;
case 'situation_matrimoniale':
//Vérification de matrimoniale
if (this.form.situation_matrimoniale === "") {
this.situation_matrimoniale_erreur = "Vous avez oublié de sélectionner le statut ";
i = 1;
return true;
}
break;
case 'departement':
//Vérification de departement
if (this.form.id_departement === "") {
this.id_departement_erreur = "Vous avez oublié de sélectionner le départrement";
i = 1;
return true;
}
break;

default:
break;
}
},

validatedataold() {
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
this.nom_user_erreur = "Ce champ est obligatoire";
/*   this.erreur= "Ce champ est obligatoire" */
i = 1;

}
if (!this.verifCaratere(this.form.nom)) {
this.nom_user_erreur = "Ce champ ne peut comporter que des lettres et des espaces";
/* this.erreur= "Ce champ ne peut comporter que des lettres et des espaces" */
i = 1;
}

//pour prenom
if (this.form.prenom === "") {
this.prenom_user_erreur = "Ce champ est obligatoire";
/*     this.erreur= "Ce champ est obligatoire" */
i = 1;
}
if (!this.verifCaratere(this.form.prenom)) {
this.prenom_user_erreur = "Ce champ ne peut comporter que des lettres et des espaces";
/*  this.erreur= "Ce champ ne peut comporter que des lettres et des espaces" */
i = 1;
}


//pour adresse
if (this.form.adresse === "") {
this.adresse_erreur = "Ce champ est obligatoire";
i = 1;
}


//pour lieu de naissance
if (this.form.lieu_naissance === "") {
this.lieu_naissance_erreur = "Ce champ est obligatoire";
i = 1;
}
if (!this.verifCaratere(this.form.lieu_naissance)) {
this.lieu_naissance_erreur = "Ce champ ne peut comporter que des lettres et des espaces";
i = 1;
}

//pour nationalite
if (this.form.nationalite === "") {
this.nationalite_erreur = "Ce champ est obligatoire";
i = 1;
}
if (!this.verifCaratere(this.form.nationalite)) {
this.nationalite_erreur = "Ce champ ne peut comporter que des lettres et des espaces";
i = 1;
}

//Vérification de l' email
if (this.form.email === "") {
this.email_user_erreur = "L'email est obligatoire";
i = 1;
} else {
if (!this.validateEmail(this.form.email)) {
this.email_user_erreur = "L'email n'est pas valide";
i = 1;
}
}

// Vérification de la date de naissance
if (this.form.date_naissance_eleve === "") {
this.date_naissance_eleve_erreur = "La date de naissance est obligatoire";
i = 1;
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
} if (dateNaissance > dateActuelle) {
this.datenaissance_eleve_erreur = "La date de naissance ne peut pas être dans le futur";
i = 1;
return true;
}

}

if (this.form.id_role === "") {
this.id_role_erreur = "Vous avez oublié de sélectionner le role ";
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

if (this.interesser == 4) {
if (this.form.id_service === "") {
this.id_service_erreur = "Vous avez oublié de sélectionner le chef de service";
i = 1;
}
}
if (this.interesser == 6) {
if (this.form.id_specialite === "") {
this.id_specialite_erreur = "Vous avez oublié de sélectionner la specialité";
i = 1;
}
if (this.form.situation_matrimoniale === "") {
this.situation_matrimoniale_erreur = "Vous avez oublié de sélectionner le statut ";
i = 1;
}
if (this.form.id_departement === "") {
this.id_departement_erreur = "Vous avez oublié de sélectionner le département";
i = 1;
}
if (this.form.type === "") {
this.type_erreur = "Vous avez oublié de sélectionner le type ";
i = 1;
}
}

if (i == 1) return true;

return false;

},
}
});
