<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Kontaktanfrage</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f4f4f4;
            padding: 2rem;
            color: #333;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background: #fff;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .header {
            border-bottom: 1px solid #ddd;
            margin-bottom: 1.5rem;
        }

        .header h2 {
            margin: 0;
            color: #0d9488;
        }

        .label {
            font-weight: bold;
            margin-top: 1rem;
            color: #111;
        }

        .value {
            margin: 0.25rem 0 1rem;
        }

        .footer {
            margin-top: 2rem;
            font-size: 0.9rem;
            color: #777;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h2>Neue Kontaktanfrage</h2>
            <p>über das Antasus Infra Kontaktformular</p>
        </div>

        <div>
            <div class="label">Name</div>
            <div class="value">{{ $data['name'] }}</div>

            <div class="label">E-Mail</div>
            <div class="value">{{ $data['email'] }}</div>

            <div class="label">Telefon</div>
            <div class="value">{{ $data['phone'] ?? '—' }}</div>

            <div class="label">Rückruf gewünscht</div>
            <div class="value">
                {{ isset($data['callback']) && $data['callback'] ? 'Ja' : 'Nein' }}
            </div>

            <div class="label">Nachricht</div>
            <div class="value">{{ $data['message'] }}</div>
        </div>

        <div class="footer">
            Diese Nachricht wurde automatisch über das Kontaktformular gesendet.
        </div>
    </div>
</body>

</html>
