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
            <!-- 1) Online-Benutzer -->
            <section>
                <h2 class="text-2xl font-semibold">Online-Benutzer</h2>
                <ul v-if="onlineUsers" class="mt-2 space-y-1">
                    <li v-for="u in onlineUsers" :key="u.id">
                        {{ u.name }} ({{ u.email }})
                    </li>
                </ul>
                <div v-else class="text-gray-500">Keine Benutzer online</div>
            </section>

            <!-- 2) Eingeloggt (ever) -->
            <section>
                <h2 class="text-2xl font-semibold">Eingeloggt (ever)</h2>
                <ul v-if="loggedInUsers" class="mt-2 space-y-1">
                    <li v-for="u in loggedInUsers" :key="u.id">
                        {{ u.name }}
                        — zuletzt eingeloggt am
                        {{ formatDate(u.last_activity) }}
                    </li>
                </ul>
                <div v-else class="text-gray-500">Keine Einträge</div>
            </section>

            <!-- 3) Alle mit Rolle -->
            <section>
                <h2 class="text-2xl font-semibold">Benutzer mit Rolle</h2>
                <table class="w-full mt-2 border-collapse table-auto">
                    <thead>
                        <tr>
                            <th class="px-2 py-1 text-left border">Name</th>
                            <th class="px-2 py-1 text-left border">E-Mail</th>
                            <th class="px-2 py-1 text-left border">Rollen</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="u in usersWithRoles" :key="u.id">
                            <td class="px-2 py-1 border">{{ u.name }}</td>
                            <td class="px-2 py-1 border">{{ u.email }}</td>
                            <td class="px-2 py-1 border">
                                {{ u.roles.map((r) => r.name).join(", ") }}
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div v-if="!usersWithRoles" class="mt-2 text-gray-500">
                    Keine Benutzer mit Rolle
                </div>
            </section>
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
    onlineUsers: Array,
    usersWithRoles: Array,
    loggedInUsers: Array,
});

function formatDate(date) {
    return format(new Date(date), "dd.MM.yyyy");
}
</script>
