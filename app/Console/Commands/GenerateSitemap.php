<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use App\Models\Service;
use App\Models\Referenz;
use Carbon\Carbon;

class GenerateSitemap extends Command
{
    protected $signature = 'sitemap:generate';
    protected $description = 'Generiert die sitemap.xml und speichert sie öffentlich';

    public function handle()
    {
        $sitemap = Sitemap::create();

        // Statische Seiten
        $sitemap
            ->add(Url::create('/')->setPriority(1.0)->setLastModificationDate(Carbon::now()->subDay()))
            ->add(Url::create('/leistungen')->setPriority(0.9))
            ->add(Url::create('/referenzen')->setPriority(0.8))
            ->add(Url::create('/kontakt')->setPriority(0.7))
            ->add(Url::create('/impressum')->setPriority(0.3))
            ->add(Url::create('/datenschutz')->setPriority(0.3))
            ->add(Url::create('/agb')->setPriority(0.3));

        // Dynamische Services
        Service::select('slug', 'updated_at')->get()->each(function ($service) use ($sitemap) {
            if ($service->slug) {
                $sitemap->add(
                    Url::create("/leistungen/{$service->slug}")
                        ->setPriority(0.9)
                        ->setLastModificationDate($service->updated_at ?? now())
                );
            }
        });

        // Dynamische Referenzen
        Referenz::select('slug', 'updated_at')->get()->each(function ($referenz) use ($sitemap) {
            if ($referenz->slug) {
                $sitemap->add(
                    Url::create("/referenzen/{$referenz->slug}")
                        ->setPriority(0.5)
                        ->setLastModificationDate($referenz->updated_at ?? now())
                );
            }
        });

        $sitemap->writeToFile(public_path('sitemap.xml'));

        $this->info('sitemap.xml wurde erfolgreich erzeugt.');
    }
}
