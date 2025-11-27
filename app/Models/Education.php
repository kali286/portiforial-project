<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;

    
    protected $table = 'education';

    protected $fillable = [
        'institution',
        'degree', 
        'field_of_study',
        'description',
        'location',
        'start_date',
        'end_date',
        'is_current',
        'institution_logo',
        'sort_order'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'is_current' => 'boolean',
        'sort_order' => 'integer'
    ];

    /**
     * Scope for active education records
     */
    public function scopeActive($query)
    {
        return $query->where('is_current', true)->orWhereNotNull('end_date');
    }

    /**
     * Scope for ordered education
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('start_date', 'desc');
    }
}