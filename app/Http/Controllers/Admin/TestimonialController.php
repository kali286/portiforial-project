<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::latest()->paginate(10);
        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        return view('admin.testimonials.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'client_name' => 'required|string|max:255',
            'company' => 'nullable|string|max:255',
            'position' => 'nullable|string|max:255',
            'testimonial' => 'required|string|min:10',
            'rating' => 'required|integer|min:1|max:5',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('avatar')) {
            $data['avatar'] = $request->file('avatar')->store('testimonials', 'public');
        }

        Testimonial::create($data);

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Testimonial created successfully.');
    }

    public function edit($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    public function update(Request $request, $id)
    {
        $testimonial = Testimonial::findOrFail($id);

        $request->validate([
            'client_name' => 'required|string|max:255',
            'company' => 'nullable|string|max:255',
            'position' => 'nullable|string|max:255',
            'testimonial' => 'required|string|min:10',
            'rating' => 'required|integer|min:1|max:5',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('avatar')) {
            // Delete old avatar if exists
            if ($testimonial->avatar) {
                Storage::disk('public')->delete($testimonial->avatar);
            }
            $data['avatar'] = $request->file('avatar')->store('testimonials', 'public');
        }

        $testimonial->update($data);

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Testimonial updated successfully.');
    }

    public function destroy($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        
        if ($testimonial->avatar) {
          Storage::disk('public')->delete($testimonial->avatar);
        }
        
        $testimonial->delete();

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Testimonial deleted successfully.');
    }

    public function toggleStatus($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        // If you have status field, otherwise remove this method
        return redirect()->back()
            ->with('success', 'Testimonial status updated successfully.');
    }

    public function approve($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $testimonial->update([
            'is_approved' => true,
            'approved_at' => now(),
        ]);

        return redirect()->back()
            ->with('success', 'Testimonial approved successfully.');
    }

    public function toggleFeatured($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $testimonial->update(['is_featured' => !$testimonial->is_featured]);

        return redirect()->back()
            ->with('success', 'Testimonial featured status updated successfully.');
    }
}