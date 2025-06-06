@extends('layouts.appdash')

@section('title', 'Créer un Événement')

@section('content')
<style>
    body {
        background-color: #fff8f0;
        font-family: Arial, sans-serif;
    }

    .container {
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
    }

    h1 {
        color: #ff6600;
        text-align: center;
        margin-bottom: 30px;
    }

    .card {
        background-color: #ffffff;
        border: 1px solid #ffcc99;
        border-radius: 10px;
        padding: 30px;
        box-shadow: 0 0 10px rgba(255, 102, 0, 0.1);
    }

    .form-label {
        display: block;
        margin-bottom: 8px;
        color: #333;
        font-weight: 500;
    }

    .form-label.required:after {
        content: " *";
        color: #dc3545;
    }

    .form-control {
        width: 100%;
        padding: 10px;
        border: 1px solid #ffcc99;
        border-radius: 5px;
        box-sizing: border-box;
        margin-bottom: 15px;
        transition: border-color 0.3s;
    }

    .form-control:focus {
        border-color: #ff6600;
        outline: none;
        box-shadow: 0 0 5px rgba(255, 102, 0, 0.3);
    }

    textarea.form-control {
        min-height: 100px;
        resize: vertical;
    }

    .btn {
        padding: 8px 16px;
        border-radius: 5px;
        cursor: pointer;
        transition: all 0.3s;
    }

    .btn-primary {
        background-color: #ff6600;
        color: white;
        border: none;
    }

    .btn-success {
        background-color: #28a745;
        color: white;
        border: none;
    }

    .btn-secondary {
        background-color: #6c757d;
        color: white;
        border: none;
    }

    .btn-danger {
        background-color: #dc3545;
        color: white;
        border: none;
    }

    .btn-outline-primary {
        border: 1px solid #ff6600;
        color: #ff6600;
        background: transparent;
    }

    .btn-outline-primary:hover {
        background-color: #ff6600;
        color: white;
    }

    .btn-sm {
        padding: 5px 10px;
        font-size: 12px;
    }

    #agenda-builder {
        border: 1px solid #ffcc99;
        border-radius: 5px;
        padding: 15px;
        margin-bottom: 15px;
        background-color: #fffaf5;
    }

    .day-block {
        border: 1px solid #ffcc99;
        border-radius: 5px;
        padding: 10px;
        margin-bottom: 10px;
        background-color: white;
    }

    .session-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 8px;
        margin: 5px 0;
        background-color: #fffaf5;
        border-radius: 3px;
        border-left: 3px solid #ff6600;
    }

    .form-text {
        font-size: 12px;
        color: #666;
        margin-top: -10px;
        margin-bottom: 10px;
    }

    .invalid-feedback {
        color: #dc3545;
        font-size: 12px;
        margin-top: -10px;
        margin-bottom: 10px;
    }

    .button-group {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        margin-top: 20px;
    }

    .section-title {
        color: #ff6600;
        border-bottom: 1px solid #ffcc99;
        padding-bottom: 5px;
        margin-bottom: 15px;
    }

    .image-preview {
        margin-top: 10px;
    }

    .image-preview img {
        max-width: 200px;
        max-height: 150px;
        border: 1px solid #ddd;
        border-radius: 4px;
        padding: 3px;
    }
</style>

