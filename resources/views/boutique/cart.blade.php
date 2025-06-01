@extends('user.layouts.app')

@section('content')
<div class="container">
    <h1 class="subtitle">Mon Panier</h1>
    @if(session('cart') && count(session('cart')) > 0)
        <div class="products">
            @foreach(session('cart') as $product)
                <div class="product-card">
                    <div class="product-img">
                        <img src="{{ asset('storage/' . $product['image']) }}" alt="{{ $product['name'] }}">
                    </div>
                    <div class="product-info">
                        <h3 class="product-title">{{ $product['name'] }}</h3>
                        <p class="product-description">{{ $product['description'] }}</p>
                        <div class="product-price">{{ $product['price'] }} DH</div>
                        <div class="product-actions">
                            <form action="{{ route('cart.remove', $product['id']) }}" method="POST" style="display:inline-block;">
                                @csrf
                                <button type="submit" class="add-to-cart btn btn-danger btn-sm">Retirer</button>
                            </form>
                            <a href="{{ route('payment.choice', $product['id']) }}" class="btn btn-success btn-sm">Payer</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-info">Votre panier est vide.</div>
    @endif
</div>
@endsection 