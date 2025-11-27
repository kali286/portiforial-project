<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with('category')->latest()->paginate(10);
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        $categories = Category::where('is_active', true)->get();
        return view('admin.projects.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'featured_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:4096',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'tech_stack' => 'nullable|string', // comma or newline separated
            'project_url' => 'nullable|url',
            'github_url' => 'nullable|url',
        ]);

        $data = [];
        $data['title'] = $request->input('title');
        $data['slug'] = Str::slug($request->title);
        $data['description'] = $request->input('description');
        $data['excerpt'] = Str::limit(strip_tags($request->description), 150);
        $data['category_id'] = $request->input('category_id');
        $data['project_url'] = $request->input('project_url');
        $data['github_url'] = $request->input('github_url');
        $data['start_date'] = $request->input('start_date');
        $data['end_date'] = $request->input('end_date');
        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_published'] = $request->boolean('is_published');

        // tech_stack: convert to JSON array
        $stack = $request->input('tech_stack');
        if (!empty($stack)) {
            $parts = preg_split('/\r?\n|,/', $stack);
            $parts = array_values(array_filter(array_map('trim', $parts)));
            $data['tech_stack'] = json_encode($parts);
        } else {
            $data['tech_stack'] = json_encode([]);
        }

        // required featured image
        $data['featured_image'] = $request->file('featured_image')->store('projects', 'public');

        Project::create($data);

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project created successfully.');
    }

    public function edit($id)
    {
        $project = Project::findOrFail($id);
        $categories = Category::where('is_active', true)->get();
        return view('admin.projects.edit', compact('project', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $project = Project::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->title);
        $data['excerpt'] = Str::limit(strip_tags($request->description), 150);

        if ($request->hasFile('featured_image')) {
            // Delete old image if exists
            if ($project->featured_image) {
                Storage::disk('public')->delete($project->featured_image);
            }
            $data['featured_image'] = $request->file('featured_image')->store('projects', 'public');
        }

        $project->update($data);

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project updated successfully.');
    }

    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        
        // Delete featured image if exists
        if ($project->featured_image) {
            Storage::disk('public')->delete($project->featured_image);
        }
        
        $project->delete();

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project deleted successfully.');
    }

    public function toggleStatus($id)
    {
        $project = Project::findOrFail($id);
        $project->update(['is_published' => !$project->is_published]);

        return redirect()->back()
            ->with('success', 'Project status updated successfully.');
    }

    public function toggleFeatured($id)
    {
        $project = Project::findOrFail($id);
        $project->update(['is_featured' => !$project->is_featured]);

        return redirect()->back()
            ->with('success', 'Project featured status updated successfully.');
    }
}