<template>
    <GuestLayout :serviceArea="'referenz'">
        <template #header>
            <section class="w-full px-4 text-center animate-fade-in">
                <div class="max-w-4xl mx-auto">
                    <h1
                        class="mb-6 text-4xl font-extrabold text-white md:text-5xl drop-shadow-xl"
                    >
                        Unsere Referenzen
                    </h1>
                    <p class="text-lg md:text-xl text-white/90 drop-shadow-md">
                        Erfolgreiche Projekte im Glasfaserausbau –
                        partnerschaftlich & termintreu.
                    </p>
                </div>
            </section>
        </template>

        <section class="py-20 bg-white">
            <div class="max-w-6xl px-4 mx-auto space-y-20">
                <div
                    v-for="(referenz, index) in referenzen"
                    :key="index"
                    class="grid items-center gap-10 p-4 text-white transition-all rounded-lg bg-gradient-to-r from-teal-600 to-black md:grid-cols-2"
                >
                    <div :class="index % 2 === 1 ? 'md:order-2' : ''">
                        <h2 class="mb-4 text-2xl font-bold text-white">
                            {{ referenz.titel }}
                        </h2>
                        <p class="text-lg leading-relaxed text-white">
                            {{ referenz.beschreibung }}
                        </p>
                        <p class="mt-4 text-sm italic text-white">
                            Ort: {{ referenz.ort }}
                        </p>
                    </div>
                    <div
                        class="overflow-hidden transition transform shadow-lg rounded-xl hover:scale-105"
                    >
                        <img
                            :src="referenz.image"
                            :alt="referenz.titel"
                            class="object-cover w-full h-64"
                            loading="lazy"
                        />
                    </div>
                </div>
            </div>
        </section>
    </GuestLayout>
</template>

<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";

const referenzen = [
    {
        titel: "FTTH-Ausbau Amsterdam",
        beschreibung:
            "Komplette Umsetzung von Tiefbau, Hausanschlüssen und Dokumentation.",
        image: "/images/Amsterdam.jpeg",
        ort: "Amsterdam",
    },
    {
        titel: "Glasfasererschließung für Gewerbegebiet Amsterdam",
        beschreibung:
            "Planung und Bau für mehrere Gewerbeeinheiten nach VDE-Vorgaben.",
        image: "/images/Amsterdam2.jpeg",
        ort: "Amsterdam",
    },
    {
        titel: "Netzmodernisierung Den Haag / Zoetermeer",
        beschreibung: "Bohrung und Innenmontage für über 2300 Haushalte.",
        image: "/images/Denhaag.jpeg",
        ort: "Den Haag / Zoetermeer",
    },
    {
        titel: "Großprojekt Rheinland",
        beschreibung:
            "Technische Projektleitung im Auftrag eines Generalunternehmens.",
        image: "/images/Rheinland.jpeg",
        ort: "Rheinland",
    },
];
</script>

<style scoped></style>
