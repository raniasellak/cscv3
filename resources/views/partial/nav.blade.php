<nav class="navbar navbar-expand-lg">
  <div class="container">
    <!-- Logo CSC -->
    <a class="navbar-brand" href="#">
      <div class="logo-container">
        <span class="logo-letter c-letter">C</span>
        <span class="logo-letter s-letter">S</span>
        <span class="logo-letter c2-letter">C</span>
      </div>
    </a>
    
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <!-- Route: accueil -->
          <a class="nav-link" href="{{route('home')}}">Accueil</a>
        </li>
        <li class="nav-item">
          <!-- Route: à définir -->
          <a class="nav-link" href="#">Formations</a>
        </li>
        <li class="nav-item">
          <!-- Route: à définir -->
          <a class="nav-link" href="profiles.index">Profiles</a>
        </li>
        <li class="nav-item">
          <!-- Route: à définir -->
          <a class="nav-link" href="#">Cellules</a>
        </li>
        <li class="nav-item">
          <!-- Route: à définir -->
          <a class="nav-link" href="#">Boutique</a>
        </li>
        <li class="nav-item">
          <!-- Route: à définir -->
          <a class="nav-link" href="#">Contact</a>
        </li>
      </ul>
      
      <div class="auth-buttons">
        <!-- Route: à définir pour la connexion -->
        <a href="#" class="btn btn-outline connexion">Connexion</a>
        
        <!-- Route: à définir pour l'inscription -->
        <a href="#" class="btn btn-primary inscription">Inscription</a>
      </div>
    </div>
  </div>
</nav>

<style>
  /* Styles pour la navbar */
  .navbar {
    background-color: white;
    padding: 0.5rem 1rem;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
  }
  
  /* Style du logo CSC */
  .logo-container {
    display: inline-flex;
    font-size: 2rem;
    font-weight: bold;
    margin-right: 1rem;
  }
  
  .logo-letter {
    display: inline-block;
    width: 30px;
    text-align: center;
  }
  
  .c-letter {
    color: #272727;
  }
  
  .s-letter {
    color: #FE7F02; /* Orange vif comme dans l'image */
    background-color: #FE7F02;
    color: white;
  }
  
  .c2-letter {
    color: #FFD68A; /* Jaune pâle comme dans l'image */
    background-color: #FFD68A;
  }
  
  /* Styles pour les liens de navigation */
  .navbar-nav .nav-link {
    color: #333;
    font-weight: 500;
    padding: 1rem 1.5rem;
    transition: color 0.3s ease;
  }
  
  .navbar-nav .nav-link:hover {
    color: #FE7F02;
  }
  
  /* Styles pour les boutons d'authentification */
  .auth-buttons {
    display: flex;
    gap: 10px;
  }
  
  .connexion {
    border: none;
    color: #333;
    font-weight: 500;
  }
  
  .connexion:hover {
    color: #FE7F02;
  }
  
  .inscription {
    background-color: #FE7F02;
    border: none;
    color: white;
    font-weight: 500;
    padding: 0.5rem 1.5rem;
    border-radius: 4px;
  }
  
  .inscription:hover {
    background-color: #e67200;
  }
  
  /* Media queries pour la responsivité */
  @media (max-width: 992px) {
    .auth-buttons {
      margin-top: 1rem;
      justify-content: center;
    }
    
    .navbar-nav .nav-link {
      padding: 0.5rem 0;
    }
  }
</style>