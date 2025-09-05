@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Isi Kuisioner untuk {{ $siswa->nama }}</h2>
    <form action="{{ route('kuisioner.simpan',$siswa->id) }}" method="POST">
        @csrf
        @foreach($pertanyaans as $p)
            <div class="mb-3">
                <label><strong>{{ $p->teks }}</strong></label>
                @foreach($p->jawabans as $j)
                    <div class="form-check">
                        <input type="radio" name="jawaban[{{ $p->id }}]" value="{{ $j->id }}" class="form-check-input">
                        <label class="form-check-label">{{ $j->teks }} (nilai: {{ $j->nilai }})</label>
                    </div>
                @endforeach
            </div>
        @endforeach
        <button class="btn btn-success">Simpan Jawaban</button>
    </form>
</div>
@endsection
