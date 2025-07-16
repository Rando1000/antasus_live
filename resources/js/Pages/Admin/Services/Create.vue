<template>
    <AdminLayout title="Service anlegen">
        <div class="flex flex-col items-center min-h-[60vh] justify-center">
            <div
                class="w-full max-w-3xl p-8 mx-auto bg-white border border-teal-100 shadow-2xl dark:bg-gray-900 rounded-2xl dark:border-teal-900/20 animate-fade-in-up"
                role="region"
                aria-label="Neuen Service anlegen"
                tabindex="-1"
            >
                <h1
                    class="mb-8 text-3xl font-extrabold tracking-tight text-antasus-black dark:text-white"
                >
                    Neuen Service anlegen
                </h1>
                <ServiceForm @submit="store" />
            </div>
        </div>
    </AdminLayout>
</template>

<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import ServiceForm from "@/Components/Services/ServiceForm.vue";
import { router } from "@inertiajs/vue3";

// Handler mit Erfolg-UX (optional: success-message, redirect etc.)
const store = (formData) => {
    router.post("/admin/services", formData, {
        onSuccess: () => {
            // z.B. Toast, Notification oder Weiterleitung (optional):
            // router.visit('/admin/services');
        },
    });
};
</script>

<style scoped>
@keyframes fade-in-up {
    from {
        opacity: 0;
        transform: translateY(32px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
.animate-fade-in-up {
    animation: fade-in-up 0.5s cubic-bezier(0.33, 1, 0.68, 1) both;
}
</style>
