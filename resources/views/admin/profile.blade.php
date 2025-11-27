<!DOCTYPE html>
<html lang="sw">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - Mfumo wa Usimamizi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .sidebar {
            background: #2c3e50;
            min-height: 100vh;
            color: white;
        }
        .sidebar .nav-link {
            color: #ecf0f1;
            padding: 15px 20px;
            border-bottom: 1px solid #34495e;
        }
        .sidebar .nav-link:hover {
            background: #34495e;
            color: #3498db;
        }
        .sidebar .nav-link.active {
            background: #3498db;
            color: white;
        }
        .main-content {
            background: #ecf0f1;
            min-height: 100vh;
        }
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 sidebar p-0">
                <div class="p-3 text-center border-bottom">
                    <h4 class="mb-0">Mfumo wa Usimamizi</h4>
                    <small class="text-muted">Administrator</small>
                </div>
                <nav class="nav flex-column">
                    <a class="nav-link" href="{{ route('admin.dashboard') }}">
                        <i class="fas fa-tachometer-alt me-2"></i>Dashibodi
                    </a>
                    <a class="nav-link active" href="{{ route('admin.profile') }}">
                        <i class="fas fa-user me-2"></i>Wasifu Wangu
                    </a>
                    <a class="nav-link" href="{{ route('admin.settings') }}">
                        <i class="fas fa-cog me-2"></i>Mipangilio
                    </a>
                    <a class="nav-link" href="{{ route('admin.system-info') }}">
                        <i class="fas fa-info-circle me-2"></i>Taarifa za Mfumo
                    </a>
                    <form method="POST" action="{{ route('admin.logout') }}" class="nav-link">
                        @csrf
                        <button type="submit" class="btn btn-link text-danger p-0 border-0 text-start w-100">
                            <i class="fas fa-sign-out-alt me-2"></i>Toka
                        </button>
                    </form>
                </nav>
            </div>

            <!-- Main Content -->
            <div class="col-md-9 col-lg-10 main-content p-0">
                <!-- Top Navigation -->
                <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
                    <div class="container-fluid">
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav ms-auto">
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                                        <i class="fas fa-user-circle me-1"></i>{{ auth()->user()->name }}
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="{{ route('admin.profile') }}">Wasifu Wangu</a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li>
                                            <form method="POST" action="{{ route('admin.logout') }}">
                                                @csrf
                                                <button type="submit" class="dropdown-item text-danger">Toka</button>
                                            </form>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>

                <!-- Page Content -->
                <div class="container-fluid p-4">
                    <div class="row mb-4">
                        <div class="col-12">
                            <h2 class="mb-0"><i class="fas fa-user me-2"></i>Wasifu Wangu</h2>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashibodi</a></li>
                                    <li class="breadcrumb-item active">Wasifu</li>
                                </ol>
                            </nav>
                        </div>
                    </div>

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

                    <div class="row">
                        <!-- Profile Information -->
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header bg-primary text-white">
                                    <h5 class="mb-0"><i class="fas fa-user-edit me-2"></i>Taarifa za Wasifu</h5>
                                </div>
                                <div class="card-body">
                                    <form method="POST" action="{{ route('admin.profile.update') }}">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="name" class="form-label">Jina Kamili</label>
                                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $admin->name) }}" required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="email" class="form-label">Barua Pepe</label>
                                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $admin->email) }}" required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="phone" class="form-label">Namba ya Simu</label>
                                                <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $admin->phone) }}">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="address" class="form-label">Anwani</label>
                                                <input type="text" class="form-control" id="address" name="address" value="{{ old('address', $admin->address) }}">
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="bio" class="form-label">Maelezo Mafupi</label>
                                            <textarea class="form-control" id="bio" name="bio" rows="3">{{ old('bio', $admin->bio) }}</textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-save me-2"></i>Hifadhi Mabadiliko
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Password Change -->
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header bg-warning text-dark">
                                    <h5 class="mb-0"><i class="fas fa-lock me-2"></i>Badilisha Nenosiri</h5>
                                </div>
                                <div class="card-body">
                                    <form method="POST" action="{{ route('admin.profile.password') }}">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="current_password" class="form-label">Nenosiri la Sasa</label>
                                            <input type="password" class="form-control" id="current_password" name="current_password" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="new_password" class="form-label">Nenosiri Jipya</label>
                                            <input type="password" class="form-control" id="new_password" name="new_password" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="new_password_confirmation" class="form-label">Thibitisha Nenosiri Jipya</label>
                                            <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" required>
                                        </div>
                                        <button type="submit" class="btn btn-warning w-100">
                                            <i class="fas fa-key me-2"></i>Badilisha Nenosiri
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>