<template>
    <Head>
        <title>
            FTTH – Glasfaser bis ins Haus: Technik, Kosten & Förderung – Antasus
        </title>
        <meta
            name="description"
            content="Erfahren Sie alles über FTTH: Aufbau, Kosten, Förderprogramme und Praxis­tipps für Glasfaser bis ins Home oder Büro."
        />
        <meta name="robots" content="index,follow" />
        <meta
            name="keywords"
            content="FTTH, Fiber to the Home, Glasfaser Förderung, Hausanschluss Technik, Antasus"
        />
        <meta property="og:type" content="article" />
        <meta
            property="og:url"
            content="https://www.antasus.de/ratgeber/ftth-fiber-to-the-home"
        />
        <meta
            property="og:title"
            content="FTTH – Glasfaser bis ins Haus: Technik, Kosten & Förderung"
        />
        <meta
            property="og:description"
            content="Alles zu FTTH: Wie Glasfaser bis ins Gebäude verlegt wird, welche Kosten anfallen & welche Förderprogramme es gibt."
        />
        <meta
            property="og:image"
            content="https://www.antasus.de/images/og-ftth.webp"
        />
    </Head>

    <GuestLayout serviceArea="ratgeber">
        <article class="container px-4 py-16 mx-auto">
            <header class="max-w-3xl mx-auto text-center">
                <h1
                    class="mb-4 text-4xl font-extrabold md:text-5xl dark:text-white"
                >
                    FTTH – Fiber to the Home<br />
                    <span class="gradient-text"
                        >Technik, Kosten & Förderung</span
                    >
                </h1>
                <p class="mb-8 text-gray-600 dark:text-gray-400">
                    <time :datetime="publishedAt">{{
                        formatDate(publishedAt)
                    }}</time>
                </p>
            </header>

            <section
                class="max-w-3xl mx-auto space-y-8 prose prose-lg dark:prose-invert"
            >
                <h2>🏠 Was ist FTTH?</h2>
                <p>
                    FTTH bedeutet Glasfaser bis ins Home- oder Bürogebäude –
                    ohne Kupferanteil, für maximale Bandbreite und Stabilität.
                </p>

                <h2>⚙️ Technischer Aufbau</h2>
                <ul>
                    <li>
                        <strong>Gebäudeeinführung:</strong> Erdverlegung bis
                        Gebäudeunterkante
                    </li>
                    <li>
                        <strong>ONT/Modem:</strong> Optischer Netzwerk­abschluss
                        direkt im Haus
                    </li>
                    <li><strong>Router:</strong> Verteilung ins LAN/WLAN</li>
                </ul>

                <h2>💶 Kosten & Förderung</h2>
                <ul>
                    <li>
                        <strong>Installationskosten:</strong> je nach Länge &
                        Aufwand 800–2.500 €
                    </li>
                    <li>
                        <strong>Förderprogramme:</strong> Bund & Länder
                        erstatten meist 50–90 %
                    </li>
                </ul>

                <h2>🔧 Installations­ablauf</h2>
                <ol>
                    <li>Vor-Ort-Begehung & Angebotserstellung</li>
                    <li>Graben & Leitungsverlegung</li>
                    <li>Gebäudeeinführung & ONT-Montage</li>
                    <li>Inbetriebnahme & Test</li>
                </ol>

                <h2>✅ Vorteile & Praxis</h2>
                <p>
                    FTTH bietet symmetrische Geschwindigkeiten bis 1 Gbit/s+,
                    höchste Zuverlässigkeit und minimale Latenz – ideal für
                    Business-Anwendungen.
                </p>
            </section>

            <section class="py-16 bg-gray-50">
                <div class="max-w-4xl px-4 mx-auto">
                    <h2
                        class="mb-10 text-3xl font-extrabold text-center text-gray-900"
                    >
                        Häufige Fragen
                    </h2>
                    <div class="space-y-4">
                        <details
                            v-for="(item, i) in faqItems"
                            :key="i"
                            class="p-4 bg-white border rounded-lg dark:bg-gray-800"
                        >
                            <summary
                                class="text-lg font-semibold text-gray-800 cursor-pointer focus:outline-none focus:ring-2 focus:ring-primary dark:text-white"
                            >
                                {{ item.q }}
                            </summary>
                            <div class="mt-2 text-gray-600 dark:text-gray-300">
                                {{ item.a }}
                            </div>
                        </details>
                    </div>
                </div>
            </section>
        </article>
    </GuestLayout>
</template>

<script setup>
import { ref, onMounted } from "vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import { Head } from "@inertiajs/vue3";
import { format } from "date-fns";
import { de } from "date-fns/locale";

const publishedAt = ref("2025-06-22");
function formatDate(d) {
    return format(new Date(d), "d. MMMM yyyy", { locale: de });
}

const faqItems = [
    {
        q: "Welche Förderprogramme gibt es für FTTH?",
        a: "Bund und Länder bieten in der Regel Zuschüsse zwischen 50–90 % der Installationskosten.",
    },
    {
        q: "Wie lange dauert die FTTH-Installation?",
        a: "Typischerweise 1–3 Werktage, abhängig von örtlichen Gegebenheiten.",
    },
    {
        q: "Brauche ich spezielle Hardware?",
        a: "Sie benötigen ein ONT (Optical Network Terminal) und einen Glasfaser-fähigen Router, z. B. eine FRITZ!Box.",
    },
];

onMounted(() => {
    const jsonLd = {
        "@context": "https://schema.org",
        "@type": "FAQPage",
        mainEntity: faqItems.map(({ q, a }) => ({
            "@type": "Question",
            name: q,
            acceptedAnswer: { "@type": "Answer", text: a },
        })),
    };
    const s = document.createElement("script");
    s.type = "application/ld+json";
    s.text = JSON.stringify(jsonLd, null, 2);
    document.head.appendChild(s);
});
</script>

<style scoped>
.gradient-text {
    background: linear-gradient(135deg, #00fdcf, #000);
    -webkit-background-clip: text;
    color: transparent;
}
</style>
