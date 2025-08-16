@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tambah Kelas</h2>
    <form action="{{ route('operator.kelas.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Nama Kelas</label>
            <input type="text" name="nama_kelas" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Jurusan</label>
            <input type="text" name="jurusan" class="form-control">
        </div>
        <button class="btn btn-success">Simpan</button>
        <a href="{{ route('operator.kelas.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
