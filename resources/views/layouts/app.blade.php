<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart-Hub Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .sidebar {
            min-height: 100vh;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .sidebar a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
        }

        .sidebar a:hover {
            color: white;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 8px;
        }

        .sidebar .active {
            color: white;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 8px;
        }

        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        }

        .stat-card {
            border-radius: 12px;
            color: white;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2 sidebar p-3">
                <div class="text-center mb-4 mt-2">
                    <h5 class="text-white fw-bold">
                        <i class="fas fa-hub"></i> Smart-Hub
                    </h5>
                    <small class="text-white-50">Management System</small>
                </div>
                <hr class="text-white-50">
                <nav class="nav flex-column gap-1">
                    <a href="{{ route('dashboard') }}"
                        class="nav-link px-3 py-2 {{ request()->is('dashboard') ? 'active' : '' }}">
                        <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                    </a>
                    <a href="/equipment"
                        class="nav-link px-3 py-2 {{ request()->is('equipment*') ? 'active' : '' }}">
                        <i class="fas fa-camera me-2"></i> Peralatan
                    </a>
                    <a href="/borrowing"
                        class="nav-link px-3 py-2 {{ request()->is('borrowing*') ? 'active' : '' }}">
                        <i class="fas fa-clipboard-list me-2"></i> Peminjaman
                    </a>
                </nav>
                <hr class="text-white-50">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-outline-light btn-sm w-100">
                        <i class="fas fa-sign-out-alt me-2"></i> Logout
                    </button>
                </form>
            </div>

            <!-- Main Content -->
            <div class="col-md-10 p-4">
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                @endif

                @yield('content')
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>