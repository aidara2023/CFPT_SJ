<?php

use App\Http\Controllers\annee_academique\annee_academique_controller;
use App\Http\Controllers\archive\archive_controller;
use App\Http\Controllers\auteur\auteur_controller;
use App\Http\Controllers\bibliothecaire\bibliothecaire_controller;
use App\Http\Controllers\bibliothecaire\bibliothecaire_view_controller;
use App\Http\Controllers\categorie\categorie_controller;
use App\Http\Controllers\date_emprunter\date_emprunter_controller;
use App\Http\Controllers\departement\departement_controller;
use App\Http\Controllers\dossier_medical\dossier_medical_controller;
use App\Http\Controllers\editeur\editeur_controller;
use App\Http\Controllers\edition\edition_controller;
use App\Http\Controllers\eleve\eleve_controller;
use App\Http\Controllers\eleve\eleve_view_controller;
use App\Http\Controllers\emprunter_livre\emprunter_livre_controller;
use App\Http\Controllers\examplaire\exemplaire_controller;
use App\Http\Controllers\financer_bourse\financer_bourse_controller;
use App\Http\Controllers\infirmier\infirmier_controller;
use App\Http\Controllers\livre\livre_controller;
use App\Http\Controllers\login\login_view_controller;
use App\Http\Controllers\materiel\materiel_controller;
use App\Http\Controllers\caissier\caissier_controller;
use App\Http\Controllers\consultation\consultation_controller;
use App\Http\Controllers\cours\cours_controller;
use App\Http\Controllers\emprunter_materiel\emprunter_materiel_controller;
use App\Http\Controllers\Formateur\formateur_controller;
use App\Http\Controllers\Formateur\formateur_view_controller;
use App\Http\Controllers\inscription\inscription_controller;
use App\Http\Controllers\matiere\matiere_controller;
use App\Http\Controllers\note\note_controller;
use App\Http\Controllers\organisme\organisme_controller;
use App\Http\Controllers\paiement\paiement_controller;
use App\Http\Controllers\partenaire\partenaire_controller;
use App\Http\Controllers\participer\participer_controller;
use App\Http\Controllers\rayon\rayon_controller;
use App\Http\Controllers\ressource_pedagogique\ressource_pedagogique_controller;
use App\Http\Controllers\role\role_controller;
use App\Http\Controllers\seminaire\seminaire_controller;
use App\Http\Controllers\service\service_controller;
use App\Http\Controllers\specialite\specialite_controller;
use App\Http\Controllers\tuteur\tuteur_controller;
use App\Http\Controllers\type_formation\type_formation_controller;
use App\Http\Controllers\unite_de_formation\unite_de_formation_controller;
use Illuminate\Support\Facades\Route;



use App\Http\Controllers\type_materiel\type_materiel_controller;
use App\Http\Controllers\user\user_controller;
use App\Http\Controllers\user\user_view_controller;
use App\Http\Controllers\user\userViewController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//Route de matiere

Route::get('matiere/index', [matiere_controller::class, 'index'])->name('matiere_index');
Route::post('matiere/store',[matiere_controller::class, 'store'])->name('matiere_store');
Route::put('matiere/update/{id}', [matiere_controller::class, 'update'])->name('matiere_update');
Route::delete('matiere/delete/{id}',[matiere_controller::class, 'delete'])->name('matiere_delete');
Route::get('matiere/get/{id}',[matiere_controller::class, 'get'])->name('matiere_get');


Route::get('annee_academique/index', [annee_academique_controller::class, 'index']) -> name('annee_academique_index');
Route::get('annee_academique/ajouter', [annee_academique_controller::class, 'ajouter']) -> name('annee_academique_ajouter');
Route::get('annee_academique/mise_a_jour', [annee_academique_controller::class, 'mise_a_jour']) -> name('annee_academique_mise_a_jour');
Route::get('annee_academique/delete', [annee_academique_controller::class, 'delete']) -> name('annee_academique_delete');
Route::get('annee_academique/show', [annee_academique_controller::class, 'show']) -> name('annee_academique_show');
//Route de Organisme

Route::get('organisme/index', [organisme_controller::class, 'index'])->name('organisme_index');
Route::post('organisme/store',[organisme_controller::class, 'store'])->name('organisme_store');
Route::put('organisme/update/{id}', [organisme_controller::class, 'update'])->name('organisme_update');
Route::delete('organisme/delete/{id}',[organisme_controller::class, 'delete'])->name('organisme_delete');
Route::get('organisme/get/{id}',[organisme_controller::class, 'get'])->name('organisme_get');


