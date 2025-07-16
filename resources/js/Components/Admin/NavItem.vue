<template>
    <Link
        :href="to"
        class="flex items-center gap-3 px-4 py-2.5 rounded-lg font-medium transition-all group focus:outline-none focus-visible:ring-2 focus-visible:ring-teal-400"
        :class="
            active
                ? 'bg-gradient-to-r from-teal-500 to-indigo-800 text-white shadow'
                : 'text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800'
        "
        aria-current="page"
    >
        <component
            :is="iconComponent"
            class="w-5 h-5 opacity-80"
            aria-hidden="true"
        />
        <span>{{ label }}</span>
    </Link>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import {
    Mail,
    Layers,
    Briefcase,
    Home,
    Users,
    BarChart,
    MessageSquare,
    MonitorCheck,
} from "lucide-vue-next";
// Du kannst alle Lucide-Icons nach Bedarf importieren

const props = defineProps({
    label: String,
    to: String,
    icon: String,
    active: Boolean,
});

// Mapping für deine Icons
const icons = {
    Dashboard: Home,
    Services: Layers,
    References: Briefcase,
    Users: Users,
    Analytics: BarChart,
    Messages: MessageSquare,
    "E-Mail-Kampagnen": Mail,
    Mail: Mail,
};
const iconComponent = icons[props.icon] || MonitorCheck;
</script>
