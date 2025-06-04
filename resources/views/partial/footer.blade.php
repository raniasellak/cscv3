<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome pour les icônes -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        :root {
            --orange-color: #FF6B00;
            --black-color: #000000;
        }

        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* Navbar styling */
        .navbar {
            background-color: var(--black-color);
            padding: 15px 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--orange-color) !important;
        }

        .nav-link {
            color: white !important;
            font-weight: 500;
            margin: 0 10px;
            position: relative;
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            color: var(--orange-color) !important;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 2px;
            background-color: var(--orange-color);
            transition: width 0.3s ease;
        }

        .nav-link:hover::after {
            width: 100%;
        }

        .navbar-toggler {
            border-color: var(--orange-color);
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba(255, 107, 0, 1)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }

        .logout-btn {
            background-color: var(--orange-color);
            color: white !important;
            border-radius: 20px;
            padding: 6px 15px !important;
            transition: all 0.3s ease;
        }

        .logout-btn:hover {
            background-color: #ff8c33;
            transform: translateY(-2px);
        }

        /* Contenu principal */
        .content {
            flex: 1;
            padding: 30px 0;
        }

        /* Footer styling */
        footer {
            background-color: var(--black-color);
            color: white;
            padding: 30px 0;
            margin-top: auto;
        }

        .footer-content {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
        }

        .footer-logo {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--orange-color);
            margin-bottom: 10px;
        }

        .social-icons a {
            color: white;
            margin-right: 15px;
            font-size: 1.2rem;
            transition: color 0.3s ease;
        }

        .social-icons a:hover {
            color: var(--orange-color);
        }

        .footer-copyright {
            border-top: 1px solid #333;
            margin-top: 20px;
            padding-top: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
    <!-- Footer amélioré -->
    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-info">
                    <div class="footer-logo">Mon Site</div>
                    <p>Votre partenaire pour des formations de qualité</p>
                </div>
                <div class="social-icons">
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-linkedin"></i></a>
                </div>
            </div>
            <div class="footer-copyright">
                <p>&copy; {{ date('Y') }} Mon Site Web. Tous droits réservés.</p>
            </div>
        </div>
    </footer>