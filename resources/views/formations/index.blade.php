

@extends(auth()->user()?->role === 'admin' ? 'layouts.appdash' : 'layouts.master')


@section('title')
Nos Formations
@endsection

@section('content')
<div class="container-fluid">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="logo mb-3">
                        <span class="logo-c">C</span>
                        <span class="logo-s">S</span>
                        <span class="logo-c2">C</span>
                    </div>
                    <h1 class="mb-2">Explorez Nos Formations</h1>
                    <p class="text-muted mb-0">
                        @if(method_exists($formations, 'total'))
                            {{ $formations->total() }} formation(s) au total
                        @else
                            {{ $formations->count() }} formation(s) au total
                        @endif
                    </p>
                </div>
                @if (auth()->check() && auth()->user()->role == 'admin')
                <div>
                    <a href="{{ route('formations.create') }}" class="btn btn-orange">
                        <i class="fas fa-plus"></i> Nouvelle Formation
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Filters Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form method="GET" action="{{ route('formations.index') }}" class="row g-3">
                        <div class="col-md-4">
                            <label for="category" class="form-label">Catégorie</label>
                            <select name="category" id="category" class="form-select">
                                <option value="">Toutes les catégories</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat }}" {{ $cat == $category ? 'selected' : '' }}>{{ $cat }}</option>
                                @endforeach
                            </select>
                        </div>
                       
                        <div class="col-md-2 d-flex align-items-end">
                            <button type="submit" class="btn btn-orange w-100">
                                <i class="fas fa-filter"></i> Filtrer
                            </button>
                        </div>
                    </form>
                </div>
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

    <!-- Formations Grid View -->
    <div id="grid-container">
        @if($formations->count() > 0)
            <div class="row">
                @foreach($formations as $formation)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-100 shadow-sm formation-card" data-formation-id="{{ $formation->id }}">
                            <!-- Formation Image -->
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
         class="card-img-top" alt="{{ $formation->title }}"
         style="height: 200px; object-fit: cover;">
@else
    <div class="card-img-top bg-gradient-orange d-flex align-items-center justify-content-center" 
         style="height: 200px;">
        <i class="fas fa-graduation-cap fa-3x text-white opacity-50"></i>
    </div>
@endif

                                
                                <!-- Status Badge -->
                                <div class="position-absolute top-0 end-0 m-2">
                                    @if($formation->date < now())
                                        <span class="badge bg-secondary">Terminée</span>
                                    {{-- @elseif($formation->date->isToday())
                                        <span class="badge bg-warning text-dark">Aujourd'hui</span>
                                    @elseif($formation->date->isTomorrow())
                                        <span class="badge bg-info">Demain</span> --}}
                                    @else
                                        <span class="badge bg-success">À venir</span>
                                    @endif
                                </div>
                                
                                <!-- Category Badge -->
                                <div class="position-absolute top-0 start-0 m-2">
                                    <span class="badge bg-orange text-white">{{ $formation->category }}</span>
                                </div>
                            </div>

                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title text-orange">{{ $formation->title }}</h5>
                                
                                <div class="mb-2">
                                    <small class="text-muted">
                                        <i class="fas fa-calendar me-1"></i>
                                        {{ \Carbon\Carbon::parse($formation->date)->format('d/m/Y') }}
                                    </small>
                                    @if($formation->duration)
                                        <br>
                                        <small class="text-muted">
                                            <i class="fas fa-clock me-1"></i>
                                            {{ $formation->duration }}
                                        </small>
                                    @endif
                                    @if($formation->instructor)
                                        <br>
                                        <small class="text-muted">
                                            <i class="fas fa-user me-1"></i>
                                            {{ $formation->instructor }}
                                        </small>
                                    @endif
                                </div>

                                @if($formation->description)
                                    <p class="card-text text-muted small">
                                        {{ Str::limit($formation->description, 120) }}
                                    </p>
                                @endif


                                <div class="mt-auto">
                                    <div class="btn-group w-100" role="group">
                                        <a href="{{ route('formations.show', $formation) }}" 
                                           class="btn btn-outline-orange btn-sm">
                                            <i class="fas fa-eye"></i> Voir
                                        </a>
                                        @if (auth()->check() && auth()->user()->role == 'admin')
                                        <a href="{{ route('formations.edit', $formation) }}" 
                                           class="btn btn-outline-warning btn-sm">
                                            <i class="fas fa-edit"></i> Modifier
                                        </a>
                                        <button type="button" class="btn btn-outline-danger btn-sm" 
                                                onclick="deleteFormation({{ $formation->id }}, '{{ $formation->title }}')">
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
                <i class="fas fa-graduation-cap fa-4x text-muted mb-3"></i>
                <h4 class="text-muted">Aucune formation trouvée</h4>
                <p class="text-muted">
                    @if(request()->hasAny(['category', 'date_from', 'date_to']))
                        Aucune formation ne correspond à vos critères de recherche.
                        <br>
                        <a href="{{ route('formations.index') }}" class="btn btn-outline-orange mt-2">
                            Voir toutes les formations
                        </a>
                    @else
                        Aucune formation disponible pour le moment.
                        @if (auth()->check() && auth()->user()->role == 'admin')
                        <br>
                        <a href="{{ route('formations.create') }}" class="btn btn-orange mt-2">
                            <i class="fas fa-plus"></i> Créer une formation
                        </a>
                        @endif
                    @endif
                </p>
            </div>
        @endif
    </div>

    <!-- Formations List View (Hidden by default) -->
    <div id="list-container" style="display: none;">
        @if($formations->count() > 0)
            <div class="card">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Formation</th>
                                <th>Catégorie</th>
                                <th>Date</th>
                                <th>Formateur</th>
                                <th>Statut</th>
                                <th width="200">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($formations as $formation)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
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
        class="rounded me-3" alt="{{ $formation->title }}"
                                                     style="width: 50px; height: 50px; object-fit: cover;">
