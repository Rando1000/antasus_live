<template>
    <div
        v-if="links.length > 3"
        class="flex items-center justify-center mt-6 space-x-2 text-sm"
    >
        <template v-for="(link, key) in links" :key="key">
            <component
                :is="link.url ? 'Link' : 'span'"
                :href="link.url"
                v-html="link.label"
                class="px-3 py-1 border rounded"
                :class="{
                    'bg-teal-600 text-white border-teal-600': link.active,
                    'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800':
                        !link.active && link.url,
                    'text-gray-400': !link.url,
                }"
            />
        </template>
    </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
defineProps({ links: Array });
</script>
