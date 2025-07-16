<?php
// config/email-templates.php

return [
    'vorlagen' => [
        'einladung' => [
            'label'   => 'Einladung zur Zusammenarbeit',
            'subject' => 'Einladung: Kappa-Angebot Hausanschlüsse HAS FTTH',
            'body'    => <<<'HTML'
<p>Hallo {{ recipient_name }},</p>

<p>wir von <strong>ANTASUS Infra</strong> möchten Ihnen unsere Expertise im Glasfaserausbau vorstellen.<br>
Als erfahrener Subunternehmer für Generalunternehmen bieten wir Ihnen:</p>

<ul>
    <li>Professionelles Projektmanagement & Bauleitung nach VOB/B und DIN 18220</li>
    <li>Komplettdienstleistungen: Tiefbau, Planung, Hausanschlüsse</li>
    <li>Georeferenzierte Dokumentation, Fertigstellungstests & digitale Abnahme</li>
    <li>Flexible, skalierbare Kapazitäten für Ihr Projektgeschäft</li>
</ul>

<p>Unser Team aus qualifizierten Bauleiter:innen, erfahrenen Projektleiter:innen und deutschsprachigen Fachkräften sorgt für höchste Qualität und Termintreue.</p>

<p>Gern vereinbaren wir ein unverbindliches Gespräch.<br>
Antworten Sie einfach auf diese E-Mail – wir freuen uns auf Ihre Nachricht!</p>

<p>Beste Grüße<br>
Ihr ANTASUS Infra Team</p>
HTML
        ],
        'angebot' => [
            'label'   => 'Individuelles Projektangebot',
            'subject' => 'Ihr maßgeschneidertes Glasfaser-Angebot von ANTASUS Infra',
            'body'    => <<<'HTML'
<p>Guten Tag {{ recipient_name }},</p>

<p>vielen Dank für Ihr Interesse am Thema Glasfaserausbau. Wir bieten Ihnen ein individuell kalkuliertes Angebot inklusive folgender Leistungen:</p>

<ul>
    <li>Projektplanung & Genehmigungsmanagement</li>
    <li>Komplettservice: Tiefbau, Montage, Inbetriebnahme</li>
    <li>Georeferenzierte Dokumentation und Abnahmeberichte</li>
    <li>Persönliche Betreuung durch unsere Projektleiter:innen</li>
</ul>

<p>Kontaktieren Sie uns direkt für eine Beratung oder senden Sie uns Ihre Anforderungen.<br>
Wir freuen uns auf die Zusammenarbeit!</p>

<p>Mit freundlichen Grüßen<br>
ANTASUS Infra</p>
HTML
        ],
        // Erweiterbar: z.B. Follow-up, Case Study, Info-Mail, etc.
    ],
];
