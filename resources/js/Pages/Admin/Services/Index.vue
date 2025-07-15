<template>
    <AdminLayout title="Service Categories">
        <div class="px-4 py-10 mx-auto max-w-7xl">
            <!-- Header / Actions -->
            <div
                class="flex flex-col gap-4 mb-10 md:flex-row md:items-center md:justify-between"
            >
                <h1
                    class="text-4xl font-extrabold tracking-tight text-antasus-black dark:text-white"
                >
                    Services & Kategorien
                </h1>
                <Link
                    href="/admin/services/create"
                    class="inline-flex items-center px-6 py-2 text-base font-semibold text-white transition shadow bg-gradient-to-br from-teal-500 to-indigo-800 rounded-xl hover:scale-105 hover:from-teal-600 hover:to-indigo-900 focus:outline-none focus-visible:ring-2 focus-visible:ring-teal-400"
                >
                    <svg
                        class="w-5 h-5 mr-2"
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
                    Neuer Service
                </Link>
            </div>

            <!-- Service Cards Grid -->
            <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
                <div
                    v-for="service in services"
                    :key="service.id"
                    class="relative flex flex-col transition bg-white border shadow-lg p-7 dark:bg-gray-900 border-teal-50 dark:border-teal-900/10 rounded-2xl hover:shadow-2xl group animate-fade-in-up"
                    :aria-label="`Service: ${service.title}`"
                    tabindex="0"
                >
                    <div class="flex items-center justify-between mb-2">
                        <h2
                            class="text-2xl font-bold text-gray-900 transition dark:text-white group-hover:text-teal-600"
                        >
                            {{ service.title }}
                        </h2>
                        <span
                            class="px-2 py-0.5 rounded-full text-xs font-bold uppercase tracking-wider"
                            :class="
                                service.is_active
                                    ? 'bg-teal-100 text-teal-800 dark:bg-teal-700/30 dark:text-teal-200 border border-teal-300'
                                    : 'bg-red-100 text-red-700 dark:bg-red-700/30 dark:text-red-200 border border-red-200'
                            "
                        >
                            {{ service.is_active ? "Aktiv" : "Inaktiv" }}
                        </span>
                    </div>
                    <p
                        class="mb-5 text-base text-gray-600 dark:text-gray-300 line-clamp-3"
                    >
                        {{ service.description }}
                    </p>
                    <div class="flex justify-end gap-3 mt-auto">
                        <Link
                            :href="`/admin/services/${service.id}/items`"
                            class="inline-flex items-center px-4 py-1.5 text-sm font-medium rounded-lg bg-indigo-50 text-indigo-800 dark:bg-indigo-800/30 dark:text-indigo-200 hover:bg-indigo-100 hover:dark:bg-indigo-800 focus:outline-none focus-visible:ring-2 focus-visible:ring-indigo-400 transition"
                        >
                            <svg
                                class="w-4 h-4 mr-1"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M9 17v-6a2 2 0 012-2h2m4 4v-2a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2h2"
                                />
                            </svg>
                            Service-Items
                        </Link>
                        <Link
                            :href="`/admin/services/${service.id}/edit`"
                            class="inline-flex items-center px-4 py-1.5 text-sm font-medium rounded-lg bg-teal-600 text-white hover:bg-teal-700 shadow focus:outline-none focus-visible:ring-2 focus-visible:ring-teal-400 transition"
                        >
                            <svg
                                class="w-4 h-4 mr-1"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L7.5 21H3v-4.5l13.232-13.232z"
                                />
                            </svg>
                            Bearbeiten
                        </Link>
                    </div>
                    <!-- Accessibility: Focus-Ring auf Card -->
                    <span class="sr-only">{{
                        service.is_active ? "Aktiv" : "Inaktiv"
                    }}</span>
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

<style scoped>
@keyframes fade-in-up {
    from {
        opacity: 0;
        transform: translateY(28px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
.animate-fade-in-up {
    animation: fade-in-up 0.5s cubic-bezier(0.33, 1, 0.68, 1) both;
}
.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
