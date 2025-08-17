@extends('layouts.app')

@section('content')
<main class="app-main">
    <div class="container-fluid">
        <h3>Hasil Perhitungan Bobot Kriteria (AHP)</h3>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Kriteria</th>
                    <th>Bobot</th>
                </tr>
            </thead>
            <tbody>
                @foreach($kriterias as $i => $k)
                    <tr>
                        <td>{{ $k->nama }}</td>
                        <td>{{ number_format($bobot[$i], 4) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <a href="{{ route('operator.kriteria.ahp') }}" class="btn btn-secondary mt-2">Kembali</a>
    </div>
</main>
@endsection