@extends('user.layouts.app')

@section('title', 'Espace utilisateur')

@section('styles')
<style>
    :root {
        --primary: #FF6B00; /* Orange vif */
        --secondary: #F5E6CA; /* Beige */
        --dark: #1A1A1A; /* Noir profond */
        --light: #F8F9FA;
        --text-light: #E8E8E8;
    }
    
    body {
        background-color: var(--dark);
        color: var(--text-light);
        font-family: 'Inter', sans-serif;
    }
    
    /* Hero Section */
    .hero {
        background: linear-gradient(rgba(26, 26, 26, 0.8), rgba(26, 26, 26, 0.8)), url('https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1200&q=80');
        background-size: cover;
        background-position: center;
        padding: 150px 0;
        text-align: center;
    }
    
    .hero h1 {
        font-weight: 800;
        font-size: 3.5rem;
        margin-bottom: 25px;
        color: white;
    }
    
    .hero span {
        color: var(--primary);
    }
    
    .hero p {
        font-size: 1.3rem;
        margin-bottom: 40px;
        color: var(--text-light);
        max-width: 700px;
        margin-left: auto;
        margin-right: auto;
    }
    
    .btn-primary {
        background-color: var(--primary);
        border-color: var(--primary);
        padding: 12px 30px;
        font-weight: 600;
        border-radius: 50px;
        transition: all 0.3s;
    }
    
    .btn-primary:hover {
        background-color: #e06000;
        border-color: #e06000;
    }
    
    .btn-outline-light {
        border-radius: 50px;
        padding: 12px 30px;
        font-weight: 600;
        transition: all 0.3s;
    }
    
    .btn-outline-light:hover {
        background-color: white;
        color: var(--dark);
    }
    
    /* Section Title */
    .section-title {
        position: relative;
        margin-bottom: 60px;
        padding-bottom: 15px;
        color: white;
        font-weight: 700;
        text-align: center;
    }
    
    .section-title::after {
        content: '';
        position: absolute;
        left: 0;
        right: 0;
        bottom: 0;
        margin: 0 auto;
        width: 80px;
        height: 4px;
        background-color: var(--primary);
    }
    
    /* À propos Section */
    .about-section {
        padding: 100px 0;
        background-color: var(--dark);
    }
    
    .about-content {
        background-color: rgba(255, 107, 0, 0.05);
        border: 1px solid rgba(255, 107, 0, 0.1);
        border-radius: 15px;
        padding: 40px;
    }
    
    .about-content h3 {
        color: white;
        font-weight: 700;
        margin-bottom: 25px;
        padding-bottom: 15px;
        position: relative;
    }
    
    .about-content h3::after {
        content: '';
        position: absolute;
        left: 0;
        bottom: 0;
        width: 60px;
        height: 3px;
        background-color: var(--primary);
    }
    
    .about-img {
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0,0,0,0.3);
    }
    
    /* Services Section */
    .services-section {
        padding: 100px 0;
        background-color: #242424;
    }
    
    .service-card {
        background-color: var(--dark);
        border-radius: 15px;
        padding: 40px 30px;
        height: 100%;
        border: 1px solid rgba(255, 255, 255, 0.05);
        transition: all 0.3s;
        text-align: center;
    }
    
    .service-card:hover {
        border-color: var(--primary);
        transform: translateY(-10px);
    }
    
    .service-icon {
        font-size: 3rem;
        color: var(--primary);
        margin-bottom: 25px;
    }
    
    .service-title {
        color: white;
        font-weight: 700;
        margin-bottom: 20px;
        position: relative;
        padding-bottom: 15px;
    }
    
    .service-title::after {
        content: '';
        position: absolute;
        left: 0;
        right: 0;
        margin: 0 auto;
        bottom: 0;
        width: 40px;
        height: 3px;
        background-color: var(--primary);
    }
    
    .service-description {
        color: var(--text-light);
        margin-bottom: 25px;
    }
    
    /* Formations Section */
    .formations-section {
        padding: 100px 0;
        background-color: var(--dark);
    }
    
    .formation-card {
        background-color: #242424;
        border-radius: 15px;
        overflow: hidden;
        border: 1px solid rgba(255, 255, 255, 0.05);
        transition: all 0.3s;
        height: 100%;
    }
    
    .formation-card:hover {
        transform: translateY(-10px);
        border-color: var(--primary);
    }
    
    .card-img-top {
        height: 200px;
        object-fit: cover;
    }
    
    .card-body {
        padding: 25px;
    }
    
    .card-title {
        color: white;
        font-weight: 600;
    }
    
    .card-text {
        color: var(--text-light);
    }
    
    .badge {
        font-weight: 600;
        padding: 5px 10px;
        border-radius: 5px;
    }
    
    /* Statistiques Section */
    .stats-section {
        padding: 80px 0;
        background-color: #242424;
    }
    
    .stats-box {
        background-color: rgba(255, 107, 0, 0.1);
        border-radius: 15px;
        padding: 40px 30px;
        text-align: center;
        border: 1px solid rgba(255, 107, 0, 0.2);
        transition: transform 0.3s;
    }
    
    .stats-box:hover {
        transform: translateY(-10px);
    }
    
    .stats-counter {
        font-size: 3.5rem;
        font-weight: 800;
        color: var(--primary);
        margin-bottom: 10px;
    }
    
    .stats-text {
        font-size: 1.1rem;
        color: var(--text-light);
    }
