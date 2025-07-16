<template>
    <AdminLayout>
        <div class="p-6 space-y-8">
            <div
                class="flex flex-col gap-6 md:flex-row md:items-center md:justify-between"
            >
                <h1
                    class="text-3xl font-extrabold text-gray-900 dark:text-white"
                >
                    Terminbuchungen
                </h1>
                <!-- Schnelle Aktion, z.B. Export -->
                <button
                    class="flex items-center gap-2 px-4 py-2 text-sm font-medium text-white rounded-lg shadow bg-gradient-to-r from-teal-500 to-indigo-800 hover:from-teal-600 hover:to-indigo-900 focus:outline-none focus-visible:ring-2 focus-visible:ring-teal-400"
                    @click="exportCsv"
                    aria-label="Alle Buchungen als CSV exportieren"
                >
                    <svg
                        class="w-5 h-5"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M4 17v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 9l5 5 5-5M12 4v10"
                        />
                    </svg>
                    Export CSV
                </button>
            </div>

            <div
                class="sticky top-0 z-20 flex flex-wrap items-center gap-4 p-4 mb-4 bg-white border rounded-lg shadow-sm dark:bg-gray-900 dark:border-gray-800"
            >
                <input
                    type="text"
                    v-model="filters.search"
                    placeholder="Suche nach Name/E-Mail"
                    class="px-3 py-2 text-sm border rounded w-60 focus:ring-2 focus:ring-teal-400 dark:bg-gray-800 dark:text-white"
                    @keydown.enter="applyFilters"
                    aria-label="Suche"
                />
                <select
                    v-model="filters.status"
                    @change="applyFilters"
                    class="px-3 py-2 text-sm border rounded dark:bg-gray-800 dark:text-white"
                    aria-label="Status"
                >
                    <option value="">Alle Status</option>
                    <option value="neu">Neu</option>
                    <option value="bearbeitet">Bearbeitet</option>
                    <option value="abgesagt">Abgesagt</option>
                </select>
                <input
                    type="date"
                    v-model="filters.from"
                    class="px-3 py-2 text-sm border rounded dark:bg-gray-800 dark:text-white"
                    @change="applyFilters"
                    aria-label="Von (Datum)"
                />
                <input
                    type="date"
                    v-model="filters.to"
                    class="px-3 py-2 text-sm border rounded dark:bg-gray-800 dark:text-white"
                    @change="applyFilters"
                    aria-label="Bis (Datum)"
                />
                <select
                    v-model="filters.mode"
                    @change="applyFilters"
                    class="px-3 py-2 text-sm border rounded dark:bg-gray-800 dark:text-white"
                    aria-label="Meeting-Modus"
                >
                    <option value="">Alle Modi</option>
                    <option value="online">Online</option>
                    <option value="praesenz">Präsenz</option>
                </select>
                <button
                    @click="resetFilters"
                    class="px-3 py-2 text-xs font-semibold text-gray-500 bg-gray-100 border rounded hover:text-teal-700 dark:bg-gray-800 dark:text-gray-300"
                    aria-label="Filter zurücksetzen"
                >
                    Zurücksetzen
                </button>
            </div>

            <div
                class="overflow-x-auto bg-white shadow rounded-xl dark:bg-gray-900"
            >
                <table
                    class="min-w-full text-sm divide-y divide-gray-200 dark:divide-gray-700"
                >
                    <thead class="bg-gray-50 dark:bg-gray-800">
                        <tr>
                            <th
                                class="px-4 py-3 font-semibold text-left text-gray-600 uppercase"
                            >
                                Datum
                            </th>
                            <th
                                class="px-4 py-3 font-semibold text-left text-gray-600 uppercase"
                            >
                                Uhrzeit
                            </th>
                            <th
                                class="px-4 py-3 font-semibold text-left text-gray-600 uppercase"
                            >
                                Typ
                            </th>
                            <th
                                class="px-4 py-3 font-semibold text-left text-gray-600 uppercase"
                            >
                                Modus
                            </th>
                            <th
                                class="px-4 py-3 font-semibold text-left text-gray-600 uppercase"
                            >
                                Name
                            </th>
                            <th
                                class="px-4 py-3 font-semibold text-left text-gray-600 uppercase"
                            >
                                E-Mail
                            </th>
                            <th
                                class="px-4 py-3 font-semibold text-left text-gray-600 uppercase"
                            >
                                Thema
                            </th>
                            <th
                                class="px-4 py-3 font-semibold text-left text-gray-600 uppercase"
                            >
                                Status
                            </th>
                            <th
                                class="px-4 py-3 font-semibold text-left text-gray-600 uppercase"
                            ></th>
                        </tr>
                    </thead>
                    <tbody
                        class="divide-y divide-gray-100 dark:divide-gray-800"
                    >
                        <tr
                            v-for="booking in bookings.data"
                            :key="booking.id"
                            class="transition hover:bg-teal-50 dark:hover:bg-gray-800"
                        >
                            <td class="px-4 py-2 whitespace-nowrap">
                                {{ formatDate(booking.start) }}
                            </td>
                            <td class="px-4 py-2 whitespace-nowrap">
                                {{
                                    formatTimeRange(booking.start, booking.end)
                                }}
                            </td>
                            <td class="px-4 py-2 capitalize whitespace-nowrap">
                                {{ booking.type }}
                            </td>
                            <td class="px-4 py-2 capitalize whitespace-nowrap">
                                <span
                                    :class="
                                        booking.mode === 'online'
                                            ? 'bg-indigo-100 text-indigo-700'
                                            : 'bg-teal-100 text-teal-800'
                                    "
                                    class="px-2 py-1 rounded"
                                >
                                    {{ booking.mode ?? "–" }}
                                </span>
                            </td>
                            <td class="px-4 py-2 whitespace-nowrap">
                                {{ booking.name }}
                            </td>
                            <td class="px-4 py-2 whitespace-nowrap">
                                <a
                                    :href="`mailto:${booking.email}`"
                                    class="text-teal-700 hover:underline dark:text-teal-300"
                                    >{{ booking.email }}</a
                                >
                            </td>
                            <td class="px-4 py-2 whitespace-nowrap">
                                {{ booking.topic ?? "–" }}
                            </td>
                            <td class="px-4 py-2 whitespace-nowrap">
                                <select
                                    v-model="booking.status"
                                    @change="updateStatus(booking)"
                                    class="px-2 py-1 text-sm font-semibold border rounded focus:outline-none focus:ring-2 focus:ring-teal-400 dark:bg-gray-800"
                                    :class="{
                                        'bg-green-100 text-green-800':
                                            booking.status === 'bearbeitet',
                                        'bg-red-100 text-red-700':
                                            booking.status === 'abgesagt',
                                        'bg-yellow-100 text-yellow-700':
                                            booking.status === 'neu',
                                    }"
                                    aria-label="Status"
                                >
                                    <option value="neu">Neu</option>
                                    <option value="bearbeitet">
                                        Bearbeitet
                                    </option>
                                    <option value="abgesagt">Abgesagt</option>
                                </select>
                            </td>
                            <td class="px-4 py-2 whitespace-nowrap">
                                <button
                                    @click="deleteBooking(booking.id)"
                                    class="px-2 py-1 text-xs font-semibold text-red-700 rounded bg-red-50 hover:bg-red-100"
                                    aria-label="Buchung löschen"
                                >
                                    Löschen
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div
                    v-if="bookings.data.length === 0"
                    class="p-8 text-center text-gray-400 dark:text-gray-500"
                >
                    Keine Buchungen gefunden.
                </div>
            </div>
            <Pagination :links="bookings.links" />
        </div>
    </AdminLayout>
