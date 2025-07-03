<template>
    <Head>
        <title>DSL vs. Glasfaser: Speed, Stabilität & Kosten – Antasus</title>
        <meta
            name="description"
            content="Vergleich von DSL und Glasfaser: Bandbreite, Latenz, Kosten, Energieeffizienz & Anwendungsszenarien für Unternehmen."
        />
        <meta name="robots" content="index,follow" />
        <meta
            name="keywords"
            content="DSL vs Glasfaser, Bandbreite, Latenz, Internet Technik, Antasus Ratgeber"
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
            content="Erfahren Sie, wie sich DSL und Glasfaser in Speed, Latenz, Stabilität, Kosten und Energieeffizienz unterscheiden."
        />
        <meta
            property="og:image"
            content="https://www.antasus.de/images/og-dsl-vs-glasfaser.webp"
        />
    </Head>

    <GuestLayout serviceArea="ratgeber">
        <!-- Breadcrumb -->
        <nav
            aria-label="Breadcrumb"
            class="container px-4 py-4 mx-auto text-sm text-gray-600 dark:text-gray-400"
        >
            <ol class="inline-flex space-x-1">
                <li>
                    <Link href="/" class="hover:underline">Startseite</Link>
                </li>
                <li>/</li>
                <li>
                    <Link href="/ratgeber" class="hover:underline"
                        >Ratgeber</Link
                    >
                </li>
                <li>/</li>
                <li class="font-semibold" aria-current="page">
                    DSL vs. Glasfaser
                </li>
            </ol>
        </nav>

        <article
            class="container px-4 py-8 mx-auto prose prose-lg dark:prose-invert"
        >
            <header class="text-center">
                <h1
                    class="mb-4 text-4xl font-extrabold md:text-5xl dark:text-white"
                >
                    DSL vs. Glasfaser<br />
                    <span class="gradient-text">Welcher Anschluss passt?</span>
                </h1>
                <p class="text-gray-600 dark:text-gray-400">
                    <time :datetime="publishedAt">{{
                        formatDate(publishedAt)
                    }}</time>
                </p>
            </header>

            <section class="mt-12 space-y-8">
                <h2>🔍 Warum dieser Vergleich?</h2>
                <p>
                    Ob Home-Office, 4K-Streaming oder Unternehmens-VPN – die
                    richtige Technologie entscheidet über Performance und
                    Kosten.
                </p>

                <h2>⚙️ Technische Grundlagen</h2>
                <p>
                    <strong>DSL</strong> überträgt Daten elektrisch über Kupfer
                    (bis ~250 Mbit/s). <strong>Glasfaser</strong> nutzt
                    Lichtimpulse in Glasfaserkabeln (bis > 1 Gbit/s).
                </p>

                <h2>🚀 Bandbreite & Latenz</h2>
                <ul>
                    <li>
                        <strong>DSL:</strong> max. 250 Mbit/s, Ping ~20–50 ms
                    </li>
                    <li>
                        <strong>Glasfaser:</strong> bis > 1 Gbit/s, Ping < 5 ms
                    </li>
                </ul>

                <h2>💰 Kosten & Betrieb</h2>
                <ul>
                    <li>
                        <strong>Installationskosten:</strong> DSL oft günstiger,
                        Glasfaser förderfähig
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

                <h2>🏢 Anwendungsszenarien</h2>
                <ul>
                    <li>
                        <strong>Home-Office:</strong> stabile Videokonferenzen
                    </li>
                    <li><strong>Gaming:</strong> niedrige Latenz</li>
                    <li>
                        <strong>Enterprise:</strong> große Bandbreiten für
                        Cloud-Services
                    </li>
                </ul>

                <h2>🔗 Entscheidungshilfe</h2>
                <p>
                    Für einfache Office-Aufgaben reicht DSL. Für zukunftssichere
                    High-Performance empfiehlt sich Glasfaser.
                </p>

                <div class="text-center">
                    <button
                        @click="
                            onCtaClick('DSL vs. Glasfaser – Beratung & Angebot')
                        "
                        class="btn-xl focus:outline-none focus:ring-2 focus:ring-[#00fdcf]"
                    >
                        Beratung & Angebot anfragen
                    </button>
                </div>
            </section>
            <section class="pt-8 mt-16 border-t">
                <h3 class="mb-4 text-xl font-semibold">Weitere Ratgeber</h3>
                <ul class="space-y-2">
                    <li>
                        <Link
                            href="/ratgeber/how-to-get-ftth"
                            class="text-antasus-primary hover:underline"
                        >
                            Wie bekomme ich meinen Glasfaser Hausanschluss
                        </Link>
                    </li>
                    <li>
                        <Link
                            href="/ratgeber/glasfaser"
                            class="text-antasus-primary hover:underline"
                        >
                            FTTH – Glasfaser bis ins Haus: Technik & Förderung
                        </Link>
                    </li>
                    <li>
                        <Link
                            href="/glasfaserbau"
                            class="text-antasus-primary hover:underline"
                        >
                            Glasfaserbau: Tiefbau & Infrastruktur
                        </Link>
                    </li>
                    <li>
                        <Link
                            href="/ratgeber/ftth-fiber-to-the-home"
                            class="text-antasus-primary hover:underline"
                        >
                            FTTH - Glasfaser bis ins Haus: Technik & Förderung
                        </Link>
                    </li>
                    <li>
                        <Link
                            href="/ratgeber/technologien"
                            class="text-antasus-primary hover:underline"
                        >
                            Techniken und Technologien Im FTTX
                        </Link>
                    </li>
                </ul>
            </section>
        </article>

        <BookingModal
            v-if="showBookingModal"
            :open="true"
            @close="showBookingModal = false"
            @typeSelected="handleMeetingType"
        />

        <!-- FAQ -->
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
        <section class="pb-12 text-center">
            <Link
                href="/ratgeber/technologien"
                class="inline-block px-6 py-3 text-white transition bg-indigo-600 rounded-lg hover:bg-indigo-700"
            >
                Technologien im Glasfaserbau entdecken
            </Link>
        </section>
    </GuestLayout>
