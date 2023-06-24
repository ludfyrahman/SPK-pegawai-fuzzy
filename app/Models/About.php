<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    use HasFactory;
    protected $table = 'about';
    protected $guarded = ['id','created_at','updated_at'];

    public function getRouteKeyName()
    {
        return 'id';
    }
}
