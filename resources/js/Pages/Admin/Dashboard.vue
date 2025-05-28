<template>
    <AdminLayout title="Dashboard">
        <div class="px-4 py-10 mx-auto space-y-10 max-w-7xl">
            <!-- Begrüßung -->
            <div
                class="flex flex-col justify-between gap-4 md:flex-row md:items-center"
            >
                <h1
                    class="text-3xl font-extrabold text-gray-900 dark:text-white"
                >
                    Willkommen im Admin-Dashboard
                </h1>
                <p class="text-sm text-gray-500 dark:text-gray-300">
                    Behalte den Überblick über Services, Referenzen & mehr
                </p>
            </div>

            <!-- Statistische Übersicht -->
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
                <SummaryCard
                    title="Services"
                    :value="stats.services"
                    icon="DocumentTextIcon"
                    color="teal"
                />
                <SummaryCard
                    title="Referenzen"
                    :value="stats.referenzen"
                    icon="ChartBarIcon"
                    color="indigo"
                />
                <SummaryCard
                    title="Nachrichten"
                    :value="stats.messages"
                    icon="EnvelopeIcon"
                    color="blue"
                />
                <SummaryCard
                    title="Kunden"
                    :value="stats.users"
                    icon="UsersIcon"
                    color="rose"
                />
            </div>
        </div>
    </AdminLayout>
</template>

<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import SummaryCard from "@/Components/Admin/SummaryCard.vue";

defineProps({
    stats: {
        type: Object,
        default: () => ({
            services: 0,
            referenzen: 0,
            messages: 0,
            users: 0,
        }),
    },
});
</script>
