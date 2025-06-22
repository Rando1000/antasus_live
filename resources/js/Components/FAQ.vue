<!-- resources/js/Components/FAQ.vue -->
<template>
    <section class="mt-12">
        <h2
            class="mb-6 text-2xl font-bold text-center text-black dark:text-white"
        >
            Häufige Fragen
        </h2>
        <div class="space-y-4">
            <details
                v-for="(item, i) in items"
                :key="i"
                class="p-4 border border-gray-300 rounded-lg dark:border-gray-700 group"
            >
                <summary
                    class="text-lg font-medium text-gray-800 cursor-pointer dark:text-gray-200"
                >
                    {{ item.q }}
                </summary>
                <p class="mt-2 text-gray-600 dark:text-gray-400">
                    {{ item.a }}
                </p>
            </details>
        </div>
    </section>
</template>

<script setup>
defineProps({
    items: {
        type: Array,
        required: true,
    },
});
</script>
