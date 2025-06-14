<template>
    <div
        class="flex flex-col items-center justify-center min-h-screen px-4 py-12 bg-gray-50"
    >
        <div class="w-full max-w-md p-6 bg-white rounded-lg shadow-lg">
            <div class="flex justify-center mb-4">
                <svg
                    class="w-16 h-16 text-teal-600"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.5"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M9 12l2 2 4-4m5 2a9 9 0 11-18 0 9 9 0 0118 0z"
                    />
                </svg>
            </div>

            <h2 class="mb-2 text-2xl font-bold text-center text-gray-800">
                Buchung bestätigt
            </h2>

            <p class="mb-6 text-sm text-center text-gray-600">
                Vielen Dank! Dein Termin wurde erfolgreich bestätigt. Du
                erhältst in Kürze eine E-Mail mit allen Details.
            </p>

            <div class="flex justify-center">
                <Link
                    href="/"
                    class="inline-block px-6 py-2 text-white transition rounded bg-gradient-to-r from-teal-600 to-black hover:shadow-lg"
                >
                    Zurück zur Startseite
                </Link>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
</script>
