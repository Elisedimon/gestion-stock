<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Stock - ALL SOLUTION TECH</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');

        * { box-sizing: border-box; }

        body {
            background-color: #f0f2f5;
            font-family: 'Poppins', sans-serif;
            margin: 0;
        }

        /* ─── SIDEBAR ─── */
        .sidebar {
            width: 250px;
            min-height: 100vh;
            background: linear-gradient(180deg, #1a237e, #283593);
            position: fixed;
            top: 0; left: 0;
            z-index: 1040;
            padding-top: 20px;
            transition: transform 0.3s ease;
        }

        .sidebar .brand {
            color: white;
            text-align: center;
            padding: 15px;
            border-bottom: 1px solid rgba(255,255,255,0.2);
            margin-bottom: 20px;
        }

        .sidebar .brand h5 { margin: 0; font-weight: 700; font-size: 14px; letter-spacing: 1px; }
        .sidebar .brand p  { margin: 0; font-size: 11px; opacity: 0.7; }

        .sidebar .nav-link {
            color: rgba(255,255,255,0.8) !important;
            padding: 11px 20px;
            border-radius: 8px;
            margin: 3px 10px;
            transition: all 0.25s;
            font-size: 0.88rem;
            font-weight: 500;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background: rgba(255,255,255,0.2);
            color: white !important;
        }

        .sidebar .nav-link i { width: 20px; margin-right: 10px; }

        .nav-section-title {
            color: rgba(255,255,255,0.4);
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 10px 20px 5px;
        }

        /* ─── OVERLAY (mobile) ─── */
        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.5);
            z-index: 1039;
        }

        .sidebar-overlay.show { display: block; }

        /* ─── TOPBAR MOBILE ─── */
        .topbar-mobile {
            display: none;
            background: linear-gradient(135deg, #1a237e, #283593);
            padding: 12px 16px;
            position: fixed;
            top: 0; left: 0; right: 0;
            z-index: 1030;
            align-items: center;
            justify-content: space-between;
        }

        .topbar-mobile .brand-name {
            color: white;
            font-weight: 700;
            font-size: 0.95rem;
            letter-spacing: 0.5px;
        }

        .btn-hamburger {
            background: rgba(255,255,255,0.15);
            border: none;
            color: white;
            width: 38px;
            height: 38px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: background 0.2s;
        }

        .btn-hamburger:hover { background: rgba(255,255,255,0.25); }

        /* ─── MAIN CONTENT ─── */
        .main-content {
            margin-left: 250px;
            padding: 20px;
            min-height: 100vh;
        }

        .navbar-top {
            background: white;
            padding: 15px 25px;
            border-radius: 12px;
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.07);
        }

        .card-header {
            background: white;
            border-bottom: 1px solid #f0f0f0;
            border-radius: 12px 12px 0 0 !important;
            padding: 15px 20px;
            font-weight: 600;
        }

        .btn-primary { background: #1a237e; border-color: #1a237e; }
        .btn-primary:hover { background: #283593; border-color: #283593; }

        .table th {
            background: #f8f9fa;
            font-weight: 600;
            font-size: 13px;
        }

        .badge-stock-ok  { background: #e8f5e9; color: #2e7d32; }
        .badge-stock-low { background: #ffebee; color: #c62828; }

        /* ─── RESPONSIVE ─── */
        @media (max-width: 768px) {

            /* Cacher le sidebar par défaut sur mobile */
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.open {
                transform: translateX(0);
            }

            /* Afficher la topbar mobile */
            .topbar-mobile {
                display: flex;
            }

            /* Décaler le contenu principal */
            .main-content {
                margin-left: 0;
                padding: 80px 12px 20px 12px; /* espace pour la topbar fixe */
            }

            .navbar-top {
                padding: 12px 15px;
                border-radius: 10px;
            }

            /* Cards stats en colonne */
            .stats-grid {
                grid-template-columns: 1fr 1fr !important;
                gap: 12px !important;
            }

            /* Tableaux scrollables */
            .table-responsive {
                font-size: 0.82rem;
            }

            /* Boutons plus compacts */
            .btn { font-size: 0.82rem; padding: 6px 12px; }

            /* Texte titre topbar */
            .navbar-top h6 { font-size: 0.9rem; }
        }

        @media (max-width: 480px) {
            .main-content {
                padding: 72px 10px 20px 10px;
            }

            .stats-grid {
                grid-template-columns: 1fr 1fr !important;
            }
        }
    </style>
</head>
<body>

    {{-- ═══ TOPBAR MOBILE (hamburger) ═══ --}}
    <div class="topbar-mobile" id="topbarMobile">
        <button class="btn-hamburger" id="btnHamburger" onclick="toggleSidebar()">
            <i class="fas fa-bars" id="hamburgerIcon"></i>
        </button>
        <span class="brand-name">GESTION STOCK</span>
        <div class="d-flex align-items-center gap-1">
            <i class="fas fa-user-circle text-white" style="font-size:1.2rem;"></i>
            <span class="text-white small">{{ Auth::user()->name }}</span>
        </div>
    </div>

    {{-- ═══ OVERLAY ═══ --}}
    <div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>

    {{-- ═══ SIDEBAR ═══ --}}
    <div class="sidebar" id="sidebar">
        <div class="brand">
            <i class="fas fa-boxes fa-2x text-white mb-2"></i>
            <h5>GESTION STOCK</h5>
            <p>ALL SOLUTION TECH</p>
        </div>
        <nav>
            <div class="nav-section-title">Principal</div>
            <a href="{{ route('dashboard') }}"
               class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
               onclick="closeSidebarOnMobile()">
                <i class="fas fa-tachometer-alt"></i> Tableau de bord
            </a>

            <div class="nav-section-title">Gestion</div>
            <a href="{{ route('produits.index') }}"
               class="nav-link {{ request()->routeIs('produits.*') ? 'active' : '' }}"
               onclick="closeSidebarOnMobile()">
                <i class="fas fa-box"></i> Produits
            </a>
            <a href="{{ route('categories.index') }}"
               class="nav-link {{ request()->routeIs('categories.*') ? 'active' : '' }}"
               onclick="closeSidebarOnMobile()">
                <i class="fas fa-tags"></i> Catégories
            </a>
            <a href="{{ route('fournisseurs.index') }}"
               class="nav-link {{ request()->routeIs('fournisseurs.*') ? 'active' : '' }}"
               onclick="closeSidebarOnMobile()">
                <i class="fas fa-truck"></i> Fournisseurs
            </a>

            <div class="nav-section-title">Mouvements</div>
            <a href="{{ route('entrees.index') }}"
               class="nav-link {{ request()->routeIs('entrees.*') ? 'active' : '' }}"
               onclick="closeSidebarOnMobile()">
                <i class="fas fa-arrow-circle-down text-success"></i> Entrées Stock
            </a>
            <a href="{{ route('sorties.index') }}"
               class="nav-link {{ request()->routeIs('sorties.*') ? 'active' : '' }}"
               onclick="closeSidebarOnMobile()">
                <i class="fas fa-arrow-circle-up text-danger"></i> Sorties Stock
            </a>

            <div class="nav-section-title">Compte</div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="nav-link btn btn-link w-100 text-start">
                    <i class="fas fa-sign-out-alt"></i> Déconnexion
                </button>
            </form>
        </nav>
    </div>

    {{-- ═══ CONTENU PRINCIPAL ═══ --}}
    <div class="main-content">

        {{-- Topbar desktop --}}
        <div class="navbar-top d-none d-md-flex">
            <h6 class="mb-0 fw-bold">@yield('titre', 'Tableau de bord')</h6>
            <div class="d-flex align-items-center gap-2">
                <i class="fas fa-user-circle fa-lg text-secondary"></i>
                <span class="text-secondary small">{{ Auth::user()->name }}</span>
            </div>
        </div>

        {{-- Titre page sur mobile --}}
        <div class="d-md-none mb-3">
            <h6 class="fw-bold mb-0" style="color:#1a237e;">@yield('titre', 'Tableau de bord')</h6>
        </div>

        {{-- Alertes --}}
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

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function toggleSidebar() {
            const sidebar  = document.getElementById('sidebar');
            const overlay  = document.getElementById('sidebarOverlay');
            const icon     = document.getElementById('hamburgerIcon');
            const isOpen   = sidebar.classList.contains('open');

            sidebar.classList.toggle('open');
            overlay.classList.toggle('show');
            icon.className = isOpen ? 'fas fa-bars' : 'fas fa-times';
        }

        function closeSidebarOnMobile() {
            if (window.innerWidth <= 768) {
                const sidebar = document.getElementById('sidebar');
                const overlay = document.getElementById('sidebarOverlay');
                const icon    = document.getElementById('hamburgerIcon');
                sidebar.classList.remove('open');
                overlay.classList.remove('show');
                icon.className = 'fas fa-bars';
            }
        }

        // Fermer le sidebar si on redimensionne vers desktop
        window.addEventListener('resize', () => {
            if (window.innerWidth > 768) {
                document.getElementById('sidebar').classList.remove('open');
                document.getElementById('sidebarOverlay').classList.remove('show');
                document.getElementById('hamburgerIcon').className = 'fas fa-bars';
            }
        });
    </script>

    @stack('scripts')
</body>
</html>
