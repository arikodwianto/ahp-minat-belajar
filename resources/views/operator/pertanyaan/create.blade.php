@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tambah Pertanyaan</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pertanyaan.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="kriteria_id" class="form-label">Kriteria</label>
            <select name="kriteria_id" id="kriteria_id" class="form-control" required>
                <option value="">-- Pilih Kriteria --</option>
                @foreach($kriterias as $kriteria)
                    <option value="{{ $kriteria->id }}">{{ $kriteria->nama }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="teks" class="form-label">Pertanyaan</label>
            <textarea name="teks" id="teks" class="form-control" rows="3" required>{{ old('teks') }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('pertanyaan.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
