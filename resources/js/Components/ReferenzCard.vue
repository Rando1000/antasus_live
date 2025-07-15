<template>
    <div
        class="referenz-card group grid items-center gap-8 md:gap-16 pb-14 md:pb-16 mb-12 md:mb-16 bg-slate-100 dark:bg-[#202636] rounded-2xl transition-transform duration-300 hover:-translate-y-1 shadow-xl"
        :class="
            reversed
                ? 'md:flex-row-reverse md:grid-cols-2 flex-row-reverse'
                : 'md:grid-cols-2'
        "
        tabindex="0"
        role="article"
        :aria-label="referenz.titel"
    >
        <!-- Bild -->
        <div
            class="relative p-0 sm:p-4 flex items-center justify-center overflow-hidden shadow-lg rounded-2xl bg-white dark:bg-[#15171d] transition"
        >
            <img
                :src="referenz.bilder?.[0] || '/images/default-image.avif'"
                :alt="referenz.titel"
                class="object-cover w-full h-64 transition-transform md:h-96 rounded-2xl group-hover:scale-105 group-hover:shadow-2xl duration-400"
                loading="lazy"
                decoding="async"
            />
            <div
                class="absolute inset-0 pointer-events-none rounded-2xl"
                style="box-shadow: 0 4px 48px 0 rgba(0, 253, 207, 0.09)"
            ></div>
        </div>

        <!-- Textblock -->
        <div class="px-3 space-y-4 sm:px-0">
            <h3
                class="text-2xl font-extrabold tracking-tight text-gray-900 md:text-3xl dark:text-white drop-shadow-md"
            >
                {{ referenz.titel }}
            </h3>
            <p
                class="leading-relaxed text-gray-700 text-md md:text-lg dark:text-gray-200"
            >
                {{ referenz.beschreibung }}
            </p>
            <div class="flex items-center gap-3 mt-2">
                <span
                    class="inline-flex items-center px-3 py-1 text-xs font-semibold text-white rounded-full shadow-sm bg-gradient-to-r from-teal-400 to-indigo-400"
                >
                    {{ referenz.ort || "Projektstandort" }}
                </span>
            </div>
            <Link
                :href="route('referenzen.show', referenz.slug)"
                class="inline-block px-6 py-3 mt-6 font-semibold text-white rounded-lg shadow-lg bg-gradient-to-r from-teal-600 to-indigo-600 hover:from-teal-700 hover:to-indigo-700 hover:-translate-y-0.5 transition-all duration-200 focus:outline-none focus:ring-4 focus:ring-teal-300"
                aria-label="Mehr zu {{ referenz.titel }}"
            >
                Mehr erfahren
            </Link>
        </div>
    </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";

defineProps({
    referenz: { type: Object, required: true },
    reversed: { type: Boolean, default: false },
});
</script>

<style scoped>
.referenz-card {
    outline: none;
}
.referenz-card:focus-visible {
    box-shadow: 0 0 0 4px #00fdcf77, 0 4px 32px rgba(0, 0, 0, 0.09);
    z-index: 10;
}
</style>
