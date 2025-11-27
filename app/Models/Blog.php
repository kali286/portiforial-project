<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    //blog table fillable fields model
    protected $table = 'blogs';
    protected $primaryKey = 'id';
    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'featured_image',
        'tags',
        'is_published',
        'published_at',
        'view_count',
        'read_time',
        'meta_title',
        'meta_description',
    ];
}
