<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Perbandingan Alternatif</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { border-collapse: collapse; width: 100%; margin-bottom: 20px; }
        th, td { border: 1px solid #000; padding: 5px; text-align: center; }
        th { background-color: #f2f2f2; }
        h2, h4 { margin: 0; padding: 0; }
        .kriteria-title { margin-top: 20px; margin-bottom: 5px; }
        .cr { margin-bottom: 15px; }
    </style>
</head>
<body>
    <h2>Laporan Perbandingan Alternatif</h2>
    <h4>Siswa: {{ $siswa->nama }}</h4>

    @foreach($kriterias as $kriteria)
        <h4 class="kriteria-title">Kriteria: {{ $kriteria->nama }}</h4>

        <!-- Tabel Perbandingan -->
        <table>
            <thead>
                <tr>
                    <th>Alternatif A</th>
                    <th>Alternatif B</th>
                    <th>Nilai</th>
                    <th>Pilihan</th>
                    <th>Alasan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($alternatifs as $i => $alt1)
                    @foreach($alternatifs as $j => $alt2)
                        @if($i < $j)
                            @php
                                $p = $perbandingans
                                    ->where('kriteria_id', $kriteria->id)
                                    ->where('alternatif1_id', $alt1->id)
                                    ->where('alternatif2_id', $alt2->id)
                                    ->first();
                            @endphp
                            @if($p)
                                <tr>
                                    <td>{{ $alt1->nama }}</td>
                                    <td>{{ $alt2->nama }}</td>
                                    <td>{{ $p->nilai }}</td>
                                    <td>{{ $p->pilihan == $alt1->id ? $alt1->nama : $alt2->nama }}</td>
                                    <td>{{ $p->alasan ?? '-' }}</td>
                                </tr>
                            @endif
                        @endif
                    @endforeach
                @endforeach
            </tbody>
        </table>

        <!-- Tabel Bobot AHP -->
        @if(isset($hasilAHP[$kriteria->id]))
            <table>
                <thead>
                    <tr>
                        <th>Alternatif</th>
                        <th>Bobot</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($hasilAHP[$kriteria->id]['bobot'] as $alt_id => $bobot)
                        @php
                            $alt = $alternatifs->where('id', $alt_id)->first();
                        @endphp
                        <tr>
                            <td>{{ $alt->nama }}</td>
                            <td>{{ number_format($bobot, 4) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <p class="cr">Consistency Ratio (CR): <strong>{{ number_format($hasilAHP[$kriteria->id]['CR'], 4) }}</strong></p>
        @endif
    @endforeach
</body>
</html>
