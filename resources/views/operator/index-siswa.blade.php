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

            <!-- Tombol Tambah Siswa -->
            <div class="mb-3">
                <a href="{{ route('operator.siswa.create') }}" class="btn btn-success">
                    <i class="bi bi-plus-circle me-1"></i> Tambah Siswa
                </a>
            </div>

            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="bi bi-people-fill me-2"></i> Data Siswa</h4>
                </div>
                <div class="card-body p-3">
                    @if($siswas->count())
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
                                    @foreach($siswas as $index => $siswa)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $siswa->nama }}</td>
                                            <td>{{ $siswa->nis }}</td>
                                            <td>{{ $siswa->jenis_kelamin }}</td>
                                            <td>{{ $siswa->kelas->nama_kelas }} @if($siswa->kelas->jurusan) ({{ $siswa->kelas->jurusan }}) @endif</td>

                                            <td>{{ $siswa->tahun_masuk ?? '-' }}</td>
                                            <td>{{ $siswa->sekolah_asal ?? '-' }}</td>
                                           <td class="">
    <!-- Tombol Edit -->
    <a href="{{ route('operator.siswa.edit', $siswa->id) }}" class="btn btn-sm btn-warning mb-1">
        <i class="bi bi-pencil-fill"></i> 
    </a>

    <!-- Tombol Hapus -->
    <form action="{{ route('operator.siswa.destroy', $siswa->id) }}" method="POST" class="d-inline form-hapus" >
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-danger mb-1">
            <i class="bi bi-trash-fill"></i>
        </button>
    </form>

    <!-- Tombol Detail -->
    <a href="{{ route('operator.siswa.show', $siswa->id) }}" class="btn btn-sm btn-info mb-1">
        <i class="bi bi-eye-fill"></i> 
    </a>
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
@endsection
