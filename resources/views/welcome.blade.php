@extends('user.layouts.app')  

@section('main')
<!-- Section héro avec image de fond -->
<section class="hero-section">
  <div class="hero-content">
    <h1>Bienvenue au<br>Computer Science Club</h1>
    <p>Apprenez, Connectez-vous et Grandissez avec des passionnés d'informatique</p>
    
    <div class="hero-buttons">
      @guest
        <a href="{{ route('register') }}" class="btn btn-primary btn-join">Rejoignez-nous</a>
        <a href="{{ route('login') }}" class="btn btn-outline-light btn-login">Connexion</a>
      @else
        <a href="{{ route('formations.index') }}" class="btn btn-primary btn-join">Voir les Formations</a>
        <a href="{{ route('evenements.index') }}" class="btn btn-outline-light btn-login">Voir les Événements</a>
      @endguest
    </div>
  </div>
</section>

<!-- Section des statistiques -->
<section class="stats-section">
  <div class="container">
    <div class="row text-center">
      <div class="col-md-3 col-6">
        <div class="stat-card">
          <i class="fas fa-graduation-cap stat-icon"></i>
          <h3 class="stat-number">{{ $totalFormations ?? 0 }}</h3>
          <p class="stat-label">Formations</p>
        </div>
      </div>
      <div class="col-md-3 col-6">
        <div class="stat-card">
          <i class="fas fa-calendar-alt stat-icon"></i>
          <h3 class="stat-number">{{ $totalEvenements ?? 0 }}</h3>
          <p class="stat-label">Événements</p>
        </div>
      </div>
      <div class="col-md-3 col-6">
        <div class="stat-card">
          <i class="fas fa-users stat-icon"></i>
          <h3 class="stat-number">{{ $totalMembers ?? 0 }}</h3>
          <p class="stat-label">Membres</p>
        </div>
      </div>
      <div class="col-md-3 col-6">
        <div class="stat-card">
          <i class="fas fa-certificate stat-icon"></i>
          <h3 class="stat-number">{{ $totalCertificates ?? 0 }}</h3>
          <p class="stat-label">Certificats</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Section des formations à venir -->
<section class="training-section">
  <div class="container">
    <h2 class="section-title">Formations à Venir</h2>
    <p class="section-description">Améliorez vos compétences avec nos sessions de formation spécialisées dirigées par des experts de l'industrie.</p>
    
    @if(isset($upcomingFormations) && $upcomingFormations->count() > 0)
      <div class="row">
        @foreach($upcomingFormations->take(3) as $formation)
          <div class="col-lg-4 col-md-6 mb-4">
            <div class="formation-card">
              <div class="formation-image">
                @php
                  $categoryImages = [
                      'CyberSecurity' => 'cyber.jpg',
                      'AI'            => 'ai.webp',
                      'Dev'           => 'dev.jpg',
                  ];
                  $image = $categoryImages[$formation->category] ?? null;
                @endphp
                
                @if($image)
                  <img src="{{ asset('storage/formations/' . $image) }}" alt="{{ $formation->title }}">
                @else
                  <div class="formation-placeholder bg-gradient-orange">
                    <i class="fas fa-graduation-cap fa-2x text-white"></i>
                  </div>
                @endif
                
                <div class="formation-overlay">
                  <span class="badge bg-orange">{{ $formation->category }}</span>
                </div>
              </div>
              
              <div class="formation-content">
                <h5 class="formation-title">{{ $formation->title }}</h5>
                <p class="formation-description">{{ Str::limit($formation->description, 100) }}</p>
                
                <div class="formation-meta">
                  <div class="meta-item">
                    <i class="fas fa-calendar text-orange"></i>
                    <span>{{ \Carbon\Carbon::parse($formation->date)->format('d/m/Y') }}</span>
                  </div>
                  @if($formation->instructor)
                    <div class="meta-item">
                      <i class="fas fa-user text-orange"></i>
                      <span>{{ $formation->instructor }}</span>
                    </div>
                  @endif
                </div>
                
                <div class="formation-actions">
                  <a href="{{ route('formations.show', $formation->id) }}" class="btn btn-orange btn-sm">
                    <i class="fas fa-eye me-1"></i>Détails
                  </a>
                  @auth
                    @if(auth()->user()->role !== 'admin')
                      @php
                        $userInscrit = $formation->inscriptions->contains('user_id', auth()->id());
                      @endphp
                      @if(!$userInscrit)
                        <a href="{{ route('formations.show', $formation->id) }}" class="btn btn-outline-orange btn-sm">
                          <i class="fas fa-user-plus me-1"></i>S'inscrire
                        </a>
                      @else
                        <span class="badge bg-success">Inscrit</span>
                      @endif
                    @endif
                  @endauth
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
      
      <div class="text-center mt-4">
        <a href="{{ route('formations.index') }}" class="btn btn-outline-orange">
          <i class="fas fa-arrow-right me-1"></i>Voir toutes les formations
        </a>
      </div>
    @else
      <div class="empty-state">
        <i class="fas fa-graduation-cap fa-3x text-muted mb-3"></i>
        <h5 class="text-muted">Aucune formation programmée pour le moment</h5>
        <p class="text-muted">Restez à l'écoute pour nos prochaines sessions de formation !</p>
      </div>
    @endif
  </div>
