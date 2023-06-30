<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PositionDetail;
class Employee extends Model
{
    use HasFactory;

    Protected $table = 'employee';


    protected $fillable = [
        'user_id',
        'nip_baru',
        'nip_lama',
        'nama',
        'gelar_depan',
        'gelar_belakang',
        'tmt_cpns',
        'gol_akhir',
        'tmt_golongan',
        'tingkat_pendidikan',
        'nama_pendidikan',
        'tahun_lulus',
        'lokasi_kerja_nama',
        'unit_kerja',
        'instansi',
        'unit_kerja_target',
        'position_target',
    ];

    public $timestamps = false;

    public function getRouteKeyName()
    {
        return 'id';
    }

    public function position()
    {
        return $this->hasMany(PositionDetail::class, 'user_id', 'id');
    }
}
