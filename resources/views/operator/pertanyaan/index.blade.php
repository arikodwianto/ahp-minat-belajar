@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Daftar Pertanyaan</h2>
    <a href="{{ route('pertanyaan.create') }}" class="btn btn-primary">Tambah Pertanyaan</a>
    <table class="table table-bordered mt-3">
        <tr>
            <th>Kriteria</th>
            <th>Pertanyaan</th>
            <th>Aksi</th>
        </tr>
        @foreach($pertanyaans as $p)
        <tr>
            <td>{{ $p->kriteria->nama }}</td>
            <td>{{ $p->teks }}</td>
            <td>
                <a href="{{ route('pertanyaan.edit',$p->id) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('pertanyaan.destroy',$p->id) }}" method="POST" style="display:inline">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger" onclick="return confirm('Hapus pertanyaan ini?')">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</div>
@endsection
