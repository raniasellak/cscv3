<?php
use App\Http\Controllers\BoutiqueController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FormationController;
use App\Http\Controllers\InscriptionController;
use Illuminate\Support\Facades\Auth;

// routes/web.php

use App\Http\Controllers\AttestationController;
// routes/web.php

use App\Http\Controllers\EvenementController;

Route::resource('evenements', EvenementController::class);


Route::get('/attestations/show/{inscription}', [App\Http\Controllers\AttestationController::class, 'generate'])->name('attestation.show');


Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');



Route::get('/admin', function () {
    if (Auth::check() && Auth::user()->role === 'admin') {
        return view('admin.dashboard');
    }
    abort(403, 'Accès réservé aux administrateurs.');
})->middleware('auth')->name('admin.dashboard');

// Routes publiques
Route::get('/', [HomeController::class, 'index'])->name('home');



Route::resource('formations', FormationController::class);


Route::post('/formations/{formationId}/quick-register', [InscriptionController::class, 'quickRegister'])->name('inscriptions.quick');

Route::put('/formations/{formation}/presence', [FormationController::class, 'updatePresence'])->name('formations.presence');
Route::get('/boutique', [BoutiqueController::class, 'index'])->name('boutique.index');
Route::get('/boutique/category/{id}', [BoutiqueController::class, 'showByCategory'])->name('boutique.category');
// Route pour afficher la liste ou le formulaire (GET)
Route::get('/evenements', [App\Http\Controllers\EvenementController::class, 'index'])->name('evenements.index');

// Route pour afficher le formulaire de création (GET)
Route::get('/evenements/create', [App\Http\Controllers\EvenementController::class, 'create'])->name('evenements.create');

// Route pour traiter la création (POST)
Route::post('/evenements', [App\Http\Controllers\EvenementController::class, 'store'])->name('evenements.store');
Route::get('evenements/{evenement}', [EvenementController::class, 'show'])->name('evenements.show');
Route::get('evenements/{evenement}/edit', [EvenementController::class, 'edit'])->name('evenements.edit');
Route::put('evenements/{evenement}', [EvenementController::class, 'update'])->name('evenements.update');
