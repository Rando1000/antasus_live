<template>
    <form @submit.prevent="submit" class="space-y-6">
        <div>
            <label for="title" class="block mb-1 font-medium text-gray-700"
                >Title</label
            >
            <input
                v-model="form.title"
                id="title"
                type="text"
                required
                class="w-full px-4 py-2 border rounded-md focus:ring focus:ring-teal-500"
            />
        </div>

        <div>
            <label for="slug" class="block mb-1 font-medium text-gray-700"
                >Slug</label
            >
            <input
                v-model="form.slug"
                id="slug"
                type="text"
                class="w-full px-4 py-2 border rounded-md focus:ring focus:ring-teal-500"
            />
        </div>

        <div>
            <label
                for="description"
                class="block mb-1 font-medium text-gray-700"
                >Description</label
            >
            <textarea
                v-model="form.description"
                id="description"
                rows="4"
                class="w-full px-4 py-2 border rounded-md focus:ring focus:ring-teal-500"
            ></textarea>
        </div>

        <div>
            <label for="image" class="block mb-1 font-medium text-gray-700"
                >Image URL</label
            >
            <input
                v-model="form.image"
                id="image"
                type="text"
                class="w-full px-4 py-2 border rounded-md focus:ring focus:ring-teal-500"
            />
        </div>

        <div>
            <label for="position" class="block mb-1 font-medium text-gray-700"
                >Position</label
            >
            <input
                v-model.number="form.position"
                id="position"
                type="number"
                class="w-full px-4 py-2 border rounded-md focus:ring focus:ring-teal-500"
            />
        </div>

        <div class="flex items-center">
            <input
                v-model="form.is_active"
                id="is_active"
                type="checkbox"
                class="w-4 h-4 text-teal-600 border-gray-300 rounded focus:ring-teal-500"
            />
            <label for="is_active" class="ml-2 text-sm text-gray-700"
                >Active</label
            >
        </div>

        <div class="pt-4">
            <button
                type="submit"
                class="px-6 py-2 font-semibold text-white bg-teal-600 rounded-md hover:bg-teal-700"
            >
                Save
            </button>
        </div>
    </form>
</template>

<script setup>
import { reactive, watch, toRefs } from "vue";
import { router } from "@inertiajs/vue3";

const props = defineProps({
    service: {
        type: Object,
        default: () => ({
            title: "",
            slug: "",
            description: "",
            image: "",
            position: 0,
            is_active: true,
        }),
    },
});

const emit = defineEmits(["submit"]);

const form = reactive({ ...props.service });

watch(
    () => props.service,
    (newValue) => {
        Object.assign(form, newValue);
    }
);

const submit = () => {
    emit("submit", { ...form });
};
</script>
