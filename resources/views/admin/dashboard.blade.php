@extends('layouts.appdash')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">
    <!-- Page Title -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <div>
            <span class="text-muted">{{ \Carbon\Carbon::now()->format('l, d F Y') }}</span>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row g-4 mb-4">
        <!-- Total Users Card -->
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 me-3">
                            <div class="bg-primary bg-gradient p-3 rounded-circle">
                                <i class="bi bi-people text-white fs-4"></i>
                            </div>
                        </div>
                        <div>
                            <h6 class="card-title mb-1">Total Membres</h6>
                            <h2 class="mb-0 fw-bold">{{ \App\Models\User::count() }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Products Card -->
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 me-3">
                            <div class="bg-success bg-gradient p-3 rounded-circle">
                                <i class="bi bi-box-seam text-white fs-4"></i>
                            </div>
                        </div>
                        <div>
                            <h6 class="card-title mb-1">Total Produits</h6>
                            <h2 class="mb-0 fw-bold">{{ \App\Models\Product::count() }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Events Card -->
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 me-3">
                            <div class="bg-warning bg-gradient p-3 rounded-circle">
                                <i class="bi bi-calendar-event text-white fs-4"></i>
                            </div>
                        </div>
                        <div>
                            <h6 class="card-title mb-1">Total Événements</h6>
                            <h2 class="mb-0 fw-bold">{{ \App\Models\Evenement::count() }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Formations Card -->
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 me-3">
                            <div class="bg-info bg-gradient p-3 rounded-circle">
                                <i class="bi bi-mortarboard text-white fs-4"></i>
                            </div>
                        </div>
                        <div>
                            <h6 class="card-title mb-1">Total Formations</h6>
                            <h2 class="mb-0 fw-bold">{{ \App\Models\Formation::count() }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="row g-4 mb-4">
        <!-- Line Chart -->
        <div class="col-xl-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Statistiques Mensuelles</h5>
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-outline-secondary" onclick="updateChart('users')">Membres</button>
                        <button type="button" class="btn btn-sm btn-outline-secondary" onclick="updateChart('products')">Produits</button>
                        <button type="button" class="btn btn-sm btn-outline-secondary" onclick="updateChart('events')">Événements</button>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="monthlyStats" height="300"></canvas>
                </div>
            </div>
        </div>

        <!-- Doughnut Chart -->
        <div class="col-xl-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0">
                    <h5 class="card-title mb-0">Répartition des Formations</h5>
                </div>
                <div class="card-body">
                    <canvas id="formationDistribution" height="260"></canvas>
                    <div class="mt-3">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="d-flex align-items-center">
                                <span class="badge bg-primary me-2" style="width: 12px; height: 12px;"></span>
                                CyberSecurity
                            </span>
                            <span class="fw-bold">{{ \App\Models\Formation::where('category', 'CyberSecurity')->count() }} formations</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="d-flex align-items-center">
                                <span class="badge bg-success me-2" style="width: 12px; height: 12px;"></span>
                                Dev
                            </span>
                            <span class="fw-bold">{{ \App\Models\Formation::where('category', 'Dev')->count() }} formations</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="d-flex align-items-center">
                                <span class="badge bg-warning me-2" style="width: 12px; height: 12px;"></span>
                                AI
                            </span>
                            <span class="fw-bold">{{ \App\Models\Formation::where('category', 'AI')->count() }} formations</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity and Quick Actions -->
    <div class="row g-4">
        <!-- Recent Activity -->
        <div class="col-xl-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0">
                    <h5 class="card-title mb-0">Activités Récentes</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Action</th>
                                    <th>Description</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(\App\Models\User::latest()->take(5)->get() as $user)
                                <tr>
                                    <td>
                                        <span class="badge bg-info">Nouveau Membre</span>
                                    </td>
                                    <td>{{ $user->name }} a rejoint la plateforme</td>
                                    <td>{{ $user->created_at->diffForHumans() }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="col-xl-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0">
                    <h5 class="card-title mb-0">Actions Rapides</h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-3">
                        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-circle me-2"></i>Ajouter un Produit
                        </a>
                        <a href="/evenements/create" class="btn btn-success">
                            <i class="bi bi-calendar-plus me-2"></i>Créer un Événement
                        </a>
                        <a href="/formations/create" class="btn btn-info">
                            <i class="bi bi-mortarboard me-2"></i>Ajouter une Formation
                        </a>
                        <a href="/members/create" class="btn btn-warning">
                            <i class="bi bi-person-plus me-2"></i>Ajouter un Membre
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Auto-refresh dashboard data every 5 minutes
        setInterval(function() {
            location.reload();
        }, 300000);

        // Monthly Statistics Line Chart
        const monthlyStatsCtx = document.getElementById('monthlyStats').getContext('2d');
        const monthlyStatsChart = new Chart(monthlyStatsCtx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Jun', 'Jul', 'Aoû', 'Sep', 'Oct', 'Nov', 'Déc'],
                datasets: [{
                    label: 'Nouveaux Membres',
                    data: [65, 59, 80, 81, 56, 55, 40, 45, 60, 75, 85, 90],
                    fill: false,
                    borderColor: 'rgb(75, 192, 192)',
                    tension: 0.1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Évolution Mensuelle'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Formation Distribution Doughnut Chart
        const formationDistCtx = document.getElementById('formationDistribution').getContext('2d');
        const formationDistChart = new Chart(formationDistCtx, {
            type: 'doughnut',
            data: {
                labels: ['CyberSecurity', 'Dev', 'AI'],
                datasets: [{
                    data: [
                        {{ \App\Models\Formation::where('category', 'CyberSecurity')->count() }},
                        {{ \App\Models\Formation::where('category', 'Dev')->count() }},
                        {{ \App\Models\Formation::where('category', 'AI')->count() }}
                    ],
                    backgroundColor: [
                        'rgba(13, 110, 253, 0.8)',  // Bootstrap primary
                        'rgba(25, 135, 84, 0.8)',   // Bootstrap success
                        'rgba(255, 193, 7, 0.8)'    // Bootstrap warning
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                const percentage = Math.round((context.raw / total) * 100);
                                return `${context.label}: ${context.raw} (${percentage}%)`;
                            }
                        }
                    }
                },
                cutout: '65%'
            }
        });

        // Function to update chart data
        window.updateChart = function(dataType) {
            let newData;
            switch(dataType) {
                case 'users':
                    newData = [65, 59, 80, 81, 56, 55, 40, 45, 60, 75, 85, 90];
                    monthlyStatsChart.data.datasets[0].label = 'Nouveaux Membres';
                    monthlyStatsChart.data.datasets[0].borderColor = 'rgb(75, 192, 192)';
                    break;
                case 'products':
                    newData = [30, 45, 35, 50, 40, 35, 45, 55, 50, 60, 70, 75];
                    monthlyStatsChart.data.datasets[0].label = 'Nouveaux Produits';
                    monthlyStatsChart.data.datasets[0].borderColor = 'rgb(255, 99, 132)';
                    break;
                case 'events':
                    newData = [10, 15, 12, 18, 15, 20, 25, 22, 20, 25, 30, 28];
                    monthlyStatsChart.data.datasets[0].label = 'Événements';
                    monthlyStatsChart.data.datasets[0].borderColor = 'rgb(255, 205, 86)';
                    break;
            }
            monthlyStatsChart.data.datasets[0].data = newData;
            monthlyStatsChart.update();
        }
    });
</script>
@endsection