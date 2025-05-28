<template>
    <AdminLayout title="Neue Referenz anlegen">
        <div class="max-w-3xl px-4 py-8 mx-auto bg-white rounded shadow">
            <ReferenzForm @submit="store" />
        </div>
    </AdminLayout>
</template>

<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import ReferenzForm from "@/Components/ReferenzForm.vue";
import { router } from "@inertiajs/vue3";

const store = (formData) => {
    router.post("/admin/referenzen", formData);
};
</script>

<style scoped></style>
