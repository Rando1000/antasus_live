<template>
    <GuestLayout :serviceArea="'impressum'">
        <template #header>
            <section class="w-full px-4 text-center animate-fade-in rounded-xl">
                <div class="max-w-4xl mx-auto rounded-xl">
                    <h1
                        class="mb-6 text-4xl font-extrabold text-white md:text-5xl drop-shadow-xl"
                    >
                        Impressum
                    </h1>
                    <p class="text-lg md:text-xl text-white/90 drop-shadow-md">
                        Angaben gemäß § 5 TMG
                    </p>
                </div>
            </section>
        </template>

        <section
            class="py-20 bg-white"
            aria-labelledby="impressum-heading"
            role="region"
            tabindex="-1"
        >
            <div
                class="max-w-3xl px-6 mx-auto prose prose-lg bg-white shadow-xl rounded-xl prose-slate"
            >
                <h1 id="impressum-heading" class="mb-8 text-3xl font-bold">
                    Impressum
                </h1>

                <section aria-labelledby="angaben-heading">
                    <h2
                        id="angaben-heading"
                        class="mt-6 text-2xl font-semibold"
                    >
                        Angaben gemäß § 5 TMG
                    </h2>
                    <address class="mb-4 not-italic">
                        <strong>ANTASUS Infra</strong><br />
                        Inhaber: Radhouan Jouini<br />
                        Norrenbergstraße 122<br />
                        42289 Wuppertal<br />
                        Deutschland
                    </address>
                </section>

                <section aria-labelledby="kontakt-heading">
                    <h2
                        id="kontakt-heading"
                        class="mt-6 text-2xl font-semibold"
                    >
                        Kontakt
                    </h2>
                    <ul class="p-0 m-0 list-none">
                        <li>
                            <span class="sr-only">Telefon:</span>
                            <a
                                href="tel:+4917624757616"
                                class="text-blue-700 underline focus:outline focus:ring-2 focus:ring-blue-400"
                            >
                                +49 176 24757616
                            </a>
                        </li>
                        <li>
                            <span class="sr-only">E-Mail:</span>
                            <a
                                href="mailto:info@antasus.de"
                                class="text-blue-700 underline focus:outline focus:ring-2 focus:ring-blue-400"
                            >
                                info@antasus.de
                            </a>
                        </li>
                        <li>
                            <span class="sr-only">Web:</span>
                            <a
                                href="https://www.antasus.de"
                                target="_blank"
                                rel="noopener"
                                class="text-blue-700 underline focus:outline focus:ring-2 focus:ring-blue-400"
                            >
                                www.antasus.de
                            </a>
                        </li>
                    </ul>
                </section>

                <section aria-labelledby="verantwortlich-heading">
                    <h2
                        id="verantwortlich-heading"
                        class="mt-6 text-2xl font-semibold"
                    >
                        Verantwortlich für den Inhalt nach § 55 Abs. 2 RStV
                    </h2>
                    <address class="mb-4 not-italic">
                        Radhouan Jouini<br />
                        Norrenbergstraße 122<br />
                        42289 Wuppertal<br />
                        Deutschland
                    </address>
                </section>

                <section aria-labelledby="ustid-heading">
                    <h2 id="ustid-heading" class="mt-6 text-2xl font-semibold">
                        Umsatzsteuer-ID
                    </h2>
                    <p>
                        Umsatzsteuer-Identifikationsnummer gemäß § 27 a
                        Umsatzsteuergesetz:<br />
                        <em>USt-IdNr. DE432559610</em>
                    </p>
                </section>

                <section aria-labelledby="streitschlichtung-heading">
                    <h2
                        id="streitschlichtung-heading"
                        class="mt-6 text-2xl font-semibold"
                    >
                        EU-Streitschlichtung
                    </h2>
                    <p>
                        Die Europäische Kommission stellt eine Plattform zur
                        Online-Streitbeilegung (OS) bereit:<br />
                        <a
                            href="https://ec.europa.eu/consumers/odr"
                            target="_blank"
                            rel="noopener"
                            class="text-blue-700 underline focus:outline focus:ring-2 focus:ring-blue-400"
                        >
                            https://ec.europa.eu/consumers/odr </a
                        ><br />
                        Unsere E-Mail-Adresse finden Sie oben im Impressum.
                    </p>
                </section>

                <section aria-labelledby="verbraucherschlichtung-heading">
                    <h2
                        id="verbraucherschlichtung-heading"
                        class="mt-6 text-2xl font-semibold"
                    >
                        Verbraucherstreitbeilegung/Universalschlichtungsstelle
                    </h2>
                    <p>
                        Wir sind nicht bereit oder verpflichtet, an
                        Streitbeilegungsverfahren vor einer
                        Verbraucherschlichtungsstelle teilzunehmen.
                    </p>
                </section>

                <section aria-labelledby="haftung-inhalte-heading">
                    <h2
                        id="haftung-inhalte-heading"
                        class="mt-6 text-2xl font-semibold"
                    >
                        Haftung für Inhalte
                    </h2>
                    <p>
                        Als Diensteanbieter sind wir gemäß § 7 Abs. 1 TMG für
                        eigene Inhalte auf diesen Seiten nach den allgemeinen
                        Gesetzen verantwortlich. Nach §§ 8 bis 10 TMG sind wir
                        als Diensteanbieter jedoch nicht verpflichtet,
                        übermittelte oder gespeicherte fremde Informationen zu
                        überwachen oder nach Umständen zu forschen, die auf eine
                        rechtswidrige Tätigkeit hinweisen. Verpflichtungen zur
                        Entfernung oder Sperrung der Nutzung von Informationen
                        nach den allgemeinen Gesetzen bleiben hiervon unberührt.
                        Eine diesbezügliche Haftung ist jedoch erst ab dem
                        Zeitpunkt der Kenntnis einer konkreten Rechtsverletzung
                        möglich. Bei Bekanntwerden von entsprechenden
                        Rechtsverletzungen werden wir diese Inhalte umgehend
                        entfernen.
                    </p>
                </section>

                <section aria-labelledby="haftung-links-heading">
                    <h2
                        id="haftung-links-heading"
                        class="mt-6 text-2xl font-semibold"
                    >
                        Haftung für Links
                    </h2>
                    <p>
                        Unser Angebot enthält Links zu externen Websites
                        Dritter, auf deren Inhalte wir keinen Einfluss haben.
                        Deshalb können wir für diese fremden Inhalte auch keine
                        Gewähr übernehmen. Für die Inhalte der verlinkten Seiten
                        ist stets der jeweilige Anbieter oder Betreiber der
                        Seiten verantwortlich. Die verlinkten Seiten wurden zum
                        Zeitpunkt der Verlinkung auf mögliche Rechtsverstöße
                        überprüft. Rechtswidrige Inhalte waren zum Zeitpunkt der
                        Verlinkung nicht erkennbar. Eine permanente inhaltliche
                        Kontrolle der verlinkten Seiten ist jedoch ohne konkrete
                        Anhaltspunkte einer Rechtsverletzung nicht zumutbar. Bei
                        Bekanntwerden von Rechtsverletzungen werden wir
                        derartige Links umgehend entfernen.
                    </p>
                </section>

                <section aria-labelledby="urheberrecht-heading">
                    <h2
                        id="urheberrecht-heading"
                        class="mt-6 text-2xl font-semibold"
                    >
                        Urheberrecht
                    </h2>
                    <p>
                        Die durch die Seitenbetreiber erstellten Inhalte und
                        Werke auf diesen Seiten unterliegen dem deutschen
                        Urheberrecht. Die Vervielfältigung, Bearbeitung,
                        Verbreitung und jede Art der Verwertung außerhalb der
                        Grenzen des Urheberrechtes bedürfen der schriftlichen
                        Zustimmung des jeweiligen Autors bzw. Erstellers.
                        Downloads und Kopien dieser Seite sind nur für den
                        privaten, nicht kommerziellen Gebrauch gestattet. Soweit
                        die Inhalte auf dieser Seite nicht vom Betreiber
                        erstellt wurden, werden die Urheberrechte Dritter
                        beachtet. Insbesondere werden Inhalte Dritter als solche
                        gekennzeichnet. Sollten Sie trotzdem auf eine
                        Urheberrechtsverletzung aufmerksam werden, bitten wir um
                        einen entsprechenden Hinweis. Bei Bekanntwerden von
                        Rechtsverletzungen werden wir derartige Inhalte umgehend
                        entfernen.
                    </p>
                </section>
            </div>
        </section>
    </GuestLayout>
</template>

<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
</script>
