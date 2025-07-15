<template>
    <Head>
        <title>
            FTTH Glasfaser bis ins Haus: Technik, Kosten & Förderung - Antasus
        </title>
        <meta
            name="description"
            content="Alles zu FTTH: Aufbau, Kosten, Förderprogramme und Praxistipps für Glasfaser bis ins Home oder Büro."
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
            content="FTTH Glasfaser bis ins Haus: Technik, Kosten & Förderung"
        />
        <meta
            property="og:description"
            content="Alles zu FTTH: Wie Glasfaser bis ins Gebäude verlegt wird, welche Kosten anfallen & welche Förderprogramme es gibt."
        />
        <meta
            property="og:image"
            content="https://www.antasus.de/images/og-ftth.webp"
        />
        <link
            rel="canonical"
            href="https://www.antasus.de/ratgeber/ftth-fiber-to-the-home"
        />
    </Head>

    <GuestLayout serviceArea="ratgeber">
        <!-- Table of Contents (SGE/UX/Accessibility) -->
        <nav
            aria-label="Seitenstruktur"
            class="sticky z-30 max-w-3xl px-6 py-4 m-5 mx-auto border border-gray-100 shadow top-6 bg-white/90 dark:bg-antasus-dark/90 rounded-xl dark:border-gray-700"
        >
            <ul class="flex flex-wrap justify-center gap-4 text-sm font-medium">
                <li>
                    <a
                        href="#was-ist-ftth"
                        class="hover:text-antasus-primary focus:outline-none focus:ring-2 focus:ring-antasus-primary"
                        >Was ist FTTH?</a
                    >
                </li>
                <li>
                    <a
                        href="#aufbau"
                        class="hover:text-antasus-primary focus:outline-none focus:ring-2 focus:ring-antasus-primary"
                        >Technik &amp; Aufbau</a
                    >
                </li>
                <li>
                    <a
                        href="#kosten"
                        class="hover:text-antasus-primary focus:outline-none focus:ring-2 focus:ring-antasus-primary"
                        >Kosten &amp; Förderung</a
                    >
                </li>
                <li>
                    <a
                        href="#ablauf"
                        class="hover:text-antasus-primary focus:outline-none focus:ring-2 focus:ring-antasus-primary"
                        >Ablauf</a
                    >
                </li>
                <li>
                    <a
                        href="#vorteile"
                        class="hover:text-antasus-primary focus:outline-none focus:ring-2 focus:ring-antasus-primary"
                        >Vorteile</a
                    >
                </li>
                <li>
                    <a
                        href="#cta"
                        class="hover:text-antasus-primary focus:outline-none focus:ring-2 focus:ring-antasus-primary"
                        >Jetzt sichern</a
                    >
                </li>
                <li>
                    <a
                        href="#faq"
                        class="hover:text-antasus-primary focus:outline-none focus:ring-2 focus:ring-antasus-primary"
                        >FAQ</a
                    >
                </li>
            </ul>
        </nav>

        <!-- Breadcrumb -->
        <nav
            aria-label="Brotkrumenpfad"
            class="container px-4 py-4 mx-auto text-sm text-gray-600 dark:text-gray-400"
        >
            <ol
                class="inline-flex space-x-1"
                itemscope
                itemtype="https://schema.org/BreadcrumbList"
            >
                <li
                    itemprop="itemListElement"
                    itemscope
                    itemtype="https://schema.org/ListItem"
                >
                    <Link href="/" class="hover:underline" itemprop="item">
                        <span itemprop="name">Startseite</span>
                    </Link>
                    <meta itemprop="position" content="1" />
                </li>
                <li aria-hidden="true">/</li>
                <li
                    itemprop="itemListElement"
                    itemscope
                    itemtype="https://schema.org/ListItem"
                >
                    <Link
                        href="/ratgeber"
                        class="hover:underline"
                        itemprop="item"
                    >
                        <span itemprop="name">Ratgeber</span>
                    </Link>
                    <meta itemprop="position" content="2" />
                </li>
                <li aria-hidden="true">/</li>
                <li
                    class="font-semibold"
                    aria-current="page"
                    itemprop="itemListElement"
                    itemscope
                    itemtype="https://schema.org/ListItem"
                >
                    <span itemprop="name">FTTH</span>
                    <meta itemprop="position" content="3" />
                </li>
            </ol>
        </nav>

        <article
            class="container px-4 py-8 mx-auto space-y-20 prose prose-lg dark:prose-invert"
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

            <section :id="'was-ist-ftth'" tabindex="-1">
                <h2 class="mb-6 text-3xl font-bold text-center">
                    🚀 Was ist
                    <a
                        href="/ratgeber/ftth-fiber-to-the-home"
                        class="underline text-antasus-second dark:text-antasus-primary"
                        aria-label="Mehr zu FTTH"
                        >FTTH</a
                    >?
                </h2>
                <p>
                    <b>FTTH</b> (<a
                        href="/ratgeber/ftth-fiber-to-the-home"
                        class="underline text-antasus-second dark:text-antasus-primary"
                        >Fiber to the Home</a
                    >) bedeutet Glasfaser bis in Ihr Gebäude -
                    <a
                        href="/ratgeber/glasfaser"
                        class="underline text-antasus-second dark:text-antasus-primary"
                        >Glasfaser</a
                    >
                    ohne Kupferumwege, das Fundament für das
                    <a
                        href="/ratgeber/gigabit-internet"
                        class="underline text-antasus-second dark:text-antasus-primary"
                        >Gigabit-Zeitalter</a
                    >. Vergleichen Sie auch
                    <a
                        href="/ratgeber/dsl-vs-glasfaser"
                        class="underline text-antasus-second dark:text-antasus-primary"
                        >DSL vs. Glasfaser</a
                    >.
                </p>
            </section>

            <section :id="'aufbau'" tabindex="-1">
                <h2 class="mb-6 text-3xl font-bold text-center">
                    🔧 Technik &amp; Aufbau: So kommt das Licht ins Haus
                </h2>
                <div class="grid gap-8 md:grid-cols-2">
                    <div
                        class="p-6 bg-white shadow-md dark:bg-gray-800 rounded-2xl"
                    >
                        <h3 class="mb-4 text-xl font-semibold">
                            📍 Schritt 1: Leitungsverlegung
                        </h3>
                        <p class="text-gray-700 dark:text-gray-300">
                            Expertenteams verlegen die Glasfaser
                            <b>grabenlos</b> via Erdrakete,
                            <a
                                href="/ratgeber/technologien"
                                class="underline text-antasus-second dark:text-antasus-primary"
                                >Micro-Trenching</a
                            >
                            oder Spülbohrung. <b>Vorteil:</b> Keine
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
                            Die Faser wird <b>dicht an Ihr Haus</b> geführt -
                            durch wasserdichte Hülle, Leerrohre und moderne
                            <a
                                href="/ratgeber/ont-router"
                                class="underline text-antasus-second dark:text-antasus-primary"
                                >ONT-Router</a
                            >
                            für Upgrades.
                        </p>
                    </div>
                </div>
            </section>

            <section
                :id="'kosten'"
                tabindex="-1"
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
                                <span class="text-blue-600 dark:text-blue-400"
                                    >800-3.500&nbsp;€</span
                                >
                            </p>
                            <p class="flex justify-between">
                                <span class="font-medium">Förderung</span>
                                <span class="text-green-600 dark:text-green-400"
                                    >50-90&nbsp;%</span
                                >
                            </p>
                            <p class="flex justify-between">
                                <span class="font-medium">Ersparte Kosten</span>
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
                            <b>Wichtig:</b> Beantragen Sie die Förderung
                            <b>vor</b> der Installation!<br />
                            Siehe
                            <a
                                href="https://www.bmv.de/SharedDocs/DE/Pressemitteilungen/2025/004-wissing-gigabitfoerderung-glasfaserausbau.html?editorSupport=true%3FresourceId%3D14470%3FresourceId%3D14470"
                                target="_blank"
                                rel="noopener"
                                class="underline text-antasus-second dark:text-antasus-primary"
                                >Förderprogramme</a
                            >
                            und
                            <a
                                href="https://www.bafa.de/"
                                target="_blank"
                                rel="noopener"
                                class="text-blue-700 underline"
                                >BAFA</a
                            >.
                            <ul class="mt-2 space-y-2 list-disc list-inside">
                                <li>Bundesförderung (BAFA)</li>
                                <li>Landesprogramme</li>
                                <li>Kommunale Zuschüsse</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>

            <section :id="'ablauf'" tabindex="-1">
                <h2 class="mb-6 text-3xl font-bold text-center">
                    🔧 Ihr FTTH-Ablauf
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

            <section
                :id="'vorteile'"
                tabindex="-1"
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
                                <span>Latenzarmes Online-Meeting</span>
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Sticky-CTA (Bottom bar on mobile/desktop) -->
            <section :id="'cta'" tabindex="-1" class="sticky-cta">
                <div class="w-full max-w-3xl px-4 mx-auto">
                    <button
                        @click="openBooking"
                        class="w-full px-8 py-4 my-8 text-xl font-semibold text-white transition rounded-lg shadow-xl md:w-auto bg-gradient-to-r from-teal-600 to-black hover:opacity-90"
                        aria-label="Jetzt FTTH-Anschluss sichern"
                    >
                        Jetzt FTTH-Anschluss sichern
                    </button>
                </div>
            </section>

            <!-- Weitere Ratgeber & Entity-Verlinkung -->
            <section class="pt-8 mt-16 border-t">
                <h3 class="mb-4 text-xl font-semibold">
                    Weitere Ratgeber &amp; Glossar
                </h3>
                <ul class="space-y-2">
                    <li>
                        <Link
                            href="/ratgeber/glasfaser"
                            class="text-antasus-primary hover:underline"
                            aria-label="Was ist Glasfaser?"
                            >Was ist Glasfaser?</Link
                        >
                    </li>
                    <li>
                        <Link
                            href="/ratgeber/technologien"
                            class="text-antasus-primary hover:underline"
                            aria-label="Technologien im Glasfaserbau"
                            >Technologien im Glasfaserbau</Link
                        >
                    </li>
                    <li>
                        <Link
                            href="/ratgeber/foerderung"
                            class="text-antasus-primary hover:underline"
                            aria-label="Förderprogramme für Glasfaser"
                            >Förderprogramme für Glasfaser</Link
                        >
                    </li>
                    <li>
                        <Link
                            href="/ratgeber/dsl-vs-glasfaser"
                            class="text-antasus-primary hover:underline"
                            aria-label="DSL vs. Glasfaser Vergleich"
                            >DSL vs. Glasfaser: Speed, Stabilität &amp;
                            Kosten</Link
                        >
                    </li>
                    <li>
                        <Link
                            href="/glasfaserbau"
                            class="text-antasus-primary hover:underline"
                            aria-label="Glasfaserbau: Tiefbau & Infrastruktur"
                            >Glasfaserbau: Tiefbau &amp; Infrastruktur</Link
                        >
                    </li>
                </ul>
            </section>
        </article>

        <!-- FAQ Section -->
        <section
            :id="'faq'"
            tabindex="-1"
            class="py-16 mb-10 border-t border-gray-100 bg-gray-50 dark:bg-antasus-dark-neutral"
        >
            <div class="max-w-4xl px-4 mx-auto">
                <h2
                    class="mb-10 text-3xl font-extrabold text-center text-gray-900 dark:text-white"
                >
                    Häufige Fragen zu FTTH (FAQ)
                </h2>
                <div class="space-y-4">
                    <details
                        v-for="(item, index) in faqItems"
                        :key="index"
                        class="p-4 bg-white border rounded-lg group dark:bg-gray-800"
                    >
                        <summary
                            class="text-lg font-semibold text-gray-800 cursor-pointer focus:outline-none focus-visible:ring-2 focus-visible:ring-antasus-primary dark:text-white"
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
        <!-- Buchungsmodal (SEO-konform, SGE Events) -->
        <BookingModal
            v-if="showBookingModal"
            :open="true"
            @close="showBookingModal = false"
            @typeSelected="handleMeetingType"
        />
    </GuestLayout>
