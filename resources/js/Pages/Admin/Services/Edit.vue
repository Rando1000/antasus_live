<template>
    <AdminLayout title="Service bearbeiten">
        <div class="flex flex-col items-center min-h-[60vh] justify-center">
            <div
                class="w-full max-w-3xl p-8 mx-auto bg-white border border-teal-100 shadow-2xl dark:bg-gray-900 rounded-2xl dark:border-teal-900/20 animate-fade-in-up"
                role="region"
                aria-label="Service bearbeiten"
                tabindex="-1"
            >
                <h1
                    class="mb-2 text-3xl font-extrabold tracking-tight text-antasus-black dark:text-white"
                >
                    Service bearbeiten
                </h1>
                <p class="mb-8 text-gray-600 dark:text-gray-300 text-md">
                    Aktualisiere hier alle Angaben und Metadaten zum gewählten
                    Service.<br />
                    <span class="font-semibold text-teal-600 dark:text-teal-400"
                        >Tipp:</span
                    >
                    Die Änderungen werden nach dem Speichern sofort übernommen.
                </p>
                <ServiceForm :service="service" @submit="update" />
            </div>
        </div>
    </AdminLayout>
</template>

<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import ServiceForm from "@/Components/Services/ServiceForm.vue";
import { router } from "@inertiajs/vue3";
import { defineProps } from "vue";

const props = defineProps({
    service: Object,
});

const update = (formData) => {
    router.post(`/admin/services/${props.service.id}`, formData, {
        forceFormData: true, // <---- das ist wichtig bei @inertiajs/vue3 >=1.0!
        onSuccess: () => {
            // z.B. router.visit('/admin/services');
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
