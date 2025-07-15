<template>
    <Head>
        <title>Ratgeber &amp; Wissen - Antasus Infra</title>
        <meta
            name="description"
            content="Ihr Wissenspool zu Glasfaser-Technologien: Grundlagen, Vergleiche, FTTH & Co. Jetzt im Antasus-Ratgeber lesen."
        />
        <meta name="robots" content="index,follow" />
        <link rel="canonical" href="https://www.antasus.de/ratgeber" />
        <!-- OG + Twitter -->
        <meta property="og:type" content="website" />
        <meta property="og:locale" content="de_DE" />
        <meta property="og:url" content="https://www.antasus.de/ratgeber" />
        <meta
            property="og:title"
            content="Ratgeber &amp; Wissen - Antasus Infra"
        />
        <meta
            property="og:description"
            content="Fundiertes Know-How zu Glasfaser-Technologien, DSL-Vergleichen & Anwendungstipps."
        />
        <meta name="twitter:card" content="summary_large_image" />
        <meta
            name="twitter:title"
            content="Ratgeber &amp; Wissen - Antasus Infra"
        />
        <meta
            name="twitter:description"
            content="Fundiertes Know-How zu Glasfaser-Technologien, DSL-Vergleichen & Anwendungstipps."
        />
    </Head>

    <GuestLayout serviceArea="ratgeber">
        <!-- Breadcrumbs -->
        <nav
            aria-label="Breadcrumb"
            class="container px-4 py-4 mx-auto text-sm text-antasus-dark dark:text-antasus-neutral"
        >
            <ol
                class="flex flex-wrap items-center gap-x-2 gap-y-1"
                role="list"
                itemscope
                itemtype="https://schema.org/BreadcrumbList"
            >
                <li
                    itemprop="itemListElement"
                    itemscope
                    itemtype="https://schema.org/ListItem"
                >
                    <Link
                        href="/"
                        class="transition-colors rounded-sm hover:text-antasus-primary focus:outline-none focus-visible:ring-2 focus-visible:ring-antasus-primary"
                        itemprop="item"
                    >
                        <span itemprop="name">Startseite</span>
                    </Link>
                    <meta itemprop="position" content="1" />
                </li>
                <li aria-hidden="true">/</li>
                <li
                    aria-current="page"
                    class="font-semibold text-antasus-black dark:text-antasus-neutral"
                    itemprop="itemListElement"
                    itemscope
                    itemtype="https://schema.org/ListItem"
                >
                    <span itemprop="name">Ratgeber</span>
                    <meta itemprop="position" content="2" />
                </li>
            </ol>
        </nav>

        <main
            class="container min-h-screen px-4 py-8 mx-auto transition-colors bg-antasus-neutral/30 dark:bg-antasus-dark text-antasus-black dark:text-antasus-neutral"
        >
            <header class="max-w-3xl mx-auto mb-12 text-center">
                <h1
                    class="text-3xl font-extrabold tracking-tight md:text-4xl drop-shadow text-antasus-black dark:text-white"
                >
                    Ratgeber &amp; Wissen
                </h1>
                <p
                    class="mt-2 text-lg text-antasus-dark/90 dark:text-antasus-neutral/80"
                >
                    Ihr unabhängiger Wissenspool zu Glasfaser-Technologien,
                    DSL-Vergleichen, FTTH-Hausanschlüssen und mehr.
                </p>
            </header>

            <!-- Sticky CTA -->
            <!-- <div
                v-show="showStickyCTA"
                class="fixed z-40 flex items-center justify-between w-full max-w-xl px-6 py-4 -translate-x-1/2 border shadow-lg bottom-4 left-1/2 rounded-2xl bg-gradient-to-r from-antasus-primary to-antasus-indigo border-antasus-neutral dark:border-antasus-dark-border animate-fade-in"
                role="region"
                aria-label="Glasfaser-Beratung jetzt sichern"
            >
                <span
                    class="text-lg font-semibold text-black dark:text-antasus-neutral"
                    >Jetzt Glasfaser-Beratung sichern!</span
                >
                <button
                    @click="stickyCTAClick"
                    class="px-6 py-2 ml-6 font-semibold text-white transition bg-black rounded-lg hover:bg-gray-900 focus:outline-none focus-visible:ring-2 focus-visible:ring-antasus-primary"
                    aria-label="Glasfaser-Beratung anfragen"
                >
                    Kontakt aufnehmen
                </button>
                <button
                    @click="showStickyCTA = false"
                    aria-label="Schließen"
                    class="absolute p-1 rounded-full top-2 right-2 hover:bg-black/10 dark:hover:bg-white/10"
                >
                    <span aria-hidden="true">&times;</span>
                </button>
            </div> -->

            <!-- Artikelübersicht -->
            <section aria-labelledby="articles-heading" class="mb-16">
                <h2 id="articles-heading" class="sr-only">Artikelübersicht</h2>
                <ul
                    role="list"
                    class="grid gap-8 sm:grid-cols-2 xl:grid-cols-3"
                >
                    <li v-for="item in articles" :key="item.slug">
                        <article
                            class="flex flex-col h-full transition rounded-2xl shadow-lg bg-white/95 dark:bg-antasus-dark-card border border-antasus-neutral dark:border-antasus-dark-border focus-within:ring-2 focus-within:ring-antasus-primary hover:scale-[1.015] hover:shadow-xl"
                            tabindex="0"
                            :aria-labelledby="`article-title-${item.slug}`"
                            @click="trackArticleClick(item)"
                        >
                            <div class="flex-grow p-6">
                                <h3
                                    class="mb-2 text-xl font-semibold leading-tight text-antasus-black dark:text-white"
                                    :id="`article-title-${item.slug}`"
                                >
                                    <Link
                                        :href="item.url"
                                        class="rounded focus:outline-none focus-visible:ring-2 focus-visible:ring-antasus-primary"
                                        :aria-label="`Zum Artikel: ${item.title}`"
                                        @click.stop="trackArticleClick(item)"
                                    >
                                        {{ item.title }}
                                    </Link>
                                </h3>
                                <p
                                    class="text-antasus-dark dark:text-antasus-neutral/90"
                                >
                                    {{ item.excerpt }}
                                </p>
                            </div>
                            <div class="p-6 pt-0">
                                <Link
                                    :href="item.url"
                                    class="inline-block font-medium text-antasus-indigo hover:text-antasus-primary focus:outline-none focus-visible:ring-2 focus-visible:ring-antasus-primary"
                                    :aria-label="`Weiterlesen: ${item.title}`"
                                    @click.stop="trackArticleClick(item)"
                                >
                                    Weiterlesen →
                                </Link>
                            </div>
                        </article>
                    </li>
                </ul>
            </section>

            <!-- AI-Widget für Ratgeber-Fragen -->
            <section aria-label="Antasus KI-Ratgeber" class="mb-10">
                <AiWidget @interaction="trackAiWidget" />
            </section>
            <!-- SEO-FAQ -->
            <section
                class="py-12 bg-white/70 dark:bg-antasus-dark-card rounded-2xl mb-14"
                aria-labelledby="faq-head"
            >
                <div class="max-w-4xl px-4 mx-auto">
                    <h2
                        id="faq-head"
                        class="mb-8 text-3xl font-bold text-center text-antasus-black dark:text-antasus-neutral"
                    >
                        Häufige Fragen zu Glasfaser & Ausbau
                    </h2>
                    <ul class="space-y-4">
                        <li v-for="(faq, i) in faqItems" :key="i">
                            <details
                                class="p-4 border rounded-xl group bg-antasus-neutral/80 dark:bg-antasus-dark-neutral border-antasus-neutral dark:border-antasus-dark-border"
                            >
                                <summary
                                    class="text-lg font-semibold rounded cursor-pointer text-antasus-black dark:text-antasus-neutral focus:outline-none focus-visible:ring-2 focus-visible:ring-antasus-primary"
                                >
                                    {{ faq.q }}
                                </summary>
                                <div
                                    class="mt-2 leading-relaxed text-antasus-dark/80 dark:text-antasus-neutral"
                                >
                                    {{ faq.a }}
                                </div>
                            </details>
                        </li>
                    </ul>
                </div>
            </section>
        </main>
    </GuestLayout>
