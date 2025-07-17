<template>
    <form
        @submit.prevent="submit"
        class="space-y-6"
        enctype="multipart/form-data"
    >
        <!-- Titel -->
        <div>
            <label for="title" class="block mb-1 font-medium text-gray-700">
                Titel <span class="text-red-500">*</span>
            </label>
            <input
                v-model="form.title"
                id="title"
                type="text"
                required
                class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-teal-500"
            />
            <div v-if="errors.title" class="mt-1 text-xs text-red-600">
                {{ errors.title }}
            </div>
        </div>

        <!-- Slug -->
        <div>
            <label for="slug" class="block mb-1 font-medium text-gray-700">
                Slug
            </label>
            <input
                v-model="form.slug"
                id="slug"
                type="text"
                class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-teal-500"
            />
            <div v-if="errors.slug" class="mt-1 text-xs text-red-600">
                {{ errors.slug }}
            </div>
        </div>

        <!-- Beschreibung -->
        <div>
            <label
                for="description"
                class="block mb-1 font-medium text-gray-700"
            >
                Beschreibung
            </label>
            <textarea
                v-model="form.description"
                id="description"
                rows="4"
                class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-teal-500"
            ></textarea>
            <div v-if="errors.description" class="mt-1 text-xs text-red-600">
                {{ errors.description }}
            </div>
        </div>

        <!-- Bild-Upload -->
        <div>
            <label for="image" class="block mb-1 font-medium text-gray-700">
                Bild hochladen
            </label>
            <input
                ref="fileInput"
                id="image"
                type="file"
                accept="image/*"
                @change="handleFileChange"
                class="w-full px-4 py-2 border rounded-md focus:ring focus:ring-teal-500"
            />
            <!-- Neue Vorschau -->
            <div v-if="previewUrl" class="mt-2">
                <img :src="previewUrl" class="object-cover rounded max-h-32" />
            </div>
            <!-- Bestehendes Bild (wenn keine neue Vorschau vorhanden) -->
            <div v-else-if="form.image_url" class="mt-2">
                <p class="text-sm text-gray-500">Aktuelles Bild:</p>
                <img
                    :src="form.image_url"
                    class="object-cover rounded max-h-32"
                />
            </div>
            <div v-if="errors.image" class="mt-1 text-xs text-red-600">
                {{ errors.image }}
            </div>
        </div>

        <!-- Position -->
        <div>
            <label for="position" class="block mb-1 font-medium text-gray-700">
                Position
            </label>
            <input
                v-model.number="form.position"
                id="position"
                type="number"
                class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-teal-500"
            />
            <div v-if="errors.position" class="mt-1 text-xs text-red-600">
                {{ errors.position }}
            </div>
        </div>

        <!-- Aktiv -->
        <div class="flex items-center">
            <input
                v-model="form.is_active"
                id="is_active"
                type="checkbox"
                class="w-4 h-4 text-teal-600 border-gray-300 rounded focus:ring-teal-500"
                :true-value="1"
                :false-value="0"
            />
            <label for="is_active" class="ml-2 text-sm text-gray-700">
                Aktiv
            </label>
        </div>

        <div class="pt-4">
            <button
                type="submit"
                class="px-6 py-2 font-semibold text-white bg-teal-600 rounded-md hover:bg-teal-700"
            >
                Speichern
            </button>
        </div>
    </form>
</template>

<script setup>
import { reactive, ref, watch } from "vue";

const props = defineProps({
    service: {
        type: Object,
        default: () => ({
            title: "",
            slug: "",
            description: "",
            image: null,
            image_url: null,
            position: 0,
            is_active: 1,
        }),
    },
    errors: {
        type: Object,
        default: () => ({}),
    },
});

const emit = defineEmits(["submit"]);

const form = reactive({
    title: props.service.title ?? "",
    slug: props.service.slug ?? "",
    description: props.service.description ?? "",
    image: null,
    image_url: props.service.image_url ?? null,
    position: props.service.position ?? 0,
    is_active: props.service.is_active ?? 1,
});

const previewUrl = ref(null);

watch(
    () => props.service,
    (newService) => {
        form.title = newService.title ?? "";
        form.slug = newService.slug ?? "";
        form.description = newService.description ?? "";
        form.image_url = newService.image_url ?? null;
        form.position = newService.position ?? 0;
        form.is_active = newService.is_active ?? 1;
        form.image = null;
        previewUrl.value = null;
    }
);

function handleFileChange(event) {
    const file = event.target.files[0];
    if (file) {
        form.image = file;
        previewUrl.value = URL.createObjectURL(file);
    }
}

function submit() {
    const formData = new FormData();
    formData.append("title", form.title);
    formData.append("slug", form.slug ?? "");
    formData.append("description", form.description ?? "");
    formData.append("position", form.position ?? "");
    formData.append("is_active", form.is_active ? 1 : 0);

    if (form.image) {
        formData.append("image", form.image);
    }

    // PUT bei Edit
    if (props.service.id) {
        formData.append("_method", "put");
    }

    emit("submit", formData);
}
</script>
