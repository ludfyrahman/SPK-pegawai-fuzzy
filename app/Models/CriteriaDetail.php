<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CriteriaDetail extends Model
{
    protected $table = 'criteria_detail';
    use HasFactory;

    protected $fillable = [
        'criteria_id',
        'weight',
        'description',
    ];
}
