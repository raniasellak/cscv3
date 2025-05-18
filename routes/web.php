<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FormationController;
use App\Http\Controllers\InscriptionController;

// routes/web.php

use App\Http\Controllers\AttestationController;

Route::get('/attestations/show/{inscription}', [AttestationController::class, 'generate'])->name('attestations.show');

Route::get('/attestations/show/{inscription}', [App\Http\Controllers\AttestationController::class, 'generate'])->name('attestation.show');


Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');



Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard')->middleware('auth');

Route::get('/user/index', function () {
    return view('user.index');
})->name('user.index')->middleware('auth');


// Routes publiques
Route::get('/', [HomeController::class, 'index'])->name('home');




Route::resource('formations', FormationController::class);


Route::post('/formations/{formationId}/quick-register', [InscriptionController::class, 'quickRegister'])->name('inscriptions.quick');

Route::put('/formations/{formation}/presence', [FormationController::class, 'updatePresence'])->name('formations.presence');
