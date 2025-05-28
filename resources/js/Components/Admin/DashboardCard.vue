<template>
    <Link
        :href="link"
        class="p-6 text-white transition-all transform shadow rounded-xl hover:shadow-lg hover:-translate-y-1 bg-gradient-to-br"
        :class="bg"
    >
        <div class="mb-3 text-4xl">{{ icon }}</div>
        <div class="text-lg font-semibold">{{ title }}</div>
        <div class="text-2xl font-bold">{{ count }}</div>
    </Link>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";

defineProps({
    title: String,
    icon: String,
    count: Number,
    link: String,
    bg: String, // z. B. "from-teal-500 to-teal-700"
});
</script>
