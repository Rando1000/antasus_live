<template>
    <AdminLayout title="Referenz bearbeiten">
        <div class="max-w-3xl px-4 py-8 mx-auto bg-white rounded shadow">
            <ReferenzForm :referenz="referenz" @submit="update" />
        </div>
    </AdminLayout>
</template>

<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { router } from "@inertiajs/vue3";
import { defineProps } from "vue";
import ReferenzForm from "@/Components/ReferenzForm.vue";

const props = defineProps({ referenz: Object });

const update = (formData) => {
    router.put(`/admin/referenzen/${props.referenz.id}`, formData);
};
</script>

<style scoped></style>
