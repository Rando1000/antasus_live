<!-- resources/js/Pages/Leistungen/Show.vue -->
<template>
    <Head>
        <title>{{ service.title }} | ANTASUS Infra</title>
        <meta name="description" :content="service.description" />
        <link
            rel="canonical"
            :href="`https://www.antasus.de/leistungen/${service.slug}`"
        />
        <!-- OpenGraph falls gewünscht -->
        <meta
            property="og:title"
            :content="service.title + ' | ANTASUS Infra'"
        />
        <meta property="og:description" :content="service.description" />
        <meta property="og:type" content="website" />
        <meta
            property="og:url"
            :content="`https://www.antasus.de/leistungen/${service.slug}`"
        />
        <!-- Wenn es ein Bild für die Übersicht gibt: -->
        <!-- <meta property="og:image" content="https://www.antasus.de/images/og-service-overview.webp" /> -->
    </Head>

    <GuestLayout :serviceArea="'dienstleistungen'">
        <!-- Header -->
        <section
            class="w-full px-4 text-center bg-gradient-to-br from-antasus-primary ..."
        >
            <div class="max-w-4xl py-20 mx-auto text-white">
                <h1
                    class="mb-4 text-4xl font-extrabold md:text-5xl drop-shadow-lg"
                >
                    {{ service.title }}
                </h1>
                <p class="text-lg md:text-xl text-white/90 drop-shadow-sm">
                    {{ service.description }}
                </p>
            </div>
        </section>

        <!-- Items Grid -->
        <section class="py-20 bg-white">
            <div class="max-w-6xl px-4 mx-auto">
                <div class="grid gap-8 md:grid-cols-2">
                    <div
                        v-for="item in service.items"
                        :key="item.id"
                        @click="showModal(item)"
                        class="overflow-hidden transition border border-gray-200 shadow cursor-pointer rounded-xl hover:shadow-lg"
                    >
                        <img
                            v-if="item.image_url"
                            :src="item.image_url"
                            :alt="item.title"
                            class="object-cover w-full h-48"
                        />
                        <div class="p-5">
                            <h3 class="mb-2 text-xl font-bold text-gray-900">
                                {{ item.title }}
                            </h3>
                            <p class="text-gray-600 line-clamp-3">
                                {{ item.description }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Modal für Service-Detail (unverändert) -->
        <Transition name="fade-slide">
            <div
                v-if="selectedItem"
                class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm"
                @click.self="closeModal"
            >
                <div
                    class="relative w-full max-w-2xl mx-4 bg-white rounded-lg shadow-xl animate-fade-in-up flex flex-col max-h-[90vh]"
                >
                    <!-- Schließen-Button -->
                    <button
                        @click="closeModal"
                        class="absolute text-gray-400 top-3 right-3 hover:text-gray-600"
                        aria-label="Schließen"
                    >
                        &times;
                    </button>

                    <!-- Titel & Bild -->
                    <div class="p-6">
                        <h2 class="mb-4 text-2xl font-bold text-gray-900">
                            {{ selectedItem.title }}
                        </h2>
                        <img
                            v-if="selectedItem.image_url"
                            :src="selectedItem.image_url"
                            :alt="selectedItem.title"
                            class="object-cover w-full h-64 mb-4 rounded"
                        />
                    </div>

                    <!-- Text-Bereich -->
                    <div
                        class="px-6 overflow-y-auto text-gray-700 whitespace-pre-line max-h-[40vh]"
                    >
                        {{ selectedItem.description }}
                    </div>

                    <!-- Aktionen unten -->
                    <div class="p-6 mt-auto border-t bg-gray-50">
                        <div
                            class="flex flex-col items-start justify-between gap-4 md:flex-row md:items-center"
                        >
                            <Link
                                :href="`/leistungen/${service.slug}/${selectedItem.slug}/${selectedItem.id}`"
                                class="text-sm font-semibold text-teal-700 hover:underline"
                            >
                                Vollständige Projektbeschreibung ansehen →
                            </Link>
                            <Link
                                href="/kontakt"
                                class="inline-block px-6 py-3 text-white rounded shadow bg-antasus-primary hover:bg-antasus-dark"
                            >
                                Projekt anfragen
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </Transition>
    </GuestLayout>
</template>

<script setup>
import { useHead } from "@vueuse/head";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import { Link, usePage, router } from "@inertiajs/vue3";
import { ref, onMounted, onUnmounted, computed } from "vue";

const props = defineProps({ service: Object });
const selectedItem = ref(null);
const page = usePage();

/**
 * Modal-Funktionen (wie gehabt)
 */
function showModal(item) {
    selectedItem.value = item;
    router.push({
        replace: false,
        preserveScroll: true,
        preserveState: true,
        url: `/leistungen/${props.service.slug}/${item.slug}/${item.id}`,
    });
}
function closeModal() {
    selectedItem.value = null;
    router.push({
        replace: false,
        preserveScroll: true,
        preserveState: true,
        url: `/leistungen/${props.service.slug}`,
    });
}
function handleEscape(event) {
    if (event.key === "Escape" && selectedItem.value) {
        closeModal();
    }
}

onMounted(() => {
    document.addEventListener("keydown", handleEscape);

    // JSON-LD für alle Service-Items in @graph
    const graph = props.service.items.map((item) => ({
        "@type": "Service",
        name: item.title,
        description: item.description,
        url: `https://www.antasus.de/leistungen/${props.service.slug}/${item.slug}/${item.id}`,
        provider: {
            "@type": "LocalBusiness",
            "@id": "https://www.antasus.de/#localbusiness",
        },
        areaServed: {
            "@type": "GeoCircle",
            geoMidpoint: {
                "@type": "GeoCoordinates",
                latitude: 51.2562,
                longitude: 7.1508,
            },
            geoRadius: 150,
        },
    }));

    useHead({
        script: [
            {
                type: "application/ld+json",
                children: JSON.stringify({
                    "@context": "https://schema.org",
                    "@graph": graph,
                }),
            },
        ],
    });
});

onUnmounted(() => {
    document.removeEventListener("keydown", handleEscape);
});
</script>

<style scoped>
.fade-slide-enter-active,
.fade-slide-leave-active {
    transition: all 0.3s ease;
}
.fade-slide-enter-from,
.fade-slide-leave-to {
    opacity: 0;
    transform: translateY(20px);
}
.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
