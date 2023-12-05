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
        'criteria_detail_id',
        'weight'
    ];

    public function position(){
        return $this->belongsTo(Position::class);
    }

    public function criteriaDetail(){
        return $this->belongsTo(Criteria::class, 'criteria_detail_id');
    }
}
