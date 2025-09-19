<?php

use App\Http\Controllers\Admin\EmailCampaignController;
use App\Http\Controllers\Admin\EmailPromotionController;
use App\Http\Controllers\Admin\EmailTrackingController;
use App\Http\Controllers\Admin\PendingBookingController as AdminPendingBooking;
use App\Http\Controllers\BookingController;
// Controllers
use App\Http\Controllers\ContactFormController;
use App\Http\Controllers\Frontend\LeistungenController;
use App\Http\Controllers\Frontend\TechnologienController;
use App\Http\Controllers\MeetingBookingController;
use App\Http\Controllers\ReferenzController;
use App\Http\Controllers\SeoController;
use App\Http\Controllers\ServiceItemController;
use App\Http\Middleware\TrackVisitor;
use App\Models\Referenz;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Cookie;
// Models
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
// Helpers
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

// --------- MAIN FRONTEND (mit Besucher-Tracking) ----------
Route::middleware([TrackVisitor::class])->group(function () {

    // --- Startseite / Welcome ---
    Route::get('/', function () {
        return Inertia::render('Welcome', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
        ]);
    })->name('home');

    // --- Leistungen ---
    Route::get('/leistungen', [LeistungenController::class, 'index'])->name('leistungen.index');
    Route::get('/leistungen/{slug}', [LeistungenController::class, 'show'])->name('leistungen.show');
    Route::get('/leistungen/{service:slug}/{item:slug}/{id}', [ServiceItemController::class, 'show'])->name('services.items.show');

    // --- Referenzen ---
    Route::get('/referenzen', [ReferenzController::class, 'index'])->name('referenzen.index');
    Route::get('/referenzen/{slug}', function ($slug) {
        $referenz = Referenz::where('slug', $slug)->firstOrFail();

        return Inertia::render('Referenz/Show', ['referenz' => $referenz]);
    })->name('referenzen.show');

    // --- Rechtliches & Statische Seiten ---
    Route::get('/impressum', fn () => Inertia::render('Impressum'))->name('impressum');
    Route::get('/datenschutz', fn () => Inertia::render('Datenschutz'))->name('datenschutz');
    Route::get('/agb', fn () => Inertia::render('AGB'))->name('agb');

    // --- Kontakt ---
    Route::get('/kontakt', function () {
        return Inertia::render('Kontakt', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
        ]);
    })->name('kontakt');
    Route::post('/kontakt', [ContactFormController::class, 'store'])->name('kontakt.store');
    Route::get('/kontakt/bestaetigt', fn () => Inertia::render('KontaktBestaetigt'))->name('kontakt.bestaetigt');

    // --- SEO & Ratgeber ---
    Route::get('/ratgeber', fn () => Inertia::render('Ratgeber/Index'))->name('ratgeber');
    Route::get('/ratgeber/glasfaser', fn () => Inertia::render('Ratgeber/WasIstGlasfaser'))->name('ratgeber.glasfaser');
    Route::get('/ratgeber/dsl-vs-glasfaser', fn () => Inertia::render('Ratgeber/DslVsGlasfaser'))->name('ratgeber.dslvsglasfaser');
    Route::get('/ratgeber/ftth-fiber-to-the-home', fn () => Inertia::render('Ratgeber/FtthFiberToTheHome'))->name('ratgeber.ftthfibertothehome');
    Route::get('/ratgeber/how-to-get-ftth', fn () => Inertia::render('Ratgeber/HowToGetFtth'))->name('ratgeber.howtogetftth');
    Route::get('/glasfaserbau', [SeoController::class, 'pillar'])->name('seo.pillar');
    Route::get('/ratgeber/technologien', [TechnologienController::class, 'index'])->name('technologien');

    // --- Sitemap.xml ---
    Route::get('/sitemap.xml', function () {
        $now = Carbon::now();
        $sitemap = Sitemap::create()
            ->add(Url::create('/')->setPriority(1.0)->setLastModificationDate($now->copy()->subDay()))
            ->add(Url::create('/leistungen')->setPriority(0.9)->setLastModificationDate($now->copy()->subDay()))
            ->add(Url::create('/referenzen')->setPriority(0.8)->setLastModificationDate($now->copy()->subDay()))
            ->add(Url::create('/kontakt')->setPriority(0.8)->setLastModificationDate($now->copy()->subDay()))
            ->add(Url::create('/impressum')->setPriority(0.5))
            ->add(Url::create('/datenschutz')->setPriority(0.5))
            ->add(Url::create('/agb')->setPriority(0.5))
            ->add(Url::create('/ratgeber')->setPriority(0.7)->setLastModificationDate($now->copy()->subDay()))
            ->add(Url::create('/ratgeber/glasfaser')->setPriority(0.9)->setLastModificationDate(Carbon::create('2025-06-21')))
            ->add(Url::create('/ratgeber/dsl-vs-glasfaser')->setPriority(0.9)->setLastModificationDate(Carbon::create('2025-06-22')))
            ->add(Url::create('/ratgeber/ftth-fiber-to-the-home')->setPriority(0.9)->setLastModificationDate(Carbon::create('2025-06-22')))
            ->add(Url::create('/glasfaserbau')->setPriority(0.8)->setLastModificationDate($now->copy()->subWeek()))
            ->add(Url::create('/ratgeber/technologien')->setPriority(0.8)->setLastModificationDate($now->copy()->subWeek()));

        Referenz::all()->each(function ($ref) use ($sitemap, $now) {
            if ($ref->slug) {
                $sitemap->add(
                    Url::create("/referenzen/{$ref->slug}")
                        ->setPriority(0.5)
                        ->setLastModificationDate($ref->updated_at ?? $now)
                );
            }
        });
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

    // --- Fallback als letzte Route ---
    Route::fallback(fn () => Inertia::render('InProgress'));
});

