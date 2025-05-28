<template>
    <AdminLayout :title="`Items zu ${service.title}`">
        <div class="max-w-6xl px-4 py-10 mx-auto">
            <div class="flex items-center justify-between mb-6">
                <h1 class="text-2xl font-bold">Service Items</h1>
                <Link
                    :href="route('admin.services.items.create', service.id)"
                    class="px-4 py-2 text-sm font-semibold text-white bg-teal-600 rounded hover:bg-teal-700"
                >
                    + Neues Item
                </Link>
            </div>

            <div class="overflow-x-auto bg-white border rounded shadow">
                <table class="min-w-full table-auto">
                    <thead class="bg-gray-100">
                        <tr class="text-left">
                            <th class="px-4 py-3">Titel</th>
                            <th class="px-4 py-3">Slug</th>
                            <th class="px-4 py-3">Position</th>
                            <th class="px-4 py-3">Bild</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3">Aktionen</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="item in items"
                            :key="item.id"
                            class="border-t hover:bg-gray-50"
                        >
                            <td class="px-4 py-3 font-medium text-gray-800">
                                {{ item.title }}
                            </td>
                            <td class="px-4 py-3 text-gray-600">
                                {{ item.slug }}
                            </td>
                            <td class="px-4 py-3 text-gray-600">
                                {{ item.position }}
                            </td>
                            <td class="px-4 py-3 text-gray-600">
                                <img
                                    :src="
                                        item.image_url ||
                                        '/images/Items_Glasfaser_Tiefbau.avif'
                                    "
                                    alt="Hintergrund für Leistung"
                                    loading="lazy"
                                    class="relative inset-0 w-auto h-20 rounded-md"
                                />
                            </td>
                            <td class="px-4 py-3">
                                <span
                                    class="inline-block px-3 py-1 text-xs font-medium rounded-full"
                                    :class="
                                        item.is_active
                                            ? 'bg-green-100 text-green-700'
                                            : 'bg-red-100 text-red-700'
                                    "
                                >
                                    {{ item.is_active ? "Aktiv" : "Inaktiv" }}
                                </span>
                            </td>
                            <td class="px-4 py-3 space-x-2">
                                <Link
                                    :href="
                                        route('admin.services.items.edit', [
                                            service.id,
                                            item.id,
                                        ])
                                    "
                                    class="text-sm text-teal-600 hover:underline"
                                >
                                    Bearbeiten
                                </Link>
                                <button
                                    @click="destroy(item.id)"
                                    class="text-sm text-red-600 hover:underline"
                                >
                                    Löschen
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <div
                    v-if="items.length === 0"
                    class="p-6 text-center text-gray-500"
                >
                    Keine Items vorhanden.
                </div>
            </div>
        </div>
    </AdminLayout>
</template>

<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { Link, router } from "@inertiajs/vue3";

const props = defineProps({
    service: Object,
    items: Array,
});

function destroy(id) {
    if (confirm("Wirklich löschen?")) {
        router.delete(
            route("admin.services.items.destroy", [props.service.id, id])
        );
    }
}
</script>
