<template>
    <AdminLayout title="Edit Service">
        <div class="max-w-3xl px-4 py-8 mx-auto bg-white rounded shadow">
            <ServiceForm :service="service" @submit="update" />
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
    router.put(`/admin/services/${props.service.id}`, formData);
};
</script>
