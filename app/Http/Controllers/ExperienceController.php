<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    public function index()
    {
        $experiences = Experience::orderBy('sort_order')->get();
        
        return view('experiences.index', compact('experiences'));
    }
}