</template>

<script setup>
import { ref, onMounted } from "vue";
import { Head, Link, router } from "@inertiajs/vue3";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import BookingModal from "@/Components/BookingModal.vue";
import { format } from "date-fns";
import { de } from "date-fns/locale";

// Analytics-Event für Conversion-Button & SGE/AI
function openBooking() {
    if (window.gtag) {
        window.gtag("event", "click", {
            event_category: "CTA",
            event_label: "Jetzt FTTH-Anschluss sichern",
            value: 1,
        });
    }
    showBookingModal.value = true;
}

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
        a: "Bund und Länder erstatten meist 50-90 % der Installationskosten. Weitere Details finden Sie im <a href='/ratgeber/foerderung' class='underline text-antasus-primary'>Förder-Ratgeber</a>.",
    },
    {
        q: "Wie lange dauert die FTTH-Installation?",
        a: "Typisch 1-3 Werktage, je nach örtlichen Gegebenheiten und Vorleistungen.",
    },
    {
        q: "Brauche ich spezielle Hardware?",
        a: "Sie benötigen ein <a href='/ratgeber/ont-router' class='underline text-antasus-primary'>ONT-Modem</a> und einen glasfaserfähigen Router, z. B. eine aktuelle FRITZ!Box.",
    },
];

onMounted(() => {
    // JSON-LD für SGE: Deep Entities, Sitelinks, FAQ, TOC, About, AI-Summary
    const jsonLd = {
        "@context": "https://schema.org",
        "@graph": [
            {
                "@type": "WebPage",
                name: "FTTH Glasfaser bis ins Haus: Technik, Kosten & Förderung - Antasus",
                url: "https://www.antasus.de/ratgeber/ftth-fiber-to-the-home",
                description:
                    "Alles zu FTTH: Aufbau, Kosten, Förderprogramme und Praxistipps für Glasfaser bis ins Gebäude.",
                breadcrumb: {
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
                about: [
                    {
                        "@type": "Thing",
                        name: "FTTH",
                        url: "https://www.antasus.de/ratgeber/ftth-fiber-to-the-home",
                    },
                    {
                        "@type": "Thing",
                        name: "Glasfaser",
                        url: "https://www.antasus.de/ratgeber/glasfaser",
                    },
                    {
                        "@type": "Thing",
                        name: "Förderung",
                        url: "https://www.antasus.de/ratgeber/foerderung",
                    },
                    {
                        "@type": "Thing",
                        name: "Technologien",
                        url: "https://www.antasus.de/ratgeber/technologien",
                    },
                ],
                hasPart: [
                    {
                        "@type": "WebPageElement",
                        name: "Was ist FTTH?",
                        url: "#was-ist-ftth",
                    },
                    {
                        "@type": "WebPageElement",
                        name: "Technik & Aufbau",
                        url: "#aufbau",
                    },
                    {
                        "@type": "WebPageElement",
                        name: "Kosten & Förderung",
                        url: "#kosten",
                    },
                    {
                        "@type": "WebPageElement",
                        name: "Ablauf",
                        url: "#ablauf",
                    },
                    {
                        "@type": "WebPageElement",
                        name: "Vorteile",
                        url: "#vorteile",
                    },
                    { "@type": "WebPageElement", name: "FAQ", url: "#faq" },
                ],
                mainEntity: {
                    "@type": "FAQPage",
                    mainEntity: faqItems.map(({ q, a }) => ({
                        "@type": "Question",
                        name: q,
                        acceptedAnswer: {
                            "@type": "Answer",
                            text: a.replace(/<[^>]+>/g, ""),
                        },
                    })),
                },
                aiSummary:
                    "FTTH (Fiber to the Home) ist die Zukunft für schnelles Internet – direkt ins Gebäude. Hier erfahren Sie alles über Technik, Ablauf, Kosten, Förderung und den Unterschied zu DSL.",
            },
            {
                "@type": "SiteNavigationElement",
                name: "Sitelinks",
                url: "https://www.antasus.de/ratgeber",
                hasPart: [
                    {
                        "@type": "WebPage",
                        name: "Was ist Glasfaser?",
                        url: "https://www.antasus.de/ratgeber/glasfaser",
                    },
                    {
                        "@type": "WebPage",
                        name: "FTTH",
                        url: "https://www.antasus.de/ratgeber/ftth-fiber-to-the-home",
                    },
                    {
                        "@type": "WebPage",
                        name: "Förderprogramme",
                        url: "https://www.antasus.de/ratgeber/foerderung",
                    },
                    {
                        "@type": "WebPage",
                        name: "Technologien",
                        url: "https://www.antasus.de/ratgeber/technologien",
                    },
                    {
                        "@type": "WebPage",
                        name: "DSL vs. Glasfaser",
                        url: "https://www.antasus.de/ratgeber/dsl-vs-glasfaser",
                    },
                ],
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
.sticky-cta {
    position: sticky;
    bottom: 0;
    z-index: 30;
    background: transparent;
    pointer-events: none;
}
.sticky-cta > div {
    pointer-events: auto;
}
@media (max-width: 768px) {
    .sticky-cta {
        padding-bottom: env(safe-area-inset-bottom, 16px);
    }
}
</style>
