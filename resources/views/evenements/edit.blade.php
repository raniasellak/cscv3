@extends('layouts.appdash')

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

    form {
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
        margin-bottom: 20px;
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

    .btn-success {
        background-color: #28a745;
        color: white;
        border: none;
        padding: 10px 20px;
        font-size: 16px;
        display: block;
        margin: 30px auto 0;
    }

    .btn-success:hover {
        background-color: #218838;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(40, 167, 69, 0.4);
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

    .btn-danger {
        background-color: #dc3545;
        color: white;
        border: none;
    }

    .btn-secondary {
        background-color: #6c757d;
        color: white;
        border: none;
    }

    .btn-sm {
        padding: 5px 10px;
        font-size: 12px;
    }

    #agenda-builder {
        margin-bottom: 20px;
    }

    .day-block {
        border: 1px solid #ffcc99;
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 15px;
        background-color: #fffaf5;
    }

    .day-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
        padding-bottom: 10px;
        border-bottom: 1px dashed #ffcc99;
    }

    .session-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 8px;
        margin-bottom: 8px;
        background-color: white;
        border-radius: 5px;
        border-left: 3px solid #ff6600;
    }

    .current-image {
        margin-top: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
        padding: 5px;
    }
</style>

<div class="container">
    <h1>Modifier un Événement</h1>

    <form action="{{ route('evenements.update', $evenement) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="titre" class="form-label required">Titre</label>
            <input type="text" name="titre" class="form-control" value="{{ old('titre', $evenement->titre) }}" required>
        </div>

        <div class="mb-3">
            <label for="lieu" class="form-label">Lieu</label>
            <input type="text" name="lieu" class="form-control" value="{{ old('lieu', $evenement->lieu) }}">
        </div>

        <div class="mb-3">
            <label for="date" class="form-label required">Date</label>
            <input type="date" name="date" class="form-control" value="{{ old('date', $evenement->date->format('Y-m-d')) }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Thématique</label>
            <textarea name="description" rows="3" class="form-control">{{ old('description', $evenement->description) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="long_description" class="form-label">Description longue</label>
            <textarea name="long_description" rows="5" class="form-control">{{ old('long_description', $evenement->long_description) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" name="image" class="form-control">
            @if ($evenement->image)
                <div class="current-image">
                    <p>Image actuelle :</p>
                    <img src="{{ asset('storage/' . $evenement->image) }}" alt="Image actuelle" width="200">
                </div>
            @endif
        </div>

        <div class="mb-3">
            <label class="form-label">Agenda</label>
            <div id="agenda-builder">
                <!-- Jours dynamiques chargés par JS -->
            </div>
            <button type="button" class="btn btn-sm btn-outline-primary mt-2" onclick="addDay()">+ Ajouter un jour</button>
        </div>

        <input type="hidden" name="agenda" id="agenda-json">

        <button type="submit" class="btn btn-success">Enregistrer</button>
    </form>
</div>
@endsection

@section('scripts')
<script>
    // On récupère l'agenda JSON depuis Blade
    const existingAgenda = @json(old('agenda', $agenda ?? []));

    function addDay(dayName = null, sessions = []) {
        if (!dayName) {
            dayName = prompt("Nom du jour (ex: Tuesday, June 17)");
            if (!dayName || document.querySelector(`[data-day="${dayName}"]`)) return;
        } else if (document.querySelector(`[data-day="${dayName}"]`)) {
            // Éviter doublons
            return;
        }

        const container = document.createElement('div');
        container.classList.add('day-block');
        container.dataset.day = dayName;

        container.innerHTML = `
            <div class="day-header">
                <h5 style="margin: 0; color: #ff6600;">${dayName}</h5>
                <button type="button" class="btn btn-sm btn-danger" onclick="this.parentElement.parentElement.remove()">Supprimer</button>
            </div>
            <div class="sessions"></div>
            <button type="button" class="btn btn-sm btn-secondary mt-2" onclick="addSession(this)">+ Ajouter une session</button>
        `;

        document.getElementById('agenda-builder').appendChild(container);

        // Charger les sessions si elles existent
        sessions.forEach(s => {
            addSession(null, s.title, s.time, container.querySelector('.sessions'));
        });
    }

    function addSession(button = null, title = null, time = null, container = null) {
        if (!button && (!title || !time)) return;
        if (!container && button) {
            container = button.previousElementSibling;
        }
        if (!title) {
            title = prompt("Titre de la session");
        }
        if (!time) {
            time = prompt("Heure (ex: 3:30 - 4:30 p.m.)");
        }
        if (!title || !time) return;

        const session = document.createElement('div');
        session.classList.add('session-item');
        session.innerHTML = `
            <div>
                <strong>${title}</strong><br>
                <small>${time}</small>
            </div>
            <button type="button" class="btn btn-sm btn-danger" onclick="this.parentElement.remove()">×</button>
        `;

        container.appendChild(session);
    }

    // Charger l'agenda au chargement de la page
    document.addEventListener('DOMContentLoaded', () => {
        for (const [day, sessions] of Object.entries(existingAgenda)) {
            addDay(day, sessions);
        }
    });

    // Avant la soumission, créer le JSON dans le champ caché
    document.querySelector('form').addEventListener('submit', function () {
        const blocks = document.querySelectorAll('#agenda-builder > div');
        const agenda = {};

        blocks.forEach(block => {
            const day = block.dataset.day;
            const sessions = [];
            block.querySelectorAll('.sessions > div').forEach(session => {
                const title = session.querySelector('strong').innerText;
                const time = session.querySelector('small').innerText;
                sessions.push({ title, time });
            });
            agenda[day] = sessions;
        });

        document.getElementById('agenda-json').value = JSON.stringify(agenda);
    });
</script>
@endsection