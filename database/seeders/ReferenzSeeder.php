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
                'beschreibung' => 'Komplette Umsetzung von Tiefbau, Hausanschlüssen und Dokumentation. Im Rahmen des großflächigen FTTH-Ausbaus (Fiber to the Home) in Amsterdam wirkte Antasus Infra an der vollständigen Umsetzung sämtlicher Tiefbauarbeiten, die Installation normgerechter Hausanschlüsse sowie die lückenlose Projektdokumentation.
                    Unsere erfahrenen Fachkräfte sorgten für eine effiziente und termingerechte Verlegung der Glasfaserkabel, wodurch eine zukunftssichere Breitbandanbindung für zahlreiche Privathaushalte und Unternehmen geschaffen wurde.',
                'slug' => Str::slug('FTTH-Ausbau Amsterdam'),
                'ort' => 'Amsterdam',
                'bilder' => ['/images/Amsterdam.avif'],
            ],
            [
                'titel' => 'Glasfasererschließung für Gewerbegebiet Amsterdam',
                'beschreibung' => 'Planung und Bau für mehrere Gewerbeeinheiten nach VDE-Vorgaben. Für ein führendes Gewerbegebiet in Amsterdam plante und realisierte Antasus Glasfaserbau die komplette Glasfasererschließung für mehrere Gewerbeeinheiten. Das Projekt umfasste die detaillierte Netzplanung,
                    die professionelle Ausführung sämtlicher Tiefbauarbeiten sowie die Installation der Glasfaserinfrastruktur nach den aktuellen VDE-Vorgaben. Unsere Leistungen beinhalteten die präzise Verlegung von Glasfaserkabeln, die Einrichtung leistungsfähiger Hausanschlüsse und die fortlaufende Qualitätssicherung während aller Bauphasen. ',
                'slug' => Str::slug('Glasfasererschließung für Gewerbegebiet Amsterdam'),
                'ort' => 'Amsterdam',
                'bilder' => ['/images/Amsterdam2.avif'],
            ],
            [
                'titel' => 'Netzmodernisierung Den Haag / Zoetermeer',
                'beschreibung' => 'Bohrung und Innenmontage für über 2300 Haushalte. Im Zuge der Netzmodernisierung in Den Haag und Zoetermeer führte Antasus Glasfaserbau anspruchsvolle Horizontalbohrungen sowie die komplette Innenmontage für über 2.300 Haushalte durch. Ziel des Projekts war die Modernisierung und Erweiterung der bestehenden Glasfasernetze,
                    um eine leistungsfähige und zukunftssichere Breitbandversorgung zu gewährleisten. Unsere Experten setzten modernste Bohrverfahren ein, um die Glasfaserkabel effizient und mit minimalen Eingriffen in die bestehende Infrastruktur zu verlegen. Die sorgfältige Innenmontage und die abschließende Qualitätskontrolle sicherten eine reibungslose Inbetriebnahme der neuen Netzkomponenten. ',
                'slug' => Str::slug('netzmodernisierung-den-haag-/-zoetermeer'),
                'ort' => 'Den Haag / Zoetermeer',
                'bilder' => ['/images/Denhaag.avif'],
            ],
            [
                'titel' => 'Großprojekt Rheinland',
                'beschreibung' => 'Technische Projektleitung im Auftrag eines Generalunternehmens. Als technischer Projektleiter im Rahmen eines groß angelegten Glasfaserprojekts im Rheinland übernahm Antasus Glasfaserbau die umfassende Steuerung und Koordination aller Bauabschnitte im Auftrag eines Generalunternehmens. Zu den Kernaufgaben zählten die Planung,
                    Überwachung und Qualitätssicherung der Tiefbauarbeiten, die Organisation der Hausanschlüsse sowie die Abstimmung mit allen beteiligten Partnern und Behörden. Durch ein professionelles Projektmanagement, den Einsatz digitaler Tools und die konsequente Umsetzung von Zeit- und Kostenplänen konnte das Projekt effizient und erfolgreich realisiert werden. Antasus Infra steht für zuverlässige Projektabwicklung, hohe Qualitätsstandards und partnerschaftliche Zusammenarbeit im Bereich Glasfaserausbau. Von der ersten Planung bis zur finalen Übergabe an den Auftraggeber.',
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
