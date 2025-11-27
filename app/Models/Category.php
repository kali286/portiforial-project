<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //category table fillable fields model
    protected $table = 'categories';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'slug',
        'description',
        'color',
        'sort_order',
        'is_active',
    ];
}
