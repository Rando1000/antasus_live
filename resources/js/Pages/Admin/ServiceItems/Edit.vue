<template>
    <AdminLayout :title="`Item bearbeiten – ${service.title}`">
        <div
            class="max-w-2xl px-4 py-10 mx-auto bg-white shadow-2xl dark:bg-gray-900 rounded-2xl"
        >
            <h1
                class="mb-6 text-2xl font-extrabold tracking-tight text-gray-900 dark:text-white"
            >
                Service-Item bearbeiten
            </h1>
            <ServiceItemForm
                :service="service"
                :item="item"
                :isEdit="true"
                @submit="update"
            />
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
            _method: "put",
            ...Object.fromEntries(formData),
        },
        {
            forceFormData: true, // auch für Bild-Updates notwendig!
            onSuccess: () => {
                router.visit(
                    route("admin.services.items.index", props.service.id)
                );
            },
            onError: (err) => {
                // Optional: Error Toast/Notification (hier einfach Scroll-to-top)
                window.scrollTo({ top: 0, behavior: "smooth" });
            },
        }
    );
}
</script>

<style scoped>
.max-w-2xl {
    border-radius: 1.25rem;
    box-shadow: 0 8px 48px 0 rgba(0, 0, 0, 0.13);
}
h1 {
    letter-spacing: -0.01em;
}
@media (max-width: 600px) {
    .max-w-2xl {
        padding: 1.2rem 0.5rem;
    }
    h1 {
        font-size: 1.3rem;
    }
}
</style>
