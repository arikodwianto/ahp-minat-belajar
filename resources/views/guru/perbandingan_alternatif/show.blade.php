@extends('layouts.base')

@section('content')
<main class="app-main">
    <!-- Header -->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h3 class="mb-0">Hasil Perbandingan Alternatif: {{ $siswa->nama }}</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('guru.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('perbandingan_alternatif.index') }}">Perbandingan Alternatif</a></li>
                       <li class="breadcrumb-item active">{{ $siswa->nama }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="app-content">
        <div class="container-fluid">

            @foreach($kriterias as $kriteria)
                <div class="card shadow-sm border-0 rounded-4 mb-4">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0"><i class="bi bi-list-check me-2"></i>Kriteria: {{ $kriteria->nama }}</h4>
                    </div>
                    <div class="card-body p-4">

                        <!-- Tabel Perbandingan -->
                        <div class="table-responsive mb-4">
                            <table class="table table-bordered table-striped table-hover align-middle">
                                <thead class="table-primary">
                                    <tr>
                                        <th>Alternatif A</th>
                                        <th>Alternatif B</th>
                                        <th>Nilai</th>
                                        <th>Pilihan</th>
                                        <th>Alasan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($alternatifs as $i => $alt1)
                                        @foreach($alternatifs as $j => $alt2)
                                            @if($i < $j)
                                                @php
                                                    $p = $perbandingans
                                                        ->where('kriteria_id', $kriteria->id)
                                                        ->where('alternatif1_id', $alt1->id)
                                                        ->where('alternatif2_id', $alt2->id)
                                                        ->first();
                                                @endphp
                                                @if($p)
                                                    <tr>
                                                        <td>{{ $alt1->nama }}</td>
                                                        <td>{{ $alt2->nama }}</td>
                                                        <td>{{ $p->nilai }}</td>
                                                        <td>{{ $p->pilihan == $alt1->id ? $alt1->nama : $alt2->nama }}</td>
                                                        <td>{{ $p->alasan ?? '-' }}</td>
                                                    </tr>
                                                @endif
                                            @endif
                                        @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Tabel Bobot AHP -->
                        @if(isset($hasilAHP[$kriteria->id]))
                            <h5 class="text-primary mb-2"><i class="bi bi-graph-up-arrow me-1"></i> Bobot Alternatif (AHP)</h5>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped align-middle">
                                    <thead class="table-secondary">
                                        <tr>
                                            <th>Alternatif</th>
                                            <th>Bobot</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($hasilAHP[$kriteria->id]['bobot'] as $alt_id => $bobot)
                                            @php
                                                $alt = $alternatifs->where('id', $alt_id)->first();
                                            @endphp
                                            <tr>
                                                <td>{{ $alt->nama }}</td>
                                                <td>{{ number_format($bobot, 4) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <p class="mt-2">Consistency Ratio (CR): <strong>{{ number_format($hasilAHP[$kriteria->id]['CR'], 4) }}</strong></p>
                             <canvas id="chartKriteria{{ $kriteria->id }}" width="400" height="200"></canvas>
                        @endif

                    </div>
                </div>
            @endforeach

            <!-- Button Cetak & Kembali -->
<div class="d-flex justify-content-end mt-3 gap-2">
   <a href="{{ route('perbandingan_alternatif.cetak', $siswa->id) }}" target="_blank" class="btn btn-success">
    <i class="bi bi-printer me-1"></i> Cetak PDF
</a>


    <a href="{{ route('perbandingan_alternatif.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left-circle me-1"></i> Kembali
    </a>
</div>


        </div>
    </div>
</main>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    @foreach($kriterias as $kriteria)
        const ctx{{ $kriteria->id }} = document.getElementById('chartKriteria{{ $kriteria->id }}').getContext('2d');
        const chart{{ $kriteria->id }} = new Chart(ctx{{ $kriteria->id }}, {
            type: 'bar', // bisa diganti 'pie' jika mau pie chart
            data: {
                labels: @json($alternatifs->pluck('nama')),
                datasets: [{
                    label: 'Bobot Alternatif',
                    data: @json(array_values($hasilAHP[$kriteria->id]['bobot'])),
                    backgroundColor: 'rgba(75, 192, 192, 0.6)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });
    @endforeach
</script>
@endsection
