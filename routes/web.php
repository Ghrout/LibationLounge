<?php

use App\Http\Controllers\CocktailController;
use Illuminate\Support\Facades\Route;

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


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// Rutas para gestionar cócteles (solo accesibles para usuarios autenticados)
Route::middleware('auth')->group(function () {
    Route::get('/cocktails/index', [CocktailController::class, 'index'])->name('cocktail.index');
    Route::get('/cocktails/manage', [CocktailController::class, 'manage'])->name('manage'); 
});

// Ruta para crear un nuevo cóctel
Route::get('/cocktails/create', function () {
    return view('cocktails.create');
})->name('cocktail.create');

// Ruta para almacenar un nuevo cóctel
Route::post('/cocktails', [CocktailController::class, 'store'])->name('cocktail.store');
