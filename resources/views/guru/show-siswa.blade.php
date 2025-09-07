@extends('layouts.base')

@section('content')
<main class="app-main">
    <!-- Header -->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h3 class="mb-0">Detail Siswa</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('operator.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('operator.siswa.index') }}">Siswa</a></li>
                        <li class="breadcrumb-item active">{{ $siswa->nama }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="app-content">
        <div class="container-fluid">

            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="bi bi-person-lines-fill me-2"></i>Informasi Siswa</h4>
                </div>
                <div class="card-body p-4">

                    <!-- Data Pribadi -->
                    <h5 class="mb-3 text-primary"><i class="bi bi-person-fill me-1"></i> Data Pribadi</h5>
                    <div class="row mb-3">
                        <div class="col-md-6 mb-2">
                            <label class="form-label"><strong>NIS</strong></label>
                            <input type="text" class="form-control" value="{{ $siswa->nis }}" readonly>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="form-label"><strong>Nama</strong></label>
                            <input type="text" class="form-control" value="{{ $siswa->nama }}" readonly>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="form-label"><strong>Jenis Kelamin</strong></label>
                            <input type="text" class="form-control" value="{{ $siswa->jenis_kelamin }}" readonly>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="form-label"><strong>Tanggal Lahir</strong></label>
                            <input type="text" class="form-control" value="{{ $siswa->tanggal_lahir }}" readonly>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="form-label"><strong>Tempat Lahir</strong></label>
                            <input type="text" class="form-control" value="{{ $siswa->tempat_lahir }}" readonly>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="form-label"><strong>Agama</strong></label>
                            <input type="text" class="form-control" value="{{ $siswa->agama }}" readonly>
                        </div>
                        <div class="col-12 mb-2">
                            <label class="form-label"><strong>Alamat</strong></label>
                            <textarea class="form-control" rows="2" readonly>{{ $siswa->alamat }}</textarea>
                        </div>
                    </div>

                    <hr>

                    <!-- Kontak -->
                    <h5 class="mb-3 text-primary"><i class="bi bi-telephone-fill me-1"></i> Kontak</h5>
                    <div class="row mb-3">
                        <div class="col-md-6 mb-2">
                            <label class="form-label"><strong>Telepon</strong></label>
                            <input type="text" class="form-control" value="{{ $siswa->telepon ?? '-' }}" readonly>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="form-label"><strong>Email</strong></label>
                            <input type="text" class="form-control" value="{{ $siswa->email ?? '-' }}" readonly>
                        </div>
                    </div>

                    <hr>

                    <!-- Pendidikan -->
                    <h5 class="mb-3 text-primary"><i class="bi bi-building me-1"></i> Pendidikan</h5>
                    <div class="row mb-3">
                        <div class="col-md-6 mb-2">
                            <label class="form-label"><strong>Kelas</strong></label>
                            <input type="text" class="form-control" value="{{ $siswa->kelas->nama_kelas }}@if($siswa->kelas->jurusan) ({{ $siswa->kelas->jurusan }})@endif" readonly>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="form-label"><strong>Tahun Masuk</strong></label>
                            <input type="text" class="form-control" value="{{ $siswa->tahun_masuk ?? '-' }}" readonly>
                        </div>
                        <div class="col-12 mb-2">
                            <label class="form-label"><strong>Sekolah Asal</strong></label>
                            <input type="text" class="form-control" value="{{ $siswa->sekolah_asal ?? '-' }}" readonly>
                        </div>
                    </div>

                    <!-- Button Kembali -->
                    <div class="d-flex justify-content-end mt-4">
                        <a href="{{ route('guru.siswa.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left-circle me-1"></i> Kembali
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </div>
</main>
@endsection
