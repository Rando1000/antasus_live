<template>
    <GuestLayout :serviceArea="'agb'">
        <template #header>
            <section
                class="w-full px-4 py-12 mb-2 text-center animate-fade-in rounded-xl"
            >
                <div class="max-w-4xl mx-auto">
                    <h1
                        class="mb-4 text-4xl font-extrabold text-white md:text-5xl drop-shadow-xl"
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
            class="py-20 bg-white dark:bg-gray-900"
            aria-labelledby="agb-heading"
            role="region"
            tabindex="-1"
        >
            <div
                class="max-w-3xl px-6 mx-auto prose prose-lg bg-white shadow-xl prose-slate dark:bg-gray-900 rounded-xl dark:prose-invert"
            >
                <h1 id="agb-heading" class="mb-10 text-3xl font-bold">
                    Allgemeine Geschäftsbedingungen (AGB)
                </h1>

                <!-- Juristisches FAQ/Schema (Google SGE etc.) -->
                <dl>
                    <dt class="mt-6 text-2xl font-semibold">
                        1. Geltungsbereich
                    </dt>
                    <dd>
                        Diese AGB gelten für sämtliche Verträge über Bau-,
                        Planungs- und technische Dienstleistungen zwischen
                        ANTASUS Infra (Inhaber: Radhouan Jouini) und
                        Auftraggebern. Insbesondere Unternehmen, öffentliche
                        Auftraggeber und private Endkunden.
                    </dd>

                    <dt class="mt-6 text-2xl font-semibold">
                        2. Vertragsgrundlagen
                    </dt>
                    <dd>
                        Für Bauleistungen im Sinne von § 1 VOB/B gelten
                        ergänzend die Bestimmungen der VOB/B, sofern
                        ausdrücklich vereinbart. Im Übrigen gilt das Bürgerliche
                        Gesetzbuch (BGB).
                    </dd>

                    <dt class="mt-6 text-2xl font-semibold">3. Leistungen</dt>
                    <dd>
                        Der Leistungsumfang ergibt sich aus dem unterzeichneten
                        Vertrag oder der schriftlichen Auftragsbestätigung. Alle
                        Leistungen werden nach den anerkannten Regeln der
                        Technik, geltenden DIN-, VDE- und ZTV-Richtlinien
                        ausgeführt.
                    </dd>

                    <dt class="mt-6 text-2xl font-semibold">
                        4. Subunternehmer
                    </dt>
                    <dd>
                        ANTASUS Infra darf zur Vertragserfüllung geeignete
                        Nachunternehmer einsetzen. Die Gesamtverantwortung
                        bleibt beim Auftragnehmer.
                    </dd>

                    <dt class="mt-6 text-2xl font-semibold">
                        5. Mitwirkungspflichten
                    </dt>
                    <dd>
                        Der Auftraggeber stellt erforderliche Unterlagen, Pläne,
                        Leitungsübersichten und Zugänge zu Grundstücken/Gebäuden
                        kostenfrei zur Verfügung und besorgt notwendige
                        Genehmigungen.
                    </dd>

                    <dt class="mt-6 text-2xl font-semibold">
                        6. Ausführungsfristen
                    </dt>
                    <dd>
                        Verzögerungen durch unvorhersehbare Ereignisse (z.B.
                        Wetter, Lieferprobleme) verschieben vereinbarte
                        Ausführungsfristen angemessen. Gleiches gilt für
                        Leistungsänderungen.
                    </dd>

                    <dt class="mt-6 text-2xl font-semibold">
                        7. Vergütung und Zahlungsbedingungen
                    </dt>
                    <dd>
                        Vergütungen verstehen sich zzgl. MwSt. Abschläge können
                        nach Baufortschritt verlangt werden. Die Schlussrechnung
                        ist innerhalb von 14 Tagen nach Zugang ohne Abzug
                        fällig. Zurückbehaltungsrechte bestehen nur bei
                        unbestrittenen oder rechtskräftig festgestellten
                        Forderungen.
                    </dd>

                    <dt class="mt-6 text-2xl font-semibold">
                        8. Eigentumsvorbehalt
                    </dt>
                    <dd>
                        Bis zur vollständigen Zahlung verbleiben gelieferte
                        Materialien, Komponenten und Unterlagen im Eigentum von
                        ANTASUS Infra.
                    </dd>

                    <dt class="mt-6 text-2xl font-semibold">9. Abnahme</dt>
                    <dd>
                        Die Abnahme gilt als erfolgt, wenn der Auftraggeber
                        nicht binnen 7 Werktagen nach Mitteilung der
                        Fertigstellung schriftlich wesentliche Mängel rügt.
                    </dd>

                    <dt class="mt-6 text-2xl font-semibold">
                        10. Gewährleistung
                    </dt>
                    <dd>
                        Es gelten die gesetzlichen Fristen: 4 Jahre bei
                        Bauleistungen (§13 VOB/B), 2 Jahre bei sonstigen
                        Leistungen (§634a BGB). Bei Mängeln erfolgt kostenlose
                        Nachbesserung. Weitere Ansprüche sind, außer bei
                        Vorsatz/grober Fahrlässigkeit, ausgeschlossen.
                    </dd>

                    <dt class="mt-6 text-2xl font-semibold">11. Haftung</dt>
                    <dd>
                        Haftung besteht nur für Vorsatz oder grobe
                        Fahrlässigkeit. Bei einfacher Fahrlässigkeit nur bei
                        Verletzung wesentlicher Vertragspflichten und ist auf
                        den typischen vorhersehbaren Schaden begrenzt. Keine
                        Haftung für entgangenen Gewinn.
                    </dd>

                    <dt class="mt-6 text-2xl font-semibold">
                        12. Widerrufsrecht für Verbraucher
                    </dt>
                    <dd>
                        Verbrauchern steht ein Widerrufsrecht nach §355 BGB zu.
                        Einzelheiten dazu werden separat mitgeteilt.
                    </dd>

                    <dt class="mt-6 text-2xl font-semibold">13. Datenschutz</dt>
                    <dd>
                        Die Verarbeitung personenbezogener Daten erfolgt im
                        Rahmen der DSGVO. Details siehe unsere
                        <a
                            href="/datenschutz"
                            class="underline text-antasus-primary hover:text-antasus-primary/80"
                            >Datenschutzerklärung</a
                        >.
                    </dd>

                    <dt class="mt-6 text-2xl font-semibold">
                        14. Gerichtsstand / anwendbares Recht
                    </dt>
                    <dd>
                        Gerichtsstand für Verträge mit Kaufleuten ist Wuppertal.
                        Es gilt ausschließlich deutsches Recht.
                    </dd>

                    <dt class="mt-6 text-2xl font-semibold">
                        15. Salvatorische Klausel
                    </dt>
                    <dd>
                        Sollte eine Bestimmung unwirksam sein, bleibt die
                        Wirksamkeit der übrigen Bestimmungen unberührt.
                    </dd>
                </dl>
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
.bg-gradient-to-r {
    background: linear-gradient(90deg, #00fdcf 0%, #000 100%);
}
.prose {
    font-family: "Inter", "Helvetica Neue", Arial, "Liberation Sans", sans-serif;
    font-size: 1.15rem;
    line-height: 1.75;
}
a {
    word-break: break-all;
}
@media (max-width: 600px) {
    .prose {
        font-size: 1rem;
        padding: 1rem 0.25rem;
    }
}
</style>
