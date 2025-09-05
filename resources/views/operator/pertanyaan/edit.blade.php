@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Pertanyaan</h2>

    <form action="{{ route('pertanyaan.update', $pertanyaan->id) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-3">
            <label>Kriteria</label>
            <select name="kriteria_id" class="form-control">
                @foreach($kriterias as $kriteria)
                    <option value="{{ $kriteria->id }}" {{ $pertanyaan->kriteria_id == $kriteria->id ? 'selected' : '' }}>
                        {{ $kriteria->nama }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Pertanyaan</label>
            <textarea name="teks" class="form-control" rows="3" required>{{ $pertanyaan->teks }}</textarea>
        </div>
        <button class="btn btn-primary">Update</button>
        <a href="{{ route('pertanyaan.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
