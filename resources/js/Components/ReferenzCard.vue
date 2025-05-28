<template>
    <div
        class="grid items-center gap-8 pb-16 mb-16 bg-slate-100 rounded-2xl md:grid-cols-2 md:gap-16"
        :class="{ 'md:flex-row-reverse': reversed }"
    >
        <!-- Bild -->
        <div class="p-4 overflow-hidden shadow-md rounded-2xl">
            <img
                :src="referenz.bilder?.[0] || '/images/default-image.avif'"
                :alt="referenz.titel"
                class="object-cover w-full h-64 rounded-2xl sm:h-96"
                loading="lazy"
            />
        </div>

        <!-- Text -->
        <div class="space-y-4">
            <h3 class="text-2xl font-bold text-gray-900">
                {{ referenz.titel }}
            </h3>
            <p class="leading-relaxed text-gray-700 text-md">
                {{ referenz.beschreibung }}
            </p>

            <Link
                :href="route('referenzen.show', referenz.slug)"
                class="inline-block px-5 py-3 mt-4 text-sm font-semibold text-white transition bg-teal-600 rounded-lg shadow hover:bg-teal-700 hover:-translate-y-0.5"
                aria-label="Zur Referenzseite"
            >
                Mehr erfahren
            </Link>
        </div>
    </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";

const props = defineProps({
    referenz: {
        type: Object,
        required: true,
    },
    reversed: {
        type: Boolean,
        default: false,
    },
});
</script>
