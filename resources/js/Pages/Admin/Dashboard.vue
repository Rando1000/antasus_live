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
            </div>

            <!-- Statistische Übersicht -->
            <div class="flex gap-6 sm:grid-cols-2 lg:grid-cols-4">
                <div
                    class="p-6 space-y-4 bg-white rounded-lg shadow dark:bg-gray-900"
                >
                    <h2 class="text-xl font-semibold">Neue Buchungen</h2>

                    <div
                        v-if="stats.newBookings.length === 0"
                        class="text-gray-500"
                    >
                        Keine neuen Buchungen
                    </div>

                    <ul v-else>
                        <li
                            v-for="booking in stats.newBookings"
                            :key="booking.id"
                            class="flex justify-between py-2 border-b"
                        >
                            <span>
                                {{ booking.name }} ({{
                                    formatDate(booking.start)
                                }})
                            </span>
                            <Link
                                :href="route('admin.bookings.index')"
                                class="text-teal-600 hover:underline"
                            >
                                Verwalten
                            </Link>
                        </li>
                    </ul>

                    <div class="text-sm text-gray-600">
                        Insgesamt {{ stats.newBookingCount }} neue Buchung(en)
                    </div>
                </div>
                <div
                    class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4"
                >
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
        </div>
    </AdminLayout>
</template>

<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import SummaryCard from "@/Components/Admin/SummaryCard.vue";
import { Link } from "@inertiajs/vue3";
import { format } from "date-fns";

const props = defineProps({
    stats: {
        type: Object,
        default: () => ({
            services: 0,
            referenzen: 0,
            messages: 0,
            users: 0,
            newBookings: [],
            newBookingCount: 0,
        }),
    },
});

function formatDate(date) {
    return format(new Date(date), "dd.MM.yyyy");
}
</script>