</section>

<!-- Section des événements à venir -->
<section class="events-section">
  <div class="container">
    <h2 class="section-title">Événements à Venir</h2>
    <p class="section-description">Participez à nos événements communautaires et networking pour enrichir votre expérience.</p>
    
    @if(isset($upcomingEvenements) && $upcomingEvenements->count() > 0)
      <div class="row">
        @foreach($upcomingEvenements->take(3) as $evenement)
          <div class="col-lg-4 col-md-6 mb-4">
            <div class="event-card">
              <div class="event-image">
                @if($evenement->image)
                  <img src="{{ asset('storage/' . $evenement->image) }}" alt="{{ $evenement->titre }}">
                @else
                  <div class="event-placeholder bg-gradient-orange">
                    <i class="fas fa-calendar-alt fa-2x text-white"></i>
                  </div>
                @endif
                
                <div class="event-overlay">
                  @if($evenement->date->isToday())
                    <span class="badge bg-warning text-dark">Aujourd'hui</span>
                  @elseif($evenement->date->isTomorrow())
                    <span class="badge bg-info">Demain</span>
                  @else
                    <span class="badge bg-success">À venir</span>
                  @endif
                </div>
              </div>
              
              <div class="event-content">
                <h5 class="event-title">{{ $evenement->titre }}</h5>
                <p class="event-description">{{ Str::limit($evenement->description, 100) }}</p>
                
                <div class="event-meta">
                  <div class="meta-item">
                    <i class="fas fa-calendar text-orange"></i>
                    <span>{{ \Carbon\Carbon::parse($evenement->date)->format('d/m/Y') }}</span>
                  </div>
                  @if($evenement->lieu)
                    <div class="meta-item">
                      <i class="fas fa-map-marker-alt text-orange"></i>
                      <span>{{ $evenement->lieu }}</span>
                    </div>
                  @endif
                </div>
                
                <div class="event-actions">
                  <a href="{{ route('evenements.show', $evenement->id) }}" class="btn btn-orange btn-sm">
                    <i class="fas fa-eye me-1"></i>Détails
                  </a>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
      
      <div class="text-center mt-4">
        <a href="{{ route('evenements.index') }}" class="btn btn-outline-orange">
          <i class="fas fa-arrow-right me-1"></i>Voir tous les événements
        </a>
      </div>
    @else
      <div class="empty-state">
        <i class="fas fa-calendar-alt fa-3x text-muted mb-3"></i>
        <h5 class="text-muted">Aucun événement programmé pour le moment</h5>
        <p class="text-muted">Restez à l'écoute pour nos prochains événements !</p>
      </div>
    @endif
  </div>
</section>

<!-- Section Newsletter -->
<section class="newsletter-section">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8 text-center">
        <h3 class="newsletter-title">Restez Informé</h3>
        <p class="newsletter-description">Recevez les dernières actualités sur nos formations et événements</p>
        
        <form class="newsletter-form" action="#" method="POST">
          @csrf
          <div class="input-group">
            <input type="email" class="form-control" placeholder="Votre adresse email" required>
            <button class="btn btn-orange" type="submit">
              <i class="fas fa-paper-plane me-1"></i>S'abonner
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
@endsection

