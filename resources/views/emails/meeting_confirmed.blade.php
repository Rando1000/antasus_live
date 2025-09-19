{{-- resources/views/emails/meeting_confirmed.blade.php --}}
<p>Hallo {{ $meeting->name }},</p>
<p>Ihr Termin wurde bestätigt:</p>
<ul>
    <li><strong>Typ:</strong> {{ $meeting->type }}</li>
    <li><strong>Modus:</strong> {{ $meeting->mode }}</li>
    <li><strong>Start:</strong> {{ $meeting->start }}</li>
    <li><strong>Ende:</strong> {{ $meeting->end }}</li>
</ul>
<p>Vielen Dank!<br>Antasus Infra</p>
