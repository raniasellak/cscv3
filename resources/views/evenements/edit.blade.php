@extends('layouts.master')

@section('content')
<div class="container">
    <h1>Modifier un Événement</h1>

<form action="{{ route('evenements.update', $evenement) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Champs classiques -->
        <div class="mb-3">
            <label for="titre" class="form-label">Titre</label>
            <input type="text" name="titre" class="form-control" value="{{ old('titre', $evenement->titre) }}" required>
        </div>
        <div class="mb-3">
            <label for="lieu" class="form-label">Lieu</label>
            <input type="text" name="lieu" class="form-control" value="{{ old('lieu', $evenement->lieu) }}">
        </div>
        <div class="mb-3">
            <label for="date" class="form-label">Date</label>
            <input type="date" name="date" class="form-control" value="{{ old('date', $evenement->date->format('Y-m-d')) }}" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">À propos</label>
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
        <p class="mt-2">Image actuelle :</p>
        <img src="{{ asset('storage/' . $evenement->image) }}" alt="Image actuelle" width="200">
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
    // On récupère l'agenda JSON depuis Blade (attention à bien échapper)
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
        container.classList.add('border', 'p-3', 'mb-3');
        container.dataset.day = dayName;

        container.innerHTML = `
            <div class="d-flex justify-content-between align-items-center">
                <h5>${dayName}</h5>
                <button type="button" class="btn btn-sm btn-danger" onclick="this.parentElement.parentElement.remove()">Supprimer le jour</button>
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
        session.classList.add('mb-2', 'd-flex', 'justify-content-between', 'align-items-center');
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
