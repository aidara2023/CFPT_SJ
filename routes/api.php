<?php

use App\Http\Controllers\connexion\connexion_controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\administrateur\administrateur_view_controller;
use App\Http\Controllers\alerte\alerte_controller;
use App\Http\Controllers\alerte\alerte_view_controller;
use App\Http\Controllers\AlerteController;
use App\Http\Controllers\annee_academique\annee_academique_controller;
use App\Http\Controllers\annee_academique\annee_academique_view_controller;
use App\Http\Controllers\archive\archive_controller;
use App\Http\Controllers\archive\archive_view_controller;
use App\Http\Controllers\AuditController;
use App\Http\Controllers\auteur\auteur_controller;
use App\Http\Controllers\batiment\batiment_controller;
use App\Http\Controllers\batiment\batiment_view_controller;
use App\Http\Controllers\auteur\auteur_view_controller;
use App\Http\Controllers\bibliothecaire\bibliothecaire_controller;

use App\Http\Controllers\caissier\caissier_view_controller;

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
use App\Http\Controllers\etat\etat_controller;
use App\Http\Controllers\financer_bourse\financer_bourse_controller;
use App\Http\Controllers\infirmier\infirmier_controller;
use App\Http\Controllers\livre\livre_controller;
use App\Http\Controllers\login\login_view_controller;
use App\Http\Controllers\caissier\caissier_controller;
use App\Http\Controllers\classe\classe_controller;
use App\Http\Controllers\classe\classe_view_controller;
use App\Http\Controllers\categorie\categorie_view_controller;
use App\Http\Controllers\ChambreController;
use App\Http\Controllers\classe_matiere\classe_matiere_controller;
use App\Http\Controllers\comptable\comptable_controller;
use App\Http\Controllers\Commande\CommandeController;
use App\Http\Controllers\consommable\consommable_controller;
use App\Http\Controllers\connexion\connexion_view_controller;

use App\Http\Controllers\consultation\consultation_controller;
use App\Http\Controllers\consultation\consultation_view_controller;
use App\Http\Controllers\cours\cours_controller;
use App\Http\Controllers\cours\cours_view_controller;

use App\Http\Controllers\demande\demande_controller;
use App\Http\Controllers\departement\departement_view_controller;
use App\Http\Controllers\direction\direction_controller;
use App\Http\Controllers\direction\direction_view_controller;
use App\Http\Controllers\dispatching\dispatching_controller;
use App\Http\Controllers\dossier_medical\dossier_medical_view_controller;
use App\Http\Controllers\emprunter_livre\emprunter_livre_view_controller;

use App\Http\Controllers\editeur\editeur_view_controller;
use App\Http\Controllers\edition\edition_view_controller;
use App\Http\Controllers\emploi_du_temps\emploi_du_temps_controller;
use App\Http\Controllers\emprunter_materiel\emprunter_materiel_controller;
use App\Http\Controllers\emprunter_materiel\emprunter_materiel_view_controller;
use App\Http\Controllers\exemplaire\exemplaire_controller as ExemplaireExemplaire_controller;
use App\Http\Controllers\exemplaire\exemplaire_view_controller;
use App\Http\Controllers\facture\facture_controller;
use App\Http\Controllers\facture\facture_view_controller;
use App\Http\Controllers\financer_bourse\financer_bourse_view_controller;
use App\Http\Controllers\fonctionnalite\fonctionnalite_controller;
use App\Http\Controllers\Formateur\formateur_controller;
use App\Http\Controllers\Formateur\formateur_view_controller;
use App\Http\Controllers\formateurMatiere\FormateurMatiereController;
use App\Http\Controllers\Fournisseur\FournisseurController;
use App\Http\Controllers\HebergementController;
use App\Http\Controllers\ImprimerController;
use App\Http\Controllers\infirmier\infirmier_view_controller;
use App\Http\Controllers\inscription\inscription_controller;
use App\Http\Controllers\livre\livre_view_controller;
use App\Http\Controllers\materiel\materiel_controller;
use App\Http\Controllers\matiere\matiere_controller;
use App\Http\Controllers\matiere\matiere_view_controller;
use App\Http\Controllers\mois\mois_controller;
use App\Http\Controllers\mois\mois_view_controller;
use App\Http\Controllers\note\note_controller;
use App\Http\Controllers\organisme\organisme_controller;
use App\Http\Controllers\organisme\organisme_view_controller;
use App\Http\Controllers\paiement\paiement_controller;
use App\Http\Controllers\paiement\paiement_view_controller;
use App\Http\Controllers\partenaire\partenaire_controller;
use App\Http\Controllers\partenaire\partenaire_view_controller;
use App\Http\Controllers\participer\participer_controller;
use App\Http\Controllers\participer\participer_view_controller;
use App\Http\Controllers\rayon\rayon_controller;
use App\Http\Controllers\rayon\rayon_view_controller;
use App\Http\Controllers\ressource_pedagogique\ressource_pedagogique_controller;
use App\Http\Controllers\ressource_pedagogique\ressource_pedagogique_view_controller;
use App\Http\Controllers\retard\retard_controller;
use App\Http\Controllers\retard\retard_view_controller;
use App\Http\Controllers\role\role_controller;
use App\Http\Controllers\salle\salle_controller;
use App\Http\Controllers\salle\salle_view_controller;
use App\Http\Controllers\SecteurActivite\SecteurActiviteController;
use App\Http\Controllers\semestre\semestre_controller;
use App\Http\Controllers\seminaire\seminaire_controller;
use App\Http\Controllers\seminaire\seminaire_view_controller;
use App\Http\Controllers\service\service_controller;
use App\Http\Controllers\service\service_view_controller;
use App\Http\Controllers\specialite\specialite_controller;
use App\Http\Controllers\specialite\specialite_view_controller;
use App\Http\Controllers\statut\statut_controller;
use App\Http\Controllers\Stock\StockController;
use App\Http\Controllers\Stock\StockMaterielController;
use App\Http\Controllers\Stock\StockConsommableController;
use App\Http\Controllers\tuteur\tuteur_controller;
use App\Http\Controllers\tuteur\tuteur_view_controller;
use App\Http\Controllers\type_evaluation\type_evaluation_controller;
use App\Http\Controllers\type_evaluation\type_evaluation_view_controller;
use App\Http\Controllers\type_formation\type_formation_controller;
use App\Http\Controllers\type_formation\type_formation_view_controller;
use App\Http\Controllers\unite_de_formation\unite_de_formation_controller;
use App\Http\Controllers\inscription\inscription_view_controller;
use App\Http\Controllers\location\location_controller;
use App\Http\Controllers\location\location_view_controller;
use App\Http\Controllers\paiement_partenaire\paiement_partenaire_controller;
use App\Http\Controllers\permission\permission_controller;
use App\Http\Controllers\personnel_administratif\personnel_administratif_controller;
use App\Http\Controllers\personnel_administratif\personnel_administratif_view_controller;
use App\Http\Controllers\personnel_appui\personnel_appui_controller;
use App\Http\Controllers\personnel_appui\personnel_appui_view_controller;
use App\Http\Controllers\recouvrement\recouvrement_controller;
use App\Http\Controllers\recouvrement\recouvrement_view_controller;
use App\Http\Controllers\reservation\reservation_controller;
use App\Http\Controllers\type_materiel\type_materiel_controller;
use App\Http\Controllers\type_materiel\type_materiel_view_controller;
use App\Http\Controllers\unite_de_formation\unite_de_formation_view_controller;
use App\Http\Controllers\user\user_controller;
use App\Http\Controllers\user\user_view_controller;
use App\Http\Controllers\user\userViewController;

use Illuminate\Support\Facades\Log;
use App\Http\Controllers\roleController;
use App\Http\Controllers\surveillant\surveillant_view_controller;

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



//Route de direction
Route::get('compte/bloquer', [connexion_view_controller::class, 'index'])->name('compte_locked');
//Route pour la connexion
 Route::post('/connexion',[connexion_controller::class,'connexion'])->name('connexion'); 
//Route::post('/logout',[connexion_controller::class,'logout'])->name('logout');
Route::get('get/emploi',[emploi_du_temps_controller::class, 'getcoursfromemploidutemps'])->name('emploi_get');
Route::get('get/formateur/schedule',[emploi_du_temps_controller::class, 'getFormateurSchedule'])->name('emploi_get_formateur');
Route::get('test', function () {
    Log::info("Route de test atteinte");
    return response()->json(['message' => 'Route de test atteinte']);
});

