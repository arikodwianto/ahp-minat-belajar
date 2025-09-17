@extends('layouts.base')

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
                    <h3 class="fw-bold mb-2">Dashboard Guru</h3>
                    <p class="fs-5 mb-0 text-muted">
                        Selamat datang kembali, <strong>{{ auth()->user()->name }}</strong>!  
                        Anda login sebagai <span class="text-success fw-semibold">Guru</span>.
                    </p>
                </div>

                <!-- Tombol Aksi -->
                <div class="d-flex flex-column flex-md-row gap-2 ms-auto">
                    <a href="{{ route('guru.profile.edit') }}" class="btn btn-primary btn-lg px-4">
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
<div class="row mb-4">
    <div class="col-12">
        <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#statistikCollapse" aria-expanded="false" aria-controls="statistikCollapse">
            Tampilkan Statistik
        </button>

        <div class="collapse mt-3" id="statistikCollapse">
            <div class="row g-3">
                

                <div class="col-lg-3 col-6">
                    <div class="small-box text-bg-success shadow rounded">
                        <div class="inner">
                            <h3>{{ $jumlahSiswa }}</h3>
                            <p>Jumlah Siswa</p>
                        </div>
                        <i class="bi bi-people-fill small-box-icon"></i>
                        <a href="{{ route('operator.siswa.index') }}" class="small-box-footer link-light">
                            Lihat Detail <i class="bi bi-arrow-right-circle"></i>
                        </a>
                    </div>
                </div>

                

                <div class="col-lg-3 col-6">
                    <div class="small-box text-bg-danger shadow rounded">
                        <div class="inner">
                            <h3>{{ $jumlahKriteria }}</h3>
                            <p>Jumlah Kriteria</p>
                        </div>
                        <i class="bi bi-list-check small-box-icon"></i>
                        <a href="{{ route('operator.kriteria.index') }}" class="small-box-footer link-light">
                            Lihat Detail <i class="bi bi-arrow-right-circle"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box text-bg-info shadow rounded">
                        <div class="inner">
                            <h3>{{ $jumlahAlternatif }}</h3>
                            <p>Jumlah Alternatif</p>
                        </div>
                        <i class="bi bi-shuffle small-box-icon"></i>
                        <a href="{{ route('perbandingan_alternatif.hasil-siswa') }}" class="small-box-footer link-light">
                            Lihat Detail <i class="bi bi-arrow-right-circle"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</main>
@endsection
