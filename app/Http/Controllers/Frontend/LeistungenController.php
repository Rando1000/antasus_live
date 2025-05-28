<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use Inertia\Inertia;

class LeistungenController extends Controller
{
    public function index()
    {
        $services = Service::with(['items' => fn ($q) => $q->orderBy('position')])
            ->where('is_active', true)
            ->orderBy('position')
            ->get();

        return Inertia::render('Leistungen', [
            'services' => $services,
        ]);
    }

    public function show($slug)
    {
        $service = Service::with(['items' => fn ($q) => $q->orderBy('position')])
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        return Inertia::render('Leistungen/Show', [
            'service' => $service,
        ]);
    }

    public function item($slug, ServiceItem $item)
    {
        $service = Service::where('slug', $slug)->firstOrFail();

        // Sicherheit: gehört das Item zum Service?
        abort_if($item->service_id !== $service->id, 404);

        return Inertia::render('Services/ServiceItemShow', [
            'service' => $service,
            'item' => $item->append('image_url'),
        ]);
    }
}
