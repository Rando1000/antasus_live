<template>
    <AdminLayout title="Referenzen verwalten">
        <section class="py-10 bg-gray-50 dark:bg-slate-900 min-h-[80vh]">
            <div class="px-4 mx-auto max-w-7xl">
                <div
                    class="flex flex-col gap-4 mb-6 md:flex-row md:items-center md:justify-between"
                >
                    <h1
                        class="text-2xl font-bold tracking-tight text-gray-800 dark:text-white"
                    >
                        Referenzen
                    </h1>
                    <div class="flex flex-wrap gap-2">
                        <NavLink
                            :href="route('admin.services.index')"
                            :active="route().current('admin.services.index')"
                            class="px-3 py-2 text-sm font-medium text-gray-700 transition-colors rounded-md dark:text-gray-200 hover:text-teal-600 dark:hover:text-teal-400"
                        >
                            Services
                        </NavLink>
                        <Link
                            href="/admin/referenzen/create"
                            class="inline-flex items-center px-4 py-2 font-semibold text-white transition rounded shadow bg-gradient-to-r from-teal-600 to-indigo-700 hover:from-teal-700 hover:to-indigo-800 focus:outline-none focus:ring-2 focus:ring-teal-400"
                        >
                            <span aria-hidden="true" class="mr-2 text-xl"
                                >+</span
                            >
                            Neue Referenz
                        </Link>
                    </div>
                </div>

                <div
                    class="overflow-x-auto bg-white rounded-lg shadow dark:bg-slate-800 ring-1 ring-slate-200/80 dark:ring-slate-700"
                >
                    <table
                        class="min-w-full text-left border-collapse table-auto"
                    >
                        <thead>
                            <tr>
                                <th
                                    scope="col"
                                    class="px-6 py-4 text-xs font-semibold tracking-wide text-gray-500 uppercase bg-gray-100 dark:text-gray-300 dark:bg-slate-700"
                                >
                                    Titel
                                </th>
                                <th
                                    scope="col"
                                    class="px-6 py-4 text-xs font-semibold tracking-wide text-gray-500 uppercase bg-gray-100 dark:text-gray-300 dark:bg-slate-700"
                                >
                                    Ort
                                </th>
                                <th
                                    scope="col"
                                    class="px-6 py-4 text-xs font-semibold tracking-wide text-gray-500 uppercase bg-gray-100 dark:text-gray-300 dark:bg-slate-700"
                                >
                                    Bild
                                </th>
                                <th
                                    scope="col"
                                    class="px-6 py-4 text-xs font-semibold tracking-wide text-gray-500 uppercase bg-gray-100 dark:text-gray-300 dark:bg-slate-700"
                                >
                                    Aktionen
                                </th>
                            </tr>
                        </thead>
                        <tbody
                            class="divide-y divide-gray-200 dark:divide-slate-700"
                        >
                            <tr
                                v-for="ref in referenzen"
                                :key="ref.id"
                                class="transition hover:bg-teal-50 dark:hover:bg-slate-900"
                            >
                                <td
                                    class="px-6 py-4 text-sm font-medium text-gray-800 dark:text-gray-200"
                                >
                                    {{ ref.titel }}
                                </td>
                                <td
                                    class="px-6 py-4 text-sm text-gray-600 dark:text-gray-300"
                                >
                                    {{ ref.ort }}
                                </td>
                                <td class="px-6 py-4">
                                    <img
                                        :src="ref.image"
                                        :alt="`Bild zur Referenz: ${ref.titel}`"
                                        class="object-cover h-16 border rounded-md shadow w-28 border-slate-200 dark:border-slate-700"
                                        loading="lazy"
                                    />
                                </td>
                                <td
                                    class="flex flex-row items-center gap-2 px-6 py-4"
                                >
                                    <Link
                                        class="inline-block text-sm font-medium text-teal-700 rounded dark:text-teal-300 hover:underline focus:outline-none focus:ring-2 focus:ring-teal-400"
                                        :href="`/admin/referenzen/${ref.id}/edit`"
                                        aria-label="Referenz bearbeiten"
                                    >
                                        Bearbeiten
                                    </Link>
                                    <button
                                        class="inline-block text-sm font-medium text-red-600 rounded dark:text-red-400 hover:underline focus:outline-none focus:ring-2 focus:ring-red-300"
                                        @click="deleteReferenz(ref.id)"
                                        aria-label="Referenz löschen"
                                        type="button"
                                    >
                                        Löschen
                                    </button>
                                </td>
                            </tr>
                            <tr v-if="referenzen.length === 0">
                                <td
                                    colspan="4"
                                    class="px-6 py-8 text-sm text-center text-gray-400 dark:text-gray-500"
                                >
                                    Keine Referenzen vorhanden.
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </AdminLayout>
</template>

<script setup>
import NavLink from "@/Components/NavLink.vue";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { Link } from "@inertiajs/vue3";
import { ref } from "vue";

// Demo-Daten (im echten Projekt per Prop oder API)
const referenzen = ref([
    {
        id: 1,
        titel: "FTTH-Ausbau Amsterdam",
        ort: "Amsterdam",
        image: "/images/Amsterdam.jpeg",
    },
    {
        id: 2,
        titel: "Gewerbegebiet Amsterdam",
        ort: "Amsterdam",
        image: "/images/Amsterdam2.jpeg",
    },
    {
        id: 3,
        titel: "Netzmodernisierung Den Haag",
        ort: "Den Haag",
        image: "/images/Denhaag.jpeg",
    },
]);

// Platzhalter-Funktion für das Löschen
function deleteReferenz(id) {
    // Hier kann z.B. eine Modal-Confirmation und ein Inertia-Delete-Request stehen
    if (confirm("Soll diese Referenz wirklich gelöscht werden?")) {
        // z. B. Inertia.delete(`/admin/referenzen/${id}`)
        // Demo: Aus Liste entfernen
        referenzen.value = referenzen.value.filter((ref) => ref.id !== id);
    }
}
</script>

<style scoped>
/* Minimal, alles via Tailwind gelöst */
</style>
