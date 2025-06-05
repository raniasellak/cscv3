@extends('layouts.master')

@section('title', 'Accueil - CSC Formation & Événements')

@section('content')
<!-- Hero Section -->
<section class="hero-section">
    <div class="hero-overlay"></div>
    <div class="container-fluid h-100">
        <div class="row h-100 align-items-center">
            <div class="col-lg-8 mx-auto text-center text-white">
                <h1 class="display-3 fw-bold mb-4 hero-title">
                    Bienvenue au <span class="text-orange">CSC</span>
                </h1>
                <p class="lead mb-5 hero-subtitle">
                    Centre de formation et d'événements spécialisé en cybersécurité, intelligence artificielle et développement
                </p>
                <div class="hero-buttons">
                    <a href="{{ route('formations.index') }}" class="btn btn-orange btn-lg me-3 mb-2">
                        <i class="fas fa-graduation-cap me-2"></i>Nos Formations
                    </a>
                    <a href="{{ route('evenements.index') }}" class="btn btn-outline-light btn-lg mb-2">
                        <i class="fas fa-calendar-alt me-2"></i>Événements
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="stats-section py-5">
    <div class="container">
        <div class="row text-center">
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <h3 class="stat-number">{{ $stats['formations'] ?? '50+' }}</h3>
                    <p class="stat-label">Formations</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <h3 class="stat-number">{{ $stats['evenements'] ?? '25+' }}</h3>
                    <p class="stat-label">Événements</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3 class="stat-number">{{ $stats['participants'] ?? '1000+' }}</h3>
                    <p class="stat-label">Participants</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-certificate"></i>
                    </div>
                    <h3 class="stat-number">{{ $stats['certificats'] ?? '500+' }}</h3>
                    <p class="stat-label">Certificats délivrés</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Services Section -->
<section class="services-section py-5 bg-light">
    <div class="container">
        <div class="row mb-5">
            <div class="col-12 text-center">
                <h2 class="section-title">Nos Domaines d'Expertise</h2>
                <p class="section-subtitle text-muted">Découvrez nos trois domaines de spécialisation</p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="service-card h-100">
                    <div class="service-icon cyber">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h4>Cybersécurité</h4>
                    <p>Formations et événements sur la sécurité informatique, la protection des données et la prévention des cyberattaques.</p>
                    <ul class="service-features">
                        <li>Sécurité des réseaux</li>
                        <li>Ethical Hacking</li>
                        <li>Forensique numérique</li>
                        <li>Gestion des risques</li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="service-card h-100">
                    <div class="service-icon ai">
                        <i class="fas fa-brain"></i>
                    </div>
                    <h4>Intelligence Artificielle</h4>
                    <p>Plongez dans le monde de l'IA avec nos formations sur le machine learning, deep learning et les applications pratiques.</p>
                    <ul class="service-features">
                        <li>Machine Learning</li>
                        <li>Deep Learning</li>
                        <li>Computer Vision</li>
                        <li>NLP & ChatBots</li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="service-card h-100">
                    <div class="service-icon dev">
                        <i class="fas fa-code"></i>
                    </div>
                    <h4>Développement</h4>
                    <p>Apprenez les dernières technologies de développement web, mobile et desktop avec nos experts.</p>
                    <ul class="service-features">
                        <li>Développement Web</li>
                        <li>Applications mobiles</li>
                        <li>DevOps & Cloud</li>
                        <li>Architecture logicielle</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Upcoming Events & Formations -->
