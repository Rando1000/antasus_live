<template>
    <GuestLayout :serviceArea="'agb'">
        <template #header>
            <section class="w-full px-4 text-center animate-fade-in">
                <div class="max-w-4xl mx-auto">
                    <h1
                        class="mb-6 text-4xl font-extrabold text-white md:text-5xl drop-shadow-xl"
                    >
                        Allgemeine Geschäftsbedingungen (AGB)
                    </h1>
                    <p class="text-lg md:text-xl text-white/90 drop-shadow-md">
                        ANTASUS Infra - Stand: {{ new Date().getFullYear() }}
                    </p>
                </div>
            </section>
        </template>

        <section class="py-20 bg-white">
            <div class="max-w-3xl px-6 mx-auto prose prose-lg prose-slate">
                <h2>1. Geltungsbereich</h2>
                <p>
                    Diese Allgemeinen Geschäftsbedingungen (AGB) gelten für alle
                    Verträge über Bauleistungen, Planungsleistungen und
                    technische Dienstleistungen zwischen ANTASUS Infra, Inhaber
                    Radhouan Jouini, und ihren Auftraggebern, insbesondere
                    Generalunternehmen, öffentlichen Auftraggebern sowie
                    privaten Endkunden.
                </p>

                <h2>2. Vertragsgrundlagen</h2>
                <p>
                    Für Bauleistungen im Sinne von § 1 VOB/B gelten ergänzend
                    die Bestimmungen der VOB/B in der jeweils gültigen Fassung,
                    sofern diese ausdrücklich vereinbart wurden. Im Übrigen gilt
                    das Bürgerliche Gesetzbuch (BGB).
                </p>

                <h2>3. Leistungen</h2>
                <p>
                    Der konkrete Leistungsumfang ergibt sich aus dem beidseitig
                    unterzeichneten Vertrag oder der schriftlichen
                    Auftragsbestätigung. Planungs-, Tiefbau-, Hausanschluss-,
                    Glasfaserverlege- und Dokumentationsleistungen werden nach
                    anerkannten Regeln der Technik sowie geltenden DIN-, VDE-
                    und ZTV-Richtlinien ausgeführt.
                </p>

                <h2>4. Subunternehmer</h2>
                <p>
                    ANTASUS Infra ist berechtigt, zur Leistungserbringung
                    geeignete Nachunternehmer einzusetzen. Die Verantwortung für
                    Qualität, Koordination und Ausführung verbleibt beim
                    Auftragnehmer.
                </p>

                <h2>5. Mitwirkungspflichten des Auftraggebers</h2>
                <p>
                    Der Auftraggeber stellt unentgeltlich alle notwendigen
                    Unterlagen, Pläne, Leitungsübersichten sowie Zugänge zu
                    Grundstücken, Gebäuden und Technikräumen zur Verfügung.
                    Etwaige Genehmigungen durch Eigentümer, Behörden oder
                    Netzbetreiber sind rechtzeitig beizubringen.
                </p>

                <h2>6. Ausführungsfristen</h2>
                <p>
                    Vereinbarte Ausführungsfristen verschieben sich angemessen,
                    wenn unvorhersehbare Ereignisse (z. B. Witterung,
                    Lieferverzögerungen, Genehmigungsprobleme) die
                    Leistungserbringung behindern. Dies gilt auch bei
                    nachträglichen Leistungsänderungen.
                </p>

                <h2>7. Vergütung und Zahlungsbedingungen</h2>
                <p>
                    Vergütungen verstehen sich netto zzgl. gesetzlicher
                    Umsatzsteuer. Abschlagszahlungen können nach Baufortschritt
                    verlangt werden. Die Schlussrechnung ist 14 Tage nach Zugang
                    ohne Abzug zur Zahlung fällig. Zurückbehaltungsrechte gelten
                    nur bei unbestrittenen oder rechtskräftig festgestellten
                    Forderungen.
                </p>

                <h2>8. Eigentumsvorbehalt</h2>
                <p>
                    Bis zur vollständigen Bezahlung verbleiben gelieferte
                    Materialien, Komponenten und Unterlagen im Eigentum von
                    ANTASUS Infra.
                </p>

                <h2>9. Abnahme</h2>
                <p>
                    Die Abnahme erfolgt förmlich oder gilt als erfolgt, wenn der
                    Auftraggeber nicht binnen 7 Werktagen nach Mitteilung der
                    Fertigstellung schriftlich wesentliche Mängel rügt.
                </p>

                <h2>10. Gewährleistung</h2>
                <p>
                    Es gelten die gesetzlichen Gewährleistungsfristen: 4 Jahre
                    bei Bauleistungen (§13 VOB/B), 2 Jahre bei sonstigen
                    Leistungen (§634a BGB). Bei berechtigter Mängelanzeige
                    erfolgt kostenfreie Nachbesserung. Weitergehende Ansprüche
                    sind ausgeschlossen, sofern nicht Vorsatz oder grobe
                    Fahrlässigkeit vorliegt.
                </p>

                <h2>11. Haftung</h2>
                <p>
                    Für Schäden haftet ANTASUS Infra nur bei Vorsatz oder grober
                    Fahrlässigkeit. Bei einfacher Fahrlässigkeit nur bei
                    Verletzung wesentlicher Vertragspflichten. Die Haftung ist
                    auf den typischen vorhersehbaren Schaden begrenzt. Eine
                    Haftung für entgangenen Gewinn ist ausgeschlossen.
                </p>

                <h2>12. Widerrufsrecht bei Verbraucherverträgen</h2>
                <p>
                    Sofern der Auftraggeber Verbraucher ist, steht ihm ein
                    Widerrufsrecht nach §355 BGB zu. Die Einzelheiten und
                    Widerrufsbelehrung werden separat übermittelt.
                </p>

                <h2>13. Datenschutz</h2>
                <p>
                    Personenbezogene Daten werden im Rahmen der
                    Auftragsabwicklung unter Beachtung der DSGVO verarbeitet.
                    Details siehe
                    <a href="/datenschutz">Datenschutzerklärung</a>.
                </p>

                <h2>14. Gerichtsstand und anwendbares Recht</h2>
                <p>
                    Für Verträge mit Kaufleuten gilt als Gerichtsstand
                    Wuppertal. Es gilt ausschließlich deutsches Recht.
                </p>

                <h2>15. Salvatorische Klausel</h2>
                <p>
                    Sollte eine Bestimmung dieser AGB unwirksam sein, bleibt die
                    Wirksamkeit der übrigen Bestimmungen unberührt.
                </p>
            </div>
        </section>
    </GuestLayout>
</template>

<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
</script>
