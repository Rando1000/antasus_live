<template>
    <AdminLayout :title="`Neues Service-Item – ${service.title}`">
        <div
            class="max-w-2xl px-4 py-10 mx-auto bg-white shadow-2xl dark:bg-gray-900 rounded-2xl"
        >
            <h1
                class="mb-6 text-2xl font-extrabold tracking-tight text-gray-900 dark:text-white"
            >
                Neues Service-Item für „{{ service.title }}“
            </h1>
            <ServiceItemForm :service="service" @submit="store" />
        </div>
    </AdminLayout>
</template>

<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import ServiceItemForm from "@/Components/Services/ServiceItemForm.vue";
import { router } from "@inertiajs/vue3";

const props = defineProps({
    service: Object,
});

function store(formData) {
    router.post(
        route("admin.services.items.store", props.service.id),
        formData,
        {
            forceFormData: true, // Für File/Image-Uploads (FormData statt JSON)
            onSuccess: () => {
                // Nach Erfolg automatisch zur Übersicht
                router.visit(
                    route("admin.services.items.index", props.service.id)
                );
            },
            onError: (errors) => {
                // Hier ggf. Error-Notification/Toast einbauen
                window.scrollTo({ top: 0, behavior: "smooth" });
            },
        }
    );
}
</script>

<style scoped>
/* Enterprise/CI-Visual */
.max-w-2xl {
    border-radius: 1.25rem;
    box-shadow: 0 6px 40px 0 rgba(0, 0, 0, 0.11);
}
h1 {
    letter-spacing: -0.01em;
}
@media (max-width: 600px) {
    .max-w-2xl {
        padding: 1.2rem 0.5rem;
    }
    h1 {
        font-size: 1.4rem;
    }
}
</style>
