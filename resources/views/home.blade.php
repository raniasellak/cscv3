@extends('layouts.master')

@section('title', 'Accueil - CSC Formations & Événements')

@section('content')
<!-- Hero Section -->
<section class="hero-section">
    <div class="hero-overlay"></div>
    <div class="container">
        <div class="row align-items-center min-vh-75">
            <div class="col-lg-8 mx-auto text-center text-white">
                <h1 class="display-3 fw-bold mb-4 text-shadow animate-fade-in">
                    Bienvenue au CSC
                </h1>
                <p class="lead mb-4 text-shadow animate-fade-in-delay-1">
                    Centre de formations professionnelles et d'événements de qualité. 
                    Développez vos compétences avec nos experts.
                </p>
                <div class="d-flex flex-wrap gap-3 justify-content-center animate-fade-in-delay-2">
                    <a href="{{ route('formations.index') }}" class="btn btn-orange btn-lg px-4">
                        <i class="fas fa-graduation-cap me-2"></i>Découvrir les formations
                    </a>
                    <a href="{{ route('evenements.index') }}" class="btn btn-outline-light btn-lg px-4">
                        <i class="fas fa-calendar-alt me-2"></i>Voir les événements
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Quick Stats Section -->
<section class="stats-section py-5 bg-light">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-3 col-sm-6">
                <div class="stat-card text-center">
                    <div class="stat-icon bg-orange text-white mb-3">
                        <i class="fas fa-graduation-cap fa-2x"></i>
                    </div>
                    <h3 class="stat-number text-orange">{{ $stats['formations_count'] ?? '0' }}</h3>
                    <p class="stat-label text-muted">Formations disponibles</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="stat-card text-center">
                    <div class="stat-icon bg-success text-white mb-3">
                        <i class="fas fa-calendar-alt fa-2x"></i>
                    </div>
                    <h3 class="stat-number text-success">{{ $stats['evenements_count'] ?? '0' }}</h3>
                    <p class="stat-label text-muted">Événements à venir</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="stat-card text-center">
                    <div class="stat-icon bg-info text-white mb-3">
                        <i class="fas fa-users fa-2x"></i>
                    </div>
                    <h3 class="stat-number text-info">{{ $stats['participants_count'] ?? '0' }}</h3>
                    <p class="stat-label text-muted">Participants actifs</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="stat-card text-center">
                    <div class="stat-icon bg-warning text-white mb-3">
                        <i class="fas fa-certificate fa-2x"></i>
                    </div>
                    <h3 class="stat-number text-warning">{{ $stats['certificats_count'] ?? '0' }}</h3>
                    <p class="stat-label text-muted">Certificats délivrés</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Featured Formations Section -->
<section class="formations-section py-5">
    <div class="container">
        <div class="row mb-5">
            <div class="col-12 text-center">
                <h2 class="section-title">
                    <i class="fas fa-graduation-cap text-orange me-2"></i>
                    Formations à la une
                </h2>
                <p class="section-subtitle text-muted">
                    Découvrez nos formations les plus populaires et développez vos compétences
                </p>
            </div>
        </div>

        @if(isset($formations_featured) && $formations_featured->count() > 0)
            <div class="row g-4 mb-4">
                @foreach($formations_featured->take(3) as $formation)
                    <div class="col-lg-4 col-md-6">
                        <div class="formation-card h-100">
                            <div class="card-image-container">
                                @if($formation->image)
                                    <img src="{{ asset('storage/' . $formation->image) }}" 
                                         class="card-img-top formation-image" alt="{{ $formation->title }}">
                                @else
                                    <div class="formation-placeholder bg-gradient-orange">
                                        <i class="fas fa-graduation-cap fa-3x text-white opacity-75"></i>
                                    </div>
                                @endif
                                <div class="card-overlay">
                                    <span class="badge bg-orange">{{ $formation->category }}</span>
                                </div>
                            </div>
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title mb-2">{{ Str::limit($formation->title, 50) }}</h5>
                                <p class="card-text text-muted flex-grow-1">
                                    {{ Str::limit($formation->description, 100) }}
                                </p>
                                <div class="formation-meta mb-3">
                                    <small class="text-muted">
                                        <i class="fas fa-calendar me-1"></i>
                                        {{ \Carbon\Carbon::parse($formation->date)->format('d/m/Y') }}
                                    </small>
                                    @if($formation->duration)
                                        <small class="text-muted ms-3">
                                            <i class="fas fa-clock me-1"></i>
                                            {{ $formation->duration }}
                                        </small>
                                    @endif
                                </div>
                                <a href="{{ route('formations.show', $formation->id) }}" 
                                   class="btn btn-orange mt-auto">
                                    <i class="fas fa-eye me-1"></i>Voir les détails
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="row">
                <div class="col-12">
                    <div class="empty-state text-center py-5">
                        <i class="fas fa-graduation-cap fa-5x text-muted mb-3"></i>
                        <h4 class="text-muted">Aucune formation disponible pour le moment</h4>
                        <p class="text-muted">Revenez bientôt pour découvrir nos nouvelles formations !</p>
                    </div>
                </div>
            </div>
        @endif

        <div class="text-center">
            <a href="{{ route('formations.index') }}" class="btn btn-outline-orange btn-lg">
                <i class="fas fa-arrow-right me-2"></i>Voir toutes les formations
            </a>
        </div>
    </div>
