<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::where('is_published', true)
            ->orderBy('published_at', 'desc')
            ->paginate(6);

        $recentBlogs = Blog::where('is_published', true)
            ->orderBy('published_at', 'desc')
            ->take(5)
            ->get();

        $categories = Category::where('is_active', true)->get();

        return view('blog.index', compact('blogs', 'recentBlogs', 'categories'));
    }

    public function byCategory(Category $category)
    {
        $blogs = Blog::whereHas('categories', function($query) use ($category) {
            $query->where('id', $category->id);
        })
        ->where('is_published', true)
        ->orderBy('published_at', 'desc')
        ->paginate(6);

        $recentBlogs = Blog::where('is_published', true)
            ->orderBy('published_at', 'desc')
            ->take(5)
            ->get();

        $categories = Category::where('is_active', true)->get();

        return view('blog.index', compact('blogs', 'recentBlogs', 'categories', 'category'));
    }

    public function show($id)
    {
        $blog = Blog::where('id', $id)
            ->where('is_published', true)
            ->firstOrFail();

        // Increment view count
        $blog->increment('view_count');

        $recentBlogs = Blog::where('id', '!=', $blog->id)
            ->where('is_published', true)
            ->orderBy('published_at', 'desc')
            ->take(5)
            ->get();

        return view('blog.show', compact('blog', 'recentBlogs'));
    }
}