<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'Laravel Maps App')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <style>
        /* ==============================
           Paleta personalizada
        =============================== */
        :root {
            --primary-color: #4db6e5; /* Azul claro */
            --secondary-color: #9ee493; /* Verde claro */
            --text-color: #1a1a1a;
            --hover-color: #37a8c2;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            color: var(--text-color);
        }

        /* Navbar */
        .navbar {
            background-color: var(--primary-color) !important;
        }

        .navbar-brand, .nav-link {
            color: #fff !important;
            font-weight: 500;
            transition: color 0.3s;
        }

        .navbar-brand:hover, .nav-link:hover {
            color: var(--secondary-color) !important;
        }

        /* Botões */
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        .btn-primary:hover {
            background-color: var(--hover-color);
            border-color: var(--hover-color);
        }

        .btn-outline-secondary {
            color: var(--secondary-color);
            border-color: var(--secondary-color);
        }
        .btn-outline-secondary:hover {
            background-color: var(--secondary-color);
            color: #fff;
        }

        /* Mapa */
        #map {
            height: 500px;
            width: 100%;
            border-radius: 8px;
            border: 2px solid var(--primary-color);
        }

        /* Cards */
        .card {
            border-radius: 10px;
            border: 1px solid #e1e1e1;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        }

        .card-header {
            background-color: var(--primary-color);
            color: #fff;
            font-weight: bold;
        }

        /* List group items */
        .location-card {
            transition: transform 0.2s, background-color 0.3s;
            border-left: 5px solid var(--secondary-color);
        }
        .location-card:hover {
            transform: translateY(-2px);
            background-color: #f0fdfa;
        }

        /* Alerts */
        .alert-success {
            background-color: var(--secondary-color);
            color: #fff;
            border: none;
        }
        .alert-danger {
            background-color: #f28b82;
            color: #fff;
            border: none;
        }

        /* Botão de ação principal */
.btn-primary {
    background-color: var(--primary-color);
    border-color: var(--primary-color);
    transition: all 0.3s ease-in-out;
}
.btn-primary:hover {
    background-color: var(--hover-color);
    border-color: var(--hover-color);
}

/* Botão de destaque secundário */
.btn-warning {
    background-color: var(--secondary-color);
    border-color: var(--secondary-color);
    color: #fff;
}
.btn-warning:hover {
    background-color: #7ccf78;
    border-color: #7ccf78;
}

/* Botão de contorno secundário */
.btn-outline-secondary {
    color: var(--primary-color);
    border-color: var(--primary-color);
}
.btn-outline-secondary:hover {
    background-color: var(--primary-color);
    color: #fff;
}

/* Botão de contorno de alerta (excluir) */
.btn-outline-danger {
    color: #f06262;
    border-color: #f06262;
}
.btn-outline-danger:hover {
    background-color: #f06262;
    color: #fff;
}

/* Botão pequeno */
.btn-sm {
    font-size: 0.85rem;
    padding: 6px 12px;
}

/* Destaque nos badges */
.badge.bg-secondary {
    background-color: var(--secondary-color) !important;
    color: #fff;
    font-weight: 500;
}

    </style>

    @yield('styles')
</head>
<body>
    <!-- Navegação -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="{{ route('locations.index') }}">
                <i class="fas fa-map-marker-alt me-2"></i>
                Laravel Maps App
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('locations.index') }}">
                            <i class="fas fa-list me-1"></i>Locais
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('locations.create') }}">
                            <i class="fas fa-plus me-1"></i>Adicionar Local
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Conteúdo Principal -->
    <main class="container my-4">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    @yield('scripts')
</body>
</html>
