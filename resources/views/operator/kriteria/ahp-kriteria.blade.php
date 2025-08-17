@extends('layouts.app')

@section('content')
<main class="app-main">
    <div class="container-fluid">
        <h3>Perhitungan Bobot Kriteria (Metode AHP - Saaty)</h3>
        <form action="{{ route('operator.kriteria.hitung-ahp') }}" method="POST">
            @csrf
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Kriteria</th>
                        @foreach($kriterias as $k)
                            <th>{{ $k->nama }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach($kriterias as $i => $k)
                    <tr>
                        <td>{{ $k->nama }}</td>
                        @foreach($kriterias as $j => $k2)
                            <td>
                                <input type="number" step="0.01" name="matriks[{{ $i }}][{{ $j }}]" 
                                       value="{{ $matriks[$i][$j] ?? 1 }}" class="form-control" required>
                            </td>
                        @endforeach
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <button class="btn btn-primary mt-2">Hitung Bobot</button>
        </form>
    </div>
</main>
@endsection
