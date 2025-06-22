<template>
    <Head>
        <title>
            Was ist Glasfaser? Technik, Vorteile & Varianten – Antasus
        </title>
        <link
            rel="canonical"
            href="https://www.antasus.de/ratgeber/glasfaser"
        />
        <meta
            name="description"
            content="Entdecken Sie, was Glasfaser ist, wie es funktioniert, die Unterschiede zu DSL und Varianten wie FTTH/FTTB/FTTC/FTTN. Jetzt bei Antasus."
        />
        <meta name="robots" content="index,follow" />
        <meta
            name="keywords"
            content="Glasfaser, FTTH, DSL Vergleich, Glasfaser Vorteile, Glasfaserausbau, Antasus"
        />
        <meta property="og:type" content="article" />
        <meta
            property="og:url"
            content="https://www.antasus.de/ratgeber/glasfaser"
        />
        <meta
            property="og:title"
            content="Was ist Glasfaser? Technik, Vorteile & Varianten"
        />
        <meta
            property="og:description"
            content="Glasfaser verständlich erklärt: Technik, Vorteile, Varianten FTTH/FTTB/FTTC/FTTN & Verfügbarkeit in Deutschland."
        />
        <meta
            property="og:image"
            content="https://www.antasus.de/images/og-glasfaser.webp"
        />
    </Head>

    <GuestLayout serviceArea="ratgeber">
        <article class="container px-4 py-16 mx-auto">
            <header class="max-w-3xl mx-auto text-center">
                <h1
                    class="mb-4 text-4xl font-extrabold md:text-5xl dark:text-white"
                >
                    Was ist Glasfaser?<br />
                    <span class="gradient-text"
                        >Technik, Vorteile & Varianten</span
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
                <p>
                    Internet, Streaming, Videocalls. Unser digitaler Alltag
                    wächst rasant. Glasfaser liefert die nötige Bandbreite
                    zuverlässig und zukunftssicher überall dorthin, wo Daten
                    gefragt sind.
                </p>

                <h2>🧬 Was ist Glasfaser?</h2>
                <p>
                    Glasfaser ist eine hauchdünne Quarzglas-Faser, die Daten in
                    Form von Lichtimpulsen mit bis zu 1Gbit/s übertragen kann,
                    deutlich leistungsfähiger als normales DSL.
                </p>
                <blockquote
                    class="p-4 border-l-4 border-teal-400 bg-teal-50 dark:bg-teal-800/50"
                >
                    „Glasfaser ist die leistungsfähigste und zukunftssicherste
                    Technik für Internetverbindungen.“
                </blockquote>

                <h2>🛠️ Wie funktioniert Glasfaser?</h2>
                <p>
                    Statt elektrischer Signale über Kupfer nutzt Glasfaser
                    Licht. Der Aufbau besteht aus:
                </p>
                <ul>
                    <li><strong>Kern:</strong> transportiert Lichtsignale</li>
                    <li>
                        <strong>Cladding:</strong> reflektiert das Licht zurück
                        in den Kern
                    </li>
                    <li><strong>Schutzmantel:</strong> schützt mechanisch</li>
                </ul>
                <p>
                    Lichtsignale laufen nahezu verlustfrei durch das Kabel,
                    ideal für schnelle und stabile Übertragung über lange
                    Distanzen.
                </p>

                <h2>✅ Vorteile gegenüber DSL</h2>
                <ul>
                    <li><strong>Über 1Gbit/s</strong> Geschwindigkeit</li>
                    <li>
                        <strong>Hohe Stabilität:</strong> auch bei mehreren
                        Nutzern gleichzeitig
                    </li>
                    <li>
                        <strong>Niedrige Latenz:</strong> perfekt für Gaming &
                        Videokonferenzen
                    </li>
                    <li>
                        <strong>Energieeffizient:</strong> weniger Strom und
                        nachhaltig
                    </li>
                    <li>
                        <strong>Zukunftssicher:</strong> skalierbar mit
                        wachsenden Bandbreitenanforderungen
                    </li>
                </ul>
                <p>
                    DSL ist typischerweise auf 250Mbit/s beschränkt, während
                    Glasfaser drahtlose Höchstleistung ermöglicht.
                </p>

                <h2>🔀 Varianten: FTTH, FTTB, FTTC & FTTN</h2>
                <dl>
                    <dt><strong>FTTH</strong> (Fiber to the Home)</dt>
                    <dd>
                        Glasfaser bis ins Haus oder Büro. Maximale Leistung.
                    </dd>

                    <dt><strong>FTTB</strong> (Fiber to the Building)</dt>
                    <dd>
                        Faser am Gebäude, Verteilung danach über Kupfer.
                        Leistung abhängig von Innenverkabelung.
                    </dd>

                    <dt><strong>FTTC</strong> (Fiber to the Curb)</dt>
                    <dd>
                        Auf halbem Weg, Glasfaser endet am Straßenverteiler,
                        Kupfer bis ins Gebäude.
                    </dd>

                    <dt><strong>FTTN</strong> (Fiber to the Node)</dt>
                    <dd>
                        Glasfaser endet weit entfernt, den Rest übernimmt Kupfer
                        am langsamsten.
                    </dd>
                </dl>
                <figure class="max-w-full mx-auto my-6">
                    <img
                        src="/images/Hausanschluesse.svg"
                        srcset="
                            /images/Hausanschluesse.svg  400w,
                            /images/Hausanschluesse.svg  800w,
                            /images/Hausanschluesse.svg 1200w
                        "
                        sizes="(max-width: 640px) 100vw, 800px"
                        alt="Schema der Glasfaser-Varianten FTTH, FTTB, FTTC & FTTN mit Vergleich Kupferabschnitt"
                        class="block w-full rounded-lg border border-gray-200 shadow-lg transition-shadow duration-200 hover:shadow-2xl focus:outline-none focus:ring-2 focus:ring-[#00fdcf]"
                        loading="lazy"
                    />
                    <figcaption
                        class="mt-2 text-lg text-center text-gray-600 dark:text-gray-400"
                    >
                        Übersicht der Glasfaser-Varianten: Türkis = Glasfaser,
                        Orange = Kupferleitung.
                    </figcaption>
                </figure>

                <h2>📊 Glasfaserausbau in Deutschland</h2>
                <p>
                    Laut Bundesnetzagentur lag die FTTH/B-Abdeckung im Januar
                    2025 bei 36,8%. Ziel ist 50% bis Ende 2025, flächendeckend
                </p>
                <p>
                    Führende Anbieter sind Telekom, Deutsche Glasfaser,
                    Vodafone, 1&1 & Co., ergänzt durch kommunale Ausbauten und
                    Förderprogramme.
                </p>

                <h2 class="text-center">🚀 Jetzt Glasfaser buchen!</h2>
                <div class="text-center">
                    <button
                        @click="showBookingModal = true"
                        class="px-4 py-2 text-white transition rounded-lg bg-gradient-to-r from-teal-600 to-black hover:shadow-lg"
                    >
                        Jetzt Betriebs-Anschluss sichern
                    </button>
                </div>
                <BookingModal
                    v-if="showBookingModal"
                    :open="true"
                    @close="showBookingModal = false"
                    @typeSelected="handleMeetingType"
                />
            </section>
        </article>
        <section class="py-16 mb-10 border-t border-gray-100 bg-gray-50">
            <div class="max-w-4xl px-4 mx-auto">
                <h2
                    class="mb-10 text-3xl font-extrabold text-center text-gray-900"
                >
                    Häufige Fragen
                </h2>
                <div class="space-y-4">
                    <details
                        v-for="(item, index) in faqItems"
                        :key="index"
                        class="p-4 bg-white border rounded-lg group dark:bg-gray-800"
                    >
                        <summary
                            class="text-lg font-semibold text-gray-800 cursor-pointer focus:outline-none focus:ring-2 focus:ring-primary dark:text-white"
                        >
                            {{ item.q }}
                        </summary>
                        <div
                            class="mt-2 leading-relaxed text-gray-600 dark:text-gray-300"
                        >
                            {{ item.a }}
                        </div>
                    </details>
                </div>
            </div>
        </section>
        <!-- 3️⃣ CTA nach LSI-Text -->
        <section class="pb-12 text-center">
            <Link
                href="/technologien"
                class="inline-block px-6 py-3 text-white transition bg-indigo-600 rounded-lg hover:bg-indigo-700"
            >
                Technologien im Glasfaserbau entdecken
            </Link>
        </section>
    </GuestLayout>
