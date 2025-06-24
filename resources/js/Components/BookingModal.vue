<template>
    <TransitionRoot appear :show="open" as="template">
        <Dialog as="div" class="relative z-50" @close="$emit('close')">
            <div
                class="fixed inset-0 bg-black/50 backdrop-blur-sm"
                @click="$emit('close')"
            />
            <div class="fixed inset-0 overflow-y-auto">
                <div
                    class="flex items-center justify-center min-h-full p-4 text-center"
                >
                    <DialogPanel
                        class="w-full max-w-3xl px-4 pt-5 pb-4 bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:p-6"
                    >
                        <div class="absolute top-0 right-0 pt-4 pr-4">
                            <button
                                @click="$emit('close')"
                                class="text-gray-400 bg-white rounded-md hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-teal-500"
                            >
                                <span class="sr-only">Schließen</span>
                                <svg
                                    class="w-6 h-6"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"
                                    />
                                </svg>
                            </button>
                        </div>

                        <div class="mb-5 sm:flex sm:items-start">
                            <div
                                class="mt-3 text-center sm:mt-0 sm:text-left sm:w-full"
                            >
                                <DialogTitle
                                    class="text-2xl font-bold leading-6 text-gray-900"
                                >
                                    Online-Terminbuchung
                                </DialogTitle>
                                <p class="mt-2 text-sm text-gray-500">
                                    Buchen Sie einen Termin für
                                    Glasfaser-Tiefbau, Hausanschluss oder
                                    Projektberatung
                                </p>
                            </div>
                        </div>

                        <!-- Step 1: Terminart -->
                        <div v-if="!selectedType" class="mt-4">
                            <h3 class="mb-3 text-lg font-medium">
                                Wählen Sie die Art des Termins:
                            </h3>
                            <ul class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                <li v-for="item in typeList" :key="item.value">
                                    <button
                                        @click="selectType(item.value)"
                                        class="flex flex-col items-center justify-center w-full p-4 text-left transition border rounded-lg hover:bg-teal-50 hover:border-teal-500 focus:outline-none focus:ring-2 focus:ring-teal-500"
                                    >
                                        <span
                                            class="flex items-center justify-center w-12 h-12 mb-3 text-white rounded-full bg-gradient-to-r from-teal-600 to-indigo-600"
                                        >
                                            <svg
                                                class="w-6 h-6"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke="currentColor"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
                                                />
                                            </svg>
                                        </span>
                                        <div class="text-lg font-medium">
                                            {{ item.label }}
                                        </div>
                                        <p class="mt-1 text-sm text-gray-500">
                                            {{ item.desc }}
                                        </p>
                                    </button>
                                </li>
                            </ul>
                        </div>

                        <!-- Step 2: Modus -->
                        <div v-else-if="!selectedMode" class="mt-6">
                            <h3
                                class="mb-4 text-lg font-semibold text-gray-900"
                            >
                                Wie möchten Sie den Termin wahrnehmen?
                            </h3>

                            <ul class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                <li v-for="item in modeList" :key="item.value">
                                    <button
                                        @click="selectMode(item.value)"
                                        class="flex flex-col items-center justify-center w-full p-4 text-left transition border rounded-lg hover:bg-teal-50 hover:border-teal-500 focus:outline-none focus:ring-2 focus:ring-teal-500"
                                    >
                                        <span
                                            class="flex items-center justify-center w-12 h-12 mb-3 text-white rounded-full bg-gradient-to-r from-teal-600 to-indigo-600"
                                        >
                                            <svg
                                                class="w-6 h-6"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke="currentColor"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
                                                />
                                            </svg>
                                        </span>
                                        <div class="text-lg font-medium">
                                            {{ item.label }}
                                        </div>
                                        <p class="mt-1 text-sm text-gray-500">
                                            {{ item.desc }}
                                        </p>
                                    </button>
                                </li>
                            </ul>

                            <div class="mt-4">
                                <button
                                    @click="selectedType = null"
                                    class="text-sm text-teal-600 hover:text-teal-800 focus:outline-none focus:underline"
                                >
                                    Zurück zur Auswahl
                                </button>
                            </div>
                        </div>

                        <!-- Step 3: Kalender + Formular -->
                        <div
                            v-if="selectedType && selectedMode"
                            class="mt-4 space-y-6"
                        >
                            <Calendar
                                :type="selectedType"
                                :mode="selectedMode"
                                :typeLabel="typeLabels[selectedType]"
                                :modeLabel="modeLabels[selectedMode]"
                                :typeLabels="typeLabels"
                                :modeLabels="modeLabels"
                                :slotDuration="slotDuration"
                                @dateSelected="handleDateSelection"
                                @back="() => (selectedMode = null)"
                            />

                            <form
                                v-if="selectedDate"
                                @submit.prevent="submitBooking"
                                class="space-y-4"
                            >
                                <div
                                    class="grid grid-cols-1 gap-4 sm:grid-cols-2"
                                >
                                    <div>
                                        <label
                                            for="name"
                                            class="block text-sm font-medium text-gray-700"
                                            >Name</label
                                        >
                                        <input
                                            v-model="bookingData.name"
                                            required
                                            type="text"
                                            id="name"
                                            class="w-full px-3 py-2 border rounded focus:ring-teal-500"
                                        />
                                    </div>
                                    <div>
                                        <label
                                            for="email"
                                            class="block text-sm font-medium text-gray-700"
                                            >E-Mail</label
                                        >
                                        <input
                                            v-model="bookingData.email"
                                            required
                                            type="email"
                                            id="email"
                                            class="w-full px-3 py-2 border rounded focus:ring-teal-500"
                                        />
                                    </div>
                                    <div class="sm:col-span-2">
                                        <label
                                            for="topic"
                                            class="block text-sm font-medium text-gray-700"
                                            >Thema (optional)</label
                                        >
                                        <input
                                            v-model="bookingData.topic"
                                            type="text"
                                            id="topic"
                                            class="w-full px-3 py-2 border rounded focus:ring-teal-500"
                                        />
                                    </div>
                                </div>

                                <div class="p-4 rounded-md bg-gray-50">
                                    <h4
                                        class="text-sm font-medium text-gray-700"
                                    >
                                        Termindetails:
                                    </h4>
                                    <p class="mt-1 text-sm text-gray-900">
                                        <span class="font-medium">{{
                                            modeLabels[selectedMode]
                                        }}</span>
                                        <span class="font-medium">{{
                                            typeLabels[selectedType]
                                        }}</span>
                                        am
                                        <span class="font-medium">{{
                                            formatDate(selectedDate)
                                        }}</span>
                                        um
                                        <span class="font-medium">{{
                                            formatTime(selectedDate)
                                        }}</span>
                                        Uhr
                                    </p>
                                </div>

                                <div class="flex justify-end pt-2 space-x-3">
                                    <button
                                        type="button"
                                        @click="$emit('close')"
                                        class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded hover:bg-gray-50"
                                    >
                                        Abbrechen
                                    </button>
                                    <button
                                        type="submit"
                                        class="px-4 py-2 text-sm font-medium text-white bg-[linear-gradient(135deg,_#00fdcf,_#000)] hover:bg-[linear-gradient(135deg,_#00fdcf,_#222)] rounded transition"
                                        :disabled="isSubmitting"
                                    >
                                        {{
                                            isSubmitting
                                                ? "Wird gesendet..."
                                                : "Termin buchen"
                                        }}
                                    </button>
                                </div>
                                <div
                                    v-if="isSubmitting"
                                    class="mt-4 text-sm text-gray-500"
                                >
                                    Buchung wird verarbeitet...
                                </div>
                                <div
                                    v-if="submitSuccess"
                                    class="mt-4 text-green-600 md:text-lg"
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
                            </form>
                        </div>
                    </DialogPanel>
                </div>
            </div>
        </Dialog>
    </TransitionRoot>
