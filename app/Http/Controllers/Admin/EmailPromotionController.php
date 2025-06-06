<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\PromotionMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;

class EmailPromotionController extends Controller
{
    public function showForm()
    {
        // Die View „EmailCampaign.vue“ wird aufgerufen
        return Inertia::render('Admin/EmailPromo', [
            'templateOptions' => [
                ['label' => 'Hausanschluss-Angebot', 'view' => 'emails.promotions.template1'],
                ['label' => 'Glasfaser-Tiefbau',     'view' => 'emails.promotions.template2'],
                // usw.
            ],
        ]);
    }

    public function send(Request $request)
    {
        $data = $request->validate([
            'email'      => 'required|email',
            'subject'    => 'required|string|max:120',
            'template'   => 'required|string',
            'customHtml' => 'nullable|string',
        ]);

        // Wenn der Benutzer eine eigene HTML-Passage eingetragen hat,
        // können wir sie temporär in eine Blade-View injizieren.
        // Andernfalls nehmen wir das Standard-Template.
        if (!empty($data['customHtml'])) {
            // temporäre View unter resources/views/emails/dynamic.blade.php schreiben
            file_put_contents(
                resource_path('views/emails/dynamic.blade.php'),
                "@extends('emails.layouts.layout')\n@section('body')\n" . $data['customHtml'] . "\n@endsection"
            );
            $templateView = 'emails.dynamic';
        } else {
            $templateView = $data['template'];
        }

        // Mailable versenden
        Mail::to($data['email'])->send(new PromotionMail(
            $data['email'],        // hier verwenden wir E-Mail als Platzhalter für den Namen
            $templateView,
            $data['subject']
            // eventuelle Zusatzdaten übergeben
        ));

        // Rückmeldung (z.B. Flash-Message)
        return redirect()->back()
            ->with('success', 'Die E-Mail wurde erfolgreich versendet.');
    }
}
