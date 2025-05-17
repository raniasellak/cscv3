<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSC - Computer Science Club</title>
    <style>
        :root {
            --color-black: #1a1a1a;
            --color-orange: #ff7b00;
            --color-beige: #f5f0e6;
            --color-dark-orange: #cc6200;
            --color-light-beige: #faf7f1;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: var(--color-light-beige);
            color: var(--color-black);
        }
        
       
        
        .hero {
            background: linear-gradient(rgba(26, 26, 26, 0.8), rgba(26, 26, 26, 0.8)), url('/api/placeholder/1200/800') center/cover;
            color: var(--color-beige);
            padding: 5rem 2rem;
            text-align: center;
        }
        
        .hero h1 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }
        
        .hero p {
            font-size: 1.2rem;
            max-width: 800px;
            margin: 0 auto;
        }
        
        .about {
            padding: 4rem 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .about h2 {
            text-align: center;
            font-size: 2rem;
            margin-bottom: 3rem;
            position: relative;
        }
        
        .about h2::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background-color: var(--color-orange);
        }
        
        .cells {
            margin-top: 3rem;
        }
        
        .cell {
            margin-bottom: 3rem;
            background-color: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }
        
        .cell:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }
        
        .cell-header {
            background-color: var(--color-black);
            color: var(--color-beige);
            padding: 1.5rem;
            position: relative;
        }
        
        .cell-header h3 {
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
        }
        
        .cell-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 5px;
            height: 100%;
            background-color: var(--color-orange);
        }
        
        .cell-content {
            padding: 1.5rem;
        }
        
        .cell-description {
            margin-bottom: 1.5rem;
        }
        
        .team {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 1.5rem;
        }
        
        .team-member {
            background-color: var(--color-light-beige);
            padding: 1rem;
            border-radius: 8px;
            text-align: center;
        }
        
        .team-member h4 {
            color: var(--color-orange);
            margin-bottom: 0.5rem;
        }
        
        .team-member p {
            font-size: 0.9rem;
            color: var(--color-black);
        }
        
        .main-team {
            margin-top: 3rem;
            text-align: center;
        }
        
        .main-team h3 {
            font-size: 1.8rem;
            margin-bottom: 2rem;
            position: relative;
            display: inline-block;
        }
        
        .main-team h3::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 100%;
            height: 3px;
            background-color: var(--color-orange);
        }
        
        .main-team-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 2rem;
            max-width: 1000px;
            margin: 0 auto;
        }
        
        .main-team-member {
            background-color: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .member-photo {
            height: 180px;
            background-color: var(--color-black);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--color-beige);
            font-size: 4rem;
        }
        
        .member-info {
            padding: 1.5rem;
        }
        
        .member-info h4 {
            color: var(--color-black);
            font-size: 1.2rem;
            margin-bottom: 0.5rem;
        }
        
        .member-info p {
            color: var(--color-orange);
            font-weight: bold;
            margin-bottom: 1rem;
        }
        
        .member-info .description {
            color: var(--color-black);
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
   
    
   
    
    <section class="about">
        <h2>À Propos de Nous</h2>
        <p>Le Computer Science Club (CSC) est une communauté dynamique d'étudiants passionnés par l'informatique et les technologies numériques. Notre mission est de favoriser l'apprentissage, l'innovation et la collaboration dans le domaine de l'informatique à travers nos trois cellules spécialisées.</p>
        
        <div class="cells">
            <div class="cell">
                <div class="cell-header">
                    <h3>Cellule Développement</h3>
                </div>
                <div class="cell-content">
                    <div class="cell-description">
                        <p>Notre cellule de développement se concentre sur la création d'applications web et mobiles, l'apprentissage des langages de programmation et la mise en œuvre de projets pratiques pour renforcer les compétences techniques.</p>
                    </div>
                    <div class="team">
                        <div class="team-member">
                            <h4>Chef de Cellule</h4>
                            <p>Responsable de la direction et de la vision de la cellule développement</p>
                        </div>
                        <div class="team-member">
                            <h4>Secrétaire Général</h4>
                            <p>Gestion des documents et communications internes</p>
                        </div>
                        <div class="team-member">
                            <h4>Trésorier</h4>
                            <p>Responsable des finances de la cellule</p>
                        </div>
                        <div class="team-member">
                            <h4>Chef de Communication</h4>
                            <p>Gère la communication externe de la cellule</p>
                        </div>
                        <div class="team-member">
                            <h4>Chef de Formation</h4>
                            <p>Coordonne les activités de formation et tutoriels</p>
                        </div>
                        <div class="team-member">
                            <h4>Chef de Design</h4>
                            <p>Responsable de l'aspect visuel des projets</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="cell">
                <div class="cell-header">
                    <h3>Cellule Cybersécurité</h3>
                </div>
                <div class="cell-content">
                    <div class="cell-description">
                        <p>La cellule cybersécurité explore les méthodes de protection des systèmes informatiques, l'analyse des vulnérabilités, la cryptographie et organise des ateliers pratiques sur la sécurité informatique.</p>
                    </div>
                    <div class="team">
                        <div class="team-member">
                            <h4>Chef de Cellule</h4>
                            <p>Responsable de la direction et de la vision de la cellule cybersécurité</p>
                        </div>
                        <div class="team-member">
                            <h4>Secrétaire Général</h4>
                            <p>Gestion des documents et communications internes</p>
                        </div>
                        <div class="team-member">
                            <h4>Trésorier</h4>
                            <p>Responsable des finances de la cellule</p>
                        </div>
                        <div class="team-member">
                            <h4>Chef de Communication</h4>
                            <p>Gère la communication externe de la cellule</p>
                        </div>
                        <div class="team-member">
                            <h4>Chef de Formation</h4>
                            <p>Coordonne les activités de formation et tutoriels</p>
                        </div>
                        <div class="team-member">
                            <h4>Chef de Design</h4>
                            <p>Responsable de l'aspect visuel des projets</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="cell">
                <div class="cell-header">
                    <h3>Cellule Intelligence Artificielle</h3>
                </div>
                <div class="cell-content">
                    <div class="cell-description">
                        <p>Notre cellule IA se concentre sur l'apprentissage automatique, les réseaux de neurones, le traitement du langage naturel et le développement d'applications basées sur l'intelligence artificielle.</p>
                    </div>
                    <div class="team">
                        <div class="team-member">
                            <h4>Chef de Cellule</h4>
                            <p>Responsable de la direction et de la vision de la cellule IA</p>
                        </div>
                        <div class="team-member">
                            <h4>Secrétaire Général</h4>
                            <p>Gestion des documents et communications internes</p>
                        </div>
                        <div class="team-member">
                            <h4>Trésorier</h4>
                            <p>Responsable des finances de la cellule</p>
                        </div>
                        <div class="team-member">
                            <h4>Chef de Communication</h4>
                            <p>Gère la communication externe de la cellule</p>
                        </div>
                        <div class="team-member">
                            <h4>Chef de Formation</h4>
                            <p>Coordonne les activités de formation et tutoriels</p>
                        </div>
                        <div class="team-member">
                            <h4>Chef de Design</h4>
                            <p>Responsable de l'aspect visuel des projets</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="main-team">
            <h3>Bureau Principal</h3>
            <div class="main-team-grid">
                <div class="main-team-member">
                    <div class="member-photo">👤</div>
                    <div class="member-info">
                        <h4>Nom du Président</h4>
                        <p>Président</p>
                        <div class="description">Responsable de la vision globale et de la coordination entre les cellules.</div>
                    </div>
                </div>
                
                <div class="main-team-member">
                    <div class="member-photo">👤</div>
                    <div class="member-info">
                        <h4>Nom du Vice-Président</h4>
                        <p>Vice-Président</p>
                        <div class="description">Assiste le président et supervise les projets transversaux.</div>
                    </div>
                </div>
                
                <div class="main-team-member">
                    <div class="member-photo">👤</div>
                    <div class="member-info">
                        <h4>Nom du Secrétaire</h4>
                        <p>Secrétaire Général</p>
                        <div class="description">Gère l'administration et les documents officiels du club.</div>
                    </div>
                </div>
                
                <div class="main-team-member">
                    <div class="member-photo">👤</div>
                    <div class="member-info">
                        <h4>Nom du Trésorier</h4>
                        <p>Trésorier</p>
                        <div class="description">Responsable des finances et du budget du club.</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>