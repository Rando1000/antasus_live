<template>
    <GuestLayout :serviceArea="'datenschutz'">
        <template #header>
            <section class="w-full px-4 text-center animate-fade-in">
                <div class="max-w-4xl mx-auto">
                    <h1
                        class="mb-6 text-4xl font-extrabold text-white md:text-5xl drop-shadow-xl"
                    >
                        Datenschutz
                    </h1>
                    <p class="text-lg md:text-xl text-white/90 drop-shadow-md">
                        Informationen gemäß DSGVO
                    </p>
                </div>
            </section>
        </template>

        <section class="py-20 bg-white">
            <div class="max-w-3xl px-6 mx-auto prose prose-lg prose-slate">
                <h2>1. Datenschutz auf einen Blick</h2>
                <p>
                    Wir nehmen den Schutz Ihrer persönlichen Daten sehr ernst.
                    Die Nutzung unserer Website ist in der Regel ohne Angabe
                    personenbezogener Daten möglich.
                </p>

                <h2>2. Allgemeine Hinweise und Pflichtinformationen</h2>
                <p>
                    Verantwortlich für die Datenverarbeitung ist:<br />
                    ANTASUS Infra<br />
                    Inh. Radhouan Jouini<br />
                    Norrenbergstraße 122<br />
                    42289 Wuppertal<br />
                    E-Mail: <a href="mailto:info@antasus.de">info@antasus.de</a>
                </p>

                <h2>3. Datenerfassung auf unserer Website</h2>
                <h3>Cookies</h3>
                <p>
                    Unsere Internetseiten verwenden teilweise so genannte
                    Cookies. Cookies richten auf Ihrem Rechner keinen Schaden an
                    und enthalten keine Viren.
                </p>

                <h3>Server-Log-Dateien</h3>
                <p>
                    Der Provider der Seiten erhebt und speichert automatisch
                    Informationen in so genannten Server-Log-Dateien...
                </p>

                <h2>4. Plugins und Tools</h2>
                <h3>Google Maps</h3>
                <p>
                    Diese Seite nutzt über eine API den Kartendienst Google
                    Maps. Anbieter ist die Google Inc., 1600 Amphitheatre
                    Parkway, Mountain View, CA 94043, USA.
                </p>

                <h2>5. Rechte der betroffenen Person</h2>
                <p>
                    Sie haben jederzeit das Recht auf unentgeltliche Auskunft
                    über Ihre gespeicherten personenbezogenen Daten, deren
                    Herkunft und Empfänger und den Zweck der
                    Datenverarbeitung...
                </p>
            </div>
        </section>
    </GuestLayout>
</template>

<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
</script>
