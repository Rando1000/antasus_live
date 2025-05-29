<template>
    <div class="flex flex-col min-h-screen text-gray-800 bg-white">
        <!-- Header (App-Bar) -->
        <header
            class="sticky top-0 z-50 flex items-center justify-between px-4 py-3 text-white shadow-md bg-antasus-primary"
        >
            <h1 class="text-xl font-semibold">{{ title }}</h1>
            <slot name="actions" />
        </header>

        <!-- Content -->
        <main class="flex-1 px-4 py-6 overflow-y-auto">
            <slot />
        </main>

        <!-- Bottom Navigation -->
        <nav
            class="sticky bottom-0 z-50 flex justify-around py-2 text-sm bg-white border-t border-gray-200"
        >
            <Link
                href="/"
                class="flex flex-col items-center text-gray-600 hover:text-teal-600"
            >
                <i class="w-5 h-5 lucide lucide-home" />
                Home
            </Link>
            <Link
                href="/leistungen"
                class="flex flex-col items-center text-gray-600 hover:text-teal-600"
            >
                <i class="w-5 h-5 lucide lucide-layers" />
                Leistungen
            </Link>
            <Link
                href="/referenzen"
                class="flex flex-col items-center text-gray-600 hover:text-teal-600"
            >
                <i class="w-5 h-5 lucide lucide-briefcase" />
                Referenzen
            </Link>
            <Link
                href="/kontakt"
                class="flex flex-col items-center text-gray-600 hover:text-teal-600"
            >
                <i class="w-5 h-5 lucide lucide-mail" />
                Kontakt
            </Link>
        </nav>
    </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";

defineProps({
    title: {
        type: String,
        default: "ANTASUS Infra",
    },
});
</script>
