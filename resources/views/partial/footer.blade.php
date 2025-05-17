<!-- Footer -->
<footer class="bg-dark text-white">
    <div class="container py-5">
        <div class="row">
            <!-- Logo et description -->
            <div class="col-lg-3 mb-4 mb-lg-0">
                <div class="d-flex align-items-center mb-3">
                    <div class="me-2">
                        <span class="fs-1 fw-bold">[</span>
                        <span class="fs-1 fw-bold text-warning">X</span>
                        <span class="fs-1 fw-bold text-light" style="color: #f8f9d2 !important;">]</span>
                    </div>
                </div>
                <p>Computer Science Club est une association universitaire dédiée à la formation et à l'innovation technologique.</p>
                
                <!-- Réseaux sociaux -->
                <div class="mt-4">
                    <a href="#" class="text-white me-3"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="text-white me-3"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="text-white me-3"><i class="bi bi-linkedin"></i></a>
                    <a href="#" class="text-white"><i class="bi bi-github"></i></a>
                </div>
            </div>
            
            <!-- Liens rapides -->
            <div class="col-lg-3 mb-4 mb-lg-0">
                <h5 class="mb-4">Liens rapides</h5>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="#" class="text-white text-decoration-none hover-link">Accueil</a></li>
                    <li class="mb-2"><a href="#" class="text-white text-decoration-none hover-link">Formations</a></li>
                    <li class="mb-2"><a href="#" class="text-white text-decoration-none hover-link">Cellules</a></li>
                    <li class="mb-2"><a href="#" class="text-white text-decoration-none hover-link">Boutique</a></li>
                    <li class="mb-2"><a href="#" class="text-white text-decoration-none hover-link">Contact</a></li>
                </ul>
            </div>
            
            <!-- Ressources -->
            <div class="col-lg-3 mb-4 mb-lg-0">
                <h5 class="mb-4">Ressources</h5>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="#" class="text-white text-decoration-none hover-link">Blog</a></li>
                    <li class="mb-2"><a href="#" class="text-white text-decoration-none hover-link">Tutoriels</a></li>
                    <li class="mb-2"><a href="#" class="text-white text-decoration-none hover-link">Projets open source</a></li>
                    <li class="mb-2"><a href="#" class="text-white text-decoration-none hover-link">Vidéothèque</a></li>
                    <li class="mb-2"><a href="#" class="text-white text-decoration-none hover-link">FAQ</a></li>
                </ul>
            </div>
            
            <!-- Contact -->
            <div class="col-lg-3">
                <h5 class="mb-4">Contact</h5>
                <ul class="list-unstyled">
                    <li class="mb-3 d-flex align-items-start">
                        <i class="bi bi-geo-alt-fill text-warning me-2 mt-1"></i>
                        <span>Université Mohammed V, Rabat</span>
                    </li>
                    <li class="mb-3 d-flex align-items-start">
                        <i class="bi bi-envelope-fill text-warning me-2 mt-1"></i>
                        <span>contact@csc-university.ma</span>
                    </li>
                    <li class="mb-3 d-flex align-items-start">
                        <i class="bi bi-telephone-fill text-warning me-2 mt-1"></i>
                        <span>+212 5XX XX XX XX</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    
    <!-- Copyright -->
    <div class="border-top border-secondary">
        <div class="container py-3">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <div>
                    <p class="mb-0">© 2025 Computer Science Club. Tous droits réservés.</p>
                </div>
                <div>
                    <a id="back-to-top" href="#" class="btn btn-warning rounded-circle">
                        <i class="bi bi-arrow-up"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer>

<style>
    /* Styles pour le footer */
    footer {
        position: relative;
        z-index: 10;
    }
    
    .hover-link {
        transition: all 0.3s ease;
    }
    
    .hover-link:hover {
        color: #ffc107 !important;
        padding-left: 5px;
    }
    
    #back-to-top {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }
    
    #back-to-top:hover {
        transform: translateY(-5px);
    }
</style>

<!-- Script pour le bouton Back to Top -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const backToTopButton = document.getElementById('back-to-top');
        
        backToTopButton.addEventListener('click', function(e) {
            e.preventDefault();
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
        
        window.addEventListener('scroll', function() {
            if (window.scrollY > 300) {
                backToTopButton.style.opacity = '1';
            } else {
                backToTopButton.style.opacity = '0';
            }
        });
    });
</script>