<section class="upcoming-section py-5">
    <div class="container">
        <div class="row">
            <!-- Prochaines Formations -->
            <div class="col-lg-6 mb-5">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="text-orange">
                        <i class="fas fa-graduation-cap me-2"></i>Nos Formations
                    </h3>
                    <a href="{{ route('formations.index') }}" class="btn btn-outline-orange btn-sm">
                        Voir tout <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                </div>
                @if($formations->count() > 0)
                    @foreach($formations->take(3) as $formation)
                        <div class="event-card mb-3">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    @php
                                        $categoryImages = [
                                            'CyberSecurity' => 'cyber.jpg',
                                            'AI' => 'ai.webp',
                                            'Dev' => 'dev.jpg',
                                        ];
                                        $image = $categoryImages[$formation->category] ?? null;
                                    @endphp
                                    @if($image)
                                        <img src="{{ asset('storage/formations/' . $image) }}" 
                                             class="img-fluid rounded-start event-img" alt="{{ $formation->title }}">
                                    @else
                                        <div class="event-img-placeholder d-flex align-items-center justify-content-center">
                                            <i class="fas fa-graduation-cap fa-2x text-orange"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body p-3">
                                        <h6 class="card-title mb-2">{{ $formation->title }}</h6>
                                        <p class="card-text small text-muted mb-2">{{ Str::limit($formation->description, 80) }}</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <small class="text-muted">
                                                <i class="fas fa-calendar me-1"></i>
                                                {{ \Carbon\Carbon::parse($formation->date)->format('d/m/Y') }}
                                            </small>
                                            <span class="badge bg-orange">{{ $formation->category }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="text-center text-muted py-4">
                        <i class="fas fa-calendar-times fa-3x mb-3"></i>
                        <p>Aucune formation programmée pour le moment</p>
                    </div>
                @endif
            </div>

            <!-- Prochains Événements -->
            <div class="col-lg-6 mb-5">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="text-orange">
                        <i class="fas fa-calendar-alt me-2"></i>Prochains Événements
                    </h3>
                    <a href="{{ route('evenements.index') }}" class="btn btn-outline-orange btn-sm">
                        Voir tout <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                </div>
                @if($Events->count() > 0)
                    @foreach($Events->take(3) as $evenement)
                        <div class="event-card mb-3">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    @if($evenement->image)
                                        <img src="{{ asset('storage/' . $evenement->image) }}" 
                                             class="img-fluid rounded-start event-img" alt="{{ $evenement->titre }}">
                                    @else
                                        <div class="event-img-placeholder d-flex align-items-center justify-content-center">
                                            <i class="fas fa-calendar-alt fa-2x text-orange"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body p-3">
                                        <h6 class="card-title mb-2">{{ $evenement->titre }}</h6>
                                        <p class="card-text small text-muted mb-2">{{ Str::limit($evenement->description, 80) }}</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <small class="text-muted">
                                                <i class="fas fa-calendar me-1"></i>
                                                {{ \Carbon\Carbon::parse($evenement->date)->format('d/m/Y') }}
                                            </small>
                                            @if($evenement->category)
                                                <span class="badge bg-orange">{{ $evenement->category }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="text-center text-muted py-4">
                        <i class="fas fa-calendar-times fa-3x mb-3"></i>
                        <p>Aucun événement programmé pour le moment</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- Newsletter Section -->
<section class="newsletter-section py-5 bg-orange text-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <h3 class="mb-3">Restez informé de nos actualités</h3>
                <p class="mb-0">Inscrivez-vous à notre newsletter pour recevoir les dernières informations sur nos formations et événements.</p>
            </div>
            <div class="col-lg-6">
                <form class="newsletter-form">
                    <div class="input-group">
                        <input type="email" class="form-control" placeholder="Votre adresse email" required>
                        <button type="submit" class="btn btn-light text-orange">
                            <i class="fas fa-paper-plane me-1"></i>S'inscrire
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Boutique Section -->
@if(isset($featuredProducts) && $featuredProducts->count() > 0)
<section class="boutique-section py-5 bg-light">
    <div class="container">
        <div class="row mb-4">
            <div class="col-12 text-center">
                <h2 class="section-title">Boutique CSC</h2>
                <p class="section-subtitle text-muted">Découvrez nos produits exclusifs</p>
            </div>
        </div>
        <div class="row">
            @foreach($featuredProducts->take(4) as $product)
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="product-card">
                        <div class="product-img">
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                            @if(isset($product->is_new) && $product->is_new)
                                <div class="badge-new">Nouveau</div>
                            @endif
                        </div>
                        <div class="product-info">
                            <h6 class="product-title">{{ $product->name }}</h6>
                            <p class="product-description small">{{ Str::limit($product->description, 60) }}</p>
                            <div class="product-price">{{ $product->price }} DH</div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="text-center">
            <a href="{{ route('boutique.index') }}" class="btn btn-orange">
                <i class="fas fa-shopping-bag me-2"></i>Voir la boutique
            </a>
        </div>
    </div>
</section>
@endif
@endsection

@section('styles')
<style>
    :root {
        --orange-color: #ff8c00;
        --dark-color: #2c3e50;
    }

    .text-orange {
        color: var(--orange-color) !important;
    }

    .bg-orange {
        background-color: var(--orange-color) !important;
    }

    .btn-orange {
        background-color: var(--orange-color);
        border-color: var(--orange-color);
        color: white;
    }

    .btn-orange:hover {
        background-color: #e07e00;
        border-color: #e07e00;
        color: white;
    }

    .btn-outline-orange {
        border-color: var(--orange-color);
        color: var(--orange-color);
    }

    .btn-outline-orange:hover {
        background-color: var(--orange-color);
        border-color: var(--orange-color);
        color: white;
    }

    /* Hero Section */
    .hero-section {
        background: linear-gradient(rgba(44, 62, 80, 0.8), rgba(44, 62, 80, 0.8)), 
                    url('{{ asset("storage/hero-bg.jpg") }}') center/cover;
        height: 70vh;
        display: flex;
        align-items: center;
        position: relative;
    }

    .hero-title {
        animation: fadeInUp 1s ease-out;
    }

    .hero-subtitle {
        animation: fadeInUp 1s ease-out 0.2s both;
    }

    .hero-buttons {
        animation: fadeInUp 1s ease-out 0.4s both;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Stats Section */
    .stats-section {
        background: white;
    }

    .stat-card {
        padding: 2rem 1rem;
        text-align: center;
        transition: transform 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-5px);
    }

    .stat-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, var(--orange-color), #e07e00);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
    }

    .stat-icon i {
        font-size: 2rem;
        color: white;
    }

    .stat-number {
        font-size: 2.5rem;
        font-weight: bold;
        color: var(--dark-color);
        margin-bottom: 0.5rem;
    }

    .stat-label {
        color: #666;
        font-size: 1.1rem;
    }

    /* Services Section */
    .section-title {
        font-size: 2.5rem;
        font-weight: bold;
        color: var(--dark-color);
        margin-bottom: 1rem;
    }

    .section-subtitle {
        font-size: 1.2rem;
        margin-bottom: 2rem;
    }

    .service-card {
        background: white;
        padding: 2rem;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        text-align: center;
    }

    .service-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.15);
    }

    .service-icon {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
    }

    .service-icon.cyber {
        background: linear-gradient(135deg, #e74c3c, #c0392b);
    }

    .service-icon.ai {
        background: linear-gradient(135deg, #9b59b6, #8e44ad);
    }

    .service-icon.dev {
        background: linear-gradient(135deg, #3498db, #2980b9);
    }

    .service-icon i {
        font-size: 2.5rem;
        color: white;
    }

    .service-card h4 {
        color: var(--dark-color);
        margin-bottom: 1rem;
        font-size: 1.5rem;
    }

    .service-card p {
        color: #666;
        margin-bottom: 1.5rem;
    }

    .service-features {
        list-style: none;
        padding: 0;
        text-align: left;
    }

    .service-features li {
        padding: 0.25rem 0;
        color: #666;
        position: relative;
        padding-left: 1.5rem;
    }

    .service-features li:before {
        content: "✓";
        color: var(--orange-color);
        font-weight: bold;
        position: absolute;
        left: 0;
    }

    /* Event Cards */
    .event-card {
        background: white;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        transition: transform 0.3s ease;
    }

    .event-card:hover {
        transform: translateY(-3px);
    }

    .event-img {
        height: 100px;
        object-fit: cover;
    }

    .event-img-placeholder {
        height: 100px;
        background: #f8f9fa;
        border-radius: 0.375rem 0 0 0.375rem;
    }

    /* Newsletter Section */
    .newsletter-form .input-group {
        max-width: 400px;
        margin-left: auto;
    }

    .newsletter-form .form-control {
        border: none;
        padding: 0.75rem 1rem;
    }

    .newsletter-form .btn {
        padding: 0.75rem 1.5rem;
        border: none;
    }

    /* Product Cards */
    .product-card {
        background: white;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        transition: transform 0.3s ease;
    }

    .product-card:hover {
        transform: translateY(-5px);
    }

    .product-img {
        height: 200px;
        overflow: hidden;
        position: relative;
    }

    .product-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .badge-new {
        position: absolute;
        top: 10px;
        left: 10px;
        background-color: #27ae60;
        color: white;
        padding: 5px 10px;
        border-radius: 4px;
        font-size: 0.75rem;
        font-weight: bold;
    }

    .product-info {
        padding: 1.5rem;
    }

    .product-title {
        color: var(--dark-color);
        margin-bottom: 0.5rem;
        font-weight: 600;
    }

    .product-description {
        color: #666;
        margin-bottom: 1rem;
    }

    .product-price {
        font-weight: bold;
        font-size: 1.25rem;
        color: var(--orange-color);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .hero-section {
            height: 60vh;
        }
        
        .section-title {
            font-size: 2rem;
        }
        
        .stat-number {
            font-size: 2rem;
        }
        
        .service-card {
            margin-bottom: 2rem;
        }
    }
</style>
@endsection

@section('scripts')
<script>
    // Newsletter form submission
    document.querySelector('.newsletter-form').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const email = this.querySelector('input[type="email"]').value;
        
        // Simuler l'inscription
        alert('Merci pour votre inscription ! Vous recevrez bientôt nos actualités.');
        this.querySelector('input[type="email"]').value = '';
    });

    // Smooth scroll for internal links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Animation on scroll
    const observeElements = document.querySelectorAll('.stat-card, .service-card, .event-card');
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    });

    observeElements.forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(20px)';
        el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observer.observe(el);
    });
</script>
@endsection