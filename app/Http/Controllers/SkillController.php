<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    public function index()
    {
        $skills = Skill::orderBy('sort_order')->get();
        
        // Group by categories if you have them, or just return all
        return view('skills.index', compact('skills'));
    }

    public function apiIndex()
    {
        $skills = Skill::orderBy('sort_order')
            ->get(['id', 'name', 'level', 'icon', 'color']);

        return response()->json($skills);
    }
}