@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Jawaban</h2>

    <form action="{{ route('jawaban.update', $jawaban->id) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-3">
            <label>Pertanyaan</label>
            <select name="pertanyaan_id" class="form-control" required>
                @foreach($pertanyaans as $pertanyaan)
                    <option value="{{ $pertanyaan->id }}" {{ $jawaban->pertanyaan_id == $pertanyaan->id ? 'selected' : '' }}>
                        {{ $pertanyaan->teks }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Alternatif</label>
            <select name="alternatif_id" class="form-control" required>
                @foreach($alternatifs as $alternatif)
                    <option value="{{ $alternatif->id }}" {{ $jawaban->alternatif_id == $alternatif->id ? 'selected' : '' }}>
                        {{ $alternatif->nama }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Teks Jawaban</label>
            <input type="text" name="teks" class="form-control" value="{{ $jawaban->teks }}" required>
        </div>
        <div class="mb-3">
            <label>Nilai</label>
            <input type="number" name="nilai" class="form-control" value="{{ $jawaban->nilai }}" required min="1">
        </div>
        <button class="btn btn-primary">Update</button>
        <a href="{{ route('jawaban.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
