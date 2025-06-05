
@extends('user.layouts.boutique')

@extends(auth()->user()?->role === 'admin' ? 'layouts.appdash' : 'user.layouts.app')

@section('content')
<style>
    :root {
        --primary: #f39c12;
        --secondary: #2c3e50;
        --accent: #d35400;
        --light: #f5f5dc;
        --dark: #2c3e50;
        --danger: #e74c3c;
        --success: #27ae60;
    }
        
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    
    body {
        background-color: #f8f9fa;
    }
    
    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 15px;
    }
    
    .subtitle {
        text-align: center;
        color: #555;
        margin: 20px 0 40px;
        font-size: 1.5rem;
    }
    
    .filters {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-bottom: 30px;
        justify-content: center;
    }
    
    .filter-btn {
        padding: 8px 16px;
        background-color: var(--light);
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .filter-btn:hover {
        background-color: #d5dbdb;
    }
    
    .filter-btn.active {
        background-color: var(--primary);
        color: white;
    }
    
    .search-container {
        display: flex;
        justify-content: center;
        margin-bottom: 30px;
    }
    
    .search-box {
        width: 100%;
        max-width: 500px;
        padding: 10px 15px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 16px;
    }
    
    .products {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 30px;
    }
    
    .product-card {
        background-color: white;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
    }
    
    .product-card:hover {
        transform: translateY(-5px);
    }
    
    .product-img {
        height: 200px;
        width: 100%;
        overflow: hidden;
        position: relative;
    }
    
    .product-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .favorite {
        position: absolute;
        top: 10px;
        right: 10px;
        background-color: white;
        border-radius: 50%;
        width: 36px;
        height: 36px;
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
    }
    
    .favorite i {
        color: #ccc;
        font-size: 18px;
    }
    
    .favorite.active i {
        color: var(--danger);
    }
    
    .product-info {
        padding: 15px;
    }
    
    .product-title {
        font-size: 18px;
        margin-bottom: 5px;
        color: var(--dark);
    }
    
    .product-description {
        color: #666;
        margin-bottom: 10px;
        font-size: 14px;
    }
    
    .product-price {
        font-weight: bold;
        font-size: 20px;
        color: var(--dark);
        margin-bottom: 15px;
    }
    
    .product-actions {
        display: flex;
        justify-content: center;
        gap: 10px;
    }
    
    .add-to-cart {
        background-color: var(--primary);
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 4px;
        cursor: pointer;
        flex-grow: 1;
        transition: background-color 0.3s ease;
    }
    
    .add-to-cart:hover {
        background-color: #2980b9;
    }

    /* Badge nouveau */
    .badge-new {
        position: absolute;
        top: 10px;
        left: 10px;
        background-color: var(--success);
        color: white;
        padding: 5px 10px;
        border-radius: 4px;
        font-size: 12px;
        font-weight: bold;
    }

    /* Badge promotion */
    .badge-promo {
        position: absolute;
        top: 10px;
        left: 10px;
        background-color: var(--danger);
        color: white;
        padding: 5px 10px;
        border-radius: 4px;
        font-size: 12px;
        font-weight: bold;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .filters {
            flex-direction: column;
            align-items: center;
        }
        
        .filter-btn {
            width: 200px;
        }
        
        .products {
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
        }
    }
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<div class="container">
    <h1 class="subtitle">Découvrez nos produits exclusifs pour les passionnés d'informatique</h1>
    
    <div class="filters">
        <button class="filter-btn active" data-filter="all">Tous les produits</button>
        <button class="filter-btn" data-filter="vetements">Vêtements</button>
        <button class="filter-btn" data-filter="papeterie">Papeterie</button>
        <button class="filter-btn" data-filter="accessoires">Accessoires</button>
        <button class="filter-btn" data-filter="gadgets">Gadgets</button>
    </div>
    
    <div class="search-container">
        <input type="text" class="search-box" placeholder="Rechercher un produit...">
    </div>
    
    <div class="products">
        @foreach($products as $product)
            <div class="product-card" data-category="{{ $product->category->name ?? 'autre' }}">
                <div class="product-img">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                    <div class="favorite"><i class="fas fa-heart"></i></div>
                    @if(isset($product->is_new) && $product->is_new)
                        <div class="badge-new">Nouveau</div>
                    @endif
                    @if(isset($product->is_promo) && $product->is_promo)
                        <div class="badge-promo">Promo</div>
                    @endif
                </div>
                <div class="product-info">
                    <h3 class="product-title">{{ $product->name }}</h3>
                    <p class="product-description">{{ $product->description }}</p>
                    <div class="product-price">{{ $product->price }} DH</div>
                    <div class="product-actions">
                        <form action="{{ route('cart.add', $product->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            <button type="submit" class="add-to-cart">Ajouter au panier</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<script>
    // Gestion des favoris
    const favoriteButtons = document.querySelectorAll('.favorite');
    favoriteButtons.forEach(button => {
        button.addEventListener('click', function() {
            this.classList.toggle('active');
            const icon = this.querySelector('i');
            if (this.classList.contains('active')) {
                icon.style.color = '#e74c3c';
            } else {
                icon.style.color = '#ccc';
            }
        });
    });

    // Filtrage des produits
    const filterButtons = document.querySelectorAll('.filter-btn');
    const productCards = document.querySelectorAll('.product-card');

    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Mettre à jour l'état actif
            filterButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');

            const filter = this.getAttribute('data-filter');

            productCards.forEach(card => {
                if (filter === 'all' || card.getAttribute('data-category') === filter) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });

    // Recherche de produits
    const searchBox = document.querySelector('.search-box');
    searchBox.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();

        productCards.forEach(card => {
            const title = card.querySelector('.product-title').textContent.toLowerCase();
            const description = card.querySelector('.product-description').textContent.toLowerCase();

            if (title.includes(searchTerm) || description.includes(searchTerm)) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    });
</script>

@endsection