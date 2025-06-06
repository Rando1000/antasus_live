<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\GenericCampaignMail;
use Inertia\Inertia;


class EmailCampaignController extends Controller
{
   public function index()
    {
        $templates = collect(config('email-templates.vorlagen'))
            ->map(fn($tpl, $key) => [
                'key'   => $key,
                'label' => $tpl['label'],
            ])
            ->values();

        $fullTemplates = config('email-templates.vorlagen');

        return Inertia::render('Admin/EmailCampaign', [
            'templates'     => $templates,
            'fullTemplates' => $fullTemplates,
        ]);
    }

    public function send(Request $request)
    {
        $data = $request->validate([
            'to_email'       => 'required|email',
            'to_name'        => 'nullable|string|max:255',
            'template_key'   => 'required|string|in:' . implode(',', array_keys(config('email-templates.vorlagen'))),
            'subject'        => 'required|string|max:255',
            'body'           => 'required|string',
        ]);

        // Ersetze Platzhalter {{ recipient_name }} im Body
        $body = str_replace(
            ['{{ recipient_name }}'],
            [$data['to_name'] ?? $data['to_email']],
            $data['body']
        );

        // Versende die E-Mail mit unserem GenericCampaignMail Mailable
        Mail::to($data['to_email'])
            ->send(new GenericCampaignMail($data['subject'], $body));

        return back()->with('success', 'E-Mail wurde versendet.');
    }
}
