@extends('layouts.app')

@section('content')
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h3 class="mb-0">Tambah Kelas</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('operator.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('operator.kelas.index') }}">Kelas</a></li>
                        <li class="breadcrumb-item active">Tambah Kelas</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">
            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-body">
                    <form id="form-simpan" action="{{ route('operator.kelas.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nama Kelas</label>
                            <input type="text" name="nama_kelas" class="form-control" placeholder="Contoh: XII RPL 1" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Jurusan</label>
                            <input type="text" name="jurusan" class="form-control" placeholder="Contoh: Rekayasa Perangkat Lunak">
                        </div>
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-success" id="btn-simpan">
                                <i class="bi bi-save-fill me-1"></i> Simpan
                            </button>
                            <a href="{{ route('operator.kelas.index') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left-circle me-1"></i> Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>


@endsection
