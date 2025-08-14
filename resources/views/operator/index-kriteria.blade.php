@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Daftar Kriteria</h1>

    <a href="{{ route('operator.kriteria.create') }}" class="btn btn-primary mb-3">Tambah Kriteria</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode</th>
                <th>Nama Kriteria</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($kriterias as $index => $kriteria)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $kriteria->kode }}</td>
                    <td>{{ $kriteria->nama }}</td>
                    <td>
                        <a href="{{ route('operator.kriteria.edit', $kriteria->id) }}" class="btn btn-sm btn-warning">Edit</a>

                        <form action="{{ route('operator.kriteria.destroy', $kriteria->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin dihapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">Belum ada kriteria.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
