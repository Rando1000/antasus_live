<template>
    <AdminLayout :title="`Neues Item – ${service.title}`">
        <div class="max-w-2xl px-4 py-10 mx-auto bg-white rounded shadow">
            <h1 class="mb-6 text-xl font-bold">
                Neues Item zu „{{ service.title }}“
            </h1>
            <ServiceItemForm @submit="store" />
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
            forceFormData: true, // ⬅️ für Bild-Upload zwingend nötig
            onSuccess: () => {
                router.visit(
                    route("admin.services.items.index", props.service.id)
                );
            },
        }
    );
}
</script>
