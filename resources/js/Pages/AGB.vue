<template>
    <GuestLayout :serviceArea="'agb'">
        <template #header>
            <section
                class="w-full px-4 py-12 mb-2 text-center animate-fade-in rounded-xl"
                aria-labelledby="agb-header"
            >
                <div class="max-w-4xl mx-auto">
                    <h1
                        id="agb-header"
                        class="mb-4 text-4xl font-extrabold tracking-tight text-white md:text-7xl drop-shadow-2xl"
                        tabindex="0"
                    >
                        Allgemeine Geschäftsbedingungen (AGB)
                    </h1>
                    <p class="text-lg md:text-2xl text-white/90 drop-shadow-md">
                        ANTASUS Infra - Stand: {{ new Date().getFullYear() }}
                    </p>
                </div>
            </section>
        </template>

        <section
            class="py-20 bg-white place-self-center md:max-w-4xl dark:bg-gray-900"
            aria-labelledby="agb-heading"
            role="region"
            tabindex="-1"
        >
            <div
                class="max-w-3xl px-6 mx-auto prose prose-lg transition-all shadow-xl bg-white/95 dark:bg-gray-900/90 rounded-xl prose-slate dark:prose-invert"
            >
                <h1 id="agb-heading" class="mb-10 text-3xl font-bold">
                    Allgemeine Geschäftsbedingungen (AGB)
                </h1>
                <dl>
                    <dt class="mt-6 text-2xl font-semibold" id="scope">
                        1. Geltungsbereich
                    </dt>
                    <dd>
                        Diese AGB's gelten für sämtliche Verträge, Lieferungen
                        und Leistungen zwischen ANTASUS Infra (Inhaber: Radhouan
                        Jouini), nachfolgend „Auftragnehmer“, und deren Kunden,
                        gleich ob Unternehmen, juristische Personen des
                        öffentlichen Rechts oder Verbraucher, soweit nicht im
                        Einzelfall abweichend schriftlich vereinbart.
                    </dd>

                    <dt class="mt-6 text-2xl font-semibold" id="contract-basis">
                        2. Vertragsgrundlagen
                    </dt>
                    <dd>
                        Grundlage jedes Vertrages ist die schriftliche
                        Leistungsbeschreibung, das Angebot und die
                        Auftragsbestätigung von ANTASUS Infra. Für Bauleistungen
                        gilt ergänzend und vorrangig die VOB/B, sofern
                        ausdrücklich vereinbart. Im Übrigen findet das
                        Bürgerliche Gesetzbuch (BGB) Anwendung.
                    </dd>

                    <dt class="mt-6 text-2xl font-semibold" id="services">
                        3. Leistungen
                    </dt>
                    <dd>
                        Die Leistungen erfolgen nach anerkannten Regeln der
                        Technik, den geltenden DIN-, VDE-, ZTV-Richtlinien und
                        allen einschlägigen gesetzlichen Vorschriften.
                        Änderungen im Leistungsumfang bedürfen der Schriftform.
                    </dd>

                    <dt class="mt-6 text-2xl font-semibold" id="subcontractors">
                        4. Subunternehmer
                    </dt>
                    <dd>
                        ANTASUS Infra ist berechtigt, zur Vertragserfüllung
                        Nachunternehmer einzusetzen. Die Verantwortung für die
                        Leistungserbringung verbleibt beim Auftragnehmer.
                    </dd>

                    <dt class="mt-6 text-2xl font-semibold" id="cooperation">
                        5. Mitwirkungspflichten des Auftraggebers
                    </dt>
                    <dd>
                        Der Auftraggeber hat sämtliche zur Durchführung der
                        Arbeiten erforderlichen Unterlagen, Genehmigungen, Pläne
                        und Zugänge unentgeltlich bereitzustellen. Er ist
                        verpflichtet, etwaige Hindernisse rechtzeitig
                        mitzuteilen.
                    </dd>

                    <dt class="mt-6 text-2xl font-semibold" id="deadlines">
                        6. Ausführungsfristen
                    </dt>
                    <dd>
                        Liefer- und Ausführungsfristen verlängern sich bei
                        höherer Gewalt, unverschuldeten Behinderungen oder
                        nachträglichen Änderungswünschen angemessen.
                        Verzögerungen aufgrund fehlender Mitwirkung des
                        Auftraggebers führen zu einer entsprechenden
                        Verlängerung.
                    </dd>

                    <dt class="mt-6 text-2xl font-semibold" id="payment">
                        7. Vergütung und Zahlungsbedingungen
                    </dt>
                    <dd>
                        Alle Preise verstehen sich zuzüglich gesetzlicher
                        Mehrwertsteuer. Abschlagszahlungen können nach
                        Baufortschritt oder Vereinbarung verlangt werden.
                        Rechnungen sind innerhalb von 14 Tagen nach Zugang ohne
                        Abzug fällig. Bei Zahlungsverzug werden Verzugszinsen in
                        gesetzlicher Höhe berechnet.
                    </dd>

                    <dt class="mt-6 text-2xl font-semibold" id="ownership">
                        8. Eigentumsvorbehalt
                    </dt>
                    <dd>
                        Bis zur vollständigen Bezahlung bleiben alle gelieferten
                        Materialien, Bauteile und Unterlagen Eigentum von
                        ANTASUS Infra.
                    </dd>

                    <dt class="mt-6 text-2xl font-semibold" id="acceptance">
                        9. Abnahme
                    </dt>
                    <dd>
                        Die Abnahme der Leistungen erfolgt nach Fertigstellung
                        und Mitteilung durch den Auftragnehmer. Sie gilt als
                        erfolgt, wenn der Auftraggeber nicht binnen 7 Werktagen
                        schriftlich wesentliche Mängel rügt.
                    </dd>

                    <dt class="mt-6 text-2xl font-semibold" id="warranty">
                        10. Gewährleistung
                    </dt>
                    <dd>
                        Es gelten die gesetzlichen Fristen: Für Bauleistungen
                        vier Jahre (§13 VOB/B), für sonstige Leistungen zwei
                        Jahre (§634a BGB). Bei berechtigten Mängeln erfolgt
                        Nachbesserung oder Ersatzlieferung. Weitergehende
                        Ansprüche sind, außer bei Vorsatz oder grober
                        Fahrlässigkeit, ausgeschlossen.
                    </dd>

                    <dt class="mt-6 text-2xl font-semibold" id="liability">
                        11. Haftung
                    </dt>
                    <dd>
                        Der Auftragnehmer haftet für Vorsatz und grobe
                        Fahrlässigkeit unbeschränkt. Für leichte Fahrlässigkeit
                        haftet er nur bei Verletzung wesentlicher
                        Vertragspflichten („Kardinalpflichten“), und die Haftung
                        ist auf den typischen, vorhersehbaren Schaden begrenzt.
                        Eine Haftung für entgangenen Gewinn ist ausgeschlossen.
                    </dd>

                    <dt class="mt-6 text-2xl font-semibold" id="revocation">
                        12. Widerrufsrecht für Verbraucher
                    </dt>
                    <dd>
                        Verbraucher im Sinne des §13 BGB haben ein
                        Widerrufsrecht nach §355 BGB. Die Belehrung und das
                        Musterformular werden bei Vertragsabschluss separat
                        bereitgestellt.
                    </dd>

                    <dt class="mt-6 text-2xl font-semibold" id="dataprotection">
                        13. Datenschutz
                    </dt>
                    <dd>
                        Die Verarbeitung personenbezogener Daten erfolgt im
                        Rahmen der jeweils gültigen Datenschutzgesetze,
                        insbesondere der DSGVO. Ausführliche Informationen
                        finden Sie in unserer
                        <a
                            href="/datenschutz"
                            class="underline text-antasus-primary hover:text-antasus-primary/80"
                            >Datenschutzerklärung</a
                        >.
                    </dd>

                    <dt class="mt-6 text-2xl font-semibold" id="jurisdiction">
                        14. Gerichtsstand und anwendbares Recht
                    </dt>
                    <dd>
                        Gerichtsstand für Kaufleute, juristische Personen des
                        öffentlichen Rechts und öffentlich-rechtliche
                        Sondervermögen ist Wuppertal. Es gilt ausschließlich
                        deutsches Recht unter Ausschluss des UN-Kaufrechts.
                    </dd>

                    <dt class="mt-6 text-2xl font-semibold" id="salvatoric">
                        15. Salvatorische Klausel
                    </dt>
                    <dd>
                        Sollte eine Bestimmung dieser AGB ganz oder teilweise
                        unwirksam sein oder werden, so bleibt die Wirksamkeit
                        der übrigen Bestimmungen hiervon unberührt. An die
                        Stelle der unwirksamen Bestimmung tritt die gesetzliche
                        Regelung.
                    </dd>
                </dl>
                <p
                    class="mt-12 mb-0 text-xs text-gray-400 dark:text-gray-500"
                    aria-label="Rechtsstand"
                >
                    Stand: Juli {{ new Date().getFullYear() }}
                </p>
            </div>
        </section>
    </GuestLayout>
</template>

<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import { onMounted } from "vue";

// Strukturierte Daten für Google (LegalPage/TermsOfService)
onMounted(() => {
    const jsonLd = {
        "@context": "https://schema.org",
        "@type": "TermsOfService",
        inLanguage: "de",
        url: "https://www.antasus.de/agb",
        name: "Allgemeine Geschäftsbedingungen (AGB) ANTASUS Infra",
        publisher: {
            "@type": "Organization",
            name: "ANTASUS Infra",
            url: "https://www.antasus.de/",
        },
        dateModified: new Date().toISOString().split("T")[0],
    };
    const s = document.createElement("script");
    s.type = "application/ld+json";
    s.text = JSON.stringify(jsonLd, null, 2);
    document.head.appendChild(s);
});
</script>

<style scoped>
.bg-gradient-to-tr {
    background: linear-gradient(105deg, #00fdcf 0%, #3f51b5 50%, #000 100%);
}
.prose {
    font-family: "Inter", "Helvetica Neue", Arial, "Liberation Sans", sans-serif;
    font-size: 1.15rem;
    line-height: 1.75;
    max-width: 100%;
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
}
</style>
