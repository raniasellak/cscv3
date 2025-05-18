@extends('layouts.master')  

@section('main')
<!-- Section héro avec image de fond -->
<section class="hero-section">
  <div class="hero-content">
    <h1>Welcome to the<br>Computer Science Club</h1>
    <p>Learn, Connect, and Grow with fellow computer science enthusiasts</p>
    
    <div class="hero-buttons">
      <!-- Route: à définir pour inscription -->
      <a href="#" class="btn btn-primary btn-join">Join Now</a>
      <!-- Route: à définir pour connexion -->
      <a href="#" class="btn btn-outline-light btn-login">Login</a>
    </div>
  </div>
</section>

<!-- Section des sessions de formation à venir -->
<section class="training-section">
  <div class="container">
    <h2 class="section-title">Upcoming Training Sessions</h2>
    <p class="section-description">Enhance your skills with our specialized training sessions led by industry experts.</p>
    
    <!-- Ici vous pourrez ajouter votre liste de formations -->
  </div>
</section>
@endsection

@section('styles')
<style>
  /* Styles pour la section héro */
  .hero-section {
    background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), 
                      url('{{ asset("images/waaw.jpg") }}'); /* Remplacer par votre image de ville */
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
  }
  
  .hero-content p {
    font-size: 1.25rem;
    margin-bottom: 2rem;
  }
  
  .hero-buttons {
    display: flex;
    justify-content: center;
    gap: 1rem;
  }
  
  .btn-join {
    background-color: #0070ff;
    border: none;
    padding: 0.75rem 2rem;
    font-weight: 500;
  }
  
  .btn-join:hover {
    background-color: #0060dd;
  }
  
  .btn-login {
    padding: 0.75rem 2rem;
    font-weight: 500;
  }
  
  /* Styles pour la section de formation */
  .training-section {
    padding: 4rem 0;
    background-color: #f8f9fa;
  }
  
  .section-title {
    font-size: 2.5rem;
    font-weight: 700;
    text-align: center;
    margin-bottom: 1rem;
  }
  
  .section-description {
    font-size: 1.2rem;
    text-align: center;
    color: #6c757d;
    max-width: 800px;
    margin: 0 auto 3rem auto;
  }
  
  /* Media queries pour la responsivité */
  @media (max-width: 768px) {
    .hero-content h1 {
      font-size: 2.5rem;
    }
    
    .section-title {
      font-size: 2rem;
    }
  }
</style>
@endsection