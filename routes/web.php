<?php
use App\Http\Controllers\BoutiqueController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
 
use App\Http\Controllers\ProductController;


use App\Http\Controllers\ContactController;


Route::get('/test-route', function() {
    return "Test route works!";
});
Route::get('/', function () {
    return view('welcome');
});
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
        'quelle est la mission du club ?' => "Notre mission est d'encourager l'innovation, l'apprentissage et la collaboration en informatique."
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
// Route pour afficher la liste ou le formulaire (GET)
Route::get('/evenements', [App\Http\Controllers\EvenementController::class, 'index'])->name('evenements.index');

// Route pour afficher le formulaire de création (GET)
Route::get('/evenements/create', [App\Http\Controllers\EvenementController::class, 'create'])->name('evenements.create');

// Route pour traiter la création (POST)
Route::post('/evenements', [App\Http\Controllers\EvenementController::class, 'store'])->name('evenements.store');
Route::get('evenements/{evenement}', [EvenementController::class, 'show'])->name('evenements.show');
Route::get('evenements/{evenement}/edit', [EvenementController::class, 'edit'])->name('evenements.edit');
Route::put('evenements/{evenement}', [EvenementController::class, 'update'])->name('evenements.update');



// Afficher le formulaire d'ajout de produit
Route::resource('products', ProductController::class);

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('products', ProductController::class);
});

// Routes pour le panier
Route::get('/panier', function() {
    return view('boutique.cart');
})->name('cart.index');
Route::post('/panier/remove/{id}', function($id) {
    $cart = session('cart', []);
    unset($cart[$id]);
    session(['cart' => $cart]);
    return redirect()->route('cart.index');
})->name('cart.remove');

// Routes pour les favoris
Route::get('/favoris', function() {
    return view('boutique.favorites');
})->name('favorites.index');
Route::post('/favoris/remove/{id}', function($id) {
    $favorites = session('favorites', []);
    unset($favorites[$id]);
    session(['favorites' => $favorites]);
    return redirect()->route('favorites.index');
})->name('favorites.remove');

// Ajouter au panier
Route::post('/panier/add/{id}', function($id) {
    $product = \App\Models\Product::findOrFail($id);
    $cart = session('cart', []);
    $cart[$id] = [
        'id' => $product->id,
        'name' => $product->name,
        'description' => $product->description,
        'image' => $product->image,
        'price' => $product->price
    ];
    session(['cart' => $cart]);
    return redirect()->back()->with('success', 'Produit ajouté au panier !');
})->name('cart.add');

// Ajouter aux favoris
Route::post('/favoris/add/{id}', function($id) {
    $product = \App\Models\Product::findOrFail($id);
    $favorites = session('favorites', []);
    $favorites[$id] = [
        'id' => $product->id,
        'name' => $product->name,
        'description' => $product->description,
        'image' => $product->image,
        'price' => $product->price
    ];
    session(['favorites' => $favorites]);
    return redirect()->back()->with('success', 'Produit ajouté aux favoris !');
})->name('favorites.add');

// Page de paiement pour un produit du panier
Route::get('/paiement/{id}', function($id) {
    $cart = session('cart', []);
    $product = $cart[$id] ?? null;
    if (!$product) {
        return redirect()->route('cart.index')->with('error', 'Produit non trouvé dans le panier.');
    }
    return view('boutique.payment', compact('product'));
})->name('payment.show');

// Page de choix du mode de paiement
Route::get('/paiement/choix/{id}', function($id) {
    $cart = session('cart', []);
    $product = $cart[$id] ?? null;
    if (!$product) {
        return redirect()->route('cart.index')->with('error', 'Produit non trouvé dans le panier.');
    }
    return view('boutique.payment_choice', compact('product'));
})->name('payment.choice');
