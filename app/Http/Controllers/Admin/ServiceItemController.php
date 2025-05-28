<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Inertia\Inertia;

class ServiceItemController extends Controller
{
    public function index(Service $service)
    {
        $items = $service->items()->latest()->get();

        return Inertia::render('Admin/ServiceItems/Index', [
            'service' => $service,
            'items' => $items,
        ]);
    }



    public function create(Service $service)
    {
        return Inertia::render('Admin/ServiceItems/Create', [
            'service' => $service,
        ]);
    }

    public function store(Request $request, Service $service)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:service_items,slug',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'position' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);
        // Handle image upload
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('service_items', 'public');
        }
        $validated['slug'] = $validated['slug'] ?? Str::slug($validated['title']);
        $validated['service_id'] = $service->id;

        $item = ServiceItem::create($validated);

        return redirect()->route('admin.services.items.index', $service)->with('success', 'Service Item created.');
    }

    public function edit(Service $service, ServiceItem $item)
    {
        return Inertia::render('Admin/ServiceItems/Edit', [
            'service' => $service,
            'item' => $item->append('image_url'), // Append image URL
        ]);
    }



    public function update(Request $request, Service $service, ServiceItem $item)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:service_items,slug,' . $item->id,
            'description' => 'nullable|string',
            'image' => 'nullable|image', // Changed to accept files
            'position' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        // Handle image upload

         if ($request->hasFile('image')) {
            if ($item->image) {
                Storage::disk('public')->delete($item->image);
            }
            $validated['image'] = $request->file('image')->store('service_items', 'public');
            }
            $validated['slug'] = $validated['slug'] ?? Str::slug($validated['title']);
        $item->update($validated);

        return redirect()->route('admin.services.items.index', $service)
            ->with('success', 'Service Item updated.');
    }




    public function destroy(Service $service, ServiceItem $item)
    {
        $item->delete();

        return redirect()->route('admin.services.items.index', $service)->with('success', 'Service Item deleted.');
    }
}
