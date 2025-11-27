<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Testimonial;
use App\Models\Service;
use App\Models\Skill;
use App\Models\Blog;
use App\Models\Experience;
use App\Models\Education;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProjects = Project::where('is_featured', true)
            ->where('is_published', true)
            ->orderBy('sort_order')
            ->take(6)
            ->get();

        $featuredTestimonials = Testimonial::where('is_featured', true)
            ->where('is_approved', true)
            ->take(4)
            ->get();

        $services = Service::where('is_active', true)
            ->orderBy('sort_order')
            ->take(4)
            ->get();

        $skills = Skill::orderBy('sort_order')
            ->take(8)
            ->get();

        $recentBlogs = Blog::where('is_published', true)
            ->orderBy('published_at', 'desc')
            ->take(3)
            ->get();

        // Calculate stats based on actual data
        $stats = [
            'totalProjects' => Project::where('is_published', true)->count(),
            'happyClients' => Testimonial::where('is_approved', true)->count(),
            'yearsExperience' => $this->calculateYearsExperience(),
            'awards' => 5, // Static for now, can be dynamic if you have awards model
        ];

        return view('home', compact(
            'featuredProjects',
            'featuredTestimonials',
            'services',
            'skills',
            'recentBlogs',
            'stats'
        ));
    }

    public function about()
    {
        $skills = Skill::orderBy('sort_order')->get();
        $experiences = Experience::orderBy('sort_order')->get();
        $education = Education::ordered()->get();
        
        return view('about', compact('skills', 'experiences', 'education'));
    }

    /**
     * Calculate years of experience from the earliest experience record
     */
    private function calculateYearsExperience()
    {
        $earliestExperience = Experience::orderBy('start_date')->first();
        
        if ($earliestExperience) {
            $startYear = \Carbon\Carbon::parse($earliestExperience->start_date)->year;
            $currentYear = now()->year;
            return $currentYear - $startYear;
        }

        return 3; // Default fallback
    }
}