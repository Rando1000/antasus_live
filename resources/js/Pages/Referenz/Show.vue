<template>
    <Head>
        <title>{{ referenz.titel }} | Projekt-Referenz | ANTASUS Infra</title>
        <meta name="description" :content="referenz.beschreibung" />
        <link :rel="'canonical'" :href="canonicalUrl" />
    </Head>

    <GuestLayout :serviceArea="'referenz'">
        <!-- Header -->
        <template #header>
            <section class="px-4 text-center">
                <div class="max-w-4xl mx-auto">
                    <h1
                        class="mb-4 text-4xl font-extrabold text-white md:text-5xl"
                    >
                        {{ referenz.titel }}
                    </h1>
                    <p class="text-lg text-white/90">
                        {{ referenz.ort }}
                    </p>
                </div>
            </section>
        </template>

        <!-- Inhalt -->
        <section class="py-16 bg-white">
            <div class="max-w-4xl px-4 mx-auto space-y-8">
                <div>
                    <h2 class="text-xl font-bold text-gray-800">
                        Projektbeschreibung
                    </h2>
                    <p class="mt-2 leading-relaxed text-gray-700">
                        {{ referenz.beschreibung }}
                    </p>
                </div>

                <!-- Galerie -->
                <div v-if="referenz.bilder?.length" class="pt-10">
                    <h3 class="mb-4 text-xl font-semibold text-gray-800">
                        Bildergalerie
                    </h3>
                    <div class="grid gap-6 sm:grid-cols-2 md:grid-cols-3">
                        <img
                            v-for="(img, idx) in referenz.bilder"
                            :key="idx"
                            :src="img"
                            :alt="`Bild ${idx + 1} von ${referenz.titel}`"
                            loading="lazy"
                            @click="openLightbox(idx)"
                            class="object-cover w-full h-64 transition duration-300 transform cursor-pointer rounded-xl hover:scale-105"
                        />
                    </div>
                </div>
            </div>
        </section>

        <!-- Lightbox -->
        <div
            v-if="lightbox.open"
            class="fixed inset-0 z-50 flex items-center justify-center bg-black/80 backdrop-blur"
            @click.self="lightbox.open = false"
        >
            <button
                class="absolute text-3xl text-white top-4 right-4"
                @click="lightbox.open = false"
                aria-label="Schließen"
            >
                &times;
            </button>
            <img
                :src="referenz.bilder[lightbox.index]"
                class="object-contain max-w-full max-h-[90vh] rounded-xl shadow-xl"
                :alt="`Bild ${lightbox.index + 1} zu ${referenz.titel}`"
            />
        </div>
    </GuestLayout>
</template>

<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import { Head, usePage } from "@inertiajs/vue3";
import { ref, computed, onMounted } from "vue";

const props = defineProps({
    referenz: Object,
});

const page = usePage();
const canonicalUrl = computed(() => `https://www.antasus.de${page.url}`);

const lightbox = ref({ open: false, index: 0 });
const openLightbox = (index) => {
    lightbox.value.open = true;
    lightbox.value.index = index;
};

// Strukturierte Daten (JSON-LD)
const jsonLd = computed(() => ({
    "@context": "https://schema.org",
    "@type": "Project",
    name: props.referenz.titel,
    description: props.referenz.beschreibung,
    location: {
        "@type": "Place",
        name: props.referenz.ort,
    },
    image: `https://www.antasus.de${
        props.referenz.bilder?.[0] || props.referenz.image
    }`,
    url: canonicalUrl.value,
    provider: {
        "@type": "Organization",
        name: "ANTASUS Infra",
        url: "https://www.antasus.de",
        logo: "https://www.antasus.de/images/antasus-logo2.svg",
        contactPoint: {
            "@type": "ContactPoint",
            telephone: "+49 176 24757616",
            contactType: "customer support",
            areaServed: "DE",
        },
    },
}));

onMounted(() => {
    const script = document.createElement("script");
    script.type = "application/ld+json";
    script.text = JSON.stringify(jsonLd.value);
    document.head.appendChild(script);
});
</script>
