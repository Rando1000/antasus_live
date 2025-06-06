@extends('emails.layouts.layout')

@section('body')
    <p>Guten Tag {{ $recipientName }},</p>

    <p>Für professionelle Glasfaser-Tiefbau-Projekte in NRW sind wir der richtige Partner:</p>

    <table style="width:100%; border-collapse: collapse; margin: 16px 0;">
        <tr style="background-color: #e0fdfa;">
            <th style="padding: 8px; text-align: left;">Leistung</th>
            <th style="padding: 8px; text-align: left;">Beschreibung</th>
        </tr>
        <tr>
            <td style="padding: 8px; border-top:1px solid #dddddd;">Leerrohrverlegung</td>
            <td style="padding: 8px; border-top:1px solid #dddddd;">
                DIN EN 50618 zertifizierte Rohre, vollständige Dokumentation, georeferenzierte Karten
            </td>
        </tr>
        <tr>
            <td style="padding: 8px; border-top:1px solid #dddddd;">Bohrungen &amp; Rohrverbinder</td>
            <td style="padding: 8px; border-top:1px solid #dddddd;">
                Horizontalbohrungen bis 200 m, passgenaue Conduits &amp; Pipes
            </td>
        </tr>
        <tr>
            <td style="padding: 8px; border-top:1px solid #dddddd;">Dokumentation &amp; Tests</td>
            <td style="padding: 8px; border-top:1px solid #dddddd;">
                Abschlussdokumentation nach DIN 18015-5, Qualitäts- &amp; Drucktests
            </td>
        </tr>
    </table>

    <p>Jetzt Anfrage stellen:</p>
    <p style="text-align:center;">
        <a href="https://www.antasus.de/leistungen/glasfaser-tiefbau" class="button" target="_blank">
            Mehr erfahren &amp; Kontakt
        </a>
    </p>

    <p>Mit freundlichen Grüßen,<br>
        Ihr Team von ANTASUS Infra</p>
@endsection
