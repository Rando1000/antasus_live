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

        // 1. Tracking-Token generieren
        $token = (string) \Illuminate\Support\Str::uuid();

        // 2. Personalisierung/Platzhalter ersetzen
        $body = str_replace('{{ recipient_name }}', $data['to_name'] ?: $data['to_email'], $data['body']);

        // 3. Klicktracking: alle <a href="...">
        $body = preg_replace_callback(
            '/<a\s+[^>]*href="([^"]+)"[^>]*>/i',
            function ($matches) use ($token) {
                $original = $matches[1];
                // Doppelte Ersetzung vermeiden!
                if (str_contains($original, '/email/click/')) return $matches[0];
                $trackUrl = url("/email/click/{$token}?url=" . urlencode($original));
                return str_replace($original, $trackUrl, $matches[0]);
            },
            $body
        );

        // 4. Tracking-Pixel anhängen (Open-Tracking)
        $body .= '<img src="' . url("/email/open/{$token}") . '" width="1" height="1" style="display:none" alt="" />';

        // 5. Mail senden (unbedingt das bearbeitete $body übergeben)
        \Mail::to($data['to_email'])->send(new \App\Mail\GenericCampaignMail(
            $data['subject'],
            $body,
            'Ihre maßgeschneiderte Glasfaser-Lösung wartet!',
            'https://www.antasus.de/kontakt',
            'Jetzt unverbindlich anfragen'
        ));

        // 6. Mail-Kampagne inkl. Token speichern
        \App\Models\EmailCampaign::create([
            'recipient_email' => $data['to_email'],
            'subject'         => $data['subject'],
            'template'        => $data['template_key'],
            'body'            => $body,
            'sent_at'         => now(),
            'tracking_token'  => $token,
        ]);

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
