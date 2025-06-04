@extends('layouts.master')

@section('title', 'À propos du CSC')

@section('content')

<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>À Propos - Computer Science Club</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --orange: #F57C00;
            --black: #1C1C1C;
            --beige: #F5F5DC;
            --white: #FFFFFF;
            --light-gray: #F8F9FA;
            --medium-gray: #6C757D;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: var(--black);
            background: linear-gradient(135deg, var(--white) 0%, var(--beige) 100%);
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Header */
        .header {
            background: linear-gradient(135deg, var(--black) 0%, #2a2a2a 100%);
            color: var(--white);
            padding: 2rem 0;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(120deg, 
                transparent 0%, 
                transparent 30%, 
                rgba(245, 124, 0, 0.1) 35%, 
                rgba(245, 124, 0, 0.2) 50%, 
                rgba(245, 124, 0, 0.3) 70%, 
                rgba(245, 124, 0, 0.4) 85%, 
                rgba(245, 124, 0, 0.5) 100%
            );
            z-index: 1;
        }

        .header::after {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 70%;
            height: 100%;
            background: linear-gradient(135deg, 
                transparent 0%, 
                rgba(245, 124, 0, 0.15) 20%, 
                rgba(245, 124, 0, 0.25) 40%, 
                rgba(245, 124, 0, 0.35) 60%, 
                rgba(245, 124, 0, 0.45) 80%, 
                rgba(245, 124, 0, 0.6) 100%
            );
            clip-path: polygon(20% 0%, 100% 0%, 100% 100%, 0% 100%);
            z-index: 1;
        }

        .header-content {
            position: relative;
            z-index: 2;
        }
     
        .header h1 {
            font-size: 3rem;
            font-weight: bold;
            margin-bottom: 1rem;
            background: linear-gradient(45deg, var(--white), var(--orange));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .header p {
            font-size: 1.2rem;
            opacity: 0.9;
        }

        /* Navigation */
        .nav {
            background: var(--white);
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .nav-container {
            display: flex;
            justify-content: center;
            padding: 1rem 0;
        }

        .nav-links {
            display: flex;
            gap: 1.5rem;
            list-style: none;
            flex-wrap: wrap;
            justify-content: center;
        }

        .nav-links a {
            text-decoration: none;
            color: var(--black);
            font-weight: 500;
            padding: 0.5rem 1rem;
            border-radius: 25px;
            transition: all 0.3s ease;
            font-size: 0.9rem;
        }

        .nav-links a:hover {
            background: var(--orange);
            color: var(--white);
            transform: translateY(-2px);
        }

        /* Sections */
        .section {
            padding: 4rem 0;
            margin: 2rem 0;
        }

        .section-title {
            font-size: 2.5rem;
            text-align: center;
            margin-bottom: 3rem;
            color: var(--black);
            position: relative;
        }

        .section-title::after {
            content: '';
            display: block;
            width: 80px;
            height: 4px;
            background: var(--orange);
            margin: 1rem auto;
            border-radius: 2px;
        }

        /* Presentation */
        .presentation {
            background: var(--white);
            border-radius: 20px;
            padding: 3rem;
            margin: 2rem 0;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            position: relative;
            overflow: hidden;
        }

        .presentation::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, var(--orange), var(--black));
        }

        .presentation-content {
            font-size: 1.1rem;
            text-align: center;
            max-width: 800px;
            margin: 0 auto;
        }

        /* Activités principales */
        .activities-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin: 3rem 0;
        }

        .activity-card {
            background: var(--white);
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .activity-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: var(--orange);
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .activity-card:hover::before {
            transform: scaleX(1);
        }

        .activity-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.15);
        }

        .activity-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        .activity-title {
            font-size: 1.3rem;
            font-weight: bold;
            color: var(--black);
            margin-bottom: 1rem;
        }

        .activity-description {
            color: var(--medium-gray);
            line-height: 1.6;
        }

        /* Objectifs */
        .objectives-container {
            background: var(--white);
            border-radius: 20px;
            padding: 3rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        .objectives-list {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }

        .objective-item {
            display: flex;
            align-items: flex-start;
            gap: 1rem;
            padding: 1.5rem;
            background: var(--light-gray);
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .objective-item:hover {
            background: var(--beige);
            transform: translateX(5px);
        }

        .objective-number {
            background: var(--orange);
            color: var(--white);
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            flex-shrink: 0;
        }

        .objective-text {
            color: var(--black);
            font-weight: 500;
        }

        /* Vision */
        .vision-container {
            background: linear-gradient(135deg, var(--orange) 0%, #FF8F00 100%);
            color: var(--white);
            border-radius: 20px;
            padding: 3rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .vision-container::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            animation: rotate 20s linear infinite;
        }

        .vision-content {
            position: relative;
            z-index: 2;
        }

        .vision-title {
            font-size: 2rem;
            margin-bottom: 1.5rem;
        }

        .vision-text {
            font-size: 1.2rem;
            line-height: 1.8;
            max-width: 800px;
            margin: 0 auto;
        }

        /* Cellules */
        .cellules {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 2rem;
            margin: 3rem 0;
        }

        .cellule {
            background: var(--white);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            position: relative;
        }

        .cellule:hover {
            transform: translateY(-10px);
            box-shadow: 0 25px 50px rgba(0,0,0,0.15);
        }

        .cellule-header {
            height: 200px;
            position: relative;
            overflow: hidden;
        }

        .cyber-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .dev-bg {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        }

        .ai-bg {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        }

        .cellule-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0,0,0,0.3);
        }

        .cellule-title {
            position: absolute;
            bottom: 1rem;
            left: 1.5rem;
            color: var(--white);
            font-size: 1.8rem;
            font-weight: bold;
            z-index: 2;
        }

        .cellule-content {
            padding: 2rem;
        }

        .cellule-description {
            margin-bottom: 1.5rem;
            color: #666;
        }

        .members-list {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        .member-tag {
            background: var(--beige);
            color: var(--black);
            padding: 0.3rem 0.8rem;
            border-radius: 15px;
            font-size: 0.9rem;
            border: 2px solid transparent;
            transition: all 0.3s ease;
        }

        .member-tag:hover {
            border-color: var(--orange);
            background: var(--orange);
            color: var(--white);
        }

        /* FAQ */
        .faq-container {
            max-width: 800px;
            margin: 0 auto;
        }

        .faq-item {
            background: var(--white);
            border-radius: 10px;
            margin-bottom: 1rem;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            overflow: hidden;
        }

        .faq-question {
            padding: 1.5rem;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: var(--white);
            border: none;
            width: 100%;
            text-align: left;
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--black);
            transition: all 0.3s ease;
        }

        .faq-question:hover {
            background: var(--light-gray);
        }

        .faq-question.active {
            background: var(--orange);
            color: var(--white);
        }

        .faq-icon {
            font-size: 1.2rem;
            transition: transform 0.3s ease;
        }

        .faq-question.active .faq-icon {
            transform: rotate(180deg);
        }

        .faq-answer {
            padding: 0 1.5rem;
            max-height: 0;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .faq-answer.active {
            padding: 1.5rem;
            max-height: 200px;
        }

        .faq-answer p {
            color: var(--medium-gray);
            line-height: 1.6;
        }

        /* Témoignages */
        .testimonials-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin: 3rem 0;
        }

        .testimonial-card {
            background: var(--white);
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            position: relative;
            transition: all 0.3s ease;
        }

        .testimonial-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.15);
        }

        .testimonial-card::before {
            content: '"';
            position: absolute;
            top: -10px;
            left: 20px;
            font-size: 4rem;
            color: var(--orange);
            opacity: 0.3;
        }

        .testimonial-text {
            font-style: italic;
            color: var(--medium-gray);
            line-height: 1.6;
            margin-bottom: 1.5rem;
        }

        .testimonial-author {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .author-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: linear-gradient(45deg, var(--orange), var(--beige));
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--white);
            font-weight: bold;
        }

        .author-info h4 {
            color: var(--black);
            font-weight: 600;
            margin-bottom: 0.2rem;
        }

        .author-info p {
            color: var(--orange);
            font-size: 0.9rem;
        }

        /* Organigramme */
        .organigramme {
            background: var(--white);
            border-radius: 20px;
            padding: 3rem;
            margin: 3rem 0;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        .org-chart {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 2rem;
        }

        .bureau-central {
            background: var(--orange);
            color: var(--white);
            padding: 1.5rem 3rem;
            border-radius: 15px;
            font-weight: bold;
            font-size: 1.2rem;
            text-align: center;
            box-shadow: 0 5px 15px rgba(245, 124, 0, 0.3);
        }

        .cellules-org {
            display: flex;
            justify-content: center;
            gap: 2rem;
            flex-wrap: wrap;
        }

        .cellule-org {
            background: var(--beige);
            padding: 1rem 2rem;
            border-radius: 10px;
            border: 3px solid var(--orange);
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .cellule-org:hover {
            background: var(--orange);
            color: var(--white);
            transform: scale(1.05);
        }

        /* Galerie */
        .gallery {
            margin: 3rem 0;
        }

        .carousel {
            position: relative;
            max-width: 800px;
            margin: 0 auto;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
        }

        .carousel-container {
            display: flex;
            transition: transform 0.5s ease;
        }

        .carousel-slide {
            min-width: 100%;
            height: 400px;
            position: relative;
            background-size: cover;
            background-position: center;
        }

        .slide1 { background: linear-gradient(45deg, var(--orange), var(--black)); }
        .slide2 { background: linear-gradient(45deg, #667eea, #764ba2); }
        .slide3 { background: linear-gradient(45deg, #f093fb, #f5576c); }

        .slide-content {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(transparent, rgba(0,0,0,0.8));
            color: var(--white);
            padding: 2rem;
        }

        .carousel-nav {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(255,255,255,0.2);
            border: none;
            color: var(--white);
            font-size: 2rem;
            padding: 1rem;
            cursor: pointer;
            border-radius: 50%;
            transition: all 0.3s ease;
        }

        .carousel-nav:hover {
            background: var(--orange);
        }

        .prev { left: 1rem; }
        .next { right: 1rem; }

        .carousel-dots {
            display: flex;
            justify-content: center;
            gap: 0.5rem;
            margin-top: 1rem;
        }

        .dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: #ccc;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .dot.active {
            background: var(--orange);
            transform: scale(1.2);
        }

        /* Équipe */
        .team-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin: 3rem 0;
        }

        .team-member {
            background: var(--white);
            border-radius: 20px;
            padding: 2rem;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .team-member::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--orange);
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .team-member:hover::before {
            transform: scaleX(1);
        }

        .team-member:hover {
            transform: translateY(-5px);
        }

        .member-photo {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: linear-gradient(45deg, var(--orange), var(--beige));
            margin: 0 auto 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: var(--white);
            font-weight: bold;
        }

        .member-name {
            font-size: 1.3rem;
            font-weight: bold;
            color: var(--black);
            margin-bottom: 0.5rem;
        }

        .member-role {
            color: var(--orange);
            font-weight: 500;
            margin-bottom: 1rem;
        }

        .member-description {
            font-size: 0.9rem;
            color: #666;
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

        @keyframes rotate {
            from {
                transform: rotate(0deg);
            }
            to {
                transform: rotate(360deg);
            }
        }

        .fade-in {
            animation: fadeInUp 0.6s ease-out;
        }

        .scroll-animate {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.6s ease;
        }

        .scroll-animate.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .header h1 {
                font-size: 2rem;
            }

            .nav-links {
                gap: 0.5rem;
            }

            .nav-links a {
                font-size: 0.8rem;
                padding: 0.4rem 0.8rem;
            }

            .section-title {
                font-size: 2rem;
            }

            .cellules {
                grid-template-columns: 1fr;
            }

            .cellules-org {
                flex-direction: column;
                align-items: center;
            }

            .presentation {
                padding: 2rem;
            }

            .carousel-nav {
                display: none;
            }

            .activities-grid {
                grid-template-columns: 1fr;
            }

            .objectives-list {
                grid-template-columns: 1fr;
            }

            .testimonials-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="container">
            <div class="header-content fade-in">
                <h1>Computer Science Club</h1>
                <p>Innovation • Formation • Excellence</p>
            </div>
        </div>
    </header>

    <!-- Navigation -->
    <nav class="nav">
        <div class="container">
            <div class="nav-container">
                <ul class="nav-links">
                    <li><a href="#presentation">Présentation</a></li>
                    <li><a href="#activites">Activités</a></li>
                    <li><a href="#objectifs">Objectifs</a></li>
                    <li><a href="#vision">Vision</a></li>
                    <li><a href="#cellules">Nos Cellules</a></li>
                    <li><a href="#organigramme">Organisation</a></li>
                    <li><a href="#galerie">Galerie</a></li>
                    <li><a href="#faq">FAQ</a></li>
                    <li><a href="#temoignages">Témoignages</a></li>
                    <li><a href="#equipe">Notre Équipe</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Présentation -->
    <section id="presentation" class="section">
        <div class="container">
            <div class="presentation scroll-animate">
                <div class="presentation-content">
                    <h2 class="section-title">Qui Sommes-Nous ?</h2>
                    <p>Le <strong>Computer Science Club</strong> est une communauté dynamique d'étudiants passionnés par les nouvelles technologies. Notre club universitaire rassemble des talents issus de différentes filières pour créer un environnement d'apprentissage collaboratif et d'innovation.</p>
                    <br>
                    <p>Nous organisons des formations accessibles à tous les niveaux, des événements enrichissants et des activités interactives animées par des experts, des étudiants avancés et nos lauréats. Notre mission est de démocratiser l'accès aux connaissances technologiques et de préparer la nouvelle génération aux défis numériques.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Nos Activités Principales -->
    <section id="activites" class="section">
        <div class="container">
            <h2 class="section-title scroll-animate">Nos Activités Principales</h2>
            <div class="activities-grid">
                <div class="activity-card scroll-animate">
                    <div class="activity-icon">🎓</div>
                    <div class="activity-title">Formations & Workshops</div>
                    <div class="activity-description">
                        Sessions de formation intensive sur les dernières technologies, animées par des experts et nos membres expérimentés. De débutant à avancé, nous couvrons tous les niveaux.
                    </div>
                </div>

                <div class="activity-card scroll-animate">
                    <div class="activity-icon">🏆</div>
                    <div class="activity-title">Compétitions & Hackathons</div>
                    <div class="activity-description">
                        Organisation de hackathons, challenges de programmation et participation à des compétitions nationales et internationales pour tester vos compétences.
                    </div>
                </div>

                <div class="activity-card scroll-animate">
                    <div class="activity-icon">🤝</div>
                    <div class="activity-title">Networking & Conférences</div>
                    <div class="activity-description">
                        Rencontres avec des professionnels du secteur, conférences avec des experts, et création d'un réseau professionnel solide pour votre carrière.
                    </div>
                </div>

                <div class="activity-card scroll-animate">
                    <div class="activity-icon">💡</div>
                    <div class="activity-title">Projets Collaboratifs</div>
                    <div class="activity-description">
                        Développement de projets innovants en équipe, permettant d'appliquer les connaissances théoriques dans des contextes pratiques et réels.
                    </div>
                </div>

                <div class="activity-card scroll-animate">
                    <div class="activity-icon">📚</div>
                    <div class="activity-title">Mentorat & Support</div>
                    <div class="activity-description">
                        Programme de mentorat entre étudiants, aide aux devoirs, préparation aux examens et accompagnement personnalisé dans votre parcours académique.
                    </div>
                </div>

                <div class="activity-card scroll-animate">
                    <div class="activity-icon">🌐</div>
                    <div class="activity-title">Veille Technologique</div>
                    <div class="activity-description">
                        Partage des dernières tendances technologiques, analyses des innovations du secteur et préparation aux évolutions futures du marché.
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Nos Objectifs -->
    <section id="objectifs" class="section">
        <div class="container">
            <h2 class="section-title scroll-animate">Nos Objectifs</h2>
            <div class="objectives-container scroll-animate">
                <div class="objectives-list">
                    <div class="objective-item">
                        <div class="objective-number">1</div>
                        <div class="objective-text">Démocratiser l'accès aux technologies avancées pour tous les étudiants</div>
                    </div>
                    <div class="objective-item">
                        <div class="objective-number">2</div>
                        <div class="objective-text">Créer une communauté d'apprentissage collaborative et inclusive</div>
                    </div>
                    <div class="objective-item">
                        <div class="objective-number">3</div>
                        <div class="objective-text">Développer les compétences pratiques complémentaires au cursus académique</div>
                    </div>
                    <div class="objective-item">
                        <div class="objective-number">4</div>
                        <div class="objective-text">Faciliter l'insertion professionnelle par le networking et l'expérience pratique</div>
                    </div>
                    <div class="objective-item">
                        <div class="objective-number">5</div>
                        <div class="objective-text">Promouvoir l'innovation et l'entrepreneuriat technologique</div>
                    </div>
                    <div class="objective-item">
                        <div class="objective-number">6</div>
                        <div class="objective-text">Contribuer au rayonnement de notre établissement dans l'écosystème tech</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Notre Vision à Long Terme -->
    <section id="vision" class="section">
        <div class="container">
            <h2 class="section-title scroll-animate">Notre Vision à Long Terme</h2>
            <div class="vision-container scroll-animate">
                <div class="vision-content">
                    <div class="vision-title">🚀 Vers l'Excellence Technologique</div>
                    <div class="vision-text">
                        Nous aspirons à devenir le club de référence au niveau national, reconnu pour la qualité de nos formations et l'excellence de nos membres. Notre vision est de créer un écosystème où chaque étudiant peut développer son potentiel technologique, contribuer à l'innovation et devenir un acteur clé de la transformation digitale du Maroc. Nous voulons être le pont entre l'université et l'industrie, formant les leaders technologiques de demain.
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Cellules -->
    <section id="cellules" class="section">
        <div class="container">
            <h2 class="section-title scroll-animate">Nos Cellules Spécialisées</h2>
            <div class="cellules">
                <div class="cellule scroll-animate">
                    <div class="cellule-header cyber-bg">
                        <div class="cellule-title">🛡️ Cyber Security</div>
                    </div>
                    <div class="cellule-content">
                        <div class="cellule-description">
                            Spécialisée dans la sécurité informatique et la protection des systèmes d'information. Cette cellule regroupe les experts en sécurité de demain.
                        </div>
                        <div class="members-list">
                            <span class="member-tag">Étudiants SIT</span>
                            <span class="member-tag">Licence Cybersécurité</span>
                            <span class="member-tag">Ethical Hacking</span>
                            <span class="member-tag">Forensics</span>
                        </div>
                    </div>
                </div>

                <div class="cellule scroll-animate">
                    <div class="cellule-header dev-bg">
                        <div class="cellule-title">💻 Développement</div>
                    </div>
                    <div class="cellule-content">
                        <div class="cellule-description">
                            Dédiée au développement logiciel, aux réseaux et aux systèmes d'information. Innovation et créativité au service de la technologie.
                        </div>
                        <div class="members-list">
                            <span class="member-tag">Étudiants IRISI</span>
                            <span class="member-tag">Full Stack</span>
                            <span class="member-tag">DevOps</span>
                            <span class="member-tag">Mobile Dev</span>
                        </div>
                    </div>
                </div>

                <div class="cellule scroll-animate">
                    <div class="cellule-header ai-bg">
                        <div class="cellule-title">🤖 Intelligence Artificielle</div>
                    </div>
                    <div class="cellule-content">
                        <div class="cellule-description">
                            Focalisée sur l'IA et l'innovation industrielle. Exploration des technologies émergentes et applications pratiques de l'intelligence artificielle.
                        </div>
                        <div class="members-list">
                            <span class="member-tag">Master IAII</span>
                            <span class="member-tag">Machine Learning</span>
                            <span class="member-tag">Deep Learning</span>
                            <span class="member-tag">Data Science</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Organigramme -->
    <section id="organigramme" class="section">
        <div class="container">
            <h2 class="section-title scroll-animate">Notre Organisation</h2>
            <div class="organigramme scroll-animate">
                <div class="org-chart">
                    <div class="bureau-central">
                        🎯 Grand Bureau Central
                        <div style="font-size: 0.9rem; font-weight: normal; margin-top: 0.5rem;">
                            Coordination générale • Toutes filières (SIT, IRISI, IAII)
                        </div>
                    </div>
                    <div style="width: 2px; height: 30px; background: var(--orange);"></div>
                    <div class="cellules-org">
                        <div class="cellule-org">🛡️ Cyber Security</div>
                        <div class="cellule-org">💻 Développement</div>
                        <div class="cellule-org">🤖 Intelligence Artificielle</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Galerie -->
    <section id="galerie" class="section">
        <div class="container">
            <h2 class="section-title scroll-animate">Nos Événements</h2>
            <div class="gallery scroll-animate">
                <div class="carousel">
                    <div class="carousel-container" id="carouselContainer">
                        <div class="carousel-slide slide1">
                            <div class="slide-content">
                                <h3>Workshop Cybersécurité</h3>
                                <p>Formation intensive sur les techniques de protection et d'audit sécuritaire</p>
                            </div>
                        </div>
                        <div class="carousel-slide slide2">
                            <div class="slide-content">
                                <h3>Hackathon Développement</h3>
                                <p>48h de programmation intensive avec nos partenaires industriels</p>
                            </div>
                        </div>
                        <div class="carousel-slide slide3">
                            <div class="slide-content">
                                <h3>Conférence IA & Innovation</h3>
                                <p>Rencontre avec des experts en intelligence artificielle et machine learning</p>
                            </div>
                        </div>
                    </div>
                    <button class="carousel-nav prev" onclick="prevSlide()">❮</button>
                    <button class="carousel-nav next" onclick="nextSlide()">❯</button>
                </div>
                <div class="carousel-dots">
                    <span class="dot active" onclick="currentSlide(1)"></span>
                    <span class="dot" onclick="currentSlide(2)"></span>
                    <span class="dot" onclick="currentSlide(3)"></span>
                </div>
            </div>
        </div>
    </section>

    <!-- Questions Fréquentes -->
    <section id="faq" class="section">
        <div class="container">
            <h2 class="section-title scroll-animate">Questions Fréquentes</h2>
            <div class="faq-container scroll-animate">
                <div class="faq-item">
                    <button class="faq-question" onclick="toggleFaq(this)">
                        Comment puis-je rejoindre le Computer Science Club ?
                        <span class="faq-icon">▼</span>
                    </button>
                    <div class="faq-answer">
                        <p>L'adhésion est ouverte à tous les étudiants passionnés par la technologie, quel que soit leur niveau ou leur filière. Il suffit de s'inscrire lors de nos journées portes ouvertes ou de nous contacter directement.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <button class="faq-question" onclick="toggleFaq(this)">
                        Y a-t-il des frais d'adhésion ?
                        <span class="faq-icon">▼</span>
                    </button>
                    <div class="faq-answer">
                        <p>Non, l'adhésion au club est totalement gratuite. Nous croyons que l'accès à la connaissance technologique doit être démocratisé et accessible à tous.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <button class="faq-question" onclick="toggleFaq(this)">
                        Quels sont les prérequis pour participer aux activités ?
                        <span class="faq-icon">▼</span>
                    </button>
                    <div class="faq-answer">
                        <p>Aucun prérequis technique n'est nécessaire ! Nous accueillons les débutants avec des formations adaptées, et proposons aussi des défis avancés pour les plus expérimentés.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <button class="faq-question" onclick="toggleFaq(this)">
                        À quelle fréquence organisez-vous des événements ?
                        <span class="faq-icon">▼</span>
                    </button>
                    <div class="faq-answer">
                        <p>Nous organisons des activités régulières : au moins 2 événements par mois (workshops, conférences, hackathons) plus des réunions hebdomadaires pour chaque cellule.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <button class="faq-question" onclick="toggleFaq(this)">
                        Puis-je rejoindre plusieurs cellules ?
                        <span class="faq-icon">▼</span>
                    </button>
                    <div class="faq-answer">
                        <p>Absolument ! Nous encourageons la polyvalence. Vous pouvez participer aux activités de plusieurs cellules selon vos intérêts et votre disponibilité.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <button class="faq-question" onclick="toggleFaq(this)">
                        Le club propose-t-il des certifications ?
                        <span class="faq-icon">▼</span>
                    </button>
                    <div class="faq-answer">
                        <p>Oui, nous délivrons des attestations de participation et de compétences pour nos formations. Nous préparons aussi nos membres aux certifications professionnelles reconnues.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Témoignages -->
    <section id="temoignages" class="section">
        <div class="container">
            <h2 class="section-title scroll-animate">Témoignages de nos Membres</h2>
            <div class="testimonials-grid">
                <div class="testimonial-card scroll-animate">
                    <div class="testimonial-text">
                        Rejoindre le CSC a été un tournant dans mon parcours. Les formations en cybersécurité m'ont permis de décrocher un stage chez une grande entreprise. L'ambiance est fantastique et l'entraide constante !
                    </div>
                    <div class="testimonial-author">
                        <div class="author-avatar">A</div>
                        <div class="author-info">
                            <h4>Ahmed Benali</h4>
                            <p>Étudiant SIT - Cellule Cyber Security</p>
                        </div>
                    </div>
                </div>

                <div class="testimonial-card scroll-animate">
                    <div class="testimonial-text">
                        Grâce au CSC, j'ai développé mes compétences en développement web et participé à des projets incroyables. Le mentorat entre étudiants est vraiment précieux. Je recommande vivement !
                    </div>
                    <div class="testimonial-author">
                        <div class="author-avatar">S</div>
                        <div class="author-info">
                            <h4>Salma Rahali</h4>
                            <p>Étudiante IRISI - Cellule Développement</p>
                        </div>
                    </div>
                </div>

                <div class="testimonial-card scroll-animate">
                    <div class="testimonial-text">
                        L'expertise en IA que j'ai acquise au CSC m'a ouvert des portes incroyables. Les conférences avec des experts du secteur sont inspirantes et les projets collaboratifs très enrichissants.
                    </div>
                    <div class="testimonial-author">
                        <div class="author-avatar">Y</div>
                        <div class="author-info">
                            <h4>Youssef Idrissi</h4>
                            <p>Master IAII - Cellule IA</p>
                        </div>
                    </div>
                </div>

                <div class="testimonial-card scroll-animate">
                    <div class="testimonial-text">
                        Le CSC m'a donné confiance en mes capacités. En tant que débutante, j'ai été accueillie chaleureusement et j'ai rapidement progressé grâce aux formations adaptées à mon niveau.
                    </div>
                    <div class="testimonial-author">
                        <div class="author-avatar">L</div>
                        <div class="author-info">
                            <h4>Leila Amrani</h4>
                            <p>Étudiante première année - Nouvelle membre</p>
                        </div>
                    </div>
                </div>

                <div class="testimonial-card scroll-animate">
                    <div class="testimonial-text">
                        Être membre du bureau du CSC m'a appris le leadership et la gestion d'équipe. C'est une expérience formatrice qui complète parfaitement les études académiques.
                    </div>
                    <div class="testimonial-author">
                        <div class="author-avatar">K</div>
                        <div class="author-info">
                            <h4>Karim Fassi</h4>
                            <p>Responsable Communication - Bureau Central</p>
                        </div>
                    </div>
                </div>

                <div class="testimonial-card scroll-animate">
                    <div class="testimonial-text">
                        Les hackathons organisés par le CSC sont des expériences uniques. J'ai pu travailler avec des étudiants d'autres filières et découvrir de nouvelles approches technologiques.
                    </div>
                    <div class="testimonial-author">
                        <div class="author-avatar">N</div>
                        <div class="author-info">
                            <h4>Nadia Benjelloun</h4>
                            <p>Étudiante IRISI - Participante Hackathons</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Équipe -->
    <section id="equipe" class="section">
        <div class="container">
            <h2 class="section-title scroll-animate">Notre Équipe</h2>
            <div class="team-grid">
                @foreach($members as $member)
                    <div class="team-member scroll-animate">
                        <div class="member-photo">
                            @if($member->image)
                                <img src="{{ asset('storage/' . $member->image) }}" alt="{{ $member->name }}" style="width: 80px; height: 80px; border-radius: 50%;">
                            @else
                                👤
                            @endif
                        </div>
                        <div class="member-name">{{ $member->name }}</div>
                        <div class="member-role">{{ $member->role }}</div>
                        <div class="member-description">{{ $member->description }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <script>
        // Carousel functionality
        let currentSlideIndex = 0;
        const slides = document.querySelectorAll('.carousel-slide');
        const dots = document.querySelectorAll('.dot');
        const container = document.getElementById('carouselContainer');

        function showSlide(index) {
            currentSlideIndex = index;
            container.style.transform = `translateX(-${index * 100}%)`;
            
            dots.forEach((dot, i) => {
                dot.classList.toggle('active', i === index);
            });
        }

        function nextSlide() {
            currentSlideIndex = (currentSlideIndex + 1) % slides.length;
            showSlide(currentSlideIndex);
        }

        function prevSlide() {
            currentSlideIndex = (currentSlideIndex - 1 + slides.length) % slides.length;
            showSlide(currentSlideIndex);
        }

        function currentSlide(index) {
            showSlide(index - 1);
        }

        // Auto-slide
        setInterval(nextSlide, 5000);

        // FAQ functionality
        function toggleFaq(element) {
            const answer = element.nextElementSibling;
            const isActive = element.classList.contains('active');
            
            // Close all FAQ items
            document.querySelectorAll('.faq-question').forEach(q => {
                q.classList.remove('active');
                q.nextElementSibling.classList.remove('active');
            });
            
            // Toggle current item
            if (!isActive) {
                element.classList.add('active');
                answer.classList.add('active');
            }
        }

        // Scroll animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, observerOptions);

        // Observe all scroll-animate elements
        document.querySelectorAll('.scroll-animate').forEach(el => {
            observer.observe(el);
        });

        // Smooth scrolling for navigation
        document.querySelectorAll('.nav-links a').forEach(link => {
            link.addEventListener('click', (e) => {
                e.preventDefault();
                const targetId = link.getAttribute('href');
                const targetSection = document.querySelector(targetId);
                targetSection.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            });
        });

        // Add some interactivity to member tags
        document.querySelectorAll('.member-tag').forEach(tag => {
            tag.addEventListener('mouseenter', () => {
                tag.style.transform = 'scale(1.05)';
            });
            
            tag.addEventListener('mouseleave', () => {
                tag.style.transform = 'scale(1)';
            });
        });

        // Add hover effects to activity cards
        document.querySelectorAll('.activity-card').forEach(card => {
            card.addEventListener('mouseenter', () => {
                card.style.transform = 'translateY(-10px) scale(1.02)';
            });
            
            card.addEventListener('mouseleave', () => {
                card.style.transform = 'translateY(0) scale(1)';
            });
        });
    </script>
</body>
</html>

@endsection