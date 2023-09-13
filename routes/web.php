<?php

use App\Http\Controllers\eleve\eleve_controller;
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

//route eleve 
Route::get('eleve/index',[eleve_controller::class, 'index'])->name('eleve_index');
Route::post('eleve/store',[eleve_controller::class, 'store'])->name('eleve_store');
Route::get('eleve/show/{id}',[eleve_controller::class, 'show'])->name('eleve_show');
Route::put('eleve/update/{id}',[eleve_controller::class, 'update'])->name('eleve_update');
Route::delete('eleve/delete/{id}',[eleve_controller::class, 'destroy'])->name('eleve_delete');

//route emprunter livre 
Route::get('emprunter_livre/index',[emprunter_livre_controller::class, 'index'])->name('emprunter_livre_index');
Route::post('emprunter_livre/store',[emprunter_livre_controller::class, 'store'])->name('emprunter_livre_store');
Route::get('emprunter_livre/show/{id}',[emprunter_livre_controller::class, 'show'])->name('emprunter_livre_show');
Route::put('emprunter_livre/update/{id}',[emprunter_livre_controller::class, 'update'])->name('emprunter_livre_update');
Route::delete('emprunter_livre/delete/{id}',[emprunter_livre_controller::class, 'destroy'])->name('emprunter_livre_delete');
Route::put('emprunter_livre/rendre/{id}',[emprunter_livre_controller::class, 'rendre'])->name('emprunter_livre_rendre');


//route formation
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
Route::delete('materiel/delete/{id}',[materiel_controller::class, 'destroy'])->name('materiel_delete');

//route seminaire
Route::get('seminaire/index',[seminaire_controller::class, 'index'])->name('seminaire_index');
Route::post('seminaire/store',[seminaire_controller::class, 'store'])->name('seminaire_store');
Route::get('seminaire/show/{id}',[seminaire_controller::class, 'show'])->name('seminaire_show');
Route::put('seminaire/update/{id}',[seminaire_controller::class, 'update'])->name('seminaire_update');
Route::delete('seminaire/delete/{id}',[seminaire_controller::class, 'destroy'])->name('seminaire_delete');