</template>

<script setup>
import { ref, onMounted } from "vue";
import { Head, Link } from "@inertiajs/vue3";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import BookingModal from "@/Components/BookingModal.vue";
import { format } from "date-fns";
import { de } from "date-fns/locale";
import { Inertia } from "@inertiajs/inertia";

const showBookingModal = ref(false);
// Neuer Tracking-Handler
function onCtaClick(label) {
    // 1) GA4 Event feuern
    if (window.gtag) {
        window.gtag("event", "cta_click", {
            category: "Ratgeber",
            label: "DSL vs. Glasfaser - Beratung & Angebot",
            service_area: "ratgeber",
        });
    }
    // 2) Modal öffnen
    showBookingModal.value = true;
}

function handleMeetingType(type) {
    showBookingModal.value = false;
    Inertia.visit(`/buchen?type=${type}`);
}

const publishedAt = ref("2025-06-22");
const formatDate = (d) => format(new Date(d), "d. MMMM yyyy", { locale: de });

const faqItems = [
    {
        q: "Lohnt sich Glasfaser für kleine Unternehmen?",
        a: "Ja – bereits 100 Mbit/s Glasfaser bieten stabilere Verbindungen als DSL.",
    },
    {
        q: "Wie schnell ist mein Ping bei Glasfaser?",
        a: "Unter 5 ms, ideal für Echtzeit-Anwendungen.",
    },
    {
        q: "Kann ich DSL und Glasfaser kombinieren?",
        a: "Hybrid-Anschlüsse sind möglich, bringen aber selten Mehrwert.",
    },
];

onMounted(() => {
    const jsonLd = {
        "@context": "https://schema.org",
        "@graph": [
            {
                "@type": "BreadcrumbList",
                itemListElement: [
                    {
                        "@type": "ListItem",
                        position: 1,
                        name: "Startseite",
                        item: "https://www.antasus.de/",
                    },
                    {
                        "@type": "ListItem",
                        position: 2,
                        name: "Ratgeber",
                        item: "https://www.antasus.de/ratgeber",
                    },
                    {
                        "@type": "ListItem",
                        position: 3,
                        name: "DSL vs. Glasfaser",
                        item: "https://www.antasus.de/ratgeber/dsl-vs-glasfaser",
                    },
                ],
            },
            {
                "@type": "Article",
                mainEntityOfPage: {
                    "@type": "WebPage",
                    "@id": "https://www.antasus.de/ratgeber/dsl-vs-glasfaser",
                },
                headline:
                    "DSL vs. Glasfaser: Speed, Stabilität & Kosten im Vergleich - Antasus",
                description:
                    "Vergleich von DSL und Glasfaser in Speed, Latenz, Stabilität, Kosten & Energieeffizienz.",
                datePublished: publishedAt.value,
                author: { "@type": "Person", name: "R. Jouini" },
                publisher: {
                    "@type": "Organization",
                    name: "ANTASUS Infra",
                    logo: {
                        "@type": "ImageObject",
                        url: "https://www.antasus.de/images/antasus-logo2.svg",
                    },
                },
            },
            {
                "@type": "FAQPage",
                mainEntity: faqItems.map(({ q, a }) => ({
                    "@type": "Question",
                    name: q,
                    acceptedAnswer: { "@type": "Answer", text: a },
                })),
            },
        ],
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
    display: inline-block;
    padding: 0.75rem 1.5rem;
    font-weight: 600;
    color: #fff;
    background: linear-gradient(135deg, #00fdcf, #000);
    border-radius: 0.375rem;
    transition: opacity 0.2s;
}
.btn-xl:hover {
    opacity: 0.9;
}
</style>
