<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactFormRequest;
use App\Mail\ContactConfirmationMail;
use App\Mail\ContactFormMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\RedirectResponse;

class ContactFormController extends Controller
{
    public function store(ContactFormRequest $request): RedirectResponse
    {
        Mail::to(config('mail.from.address'))->send(new ContactFormMail($request->validated()));
        Mail::to(config('mail.from.address'))->send(new ContactFormMail($request->validated()));
        Mail::to($request->email)->send(new ContactConfirmationMail($request->validated()));

        return redirect()->route('kontakt.bestaetigt');
    }
}
