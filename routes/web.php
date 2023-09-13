<?php

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

Route::get('participer/index', [participer_controller::class, 'index']) -> name('participer_index');
Route::get('participer/ajouter', [participer_controller::class, 'ajouter']) -> name('participer_ajouter');
Route::get('participer/mise_a_jour', [participer_controller::class, 'mise_a_jour']) -> name('participer_mise_a_jour');
Route::get('participer/delete', [participer_controller::class, 'delete']) -> name('participer_delete');
Route::get('participer/show', [participer_controller::class, 'show']) -> name('participer_show');

Route::get('specialite/index', [specialitecontroller::class, 'index']) -> name('specialite_index');
Route::get('specialite/ajouter', [specialite_controller::class, 'ajouter']) -> name('specialite_ajouter');
Route::get('specialite/mise_a_jour', [specialite_controller::class, 'mise_a_jour']) -> name('specialite_mise_a_jour');
Route::get('specialite/delete', [specialite_controller::class, 'delete']) -> name('specialite_delete');
Route::get('specialite/show', [specialite_controller::class, 'show']) -> name('specialite_show');

Route::get('annee_academique/index', [annee_academique_controller::class, 'index']) -> name('annee_academique_index');
Route::get('annee_academique/ajouter', [annee_academique_controller::class, 'ajouter']) -> name('annee_academique_ajouter');
Route::get('annee_academique/mise_a_jour', [annee_academique_controller::class, 'mise_a_jour']) -> name('annee_academique_mise_a_jour');
Route::get('annee_academique/delete', [annee_academique_controller::class, 'delete']) -> name('annee_academique_delete');
Route::get('annee_academique/show', annee_academique_controller::class, 'show']) -> name('annee_academique_show');

Route::get('departement/index', [departement_controller::class, 'index']) -> name('departement_index');
Route::get('departement/ajouter', [departement_controller::class, 'ajouter']) -> name('departement_ajouter');
Route::get('departement/mise_a_jour', [departement_controller::class, 'mise_a_jour']) -> name('departement_mise_a_jour');
Route::get('departement/delete', [departement_controller::class, 'delete']) -> name('departement_delete');
Route::get('departement/show', [departement_controller::class, 'show']) -> name('departement_show');

Route::get('tuteur/index', [tuteur_controller::class, 'index']) -> name('tuteur_index');
Route::get('tuteur/ajouter', [tuteur_controller::class, 'ajouter']) -> name('tuteur_ajouter');
Route::get('tuteur/mise_a_jour', [tuteur_controller::class, 'mise_a_jour']) -> name('tuteur_mise_a_jour');
Route::get('tuteur/delete', [tuteur_controller::class, 'delete']) -> name('tuteur_delete');
Route::get('tuteur/show', [tuteur_controller::class, 'show']) -> name('tuteur_show');

Route::get('paiement/index', [paiement_controller::class, 'index']) -> name('paiement_index');
Route::get('paiement/ajouter', [paiement_controller::class, 'ajouter']) -> name('paiement_ajouter');
Route::get('paiement/mise_a_jour', [paiement_controller::class, 'mise_a_jour']) -> name('paiement_mise_a_jour');
Route::get('paiement/delete', [paiement_controller::class, 'delete']) -> name('paiement_delete');
Route::get('paiement/show', [paiement_controller::class, 'show']) -> name('paiement_show');

