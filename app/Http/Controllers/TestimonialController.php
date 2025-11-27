<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::where('is_approved', true)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('testimonials.index', compact('testimonials'));
    }

    public function apiIndex()
    {
        $testimonials = Testimonial::where('is_approved', true)
            ->where('is_featured', true)
            ->orderBy('created_at', 'desc')
            ->get(['id', 'client_name', 'company', 'position', 'testimonial', 'rating', 'avatar']);

        return response()->json($testimonials);
    }
}