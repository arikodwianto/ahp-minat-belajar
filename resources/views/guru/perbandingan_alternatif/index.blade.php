@extends('layouts.base')

@section('content')
<main class="app-main">
    <!-- Header -->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h3 class="mb-0">Daftar Siswa</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('operator.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Siswa</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="app-content">
        <div class="container-fluid">

            <!-- Card Daftar Siswa -->
            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="bi bi-people-fill me-2"></i> Siswa</h5>
                </div>
                <div class="card-body p-3">
                    @if ($siswas->count())
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover align-middle" id="dataTable">
                                <thead class="table-primary">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Siswa</th>
                                        <th>NIS</th>
                                        <th>Kelas</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($siswas as $index => $siswa)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $siswa->nama }}</td>
                                            <td>{{ $siswa->nis }}</td>
                                            <td>{{ $siswa->kelas->nama_kelas ?? '-' }} @if(isset($siswa->kelas->jurusan)) ({{ $siswa->kelas->jurusan }}) @endif</td>
                                            <td class="text-center">
                                                <a href="{{ route('perbandingan_alternatif.create', $siswa->id) }}" class="btn btn-primary btn-sm mb-1">
                                                    <i class="bi bi-pencil-square me-1"></i> Input Perbandingan
                                                </a>
                                                <a href="{{ route('perbandingan_alternatif.show', $siswa->id) }}" class="btn btn-success btn-sm mb-1">
                                                    <i class="bi bi-eye me-1"></i> Lihat Hasil
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-center mb-0">Belum ada siswa.</p>
                    @endif
                </div>
            </div>

        </div>
    </div>
</main>

<!-- Bootstrap JS (untuk modal, jika diperlukan) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@endsection
