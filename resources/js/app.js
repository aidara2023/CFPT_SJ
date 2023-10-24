import './bootstrap';
import { createApp } from 'vue/dist/vue.esm-bundler.js';
import { Form } from 'vform';
import loginComponent from './components/auth/loginComponent.vue';
import accueilFormateurComponent from './components/formateur/accueilComponent.vue' ;
import listeNoteComponent from './components/formateur/listeNoteComponent.vue';
import profilComponent from './components/formateur/profilComponent.vue';
import inscriptionComponent from './components/eleve/inscriptionComponent.vue';
import utilisateurComponent from './components/utilisateur/utilisateurComponent.vue';
import createEleveComponent from './components/eleve/createEleveComponent.vue';

import createInfirmierComponent from './components/infirmier/createInfirmierComponent.vue';

import createCaissierComponent from './components/caissier/createCaissierComponent.vue';
import createBibliothecaireComponent from './components/bibliothecaire/createBibliothecaireComponent.vue';
import createTuteurComponent from './components/tuteur/createTuteurComponent.vue';

import createMatiereComponent from './components/matiere/createMatiereComponent.vue';
import createClasseComponent from './components/classe/createClasseComponent.vue';
import createBatimentComponent from './components/batiment/createBatimentComponent.vue';
import createSalleComponent from './components/salle/createSalleComponent.vue';
import createCourComponent from './components/cours/createCourComponent.vue';

import createSpecialiteComponent from './components/specialite/createSpecialiteComponent.vue';
import createDepartementComponent from './components/departement/createDepartementComponent.vue';
import createPartenaireComponent from './components/partenaire/createPartenaireComponent.vue';
import createConsultationComponent from './components/consultation/createConsultationComponent.vue';
import createOrganismeComponent from './components/organisme/createOrganismeComponent.vue';
import createExemplaireComponent from './components/exemplaire/createExemplaireComponent.vue';
import createEvaluationComponent from './components/evaluation/createEvaluationComponent.vue';
import createRetardComponent from './components/retard/createRetardComponent.vue';
import createParticiperComponent from './components/participer/createParticiperComponent.vue';
import createFinancerBourseComponent from './components/financer_bourse/createFinancerBourseComponent.vue';
import createUniteDeFormationComponent from './components/unite_de_formation/createUniteDeFormationComponent.vue';

import createTypeFormationComponent from './components/type_formation/createTypeFormationComponent.vue';
import listeTypeFormationComponent from './components/type_formation/listeTypeFormationComponent.vue';


import createTypeEvaluationComponent from './components/type_evaluation/createTypeEvaluationComponent.vue';
import createTypeMaterielComponent from './components/type_materiel/createTypeMaterielComponent.vue';
import createEmprunterLivreComponent from './components/emprunter_livre/createEmprunterLivreComponent.vue';
import createEmprunterMaterielComponent from './components/emprunter_materiel/createEmprunterMaterielComponent.vue';
import createRessourcePedagogiqueComponent from './components/ressource_pedagogique/createRessourcePedagogiqueComponent.vue';
import createEditeurComponent from './components/editeur/createEditeurComponent.vue';
import createEditionComponent from './components/edition/createEditionComponent.vue';
import createCategorieComponent from './components/categorie/createCategorieComponent.vue';
import createAuteurComponent from './components/auteur/createAuteurComponent.vue';
import createRayonComponent from './components/rayon/createRayonComponent.vue';
import createLivreComponent from './components/livre/createLivreComponent.vue';
import createPaiementComponent from './components/paiement/createPaiementComponent.vue';
import createAnneeComponent from './components/annee_academique/createAnneeComponent.vue';
import createSeminaireComponent from './components/seminaire/createSeminaireComponent.vue';
import createDossierMedicalComponent from './components/dossier_medical/createDossierMedicalComponent.vue';
import createServiceComponent from './components/service/createServiceComponent.vue';
import createDirectionComponent from './components/direction/createDirectionComponent.vue';
import createArchiveComponent from './components/archive/createArchiveComponent.vue';




import Swal from 'sweetalert2';
window.Form=Form;
window.Swal=Swal;

const app=createApp({})
app.component("user-login", loginComponent);
app.component("accueil-formateur", accueilFormateurComponent);
app.component("listenote-formateur", listeNoteComponent );
app.component("profil-formateur", profilComponent );
app.component("inscription-eleve", inscriptionComponent);
app.component("utilisateur-create", utilisateurComponent);
app.component("create-eleve", createEleveComponent);

app.component("create-infirmier",createInfirmierComponent);

app.component("caissier-create", createCaissierComponent);
app.component("tuteur-create", createTuteurComponent);
app.component("create-bibliothecaire", createBibliothecaireComponent);
app.component("create-matiere", createMatiereComponent);
app.component("create-classe", createClasseComponent);
app.component("create-batiment", createBatimentComponent);                      
app.component("create-salle", createSalleComponent);
app.component("create-cours", createCourComponent);


app.component("specialite-create", createSpecialiteComponent);
app.component("departement-create", createDepartementComponent);
app.component("type-evaluation-create", createTypeEvaluationComponent);
app.component("evaluation-create", createEvaluationComponent);
app.component("retard-create", createRetardComponent);
app.component("ressource-pedagogique-create", createRessourcePedagogiqueComponent);
app.component("participer-create", createParticiperComponent);
app.component("partenaire-create", createPartenaireComponent);
app.component("seminaire-create", createSeminaireComponent);

app.component("type-formation-create", createTypeFormationComponent);
app.component("type-formation-liste",listeTypeFormationComponent);

app.component("type-materiel-create", createTypeMaterielComponent);
app.component("unite-de-formation-create", createUniteDeFormationComponent);
app.component("dossier-medical-create", createDossierMedicalComponent);
app.component("exemplaire-create", createExemplaireComponent);
app.component("emprunter-livre-create", createEmprunterLivreComponent);
app.component("emprunter-materiel-create", createEmprunterMaterielComponent);
app.component("organisme-create", createOrganismeComponent);
app.component("financer-bourse-create", createFinancerBourseComponent);
app.component("consultation-create", createConsultationComponent);


app.component("editeur-create", createEditeurComponent);
app.component("edition-create", createEditionComponent);
app.component("categorie-create", createCategorieComponent);
app.component("auteur-create", createAuteurComponent);
app.component("rayon-create", createRayonComponent);
app.component("livre-create", createLivreComponent);
app.component("paiement-create", createPaiementComponent);
app.component("annee-create", createAnneeComponent);
app.component("service-create", createServiceComponent);
app.component("direction-create", createDirectionComponent);
app.component("archive-create",createArchiveComponent );
// app.compenent("comptable-create",createComptableComponent);



app.mount('#app')