// --------- AUTHENTIFIZIERUNG UND BERECHTIGUNGEN -----------
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', fn () => Inertia::render('Dashboard'))->name('dashboard');
});

// Kundenbereich
Route::middleware(['auth', 'role:kunde'])->group(function () {
    Route::get('/kundenbereich', fn () => Inertia::render('Dashboard'))->name('kunde.dashboard');
});

// Adminbereich
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->group(function () {
        // Admin-spezifische Routen
        Route::get('emailcampaign', [EmailCampaignController::class, 'index'])->name('admin.emailcampaign.index');
        Route::get('emailcampaign/create', [EmailCampaignController::class, 'create'])->name('admin.emailcampaign.create');
        Route::put('emailkonverse/{campaign}', [EmailCampaignController::class, 'update'])->name('admin.email.update');
        Route::post('emailcampaign/send', [EmailCampaignController::class, 'send'])->name('admin.emailcampaign.send');
        Route::get('/email/{type}/{token}', [EmailCampaignController::class, 'track'])->where(['type' => 'open|click', 'token' => '[\w\-]+']);
        Route::delete('/emailcampaign/{id}', [EmailCampaignController::class, 'destroy'])->name('admin.emailcampaign.destroy');
        Route::post('/emailcampaign/bulk-delete', [EmailCampaignController::class, 'bulkDelete'])->name('admin.emailcampaign.bulkDelete');
        // Weitere Adminrouten hier ergänzen ...
    });

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('admin/emailkonverse', [EmailPromotionController::class, 'showForm'])->name('admin.email.form');
    Route::post('admin/email/send', [EmailPromotionController::class, 'send'])->name('admin.email.send');
    Route::post('/bookings/multi', [BookingController::class, 'storeMulti'])->name('bookings.storeMulti');
});

Route::middleware(['auth', 'role:admin'])->get('/redirect-after-login', function () {
    return auth()->user()->role === 'admin'
        ? redirect()->route('admin.dashboard')
        : redirect()->route('kunde.dashboard');
});

// -------------- Cookies / Consent ----------------
Route::post('/cookie-consent/accept', function () {
    Cookie::queue(cookie()->forever(config('cookie-consent.cookie_name'), 'true'));

    return back();
})->name('cookie-consent.accept');

Route::post('/cookie-consent/decline', function () {
    return redirect()->back()
        ->withCookie(cookie(config('cookie-consent.cookie_name'), 'declined', 60 * 24 * 365));
})->name('cookie-consent.decline');

// --------- BUCHUNGSSYSTEM ---------
Route::post('/bookings', [MeetingBookingController::class, 'store'])->name('bookings.store');
Route::get('/bookings/confirm/{token}', [BookingController::class, 'confirm'])->name('bookings.confirm');
Route::get('/buchung/bestaetigen/{token}', [MeetingBookingController::class, 'confirm'])->name('booking.confirm');

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('pending-bookings', [AdminPendingBooking::class, 'index'])->name('pending.index');
    Route::post('pending-bookings/{id}/confirm', [AdminPendingBooking::class, 'confirm'])->name('pending.confirm');
    Route::post('pending-bookings/{id}/resend', [AdminPendingBooking::class, 'resend'])->name('pending.resend');
    Route::delete('pending-bookings/{id}', [AdminPendingBooking::class, 'destroy'])->name('pending.destroy');
});

// --------- EMAIL TRACKING ---------
Route::get('/email/open/{token}', [EmailTrackingController::class, 'open'])->name('email.open');
Route::get('/email/click/{token}', [EmailTrackingController::class, 'click'])->name('email.click');

// --------- BACKEND/ADMIN Extra-Routen aus externer Datei ---------
require __DIR__.'/backadmin.php';
// Route::get('/active-visitors-history', [\App\Http\Controllers\Admin\ActiveVisitorsController::class, 'history']);

// --------- (Optional) Letzte Fallback-Route ---------
// Route::fallback(fn () => Inertia::render('InProgress'));
