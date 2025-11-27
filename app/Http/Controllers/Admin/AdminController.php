<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Blog;
use App\Models\ContactMessage;
use App\Models\Testimonial;
use App\Models\Service;
use App\Models\Skill;
use App\Models\Experience;
use App\Models\Education;
use App\Models\Category;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Artisan;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = $this->getDashboardStats();
        
        $recentMessages = ContactMessage::latest()->take(5)->get();
        $recentProjects = Project::latest()->take(5)->get();
        
        // For recent activities - you might want to create an Activity model later
        $recentActivities = collect(); // Empty for now

        return view('admin.dashboard', compact('stats', 'recentMessages', 'recentProjects', 'recentActivities'));
    }

    public function getStats()
    {
        $stats = $this->getDashboardStats();
        return response()->json($stats);
    }

    private function getDashboardStats()
    {
        return [
            // Projects
            'totalProjects' => Project::count(),
            'publishedProjects' => Project::where('is_published', true)->count(),
            
            // Blog
            'totalBlogs' => Blog::count(),
            'publishedBlogs' => Blog::where('is_published', true)->count(),
            
            // Messages
            'totalMessages' => ContactMessage::count(),
            'unreadMessages' => ContactMessage::where('status', 'unread')->count(),
            
            // Testimonials
            'totalTestimonials' => Testimonial::count(),
            'pendingTestimonials' => Testimonial::where('is_approved', false)->count(),
            
            // Services
            'totalServices' => Service::count(),
            'activeServices' => Service::where('is_active', true)->count(),
            
            // Skills
            'totalSkills' => Skill::count(),
            
            // Experience & Education
            'totalExperiences' => Experience::count(),
            'totalEducation' => Education::count(),
            
            // Categories
            'totalCategories' => Category::count(),
        ];
    }

    public function profile()
    {
        $user = Auth::user();
        return view('admin.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        $user->update($request->only('name', 'email'));

        return redirect()->route('admin.profile.index')
            ->with('success', 'Profile updated successfully.');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed|min:8',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        $user->update(['password' => Hash::make($request->password)]);

        return redirect()->route('admin.profile.index')
            ->with('success', 'Password updated successfully.');
    }

    public function settings()
    {
        $settings = Setting::query()->pluck('value', 'key')->toArray();
        return view('admin.settings', compact('settings'));
    }

    public function updateSettings(Request $request)
    {
        $request->validate([
            'site_name' => 'nullable|string|max:255',
            'contact_email' => 'nullable|email',
            'maintenance_mode' => 'nullable|boolean',
        ]);

        $data = [
            'site_name' => $request->input('site_name'),
            'contact_email' => $request->input('contact_email'),
            'maintenance_mode' => $request->boolean('maintenance_mode') ? '1' : '0',
        ];

        foreach ($data as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        return redirect()->route('admin.settings')
            ->with('success', 'Settings updated successfully.');
    }

    public function activityLogs()
    {
        // Implementation for activity logs
        return view('admin.activity-logs');
    }

    public function backups()
    {
        // Implementation for backups
        return view('admin.backups');
    }

    public function createBackup(Request $request)
    {
        // Implementation for creating backup
        return redirect()->route('admin.backups')
            ->with('success', 'Backup created successfully.');
    }

    public function systemInfo()
    {
        // Implementation for system info
        return view('admin.system-info');
    }

    public function clearCache()
    {
        Artisan::call('cache:clear');
        Artisan::call('view:clear');
        Artisan::call('config:clear');

        return redirect()->back()->with('success', 'Cache cleared successfully.');
    }

    public function optimize()
    {
        Artisan::call('optimize');

        return redirect()->back()->with('success', 'Application optimized successfully.');
    }

    public function fileManager()
    {
        return view('admin.file-manager');
    }

    public function search(Request $request)
    {
        $query = $request->get('q');
        
        // Implement search logic across models
        $results = [];
        
        return view('admin.search-results', compact('results', 'query'));
    }
}