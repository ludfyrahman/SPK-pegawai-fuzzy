<?php

namespace App\Imports;

use App\Models\Project;
use Maatwebsite\Excel\Concerns\WithStartRow;

use Maatwebsite\Excel\Concerns\ToModel;

class ProjectImport implements ToModel,WithStartRow
{
    /**
     * @return int
     */
    public function startRow(): int
    {
        return 2;
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Project([
            //
            'nip_lama'               => $row[0],
            'nip_baru'               => $row[1],
            'nama'                   => $row[2],
            'gelar_depan'            => $row[3],
            'gelar_belakang'         => $row[4],
            'tmt_cpns'               => $row[5],
            'gol_akhir_id'           => $row[6],
            'gol_akhir_nama'         => $row[7],
            'tmt_golongan'           => $row[8],
            'mk_tahun'               => $row[9],
            'mk_bulan'               => $row[10],
            'jenis_jabatan_nama'     => $row[11],
            'jabatan_nama'           => $row[12],
            'tmt_jabatan'            => $row[13],
            'tingkat_pendidikan'     => $row[14],
            'pendidikan_nama'        => $row[15],
            'tahun_lulus'            => $row[16],
            'kpkn_nama'              => $row[17],
            'lokasi_kerja_nama'      => $row[18],
            'unor_nama'              => $row[19],
            'instasi_induk_nama'     => $row[20],
        ]);
    }
}
