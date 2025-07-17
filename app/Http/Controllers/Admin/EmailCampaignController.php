<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\EmailCampaign;
use App\Mail\GenericCampaignMail;
use Illuminate\Support\Str;
use Inertia\Inertia;

class EmailCampaignController extends Controller
{
    public function index()
    {
        $campaigns = EmailCampaign::orderByDesc('sent_at')->get();
        return Inertia::render('Admin/EmailCampaignIndex', [
            'campaigns' => $campaigns,
        ]);
    }

    public function create()
    {
        $templates = collect(config('email-templates.vorlagen'))
            ->map(fn($tpl, $key) => ['key' => $key, 'label' => $tpl['label']])
            ->values();

        $fullTemplates = config('email-templates.vorlagen');

        return Inertia::render('Admin/EmailCampaign', [
            'templates' => $templates,
            'fullTemplates' => $fullTemplates,
        ]);
    }

    public function send(Request $request)
{
    $data = $request->validate([
        'to_email'     => 'required|email',
        'to_name'      => 'nullable|string|max:255',
        'template_key' => 'required|string|in:' . implode(',', array_keys(config('email-templates.vorlagen'))),
        'subject'      => 'required|string|max:255',
        'body'         => 'required|string',
    ]);
    $token = (string) Str::uuid();

    // 1. Personalisierung (Name einfügen)
    $body = str_replace(
        '{{ recipient_name }}',
        $data['to_name'] ?: $data['to_email'],
        $data['body']
    );

    // 2. Alle Links im Body für Klicktracking ersetzen (egal ob Vorlage, Editor oder Blade)
    $body = preg_replace_callback(
    '/<a\s+[^>]*href="([^"]+)"[^>]*>/is',
    function ($matches) use ($token) {
        $original = $matches[1];
        if (str_contains($original, '/email/click/')) return $matches[0];
        $trackUrl = route('email.click', $token) . '?url=' . urlencode($original);
        return str_replace($original, $trackUrl, $matches[0]);
    },
    $body
);
// 3. Open-Pixel anhängen
    $body .= '<img src="' . route('email.open', $token) . '" width="1" height="1" style="display:none" alt="" />';

// CTA-Button und Footer-Links "manuell" auch als Tracking-Link bauen:
$ctaUrl      = 'https://www.antasus.de/kontakt';
$ctaUrlTrack = route('email.click', $token) . '?url=' . urlencode($ctaUrl);

// Footer-Links – Beispiel
$footerLinks = [
    'https://www.antasus.de',
    'https://www.antasus.de/impressum',
    'https://www.antasus.de/datenschutz',
];
$footerTrack = [];
foreach ($footerLinks as $link) {
    $footerTrack[] = route('email.click', $token) . '?url=' . urlencode($link);
}
$ctaLabel = 'Jetzt unverbindlich anfragen';
$preheader = 'Ihre maßgeschneiderte Glasfaser-Lösung wartet!';

// Übergib ALLE getrackten Links ans Blade:
Mail::to($data['to_email'])
    ->send(new GenericCampaignMail(
        $data['subject'],
        $body,
        $preheader,
        $ctaUrlTrack,         // Tracked CTA
        $ctaLabel,
        $footerTrack[0] ?? null, // Tracked Footer 1
        $footerTrack[1] ?? null, // Tracked Footer 2
        $footerTrack[2] ?? null  // Tracked Footer 3
    ));

    // 6. In DB speichern (Tracking-Body)
    EmailCampaign::create([
        'recipient_email' => $data['to_email'],
        'subject'         => $data['subject'],
        'template'        => $data['template_key'],
        'body'            => $body, // TRACKING-BODY mit getrackten Links!
        'sent_at'         => now(),
        'tracking_token'  => $token,
    ]);

    \Log::info('Finaler Mail-Body', ['body' => $body]);

    return back()->with('success', 'E-Mail wurde versendet.');
}

    public function update(Request $request, EmailCampaign $campaign)
    {
        $data = $request->validate([
            'contact_name'  => 'nullable|string|max:100',
            'contact_email' => 'nullable|email|max:100',
            'contact_phone' => 'nullable|string|max:30',
        ]);
        $campaign->update([
            'responded'     => true,
            'responded_at'  => now(),
            'contact_name'  => $data['contact_name'],
            'contact_email' => $data['contact_email'],
            'contact_phone' => $data['contact_phone'],
        ]);
        return redirect()->back()->with('success', 'Kampagne aktualisiert.');
    }
}
