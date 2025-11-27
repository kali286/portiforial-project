<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    //skill table fillable fields model
    protected $table = 'skills';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'slug',
        'level',
        'icon',
        'color',
        'sort_order',
        'is_featured',
    ];
}
