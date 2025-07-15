<!DOCTYPE html>
<html lang="de" style="background: #f7fafc; color: #171923;">

<head>
    <meta charset="UTF-8">
    <title>Terminbestätigung | ANTASUS Infra</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            background: #f7fafc;
            color: #171923;
            font-family: 'Inter', Arial, Helvetica, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            background: #fff;
            max-width: 540px;
            margin: 48px auto;
            border-radius: 18px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.07), 0 1.5px 4px rgba(0, 253, 207, 0.09);
            padding: 36px 30px 28px 30px;
        }

        .brand {
            display: flex;
            align-items: center;
            margin-bottom: 22px;
            gap: 10px;
        }

        .brand-logo {
            width: 40px;
            height: 40px;
        }

        .brand-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: #00fdcf;
            letter-spacing: -1px;
        }

        h1 {
            font-size: 2.1rem;
            color: #23272f;
            margin-bottom: 16px;
        }

        p {
            font-size: 1.07rem;
            margin-bottom: 16px;
        }

        .booking-details {
            background: #e6fffa;
            border-left: 4px solid #00fdcf;
            border-radius: 7px;
            padding: 15px 22px;
            margin: 26px 0 20px 0;
            color: #174247;
        }

        .cta-btn {
            display: inline-block;
            background: linear-gradient(90deg, #00fdcf 0, #3f51b5 100%);
            color: #0000;
            font-weight: 600;
            text-decoration: none;
            padding: 12px 34px;
            border-radius: 11px;
            font-size: 1.14rem;
            margin-top: 8px;
            box-shadow: 0 2px 12px #00fdcf20;
            transition: background .2s, transform .2s;
        }

        .cta-btn:hover {
            background: linear-gradient(90deg, #00fdcf 30%, #174247 100%);
            transform: translateY(-2px) scale(1.03);
        }

        .footer {
            margin-top: 40px;
            font-size: 0.97rem;
            color: #666;
            text-align: center;
        }

        @media (max-width: 600px) {
            .container {
                padding: 16px 7vw 16px 7vw;
            }

            h1 {
                font-size: 1.3rem;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Branding -->
        <div class="brand">
            <img class="brand-logo" src="{{ asset('images/antasus-logo.svg') }}" alt="ANTASUS Infra Logo">
            <span class="brand-title">ANTASUS Infra</span>
        </div>

        <h1>Terminbestätigung</h1>

        <p>Hallo {{ $booking['name'] }},</p>

        <p>
            Sie haben erfolgreich einen Termin für ein
            <strong>
                {{ $booking->type === 'online' ? 'Online-Meeting' : 'Präsenz-Meeting' }}
            </strong>
            bei ANTASUS Infra gebucht.
        </p>

        <div class="booking-details">
            <p><strong>Datum:</strong> {{ \Carbon\Carbon::parse($booking['start'])->format('d.m.Y, H:i') }} bis
                {{ \Carbon\Carbon::parse($booking['end'])->format('H:i') }}</p>
            <p><strong>Thema:</strong> {{ $booking['topic'] }}</p>
        </div>

        <p>
            <strong>Bitte bestätigen Sie jetzt Ihren Termin</strong>, damit wir alles optimal für Sie vorbereiten
            können. Erst nach der Bestätigung ist Ihr Termin verbindlich für Sie reserviert.
        </p>

        <p style="text-align:center;">
            <a href="{{ url('/buchung/bestaetigen/' . $booking['token']) }}" style="cta-btn">
                Termin verbindlich bestätigen
            </a>
        </p>

        <p>
            Sollten Sie Fragen haben oder den Termin nicht wahrnehmen können, kontaktieren Sie uns einfach per E-Mail an
            <a href="mailto:info@antasus.de" style="color:#00fdcf; text-decoration:underline;">info@antasus.de</a>
            oder telefonisch unter <span style="white-space:nowrap;">+49 176 24757616</span>.
        </p>

        <div class="footer">
            &copy; {{ now()->year }} ANTASUS Infra. Ihr Partner für Glasfaser-Infrastruktur & Projekterfolg.
        </div>
    </div>
</body>

</html>
