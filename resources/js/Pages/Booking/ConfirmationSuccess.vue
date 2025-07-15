<template>
    <div
        class="flex flex-col items-center justify-center min-h-screen px-4 py-20 transition-colors bg-gradient-to-br from-white via-teal-50 to-indigo-50 dark:from-gray-900 dark:via-slate-900 dark:to-black"
    >
        <div
            class="w-full max-w-lg px-8 py-10 shadow-2xl bg-white/95 dark:bg-gray-900/95 rounded-2xl ring-1 ring-teal-100/70 dark:ring-teal-900/70 animate-fade-in-up"
            aria-labelledby="buchung-bestaetigt-heading"
            role="status"
            tabindex="-1"
        >
            <div class="flex justify-center mb-6">
                <span
                    class="inline-flex items-center justify-center w-20 h-20 bg-teal-100 rounded-full shadow-inner dark:bg-teal-900"
                >
                    <svg
                        class="w-12 h-12 text-teal-600 dark:text-teal-400 animate-pulse"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 48 48"
                        stroke-width="3"
                        aria-hidden="true"
                    >
                        <circle cx="24" cy="24" r="22" stroke-width="2" />
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="3"
                            d="M16 25.5l6 6 10-13"
                        />
                    </svg>
                    <span class="sr-only">Buchung erfolgreich bestätigt</span>
                </span>
            </div>

            <h2
                id="buchung-bestaetigt-heading"
                class="mb-2 text-3xl font-extrabold text-center text-transparent md:text-4xl bg-clip-text bg-gradient-to-r from-teal-600 to-indigo-700 dark:from-teal-400 dark:to-indigo-300 drop-shadow-xl"
            >
                Buchung bestätigt
            </h2>

            <p
                class="mb-8 text-lg font-medium leading-relaxed text-center text-gray-700 md:text-xl dark:text-gray-200"
            >
                Vielen Dank für Ihr Vertrauen!<br />
                Ihr Termin wurde erfolgreich bestätigt.<br />
                Sie erhalten in Kürze eine E-Mail mit allen Details.<br />
                <span
                    class="block mt-2 text-base text-teal-700 dark:text-teal-400"
                >
                    Wir freuen uns auf das Gespräch.
                </span>
            </p>

            <div class="flex flex-col items-center gap-4">
                <Link
                    href="/"
                    class="inline-block px-8 py-3 text-lg font-semibold text-white transition shadow rounded-xl bg-gradient-to-r from-teal-500 to-indigo-700 hover:from-teal-600 hover:to-indigo-800 focus:outline-none focus-visible:ring-2 focus-visible:ring-teal-400"
                    aria-label="Zurück zur Startseite"
                >
                    Zurück zur Startseite
                </Link>
                <a
                    href="mailto:info@antasus.de"
                    class="inline-block px-5 py-2 text-sm font-medium text-teal-700 transition rounded-lg dark:text-teal-300 bg-teal-50 dark:bg-gray-800 hover:underline focus:outline-none focus-visible:ring-2 focus-visible:ring-teal-400"
                    aria-label="E-Mail an info@antasus.de"
                >
                    Kontakt: info@antasus.de
                </a>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
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
    animation: fade-in-up 0.6s cubic-bezier(0.33, 1, 0.68, 1) both;
}
</style>
