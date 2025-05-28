<template>
    <AdminLayout title="Service Categories">
        <div class="max-w-6xl px-4 py-10 mx-auto">
            <div class="flex items-center justify-between mb-6">
                <h1 class="text-3xl font-bold text-gray-800">Services</h1>
                <Link
                    href="/admin/services/create"
                    class="px-5 py-2 text-white bg-teal-600 rounded-lg shadow hover:bg-teal-700"
                >
                    + New Service
                </Link>
            </div>

            <div class="grid gap-6 sm:grid-cols-2 md:grid-cols-3">
                <div
                    v-for="service in services"
                    :key="service.id"
                    class="p-6 transition bg-white border border-gray-200 rounded-lg shadow hover:shadow-md"
                >
                    <div class="flex items-center justify-between mb-2">
                        <h2 class="text-xl font-semibold text-gray-900">
                            {{ service.title }}
                        </h2>
                        <span
                            class="px-2 py-1 text-xs font-semibold rounded"
                            :class="
                                service.is_active
                                    ? 'bg-green-100 text-green-700'
                                    : 'bg-red-100 text-red-700'
                            "
                        >
                            {{ service.is_active ? "Active" : "Inactive" }}
                        </span>
                    </div>
                    <p class="mb-4 text-sm text-gray-600 line-clamp-3">
                        {{ service.description }}
                    </p>
                    <div class="flex items-center justify-between">
                        <Link
                            :href="`/admin/services/${service.id}/edit`"
                            class="text-sm font-medium text-teal-600 hover:underline"
                        >
                            Edit
                        </Link>
                        <Link
                            :href="`/admin/services/${service.id}/items`"
                            class="text-sm font-medium text-indigo-600 hover:underline"
                        >
                            Manage Items
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>

<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { Link } from "@inertiajs/vue3";

defineProps({
    services: Array,
});
</script>
