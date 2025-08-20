@extends('layouts.app')

@section('content')
<main class="app-main">
    <!-- Header -->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h3 class="mb-0">Dashboard</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end mb-0">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="app-content">
        <div class="container-fluid">
<!-- Card Profil Guru -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card shadow-lg border-0 rounded-3">
            <div class="card-body p-4 d-flex align-items-center flex-wrap">

                <!-- Icon / Foto Profil -->
                <div class="me-4 mb-3 mb-md-0 text-center">
                    <i class="bi bi-person-circle text-primary" style="font-size: 6rem;"></i>
                </div>

                <!-- Info Guru -->
               <div class="flex-grow-1">
    <h3 class="fw-bold mb-2">Dashboard Operator</h3>
    <p class="fs-5 mb-0 text-muted">
        Selamat datang kembali, <strong>{{ auth()->user()->name }}</strong>!  
        Anda login sebagai <span class="text-success fw-semibold">Operator</span>.
    </p>
    <p class="mt-2 text-primary fw-semibold" id="tanggal-jam"></p>
</div>




                <!-- Tombol Aksi -->
                <div class="d-flex flex-column flex-md-row gap-2 ms-auto">
                    <a href="{{ route('profile.edit') }}" class="btn btn-primary btn-lg px-4">
                        <i class="bi bi-person-lines-fill me-2"></i> Lihat Profil
                    </a>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger btn-lg px-4">
                            <i class="bi bi-box-arrow-right me-2"></i> Keluar
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

           <!-- Statistik -->
<div class="row g-3">
    <!-- Guru -->
    <div class="col-lg-3 col-6">
        <div class="small-box text-bg-primary shadow rounded">
            <div class="inner">
                <h3>{{ $jumlahGuru }}</h3>
                <p>Jumlah Guru</p>
            </div>
            <i class="bi bi-person-badge small-box-icon"></i>
            <a href="{{ route('operator.guru.index') }}" class="small-box-footer link-light">
                Lihat Detail <i class="bi bi-arrow-right-circle"></i>
            </a>
        </div>
    </div>

    <!-- Siswa -->
    <div class="col-lg-3 col-6">
        <div class="small-box text-bg-success shadow rounded">
            <div class="inner">
                <h3>{{ $jumlahSiswa }}</h3>
                <p>Jumlah Siswa</p>
            </div>
            <i class="bi bi-people small-box-icon"></i>
            <a href="{{ route('operator.siswa.index') }}" class="small-box-footer link-light">
                Lihat Detail <i class="bi bi-arrow-right-circle"></i>
            </a>
        </div>
    </div>

    <!-- Kelas -->
    <div class="col-lg-3 col-6">
        <div class="small-box text-bg-warning shadow rounded">
            <div class="inner">
                <h3>{{ $jumlahKelas }}</h3>
                <p>Jumlah Kelas</p>
            </div>
            <i class="bi bi-building small-box-icon"></i>
            <a href="{{ route('operator.kelas.index') }}" class="small-box-footer link-dark">
                Lihat Detail <i class="bi bi-arrow-right-circle"></i>
            </a>
        </div>
    </div>

    <!-- Kriteria -->
    <div class="col-lg-3 col-6">
        <div class="small-box text-bg-danger shadow rounded">
            <div class="inner">
                <h3>{{ $jumlahKriteria }}</h3>
                <p>Jumlah Kriteria</p>
            </div>
            <i class="bi bi-diagram-3-fill small-box-icon"></i>
            <a href="{{ route('operator.kriteria.index') }}" class="small-box-footer link-light">
                Lihat Detail <i class="bi bi-arrow-right-circle"></i>
            </a>
        </div>
    </div>
</div>

</main>
<script>
    function updateDateTime() {
        const now = new Date();

        // Format tanggal Indonesia
        const optionsTanggal = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        const tanggal = now.toLocaleDateString('id-ID', optionsTanggal);

        // Format jam:menit:detik
        const jam = now.toLocaleTimeString('id-ID', { hour12: false });

        document.getElementById('tanggal-jam').textContent = `${tanggal} | ${jam}`;
    }

    setInterval(updateDateTime, 1000);
    updateDateTime();
</script>
@endsection