</template>

<script setup>
import { format } from "date-fns";
import Pagination from "@/Components/Pagination.vue";
import { router } from "@inertiajs/vue3";
import { reactive } from "vue";
import AdminLayout from "@/Layouts/AdminLayout.vue";

const props = defineProps({ bookings: Object, filters: Object });

const filters = reactive({
    search: props.filters.search || "",
    status: props.filters.status || "",
    from: props.filters.from || "",
    to: props.filters.to || "",
    mode: props.filters.mode || "",
});

function applyFilters() {
    router.get(route("admin.bookings.index"), filters, {
        preserveScroll: true,
        replace: true,
    });
}
function resetFilters() {
    filters.search = "";
    filters.status = "";
    filters.from = "";
    filters.to = "";
    filters.mode = "";
    applyFilters();
}

function formatDate(date) {
    return format(new Date(date), "dd.MM.yyyy");
}
function formatTimeRange(start, end) {
    return (
        format(new Date(start), "HH:mm") +
        " – " +
        format(new Date(end), "HH:mm")
    );
}
function updateStatus(booking) {
    router.put(
        `/admin/bookings/${booking.id}/status`,
        { status: booking.status },
        { preserveScroll: true }
    );
}
function deleteBooking(id) {
    if (confirm("Buchung wirklich löschen?")) {
        router.delete(`/admin/bookings/${id}`, { preserveScroll: true });
    }
}
function exportCsv() {
    window.open(route("admin.bookings.export"), "_blank");
}
</script>
