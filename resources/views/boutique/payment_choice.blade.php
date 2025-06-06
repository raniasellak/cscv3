@extends(auth()->user()?->role === 'admin' ? 'layouts.appdash' : 'layouts.master')
@section('title', 'Choix du paiement')
@section('content')
<style>
    body {
        background: #ffffff;
        min-height: 100vh;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    
    .payment-container {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
        background: #ffffff;
    }
    
    .payment-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        box-shadow: 0 20px 40px rgba(255, 140, 0, 0.15);
        overflow: hidden;
        max-width: 1200px;
        width: 100%;
        border: 2px solid rgba(255, 140, 0, 0.2);
    }
    
    .payment-left {
        background: linear-gradient(45deg, #f8f9fa, #e9ecef);
        padding: 40px 30px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        color: #1a1a1a;
        position: relative;
        overflow: hidden;
        border-right: 3px solid #ff8c00;
    }
    
    .payment-left::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="50" cy="50" r="2" fill="rgba(255,140,0,0.08)"/></svg>') repeat;
        animation: float 20s infinite linear;
    }
    
    @keyframes float {
        0% { transform: translate(-50%, -50%) rotate(0deg); }
        100% { transform: translate(-50%, -50%) rotate(360deg); }
    }
    
    .cart-summary {
        background: rgba(255, 255, 255, 0.9);
        border-radius: 15px;
        padding: 30px;
        margin-bottom: 30px;
        position: relative;
        z-index: 2;
        border: 2px solid rgba(255, 140, 0, 0.2);
        width: 100%;
        max-width: 400px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    }
    
    .cart-title {
        display: flex;
        align-items: center;
        gap: 15px;
        font-size: 1.5rem;
        font-weight: 600;
        color: #ff8c00;
        margin-bottom: 25px;
    }
    
    .cart-icon {
        width: 40px;
        height: 40px;
        background: linear-gradient(45deg, #ff8c00, #ffa500);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
    }
    
    .product-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px 0;
        border-bottom: 1px solid rgba(255, 140, 0, 0.2);
        margin-bottom: 10px;
    }
    
    .product-item:last-child {
        border-bottom: none;
        margin-bottom: 0;
    }
    
    .product-name {
        color: #2c3e50;
        font-weight: 500;
    }
    
    .product-price {
        background: linear-gradient(45deg, #ff8c00, #ffa500);
        color: white;
        padding: 5px 12px;
        border-radius: 15px;
        font-weight: 600;
        font-size: 0.9rem;
    }
    
    .total-section {
        margin-top: 25px;
        padding-top: 20px;
        border-top: 2px solid rgba(255, 140, 0, 0.3);
        text-align: center;
    }
    
    .total-amount {
        font-size: 2rem;
        font-weight: 700;
        color: #ff8c00;
        margin-bottom: 15px;
    }
    
    .security-badge {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        background: rgba(255, 140, 0, 0.1);
        padding: 10px;
        border-radius: 8px;
        font-size: 0.9rem;
        color: #ff8c00;
    }
    
    .payment-right {
        padding: 40px 40px;
        background: #ffffff;
    }
    
    .payment-title {
        font-size: 2.5rem;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 10px;
    }
    
    .payment-subtitle {
        color: #666;
        margin-bottom: 40px;
        font-size: 1.1rem;
    }
    
    .payment-methods {
        margin-bottom: 30px;
    }
    
    .method-title {
        display: flex;
        align-items: center;
        gap: 12px;
        font-size: 1.3rem;
        font-weight: 600;
        color: #1a1a1a;
        margin-bottom: 20px;
    }
    
    .method-icon {
        width: 35px;
        height: 35px;
        background: linear-gradient(45deg, #1a1a1a, #2d2d2d);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ff8c00;
    }
    
    .payment-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 15px;
        padding: 18px 25px;
        border: 2px solid transparent;
        border-radius: 15px;
        font-size: 1.1rem;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
        cursor: pointer;
        position: relative;
        overflow: hidden;
        width: 100%;
        margin-bottom: 15px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    
    .payment-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s;
    }
    
    .payment-btn:hover::before {
        left: 100%;
    }
    
    .btn-card {
        background: linear-gradient(45deg, #ff8c00, #ffa500);
        color: white;
        box-shadow: 0 6px 20px rgba(255, 140, 0, 0.3);
    }
    
    .btn-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 30px rgba(255, 140, 0, 0.4);
        color: white;
    }
    
    .btn-paypal {
        background: linear-gradient(45deg, #0070BA, #003087);
        color: white;
        box-shadow: 0 6px 20px rgba(0, 112, 186, 0.3);
    }
    
    .btn-paypal:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 30px rgba(0, 112, 186, 0.4);
        color: white;
    }
    
    .payment-form {
        background: rgba(248, 249, 250, 0.8);
        border-radius: 15px;
        padding: 25px;
        margin-top: 20px;
        border: 2px solid rgba(255, 140, 0, 0.2);
        opacity: 0;
        transform: translateY(20px);
        animation: slideIn 0.5s ease forwards;
    }
    
    @keyframes slideIn {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .form-group {
        margin-bottom: 20px;
        position: relative;
    }
    
    .form-label {
        display: block;
        font-weight: 600;
        color: #1a1a1a;
        margin-bottom: 8px;
        font-size: 1rem;
    }
    
    .form-control {
        width: 100%;
        padding: 15px 20px;
        border: 2px solid #e9ecef;
        border-radius: 12px;
        font-size: 16px;
        transition: all 0.3s ease;
        background: #ffffff;
        color: #1a1a1a;
    }
    
    .form-control:focus {
        outline: none;
        border-color: #ff8c00;
        box-shadow: 0 0 0 3px rgba(255, 140, 0, 0.2);
        background: white;
    }
    
    .submit-btn {
        width: 100%;
        padding: 15px;
        background: linear-gradient(45deg, #1a1a1a, #2d2d2d);
        color: white;
        border: none;
        border-radius: 12px;
        font-size: 1.1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    }
    
    .submit-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.3);
    }
    
    .back-section {
        text-align: center;
        margin-top: 40px;
    }
    
    .back-btn {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 12px 25px;
        background: rgba(248, 249, 250, 0.9);
        color: #1a1a1a;
        text-decoration: none;
        border-radius: 12px;
        font-weight: 500;
        transition: all 0.3s ease;
        border: 2px solid rgba(255, 140, 0, 0.2);
    }
    
    .back-btn:hover {
        background: #f8f9fa;
        transform: translateX(-5px);
        color: #1a1a1a;
        box-shadow: 0 4px 15px rgba(255, 140, 0, 0.2);
    }
    
    .alert {
        border-radius: 12px;
        border: none;
        margin-bottom: 25px;
        padding: 15px 20px;
    }
    
    .alert-success {
        background: linear-gradient(45deg, #ff8c00, #ffa500);
        color: white;
    }
    
    .alert-danger {
        background: linear-gradient(45deg, #dc3545, #c82333);
        color: white;
    }
    
    @media (max-width: 768px) {
        .payment-left {
            display: none;
        }
        .payment-right {
            padding: 30px 25px;
        }
        .payment-title {
            font-size: 2rem;
        }
        .cart-summary {
            max-width: 100%;
        }
    }
</style>

<div class="payment-container">
    <div class="payment-card">
        <div class="row g-0 h-100">
            <!-- Partie gauche avec résumé du panier -->
            <div class="col-lg-5">
                <div class="payment-left h-100">
                    <div class="cart-summary">
                        <div class="cart-title">
                            <div class="cart-icon">
                                <i class="fas fa-shopping-cart"></i>
                            </div>
                            Résumé de la commande
                        </div>
                        
                        <div class="product-list">
                            @foreach($cart->products as $product)
                                <div class="product-item">
                                    <span class="product-name">{{ $product->name }} x {{ $product->pivot->quantity }}</span>
                                    <span class="product-price">{{ number_format($product->price * $product->pivot->quantity, 2) }} €</span>
                                </div>
                            @endforeach
                        </div>

                        <div class="total-section">
                            <div class="total-amount">{{ number_format($cart->products->sum(fn($p) => $p->price * $p->pivot->quantity), 2) }} €</div>
                            <div class="security-badge">
                                <i class="fas fa-shield-alt"></i>
                                Paiement 100% sécurisé
                            </div>
                        </div>
                    </div>
                    
                    <div style="position: relative; z-index: 2;">
                        <h4 style="color: #ff8c00; margin-bottom: 15px;">
                            <i class="fas fa-lock me-2"></i>
                            Paiement Sécurisé
                        </h4>
                        <p style="opacity: 0.8; font-size: 0.95rem; color: #2c3e50;">
                            Vos informations de paiement sont cryptées et sécurisées par SSL.
                        </p>
                    </div>
                </div>
            </div>
            
            <!-- Partie droite avec méthodes de paiement -->
            <div class="col-lg-7">
                <div class="payment-right">
                    <h2 class="payment-title">Finaliser la commande</h2>
                    <p class="payment-subtitle">Choisissez votre mode de paiement préféré</p>
                    
                    @if (session('success'))
                        <div class="alert alert-success">
                            <i class="fas fa-check-circle me-2"></i>
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger">
                            <i class="fas fa-exclamation-circle me-2"></i>
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="payment-methods">
                        <div class="method-title">
                            <div class="method-icon">
                                <i class="fas fa-credit-card"></i>
                            </div>
                            Modes de paiement
                        </div>

                        <button id="btn-card" class="payment-btn btn-card">
                            <i class="fas fa-credit-card"></i>
                            Payer par carte bancaire
                            <i class="fas fa-chevron-right ms-auto"></i>
                        </button>
                        
                        <button id="btn-paypal" class="payment-btn btn-paypal">
                            <i class="fab fa-paypal"></i>
                            Payer avec PayPal
                            <i class="fas fa-chevron-right ms-auto"></i>
                        </button>
                    </div>

                    <div id="payment-method"></div>
                    
                    <div class="back-section">
                        <a href="{{ route('cart.index') }}" class="back-btn">
                            <i class="fas fa-arrow-left"></i>
                            Retour au panier
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Font Awesome pour les icônes -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<script src="https://js.stripe.com/v3/"></script>
<script src="https://www.paypal.com/sdk/js?client-id=sb&currency=EUR"></script>
<script>
document.getElementById('btn-card').onclick = function() {
    document.getElementById('payment-method').innerHTML = `
        <div class="payment-form">
            <form id="stripe-form">
                <div class="form-group">
                    <label for="card-element" class="form-label">
                        <i class="fas fa-credit-card me-2"></i>Informations de la carte
                    </label>
                    <div id="card-element" class="form-control"></div>
                </div>
                <button type="submit" class="submit-btn">
                    <i class="fas fa-lock me-2"></i>Payer maintenant
                </button>
            </form>
        </div>
    `;
    
    var stripe = Stripe('pk_test_12345'); // Remplace par ta vraie clé publique Stripe !
    var elements = stripe.elements();
    var card = elements.create('card', {
        style: {
            base: {
                fontSize: '16px',
                color: '#1A1A1A',
                '::placeholder': {
                    color: '#999',
                },
            },
        },
    });
    card.mount('#card-element');
    
    document.getElementById('stripe-form').onsubmit = function(e) {
        e.preventDefault();
        alert('Paiement Stripe fictif (à implémenter côté serveur)');
    };
};

document.getElementById('btn-paypal').onclick = function() {
    document.getElementById('payment-method').innerHTML = `
        <div class="payment-form">
            <div style="text-align: center; margin-bottom: 20px;">
                <p style="color: #666; font-size: 1rem;">
                    <i class="fas fa-info-circle me-2"></i>
                    Vous allez être redirigé vers PayPal pour finaliser votre paiement
                </p>
            </div>
            <div id="paypal-button-container"></div>
        </div>
    `;
    
    paypal.Buttons({
        createOrder: function(data, actions) {
            return actions.order.create({
                purchase_units: [{ 
                    amount: { value: '{{ $cart->products->sum(fn($p) => $p->price * $p->pivot->quantity) }}' }
                }]
            });
        },
        onApprove: function(data, actions) {
            return actions.order.capture().then(function(details) {
                alert('Paiement PayPal fictif (à implémenter côté serveur)');
            });
        },
        style: {
            color: 'blue',
            shape: 'rect',
            height: 50,
            label: 'paypal'
        }
    }).render('#paypal-button-container');
};
</script>

@endsection