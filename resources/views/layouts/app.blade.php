<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Operator</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
        <div class="container">
            <a class="navbar-brand" href="{{ route('operator.dashboard') }}">Dashboard Operator</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <!-- Menu Guru -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('operator.guru.index') }}">Daftar Guru</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('operator.guru.create') }}">Tambah Guru</a>
                    </li>

                    <!-- Menu Kriteria -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('operator.kriteria.index') }}">Daftar Kriteria</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('operator.kriteria.create') }}">Tambah Kriteria</a>
                    </li>

                    <!-- Menu Siswa -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('operator.siswa.index') }}">Daftar Siswa</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('operator.siswa.create') }}">Tambah Siswa</a>
                    </li>
                </ul>

                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <span class="nav-link">Hello, {{ auth()->user()->name }}</span>
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-link nav-link" style="display:inline; padding:0; border:none;">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="container">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
