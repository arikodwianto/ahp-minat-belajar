@extends('layouts.app')

@section('content')
<main class="app-main">
    <!-- Header -->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h3 class="mb-0">Perbandingan Kriteria AHP</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('operator.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Perbandingan Kriteria</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="app-content">
        <div class="container-fluid">
            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="bi bi-sliders me-2"></i> Form Perbandingan Kriteria</h4>
                </div>
                <div class="card-body">
                    <form id="formPerbandingan" action="{{ route('operator.kriteria.perbandingan.simpan') }}" method="POST">
                        @csrf

                        <div class="table-responsive">
                            <table class="table table-bordered text-center align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th style="width: 40%">Kriteria 1</th>
                                        <th style="width: 20%">Nilai</th>
                                        <th style="width: 40%">Kriteria 2</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($kriteria as $i => $k1)
                                        @for($j = $i+1; $j < count($kriteria); $j++)
                                            @php
                                                $nilai = \App\Models\PerbandinganKriteria::where('kriteria1_id', $k1->id)
                                                    ->where('kriteria2_id', $kriteria[$j]->id)
                                                    ->value('nilai') ?? 1;

                                                $ahpLabels = [
                                                    1 => '1 - Sama pentingnya',
                                                    2 => '2 - Mendekati agak lebih penting',
                                                    3 => '3 - Agak lebih penting',
                                                    4 => '4 - Mendekati lebih penting',
                                                    5 => '5 - Lebih penting',
                                                    6 => '6 - Mendekati sangat penting',
                                                    7 => '7 - Sangat penting',
                                                    8 => '8 - Mendekati mutlak penting',
                                                    9 => '9 - Mutlak lebih penting',
                                                ];
                                            @endphp
                                            <tr>
                                                <td class="fw-bold">{{ $k1->nama }}</td>
                                                <td>
                                                    <select name="kriteria_{{ $k1->id }}_vs_{{ $kriteria[$j]->id }}" 
                                                            class="form-select">
                                                        @foreach($ahpLabels as $n => $label)
                                                            <option value="{{ $n }}"
                                                                {{ $n == old("kriteria_{$k1->id}_vs_{$kriteria[$j]->id}", $nilai) ? 'selected' : '' }}>
                                                                {{ $label }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td class="fw-bold">{{ $kriteria[$j]->nama }}</td>
                                            </tr>
                                        @endfor
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="text-center mt-4 d-flex justify-content-center gap-3">
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="bi bi-calculator"></i> Hitung AHP
                            </button>
                            <button type="button" class="btn btn-danger px-4" onclick="resetToDefault()">
                                <i class="bi bi-arrow-counterclockwise"></i> Reset
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    function resetToDefault() {
        document.querySelectorAll('#formPerbandingan select').forEach(function (el) {
            el.value = "1";
        });
    }
</script>
@endsection
