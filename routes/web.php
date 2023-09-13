<?php

use App\Http\Controllers\auteur\auteur_controller;
use App\Http\Controllers\bibliothecaire\bibliothecaire_controller;
use App\Http\Controllers\categorie\categorie_controller;
use App\Http\Controllers\editeur\editeur_controller;
use App\Http\Controllers\examplaire\exemplaire_controller;
use App\Http\Controllers\livre\livre_controller;
use App\Http\Controllers\rayon\rayon_controller;
use App\Http\Controllers\ressource_pedagogique\ressource_pedagogique_controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\user\user_controller;

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

//Route de User
Route::get('user/index', [user_controller::class, 'index'])->name('user_index');
Route::post('user/store',[user_controller::class,'store'])->name('user_store');
Route::get('user/show/{id}',[user_controller::class, 'show'])->name('user_show');
Route::put('user/update/{id}',[user_controller::class, 'update'])->name('user_update');
Route:: delete('user/delete/{id}',[user_controller::class, 'delete'])->name('user_delete');

//Route de livre
Route::get('livre/index', [livre_controller::class, 'index'])->name('livre_index');
Route::post('livre/store',[livre_controller::class,'store'])->name('livre_store');
Route::get('livre/show/{id}',[livre_controller::class, 'show'])->name('livre_show');
Route::put('livre/update/{id}',[livre_controller::class, 'update'])->name('livre_update');
Route:: delete('livre/delete/{id}',[livre_controller::class, 'delete'])->name('livre_delete');

//Route de categorie
Route::get('categorie/index', [categorie_controller::class, 'index'])->name('categorie_index');
Route::post('categorie/store',[categorie_controller::class,'store'])->name('categorie_store');
Route::get('categorie/show/{id}',[categorie_controller::class, 'show'])->name('categorie_show');
Route::put('categorie/update/{id}',[categorie_controller::class, 'update'])->name('categorie_update');
Route:: delete('categorie/delete/{id}',[categorie_controller::class, 'delete'])->name('categorie_delete');

//Route de auteur
Route::get('auteur/index', [auteur_controller::class, 'index'])->name('auteuri_ndex');
Route::post('auteur/store',[auteur_controller::class,'store'])->name('auteurs_tore');
Route::get('auteur/show/{id}',[auteur_controller::class, 'show'])->name('auteur_show');
Route::put('auteur/update/{id}',[auteur_controller::class, 'update'])->name('auteur_update');
Route:: delete('auteur/delete/{id}',[auteur_controller::class, 'delete'])->name('auteur_delete');

//Route de editeur
Route::get('editeur/index', [editeur_controller::class, 'index'])->name('editeur_index');
Route::post('editeur/store',[editeur_controller::class,'store'])->name('editeur_store');
Route::get('editeur/show/{id}',[editeur_controller::class, 'show'])->name('editeur_show');
Route::put('editeur/update/{id}',[editeur_controller::class, 'update'])->name('editeur_update');
Route:: delete('editeur/delete/{id}',[editeur_controller::class, 'delete'])->name('editeur_delete');

//Route de rayon
Route::get('rayon/index', [rayon_controller::class, 'index'])->name('rayon_index');
Route::post('rayon/store',[rayon_controller::class,'store'])->name('rayon_store');
Route::get('rayon/show/{id}',[rayon_controller::class, 'show'])->name('rayon_show');
Route::put('rayon/update/{id}',[rayon_controller::class, 'update'])->name('rayon_update');
Route:: delete('rayon/delete/{id}',[rayon_controller::class, 'delete'])->name('rayon_delete');

//Route de bibliothecaire
Route::get('bibliothecaire/index', [bibliothecaire_controller::class, 'index'])->name('bibliothecaire_index');
Route::post('bibliothecaire/store',[bibliothecaire_controller::class,'store'])->name('bibliothecaire_store');
Route::get('bibliothecaire/show/{id}',[bibliothecaire_controller::class, 'show'])->name('bibliothecaire_show');
Route::put('bibliothecaire/update/{id}',[bibliothecaire_controller::class, 'update'])->name('bibliothecaire_update');
Route:: delete('bibliothecaire/delete/{id}',[bibliothecaire_controller::class, 'delete'])->name('bibliothecaire_delete');

//Route de exemplaire
Route::get('exemplaire/index', [exemplaire_controller::class, 'index'])->name('exemplaire_index');
Route::post('exemplaire/store',[exemplaire_controller::class,'store'])->name('exemplaire_store');
Route::get('exemplaire/show/{id}',[exemplaire_controller::class, 'show'])->name('exemplaire_show');
Route::put('exemplaire/update/{id}',[exemplairec_ontroller::class, 'update'])->name('exemplaire_update');
Route:: delete('exemplaire/delete/{id}',[exemplaire_controller::class, 'delete'])->name('exemplaire_delete');

//Route de ressource_pedagogique
Route::get('ressource_pedagogique/index', [ressource_pedagogique_controller::class, 'index'])->name('ressource_pedagogique_index');
Route::post('ressource_pedagogique/store',[ressource_pedagogique_controller::class,'store'])->name('ressource_pedagogique_store');
Route::get('ressource_pedagogique/show/{id}',[ressource_pedagogique_controller::class, 'show'])->name('ressource_pedagogique_show');
Route::put('ressource_pedagogique/update/{id}',[ressource_pedagogique_controller::class, 'update'])->name('ressource_pedagogique_update');
Route:: delete('ressource_pedagogique/delete/{id}',[ressource_pedagogique_controller::class, 'delete'])->name('ressource_pedagogique_delete');
