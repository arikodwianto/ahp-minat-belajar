<?php

namespace App\Imports;

use App\Models\Siswa;
use App\Models\Kelas;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsErrors;

class SiswaImport implements ToModel, WithHeadingRow, SkipsOnError
{
    use SkipsErrors;

    public $gagal = []; // simpan baris yang gagal

    public function model(array $row)
    {
        $kelas = Kelas::whereRaw('LOWER(nama_kelas) = ?', [strtolower($row['kelas'])])->first();

        if (!$kelas) {
            $this->gagal[] = "Baris '{$row['nama']}' gagal: Kelas '{$row['kelas']}' tidak ditemukan";
            return null; // lewati baris ini
        }

        $tanggal_lahir = !empty($row['tanggal_lahir']) 
            ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['tanggal_lahir'])->format('Y-m-d')
            : null;

        return new Siswa([
            'nama'          => $row['nama'],
            'nis'           => $row['nis'],
            'jenis_kelamin' => $row['jenis_kelamin'],
            'tanggal_lahir' => $tanggal_lahir,
            'tempat_lahir'  => $row['tempat_lahir'],
            'agama'         => $row['agama'],
            'alamat'        => $row['alamat'],
            'telepon'       => $row['telepon'] ?? null,
            'email'         => $row['email'] ?? null,
            'kelas_id'      => $kelas->id,
            'tahun_masuk'   => $row['tahun_masuk'] ?? null,
            'sekolah_asal'  => $row['sekolah_asal'] ?? null,
        ]);
    }
}

