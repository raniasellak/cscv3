<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;

class PaymentController extends Controller
{
    public function choice($cartId)
    {
        $cart = Cart::with('products')->findOrFail($cartId);
        return view('boutique.payment_choice', compact('cart'));
    }

    public function card($cartId)
    {
        $cart = Cart::with('products')->findOrFail($cartId);
        return view('boutique.payment_card', compact('cart'));
    }

    public function paypal($cartId)
    {
        $cart = Cart::with('products')->findOrFail($cartId);
        return view('boutique.payment_paypal', compact('cart'));
    }

    public function paypalSuccess(Request $request) {
    // Vérifier la transaction avec PayPal
    // Marquer la commande comme payée
    // Vider le panier
    // Rediriger vers une page de confirmation
}
} 