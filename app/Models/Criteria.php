<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Criteria extends Model
{
    protected $table = 'criteria';
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'weight',
    ];

    public function criteriaDetail()
    {
        return $this->hasMany(CriteriaDetail::class, 'criteria_id', 'id');
    }

    public function plottingPositionDetail()
    {
        return $this->hasMany(PlottingPositionDetail::class, 'criteria_id', 'id');
    }
    
}
