<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Education;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EducationController extends Controller
{
    public function index()
    {
        $education = Education::ordered()->paginate(10);
        return view('admin.education.index', compact('education'));
    }

    public function create()
    {
        return view('admin.education.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'institution' => 'required|string|max:255',
            'degree' => 'required|string|max:255',
            'field_of_study' => 'required|string|max:255',
            'start_date' => 'required|date',
            'institution_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('institution_logo')) {
            $data['institution_logo'] = $request->file('institution_logo')->store('education', 'public');
        }

        Education::create($data);

        return redirect()->route('admin.education.index')
            ->with('success', 'Education record created successfully.');
    }

    public function edit($id)
    {
        $education = Education::findOrFail($id);
        return view('admin.education.edit', compact('education'));
    }

    public function update(Request $request, $id)
    {
        $education = Education::findOrFail($id);

        $request->validate([
            'institution' => 'required|string|max:255',
            'degree' => 'required|string|max:255',
            'field_of_study' => 'required|string|max:255',
            'start_date' => 'required|date',
            'institution_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('institution_logo')) {
            // Delete old logo if exists
            if ($education->institution_logo) {
                Storage::disk('public')->delete($education->institution_logo);
            }
            $data['institution_logo'] = $request->file('institution_logo')->store('education', 'public');
        }

        $education->update($data);

        return redirect()->route('admin.education.index')
            ->with('success', 'Education record updated successfully.');
    }

    public function destroy($id)
    {
        $education = Education::findOrFail($id);
        
        if ($education->institution_logo) {
            Storage::disk('public')->delete($education->institution_logo);
        }
        
        $education->delete();

        return redirect()->route('admin.education.index')
            ->with('success', 'Education record deleted successfully.');
    }

    public function toggleStatus($id)
    {
        $education = Education::findOrFail($id);
        // If you have status field, otherwise remove this method
        return redirect()->back()
            ->with('success', 'Education status updated successfully.');
    }
}