</template>

<script setup>
import { ref, onMounted } from "vue";
import { Head, Link, router } from "@inertiajs/vue3";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import AiWidget from "@/Components/AiWidget.vue";
import { useHead } from "@vueuse/head";

// Sticky CTA
const showStickyCTA = ref(true);
function stickyCTAClick() {
    trackStickyCTA();
    router.visit("/kontakt");
}

// Google Analytics Events
function trackArticleClick(article) {
    if (window.gtag) {
        window.gtag("event", "click", {
            event_category: "Ratgeber Artikel",
            event_label: article.title,
            value: article.slug,
        });
    }
}
function trackStickyCTA() {
    if (window.gtag) {
        window.gtag("event", "click", {
            event_category: "CTA",
            event_label: "Sticky Glasfaser-Beratung",
        });
    }
}
function trackAiWidget(payload) {
    if (window.gtag) {
        window.gtag("event", "ai_widget_interaction", {
            event_category: "AI Widget",
            event_label: JSON.stringify(payload),
        });
    }
}

// Artikel-Liste
const articles = [
    {
        slug: "glasfaser",
        title: "Was ist Glasfaser? Technik, Vorteile & Varianten",
        excerpt:
            "Erfahren Sie, was Glasfaser ist, wie es funktioniert, die Unterschiede zu DSL und Varianten wie FTTH/FTTB/FTTC/FTTN.",
        url: "/ratgeber/glasfaser",
    },
    {
        slug: "dsl-vs-glasfaser",
        title: "DSL vs. Glasfaser: Speed, Stabilität & Kosten",
        excerpt:
            "Vergleich von DSL und Glasfaser in Bandbreite, Latenz, Kosten und Energieeffizienz. Welche Technik passt?",
        url: "/ratgeber/dsl-vs-glasfaser",
    },
    {
        slug: "ftth-fiber-to-the-home",
        title: "FTTH - Glasfaser bis ins Haus: Technik & Förderung",
        excerpt:
            "Alles zu FTTH: Aufbau, Kosten, Förderprogramme und Praxistipps für Glasfaser bis ins Gebäude.",
        url: "/ratgeber/ftth-fiber-to-the-home",
    },
    {
        slug: "ftth-hausanschluss",
        title: "FTTH - Hausanschluss Der ultimative Leitfaden",
        excerpt:
            "Alles zu FTTH: Die Kurzanleitung zu Aufbau, Kosten, Förderprogramme. Der digitale Superhighway",
        url: "/ratgeber/how-to-get-ftth",
    },
    {
        slug: "glasfaserbau",
        title: "Glasfaserbau: Tiefbau, Hausanschluss & Infrastruktur",
        excerpt:
            "Einblick in den Glasfaser-Tiefbau: Trassen, Hausanschlüsse und Koordination großer Projekte.",
        url: "/glasfaserbau",
    },
    {
        slug: "technologien",
        title: "Technologien im Glasfaserbau: Standards & Methoden",
        excerpt:
            "Übersicht der wichtigsten Normen, Werkzeuge und Technologien im modernen Glasfaserbau.",
        url: "/ratgeber/technologien",
    },
];

