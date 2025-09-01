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
                                                        <input type="text" class="form-control text-center bg-light" value="1" readonly>
                                                        <input type="hidden" name="matriks[{{ $i }}][{{ $j }}]" value="1">
                                                    @elseif($i < $j)
                                                        <select name="matriks[{{ $i }}][{{ $j }}]"
                                                                class="form-select ahp-select text-center"
                                                                data-row="{{ $i }}" data-col="{{ $j }}">
                                                            <option value="">-- pilih --</option>
                                                            {{-- Skala Saaty 1–9 dan kebalikannya --}}
                                                            <option value="1" @selected(session("form_ahp.$i.$j") == 1)>1 Sama penting</option>
                                                            <option value="2" @selected(session("form_ahp.$i.$j") == 2)>2 Mendekati sedikit lebih penting</option>
                                                            <option value="3" @selected(session("form_ahp.$i.$j") == 3)>3 Sedikit lebih penting</option>
                                                            <option value="4" @selected(session("form_ahp.$i.$j") == 4)>4 Mendekati lebih penting</option>
                                                            <option value="5" @selected(session("form_ahp.$i.$j") == 5)>5 Lebih penting</option>
                                                            <option value="6" @selected(session("form_ahp.$i.$j") == 6)>6 Mendekati sangat penting</option>
                                                            <option value="7" @selected(session("form_ahp.$i.$j") == 7)>7 Sangat penting</option>
                                                            <option value="8" @selected(session("form_ahp.$i.$j") == 8)>8 Mendekati mutlak</option>
                                                            <option value="9" @selected(session("form_ahp.$i.$j") == 9)>9 Mutlak lebih penting</option>
                                                            <option value="0.5" @selected(session("form_ahp.$i.$j") == 0.5)>1/2</option>
                                                            <option value="0.3333" @selected(session("form_ahp.$i.$j") == 0.3333)>1/3</option>
                                                            <option value="0.25" @selected(session("form_ahp.$i.$j") == 0.25)>1/4</option>
                                                            <option value="0.2" @selected(session("form_ahp.$i.$j") == 0.2)>1/5</option>
                                                            <option value="0.1667" @selected(session("form_ahp.$i.$j") == 0.1667)>1/6</option>
                                                            <option value="0.1429" @selected(session("form_ahp.$i.$j") == 0.1429)>1/7</option>
                                                            <option value="0.125" @selected(session("form_ahp.$i.$j") == 0.125)>1/8</option>
                                                            <option value="0.1111" @selected(session("form_ahp.$i.$j") == 0.1111)>1/9</option>
                                                        </select>
                                                    @else
                                                        {{-- Bagian bawah akan diisi otomatis oleh JS --}}
                                                        <input type="text" 
                                                               class="form-control text-center bg-light reciprocal" 
                                                               name="matriks[{{ $i }}][{{ $j }}]" 
                                                               value="{{ session("form_ahp.$i.$j") }}" 
                                                               readonly>
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
    // Sinkronisasi nilai reciprocal
    document.querySelectorAll('.ahp-select').forEach(function(select) {
        select.addEventListener('change', function() {
            let row = this.dataset.row;
            let col = this.dataset.col;
            let val = parseFloat(this.value);

            if (row !== col && val) {
                let reciprocalInput = document.querySelector('input[name="matriks['+col+']['+row+']"]');
                if (reciprocalInput) {
                    reciprocalInput.value = (1 / val).toFixed(4);
                }
            }
        });
    });

    // Tombol reset
    document.getElementById('resetBtn').addEventListener('click', function() {
        document.querySelectorAll('.ahp-select').forEach(function(s) {
            s.value = "";
        });
        document.querySelectorAll('.reciprocal').forEach(function(inp) {
            inp.value = "";
        });
    });
</script>
@endsection
