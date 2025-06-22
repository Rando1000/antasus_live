<template>
    <Head>
        <title>Ratgeber &amp; Wissen – Antasus Infra</title>
        <meta
            name="description"
            content="Ihr Wissenspool zu Glasfaser-Technologien: Grundlagen, Vergleiche, FTTH & Co. Jetzt im Antasus-Ratgeber lesen."
        />
        <meta name="robots" content="index,follow" />
        <meta
            name="keywords"
            content="Glasfaser Ratgeber, DSL vs Glasfaser, FTTH, Glasfaserbau, Antasus"
        />
        <meta property="og:type" content="website" />
        <meta property="og:url" content="https://www.antasus.de/ratgeber" />
        <meta
            property="og:title"
            content="Ratgeber &amp; Wissen – Antasus Infra"
        />
        <meta
            property="og:description"
            content="Fundiertes Know-How zu Glasfaser-Technologien, DSL-Vergleichen & Anwendungstipps."
        />
    </Head>

    <GuestLayout serviceArea="ratgeber">
        <!-- Breadcrumb Navigation -->
        <nav
            aria-label="Breadcrumb"
            class="container px-4 py-4 mx-auto text-sm text-gray-600 dark:text-gray-400"
        >
            <ol class="flex space-x-2">
                <li>
                    <Link href="/" class="hover:text-antasus-primary"
                        >Startseite</Link
                    >
                </li>
                <li>/</li>
                <li
                    aria-current="page"
                    class="font-semibold text-gray-800 dark:text-gray-200"
                >
                    Ratgeber
                </li>
            </ol>
        </nav>

        <main class="container px-4 py-8 mx-auto">
            <!-- Page Header -->
            <header class="max-w-3xl mx-auto mb-12 text-center">
                <h1 class="text-3xl font-extrabold md:text-4xl dark:text-white">
                    Ratgeber &amp; Wissen
                </h1>
                <p class="mt-2 text-gray-600 dark:text-gray-400">
                    Ihr unabhängiger Wissenspool zu Glasfaser-Technologien,
                    DSL-Vergleichen, FTTH-Hausanschlüssen und mehr.
                </p>
            </header>

            <!-- Artikel-Liste -->
            <ul role="list" class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
                <li
                    v-for="(item, idx) in articles"
                    :key="item.slug"
                    role="listitem"
                >
                    <article
                        class="flex flex-col h-full transition bg-white rounded-lg shadow dark:bg-gray-800 hover:shadow-lg focus-within:ring-2 focus-within:ring-antasus-primary"
                    >
                        <div class="flex flex-col flex-grow p-6">
                            <h2
                                class="mb-2 text-xl font-semibold dark:text-white"
                            >
                                <Link
                                    :href="item.url"
                                    class="focus:outline-none focus:ring-2 focus:ring-antasus-primary"
                                >
                                    {{ item.title }}
                                </Link>
                            </h2>
                            <p
                                class="flex-grow text-gray-600 dark:text-gray-400"
                            >
                                {{ item.excerpt }}
                            </p>
                        </div>
                        <div class="p-6 pt-0">
                            <Link
                                :href="item.url"
                                class="inline-block font-medium text-antasus-primary hover:text-antasus-dark focus:outline-none focus:ring-2 focus:ring-antasus-primary"
                                :aria-label="`Weiterlesen: ${item.title}`"
                            >
                                Weiterlesen →
                            </Link>
                        </div>
                    </article>
                </li>
            </ul>
        </main>
    </GuestLayout>
</template>

<script setup>
import { onMounted } from "vue";
import { Head, Link } from "@inertiajs/vue3";
import GuestLayout from "@/Layouts/GuestLayout.vue";

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
            "Vergleich von DSL und Glasfaser in Bandbreite, Latenz, Kosten und Energieeffizienz – welche Technik passt?",
        url: "/ratgeber/dsl-vs-glasfaser",
    },
    {
        slug: "ftth-fiber-to-the-home",
        title: "FTTH – Glasfaser bis ins Haus: Technik & Förderung",
        excerpt:
            "Alles zu FTTH: Aufbau, Kosten, Förderprogramme und Praxistipps für Glasfaser bis ins Gebäude.",
        url: "/ratgeber/ftth-fiber-to-the-home",
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
        url: "/technologien",
    },
];

onMounted(() => {
    // BreadcrumbList JSON-LD
    const breadcrumb = {
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
    const s1 = document.createElement("script");
    s1.type = "application/ld+json";
    s1.text = JSON.stringify(breadcrumb, null, 2);
    document.head.appendChild(s1);

    // ItemList JSON-LD
    const itemList = {
        "@context": "https://schema.org",
        "@type": "ItemList",
        itemListElement: articles.map((art, i) => ({
            "@type": "ListItem",
            position: i + 1,
            name: art.title,
            url: `https://www.antasus.de${art.url}`,
        })),
    };
    const s2 = document.createElement("script");
    s2.type = "application/ld+json";
    s2.text = JSON.stringify(itemList, null, 2);
    document.head.appendChild(s2);
});
</script>

<style scoped>
/* Fokus-Ring mit CI/CD-Primärfarbe */
.focus-within\:ring-2:focus-within {
    --tw-ring-color: theme("colors.antasus.primary");
}

/* Responsive Anpassung (falls nötig) */
@media (max-width: 640px) {
    ul[role="list"] {
        grid-template-columns: 1fr;
    }
}
</style>
