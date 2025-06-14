<template>
    <div class="p-6 space-y-6">
        <h1 class="text-2xl font-bold">Terminbuchungen</h1>

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
                        <td class="px-4 py-2">{{ booking.name }}</td>
                        <td class="px-4 py-2">{{ booking.email }}</td>
                        <td class="px-4 py-2">{{ booking.topic ?? "–" }}</td>
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
defineProps({ bookings: Object });

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
</script>
