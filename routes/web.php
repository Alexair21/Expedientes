<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BackupController;
use App\Http\Controllers\CarpetaController;
use App\Http\Controllers\ExpedienteController;
use App\Http\Controllers\ProyectoController;
use App\Http\Controllers\DocumentoController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\SubcarpetasIController;
use App\Http\Controllers\ArchivosIController;
use App\Http\Controllers\CarpetasIController;

use App\Http\Controllers\SubcarpetaController;
use App\Http\Controllers\DocumentosIController;
use App\Http\Controllers\DocumentosEController;

use App\Http\Controllers\CarpetaUnoController;
use App\Http\Controllers\CarpetaDosController;
use App\Http\Controllers\CarpetaTresController;
use App\Http\Controllers\CarpetaCuatroController;
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
    return view('auth.login');
});

Auth::routes();
Route::resource('roles', RolController::class);
Route::resource('usuarios', UsuarioController::class);
Route::resource('expedientes', ExpedienteController::class);
Route::resource('proyectos', ProyectoController::class);
Route::resource('documentos', DocumentoController::class);
Route::resource('carpetas', CarpetaController::class);


Route::resource('carpetauno', CarpetaUnoController::class);
Route::get('/carpetauno/{id}', [CarpetaUnoController::class, 'ver'])->name('carpetauno.ver');

Route::resource('carpetados', CarpetaDosController::class);
Route::get('/carpetados/arch/{carpeta_uno}', [CarpetaDosController::class, 'arch'])->name('carpetados.arch');

Route::resource('carpetatres', CarpetaTresController::class);
Route::get('/carpetatres/arch/{carpeta_dos}', [CarpetaTresController::class, 'arch'])->name('carpetatres.arch');

Route::resource('carpetacuatro', CarpetaCuatroController::class);
Route::get('/carpetacuatro/arch/{carpeta_tres}', [CarpetaCuatroController::class, 'arch'])->name('carpetacuatro.arch');


Route::post('/buscarExpediente', [ExpedienteController::class, 'buscarExpediente'])->name('buscarExpediente');



Route::get('/home', 'HomeController@index')->name('home');

Route::get('/profile', 'ProfileController@index')->name('profile');
Route::put('/profile', 'ProfileController@update')->name('profile.update');

Route::post('/buscarProyecto', [ProyectoController::class, 'buscarProyecto'])->name('buscarProyecto');

Route::get('/inicio', function () {
    return view('inicio');
})->name('inicio');

Route::get('/b_expediente', function () {
    return view('busqueda_expediente');
})->name('b_expediente');


Route::get('/about', function () {
    return view('about');
})->name('about');
