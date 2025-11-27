<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    //service table fillable fields model
    protected $table = 'services';
    protected $primaryKey = 'id';
    protected $fillable = [
        'title',
        'slug',
        'description',
        'features',
        'icon',
        'sort_order',
        'is_active',
    ];
}
