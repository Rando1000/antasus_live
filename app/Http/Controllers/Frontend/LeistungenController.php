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

    public function show(string $slug)
    {
        $service = Service::with(['items' => fn($q) => $q->orderBy('position')])
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        //
        // 1) Service-Schema
        //
        $servicesJsonLd = [
            '@context'      => 'https://schema.org',
            '@type'         => 'Service',
            '@id'           => route('leistungen.show', $slug) . '#service',
            'name'          => $service->title,
            'description'   => $service->description,
            'serviceType'   => 'Glasfaserinstallation',
            'provider'      => [
                '@type' => 'Organization',
                'name'  => 'ANTASUS Infra',
                'url'   => url('/'),
                'address' => [
                    '@type'           => 'PostalAddress',
                    'streetAddress'   => 'Norrenbergstraße 122',
                    'addressLocality' => 'Wuppertal',
                    'postalCode'      => '42289',
                    'addressCountry'  => 'DE',
                ],
                'contactPoint' => [
                    '@type'       => 'ContactPoint',
                    'telephone'   => '+49 176 24757616',
                    'contactType' => 'customer service',
                ],
            ],
            'areaServed' => [
                '@type' => 'Country',
                'name'  => 'Deutschland',
            ],
            'image' => $service->items->pluck('image_url')->first()
                        ?? asset('images/services/standard.jpg'),
            'hasOfferCatalog' => [
                '@type'           => 'OfferCatalog',
                'name'            => 'Leistungspakete von '.$service->title,
                'itemListElement' => $service->items->map(fn($item, $i) => [
                    '@type'    => 'ListItem',
                    'position' => $i+1,
                    'item'     => [
                        '@type'       => 'Service',
                        'name'        => $item->title,
                        'description' => $item->description,
                        'url'         => url("/leistungen/{$service->slug}/item/{$item->id}") . '#item',
                    ],
                ]),
            ],
        ];

        //
        // 2) HowTo-Schema
        //
        $howToJsonLd = [
            '@context'    => 'https://schema.org',
            '@type'       => 'HowTo',
            'name'        => "Anleitung: {$service->title}",
            'description' => $service->description,
            'totalTime'   => 'P1DT2H',
            'supply'      => [
                ['@type' => 'HowToSupply', 'name' => 'Leerrohr'],
                ['@type' => 'HowToSupply', 'name' => 'Glasfaserkabel'],
            ],
            'tool' => [
                ['@type' => 'HowToTool', 'name' => 'Spaten'],
                ['@type' => 'HowToTool', 'name' => 'Einblasgerät'],
            ],
            'step' => [
                [
                    '@type'    => 'HowToStep',
                    'url'      => url("/leistungen/{$service->slug}") . '#step1',
                    'name'     => 'Planung & Vermessung',
                    'text'     => 'Wir prüfen die Trassenführung und holen Genehmigungen ein.',
                    'position' => 1,
                ],
                // … weitere Schritte analog
            ],
        ];

        return Inertia::render('Leistungen/Show', [
            'service'        => $service,
            'servicesJsonLd' => $servicesJsonLd,
            'howToJsonLd'    => $howToJsonLd,
        ]);
    }
}
