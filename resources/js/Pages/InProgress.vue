<template>
    <Head>
        <title>Seite im Aufbau | ANTASUS Infra</title>
        <meta
            name="description"
            content="Diese Seite wird gerade überarbeitet. Schau bald wieder vorbei!"
        />
        <meta name="robots" content="noindex, nofollow" />
    </Head>

    <GuestLayout :serviceArea="'default'">
        <div
            class="flex flex-col items-center justify-center min-h-screen px-4 bg-gradient-to-br from-gray-100 to-gray-200"
        >
            <div
                class="w-full max-w-md p-8 text-center bg-white shadow-2xl rounded-2xl animate-fade-in-up"
            >
                <!-- Wartungs-Icon -->
                <div
                    class="flex items-center justify-center w-24 h-24 mx-auto bg-teal-100 rounded-full"
                >
                    <svg
                        class="w-12 h-12 text-teal-600 animate-pulse"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="2"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"
                        />
                    </svg>
                </div>

                <h1 class="mt-6 text-3xl font-extrabold text-gray-900">
                    Seite in Wartung
                </h1>
                <p class="mt-4 leading-relaxed text-gray-600">
                    Wir arbeiten gerade an dieser Seite, damit sie bald in
                    gewohnter Qualität zur Verfügung steht. Bitte schaue später
                    nochmal vorbei.
                </p>

                <div class="mt-6">
                    <Link
                        href="/"
                        class="inline-block px-6 py-2 font-semibold text-white transition bg-teal-600 rounded-lg shadow hover:bg-teal-700"
                    >
                        Zur Startseite
                    </Link>
                </div>

                <p class="mt-6 text-sm text-gray-500">
                    Bei dringenden Fragen erreichst du uns unter
                    <a
                        href="mailto:info@antasus.de"
                        class="text-teal-600 hover:underline"
                        >info@antasus.de</a
                    >.
                </p>
            </div>
        </div>
    </GuestLayout>
</template>

<script setup>
import { Head, Link } from "@inertiajs/vue3";
import GuestLayout from "@/Layouts/GuestLayout.vue";
</script>

<style scoped>
@keyframes fade-in-up {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
.animate-fade-in-up {
    animation: fade-in-up 0.5s ease-out both;
}
</style>
