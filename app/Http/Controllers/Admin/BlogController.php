<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::latest()->paginate(10);
        return view('admin.blog.index', compact('blogs'));
    }

    public function create()
    {
        $categories = Category::where('is_active', true)->get();
        return view('admin.blog.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'excerpt' => 'nullable|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->title);
        $data['excerpt'] = $request->excerpt ?? Str::limit(strip_tags($request->content), 150);

        if ($request->hasFile('featured_image')) {
            $data['featured_image'] = $request->file('featured_image')->store('blog', 'public');
        }

        if ($request->has('is_published')) {
            $data['published_at'] = now();
        }

        Blog::create($data);

        return redirect()->route('admin.blog.index')
            ->with('success', 'Blog post created successfully.');
    }

    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        $categories = Category::where('is_active', true)->get();
        return view('admin.blog.edit', compact('blog', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'excerpt' => 'nullable|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->title);
        $data['excerpt'] = $request->excerpt ?? Str::limit(strip_tags($request->content), 150);

        if ($request->hasFile('featured_image')) {
            // Delete old image if exists
            if ($blog->featured_image) {
                Storage::disk('public')->delete($blog->featured_image);
            }
            $data['featured_image'] = $request->file('featured_image')->store('blog', 'public');
        }

        if ($request->has('is_published') && !$blog->is_published) {
            $data['published_at'] = now();
        }

        $blog->update($data);

        return redirect()->route('admin.blog.index')
            ->with('success', 'Blog post updated successfully.');
    }

    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);
        
        if ($blog->featured_image) {
            Storage::disk('public')->delete($blog->featured_image);
        }
        
        $blog->delete();

        return redirect()->route('admin.blog.index')
            ->with('success', 'Blog post deleted successfully.');
    }

    public function toggleStatus($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->update([
            'is_published' => !$blog->is_published,
            'published_at' => $blog->is_published ? null : now(),
        ]);

        return redirect()->back()
            ->with('success', 'Blog status updated successfully.');
    }

    public function toggleFeatured($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->update(['is_featured' => !$blog->is_featured]);

        return redirect()->back()
            ->with('success', 'Blog featured status updated successfully.');
    }
}