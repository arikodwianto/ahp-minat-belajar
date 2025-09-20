<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Hasil Perbandingan Siswa</title>
    <style>
        body { font-family: "Times New Roman", serif; font-size: 12pt; margin: 30px 50px; line-height: 1.5; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: center; }
        th { background-color: #f5f5f5; font-weight: bold; }
        h2, h3, h4 { margin: 5px 0; padding: 0; }
        .kop-surat { width: 100%; margin-bottom: 5px; }
        .kop-surat td { border: none; text-align: center; vertical-align: middle; }
        .kop-logo { width: 95px; text-align: center; }
        .line1 { border-top: 2px solid #000; margin: 0; }
        .line2 { border-top: 1px solid #000; margin: 2px 0 20px 0; }
        .title { text-align: center; margin: 20px 0; text-transform: uppercase; }
        .alternatif-title { margin: 15px 0 8px 0; font-weight: bold; }
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
    <h2 class="title">Laporan Hasil Perbandingan Siswa</h2>
    <p><strong>Tanggal Cetak:</strong> {{ date('d-m-Y') }}</p>

    <!-- DATA PER ALTERNATIF -->
@foreach($siswaPerAlternatif as $alternatif => $siswas)
    <h4 class="alternatif-title">Alternatif: {{ $alternatif }}</h4>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>NIS</th>
                <th>Jenis Kelamin</th>
                <th>Kelas</th>
                @foreach($alternatifs as $alt)
                    <th>{{ $alt->nama }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @if(count($siswas) > 0)
                @foreach($siswas as $index => $siswa)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $siswa->nama }}</td>
                        <td>{{ $siswa->nis }}</td>
                        <td>{{ $siswa->jenis_kelamin }}</td>
                        <td>
                            {{ $siswa->kelas->nama_kelas ?? '-' }}
                            @if(isset($siswa->kelas->jurusan)) ({{ $siswa->kelas->jurusan }}) @endif
                        </td>

                        {{-- tampilkan nilai bobot per alternatif --}}
                        @foreach($alternatifs as $alt)
                            <td>
                                {{ number_format($nilaiPerSiswa[$siswa->id][$alt->id] ?? 0, 4) }}
                            </td>
                        @endforeach
                        
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="{{ 5 + $alternatifs->count() }}" class="text-center text-muted fst-italic">
                        Belum ada siswa yang sesuai dengan alternatif ini.
                    </td>
                </tr>
            @endif
        </tbody>
    </table>
@endforeach


    <!-- TANDA TANGAN -->
    <div class="ttd">
        <p>Tanjungpinang {{ date('d-m-Y') }}</p>
        <p><strong>Kepala Sekolah</strong></p>
        <br><br><br>
        <p><u>Nama Kepala Sekolah</u><br>NIP. 1970XXXXXXXXXX</p>
    </div>

</body>
</html>