</style>
@endsection

@section('content')

<!-- Hero Section -->
<section class="hero py-5 text-center bg-light-gray" style="background: linear-gradient(120deg, #fff7f0 0%, #f5f5dc 100%);">
    <div class="container">
        <h1 class="display-4 fw-bold mb-3">Bienvenue au <span style="color:var(--orange-color)">Computer Science Club</span></h1>
        <p class="lead mb-4">Le club universitaire qui rassemble les passionnés d'informatique, d'innovation et de technologie. Rejoignez-nous pour apprendre, partager, créer et vivre des expériences uniques !</p>
        <a href="#rejoindre" class="btn btn-warning btn-lg me-2">Rejoindre le club</a>
        <a href="#activites" class="btn btn-outline-dark btn-lg">Découvrir nos activités</a>
    </div>
</section>

<!-- Activités Section -->
<section id="activites" class="py-5">
    <div class="container">
        <h2 class="section-title mb-5">Nos Activités</h2>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body text-center">
                        <i class="fas fa-calendar-alt fa-2x mb-3 text-warning"></i>
                        <h5 class="card-title">Événements & Conférences</h5>
                        <p class="card-text">Participez à des conférences, meetups, tables rondes et hackathons animés par des experts et des alumni du club.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body text-center">
                        <i class="fas fa-chalkboard-teacher fa-2x mb-3 text-warning"></i>
                        <h5 class="card-title">Ateliers & Formations</h5>
                        <p class="card-text">Des ateliers pratiques et des formations sur le développement web, l'IA, la cybersécurité, la robotique, et bien plus encore.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body text-center">
                        <i class="fas fa-users fa-2x mb-3 text-warning"></i>
                        <h5 class="card-title">Vie associative</h5>
                        <p class="card-text">Des sorties, des team buildings, des soirées gaming, des compétitions et une ambiance conviviale toute l'année !</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Boutique Section -->
<section id="boutique" class="py-5 bg-light-gray">
    <div class="container">
        <h2 class="section-title mb-5">Notre Boutique</h2>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    <img src="https://images.unsplash.com/photo-1512436991641-6745cdb1723f?auto=format&fit=crop&w=400&q=80" class="card-img-top" alt="T-shirt club">
                    <div class="card-body">
                        <h5 class="card-title">T-shirt officiel CSC</h5>
                        <p class="card-text">Montrez votre appartenance au club avec notre t-shirt exclusif !</p>
                        <a href="{{ route('boutique.index') }}" class="btn btn-warning">Voir la boutique</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    <img src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=400&q=80" class="card-img-top" alt="Mug club">
                    <div class="card-body">
                        <h5 class="card-title">Mug CSC</h5>
                        <p class="card-text">Le mug parfait pour vos pauses café lors des sessions de code !</p>
                        <a href="{{ route('boutique.index') }}" class="btn btn-warning">Voir la boutique</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    <img src="https://images.unsplash.com/photo-1464983953574-0892a716854b?auto=format&fit=crop&w=400&q=80" class="card-img-top" alt="Goodies club">
                    <div class="card-body">
                        <h5 class="card-title">Goodies & accessoires</h5>
                        <p class="card-text">Stickers, carnets, tote bags et autres accessoires à l'effigie du club.</p>
                        <a href="{{ route('boutique.index') }}" class="btn btn-warning">Voir la boutique</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Formations Section -->
