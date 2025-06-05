
@extends('layouts.appdash')
@section('title', 'Dashboard Admin')

@section('content')
<style>
    .stats-card {
        background: white;
        border-radius: 15px;
        padding: 25px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        border: none;
        transition: all 0.3s ease;
        overflow: hidden;
        position: relative;
    }
    
    .stats-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
    }
    
    .stats-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(45deg, #ff6b35, #f7931e);
    }
    
    .stats-icon {
        width: 60px;
        height: 60px;
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.8rem;
        color: white;
        margin-bottom: 15px;
    }
    
    .stats-number {
        font-size: 2.2rem;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 5px;
    }
    
    .stats-label {
        color: #6c757d;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .stats-change {
        font-size: 0.8rem;
        padding: 4px 8px;
        border-radius: 20px;
        font-weight: 600;
    }
    
    .stats-change.positive {
        background-color: #d4edda;
        color: #155724;
    }
    
    .stats-change.negative {
        background-color: #f8d7da;
        color: #721c24;
    }
    
    .chart-card {
        background: white;
        border-radius: 15px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        overflow: hidden;
    }
    
    .chart-header {
        padding: 25px 25px 15px;
        border-bottom: 1px solid #eee;
        background: #f8f9fa;
    }
    
    .chart-body {
        padding: 25px;
    }
    
    .recent-activities {
        background: white;
        border-radius: 15px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        overflow: hidden;
    }
    
    .activity-item {
        padding: 15px 25px;
        border-bottom: 1px solid #f1f1f1;
        display: flex;
        align-items: center;
    }
    
    .activity-item:last-child {
        border-bottom: none;
    }
    
    .activity-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 15px;
        font-size: 1rem;
        color: white;
    }
    
    .page-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 30px;
        border-radius: 15px;
        margin-bottom: 30px;
    }
    
    .btn-custom {
        background: linear-gradient(45deg, #ff6b35, #f7931e);
        color: white;
        border: none;
        padding: 10px 25px;
        border-radius: 25px;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    
    .btn-custom:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(255, 107, 53, 0.4);
        color: white;
    }
    
    .btn-outline-custom {
        border: 2px solid #ff6b35;
        color: #ff6b35;
        background: transparent;
        padding: 8px 20px;
        border-radius: 25px;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    
    .btn-outline-custom:hover {
        background: #ff6b35;
        color: white;
    }
    
    .progress-custom {
        height: 8px;
        border-radius: 10px;
        background-color: #e9ecef;
        overflow: hidden;
    }
    
    .progress-bar-custom {
        background: linear-gradient(45deg, #ff6b35, #f7931e);
        border-radius: 10px;
        transition: width 0.6s ease;
    }
</style>

<!-- Page Header -->
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h2 class="mb-2">Tableau de Bord</h2>
            <p class="mb-0 opacity-75">Bienvenue dans votre espace d'administration</p>
        </div>
        <div>
            <button class="btn btn-light me-2">
                <i class="bi bi-download me-2"></i>Exporter
            </button>
            <button class="btn btn-custom">
                <i class="bi bi-plus-circle me-2"></i>Nouveau
            </button>
        </div>
    </div>
</div>

<!-- Statistics Cards -->
<div class="row g-4 mb-4">
    <div class="col-xl-3 col-md-6">
        <div class="stats-card">
            <div class="stats-icon" style="background: linear-gradient(45deg, #667eea, #764ba2);">
                <i class="bi bi-people"></i>
            </div>
            <div class="stats-number">1,294</div>
            <div class="stats-label">Visiteurs</div>
            <div class="d-flex justify-content-between align-items-center mt-3">
                <span class="stats-change positive">+12%</span>
                <small class="text-muted">ce mois</small>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6">
        <div class="stats-card">
            <div class="stats-icon" style="background: linear-gradient(45deg, #ff6b35, #f7931e);">
                <i class="bi bi-person-check"></i>
            </div>
            <div class="stats-number">1,303</div>
            <div class="stats-label">Abonnés</div>
            <div class="d-flex justify-content-between align-items-center mt-3">
                <span class="stats-change positive">+8%</span>
                <small class="text-muted">ce mois</small>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6">
        <div class="stats-card">
            <div class="stats-icon" style="background: linear-gradient(45deg, #56ab2f, #a8e6cf);">
                <i class="bi bi-cash-stack"></i>
            </div>
            <div class="stats-number">€1,345</div>
            <div class="stats-label">Ventes</div>
            <div class="d-flex justify-content-between align-items-center mt-3">
                <span class="stats-change positive">+15%</span>
                <small class="text-muted">ce mois</small>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6">
        <div class="stats-card">
            <div class="stats-icon" style="background: linear-gradient(45deg, #ff758c, #ff7eb3);">
                <i class="bi bi-bag-check"></i>
            </div>
            <div class="stats-number">576</div>
            <div class="stats-label">Commandes</div>
            <div class="d-flex justify-content-between align-items-center mt-3">
                <span class="stats-change negative">-3%</span>
                <small class="text-muted">ce mois</small>
            </div>
        </div>
    </div>
</div>

<!-- Charts Section -->
<div class="row g-4 mb-4">
    <div class="col-xl-8">
        <div class="chart-card">
            <div class="chart-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Statistiques des Utilisateurs</h5>
                    <div>
                        <button class="btn btn-outline-custom btn-sm me-2">
                            <i class="bi bi-download me-1"></i>Export
                        </button>
                        <button class="btn btn-outline-custom btn-sm">
                            <i class="bi bi-printer me-1"></i>Imprimer
                        </button>
                    </div>
                </div>
            </div>
            <div class="chart-body">
                <div style="height: 300px; background: linear-gradient(45deg, #f8f9fa, #e9ecef); border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                    <div class="text-center text-muted">
                        <i class="bi bi-bar-chart" style="font-size: 3rem; margin-bottom: 15px;"></i>
                        <p class="mb-0">Graphique des statistiques</p>
                        <small>Intégrer Chart.js ou ApexCharts ici</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-4">
        <div class="chart-card">
            <div class="chart-header" style="background: linear-gradient(45deg, #ff6b35, #f7931e); color: white;">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Ventes Quotidiennes</h5>
                    <div class="dropdown">
                        <button class="btn btn-light btn-sm dropdown-toggle" data-bs-toggle="dropdown">
                            Export
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">PDF</a></li>
                            <li><a class="dropdown-item" href="#">Excel</a></li>
                            <li><a class="dropdown-item" href="#">CSV</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="chart-body">
                <div class="mb-3">
                    <small class="text-muted">25 Mars - 02 Avril</small>
                    <h2 class="text-primary fw-bold">€4,578.58</h2>
                </div>
                <div style="height: 120px; background: #f8f9fa; border-radius: 8px; display: flex; align-items: center; justify-content: center; margin-bottom: 20px;">
                    <small class="text-muted">Mini graphique</small>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="mb-0">17</h4>
                        <small class="text-muted">Commandes</small>
                    </div>
                    <div class="text-success fw-bold">
                        <i class="bi bi-arrow-up"></i> +5%
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Activities -->
<div class="row g-4">
    <div class="col-xl-6">
        <div class="recent-activities">
            <div class="chart-header">
                <h5 class="mb-0">Activités Récentes</h5>
            </div>
            <div class="activity-item">
                <div class="activity-icon" style="background: linear-gradient(45deg, #667eea, #764ba2);">
                    <i class="bi bi-person-plus"></i>
                </div>
                <div class="flex-grow-1">
                    <div class="fw-semibold">Nouvel utilisateur inscrit</div>
                    <small class="text-muted">Marie Dubois s'est inscrite</small>
                </div>
                <small class="text-muted">Il y a 2h</small>
            </div>
            <div class="activity-item">
                <div class="activity-icon" style="background: linear-gradient(45deg, #ff6b35, #f7931e);">
                    <i class="bi bi-bag-plus"></i>
                </div>
                <div class="flex-grow-1">
                    <div class="fw-semibold">Nouvelle commande</div>
                    <small class="text-muted">Commande #1234 - €145.50</small>
                </div>
                <small class="text-muted">Il y a 4h</small>
            </div>
            <div class="activity-item">
                <div class="activity-icon" style="background: linear-gradient(45deg, #56ab2f, #a8e6cf);">
                    <i class="bi bi-check-circle"></i>
                </div>
                <div class="flex-grow-1">
                    <div class="fw-semibold">Formation terminée</div>
                    <small class="text-muted">Formation "Laravel Avancé" complétée</small>
                </div>
                <small class="text-muted">Il y a 6h</small>
            </div>
            <div class="activity-item">
                <div class="activity-icon" style="background: linear-gradient(45deg, #ff758c, #ff7eb3);">
                    <i class="bi bi-envelope"></i>
                </div>
                <div class="flex-grow-1">
                    <div class="fw-semibold">Newsletter envoyée</div>
                    <small class="text-muted">1,250 destinataires</small>
                </div>
                <small class="text-muted">Il y a 1j</small>
            </div>
        </div>
    </div>
    
    <div class="col-xl-6">
        <div class="recent-activities">
            <div class="chart-header">
                <h5 class="mb-0">Progression des Objectifs</h5>
            </div>
            <div class="activity-item">
                <div class="flex-grow-1">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="fw-semibold">Ventes Mensuelles</span>
                        <span class="text-muted">75%</span>
                    </div>
                    <div class="progress-custom">
                        <div class="progress-bar-custom" style="width: 75%"></div>
                    </div>
                    <small class="text-muted mt-1">€7,500 / €10,000</small>
                </div>
            </div>
            <div class="activity-item">
                <div class="flex-grow-1">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="fw-semibold">Nouveaux Clients</span>
                        <span class="text-muted">60%</span>
                    </div>
                    <div class="progress-custom">
                        <div class="progress-bar-custom" style="width: 60%; background: linear-gradient(45deg, #667eea, #764ba2);"></div>
                    </div>
                    <small class="text-muted mt-1">120 / 200</small>
                </div>
            </div>
            <div class="activity-item">
                <div class="flex-grow-1">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="fw-semibold">Formations Complétées</span>
                        <span class="text-muted">85%</span>
                    </div>
                    <div class="progress-custom">
                        <div class="progress-bar-custom" style="width: 85%; background: linear-gradient(45deg, #56ab2f, #a8e6cf);"></div>
                    </div>
                    <small class="text-muted mt-1">42 / 50</small>
                </div>
            </div>
            <div class="activity-item">
                <div class="flex-grow-1">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="fw-semibold">Satisfaction Client</span>
                        <span class="text-muted">92%</span>
                    </div>
                    <div class="progress-custom">
                        <div class="progress-bar-custom" style="width: 92%; background: linear-gradient(45deg, #ff758c, #ff7eb3);"></div>
                    </div>
                    <small class="text-muted mt-1">4.6 / 5.0 étoiles</small>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="row g-4 mt-4">
    <div class="col-12">
        <div class="chart-card">
            <div class="chart-header">
                <h5 class="mb-0">Actions Rapides</h5>
            </div>
            <div class="chart-body">
                <div class="row g-3">
                    <div class="col-md-3">
                        <div class="d-grid">
                            <button class="btn btn-custom">
                                <i class="bi bi-plus-circle me-2"></i>
                                Ajouter Formation
                            </button>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="d-grid">
                            <button class="btn btn-outline-custom">
                                <i class="bi bi-people me-2"></i>
                                Gérer Utilisateurs
                            </button>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="d-grid">
                            <button class="btn btn-outline-custom">
                                <i class="bi bi-envelope me-2"></i>
                                Envoyer Newsletter
                            </button>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="d-grid">
                            <button class="btn btn-outline-custom">
                                <i class="bi bi-gear me-2"></i>
                                Paramètres
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Animation pour les cartes de statistiques
    const statsCards = document.querySelectorAll('.stats-card');
    statsCards.forEach((card, index) => {
        setTimeout(() => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            card.style.transition = 'all 0.5s ease';
            
            setTimeout(() => {
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, 100);
        }, index * 100);
    });

    // Animation pour les barres de progression
    const progressBars = document.querySelectorAll('.progress-bar-custom');
    setTimeout(() => {
        progressBars.forEach(bar => {
            const width = bar.style.width;
            bar.style.width = '0%';
            setTimeout(() => {
                bar.style.width = width;
            }, 500);
        });
    }, 1000);
});
</script>

@endsection