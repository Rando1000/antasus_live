<template>
    <Head>
        <title>
            Glasfaser-Referenzen | Erfolgreiche Tiefbau-Projekte mit ANTASUS
            Infra
        </title>
        <meta
            name="description"
            content="Erleben Sie ausgewählte Projekte aus dem Bereich Glasfaser-Tiefbau, Hausanschlüsse und Projektkoordination - umgesetzt von ANTASUS Infra, Ihrem zuverlässigen Subunternehmer."
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

    <GuestLayout :serviceArea="'referenz'">
        <template #header>
            <section>
                <div class="max-w-4xl px-4 mx-auto text-center">
                    <h1 class="mb-4 text-4xl font-extrabold">
                        Unsere Referenzen
                    </h1>
                    <p class="max-w-2xl mx-auto">
                        Ausgewählte Projekte aus dem Bereich Glasfaser-Tiefbau &
                        Infrastruktur
                    </p>
                </div>
            </section>
        </template>
        <section class="bg-white">
            <div class="max-w-6xl px-4 mx-auto mt-16 space-y-12">
                <Link
                    v-for="(ref, index) in referenzen"
                    :key="ref.slug"
                    :href="route('referenzen.show', ref.slug)"
                >
                    <ReferenzCard :referenz="ref" :reversed="index % 2 !== 0" />
                </Link>
            </div>
        </section>
    </GuestLayout>
</template>

<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import ReferenzCard from "@/Components/ReferenzCard.vue";
import { Head, Link } from "@inertiajs/vue3";

defineProps({
    referenzen: Array,
});

// const referenzen = [
//     {
//         titel: "FTTH-Ausbau Amsterdam",
//         slug: "ftth-ausbau-amsterdam",
//         beschreibung:
//             "Komplette Umsetzung von Tiefbau, Hausanschlüssen und Dokumentation.",
//         image: "/images/Amsterdam.jpeg",
//         ort: "Amsterdam",
//     },
//     {
//         titel: "Glasfasererschließung für Gewerbegebiet Amsterdam",
//         slug: "glasfasererschließung-für-gewerbegebiet-amsterdam",
//         beschreibung:
//             "Planung und Bau für mehrere Gewerbeeinheiten nach VDE-Vorgaben.",
//         image: "/images/Amsterdam2.jpeg",
//         ort: "Amsterdam",
//     },
//     {
//         titel: "Netzmodernisierung Den Haag / Zoetermeer",
//         slug: "netzmodernisierung-den-haag-/-zoetermeer",
//         beschreibung: "Bohrung und Innenmontage für über 2300 Haushalte.",
//         image: "/images/Denhaag.jpeg",
//         ort: "Den Haag / Zoetermeer",
//     },
//     {
//         titel: "Großprojekt Rheinland",
//         slug: "großprojekt-rheinland",
//         beschreibung:
//             "Technische Projektleitung im Auftrag eines Generalunternehmens.",
//         image: "/images/Rheinland.jpeg",
//         ort: "Rheinland",
//     },
// ];
</script>

<style scoped></style>
