<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'title' => 'Hausanschlüsse',
                'description' => 'Trasse, Bohrung & Innenmontage – alles aus einer Hand mit deutscher Präzision.',
                'icons' => ['🏠'],
                'image' => '/images/hausanschluss.jpeg',
                'position' => 1,
            ],
            [
                'title' => 'Glasfaser-Tiefbau',
                'description' => 'DIN- & VDE-gerechte Leerrohrverlegung mit höchster Qualität und Dokumentation.',
                'icons' => ['🛠️'],
                'image' => '/images/glasfaserbau.jpeg',
                'position' => 2,
            ],
            [
                'title' => 'Projektplanung & Beratung',
                'description' => 'Technische Planung mit Praxisbezug für Generalunternehmer und Bauherren.',
                'icons' => ['📊'],
                'image' => '/images/planung.jpg',
                'position' => 3,
            ],
            [
                'title' => 'Dokumentation',
                'description' => 'Lückenlose Ausführung nach Auftraggebervorgaben & aktuellen Normen.',
                'icons' => ['📋'],
                'image' => '/images/doku.jpeg',
                'position' => 4,
            ],
        ];

        foreach ($services as $data) {
            Service::updateOrCreate(
                ['slug' => Str::slug($data['title'])],
                [
                    'title' => $data['title'],
                    'slug' => Str::slug($data['title']),
                    'description' => $data['description'],
                    'icons' => json_encode($data['icons']),
                    'image' => $data['image'],
                    'position' => $data['position'],
                    'is_active' => true,
                ]
            );
        }
    }
}