<div class="container">
    <h1>Créer un Événement</h1>

    <div class="card">
        <form action="{{ route('evenements.store') }}" method="POST" enctype="multipart/form-data" id="eventForm">
            @csrf

            <!-- Basic Information Section -->
            <h5 class="section-title">Informations de base</h5>

            <div class="row">
                <div class="col-md-8">
                    <label for="titre" class="form-label required">Titre</label>
                    <input type="text" name="titre" id="titre" class="form-control" required>
                    <div class="invalid-feedback">
                        Veuillez saisir un titre pour l'événement.
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="date" class="form-label required">Date</label>
                    <input type="date" name="date" id="date" class="form-control" required min="{{ date('Y-m-d') }}">
                    <div class="invalid-feedback">
                        Veuillez sélectionner une date valide.
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="lieu" class="form-label">Lieu</label>
                <input type="text" name="lieu" id="lieu" class="form-control">
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description courte</label>
                <textarea name="description" id="description" rows="3" class="form-control" maxlength="200"></textarea>
                <div class="form-text">
                    <span id="desc-count">0</span>/200 caractères
                </div>
            </div>

            <div class="mb-3">
                <label for="long_description" class="form-label">Description détaillée</label>
                <textarea name="long_description" id="long_description" rows="5" class="form-control"></textarea>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" name="image" id="image" class="form-control" accept="image/*">
                <div class="form-text">
                    Formats acceptés: JPG, PNG, GIF (max 2MB)
                </div>
                <div id="image-preview" class="image-preview"></div>
            </div>

            <!-- Agenda Section -->
            <h5 class="section-title">Programme de l'événement</h5>

            <div class="mb-3">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <label class="form-label">Agenda</label>
                    <button type="button" class="btn btn-sm btn-outline-primary" onclick="addDay()">
                        <i class="fas fa-plus"></i> Ajouter un jour
                    </button>
                </div>
                
                <div id="agenda-builder">
                    <div class="text-center text-muted py-3" id="empty-agenda">
                        <i class="fas fa-calendar-alt fa-lg mb-2"></i>
                        <p>Aucun jour ajouté</p>
                    </div>
                </div>
            </div>

            <input type="hidden" name="agenda" id="agenda-json">

            <div class="button-group">
                <button type="button" class="btn btn-secondary" onclick="previewEvent()">
                    <i class="fas fa-eye"></i> Aperçu
                </button>
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save"></i> Créer l'événement
                </button>
            </div>
        </form>
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
                preview.innerHTML = `<img src="${e.target.result}" class="img-thumbnail">`;
            };
            reader.readAsDataURL(file);
        } else {
            preview.innerHTML = '';
        }
    });

    // Day management
    function addDay() {
        const dayName = prompt("Nom du jour (ex: Mardi 17 Juin):");
        if (!dayName) return;
        
        if (document.querySelector(`[data-day="${dayName}"]`)) {
            alert("Ce jour existe déjà !");
            return;
        }

        // Hide empty message
        document.getElementById('empty-agenda').style.display = 'none';

        const container = document.createElement('div');
        container.classList.add('day-block');
        container.dataset.day = dayName;

        container.innerHTML = `
            <div class="d-flex justify-content-between align-items-center mb-2">
                <h6 class="mb-0" style="color: #ff6600;">${dayName}</h6>
                <div>
                    <button type="button" class="btn btn-sm btn-outline-primary me-1" onclick="addSession(this)">
                        <i class="fas fa-plus"></i> Session
                    </button>
                    <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeDay(this)">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
            <div class="sessions">
                <div class="text-center text-muted py-2">
                    <small>Aucune session ajoutée</small>
                </div>
            </div>
        `;

        document.getElementById('agenda-builder').appendChild(container);
    }

    function removeDay(button) {
        if (confirm('Êtes-vous sûr de vouloir supprimer ce jour et toutes ses sessions ?')) {
            button.closest('.day-block').remove();
            
            // Show empty message if no days left
            if (document.querySelectorAll('#agenda-builder .day-block').length === 0) {
                document.getElementById('empty-agenda').style.display = 'block';
            }
        }
    }

    function addSession(button) {
        const time = prompt("Heure (ex: 14:30 - 16:00):");
        if (!time) return;
        
        const title = prompt("Titre de la session:");
        if (!title) return;

        const sessionsContainer = button.closest('.day-block').querySelector('.sessions');
        
        // Remove empty message if it exists
        const emptyMsg = sessionsContainer.querySelector('.text-center');
        if (emptyMsg) emptyMsg.remove();

        const session = document.createElement('div');
        session.classList.add('session-item');

        session.innerHTML = `
            <div>
                <strong>${title}</strong><br>
                <small>${time}</small>
            </div>
            <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeSession(this)">
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
                <div class="text-center text-muted py-2">
                    <small>Aucune session ajoutée</small>
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
        const days = document.querySelectorAll('#agenda-builder .day-block');
        
        if (days.length > 0) {
            agendaPreview = '<h6 class="mt-3" style="color: #ff6600;">Programme:</h6>';
            days.forEach(day => {
                const dayName = day.dataset.day;
                const sessions = day.querySelectorAll('.session-item');
                
                agendaPreview += `<div class="mb-2"><strong>${dayName}</strong><ul style="list-style: none; padding-left: 0;">`;
                
                if (sessions.length > 0) {
                    sessions.forEach(session => {
                        const title = session.querySelector('strong').textContent;
                        const time = session.querySelector('small').textContent;
                        agendaPreview += `<li><i class="fas fa-clock text-muted me-2"></i>${title} - ${time}</li>`;
                    });
                } else {
                    agendaPreview += '<li class="text-muted">Aucune session</li>';
                }
                
                agendaPreview += '</ul></div>';
            });
        }

        const previewContent = `
            <div>
                <h4 style="color: #ff6600;">${titre}</h4>
                ${lieu ? `<p><i class="fas fa-map-marker-alt text-muted me-2"></i>${lieu}</p>` : ''}
                <p><i class="fas fa-calendar text-muted me-2"></i>${new Date(date).toLocaleDateString('fr-FR', {
                    weekday: 'long',
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                })}</p>
                ${description ? `<p class="lead">${description}</p>` : ''}
                ${longDescription ? `<div>${longDescription.replace(/\n/g, '<br>')}</div>` : ''}
                ${agendaPreview}
            </div>
        `;

        document.getElementById('preview-content').innerHTML = previewContent;
        new bootstrap.Modal(document.getElementById('previewModal')).show();
    }

    // Form submission
    document.getElementById('eventForm').addEventListener('submit', function(e) {
        // Build agenda JSON
        const blocks = document.querySelectorAll('#agenda-builder .day-block');
        const agenda = {};

        blocks.forEach(block => {
            const day = block.dataset.day;
            const sessions = [];
            const sessionElements = block.querySelectorAll('.session-item');
            
            sessionElements.forEach(session => {
                const title = session.querySelector('strong').textContent;
                const time = session.querySelector('small').textContent;
                sessions.push({ title, time });
            });
            
            if (sessions.length > 0) {
                agenda[day] = sessions;
            }
        });

        document.getElementById('agenda-json').value = JSON.stringify(agenda);

        // Add form validation
        this.classList.add('was-validated');
        
        if (!this.checkValidity()) {
            e.preventDefault();
            e.stopPropagation();
        }
    });
</script>
@endsection