<?php

use App\Http\Controllers\caissier\caissier_controller;
use App\Http\Controllers\consultation\consultation_controller;
use App\Http\Controllers\cours\cours_controller;
use App\Http\Controllers\emprunter_materiel\emprunter_materiel_controller;
use App\Http\Controllers\inscription\inscription_controller;
use App\Http\Controllers\note\note_controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\type_materiel\type_materiel_controller;

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

//Route type materiel

Route::get('Type_materiel/index',[type_materiel_controller::class, 'index'])->name('type_materiel_index');
Route::post('type_materiel/store',[type_materiel_controller::class, 'store'])->name('type_materiel_store');
Route::get('type_materiel/show/{$id}',[type_materiel_controller::class,'show'])->name('type_materiel_show');
Route::put('type_materiel/update/{$id}',[type_materiel_controller::class,'update'])->name('type_materiel_update');
Route::destory('type_materiel/destory/{$id}',[type_materiel_controller::class, 'destory'])->name('type_materiel_destory');

//Route pour caissier
Route::get('caissier/index',[caissier_controller::class, 'index'])->name('caissier_index');
Route::post('caissier/store',[caissier_controller::class, 'store'])->name('caissier_store');
Route::get('caissier/show/{$id}',[caissier_controller::class,'show'])->name('caissier_show');
Route::put('caissier/update/{$id}',[caissier_controller::class,'update'])->name('caissier_update');
Route::destory('caissier/destory/{$id}',[caissier_controller::class, 'destory'])->name('caissier_destory');

//Route pour note

Route::get('note/index',[note_controller::class, 'index'])->name('note_index');
Route::post('note/store',[note_controller::class, 'store'])->name('note_store');
Route::get('note/show/{$id}',[note_controller::class,'show'])->name('note_show');
Route::put('note/update/{$id}',[note_controller::class,'update'])->name('note_update');
Route::destory('note/destory/{$id}',[note_controller::class, 'destory'])->name('note_destory');

//Route pour cour

Route::get('cour/index',[cours_controller::class, 'index'])->name('cour_index');
Route::post('cour/store',[cour_controller::class, 'store'])->name('cour_store');
Route::get('cour/show/{$id}',[cour_controller::class,'show'])->name('cour_show');
Route::put('cour/update/{$id}',[cour_controller::class,'update'])->name('cour_update');
Route::destory('cour/destory/{$id}',[cour_controller::class, 'destory'])->name('cour_destory');

//Route pourinscription

Route::get('inscription/index',[inscription_controller::class, 'index'])->name('inscription_index');
Route::post('inscription/store',[inscription_controller::class, 'store'])->name('inscription_store');
Route::get('inscription/show/{$id}',[inscription_controller::class,'show'])->name('inscription_show');
Route::put('inscription/update/{$id}',[inscription_controller::class,'update'])->name('inscription_update');
Route::destory('inscription/destory/{$id}',[inscription_controller::class, 'destory'])->name('inscription_destory');

//Route pour emprunter materiel

Route::get('emprunter_materiel/index',[emprunter_materiel_controller::class, 'index'])->name('emprunter_materiel_index');
Route::post('emprunter_materiel/store',[emprunter_materiel_controller::class, 'store'])->name('emprunter_materiel_store');
Route::get('emprunter_materiel/show/{$id}',[emprunter_materiel_controller::class,'show'])->name('emprunter_materiel_show');
Route::put('emprunter_materiel/update/{$id}',[emprunter_materiel_controller::class,'update'])->name('emprunter_materiel_update');
Route::destory('emprunter_materiel/destory/{$id}',[emprunter_controller::class, 'destory'])->name('emprunter_materiel_destory');

//Route pour consultation

Route::get('consultation/index',[consultation_controller::class, 'index'])->name('consultation_index');
Route::post('consultation/store',[consultation_controller::class, 'store'])->name('consultation_store');
Route::get('consultation/show/{$id}',[consultation_controller::class,'show'])->name('consultation_show');
Route::put('consultation/update/{$id}',[cosultation_controller::class,'update'])->name('consultation_update');
Route::destory('consultation/destory/{$id}',[consulation_controller::class, 'destory'])->name('consultation_destory');










