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
                <!-- Card 1 -->
                <div class="col-lg-3 col-6">
                    <div class="small-box text-bg-primary shadow rounded">
                        <div class="inner">
                            <h3>150</h3>
                            <p>New Orders</p>
                        </div>
                        <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M2.25 2.25a.75.75 0 000 1.5h1.386c..."></path>
                        </svg>
                        <a href="#" class="small-box-footer link-light">
                            More info <i class="bi bi-link-45deg"></i>
                        </a>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="col-lg-3 col-6">
                    <div class="small-box text-bg-success shadow rounded">
                        <div class="inner">
                            <h3>53<sup class="fs-5">%</sup></h3>
                            <p>Bounce Rate</p>
                        </div>
                        <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M18.375 2.25c-1.035 0-1.875.84..."></path>
                        </svg>
                        <a href="#" class="small-box-footer link-light">
                            More info <i class="bi bi-link-45deg"></i>
                        </a>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="col-lg-3 col-6">
                    <div class="small-box text-bg-warning shadow rounded">
                        <div class="inner">
                            <h3>44</h3>
                            <p>User Registrations</p>
                        </div>
                        <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M6.25 6.375a4.125 4.125 0 118.25..."></path>
                        </svg>
                        <a href="#" class="small-box-footer link-dark">
                            More info <i class="bi bi-link-45deg"></i>
                        </a>
                    </div>
                </div>

                <!-- Card 4 -->
                <div class="col-lg-3 col-6">
                    <div class="small-box text-bg-danger shadow rounded">
                        <div class="inner">
                            <h3>65</h3>
                            <p>Unique Visitors</p>
                        </div>
                        <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24">
                            <path clip-rule="evenodd" fill-rule="evenodd" d="M2.25 13.5a8.25..."></path>
                            <path clip-rule="evenodd" fill-rule="evenodd" d="M12.75 3a.75..."></path>
                        </svg>
                        <a href="#" class="small-box-footer link-light">
                            More info <i class="bi bi-link-45deg"></i>
                        </a>
                    </div>
                </div>
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
