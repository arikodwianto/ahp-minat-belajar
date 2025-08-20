@extends('layouts.app')

@section('content')
<main class="app-main">
    <!-- Header -->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h3 class="mb-0">Daftar Kriteria</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('operator.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Kriteria</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="app-content">
        <div class="container-fluid">

        
            <!-- Tombol Tambah Kriteria di luar card -->
            <div class="mb-3">
                <a href="{{ route('operator.kriteria.create') }}" class="btn btn-success">
                    <i class="bi bi-plus-circle me-1"></i> Tambah Kriteria
                </a>
            </div>

            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="bi bi-list-check me-2"></i> Data Kriteria</h4>
                </div>
                <div class="card-body p-3">
                    @if ($kriterias->count())
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover align-middle" id="dataTable">
                                <thead class="table-primary">
                                    <tr>
                                        <th>No</th>
                                        <th>Kode</th>
                                        <th>Nama Kriteria</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kriterias as $index => $kriteria)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $kriteria->kode }}</td>
                                            <td>{{ $kriteria->nama }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('operator.kriteria.edit', $kriteria->id) }}" class="btn btn-sm btn-warning mb-1">
                                                    <i class="bi bi-pencil-square"></i> 
                                                </a>
                                                <form action="{{ route('operator.kriteria.destroy', $kriteria->id) }}" method="POST" class="d-inline form-hapus" >
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
                        <p class="text-center mb-0">Belum ada data kriteria.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
