<template>
    <GuestLayout :serviceArea="'datenschutz'">
        <template #header>
            <section
                class="w-full px-4 py-12 mb-2 text-center shadow-2xl animate-fade-in rounded-xl"
                aria-labelledby="datenschutz-header"
            >
                <div class="max-w-4xl mx-auto">
                    <h1
                        id="datenschutz-header"
                        class="mb-4 text-4xl font-extrabold tracking-tight text-white opacity-100 md:text-7xl drop-shadow-2xl"
                        tabindex="0"
                    >
                        Datenschutz
                    </h1>
                    <p class="text-lg md:text-2xl text-white/90 drop-shadow-md">
                        Informationen gemäß DSGVO für Geschäftskunden, Partner
                        und Besucher
                    </p>
                </div>
            </section>
        </template>

        <section
            class="py-20 bg-white dark:bg-gray-900"
            aria-labelledby="datenschutz-heading"
            role="region"
            tabindex="-1"
        >
            <div
                class="max-w-3xl px-6 mx-auto prose prose-lg transition-all shadow-xl bg-white/95 dark:bg-gray-900/90 rounded-xl prose-slate dark:prose-invert"
            >
                <h1 id="datenschutz-heading" class="mb-8 text-3xl font-bold">
                    Datenschutzerklärung
                </h1>

                <!-- Zusammenfassung -->
                <section aria-labelledby="datenschutz-kurz" tabindex="0">
                    <h2 id="datenschutz-kurz" class="text-2xl font-semibold">
                        1. Datenschutz auf einen Blick
                    </h2>
                    <p>
                        Wir, die ANTASUS Infra, nehmen den Schutz Ihrer Daten
                        sehr ernst. Sie können unsere Website grundsätzlich ohne
                        Angabe personenbezogener Daten nutzen. Sofern
                        personenbezogene Daten (z. B. Name, E-Mail-Adresse)
                        erhoben werden, erfolgt dies stets freiwillig und nach
                        den Vorgaben der DSGVO.
                    </p>
                </section>

                <!-- Automatische Datenverarbeitung -->
                <section
                    aria-labelledby="datenverarbeitung-heading"
                    tabindex="0"
                >
                    <h2
                        id="datenverarbeitung-heading"
                        class="mt-8 text-2xl font-semibold"
                    >
                        2. Automatische Datenverarbeitung beim Besuch unserer
                        Website
                    </h2>
                    <p>
                        Beim Besuch dieser Website werden automatisch folgende
                        Daten verarbeitet:
                    </p>
                    <ul>
                        <li>Aufgerufene URL</li>
                        <li>User-Agent (Browsertyp und Betriebssystem)</li>
                        <li>Referrer-URL</li>
                        <li>Datum und Uhrzeit des Zugriffs</li>
                        <li>
                            IP-Adresse (gekürzt, nicht personenbezogen
                            ausgewertet)
                        </li>
                    </ul>
                    <p>
                        Diese Daten dienen der technischen Stabilität,
                        Sicherheit und statistischen Auswertung (Art. 6 Abs. 1
                        lit. f DSGVO). Die Server werden von Hostinger, UAB
                        Švitrigailos str. 34, Vilnius 03230, Litauen, gehostet.
                        Die Löschung erfolgt automatisch nach 14 Tagen.
                    </p>
                </section>

                <!-- Cookies und Consent -->
                <section aria-labelledby="cookies-consent-heading" tabindex="0">
                    <h2
                        id="cookies-consent-heading"
                        class="mt-8 text-2xl font-semibold"
                    >
                        3. Cookies, Consent und Reichweitenanalyse
                    </h2>
                    <p>
                        Wir verwenden technisch notwendige Cookies zur
                        Bereitstellung dieser Website. Alle weiteren Cookies
                        (Statistik, Marketing, externe Dienste) werden
                        ausschließlich nach Ihrer ausdrücklichen Einwilligung
                        (Art. 6 Abs. 1 lit. a DSGVO) gesetzt. Die Verwaltung
                        Ihrer Präferenzen erfolgt über das Consent-Tool (<b
                            >Spatie Cookie Consent</b
                        >) – Ihre Einstellungen sind jederzeit am Seitenende
                        editierbar.
                    </p>
                    <p>
                        Zur Analyse der Nutzung verwenden wir Google Analytics 4
                        (GA4, Google Ireland Limited, Dublin). Die Aktivierung
                        erfolgt ausschließlich mit Ihrer Zustimmung. Die
                        IP-Adresse wird gekürzt verarbeitet. Weitere
                        Informationen zum Datenschutz bei Google finden Sie
                        unter
                        <a
                            href="https://policies.google.com/privacy?hl=de"
                            target="_blank"
                            rel="noopener"
                            class="underline text-antasus-primary hover:text-antasus-primary/80"
                            >https://policies.google.com/privacy</a
                        >.
                    </p>
                </section>

                <!-- Hosting/Provider -->
                <section aria-labelledby="hosting-heading" tabindex="0">
                    <h2
                        id="hosting-heading"
                        class="mt-8 text-2xl font-semibold"
                    >
                        4. Hosting und technische Dienstleister
                    </h2>
                    <p>
                        Das Hosting erfolgt bei <b>Hostinger</b> auf Servern in
                        der EU. Mit Hostinger besteht ein
                        Auftragsverarbeitungsvertrag nach Art. 28 DSGVO.
                    </p>
                    <p>
                        Die technische Betreuung (Entwicklung, Wartung,
                        IT-Security) wird ausschließlich durch unsere internen
                        Teams und autorisierte Partner durchgeführt.
                    </p>
                </section>

                <!-- Kommunikation -->
                <section aria-labelledby="kommunikation-heading" tabindex="0">
                    <h2
                        id="kommunikation-heading"
                        class="mt-8 text-2xl font-semibold"
                    >
                        5. Kontaktaufnahme und Kommunikation
                    </h2>
                    <p>
                        Wenn Sie uns kontaktieren (E-Mail, Telefon, Formular),
                        verarbeiten wir Ihre Angaben ausschließlich zur
                        Bearbeitung Ihres Anliegens (Art. 6 Abs. 1 lit. f
                        DSGVO). Daten werden nicht an Dritte weitergegeben.
                        Nachrichten werden nach Erledigung bzw. nach Ablauf
                        gesetzlicher Aufbewahrungsfristen gelöscht.
                    </p>
                </section>

                <!-- Bewerbungen -->
                <section aria-labelledby="bewerbungen-heading" tabindex="0">
                    <h2
                        id="bewerbungen-heading"
                        class="mt-8 text-2xl font-semibold"
                    >
                        6. Bewerbungen
                    </h2>
                    <p>
                        Bewerbungsunterlagen werden ausschließlich zur
                        Durchführung des Bewerbungsverfahrens verwendet (Art. 6
                        Abs. 1 lit. b, § 26 BDSG). Nach Abschluss des
                        Auswahlverfahrens werden die Daten spätestens 4 Monate
                        nach Mitteilung der Entscheidung gelöscht, sofern keine
                        längere Speicherung vereinbart oder gesetzlich
                        vorgeschrieben ist.
                    </p>
                </section>

                <!-- Buchungsformular -->
                <section
                    aria-labelledby="buchungsformular-heading"
                    tabindex="0"
                >
                    <h2
                        id="buchungsformular-heading"
                        class="mt-8 text-2xl font-semibold"
                    >
                        7. Buchungsformular und Meetings
                    </h2>
                    <p>
                        Für Terminbuchungen erheben wir die von Ihnen
                        eingegebenen Daten. Die Verarbeitung erfolgt
                        ausschließlich zur Vereinbarung und Durchführung des
                        gebuchten Termins (Art. 6 Abs. 1 lit. b DSGVO). Die
                        Übermittlung erfolgt verschlüsselt (TLS/SSL).
                    </p>
                    <p>
                        Für Online-Meetings nutzen wir „Microsoft Teams“
                        (Microsoft Ireland, EU). Die Nutzung erfolgt nur nach
                        Ihrer aktiven Teilnahme (Beitritt/Einladung). Weitere
                        Informationen:
                        <a
                            href="https://privacy.microsoft.com/de-de/privacystatement"
                            target="_blank"
                            rel="noopener"
                            class="underline text-antasus-primary hover:text-antasus-primary/80"
                            >privacy.microsoft.com</a
                        >
                    </p>
                </section>

                <!-- Marketing -->
                <section aria-labelledby="marketing-heading" tabindex="0">
                    <h2
                        id="marketing-heading"
                        class="mt-8 text-2xl font-semibold"
                    >
                        8. Marketing und Newsletter
                    </h2>
                    <p>
                        Wir verwenden Ihre Kontaktdaten zu Marketingzwecken
                        (z. B. E-Mail-Newsletter, Telefon, Post) nur mit Ihrer
                        ausdrücklichen Einwilligung oder im Rahmen bestehender
                        Geschäftsbeziehungen (Art. 6 Abs. 1 lit. a/f DSGVO). Sie
                        können der Nutzung jederzeit widersprechen.
                    </p>
                </section>

                <!-- Datensicherheit -->
                <section aria-labelledby="datensicherheit-heading" tabindex="0">
                    <h2
                        id="datensicherheit-heading"
                        class="mt-8 text-2xl font-semibold"
                    >
                        9. Datensicherheit
                    </h2>
                    <p>
                        Wir setzen technische und organisatorische Maßnahmen
                        (TOMs) zum Schutz Ihrer Daten ein, darunter
                        TLS/SSL-Verschlüsselung, Zugriffsbeschränkungen,
                        Firewalls und regelmäßige Audits.
                    </p>
                </section>

                <!-- Speicherfristen -->
                <section aria-labelledby="speicherfristen-heading" tabindex="0">
                    <h2
                        id="speicherfristen-heading"
                        class="mt-8 text-2xl font-semibold"
                    >
                        10. Speicherfristen
                    </h2>
                    <p>
                        Personenbezogene Daten werden nur solange gespeichert,
                        wie dies zur Zweckerfüllung erforderlich ist oder
                        gesetzliche Aufbewahrungsfristen bestehen.
                    </p>
                </section>

                <!-- Rechte -->
                <section aria-labelledby="rechte-heading" tabindex="0">
                    <h2 id="rechte-heading" class="mt-8 text-2xl font-semibold">
                        11. Ihre Rechte
                    </h2>
                    <ul>
                        <li>Auskunft (Art. 15 DSGVO)</li>
                        <li>Berichtigung (Art. 16 DSGVO)</li>
                        <li>Löschung (Art. 17 DSGVO)</li>
                        <li>Einschränkung der Verarbeitung (Art. 18 DSGVO)</li>
                        <li>Datenübertragbarkeit (Art. 20 DSGVO)</li>
                        <li>Widerspruch gegen Verarbeitung (Art. 21 DSGVO)</li>
                        <li>
                            Widerruf einer Einwilligung (Art. 7 Abs. 3 DSGVO)
                        </li>
                        <li>
                            Beschwerde bei einer Aufsichtsbehörde (Art. 77
                            DSGVO)
                        </li>
                    </ul>
                    <p>
                        Wenden Sie sich zur Wahrnehmung Ihrer Rechte an
                        <a
                            href="mailto:datenschutz@antasus.de"
                            class="underline text-antasus-primary hover:text-antasus-primary/80"
                            >datenschutz@antasus.de</a
                        >
                        oder postalisch an die im Impressum genannten
                        Kontaktdaten.
                    </p>
                </section>

                <!-- Keine Pflicht -->
                <section aria-labelledby="keinepflicht-heading" tabindex="0">
                    <h2
                        id="keinepflicht-heading"
                        class="mt-8 text-2xl font-semibold"
                    >
                        12. Keine Pflicht zur Bereitstellung personenbezogener
                        Daten
                    </h2>
                    <p>
                        Die Bereitstellung personenbezogener Daten ist in der
                        Regel freiwillig. Ohne Angabe der erforderlichen Daten
                        können bestimmte Angebote oder Leistungen jedoch nicht
                        erbracht werden.
                    </p>
                </section>

                <!-- Datenschutzbeauftragter -->
                <section aria-labelledby="dsb-heading" tabindex="0">
                    <h2 id="dsb-heading" class="mt-8 text-2xl font-semibold">
                        13. Datenschutzbeauftragter
                    </h2>
                    <p>
                        Unser Datenschutzbeauftragter steht Ihnen für Fragen,
                        Hinweise oder Beschwerden gern zur Verfügung:<br />
                        <strong>
                            E-Mail:
                            <a href="mailto:datenschutz@antasus.de"
                                >datenschutz@antasus.de</a
                            >
                        </strong>
                    </p>
                </section>

                <p
                    class="mt-10 text-xs text-gray-400 dark:text-gray-500"
                    aria-label="Rechtsstand"
                >
                    Stand: Juli 2025
                </p>
            </div>
        </section>
    </GuestLayout>
