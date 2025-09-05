<!DOCTYPE html>
<html>
<head>
    <title>Hasil Perbandingan Siswa</title>
    <style>
        table { width: 100%; border-collapse: collapse; margin-bottom: 15px; }
        th, td { border: 1px solid #000; padding: 5px; text-align: left; }
        h4 { margin-bottom: 5px; }
    </style>
</head>
<body>
    <h2>Hasil Perbandingan Siswa</h2>

    @foreach($siswaPerAlternatif as $alternatif => $siswas)
        <h4>Alternatif: {{ $alternatif }}</h4>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                                        <th>NIS</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Kelas</th>
                                        <th>Tahun Masuk</th>
                                        <th>Sekolah Asal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($siswas as $index => $siswa)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                       <td>{{ $siswa->nama }}</td>
                                            <td>{{ $siswa->nis }}</td>
                                            <td>{{ $siswa->jenis_kelamin }}</td>
                                            <td>{{ $siswa->kelas->nama_kelas ?? '-' }} @if(isset($siswa->kelas->jurusan)) ({{ $siswa->kelas->jurusan }}) @endif</td>
                                            <td>{{ $siswa->tahun_masuk ?? '-' }}</td>
                                            <td>{{ $siswa->sekolah_asal ?? '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endforeach
</body>
</html>