//Route de dossier medical 

Route::get('dossier_medical/index', [dossier_medical_controller::class, 'index'])->name('dossier_medical_index');
Route::post('dossier_medical/store',[dossier_medical_controller::class, 'store'])->name('dossier_medical_store');
Route::put('dossier_medical/update/{id}', [dossier_medical_controller::class, 'update'])->name('dossier_medical_update');
Route::delete('dossier_medical/delete/{id}',[dossier_medical_controller::class, 'delete'])->name('dossier_medical_delete');
Route::get('dossier_medical/get/{id}',[dossier_medical_controller::class, 'get'])->name('dossier_medical_get');


//Route de infirmier

Route::get('infirmier/index', [infirmier_controller::class, 'index'])->name('infirmier_index');
Route::post('infirmier/store',[infirmier_controller::class, 'store'])->name('infirmier_store');
Route::put('infirmier/update/{id}', [infirmier_controller::class, 'update'])->name('infirmier_update');
Route::delete('infirmier/delete/{id}',[infirmier_controller::class, 'delete'])->name('infirmier_delete');
Route::get('infirmier/get/{id}',[infirmier_controller::class, 'get'])->name('infirmier_get');


//Route unite de formation

Route::get('unite_de_formation/index', [unite_de_formation_controller::class, 'index'])->name('unite_de_formation_index');
Route::post('unite_de_formation/store',[unite_de_formation_controller::class, 'store'])->name('unite_de_formation_store');
Route::put('unite_de_formation/update/{id}', [unite_de_formation_controller::class, 'update'])->name('unite_de_formation_update');
Route::delete('unite_de_formation/delete/{id}',[unite_de_formation_controller::class, 'delete'])->name('unite_de_formation_delete');
Route::get('unite_de_formation/get/{id}',[unite_de_formation_controller::class, 'get'])->name('unite_de_formation_get');


//route eleve 
Route::get('eleve/index',[eleve_controller::class, 'index'])->name('eleve_index');
Route::post('eleve/store',[eleve_controller::class, 'store'])->name('eleve_store');
Route::get('eleve/show/{id}',[eleve_controller::class, 'show'])->name('eleve_show');
Route::put('eleve/update/{id}',[eleve_controller::class, 'update'])->name('eleve_update');
Route::delete('eleve/delete/{id}',[eleve_controller::class, 'destroy'])->name('eleve_delete');

Route::get('/eleve/inscription',[eleve_view_controller::class, 'inscription'])->name('eleve_inscription');
Route::get('/eleve/create',[eleve_view_controller::class, 'create'])->name('eleve_create');

//route emprunter livre 
Route::get('emprunter_livre/index',[emprunter_livre_controller::class, 'index'])->name('emprunter_livre_index');
Route::post('emprunter_livre/store',[emprunter_livre_controller::class, 'store'])->name('emprunter_livre_store');
Route::get('emprunter_livre/show/{id}',[emprunter_livre_controller::class, 'show'])->name('emprunter_livre_show');
Route::put('emprunter_livre/update/{id}',[emprunter_livre_controller::class, 'update'])->name('emprunter_livre_update');
Route::delete('emprunter_livre/delete/{id}',[emprunter_livre_controller::class, 'destroy'])->name('emprunter_livre_delete');
Route::put('emprunter_livre/rendre/{id}',[emprunter_livre_controller::class, 'rendre'])->name('emprunter_livre_rendre');


//route type de formation
Route::get('type_formation/index',[type_formation_controller::class, 'index'])->name('type_formation_index');
Route::post('type_formation/store',[type_formation_controller::class, 'store'])->name('type_formation_store');
Route::get('type_formation/show/{id}',[type_formation_controller::class, 'show'])->name('type_formation_show');
Route::put('type_formation/update/{id}',[type_formation_controller::class, 'update'])->name('type_formation_update');
Route::delete('type_formation/delete/{id}',[type_formation_controller::class, 'destroy'])->name('type_formation_delete');

//route evaluation
Route::get('type_evaluation/index',[partenaire_controller::class, 'index'])->name('partenaire_index');
Route::post('type_evaluation/store',[partenaire_controller::class, 'store'])->name('partenaire_store');
Route::get('type_evaluation/show/{id}',[partenaire_controller::class, 'show'])->name('partenaire_show');
Route::put('type_evaluation/update/{id}',[partenaire_controller::class, 'update'])->name('partenaire_update');
Route::delete('type_evaluation/delete/{id}',[partenaire_controller::class, 'destroy'])->name('partenaire_delete');

