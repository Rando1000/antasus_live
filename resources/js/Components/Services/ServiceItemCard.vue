<template>
    <div
        class="relative overflow-hidden transition bg-white border border-gray-200 shadow rounded-xl hover:shadow-lg"
    >
        <button
            @click="$emit('select', item)"
            class="block w-full text-left group"
        >
            <img
                v-if="item.image"
                :src="item.image_url"
                :alt="item.title"
                class="object-cover w-full h-48 transition-transform duration-300 group-hover:scale-105"
            />
            <div class="p-6">
                <h3 class="mb-2 text-xl font-bold text-gray-900">
                    {{ item.title }}
                </h3>
                <p class="text-sm text-gray-700 line-clamp-3">
                    {{ item.description }}
                </p>
                <div
                    class="mt-4 text-sm font-medium text-teal-600 hover:underline"
                >
                    Mehr erfahren
                </div>
            </div>
        </button>
    </div>
</template>

<script setup>
defineProps({
    item: Object,
});
defineEmits(["select"]);
</script>

<style scoped>
.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
