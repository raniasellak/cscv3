@extends(auth()->user()?->role === 'admin' ? 'layouts.appdash' : 'user.layouts.app')

@section('content')
<div class="container" style="max-width:600px; margin:auto;">
    <h1 class="subtitle">Paiement du produit</h1>
    <div class="product-card mb-4">
        <div class="product-img">
            <img src="{{ asset('storage/' . $product['image']) }}" alt="{{ $product['name'] }}">
        </div>
        <div class="product-info">
            <h3 class="product-title">{{ $product['name'] }}</h3>
            <p class="product-description">{{ $product['description'] }}</p>
            <div class="product-price">{{ $product['price'] }} DH</div>
        </div>
    </div>
    <div class="mb-3">
        <label class="form-label">Résumé de la commande :</label>
        <ul class="list-group">
            <li class="list-group-item d-flex justify-content-between align-items-center">
                {{ $product['name'] }}
                <span class="badge bg-primary rounded-pill">{{ $product['price'] }} DH</span>
            </li>
        </ul>
    </div>
    <div class="text-end">
        <a href="{{ route('payment.choice', $product['id']) }}" class="btn btn-success">Continuer vers paiement</a>
        <a href="{{ route('cart.index') }}" class="btn btn-secondary ms-2">Annuler</a>
    </div>
</div>
@endsection 