<?php

use App\Http\Controllers\matiere\matiere_controller;
use App\Http\Controllers\organisme\organisme_controller;
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

//Route de matiere

Route::get('matiere/index', [matiere_controller::class, 'index'])->name('matiere_index');
Route::post('matiere/store',[matiere_controller::class, 'store'])->name('matiere_store');
Route::put('matiere/update/{id}', [matiere_controller::class, 'update'])->name('matiere_update');
Route::delete('matiere/delete/{id}',[matiere_controller::class, 'delete'])->name('matiere_delete');
Route::get('matiere/get/{id}',[matiere_controller::class, 'get'])->name('matiere_get');

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



