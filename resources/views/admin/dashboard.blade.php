@extends('layouts.master')

@section('title', 'Dashboard Admin')


@section('content')
<div class="d-flex">
    <!-- Sidebar -->
    <div id="sidebar" class="bg-dark text-white" style="width: 250px; min-height: 100vh; transition: all 0.3s ease;">
        <div class="d-flex align-items-center p-3 border-bottom">
            <div class="me-2">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" width="40" class="me-2">
            </div>
            <h5 class="m-0 text-gradient sidebar-text">KaiAdmin</h5>
            <button id="toggle-btn" class="btn text-white ms-auto">
                <i class="bi bi-list"></i>
            </button>
        </div>
        
        <div class="p-2">
            <div class="d-flex align-items-center p-3 mb-3">
                <div class="avatar me-3">
                    <img src="{{ asset('images/avatar.jpg') }}" alt="User" class="rounded-circle" width="40">
                </div>
                <div class="sidebar-text">
                    <div class="fw-bold">Hi, {{ Auth::user()->name }}</div>
                    <small class="text-muted">Admin</small>
                </div>
            </div>
            
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link active d-flex align-items-center py-3 px-3 rounded mb-1" href="#">
                        <i class="bi bi-speedometer2 me-3"></i>
                        <span class="sidebar-text">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white-50 d-flex align-items-center py-3 px-3 rounded mb-1" href="/formations">
                        <i class="bi bi-grid me-3"></i>
                        <span class="sidebar-text">Formations</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white-50 d-flex align-items-center py-3 px-3 rounded mb-1" href="/formations/create">
                        <i class="bi bi-layout-sidebar me-3"></i>
                        <span class="sidebar-text">Create Formation</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white-50 d-flex align-items-center py-3 px-3 rounded mb-1" href="#">
                        <i class="bi bi-ui-checks me-3"></i>
                        <span class="sidebar-text">Forms</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white-50 d-flex align-items-center py-3 px-3 rounded mb-1" href="#">
                        <i class="bi bi-table me-3"></i>
                        <span class="sidebar-text">Tables</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white-50 d-flex align-items-center py-3 px-3 rounded mb-1" href="#">
                        <i class="bi bi-geo-alt me-3"></i>
                        <span class="sidebar-text">Maps</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white-50 d-flex align-items-center py-3 px-3 rounded mb-1" href="#">
                        <i class="bi bi-bar-chart me-3"></i>
                        <span class="sidebar-text">Charts</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white-50 d-flex align-items-center py-3 px-3 rounded mb-1" href="#">
                        <i class="bi bi-widget me-3"></i>
                        <span class="sidebar-text">Widgets</span>
                        <span class="badge bg-success rounded-pill ms-auto">4</span>
                    </a>
                </li>
               <li class="nav-item">
    <a href="{{ route('admin.products.create') }}" class="nav-link text-white-50 d-flex align-items-center py-3 px-3 rounded mb-1">
        <i class="bi bi-plus-circle me-3"></i>
        <span class="sidebar-text">Ajouter un produit</span>
    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white-50 d-flex align-items-center py-3 px-3 rounded mb-1" href="#">
                        <i class="bi bi-list-nested me-3"></i>
                        <span class="sidebar-text">Menu Levels</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <!-- Main Content -->
    <div class="flex-grow-1">
        <!-- Top Navbar -->
        <div class="bg-white shadow-sm d-flex justify-content-between align-items-center p-3">
            <div class="d-flex">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0">
                        <i class="bi bi-search text-muted"></i>
                    </span>
                    <input type="text" class="form-control border-start-0" placeholder="Search...">
                </div>
            </div>
            <div class="d-flex align-items-center">
                <a href="#" class="text-muted me-3 position-relative">
                    <i class="bi bi-envelope fs-5"></i>
                </a>
                <a href="#" class="text-muted me-3 position-relative">
                    <i class="bi bi-bell fs-5"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        2
                    </span>
                </a>
                <a href="#" class="text-muted me-3">
                    <i class="bi bi-list-task fs-5"></i>
                </a>
                <div class="dropdown">
                    <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ asset('images/avatar.jpg') }}" alt="User" class="rounded-circle" width="32" height="32">
                        <span class="ms-2">Hi, {{ Auth::user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <li><a class="dropdown-item" href="#"><i class="bi bi-person me-2"></i> Profile</a></li>
                        <li><a class="dropdown-item" href="#"><i class="bi bi-gear me-2"></i> Settings</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}" 
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                               <i class="bi bi-box-arrow-right me-2"></i> Sign Out
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Dashboard Content -->
        <div class="p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h3 class="mb-1">Dashboard</h3>
                    <p class="text-muted">Free Bootstrap 5 Admin Dashboard</p>
                </div>
                <div>
                    <button class="btn btn-light me-2">Manage</button>
                    <button class="btn btn-primary">Add Customer</button>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="row g-3 mb-4">
                <div class="col-md-3">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body p-3">
                            <div class="d-flex">
                                <div class="bg-primary text-white p-3 rounded me-3">
                                    <i class="bi bi-people fs-4"></i>
                                </div>
                                <div>
                                    <div class="text-muted">Visitors</div>
                                    <h3 class="mb-0">1,294</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body p-3">
                            <div class="d-flex">
                                <div class="bg-info text-white p-3 rounded me-3">
                                    <i class="bi bi-person-check fs-4"></i>
                                </div>
                                <div>
                                    <div class="text-muted">Subscribers</div>
                                    <h3 class="mb-0">1303</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body p-3">
                            <div class="d-flex">
                                <div class="bg-success text-white p-3 rounded me-3">
                                    <i class="bi bi-cash-stack fs-4"></i>
                                </div>
                                <div>
                                    <div class="text-muted">Sales</div>
                                    <h3 class="mb-0">$ 1,345</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body p-3">
                            <div class="d-flex">
                                <div class="bg-purple text-white p-3 rounded me-3" style="background-color: #6f42c1;">
                                    <i class="bi bi-check-circle fs-4"></i>
                                </div>
                                <div>
                                    <div class="text-muted">Order</div>
                                    <h3 class="mb-0">576</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts Section -->
            <div class="row g-3">
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-3">
                                <h5 class="card-title">User Statistics</h5>
                                <div>
                                    <button class="btn btn-sm btn-light me-2">Export</button>
                                    <button class="btn btn-sm btn-light"><i class="bi bi-printer"></i> Print</button>
                                </div>
                            </div>
                            <div style="height: 300px; position: relative;">
                                <!-- This would be replaced with an actual chart library -->
                                <div class="text-center py-5 text-muted">
                                    <p>Chart Placeholder - Use Chart.js, ApexCharts, etc.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card bg-primary text-white border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-3">
                                <h5 class="card-title">Daily Sales</h5>
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-primary dropdown-toggle" type="button" id="exportDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                        Export
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="exportDropdown">
                                        <li><a class="dropdown-item" href="#">PDF</a></li>
                                        <li><a class="dropdown-item" href="#">Excel</a></li>
                                        <li><a class="dropdown-item" href="#">CSV</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="mb-3">
                                <small>March 25 - April 02</small>
                                <h2 class="display-5 fw-bold">$4,578.58</h2>
                            </div>
                            <div style="height: 120px; position: relative;">
                                <!-- This would be a small chart -->
                                <div class="text-center text-white-50">
                                    <small>Chart Placeholder</small>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <h4>17</h4>
                                <div class="text-success">+5%</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>

<style>
    .nav-link.active {
        background-color: rgba(255, 255, 255, 0.1);
        color: white !important;
    }
    
    .nav-link {
        color: rgba(255, 255, 255, 0.7);
        transition: all 0.3s;
    }
    
    .nav-link:hover {
        background-color: rgba(255, 255, 255, 0.05);
        color: white;
    }
    
    .text-gradient {
        background: linear-gradient(45deg, #6f42c1, #007bff);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    
    .bg-purple {
        background-color: #6f42c1;
    }
</style>

<!-- Script JS -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sidebar = document.getElementById('sidebar');
        const toggleBtn = document.getElementById('toggle-btn');
        const sidebarText = document.querySelectorAll('.sidebar-text');
        const mainContent = document.querySelector('.flex-grow-1');

        toggleBtn.addEventListener('click', () => {
            if (sidebar.style.width === '250px' || sidebar.style.width === '') {
                sidebar.style.width = '80px';
                sidebarText.forEach(text => text.style.display = 'none');
                mainContent.style.marginLeft = '80px';
            } else {
                sidebar.style.width = '250px';
                setTimeout(() => {
                    sidebarText.forEach(text => text.style.display = 'block');
                }, 150);
                mainContent.style.marginLeft = '250px';
            }
        });
    });
</script>
@endsection