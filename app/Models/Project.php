<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    Protected $table = 'project';


    protected $fillable = ['nip_lama', 'nip_baru', 'nama', 'gelar_depan', 'gelar_belakang', 'tmt_cpns','gol_akhir_id', 'gol_akhir_nama', 'tmt_golongan', 'mk_tahun', 'mk_bulan', 'jenis_jabatan_nama', 'jabatan_nama', 'tmt_jabatan', 'tingkat_pendidikan', 'pendidikan_nama', 'tahun_lulus', 'kpkn_nama', 'lokasi_kerja_nama', 'unor_nama', 'instasi_induk_nama'];

    public $timestamps = false;

    public function getRouteKeyName()
    {
        return 'id';
    }
}
