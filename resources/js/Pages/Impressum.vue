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

        <section class="py-20 bg-white">
            <div
                class="max-w-3xl px-6 mx-auto prose prose-lg shadow-xl rounded-xl prose-slate"
            >
                <h2>Angaben gemäß § 5 TMG</h2>
                <p>
                    ANTASUS Infra<br />
                    Inh. Radhouan Jouini<br />
                    Norrenbergstraße 122<br />
                    42289 Wuppertal
                </p>

                <h2>Kontakt</h2>
                <p>
                    Telefon: <a href="tel:+4917624757616">+49 176 24757616</a
                    ><br />
                    E-Mail: <a href="mailto:info@antasus.de">info@antasus.de</a
                    ><br />
                    Web:
                    <a href="https://www.antasus.de" target="_blank"
                        >www.antasus.de</a
                    >
                </p>

                <h2>Verantwortlich für den Inhalt nach § 55 Abs. 2 RStV</h2>
                <p>
                    Radhouan Jouini<br />Norrenbergstraße 122<br />42289
                    Wuppertal
                </p>

                <h2>EU-Streitschlichtung</h2>
                <p>
                    Die Europäische Kommission stellt eine Plattform zur
                    Online-Streitbeilegung (OS) bereit:
                    <a
                        href="https://ec.europa.eu/consumers/odr"
                        target="_blank"
                        rel="noopener"
                        >https://ec.europa.eu/consumers/odr</a
                    >.<br />
                    Unsere E-Mail-Adresse finden Sie oben im Impressum.
                </p>

                <h2>Haftung für Inhalte</h2>
                <p>
                    Als Diensteanbieter sind wir gemäß § 7 Abs.1 TMG für eigene
                    Inhalte auf diesen Seiten nach den allgemeinen Gesetzen
                    verantwortlich...
                </p>
            </div>
        </section>
    </GuestLayout>
</template>

<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
</script>
