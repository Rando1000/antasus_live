<script setup>
import { usePage } from "@inertiajs/vue3";
import { computed } from "vue";

const props = defineProps({
    title: String,
    description: String,
    image: String,
    jsonLd: Object,
});

const fullTitle = computed(() => `${props.title} | ANTASUS Infra`);
const url = computed(() => usePage().url);
</script>

<template>
    <head>
        <title>{{ fullTitle }}</title>
        <meta name="description" :content="description" />
        <meta property="og:title" :content="fullTitle" />
        <meta property="og:description" :content="description" />
        <meta property="og:image" :content="image" />
        <meta property="og:url" :content="`https://www.antasus.de${url}`" />
        <meta name="twitter:card" content="summary_large_image" />
        <meta name="twitter:title" :content="fullTitle" />
        <meta name="twitter:description" :content="description" />
        <meta name="twitter:image" :content="image" />
        <link rel="canonical" :href="`https://www.antasus.de${url}`" />
        <div
            v-if="jsonLd"
            type="application/ld+json"
            :innerHTML="JSON.stringify(jsonLd)"
        />
    </head>
</template>
