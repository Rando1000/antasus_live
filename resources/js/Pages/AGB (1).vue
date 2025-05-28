
<template>
  <GuestLayout title="AGB">
    <template #header>
      <section class="w-full px-4 text-center animate-fade-in">
        <div class="max-w-4xl mx-auto">
          <h1 class="text-4xl md:text-5xl font-extrabold text-white drop-shadow-xl mb-6">
            Allgemeine Geschäftsbedingungen
          </h1>
          <p class="text-lg md:text-xl text-white/90 drop-shadow-md">
            ANTASUS Infra – Glasfaserausbau & Tiefbau
          </p>
        </div>
      </section>
    </template>

    <section class="py-20 bg-white">
      <div class="max-w-3xl px-6 mx-auto prose prose-lg prose-slate">
        <h2>1. Geltungsbereich</h2>
        <p>
          Diese Allgemeinen Geschäftsbedingungen (AGB) gelten für alle Leistungen der ANTASUS Infra, Inh. Radhouan Jouini,
          insbesondere im Bereich Glasfaserausbau, Tiefbau, Hausanschluss und begleitender Dienstleistungen.
          Die AGB gelten für Verträge mit Geschäftskunden (insbesondere Generalunternehmen) und Privatkunden,
          sofern nicht ausdrücklich anders vereinbart.
        </p>

        <h2>2. Vertragsabschluss</h2>
        <p>
          Ein Vertrag kommt durch eine schriftliche Auftragsbestätigung durch ANTASUS Infra oder durch tatsächlichen Beginn der Leistungserbringung zustande.
          Mündliche Nebenabreden bedürfen zu ihrer Wirksamkeit der schriftlichen Bestätigung.
        </p>

        <h2>3. Leistungen</h2>
        <p>
          Der Umfang der vertraglich geschuldeten Leistung ergibt sich aus dem individuellen Angebot bzw. der Leistungsbeschreibung.
          Änderungen des Leistungsumfangs bedürfen der schriftlichen Zustimmung beider Vertragsparteien.
        </p>

        <h2>4. Mitwirkungspflichten</h2>
        <p>
          Der Auftraggeber hat sicherzustellen, dass alle zur Durchführung der Arbeiten erforderlichen Genehmigungen vorliegen
          und Zugänge zu Arbeitsflächen, Plänen, Anschlusspunkten etc. gewährleistet sind.
        </p>

        <h2>5. Ausführungsfristen</h2>
        <p>
          Die Einhaltung vereinbarter Fristen setzt voraus, dass der Auftraggeber seine Mitwirkungspflichten rechtzeitig erfüllt.
          Verzögerungen, die auf unzureichende Vorbereitungen des Auftraggebers zurückzuführen sind, verschieben vereinbarte Fristen entsprechend.
        </p>

        <h2>6. Vergütung</h2>
        <p>
          Die Vergütung richtet sich nach dem individuell geschlossenen Vertrag. Alle Preise verstehen sich netto zuzüglich gesetzlicher Mehrwertsteuer.
          Zahlungen sind 14 Tage nach Rechnungsstellung ohne Abzug fällig.
        </p>

        <h2>7. Abnahme</h2>
        <p>
          Nach Abschluss der Leistungen ist eine förmliche Abnahme durchzuführen. Wird die Abnahme nicht innerhalb von 7 Tagen nach Mitteilung
          über die Fertigstellung vorgenommen, so gilt die Leistung als abgenommen.
        </p>

        <h2>8. Gewährleistung</h2>
        <p>
          Es gelten die gesetzlichen Vorschriften. Die Gewährleistungsfrist beträgt 24 Monate, bei Bauleistungen gemäß §13 VOB/B 4 Jahre.
          Offensichtliche Mängel sind innerhalb von 7 Tagen nach Abnahme schriftlich anzuzeigen.
        </p>

        <h2>9. Haftung</h2>
        <p>
          ANTASUS Infra haftet bei Vorsatz und grober Fahrlässigkeit uneingeschränkt. Bei leichter Fahrlässigkeit nur bei
          Verletzung wesentlicher Vertragspflichten (Kardinalpflichten). Die Haftung ist auf den vertragstypischen Schaden begrenzt.
        </p>

        <h2>10. Eigentumsvorbehalt</h2>
        <p>
          Gelieferte Materialien und Komponenten bleiben bis zur vollständigen Bezahlung Eigentum von ANTASUS Infra.
        </p>

        <h2>11. Datenschutz</h2>
        <p>
          ANTASUS Infra verarbeitet personenbezogene Daten ausschließlich im Rahmen der geltenden Datenschutzgesetze.
          Es gilt unsere <a href="/datenschutz">Datenschutzerklärung</a>.
        </p>

        <h2>12. Gerichtsstand und anwendbares Recht</h2>
        <p>
          Es gilt das Recht der Bundesrepublik Deutschland. Gerichtsstand ist Wuppertal, soweit gesetzlich zulässig.
        </p>

        <h2>13. Schlussbestimmungen</h2>
        <p>
          Sollten einzelne Bestimmungen dieser AGB ganz oder teilweise unwirksam sein, bleibt die Wirksamkeit der übrigen Bestimmungen unberührt.
        </p>
      </div>
    </section>
  </GuestLayout>
</template>

<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue'
</script>
