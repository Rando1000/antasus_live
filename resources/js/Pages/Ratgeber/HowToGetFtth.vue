<template>
    <Head>
        <title>
            FTTH – Glasfaser bis ins Haus: Technik, Kosten & Förderung – Antasus
        </title>
        <meta
            name="description"
            content="Alles zu FTTH: Aufbau, Kosten, Förderprogramme und Praxis­tipps für Glasfaser bis ins Home oder Büro."
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
                <li class="font-semibold" aria-current="page">FTTH</li>
            </ol>
        </nav>
        <article
            class="container px-4 py-8 mx-auto prose prose-lg dark:prose-invert"
        >
            <header class="mb-12 space-y-10 text-center">
                <h1
                    class="mb-4 text-4xl font-extrabold md:text-5xl dark:text-white"
                >
                    FTTH - Glasfaser bis ins Haus:<br />
                    <span class="gradient-text">Der ultimative Leitfaden</span>
                </h1>
                <p class="text-gray-600 dark:text-gray-400">
                    <time :datetime="publishedAt">{{
                        formatDate(publishedAt)
                    }}</time>
                </p>
            </header>

            <!-- 🌟 Hauptartikel mit Storytelling-Ansatz -->
            <div class="space-y-8">
                <!-- 🔍 **Was ist FTTH? – Der digitale Superhighway** -->
                <section
                    class="p-8 bg-white shadow-lg dark:bg-gray-800 rounded-2xl"
                >
                    <h2 class="mb-6 text-3xl font-bold text-center">
                        🚀 Der digitale Superhighway
                    </h2>
                    <p
                        class="text-lg leading-relaxed text-gray-700 dark:text-gray-300"
                    >
                        Stellen Sie sich vor: Sie surfen mit **1 Gbit/s Upload**
                        wie in einer Cloud, streamen 8K-Videos wie im Kino und
                        halten Videokonferenzen ohne Ruckeln.
                        <strong>FTTH</strong> macht das möglich – ohne Kupfer,
                        komplett aus Glas.
                    </p>
                    <div
                        class="p-6 mt-4 bg-gray-50 dark:bg-gray-700 rounded-xl"
                    >
                        <div
                            class="font-semibold text-blue-600 dark:text-blue-400"
                        >
                            📌 Warum FTTH revolutioniert:
                            <ul class="mt-2 space-y-2 list-disc list-inside">
                                <li>
                                    Symmetrische Geschwindigkeiten (gleich
                                    schnell up- und download)
                                </li>
                                <li>
                                    99,9% Ausfallsicherheit dank Lichtwellen
                                </li>
                                <li>Fürs Homeoffice, Smart Home und Gaming</li>
                            </ul>
                        </div>
                    </div>
                </section>

                <!-- ⚙️ **Technischer Aufbau – Von der Leitung ins Haus** -->
                <section>
                    <h2 class="mb-6 text-3xl font-bold text-center">
                        🔧 So kommt das Licht ins Haus
                    </h2>
                    <div class="grid gap-8 md:grid-cols-2">
                        <div
                            class="p-6 bg-white shadow-md dark:bg-gray-800 rounded-2xl"
                        >
                            <h3 class="mb-4 text-xl font-semibold">
                                📍 Schritt 1: Leitungsverlegung
                            </h3>
                            <p class="text-gray-700 dark:text-gray-300">
                                Expertenteams legen die Glasfaser **ohne
                                Tiefbau** per Erdrakete oder Micro-Trenching.
                                <strong>Vorteil:</strong> Keine
                                Straßensperrungen, keine Lärmbelästigung.
                            </p>
                        </div>
                        <div
                            class="p-6 bg-white shadow-md dark:bg-gray-800 rounded-2xl"
                        >
                            <h3 class="mb-4 text-xl font-semibold">
                                🏠 Schritt 2: Hausanschluss
                            </h3>
                            <p class="text-gray-700 dark:text-gray-300">
                                Die Faser wird **dicht an Ihr Haus** geführt –
                                durch wasserdichte Hülle und in Leerrohren für
                                zukünftige Upgrades.
                            </p>
                        </div>
                    </div>
                </section>

                <!-- 💶 **Kosten & Förderung – Wo sparen Sie** -->
                <section
                    class="p-8 shadow-lg bg-gray-50 dark:bg-gray-700 rounded-2xl"
                >
                    <h2 class="mb-6 text-3xl font-bold text-center">
                        💡 Investition mit Rückenwind
                    </h2>
                    <div class="grid gap-8 md:grid-cols-2">
                        <div
                            class="p-6 bg-white shadow-md dark:bg-gray-800 rounded-xl"
                        >
                            <h3 class="mb-4 text-xl font-semibold">
                                📉 Kosten im Überblick
                            </h3>
                            <div class="space-y-4">
                                <p class="flex justify-between">
                                    <span class="font-medium"
                                        >Grundinstallation</span
                                    >
                                    <span
                                        class="text-blue-600 dark:text-blue-400"
                                        >800–2.500 €</span
                                    >
                                </p>
                                <p class="flex justify-between">
                                    <span class="font-medium">Förderung</span>
                                    <span
                                        class="text-green-600 dark:text-green-400"
                                        >50–90%</span
                                    >
                                </p>
                                <p class="flex justify-between">
                                    <span class="font-medium"
                                        >Dauerhaft ersparte Kosten</span
                                    >
                                    <span class="text-red-600 dark:text-red-400"
                                        >Kupfermiete</span
                                    >
                                </p>
                            </div>
                        </div>
                        <div
                            class="p-6 bg-white shadow-md dark:bg-gray-800 rounded-xl"
                        >
                            <h3 class="mb-4 text-xl font-semibold">
                                🔑 Förder-Tipp
                            </h3>
                            <div class="text-gray-700 dark:text-gray-300">
                                <strong>Wichtig:</strong> Beantragen Sie die
                                Förderung **vor** der Installation!
                                <ul
                                    class="mt-2 space-y-2 list-disc list-inside"
                                >
                                    <li>Bundesförderung (BAFA)</li>
                                    <li>Landesprogramme</li>
                                    <li>Kommunale Zuschüsse</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- ⏱️ **Installationsablauf – Schritt für Schritt** -->
                <section>
                    <h2 class="mb-6 text-3xl font-bold text-center">
                        🔧 Ihr FTTH-Checkliste
                    </h2>
                    <div class="grid gap-6 md:grid-cols-3">
                        <div
                            class="p-6 text-center bg-white shadow-md dark:bg-gray-800 rounded-xl"
                        >
                            <h3 class="mb-4 text-xl font-semibold">
                                📅 1. Terminvereinbarung
                            </h3>
                            <p class="text-gray-700 dark:text-gray-300">
                                Vor-Ort-Check + individuelles Angebot
                                <span class="text-blue-600 dark:text-blue-400"
                                    >Kostenlos</span
                                >
                            </p>
                        </div>
                        <div
                            class="p-6 text-center bg-white shadow-md dark:bg-gray-800 rounded-xl"
                        >
                            <h3 class="mb-4 text-xl font-semibold">
                                🛠️ 2. Installation
                            </h3>
                            <p class="text-gray-700 dark:text-gray-300">
                                1–3 Tage ohne Tiefbau
                                <span class="text-green-600 dark:text-green-400"
                                    >Sofort einsatzbereit</span
                                >
                            </p>
                        </div>
                        <div
                            class="p-6 text-center bg-white shadow-md dark:bg-gray-800 rounded-xl"
                        >
                            <h3 class="mb-4 text-xl font-semibold">
                                📈 3. Inbetriebnahme
                            </h3>
                            <p class="text-gray-700 dark:text-gray-300">
                                Speedtest + Dokumentation
                                <span class="text-red-600 dark:text-red-400"
                                    >Garantie inklusive</span
                                >
                            </p>
                        </div>
                    </div>
                </section>

                <!-- ✅ **Vorteile – Warum FTTH lohnt sich** -->
                <section
                    class="p-8 bg-gray-100 shadow-lg dark:bg-gray-900 rounded-2xl"
                >
                    <h2 class="mb-6 text-3xl font-bold text-center">
                        🏆 Ihre Vorteile im Überblick
                    </h2>
                    <div class="grid gap-8 md:grid-cols-2">
                        <div
                            class="p-6 bg-white shadow-md dark:bg-gray-800 rounded-xl"
                        >
                            <h3 class="mb-4 text-xl font-semibold">
                                🌐 Für Privatnutzer
                            </h3>
                            <div class="space-y-4">
                                <p class="flex items-center">
                                    <svg
                                        class="w-5 h-5 mr-2 text-green-500 dark:text-green-400"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"
                                        ></path>
                                    </svg>
                                    <span>8K-Streaming ohne Buffering</span>
                                </p>
                                <p class="flex items-center">
                                    <svg
                                        class="w-5 h-5 mr-2 text-green-500 dark:text-green-400"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M12 6v6m0 0v6m0-6h6m-6 0H6"
                                        ></path>
                                    </svg>
                                    <span>Smart Home-Steuerung</span>
                                </p>
                            </div>
                        </div>
                        <div
                            class="p-6 bg-white shadow-md dark:bg-gray-800 rounded-xl"
                        >
                            <h3 class="mb-4 text-xl font-semibold">
                                🏢 Für Unternehmen
                            </h3>
                            <div class="space-y-4">
                                <p class="flex items-center">
                                    <svg
                                        class="w-5 h-5 mr-2 text-green-500 dark:text-green-400"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M13 10V3L4 14h7v7l9-11h-7z"
                                        ></path>
                                    </svg>
                                    <span>Cloud-Backups in Echtzeit</span>
                                </p>
                                <p class="flex items-center">
                                    <svg
                                        class="w-5 h-5 mr-2 text-green-500 dark:text-green-400"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"
                                        ></path>
                                    </svg>
                                    <span>Latenciearmes Online-Meeting</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- 🚀 **Fazit – Ihr nächster Schritt** -->
                <section
                    class="p-8 bg-white shadow-lg dark:bg-gray-800 rounded-2xl"
                >
                    <h2 class="mb-6 text-3xl font-bold text-center">
                        🚀 Machen Sie den Schritt ins Gigabit-Zeitalter
                    </h2>
                    <div class="max-w-2xl mx-auto text-center">
                        <p
                            class="mb-8 text-lg leading-relaxed text-gray-700 dark:text-gray-300"
                        >
                            FTTH ist kein optionaler Upgrade – es ist die
                            Grundlage für Ihr digitales Leben.
                            <strong>Warum warten?</strong> Mit unserer Expertise
                            und den aktuellen Förderprogrammen wird Ihre
                            Glasfaser-Installation zum Kinderspiel.
                        </p>
                        <button
                            @click="showBookingModal = true"
                            class="px-4 py-2 text-white transition rounded-lg bg-gradient-to-r from-teal-600 to-black hover:shadow-lg"
                        >
                            Jetzt FTTH-Anschluss sichern
                        </button>
                    </div>
                    <BookingModal
                        v-if="showBookingModal"
                        :open="true"
                        @close="showBookingModal = false"
                        @typeSelected="handleMeetingType"
                    />
                </section>
            </div>
            <section class="pt-8 mt-16 border-t">
                <h3 class="mb-4 text-xl font-semibold">Weitere Ratgeber</h3>
                <ul class="space-y-2">
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
                            href="/ratgeber/glasfaser"
                            class="text-antasus-primary hover:underline"
                        >
                            FTTH - Glasfaser Tiefbau und mehr
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
                            href="/ratgeber/dsl-vs-glasfaser"
                            class="text-antasus-primary hover:underline"
                        >
                            DSL vs. Glasfaser: Speed, Stabilität & Kosten
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