// FAQ für SEO
const faqItems = [
    {
        q: "Warum ist Glasfaser die beste Wahl für Internet?",
        a: "Glasfaser ermöglicht höhere Bandbreiten, geringere Latenz und bessere Stabilität als Kupferleitungen. Sie ist zukunftssicher, energieeffizient und steigert häufig den Immobilienwert.",
    },
    {
        q: "Wie schnell kann Glasfaser tatsächlich sein?",
        a: "Mit Glasfaser sind heute bis zu 1 Gbit/s für Privatkunden möglich – in Firmen sogar deutlich mehr. Im Gegensatz zu DSL gibt es keine Dämpfung auf langen Strecken.",
    },
    {
        q: "Was ist der Unterschied zwischen FTTH, FTTB, FTTC und FTTN?",
        a: "FTTH: Glasfaser bis ins Haus. FTTB: bis ins Gebäude. FTTC: bis zum Straßenverteiler. FTTN: nur bis zum Knotenpunkt. Je näher die Glasfaser am Nutzer, desto schneller die Verbindung.",
    },
    {
        q: "Wer kann einen Glasfaseranschluss buchen?",
        a: "Grundsätzlich jeder Eigentümer oder Mieter, wenn Glasfaser im Ausbaugebiet verfügbar ist. Bei Firmen lohnt sich eine Beratung zu Sonderlösungen.",
    },
    {
        q: "Welche Vorteile bringt eine persönliche Beratung?",
        a: "Eine Glasfaser-Beratung klärt individuelle Möglichkeiten, Kosten und fördert einen reibungslosen Ausbau. Sie hilft, die optimale Lösung für Haus, Gewerbe oder Wohnanlage zu finden.",
    },
];

