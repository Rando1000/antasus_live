<template>
    <div class="flex flex-col min-h-screen bg-white">
        <!-- Header mit anthraziter Unterleiste -->
        <header class="bg-white border-b border-gray-800">
            <div
                class="flex items-center justify-between px-6 py-4 mx-auto max-w-7xl"
            >
                <Link href="/" class="group">
                    <ApplicationLogo2
                        class="h-10 transition-opacity group-hover:opacity-90"
                    />
                </Link>
                <nav class="flex items-center space-x-8">
                    <Link
                        href="/leistungen"
                        class="font-medium text-gray-700 transition-colors hover:text-indigo-600"
                    >
                        Leistungen
                    </Link>
                    <Link
                        href="/kontakt"
                        class="font-medium text-gray-700 transition-colors hover:text-indigo-600"
                    >
                        Kontakt
                    </Link>
                    <Link
                        href="/login"
                        class="px-4 py-2 font-semibold text-white transition-colors bg-gray-900 rounded-lg hover:bg-indigo-700"
                    >
                        Login
                    </Link>
                </nav>
            </div>
        </header>

        <main class="flex-grow">
            <slot />
        </main>

        <Footer />
    </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import Footer from "@/Components/Footer_ersatz.vue";
import ApplicationLogo2 from "@/Components/ApplicationLogo2.vue";
</script>
