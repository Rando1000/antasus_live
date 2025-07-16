<template>
    <div class="flex min-h-screen bg-gray-50 dark:bg-gray-900">
        <!-- Sidebar -->
        <aside class="w-64 bg-white shadow-md dark:bg-gray-800">
            <div
                class="p-6 text-2xl font-bold text-teal-600 dark:text-teal-400"
            >
                ANTASUS Infra
            </div>
            <nav class="px-4 space-y-1">
                <NavItem
                    label="Dashboard"
                    to="/admin/dashboard"
                    icon="Dashboard"
                    :active="isActive('/admin/dashboard')"
                />
                <NavItem
                    label="Bookings"
                    to="/admin/bookings"
                    icon="Booking"
                    :active="isActive('/admin/bookings')"
                />
                <NavItem
                    label="Services"
                    to="/admin/services"
                    icon="Services"
                    :active="isActive('/admin/services')"
                />
                <NavItem
                    label="References"
                    to="/admin/referenzen"
                    icon="References"
                    :active="isActive('/admin/referenzen')"
                />
                <NavItem
                    label="E-Mail-Kampagnen"
                    to="/admin/emailcampaign"
                    icon="Mail"
                    :active="isActive('/admin/emailcampaign')"
                />
                <NavItem
                    label="Users"
                    to="/admin/users"
                    icon="Users"
                    :active="isActive('/admin/users')"
                />
                <NavItem
                    label="Analytics"
                    to="/admin/analytics"
                    icon="Analytics"
                    :active="isActive('/admin/analytics')"
                />
                <NavItem
                    label="Messages"
                    to="/admin/messages"
                    icon="Messages"
                    :active="isActive('/admin/messages')"
                />
            </nav>
        </aside>

        <!-- Main content ... -->
        <div class="flex flex-col flex-1">
            <!-- Topbar -->
            <header
                class="flex items-center justify-between h-16 px-6 bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700"
            >
                <h1 class="text-lg font-semibold text-gray-700 dark:text-white">
                    {{ title }}
                </h1>
                <div class="flex items-center space-x-4">
                    <!-- Light/Dark Toggle -->
                    <button
                        @click="toggleDark"
                        class="text-gray-600 dark:text-gray-300 hover:text-teal-600 dark:hover:text-teal-400"
                    >
                        <SunIcon v-if="!isDark" class="w-5 h-5" />
                        <MoonIcon v-else class="w-5 h-5" />
                    </button>
                    <!-- User Dropdown -->
                    <div
                        class="relative"
                        @mouseenter="open = true"
                        @mouseleave="open = false"
                    >
                        <button
                            class="text-sm font-medium text-gray-700 dark:text-gray-100"
                        >
                            {{ user.name }}
                        </button>
                        <div
                            v-if="open"
                            class="absolute right-0 z-50 w-40 mt-2 bg-white border border-gray-200 rounded shadow-lg dark:bg-gray-700 dark:border-gray-600"
                        >
                            <Link
                                href="/user/profile"
                                class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-100 hover:bg-teal-100 dark:hover:bg-gray-600"
                            >
                                Profil
                            </Link>
                            <Link
                                href="/logout"
                                method="post"
                                as="button"
                                class="w-full px-4 py-2 text-sm text-left text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-600 dark:hover:text-white"
                            >
                                Abmelden
                            </Link>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page content -->
            <main class="flex-1 p-6 overflow-y-auto">
                <slot />
            </main>
        </div>
    </div>
</template>

<script setup>
import NavItem from "@/Components/Admin/NavItem.vue";
import { Link, usePage } from "@inertiajs/vue3";
import { ref, computed, watchEffect } from "vue";
import { SunIcon, MoonIcon } from "@heroicons/vue/24/solid";

const props = defineProps({
    title: {
        type: String,
        default: "Dashboard",
    },
});

const user = computed(() => usePage().props.auth.user);
const open = ref(false);

// Darkmode handling
const isDark = ref(localStorage.getItem("theme") === "dark");
watchEffect(() => {
    document.documentElement.classList.toggle("dark", isDark.value);
    localStorage.setItem("theme", isDark.value ? "dark" : "light");
});
function toggleDark() {
    isDark.value = !isDark.value;
}

// Aktiv-Logik, robust gegen Teilrouten (z.B. /admin/emailcampaign/xyz)
function isActive(path) {
    return window.location.pathname.startsWith(path);
}
</script>

<style scoped>
main::-webkit-scrollbar {
    width: 6px;
}
main::-webkit-scrollbar-thumb {
    background-color: rgba(0, 0, 0, 0.2);
    border-radius: 3px;
}
</style>
