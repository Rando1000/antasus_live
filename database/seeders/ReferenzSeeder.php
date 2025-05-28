<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Referenz;
use Illuminate\Support\Str;

class ReferenzSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   public function run()
    {
        $referenzen = [
            [
                'titel' => 'FTTH-Ausbau Amsterdam',
                'beschreibung' => 'Komplette Umsetzung von Tiefbau, Hausanschlüssen und Dokumentation.',
                'slug' => Str::slug('FTTH-Ausbau Amsterdam'),
                'ort' => 'Amsterdam',
                'bilder' => ['/images/Amsterdam.avif'],
            ],
            [
                'titel' => 'Glasfasererschließung für Gewerbegebiet Amsterdam',
                'beschreibung' => 'Planung und Bau für mehrere Gewerbeeinheiten nach VDE-Vorgaben.',
                'slug' => Str::slug('Glasfasererschließung für Gewerbegebiet Amsterdam'),
                'ort' => 'Amsterdam',
                'bilder' => ['/images/Amsterdam2.avif'],
            ],
            [
                'titel' => 'Netzmodernisierung Den Haag / Zoetermeer',
                'beschreibung' => 'Bohrung und Innenmontage für über 2300 Haushalte.',
                'slug' => Str::slug('netzmodernisierung-den-haag-/-zoetermeer'),
                'ort' => 'Den Haag / Zoetermeer',
                'bilder' => ['/images/Denhaag.avif'],
            ],
            [
                'titel' => 'Großprojekt Rheinland',
                'beschreibung' => 'Technische Projektleitung im Auftrag eines Generalunternehmens.',
                'slug' => Str::slug('großprojekt-rheinland'),
                'ort' => 'Rheinland',
                'bilder' => ['/images/Rheinland.avif'],
            ],
        ];

        foreach ($referenzen as $ref) {
            Referenz::updateOrCreate(['slug' => $ref['slug']], $ref);
        }
    }
}