Route::middleware('auth:sanctum')->group(function () {

Route::get('direction/index', [direction_controller::class, 'index'])->name('direction_index');
Route::get('direction/index/paginate', [direction_controller::class, 'indexpagine'])->name('direction_index_paginate');
Route::get('direction/index/get/last', [direction_controller::class, 'get_five_laste'])->name('direction_index_get_last');
Route::post('direction/store',[direction_controller::class, 'store'])->name('direction_store');
Route::post('direction/update/{id}', [direction_controller::class, 'update'])->name('direction_update');
Route::delete('direction/delete/{id}',[direction_controller::class, 'delete'])->name('direction_delete');
Route::get('direction/get/{id}',[direction_controller::class, 'get'])->name('direction_get');

Route::get('/direction/accueil',[direction_view_controller::class, 'accueil'])->name('direction_accueil');

Route::get('demandes', [demande_controller::class, 'index'])->name('demandes.index');
Route::get('demandes-a-commander', [demande_controller::class, 'getDemandesACommander'])->name('demandes.a_commander');
Route::put('demandes/{id}/change-statut', [demande_controller::class, 'changeStatut'])->name('demande_change_statut');
Route::post('demandes', [demande_controller::class, 'store'])->name('demandes.store');
Route::put('demandes/{id}', [demande_controller::class, 'update'])->name('demandes.update');
Route::delete('demandes/{id}', [demande_controller::class, 'destroy'])->name('demandes.destroy');
Route::get('demandes/{id}', [demande_controller::class, 'show'])->name('demandes.show');
Route::get('demandes/user', [demande_controller::class, 'userDemandes'])->name('demandes.user');
Route::get('demandes/last-three', [demande_controller::class, 'getLastThreeDemandes'])->name('demandes.last_three');
Route::get('demandes/index/paginate', [demande_controller::class, 'indexpagine'])->name('demandes.index_paginate');
Route::patch('demandes/{id}/urgence', [demande_controller::class, 'updateUrgence']);
Route::post('/demandes/{id}/valider', [demande_controller::class, 'validerDemande']);
// routes/web.php ou routes/api.php
Route::get('materiel/index', [materiel_controller::class, 'index'])->name('materiel_index');
Route::post('materiel/store', [materiel_controller::class, 'store'])->name('materiel_store');
Route::get('materiel/show/{id}', [materiel_controller::class, 'show'])->name('materiel_show');
Route::post('materiel/update/{id}', [materiel_controller::class, 'update'])->name('materiel_update');
Route::delete('materiel/delete/{id}', [materiel_controller::class, 'destroy'])->name('materiel_delete');
Route::get('materiel/search', [materiel_controller::class, 'search'])->name('materiel_search');

Route::get('consommable/index', [consommable_controller::class, 'index'])->name('consommable_index');
Route::post('consommable/store', [consommable_controller::class, 'store'])->name('consommable_store');
Route::get('consommables/show/{id}', [consommable_controller::class, 'show'])->name('consommable_show');
Route::post('consommable/update/{id}', [consommable_controller::class, 'update'])->name('consommable_update');
Route::delete('consommable/delete/{id}', [consommable_controller::class, 'destroy'])->name('consommable_delete');
Route::get('consommable/search', [consommable_controller::class, 'search'])->name('consommable_search');

Route::get('/demandes/received', [dispatching_controller::class, 'getReceivedDemandes']);


Route::get('type_materiel/index',[type_materiel_controller::class, 'index'])->name('type_materiel_index');
Route::post('type_materiel/store',[type_materiel_controller::class, 'store'])->name('type_materiel_store');
Route::get('type_materiel/show/{id}',[type_materiel_controller::class,'show'])->name('type_materiel_show');
Route::post('type_materiel/update/{id}',[type_materiel_controller::class,'update'])->name('type_materiel_update');
Route::delete('type_materiel/delete/{id}',[type_materiel_controller::class, 'delete'])->name('type_materiel_delete');

Route::get('/type_materiel/create',[type_materiel_view_controller::class, 'create'])->name('type_materiel_create');

Route::get('emprunter_materiel/index',[emprunter_materiel_controller::class, 'index'])->name('emprunter_materiel_index');
Route::post('emprunter_materiel/store',[emprunter_materiel_controller::class, 'store'])->name('emprunter_materiel_store');
Route::get('emprunter_materiel/show/{id}',[emprunter_materiel_controller::class,'show'])->name('emprunter_materiel_show');
Route::post('emprunter_materiel/update/{id}',[emprunter_materiel_controller::class,'update'])->name('emprunter_materiel_update');
Route::delete('emprunter_materiel/delete/{id}',[emprunter_materiel_controller::class, 'delete'])->name('emprunter_materiel_delete');

Route::get('/emprunter_materiel/create',[emprunter_materiel_view_controller::class, 'create'])->name('emprunter_materiel_create');


Route::get('/statut/index', [statut_controller::class, 'index']); // Récupérer tous les statuts
Route::post('/statut/store', [statut_controller::class, 'store']); // Créer un nouveau statut
Route::put('/statut/update/{id}', [statut_controller::class, 'update']); // Mettre à jour un statut existant
Route::delete('/statut/delete/{id}', [statut_controller::class, 'destroy']); // Supprimer un statut
Route::get('/statut/show/{id}', [statut_controller::class, 'show']); // Afficher un statut spécifique

Route::get('/etats', [etat_controller::class, 'index']);
Route::get('/etats/{id}', [etat_controller::class, 'show']);
Route::post('/etats', [etat_controller::class, 'store']);
Route::put('/etats/{id}', [etat_controller::class, 'update']);
Route::delete('/etats/{id}', [etat_controller::class, 'destroy']);


Route::prefix('dispatchings')->group(function () {
    Route::get('/', [dispatching_controller::class, 'index'])->name('dispatching_index'); // Récupérer tous les dispatchings
    Route::post('/{id}/dispatcher', [dispatching_controller::class, 'dispatcher'])->name('dispatching_dispatcher'); // Dispatcher une commande
    Route::delete('/{id}', [dispatching_controller::class, 'destroy'])->name('dispatching_delete'); // Supprimer un dispatching
    Route::get('/{id}', [dispatching_controller::class, 'show'])->name('dispatching_show'); // Afficher un dispatching spécifique
});

Route::put('/dispatchings/{id}', [dispatching_controller::class, 'update'])->name('dispatching_update');
Route::get('/dispatching/search', [dispatching_controller::class, 'search']);
Route::post('/dispatching', [dispatching_controller::class, 'dispatchItems']);
Route::get('/batiments', [dispatching_controller::class, 'getBatiments']);
Route::get('/salles/batiment/{batimentId}', [dispatching_controller::class, 'getSallesByBatiment']);



Route::get('/fournisseurs', [FournisseurController::class, 'index']);
Route::get('/fournisseurs/{id}', [FournisseurController::class, 'show']);
Route::post('/fournisseurs', [FournisseurController::class, 'store']);
Route::put('/fournisseurs/{id}', [FournisseurController::class, 'update']);
Route::delete('/fournisseurs/{id}', [FournisseurController::class, 'delete']);



Route::get('/secteurs-activite', [SecteurActiviteController::class, 'index']);
Route::post('/secteurs-activite', [SecteurActiviteController::class, 'store']);
Route::get('/secteurs-activite/{id}', [SecteurActiviteController::class, 'show']);
Route::put('/secteurs-activite/{id}', [SecteurActiviteController::class, 'update']);
Route::delete('/secteurs-activite/{id}', [SecteurActiviteController::class, 'destroy']);



Route::prefix('commandes')->group(function () {
    Route::get('/', [CommandeController::class, 'index']);
    Route::get('/{id}', [CommandeController::class, 'show']);
    Route::post('/', [CommandeController::class, 'store']);
    Route::put('/{id}', [CommandeController::class, 'update']);
    Route::delete('/{id}', [CommandeController::class, 'delete']);
});
Route::prefix('stocks-materiels')->group(function () {
    Route::get('/', [StockMaterielController::class, 'index']);
    Route::post('/', [StockMaterielController::class, 'store']);
    Route::get('/{id}', [StockMaterielController::class, 'show']);
    Route::put('/{id}', [StockMaterielController::class, 'update']);
    Route::delete('/{id}', [StockMaterielController::class, 'destroy']);
});

// Routes pour StockConsommable
Route::prefix('stocks-consommables')->group(function () {
    Route::get('/', [StockConsommableController::class, 'index']);
    Route::post('/', [StockConsommableController::class, 'store']);
    Route::get('/{id}', [StockConsommableController::class, 'show']);
    Route::put('/{id}', [StockConsommableController::class, 'update']);
    Route::delete('/{id}', [StockConsommableController::class, 'destroy']);
});
Route::prefix('stock')->group(function () {
    Route::get('/materiels', [StockMaterielController::class, 'index']);
    Route::get('/consommables', [StockConsommableController::class, 'index']);
    Route::get('/verifier/{id}', [StockController::class, 'verifierDisponibilite']);
    Route::post('/dispatcher', [StockController::class, 'dispatcherStock']);
});

Route::prefix('stock')->group(function () {
    Route::get('demande/{id}/verifier', [StockController::class, 'verifierDisponibilite']);
    Route::post('demande/{id}/dispatcher', [StockController::class, 'dispatcherStock']);
    Route::get('demande/{id}/non-disponibles', [StockController::class, 'getItemsNonDisponibles']);
    Route::get('/transactions', [App\Http\Controllers\Stock\TransactionController::class, 'index']);
});

Route::prefix('stock')->group(function () {
    Route::get('materiel/all', [StockController::class, 'allMateriel']);
    Route::get('consommable/all', [StockController::class, 'allConsommable']);
    Route::get('demande/{id}/verifier', [StockController::class, 'verifierDisponibilite']);
    Route::post('demande/{id}/dispatcher', [StockController::class, 'dispatcherStock']);
    Route::get('demande/{id}/non-disponibles', [StockController::class, 'getItemsNonDisponibles']);
    Route::get('transactions', [App\Http\Controllers\Stock\TransactionController::class, 'index']);
});

//Route de emploi du temps

Route::get('emploidutemps/all', [emploi_du_temps_controller::class, 'all'])->name('emploi_du_temps_all');
// Dans routes/api.php
Route::get('/emploi-du-temps/classe/{classId}', [emploi_du_temps_controller::class, 'getScheduleByClass']);
Route::post('emploidutemps/store', [emploi_du_temps_controller::class, 'store'])->name('emploi_du_temps_store');
Route::post('/verify-schedule-conflict', [emploi_du_temps_controller::class, 'verifyScheduleConflict'])->name('emploi_du_temps_verify-schedule-conflict');
Route::post('/exchange-events', [emploi_du_temps_controller::class, 'exchangeEvents'])->name('emploi_du_temps_exchangeEvents');
Route::post('/emploi-du-temps/move', [emploi_du_temps_controller::class, 'moveEvent'])->name('emploi_du_temps_exchangeEvents');
Route::post('planification/emploidutemps/store', [emploi_du_temps_controller::class, 'store_planification'])->name('planification_emploi_du_temps_store');
Route::post('/generate-schedule', [emploi_du_temps_controller::class, 'generateSchedule']);
Route::post('/save-schedule', [emploi_du_temps_controller::class, 'saveSchedule']);
Route::post('/check-and-update-event', [emploi_du_temps_controller::class, 'checkAndUpdateEvent'])->name('checkAndUpdateEvent');
Route::get('emploi-du-temps/formateur',[emploi_du_temps_controller::class, 'getEmploiDuTempsForConnectedFormateur'])->name('emploi_get_formateurs');


//Route de matiere

Route::get('matiere/index', [matiere_controller::class, 'index'])->name('matiere_index');
Route::get('matiere/all/paginate',[matiere_controller::class, 'all_paginate'])->name('matiere_all_paginate');
Route::post('matiere/store',[matiere_controller::class, 'store'])->name('matiere_store');
Route::post('matiere/update/{id}', [matiere_controller::class, 'update'])->name('matiere_update');
Route::delete('matiere/delete/{id}',[matiere_controller::class, 'delete'])->name('matiere_delete');
Route::get('matiere/get',[matiere_controller::class, 'get_five_laste'])->name('matiere_get');
Route::get('matiere/find/formateur/assign/{id}',[matiere_controller::class,'find_professeur_assign_to_matiere'])->name('matiere_find_professeur_assign');


Route::get('/matiere/create',[matiere_view_controller::class, 'create'])->name('matiere_create');


//Route anne academique
Route::get('annee_academique/index', [annee_academique_controller::class, 'index']) -> name('annee_academique_index');
Route::get('annee_academique/ajouter', [annee_academique_controller::class, 'ajouter']) -> name('annee_academique_ajouter');
Route::get('annee_academique/mise_a_jour', [annee_academique_controller::class, 'mise_a_jour']) -> name('annee_academique_mise_a_jour');
Route::get('annee_academique/delete', [annee_academique_controller::class, 'delete']) -> name('annee_academique_delete');
Route::get('annee_academique/show/{id}', [annee_academique_controller::class, 'show']) -> name('annee_academique_show');

Route::get('/annee_academique/create',[annee_academique_view_controller::class, 'create'])->name('annee_academique_create');

//Route de Organisme

Route::get('organisme/index', [organisme_controller::class, 'index'])->name('organisme_index');
Route::post('organisme/store',[organisme_controller::class, 'store'])->name('organisme_store');
Route::post('organisme/update/{id}', [organisme_controller::class, 'update'])->name('organisme_update');
Route::delete('organisme/delete/{id}',[organisme_controller::class, 'delete'])->name('organisme_delete');
Route::get('organisme/get/{id}',[organisme_controller::class, 'get'])->name('organisme_get');

Route::get('/organisme/create',[organisme_view_controller::class, 'create'])->name('organisme_create');


//Route de dossier medical

Route::get('dossier_medical/index', [dossier_medical_controller::class, 'index'])->name('dossier_medical_index');
Route::post('dossier_medical/store',[dossier_medical_controller::class, 'store'])->name('dossier_medical_store');
Route::post('dossier_medical/update/{id}', [dossier_medical_controller::class, 'update'])->name('dossier_medical_update');
Route::delete('dossier_medical/delete/{id}',[dossier_medical_controller::class, 'delete'])->name('dossier_medical_delete');
Route::get('dossier_medical/get/{id}',[dossier_medical_controller::class, 'get'])->name('dossier_medical_get');

Route::get('/dossier_medical/create',[dossier_medical_view_controller::class, 'create'])->name('dossier_medical_create');

//Route de infirmier

Route::get('infirmier/index', [infirmier_controller::class, 'index'])->name('infirmier_index');
Route::post('infirmier/store',[infirmier_controller::class, 'store'])->name('infirmier_store');
Route::post('infirmier/update/{id}', [infirmier_controller::class, 'update'])->name('infirmier_update');
Route::delete('infirmier/delete/{id}',[infirmier_controller::class, 'delete'])->name('infirmier_delete');
Route::get('infirmier/get/{id}',[infirmier_controller::class, 'get'])->name('infirmier_get');

Route::get('/infirmier/create',[infirmier_view_controller::class, 'create'])->name('infirmier_create');

//Route Audit
Route::get('audit/all', [AuditController::class, 'index'])->name('audit_all');
Route::get('audit/last', [AuditController::class, 'getlast'])->name('audit_last');


//Route unite de formation

Route::get('unite_de_formation/all', [unite_de_formation_controller::class, 'all'])->name('unite_de_formation_all');
Route::get('unite_de_formation/all/paginate', [unite_de_formation_controller::class, 'all_paginate'])->name('unite_de_formation_all_paginate');
Route::get('unite_de_formation/get/last', [unite_de_formation_controller::class, 'get_last_value'])->name('unite_de_formation_last');
Route::post('unite_de_formation/store',[unite_de_formation_controller::class, 'store'])->name('unite_de_formation_store');
Route::post('unite_de_formation/update/{id}', [unite_de_formation_controller::class, 'update'])->name('unite_de_formation_update');
Route::post('unite_de_formation/by/departement/{id}', [unite_de_formation_controller::class, 'get_filiere_by_departement'])->name('filiere_departement');
Route::delete('unite_de_formation/delete/{id}',[unite_de_formation_controller::class, 'delete'])->name('unite_de_formation_delete');
Route::get('unite_de_formation/get/{id}',[unite_de_formation_controller::class, 'get'])->name('unite_de_formation_get');

Route::get('/unite_de_formation/create',[unite_de_formation_view_controller::class, 'create'])->name('unite_deformation_create');
Route::get('unite_de_formation/index',[unite_de_formation_view_controller::class, 'index'])->name('unite_de_formation_index');

//route eleve
Route::get('eleve/index',[eleve_controller::class, 'index'])->name('eleve_index');
Route::get('user/count',[eleve_controller::class, 'countUser'])->name('user_count');
Route::post('eleve/store',[eleve_controller::class, 'store'])->name('eleve_store');
Route::get('eleve/show/{id}',[eleve_controller::class, 'show'])->name('eleve_show');
Route::get('eleve/show_by_where/{id}',[eleve_controller::class, 'show_by_where'])->name('eleve_search');
Route::post('eleve/update/{id}',[eleve_controller::class, 'update'])->name('eleve_update');
Route::post('eleve/find/user/{id}',[user_controller::class, 'find_eleve_in_user'])->name('eleve_find_user');
Route::delete('eleve/delete/{id}',[eleve_controller::class, 'destroy'])->name('eleve_delete');

Route::get('/eleve/inscription',[eleve_view_controller::class, 'inscription'])->name('eleve_inscription');
Route::get('/liste/inscription',[eleve_view_controller::class, 'liste'])->name('liste_inscription');

//route emprunter livre
Route::get('emprunter_livre/index',[emprunter_livre_controller::class, 'index'])->name('emprunter_livre_index');
Route::post('emprunter_livre/store',[emprunter_livre_controller::class, 'store'])->name('emprunter_livre_store');
Route::get('emprunter_livre/show/{id}',[emprunter_livre_controller::class, 'show'])->name('emprunter_livre_show');
Route::post('emprunter_livre/update/{id}',[emprunter_livre_controller::class, 'update'])->name('emprunter_livre_update');
Route::delete('emprunter_livre/delete/{id}',[emprunter_livre_controller::class, 'destroy'])->name('emprunter_livre_delete');
Route::post('emprunter_livre/rendre/{id}',[emprunter_livre_controller::class, 'rendre'])->name('emprunter_livre_rendre');

Route::get('/emprunter_livre/create',[emprunter_livre_view_controller::class, 'create'])->name('emprunter_livre_create');
Route::get('/emprunter_livre/accueil',[emprunter_livre_view_controller::class, 'accueil'])->name('emprunter_livre_accueil');


//route type de formation
Route::get('type_formation/all/paginate',[type_formation_controller::class, 'index_paginate'])->name('type_formation_all_paginate');
Route::get('type_formation/all',[type_formation_controller::class, 'index'])->name('type_formation_all');
Route::get('type_formation/get/last',[type_formation_controller::class, 'get_last_values'])->name('type_formation_last_values');
Route::post('type_formation/store',[type_formation_controller::class, 'store'])->name('type_formation_store');
Route::get('type_formation/show/{id}',[type_formation_controller::class, 'show'])->name('type_formation_show');
Route::post('type_formation/update/{id}',[type_formation_controller::class, 'update'])->name('type_formation_update');
Route::delete('type_formation/delete/{id}',[type_formation_controller::class, 'destroy'])->name('type_formation_delete');

Route::get('/type_formation/create',[type_formation_view_controller::class, 'create'])->name('type_formation_create');
Route::get('/type_formation/index',[type_formation_view_controller::class, 'index'])->name('type_formation_index');

//route evaluation
Route::get('type_evaluation/index',[type_evaluation_controller::class, 'index'])->name('type_evaluation_index');
Route::post('type_evaluation/store',[type_evaluation_controller::class, 'store'])->name('type_evaluation_store');
Route::get('type_evaluation/show/{id}',[type_evaluation_controller::class, 'show'])->name('type_evaluation_show');
Route::post('type_evaluation/update/{id}',[type_evaluation_controller::class, 'update'])->name('type_evaluation_update');
Route::delete('type_evaluation/delete/{id}',[type_evaluation_controller::class, 'destroy'])->name('type_evaluation_delete');

Route::get('/type_evaluation/create',[type_evaluation_view_controller::class, 'create'])->name('evaluation_create');


//route partenaire
Route::get('partenaire/index',[partenaire_controller::class, 'index'])->name('partenaire_index');
Route::get('partenaire/all/paginate',[partenaire_controller::class, 'all_paginate'])->name('partenaire_all_paginate');
Route::get('partenaire/get/last',[partenaire_controller::class, 'get_last'])->name('partenaire_last_values');
Route::post('partenaire/store',[partenaire_controller::class, 'store'])->name('partenaire_store');
Route::get('partenaire/show/{id}',[partenaire_controller::class, 'show'])->name('partenaire_show');
Route::post('partenaire/update/{id}',[partenaire_controller::class, 'update'])->name('partenaire_update');
Route::delete('partenaire/delete/{id}',[partenaire_controller::class, 'delete'])->name('partenaire_delete');

Route::get('/partenaire/create',[partenaire_view_controller::class, 'create'])->name('partenaire_create');

//route materiel

Route::get('seminaire/index',[seminaire_controller::class, 'index'])->name('seminaire_index');
Route::post('seminaire/store',[seminaire_controller::class, 'store'])->name('seminaire_store');
Route::get('seminaire/show/{id}',[seminaire_controller::class, 'show'])->name('seminaire_show');
Route::post('seminaire/update/{id}',[seminaire_controller::class, 'update'])->name('seminaire_update');
Route::delete('seminaire/delete/{id}',[seminaire_controller::class, 'destroy'])->name('seminaire_delete');

Route::get('/seminaire/create',[seminaire_view_controller::class, 'create'])->name('seminaire_create');


//route participer
Route::get('participer/index',[participer_controller::class, 'index'])->name('participer_index');
Route::post('participer/store',[participer_controller::class, 'store'])->name('participer_store');
Route::get('participer/show/{id}',[participer_controller::class, 'show'])->name('participer_show');
Route::post('participer/update/{id}',[participer_controller::class, 'update'])->name('participer_update');
Route::delete('participer/delete/{id}',[participer_controller::class, 'destroy'])->name('participer_delete');

Route::get('/participer/create',[participer_view_controller::class, 'create'])->name('participer_create');

//route specialite
Route::get('specialite/index',[specialite_controller::class, 'index'])->name('specialite_index');
Route::get('specialite/all/paginate',[specialite_controller::class, 'all_paginate'])->name('specialite_all_paginate');
Route::get('specialite/get/last',[specialite_controller::class, 'get_five_laste'])->name('specialite_get_last');
Route::post('specialite/store',[specialite_controller::class, 'store'])->name('specialite_store');
Route::get('specialite/show/{id}',[specialite_controller::class, 'show'])->name('specialite_show');
Route::post('specialite/update/{id}',[specialite_controller::class, 'update'])->name('specialite_update');
Route::delete('specialite/delete/{id}',[specialite_controller::class, 'delete'])->name('specialite_delete');

Route::get('/specialite/create',[specialite_view_controller::class, 'create'])->name('specialite_create');




//route departement
Route::get('departement/all',[departement_controller::class, 'all'])->name('departement_all');
Route::get('departement/all/paginate',[departement_controller::class, 'all_paginate'])->name('departement_all_paginate');
Route::get('departement/get/last',[departement_controller::class, 'get_five_laste'])->name('departement_get_last');
Route::post('departement/store',[departement_controller::class, 'store'])->name('departement_store');
Route::get('departement/show/{id}',[departement_controller::class, 'show'])->name('departement_show');
Route::post('departement/update/{id}',[departement_controller::class, 'update'])->name('departement_update');
Route::delete('departement/delete/{id}',[departement_controller::class, 'destroy'])->name('departement_delete');
Route::get('/departement/find-chef', [departement_controller::class, 'findChefDepartement']);
Route::get('/departement/create',[departement_view_controller::class, 'create'])->name('departement_create');
Route::get('departement/index',[departement_view_controller::class, 'index'])->name('departement_index');


//route fonctionnalite
Route::get('fonctionnalite/all',[fonctionnalite_controller::class, 'index'])->name('fonctionnalite_all');
Route::get('fonctionnalite/all/paginate',[fonctionnalite_controller::class, 'all_paginate'])->name('fonctionnalite_all_paginate');
Route::get('fonctionnalite/get/last',[fonctionnalite_controller::class, 'get_five_laste'])->name('fonctionnalite_get_last');
Route::post('fonctionnalite/store',[fonctionnalite_controller::class, 'store'])->name('fonctionnalite_store');
Route::get('fonctionnalite/show/{id}',[fonctionnalite_controller::class, 'show'])->name('fonctionnalite_show');
Route::post('fonctionnalite/update/{id}',[fonctionnalite_controller::class, 'update'])->name('fonctionnalite_update');
Route::delete('fonctionnalite/delete/{id}',[fonctionnalite_controller::class, 'destroy'])->name('fonctionnalite_delete');

//route permission
Route::get('permission/all',[permission_controller::class, 'index'])->name('permission_all');
Route::get('permission/all/paginate',[permission_controller::class, 'all_paginate'])->name('permission_all_paginate');
Route::get('permission/get/last',[permission_controller::class, 'get_five_laste'])->name('permission_get_last');
Route::post('permission/store',[permission_controller::class, 'store'])->name('permission_store');
Route::get('permission/show/{id}',[permission_controller::class, 'show'])->name('permission_show');
Route::get('get/all/permission/{id}',[permission_controller::class, 'get_permission_by_id_role'])->name('permission_get_id_role');
Route::post('permission/update/{id}',[permission_controller::class, 'update'])->name('permission_update');
Route::delete('permission/delete/{id}',[permission_controller::class, 'destroy'])->name('permission_delete');

//route classeMatiere
Route::get('classe_matiere/all',[classe_matiere_controller::class, 'index'])->name('classe_matiere_all');
Route::get('classe_matiere/all/paginate',[classe_matiere_controller::class, 'all_paginate'])->name('classe_matiere_all_paginate');
Route::get('classe_matiere/get/last',[classe_matiere_controller::class, 'get_five_laste'])->name('classe_matiere_get_last');
Route::post('classe_matiere/store',[classe_matiere_controller::class, 'store'])->name('classe_matiere_store');
Route::get('classe_matiere/show/{id}',[classe_matiere_controller::class, 'show'])->name('classe_matiere_show');
Route::post('classe_matiere/update/{id}',[classe_matiere_controller::class, 'update'])->name('classe_matiere_update');
Route::delete('classe_matiere/delete/{id}',[classe_matiere_controller::class, 'destroy'])->name('classe_matiere_delete');


//route tuteur
Route::get('tuteur/index',[tuteur_controller::class, 'index'])->name('tuteur_index');
Route::post('tuteur/store',[tuteur_controller::class, 'store'])->name('tuteur_store');
Route::get('tuteur/show/{id}',[tuteur_controller::class, 'show'])->name('tuteur_show');
Route::post('tuteur/update/{id}',[tuteur_controller::class, 'update'])->name('tuteur_update');
Route::delete('tuteur/delete/{id}',[tuteur_controller::class, 'destroy'])->name('tuteur_delete');

Route::get('/tuteur/create',[tuteur_view_controller::class, 'create'])->name('tuteur_create');


//route paiement
Route::get('paiement/index',[paiement_controller::class, 'index'])->name('paiement_index');
Route::get('paiement/index/paginate',[paiement_controller::class, 'indexpaginate'])->name('paiement_index_paginate');
Route::get('paiement/get_last',[paiement_controller::class, 'get_last'])->name('paiement_get_last');
Route::get('recherche/eleve',[paiement_controller::class, 'recherche_eleve'])->name('recherche_eleve');
Route::get('historique/filtre/eleve',[paiement_controller::class, 'historiquePaiementsEleve'])->name('historiquePaiementsEleve');
Route::post('paiement/store',[paiement_controller::class, 'store'])->name('paiement_store');
Route::get('paiement/show/{id}',[paiement_controller::class, 'show'])->name('paiement_show');
Route::post('paiement/update/{id}',[paiement_controller::class, 'update'])->name('paiement_update');
Route::delete('paiement/delete/{id}',[paiement_controller::class, 'destroy'])->name('paiement_delete');

Route::get('reçu/index',[paiement_view_controller::class, 'reçu'])->name('reçu_index');
Route::get('paiement/accueil',[paiement_view_controller::class, 'liste'])->name('paiement_accueil');
Route::get('paiement/create',[paiement_view_controller::class, 'create'])->name('paiement_create');

//route mois
Route::get('mois/index',[mois_controller::class, 'index'])->name('mois_index');
Route::post('mois/store',[mois_controller::class, 'store'])->name('mois_store');
Route::get('mois/show/{id}',[mois_controller::class, 'show'])->name('mois_show');
Route::post('mois/update/{id}',[mois_controller::class, 'update'])->name('mois_update');
Route::delete('mois/delete/{id}',[mois_controller::class, 'destroy'])->name('mois_delete');

Route::get('/mois/create',[mois_view_controller::class, 'create'])->name('mois_create');

//route livre
Route::get('livre/index',[livre_controller::class, 'index'])->name('livre_index');
Route::post('livre/store',[livre_controller::class, 'store'])->name('livre_store');
Route::get('livre/show/{id}',[livre_controller::class, 'show'])->name('livre_show');
Route::get('/livre/last-three', [livre_controller::class, 'getLastThreeBooks']);
Route::delete('livre/delete/{id}',[livre_controller::class, 'delete'])->name('livre_delete');
Route::put('/livre/update/{id}', [livre_controller::class, 'update']);
//Route::get('/livre/create',[livre_view_controller::class, 'create'])->name('livre_create');
Route::get('/livre/accueil',[livre_view_controller::class, 'accueil'])->name('livre_accueil');
Route::get('/livre/index/paginate', [livre_controller::class, 'indexpagine']);

//route editeur
Route::get('editeur/index',[editeur_controller::class, 'index'])->name('editeur_index');
Route::post('editeur/store',[editeur_controller::class, 'store'])->name('editeur_store');
Route::get('editeur/show/{id}',[editeur_controller::class, 'show'])->name('editeur_show');
Route::post('editeur/update/{id}',[editeur_controller::class, 'update'])->name('editeur_update');
Route::delete('editeur/delete/{id}',[editeur_controller::class, 'delete'])->name('editeur_delete');

Route::get('/editeur/create',[editeur_view_controller::class, 'create'])->name('editeur_create');
Route::get('/editeur/accueil',[editeur_view_controller::class, 'accueil'])->name('editeur_accueil');


//route auteur
Route::get('auteur/index', [auteur_controller::class, 'index']) -> name('auteur_index');
Route::get('auteur/index/last/values',[auteur_controller::class, 'get_last_value'])->name('auteur_index_get_last');


Route::post('auteur/store', [auteur_controller::class, 'store']) -> name('auteur_store');
Route::post('auteur/update/{id}', [auteur_controller::class, 'update']) -> name('auteur_update');
Route::delete('auteur/delete/{id}', [auteur_controller::class, 'delete']) -> name('auteur_delete');
Route::get('auteur/show/{id}', [auteur_controller::class, 'show']) -> name('auteur_show');

Route::get('/auteur/create',[auteur_view_controller::class, 'create'])->name('auteur_create');
Route::get('/auteur/accueil',[auteur_view_controller::class, 'accueil'])->name('auteur_accueil');


//route rayon
Route::get('rayon/index',[rayon_controller::class, 'index'])->name('rayon_index');
Route::post('rayon/store',[rayon_controller::class, 'store'])->name('rayon_store');
Route::get('rayon/show/{id}',[rayon_controller::class, 'show'])->name('rayon_show');
Route::post('rayon/update/{id}',[rayon_controller::class, 'update'])->name('rayon_update');
Route::delete('rayon/delete/{id}',[rayon_controller::class, 'delete'])->name('rayon_delete');

Route::get('/rayon/create',[rayon_view_controller::class, 'create'])->name('rayon_create');
Route::get('/rayon/accueil',[rayon_view_controller::class, 'accueil'])->name('rayon_accueil');


//route categorie
Route::get('categorie/index',[categorie_controller::class, 'index'])->name('categorie_index');
Route::post('categorie/store',[categorie_controller::class, 'store'])->name('categorie_store');
Route::get('categorie/index/get/last', [categorie_controller::class, 'get_five_laste'])->name('categorie_index_get_last');

Route::get('categorie/show/{id}',[categorie_controller::class, 'show'])->name('categorie_show');
Route::post('categorie/update/{id}',[categorie_controller::class, 'update'])->name('categorie_update');
Route::delete('categorie/delete/{id}',[categorie_controller::class, 'delete'])->name('categorie_delete');

Route::get('/categorie/create',[categorie_view_controller::class, 'create'])->name('categorie_create');
Route::get('/categorie/accueil',[categorie_view_controller::class, 'accueil'])->name('categorie_accueil');


//route bibliothecaire
Route::get('bibliothecaire/index',[bibliothecaire_controller::class, 'index'])->name('bibliothecaire_index');
Route::post('bibliothecaire/store',[bibliothecaire_controller::class, 'store'])->name('bibliothecaire_store');
Route::get('bibliothecaire/show/{id}',[bibliothecaire_controller::class, 'show'])->name('bibliothecaire_show');
Route::post('bibliothecaire/update/{id}',[bibliothecaire_controller::class, 'update'])->name('bibliothecaire_update');
Route::delete('bibliothecaire/delete/{id}',[bibliothecaire_controller::class, 'delete'])->name('bibliothecaire_delete');


Route::get('/bibliothecaire/create',[bibliothecaire_view_controller::class, 'create'])->name('bibliothecaire_create');
Route::get('/bibliothecaire/accueil',[bibliothecaire_view_controller::class, 'accueil'])->name('bibliothecaire_accueil');


//rout exemplaire
// Route::get('exemplaire/index',[exemplaire_controller::class, 'index'])->name('exemplaire_index');
// Route::post('exemplaire/store',[exemplaire_controller::class, 'store'])->name('exemplaire_store');
// Route::get('exemplaire/show/{id}',[exemplaire_controller::class, 'show'])->name('exemplaire_show');
// Route::post('exemplaire/update/{id}',[exemplaire_controller::class, 'update'])->name('exemplaire_update');
// Route::delete('exemplaire/delete/{id}',[exemplaire_controller::class, 'delete'])->name('exemplaire_delete');
 
Route::get('/exemplaire/create',[exemplaire_view_controller::class, 'create'])->name('exemplaire_create');
Route::get('/exemplaire/accueil',[exemplaire_view_controller::class, 'accueil'])->name('exemplaire_accueil');
// Route::get('exemplaire/index/get/last' ,[exemplaire_controller::class, 'get_five_laste'])->name('exemplaire_index_get_last');


//route ressource_pedagogique
Route::get('ressource_pedagogique/index',[ressource_pedagogique_controller::class, 'index'])->name('ressource_pedagogique_index');
Route::post('ressource_pedagogique/store',[ressource_pedagogique_controller::class, 'store'])->name('ressource_pedagogique_store');
Route::get('ressource_pedagogique/show/{id}',[ressource_pedagogique_controller::class, 'show'])->name('ressource_pedagogique_show');
Route::post('ressource_pedagogique/update/{id}',[ressource_pedagogique_controller::class, 'update'])->name('ressource_pedagogique_update');
Route::delete('ressource_pedagogique/delete/{id}',[ressource_pedagogique_controller::class, 'delete'])->name('ressource_pedagogique_delete');

Route::get('/ressource_pedagogique/create',[ressource_pedagogique_view_controller::class, 'create'])->name('ressource_pedagogique_create');

//route archive
Route::get('archive/index',[archive_controller::class, 'index'])->name('archive_index');
Route::post('archive/store',[archive_controller::class, 'store'])->name('archive_store');
Route::get('archive/show/{id}',[archive_controller::class, 'show'])->name('archive_show');
Route::post('archive/update/{id}',[archive_controller::class, 'update'])->name('archive_update');
Route::delete('archive/delete/{id}',[archive_controller::class, 'delete'])->name('archive_delete');

Route::get('/archive/create',[archive_view_controller::class, 'create'])->name('archive_create');

//route date_emprunter
Route::get('date_emprunter/index',[date_emprunter_controller::class, 'index'])->name('date_emprunter_index');
Route::post('date_emprunter/store',[date_emprunter_controller::class, 'store'])->name('date_emprunter_store');
Route::get('date_emprunter/show/{id}',[date_emprunter_controller::class, 'show'])->name('date_emprunter_show');
Route::post('date_emprunter/update/{id}',[date_emprunter_controller::class, 'update'])->name('date_emprunter_update');
Route::delete('date_emprunter/delete/{id}',[date_emprunter_controller::class, 'delete'])->name('date_emprunter_delete');

//route edition
Route::get('edition/index',[edition_controller::class, 'index'])->name('edition_index');
Route::post('edition/store',[edition_controller::class, 'store'])->name('edition_store');
Route::get('edition/show/{id}',[edition_controller::class, 'show'])->name('edition_show');
Route::post('edition/update/{id}',[edition_controller::class, 'update'])->name('edition_update');
Route::delete('edition/delete/{id}',[edition_controller::class, 'delete'])->name('edition_delete');

Route::get('/edition/create',[edition_view_controller::class, 'create'])->name('edition_create');

//route financer_bourse
Route::get('financer_bourse/index',[financer_bourse_controller::class, 'index'])->name('financer_bourse_index');
Route::post('financer_bourse/store',[financer_bourse_controller::class, 'store'])->name('financer_bourse_store');
Route::get('financer_bourse/show/{id}',[financer_bourse_controller::class, 'show'])->name('financer_bourse_show');
Route::post('financer_bourse/update/{id}',[financer_bourse_controller::class, 'update'])->name('financer_bourse_update');
Route::delete('financer_bourse/delete/{id}',[financer_bourse_controller::class, 'delete'])->name('financer_bourse_delete');

Route::get('/financer_bourse/create',[financer_bourse_view_controller::class, 'create'])->name('financer_bourse_create');

//administrateur
Route::get('admin/index',[administrateur_view_controller::class, 'index'])->middleware('auth')->name('admin_index');

//type typemateriel


//Route pour caissier
Route::get('caissier/index',[caissier_controller::class, 'index'])->name('caissier_index');
Route::post('caissier/store',[caissier_controller::class, 'store'])->name('caissier_store');
Route::get('caissier/show/{id}',[caissier_controller::class,'show'])->name('caissier_show');
Route::post('caissier/update/{id}',[caissier_controller::class,'update'])->name('caissier_update');
Route::delete('caissier/delete/{id}',[caissier_controller::class, 'delete'])->name('caissier_delete');

Route::get('/caissier/create',[caissier_view_controller::class, 'create'])->name('caissier_create');
Route::get('/caissier/accueil',[caissier_view_controller::class, 'accueil'])->name('caissier_accueil');

//Route pour note

Route::get('note/index',[note_controller::class, 'index'])->name('note_index');
Route::post('note/store',[note_controller::class, 'store'])->name('note_store');
Route::get('note/show/{id}',[note_controller::class,'show'])->name('note_show');
Route::post('note/update/{id}',[note_controller::class,'update'])->name('note_update');
Route::delete('note/delete/{id}',[note_controller::class, 'delete'])->name('note_delete');

//Route pour cour

Route::get('cour/all',[cours_controller::class, 'all'])->name('cour_all');
Route::get('cour/all/paginate',[cours_controller::class, 'all_paginate'])->name('cour_all_paginate');
Route::get('cour/get/last',[cours_controller::class, 'get_last_value'])->name('cour_get_last');
Route::post('cour/store',[cours_controller::class, 'store'])->name('cour_store');
Route::get('cour/show/{id}',[cours_controller::class,'show'])->name('cour_show');
Route::get('find/cours/by/classe/{id}',[cours_controller::class,'find_cours_by_id_classe'])->name('cour_show_by_classe');
Route::post('cour/update/{id}',[cours_controller::class,'update'])->name('cour_update');
Route::delete('cour/delete/{id}',[cours_controller::class, 'delete'])->name('cour_delete');

Route::get('cour/create',[cours_view_controller::class, 'create'])->name('cour_create');


//Route pourinscription

Route::get('inscription/valide',[inscription_controller::class, 'index_val'])->name('inscription_index_val');
Route::get('inscription/all',[inscription_controller::class, 'index'])->name('inscription_index');
Route::get('inscription/invalide',[inscription_controller::class, 'index_inval'])->name('inscription_index_inval');
Route::get('inscription/last',[inscription_controller::class, 'last'])->name('inscription_index_');
Route::post('inscription/store',[inscription_controller::class, 'store'])->name('inscription_store');
Route::get('inscription/show/{id}',[inscription_controller::class,'show'])->name('inscription_show');
Route::post('inscription/update/{id}',[inscription_controller::class,'update'])->name('inscription_update');
Route::delete('inscription/delete/{id}',[inscription_controller::class, 'delete'])->name('inscription_delete');
Route::get('inscription/get_id_eleve_by_inscription/{id}',[inscription_controller::class, 'getEleveIdByInscriptionId'])->name('getEleveIdByInscriptionId');
Route::get('find/filieres/{id}',[inscription_controller::class, 'get_filiere_by_departement'])->name('find_filiere');
Route::get('find/classes/{id}',[inscription_controller::class, 'get_classe_by_filiere'])->name('find_classe');

Route::get('inscription/index', [inscription_view_controller::class, 'index'])->name('inscription_accueil');

//Route pour emprunter materiel



//Route pour consultation

Route::get('consultation/index',[consultation_controller::class, 'index'])->name('consultation_index');
Route::post('consultation/store',[consultation_controller::class, 'store'])->name('consultation_store');
Route::get('consultation/show/{id}',[consultation_controller::class,'show'])->name('consultation_show');
Route::post('consultation/update/{id}',[consultation_controller::class,'update'])->name('consultation_update');
Route::delete('consultation/delete/{id}',[consultation_controller::class, 'delete'])->name('consultation_delete');

Route::get('/consultation/create',[consultation_view_controller::class, 'create'])->name('consultation_create');


//Route pour formateur Matiere

Route::get('matiere/formateur/index',[FormateurMatiereController::class, 'index'])->name('matiere_formateur_index');
Route::get('matiere/formateur/all/paginate',[FormateurMatiereController::class, 'all_paginate'])->name('matiere_formateur_all_paginate');
Route::post('matiere/formateur/store',[FormateurMatiereController::class, 'store_matiere_professeur'])->name('matiere_formateur_store');
Route::delete('matiere/formateur/delete/{id}',[FormateurMatiereController::class, 'delete'])->name('matiere_formateur_delete');



//Route pour formateur

Route::get('formateur/index',[formateur_controller::class, 'index'])->name('formateur_index');
Route::get('formateur/getClassesByFormateur/{id}',[formateur_controller::class, 'getClassesByFormateur'])->name('formateur_classe_formateur');
Route::get('formateur/getClassesByFormateurs',[formateur_controller::class, 'getClassesByFormateurs'])->name('formateur_classe_formateurs');
Route::post('formateur/store',[formateur_controller::class, 'store'])->name('formateur_store');
Route::get('formateur/show/{id}',[formateur_controller::class,'show'])->name('formateur_show');
Route::get('formateur/find/by/unite/formation/{id}',[formateur_controller::class,'get_formateur_by_id_uniteformation'])->name('get_formateur_by_id_uniteformation');
Route::get('formateur/find/professeur/{id}',[formateur_controller::class,'find_professeur'])->name('formateur_find_professeur');
Route::get('formateur/find/matiere/professeur/{id}',[formateur_controller::class,'find_matiere_professeur'])->name('formateur_find_matiere_professeur');
Route::post('formateur/update/{id}',[formateur_controller::class,'update'])->name('formateur_update');
Route::delete('formateur/delete/{id}',[formateur_controller::class, 'delete'])->name('formateur_delete');

Route::get('/formateur',[formateur_view_controller::class, 'accueil'])->name('formateur_accueil');
Route::get('/formateur/liste_note',[formateur_view_controller::class, 'liste_note'])->name('formateur_liste_note');
Route::get('/formateur/profil',[formateur_view_controller::class, 'profil'])->name('formateur_profil');
Route::get('/formateur/cours',[formateur_view_controller::class, 'cours'])->name('formateur_cours');


//Route pour utilisateur


Route::get('utilisateur/create', [user_view_controller::class, 'create'])->name('utilisateur_create');
Route::get('utilisateur/index', [user_view_controller::class, 'index'])->name('utilisateur_index');

Route::get('utilisateur/profil', [user_view_controller::class, 'profil'])->name('utilisateur_profil');
Route::get('utilisateur/service', [user_controller::class, 'getServiceUtilisateurConnecte'])->name('utilisateur_service');
Route::get('utilisateur/direction', [user_controller::class, 'getDirectionUtilisateurConnecte'])->name('utilisateur_direction');
 

Route::get('utilisateur/update/{id}',[user_view_controller::class, 'show'])->name('user_edit');
Route::post('utilisateur/password/{id}',[user_controller::class, 'setPassword'])->name('set_password');
Route::post('verif/mail', [user_controller::class, 'verifMail'])->name('verif_mail');


Route::get('user/index',[user_controller::class, 'index'])->name('user_index');
Route::get('user/getPersonnel',[user_controller::class, 'getPersonnelAdministratif'])->name('user_personnel');
Route::get('user/getFormateur',[user_controller::class, 'getFormateur'])->name('user_formateur');
Route::get('user/getPersonnelAdmin',[user_controller::class, 'getPersonnelAdminin'])->name('user_personnel_admin');
Route::get('user/getPersonnelApui',[user_controller::class, 'getPersonnelApui'])->name('user_personnel_apui');
Route::post('user/store',[user_controller::class, 'store'])->name('user_store');
Route::get('user/show/{id}',[user_controller::class, 'show'])->name('user_show');

Route::post('user/update/{id}',[user_controller::class, 'update'])->name('user_update');
Route::delete('user/delete/{id}',[user_controller::class, 'delete'])->name('user_delete');
Route::get('user/getBibliothecaire',[user_controller::class, 'getBibliothecaire'])->name('user_personnel_bibliothecaire');


//Route pour role

Route::get('roles/index', [role_controller::class, 'index'])->name('role_index');
Route::get('role/all/paginate',[role_controller::class, 'all_paginate'])->name('role_all_paginate');
Route::get('role/get/last',[role_controller::class, 'get_last_value'])->name('role_last_values');
Route::delete('role/delete/{id}',[role_controller::class, 'delete'])->name('role_delete');
Route::post('role/update/{id}',[role_controller::class,'update'])->name('role_update');
Route::post('role/store',[role_controller::class, 'store'])->name('role_store');
Route::get('role/all', [role_controller::class, 'all'])->name('role_all');


//Route pour service

Route::get('service/index' ,[service_controller::class, 'index'])->name('service_index');
Route::get('service/all' ,[service_controller::class, 'get_all_services'])->name('all_services');
Route::get('service/index/get/last' ,[service_controller::class, 'get_five_laste'])->name('service_index_get_last');
Route::post('service/store' ,[service_controller::class, 'store'])->name('service_store');
Route::delete('service/delete/{id}',[service_controller::class, 'delete'])->name('service_delete');
Route::post('service/update/{id}',[service_controller::class, 'update'])->name('service_update');
Route::get('create/service', [service_view_controller::class, 'create'])->name('create_service');
Route::get('service/accueil', [service_view_controller::class, 'accueil'])->name('service_accueil');

Route::get('facture/index' ,[facture_controller::class, 'index'])->name('facture_index');
Route::get('facture/definitive' ,[facture_controller::class, 'facture_definitve'])->name('facture_definitive');
Route::get('facture/acompte' ,[facture_controller::class, 'facture_acompte'])->name('facture_acompte');
Route::get('facture/solde' ,[facture_controller::class, 'facture_solde'])->name('facture_solde');
Route::get('facture/index/get/last' ,[facture_controller::class, 'get_five_laste'])->name('facture_index_get_last');
Route::post('facture/store' ,[facture_controller::class, 'store'])->name('facture_store');
Route::delete('facture/delete/{id}',[facture_controller::class, 'delete'])->name('facture_delete');
Route::post('facture/update/{id}',[facture_controller::class, 'update'])->name('facture_update');
Route::post('get/facture/{id}',[facture_controller::class,'show'])->name('show facture');

Route::get('create/facture', [facture_view_controller::class, 'create'])->name('create_facture');
Route::get('facture/accueil', [facture_view_controller::class, 'accueil'])->name('facture_accueil');


//Route pour Location


Route::get('location/index' ,[location_controller::class, 'index'])->name('location_index');
Route::get('location/index/proforma' ,[location_controller::class, 'index_proforma'])->name('index_proforma');
Route::get('location/index/get/last' ,[location_controller::class, 'get_five_laste'])->name('location_index_get_last');
Route::post('location/store' ,[location_controller::class, 'store'])->name('location_store');
Route::delete('location/delete/{id}',[location_controller::class, 'delete'])->name('location_delete');
Route::post('location/update/{id}',[location_controller::class, 'update'])->name('location_update');
Route::get('create/location', [location_view_controller::class, 'create'])->name('create_location');
Route::get('location/accueil', [location_view_controller::class, 'accueil'])->name('location_accueil');
Route::post('get/location/by/id/{id}',[location_controller::class,'show'])->name('show_location');
//Route pour classe

Route::get('classe/all/paginate',[classe_controller::class, 'all_paginate'])->name('classe_all_paginate');
Route::get('classe/all',[classe_controller::class, 'all'])->name('classe_all');
Route::get('classe/get/last',[classe_controller::class, 'get_last_value'])->name('classe_last_values');
Route::post('classe/store',[classe_controller::class, 'store'])->name('classe_store');
Route::get('classe/show/{id}',[classe_controller::class,'show'])->name('classe_show');

Route::post('classe/update/{id}',[classe_controller::class,'update'])->name('classe_update');
Route::delete('classe/delete/{id}',[classe_controller::class, 'delete'])->name('classe_delete');
Route::get('classe/create' ,[classe_view_controller::class, 'create'])->name('classe_create');
Route::get('classe/index' ,[classe_view_controller::class, 'index'])->name('classe_index');


//Route pour batiment

Route::get('batiment/index/paginate',[batiment_controller::class, 'index_paginate'])->name('batiment_index_paginate');
Route::get('batiment/index',[batiment_controller::class, 'index'])->name('batiment_index');
Route::get('batiment/index/last/values',[batiment_controller::class, 'get_last_value'])->name('batiment_index_get_last');
Route::post('batiment/store',[batiment_controller::class, 'store'])->name('batiment_store');
Route::get('batiment/show/{id}',[batiment_controller::class,'show'])->name('batiment_show');
Route::post('batiment/update/{id}',[batiment_controller::class,'update'])->name('batiment_update');
Route::delete('batiment/delete/{id}',[batiment_controller::class, 'delete'])->name('batiment_delete');
Route::get('batiment/create' ,[batiment_view_controller::class, 'create'])->name('batiment_create');
Route::get('batiment/accueil',[batiment_view_controller::class, 'index'])->name('batiment_accueil');


//Route pour hebergement

Route::get('hebergement/index/paginate',[HebergementController::class, 'index_paginate'])->name('hebergement_index_paginate');
Route::get('hebergement/index',[HebergementController::class, 'index'])->name('hebergement_index');
Route::get('hebergement/get/last',[HebergementController::class, 'get_last_values'])->name('hebergement_get_last_value');
Route::post('hebergement/store',[HebergementController::class, 'store'])->name('hebergement_store');
Route::get('hebergement/show/{id}',[HebergementController::class,'show'])->name('hebergement_show');
Route::post('hebergement/update/{id}',[HebergementController::class,'update'])->name('hebergement_update');
Route::delete('hebergement/delete/{id}',[HebergementController::class, 'delete'])->name('hebergement_delete');

Route::get('hebergement/all',[HebergementController::class, 'all'])->name('hebergement_all');

//Route pour chambre

Route::get('chambre/index/paginate',[ChambreController::class, 'index_paginate'])->name('chambre_index_paginate');
Route::get('chambre/index',[ChambreController::class, 'index'])->name('chambre_index');
Route::get('chambre/get/last',[ChambreController::class, 'get_last_values'])->name('chambre_get_last_value');
Route::post('chambre/store',[ChambreController::class, 'store'])->name('chambre_store');
Route::get('chambre/show/{id}',[ChambreController::class,'show'])->name('chambre_show');
Route::post('chambre/update/{id}',[ChambreController::class,'update'])->name('chambre_update');
Route::delete('chambre/delete/{id}',[ChambreController::class, 'delete'])->name('chambre_delete');

Route::get('chambre/all',[ChambreController::class, 'all'])->name('chambre_all');


//Route pour salle

Route::get('salle/index/paginate',[salle_controller::class, 'index_paginate'])->name('salle_index_paginate');
Route::get('salle/index',[salle_controller::class, 'index'])->name('salle_index');
Route::get('salle/get/last',[salle_controller::class, 'get_last_values'])->name('salle_get_last_value');
Route::post('salle/store',[salle_controller::class, 'store'])->name('salle_store');
Route::get('salle/show/{id}',[salle_controller::class,'show'])->name('salle_show');
Route::post('salle/update/{id}',[salle_controller::class,'update'])->name('salle_update');
Route::delete('salle/delete/{id}',[salle_controller::class, 'delete'])->name('salle_delete');
Route::get('salle/create' ,[salle_view_controller::class, 'create'])->name('salle_create');

Route::get('salle/all',[salle_controller::class, 'all'])->name('salle_all');
Route::get('salle/accueil',[salle_view_controller::class, 'accueil'])->name('salle_accueil');


//ROUTE POUR SEMESTRe

Route::get('semestre/index',[semestre_controller::class, 'index'])->name('semestre_index');


//Route pour retard

Route::get('retard/index',[retard_controller::class, 'index'])->name('retard_index');
Route::post('retard/store',[retard_controller::class, 'store'])->name('retard_store');
Route::get('retard/show/{id}',[retard_controller::class,'show'])->name('retard_show');
Route::post('retard/update/{id}',[retard_controller::class,'update'])->name('retard_update');
Route::delete('retard/delete/{id}',[retard_controller::class, 'delete'])->name('retard_delete');
Route::get('retard/create' ,[retard_view_controller::class, 'create'])->name('retard_create');


Route::get('service/create', [service_view_controller::class, 'create'])->name('create_service_');
//Route::get('service/all',[service_controller::class, 'all'])->name('service_all');


Route::get('/role/home',[role_controller::class, 'index']);

//Surveillant
Route::get('surveillant/index',[surveillant_view_controller::class, 'index'])->name('surveillant_index');



//Route pour Comptable
Route::get('comptable/index',[comptable_controller::class, 'index'])->name('comptable_index');


Route::get('/role/home',[role_controller::class, 'index']);



//Route pour personnel administratif

Route::get('personnel_administratif/index',[personnel_administratif_controller::class, 'index'])->name('personnel_administratif_index');
Route::post('personnel_administratif/store',[personnel_administratif_controller::class, 'store'])->name('personnel_administratif_store');
Route::get('personnel_administratif/show/{id}',[personnel_administratif_controller::class,'show'])->name('personnel_administratif_show');
Route::put('personnel_administratif/update/{id}',[personnel_administratif_controller::class,'update'])->name('personnel_administratif_update');
Route::delete('personnel_administratif/delete/{id}',[personnel_administratif_controller::class, 'delete'])->name('personnel_administratif_delete');
Route::get('personnel_administratif/create' ,[personnel_administratif_view_controller::class, 'create'])->name('personnel_administratif_create');

//Route pour personnel appui

Route::get('personnel_appui/index',[personnel_appui_controller::class, 'index'])->name('personnel_appui_index');
Route::post('personnel_appui/store',[personnel_appui_controller::class, 'store'])->name('personnel_appui_store');
Route::get('personnel_appui/show/{id}',[personnel_appui_controller::class,'show'])->name('personnel_appui_show');
Route::put('personnel_appui/update/{id}',[personnel_appui_controller::class,'update'])->name('personnel_appui_update');
Route::delete('personnel_appui/delete/{id}',[personnel_appui_controller::class, 'delete'])->name('personnel_appui_delete');
Route::get('personnel_appui/create' ,[personnel_appui_view_controller::class, 'create'])->name('personnel_appui_create');

//Route pour recouvrement
Route::get('recouvrement/index' ,[recouvrement_view_controller::class, 'index'])->name('recouvrement_index');
//Route::put('/user/disable/{id}', 'UserController@disableUser');
Route::get('user_formateur/index' ,[unite_de_formation_controller::class, 'index'])->name('unite_de_formation_index_user');
Route::get('user/getpersoadminunique' ,[user_controller::class, 'getUniquementPersonnelAdministratif'])->name('getUniquementPersonnelAdministratif_user');
Route::post('recouvrement/filtre' ,[recouvrement_controller::class, 'filtre'])->name('recouvrement_filtre');
Route::post('recouvrement/saf' ,[recouvrement_controller::class, 'filtre_saf'])->name('recouvrement_filtre_saf');
//Route::get('/create-default-admin', [administrateur_view_controller::class, 'create_admin']);

Route::get('/imprimer-pdf', [ImprimerController::class, 'index'])->name('imprimer-pdf');
Route::get('caissier/inscription' ,[caissier_view_controller::class, 'inscription'])->name('validation_inscription');
Route::get('valider/paiement/inscription' ,[caissier_view_controller::class, 'valider'])->name('valider_paiement');
Route::get('valider/paiement/inscription/{id}' ,[caissier_view_controller::class, 'valider'])->name('valider_paiement_');


Route::get('recherche/code',[caissier_controller::class, 'recherche_id_inscription'])->name('recherche_id_inscription');
Route::post('caissier/valider-inscription/{id}' ,[caissier_controller::class, 'validerInscription'])->name('validerInscription');

//Route pour alerte 

Route::get('alerte/index',[alerte_controller::class, 'index'])->name('alerte_index');
Route::post('alerte/store',[alerte_controller::class, 'store'])->name('alerte_store');
Route::post('alerte/update/{id}',[alerte_controller::class,'update'])->name('alerte_update');
Route::delete('alerte/delete/{id}',[alerte_controller::class, 'delete'])->name('alerte_delete');
Route::get('alerte/create',[alerte_view_controller::class, 'create'])->name('alerte_create');

Route::get('alerte/showLatestAlert',[alerte_controller::class, 'showLatestAlert'])->name('alerte_show');
Route::put('/user/toggle-status/{id}',[user_controller::class, 'toggleUserStatus'])->name('user.toggle-status');

Route::get('reservation/index',[reservation_controller::class, 'index'])->name('reservation_index');
Route::get('reservation/index/paginate',[reservation_controller::class, 'indexpaginate'])->name('reservation_index_paginate');
Route::post('reservation/store',[reservation_controller::class, 'store'])->name('reservation_store');
Route::post('reservation/update/{id}',[reservation_controller::class,'update'])->name('reservation_update');
Route::get('stats/reservations',[reservation_controller::class,'getReservationsStats'])->name('reservation_stats');
Route::delete('reservation/delete/{id}',[reservation_controller::class, 'delete'])->name('reservation_delete');



//route paiement
Route::get('paiement_partenaire/index',[paiement_partenaire_controller::class, 'index'])->name('paiement_index_');
Route::get('paiement_partenaire/pagination',[paiement_partenaire_controller::class, 'indexpagination'])->name('paiement_index_paginate_');
//Route::get('paiement/get_last',[paiement_partenaire_controller::class, 'get_last'])->name('paiement_get_last');
Route::get('recherche/facture',[paiement_partenaire_controller::class, 'recherche_eleve'])->name('recherche_eleve_');
Route::get('/recherche/id_facture',[paiement_partenaire_controller::class, 'recherche_id_facture'])->name('recherche_id_facture');
Route::post('paiement_partenaire/store',[paiement_partenaire_controller::class, 'store'])->name('paiement_store');
Route::get('paiement_partenaire/show/{id}',[paiement_partenaire_controller::class, 'show'])->name('paiement_show');
Route::post('paiement_partenaire/update/{id}',[paiement_partenaire_controller::class, 'update'])->name('paiement_update');
Route::post('/paiement_partenaire/valider-facture/{id}',[paiement_partenaire_controller::class, 'validerFacture'])->name('valider_facture');
Route::delete('paiement_partenaire/delete/{id}',[paiement_partenaire_controller::class, 'destroy'])->name('paiement_delete');

});



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

/* Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
}); */

Route::middleware('auth:sanctum')->post('/logout', [connexion_controller::class, 'logout']);
Route::get('/create-default-admin', [administrateur_view_controller::class, 'create_admin']);
