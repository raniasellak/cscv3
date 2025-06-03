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

// routes/web.php

use App\Http\Controllers\AttestationController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\CartController;

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
Route::get('/admin/newsletter', [NewsletterController::class, 'index'])
    ->name('admin.newsletter')
    ->middleware('auth');

// Envoi de la newsletter à tous les abonnés via le formulaire
Route::post('/admin/newsletter/send', [AdminNewsletterController::class, 'send'])
    ->name('admin.newsletter.send')
    ->middleware('auth');