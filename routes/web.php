<?php
use App\Http\Controllers\BoutiqueController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
 
use App\Http\Controllers\ProductController;


use App\Http\Controllers\ContactController;
use App\Http\Controllers\MemberController;


use App\Http\Controllers\HomeController;
use App\Http\Controllers\FormationController;
use App\Http\Controllers\InscriptionController;
use Illuminate\Support\Facades\Auth;

// routes/web.php

use App\Http\Controllers\AttestationController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\CartController;


Route::get('/attestations/show/{inscription}', [App\Http\Controllers\AttestationController::class, 'generate'])->name('attestation.show');


Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', [HomeController::class, 'index'])->name('home');


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


Route::get('/accueil', function () {
return view('accueil');
})->name('accueil');

// Routes publiques



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
Route::get('/panier', [CartController::class, 'index'])->name('cart.index');
Route::post('/panier/add/{productId}', [CartController::class, 'add'])->name('cart.add');
Route::post('/panier/remove/{productId}', [CartController::class, 'remove'])->name('cart.remove');

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
Route::get('/paiement/choix/{cart}', [App\Http\Controllers\PaymentController::class, 'choice'])->name('payment.choice');
Route::get('/payer-carte/{cart}', [App\Http\Controllers\PaymentController::class, 'card'])->name('payment.card');
Route::get('/payer-paypal/{cart}', [App\Http\Controllers\PaymentController::class, 'paypal'])->name('payment.paypal');

Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');

// Route d'envoi de newsletter par l'adminuse App\Http\Controllers\Admin\NewsletterController as AdminNewsletterController;

// Affichage de la page de gestion de la newsletter (formulaire + liste des inscrits)
// Routes pour la newsletter

use App\Http\Controllers\AdminNewsletterController;
Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/newsletter', [AdminNewsletterController::class, 'index'])->name('admin.newsletter');
    Route::post('/newsletter/send', [AdminNewsletterController::class, 'send'])->name('admin.newsletter.send');
});
// Envoi de la newsletter à tous les abonnés via le formulaire


    // Routes pour la newsletter (à ajouter dans routes/web.php)
Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/newsletter', [AdminNewsletterController::class, 'index'])->name('admin.newsletter');
    Route::post('/newsletter/send', [AdminNewsletterController::class, 'send'])->name('admin.newsletter.send');
});


    Route::resource('members', MemberController::class);


    use App\Http\Controllers\FrontendController;

Route::get('/about', [FrontendController::class, 'about'])->name('about');
use App\Http\Controllers\ChatbotController;

// Routes pour le chatbot
Route::get('/chatbot', [ChatbotController::class, 'index'])->name('chatbot.index');
Route::post('/chatbot/send', [ChatbotController::class, 'sendMessage'])->name('chatbot.send');
Route::get('/chatbot/test', [ChatbotController::class, 'testOpenAI'])->name('chatbot.test');


use App\Http\Controllers\PasswordResetController;

// Routes pour réinitialisation de mot de passe
Route::get('/forgot-password', [PasswordResetController::class, 'showLinkRequestForm'])
    ->name('password.request');
    
Route::post('/forgot-password', [PasswordResetController::class, 'sendResetLinkEmail'])
    ->name('password.email');
    
Route::get('/reset-password/{token}', [PasswordResetController::class, 'showResetForm'])
    ->name('password.reset');
    
Route::post('/reset-password', [PasswordResetController::class, 'reset'])
    ->name('password.update');
