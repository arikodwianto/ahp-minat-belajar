@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Hasil Perhitungan AHP</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Kriteria</th>
                <th>Bobot</th>
            </tr>
        </thead>
        <tbody>
            @foreach($hasil as $row)
                <tr>
                    <td>{{ $row->kriteria->nama }}</td>
                    <td>{{ number_format($row->bobot, 3) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
