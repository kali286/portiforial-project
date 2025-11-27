<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    //experience table fillable fields model
    protected $table = 'experiences';
    protected $primaryKey = 'id';
    protected $fillable = [
        'company_name',
        'position',
        'responsibilities',
        'employment_type',
        'location',
        'start_date',
        'end_date',
        'is_current',
        'company_logo',
        'sort_order',
    ];
}
