@extends('layouts.master')

@section('title', 'Espace utilisateur')

@section('styles')

@endsection

@section('content')

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <h1>Computer <span>Science</span> Club</h1>
                    <p>Votre club informatique de référence pour développer vos compétences et préparer votre avenir dans le numérique</p>
                    <a href="#formations" class="btn btn-primary btn-lg me-3">Nos formations</a>
                    <a href="#contact" class="btn btn-outline-light btn-lg">Nous contacter</a>
                </div>
            </div>
        </div>
    </section>

    <!-- À propos Section -->
    <section id="about" class="about-section">
        <div class="container">
            <h2 class="section-title">À PROPOS DE NOUS</h2>
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="about-content">
                        <h3>Qui sommes-nous ?</h3>
                        <p>Le Computer Science Club (CSC) est une communauté dynamique d'étudiants, professionnels et passionnés d'informatique qui se réunissent pour apprendre, partager et collaborer sur divers projets technologiques.</p>
                        <p>Fondé en 2020, notre club s'engage à démocratiser l'accès aux connaissances informatiques à travers des formations de qualité, des ateliers pratiques et des événements enrichissants.</p>
                        <p>Notre mission est de vous aider à développer vos compétences techniques, à rester à jour avec les dernières tendances de l'industrie et à construire un réseau professionnel solide.</p>
                        <a href="{{ route('about') }}" class="btn btn-primary mt-3">En savoir plus</a>
                    </div>
                </div>
                <div class="col-lg-6 mt-4 mt-lg-0">
                    <div class="about-img">
                        <img src="https://images.unsplash.com/photo-1531482615713-2afd69097998?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80" alt="Computer Science Club" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="services-section">
        <div class="container">
            <h2 class="section-title">NOS SERVICES</h2>
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="fas fa-laptop-code"></i>
                        </div>
                        <h3 class="service-title">Formations</h3>
                        <p class="service-description">Des formations complètes sur différentes technologies et langages de programmation, adaptées à tous les niveaux.</p>
                        <a href="#" class="btn btn-outline-light">Découvrir</a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <h3 class="service-title">Événements</h3>
                        <p class="service-description">Des hackathons, workshops et conférences pour rencontrer d'autres passionnés et enrichir vos connaissances.</p>
                        <a href="#" class="btn btn-outline-light">Découvrir</a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="fas fa-project-diagram"></i>
                        </div>
                        <h3 class="service-title">Projets</h3>
                        <p class="service-description">Collaborez sur des projets concrets pour appliquer vos compétences et enrichir votre portfolio.</p>
                        <a href="#" class="btn btn-outline-light">Découvrir</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Formations Section -->
    <section id="formations" class="formations-section">
        <div class="container">
            <h2 class="section-title">NOS FORMATIONS</h2>
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="card formation-card">
                        <img src="https://images.unsplash.com/photo-1547658719-da2b51169166?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=400&q=80" class="card-img-top" alt="Formation Développement Web">
                        <div class="card-body">
                            <h5 class="card-title">Développement Web</h5>
                            <div class="d-flex justify-content-between mb-3">
                                <span class="text-muted">3 mois</span>
                                <span class="badge bg-primary">Populaire</span>
                            </div>
                            <p class="card-text">Maîtrisez HTML, CSS, JavaScript et les frameworks modernes pour créer des sites web interactifs.</p>
                            <a href="#" class="btn btn-primary">S'inscrire</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="card formation-card">
                        <img src="https://images.unsplash.com/photo-1620712943543-bcc4688e7485?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=400&q=80" class="card-img-top" alt="Formation Intelligence Artificielle">
                        <div class="card-body">
                            <h5 class="card-title">Intelligence Artificielle</h5>
                            <div class="d-flex justify-content-between mb-3">
                                <span class="text-muted">4 mois</span>
                                <span class="badge bg-success">Nouveau</span>
                            </div>
                            <p class="card-text">Découvrez les concepts fondamentaux de l'IA, du machine learning et du deep learning.</p>
                            <a href="#" class="btn btn-primary">S'inscrire</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="card formation-card">
                        <img src="https://images.unsplash.com/photo-1510511459019-5dda7724fd87?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=400&q=80" class="card-img-top" alt="Formation Cybersécurité">
                        <div class="card-body">
                            <h5 class="card-title">Cybersécurité</h5>
                            <div class="d-flex justify-content-between mb-3">
                                <span class="text-muted">3 mois</span>
                                <span class="badge bg-warning text-dark">Limitée</span>
                            </div>
                            <p class="card-text">Apprenez à sécuriser les systèmes et à protéger les données contre les cyberattaques.</p>
                            <a href="#" class="btn btn-primary">S'inscrire</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mt-5">
                <a href="#" class="btn btn-outline-light btn-lg">Voir toutes nos formations</a>
            </div>
        </div>
    </section>

    <!-- Statistiques Section -->
    <section class="stats-section">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-3">
                    <div class="stats-box">
                        <div class="stats-counter" data-count="500">0</div>
                        <div class="stats-text">Membres actifs</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-box">
                        <div class="stats-counter" data-count="30">0</div>
                        <div class="stats-text">Formateurs experts</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-box">
                        <div class="stats-counter" data-count="150">0</div>
                        <div class="stats-text">Formations par an</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-box">
                        <div class="stats-counter" data-count="98">0</div>
                        <div class="stats-text">% de satisfaction</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection