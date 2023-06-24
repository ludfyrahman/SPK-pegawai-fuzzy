<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
    use HasFactory;
    protected $table = 'gudang_detail';
    public $fillable = [
        'gudang_id','no_part','sap','cat','deskripsi','satuan','lokasi','keterangan','stok','foto','barcode'
    ];
}
