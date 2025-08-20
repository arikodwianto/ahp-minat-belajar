@extends('layouts.app')

@section('content')
<main class="app-main">
    <!-- Header -->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h3 class="mb-0">Tambah Kriteria</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('operator.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('operator.kriteria.index') }}">Kriteria</a></li>
                        <li class="breadcrumb-item active">Tambah</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="app-content">
        <div class="container-fluid">

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i> Terjadi kesalahan:
                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="bi bi-plus-circle me-2"></i> Form Tambah Kriteria</h4>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('operator.kriteria.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Kriteria</label>
                            <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukkan nama kriteria" required>
                        </div>
                        <button type="submit" class="btn btn-success" id="btn-simpan">
                            <i class="bi bi-save me-1"></i> Simpan
                        </button>
                        <a href="{{ route('operator.kriteria.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left-circle me-1"></i> Kembali
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
