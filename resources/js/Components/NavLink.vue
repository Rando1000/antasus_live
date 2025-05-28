<template>
    <Link
        :href="href"
        class="relative inline-block px-1 transition-colors duration-200"
        :class="[
            isActive
                ? 'text-teal-600 dark:text-teal-400 font-semibold'
                : 'text-gray-700 hover:text-teal-600 dark:text-gray-300 dark:hover:text-teal-400',
        ]"
        aria-current="page"
    >
        <span class="relative z-10">{{ label }}</span>
        <!-- Unterstrich bei aktivem Link -->
        <span
            v-if="isActive"
            class="absolute bottom-0 left-0 w-full h-[2px] bg-teal-600 dark:bg-teal-400 rounded-full"
        ></span>
    </Link>
</template>

<script setup>
import { computed } from "vue";
import { Link, usePage } from "@inertiajs/vue3";

const props = defineProps({
    href: String,
    label: {
        type: String,
        required: true,
    },
});

const page = usePage();

const isActive = computed(() => {
    const current = page.url.split("?")[0];
    return current === props.href || current.startsWith(props.href + "/");
});
</script>
