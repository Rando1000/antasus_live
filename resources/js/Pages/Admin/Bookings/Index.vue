<template>
    <div class="p-6 space-y-6">
        <h1 class="text-2xl font-bold">Terminbuchungen</h1>

        <div class="flex items-center gap-4 mb-4">
            <input
                type="text"
                v-model="filters.search"
                placeholder="Suche nach Name oder E-Mail"
                class="w-64 px-3 py-2 border rounded"
                @keydown.enter="applyFilters"
            />
            <select
                v-model="filters.status"
                @change="applyFilters"
                class="py-2 border rounded"
            >
                <option value="">Alle Status</option>
                <option value="neu">Neu</option>
                <option value="bearbeitet">Bearbeitet</option>
                <option value="abgesagt">Abgesagt</option>
            </select>

            <input
                type="date"
                v-model="filters.from"
                class="px-3 py-2 border rounded"
                @change="applyFilters"
            />
            <input
                type="date"
                v-model="filters.to"
                class="px-3 py-2 border rounded"
                @change="applyFilters"
            />
            <select
                v-model="filters.mode"
                @change="applyFilters"
                class="py-2 border rounded"
            >
                <option value="">Alle Modi</option>
                <option value="online">Online</option>
                <option value="praesenz">Präsenz</option>
            </select>
            <button
                @click="resetFilters"
                class="text-sm text-gray-500 hover:underline"
            >
                Zurücksetzen
            </button>
        </div>

        <div
            class="overflow-x-auto bg-white shadow dark:bg-gray-900 rounded-xl"
        >
            <table
                class="min-w-full divide-y divide-gray-200 dark:divide-gray-700"
            >
                <thead class="bg-gray-50 dark:bg-gray-800">
                    <tr>
                        <th
                            class="px-4 py-3 text-xs font-medium text-left text-gray-500 uppercase"
                        >
                            Datum
                        </th>
                        <th
                            class="px-4 py-3 text-xs font-medium text-left text-gray-500 uppercase"
                        >
                            Uhrzeit
                        </th>
                        <th
                            class="px-4 py-3 text-xs font-medium text-left text-gray-500 uppercase"
                        >
                            Typ
                        </th>
                        <th
                            class="px-4 py-3 text-xs font-medium text-left text-gray-500 uppercase"
                        >
                            Meeting-Mode
                        </th>
                        <th
                            class="px-4 py-3 text-xs font-medium text-left text-gray-500 uppercase"
                        >
                            Name
                        </th>
                        <th
                            class="px-4 py-3 text-xs font-medium text-left text-gray-500 uppercase"
                        >
                            E-Mail
                        </th>
                        <th
                            class="px-4 py-3 text-xs font-medium text-left text-gray-500 uppercase"
                        >
                            Thema
                        </th>
                    </tr>
                </thead>
                <tbody
                    class="bg-white divide-y divide-gray-200 dark:bg-gray-900 dark:divide-gray-800"
                >
                    <tr v-for="booking in bookings.data" :key="booking.id">
                        <td class="px-4 py-2">
                            {{ formatDate(booking.start) }}
                        </td>
                        <td class="px-4 py-2">
                            {{ formatTimeRange(booking.start, booking.end) }}
                        </td>
                        <td class="px-4 py-2 capitalize">{{ booking.type }}</td>
                        <td class="px-4 py-2 capitalize">
                            {{ booking.mode ?? "–" }}
                        </td>
                        <td class="px-4 py-2">{{ booking.name }}</td>
                        <td class="px-4 py-2">{{ booking.email }}</td>
                        <td class="px-4 py-2">{{ booking.topic ?? "–" }}</td>
                        <td class="px-4 py-2">
                            <select
                                v-model="booking.status"
                                @change="updateStatus(booking)"
                                class="px-2 py-1 text-sm bg-white border rounded dark:bg-gray-800"
                            >
                                <option value="neu">Neu</option>
                                <option value="bearbeitet">Bearbeitet</option>
                                <option value="abgesagt">Abgesagt</option>
                            </select>
                        </td>
                        <td class="px-4 py-2">
                            <button
                                @click="deleteBooking(booking.id)"
                                class="text-red-600 hover:underline"
                            >
                                Löschen
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <Pagination :links="bookings.links" />
    </div>
</template>

<script setup>
import { format } from "date-fns";
import Pagination from "@/Components/Pagination.vue";
import { router } from "@inertiajs/vue3";
import { reactive } from "vue";

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
        {
            status: booking.status,
        },
        { preserveScroll: true }
    );
}

function deleteBooking(id) {
    if (confirm("Buchung wirklich löschen?")) {
        router.delete(`/admin/bookings/${id}`, { preserveScroll: true });
    }
}
</script>
