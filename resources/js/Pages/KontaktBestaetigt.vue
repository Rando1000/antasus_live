<!-- resources/js/Pages/KontaktBestaetigt.vue -->
<template>
    <GuestLayout title="Vielen Dank">
        <section class="py-32 text-center bg-white">
            <div class="max-w-2xl px-4 mx-auto">
                <h1 class="mb-6 text-4xl font-extrabold text-teal-600">
                    Vielen Dank!
                </h1>
                <p class="mb-8 text-lg text-gray-700">
                    Ihre Nachricht wurde erfolgreich übermittelt.<br />
                    Wir melden uns so schnell wie möglich bei Ihnen.
                </p>
                <Link
                    href="/"
                    class="inline-block px-6 py-3 font-medium text-white transition bg-teal-600 rounded-lg hover:bg-teal-700"
                >
                    Zurück zur Startseite
                </Link>
            </div>
        </section>
    </GuestLayout>
</template>

<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import { Link } from "@inertiajs/vue3";
</script>
