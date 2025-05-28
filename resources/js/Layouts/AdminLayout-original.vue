<template>
    <div class="min-h-screen text-gray-900 bg-gray-100">
        <!-- Header -->
        <header class="bg-white shadow">
            <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
                <h1 class="text-3xl font-bold">Admin Bereich</h1>
                <NavLink
                    :href="route('admin.services.index')"
                    :active="route().current('admin.services.index')"
                >
                    Leistungen
                </NavLink>
            </div>
        </header>

        <!-- Page Title -->
        <div class="px-4 mx-auto mt-4 max-w-7xl sm:px-6 lg:px-8">
            <h2 class="text-xl font-semibold text-teal-700">{{ title }}</h2>
        </div>

        <!-- Main Content -->
        <main class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <slot />
        </main>
    </div>
</template>

<script setup>
import NavLink from "@/Components/NavLink.vue";

defineProps({ title: String });
</script>
