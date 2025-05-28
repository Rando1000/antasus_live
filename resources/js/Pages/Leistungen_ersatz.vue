<template>
    <Head>
        <title>
            Glasfaser-Tiefbau & Hausanschlüsse | Subunternehmer für
            Generalunternehmen
        </title>
        <meta
            name="description"
            content="ANTASUS Infra ist Ihr zuverlässiger Subunternehmer für Glasfaser-Tiefbau, Hausanschlüsse und Projektabwicklung nach DIN/VDE – termintreu, normkonform und partnerschaftlich."
        />
        <meta
            name="keywords"
            content="Glasfaser Tiefbau, Hausanschlüsse, Subunternehmer, Generalunternehmen, DIN VDE, Glasfaserbau NRW, Partner Glasfaserprojekt"
        />

        <!-- Open Graph -->
        <meta
            property="og:title"
            content="Ihr Glasfaser-Partner für Tiefbau & Hausanschlüsse – ANTASUS Infra"
        />
        <meta
            property="og:description"
            content="Subunternehmer für Generalunternehmen: Planung, Bau & Dokumentation von Glasfaser-Infrastruktur."
        />
        <meta
            property="og:image"
            content="https://www.antasus.de/images/og-leistungen.webp"
        />
        <meta property="og:url" content="https://www.antasus.de/leistungen" />
        <meta property="og:type" content="website" />
    </Head>
    <GuestLayout :serviceArea="'dienstleistungen'">
        <template #header>
            <section>
                <div class="max-w-4xl px-4 mx-auto text-center">
                    <h1 class="mb-4 text-5xl font-extrabold text-white">
                        Unsere Leistungen
                    </h1>
                    <p class="text-xl text-white/90">
                        Glasfaser-Tiefbau, Projektplanung & Hausanschlüsse –
                        strukturiert nach Kategorien.
                    </p>
                </div>
            </section>
        </template>

        <section class="py-20 bg-white">
            <div class="max-w-6xl px-4 mx-auto space-y-16">
                <div
                    v-for="service in services"
                    :key="service.id"
                    class="space-y-6"
                >
                    <div class="p-6 shadow-md bg-gray-50 rounded-xl">
                        <h2 class="mb-2 text-3xl font-bold text-gray-800">
                            {{ service.title }}
                        </h2>
                        <p class="text-gray-600">{{ service.description }}</p>

                        <!-- Untergeordnete Items -->
                        <ul class="mt-6 space-y-3">
                            <li
                                v-for="item in service.items"
                                :key="item.id"
                                class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm"
                            >
                                <h3 class="text-lg font-semibold text-gray-800">
                                    {{ item.title }}
                                </h3>
                                <p class="text-sm text-gray-600">
                                    {{ item.description }}
                                </p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
    </GuestLayout>
</template>

<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import { Head } from "@inertiajs/vue3";

defineProps({
    services: Array,
});
</script>
