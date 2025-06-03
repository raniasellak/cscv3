@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h1 class="mb-0">Créer un Événement</h1>
                </div>
                <div class="card-body">
                    <form action="{{ route('evenements.store') }}" method="POST" enctype="multipart/form-data" id="eventForm">
                        @csrf

                        <!-- Basic Information Section -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="text-primary border-bottom pb-2">Informations de base</h5>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-8">
                                <label for="titre" class="form-label required">Titre de l'événement</label>
                                <input type="text" name="titre" id="titre" class="form-control" required 
                                       placeholder="Ex: Festival de Musique Berbère">
                                <div class="invalid-feedback">
                                    Veuillez saisir un titre pour l'événement.
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="date" class="form-label required">Date</label>
                                <input type="date" name="date" id="date" class="form-control" required 
                                       min="{{ date('Y-m-d') }}">
                                <div class="invalid-feedback">
                                    Veuillez sélectionner une date valide.
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="lieu" class="form-label">Lieu</label>
                            <input type="text" name="lieu" id="lieu" class="form-control" 
                                   placeholder="Ex: Théâtre Mohammed V, Rabat">
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description courte</label>
                            <textarea name="description" id="description" rows="3" class="form-control" 
                                      placeholder="Résumé de l'événement (maximum 200 caractères)" 
                                      maxlength="200"></textarea>
                            <div class="form-text">
                                <span id="desc-count">0</span>/200 caractères
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="long_description" class="form-label">Description détaillée</label>
                            <textarea name="long_description" id="long_description" rows="6" class="form-control" 
                                      placeholder="Description complète de l'événement"></textarea>
                        </div>

                        <div class="mb-4">
                            <label for="image" class="form-label">Image de l'événement</label>
                            <input type="file" name="image" id="image" class="form-control" accept="image/*">
                            <div class="form-text">
                                Formats acceptés: JPG, PNG, GIF (max 2MB)
                            </div>
                            <div id="image-preview" class="mt-2"></div>
                        </div>

                        <!-- Agenda Section -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="text-primary border-bottom pb-2">Programme de l'événement</h5>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <label class="form-label mb-0">Agenda</label>
                                <button type="button" class="btn btn-outline-primary btn-sm" onclick="addDay()">
                                    <i class="fas fa-plus"></i> Ajouter un jour
                                </button>
                            </div>
                            
                            <div id="agenda-builder" class="border rounded p-3 bg-light min-height-100">
                                <div class="text-center text-muted" id="empty-agenda">
                                    <i class="fas fa-calendar-alt fa-2x mb-2"></i>
                                    <p>Aucun jour ajouté. Cliquez sur "Ajouter un jour" pour commencer.</p>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="agenda" id="agenda-json">

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="button" class="btn btn-secondary me-md-2" onclick="previewEvent()">
                                <i class="fas fa-eye"></i> Aperçu
                            </button>
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save"></i> Créer l'événement
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Preview Modal -->
<div class="modal fade" id="previewModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Aperçu de l'événement</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="preview-content">
                <!-- Preview content will be inserted here -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Character counter for description
    document.getElementById('description').addEventListener('input', function() {
        const count = this.value.length;
        document.getElementById('desc-count').textContent = count;
        
        if (count > 180) {
            document.getElementById('desc-count').style.color = '#dc3545';
        } else {
            document.getElementById('desc-count').style.color = '#6c757d';
        }
    });

    // Image preview
    document.getElementById('image').addEventListener('change', function(e) {
        const file = e.target.files[0];
        const preview = document.getElementById('image-preview');
        
        if (file) {
            if (file.size > 2 * 1024 * 1024) {
                alert('La taille de l\'image ne doit pas dépasser 2MB');
                this.value = '';
                preview.innerHTML = '';
                return;
            }
            
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.innerHTML = `
                    <img src="${e.target.result}" class="img-thumbnail" style="max-width: 200px; max-height: 150px;">
                `;
            };
            reader.readAsDataURL(file);
        } else {
            preview.innerHTML = '';
        }
    });

    // Day management
    function addDay() {
        const dayName = prompt("Nom du jour (ex: Mardi 17 Juin 2025):");
        if (!dayName || dayName.trim() === '') return;
        
        if (document.querySelector(`[data-day="${dayName}"]`)) {
            alert("Ce jour existe déjà !");
            return;
        }

        // Hide empty message
        document.getElementById('empty-agenda').style.display = 'none';

        const container = document.createElement('div');
        container.classList.add('card', 'mb-3');
        container.dataset.day = dayName;

        container.innerHTML = `
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="mb-0 text-primary">${dayName}</h6>
                <div>
                    <button type="button" class="btn btn-outline-secondary btn-sm me-2" onclick="addSession(this)">
                        <i class="fas fa-plus"></i> Session
                    </button>
                    <button type="button" class="btn btn-outline-danger btn-sm" onclick="removeDay(this)" title="Supprimer ce jour">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="sessions">
                    <div class="text-center text-muted">
                        <i class="fas fa-clock"></i>
                        <small>Aucune session. Cliquez sur "Session" pour ajouter.</small>
                    </div>
                </div>
            </div>
        `;

        document.getElementById('agenda-builder').appendChild(container);
    }

    function removeDay(button) {
        if (confirm('Êtes-vous sûr de vouloir supprimer ce jour et toutes ses sessions ?')) {
            button.closest('.card').remove();
            
            // Show empty message if no days left
            if (document.querySelectorAll('#agenda-builder .card').length === 0) {
                document.getElementById('empty-agenda').style.display = 'block';
            }
        }
    }

    function addSession(button) {
        const time = prompt("Heure (ex: 14:30 - 16:00):");
        if (!time || time.trim() === '') return;
        
        const title = prompt("Titre de la session:");
        if (!title || title.trim() === '') return;

        const sessionsContainer = button.closest('.card').querySelector('.sessions');
        
        // Remove empty message if it exists
        const emptyMsg = sessionsContainer.querySelector('.text-center');
        if (emptyMsg) emptyMsg.remove();

        const session = document.createElement('div');
        session.classList.add('d-flex', 'justify-content-between', 'align-items-center', 'border-bottom', 'py-2');

        session.innerHTML = `
            <div>
                <strong class="text-dark">${title}</strong><br>
                <small class="text-muted">
                    <i class="fas fa-clock me-1"></i>${time}
                </small>
            </div>
            <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeSession(this)" title="Supprimer cette session">
                <i class="fas fa-times"></i>
            </button>
        `;

        sessionsContainer.appendChild(session);
    }

    function removeSession(button) {
        const sessionsContainer = button.closest('.sessions');
        button.parentElement.remove();
        
        // Show empty message if no sessions left
        if (sessionsContainer.children.length === 0) {
            sessionsContainer.innerHTML = `
                <div class="text-center text-muted">
                    <i class="fas fa-clock"></i>
                    <small>Aucune session. Cliquez sur "Session" pour ajouter.</small>
                </div>
            `;
        }
    }

    // Preview functionality
    function previewEvent() {
        const titre = document.getElementById('titre').value;
        const lieu = document.getElementById('lieu').value;
        const date = document.getElementById('date').value;
        const description = document.getElementById('description').value;
        const longDescription = document.getElementById('long_description').value;
        
        if (!titre || !date) {
            alert('Veuillez remplir au moins le titre et la date pour voir l\'aperçu.');
            return;
        }

        // Build agenda preview
        let agendaPreview = '';
        const days = document.querySelectorAll('#agenda-builder .card');
        
        if (days.length > 0) {
            agendaPreview = '<h6>Programme:</h6>';
            days.forEach(day => {
                const dayName = day.dataset.day;
                const sessions = day.querySelectorAll('.sessions > div:not(.text-center)');
                
                agendaPreview += `<div class="mb-3"><strong>${dayName}</strong><ul class="list-group list-group-flush mt-2">`;
                
                if (sessions.length > 0) {
                    sessions.forEach(session => {
                        const title = session.querySelector('strong').textContent;
                        const time = session.querySelector('small').textContent.replace(/^\s*/, '');
                        agendaPreview += `<li class="list-group-item px-0 py-1">${title} - ${time}</li>`;
                    });
                } else {
                    agendaPreview += '<li class="list-group-item px-0 py-1 text-muted">Aucune session</li>';
                }
                
                agendaPreview += '</ul></div>';
            });
        }

        const previewContent = `
            <div class="mb-3">
                <h4 class="text-primary">${titre}</h4>
                ${lieu ? `<p class="mb-1"><i class="fas fa-map-marker-alt text-muted me-2"></i>${lieu}</p>` : ''}
                <p class="mb-3"><i class="fas fa-calendar text-muted me-2"></i>${new Date(date).toLocaleDateString('fr-FR', {
                    weekday: 'long',
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                })}</p>
                ${description ? `<p class="lead">${description}</p>` : ''}
                ${longDescription ? `<div class="mb-3">${longDescription.replace(/\n/g, '<br>')}</div>` : ''}
                ${agendaPreview}
            </div>
        `;

        document.getElementById('preview-content').innerHTML = previewContent;
        new bootstrap.Modal(document.getElementById('previewModal')).show();
    }

    // Form submission
    document.getElementById('eventForm').addEventListener('submit', function(e) {
        // Build agenda JSON
        const blocks = document.querySelectorAll('#agenda-builder .card');
        const agenda = {};

        blocks.forEach(block => {
            const day = block.dataset.day;
            const sessions = [];
            const sessionElements = block.querySelectorAll('.sessions > div:not(.text-center)');
            
            sessionElements.forEach(session => {
                const title = session.querySelector('strong').textContent;
                const time = session.querySelector('small').textContent.replace(/^\s*/, '');
                sessions.push({ title, time });
            });
            
            if (sessions.length > 0) {
                agenda[day] = sessions;
            }
        });

        document.getElementById('agenda-json').value = JSON.stringify(agenda);

        // Add form validation classes
        this.classList.add('was-validated');
        
        // Check if form is valid
        if (!this.checkValidity()) {
            e.preventDefault();
            e.stopPropagation();
        }
    });
</script>

<style>
    .required::after {
        content: " *";
        color: #dc3545;
    }
    
    .min-height-100 {
        min-height: 100px;
    }
    
    .card-header h6 {
        font-weight: 600;
    }
    
    .was-validated .form-control:valid {
        border-color: #198754;
    }
    
    .was-validated .form-control:invalid {
        border-color: #dc3545;
    }
</style>
@endsection