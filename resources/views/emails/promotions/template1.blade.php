@extends('emails.layouts.layout')

@section('body')
    <p>Hallo {{ $recipientName }},</p>

    <p>Sie suchen nach einem zuverlässigen Partner für den Glasfaser-Hausanschluss?
        Bei <strong>ANTASUS Infra</strong> bieten wir Ihnen:</p>

    <ul>
        <li>Fachgerechte Verlegung nach DIN EN 1610 und VDE-Richtlinien</li>
        <li>Schnelle Ausführung, in der Regel in 2–4 Tagen</li>
        <li>Festpreis-Angebot &amp; transparente Kalkulation</li>
    </ul>

    <p>Erfahren Sie mehr auf unserer Website:</p>
    <p style="text-align:center;">
        <a href="https://www.antasus.de/leistungen/hausanschluesse" class="button" target="_blank">
            Jetzt Angebot anfordern
        </a>
    </p>

    <p>Für eine kostenlose Erstberatung können Sie mich jederzeit direkt erreichen:</p>
    <p>
        <strong>Max Mustermann</strong><br>
        Telefon: +49 202 429 88411<br>
        <a href="mailto:max.mustermann@antasus.de">max.mustermann@antasus.de</a>
    </p>

    <p>Beste Grüße,<br>
        Ihr ANTASUS-Team</p>
@endsection