@else
    <div class="card-img-top bg-gradient-orange d-flex align-items-center justify-content-center" 
         style="height: 200px;">
        <i class="fas fa-graduation-cap fa-3x text-white opacity-50"></i>
    </div>
@endif

                                            <div>
                                                <h6 class="mb-0">{{ $formation->title }}</h6>
                                                @if($formation->description)
                                                    <small class="text-muted">{{ Str::limit($formation->description, 60) }}</small>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-orange text-white">{{ $formation->category }}</span>
                                    </td>
                                    <td>
                                        <span class="fw-medium">{{ \Carbon\Carbon::parse($formation->date)->format('d/m/Y') }}</span><br>
                                        <small class="text-muted">{{ \Carbon\Carbon::parse($formation->date)->format('l') }}</small>
                                    </td>
                                    
                                    <td>
                                        @if($formation->formateur_email)
                                            <i class="fas fa-user text-muted me-1"></i>
                                            {{ $formation->formateur_email }}
                                        @else
                                            <span class="text-muted">Non spécifié</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($formation->date < now())
                                            <span class="badge bg-secondary">Terminée</span>
                                        {{-- @elseif($formation->date->isToday())
                                            <span class="badge bg-warning text-dark">Aujourd'hui</span>
                                        @elseif($formation->date->isTomorrow())
                                            <span class="badge bg-info">Demain</span> --}}
                                        @else
                                            <span class="badge bg-success">À venir</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm" role="group">
                                            <a href="{{ route('formations.show', $formation) }}" 
                                               class="btn btn-outline-orange" title="Voir">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            @if (auth()->check() && auth()->user()->role == 'admin')
                                            <a href="{{ route('formations.edit', $formation) }}" 
                                               class="btn btn-outline-warning" title="Modifier">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button type="button" class="btn btn-outline-danger" 
                                                    onclick="deleteFormation({{ $formation->id }}, '{{ $formation->title }}')" 
                                                    title="Supprimer">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                            @else
                                            <button type="button" class="btn btn-orange" title="S'inscrire">
                                                <i class="fas fa-user-plus"></i>
                                            </button>
                                            @endif
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
    @if(method_exists($formations, 'hasPages') && $formations->hasPages())
        <div class="row mt-4">
            <div class="col-12">
                <div class="d-flex justify-content-center">
                    {{ $formations->links() }}
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
                <p>Êtes-vous sûr de vouloir supprimer la formation <strong id="formation-title"></strong> ?</p>
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
            localStorage.setItem('formations-view', 'grid');
        }
    });

    document.getElementById('list-view').addEventListener('change', function() {
        if (this.checked) {
            document.getElementById('grid-container').style.display = 'none';
            document.getElementById('list-container').style.display = 'block';
            localStorage.setItem('formations-view', 'list');
        }
    });

    // Restore saved view preference
    document.addEventListener('DOMContentLoaded', function() {
        const savedView = localStorage.getItem('formations-view');
        if (savedView === 'list') {
            document.getElementById('list-view').checked = true;
            document.getElementById('list-view').dispatchEvent(new Event('change'));
        }
    });

    // Delete formation function
    function deleteFormation(formationId, formationTitle) {
        document.getElementById('formation-title').textContent = formationTitle;
        document.getElementById('delete-form').action = `/formations/${formationId}`;
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
@endsection

@section('styles')
<style>
    .logo {
        font-size: 2.5rem;
        font-weight: bold;
        margin-bottom: 1rem;
    }

    .logo-bracket {
        color: #333;
    }

    .logo-c {
        color: #333;
    }

    .logo-s {
        color: #ff8c00;
    }

    .logo-c2 {
        color: #ffedaf;
    }

    .btn-orange {
        background-color: #ff8c00;
        border-color: #ff8c00;
        color: white;
    }

    .btn-orange:hover {
        background-color: #e07e00;
        border-color: #e07e00;
        color: white;
    }

    .btn-outline-orange {
        color: #ff8c00;
        border-color: #ff8c00;
    }

    .btn-outline-orange:hover {
        background-color: #ff8c00;
        border-color: #ff8c00;
        color: white;
    }

    .text-orange {
        color: #ff8c00;
    }

    .bg-orange {
        background-color: #ff8c00;
    }

    .form-control:focus, .form-select:focus {
        border-color: #ff8c00;
        box-shadow: 0 0 0 0.25rem rgba(255, 140, 0, 0.25);
    }

    .form-check-input:checked {
        background-color: #ff8c00;
        border-color: #ff8c00;
    }

    .formation-card {
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .formation-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(0,0,0,0.1) !important;
    }

    .bg-gradient-orange {
        background: linear-gradient(135deg, #ff8c00, #e07e00);
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