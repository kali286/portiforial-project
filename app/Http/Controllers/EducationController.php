<?php

namespace App\Http\Controllers;

use App\Models\Education;
use Illuminate\Http\Request;

class EducationController extends Controller
{
    public function index()
    {
        $education = Education::ordered()->get();
        
        return view('education.index', compact('education'));
    }
}