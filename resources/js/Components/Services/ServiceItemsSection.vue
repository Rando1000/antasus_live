<template>
    <section class="py-20 bg-gray-50">
        <div class="max-w-6xl px-4 mx-auto">
            <h2 class="mb-10 text-3xl font-extrabold text-center text-gray-900">
                {{ service.title }}
            </h2>
            <p
                v-if="service.description"
                class="max-w-3xl mx-auto mb-12 text-center text-gray-600"
            >
                {{ service.description }}
            </p>

            <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                <ServiceItemCard
                    v-for="item in service.items"
                    :key="item.id"
                    :item="item"
                />
            </div>
        </div>
    </section>
</template>

<script setup>
import ServiceItemCard from "./ServiceItemCard.vue";

const props = defineProps({
    service: {
        type: Object,
        required: true,
    },
});
</script>
