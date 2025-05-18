@extends('user.layouts.app')

@section('title', 'Espace utilisateur')

@section('styles')
<style>
    :root {
        --primary: #ff8c00;
        --secondary: #f5e6ca;
        --dark: #212121;
        --light: #f8f9fa;
    }
    
    .hero {
        background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('{{ asset("images/banner.jpg") }}');
        background-size: cover;
        background-position: center;
        color: white;
        padding: 100px 0;
    }
    
    .hero h1 {
        font-weight: 700;
        margin-bottom: 25px;
    }
    
    .hero p {
        font-size: 1.2rem;
        margin-bottom: 30px;
    }
    
    .feature-box {
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        background-color: white;
        transition: transform 0.3s;
        height: 100%;
    }
    
    .feature-box:hover {
        transform: translateY(-10px);
    }
    
    .feature-icon {
        font-size: 50px;
        color: var(--primary);
        margin-bottom: 20px;
    }
    
    .stats-counter {
        font-size: 3rem;
        font-weight: 700;
        color: var(--primary);
    }
    
    .stats-text {
        font-size: 1.2rem;
        color: var(--dark);
    }
    
    .stats-box {
        background-color: var(--secondary);
        border-radius: 10px;
        padding: 30px;
    }
    
    .formation-card {
        border: none;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s;
    }
    
    .formation-card:hover {
        transform: translateY(-10px);
    }
    
    .card-img-top {
        height: 200px;
        object-fit: cover;
    }
    
    .section-title {
        position: relative;
        margin-bottom: 50px;
        padding-bottom: 15px;
    }
    
    .section-title::after {
        content: '';
        position: absolute;
        left: 0;
        right: 0;
        bottom: 0;
        margin: 0 auto;
        width: 100px;
        height: 3px;
        background-color: var(--primary);
    }
    
    .social-icon {
        font-size: 24px;
        color: var(--light);
        margin-right: 15px;
        transition: color 0.3s;
    }
    
    .social-icon:hover {
        color: var(--primary);
    }
    
    .boutique-section {
        background-color: var(--secondary);
    }
    
    .testimonial-card {
        background-color: white;
        border-radius: 10px;
        padding: 30px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }
    
    .testimonial-img {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        object-fit: cover;
        margin-bottom: 20px;
    }
</style>
@endsection

