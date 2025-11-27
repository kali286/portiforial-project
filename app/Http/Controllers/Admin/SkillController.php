<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SkillController extends Controller
{
    public function index()
    {
        $skills = Skill::orderBy('sort_order')->paginate(10);
        return view('admin.skills.index', compact('skills'));
    }

    public function create()
    {
        return view('admin.skills.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'level' => 'required|integer|min:1|max:100',
            'icon' => 'nullable|string|max:255',
            'color' => 'nullable|string|max:7',
        ]);

        Skill::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'level' => $request->level,
            'icon' => $request->icon,
            'color' => $request->color,
            'sort_order' => $request->sort_order ?? 0,
        ]);

        return redirect()->route('admin.skills.index')
            ->with('success', 'Skill created successfully.');
    }

    public function edit($id)
    {
        $skill = Skill::findOrFail($id);
        return view('admin.skills.edit', compact('skill'));
    }

    public function update(Request $request, $id)
    {
        $skill = Skill::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'level' => 'required|integer|min:1|max:100',
            'icon' => 'nullable|string|max:255',
            'color' => 'nullable|string|max:7',
        ]);

        $skill->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'level' => $request->level,
            'icon' => $request->icon,
            'color' => $request->color,
            'sort_order' => $request->sort_order ?? $skill->sort_order,
        ]);

        return redirect()->route('admin.skills.index')
            ->with('success', 'Skill updated successfully.');
    }

    public function destroy($id)
    {
        $skill = Skill::findOrFail($id);
        $skill->delete();

        return redirect()->route('admin.skills.index')
            ->with('success', 'Skill deleted successfully.');
    }

    public function toggleStatus($id)
    {
        $skill = Skill::findOrFail($id);
        // If you have status field, otherwise remove this method
        return redirect()->back()
            ->with('success', 'Skill status updated successfully.');
    }

    public function toggleFeatured($id)
    {
        $skill = Skill::findOrFail($id);
        $skill->update(['is_featured' => !$skill->is_featured]);

        return redirect()->back()
            ->with('success', 'Skill featured status updated successfully.');
    }

    public function showReorderForm()
    {
        $skills = Skill::orderBy('sort_order')->get();
        return view('admin.skills.reorder', compact('skills'));
    }

    public function reorder(Request $request)
    {
        $request->validate([
            'order' => 'required|array',
        ]);

        foreach ($request->order as $index => $id) {
            Skill::where('id', $id)->update(['sort_order' => $index + 1]);
        }

        return redirect()->route('admin.skills.index')
            ->with('success', 'Skills order updated successfully.');
    }
}