</template>

<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import { onMounted } from "vue";

// Strukturierte Daten für Google/Trust/AI
onMounted(() => {
    const jsonLd = {
        "@context": "https://schema.org",
        "@type": "WebPage",
        name: "Datenschutzerklärung – ANTASUS Infra",
        url: "https://www.antasus.de/datenschutz",
        description:
            "DSGVO-konforme Datenschutzerklärung für ANTASUS Infra, inkl. Kontakt, Hosting, Consent, Analytics, Bewerbungen und alle gesetzlichen Pflichten.",
        publisher: {
            "@type": "Organization",
            name: "ANTASUS Infra",
            url: "https://www.antasus.de",
            email: "info@antasus.de",
            address: {
                "@type": "PostalAddress",
                streetAddress: "Norrenbergstraße 122",
                addressLocality: "Wuppertal",
                postalCode: "42289",
                addressCountry: "DE",
            },
            telephone: "+49 176 24757616",
            logo: {
                "@type": "ImageObject",
                url: "https://www.antasus.de/images/antasus-logo2.svg",
            },
        },
        inLanguage: "de",
    };
    const s = document.createElement("script");
    s.type = "application/ld+json";
    s.text = JSON.stringify(jsonLd, null, 2);
    document.head.appendChild(s);
});
</script>

<style scoped>
.prose {
    font-family: "Inter", "Helvetica Neue", Arial, "Liberation Sans", sans-serif;
    font-size: 1.15rem;
    line-height: 1.75;
}
a {
    word-break: break-all;
}
a:focus-visible {
    outline: 2px solid #00fdcf !important;
    outline-offset: 2px;
    border-radius: 0.25rem;
}
@media (max-width: 600px) {
    .prose {
        font-size: 1rem;
        padding: 1rem 0.25rem;
    }
    .mb-8 {
        margin-bottom: 2.2rem;
    }
}
</style>