// Strukturierte Daten: Breadcrumb, ItemList, WebPage, FAQPage
const breadcrumbList = {
    "@context": "https://schema.org",
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
    ],
};
const itemList = {
    "@context": "https://schema.org",
    "@type": "ItemList",
    name: "Ratgeber",
    itemListElement: articles.map((art, i) => ({
        "@type": "ListItem",
        position: i + 1,
        name: art.title,
        url: `https://www.antasus.de${art.url}`,
    })),
};
const webPage = {
    "@context": "https://schema.org",
    "@type": "WebPage",
    url: "https://www.antasus.de/ratgeber",
    name: "Ratgeber & Wissen - Antasus Infra",
    description:
        "Ihr Wissenspool zu Glasfaser-Technologien: Grundlagen, Vergleiche, FTTH & Co.",
};
const faqJsonLd = {
    "@context": "https://schema.org",
    "@type": "FAQPage",
    mainEntity: faqItems.map(({ q, a }) => ({
        "@type": "Question",
        name: q,
        acceptedAnswer: { "@type": "Answer", text: a },
    })),
};

useHead({
    script: [
        {
            type: "application/ld+json",
            children: JSON.stringify(breadcrumbList, null, 2),
        },
        {
            type: "application/ld+json",
            children: JSON.stringify(itemList, null, 2),
        },
        {
            type: "application/ld+json",
            children: JSON.stringify(webPage, null, 2),
        },
        {
            type: "application/ld+json",
            children: JSON.stringify(faqJsonLd, null, 2),
        },
    ],
});

// Sticky CTA einblenden nach Scroll
onMounted(() => {
    const onScroll = () => {
        showStickyCTA.value = window.scrollY > 300;
    };
    window.addEventListener("scroll", onScroll, { passive: true });
});
</script>

<style scoped>
/* Sticky CTA Animation */
@keyframes fade-in {
    from {
        opacity: 0;
        transform: translateY(40px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
.animate-fade-in {
    animation: fade-in 0.5s cubic-bezier(0.23, 1.1, 0.32, 1) both;
}
.focus-visible\:ring-2:focus-visible {
    --tw-ring-color: #00fdcf !important;
}
@media (max-width: 640px) {
    ul[role="list"] {
        grid-template-columns: 1fr !important;
    }
}
.bg-antasus-primary {
    background: #00fdcf !important;
}
.text-antasus-primary {
    color: #00fdcf !important;
}
</style>
