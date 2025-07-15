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
        <main
            class="flex flex-col items-center justify-center min-h-screen px-4 py-16 bg-gradient-to-br from-gray-100 via-white to-teal-50 dark:from-[#14181b] dark:via-[#22292f] dark:to-[#14312b]"
            role="main"
            aria-label="Seite im Aufbau"
        >
            <section
                class="w-full max-w-md p-8 mx-auto text-center shadow-2xl rounded-2xl bg-white/90 dark:bg-[#181d27]/95 backdrop-blur-lg border border-gray-100 dark:border-gray-800 animate-fade-in-up focus-within:ring-4 focus-within:ring-teal-400"
                tabindex="-1"
                aria-live="polite"
            >
                <!-- Wartungs-Icon mit Glow/Pulse -->
                <div
                    class="flex items-center justify-center w-24 h-24 mx-auto bg-teal-100 dark:bg-[#132f28] rounded-full shadow-inner mb-2 relative"
                    aria-hidden="true"
                >
                    <svg
                        class="text-teal-600 w-14 h-14 dark:text-teal-400 animate-pulse-glow"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="2"
                        aria-hidden="true"
                    >
                        <title>Wartung läuft</title>
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"
                        />
                    </svg>
                    <span
                        class="absolute w-20 h-20 rounded-full -z-10 bg-teal-400/10 blur-2xl animate-soft-glow"
                    ></span>
                </div>

                <h1
                    class="mt-4 text-3xl font-extrabold tracking-tight text-gray-900 dark:text-white"
                >
                    Seite im Aufbau
                </h1>
                <p
                    class="mt-4 leading-relaxed text-gray-700 dark:text-gray-200"
                >
                    Wir arbeiten gerade an dieser Seite, damit sie Ihnen bald in
                    gewohnter Qualität zur Verfügung steht.
                    <br class="hidden sm:inline" />
                    Bitte schauen Sie später noch einmal vorbei.
                </p>

                <div class="mt-8">
                    <Link
                        href="/"
                        class="inline-block px-6 py-2 font-semibold text-white bg-gradient-to-br from-teal-400 to-indigo-700 rounded-lg shadow-lg focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-teal-400 transition hover:from-teal-500 hover:to-indigo-900 hover:-translate-y-0.5"
                        aria-label="Zur Startseite zurückkehren"
                    >
                        Zur Startseite
                    </Link>
                </div>

                <p class="text-sm text-gray-500 mt-7 dark:text-gray-400">
                    Bei dringenden Fragen erreichen Sie uns jederzeit unter
                    <a
                        href="mailto:info@antasus.de"
                        class="font-semibold text-teal-600 underline underline-offset-4 hover:text-indigo-700 dark:text-teal-300 dark:hover:text-indigo-300 focus:outline-none focus-visible:ring-2 focus-visible:ring-teal-400"
                        aria-label="E-Mail an ANTASUS Infra"
                    >
                        info@antasus.de
                    </a>
                    .
                </p>
            </section>
        </main>
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
        transform: translateY(32px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
.animate-fade-in-up {
    animation: fade-in-up 0.55s cubic-bezier(0.37, 1.13, 0.39, 1) both;
}
@keyframes soft-glow {
    0% {
        opacity: 0.15;
        box-shadow: 0 0 0 0 #00fdcf88;
    }
    60% {
        opacity: 0.5;
        box-shadow: 0 0 36px 8px #00fdcf44;
    }
    100% {
        opacity: 0.15;
        box-shadow: 0 0 0 0 #00fdcf88;
    }
}
.animate-soft-glow {
    animation: soft-glow 2.2s ease-in-out infinite;
}
@keyframes pulse-glow {
    0% {
        filter: drop-shadow(0 0 0 #00fdcf70);
    }
    50% {
        filter: drop-shadow(0 0 20px #00fdcf90);
    }
    100% {
        filter: drop-shadow(0 0 0 #00fdcf70);
    }
}
.animate-pulse-glow {
    animation: pulse-glow 1.6s cubic-bezier(0.44, 0.09, 0.67, 0.77) infinite;
}
:focus-visible {
    outline: 2px solid #00fdcf !important;
    outline-offset: 3px;
}
</style>
