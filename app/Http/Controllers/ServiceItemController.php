<?php

namespace App\Http\Controllers;

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

    }

    public function show(string $serviceSlug, string $itemSlug, int $item)
    {
        $item = ServiceItem::with('service')
            ->where('id', $item)
            ->whereHas('service', function ($q) use ($serviceSlug) {
                $q->where('slug', $serviceSlug);
            })
            ->firstOrFail();

        return Inertia::render('ServiceItemShow', [
            'item' => $item,
            'service' => $item->service,
        ]);
    }

    // public function show($slug, $id)
    // {
    //     $service = Service::where('slug', $slug)->firstOrFail();
    //     $item = $service->items()->where(['id' => $id,'slug' =>$slug ])->firstOrFail();

    //     return Inertia::render('ServiceItemShow', [
    //         'service' => $service,
    //         'item' => $item,
    //     ]);
    // }


    // public function show(Service $service, ServiceItem $item)
    // {
    //     return Inertia::render('Services/ServiceItemShow', [
    //         'service' => $service,
    //         'item' => $item->append('image_url'),
    //     ]);
    // }


}
