@extends(auth()->user()?->role === 'admin' ? 'layouts.appdash' : 'user.layouts.app')

@section('title', $formation->title . ' - CSC Formations')

@section('content')
<div class="container-fluid">
    <!-- Navigation Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('formations.index') }}" class="text-orange text-decoration-none">
                    <i class="fas fa-graduation-cap me-1"></i>Formations
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">{{ $formation->title }}</li>
        </ol>
    </nav>

    <!-- Header Section with Hero Image -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-lg border-0 overflow-hidden">
                <div class="position-relative">
                   @php
    $categoryImages = [
        'CyberSecurity' => 'cyber.jpg',
        'AI'            => 'ai.webp',
        'Dev'           => 'dev.jpg',
    ];

    $image = $categoryImages[$formation->category] ?? null;
@endphp

@if($image)
    <img src="{{ asset('storage/formations/' . $image) }}" 
    class="card-img-top hero-image" alt="{{ $formation->title }}">
    <div class="hero-overlay"></div>
    @else
    <div class="card-img-top bg-gradient-orange d-flex align-items-center justify-content-center" 
         style="height: 200px;">
        <i class="fas fa-graduation-cap fa-3x text-white opacity-50"></i>
    </div>
@endif
                    
                    <!-- Status and Category Badges -->
                    <div class="position-absolute top-0 end-0 m-3">
                        @if($formation->date < now())
                            <span class="badge bg-secondary fs-6 me-2">Terminée</span>
                        {{-- @elseif($formation->date->isToday())
                            <span class="badge bg-warning text-dark fs-6 me-2">Aujourd'hui</span>
                        @elseif($formation->date->isTomorrow())
                            <span class="badge bg-info fs-6 me-2">Demain</span> --}}
                        @else
                            <span class="badge bg-success fs-6 me-2">À venir</span>
                        @endif
                        <span class="badge bg-orange text-white fs-6">{{ $formation->category }}</span>
                    </div>
                    
                    <!-- Title Overlay -->
                    <div class="position-absolute bottom-0 start-0 p-4 text-white">
                        <h1 class="display-5 fw-bold mb-2 text-shadow">{{ $formation->title }}</h1>
                        <div class="d-flex flex-wrap gap-3">
                            <span class="badge bg-dark bg-opacity-75 fs-6">
                                <i class="fas fa-calendar me-1"></i>
                                {{ \Carbon\Carbon::parse($formation->date)->format('d/m/Y') }}
                            </span>
                            @if($formation->instructor)
                            <span class="badge bg-dark bg-opacity-75 fs-6">
                                <i class="fas fa-user me-1"></i>
                                {{ $formation->instructor }}
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="row">
        <!-- Left Column - Formation Details -->
        <div class="col-lg-8">
            <!-- Description Section -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-light">
                    <h4 class="mb-0 text-orange">
                        <i class="fas fa-info-circle me-2"></i>Description
                    </h4>
                </div>
                <div class="card-body">
                    <p class="lead text-muted">{{ $formation->description }}</p>
                </div>
            </div>

            <!-- Content Section -->
            
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-light">
                    <h4 class="mb-0 text-orange">
                        <i class="fas fa-book me-2"></i>Prérequis
                    </h4>
                </div>
                
                <div class="card-body">
                    @if($formation->contenu)
                    <p class="lead text-muted">{{ $formation->contenu }}</p>
                    
                    @else
                    <p class="lead text-muted">Non specifiée</p>
                    @endif
                </div>
                
            </div>
            

            <!-- Resources Section -->
            @if($formation->support_course)
