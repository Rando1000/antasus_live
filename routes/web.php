<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cookie;
use App\Http\Controllers\ContactFormController;
use App\Http\Controllers\SeoController;
use App\Http\Controllers\ReferenzController;
use App\Http\Controllers\MeetingBookingController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\Frontend\LeistungenController;
use App\Http\Controllers\ServiceItemController;
use App\Http\Controllers\Admin\EmailCampaignController;
use App\Http\Controllers\Admin\EmailPromotionController;
use App\Http\Controllers\Admin\EmailTrackingController;
use App\Http\Controllers\Frontend\TechnologienController;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use App\Models\Referenz;
use App\Models\Service;
use Carbon\Carbon;
use Inertia\Inertia;

//define('HOME', '/redirect-after-login');

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});



//-----Leistungen-Bereich-----------
Route::get('/leistungen', [LeistungenController::class, 'index'])->name('leistungen.index');
Route::get('/leistungen/{service:slug}/{item:slug}/{id}', [ServiceItemController::class, 'show'])->name('services.items.show');
// Route::get('/leistungen/{serviceSlug}/{itemSlug}/{item}', [ServiceItemController::class, 'show'])
//     ->name('services.items.show.item');


// Kategorieseite mit allen Items (inkl. Modal-Mechanik)
Route::get('/leistungen/{slug}', [LeistungenController::class, 'show'])->name('leistungen.show');


// Detailansicht eines Items (SEO-optimiert, direkte URL)
// Route::get('/leistungen/{slug}/item/{item}', [LeistungenController::class, 'item'])->name('leistungen.item.show');

//--------------------------------

//-----Referenzen-Bereich-----------

Route::get('/referenzen', [ReferenzController::class, 'index'])->name('referenzen.index');
Route::get('/referenzen/{slug}', [ReferenzController::class, 'show'])->name('referenzen.show');
Route::get('/referenzen/{slug}', function ($slug) {
    $referenz = Referenz::where('slug', $slug)->firstOrFail();

    return Inertia::render('Referenz/Show', [
        'referenz' => $referenz,
    ]);
})->name('referenzen.show');

//--------------------------------

//-----Impressum-Bereich-----------
Route::get('/impressum', fn () => Inertia::render('Impressum'))->name('impressum');
//--------------------------------

//-----Datenschutz-Bereich-----------
Route::get('/datenschutz', fn () => Inertia::render('Datenschutz'))->name('datenschutz');
//--------------------------------

//-----AGB's-Bereich-----------
Route::get('/agb', fn () => Inertia::render('AGB'))->name('agb');
//--------------------------------

