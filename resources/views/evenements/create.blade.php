@extends('layouts.master')

@section('content')
<div class="container">
    <h1>Créer un Événement</h1>

    <form action="{{ route('evenements.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="titre" class="form-label">Titre</label>
            <input type="text" name="titre" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="lieu" class="form-label">Lieu</label>
            <input type="text" name="lieu" class="form-control">
        </div>

        <div class="mb-3">
            <label for="date" class="form-label">Date</label>
            <input type="date" name="date" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" rows="3" class="form-control"></textarea>
        </div>
        <div class="mb-3">
    <label for="long_description" class="form-label">Description longue</label>
    <textarea name="long_description" rows="6" class="form-control"></textarea>
</div>


        <div class="mb-3">
            <label class="form-label">Agenda</label>
            <div id="agenda-builder">
                <!-- Jours dynamiques ici -->
            </div>
            <button type="button" class="btn btn-sm btn-outline-primary mt-2" onclick="addDay()">+ Ajouter un jour</button>
        </div>

        <input type="hidden" name="agenda" id="agenda-json">

        <button type="submit" class="btn btn-success">Créer</button>
    </form>
</div>
@endsection

@section('scripts')
<script>
    function addDay() {
    const dayName = prompt("Nom du jour (ex: Mardi, 17 Juin)");
    if (!dayName || document.querySelector(`[data-day="${dayName}"]`)) return;

    const container = document.createElement('div');
    container.classList.add('border', 'p-3', 'mb-3', 'position-relative');
    container.dataset.day = dayName;

    container.innerHTML = `
        <h5>${dayName}</h5>
        <button type="button" class="btn-close position-absolute top-0 end-0" aria-label="Supprimer" onclick="this.parentElement.remove()"></button>
        <div class="sessions"></div>
        <button type="button" class="btn btn-sm btn-secondary mt-2" onclick="addSession(this)">+ Ajouter une session</button>
    `;

    document.getElementById('agenda-builder').appendChild(container);
}


    function addSession(button) {
    const container = button.previousElementSibling;
    const time = prompt("Heure (ex: 3:30 - 4:30 p.m.)");
    const title = prompt("Titre de la session");
    if (!time || !title) return;

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
