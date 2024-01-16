<?php

use App\Http\Controllers\FichaController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\IndexController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/index/{id_documento}', [IndexController::class, 'index'])->name('index');
//ruta ficha

Route::post('/imagenes', [ImageController::class, 'index'])->name('formImg');

Route::get('/ficha/{clavec}/{id_documento}/{id_usuario}', [FichaController::class, 'ficha'])->name('ficha');
//Buscador
Route::post('/search', [IndexController::class, 'show'])->name('search');
//formulario
Route::post('/formulario', [FichaController::class, 'index'])->name('form');


//guardar datos ficha
Route::post('/registro', [FichaController::class, 'store'])->name('guardar-ficha');
//view Fichas del dia
Route::post('/fichas-del-dia', [FichaController::class, 'viewFichasNow'])->name('viewFichas');
//view Fichas all
Route::get('/fichas-generadas/{id_usuario}', [FichaController::class, 'viewFichasall'])->name('viewFichasall');

