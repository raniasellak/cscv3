<!-- appdash -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --orange-color: #FF6B00;
            --black-color: #000000;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
            color: #2c3e50;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

       

        
        
        /* Sidebar Styles */
        #sidebar {
            background: #2c2c2c;
        height: 100vh; /* Changez ceci de calc(100vh - 76px) à 100vh */
        position: fixed;
        left: 0;
        top: 0; /* Changez ceci de 76px à 0 */
        width: 280px;
        transition: all 0.3s ease;
        z-index: 1000;
        box-shadow: 4px 0 15px rgba(0, 0, 0, 0.1);
        overflow-y: auto;
        overflow-x: hidden;
        padding-top: 0; 
        }
        .sidebar-content {
        height: calc(100% - 76px); /* Hauteur totale moins la hauteur de la navbar */
        overflow-y: auto;
    }
        #sidebar.collapsed {
            width: 80px;
        }
        
        /* Scrollbar customization for sidebar */
        #sidebar::-webkit-scrollbar {
            width: 6px;
        }
        
        #sidebar::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
        }
        
        #sidebar::-webkit-scrollbar-thumb {
            background: linear-gradient(45deg, #ff6b35, #f7931e);
            border-radius: 10px;
        }
        
        #sidebar::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(45deg, #ff8c33, #ffb84d);
        }
        
        .sidebar-header {
            padding: 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            background: rgba(255, 255, 255, 0.05);
        }
        
        .logo-text {
            background: linear-gradient(45deg, #ff6b35, #f7931e);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-weight: 700;
            font-size: 1.4rem;
        }
        
        .user-profile {
            padding: 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            background: rgba(255, 255, 255, 0.03);
        }
        
        .user-avatar {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: linear-gradient(45deg, #ff6b35, #f7931e);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
        }
        
        
        .sidebar .nav-link {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            border-radius: 10px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            margin: 0;
        }

        .sidebar .nav-link::after {
            display: none;
        }
        
        .sidebar .nav-link:hover {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            transform: translateX(5px);
        }
        
        .sidebar .nav-link.active {
            background: linear-gradient(45deg, #ff6b35, #f7931e);
            color: white;
            box-shadow: 0 4px 15px rgba(255, 107, 53, 0.3);
        }
        
        .sidebar .nav-link i {
            font-size: 1.2rem;
            margin-right: 15px;
            width: 20px;
            text-align: center;
        }
        
        /* Main Content */
        .main-content {
            margin-left: 280px;
            margin-top: 76px;
            transition: all 0.3s ease;
            min-height: calc(100vh - 76px);
            flex: 1;
        }
        
        .main-content.expanded {
            margin-left: 80px;
        }
        
        .topbar {
            background: white;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .search-box {
            background: #f8f9fa;
            border: none;
            border-radius: 25px;
            padding: 10px 20px;
            width: 350px;
            outline: none;
        }
        
        .topbar-actions {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .notification-icon {
            position: relative;
            color: #6c757d;
            font-size: 1.3rem;
        }
        
        .notification-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background: #ff6b35;
            color: white;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            font-size: 0.7rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .toggle-btn {
            background: none;
            border: none;
            color: white;
            font-size: 1.3rem;
            cursor: pointer;
            padding: 5px;
            border-radius: 5px;
            transition: all 0.3s ease;
        }
        
        .toggle-btn:hover {
            background: rgba(255, 255, 255, 0.1);
        }
        
        /* Content Area */
        .content-area {
            padding: 20px;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            #sidebar {
                transform: translateX(-100%);
            }
            
            #sidebar.show {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0;
            }

            .search-box {
                width: 200px;
            }
        }
        
        /* Alert Customization */
        .alert {
            border-radius: 10px;
            border: none;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        
        .alert-success {
            background-color: #d4edda;
            color: #155724;
        }
        
        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
        }
        
        .alert-warning {
            background-color: #fff3cd;
            color: #856404;
        }
        
        .alert-info {
            background-color: #cce7ff;
            color: #004085;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    @include('partial.nav')   {{-- Nav principale --}}
    @include('partial.flash') 
    <!-- Sidebar -->
    <div id="sidebar" class="sidebar">
        <div class="sidebar-content">
        <div class="sidebar-header">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    
                <button class="toggle-btn" id="toggle-btn">
                    <i class="bi bi-list"></i>
                </button>
                    
                </div>
            </div>
        </div>
        
        <div class="user-profile">
            <div class="d-flex align-items-center">
                <div class="user-avatar me-3">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div class="sidebar-text">
                    <div class="text-white fw-semibold">{{ Auth::user()->name }}</div>
                    <small class="text-warning">Administrator</small>
                </div>
            </div>
        </div>
        
        <div class="nav-menu">
            <div class="nav-item">
                <a class="nav-link active" href="{{ route('admin.dashboard') }}">
                    <i class="bi bi-speedometer2"></i>
                    <span class="sidebar-text">Dashboard</span>
                </a>
            </div>
            <div class="nav-item">
                <a class="nav-link" href="/formations">
                    <i class="bi bi-grid-3x3-gap"></i>
                    <span class="sidebar-text">Formations</span>
                </a>
            </div>
            <div class="nav-item">
                <a class="nav-link" href="/formations/create">
                    <i class="bi bi-plus-circle"></i>
                    <span class="sidebar-text">Create Formation</span>
                </a>
            </div>
            <div class="nav-item">
                <a class="nav-link" href="/evenements">
                    <i class="bi bi-table"></i>
                    <span class="sidebar-text">Events</span>
                </a>
            </div>
            <div class="nav-item">
                <a class="nav-link" href="/evenements/create">
                    <i class="bi bi-plus-circle"></i>
                    <span class="sidebar-text">Create Event</span>
                </a>
            </div>
            <div class="nav-item">
                <a class="nav-link" href="/members">
                    <i class="bi bi-geo-alt"></i>
                    <span class="sidebar-text">Gestion des membres</span>
                </a>
            </div>
            <div class="nav-item">
                <a class="nav-link" href="/members/create">
                    <i class="bi bi-bar-chart"></i>
                    <span class="sidebar-text">Ajouter des membres</span>
                </a>
            </div>
            <div class="nav-item">
                <a class="nav-link" href="{{ route('admin.products.create') }}">
                    <i class="bi bi-bag-plus"></i>
                    <span class="sidebar-text">Ajouter un produit</span>
                </a>
            </div>

              <div class="nav-item">
                <a class="nav-link" href="/products">
                    <i class="bi bi-bag-plus"></i>
                    <span class="sidebar-text">Gestion des produits</span>
                </a>
            </div>
            <div class="nav-item">
                <a class="nav-link" href="{{ route('admin.newsletter') }}">
                    <i class="bi bi-envelope-paper"></i>
                    <span class="sidebar-text">Newsletter</span>
                </a>
            </div>
            <div class="nav-item">
                <a class="nav-link" href="/">
                    <i class="bi bi-list-nested"></i>
                    <span class="sidebar-text">Acceuil</span>
                </a>
            </div>
        </div></div>
    </div>

    <!-- Main Content -->
    <div class="main-content" id="main-content">
       
        <!-- Content Area -->
        <div class="content-area">
            <!-- Flash Messages -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('warning'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-circle me-2"></i>
                    {{ session('warning') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('info'))
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    <i class="bi bi-info-circle me-2"></i>
                    {{ session('info') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

           

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    <strong>Veuillez corriger les erreurs suivantes :</strong>
                    <ul class="mb-0 mt-2">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
            @yield('main')
        </div>
    </div>

    <!-- Logout Form -->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
    @include('partial.footer')  {{-- Footer --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const toggleBtn = document.getElementById('toggle-btn');
            const mainContent = document.getElementById('main-content');
            const sidebarTexts = document.querySelectorAll('.sidebar-text');

            toggleBtn.addEventListener('click', function() {
                sidebar.classList.toggle('collapsed');
                mainContent.classList.toggle('expanded');
                
                if (sidebar.classList.contains('collapsed')) {
                    sidebarTexts.forEach(text => {
                        text.style.display = 'none';
                    });
                } else {
                    setTimeout(() => {
                        sidebarTexts.forEach(text => {
                            text.style.display = 'inline';
                        });
                    }, 150);
                }
            });

            // Mobile responsive
            if (window.innerWidth <= 768) {
                sidebar.classList.add('collapsed');
                mainContent.classList.add('expanded');
            }

            // Auto-hide alerts after 5 seconds
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                setTimeout(() => {
                    if (alert && alert.classList.contains('show')) {
                        alert.classList.remove('show');
                    }
                }, 5000);
            });
        });
    </script>
</body>
</html>