<?php

use App\Http\Controllers\annee_academique\annee_academique_controller;
use App\Http\Controllers\archive\archive_controller;
use App\Http\Controllers\auteur\auteur_controller;
use App\Http\Controllers\bibliothecaire\bibliothecaire_controller;
use App\Http\Controllers\categorie\categorie_controller;
use App\Http\Controllers\date_emprunter\date_emprunter_controller;
use App\Http\Controllers\departement\departement_controller;
use App\Http\Controllers\dossier_medical\dossier_medical_controller;
use App\Http\Controllers\editeur\editeur_controller;
use App\Http\Controllers\edition\edition_controller;
use App\Http\Controllers\eleve\eleve_controller;
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
use App\Http\Controllers\inscription\inscription_controller;
use App\Http\Controllers\matiere\matiere_controller;
use App\Http\Controllers\note\note_controller;
use App\Http\Controllers\organisme\organisme_controller;
use App\Http\Controllers\paiement\paiement_controller;
use App\Http\Controllers\partenaire\partenaire_controller;
use App\Http\Controllers\participer\participer_controller;
use App\Http\Controllers\rayon\rayon_controller;
use App\Http\Controllers\ressource_pedagogique\ressource_pedagogique_controller;
use App\Http\Controllers\seminaire\seminaire_controller;
use App\Http\Controllers\specialite\specialite_controller;
use App\Http\Controllers\tuteur\tuteur_controller;
use App\Http\Controllers\type_formation\type_formation_controller;
use App\Http\Controllers\unite_de_formation\unite_de_formation_controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\roleController;
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
Route::get('/role/home',[roleController::class, 'index']);
