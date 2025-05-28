<template>
    <Link
        :href="to"
        class="flex items-center px-3 py-2 text-sm font-medium transition-colors rounded-lg hover:bg-teal-100 dark:hover:bg-gray-700"
        :class="{ 'bg-teal-50 dark:bg-gray-700': isActive }"
    >
        <component
            :is="iconComponent"
            class="w-5 h-5 mr-3 text-teal-600 dark:text-teal-300"
        />
        <span class="text-gray-800 dark:text-gray-100">{{ label }}</span>
    </Link>
</template>

<script setup>
import { computed } from "vue";
import { Link, usePage } from "@inertiajs/vue3";
import {
    UsersIcon,
    ChartBarIcon,
    DocumentTextIcon,
    Cog6ToothIcon,
    InboxIcon,
    HomeIcon,
} from "@heroicons/vue/24/solid";

const props = defineProps({
    label: String,
    to: String,
    icon: String, // z. B. 'Users', 'Analytics', 'Messages'
});

// Mapping der Icon-Namen auf Komponenten
const iconMap = {
    Users: UsersIcon,
    Analytics: ChartBarIcon,
    References: DocumentTextIcon,
    Settings: Cog6ToothIcon,
    Messages: InboxIcon,
    Dashboard: HomeIcon,
};

const iconComponent = computed(() => iconMap[props.icon] || Cog6ToothIcon);

const page = usePage();
const isActive = computed(() => page.url.startsWith(props.to));
</script>
