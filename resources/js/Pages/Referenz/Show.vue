<template>
    <Head>
        <title>{{ referenz.titel }} | Projekt-Referenz | ANTASUS Infra</title>
        <meta name="description" :content="referenz.beschreibung" />
        <meta
            property="og:title"
            :content="`${referenz.titel} | Projekt-Referenz | ANTASUS Infra`"
        />
        <meta property="og:description" :content="referenz.beschreibung" />
        <meta property="og:image" :content="ogImage" />
        <meta property="og:type" content="article" />
        <meta property="og:url" :content="canonicalUrl" />
    </Head>

    <GuestLayout :serviceArea="'referenz'">
        <!-- Header -->
        <template #header>
            <section class="px-4 text-center animate-fade-in">
                <div class="max-w-4xl mx-auto">
                    <h1
                        class="mb-4 text-4xl font-extrabold text-white md:text-5xl drop-shadow-xl"
                    >
                        {{ referenz.titel }}
                    </h1>
                    <p class="text-lg text-white/90 drop-shadow-md">
                        {{ referenz.ort }}
                    </p>
                </div>
            </section>
        </template>

        <!-- Inhalt -->
        <section class="py-16 transition bg-white dark:bg-slate-900">
            <div class="max-w-4xl px-4 mx-auto space-y-12">
                <article>
                    <h2 class="text-xl font-bold text-gray-800 dark:text-white">
                        Projektbeschreibung
                    </h2>
                    <p
                        class="mt-2 text-lg leading-relaxed text-gray-700 dark:text-gray-200"
                    >
                        {{ referenz.beschreibung }}
                    </p>
                </article>

                <!-- Galerie -->
                <div v-if="bilder.length" class="pt-10">
                    <h3
                        class="mb-4 text-xl font-semibold text-gray-800 dark:text-white"
                    >
                        Bildergalerie
                    </h3>
                    <ul
                        class="grid gap-6 sm:grid-cols-2 md:grid-cols-3"
                        role="list"
                        aria-label="Bildergalerie"
                    >
                        <li
                            v-for="(img, idx) in bilder"
                            :key="idx"
                            class="relative group"
                        >
                            <button
                                @click="openLightbox(idx)"
                                class="block w-full h-64 overflow-hidden transition-transform duration-300 ease-in-out rounded-xl focus:ring-2 focus:ring-teal-500 focus:outline-none group-hover:scale-105 group-focus:scale-105"
                                :aria-label="`Bild ${idx + 1} zu ${
                                    referenz.titel
                                } öffnen`"
                            >
                                <img
                                    :src="img"
                                    :alt="`Projektbild ${idx + 1} zu ${
                                        referenz.titel
                                    }`"
                                    class="object-cover w-full h-full pointer-events-none"
                                    loading="lazy"
                                    draggable="false"
                                />
                                <span
                                    class="absolute inset-0 transition bg-black/10 group-hover:bg-black/25"
                                ></span>
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
        </section>

        <!-- Lightbox -->
        <Teleport to="body">
            <transition name="fade">
                <div
                    v-if="lightbox.open"
                    class="fixed inset-0 z-50 flex flex-col items-center justify-center p-4 bg-black/80 backdrop-blur-md"
                    tabindex="-1"
                    aria-modal="true"
                    role="dialog"
                    @keydown.esc="closeLightbox"
                >
                    <button
                        class="absolute text-3xl rounded top-4 right-4 text-white/90 hover:text-teal-300 focus:outline-none focus:ring-2 focus:ring-teal-400"
                        @click="closeLightbox"
                        aria-label="Schließen"
                    >
                        &times;
                    </button>
                    <div class="relative w-full max-w-2xl mx-auto">
                        <img
                            :src="bilder[lightbox.index]"
                            :alt="`Großansicht Bild ${lightbox.index + 1} zu ${
                                referenz.titel
                            }`"
                            class="object-contain w-full max-h-[75vh] rounded-xl shadow-2xl"
                            draggable="false"
                        />
                        <!-- Vor/Zurück -->
                        <button
                            v-if="bilder.length > 1"
                            class="absolute left-0 p-2 text-2xl text-white transition -translate-y-1/2 rounded-full shadow top-1/2 bg-white/20 hover:bg-teal-400/80 focus:outline-none focus:ring-2 focus:ring-teal-400"
                            @click="prevImg"
                            aria-label="Vorheriges Bild"
                        >
                            <
                        </button>
                        <button
                            v-if="bilder.length > 1"
                            class="absolute right-0 p-2 text-2xl text-white transition -translate-y-1/2 rounded-full shadow top-1/2 bg-white/20 hover:bg-teal-400/80 focus:outline-none focus:ring-2 focus:ring-teal-400"
                            @click="nextImg"
                            aria-label="Nächstes Bild"
                        >
                            >
                        </button>
                    </div>
                    <div class="mt-4 text-sm text-white/70">
                        Bild {{ lightbox.index + 1 }} von {{ bilder.length }}
                    </div>
                </div>
            </transition>
        </Teleport>
    </GuestLayout>
</template>

<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import { Head } from "@inertiajs/vue3";
import { ref, computed, watch, onMounted, nextTick } from "vue";
import { usePage } from "@inertiajs/vue3";

const props = defineProps({
    referenz: Object,
});

// Korrigiert und fallback-sicher für alle Datenstrukturen:
const bilder = computed(() =>
    Array.isArray(props.referenz.bilder)
        ? props.referenz.bilder
        : props.referenz.image
        ? [props.referenz.image]
        : []
);

// Lightbox State + Keyboard-Navigation
const lightbox = ref({ open: false, index: 0 });

function openLightbox(idx) {
    lightbox.value.open = true;
    lightbox.value.index = idx;
    nextTick(() => {
        // Focus trapping für Accessibility
        document.body.style.overflow = "hidden";
        window.addEventListener("keydown", keyHandler);
    });
}
function closeLightbox() {
    lightbox.value.open = false;
    document.body.style.overflow = "";
    window.removeEventListener("keydown", keyHandler);
}
function nextImg() {
    if (lightbox.value.index < bilder.value.length - 1) {
        lightbox.value.index += 1;
    } else {
        lightbox.value.index = 0;
    }
}
function prevImg() {
    if (lightbox.value.index > 0) {
        lightbox.value.index -= 1;
    } else {
        lightbox.value.index = bilder.value.length - 1;
    }
}
function keyHandler(e) {
    if (!lightbox.value.open) return;
    if (e.key === "ArrowRight") nextImg();
    if (e.key === "ArrowLeft") prevImg();
    if (e.key === "Escape") closeLightbox();
}

// Canonical URL und OG
const canonicalUrl = computed(() => {
    const base = "https://www.antasus.de/referenzen/";
    return props.referenz.slug
        ? base + encodeURIComponent(props.referenz.slug)
        : base;
});
const ogImage = computed(() =>
    bilder.value.length
        ? bilder.value[0].startsWith("http")
            ? bilder.value[0]
            : `https://www.antasus.de${bilder.value[0]}`
        : "https://www.antasus.de/images/og-referenzen.webp"
);

// Strukturierte Daten (JSON-LD) für Google AI, direkt per JS
const jsonLd = computed(() => ({
    "@context": "https://schema.org",
    "@type": "Project",
    name: props.referenz.titel,
    description: props.referenz.beschreibung,
    location: {
        "@type": "Place",
        name: props.referenz.ort,
    },
    image: ogImage.value,
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
    // Remove old if exists:
    document
        .querySelectorAll('script[type="application/ld+json"].referenz-jsonld')
        .forEach((e) => e.remove());
    // Add new
    const script = document.createElement("script");
    script.type = "application/ld+json";
    script.className = "referenz-jsonld";
    script.text = JSON.stringify(jsonLd.value);
    document.head.appendChild(script);
});
</script>

<style scoped>
/* Fade Anim for Lightbox */
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.25s cubic-bezier(0.5, 0, 0.2, 1);
}
.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
</style>