</template>

<script setup>
import { ref, watch, onUnmounted, nextTick } from "vue";
import {
    TransitionRoot,
    Dialog,
    DialogPanel,
    DialogTitle,
} from "@headlessui/vue";
import Calendar from "@/Components/Booking/Calendar.vue";
import { format } from "date-fns";
import { de } from "date-fns/locale";
import axios from "axios";

// Analytics-Helper für GA4
const trackEvent = (name, params = {}) => {
    if (window.gtag) {
        window.gtag("event", name, {
            ...params,
            // optional: immer die gleiche Dimension mitgeben
            service_area: "ratgeber",
        });
    }
};

const props = defineProps({
    open: Boolean,
});
const emit = defineEmits(["close"]);

const selectedType = ref(null);
const selectedMode = ref(null);
const selectedDate = ref(null);
const slotDuration = "00:30:00";
const isSubmitting = ref(false);
const submitSuccess = ref(false);
const submitError = ref(null);

const bookingData = ref({
    type: "",
    mode: "",
    start: null,
    end: null,
    name: "",
    email: "",
    topic: "",
});

const typeList = [
    {
        value: "beratung",
        label: "Beratungsgespräch",
        desc: "Individuelle Beratung zu Glasfaserprojekten",
    },
    {
        value: "angebot",
        label: "Angebotserstellung",
        desc: "Kostenlose Angebotserstellung für Ihr Projekt",
    },
    {
        value: "hausanschluss",
        label: "Hausanschluss",
        desc: "Terminvereinbarung für Glasfaser-Hausanschluss",
    },
    {
        value: "projektplanung",
        label: "Projektplanung",
        desc: "Planung und Koordination größerer Projekte",
    },
];
const modeList = [
    {
        value: "online",
        label: "Online-Termin",
        desc: "Per Video-Konferenz bequem von überall",
    },
    {
        value: "praesenz",
        label: "Präsenz-Termin",
        desc: "Persönlich vor Ort bei Ihnen oder auf der Baustelle",
    },
];

