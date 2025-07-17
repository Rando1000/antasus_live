<template>
    <div
        class="p-6 transition transform bg-white border rounded-lg shadow hover:shadow-md dark:bg-gray-800 dark:border-gray-700 hover:-translate-y-1"
        :class="`ring-2 ring-${color}-100 dark:ring-${color}-800/50`"
        tabindex="0"
        aria-label="Statistik {{ title }}"
    >
        <div class="flex items-center space-x-4">
            <div
                class="flex items-center justify-center w-12 h-12 rounded-full"
                :class="`bg-${color}-100 text-${color}-600 dark:bg-${color}-800 dark:text-${color}-200`"
            >
                <component :is="iconComponent" class="w-6 h-6" />
            </div>
            <div>
                <h2
                    class="text-lg font-semibold text-gray-800 dark:text-gray-100"
                >
                    {{ title }}
                </h2>
                <p
                    class="text-2xl font-bold text-gray-900 dark:text-white animate-fade-in-up"
                >
                    {{ value }}
                </p>
            </div>
        </div>
    </div>
</template>

<script setup>
import { computed } from "vue";
import {
    DocumentTextIcon,
    ChartBarIcon,
    EnvelopeIcon,
    UsersIcon,
    EyeIcon,
} from "@heroicons/vue/24/solid";

const props = defineProps({
    title: String,
    value: [String, Number],
    icon: String,
    color: {
        type: String,
        default: "teal",
    },
});

const iconMap = {
    DocumentTextIcon,
    ChartBarIcon,
    EnvelopeIcon,
    UsersIcon,
    EyeIcon,
};
const iconComponent = computed(() => iconMap[props.icon] || DocumentTextIcon);
</script>
