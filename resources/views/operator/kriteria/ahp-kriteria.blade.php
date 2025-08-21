@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Perhitungan AHP Kriteria</h3>
    <form action="{{ route('operator.kriteria.hitungAHP') }}" method="POST" id="ahpForm">
        @csrf
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Kriteria</th>
                    @foreach($kriterias as $k)
                        <th>{{ $k->nama }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach($kriterias as $i => $k1)
                    <tr>
                        <td>{{ $k1->nama }}</td>
                        @foreach($kriterias as $j => $k2)
                            <td>
                                <select name="matriks[{{ $i }}][{{ $j }}]" 
        class="form-select ahp-select" 
        data-row="{{ $i }}" 
        data-col="{{ $j }}">
    @if($i == $j)
        <option value="1" selected>1</option>
    @else
        @for($v=1; $v<=9; $v++)
            <option value="{{ $v }}"
                @if(old("matriks.$i.$j", session("form_ahp.$i.$j")) == $v) selected @endif>
                {{ $v }}
            </option>
        @endfor
    @endif
</select>

                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <button type="button" class="btn btn-secondary" id="resetBtn">Reset</button>
    </form>
</div>
@endsection

@section('scripts')
<script>
    // Seleksi otomatis (inverse)
    document.querySelectorAll('.ahp-select').forEach(function(select){
        select.addEventListener('change', function(){
            let row = this.dataset.row;
            let col = this.dataset.col;
            let val = parseFloat(this.value);
            if(row != col){
                let inverseSelect = document.querySelector('select[data-row="'+col+'"][data-col="'+row+'"]');
                inverseSelect.value = (val == 0) ? 0 : (1 / val).toFixed(2);
            }
        });
    });

    // Reset tombol
    document.getElementById('resetBtn').addEventListener('click', function(){
        document.querySelectorAll('.ahp-select').forEach(function(s){
            s.value = (s.dataset.row == s.dataset.col) ? 1 : 0;
        });
    });
</script>
@endsection