const typeLabels = {
    beratung: "Beratungsgespräch",
    angebot: "Angebotserstellung",
    hausanschluss: "Hausanschluss",
    projektplanung: "Projektplanung",
};
const modeLabels = {
    online: "Online-Termin",
    praesenz: "Präsenz-Termin",
    hausanschluss: "Hausanschluss",
    projektplanung: "Projektplanung",
};

const formatDate = (date) => format(date, "EEEE, d. MMMM yyyy", { locale: de });
const formatTime = (date) => format(date, "HH:mm", { locale: de });

const selectType = (type) => {
    // Event senden, bevor wir den Typ setzen
    trackEvent("select_type", {
        category: "Booking",
        label: type,
    });
    selectedType.value = type;
};
const selectMode = (mode) => {
    trackEvent("select_mode", {
        category: "Booking",
        label: mode,
    });
    selectedMode.value = mode;
};
const handleDateSelection = ({ start }) =>
    (selectedDate.value = new Date(start));

const submitBooking = async () => {
    if (!selectedDate.value || !selectedType.value || !selectedMode.value)
        return;
    isSubmitting.value = true;
    submitError.value = null;
    submitSuccess.value = false;

    bookingData.value = {
        ...bookingData.value,
        type: selectedType.value,
        mode: selectedMode.value,
        start: selectedDate.value.toISOString(),
        end: new Date(selectedDate.value.getTime() + 30 * 60000).toISOString(),
    };

    try {
        await axios.post("/api/bookings/pending", bookingData.value);
        submitSuccess.value = true;
        trackEvent("booking_submit", {
            type: selectedType.value,
            mode: selectedMode.value,
        });

        setTimeout(() => emit("close"), 2000);
    } catch (e) {
        submitError.value = "Es ist ein Fehler aufgetreten.";
    } finally {
        isSubmitting.value = false;
    }
};
</script>
