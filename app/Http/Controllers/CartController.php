<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Afficher le panier
    public function index()
    {
        $cart = $this->getCart();
        return view('cart.index', ['cart' => $cart]);
    }

    // Ajouter un produit
    public function add(Request $request, $productId)
    {
        $cart = $this->getCart();
        $product = Product::findOrFail($productId);

        $cart->products()->syncWithoutDetaching([
            $product->id => ['quantity' => ($cart->products()->find($product->id)?->pivot->quantity ?? 0) + 1]
        ]);

        return redirect()->route('cart.index')->with('success', 'Produit ajouté au panier !');
    }

    // Retirer un produit
    public function remove($productId)
    {
        $cart = $this->getCart();
        $cart->products()->detach($productId);
        return redirect()->route('cart.index')->with('success', 'Produit retiré du panier !');
    }

    // Utilitaire pour récupérer le panier courant
    private function getCart()
    {
        if (Auth::check()) {
            return Cart::firstOrCreate(['user_id' => Auth::id()]);
        } else {
            $sessionId = session()->getId();
            return Cart::firstOrCreate(['session_id' => $sessionId]);
        }
    }
} 