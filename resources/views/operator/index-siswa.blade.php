@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4>Daftar Siswa</h4>
        <a href="{{ route('operator.siswa.create') }}" class="btn btn-primary">Tambah Siswa</a>
    </div>
    <div class="card-body">
        @if($siswas->count())
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>NIS</th>
                        <th>Jenis Kelamin</th>
                        <th>Tanggal Lahir</th>
                        <th>Tempat Lahir</th>
                        <th>Agama</th>
                        <th>Alamat</th>
                        <th>Telepon</th>
                        <th>Email</th>
                        <th>Kelas</th>
                        <th>Tahun Masuk</th>
                        <th>Sekolah Asal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($siswas as $index => $siswa)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $siswa->nama }}</td>
                            <td>{{ $siswa->nis }}</td>
                            <td>{{ $siswa->jenis_kelamin }}</td>
                            <td>{{ $siswa->tanggal_lahir }}</td>
                            <td>{{ $siswa->tempat_lahir }}</td>
                            <td>{{ $siswa->agama }}</td>
                            <td>{{ $siswa->alamat }}</td>
                            <td>{{ $siswa->telepon }}</td>
                            <td>{{ $siswa->email }}</td>
                            <td>{{ $siswa->kelas }}</td>
                            <td>{{ $siswa->tahun_masuk }}</td>
                            <td>{{ $siswa->sekolah_asal }}</td>
                            <td>
                                <a href="{{ route('operator.siswa.edit', $siswa->id) }}" class="btn btn-sm btn-warning mb-1">Edit</a>

                                <form action="{{ route('operator.siswa.destroy', $siswa->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus siswa ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger mb-1">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="text-center">Belum ada data siswa.</p>
        @endif
    </div>
</div>
@endsection
