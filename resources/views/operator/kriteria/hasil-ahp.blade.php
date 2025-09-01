@extends('layouts.app')

@section('content')
<main class="app-main">
    <div class="app-content-header">
        <h3 class="mb-0">Hasil Perhitungan AHP</h3>
    </div>
    <div class="app-content">
        <div class="container-fluid">

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="card">
                <div class="card-header bg-primary text-white">Bobot Kriteria</div>
                <div class="card-body">
                    <table class="table table-bordered text-center">
                        <thead>
                            <tr>
                                <th>Kriteria</th>
                                <th>Bobot</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bobotKriteria as $row)
                                <tr>
                                    <td>{{ $row['kriteria'] }}</td>
                                    <td>{{ $row['bobot'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <a href="{{ route('operator.kriteria.perbandingan.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </div>

        </div>
    </div>
</main>
@endsection
