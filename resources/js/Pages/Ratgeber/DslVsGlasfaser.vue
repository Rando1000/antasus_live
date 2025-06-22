<template>
    <Head>
        <title>
            DSL vs. Glasfaser: Speed, Stabilität & Kosten im Vergleich – Antasus
        </title>
        <meta
            name="description"
            content="Vergleich von DSL und Glasfaser: Bandbreite, Latenz, Kosten, Energieeffizienz & Anwendungs­szenarien. Finden Sie die richtige Technik für Ihr Unternehmen."
        />
        <meta name="robots" content="index,follow" />
        <meta
            name="keywords"
            content="DSL vs Glasfaser, Bandbreite Vergleich, Latenz, Internet Technik, Antasus Ratgeber"
        />
        <meta property="og:type" content="article" />
        <meta
            property="og:url"
            content="https://www.antasus.de/ratgeber/dsl-vs-glasfaser"
        />
        <meta
            property="og:title"
            content="DSL vs. Glasfaser: Speed, Stabilität & Kosten im Vergleich"
        />
        <meta
            property="og:description"
            content="Erfahren Sie, wie sich DSL und Glasfaser in Speed, Latenz, Stabilität, Kosten und Energie­effizienz unterscheiden."
        />
        <meta
            property="og:image"
            content="https://www.antasus.de/images/og-dsl-vs-glasfaser.webp"
        />
    </Head>

    <GuestLayout serviceArea="ratgeber">
        <article class="container px-4 py-16 mx-auto">
            <header class="max-w-4xl mx-auto text-center">
                <h1
                    class="mb-4 text-4xl font-extrabold md:text-5xl dark:text-white"
                >
                    DSL vs. Glasfaser<br />
                    <span class="gradient-text">Welcher Anschluss passt?</span>
                </h1>
                <p class="mb-8 text-gray-600 dark:text-gray-400">
                    <time :datetime="publishedAt">{{
                        formatDate(publishedAt)
                    }}</time>
                </p>
            </header>

            <section
                class="max-w-4xl mx-auto space-y-8 prose prose-lg dark:prose-invert"
            >
                <h2>🔍 Warum dieser Vergleich?</h2>
                <p>
                    Ob Home-Office, 4K-Streaming oder Unternehmens-VPN – die
                    richtige Technologie entscheidet über Performance und
                    Kosten.
                </p>

                <h2>⚙️ Technische Grundlagen</h2>
                <p>
                    <strong>DSL</strong> überträgt Daten elektrisch über Kupfer,
                    typisch bis 250 Mbit/s. <strong>Glasfaser</strong> nutzt
                    Lichtimpulse in Glasfaserkabeln, heute bis zu 1 Gbit/s und
                    mehr.
                </p>

                <h2>🚀 Bandbreite & Latenz</h2>
                <ul>
                    <li>
                        <strong>DSL:</strong> max. 250 Mbit/s, Ping ~20–50 ms
                    </li>
                    <li>
                        <strong>Glasfaser:</strong> bis 1 Gbit/s+, Ping &lt;5 ms
                    </li>
                </ul>

                <h2>💰 Kosten & Betrieb</h2>
                <ul>
                    <li>
                        <strong>Installations­kosten:</strong> DSL oft
                        günstiger, Glasfaser oft förderfähig
                    </li>
                    <li>
                        <strong>Betriebskosten:</strong> Glasfaser langlebiger,
                        weniger Wartung
                    </li>
                </ul>

                <h2>🌱 Energieeffizienz & Nachhaltigkeit</h2>
                <p>
                    Glasfaser benötigt weniger aktive Repeater und verbraucht
                    deutlich weniger Strom pro übertragenem Gigabit.
                </p>

                <h2>🏢 Anwendungs­szenarien</h2>
                <ul>
                    <li>
                        <strong>Home-Office:</strong> Glasfaser für stabile
                        Video­konferenzen
                    </li>
                    <li>
                        <strong>Gaming:</strong> Geringe Latenz nur per
                        Glasfaser erreichbar
                    </li>
                    <li>
                        <strong>Enterprise:</strong> Hohe Bandbreiten für
                        Cloud-Services
                    </li>
                </ul>

                <h2>🔗 Entscheidungshilfe</h2>
                <p>
                    Für einfache Office-Aufgaben reicht DSL oft aus. Für
                    zukunftssichere High-Performance empfiehlt sich Glasfaser.
                </p>

                <h2>🚀 Jetzt Glasfaser buchen!</h2>
                <p class="text-center">
                    <Link href="/kontakt" class="btn-xl">
                        Beratung & Angebot anfragen
                    </Link>
                </p>
            </section>
        </article>

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
                        class="p-4 bg-white border rounded-lg group dark:bg-gray-800"
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
    </GuestLayout>
</template>

<script setup>
import { ref, onMounted } from "vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
import { format } from "date-fns";
import { de } from "date-fns/locale";

const publishedAt = ref("2025-06-22");
function formatDate(d) {
    return format(new Date(d), "d. MMMM yyyy", { locale: de });
}

const faqItems = [
    {
        q: "Lohnt sich Glasfaser für kleine Unternehmen?",
        a: "Ja – bereits 100 Mbit/s Glasfaser bieten spürbar stabilere Verbindungen als DSL.",
    },
    {
        q: "Wie schnell ist mein Ping bei Glasfaser?",
        a: "In der Regel unter 5 ms, ideal für Echt­zeit­Anwendungen wie Video­calls oder Gaming.",
    },
    {
        q: "Kann ich DSL und Glasfaser kombinieren?",
        a: "Hybrid-Anschlüsse sind möglich, bringen aber meist keinen Mehrwert gegenüber reinen Glasfaser-Leitungen.",
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
.btn-xl {
    @apply inline-block px-6 py-3 font-semibold text-white rounded-lg transition;
    background: linear-gradient(135deg, #00fdcf, #000);
}
</style>
