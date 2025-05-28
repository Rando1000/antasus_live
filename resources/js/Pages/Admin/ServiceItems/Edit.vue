<template>
    <AdminLayout :title="`Item bearbeiten – ${service.title}`">
        <div class="max-w-2xl px-4 py-10 mx-auto bg-white rounded shadow">
            <h1 class="mb-6 text-xl font-bold">Item bearbeiten</h1>
            <ServiceItemForm :item="item" :isEdit="true" @submit="update" />
        </div>
    </AdminLayout>
</template>

<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import ServiceItemForm from "@/Components/Services/ServiceItemForm.vue";
import { router } from "@inertiajs/vue3";

const props = defineProps({
    service: Object,
    item: {
        type: Object,
        default: () => ({
            title: "",
            description: "",
            image: "",
            image_url: "",
            position: 0,
        }),
    },
});

function update(formData) {
    router.post(
        route("admin.services.items.update", [props.service.id, props.item.id]),
        {
            _method: "put", // Damit Laravel PUT akzeptiert
            ...Object.fromEntries(formData),
        },
        {
            forceFormData: true,
            onSuccess: () => {
                router.visit(
                    route("admin.services.items.index", props.service.id)
                );
            },
        }
    );
}
</script>
