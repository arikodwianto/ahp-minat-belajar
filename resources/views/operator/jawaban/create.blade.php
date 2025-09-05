@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tambah Jawaban</h2>

    <form action="{{ route('jawaban.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="siswa_id">Siswa</label>
            <select name="siswa_id" id="siswa_id" class="form-control" required>
                @foreach($siswas as $siswa)
                    <option value="{{ $siswa->id }}">{{ $siswa->nama }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="pertanyaan_id">Pertanyaan</label>
            <select name="pertanyaan_id" id="pertanyaan_id" class="form-control" required>
                @foreach($pertanyaans as $pertanyaan)
                    <option value="{{ $pertanyaan->id }}">{{ $pertanyaan->teks }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="nilai">Nilai (1–5)</label>
            <input type="number" name="nilai" id="nilai" class="form-control" required min="1" max="5">
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('jawaban.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
