<template>
    <form
        @submit.prevent="submit"
        class="space-y-6"
        enctype="multipart/form-data"
    >
        <!-- Titel -->
        <div>
            <label for="title" class="block text-sm font-medium text-gray-700">
                Titel
            </label>
            <input
                v-model="form.title"
                type="text"
                id="title"
                required
                class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500"
            />
        </div>

        <!-- Beschreibung -->
        <div>
            <label
                for="description"
                class="block text-sm font-medium text-gray-700"
            >
                Beschreibung
            </label>
            <textarea
                v-model="form.description"
                id="description"
                rows="4"
                required
                class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500"
            ></textarea>
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
                <img :src="previewUrl" class="object-cover max-h-32" />
            </div>
            <!-- Bestehendes Bild (wenn keine neue Vorschau vorhanden) -->
            <div v-else-if="item.image_url" class="mt-2">
                <p class="text-sm text-gray-500">Aktuelles Bild:</p>
                <img :src="item.image_url" class="object-cover max-h-32" />
            </div>
        </div>

        <!-- Position -->
        <div>
            <label
                for="position"
                class="block text-sm font-medium text-gray-700"
            >
                Position (optional)
            </label>
            <input
                v-model.number="form.position"
                type="number"
                id="position"
                class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500"
            />
        </div>

        <!-- Speichern-Button -->
        <div>
            <button
                type="submit"
                class="px-4 py-2 text-white bg-teal-600 rounded hover:bg-teal-700"
            >
                Speichern
            </button>
        </div>
    </form>
</template>

<script setup>
import { reactive, ref, watch } from "vue";

const props = defineProps({
    item: {
        type: Object,
        default: () => ({
            title: "",
            description: "",
            position: 0,
            image: null,
            image_url: null,
        }),
    },
    isEdit: {
        type: Boolean,
        default: false,
    },
});

const emit = defineEmits(["submit"]);

const form = reactive({
    title: props.item.title,
    description: props.item.description,
    position: props.item.position ?? 0,
    image: null,
});

const previewUrl = ref(null);

watch(
    () => props.item,
    (newItem) => {
        form.title = newItem.title;
        form.description = newItem.description;
        form.position = newItem.position ?? 0;
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
    formData.append("description", form.description);
    formData.append("position", form.position ?? "");

    if (form.image) {
        formData.append("image", form.image);
    }

    if (props.isEdit) {
        formData.append("_method", "put");
    }

    emit("submit", formData);
}
</script>
