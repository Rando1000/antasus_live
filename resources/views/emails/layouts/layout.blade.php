{{-- resources/views/emails/layout.blade.php --}}
<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $subject ?? 'ANTASUS Infra' }}</title>
    <style>
        /* Grundlegende Inline-CSS-Regeln für bestmögliche Kompatibilität */
        body {
            margin: 0;
            padding: 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            background-color: #f5f5f5;
            color: #333333;
        }

        a {
            color: #0d9488;
            /* teal-600 */
            text-decoration: none;
        }

        .wrapper {
            width: 100%;
            table-layout: fixed;
            background-color: #f5f5f5;
            padding-bottom: 40px;
        }

        .main {
            background-color: #ffffff;
            margin: 0 auto;
            width: 100%;
            max-width: 600px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .header {
            background-color: #0d9488;
            /* teal-600 */
            padding: 20px;
            text-align: center;
        }

        .header img {
            max-width: 180px;
            height: auto;
        }

        .content {
            padding: 24px 30px;
        }

        .footer {
            background-color: #f0fdfa;
            /* teal-50 */
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #555555;
        }

        .button {
            display: inline-block;
            background-color: #0d9488;
            color: #ffffff;
            padding: 12px 24px;
            border-radius: 4px;
            margin-top: 16px;
            text-transform: uppercase;
            font-weight: 600;
        }
    </style>
</head>

<body>
    <table class="wrapper" cellpadding="0" cellspacing="0" role="presentation">
        <tr>
            <td align="center">
                <table class="main" cellpadding="0" cellspacing="0" role="presentation">
                    {{-- Header mit Logo --}}
                    <tr>
                        <td class="header">
                            <a href="https://www.antasus.de" target="_blank">
                                <img src="https://www.antasus.de/images/favicon.svg" alt="ANTASUS Infra Logo">
                            </a>
                        </td>
                    </tr>

                    {{-- Dynamischer Inhalt --}}
                    <tr>
                        <td class="content">
                            @yield('body')
                        </td>
                    </tr>

                    {{-- Footer --}}
                    <tr>
                        <td class="footer">
                            ANTASUS Infra<br>
                            Norrenbergstraße 122, 42289 Wuppertal<br>
                            <a href="mailto:info@antasus.de">info@antasus.de</a> |
                            <a href="https://www.antasus.de">www.antasus.de</a><br>
                            © {{ date('Y') }} ANTASUS Infra - Alle Rechte vorbehalten.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
