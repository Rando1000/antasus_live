<template>
    <AdminLayout title="Dashboard">
        <div class="px-4 py-10 mx-auto max-w-7xl space-y-14">
            <!-- Begrüßung und Schnellzugriff -->
            <div
                class="flex flex-col gap-6 mb-8 md:flex-row md:items-center md:justify-between"
            >
                <div>
                    <h1
                        class="mb-2 text-4xl font-extrabold tracking-tight md:text-5xl text-antasus-black dark:text-white"
                    >
                        Willkommen im Admin-Dashboard
                    </h1>
                    <p
                        class="text-base font-medium text-gray-600 dark:text-gray-300"
                    >
                        Ihre zentrale Steuerzentrale für alle Aktivitäten und
                        Auswertungen bei
                        <span class="font-bold text-teal-600"
                            >ANTASUS Infra</span
                        >.
                    </p>
                </div>
                <div class="flex gap-3">
                    <Link
                        href="/admin/services"
                        class="px-5 py-2 text-sm font-semibold text-white transition bg-teal-600 rounded-lg shadow hover:bg-teal-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-teal-300"
                        aria-label="Services verwalten"
                    >
                        Services verwalten
                    </Link>
                    <Link
                        href="/admin/referenzen"
                        class="px-5 py-2 text-sm font-semibold text-white transition bg-indigo-600 rounded-lg shadow hover:bg-indigo-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-indigo-300"
                        aria-label="Referenzen verwalten"
                    >
                        Referenzen verwalten
                    </Link>
                    <Link
                        href="/admin/messages"
                        class="px-5 py-2 text-sm font-semibold text-white transition bg-blue-600 rounded-lg shadow hover:bg-blue-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-300"
                        aria-label="Nachrichten verwalten"
                    >
                        Nachrichten
                    </Link>
                </div>
            </div>

            <!-- Statistische Übersicht (Cards & Buchungen) -->
            <div class="grid gap-8 lg:grid-cols-5 sm:grid-cols-2">
                <!-- Neue Buchungen -->
                <div
                    class="flex flex-col justify-between col-span-2 bg-white border border-teal-100 shadow-lg dark:bg-gray-900 rounded-2xl p-7 dark:border-teal-900/30 animate-fade-in-up"
                >
                    <h2
                        class="mb-3 text-lg font-bold text-teal-700 dark:text-teal-400"
                    >
                        Neue Buchungen
                    </h2>
                    <div
                        v-if="!stats.newBookings?.length"
                        class="pb-8 text-base text-gray-400"
                    >
                        Keine neuen Buchungen
                    </div>
                    <ul
                        v-else
                        class="mb-3 divide-y divide-teal-50 dark:divide-teal-900/10"
                    >
                        <li
                            v-for="booking in stats.newBookings"
                            :key="booking.id"
                            class="flex items-center justify-between py-2 group"
                        >
                            <span>
                                <span
                                    class="font-semibold text-gray-800 dark:text-gray-100"
                                    >{{ booking.name }}</span
                                >
                                <span class="ml-2 text-gray-500"
                                    >({{ formatDate(booking.start) }})</span
                                >
                            </span>
                            <Link
                                :href="route('admin.bookings.index')"
                                class="text-sm font-medium text-teal-600 hover:underline focus:outline-none"
                                aria-label="Zur Buchungsübersicht"
                            >
                                Verwalten
                            </Link>
                        </li>
                    </ul>
                    <div class="pt-2 text-xs text-gray-500">
                        Insgesamt <b>{{ stats.newBookingCount }}</b> neue
                        Buchung(en)
                    </div>
                </div>
                <!-- Cards: Services, Referenzen, Nachrichten, Kunden -->
                <SummaryCard
                    class="col-span-1"
                    title="Services"
                    :value="stats.services"
                    icon="DocumentTextIcon"
                    color="teal"
                />
                <SummaryCard
                    class="col-span-1"
                    title="Referenzen"
                    :value="stats.referenzen"
                    icon="ChartBarIcon"
                    color="indigo"
                />
                <SummaryCard
                    class="col-span-1"
                    title="Nachrichten"
                    :value="stats.messages"
                    icon="EnvelopeIcon"
                    color="blue"
                />
                <SummaryCard
                    class="col-span-1"
                    title="Kunden"
                    :value="stats.users"
                    icon="UsersIcon"
                    color="rose"
                />
                <SummaryCard
                    class="col-span-1"
                    title="Live-Besucher"
                    :value="liveVisitors"
                    icon="EyeIcon"
                    color="emerald"
                />
                <ActiveVisitorsWidget class="col-span-2" />
            </div>
            <!-- Online-Benutzer -->
            <section aria-labelledby="online-user-heading" class="mt-14">
                <h2
                    id="online-user-heading"
                    class="mb-4 text-2xl font-bold text-gray-800 dark:text-white"
                >
                    Online-Benutzer
                </h2>
                <ul
                    v-if="onlineUsers && onlineUsers.length"
                    class="flex flex-wrap gap-3"
                >
                    <li
                        v-for="u in onlineUsers"
                        :key="u.id"
                        class="px-3 py-2 text-sm font-medium text-teal-700 shadow rounded-xl bg-teal-50 dark:bg-teal-900/40 dark:text-teal-200"
                        :title="u.email"
                    >
                        {{ u.name }}
                        <span class="text-gray-400">({{ u.email }})</span>
                    </li>
                </ul>
                <div v-else class="pl-1 text-gray-400">
                    Keine Benutzer online
                </div>
            </section>

            <!-- Eingeloggt (ever) -->
            <section aria-labelledby="loggedin-user-heading" class="mt-10">
                <h2
                    id="loggedin-user-heading"
                    class="mb-4 text-2xl font-bold text-gray-800 dark:text-white"
                >
                    Eingeloggt (ever)
                </h2>
                <ul
                    v-if="loggedInUsers && loggedInUsers.length"
                    class="space-y-1"
                >
                    <li v-for="u in loggedInUsers" :key="u.id">
                        <span
                            class="font-medium text-gray-900 dark:text-gray-100"
                            >{{ u.name }}</span
                        >
                        <span class="text-gray-500">
                            — zuletzt eingeloggt am
                            {{ formatDate(u.last_activity) }}
                        </span>
                    </li>
                </ul>
                <div v-else class="pl-1 text-gray-400">Keine Einträge</div>
            </section>

            <!-- Benutzer mit Rolle -->
            <section aria-labelledby="users-with-role-heading" class="mt-10">
                <h2
                    id="users-with-role-heading"
                    class="mb-4 text-2xl font-bold text-gray-800 dark:text-white"
                >
                    Benutzer mit Rolle
                </h2>
                <div
                    class="overflow-auto bg-white border border-gray-100 rounded-lg shadow-lg dark:border-gray-800 dark:bg-gray-900"
                >
                    <table class="min-w-full text-sm">
                        <thead class="bg-teal-50 dark:bg-teal-950/40">
                            <tr>
                                <th class="px-4 py-3 font-semibold text-left">
                                    Name
                                </th>
                                <th class="px-4 py-3 font-semibold text-left">
                                    E-Mail
                                </th>
                                <th class="px-4 py-3 font-semibold text-left">
                                    Rollen
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                v-for="u in usersWithRoles"
                                :key="u.id"
                                class="transition hover:bg-gray-50 dark:hover:bg-gray-800"
                            >
                                <td class="px-4 py-2">{{ u.name }}</td>
                                <td class="px-4 py-2">{{ u.email }}</td>
                                <td class="px-4 py-2">
                                    {{ u.roles.map((r) => r.name).join(", ") }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div
                    v-if="!usersWithRoles || !usersWithRoles.length"
                    class="mt-2 text-gray-400"
                >
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
import { ref, onMounted } from "vue";
import ActiveVisitorsWidget from "@/Components/ActiveVisitorsWidget.vue";

const liveVisitors = ref(0);

function fetchLiveVisitors() {
    fetch("/active-visitors")
        .then((r) => r.json())
        .then((data) => {
            liveVisitors.value = data.count;
        })
        .catch(() => {
            liveVisitors.value = 0;
        });
}

onMounted(() => {
    fetchLiveVisitors();
    setInterval(fetchLiveVisitors, 7500);
});
const activeVisitors = ref(0);
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
            liveVisitors: 0,
        }),
    },
    activeVisitors: Object,
    onlineUsers: Array,
    usersWithRoles: Array,
    loggedInUsers: Array,
});

function formatDate(date) {
    if (!date) return "-";
    return format(new Date(date), "dd.MM.yyyy");
}
</script>

<style scoped>
@keyframes fade-in-up {
    from {
        opacity: 0;
        transform: translateY(24px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
.animate-fade-in-up {
    animation: fade-in-up 0.7s cubic-bezier(0.33, 1, 0.68, 1) both;
}
</style>
