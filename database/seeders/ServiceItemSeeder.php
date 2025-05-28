<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ServiceItem;
use App\Models\Service;
use Illuminate\Support\Str;

class ServiceItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $categories = Service::all();

        foreach ($categories as $service) {
            ServiceItem::create([
                'service_id' => $service->id,
                'title' => 'Beispiel für ' . $service->title,
                'slug' => Str::slug('Beispiel für ' . $service->title),
                'description' => 'Beschreibung der Unterleistung für ' . $service->title,
                'icon' => '🛠️',
                'image' => '/images/glasfaser_tiefbau.avif',
                'position' => 1,
                'is_active' => true,
            ]);
        }
    }
}
