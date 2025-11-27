<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        return view('services.index', compact('services'));
    }

    public function show($id)
    {
        $service = Service::where('id', $id)
            ->where('is_active', true)
            ->firstOrFail();

        $otherServices = Service::where('id', '!=', $service->id)
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->take(3)
            ->get();

        return view('services.show', compact('service', 'otherServices'));
    }
}