//route partenaire 
Route::get('partenaire/index',[partenaire_controller::class, 'index'])->name('partenaire_index');
Route::post('partenaire/store',[partenaire_controller::class, 'store'])->name('partenaire_store');
Route::get('partenaire/show/{id}',[partenaire_controller::class, 'show'])->name('partenaire_show');
Route::put('partenaire/update/{id}',[partenaire_controller::class, 'update'])->name('partenaire_update');
Route::delete('partenaire/delete/{id}',[partenaire_controller::class, 'destroy'])->name('partenaire_delete');

//route materiel
Route::get('materiel/index',[materiel_controller::class, 'index'])->name('materiel_index');
Route::post('materiel/store',[materiel_controller::class, 'store'])->name('materiel_store');
Route::get('materiel/show/{id}',[materiel_controller::class, 'show'])->name('materiel_show');
Route::put('materiel/update/{id}',[materiel_controller::class, 'update'])->name('materiel_update');
Route::delete('materiel/delete/{id}',[materiel_controller::class, 'estroy'])->name('materiel_delete');

//route seminaire
Route::get('seminaire/index',[seminaire_controller::class, 'index'])->name('seminaire_index');
Route::post('seminaire/store',[seminaire_controller::class, 'store'])->name('seminaire_store');
Route::get('seminaire/show/{id}',[seminaire_controller::class, 'show'])->name('seminaire_show');
Route::put('seminaire/update/{id}',[seminaire_controller::class, 'update'])->name('seminaire_update');
Route::delete('seminaire/delete/{id}',[seminaire_controller::class, 'destroy'])->name('seminaire_delete');



//route participer
Route::get('participer/index',[participer_controller::class, 'index'])->name('participer_index');
Route::post('participer/store',[participer_controller::class, 'store'])->name('participer_store');
Route::get('participer/show/{id}',[participer_controller::class, 'show'])->name('participer_show');
Route::put('participer/update/{id}',[participer_controller::class, 'update'])->name('participer_update');
Route::delete('participer/delete/{id}',[participer_controller::class, 'destroy'])->name('participer_delete');

//route specialite
Route::get('specialite/index',[specialite_controller::class, 'index'])->name('specialite_index');
Route::post('specialite/store',[specialite_controller::class, 'store'])->name('specialite_store');
Route::get('specialite/show/{id}',[specialite_controller::class, 'show'])->name('specialite_show');
Route::put('specialite/update/{id}',[specialite_controller::class, 'update'])->name('specialite_update');
Route::delete('specialite/delete/{id}',[specialite_controller::class, 'destroy'])->name('specialite_delete');

//route annee_academique
Route::get('annee_academique/index',[annee_academique_controller::class, 'index'])->name('annee_academique_index');
Route::post('annee_academique/store',[annee_academique_controller::class, 'store'])->name('annee_academique_store');
Route::get('annee_academique/show/{id}',[annee_academique_controller::class, 'show'])->name('annee_academique_show');
Route::put('annee_academique/update/{id}',[annee_academique_controller::class, 'update'])->name('annee_academique_update');
Route::delete('annee_academique/delete/{id}',[annee_academique_controller::class, 'destroy'])->name('annee_academique_delete');

//route departement
Route::get('departement/index',[departement_controller::class, 'index'])->name('departement_index');
Route::post('departement/store',[departement_controller::class, 'store'])->name('departement_store');
Route::get('departement/show/{id}',[departement_controller::class, 'show'])->name('departement_show');
Route::put('departement/update/{id}',[departement_controller::class, 'update'])->name('departement_update');
Route::delete('departement/delete/{id}',[departement_controller::class, 'destroy'])->name('departement_delete');

//route tuteur
Route::get('tuteur/index',[tuteur_controller::class, 'index'])->name('tuteur_index');
Route::post('tuteur/store',[tuteur_controller::class, 'store'])->name('tuteur_store');
Route::get('tuteur/show/{id}',[tuteur_controller::class, 'show'])->name('tuteur_show');
Route::put('tuteur/update/{id}',[tuteur_controller::class, 'update'])->name('tuteur_update');
Route::delete('tuteur/delete/{id}',[tuteur_controller::class, 'destroy'])->name('tuteur_delete');

