@extends('layouts.base')

@section('content')
<main class="app-main">
    <!-- Header -->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h3 class="mb-0">Hasil Perhitungan AHP</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('guru.dashboard') }}">Home</a></li>
                        
                        <li class="breadcrumb-item active">Hasil Perhitungan</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="app-content">
        <div class="container-fluid">

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="bi bi-bar-chart-line me-2"></i> Bobot Kriteria</h4>
                </div>
                <div class="card-body p-4">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped text-center align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Kriteria</th>
                                    <th>Bobot</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($hasil as $row)
                                    <tr>
                                        <td class="fw-bold">{{ $row->kriteria->nama }}</td>
                                        <td>{{ number_format($row->bobot, 3) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-3">
                        <a href="{{ route('operator.kriteria.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left-circle me-1"></i> Kembali
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</main>
@endsection
