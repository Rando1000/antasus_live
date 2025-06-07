<template>
    <AdminLayout title="Referenzen verwalten">
        <section class="py-10 bg-gray-50">
            <div class="px-4 mx-auto max-w-7xl">
                <div class="flex items-center justify-between mb-6">
                    <h1 class="text-2xl font-bold text-gray-800">Referenzen</h1>
                    <NavLink
                        :href="route('admin.services.index')"
                        :active="route().current('admin.services.index')"
                    >
                        Services
                    </NavLink>
                    <Link
                        href="/admin/referenzen/create"
                        class="px-4 py-2 font-semibold text-white bg-teal-600 rounded hover:bg-teal-700"
                    >
                        + Neue Referenz
                    </Link>
                </div>

                <div class="overflow-x-auto bg-white rounded-lg shadow">
                    <table class="min-w-full table-auto">
                        <thead
                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase bg-gray-100"
                        >
                            <tr>
                                <th class="px-6 py-4">Titel</th>
                                <th class="px-6 py-4">Ort</th>
                                <th class="px-6 py-4">Bild</th>
                                <th class="px-6 py-4">Aktionen</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr v-for="ref in referenzen" :key="ref.id">
                                <td class="px-6 py-4 text-sm text-gray-800">
                                    {{ ref.titel }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    {{ ref.ort }}
                                </td>
                                <td class="px-6 py-4">
                                    <img
                                        :src="ref.image"
                                        class="object-cover w-24 h-16 rounded-md shadow"
                                    />
                                </td>
                                <td class="px-6 py-4 space-x-2">
                                    <Link
                                        class="text-sm font-medium text-blue-600 hover:underline"
                                        :href="`/admin/referenzen/${ref.id}/edit`"
                                    >
                                        Bearbeiten
                                    </Link>
                                    <button
                                        class="text-sm font-medium text-red-600 hover:underline"
                                    >
                                        Löschen
                                    </button>
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

const referenzen = [
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
];
</script>

<style scoped></style>