//route paiement
Route::get('paiement/index',[paiement_controller::class, 'index'])->name('paiement_index');
Route::post('paiement/store',[paiement_controller::class, 'store'])->name('paiement_store');
Route::get('paiement/show/{id}',[paiement_controller::class, 'show'])->name('paiement_show');
Route::put('paiement/update/{id}',[paiement_controller::class, 'update'])->name('paiement_update');
Route::delete('paiement/delete/{id}',[paiement_controller::class, 'destroy'])->name('paiement_delete');

//route livre
Route::get('livre/index',[livre_controller::class, 'index'])->name('livre_index');
Route::post('livre/store',[livre_controller::class, 'store'])->name('livre_store');
Route::get('livre/show/{id}',[livre_controller::class, 'show'])->name('livre_show');
Route::put('livre/update/{id}',[livre_controller::class, 'update'])->name('livre_update');
Route::delete('livre/delete/{id}',[livre_controller::class, 'delete'])->name('livre_delete');

//route editeur
Route::get('editeur/index',[editeur_controller::class, 'index'])->name('editeur_index');
Route::post('editeur/store',[editeur_controller::class, 'store'])->name('editeur_store');
Route::get('editeur/show/{id}',[editeur_controller::class, 'show'])->name('editeur_show');
Route::put('editeur/update/{id}',[editeur_controller::class, 'update'])->name('editeur_update');
Route::delete('editeur/delete/{id}',[editeur_controller::class, 'delete'])->name('editeur_delete');

//route auteur
Route::get('auteur/index', [auteur_controller::class, 'index']) -> name('auteur_index');
Route::get('auteur/ajouter', [auteur_controller::class, 'ajouter']) -> name('auteur_ajouter');
Route::get('auteur/mise_a_jour/{id}', [auteur_controller::class, 'mise_a_jour']) -> name('auteur_mise_a_jour');
Route::get('auteur/delete/{id}', [auteur_controller::class, 'delete']) -> name('auteur_delete');
Route::get('auteur/show/{id}', [auteur_controller::class, 'show']) -> name('auteur_show');

//route rayon
Route::get('rayon/index',[rayon_controller::class, 'index'])->name('rayon_index');
Route::post('rayon/store',[rayon_controller::class, 'store'])->name('rayon_store');
Route::get('rayon/show/{id}',[rayon_controller::class, 'show'])->name('rayon_show');
Route::put('rayon/update/{id}',[rayon_controller::class, 'update'])->name('rayon_update');
Route::delete('rayon/delete/{id}',[rayon_controller::class, 'delete'])->name('rayon_delete');

//route categorie
Route::get('categorie/index',[categorie_controller::class, 'index'])->name('categorie_index');
Route::post('categorie/store',[categorie_controller::class, 'store'])->name('categorie_store');
Route::get('categorie/show/{id}',[categorie_controller::class, 'show'])->name('categorie_show');
Route::put('categorie/update/{id}',[categorie_controller::class, 'update'])->name('categorie_update');
Route::delete('categorie/delete/{id}',[categorie_controller::class, 'delete'])->name('categorie_delete');

//route bibliothecaire
Route::get('bibliothecaire/index',[bibliothecaire_controller::class, 'index'])->name('bibliothecaire_index');
Route::post('bibliothecaire/store',[bibliothecaire_controller::class, 'store'])->name('bibliothecaire_store');
Route::get('bibliothecaire/show/{id}',[bibliothecaire_controller::class, 'show'])->name('bibliothecaire_show');
Route::put('bibliothecaire/update/{id}',[bibliothecaire_controller::class, 'update'])->name('bibliothecaire_update');
Route::delete('bibliothecaire/delete/{id}',[bibliothecaire_controller::class, 'delete'])->name('bibliothecaire_delete');


Route::get('/bibliothecaire',[bibliothecaire_view_controller::class, 'create'])->name('bibliothecaire_create');



//route exemplaire
Route::get('exemplaire/index',[exemplaire_controller::class, 'index'])->name('exemplaire_index');
Route::post('exemplaire/store',[exemplaire_controller::class, 'store'])->name('exemplaire_store');
Route::get('exemplaire/show/{id}',[exemplaire_controller::class, 'show'])->name('exemplaire_show');
Route::put('exemplaire/update/{id}',[exemplaire_controller::class, 'update'])->name('exemplaire_update');
Route::delete('exemplaire/delete/{id}',[exemplaire_controller::class, 'delete'])->name('exemplaire_delete');

