<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    
    // testimonial model code 
    protected $table = 'testimonials';
    protected $primaryKey = 'id';
    protected $fillable = [
                'client_name',
                'company',
                'position',       
                'testimonial',
                'rating',
                'avatar',
                'project_worked_on',
                'is_featured',
                'is_approved',
                'approved_at',
    ];
}