@section('content')
    <!-- Le navbar est probablement déjà défini dans le layout 'user.layouts.app' -->

    <!-- Hero Section -->
    <section class="hero text-center">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <h1>Centre de Formation Professionnel</h1>
                    <p>Des formations de qualité pour votre avenir professionnel</p>
                    <a href="#formations" class="btn btn-primary btn-lg me-3">Nos formations</a>
                    <a href="#contact" class="btn btn-outline-light btn-lg">Contactez-nous</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center section-title">Nos services</h2>
            <div class="row gy-4">
                <div class="col-md-4">
                    <div class="feature-box text-center">
                        <i class="fas fa-laptop-code feature-icon"></i>
                        <h3>Formations professionnelles</h3>
                        <p>Des formations adaptées aux besoins du marché, dispensées par des experts.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-box text-center">
                        <i class="fas fa-certificate feature-icon"></i>
                        <h3>Attestations de présence</h3>
                        <p>Certificats et attestations reconnus par les professionnels du secteur.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-box text-center">
                        <i class="fas fa-store feature-icon"></i>
                        <h3>Boutique spécialisée</h3>
                        <p>Tous les outils et ressources nécessaires pour votre apprentissage.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-5 bg-dark text-white">
        <div class="container">
            <h2 class="text-center section-title text-white">Nos chiffres</h2>
            <div class="row">
                <div class="col-md-3 text-center mb-4">
                    <div class="stats-counter" data-count="150">0</div>
                    <div class="stats-text">Formations</div>
                </div>
                <div class="col-md-3 text-center mb-4">
                    <div class="stats-counter" data-count="5000">0</div>
                    <div class="stats-text">Étudiants formés</div>
                </div>
                <div class="col-md-3 text-center mb-4">
                    <div class="stats-counter" data-count="98">0</div>
                    <div class="stats-text">% de satisfaction</div>
                </div>
                <div class="col-md-3 text-center mb-4">
                    <div class="stats-counter" data-count="25">0</div>
                    <div class="stats-text">Formateurs experts</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Formations Section -->
    <section id="formations" class="py-5">
        <div class="container">
            <h2 class="text-center section-title">Nos formations populaires</h2>
            <div class="row gy-4">
                <div class="col-lg-4 col-md-6">
                    <div class="card formation-card">
                        <img src="/api/placeholder/400/250" class="card-img-top" alt="Formation 1">
                        <div class="card-body">
                            <h5 class="card-title">Développement Web</h5>
                            <div class="d-flex justify-content-between mb-3">
                                <span class="text-muted">3 mois</span>
                                <span class="badge bg-primary">Populaire</span>
                            </div>
                            <p class="card-text">Apprenez les technologies web modernes et devenez développeur full-stack.</p>
                            <a href="#" class="btn btn-primary">En savoir plus</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="card formation-card">
                        <img src="/api/placeholder/400/250" class="card-img-top" alt="Formation 2">
                        <div class="card-body">
                            <h5 class="card-title">Marketing Digital</h5>
                            <div class="d-flex justify-content-between mb-3">
                                <span class="text-muted">2 mois</span>
                                <span class="badge bg-success">Nouveau</span>
                            </div>
                            <p class="card-text">Maîtrisez les stratégies de marketing en ligne pour développer votre entreprise.</p>
                            <a href="#" class="btn btn-primary">En savoir plus</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="card formation-card">
                        <img src="/api/placeholder/400/250" class="card-img-top" alt="Formation 3">
                        <div class="card-body">
                            <h5 class="card-title">Data Science</h5>
                            <div class="d-flex justify-content-between mb-3">
                                <span class="text-muted">4 mois</span>
                                <span class="badge bg-warning text-dark">Avancé</span>
                            </div>
                            <p class="card-text">Analysez et interprétez des données complexes pour prendre des décisions stratégiques.</p>
                            <a href="#" class="btn btn-primary">En savoir plus</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mt-5">
                <a href="#" class="btn btn-outline-primary btn-lg">Voir toutes nos formations</a>
            </div>
        </div>
    </section>

    <!-- Attestations Section -->
    <section id="attestations" class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center section-title">Attestations de présence</h2>
            <div class="row">
                <div class="col-lg-6 mx-auto text-center">
                    <p class="lead mb-5">Nous délivrons des attestations officielles à la fin de chaque formation, reconnues par les professionnels du secteur.</p>
                </div>
            </div>
            <div class="row gy-4">
                <div class="col-md-6">
                    <div class="testimonial-card">
                        <img src="/api/placeholder/80/80" class="testimonial-img" alt="Témoignage 1">
                        <p class="fst-italic mb-3">"Grâce à l'attestation reçue après ma formation, j'ai pu valoriser mes nouvelles compétences auprès de mon employeur et obtenir une promotion."</p>
                        <h5 class="mb-1">Sarah D.</h5>
                        <small class="text-muted">Développeuse Web</small>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="testimonial-card">
                        <img src="/api/placeholder/80/80" class="testimonial-img" alt="Témoignage 2">
                        <p class="fst-italic mb-3">"Les attestations délivrées sont reconnues dans le milieu professionnel. Elles m'ont permis de me reconvertir facilement dans un nouveau domaine."</p>
                        <h5 class="mb-1">Thomas M.</h5>
                        <small class="text-muted">Expert en Marketing Digital</small>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Boutique Section -->
    <section id="boutique" class="py-5 boutique-section">
        <div class="container">
            <h2 class="text-center section-title">Notre boutique</h2>
            <div class="row gy-4">
                <div class="col-md-3">
                    <div class="card formation-card">
                        <img src="/api/placeholder/300/200" class="card-img-top" alt="Produit 1">
                        <div class="card-body">
                            <h5 class="card-title">Manuel de formation</h5>
                            <p class="card-text">Support complet pour accompagner votre apprentissage.</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="fw-bold">29,99 €</span>
                                <a href="#" class="btn btn-sm btn-primary">Ajouter au panier</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card formation-card">
                        <img src="/api/placeholder/300/200" class="card-img-top" alt="Produit 2">
                        <div class="card-body">
                            <h5 class="card-title">Pack d'outils</h5>
                            <p class="card-text">Ensemble d'outils essentiels pour les professionnels.</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="fw-bold">49,99 €</span>
                                <a href="#" class="btn btn-sm btn-primary">Ajouter au panier</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card formation-card">
                        <img src="/api/placeholder/300/200" class="card-img-top" alt="Produit 3">
                        <div class="card-body">
                            <h5 class="card-title">Cours en ligne</h5>
                            <p class="card-text">Accès illimité à nos cours vidéo professionnels.</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="fw-bold">79,99 €</span>
                                <a href="#" class="btn btn-sm btn-primary">Ajouter au panier</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card formation-card">
                        <img src="/api/placeholder/300/200" class="card-img-top" alt="Produit 4">
                        <div class="card-body">
                            <h5 class="card-title">Consultation privée</h5>
                            <p class="card-text">Session personnalisée avec un de nos experts.</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="fw-bold">119,99 €</span>
                                <a href="#" class="btn btn-sm btn-primary">Ajouter au panier</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mt-5">
                <a href="#" class="btn btn-outline-primary btn-lg">Visiter la boutique</a>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-5">
        <div class="container">
            <h2 class="text-center section-title">Contactez-nous</h2>
            <div class="row">
                <div class="col-lg-6">
                    <form>
                        <div class="mb-3">
                            <label for="name" class="form-label">Nom complet</label>
                            <input type="text" class="form-control" id="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="subject" class="form-label">Sujet</label>
                            <input type="text" class="form-control" id="subject" required>
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Message</label>
                            <textarea class="form-control" id="message" rows="5" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Envoyer</button>
                    </form>
                </div>
                <div class="col-lg-6">
                    <div class="ps-lg-5 mt-4 mt-lg-0">
                        <h4>Nos coordonnées</h4>
                        <p><i class="fas fa-map-marker-alt me-2"></i> 123 Rue de la Formation, 75000 Paris</p>
                        <p><i class="fas fa-phone me-2"></i> +33 1 23 45 67 89</p>
                        <p><i class="fas fa-envelope me-2"></i> contact@votrecentre.com</p>
                        <h4 class="mt-4">Heures d'ouverture</h4>
                        <p>Lundi - Vendredi: 9h00 - 18h00</p>
                        <p>Samedi: 10h00 - 15h00</p>
                        <p>Dimanche: Fermé</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Le footer est probablement déjà défini dans le layout 'user.layouts.app' -->
@endsection

@section('scripts')
<script>
    // Counter Animation
    const counters = document.querySelectorAll('.stats-counter');
    const speed = 200;
    
    counters.forEach(counter => {
        const animate = () => {
            const value = +counter.getAttribute('data-count');
            const data = +counter.innerText;
            
            const time = value / speed;
            if (data < value) {
                counter.innerText = Math.ceil(data + time);
                setTimeout(animate, 1);
            } else {
                counter.innerText = value;
            }
        }
        animate();
    });
    
    // Smooth Scroll
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            
            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });
    
    // Scroll to reveal animations
    window.addEventListener('scroll', reveal);
    
    function reveal() {
        var reveals = document.querySelectorAll('.feature-box, .formation-card, .testimonial-card');
        
        for (var i = 0; i < reveals.length; i++) {
            var windowHeight = window.innerHeight;
            var revealTop = reveals[i].getBoundingClientRect().top;
            var revealPoint = 150;
            
            if (revealTop < windowHeight - revealPoint) {
                reveals[i].classList.add('active');
            }
        }
    }
</script>
@endsection