//route ressource_pedagogique
Route::get('ressource_pedagogique/index',[ressource_pedagogique_controller::class, 'index'])->name('ressource_pedagogique_index');
Route::post('ressource_pedagogique/store',[ressource_pedagogique_controller::class, 'store'])->name('ressource_pedagogique_store');
Route::get('ressource_pedagogique/show/{id}',[ressource_pedagogique_controller::class, 'show'])->name('ressource_pedagogique_show');
Route::put('ressource_pedagogique/update/{id}',[ressource_pedagogique_controller::class, 'update'])->name('ressource_pedagogique_update');
Route::delete('ressource_pedagogique/delete/{id}',[ressource_pedagogique_controller::class, 'delete'])->name('ressource_pedagogique_delete');


//route archive
Route::get('archive/index',[archive_controller::class, 'index'])->name('archive_index');
Route::post('archive/store',[archive_controller::class, 'store'])->name('archive_store');
Route::get('archive/show/{id}',[archive_controller::class, 'show'])->name('archive_show');
Route::put('archive/update/{id}',[archive_controller::class, 'update'])->name('archive_update');
Route::delete('archive/delete/{id}',[archive_controller::class, 'delete'])->name('archive_delete');

//route date_emprunter
Route::get('date_emprunter/index',[date_emprunter_controller::class, 'index'])->name('date_emprunter_index');
Route::post('date_emprunter/store',[date_emprunter_controller::class, 'store'])->name('date_emprunter_store');
Route::get('date_emprunter/show/{id}',[date_emprunter_controller::class, 'show'])->name('date_emprunter_show');
Route::put('date_emprunter/update/{id}',[date_emprunter_controller::class, 'update'])->name('date_emprunter_update');
Route::delete('date_emprunter/delete/{id}',[date_emprunter_controller::class, 'delete'])->name('date_emprunter_delete');

//route edition
Route::get('edition/index',[edition_controller::class, 'index'])->name('edition_index');
Route::post('edition/store',[edition_controller::class, 'store'])->name('edition_store');
Route::get('edition/show/{id}',[edition_controller::class, 'show'])->name('edition_show');
Route::put('edition/update/{id}',[edition_controller::class, 'update'])->name('edition_update');
Route::delete('edition/delete/{id}',[edition_controller::class, 'delete'])->name('edition_delete');

//route financer_bourse
Route::get('financer_bourse/index',[financer_bourse_controller::class, 'index'])->name('financer_bourse_index');
Route::post('financer_bourse/store',[financer_bourse_controller::class, 'store'])->name('financer_bourse_store');
Route::get('financer_bourse/show/{id}',[financer_bourse_controller::class, 'show'])->name('financer_bourse_show');
Route::put('financer_bourse/update/{id}',[financer_bourse_controller::class, 'update'])->name('financer_bourse_update');
Route::delete('financer_bourse/delete/{id}',[financer_bourse_controller::class, 'delete'])->name('financer_bourse_delete');

//type materiel

Route::get('Type_materiel/index',[type_materiel_controller::class, 'index'])->name('type_materiel_index');
Route::post('type_materiel/store',[type_materiel_controller::class, 'store'])->name('type_materiel_store');
Route::get('type_materiel/show/{$id}',[type_materiel_controller::class,'show'])->name('type_materiel_show');
Route::put('type_materiel/update/{$id}',[type_materiel_controller::class,'update'])->name('type_materiel_update');
Route::delete('type_materiel/delete/{$id}',[type_materiel_controller::class, 'delete'])->name('type_materiel_delete');

//Route pour caissier
Route::get('caissier/index',[caissier_controller::class, 'index'])->name('caissier_index');
Route::post('caissier/store',[caissier_controller::class, 'store'])->name('caissier_store');
Route::get('caissier/show/{$id}',[caissier_controller::class,'show'])->name('caissier_show');
Route::put('caissier/update/{$id}',[caissier_controller::class,'update'])->name('caissier_update');
Route::delete('caissier/delete/{$id}',[caissier_controller::class, 'delete'])->name('caissier_delete');

//Route pour note

Route::get('note/index',[note_controller::class, 'index'])->name('note_index');
Route::post('note/store',[note_controller::class, 'store'])->name('note_store');
Route::get('note/show/{$id}',[note_controller::class,'show'])->name('note_show');
Route::put('note/update/{$id}',[note_controller::class,'update'])->name('note_update');
Route::delete('note/delete/{$id}',[note_controller::class, 'delete'])->name('note_delete');

//Route pour cour

