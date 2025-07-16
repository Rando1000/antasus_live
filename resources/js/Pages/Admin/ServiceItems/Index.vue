<template>
    <AdminLayout :title="`Service-Items zu ${service.title}`">
        <div class="max-w-6xl px-4 py-10 mx-auto">
            <div
                class="flex flex-col-reverse gap-3 mb-6 md:flex-row md:items-center md:justify-between"
            >
                <h1
                    class="text-3xl font-extrabold text-gray-900 dark:text-white"
                >
                    Service-Items verwalten
                </h1>
                <Link
                    :href="route('admin.services.items.create', service.id)"
                    class="inline-flex items-center gap-2 px-5 py-2 text-white transition bg-teal-600 rounded-lg shadow hover:bg-teal-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-teal-400"
                    aria-label="Neues Item anlegen"
                >
                    <svg
                        class="w-4 h-4"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M12 4v16m8-8H4"
                        />
                    </svg>
                    Neues Item
                </Link>
            </div>

            <div
                class="overflow-x-auto bg-white border border-gray-100 shadow dark:bg-gray-900 dark:border-gray-800 rounded-2xl"
            >
                <table
                    class="min-w-full divide-y divide-gray-100 table-auto dark:divide-gray-800"
                >
                    <thead class="bg-gray-50 dark:bg-gray-800">
                        <tr>
                            <th
                                scope="col"
                                class="px-4 py-3 text-xs font-bold tracking-wider text-left text-gray-600 uppercase dark:text-gray-300"
                            >
                                Titel
                            </th>
                            <th
                                scope="col"
                                class="px-4 py-3 text-xs font-bold tracking-wider text-left text-gray-600 uppercase dark:text-gray-300"
                            >
                                Slug
                            </th>
                            <th
                                scope="col"
                                class="px-4 py-3 text-xs font-bold tracking-wider text-left text-gray-600 uppercase dark:text-gray-300"
                            >
                                Position
                            </th>
                            <th
                                scope="col"
                                class="px-4 py-3 text-xs font-bold tracking-wider text-left text-gray-600 uppercase dark:text-gray-300"
                            >
                                Bild
                            </th>
                            <th
                                scope="col"
                                class="px-4 py-3 text-xs font-bold tracking-wider text-left text-gray-600 uppercase dark:text-gray-300"
                            >
                                Status
                            </th>
                            <th
                                scope="col"
                                class="px-4 py-3 text-xs font-bold tracking-wider text-left text-gray-600 uppercase dark:text-gray-300"
                            >
                                Aktionen
                            </th>
                        </tr>
                    </thead>
                    <tbody
                        class="divide-y divide-gray-100 dark:divide-gray-800"
                    >
                        <tr
                            v-for="item in items"
                            :key="item.id"
                            class="transition hover:bg-teal-50 dark:hover:bg-gray-800"
                        >
                            <td
                                class="px-4 py-3 font-medium text-gray-900 align-middle dark:text-white"
                            >
                                {{ item.title }}
                            </td>
                            <td
                                class="px-4 py-3 text-gray-600 align-middle dark:text-gray-400"
                            >
                                {{ item.slug }}
                            </td>
                            <td
                                class="px-4 py-3 text-gray-600 align-middle dark:text-gray-400"
                            >
                                {{ item.position }}
                            </td>
                            <td class="px-4 py-3 align-middle">
                                <img
                                    :src="
                                        item.image_url ||
                                        '/images/Items_Glasfaser_Tiefbau.avif'
                                    "
                                    alt="Bild Service-Item"
                                    loading="lazy"
                                    class="object-cover w-24 h-16 border border-gray-200 rounded-lg shadow-sm dark:border-gray-700"
                                />
                            </td>
                            <td class="px-4 py-3 align-middle">
                                <span
                                    class="inline-block px-3 py-1 text-xs font-semibold rounded-full"
                                    :class="
                                        item.is_active
                                            ? 'bg-green-100 text-green-700 dark:bg-green-900/60 dark:text-green-300'
                                            : 'bg-red-100 text-red-700 dark:bg-red-900/60 dark:text-red-300'
                                    "
                                >
                                    {{ item.is_active ? "Aktiv" : "Inaktiv" }}
                                </span>
                            </td>
                            <td class="px-4 py-3 space-x-2 align-middle">
                                <Link
                                    :href="
                                        route('admin.services.items.edit', [
                                            service.id,
                                            item.id,
                                        ])
                                    "
                                    class="inline-flex items-center px-3 py-1.5 text-xs font-semibold text-teal-700 dark:text-teal-300 bg-teal-50 dark:bg-teal-900/20 rounded hover:bg-teal-100 dark:hover:bg-teal-800 focus:outline-none focus-visible:ring-2 focus-visible:ring-teal-500"
                                    aria-label="Item bearbeiten"
                                >
                                    Bearbeiten
                                </Link>
                                <button
                                    @click="destroy(item.id)"
                                    class="inline-flex items-center px-3 py-1.5 text-xs font-semibold text-red-600 bg-red-50 dark:bg-red-900/30 rounded hover:bg-red-100 dark:hover:bg-red-900 focus:outline-none focus-visible:ring-2 focus-visible:ring-red-400"
                                    aria-label="Item löschen"
                                >
                                    Löschen
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div
                    v-if="items.length === 0"
                    class="p-10 text-center text-gray-500 dark:text-gray-400"
                >
                    <span class="block mb-2 text-lg font-semibold"
                        >Noch keine Items angelegt.</span
                    >
                    <Link
                        :href="route('admin.services.items.create', service.id)"
                        class="inline-block px-5 py-2 mt-2 font-medium text-white rounded shadow bg-gradient-to-r from-teal-600 to-indigo-700 hover:scale-105"
                    >
                        + Jetzt erstes Item anlegen
                    </Link>
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
    if (
        window.confirm(
            "Möchten Sie dieses Item wirklich unwiderruflich löschen? Diese Aktion kann nicht rückgängig gemacht werden."
        )
    ) {
        router.delete(
            route("admin.services.items.destroy", [props.service.id, id])
        );
    }
}
</script>

<style scoped>
/* Enterprise-Tabelle, Fokus, Hover, Barrierefreiheit, Dark-Mode optimiert */
table {
    font-feature-settings: "ss03";
}
th,
td {
    vertical-align: middle;
}
th {
    font-weight: 700;
    letter-spacing: 0.06em;
}
tr:focus-within {
    outline: 2px solid #00fdcf;
    outline-offset: 2px;
}
@media (max-width: 800px) {
    .max-w-6xl {
        padding: 0 !important;
    }
    table {
        font-size: 0.96rem;
    }
}
</style>
