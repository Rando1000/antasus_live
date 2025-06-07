<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\EmailCampaign;
use App\Mail\GenericCampaignMail;
use Inertia\Inertia;


class EmailCampaignController extends Controller
{
   public function index()
    {
        $campaigns = EmailCampaign::orderBy('sent_at','desc')->get();
        return Inertia::render('Admin/EmailCampaignIndex', [
            'campaigns' => $campaigns,
        ]);
    }

    public function create()
    {

          $templates = collect(config('email-templates.vorlagen'))
            ->map(fn($tpl, $key) => [
                'key'   => $key,
                'label' => $tpl['label'],
            ])
            ->values();

        // komplettes Array (key→subject/body) für JS
        $fullTemplates = config('email-templates.vorlagen');

        return Inertia::render('Admin/EmailCampaign', [
            'templates'     => $templates,
            'fullTemplates' => $fullTemplates,
        ]);
        // $templates = collect(config('email-templates.vorlagen'))
        //     ->map(fn($tpl, $key) => [
        //         'key'   => $key,
        //         'label' => $tpl['label'],
        //     ])
        //     ->values();

        // $fullTemplates = config('email-templates.vorlagen');

        // return Inertia::render('Admin/EmailCampaign', [
        //     'templates'     => $templates,
        //     'fullTemplates' => $fullTemplates,
        // ]);
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

        // Name-Platzhalter ersetzen
        $body = str_replace(
            ['{{ recipient_name }}'],
            [$data['to_name'] ?? $data['to_email']],
            $data['body']
        );

        // Optional: Preheader und CTA definieren
        $preheader = 'Ihre maßgeschneiderte Glasfaser-Lösung wartet!';
        $ctaUrl = 'https://www.antasus.de/kontakt';            // deine Kontakt-Route
        $ctaLabel  = 'Jetzt unverbindlich anfragen';

        Mail::to($data['to_email'])
            ->send(new GenericCampaignMail(
                $data['subject'],
                $body,
                $preheader,
                $ctaUrl,
                $ctaLabel
            ));

        // Kampagne speichern
        EmailCampaign::create([
            'recipient_email' => $data['to_email'],
            'subject'         => $data['subject'],
            'template'        => $data['template_key'],
            'body'            => $body,
            'sent_at'         => now(),
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

        return redirect()->back()->with('success','Kampagne aktualisiert.');
    }
}
