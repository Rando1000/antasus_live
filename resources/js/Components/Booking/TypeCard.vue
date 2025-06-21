<template>
    <button
        @click="$emit('select')"
        type="button"
        class="flex flex-col items-center justify-center w-full h-full p-4 transition bg-white border rounded-lg dark:bg-gray-800 dark:border-gray-700 hover:bg-teal-50 hover:border-teal-500 dark:hover:bg-teal-900 focus:outline-none focus:ring-2 focus:ring-teal-500"
    >
        <span
            class="flex items-center justify-center w-12 h-12 mb-3 text-white rounded-full bg-gradient-to-r from-teal-600 to-indigo-600"
        >
            <component :is="iconComponent" class="w-6 h-6" />
        </span>
        <div class="text-lg font-medium text-gray-900 dark:text-white">
            {{ title }}
        </div>
        <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">
            {{ description }}
        </p>
    </button>
</template>

<script setup>
import {
    ChatBubbleLeftRightIcon,
    DocumentTextIcon,
    HomeModernIcon,
    Squares2X2Icon,
} from "@heroicons/vue/24/outline";

const props = defineProps({
    title: String,
    description: String,
    icon: String,
});

const emit = defineEmits(["select"]);

const icons = {
    ChatBubbleLeftRightIcon,
    DocumentTextIcon,
    HomeModernIcon,
    Squares2X2Icon,
};

const iconComponent = icons[props.icon] ?? ChatBubbleLeftRightIcon;
</script>
