@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="col-md-10">
        <div class="card shadow-lg">
            <div class="card-header text-center">
                <h3>Perbandingan Kriteria AHP</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('operator.kriteria.perbandingan.simpan') }}" method="POST">
                    @csrf

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
                                    <tr>
                                        <!-- Kriteria 1 -->
                                        <td class="fw-bold">{{ $k1->nama }}</td>

                                        <!-- Dropdown nilai -->
                                        <td>
                                            <select name="kriteria_{{ $k1->id }}_vs_{{ $kriteria[$j]->id }}" 
                                                    class="form-select text-center">
                                                @for($n = 1; $n <= 9; $n++)
                                                    <option value="{{ $n }}" {{ $n == 1 ? 'selected' : '' }}>
                                                        {{ $n }}
                                                    </option>
                                                @endfor
                                            </select>
                                        </td>

                                        <!-- Kriteria 2 -->
                                        <td class="fw-bold ">{{ $kriteria[$j]->nama }}</td>
                                    </tr>
                                @endfor
                            @endforeach
                        </tbody>
                    </table>

                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bi bi-calculator"></i> Hitung AHP
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
