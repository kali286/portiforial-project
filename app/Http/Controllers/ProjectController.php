<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Category;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::where('is_published', true)
            ->orderBy('sort_order')
            ->paginate(9);

        $categories = Category::where('is_active', true)->get();

        return view('projects.index', compact('projects', 'categories'));
    }

    public function byCategory(Category $category)
    {
        $projects = Project::where('category_id', $category->id)
            ->where('is_published', true)
            ->orderBy('sort_order')
            ->paginate(9);

        $categories = Category::where('is_active', true)->get();

        return view('projects.index', compact('projects', 'categories', 'category'));
    }

    public function show($id)
    {
        $project = Project::where('id', $id)
            ->where('is_published', true)
            ->firstOrFail();

        // Increment view count
        // $project->increment('view_count'); // Uncomment if you have view_count field

        $relatedProjects = Project::where('category_id', $project->category_id)
            ->where('id', '!=', $project->id)
            ->where('is_published', true)
            ->orderBy('sort_order')
            ->take(3)
            ->get();

        return view('projects.show', compact('project', 'relatedProjects'));
    }

    public function apiIndex()
    {
        $projects = Project::where('is_published', true)
            ->orderBy('sort_order')
            ->get(['id', 'title', 'slug', 'excerpt', 'featured_image', 'tech_stack']);

        return response()->json($projects);
    }
}