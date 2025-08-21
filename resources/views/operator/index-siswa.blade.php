@extends('layouts.app')

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

            <!-- Alerts -->
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Tombol Aksi -->
            <div class="mb-3 d-flex flex-wrap gap-2">
                <a href="{{ route('operator.siswa.template') }}" class="btn btn-primary">
                    <i class="bi bi-file-earmark-excel"></i> Download Template Excel
                </a>

                <!-- Tombol untuk buka modal -->
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#importModal">
                    <i class="bi bi-upload"></i> Import Excel
                </button>

                <a href="{{ route('operator.siswa.create') }}" class="btn btn-success">
                    <i class="bi bi-plus-circle me-1"></i> Tambah Siswa
                </a>
            </div>

            <!-- Modal Import Excel -->
            <div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ route('operator.siswa.import') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title" id="importModalLabel">Import Excel Siswa</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="file" class="form-label">Pilih file Excel (.xlsx/.xls/.csv)</label>
                                    <input type="file" name="file" class="form-control" id="file" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-success">Import</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Table Siswa -->
            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="bi bi-people-fill me-2"></i> Data Siswa</h4>
                </div>
                <div class="card-body p-3">
                    @if ($siswas->count())
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover align-middle" id="dataTable">
                                <thead class="table-primary">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>NIS</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Kelas</th>
                                        <th>Tahun Masuk</th>
                                        <th>Sekolah Asal</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($siswas as $index => $siswa)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $siswa->nama }}</td>
                                            <td>{{ $siswa->nis }}</td>
                                            <td>{{ $siswa->jenis_kelamin }}</td>
                                            <td>{{ $siswa->kelas->nama_kelas ?? '-' }} @if(isset($siswa->kelas->jurusan)) ({{ $siswa->kelas->jurusan }}) @endif</td>
                                            <td>{{ $siswa->tahun_masuk ?? '-' }}</td>
                                            <td>{{ $siswa->sekolah_asal ?? '-' }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('operator.siswa.show', $siswa->id) }}" class="btn btn-sm btn-info mb-1">
                                                    <i class="bi bi-eye-fill"></i>
                                                </a>
                                                <a href="{{ route('operator.siswa.edit', $siswa->id) }}" class="btn btn-sm btn-warning mb-1">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>
                                                <form action="{{ route('operator.siswa.destroy', $siswa->id) }}" method="POST" class="d-inline form-hapus">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger mb-1">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-center mb-0">Belum ada data siswa.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Bootstrap JS (untuk modal) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@endsection
