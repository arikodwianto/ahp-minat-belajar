@extends('layouts.app')

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
                        <li class="breadcrumb-item"><a href="{{ route('operator.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('operator.kriteria.perbandingan.index') }}">Perbandingan Kriteria</a></li>
                        <li class="breadcrumb-item active">Hasil Perhitungan</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="app-content">
        <div class="container-fluid">

            <!-- Alert -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Card Bobot Kriteria -->
            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="bi bi-bar-chart-line-fill me-2"></i> Bobot Kriteria</h4>
                </div>
                <div class="card-body p-3">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover align-middle text-center">
                            <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>Kriteria</th>
                                    <th>Bobot</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($bobotKriteria as $index => $row)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td class="fw-bold">{{ $row['kriteria'] }}</td>
                                        <td>{{ number_format($row['bobot'], 4) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="text-right mt-3">
                        <a href="{{ route('operator.kriteria.perbandingan.index') }}" class="btn btn-secondary px-4">
                            <i class="bi bi-arrow-left-circle"></i> Kembali
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</main>
@endsection
