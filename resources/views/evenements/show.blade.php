@extends(auth()->user()?->role === 'admin' ? 'layouts.appdash' : 'layouts.master')

@section('title', $evenement->titre . ' - CSC Événements')

@section('content')
<div class="container-fluid">
    <!-- Navigation Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('evenements.index') }}" class="text-orange text-decoration-none">
                    <i class="fas fa-calendar-alt me-1"></i>Événements
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">{{ $evenement->titre }}</li>
        </ol>
    </nav>

    <!-- Header Section with Hero Image -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-lg border-0 overflow-hidden">
                <div class="position-relative">
                    @if($evenement->image)
                        <img src="{{ asset('storage/' . $evenement->image) }}" 
                             class="card-img-top hero-image" alt="{{ $evenement->titre }}">
                        <div class="hero-overlay"></div>
                    @else
                        <div class="hero-placeholder bg-gradient-orange">
                            <i class="fas fa-calendar-alt fa-5x text-white opacity-50"></i>
                        </div>
                    @endif
                    
                    <!-- Status and Category Badges -->
                    <div class="position-absolute top-0 end-0 m-3">
                        @if($evenement->date < now())
                            <span class="badge bg-secondary fs-6 me-2">Terminé</span>
                        @elseif($evenement->date->isToday())
                            <span class="badge bg-warning text-dark fs-6 me-2">Aujourd'hui</span>
                        @elseif($evenement->date->isTomorrow())
                            <span class="badge bg-info fs-6 me-2">Demain</span>
                        @else
                            <span class="badge bg-success fs-6 me-2">À venir</span>
                        @endif
                        @if($evenement->category)
                            <span class="badge bg-orange text-white fs-6">{{ $evenement->category }}</span>
                        @endif
                    </div>
                    
                    <!-- Title Overlay -->
                    <div class="position-absolute bottom-0 start-0 p-4 text-white">
                        <h1 class="display-5 fw-bold mb-2 text-shadow">{{ $evenement->titre }}</h1>
                        <div class="d-flex flex-wrap gap-3">
                            <span class="badge bg-dark bg-opacity-75 fs-6">
                                <i class="fas fa-calendar me-1"></i>
                                {{ \Carbon\Carbon::parse($evenement->date)->format('d/m/Y') }}
                            </span>
                            @if($evenement->lieu)
                            <span class="badge bg-dark bg-opacity-75 fs-6">
                                <i class="fas fa-map-marker-alt me-1"></i>
                                {{ $evenement->lieu }}
                            </span>
                            @endif
                            @if($evenement->duration)
                            <span class="badge bg-dark bg-opacity-75 fs-6">
                                <i class="fas fa-clock me-1"></i>
                                {{ $evenement->duration }}
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
        <!-- Left Column - Event Details -->
        <div class="col-lg-8">
            <!-- Description Section -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-light">
                    <h4 class="mb-0 text-orange">
                        <i class="fas fa-info-circle me-2"></i>Thématique
                    </h4>
                </div>
                <div class="card-body">
                    <p class="lead text-muted">{{ $evenement->description ?? 'Aucune description disponible' }}</p>
                </div>
            </div>

            <!-- Long Description Section -->
            @if($evenement->long_description)
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-light">
                    <h4 class="mb-0 text-orange">
                        <i class="fas fa-file-text me-2"></i>Description détaillée
                    </h4>
                </div>
                <div class="card-body">
                    <div class="event-content">
                        {!! nl2br(e($evenement->long_description)) !!}
                    </div>
                </div>
            </div>
            @endif

            <!-- Agenda Section -->
            @if(!empty($agenda) && count($agenda) > 0)
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-light">
                    <h4 class="mb-0 text-orange">
                        <i class="fas fa-calendar-day me-2"></i>Programme
                    </h4>
                </div>
                <div class="card-body">
                    <div class="agenda-content">
                        @foreach($agenda as $day => $sessions)
                            <div class="agenda-day mb-4">
                                <h5 class="text-orange border-bottom pb-2 mb-3">
                                    <i class="fas fa-calendar-day me-2"></i>{{ $day }}
                                </h5>
                                <div class="row g-3">
                                    @forelse($sessions as $session)
                                        <div class="col-md-6">
                                            <div class="session-card p-3 border rounded">
                                                <div class="d-flex align-items-start">
                                                    <div class="session-time me-3">
                                                        <i class="fas fa-clock text-orange"></i>
                                                        <small class="text-muted d-block">{{ $session['time'] }}</small>
                                                    </div>
                                                    <div class="session-details flex-grow-1">
                                                        <h6 class="mb-1">{{ $session['title'] }}</h6>
                                                        @if(isset($session['description']))
                                                            <small class="text-muted">{{ $session['description'] }}</small>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="col-12">
                                            <div class="text-center text-muted">
                                                <i class="fas fa-calendar-times fa-2x mb-2"></i>
                                                <p class="mb-0">Aucune session prévue pour ce jour</p>
                                            </div>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @else
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-light">
                    <h4 class="mb-0 text-orange">
                        <i class="fas fa-calendar-day me-2"></i>Programme
                    </h4>
                </div>
                <div class="card-body">
                    <div class="text-center text-muted">
                        <i class="fas fa-calendar-times fa-3x mb-3"></i>
                        <p class="mb-0">Aucun programme disponible pour cet événement</p>
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
                        <a href="{{ route('evenements.edit', $evenement->id) }}" 
                           class="btn btn-warning">
                            <i class="fas fa-edit me-1"></i>Modifier
                        </a>
                        <button type="button" class="btn btn-danger" 
                                onclick="deleteEvent({{ $evenement->id }}, '{{ $evenement->titre }}')">
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
                        @if($evenement->category)
                        <li class="mb-3">
                            <strong class="text-muted">
                                <i class="fas fa-tag me-2"></i>Catégorie
                            </strong><br>
                            <span class="badge bg-orange text-white">{{ $evenement->category }}</span>
                        </li>
                        @endif
                        <li class="mb-3">
                            <strong class="text-muted">
                                <i class="fas fa-calendar me-2"></i>Date
                            </strong><br>
                            {{ \Carbon\Carbon::parse($evenement->date)->format('d/m/Y') }}
                            <small class="text-muted d-block">
                                {{ \Carbon\Carbon::parse($evenement->date)->format('l') }}
                            </small>
                        </li>
                        @if($evenement->lieu)
                        <li class="mb-3">
                            <strong class="text-muted">
                                <i class="fas fa-map-marker-alt me-2"></i>Lieu
                            </strong><br>
                            {{ $evenement->lieu }}
                        </li>
                        @endif
                        @if($evenement->duration)
                        <li class="mb-3">
                            <strong class="text-muted">
                                <i class="fas fa-clock me-2"></i>Durée
                            </strong><br>
                            {{ $evenement->duration }}
                        </li>
                        @endif
                        @if($evenement->organizer)
                        <li class="mb-3">
                            <strong class="text-muted">
                                <i class="fas fa-user me-2"></i>Organisateur
                            </strong><br>
                            {{ $evenement->organizer }}
                        </li>
                        @endif
                        @if(isset($evenement->inscriptions))
                        <li>
                            <strong class="text-muted">
                                <i class="fas fa-users me-2"></i>Participants
                            </strong><br>
                            {{ $evenement->inscriptions->count() ?? 0 }} inscrit(s)
                        </li>
                        @endif
                    </ul>
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
                <p>Êtes-vous sûr de vouloir supprimer l'événement <strong id="event-title"></strong> ?</p>
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

    .session-card {
        transition: transform 0.2s, box-shadow 0.2s;
        background: #f8f9fa;
    }

    .session-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }

    .event-content {
        line-height: 1.6;
        color: #666;
    }

    .agenda-day {
        border-left: 3px solid var(--orange-color);
        padding-left: 1rem;
    }

    .participant-item {
        background: #f8f9fa;
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
    // Delete event function
    function deleteEvent(eventId, eventTitle) {
        document.getElementById('event-title').textContent = eventTitle;
        document.getElementById('delete-form').action = `/evenements/${eventId}`;
        new bootstrap.Modal(document.getElementById('deleteModal')).show();
    }

    // Auto-dismiss alerts
    setTimeout(function() {
        const alerts = document.querySelectorAll('.alert');
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