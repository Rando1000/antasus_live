<!-- resources/js/Pages/Leistungen/ServiceItemShow.vue -->
<template>
    <Head>
        <title>{{ item.title }} – {{ service.title }} | ANTASUS Infra</title>
        <meta name="description" :content="item.description" />
        <link rel="canonical" :href="fullUrl" />
        <!-- OpenGraph falls nötig: -->
        <meta
            property="og:title"
            :content="`${item.title} – ${service.title}`"
        />
        <meta property="og:description" :content="item.description" />
        <meta property="og:image" :content="imageUrl" />
        <meta property="og:url" :content="fullUrl" />
        <meta property="og:type" content="article" />
        <meta name="twitter:card" content="summary_large_image" />
    </Head>

    <GuestLayout :serviceArea="'dienstleistungen'">
        <section
            class="max-w-4xl px-4 py-20 mx-auto text-center animate-fade-in"
        >
            <h1 class="mb-4 text-3xl font-extrabold text-gray-900">
                {{ item.title }}
            </h1>
            <p class="mb-8 text-lg text-gray-700">{{ item.description }}</p>
            <img
                v-if="item.image_url"
                :src="item.image_url"
                class="object-cover w-full max-h-[400px] mx-auto rounded shadow"
                :alt="item.title"
                loading="lazy"
            />
            <div class="mt-10">
                <Link
                    href="/kontakt"
                    class="inline-block px-6 py-3 text-white transition bg-teal-600 rounded hover:bg-teal-700"
                >
                    Projekt anfragen
                </Link>
            </div>
        </section>
    </GuestLayout>
</template>

<script setup>
import { useHead } from "@vueuse/head";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import { Link } from "@inertiajs/vue3";
import { computed } from "vue";

const props = defineProps({
    service: Object,
    item: Object,
});

const fullUrl = computed(() => window.location.href);
const imageUrl = computed(
    () =>
        props.item.image_url ||
        "https://www.antasus.de/images/og-leistungen.webp"
);

// JSON-LD für **einen** Service
useHead({
    script: [
        {
            type: "application/ld+json",
            children: JSON.stringify({
                "@context": "https://schema.org",
                "@type": "Service",
                name: props.item.title,
                description: props.item.description,
                image: imageUrl.value,
                url: fullUrl.value,
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
            }),
        },
    ],
});
</script>
