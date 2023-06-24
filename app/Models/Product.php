<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    // protected $fillable = ['id','name','harga','image','qty','deskripsi','part_no','code'];

    protected $fillable = ['part_no', 'name', 'qty', 'deskripsi','tanggal', 'image', 'code',];

    public $timestamps = false;

    public function getRouteKeyName()
    {
        return 'id';
    }

    // public function product()
    // {
    //     return $this->belongsTo(Product::class);
    // }
}