<section id="formations" class="py-5">
    <div class="container">
        <h2 class="section-title mb-5">Nos Formations</h2>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    <img src="https://images.unsplash.com/photo-1519389950473-47ba0277781c?auto=format&fit=crop&w=400&q=80" class="card-img-top" alt="Formation Web">
                    <div class="card-body">
                        <h5 class="card-title">Développement Web</h5>
                        <p class="card-text">HTML, CSS, JavaScript, frameworks modernes, projets pratiques.</p>
                        <a href="/formations" class="btn btn-outline-dark">Découvrir</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    <img src="https://images.unsplash.com/photo-1519125323398-675f0ddb6308?auto=format&fit=crop&w=400&q=80" class="card-img-top" alt="Formation IA">
                    <div class="card-body">
                        <h5 class="card-title">Intelligence Artificielle</h5>
                        <p class="card-text">Machine learning, deep learning, data science, projets IA.</p>
                        <a href="/formations" class="btn btn-outline-dark">Découvrir</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    <img src="https://images.unsplash.com/photo-1510511459019-5dda7724fd87?auto=format&fit=crop&w=400&q=80" class="card-img-top" alt="Formation Cybersécurité">
                    <div class="card-body">
                        <h5 class="card-title">Cybersécurité</h5>
                        <p class="card-text">Sécurité des systèmes, réseaux, cryptographie, CTF et challenges.</p>
                        <a href="/formations" class="btn btn-outline-dark">Découvrir</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Témoignages Section -->
<section id="temoignages" class="py-5 bg-light-gray">
    <div class="container">
        <h2 class="section-title mb-5">Ils parlent du club</h2>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body">
                        <p class="fst-italic">« Grâce au CSC, j'ai pu participer à mon premier hackathon et décrocher un stage en cybersécurité ! »</p>
                        <div class="d-flex align-items-center mt-3">
                            <img src="https://randomuser.me/api/portraits/men/32.jpg" class="rounded-circle me-3" width="50" height="50" alt="Membre">
                            <div>
                                <div class="fw-bold">Yassine L.</div>
                                <div class="text-muted small">Étudiant & membre actif</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body">
                        <p class="fst-italic">« Les ateliers du club m'ont permis de progresser rapidement en développement web et de rencontrer des amis passionnés. »</p>
                        <div class="d-flex align-items-center mt-3">
                            <img src="https://randomuser.me/api/portraits/women/44.jpg" class="rounded-circle me-3" width="50" height="50" alt="Membre">
                            <div>
                                <div class="fw-bold">Sarah M.</div>
                                <div class="text-muted small">Membre & animatrice atelier</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body">
                        <p class="fst-italic">« J'ai adoré la boutique du club, les goodies sont top et la livraison rapide ! »</p>
                        <div class="d-flex align-items-center mt-3">
                            <img src="https://randomuser.me/api/portraits/men/65.jpg" class="rounded-circle me-3" width="50" height="50" alt="Membre">
                            <div>
                                <div class="fw-bold">Omar K.</div>
                                <div class="text-muted small">Membre fidèle</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Partenaires Section -->
<section id="partenaires" class="py-5">
    <div class="container">
        <h2 class="section-title mb-5">Nos partenaires</h2>
        <div class="row g-4 justify-content-center align-items-center">
            <div class="col-6 col-md-3 text-center">
                <img src="https://upload.wikimedia.org/wikipedia/commons/6/6e/Logo_UM5_Rabat.png" alt="UM5" class="img-fluid mb-2" style="max-height:60px;">
                <div class="fw-bold">Université Mohammed V</div>
            </div>
            <div class="col-6 col-md-3 text-center">
                <img src="https://upload.wikimedia.org/wikipedia/commons/2/2d/Logo_Google_2013.png" alt="Google" class="img-fluid mb-2" style="max-height:60px;">
                <div class="fw-bold">Google Developer Student Clubs</div>
            </div>
            <div class="col-6 col-md-3 text-center">
                <img src="https://upload.wikimedia.org/wikipedia/commons/4/44/Microsoft_logo.svg" alt="Microsoft" class="img-fluid mb-2" style="max-height:60px;">
                <div class="fw-bold">Microsoft</div>
            </div>
            <div class="col-6 col-md-3 text-center">
                <img src="https://upload.wikimedia.org/wikipedia/commons/0/08/Logo_OCP_Group.png" alt="OCP" class="img-fluid mb-2" style="max-height:60px;">
                <div class="fw-bold">OCP Group</div>
            </div>
        </div>
    </div>
</section>

<!-- Appel à rejoindre le club -->
<section id="rejoindre" class="py-5 bg-warning text-dark text-center">
    <div class="container">
        <h2 class="mb-4">Envie de rejoindre l'aventure ?</h2>
        <p class="lead mb-4">Le Computer Science Club est ouvert à tous les étudiants motivés, quel que soit leur niveau. Rejoins-nous pour vivre une expérience unique, progresser et t'épanouir dans le numérique !</p>
        <a href="#" class="btn btn-dark btn-lg">Je veux rejoindre le club</a>
    </div>
</section>

@endsection