</template>

<script setup>
import { ref, onMounted } from "vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
import { format } from "date-fns";
import { de } from "date-fns/locale";
import BookingModal from "@/Components/BookingModal.vue";
import NavLink from "@/Components/NavLink.vue";

const publishedAt = ref("2025-06-21");

const showBookingModal = ref(false);

const handleMeetingType = (type) => {
    showBookingModal.value = false;
    router.visit(`/buchen?type=${type}`);
};

function formatDate(d) {
    return format(new Date(d), "d. MMMM yyyy", { locale: de });
}

const faqItems = [
    {
        q: "Warum zahlt sich ein Glasfaseranschluss aus, auch langfristig?",
        a: "Ein Glasfaseranschluss bietet überlegene Geschwindigkeit, Stabilität und Zukunftsfähigkeit. Er steigert außerdem häufig den Immobilienwert.",
    },
    {
        q: "Welche technische Ausstattung benötige ich für einen Glasfaseranschluss?",
        a: "In der Regel benötigen Sie ein ONT-Modem oder einen kompatiblen Router wie eine aktuelle FRITZ!Box. Telefonie funktioniert via VoIP.",
    },
    {
        q: "Was ist besser? FTTH oder FTTB/FTTC/FTTN?",
        a: "FTTH bietet die beste Leistung. FTTB, FTTC und FTTN beinhalten Kupferabschnitte, was zu Einbußen bei Geschwindigkeit und Stabilität führt.",
    },
    {
        q: "Was ist Glasfaser?",
        a: "Eine Faser aus Quarzglas, die Lichtdaten mit Lichtimpulsen bis zu 1 Gbit/s überträgt.",
    },
    {
        q: "Was sind die Vorteile von Glasfaser?",
        a: "Höhere Geschwindigkeit, stabile Verbindung, niedrige Latenz, Energieeffizienz und Zukunftssicherheit.",
    },
    {
        q: "Worin unterscheiden sich FTTH, FTTB, FTTC und FTTN?",
        a: "FTTH: bis ins Gebäude; FTTB: bis ins Haus; FTTC: bis zum Verteiler; FTTN: nur bis zum Knoten.",
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
    s.text = JSON.stringify(jsonLd);
    document.head.appendChild(s);
});
</script>

<style scoped>
.container {
    max-width: 800px;
}
.gradient-text {
    background: linear-gradient(135deg, #00fdcf, #000);
    -webkit-background-clip: text;
    color: transparent;
}
.btn-xl {
    padding: 0.75rem 1.5rem;
    font-weight: 600;
    background: linear-gradient(135deg, #00fdcf, #000);
    color: #fff;
    border-radius: 0.5rem;
    transition: opacity 0.2s;
}
.btn-xl:hover {
    opacity: 0.9;
}
.prose blockquote {
    border-left: 4px solid #00fdcf;
    background: rgba(0, 253, 207, 0.1);
    padding: 1rem;
}
.dark .prose blockquote {
    background: rgba(0, 253, 207, 0.2);
}
dl dt {
    font-weight: 600;
    margin-top: 1rem;
}
dl dd {
    margin-left: 1rem;
}
</style>
