<template>
    <Link
        :href="to"
        class="p-6 transition bg-white border-l-4 rounded-lg shadow hover:shadow-md"
        :class="colorClass"
    >
        <div class="mb-1 text-sm font-semibold text-gray-500">{{ label }}</div>
        <div class="text-3xl font-bold text-gray-800">{{ value }}</div>
    </Link>
</template>

<script setup>
import { computed } from "vue";
import { Link } from "@inertiajs/vue3";

const props = defineProps({
    label: String,
    value: Number,
    color: String,
    to: String,
});

const colorClass = computed(() => {
    return (
        {
            teal: "border-teal-600",
            indigo: "border-indigo-600",
            amber: "border-amber-500",
            gray: "border-gray-500",
        }[props.color] || "border-gray-300"
    );
});
</script>
