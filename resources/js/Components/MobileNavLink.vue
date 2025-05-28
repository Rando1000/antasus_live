<template>
    <Link
        :href="href"
        class="block px-4 py-3 text-base font-medium transition rounded-lg"
        :class="[
            isActive
                ? 'bg-teal-100 text-teal-700 dark:bg-teal-800/20 dark:text-teal-200'
                : 'text-gray-800 hover:bg-teal-50 hover:text-teal-700 dark:text-gray-200 dark:hover:bg-gray-700 dark:hover:text-white',
        ]"
    >
        {{ label }}
    </Link>
</template>

<script setup>
import { computed } from "vue";
import { Link, usePage } from "@inertiajs/vue3";

const props = defineProps({
    href: String,
    label: String,
});

const page = usePage();

const isActive = computed(() => {
    const current = page.url.split("?")[0];
    return current === props.href || current.startsWith(props.href + "/");
});
</script>
