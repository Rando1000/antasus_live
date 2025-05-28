<template>
    <div class="grid max-w-6xl gap-10 px-4 py-20 mx-auto md:grid-cols-2">
        <Link
            v-for="(leistung, index) in services"
            :key="leistung.id"
            :href="route('leistungen.show', leistung.slug)"
            class="relative group bg-center bg-cover rounded-2xl shadow-lg overflow-hidden transform transition hover:scale-[1.02] hover:shadow-2xl"
        >
            <!-- Hintergrundbild -->
            <img
                :src="leistung.image || '/images/leistung-bg.webp'"
                alt="Hintergrund für Leistung"
                loading="lazy"
                class="absolute inset-0 object-cover w-full h-full"
            />
            <!-- Overlay -->
            <div class="absolute inset-0 bg-black/30"></div>

            <!-- Inhalt -->
            <div
                class="relative z-10 flex flex-col justify-between h-full p-6 text-white"
            >
                <div>
                    <h3
                        class="mb-2 text-2xl font-extrabold drop-shadow"
                        :id="'leistung-' + index"
                    >
                        {{ leistung.title }}
                    </h3>
                    <p
                        class="leading-relaxed text-gray-200 text-md drop-shadow line-clamp-3"
                    >
                        {{ leistung.description }}
                    </p>
                </div>
            </div>
        </Link>
    </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";

defineProps({
    services: Array,
});
</script>
