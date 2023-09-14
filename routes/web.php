<?php

use App\Http\Controllers\batiment\batiment_controller;
use App\Http\Controllers\classe\classe_controller;
use App\Http\Controllers\direction\direction_controller;
use App\Http\Controllers\retard\retard_controller;
use App\Http\Controllers\role\role_controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\roleController;
use App\Http\Controllers\salle\salle_controller;
use App\Http\Controllers\service\service_controller;

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

//Route de role
Route::get('role/index', [role_controller::class, 'index'])->name('role_index');
Route::get('role/index/{id}', [role_controller::class, 'show'])->name('role_show');
Route::post('role/create', [role_controller::class, 'create'])->name('role_create');
Route::put('role/update/{id}', [role_controller::class, 'update'])->name('role_update');
Route::delete('role/delete/{id}', [role_controller::class, 'delete'])->name('role_delete');

//Route de direction
Route::get('direction/index', [direction_controller::class, 'index'])->name('direction_index');
Route::get('direction/index/{id}', [direction_controller::class, 'show'])->name('direction_show');
Route::post('direction/create', [direction_controller::class, 'create'])->name('direction_create');
Route::put('direction/update/{id}', [direction_controller::class, 'update'])->name('direction_update');
Route::delete('direction/delete/{id}', [direction_controller::class, 'delete'])->name('direction_delete');

//Route de service
Route::get('service/index', [service_controller::class, 'index'])->name('service_index');
Route::get('service/index/{id}', [service_controller::class, 'show'])->name('service_show');
Route::post('service/create', [service_controller::class, 'create'])->name('service_create');
Route::put('service/update/{id}', [service_controller::class, 'update'])->name('service_update');
Route::delete('service/delete/{id}', [service_controller::class, 'delete'])->name('service_delete');

//Route de classe
Route::get('classe/index', [classe_controller::class, 'index'])->name('classe_index');
Route::get('classe/index/{id}', [classe_controller::class, 'show'])->name('classe_show');
Route::post('classe/create', [classe_controller::class, 'create'])->name('classe_create');
Route::put('classe/update/{id}', [classe_controller::class, 'update'])->name('classe_update');
Route::delete('classe/delete/{id}', [classe_controller::class, 'delete'])->name('classe_delete');

//Route de salle
Route::get('salle/index', [salle_controller::class, 'index'])->name('salle_index');
Route::get('salle/index/{id}', [salle_controller::class, 'show'])->name('salle_show');
Route::post('salle/create', [salle_controller::class, 'create'])->name('salle_create');
Route::put('salle/update/{id}', [salle_controller::class, 'update'])->name('salle_update');
Route::delete('salle/delete/{id}', [salle_controller::class, 'delete'])->name('salle_delete');

//Route de retard
Route::get('retard/index', [retard_controller::class, 'index'])->name('retard_index');
Route::get('retard/index/{id}', [retard_controller::class, 'show'])->name('retard_show');
Route::post('retard/create', [retard_controller::class, 'create'])->name('retard_create');
Route::put('retard/update/{id}', [retard_controller::class, 'update'])->name('retard_update');
Route::delete('retard/delete/{id}', [retard_controller::class, 'delete'])->name('retard_delete');

//Route de batiment
Route::get('batiment/index', [batiment_controller::class, 'index'])->name('batiment_index');
Route::get('batiment/index/{id}', [batiment_controller::class, 'show'])->name('batiment_show');
Route::post('batiment/create', [batiment_controller::class, 'create'])->name('batiment_create');
Route::put('batiment/update/{id}', [batiment_controller::class, 'update'])->name('batiment_update');
Route::delete('batiment/delete/{id}', [batiment_controller::class, 'delete'])->name('batiment_delete');
