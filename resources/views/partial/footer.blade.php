<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Footer CSC</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome pour les icônes -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <style>
        :root {
            --orange-color: #FF6B00;
            --black-color: #000000;
            --dark-gray: #2c2c2c;
            --beige-color: #F5F5DC;
            --light-gray: #f8f9fa;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Demo content */
        .demo-content {
            flex: 1;
            padding: 50px 0;
            text-align: center;
            background-color: #f8f9fa;
            min-height: 400px;
        }

        /* Newsletter Section */
        .newsletter-section {
            background: linear-gradient(135deg, var(--beige-color) 0%, #f0f0f0 100%);
            padding: 50px 0;
            border-top: 3px solid var(--orange-color);
        }

        .newsletter-title {
            color: var(--dark-gray);
            font-weight: 700;
            font-size: 2rem;
            margin-bottom: 15px;
        }

        .newsletter-subtitle {
            color: #666;
            font-size: 1.1rem;
            margin-bottom: 30px;
        }

        .newsletter-form {
            max-width: 500px;
            margin: 0 auto;
        }

        .newsletter-input {
            border: 2px solid #ddd;
            border-radius: 25px;
            padding: 12px 20px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .newsletter-input:focus {
            border-color: var(--orange-color);
            box-shadow: 0 0 0 0.2rem rgba(255, 107, 0, 0.25);
        }

        .newsletter-btn {
            background-color: var(--orange-color);
            border: none;
            border-radius: 25px;
            padding: 12px 30px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .newsletter-btn:hover {
            background-color: #ff8c33;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 107, 0, 0.3);
        }

        /* Footer styling */
        footer {
            background: linear-gradient(135deg, var(--dark-gray) 0%, #3a3a3a 100%);
            color: white;
            padding: 60px 0 20px;
            margin-top: auto;
        }

        .footer-main {
            padding-bottom: 40px;
            border-bottom: 1px solid #333;
        }

        .footer-section h5 {
            color: var(--orange-color);
            font-weight: 700;
            margin-bottom: 20px;
            font-size: 1.2rem;
        }

        .footer-section ul {
            list-style: none;
            padding: 0;
        }

        .footer-section ul li {
            margin-bottom: 10px;
        }

        .footer-section ul li a {
            color: #ccc;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .footer-section ul li a:hover {
            color: var(--orange-color);
            padding-left: 5px;
        }

        .footer-logo {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 15px;
        }

        .footer-brand-c1 {
            color: var(--black-color);
        }

        .footer-brand-s {
            color: var(--orange-color);
        }

        .footer-brand-c2 {
            color: var(--beige-color);
        }

        .footer-description {
            color: #ccc;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .social-icons a {
            display: inline-block;
            width: 40px;
            height: 40px;
            background-color: #333;
            color: white;
            text-align: center;
            line-height: 40px;
            border-radius: 50%;
            margin-right: 10px;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .social-icons a:hover {
            background-color: var(--orange-color);
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(255, 107, 0, 0.3);
        }

        .contact-info {
            color: #ccc;
        }

        .contact-info i {
            color: var(--orange-color);
            width: 20px;
            margin-right: 10px;
        }

        .contact-info p {
            margin-bottom: 10px;
        }

        .footer-bottom {
            text-align: center;
            padding-top: 30px;
            color: #999;
        }

        .footer-bottom a {
            color: var(--orange-color);
            text-decoration: none;
        }

        .footer-bottom a:hover {
            text-decoration: underline;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .newsletter-title {
                font-size: 1.5rem;
            }
            
            .newsletter-form .row {
                gap: 15px;
            }
            
            .footer-section {
                margin-bottom: 30px;
            }
        }
    </style>
</head>
<body>
 

    <!-- Section Newsletter -->
    <section class="newsletter-section">
        <div class="container">
            <div class="text-center">
                <h2 class="newsletter-title">
                    <i class="fas fa-envelope-open-text text-warning me-2"></i>
                    Restez Informé
                </h2>
                <p class="newsletter-subtitle">
                    Inscrivez-vous à notre newsletter pour recevoir nos dernières actualités et offres exclusives
                </p>
                @if(session('newsletter_success'))
                    <div class="alert alert-success mt-3">{{ session('newsletter_success') }}</div>
                @endif
                @if(session('newsletter_error'))
                    <div class="alert alert-danger mt-3">{{ session('newsletter_error') }}</div>
                @endif
                <form class="newsletter-form" method="POST" action="{{ route('newsletter.subscribe') }}">
                    @csrf
                    <div class="row g-3 align-items-center justify-content-center">
                        <div class="col-md-7">
                            <input type="email" name="email" class="form-control newsletter-input" placeholder="Votre adresse email" required>
                        </div>
                        <div class="col-md-auto">
                            <button type="submit" class="btn btn-warning newsletter-btn">
                                <i class="fas fa-paper-plane me-2"></i>S'abonner
                            </button>
                        </div>
                    </div>
                    <small class="text-muted mt-2 d-block">
                        <i class="fas fa-lock me-1"></i>
                        Nous respectons votre vie privée. Pas de spam, désinscription facile.
                    </small>
                </form>
            </div>
        </div>
    </section>

    <!-- Footer amélioré -->
    <footer>
        <div class="container">
            <div class="footer-main">
                <div class="row">
                    <!-- Colonne 1: À propos -->
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="footer-section">
                            <div class="footer-logo">
                                <span class="footer-brand-c1">C</span><span class="footer-brand-s">S</span><span class="footer-brand-c2">C</span>
                            </div>
                            <p class="footer-description">
                                Votre partenaire de confiance pour des formations de qualité. 
                                Nous vous accompagnons dans votre développement professionnel 
                                avec des programmes adaptés à vos besoins.
                            </p>
                            <div class="social-icons">   
                                <a href="#" title="Instagram"><i class="fab fa-instagram"></i></a>
                                <a href="https://www.linkedin.com/company/club-csc/posts/?feedView=all" title="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                            </div>
                        </div>
                    </div>

                    <!-- Colonne 2: Liens rapides -->
                    <div class="col-lg-2 col-md-6 mb-4">
                        <div class="footer-section">
                            <h5>Liens Rapides</h5>
                            <ul>
                                <li><a href="{{ route('user.index') }}">Accueil</a></li>
                                <li><a href="/formations">Formations</a></li>
                                <li><a href="{{ route('boutique.index') }}">Boutique</a></li>
                                <li><a href="#">À propos</a></li>
                                <li><a href="{{ route('contact.show') }}">Contact</a></li>
                            </ul>
                        </div>
                    </div>

                    <!-- Colonne 3: Services -->
                    <div class="col-lg-2 col-md-6 mb-4">
                        <div class="footer-section">
                            <h5>Nos Services</h5>
                            <ul>
                                <li><a href="#">Formation en ligne</a></li>
                                <li><a href="#">Certification</a></li>
                                <li><a href="#">Coaching</a></li>
                                <li><a href="#">Consultation</a></li>
                                <li><a href="#">Support 24/7</a></li>
                            </ul>
                        </div>
                    </div>

                    <!-- Colonne 4: Contact -->
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="footer-section">
                            <h5>Contactez-nous</h5>
                            <div class="contact-info">
                                <p><i class="fas fa-map-marker-alt"></i>123 Rue de la Formation, 75001 Paris</p>
                                <p><i class="fas fa-phone"></i>+33 1 23 45 67 89</p>
                                <p><i class="fas fa-envelope"></i>contact@monsite.fr</p>
                                <p><i class="fas fa-clock"></i>Lun - Ven: 9h00 - 18h00</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer Bottom -->
            <div class="footer-bottom">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <p class="mb-0">
                            &copy; {{ date('Y') }} <a href="#"><span class="footer-brand-c1">C</span><span class="footer-brand-s">S</span><span class="footer-brand-c2">C</span></a>. Tous droits réservés.
                        </p>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <a href="#" class="me-3">Politique de confidentialité</a>
                        <a href="#" class="me-3">Conditions d'utilisation</a>
                        <a href="#">Mentions légales</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    <script>
        // Animation d'apparition au scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        document.querySelectorAll('.footer-section').forEach(section => {
            section.style.opacity = '0';
            section.style.transform = 'translateY(20px)';
            section.style.transition = 'all 0.6s ease';
            observer.observe(section);
        });
    </script>
</body>
</html>