<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PositionDetail extends Model
{
    use HasFactory;
    protected $table = 'position_detail';
    protected $fillable = [
        'position_id',
        'user_id',
        'start_period',
        'end_period',
        'status',
    ];

    public function position(){
        return $this->belongsTo(Position::class);
    }
}
