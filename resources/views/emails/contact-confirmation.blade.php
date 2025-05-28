<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8" />
    <title>Ihre Anfrage bei ANTASUS Infra</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f4f4f4;
            padding: 2rem;
            color: #333;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        .header {
            background: linear-gradient(to right, #0d9488, #6366f1);
            color: white;
            padding: 1.5rem 2rem;
        }

        .header h1 {
            margin: 0;
            font-size: 1.75rem;
        }

        .content {
            padding: 2rem;
        }

        .content p {
            font-size: 1rem;
            margin-bottom: 1.2rem;
            line-height: 1.6;
        }

        .footer {
            font-size: 0.875rem;
            padding: 1.5rem 2rem;
            background: #f9fafb;
            color: #6b7280;
        }

        .logo {
            font-size: 1.25rem;
            font-weight: bold;
            letter-spacing: 0.5px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <div class="logo">ANTASUS Infra</div>
        </div>
        <div class="content">
            <p>Hallo {{ $data['name'] }},</p>
            <p>vielen Dank für Ihre Kontaktaufnahme mit <strong>ANTASUS Infra</strong>.</p>
            <p>
                Wir haben Ihre Nachricht erhalten und werden uns so schnell wie möglich bei Ihnen melden.
                In dringenden Fällen erreichen Sie uns auch telefonisch unter:
            </p>
            <p style="font-weight: bold; font-size: 1.1rem;">📞 +49 176 24757616</p>
            <p>Wir freuen uns auf die Zusammenarbeit.</p>
            <p>Herzliche Grüße<br><strong>Ihr ANTASUS Infra Team</strong></p>
        </div>
        <div class="footer">
            <p>
                ANTASUS Infra – Inh. Radhouan Jouini<br>
                Norrenbergstraße 122, 42289 Wuppertal<br>
                📧 info@antasus.de · 🌐 www.antasus.de
            </p>
            <p>Diese E-Mail wurde automatisch versendet. Bitte antworten Sie nicht direkt darauf.</p>
        </div>
    </div>
</body>

</html>