<div class="card shadow-sm mb-4">
    <div class="card-header bg-light">
        <h4 class="mb-0 text-orange">
            <i class="fas fa-download me-2"></i>Ressources
        </h4>
    </div>
    <div class="card-body">
        <div class="row g-3">
            <div class="col-md-6">
                <div class="resource-card p-3 border rounded">
                    <i class="fas fa-file-pdf fa-2x text-danger mb-2"></i>
                    <h6>Support de cours</h6>
                    <a href="{{ asset('storage/' . $formation->support_course) }}" target="_blank" 
                       class="btn btn-outline-danger btn-sm">
                        <i class="fas fa-download me-1"></i>Télécharger
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endif



            <!-- Admin Actions -->
            @if (auth()->check() && auth()->user()->role == 'admin')
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-light">
                    <h4 class="mb-0 text-orange">
                        <i class="fas fa-cogs me-2"></i>Actions administrateur
                    </h4>
                </div>
                <div class="card-body">
                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ route('formations.edit', $formation->id) }}" 
                           class="btn btn-warning">
                            <i class="fas fa-edit me-1"></i>Modifier
                        </a>
                        <button type="button" class="btn btn-danger" 
                                onclick="deleteFormation({{ $formation->id }}, '{{ $formation->title }}')">
                            <i class="fas fa-trash me-1"></i>Supprimer
                        </button>
                    </div>
                </div>
            </div>
            @endif
        </div>

        <!-- Right Column - Sidebar -->
        <div class="col-lg-4">
            <!-- Quick Info Card -->
            <div class="card shadow-sm mb-4 sticky-top" style="top: 20px;">
                <div class="card-header bg-orange text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-info me-2"></i>Informations
                    </h5>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled mb-0">
                        <li class="mb-3">
                            <strong class="text-muted">
                                <i class="fas fa-tag me-2"></i>Catégorie
                            </strong><br>
                            <span class="badge bg-orange text-white">{{ $formation->category }}</span>
                        </li>
                        <li class="mb-3">
                            <strong class="text-muted">
                                <i class="fas fa-calendar me-2"></i>Date
                            </strong><br>
                            {{ \Carbon\Carbon::parse($formation->date)->format('d/m/Y') }}
                            <small class="text-muted d-block">
                                {{ \Carbon\Carbon::parse($formation->date)->format('l') }}
                            </small>
                        </li>
                        @if($formation->duration)
                        <li class="mb-3">
                            <strong class="text-muted">
                                <i class="fas fa-clock me-2"></i>Durée
                            </strong><br>
                            {{ $formation->duration }}
                        </li>
                        @endif
                        @if($formation->instructor || $formation->formateur_email)
                        <li class="mb-3">
                            <strong class="text-muted">
                                <i class="fas fa-user me-2"></i>Formateur
                            </strong><br>
                            {{ $formation->instructor ?? $formation->formateur_email }}
                        </li>
                        @endif
                        
                        @if (auth()->check() && auth()->user()->role == 'admin')

                        <li>
                            <strong class="text-muted">
                                <i class="fas fa-users me-2"></i>Inscrits
                            </strong><br>
                            {{ $formation->inscriptions->count() }} participant(s)
                        </li>
                        @endif
                    </ul>
                </div>
            </div>

            <!-- Registration Section for Non-Admin Users -->
            @if (auth()->check() && auth()->user()->role !== 'admin')
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-user-plus me-2"></i>Inscription
                        </h5>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">
                                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                            </div>
                        @endif
                        @if(session('error'))
                            <div class="alert alert-danger">
                                <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                            </div>
                        @endif

                        @php
                            $userInscrit = $formation->inscriptions->contains('user_id', auth()->id());
                            $inscription = $formation->inscriptions->firstWhere('user_id', auth()->id());
                        @endphp

                        @if ($isPassed)
                            <div class="alert alert-warning">
                                <i class="fas fa-clock me-2"></i>Cette formation est déjà passée.
                            </div>

                            @if ($userInscrit && $inscription && $inscription->presence)
                                <div class="text-center">
                                    <a href="{{ route('attestation.show', $inscription->id) }}" 
                                       class="btn btn-outline-success">
                                        <i class="fas fa-certificate me-1"></i>Télécharger l'attestation
                                    </a>
                                </div>
                            @endif
                        @else
                            @if (!$userInscrit)
                                <form action="{{ route('inscriptions.quick', $formation->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-success w-100">
                                        <i class="fas fa-user-plus me-1"></i>S'inscrire à cette formation
                                    </button>
                                </form>
                            @else
                                <div class="alert alert-info mb-0">
                                    <i class="fas fa-check me-2"></i>Vous êtes déjà inscrit à cette formation.
                                </div>
                            @endif
                        @endif
                    </div>
                </div>
            @endif

            <!-- Participants List for Admin -->
            @if (auth()->check() && auth()->user()->role == 'admin')
                <div class="card shadow-sm">
                    <div class="card-header bg-info text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-users me-2"></i>Liste des participants
                        </h5>
                    </div>
                    <div class="card-body">
                        @if ($formation->inscriptions->count())
                            <form action="{{ route('formations.presence', $formation->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    @foreach ($formation->inscriptions as $inscription)
                                        <div class="form-check mb-2 p-2 rounded border">
                                            <input type="checkbox" name="presence[{{ $inscription->id }}]" 
                                                   class="form-check-input" id="presence-{{ $inscription->id }}"
                                                   {{ $inscription->presence ? 'checked' : '' }}>
                                            <label class="form-check-label w-100" for="presence-{{ $inscription->id }}">
                                                <div>
                                                    <strong>{{ $inscription->user->name ?? $inscription->nom }}</strong>
                                                    <br>
                                                    <small class="text-muted">
                                                        {{ $inscription->user->email ?? $inscription->email }}
                                                    </small>
                                                </div>
                                            </label>
                                        </div>
                                    @endforeach
                                </div>

                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="fas fa-save me-1"></i>Enregistrer les présences
                                </button>
                            </form>
                        @else
                            <div class="text-center text-muted">
                                <i class="fas fa-users fa-2x mb-2"></i>
                                <p class="mb-0">Aucun participant inscrit</p>
                            </div>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-exclamation-triangle text-warning me-2"></i>
                    Confirmer la suppression
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Êtes-vous sûr de vouloir supprimer la formation <strong id="formation-title"></strong> ?</p>
                <p class="text-danger">
                    <small><i class="fas fa-exclamation-triangle"></i> Cette action est irréversible et supprimera également toutes les inscriptions.</small>
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i>Annuler
                </button>
                <form id="delete-form" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash me-1"></i>Supprimer définitivement
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    :root {
        --orange-color: #ff8c00;
    }

    .text-orange {
        color: var(--orange-color) !important;
    }

    .bg-orange {
        background-color: var(--orange-color) !important;
    }

    .btn-orange {
        background-color: var(--orange-color);
        border-color: var(--orange-color);
        color: white;
    }

    .btn-orange:hover {
        background-color: #e07e00;
        border-color: #e07e00;
        color: white;
    }

    .hero-image {
        height: 300px;
        object-fit: cover;
        width: 100%;
    }

    .hero-placeholder {
        height: 300px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, var(--orange-color), #e07e00);
    }

    .hero-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(to top, rgba(0,0,0,0.7), rgba(0,0,0,0.1));
    }

    .text-shadow {
        text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
    }

    .bg-gradient-orange {
        background: linear-gradient(135deg, var(--orange-color), #e07e00);
    }

    .resource-card {
        text-align: center;
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .resource-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }

    .formation-content {
        line-height: 1.6;
        color: #666;
    }

    .breadcrumb {
        background: none;
        padding: 0;
    }

    .breadcrumb-item + .breadcrumb-item::before {
        content: ">";
        color: #6c757d;
    }

    .card {
        border: none;
    }

    .badge {
        font-size: 0.8em;
    }

    @media (max-width: 768px) {
        .hero-image, .hero-placeholder {
            height: 200px;
        }
        
        .display-5 {
            font-size: 1.5rem;
        }
        
        .sticky-top {
            position: relative !important;
        }
    }
</style>
@endsection

@section('scripts')
<script>
    // Delete formation function
    function deleteFormation(formationId, formationTitle) {
        document.getElementById('formation-title').textContent = formationTitle;
        document.getElementById('delete-form').action = `/formations/${formationId}`;
        new bootstrap.Modal(document.getElementById('deleteModal')).show();
    }

    // Auto-dismiss alerts
    setTimeout(function() {
        const alerts = document.querySelectorAll '.alert');
        alerts.forEach(alert => {
            if (alert.classList.contains('show')) {
                bootstrap.Alert.getOrCreateInstance(alert).close();
            }
        });
    }, 5000);

    // Smooth scroll for internal links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
</script>
@endsection