<template>
    <form @submit.prevent="submit" class="space-y-6">
        <!-- Titel -->
        <div>
            <label class="block mb-1 font-medium text-gray-700">Titel</label>
            <input
                v-model="form.titel"
                type="text"
                required
                class="w-full px-4 py-2 border rounded focus:outline-none focus:ring focus:ring-teal-300"
            />
        </div>

        <!-- Ort -->
        <div>
            <label class="block mb-1 font-medium text-gray-700">Ort</label>
            <input
                v-model="form.ort"
                type="text"
                class="w-full px-4 py-2 border rounded focus:outline-none focus:ring focus:ring-teal-300"
            />
        </div>

        <!-- Beschreibung -->
        <div>
            <label class="block mb-1 font-medium text-gray-700"
                >Beschreibung</label
            >
            <textarea
                v-model="form.beschreibung"
                rows="4"
                class="w-full px-4 py-2 border rounded focus:outline-none focus:ring focus:ring-teal-300"
            ></textarea>
        </div>

        <!-- Bilder-Upload -->
        <div>
            <label class="block mb-1 font-medium text-gray-700">
                Bilder (bis zu 3)
            </label>
            <input
                type="file"
                accept="image/*"
                multiple
                @change="handleImageUpload"
                class="block w-full text-sm text-gray-500"
            />
            <p class="mt-1 text-sm text-gray-400">Max. 3 Bilder</p>

            <!-- Vorschau -->
            <div class="flex gap-4 mt-4">
                <img
                    v-for="(bild, index) in form.bilder"
                    :key="index"
                    :src="getBildPreview(bild)"
                    class="object-cover w-24 h-24 rounded shadow"
                />
            </div>
        </div>

        <!-- Button -->
        <div>
            <button
                type="submit"
                class="px-6 py-3 font-semibold text-white transition bg-teal-600 rounded hover:bg-teal-700"
            >
                Speichern
            </button>
        </div>
    </form>
</template>

<script setup>
import { reactive } from "vue";
import { defineEmits, defineProps } from "vue";

const emit = defineEmits(["submit"]);
const props = defineProps({
    referenz: {
        type: Object,
        default: () => ({}),
    },
});

const form = reactive({
    titel: props.referenz?.titel || "",
    ort: props.referenz?.ort || "",
    beschreibung: props.referenz?.beschreibung || "",
    bilder: [],
});

// Vorschau-URLs generieren
const getBildPreview = (bild) => {
    if (typeof bild === "string") return bild;
    return URL.createObjectURL(bild);
};

// Upload handler
const handleImageUpload = (event) => {
    const files = Array.from(event.target.files);
    form.bilder = files.slice(0, 3); // max. 3 Bilder
};

const submit = () => {
    emit("submit", form);
};
</script>
