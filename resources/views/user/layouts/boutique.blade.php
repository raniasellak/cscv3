<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome pour les icônes -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        :root {
            --orange-color: #FF6B00;
            --black-color: #000000;
            --dark-gray: #2c2c2c;
            --beige-color: #F5F5DC;
            --light-gray: #f8f9fa;
        }

        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* Navbar styling */
        .navbar {
            background-color: var(--dark-gray);
            padding: 15px 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: white !important;
        }

        .brand-c1 {
            color: var(--black-color) !important;
        }

        .brand-s {
            color: var(--orange-color) !important;
        }

        .brand-c2 {
            color: var(--beige-color) !important;
        }

        .nav-link {
            color: white !important;
            font-weight: 500;
            margin: 0 10px;
            position: relative;
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            color: var(--orange-color) !important;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 2px;
            background-color: var(--orange-color);
            transition: width 0.3s ease;
        }

        .nav-link:hover::after {
            width: 100%;
        }

        .navbar-toggler {
            border-color: var(--orange-color);
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba(255, 107, 0, 1)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }

        /* Cart Icon Styling */
        .cart-icon {
            position: relative;
            margin-right: 15px;
            text-decoration: none !important;
        }

        .cart-icon::after {
            display: none !important;
        }

        .cart-badge {
            position: absolute;
            top: -8px;
            right: -8px;
            background-color: var(--orange-color);
            color: white;
            border-radius: 50%;
            padding: 2px 6px;
            font-size: 0.75rem;
            font-weight: bold;
            min-width: 18px;
            height: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }

        .logout-btn {
            background-color: var(--orange-color);
            color: white !important;
            border-radius: 20px;
            padding: 6px 15px !important;
            transition: all 0.3s ease;
        }

        .logout-btn:hover {
            background-color: #ff8c33;
            transform: translateY(-2px);
        }

        /* Contenu principal */
        .content {
            flex: 1;
            padding: 30px 0;
        }

        /* Newsletter Section */
        .newsletter-section {
            background: linear-gradient(135deg, var(--beige-color) 0%, #f0f0f0 100%);
            padding: 50px 0;
            border-top: 3px solid var(--orange-color);
        }

        .newsletter-title {
            color: var(--dark-gray);
            font-weight: 700;
            font-size: 2rem;
            margin-bottom: 15px;
        }

        .newsletter-subtitle {
            color: #666;
            font-size: 1.1rem;
            margin-bottom: 30px;
        }

        .newsletter-form {
            max-width: 500px;
            margin: 0 auto;
        }

        .newsletter-input {
            border: 2px solid #ddd;
            border-radius: 25px;
            padding: 12px 20px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .newsletter-input:focus {
            border-color: var(--orange-color);
            box-shadow: 0 0 0 0.2rem rgba(255, 107, 0, 0.25);
        }

        .newsletter-btn {
            background-color: var(--orange-color);
            border: none;
            border-radius: 25px;
            padding: 12px 30px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .newsletter-btn:hover {
            background-color: #ff8c33;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 107, 0, 0.3);
        }

        /* Footer styling */
        footer {
            background: linear-gradient(135deg, var(--dark-gray) 0%, #3a3a3a 100%);
            color: white;
            padding: 60px 0 20px;
            margin-top: auto;
        }

        .footer-main {
            padding-bottom: 40px;
            border-bottom: 1px solid #333;
        }

        .footer-section h5 {
            color: var(--orange-color);
            font-weight: 700;
            margin-bottom: 20px;
            font-size: 1.2rem;
        }

        .footer-section ul {
            list-style: none;
            padding: 0;
        }

        .footer-section ul li {
            margin-bottom: 10px;
        }

        .footer-section ul li a {
            color: #ccc;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .footer-section ul li a:hover {
            color: var(--orange-color);
            padding-left: 5px;
        }

        .footer-logo {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 15px;
        }

        .footer-brand-c1 {
            color: var(--black-color);
        }

        .footer-brand-s {
            color: var(--orange-color);
        }

        .footer-brand-c2 {
            color: var(--beige-color);
        }

        .footer-description {
            color: #ccc;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .social-icons a {
            display: inline-block;
            width: 40px;
            height: 40px;
            background-color: #333;
            color: white;
            text-align: center;
            line-height: 40px;
            border-radius: 50%;
            margin-right: 10px;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .social-icons a:hover {
            background-color: var(--orange-color);
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(255, 107, 0, 0.3);
        }

        .contact-info {
            color: #ccc;
        }

        .contact-info i {
            color: var(--orange-color);
            width: 20px;
            margin-right: 10px;
        }

        .contact-info p {
            margin-bottom: 10px;
        }

        .footer-bottom {
            text-align: center;
            padding-top: 30px;
            color: #999;
        }

        .footer-bottom a {
            color: var(--orange-color);
            text-decoration: none;
        }

        .footer-bottom a:hover {
            text-decoration: underline;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .newsletter-title {
                font-size: 1.5rem;
            }
            
            .newsletter-form .row {
                gap: 15px;
            }
            
            .footer-section {
                margin-bottom: 30px;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar améliorée avec Bootstrap -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#"><span class="brand-c1">C</span><span class="brand-s">S</span><span class="brand-c2">C</span></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.index') }}"><i class="fas fa-home me-1"></i>Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/formations"><i class="fas fa-graduation-cap me-1"></i>Formation</a>
                    </li>
                     @if (auth()->check() && auth()->user()->role == 'admin')
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/dashboard"><i class="fas fa-graduation-cap me-1"></i>Dashboard</a>
                    </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link" href="/evenements"><i class="fas fa-calendar-alt me-1"></i>Events</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/about"><i class="fas fa-users me-1"></i>À propos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('boutique.index') }}"><i class="fas fa-store me-1"></i>Boutique</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('contact.show') }}"><i class="fas fa-envelope me-1"></i>Contacter nous</a>
                    </li>
                </ul>
                <div class="d-flex align-items-center">
                    <!-- Icône du panier -->
                    <a class="nav-link cart-icon" href="{{ route('cart.index') }}" title="Mon Panier">
                        <i class="fas fa-shopping-cart fa-lg"></i>
                        <span class="cart-badge" id="cart-count">0</span>
                    </a>
                    <a class="nav-link logout-btn" href="{{ route('logout') }}"><i class="fas fa-sign-out-alt me-1"></i>Déconnexion</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Contenu principal de la page -->
    <div class="content">
        <div class="container">
            @yield('content')
            @include('chatbot.widget')
        </div>
    </div>

    <!-- Section Newsletter -->
    <section class="newsletter-section">
        <div class="container">
            <div class="text-center">
                <h2 class="newsletter-title">
                    <i class="fas fa-envelope-open-text text-warning me-2"></i>
                    Restez Informé
                </h2>
                <p class="newsletter-subtitle">
                    Inscrivez-vous à notre newsletter pour recevoir nos dernières actualités et offres exclusives
                </p>
                @if(session('newsletter_success'))
                    <div class="alert alert-success mt-3">{{ session('newsletter_success') }}</div>
                @endif
                @if(session('newsletter_error'))
                    <div class="alert alert-danger mt-3">{{ session('newsletter_error') }}</div>
                @endif
                <form class="newsletter-form" method="POST" action="{{ route('newsletter.subscribe') }}">
                    @csrf
                    <div class="row g-3 align-items-center justify-content-center">
                        <div class="col-md-7">
                            <input type="email" name="email" class="form-control newsletter-input" placeholder="Votre adresse email" required>
                        </div>
                        <div class="col-md-auto">
                            <button type="submit" class="btn btn-warning newsletter-btn">
                                <i class="fas fa-paper-plane me-2"></i>S'abonner
                            </button>
                        </div>
                    </div>
                    <small class="text-muted mt-2 d-block">
                        <i class="fas fa-lock me-1"></i>
                        Nous respectons votre vie privée. Pas de spam, désinscription facile.
                    </small>
                </form>
            </div>
        </div>
    </section>

    <!-- Footer amélioré -->
    <footer>
        <div class="container">
            <div class="footer-main">
                <div class="row">
                    <!-- Colonne 1: À propos -->
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="footer-section">
                            <div class="footer-logo">
                                <span class="footer-brand-c1">C</span><span class="footer-brand-s">S</span><span class="footer-brand-c2">C</span>
                            </div>
                            <p class="footer-description">
                                Votre partenaire de confiance pour des formations de qualité. 
                                Nous vous accompagnons dans votre développement professionnel 
                                avec des programmes adaptés à vos besoins.
                            </p>
                            <div class="social-icons">
                               
                                <a href="#" title="Instagram"><i class="fab fa-instagram"></i></a>
                                <a href="https://www.linkedin.com/company/club-csc/posts/?feedView=all" title="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
            
                            </div>
                        </div>
                    </div>

                    <!-- Colonne 2: Liens rapides -->
                    <div class="col-lg-2 col-md-6 mb-4">
                        <div class="footer-section">
                            <h5>Liens Rapides</h5>
                            <ul>
                                <li><a href="{{ route('user.index') }}">Accueil</a></li>
                                <li><a href="/formations">Formations</a></li>
                                <li><a href="/evenements">Events</a></li>
                                <li><a href="{{ route('boutique.index') }}">Boutique</a></li>
                                <li><a href="#">À propos</a></li>
                                <li><a href="{{ route('contact.show') }}">Contact</a></li>
                            </ul>
                        </div>
                    </div>

                    <!-- Colonne 3: Services -->
                    <div class="col-lg-2 col-md-6 mb-4">
                        <div class="footer-section">
                            <h5>Nos Services</h5>
                            <ul>
                                <li><a href="#">Formation en ligne</a></li>
                                <li><a href="#">Certification</a></li>
                                <li><a href="#">Coaching</a></li>
                                <li><a href="#">Consultation</a></li>
                                <li><a href="#">Support 24/7</a></li>
                            </ul>
                        </div>
                    </div>

                    <!-- Colonne 4: Contact -->
                    <!-- Colonne 4: Contact -->
                   <div class="col-lg-4 col-md-6 mb-4">
                        <div class="footer-section"href="{{ route('contact.show') }}">
                            <h5>Contactez-nous</h5>
                            <div class="contact-info">
                                <p><i class="fas fa-map-marker-alt"></i>Faculté des Sciences et Techniques Marrakech</p>
                                <p><i class="fas fa-phone"></i>05 06 01 23 45 69</p>
                                <p><i class="fas fa-envelope"></i>cscclubfstg@gmail.com</p>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer Bottom -->
            <div class="footer-bottom">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <p class="mb-0">
                            &copy; {{ date('Y') }} <a href="#"><span class="footer-brand-c1">C</span><span class="footer-brand-s">S</span><span class="footer-brand-c2">C</span></a>. Tous droits réservés.
                        </p>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <a href="#" class="me-3">Politique de confidentialité</a>
                        <a href="#" class="me-3">Conditions d'utilisation</a>
                        <a href="#">Mentions légales</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    <script>
        // Configuration CSRF pour les requêtes AJAX
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Animation d'apparition au scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        document.querySelectorAll('.footer-section').forEach(section => {
            section.style.opacity = '0';
            section.style.transform = 'translateY(20px)';
            section.style.transition = 'all 0.6s ease';
            observer.observe(section);
        });

        // Fonction pour mettre à jour le compteur du panier
        function updateCartCount() {
            fetch('/cart/count')
                .then(response => response.json())
                .then(data => {
                    const cartCountElement = document.getElementById('cart-count');
                    if (cartCountElement) {
                        cartCountElement.textContent = data.count || 0;
                    }
                })
                .catch(error => {
                    console.log('Erreur lors de la récupération du compteur panier:', error);
                    // Fallback : récupérer depuis le localStorage
                    const cartCount = localStorage.getItem('cart_count') || 0;
                    const cartCountElement = document.getElementById('cart-count');
                    if (cartCountElement) {
                        cartCountElement.textContent = cartCount;
                    }
                });
        }

        // Fonction pour incrémenter le compteur du panier
        function incrementCartCount() {
            const cartCountElement = document.getElementById('cart-count');
            if (cartCountElement) {
                let currentCount = parseInt(cartCountElement.textContent) || 0;
                currentCount++;
                cartCountElement.textContent = currentCount;
                
                // Sauvegarder dans localStorage comme backup
                localStorage.setItem('cart_count', currentCount);
                
                // Animation de pulsation
                cartCountElement.style.animation = 'none';
                setTimeout(() => {
                    cartCountElement.style.animation = 'pulse 0.5s ease-in-out';
                }, 10);
            }
        }

        // Mettre à jour le compteur au chargement de la page
        document.addEventListener('DOMContentLoaded', function() {
            updateCartCount();
            
            // Écouter les événements personnalisés pour la mise à jour du panier
            document.addEventListener('cartUpdated', function() {
                updateCartCount();
            });
            
            document.addEventListener('cartItemAdded', function() {
                incrementCartCount();
            });
        });

        // Fonction globale disponible pour d'autres scripts
        window.updateCartCount = updateCartCount;
        window.incrementCartCount = incrementCartCount;
    </script>
</body>
</html>