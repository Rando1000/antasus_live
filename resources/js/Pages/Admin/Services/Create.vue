<template>
    <AdminLayout title="Create Service">
        <div class="max-w-3xl px-4 py-8 mx-auto bg-white rounded shadow">
            <ServiceForm @submit="store" />
        </div>
    </AdminLayout>
</template>

<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import ServiceForm from "@/Components/Services/ServiceForm.vue";
import { router } from "@inertiajs/vue3";

const store = (formData) => {
    router.post("/admin/services", formData);
};
</script>
