<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>{{ $subjectLine }}</title>
    <style>
        body {
            background: #f4f4f4;
            color: #333;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0
        }

        .wrapper {
            max-width: 600px;
            margin: 0 auto;
            background: #fff;
            border-radius: 6px;
            overflow: hidden;
            box-shadow: 0 0 8px rgba(0, 0, 0, 0.1);
        }

        .header {
            background: #14b8a6;
            padding: 20px;
            text-align: center
        }

        .header img {
            max-height: 50px
        }

        .content {
            padding: 20px;
            line-height: 1.5
        }

        .footer {
            background: #f0f0f0;
            padding: 15px;
            font-size: 12px;
            text-align: center;
            color: #666
        }

        .btn {
            display: inline-block;
            background: #14b8a6;
            color: #fff;
            padding: 10px 20px;
            border-radius: 50%;
            text-decoration: none
        }
    </style>
</head>

<body>
    {{-- Versteckter Preheader --}}
    <div style="display:none;font-size:1px;line-height:1px;max-height:0;max-width:0;opacity:0;overflow:hidden;">
        {{ $preheader ?? \Illuminate\Support\Str::limit(strip_tags($htmlBody), 100) }}
    </div>

    <table width="100%" cellpadding="0" cellspacing="0" role="presentation">
        <tr>
            <td align="center">
                <div class="wrapper">
                    <div class="header">
                        <img src="https://www.antasus.de/images/antasus-logo2.svg" alt="ANTASUS Infra" />
                    </div>
                    <div class="content">
                        {!! $htmlBody !!}
                    </div>

                    @if ($ctaUrl && $ctaLabel)
                        <div class="content" style="text-align:center;padding-bottom:20px;">
                            <a href="{{ $ctaUrl }}" class="btn" target="_blank">{{ $ctaLabel }}</a>
                        </div>
                    @endif

                    <div class="footer">
                        <p style="margin:0 0 4px;">
                            ANTASUS Infra<br>
                            Norrenbergstraße 122, 42289 Wuppertal
                        </p>
                        <p style="margin:0;">
                            <a href="https://www.antasus.de/impressum">Impressum</a> |
                            <a href="https://www.antasus.de/datenschutz">Datenschutz</a>
                        </p>
                    </div>
                </div>
            </td>
        </tr>
    </table>
</body>

</html>
