<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    //project table fillable fields model
    protected $table = 'projects';
    protected $primaryKey = 'id';
    protected $fillable = [
        'title',
        'slug',
        'description',
        'excerpt',
        'category_id',
        'featured_image',
        'gallery_images',
        'project_url',
        'github_url',
        'tech_stack',
        'start_date',
        'end_date',
        'is_featured',
        'is_published',
        'sort_order',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