//-----Kontakt-Bereich-----------
Route::get('/kontakt', function () {
    return Inertia::render('Kontakt', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::post('/kontakt', [ContactFormController::class, 'store'])->name('kontakt.store');
Route::get('/kontakt/bestaetigt', fn () => Inertia::render('KontaktBestaetigt'))->name('kontakt.bestaetigt');

//--------------------------------

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});

//-----------------------------------------------------------

// Kunden-Bereich (nur für Rolle "kunde")
Route::middleware(['auth', 'role:kunde'])->group(function () {
    Route::get('/kundenbereich', fn () => Inertia::render('Dashboard'))->name('kunde.dashboard');
});

// Admin-Bereich (nur für Rolle "admin")
// Route::middleware(['auth', 'role:admin'])->group(function () {
//     Route::get('/admin', fn () => Inertia::render('Admin/Dashboard'))->name('admin.dashboard');
// });

Route::middleware(['auth', 'role:admin'])->get('/redirect-after-login', function () {
    if (auth()->user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }

    return redirect()->route('kunde.dashboard');
});

//------------------------------------------------------------

//--------------SiteMap.xml_Route-Sitemap_automatischer_ERzeuger----------------------------------

Route::get('/sitemap.xml', function () {
    $now = Carbon::now();

    $sitemap = Sitemap::create()
        // ———————————————— Statische Seiten ————————————————
        ->add(Url::create('/')
            ->setPriority(1.0)
            ->setLastModificationDate($now->copy()->subDay()))
        ->add(Url::create('/leistungen')
            ->setPriority(0.9)
            ->setLastModificationDate($now->copy()->subDay()))
        ->add(Url::create('/referenzen')
            ->setPriority(0.8)
            ->setLastModificationDate($now->copy()->subDay()))
        ->add(Url::create('/kontakt')
            ->setPriority(0.8)
            ->setLastModificationDate($now->copy()->subDay()))
        ->add(Url::create('/impressum')->setPriority(0.5))
        ->add(Url::create('/datenschutz')->setPriority(0.5))
        ->add(Url::create('/agb')->setPriority(0.5))

        // —————————————— Ratgeber & Wissen ——————————————
        ->add(Url::create('/ratgeber')
            ->setPriority(0.7)
            ->setLastModificationDate($now->copy()->subDay()))
        ->add(Url::create('/ratgeber/glasfaser')
            ->setPriority(0.9)
            ->setLastModificationDate(Carbon::create('2025-06-21')))
        ->add(Url::create('/ratgeber/dsl-vs-glasfaser')
            ->setPriority(0.9)
            ->setLastModificationDate(Carbon::create('2025-06-22')))
        ->add(Url::create('/ratgeber/ftth-fiber-to-the-home')
            ->setPriority(0.9)
            ->setLastModificationDate(Carbon::create('2025-06-22')))
        ->add(Url::create('/glasfaserbau')
            ->setPriority(0.8)
            ->setLastModificationDate($now->copy()->subWeek()))
        ->add(Url::create('/ratgeber/technologien')
            ->setPriority(0.8)
            ->setLastModificationDate($now->copy()->subWeek()));

    // —————————————— Dynamische Referenzen ——————————————
    Referenz::all()->each(function ($ref) use ($sitemap, $now) {
        if ($ref->slug) {
            $sitemap->add(
                Url::create("/referenzen/{$ref->slug}")
                    ->setPriority(0.5)
                    ->setLastModificationDate($ref->updated_at ?? $now)
            );
        }
    });

    // —————————————— Dynamische Services ——————————————
    Service::all()->each(function ($service) use ($sitemap, $now) {
        if ($service->slug) {
            $sitemap->add(
                Url::create("/leistungen/{$service->slug}")
                    ->setPriority(0.9)
                    ->setLastModificationDate($service->updated_at ?? $now)
            );
        }
    });

    return $sitemap->toResponse(request());
});

//------------------------------------------------------------
//------------------------------------------------------------

//------------------------------------------------------------
//------------------------------------------------------------
Route::get('/in-arbeit', function () {
    return Inertia::render('InProgress');
})->name('in-arbeit');
Route::get('/inprogress', function () {
    return Inertia::render('InProgress');
})->name('inprogress');

// Route::get('/{any}', function () {
//     return Inertia::render('InProgress');
// })->where('any', '.*');
//------------------------------------------------------------
//------------------------------------------------------------
Route::get('/email/open/{token}', [EmailTrackingController::class, 'open'])->name('email.open');
Route::get('/email/click/{token}', [EmailTrackingController::class, 'click'])->name('email.click');
//------------------------------------------------------------
//------------------------------------------------------------
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->group(function() {
        // Seite zum Verfassen (GET) und Senden (POST) von Kampagnen-Mails
        Route::get('emailcampaign', [EmailCampaignController::class, 'index'])
            ->name('admin.emailcampaign.index');
        Route::get('emailcampaign/create', [EmailCampaignController::class, 'create'])
            ->name('admin.emailcampaign.create');
        Route::put('emailkonverse/{campaign}', [EmailCampaignController::class,'update'])
            ->name('admin.email.update');
        Route::post('emailcampaign/send', [EmailCampaignController::class, 'send'])
            ->name('admin.emailcampaign.send');
        // Tracking:
        Route::get('/email/{type}/{token}', [EmailCampaignController::class, 'track'])
            ->where(['type' => 'open|click', 'token' => '[\w\-]+']);
    });

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('admin/emailkonverse', [EmailPromotionController::class, 'showForm'])
         ->name('admin.email.form');
    Route::post('admin/email/send',     [EmailPromotionController::class, 'send'])
         ->name('admin.email.send');
    Route:: post('/bookings/multi', [BookingController::class, 'storeMulti'])->name('bookings.storeMulti');
});

//------------------------------------------------------------
//------------------------------------------------------------

//------------------------------------------------------------



//------------------Spati_Cookies-----------------------------
Route::post('/cookie-consent/accept', function () {
    Cookie::queue(cookie()->forever(config('cookie-consent.cookie_name'), 'true'));
    return back();
})->name('cookie-consent.accept');

Route::post('/cookie-consent/decline', function () {
    return redirect()->back()
        ->withCookie(cookie(config('cookie-consent.cookie_name'), 'declined', 60 * 24 * 365));
})->name('cookie-consent.decline');

//-----------------Spati_Cookies-END--------------------------


//----------------Buchungssytem_Routes------------------------

Route::post('/bookings', [MeetingBookingController::class, 'store'])->name('bookings.store');
Route::get('/bookings/confirm/{token}', [BookingController::class, 'confirm'])->name('bookings.confirm');
Route::get('/buchung/bestaetigen/{token}', [MeetingBookingController::class, 'confirm'])->name('booking.confirm');

//----------------Buchungssystem_Ende-------------------------

//------------------Google-AI-SEO_Ratgeberseiten--------------

Route::get('/ratgeber', function () {
    return Inertia::render('Ratgeber/Index');
})->name('ratgeber');

Route::get('/ratgeber/glasfaser', function () {
    return Inertia::render('Ratgeber/WasIstGlasfaser');
})->name('ratgeber.glasfaser');
Route::get('/ratgeber/dsl-vs-glasfaser', function () {
    return Inertia::render('Ratgeber/DslVsGlasfaser');
})->name('ratgeber.dslvsglasfaser');
Route::get('/ratgeber/ftth-fiber-to-the-home', function () {
    return Inertia::render('Ratgeber/FtthFiberToTheHome');
})->name('ratgeber.ftthfibertothehome');
Route::get('/ratgeber/how-to-get-ftth', function () {
    return Inertia::render('Ratgeber/HowToGetFtth');
})->name('ratgeber.howtogetftth');
//-----------------------SEO-Pillar-Seite---------------------

Route::get('/glasfaserbau', [SeoController::class, 'pillar'])->name('seo.pillar');
Route::get('ratgeber/technologien', [TechnologienController::class, 'index'])
    ->name('technologien');


//-----------------SEO-Pillar-Seite-END-----------------------
//------------------------------------------------------------
//----------------Google-AI-SEO_Ratgeberseiten----------------
// back
require __DIR__.'/backadmin.php';