Route::get('cour/index',[cours_controller::class, 'index'])->name('cour_index');
Route::post('cour/store',[cours_controller::class, 'store'])->name('cour_store');
Route::get('cour/show/{$id}',[cours_controller::class,'show'])->name('cour_show');
Route::put('cour/update/{$id}',[cours_controller::class,'update'])->name('cour_update');
Route::delete('cour/delete/{$id}',[cours_controller::class, 'delete'])->name('cour_delete');

//Route pourinscription

Route::get('inscription/index',[inscription_controller::class, 'index'])->name('inscription_index');
Route::post('inscription/store',[inscription_controller::class, 'store'])->name('inscription_store');
Route::get('inscription/show/{$id}',[inscription_controller::class,'show'])->name('inscription_show');
Route::put('inscription/update/{$id}',[inscription_controller::class,'update'])->name('inscription_update');
Route::delete('inscription/delete/{$id}',[inscription_controller::class, 'delete'])->name('inscription_delete');

//Route pour emprunter materiel

Route::get('emprunter_materiel/index',[emprunter_materiel_controller::class, 'index'])->name('emprunter_materiel_index');
Route::post('emprunter_materiel/store',[emprunter_materiel_controller::class, 'store'])->name('emprunter_materiel_store');
Route::get('emprunter_materiel/show/{$id}',[emprunter_materiel_controller::class,'show'])->name('emprunter_materiel_show');
Route::put('emprunter_materiel/update/{$id}',[emprunter_materiel_controller::class,'update'])->name('emprunter_materiel_update');
Route::delete('emprunter_materiel/delete/{$id}',[emprunter_materiel_controller::class, 'delete'])->name('emprunter_materiel_delete');

//Route pour consultation

Route::get('consultation/index',[consultation_controller::class, 'index'])->name('consultation_index');
Route::post('consultation/store',[consultation_controller::class, 'store'])->name('consultation_store');
Route::get('consultation/show/{$id}',[consultation_controller::class,'show'])->name('consultation_show');
Route::put('consultation/update/{$id}',[consultation_controller::class,'update'])->name('consultation_update');
Route::delete('consultation/delete/{$id}',[consultation_controller::class, 'delete'])->name('consultation_delete');

//Route pour inscription

Route::get('inscription/index',[inscription_controller::class, 'index'])->name('inscription_index');
Route::post('inscription/store',[inscription_controller::class, 'store'])->name('inscription_store');
Route::get('inscription/show/{$id}',[inscription_controller::class,'show'])->name('inscription_show');
Route::put('inscription/update/{$id}',[inscription_controller::class,'update'])->name('inscription_update');
Route::delete('inscription/delete/{$id}',[inscription_controller::class, 'delete'])->name('inscription_delete');

//Route pour formateur

Route::get('formateur/index',[formateur_controller::class, 'index'])->name('formateur_index');
Route::post('formateur/store',[formateur_controller::class, 'store'])->name('formateur_store');
Route::get('formateur/show/{$id}',[formateur_controller::class,'show'])->name('formateur_show');
Route::put('formateur/update/{$id}',[formateur_controller::class,'update'])->name('formateur_update');
Route::delete('formateur/delete/{$id}',[formateur_controller::class, 'delete'])->name('formateur_delete');

Route::get('/formateur',[formateur_view_controller::class, 'accueil'])->name('formateur_accueil');
Route::get('/formateur/liste_note',[formateur_view_controller::class, 'liste_note'])->name('formateur_liste_note');
Route::get('/formateur/profil',[formateur_view_controller::class, 'profil'])->name('formateur_profil');
Route::get('/formateur/cours',[formateur_view_controller::class, 'cours'])->name('formateur_cours');
//Route pour la connexion
Route::post('/connexion',[connexion_controller::class,'connexion'])->name('connexion');

//Route pour utilisateur


Route::get('utilisateur/create', [user_view_controller::class, 'create'])->name('utilisateur_create');

Route::get('user/index',[user_controller::class, 'index'])->name('user_index');
Route::post('user/store',[user_controller::class, 'store'])->name('user_store');
Route::get('user/show/{id}',[user_controller::class, 'show'])->name('user_show');
Route::put('user/update/{id}',[user_controller::class, 'update'])->name('user_update');
Route::delete('user/delete/{id}',[user_controller::class, 'destroy'])->name('user_delete');

//Route pour role

Route::get('roles/index', [role_controller::class, 'index'])->name('role_index');



//Route pour service

Route::get('service/index' ,[service_controller::class, 'index'])->name('service_index');



