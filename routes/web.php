<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;

Route::get('/test-route', function() {
    return "Test route works!";
});
Route::get('/', function () {
    return view('welcome');
});



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