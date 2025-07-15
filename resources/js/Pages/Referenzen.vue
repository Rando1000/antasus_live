<template>
    <Head>
        <title>
            Glasfaser-Referenzen | Erfolgreiche Tiefbau-Projekte mit ANTASUS
            Infra
        </title>
        <meta
            name="description"
            content="Erleben Sie ausgewählte Projekte aus dem Bereich Glasfaser-Tiefbau, Hausanschlüsse und Projektkoordination – umgesetzt von ANTASUS Infra, Ihrem zuverlässigen Subunternehmer."
        />
        <meta
            name="keywords"
            content="Glasfaser Referenzen, Tiefbau Projekte, Glasfaserausbau Beispiele, Hausanschluss, Subunternehmer, ANTASUS Infra"
        />

        <!-- OpenGraph -->
        <meta
            property="og:title"
            content="Erfolgreiche Projekte im Glasfaser-Tiefbau - ANTASUS Infra"
        />
        <meta
            property="og:description"
            content="Einblick in realisierte Bauprojekte: Hausanschlüsse, Netzmodernisierung, Gewerbeerschließung."
        />
        <meta
            property="og:image"
            content="https://www.antasus.de/images/og-referenzen.webp"
        />
        <meta property="og:url" content="https://www.antasus.de/referenzen" />
        <meta property="og:type" content="website" />
    </Head>

    <!-- JSON-LD Script außerhalb des Templates -->
    <div v-if="false"></div>
    <!-- Platzhalter, damit Vue nicht meckert -->

    <GuestLayout :serviceArea="'referenz'">
        <template #header>
            <section>
                <div class="max-w-4xl px-4 mx-auto text-center">
                    <h1
                        class="mb-4 text-4xl font-extrabold md:text-8xl dark:text-white drop-shadow-xl"
                    >
                        Unsere Referenzen
                    </h1>
                    <p class="max-w-2xl mx-auto dark:text-gray-200">
                        Ausgewählte Projekte aus dem Bereich Glasfaser-Tiefbau &
                        Infrastruktur
                    </p>
                </div>
            </section>
        </template>
        <section class="bg-white dark:bg-slate-900">
            <div class="max-w-6xl px-4 mx-auto mt-16 space-y-16">
                <Link
                    v-for="(ref, index) in referenzen"
                    :key="ref.slug"
                    :href="route('referenzen.show', ref.slug)"
                    class="block transition-transform group"
                    :aria-label="`Mehr zu ${ref.titel}`"
                >
                    <ReferenzCard :referenz="ref" :reversed="index % 2 !== 0" />
                </Link>
            </div>
        </section>
    </GuestLayout>
</template>

<script setup>
import { onMounted } from "vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import ReferenzCard from "@/Components/ReferenzCard.vue";
import { Head, Link } from "@inertiajs/vue3";

const props = defineProps({
    referenzen: {
        type: Array,
        required: true,
    },
});

// JSON-LD Schema dynamisch für alle Referenzen generieren
const jsonLd = JSON.stringify(
    {
        "@context": "https://schema.org",
        "@type": "ItemList",
        name: "Referenzen | ANTASUS Infra",
        description:
            "Ausgewählte Projekte im Glasfaser-Tiefbau, Hausanschlüsse, Infrastruktur",
        itemListElement: props.referenzen.map((ref, i) => ({
            "@type": "ListItem",
            position: i + 1,
            url: `https://www.antasus.de/referenzen/${ref.slug}`,
            name: ref.titel,
            description: ref.beschreibung,
            image: ref.bilder?.[0] || null,
        })),
    },
    null,
    2
);

// Füge das strukturierte JSON-LD bei Mount direkt in den Head ein (Best Practice für Vue/Vite/SPA)
onMounted(() => {
    // Prüfe, ob schon ein altes JSON-LD existiert
    let oldScript = document.getElementById("antasus-jsonld-referenzen");
    if (oldScript) oldScript.remove();
    const script = document.createElement("script");
    script.type = "application/ld+json";
    script.id = "antasus-jsonld-referenzen";
    script.innerHTML = jsonLd;
    document.head.appendChild(script);
});
</script>

<style scoped>
section.bg-white {
    padding-top: 2rem;
    padding-bottom: 4rem;
}
@media (max-width: 640px) {
    section.bg-white {
        padding-top: 1rem;
        padding-bottom: 2rem;
    }
}
</style>
