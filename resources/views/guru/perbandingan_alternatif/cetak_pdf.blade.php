<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Perbandingan Alternatif</title>
    <style>
        body { font-family: "Times New Roman", serif; font-size: 12pt; margin: 30px 50px; line-height: 1.5; }
        table { border-collapse: collapse; width: 100%; margin-bottom: 20px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: center; }
        th { background-color: #f5f5f5; font-weight: bold; }
        h2, h3, h4 { margin: 4px 0; padding: 0; }
        .kop-surat { width: 100%; margin-bottom: 5px; }
        .kop-surat td { border: none; text-align: center; vertical-align: middle; }
        .kop-logo { width: 95px; text-align: center; }
        .line1 { border-top: 2px solid #000; margin: 0; }
        .line2 { border-top: 1px solid #000; margin: 2px 0 20px 0; }
        .title { text-align: center; margin: 20px 0; text-transform: uppercase; }
        .info { margin-bottom: 15px; }
        .kriteria-title { margin-top: 20px; font-weight: bold; }
        .cr { margin-bottom: 15px; font-style: italic; }
        .ttd { width: 280px; text-align: center; float: right; margin-top: 50px; }
    </style>
</head>
<body>

    <!-- KOP SURAT -->
    <table class="kop-surat">
        <tr>
            <td class="kop-logo">
                <img src="{{ public_path('logo/Lambang_Kota_Tanjungpinang.png') }}" alt="Logo Sekolah" width="90">
            </td>
            <td>
                <h2 style="margin:0;">SEKOLAH DASAR NEGERI 02</h2>
                <h3 style="margin:0;">KECAMATAN TANJUNGPINANG TIMUR</h3>
                <p style="margin:0;">Jl. Adi Sucipto, Pinang Kencana, Kota Tanjungpinang</p>
                <p style="margin:0;">Telp: (0771) 123456 | Email: sdn02tpi@gmail.com</p>
            </td>
        </tr>
    </table>
    <div class="line1"></div>
    <div class="line2"></div>

    <!-- JUDUL -->
    <h2 class="title">Laporan Perbandingan Alternatif</h2>

    <!-- INFORMASI SISWA -->
    <div class="info">
        <p><strong>Nama Siswa :</strong> {{ $siswa->nama }}</p>
        <p><strong>Tanggal Cetak :</strong> {{ date('d-m-Y') }}</p>
    </div>

    <!-- LOOP KRITERIA -->
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

    <!-- Bagian tanda tangan -->
    <div class="ttd">
        <p>Tanjungpinang, {{ date('d-m-Y') }}</p>
        <p><strong>Kepala Sekolah</strong></p>
        <br><br><br>
        <p><u>Nama Kepala Sekolah</u><br>NIP. 1970XXXXXXXXXX</p>
    </div>

</body>
</html>
