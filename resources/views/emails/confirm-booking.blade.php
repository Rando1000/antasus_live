<h1>Termin bestätigen</h1>

<p>Hallo {{ $booking['name'] }},</p>

<p>Du hast einen Termin für ein {{ $booking->type === 'online' ? 'Online-Meeting' : 'Präsenz-Meeting' }} gebucht.</p>

<p><strong>Datum:</strong> {{ $booking['start'] }} bis {{ $booking['end'] }}</p>
<p><strong>Thema:</strong> {{ $booking['topic'] }}</p>

<p>Bitte bestätige deinen Termin, indem du auf den folgenden Link klickst:</p>

<p>
    <a href="{{ url('/buchung/bestaetigen/' . $booking['token']) }}">
        Buchung bestätigen
    </a>
</p>
