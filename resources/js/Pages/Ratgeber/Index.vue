<template>
    <Head>
        <!-- SEO & Meta -->
        <title>Ratgeber &amp; Wissen - Antasus Infra</title>
        <meta
            name="description"
            content="Ihr Wissenspool zu Glasfaser Technologien: Grundlagen, Vergleiche, FTTH & Co. Jetzt im Antasus-Ratgeber lesen."
        />
        <meta name="robots" content="index,follow" />
        <link rel="canonical" href="https://www.antasus.de/ratgeber" />

        <!-- Open Graph -->
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

        <!-- Twitter Card -->
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
            aria-label="Brotkrumenpfad"
            class="container px-4 py-4 mx-auto text-sm text-gray-600 dark:text-gray-400"
        >
            <ol class="flex flex-wrap items-center gap-x-2 gap-y-1" role="list">
                <li>
                    <Link
                        href="/"
                        class="transition-colors rounded-sm hover:text-antasus-primary focus:outline-none focus:ring-2 focus:ring-antasus-primary"
                        >Startseite</Link
                    >
                </li>
                <li aria-hidden="true">/</li>
                <li
                    aria-current="page"
                    class="font-semibold text-gray-800 dark:text-gray-200"
                >
                    Ratgeber
                </li>
            </ol>
        </nav>

        <main
            class="container min-h-screen px-4 py-8 mx-auto transition-colors bg-antasus-neutral/30 dark:bg-antasus-dark text-antasus-text"
        >
            <header class="max-w-3xl mx-auto mb-12 text-center">
                <h1
                    class="text-3xl font-extrabold tracking-tight text-black md:text-4xl dark:text-white drop-shadow"
                >
                    Ratgeber &amp; Wissen
                </h1>
                <p class="mt-2 text-lg text-gray-700 dark:text-gray-300">
                    Ihr unabhängiger Wissenspool zu Glasfaser-Technologien,
                    DSL-Vergleichen, FTTH-Hausanschlüssen und mehr.
                </p>
            </header>

            <section aria-labelledby="articles-heading" class="mb-16">
                <h2 id="articles-heading" class="sr-only">Artikelübersicht</h2>
                <ul
                    role="list"
                    class="grid gap-8 sm:grid-cols-2 xl:grid-cols-3"
                >
                    <li v-for="item in articles" :key="item.slug">
                        <article
                            class="flex flex-col h-full transition rounded-2xl shadow-lg bg-white/90 dark:bg-gray-900/90 border border-gray-100 dark:border-gray-800 focus-within:ring-2 focus-within:ring-antasus-primary hover:scale-[1.015] hover:shadow-xl"
                            tabindex="0"
                            aria-labelledby="article-title"
                        >
                            <div class="flex-grow p-6">
                                <h3
                                    class="mb-2 text-xl font-semibold leading-tight dark:text-white"
                                    :id="`article-title-${item.slug}`"
                                >
                                    <Link
                                        :href="item.url"
                                        class="rounded focus:outline-none focus:ring-2 focus:ring-antasus-primary"
                                        :aria-label="`Zum Artikel: ${item.title}`"
                                    >
                                        {{ item.title }}
                                    </Link>
                                </h3>
                                <p class="text-gray-700 dark:text-gray-300">
                                    {{ item.excerpt }}
                                </p>
                            </div>
                            <div class="p-6 pt-0">
                                <Link
                                    :href="item.url"
                                    class="inline-block font-medium text-teal-800 hover:text-antasus-primary focus:outline-none focus:ring-2 focus:ring-antasus-primary"
                                    :aria-label="`Weiterlesen: ${item.title}`"
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
                <AiWidget />
            </section>
        </main>
    </GuestLayout>
</template>

<script setup>
import { ref, nextTick } from "vue";
import { Head, Link } from "@inertiajs/vue3";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import { useHead } from "@vueuse/head";
import AiWidget from "@/Components/AiWidget.vue";

// Artikel-Liste (kann später aus dem Backend kommen)
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

// JSON-LD für SEO
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

// SEO-Schema in den <head> injizieren
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
    ],
});
</script>

<style scoped>
/* Primary focus ring */
.focus-within\:ring-2:focus-within {
    --tw-ring-color: theme("colors.antasus-primary");
}

/* Ensure single-column on small screens */
@media (max-width: 640px) {
    ul[role="list"] {
        grid-template-columns: 1fr;
    }
}
@media (max-width: 640px) {
    #ai-assistant input {
        font-size: 1rem;
    }
    #ai-assistant form {
        flex-direction: column;
        gap: 0.75rem;
    }
    #ai-assistant button {
        width: 100%;
    }
}

.bg-antasus-primary {
    background: #00fdcf !important;
}
.text-antasus-primary {
    color: #00fdcf !important;
}

.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.4s;
}
.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
</style>
