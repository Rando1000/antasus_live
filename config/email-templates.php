<?php
// config/email-templates.php

return [
    'vorlagen' => [
        'einladung' => [
            'label'   => 'Einladung zur Zusammenarbeit',
            'subject' => 'Einladung: Kappa-Angebot Hausanschlüsse HAS FTTH',
            'body'    => <<<'HTML'
<p>Hallo {{ recipient_name }},</p>

<p>wir von <strong>ANTASUS Infra</strong> möchten Ihnen unsere Expertise im Glasfaserausbau vorstellen.
Mit langjähriger Erfahrung als Subunternehmer für Generalunternehmen bieten wir:</p>

<ul>
    <li>Professionelles Projektmanagement (Projektleitung / Bauleitung)</li>
    <li>Normgerechte Hausanschlüsse (DIN 18220)</li>
    <li>Komplettdienstleistungen für Tiefbau und Planung</li>
    <li>Georeferenzierte Dokumentation und Fertigstellungstests</li>
</ul>

<p>Nach durchgängigen Prozessoptimierungen, sind wir in der Lage unsere Kappazitäten noch effektiver zu steuern. Wir bieten Ihnen ein hohes Maß an Qualität und Flexibilität die Sie ab sofort für Ihre Projekte nutzen können.
    Unser Team aus exzelenten Projektleitern, spezialisierten Bauleitern und qualifizierten deutschsprachigen Mitarbeitern, werden Ihr Projekt auf einen hören Level bringen!
    Haben Sie Interesse an einem unverbindlichen Gespräch? Dann lassen Sie uns gern einen Termin vereinbaren.</p>

<p>Beste Grüße<br>
Ihr ANTASUS Infra Team</p>
HTML
        ],
        'angebot' => [
            'label'   => 'Preisanfrage für Projekt',
            'subject' => 'Angebot: Ihr Glasfaserbau-Projekt mit ANTASUS Infra',
            'body'    => <<<'HTML'
<p>Guten Tag {{ recipient_name }},</p>

<p>vielen Dank für Ihre Anfrage zum Thema Glasfaserausbau. Gerne unterbreiten wir Ihnen ein individuelles Angebot, das folgende Leistungen umfasst:</p>

<ul>
    <li>Projektplanung & Genehmigungsmanagement</li>
    <li>Projektleitung & Bauleitung</li>
    <li>Tiefbauarbeiten inklusive</li>
    <li>Montage von Hausanschlüssen</li>
    <li>Georeferenzierte Dokumentationen & Abnahmeberichte</li>
</ul>

<p>Bitte antworten Sie auf diese E-Mail, damit wir Ihnen ein maßgeschneidertes Angebot zusenden können.</p>

<p>Mit freundlichen Grüßen<br>
ANTASUS Infra</p>
HTML
        ],
        // … weitere Vorlagen hier nach demselben Schema
    ],
];
