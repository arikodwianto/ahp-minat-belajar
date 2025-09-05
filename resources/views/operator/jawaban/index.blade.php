@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Daftar Jawaban</h2>
    <a href="{{ route('jawaban.create') }}" class="btn btn-primary mb-3">+ Tambah Jawaban</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Pertanyaan</th>
                <th>Jawaban</th>
                <th>Nilai</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($jawabans as $j)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $j->pertanyaan->teks }}</td>
                <td>{{ $j->teks }}</td>
                <td>{{ $j->nilai }}</td>
                <td>
                    <a href="{{ route('jawaban.edit', $j->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('jawaban.destroy', $j->id) }}" method="POST" style="display:inline-block;">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
