@extends('layouts.app')

@section('content')
<main class="app-main">
    <!-- Header -->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h3 class="mb-0">Hasil Kecocokan Siswa</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end mb-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('guru.dashboard') }}">Home</a>
                        </li>
                      
                        <li class="breadcrumb-item active">Hasil Kecocokan</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="app-content">
        <div class="container-fluid">

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="bi bi-list-check me-2"></i> Data Hasil Kecocokan Siswa</h4>
                </div>

                <div class="card-body p-3">
                    <!-- Tombol Cetak PDF -->
                    <div class="mb-3">
                           <a href="{{ route('perbandingan_alternatif.cetak_pdf') }}" class="btn btn-success" target="_blank">
                            <i class="bi bi-printer me-1"></i> Cetak PDF
                        </a>
                    </div>

                  @foreach($alternatifs as $alternatif)
    <h5 class="mt-4">Alternatif: {{ $alternatif->nama }}</h5>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>NIS</th>
        <th>Jenis Kelamin</th>
        <th>Kelas</th>
        @foreach($alternatifs as $alt)
            <th>{{ $alt->nama }}</th>
        @endforeach
    </tr>
</thead>
<tbody>
    @forelse($siswaPerAlternatif[$alternatif->nama] as $index => $siswa)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $siswa->nama }}</td>
            <td>{{ $siswa->nis }}</td>
            <td>{{ $siswa->jenis_kelamin }}</td>
            <td>
                {{ $siswa->kelas->nama_kelas ?? '-' }}
                @if(isset($siswa->kelas->jurusan))
                    ({{ $siswa->kelas->jurusan }})
                @endif
            </td>
            @foreach($alternatifs as $alt)
                <td>{{ number_format($nilaiPerSiswa[$siswa->id][$alt->id] ?? 0, 4) }}</td>
            @endforeach
        </tr>
    @empty
        <tr>
            <td colspan="{{ 5 + $alternatifs->count() }}" class="text-center text-muted fst-italic">
                Belum ada siswa pada alternatif ini.
            </td>
        </tr>
    @endforelse
</tbody>

        </table>
    </div>
    
@endforeach


                    <h3>Diagram Bobot Alternatif</h3>
    <canvas id="chartAlternatif" width="400" height="200"></canvas>
                </div>
            </div>

        </div>
    </div>
</main>
<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('chartAlternatif').getContext('2d');
    const chartAlternatif = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json($chartLabels),
            datasets: [{
                label: 'Total Bobot Alternatif',
                data: @json($chartData),
                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
</script>
@endsection
