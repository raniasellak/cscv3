

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
                    Bienvenue au <span class="text-orange">Computer Science Club</span>
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
                <h2 class="section-title">Nos Cellules</h2>
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
                    <h4>Développement Web</h4>
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
            --gradient-primary: linear-gradient(135deg, #ff8c00, #e07e00);
            --gradient-cyber: linear-gradient(135deg, #e74c3c, #c0392b);
            --gradient-ai: linear-gradient(135deg, #9b59b6, #8e44ad);
            --gradient-dev: linear-gradient(135deg, #3498db, #2980b9);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            overflow-x: hidden;
        }

        .text-orange { color: var(--orange-color) !important; }
        .bg-orange { background-color: var(--orange-color) !important; }

       
        /* Buttons */
        .btn-orange {
            background: var(--gradient-primary);
            border: none;
            color: white;
            padding: 0.75rem 2rem;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-orange:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(255, 140, 0, 0.3);
            color: white;
        }

        .btn-outline-orange {
            border: 2px solid var(--orange-color);
            color: var(--orange-color);
            background: transparent;
            padding: 0.75rem 2rem;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-outline-orange:hover {
            background: var(--orange-color);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(255, 140, 0, 0.3);
        }
.hero-section {
    background: linear-gradient(135deg, 
                    rgba(10, 15, 35, 0.95) 0%,
                    rgba(15, 25, 50, 0.90) 25%,
                    rgba(20, 35, 65, 0.85) 50%,
                    rgba(25, 45, 80, 0.80) 75%,
                    rgba(30, 55, 95, 0.75) 100%),
                url('{{ asset("images/event.jpg") }}');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    height: 100vh;
    display: flex;
    align-items: center;
    position: relative;
    overflow: hidden;
}

/* Alternative avec un dégradé très sombre */
.hero-section-alt {
    background: linear-gradient(135deg, 
                    rgba(5, 10, 25, 0.95) 0%,
                    rgba(10, 20, 40, 0.90) 30%,
                    rgba(15, 30, 55, 0.85) 60%,
                    rgba(20, 40, 70, 0.80) 100%),
                url('{{ asset("images/event.jpg") }}');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    height: 100vh;
    display: flex;
    align-items: center;
    position: relative;
    overflow: hidden;
}

/* Version avec effet de vignette très sombre pour plus de profondeur */
.hero-section-vignette {
    background: 
        radial-gradient(ellipse at center, 
                       rgba(8, 15, 30, 0.4) 0%,
                       rgba(3, 8, 20, 0.95) 100%),
        linear-gradient(135deg, 
                       rgba(5, 12, 28, 0.90) 0%,
                       rgba(12, 22, 45, 0.85) 50%,
                       rgba(18, 32, 60, 0.80) 100%),
        url('{{ asset("images/event.jpg") }}');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    height: 100vh;
    display: flex;
    align-items: center;
    position: relative;
    overflow: hidden;
}

/* Version ultra-dark pour un effet dramatique */
.hero-section-ultra-dark {
    background: linear-gradient(135deg, 
                    rgba(0, 5, 15, 0.98) 0%,
                    rgba(5, 10, 25, 0.95) 25%,
                    rgba(8, 15, 35, 0.92) 50%,
                    rgba(12, 20, 45, 0.88) 75%,
                    rgba(15, 25, 55, 0.85) 100%),
                url('{{ asset("images/event.jpg") }}');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    height: 100vh;
    display: flex;
    align-items: center;
    position: relative;
    overflow: hidden;
}

/* Boutons avec dégradés orange et beige */
.btn {
    padding: 1rem 2.5rem;
    border: none;
    border-radius: 50px;
    font-size: 1.1rem;
    font-weight: 600;
    text-decoration: none;
    cursor: pointer;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.5s;
}

.btn:hover::before {
    left: 100%;
}

.btn-primary {
    background: linear-gradient(135deg, 
                              #ff8c00 0%,
                              #ff7f00 25%,
                              #ff6b00 50%,
                              #e55a00 75%,
                              #cc4f00 100%);
    color: white;
    box-shadow: 0 8px 25px rgba(255, 140, 0, 0.3);
}

.btn-primary:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 35px rgba(255, 140, 0, 0.4);
    background: linear-gradient(135deg, 
                              #ff9500 0%,
                              #ff8c00 25%,
                              #ff7f00 50%,
                              #ff6b00 75%,
                              #e55a00 100%);
}

.btn-secondary {
    background: linear-gradient(135deg, 
                              #f5deb3 0%,
                              #ddb892 25%,
                              #d2b48c 50%,
                              #c19a6b 75%,
                              #a0826d 100%);
    color: #2c1810;
    box-shadow: 0 8px 25px rgba(245, 222, 179, 0.3);
}

.btn-secondary:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 35px rgba(245, 222, 179, 0.4);
    background: linear-gradient(135deg, 
                              #f5e6d3 0%,
                              #e6c7a2 25%,
                              #ddb892 50%,
                              #d2b48c 75%,
                              #c19a6b 100%);
}

/* Animations */
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

@keyframes lightPulse {
    0% {
        opacity: 0.8;
        transform: scale(1);
    }
    100% {
        opacity: 1;
        transform: scale(1.05);
    }
}

@keyframes sparkleFloat {
    0%, 100% {
        opacity: 0.3;
        transform: translateY(0px);
    }
    50% {
        opacity: 0.8;
        transform: translateY(-10px);
    }
}

/* Responsive */
@media (max-width: 768px) {
    .hero-title {
        font-size: 2.5rem;
    }
    
    .hero-subtitle {
        font-size: 1.2rem;
    }
    
    .hero-buttons {
        flex-direction: column;
        align-items: flex-start;
    }
    
    .btn {
        width: 100%;
        max-width: 300px;
        text-align: center;
    }
}

@media (max-width: 480px) {
    .hero-title {
        font-size: 2rem;
    }
    
    .hero-subtitle {
        font-size: 1rem;
    }
    
    .hero-description {
        font-size: 1rem;
    }
}
        

        .floating-shapes {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }

        .shape {
            position: absolute;
            background: rgba(255, 140, 0, 0.1);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }

        .shape:nth-child(1) {
            width: 80px;
            height: 80px;
            top: 20%;
            left: 10%;
            animation-delay: 0s;
        }

        .shape:nth-child(2) {
            width: 120px;
            height: 120px;
            top: 60%;
            right: 15%;
            animation-delay: -2s;
        }

        .shape:nth-child(3) {
            width: 60px;
            height: 60px;
            bottom: 30%;
            left: 20%;
            animation-delay: -4s;
        }

        /* Stats Section */
        .stats-section {
            background: linear-gradient(135deg, #f8f9fa, #ffffff);
            padding: 5rem 0;
        }

        .stat-card {
            background: white;
            padding: 3rem 2rem;
            border-radius: 20px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 140, 0, 0.1);
        }

        .stat-card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        }

        .stat-icon {
            width: 100px;
            height: 100px;
            background: var(--gradient-primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 2rem;
            transition: all 0.3s ease;
        }

        .stat-card:hover .stat-icon {
            transform: rotate(360deg);
        }

        .stat-icon i {
            font-size: 2.5rem;
            color: white;
        }

        .stat-number {
            font-size: 3rem;
            font-weight: 900;
            color: var(--dark-color);
            margin-bottom: 1rem;
            background: var(--gradient-primary);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .stat-label {
            color: #666;
            font-size: 1.2rem;
            font-weight: 500;
        }

        /* Services Section */
        .services-section {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            padding: 6rem 0;
            position: relative;
        }

        .services-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="dots" width="10" height="10" patternUnits="userSpaceOnUse"><circle cx="5" cy="5" r="1" fill="rgba(255,140,0,0.1)"/></pattern></defs><rect width="100%" height="100%" fill="url(%23dots)"/></svg>');
        }

        .section-title {
            font-size: 3rem;
            font-weight: 800;
            color: var(--dark-color);
            margin-bottom: 1rem;
            text-align: center;
            position: relative;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 4px;
            background: var(--gradient-primary);
            border-radius: 2px;
        }

        .section-subtitle {
            font-size: 1.3rem;
            text-align: center;
            margin-bottom: 4rem;
            color: #666;
        }

        .service-card {
            background: white;
            padding: 3rem 2rem;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
            transition: all 0.4s ease;
            text-align: center;
            height: 100%;
            border: 1px solid rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            position: relative;
            overflow: hidden;
        }

        .service-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--gradient-primary);
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .service-card:hover::before {
            transform: scaleX(1);
        }

        .service-card:hover {
            transform: translateY(-15px);
            box-shadow: 0 25px 50px rgba(0,0,0,0.2);
        }

        .service-icon {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 2rem;
            transition: all 0.3s ease;
        }

        .service-icon.cyber { background: var(--gradient-cyber); }
        .service-icon.ai { background: var(--gradient-ai); }
        .service-icon.dev { background: var(--gradient-dev); }

        .service-card:hover .service-icon {
            transform: scale(1.1);
        }

        .service-icon i {
            font-size: 3rem;
            color: white;
        }

        .service-card h4 {
            color: var(--dark-color);
            margin-bottom: 1.5rem;
            font-size: 1.8rem;
            font-weight: 700;
        }

        .service-card p {
            color: #666;
            margin-bottom: 2rem;
            font-size: 1.1rem;
            line-height: 1.7;
        }

        .service-features {
            list-style: none;
            padding: 0;
            text-align: left;
        }

        .service-features li {
            padding: 0.5rem 0;
            color: #666;
            position: relative;
            padding-left: 2rem;
            font-size: 1rem;
            transition: color 0.3s ease;
        }

        .service-features li:before {
            content: "✓";
            color: var(--orange-color);
            font-weight: bold;
            position: absolute;
            left: 0;
            font-size: 1.2rem;
        }

        .service-card:hover .service-features li {
            color: var(--dark-color);
        }

        /* Newsletter Section */
        .newsletter-section {
            background: var(--gradient-primary);
            padding: 4rem 0;
            position: relative;
            overflow: hidden;
        }

        .newsletter-section::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 1px, transparent 1px);
            background-size: 50px 50px;
            animation: float 20s linear infinite;
        }

        .newsletter-form {
            position: relative;
            z-index: 2;
        }

        .newsletter-form .input-group {
            max-width: 500px;
            margin: 0 auto;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            border-radius: 50px;
            overflow: hidden;
        }

        .newsletter-form .form-control {
            border: none;
            padding: 1rem 1.5rem;
            font-size: 1.1rem;
            background: rgba(255,255,255,0.95);
        }

        .newsletter-form .form-control:focus {
            box-shadow: none;
            background: white;
        }

        .newsletter-form .btn {
            padding: 1rem 2rem;
            border: none;
            background: var(--dark-color);
            color: white;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .newsletter-form .btn:hover {
            background: #1a252f;
            transform: scale(1.05);
        }

        /* Animations */
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

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }
            
            .hero-subtitle {
                font-size: 1.2rem;
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

            .hero-buttons .btn-orange,
            .hero-buttons .btn-outline-orange {
                display: block;
                margin: 0.5rem 0;
                text-align: center;
            }
        }

        /* Scroll animations */
        .fade-in {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.6s ease;
        }

        .fade-in.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* Loading animation */
        .loading {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: var(--dark-color);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            transition: opacity 0.5s ease;
        }

        .loading.hidden {
            opacity: 0;
            pointer-events: none;
        }

        .spinner {
            width: 50px;
            height: 50px;
            border: 3px solid rgba(255, 140, 0, 0.3);
            border-top: 3px solid var(--orange-color);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
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