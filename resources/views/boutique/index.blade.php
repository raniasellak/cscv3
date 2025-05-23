@extends('user.layouts.app')

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
        
        header {
            background-color: var(--secondary);
            color: white;
            padding: 20px 0;
            text-align: center;
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
            justify-content: space-between;
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
        
        .cart-count {
            position: relative;
            margin-left: 20px;
        }
        
        .cart-icon {
            background-color: var(--secondary);
            color: white;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
        }
        
        .cart-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background-color: var(--danger);
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 12px;
        }
        
        .nav-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 0;
        }
        
        .nav-logo {
            font-size: 24px;
            font-weight: bold;
            color: white;
            text-decoration: none;
        }
        
        .nav-actions {
            display: flex;
            align-items: center;
        }
        
        footer {
            background-color: var(--secondary);
            color: white;
            text-align: center;
            padding: 20px 0;
            margin-top: 60px;
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
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <header>
        <div class="container">
            <div class="nav-container">
                <a href="#" class="nav-logo">CSC Boutique</a>
                <div class="nav-actions">
                    <div class="cart-count">
                        <div class="cart-icon">
                            <i class="fas fa-shopping-cart"></i>
                            <div class="cart-badge">0</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

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
            <!-- T-shirt CSC -->
            <div class="product-card" data-category="vetements">
                <div class="product-img">
                    <img src="/api/placeholder/400/320" alt="T-shirt CSC">
                    <div class="favorite"><i class="fas fa-heart"></i></div>
                </div>
                <div class="product-info">
                    <h3 class="product-title">T-shirt CSC</h3>
                    <p class="product-description">T-shirt avec le logo du club, 100% coton.</p>
                    <div class="product-price">120 DH</div>
                    <div class="product-actions">
                        <button class="add-to-cart">Ajouter au panier</button>
                    </div>
                </div>
            </div>
            
            <!-- Mug CSC -->
            <div class="product-card" data-category="accessoires">
                <div class="product-img">
                    <img src="/api/placeholder/400/320" alt="Mug CSC">
                    <div class="favorite"><i class="fas fa-heart"></i></div>
                </div>
                <div class="product-info">
                    <h3 class="product-title">Mug CSC</h3>
                    <p class="product-description">Mug en céramique avec le logo du club, 350ml.</p>
                    <div class="product-price">80 DH</div>
                    <div class="product-actions">
                        <button class="add-to-cart">Ajouter au panier</button>
                    </div>
                </div>
            </div>
            
            <!-- Pack de stickers -->
            <div class="product-card" data-category="papeterie">
                <div class="product-img">
                    <img src="/api/placeholder/400/320" alt="Pack de stickers">
                    <div class="favorite"><i class="fas fa-heart"></i></div>
                    <div class="badge-new">Nouveau</div>
                </div>
                <div class="product-info">
                    <h3 class="product-title">Stickers Pack</h3>
                    <p class="product-description">Pack de 5 stickers dev, IA et cybersécurité.</p>
                    <div class="product-price">50 DH</div>
                    <div class="product-actions">
                        <button class="add-to-cart">Ajouter au panier</button>
                    </div>
                </div>
            </div>
            
            <!-- Notebook CSC -->
            <div class="product-card" data-category="papeterie">
                <div class="product-img">
                    <img src="/api/placeholder/400/320" alt="Notebook CSC">
                    <div class="favorite"><i class="fas fa-heart"></i></div>
                </div>
                <div class="product-info">
                    <h3 class="product-title">Notebook CSC</h3>
                    <p class="product-description">Carnet de notes avec couverture rigide et logo CSC.</p>
                    <div class="product-price">60 DH</div>
                    <div class="product-actions">
                        <button class="add-to-cart">Ajouter au panier</button>
                    </div>
                </div>
            </div>
            
            <!-- Sac CSC -->
            <div class="product-card" data-category="accessoires">
                <div class="product-img">
                    <img src="/api/placeholder/400/320" alt="Sac CSC">
                    <div class="favorite"><i class="fas fa-heart"></i></div>
                </div>
                <div class="product-info">
                    <h3 class="product-title">Sac à dos CSC</h3>
                    <p class="product-description">Sac à dos résistant avec compartiment pour ordinateur portable.</p>
                    <div class="product-price">250 DH</div>
                    <div class="product-actions">
                        <button class="add-to-cart">Ajouter au panier</button>
                    </div>
                </div>
            </div>
            
            <!-- Clé USB CSC -->
            <div class="product-card" data-category="gadgets">
                <div class="product-img">
                    <img src="/api/placeholder/400/320" alt="Clé USB CSC">
                    <div class="favorite"><i class="fas fa-heart"></i></div>
                    <div class="badge-promo">-20%</div>
                </div>
                <div class="product-info">
                    <h3 class="product-title">Clé USB CSC</h3>
                    <p class="product-description">Clé USB 64Go avec le logo CSC, USB 3.0.</p>
                    <div class="product-price">120 DH <span style="text-decoration: line-through; color: #999; font-size: 16px;">150 DH</span></div>
                    <div class="product-actions">
                        <button class="add-to-cart">Ajouter au panier</button>
                    </div>
                </div>
            </div>
            
            <!-- Sweat CSC -->
            <div class="product-card" data-category="vetements">
                <div class="product-img">
                    <img src="/api/placeholder/400/320" alt="Sweat CSC">
                    <div class="favorite"><i class="fas fa-heart"></i></div>
                </div>
                <div class="product-info">
                    <h3 class="product-title">Sweat CSC</h3>
                    <p class="product-description">Sweat à capuche avec le logo CSC brodé, très confortable.</p>
                    <div class="product-price">220 DH</div>
                    <div class="product-actions">
                        <button class="add-to-cart">Ajouter au panier</button>
                    </div>
                </div>
            </div>
            
            <!-- Tapis de souris -->
            <div class="product-card" data-category="accessoires">
                <div class="product-img">
                    <img src="/api/placeholder/400/320" alt="Tapis de souris CSC">
                    <div class="favorite"><i class="fas fa-heart"></i></div>
                    <div class="badge-new">Nouveau</div>
                </div>
                <div class="product-info">
                    <h3 class="product-title">Tapis de souris CSC</h3>
                    <p class="product-description">Tapis de souris gaming XL avec le logo CSC.</p>
                    <div class="product-price">90 DH</div>
                    <div class="product-actions">
                        <button class="add-to-cart">Ajouter au panier</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <div class="container">
            <p>&copy; 2025 CSC Boutique - Tous droits réservés</p>
        </div>
    </footer>

    <script>
        // Initialisation du compteur du panier
        let cartCount = 0;
        const cartBadge = document.querySelector('.cart-badge');
        
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
        
        // Gestion du panier
        const addToCartButtons = document.querySelectorAll('.add-to-cart');
        addToCartButtons.forEach(button => {
            button.addEventListener('click', function() {
                cartCount++;
                cartBadge.textContent = cartCount;
                
                // Animation d'ajout au panier
                this.textContent = 'Ajouté !';
                this.style.backgroundColor = '#2ecc71';
                
                setTimeout(() => {
                    this.textContent = 'Ajouter au panier';
                    this.style.backgroundColor = '';
                }, 1000);
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
</body>
</html>