</section>

<!-- Featured Events Section -->
<section class="events-section py-5 bg-light">
    <div class="container">
        <div class="row mb-5">
            <div class="col-12 text-center">
                <h2 class="section-title">
                    <i class="fas fa-calendar-alt text-orange me-2"></i>
                    Événements à venir
                </h2>
                <p class="section-subtitle text-muted">
                    Participez à nos événements et élargissez votre réseau professionnel
                </p>
            </div>
        </div>

        @if(isset($evenements_featured) && $evenements_featured->count() > 0)
            <div class="row g-4 mb-4">
                @foreach($evenements_featured->take(3) as $evenement)
                    <div class="col-lg-4 col-md-6">
                        <div class="event-card h-100">
                            <div class="card-image-container">
                                @if($evenement->image)
                                    <img src="{{ asset('storage/' . $evenement->image) }}" 
                                         class="card-img-top event-image" alt="{{ $evenement->titre }}">
                                @else
                                    <div class="event-placeholder bg-gradient-success">
                                        <i class="fas fa-calendar-alt fa-3x text-white opacity-75"></i>
                                    </div>
                                @endif
                                <div class="card-overlay">
                                    @if($evenement->date->isToday())
                                        <span class="badge bg-warning text-dark">Aujourd'hui</span>
                                    @elseif($evenement->date->isTomorrow())
                                        <span class="badge bg-info">Demain</span>
                                    @else
                                        <span class="badge bg-success">{{ $evenement->date->diffForHumans() }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title mb-2">{{ Str::limit($evenement->titre, 50) }}</h5>
                                <p class="card-text text-muted flex-grow-1">
                                    {{ Str::limit($evenement->description, 100) }}
                                </p>
                                <div class="event-meta mb-3">
                                    <small class="text-muted">
                                        <i class="fas fa-calendar me-1"></i>
                                        {{ \Carbon\Carbon::parse($evenement->date)->format('d/m/Y') }}
                                    </small>
                                    @if($evenement->lieu)
                                        <small class="text-muted ms-3">
                                            <i class="fas fa-map-marker-alt me-1"></i>
                                            {{ Str::limit($evenement->lieu, 20) }}
                                        </small>
                                    @endif
                                </div>
                                <a href="{{ route('evenements.show', $evenement->id) }}" 
                                   class="btn btn-success mt-auto">
                                    <i class="fas fa-eye me-1"></i>Voir les détails
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="row">
                <div class="col-12">
                    <div class="empty-state text-center py-5">
                        <i class="fas fa-calendar-alt fa-5x text-muted mb-3"></i>
                        <h4 class="text-muted">Aucun événement programmé pour le moment</h4>
                        <p class="text-muted">Restez connecté pour être informé de nos prochains événements !</p>
                    </div>
                </div>
            </div>
        @endif

        <div class="text-center">
            <a href="{{ route('evenements.index') }}" class="btn btn-outline-success btn-lg">
                <i class="fas fa-arrow-right me-2"></i>Voir tous les événements
            </a>
        </div>
    </div>
</section>

<!-- Call to Action Section -->
<section class="cta-section py-5 bg-orange text-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h3 class="mb-2">Prêt à développer vos compétences ?</h3>
                <p class="mb-0">Rejoignez notre communauté et accédez à des formations de qualité</p>
            </div>
            <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                @auth
                    <a href="{{ route('admin') }}" class="btn btn-light btn-lg">
                        <i class="fas fa-tachometer-alt me-2"></i>Mon tableau de bord
                    </a>
                @else
                    <a href="{{ route('register') }}" class="btn btn-light btn-lg me-2">
                        <i class="fas fa-user-plus me-2"></i>S'inscrire
                    </a>
                    <a href="{{ route('login') }}" class="btn btn-outline-light btn-lg">
                        <i class="fas fa-sign-in-alt me-2"></i>Se connecter
                    </a>
                @endauth
            </div>
        </div>
    </div>
</section>
@endsection

@section('styles')
<style>
    :root {
        --orange-color: #ff8c00;
        --orange-dark: #e07e00;
    }

    /* Hero Section */
    .hero-section {
        background: linear-gradient(135deg, var(--orange-color), var(--orange-dark)),
                    url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 600"><defs><pattern id="grid" width="40" height="40" patternUnits="userSpaceOnUse"><path d="M 40 0 L 0 0 0 40" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="1"/></pattern></defs><rect width="100%" height="100%" fill="url(%23grid)"/></svg>');
        background-size: cover;
        background-position: center;
        position: relative;
        overflow: hidden;
    }

    .hero-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0,0,0,0.3);
    }

    .min-vh-75 {
        min-height: 75vh;
    }

    .text-shadow {
        text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
    }

    /* Animations */
    .animate-fade-in {
        animation: fadeIn 1s ease-in-out;
    }

    .animate-fade-in-delay-1 {
        animation: fadeIn 1s ease-in-out 0.3s both;
    }

    .animate-fade-in-delay-2 {
        animation: fadeIn 1s ease-in-out 0.6s both;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Buttons */
    .btn-orange {
        background-color: var(--orange-color);
        border-color: var(--orange-color);
        color: white;
    }

    .btn-orange:hover {
        background-color: var(--orange-dark);
        border-color: var(--orange-dark);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(255, 140, 0, 0.3);
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

    .text-orange {
        color: var(--orange-color) !important;
    }

    .bg-orange {
        background-color: var(--orange-color) !important;
    }

    /* Stats Section */
    .stat-card {
        padding: 2rem 1rem;
        transition: transform 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-5px);
    }

    .stat-icon {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto;
        transition: transform 0.3s ease;
    }

    .stat-card:hover .stat-icon {
        transform: scale(1.1);
    }

    .stat-number {
        font-size: 2.5rem;
        font-weight: bold;
        margin-bottom: 0.5rem;
    }

    /* Section Titles */
    .section-title {
        font-size: 2.5rem;
        font-weight: bold;
        margin-bottom: 1rem;
    }

    .section-subtitle {
        font-size: 1.1rem;
        max-width: 600px;
        margin: 0 auto;
    }

    /* Card Styles */
    .formation-card,
    .event-card {
        border: none;
        border-radius: 15px;
        overflow: hidden;
        transition: all 0.3s ease;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    .formation-card:hover,
    .event-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 35px rgba(0,0,0,0.2);
    }

    .card-image-container {
        position: relative;
        overflow: hidden;
    }

    .formation-image,
    .event-image {
        height: 200px;
        object-fit: cover;
        width: 100%;
        transition: transform 0.3s ease;
    }

    .formation-card:hover .formation-image,
    .event-card:hover .event-image {
        transform: scale(1.05);
    }

    .formation-placeholder,
    .event-placeholder {
        height: 200px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .bg-gradient-orange {
        background: linear-gradient(135deg, var(--orange-color), var(--orange-dark));
    }

    .bg-gradient-success {
        background: linear-gradient(135deg, #28a745, #20c997);
    }

    .card-overlay {
        position: absolute;
        top: 15px;
        right: 15px;
    }

    .card-body {
        padding: 1.5rem;
    }

    .formation-meta,
    .event-meta {
        border-top: 1px solid #eee;
        padding-top: 1rem;
    }

    /* Empty State */
    .empty-state {
        background: white;
        border-radius: 15px;
        margin: 2rem 0;
    }

    /* CTA Section */
    .cta-section {
        background: linear-gradient(135deg, var(--orange-color), var(--orange-dark)) !important;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .hero-section {
            min-height: 60vh;
        }
        
        .display-3 {
            font-size: 2.5rem;
        }
        
        .section-title {
            font-size: 2rem;
        }
        
        .stat-number {
            font-size: 2rem;
        }
        
        .btn-lg {
            font-size: 1rem;
            padding: 0.75rem 1.5rem;
        }
    }

    @media (max-width: 576px) {
        .formation-card,
        .event-card {
            margin-bottom: 2rem;
        }
        
        .d-flex.flex-wrap.gap-3 {
            flex-direction: column;
        }
        
        .d-flex.flex-wrap.gap-3 .btn {
            width: 100%;
        }
    }
</style>
@endsection

@section('scripts')
<script>
    // Counter animation for stats
    function animateCounters() {
        const counters = document.querySelectorAll('.stat-number');
        counters.forEach(counter => {
            const target = parseInt(counter.textContent);
            let count = 0;
            const increment = target / 100;
            
            const updateCounter = () => {
                if (count < target) {
                    count += increment;
                    counter.textContent = Math.ceil(count);
                    setTimeout(updateCounter, 20);
                } else {
                    counter.textContent = target;
                }
            };
            
            updateCounter();
        });
    }

    // Intersection Observer for animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                if (entry.target.classList.contains('stats-section')) {
                    animateCounters();
                }
                entry.target.classList.add('animate-in');
            }
        });
    }, observerOptions);

    // Observe sections for animations
    document.addEventListener('DOMContentLoaded', function() {
        const sections = document.querySelectorAll('.stats-section, .formations-section, .events-section');
        sections.forEach(section => observer.observe(section));
        
        // Smooth scrolling for anchor links
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
    });
</script>
@endsection