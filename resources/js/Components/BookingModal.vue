<template>
    <TransitionRoot appear :show="open" as="template">
        <Dialog as="div" class="relative z-50" @close="closeModal">
            <div class="fixed inset-0 bg-black/50 backdrop-blur-sm" />
            <div class="fixed inset-0 overflow-y-auto">
                <div
                    class="flex items-center justify-center min-h-full p-4 text-center"
                >
                    <DialogPanel
                        class="w-full max-w-xl p-6 bg-white shadow-xl rounded-2xl"
                    >
                        <template v-if="currentStep === 1">
                            <DialogTitle
                                as="h3"
                                class="text-2xl font-bold text-gray-900"
                            >
                                Terminart wählen
                            </DialogTitle>
                            <p class="mt-2 text-sm text-gray-600">
                                Bitte wähle aus, wie du das Meeting führen
                                möchtest.
                            </p>
                            <div class="flex flex-col gap-4 mt-6">
                                <button
                                    @click="selectType('online')"
                                    class="w-full px-4 py-3 text-white bg-teal-600 rounded-lg hover:bg-teal-700"
                                >
                                    Online-Meeting
                                </button>
                                <button
                                    @click="selectType('praesenz')"
                                    class="w-full px-4 py-3 text-white bg-gray-800 rounded-lg hover:bg-gray-900"
                                >
                                    Präsenz-Meeting
                                </button>
                            </div>
                            <div class="mt-6 text-sm text-center text-gray-500">
                                <button
                                    @click="closeModal"
                                    class="hover:underline"
                                >
                                    Abbrechen
                                </button>
                            </div>
                        </template>

                        <template v-else-if="currentStep === 2">
                            <Calendar @dateSelected="handleDateSelection" />
                        </template>

                        <template v-else-if="currentStep === 3">
                            <div class="space-y-4">
                                <h3 class="text-lg font-semibold text-gray-900">
                                    Kontaktdaten
                                </h3>
                                <input
                                    v-model="bookingData.name"
                                    type="text"
                                    placeholder="Name"
                                    class="w-full p-2 border rounded"
                                />
                                <input
                                    v-model="bookingData.email"
                                    type="email"
                                    placeholder="E-Mail"
                                    class="w-full p-2 border rounded"
                                />
                                <input
                                    v-model="bookingData.topic"
                                    type="text"
                                    placeholder="Thema"
                                    class="w-full p-2 border rounded"
                                />

                                <div class="flex justify-between mt-4">
                                    <button
                                        @click="currentStep = 2"
                                        class="text-sm text-gray-600 hover:underline"
                                    >
                                        Zurück
                                    </button>
                                    <button
                                        @click="submitBooking"
                                        class="px-4 py-2 text-white bg-teal-600 rounded hover:bg-teal-700"
                                    >
                                        Buchen
                                    </button>
                                </div>
                            </div>
                            <div
                                v-if="isSubmitting"
                                class="mt-4 text-sm text-gray-500"
                            >
                                Buchung wird verarbeitet...
                            </div>
                            <div
                                v-if="submitSuccess"
                                class="mt-4 text-sm text-green-600"
                            >
                                Bestätigung wurde versendet. Bitte E-Mail
                                prüfen.
                            </div>
                            <div
                                v-if="submitError"
                                class="mt-4 text-sm text-red-600"
                            >
                                {{ submitError }}
                            </div>
                        </template>
                    </DialogPanel>
                </div>
            </div>
        </Dialog>
    </TransitionRoot>
</template>

<script setup>
import { ref } from "vue";
import {
    Dialog,
    DialogPanel,
    DialogTitle,
    TransitionRoot,
} from "@headlessui/vue";
import Calendar from "./Booking/Calendar.vue";
import axios from "axios";

const isSubmitting = ref(false);
const submitError = ref(null);
const submitSuccess = ref(false);

const props = defineProps({ open: Boolean });
const emit = defineEmits(["close"]);
const closeModal = () => emit("close");

const currentStep = ref(1);
const bookingData = ref({
    type: "",
    start: null,
    end: null,
    name: "",
    email: "",
    topic: "",
});

function selectType(type) {
    bookingData.value.type = type;
    currentStep.value = 2;
}

function handleDateSelection({ start, end }) {
    bookingData.value.start = start;
    bookingData.value.end = end;
    currentStep.value = 3;
}

async function submitBooking() {
    isSubmitting.value = true;
    submitError.value = null;
    submitSuccess.value = false;

    try {
        const response = await axios.post(
            "/api/bookings/pending",
            bookingData.value
        );
        submitSuccess.value = true;

        // Optional: Nach kurzer Zeit Modal schließen
        setTimeout(() => {
            closeModal();
            resetForm();
        }, 2000);
    } catch (error) {
        submitError.value =
            error.response?.data?.message || "Ein Fehler ist aufgetreten.";
    } finally {
        isSubmitting.value = false;
    }
}

function resetForm() {
    bookingData.value = {
        type: "",
        start: null,
        end: null,
        name: "",
        email: "",
        subject: "",
    };
    currentStep.value = 1;
}
</script>
