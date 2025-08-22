@extends('layouts.app')

@section('content')
<main class="app-main">
    <!-- Header -->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h3 class="mb-0">Perhitungan AHP Kriteria</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('operator.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('operator.kriteria.index') }}">Kriteria</a></li>
                        <li class="breadcrumb-item active">Perhitungan AHP</li>
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

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i> Terjadi kesalahan:
                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="bi bi-calculator me-2"></i> Matriks Perbandingan Kriteria</h4>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('operator.kriteria.hitungAHP') }}" method="POST" id="ahpForm">
                        @csrf
                        <div class="table-responsive">
                            <table class="table table-bordered text-center align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>Kriteria</th>
                                        @foreach($kriterias as $k)
                                            <th>{{ $k->nama }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($kriterias as $i => $k1)
                                        <tr>
                                            <td class="fw-bold">{{ $k1->nama }}</td>
                                            @foreach($kriterias as $j => $k2)
                                                <td>
                                                    @if($i == $j)
                                                        <select class="form-select text-center" disabled>
                                                            <option value="1" selected>1</option>
                                                        </select>
                                                        <input type="hidden" name="matriks[{{ $i }}][{{ $j }}]" value="1">
                                                    @else
                                                        <select name="matriks[{{ $i }}][{{ $j }}]"
                                                                class="form-select ahp-select text-center"
                                                                data-row="{{ $i }}" data-col="{{ $j }}">
                                                            <option value="">-- pilih --</option>
                                                            @for($v = 1; $v <= 9; $v++)
                                                                <option value="{{ $v }}"
                                                                    @if(old("matriks.$i.$j", session("form_ahp.$i.$j")) == $v) selected @endif>
                                                                    {{ $v }}
                                                                </option>
                                                            @endfor
                                                        </select>
                                                    @endif
                                                </td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-3">
                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-save me-1"></i> Simpan
                            </button>
                            <button type="button" class="btn btn-secondary" id="resetBtn">
                                <i class="bi bi-arrow-counterclockwise me-1"></i> Reset
                            </button>
                            <a href="{{ route('operator.kriteria.index') }}" class="btn btn-danger">
                                <i class="bi bi-x-circle me-1"></i> Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</main>
@endsection

@section('scripts')
<script>
    // Sinkronisasi nilai (inverse)
    document.querySelectorAll('.ahp-select').forEach(function(select) {
        select.addEventListener('change', function() {
            let row = this.dataset.row;
            let col = this.dataset.col;
            let val = parseInt(this.value);

            if (row !== col && val) {
                let inverseSelect = document.querySelector('select[data-row="'+col+'"][data-col="'+row+'"]');
                if (inverseSelect) {
                    inverseSelect.value = (10 - val); // contoh logika skala 1–9 ↔ 9–1
                }
            }
        });
    });

    // Tombol reset
    document.getElementById('resetBtn').addEventListener('click', function() {
        document.querySelectorAll('.ahp-select').forEach(function(s) {
            s.value = "";
        });
    });
</script>
@endsection
