
@extends('user.layouts.app')


@section('title', 'Contactez-nous')

@section('content')
<!-- CSS intégré directement dans la section content -->
<style>
    .contact-header {
        background-color: #f8f9fa;
        padding: 40px 0;
        text-align: center;
        margin-bottom: 0;
    }
    
    .contact-title {
        font-size: 2.5rem;
        font-weight: 600;
        margin-bottom: 15px;
    }
    
    .contact-subtitle {
        color: #6c757d;
        max-width: 700px;
        margin: 0 auto;
    }
    
    .contact-container {
        display: flex;
        flex-wrap: wrap;
        margin-top: 0;
    }
    
    .contact-info {
        flex: 0 0 30%;
        background-color: #212529;
        color: white;
        padding: 40px 30px;
    }
    
    .contact-form {
        flex: 0 0 70%;
        background-color: #fff;
        padding: 40px 50px;
    }
    
    .info-title {
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 25px;
        color: white;
    }
    
    .form-title {
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 25px;
    }
    
    .info-item {
        display: flex;
        margin-bottom: 20px;
    }
    
    .info-item i {
        color: #fd7e14;
        font-size: 1.2rem;
        margin-right: 15px;
        width: 20px;
        text-align: center;
    }
    
    .info-item p {
        margin: 0;
    }
    
    .social-links {
        margin-top: 30px;
    }
    
    .social-links h3 {
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 20px;
    }
    
    .social-icons {
        display: flex;
    }
    
    .social-icons a {
        color: white;
        font-size: 1.2rem;
        margin-right: 20px;
        text-decoration: none;
    }
    
    .chatbot-block {
        background-color: #fd7e14;
        padding: 25px;
        margin-top: 30px;
        border-radius: 5px;
    }
    
    .chatbot-title {
        font-size: 1.3rem;
        font-weight: 600;
        margin-bottom: 10px;
    }
    
    .form-group {
        margin-bottom: 20px;
    }
    
    .form-control {
        padding: 12px 15px;
        border: 1px solid #e1e1e1;
        border-radius: 5px;
    }
    
    textarea.form-control {
        min-height: 120px;
    }
    
    .form-label {
        margin-bottom: 8px;
        font-weight: 500;
    }
    
    .form-row {
        display: flex;
        gap: 20px;
        margin-bottom: 20px;
    }
    
    .form-row > div {
        flex: 1;
    }
    
    .btn-send {
        background-color: #fd7e14;
        color: white;
        border: none;
        padding: 12px 25px;
        font-weight: 500;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
    }
    
    .btn-send:hover {
        background-color: #e76b00;
    }
    
    .chat-float-btn {
        position: fixed;
        bottom: 30px;
        right: 30px;
        background-color: #fd7e14;
        color: white;
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 24px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        cursor: pointer;
        z-index: 1000;
    }
    
    .map-container {
        width: 100%;
        height: 300px;
        margin-top: 40px;
        border-radius: 5px;
        overflow: hidden;
    }
    
    .hours-container {
        margin-top: 25px;
    }
    
    .hours-title {
        font-size: 1.2rem;
        font-weight: 600;
        margin-bottom: 10px;
    }
    
    .hours-list {
        list-style: none;
        padding: 0;
    }
    
    .hours-list li {
        display: flex;
        justify-content: space-between;
        margin-bottom: 5px;
        font-size: 0.95rem;
    }
    
    .contact-tabs {
        display: flex;
        border-bottom: 1px solid #dee2e6;
        margin-bottom: 25px;
    }
    
    .contact-tab {
        padding: 10px 15px;
        cursor: pointer;
        border-bottom: 2px solid transparent;
        font-weight: 500;
    }
    
    .contact-tab.active {
        border-bottom: 2px solid #fd7e14;
        color: #fd7e14;
    }
    
    .tab-content {
        display: none;
    }
    
    .tab-content.active {
        display: block;
    }
    
    .faq-container {
        margin-top: 20px;
    }
    
    .faq-item {
        margin-bottom: 15px;
        border-bottom: 1px solid #e1e1e1;
        padding-bottom: 15px;
    }
    
    .faq-question {
        font-weight: 600;
        margin-bottom: 8px;
        cursor: pointer;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .faq-answer {
        display: none;
        padding: 10px 0;
        color: #6c757d;
    }
    
    .faq-answer.show {
        display: block;
    }
    
    .team-container {
        margin-top: 30px;
    }
    
    .team-member {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
    }
    
    .team-photo {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background-color: #e9ecef;
        margin-right: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }
    
    .team-photo i {
        font-size: 30px;
        color: #adb5bd;
    }
    
    .team-info h4 {
        margin: 0 0 5px 0;
        font-size: 1.1rem;
    }
    
    .team-info p {
        margin: 0;
        color: #6c757d;
        font-size: 0.9rem;
    }
    
    .privacy-note {
        margin-top: 25px;
        padding: 15px;
        background-color: #f8f9fa;
        border-radius: 5px;
        font-size: 0.9rem;
        color: #6c757d;
    }
    
    .cta-container {
        margin-top: 30px;
        padding: 20px;
        background-color: #f8f9fa;
        border-radius: 5px;
        text-align: center;
    }
    
    .cta-title {
        font-weight: 600;
        margin-bottom: 15px;
    }
    
    .newsletter-form {
        display: flex;
        max-width: 400px;
        margin: 0 auto;
    }
    
    .newsletter-form input {
        flex: 1;
        padding: 10px 15px;
        border: 1px solid #e1e1e1;
        border-radius: 5px 0 0 5px;
        border-right: none;
    }
    
    .newsletter-form button {
        background-color: #fd7e14;
        color: white;
        border: none;
        padding: 0 15px;
        border-radius: 0 5px 5px 0;
    }
    
    /* Responsive adjustments */
    @media (max-width: 992px) {
        .contact-info {
            flex: 0 0 100%;
        }
        
        .contact-form {
            flex: 0 0 100%;
        }
        
        .form-row {
            flex-direction: column;
            gap: 10px;
        }
        
        .newsletter-form {
            flex-direction: column;
        }
        
        .newsletter-form input {
            border-radius: 5px;
            border-right: 1px solid #e1e1e1;
            margin-bottom: 10px;
        }
        
        .newsletter-form button {
            border-radius: 5px;
        }
    }
</style>

<!-- Contact Header -->
<div class="contact-header">
    <div class="container">
        <h1 class="contact-title">Contactez-nous</h1>
        <p class="contact-subtitle">Des questions ? N'hésitez pas à nous contacter, nous vous répondrons dans les plus brefs délais.</p>
    </div>
</div>

<!-- Contact Content -->
<div class="contact-container">
    <!-- Left Column - Contact Info -->
    <div class="contact-info">
        <h2 class="info-title">Informations de contact</h2>
        
        <div class="info-item">
            <i class="fas fa-map-marker-alt"></i>
            <div>
                <p>Université Mohammed V, Faculté des Sciences</p>
                <p>Avenue Ibn Battouta, Rabat</p>
            </div>
        </div>
        
        <div class="info-item">
            <i class="fas fa-envelope"></i>
            <div>
                <p>contact@csc-university.ma</p>
            </div>
        </div>
        
        <div class="info-item">
            <i class="fas fa-phone-alt"></i>
            <div>
                <p>+212 5XX XX XX XX</p>
            </div>
        </div>
        
        <!-- Heures d'ouverture -->
        <div class="hours-container">
            <h3 class="hours-title">Heures d'ouverture</h3>
            <ul class="hours-list">
                <li><span>Lundi - Vendredi:</span> <span>9h00 - 17h00</span></li>
                <li><span>Samedi:</span> <span>9h00 - 12h00</span></li>
                <li><span>Dimanche:</span> <span>Fermé</span></li>
            </ul>
        </div>
        
        <div class="social-links">
            <h3>Suivez-nous</h3>
            <div class="social-icons">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-linkedin-in"></i></a>
                <a href="#"><i class="fab fa-github"></i></a>
            </div>
        </div>
       
        
        <!-- Google Maps Iframe -->
        <div class="map-container">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3307.149847272112!2d-6.869345284787112!3d34.01405762710283!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xda76c7863654683%3A0x9dd409bdb7c6b9e2!2sFacult%C3%A9%20des%20Sciences%2C%20Rabat!5e0!3m2!1sfr!2sma!4v1653042095754!5m2!1sfr!2sma" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
    </div>
    
    <!-- Right Column - Contact Form and More -->
    <div class="contact-form">
        <!-- Tabs for different contact options -->
        <div class="contact-tabs">
            <div class="contact-tab active" data-tab="form">Formulaire de contact</div>
            <div class="contact-tab" data-tab="faq">FAQ</div>
            <div class="contact-tab" data-tab="team">Notre équipe</div>
        </div>
        
        <!-- Contact Form Tab -->
        <div class="tab-content active" id="form-tab">
            <h2 class="form-title">Envoyez-nous un message</h2>
            
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <form method="POST" action="{{ route('contact.send') }}">
                @csrf
                <div class="form-row">
                    <div>
                        <label for="name" class="form-label">Nom complet</label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Votre nom" required>
                    </div>
                    <div>
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="email" class="form-control" placeholder="votre@email.com" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="subject" class="form-label">Sujet</label>
                    <input type="text" id="subject" name="subject" class="form-control" placeholder="Sujet de votre message">
                </div>
                
                <div class="form-group">
                    <label for="message" class="form-label">Message</label>
                    <textarea id="message" name="message" class="form-control" placeholder="Votre message..." required></textarea>
                </div>
                
                <div class="privacy-note">
                    <p>En soumettant ce formulaire, vous acceptez que les informations saisies soient utilisées pour vous recontacter. Pour connaître et exercer vos droits, consultez notre <a href="#">politique de confidentialité</a>.</p>
                </div>
                
                <button type="submit" class="btn-send">Envoyer le message</button>
            </form>
            
            <!-- Call-to-action secondaire: Newsletter -->
          
        </div>
        
        <!-- FAQ Tab -->
        <div class="tab-content" id="faq-tab">
            <h2 class="form-title">Questions fréquemment posées</h2>
            
            <div class="faq-container">
                <div class="faq-item">
                    <div class="faq-question">
                        <span>Comment puis-je m'inscrire à l'université ?</span>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Pour vous inscrire à l'université, vous devez vous rendre sur le portail des inscriptions en ligne et suivre les étapes indiquées. Vous devrez fournir vos informations personnelles, vos résultats scolaires et choisir votre filière d'études.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">
                        <span>Quels sont les horaires d'ouverture du secrétariat ?</span>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Le secrétariat est ouvert du lundi au vendredi de 9h00 à 17h00 et le samedi de 9h00 à 12h00. Il est fermé les dimanches et jours fériés.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">
                        <span>Comment puis-je obtenir un relevé de notes ?</span>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Pour obtenir un relevé de notes, vous pouvez faire une demande en ligne via votre espace étudiant ou vous présenter au secrétariat de votre département avec votre carte d'étudiant.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">
                        <span>Quelles sont les modalités de paiement des frais d'inscription ?</span>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Les frais d'inscription peuvent être réglés par virement bancaire, carte bancaire en ligne via notre plateforme sécurisée, ou en espèces à l'agence comptable de l'université.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">
                        <span>Comment puis-je contacter un professeur ?</span>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Vous pouvez contacter vos professeurs via leur adresse email universitaire ou pendant leurs heures de permanence. Les coordonnées des enseignants sont disponibles sur le site web de chaque département.</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Team Tab -->
        <div class="tab-content" id="team-tab">
            <h2 class="form-title">Notre équipe de contact</h2>
            
            <div class="team-container">
                <div class="team-member">
                    <div class="team-photo">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="team-info">
                        <h4>Mohammed Alaoui</h4>
                        <p>Responsable des admissions</p>
                        <p>m.alaoui@csc-university.ma</p>
                    </div>
                </div>
                
                <div class="team-member">
                    <div class="team-photo">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="team-info">
                        <h4>Fatima Bensouda</h4>
                        <p>Secrétaire générale</p>
                        <p>f.bensouda@csc-university.ma</p>
                    </div>
                </div>
                
                <div class="team-member">
                    <div class="team-photo">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="team-info">
                        <h4>Youssef Lahlou</h4>
                        <p>Support technique</p>
                        <p>y.lahlou@csc-university.ma</p>
                    </div>
                </div>
                
                <div class="team-member">
                    <div class="team-photo">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="team-info">
                        <h4>Nawal Chraibi</h4>
                        <p>Relations internationales</p>
                        <p>n.chraibi@csc-university.ma</p>
                    </div>
                </div>
            </div>
            
            <div class="privacy-note">
                <p>Notre équipe s'engage à vous répondre dans un délai de 48 heures ouvrables. Pour les demandes urgentes, nous vous recommandons de nous contacter par téléphone.</p>
            </div>
        </div>
    </div>
</div>

<!-- Floating Chat Button -->
<div class="chat-float-btn" id="chatBtn">
    <i class="fas fa-comments"></i>
</div>

<!-- Chat Modal -->
<div class="modal fade" id="chatModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title">Chatbot CSC</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <textarea class="form-control mb-3" rows="3" placeholder="Votre message..."></textarea>
                <button type="button" class="btn-send w-100">Envoyer le message</button>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add Font Awesome if not already included
        if (!document.querySelector('link[href*="font-awesome"]')) {
            const fontAwesome = document.createElement('link');
            fontAwesome.rel = 'stylesheet';
            fontAwesome.href = 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css';
            document.head.appendChild(fontAwesome);
        }
        
        // Chat button functionality
        const chatBtn = document.getElementById('chatBtn');
        if (chatBtn) {
            chatBtn.addEventListener('click', function() {
                const chatModal = new bootstrap.Modal(document.getElementById('chatModal'));
                chatModal.show();
            });
        }
        
        // Tabs functionality
        const tabs = document.querySelectorAll('.contact-tab');
        tabs.forEach(tab => {
            tab.addEventListener('click', function() {
                // Remove active class from all tabs
                tabs.forEach(t => t.classList.remove('active'));
                // Add active class to current tab
                this.classList.add('active');
                
                // Hide all tab contents
                const tabContents = document.querySelectorAll('.tab-content');
                tabContents.forEach(content => content.classList.remove('active'));
                
                // Show current tab content
                const tabId = this.getAttribute('data-tab');
                document.getElementById(tabId + '-tab').classList.add('active');
            });
        });
        
        // FAQ accordion functionality
        const faqQuestions = document.querySelectorAll('.faq-question');
        faqQuestions.forEach(question => {
            question.addEventListener('click', function() {
                const answer = this.nextElementSibling;
                const icon = this.querySelector('i');
                
                if (answer.classList.contains('show')) {
                    answer.classList.remove('show');
                    icon.classList.remove('fa-chevron-up');
                    icon.classList.add('fa-chevron-down');
                } else {
                    answer.classList.add('show');
                    icon.classList.remove('fa-chevron-down');
                    icon.classList.add('fa-chevron-up');
                }
            });
        });
    });
</script>
@endsection