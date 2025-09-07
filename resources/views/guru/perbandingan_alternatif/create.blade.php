@extends('layouts.base')

@section('content')
<main class="app-main">
    <!-- Header -->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h3 class="mb-0">Perbandingan Alternatif Siswa: {{ $siswa->nama }}</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('guru.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('perbandingan_alternatif.index') }}">Perbandingan</a></li>
                        <li class="breadcrumb-item active">Alternatif</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="app-content">
        <div class="container-fluid">

            <!-- Alert Success -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Card Form Perbandingan -->
            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="bi bi-graph-up me-2"></i> Form Perbandingan Alternatif</h4>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('perbandingan_alternatif.store', $siswa->id) }}" method="POST">
                        @csrf

                        @foreach($kriterias as $kriteria)
                            <h5 class="mt-4 mb-3 text-primary">Kriteria: {{ $kriteria->nama }}</h5>
                            <div class="table-responsive mb-4">
                                <table class="table table-bordered table-striped align-middle text-center">
                                    <thead class="table-primary">
                                        <tr>
                                            <th>Alternatif A</th>
                                            <th>Alternatif B</th>
                                            <th>Nilai Perbandingan</th>
                                            <th>Pilihan</th>
                                            <th>Alasan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($alternatifs as $i => $alt1)
                                            @foreach($alternatifs as $j => $alt2)
                                                @if($i < $j)
                                                    @php
                                                        $existing = $perbandinganData[$kriteria->id][$alt1->id][$alt2->id] ?? null;
                                                    @endphp
                                                    <tr>
                                                        <td>{{ $alt1->nama }}</td>
                                                        <td>{{ $alt2->nama }}</td>
                                                        <td>
                                                            <select name="nilai[{{ $kriteria->id }}][{{ $alt1->id }}][{{ $alt2->id }}]" class="form-select" required>
                                                                @for($n = 1; $n <= 9; $n++)
                                                                    <option value="{{ $n }}" {{ (isset($existing['nilai']) && $existing['nilai'] == $n) ? 'selected' : '' }}>
                                                                        {{ $n }} -
                                                                        @switch($n)
                                                                            @case(1) Sama Penting @break
                                                                            @case(2) Mendekati Sedikit Lebih Penting @break
                                                                            @case(3) Sedikit Lebih Penting @break
                                                                            @case(4) Mendekati Lebih Penting @break
                                                                            @case(5) Lebih Penting @break
                                                                            @case(6) Mendekati Sangat Penting @break
                                                                            @case(7) Sangat Penting @break
                                                                            @case(8) Mendekati Mutlak Penting @break
                                                                            @case(9) Mutlak Penting @break
                                                                        @endswitch
                                                                    </option>
                                                                @endfor
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <select name="pilihan[{{ $kriteria->id }}][{{ $alt1->id }}][{{ $alt2->id }}]" class="form-select" required>
                                                                <option value="{{ $alt1->id }}" {{ (isset($existing['pilihan']) && $existing['pilihan'] == $alt1->id) ? 'selected' : '' }}>{{ $alt1->nama }}</option>
                                                                <option value="{{ $alt2->id }}" {{ (isset($existing['pilihan']) && $existing['pilihan'] == $alt2->id) ? 'selected' : '' }}>{{ $alt2->nama }}</option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control" 
                                                                name="alasan[{{ $kriteria->id }}][{{ $alt1->id }}][{{ $alt2->id }}]" 
                                                                placeholder="Masukkan alasan" 
                                                                value="{{ $existing['alasan'] ?? '' }}">
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endforeach

                        <!-- Button Submit dan Kembali -->
                        <div class="mt-4 d-flex justify-content-end gap-2">
                            <a href="{{ route('perbandingan_alternatif.index') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left me-1"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save me-1"></i> Simpan
                            </button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</main>
@endsection
