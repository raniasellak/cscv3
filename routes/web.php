<?php
use App\Http\Controllers\BoutiqueController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
<<<<<<< HEAD
use App\Http\Controllers\ProductController;

=======
use App\Http\Controllers\ContactController;
>>>>>>> 22c5250e2d9af7561966673af9c1a7d6a4dd1b56

Route::get('/test-route', function() {
    return "Test route works!";
});
Route::get('/', function () {
    return view('welcome');
});
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

Route::get('/contact', [ContactController::class, 'show'])->name('contact.show');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

Route::get('/about', function () {
    return view('about');
})->name('about');
Route::post('/chatbot', function (\Illuminate\Http\Request $request) {
    $message = strtolower($request->input('message'));

    $reponses = [
        'quand le club a-t-il été fondé ?' => 'Le CSC a été fondé en 2025.',
        'quelles sont les cellules du club ?' => 'Les cellules sont : Développement, Cybersécurité et Intelligence Artificielle.',
        'qui fait partie du grand bureau ?' => 'Le grand bureau comprend le président, vice-président, secrétaire général, trésorier général, responsable communication, formation et design.',
        'quelle est la mission du club ?' => 'Notre mission est d’encourager l’innovation, l’apprentissage et la collaboration en informatique.'
    ];

    foreach ($reponses as $question => $reponse) {
        if (str_contains($message, strtolower($question))) {
            return response()->json(['reply' => $reponse]);
        }
    }

    return response()->json(['reply' => "Désolé, je ne comprends pas cette question."]);
});
Route::get('/accueil', function () {
return view('accueil');
})->name('accueil');

// Routes publiques
Route::get('/', [HomeController::class, 'index'])->name('home');




Route::resource('formations', FormationController::class);


Route::post('/formations/{formationId}/quick-register', [InscriptionController::class, 'quickRegister'])->name('inscriptions.quick');

Route::put('/formations/{formation}/presence', [FormationController::class, 'updatePresence'])->name('formations.presence');
Route::get('/boutique', [BoutiqueController::class, 'index'])->name('boutique.index');
Route::get('/boutique/category/{id}', [BoutiqueController::class, 'showByCategory'])->name('boutique.category');
<<<<<<< HEAD


// Afficher le formulaire d'ajout de produit
Route::resource('products', ProductController::class);

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('products', ProductController::class);
});
=======
>>>>>>> 22c5250e2d9af7561966673af9c1a7d6a4dd1b56
