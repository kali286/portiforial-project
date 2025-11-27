<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::orderBy('sort_order')->paginate(10);
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'nullable|string|max:255',
        ]);

        Service::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'description' => $request->description,
            'features' => $request->features,
            'icon' => $request->icon,
            'sort_order' => $request->sort_order ?? 0,
        ]);

        return redirect()->route('admin.services.index')
            ->with('success', 'Service created successfully.');
    }

    public function edit($id)
    {
        $service = Service::findOrFail($id);
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, $id)
    {
        $service = Service::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'nullable|string|max:255',
        ]);

        $service->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'description' => $request->description,
            'features' => $request->features,
            'icon' => $request->icon,
            'sort_order' => $request->sort_order ?? $service->sort_order,
        ]);

        return redirect()->route('admin.services.index')
            ->with('success', 'Service updated successfully.');
    }

    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        $service->delete();

        return redirect()->route('admin.services.index')
            ->with('success', 'Service deleted successfully.');
    }

    public function toggleStatus($id)
    {
        $service = Service::findOrFail($id);
        $service->update(['is_active' => !$service->is_active]);

        return redirect()->back()
            ->with('success', 'Service status updated successfully.');
    }
}