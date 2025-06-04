@extends('layouts.master')

@section('content')
<div class="container-fluid">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="mb-2">Explorez Nos Événements</h1>
                    <p class="text-muted mb-0">
                        @if(method_exists($evenements, 'total'))
                            {{ $evenements->total() }} événement(s) au total
                        @else
                            {{ $evenements->count() }} événement(s) au total
                        @endif
                    </p>
                </div>
                 @if (auth()->check() && auth()->user()->role == 'admin')
                <div>
                    <a href="{{ route('evenements.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Nouvel Événement
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>



    <!-- Success/Error Messages -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- View Toggle -->
    <div class="row mb-3">
        <div class="col-12">
            <div class="btn-group" role="group">
                <input type="radio" class="btn-check" name="view-toggle" id="grid-view" checked>
                <label class="btn btn-outline-secondary" for="grid-view">
                    <i class="fas fa-th"></i> Grille
                </label>
                
                <input type="radio" class="btn-check" name="view-toggle" id="list-view">
                <label class="btn btn-outline-secondary" for="list-view">
                    <i class="fas fa-list"></i> Liste
                </label>
            </div>
        </div>
    </div>

    <!-- Events Grid View -->
    <div id="grid-container">
        @if($evenements->count() > 0)
            <div class="row">
                @foreach($evenements as $evenement)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-100 shadow-sm event-card" data-event-id="{{ $evenement->id }}">
                            <!-- Event Image -->
                            <div class="position-relative">
                                @if($evenement->image)
                                    <img src="{{ asset('storage/' . $evenement->image) }}" 
                                         class="card-img-top" alt="{{ $evenement->titre }}"
                                         style="height: 200px; object-fit: cover;">
                                @else
                                    <div class="card-img-top bg-gradient-primary d-flex align-items-center justify-content-center" 
                                         style="height: 200px;">
                                        <i class="fas fa-calendar-alt fa-3x text-white opacity-50"></i>
                                    </div>
                                @endif
                                
                                <!-- Status Badge -->
                                <div class="position-absolute top-0 end-0 m-2">
                                    @if($evenement->date < now())
                                        <span class="badge bg-secondary">Passé</span>
                                    @elseif($evenement->date->isToday())
                                        <span class="badge bg-warning text-dark">Aujourd'hui</span>
                                    @elseif($evenement->date->isTomorrow())
                                        <span class="badge bg-info">Demain</span>
                                    @else
                                        <span class="badge bg-success">À venir</span>
                                    @endif
                                </div>
                            </div>

                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{{ $evenement->titre }}</h5>
                                
                                <div class="mb-2">
                                    <small class="text-muted">
                                        <i class="fas fa-calendar me-1"></i>
                                        {{ $evenement->date->format('d/m/Y') }}
                                    </small>
                                    @if($evenement->lieu)
                                        <br>
                                        <small class="text-muted">
                                            <i class="fas fa-map-marker-alt me-1"></i>
                                            {{ $evenement->lieu }}
                                        </small>
                                    @endif
                                </div>

                                @if($evenement->description)
                                    <p class="card-text text-muted small">
                                        {{ Str::limit($evenement->description, 120) }}
                                    </p>
                                @endif

                                <!-- Agenda Preview -->
                                @if($evenement->agenda && is_array(json_decode($evenement->agenda, true)))
                                    @php
                                        $agenda = json_decode($evenement->agenda, true);
                                        $totalSessions = collect($agenda)->sum(fn($day) => count($day));
                                    @endphp
                                    <div class="mb-2">
                                        <small class="text-primary">
                                            <i class="fas fa-clock me-1"></i>
                                            {{ count($agenda) }} jour(s) • {{ $totalSessions }} session(s)
                                        </small>
                                    </div>
                                @endif

                                <div class="mt-auto">
                                    <div class="btn-group w-100" role="group">
                                        <a href="{{ route('evenements.show', $evenement) }}" 
                                           class="btn btn-outline-primary btn-sm">
                                            <i class="fas fa-eye"></i> Voir
                                        </a>
                                         @if (auth()->check() && auth()->user()->role == 'admin')
                                        <a href="{{ route('evenements.edit', $evenement) }}" 
                                           class="btn btn-outline-warning btn-sm">
                                            <i class="fas fa-edit"></i> Modifier
                                        </a>
                                        <button type="button" class="btn btn-outline-danger btn-sm" 
                                                onclick="deleteEvent({{ $evenement->id }}, '{{ $evenement->titre }}')">
                                            <i class="fas fa-trash"></i> Supprimer
                                        </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-calendar-times fa-4x text-muted mb-3"></i>
                <h4 class="text-muted">Aucun événement trouvé</h4>
                <p class="text-muted">
                    @if(request()->hasAny(['search', 'date_from', 'date_to']))
                        Aucun événement ne correspond à vos critères de recherche.
                        <br>
                        <a href="{{ route('evenements.index') }}" class="btn btn-outline-primary mt-2">
                            Voir tous les événements
                        </a>
                    @else
                        Commencez par créer votre premier événement.
                        <br>
                        <a href="{{ route('evenements.create') }}" class="btn btn-primary mt-2">
                            <i class="fas fa-plus"></i> Créer un événement
                        </a>
                    @endif
                </p>
            </div>
        @endif
    </div>

    <!-- Events List View (Hidden by default) -->
    <div id="list-container" style="display: none;">
        @if($evenements->count() > 0)
            <div class="card">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Événement</th>
                                <th>Date</th>
                                <th>Lieu</th>
                                <th>Statut</th>
                                <th>Sessions</th>
                                <th width="200">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($evenements as $evenement)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            @if($evenement->image)
                                                <img src="{{ asset('storage/' . $evenement->image) }}" 
                                                     class="rounded me-3" alt="{{ $evenement->titre }}"
                                                     style="width: 50px; height: 50px; object-fit: cover;">
                                            @else
                                                <div class="bg-light rounded me-3 d-flex align-items-center justify-content-center"
                                                     style="width: 50px; height: 50px;">
                                                    <i class="fas fa-calendar text-muted"></i>
                                                </div>
                                            @endif
                                            <div>
                                                <h6 class="mb-0">{{ $evenement->titre }}</h6>
                                                @if($evenement->description)
                                                    <small class="text-muted">{{ Str::limit($evenement->description, 60) }}</small>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-medium">{{ $evenement->date->format('d/m/Y') }}</span><br>
                                        <small class="text-muted">{{ $evenement->date->format('l') }}</small>
                                    </td>
                                    <td>
                                        @if($evenement->lieu)
                                            <i class="fas fa-map-marker-alt text-muted me-1"></i>
                                            {{ $evenement->lieu }}
                                        @else
                                            <span class="text-muted">Non spécifié</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($evenement->date < now())
                                            <span class="badge bg-secondary">Passé</span>
                                        @elseif($evenement->date->isToday())
                                            <span class="badge bg-warning text-dark">Aujourd'hui</span>
                                        @elseif($evenement->date->isTomorrow())
                                            <span class="badge bg-info">Demain</span>
                                        @else
                                            <span class="badge bg-success">À venir</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($evenement->agenda && is_array(json_decode($evenement->agenda, true)))
                                            @php
                                                $agenda = json_decode($evenement->agenda, true);
                                                $totalSessions = collect($agenda)->sum(fn($day) => count($day));
                                            @endphp
                                            <span class="text-primary">{{ $totalSessions }} session(s)</span><br>
                                            <small class="text-muted">{{ count($agenda) }} jour(s)</small>
                                        @else
                                            <span class="text-muted">Aucune session</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm" role="group">
                                            <a href="{{ route('evenements.show', $evenement) }}" 
                                               class="btn btn-outline-primary" title="Voir">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            
                                            <a href="{{ route('evenements.edit', $evenement) }}" 
                                               class="btn btn-outline-warning" title="Modifier">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button type="button" class="btn btn-outline-danger" 
                                                    onclick="deleteEvent({{ $evenement->id }}, '{{ $evenement->titre }}')" 
                                                    title="Supprimer">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>

    <!-- Pagination -->
    @if(method_exists($evenements, 'hasPages') && $evenements->hasPages())
        <div class="row mt-4">
            <div class="col-12">
                <div class="d-flex justify-content-center">
                    {{ $evenements->links() }}
                </div>
            </div>
        </div>
    @endif
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirmer la suppression</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Êtes-vous sûr de vouloir supprimer l'événement <strong id="event-title"></strong> ?</p>
                <p class="text-danger"><small><i class="fas fa-exclamation-triangle"></i> Cette action est irréversible.</small></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <form id="delete-form" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash"></i> Supprimer
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // View toggle functionality
    document.getElementById('grid-view').addEventListener('change', function() {
        if (this.checked) {
            document.getElementById('grid-container').style.display = 'block';
            document.getElementById('list-container').style.display = 'none';
            localStorage.setItem('events-view', 'grid');
        }
    });

    document.getElementById('list-view').addEventListener('change', function() {
        if (this.checked) {
            document.getElementById('grid-container').style.display = 'none';
            document.getElementById('list-container').style.display = 'block';
            localStorage.setItem('events-view', 'list');
        }
    });

    // Restore saved view preference
    document.addEventListener('DOMContentLoaded', function() {
        const savedView = localStorage.getItem('events-view');
        if (savedView === 'list') {
            document.getElementById('list-view').checked = true;
            document.getElementById('list-view').dispatchEvent(new Event('change'));
        }
    });

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

    // Enhanced search functionality
    let searchTimeout;
    document.getElementById('search').addEventListener('input', function() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => {
            // You can implement live search here if needed
            // For now, user needs to click the filter button
        }, 500);
    });

    // Date range validation
    document.getElementById('date_from').addEventListener('change', function() {
        const dateTo = document.getElementById('date_to');
        if (this.value && dateTo.value && this.value > dateTo.value) {
            dateTo.value = this.value;
        }
        dateTo.min = this.value;
    });

    document.getElementById('date_to').addEventListener('change', function() {
        const dateFrom = document.getElementById('date_from');
        if (this.value && dateFrom.value && this.value < dateFrom.value) {
            dateFrom.value = this.value;
        }
        dateFrom.max = this.value;
    });
</script>

<style>
    .event-card {
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .event-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(0,0,0,0.1) !important;
    }

    .bg-gradient-primary {
        background: linear-gradient(135deg, #007bff, #0056b3);
    }

    .table th {
        border-top: none;
        font-weight: 600;
    }

    .btn-group-sm > .btn {
        font-size: 0.75rem;
    }

    .badge {
        font-size: 0.7em;
        font-weight: 500;
    }

    @media (max-width: 768px) {
        .btn-group {
            flex-direction: column;
        }
        
        .btn-group .btn {
            border-radius: 0.375rem !important;
            margin-bottom: 0.25rem;
        }
        
        .btn-group .btn:last-child {
            margin-bottom: 0;
        }
    }
</style>
@endsection