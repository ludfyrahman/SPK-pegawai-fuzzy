<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    protected $table = 'position';
    use HasFactory;
    protected $fillable = [
        'name',
        'position_type'
    ];

    public function positionDetail(){
        return $this->hasMany(PositionDetail::class);
    }
}
