<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Experience;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ExperienceController extends Controller
{
    public function index()
    {
        $experiences = Experience::orderBy('sort_order')->paginate(10);
        return view('admin.experiences.index', compact('experiences'));
    }

    public function create()
    {
        return view('admin.experiences.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'responsibilities' => 'required|string',
            'start_date' => 'required|date',
            'company_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('company_logo')) {
            $data['company_logo'] = $request->file('company_logo')->store('experiences', 'public');
        }

        Experience::create($data);

        return redirect()->route('admin.experiences.index')
            ->with('success', 'Experience created successfully.');
    }

    public function edit($id)
    {
        $experience = Experience::findOrFail($id);
        return view('admin.experiences.edit', compact('experience'));
    }

    public function update(Request $request, $id)
    {
        $experience = Experience::findOrFail($id);

        $request->validate([
            'company_name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'responsibilities' => 'required|string',
            'start_date' => 'required|date',
            'company_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('company_logo')) {
            // Delete old logo if exists
            if ($experience->company_logo) {
                Storage::disk('public')->delete($experience->company_logo);
            }
            $data['company_logo'] = $request->file('company_logo')->store('experiences', 'public');
        }

        $experience->update($data);

        return redirect()->route('admin.experiences.index')
            ->with('success', 'Experience updated successfully.');
    }

    public function destroy($id)
    {
        $experience = Experience::findOrFail($id);
        
        if ($experience->company_logo) {
            Storage::disk('public')->delete($experience->company_logo);
        }
        
        $experience->delete();

        return redirect()->route('admin.experiences.index')
            ->with('success', 'Experience deleted successfully.');
    }

    public function toggleStatus($id)
    {
        $experience = Experience::findOrFail($id);
        // If you have status field, otherwise remove this method
        return redirect()->back()
            ->with('success', 'Experience status updated successfully.');
    }
}