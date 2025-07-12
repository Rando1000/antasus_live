<template>
    <Head>
        <!-- Basic SEO -->
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
            aria-label="Breadcrumb"
            class="container px-4 py-4 mx-auto text-sm text-gray-600 dark:text-gray-400"
        >
            <ol class="inline-flex space-x-1">
                <li>
                    <Link href="/" class="hover:text-antasus-primary"
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

        <main class="container px-4 py-8 mx-auto">
            <header class="max-w-3xl mx-auto mb-12 text-center">
                <h1 class="text-3xl font-extrabold md:text-4xl dark:text-white">
                    Ratgeber &amp; Wissen
                </h1>
                <p class="mt-2 text-gray-600 dark:text-gray-400">
                    Ihr unabhängiger Wissenspool zu Glasfaser-Technologien,
                    DSL-Vergleichen, FTTH-Hausanschlüssen und mehr.
                </p>
            </header>

            <section aria-labelledby="articles-heading">
                <h2 id="articles-heading" class="sr-only">Artikelübersicht</h2>
                <ul
                    role="list"
                    class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3"
                >
                    <li v-for="item in articles" :key="item.slug">
                        <article
                            class="flex flex-col h-full transition bg-white rounded-lg shadow hover:shadow-lg dark:bg-gray-800 focus-within:ring-2 focus-within:ring-antasus-primary"
                        >
                            <div class="flex-grow p-6">
                                <h3
                                    class="mb-2 text-xl font-semibold dark:text-white"
                                >
                                    <Link
                                        :href="item.url"
                                        class="focus:outline-none focus:ring-2 focus:ring-antasus-primary"
                                        >{{ item.title }}</Link
                                    >
                                </h3>
                                <p class="text-gray-600 dark:text-gray-400">
                                    {{ item.excerpt }}
                                </p>
                            </div>
                            <div class="p-6 pt-0">
                                <Link
                                    :href="item.url"
                                    class="inline-block font-medium text-antasus-primary hover:text-antasus-dark focus:outline-none focus:ring-2 focus:ring-antasus-primary"
                                    :aria-label="`Weiterlesen: ${item.title}`"
                                    >Weiterlesen →</Link
                                >
                            </div>
                        </article>
                    </li>
                </ul>
            </section>
            <!-- ─── AI-Widget ──────────────────────────────────────── -->
            <section id="ai-assistant" class="px-2 py-8 sm:py-12 bg-gray-50">
                <div class="max-w-3xl mx-auto space-y-4">
                    <h3 class="text-2xl font-bold text-center">
                        Frage unseren Ratgeber-Bot
                    </h3>
                    <form
                        @submit.prevent="askAI"
                        class="flex flex-col gap-2 sm:flex-row"
                    >
                        <input
                            v-model="question"
                            type="text"
                            placeholder="Stellen Sie hier Ihre Frage…"
                            class="flex-1 px-4 py-2 text-base border rounded focus:ring-2 focus:ring-antasus-primary"
                            autocomplete="off"
                        />
                        <button
                            type="submit"
                            :disabled="loading || !question.trim()"
                            class="w-full px-4 py-2 font-semibold text-white transition bg-teal-600 rounded sm:w-auto hover:bg-teal-700 disabled:opacity-50"
                        >
                            {{ loading ? "…arbeite" : "Fragen" }}
                        </button>
                    </form>
                    <div
                        v-if="answer"
                        class="p-4 mt-2 prose break-words bg-white rounded shadow dark:prose-invert"
                    >
                        <h4 class="font-semibold">Antwort:</h4>
                        <div v-html="answer"></div>
                    </div>
                </div>
            </section>
            <!-- ──────────────────────────────────────────────────── -->
        </main>
    </GuestLayout>
</template>

<script setup>
import { ref } from "vue";
import { Head, Link } from "@inertiajs/vue3";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import { useHead } from "@vueuse/head";
import axios from "axios";

const question = ref("");
const answer = ref("");
const loading = ref(false);

async function askAI() {
    if (!question.value.trim()) return;
    loading.value = true;
    answer.value = null;

    try {
        // // bei Sanctum-Projekten nötig
        // await axios.get("/sanctum/csrf-cookie");
        const { data } = await axios.post(
            "/api/ai/answer",
            { question: question.value },
            { headers: { "Content-Type": "application/json" } }
        );
        answer.value = data.answer;
    } catch (err) {
        console.error("HF-Error:", err.response?.data || err);
    } finally {
        loading.value = false;
    }
}
// --- ARTICLE LIST ---
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
        slug: "ftth-fiber-to-the-home",
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

// --- JSON-LD DATA ---
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

// inject JSON-LD mit useHead anstatt  mit onmount in den <head>
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

// onMounted(() => {
//     // inject BreadcrumbList
//     const s1 = document.createElement("script");
//     s1.type = "application/ld+json";
//     s1.text = JSON.stringify(breadcrumbList, null, 2);
//     document.head.appendChild(s1);

//     // inject ItemList
//     const s2 = document.createElement("script");
//     s2.type = "application/ld+json";
//     s2.text = JSON.stringify(itemList, null, 2);
//     document.head.appendChild(s2);

//     // inject WebPage
//     const s3 = document.createElement("script");
//     s3.type = "application/ld+json";
//     s3.text = JSON.stringify(webPage, null, 2);
//     document.head.appendChild(s3);
// });
</script>

<style scoped>
/* Primary focus ring */
.focus-within\:ring-2:focus-within {
    --tw-ring-color: theme("colors.antasus.primary");
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
</style>
