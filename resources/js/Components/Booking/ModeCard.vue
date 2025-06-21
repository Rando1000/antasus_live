<template>
    <button
        @click="$emit('select')"
        type="button"
        class="flex flex-col items-start justify-start w-full h-full p-4 transition bg-white border rounded-lg dark:bg-gray-800 dark:border-gray-700 hover:bg-teal-50 hover:border-teal-500 dark:hover:bg-teal-900 focus:outline-none focus:ring-2 focus:ring-teal-500"
    >
        <div class="flex items-center gap-3">
            <span
                class="flex items-center justify-center w-10 h-10 text-white rounded-full bg-gradient-to-r from-teal-600 to-indigo-600"
            >
                <component :is="modeIcon" class="w-5 h-5" />
            </span>
            <div class="text-base font-medium text-gray-900 dark:text-white">
                {{ title }}
            </div>
        </div>
        <p class="mt-2 text-sm text-gray-500 dark:text-gray-300">
            {{ description }}
        </p>
    </button>
</template>

<script setup>
import { DevicePhoneMobileIcon, HomeIcon } from "@heroicons/vue/24/outline";

const props = defineProps({
    mode: String,
    title: String,
    description: String,
});

const emit = defineEmits(["select"]);

const modeIcon = props.mode === "online" ? DevicePhoneMobileIcon : HomeIcon;
</script>