const handleMeetingType = (type) => {
    showBookingModal.value = false;
    router.visit(`/buchen?type=${type}`);
};

const publishedAt = ref("2025-06-22");
const formatDate = (d) => format(new Date(d), "d. MMMM yyyy", { locale: de });

const faqItems = [
    {
        q: "Welche Förderprogramme gibt es für FTTH?",
        a: "Bund und Länder erstatten meist 50–90 % der Installationskosten.",
    },
    {
        q: "Wie lange dauert die FTTH-Installation?",
        a: "Typisch 1–3 Werktage, je nach örtlichen Gegebenheiten.",
    },
    {
        q: "Brauche ich spezielle Hardware?",
        a: "Sie benötigen ein ONT und einen Glasfaser-fähigen Router, z. B. FRITZ!Box.",
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
                        name: "FTTH",
                        item: "https://www.antasus.de/ratgeber/ftth-fiber-to-the-home",
                    },
                ],
            },
            {
                "@type": "Article",
                mainEntityOfPage: {
                    "@type": "WebPage",
                    "@id": "https://www.antasus.de/ratgeber/ftth-fiber-to-the-home",
                },
                headline:
                    "FTTH – Glasfaser bis ins Haus: Technik, Kosten & Förderung – Antasus",
                description:
                    "Alles zu FTTH: Aufbau, Kosten, Förderprogramme und Praxis­tipps für Glasfaser bis ins Gebäude.",
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
</style>
