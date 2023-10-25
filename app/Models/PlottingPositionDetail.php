<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class PlottingPositionDetail extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'plotting_position_detail';

    protected $fillable = [
        'plotting_position_id',
        'criteria_id',
        'weight',
    ];

    public function criteria()
    {
        return $this->belongsTo(Criteria::class, 'criteria_id', 'id');
    }
}