@section('styles')
<style>
  :root {
    --orange-color: #ff8c00;
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

  .bg-gradient-orange {
    background: linear-gradient(135deg, var(--orange-color), #e07e00);
  }

  /* Styles pour la section héro */
  .hero-section {
    background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), 
                      url('{{ asset("images/waaw.jpg") }}');
    background-size: cover;
    background-position: center;
    height: 500px;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    color: white;
    padding: 2rem;
  }
  
  .hero-content {
    max-width: 800px;
  }
  
  .hero-content h1 {
    font-size: 3.5rem;
    font-weight: 700;
    margin-bottom: 1.5rem;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
  }
  
  .hero-content p {
    font-size: 1.25rem;
    margin-bottom: 2rem;
    text-shadow: 1px 1px 2px rgba(0,0,0,0.5);
  }
  
  .hero-buttons {
    display: flex;
    justify-content: center;
    gap: 1rem;
    flex-wrap: wrap;
  }
  
  .btn-join {
    background-color: var(--orange-color);
    border: none;
    padding: 0.75rem 2rem;
    font-weight: 500;
  }
  
  .btn-join:hover {
    background-color: #e07e00;
  }
  
  .btn-login {
    padding: 0.75rem 2rem;
    font-weight: 500;
    border-color: white;
  }

  /* Section des statistiques */
  .stats-section {
    padding: 3rem 0;
    background-color: white;
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
    font-size: 2.5rem;
    color: var(--orange-color);
    margin-bottom: 1rem;
  }

  .stat-number {
    font-size: 2.5rem;
    font-weight: 700;
    color: #333;
    margin-bottom: 0.5rem;
  }

  .stat-label {
    color: #666;
    font-size: 1rem;
    margin-bottom: 0;
  }
  
  /* Styles pour les sections */
  .training-section, .events-section {
    padding: 4rem 0;
    background-color: #f8f9fa;
  }

  .events-section {
    background-color: white;
  }
  
  .section-title {
    font-size: 2.5rem;
    font-weight: 700;
    text-align: center;
    margin-bottom: 1rem;
    color: #333;
  }
  
  .section-description {
    font-size: 1.2rem;
    text-align: center;
    color: #6c757d;
    max-width: 800px;
    margin: 0 auto 3rem auto;
  }

  /* Cartes de formation */
  .formation-card, .event-card {
    background: white;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    height: 100%;
  }

  .formation-card:hover, .event-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.15);
  }

  .formation-image, .event-image {
    position: relative;
    height: 200px;
    overflow: hidden;
  }

  .formation-image img, .event-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }

  .formation-placeholder, .event-placeholder {
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .formation-overlay, .event-overlay {
    position: absolute;
    top: 1rem;
    right: 1rem;
  }

  .formation-content, .event-content {
    padding: 1.5rem;
  }

  .formation-title, .event-title {
    font-size: 1.25rem;
    font-weight: 600;
    margin-bottom: 0.75rem;
    color: #333;
  }

  .formation-description, .event-description {
    color: #666;
    margin-bottom: 1rem;
    line-height: 1.5;
  }

  .formation-meta, .event-meta {
    margin-bottom: 1.5rem;
  }

  .meta-item {
    display: flex;
    align-items: center;
    margin-bottom: 0.5rem;
    font-size: 0.9rem;
    color: #666;
  }

  .meta-item i {
    margin-right: 0.5rem;
    width: 16px;
  }

  .formation-actions, .event-actions {
    display: flex;
    gap: 0.5rem;
    align-items: center;
  }

  /* Empty state */
  .empty-state {
    text-align: center;
    padding: 3rem;
  }

  /* Newsletter */
  .newsletter-section {
    padding: 4rem 0;
    background: linear-gradient(135deg, var(--orange-color), #e07e00);
    color: white;
  }

  .newsletter-title {
    font-size: 2rem;
    font-weight: 600;
    margin-bottom: 1rem;
  }

  .newsletter-description {
    font-size: 1.1rem;
    margin-bottom: 2rem;
    opacity: 0.9;
  }

  .newsletter-form {
    max-width: 400px;
    margin: 0 auto;
  }

  .newsletter-form .form-control {
    border: none;
    padding: 0.75rem 1rem;
    font-size: 1rem;
  }

  .newsletter-form .btn {
    background-color: white;
    color: var(--orange-color);
    border: none;
    padding: 0.75rem 1.5rem;
    font-weight: 500;
  }

  .newsletter-form .btn:hover {
    background-color: #f8f9fa;
    color: #e07e00;
  }
  
  /* Media queries pour la responsivité */
  @media (max-width: 768px) {
    .hero-content h1 {
      font-size: 2.5rem;
    }
    
    .section-title {
      font-size: 2rem;
    }

    .stat-number {
      font-size: 2rem;
    }

    .hero-buttons {
      flex-direction: column;
      align-items: center;
    }

    .hero-buttons .btn {
      width: 200px;
    }
  }

  @media (max-width: 576px) {
    .hero-section {
      height: 400px;
    }

    .hero-content h1 {
      font-size: 2rem;
    }

    .hero-content p {
      font-size: 1.1rem;
    }

    .stats-section {
      padding: 2rem 0;
    }

    .training-section, .events-section {
      padding: 3rem 0;
    }
  }
</style>
@endsection

@section('scripts')
<script>
  // Animation pour les compteurs de statistiques
  document.addEventListener('DOMContentLoaded', function() {
    const statNumbers = document.querySelectorAll('.stat-number');
    
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          const target = entry.target;
          const finalValue = parseInt(target.textContent);
          animateCounter(target, finalValue);
          observer.unobserve(target);
        }
      });
    });

    statNumbers.forEach(number => {
      observer.observe(number);
    });
  });

  function animateCounter(element, finalValue) {
    let currentValue = 0;
    const increment = finalValue / 30;
    const timer = setInterval(() => {
      currentValue += increment;
      if (currentValue >= finalValue) {
        element.textContent = finalValue;
        clearInterval(timer);
      } else {
        element.textContent = Math.floor(currentValue);
      }
    }, 50);
  }

  // Smooth scroll pour les ancres
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
</script>
@endsection