<template>
    <nav
        class="fixed bottom-0 left-0 right-0 z-50 flex justify-around bg-white border-t border-gray-200 shadow md:hidden"
    >
        <Link
            v-for="item in items"
            :key="item.href"
            :href="item.href"
            class="flex flex-col items-center justify-center py-2 text-xs text-gray-600 hover:text-teal-600"
        >
            <component :is="item.icon" class="w-5 h-5 mb-1" />
            <span>{{ item.label }}</span>
        </Link>
    </nav>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import { Home, Layers, Briefcase, Mail } from "lucide-vue-next";

const items = [
    { href: "/", label: "Home", icon: Home },
    { href: "/leistungen", label: "Leistungen", icon: Layers },
    { href: "/referenzen", label: "Referenzen", icon: Briefcase },
    { href: "/kontakt", label: "Kontakt", icon: Mail },
];
</script>
