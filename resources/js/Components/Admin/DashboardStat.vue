<template>
    <Link
        :href="href"
        class="block p-6 transition bg-white border rounded-lg shadow hover:shadow-md"
    >
        <p class="text-sm font-medium text-gray-500">{{ title }}</p>
        <p class="mt-1 text-3xl font-bold text-gray-900">{{ value }}</p>
    </Link>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";

defineProps({
    title: String,
    value: Number,
    href: String,
});
</script>
