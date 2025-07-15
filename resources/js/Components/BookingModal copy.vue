<template>
    <TransitionRoot appear :show="open" as="template">
        <Dialog as="div" class="relative z-50" @close="$emit('close')">
            <div
                class="fixed inset-0 bg-black/50 backdrop-blur-sm"
                @click="$emit('close')"
                aria-label="Modal schließen"
                tabindex="-1"
            />
            <div class="fixed inset-0 overflow-y-auto">
                <div
                    class="flex items-center justify-center min-h-full p-4 text-center"
                >
                    <DialogPanel
                        class="relative w-full max-w-3xl px-4 pt-5 pb-4 bg-white shadow-2xl dark:bg-gray-900 rounded-2xl sm:my-8 sm:align-middle sm:p-6"
                    >
                        <!-- Close Button -->
                        <div class="absolute top-0 right-0 pt-4 pr-4">
                            <button
                                @click="$emit('close')"
                                class="text-gray-400 bg-white rounded-md dark:bg-gray-900 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-teal-500"
                                aria-label="Schließen"
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
                        <!-- Modal Header -->
                        <div class="mb-5 sm:flex sm:items-start">
                            <div
                                class="mt-3 text-center sm:mt-0 sm:text-left sm:w-full"
                            >
                                <DialogTitle
                                    class="text-2xl font-bold leading-6 text-gray-900 dark:text-white"
                                >
                                    Online-Terminbuchung
                                </DialogTitle>
                                <p
                                    class="mt-2 text-sm text-gray-500 dark:text-gray-300"
                                >
                                    Buchen Sie einen Termin für
                                    Glasfaser-Tiefbau, Hausanschluss oder
                                    Projektberatung – 100% digital &
                                    DSGVO-konform.
                                </p>
                            </div>
                        </div>

                        <!-- Step 1: Terminart -->
                        <div v-if="!selectedType" class="mt-4">
                            <h3
                                class="mb-3 text-lg font-medium text-gray-900 dark:text-white"
                            >
                                Wählen Sie die Art des Termins:
                            </h3>
                            <ul class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                <li v-for="item in typeList" :key="item.value">
                                    <button
                                        @click="selectType(item.value)"
                                        class="flex flex-col items-center justify-center w-full p-4 text-left transition border rounded-xl hover:bg-teal-50 hover:border-teal-500 dark:hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-teal-500"
                                    >
                                        <span
                                            class="flex items-center justify-center w-12 h-12 mb-3 text-white rounded-full bg-gradient-to-r from-teal-600 to-black"
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
                                        <div
                                            class="text-lg font-medium text-antasus-second dark:text-antasus-neutral"
                                        >
                                            {{ item.label }}
                                        </div>
                                        <p
                                            class="mt-1 text-sm text-gray-500 dark:text-gray-200"
                                        >
                                            {{ item.desc }}
                                        </p>
                                    </button>
                                </li>
                            </ul>
                        </div>

                        <!-- Step 2: Modus -->
                        <div v-else-if="!selectedMode" class="mt-6">
                            <h3
                                class="mb-4 text-lg font-semibold text-gray-900 dark:text-white"
                            >
                                Wie möchten Sie den Termin wahrnehmen?
                            </h3>
                            <ul class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                <li v-for="item in modeList" :key="item.value">
                                    <button
                                        @click="selectMode(item.value)"
                                        class="flex flex-col items-center justify-center w-full p-4 text-left transition border rounded-xl hover:bg-teal-50 hover:border-teal-500 dark:hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-teal-500"
                                    >
                                        <span
                                            class="flex items-center justify-center w-12 h-12 mb-3 text-white rounded-full bg-gradient-to-r from-teal-600 to-black"
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
                                        <div
                                            class="text-lg font-medium dark:text-antasus-neutral"
                                        >
                                            {{ item.label }}
                                        </div>
                                        <p
                                            class="mt-1 text-sm text-gray-500 dark:text-gray-200"
                                        >
                                            {{ item.desc }}
                                        </p>
                                    </button>
                                </li>
                            </ul>
                            <div class="mt-4">
                                <button
                                    @click="selectedType = null"
                                    class="text-sm text-teal-600 dark:text-teal-300 hover:text-teal-800 focus:outline-none focus:underline"
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
                                :admin="isAdmin"
                                @dateSelected="handleDateSelection"
                                @slotsSelected="handleSlotsSelection"
                                @back="() => (selectedMode = null)"
                            />

                            <form
                                v-if="selectedDate"
                                @submit.prevent="submitBooking"
                                class="space-y-4"
                                autocomplete="off"
                                aria-label="Terminbuchungsformular"
                            >
                                <div
                                    class="grid grid-cols-1 gap-4 sm:grid-cols-2"
                                >
                                    <div>
                                        <label
                                            for="name"
                                            class="block text-sm font-medium text-gray-700 dark:text-gray-200"
                                            >Name*</label
                                        >
                                        <input
                                            v-model="bookingData.name"
                                            required
                                            type="text"
                                            id="name"
                                            class="w-full px-3 py-2 border rounded focus:ring-teal-500"
                                            autocomplete="name"
                                        />
                                    </div>
                                    <div>
                                        <label
                                            for="email"
                                            class="block text-sm font-medium text-gray-700 dark:text-gray-200"
                                            >E-Mail*</label
                                        >
                                        <input
                                            v-model="bookingData.email"
                                            required
                                            type="email"
                                            id="email"
                                            class="w-full px-3 py-2 border rounded focus:ring-teal-500"
                                            autocomplete="email"
                                        />
                                    </div>
                                    <div class="sm:col-span-2">
                                        <label
                                            for="topic"
                                            class="block text-sm font-medium text-gray-700 dark:text-gray-200"
                                            >Thema (optional)</label
                                        >
                                        <input
                                            v-model="bookingData.topic"
                                            type="text"
                                            id="topic"
                                            class="w-full px-3 py-2 border rounded focus:ring-teal-500"
                                            autocomplete="off"
                                        />
                                    </div>
                                </div>

                                <div
                                    class="p-4 rounded-md bg-gray-50 dark:bg-gray-800"
                                >
                                    <h4
                                        class="text-sm font-medium text-gray-700 dark:text-gray-200"
                                    >
                                        Termindetails:
                                    </h4>
                                    <p
                                        class="mt-1 text-sm text-gray-900 dark:text-gray-100"
                                    >
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
                                <!-- DSGVO Hinweis -->
                                <div
                                    class="px-2 py-1 text-xs text-gray-500 dark:text-gray-400"
                                >
                                    <span>
                                        Mit dem Absenden stimmen Sie der
                                        Verarbeitung Ihrer Daten gemäß unserer
                                        <a
                                            href="/datenschutz"
                                            target="_blank"
                                            class="text-teal-700 underline dark:text-teal-300 hover:text-teal-900"
                                            >Datenschutzerklärung</a
                                        >
                                        zu. Die Übertragung erfolgt
                                        verschlüsselt.
                                    </span>
                                </div>

                                <div class="flex justify-end pt-2 space-x-3">
                                    <button
                                        type="button"
                                        @click="$emit('close')"
                                        class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded hover:bg-gray-50 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-200"
                                    >
                                        Abbrechen
                                    </button>
                                    <button
                                        type="submit"
                                        class="px-4 py-2 text-sm font-medium text-white bg-[linear-gradient(135deg,_#00fdcf,_#000)] hover:bg-[linear-gradient(135deg,_#00fdcf,_#222)] rounded transition focus:ring-2 focus:ring-teal-500"
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

                            <!-- Admin: Ausgewählte Slots + Pflichtfelder -->
                            <div
                                v-if="isAdmin && selectedSlots"
                                class="space-y-4"
                            >
                                <h4
                                    class="font-medium text-indigo-700 dark:text-indigo-400"
                                >
                                    Ausgewählte Slots (Admin):
                                </h4>
                                <ul
                                    class="ml-5 text-sm text-gray-700 list-disc dark:text-gray-200"
                                >
                                    <li
                                        v-for="(s, i) in selectedSlots"
                                        :key="i"
                                    >
                                        {{ formatDate(s.start) }} –
                                        {{ formatTime(s.end) }}
                                    </li>
                                </ul>
                                <div
                                    class="grid grid-cols-1 gap-4 sm:grid-cols-2"
                                >
                                    <div>
                                        <label
                                            for="name"
                                            class="block text-sm font-medium"
                                            >Name*</label
                                        >
                                        <input
                                            id="name"
                                            v-model="bookingData.name"
                                            required
                                            type="text"
                                            class="w-full px-3 py-2 border rounded focus:ring-teal-500"
                                            placeholder="Name eingeben"
                                        />
                                    </div>
                                    <div>
                                        <label
                                            for="email"
                                            class="block text-sm font-medium"
                                            >E-Mail*</label
                                        >
                                        <input
                                            id="email"
                                            v-model="bookingData.email"
                                            required
                                            type="email"
                                            class="w-full px-3 py-2 border rounded focus:ring-teal-500"
                                            placeholder="E-Mail eingeben"
                                        />
                                    </div>
                                </div>
                                <div class="flex justify-end">
                                    <button
                                        type="button"
                                        @click="submitAdminBooking"
                                        :disabled="
                                            isSubmitting ||
                                            !bookingData.name ||
                                            !bookingData.email
                                        "
                                        class="px-4 py-2 text-white bg-indigo-600 rounded hover:bg-indigo-700 disabled:opacity-50"
                                    >
                                        {{
                                            isSubmitting
                                                ? "Wird gesendet…"
                                                : "Alle Slots buchen"
                                        }}
                                    </button>
                                </div>
                                <p v-if="submitError" class="text-red-600">
                                    {{ submitError }}
                                </p>
                                <p v-if="submitSuccess" class="text-green-600">
                                    Admin-Buchung erfolgreich!
                                </p>
                            </div>
                        </div>
                    </DialogPanel>
                </div>
            </div>
        </Dialog>
    </TransitionRoot>
</template>

<script setup>
import { ref, computed } from "vue";
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
import { usePage } from "@inertiajs/vue3";

// Analytics-Helper für GA4
const trackEvent = (name, params = {}) => {
    if (window.gtag) {
        window.gtag("event", name, {
            ...params,
            service_area: "ratgeber",
        });
    }
};

const props = defineProps({ open: Boolean });
const emit = defineEmits(["close"]);

const page = usePage();
const isAdmin = computed(() => page.props.isAdmin === true);

const selectedType = ref(null);
const selectedMode = ref(null);
const selectedDate = ref(null);
const selectedSlots = ref([]);
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
};

const formatDate = (date) => format(date, "EEEE, d. MMMM yyyy", { locale: de });
const formatTime = (date) => format(date, "HH:mm", { locale: de });

const selectType = (type) => {
    trackEvent("select_type", { category: "Booking", label: type });
    selectedType.value = type;
};
const selectMode = (mode) => {
    trackEvent("select_mode", { category: "Booking", label: mode });
    selectedMode.value = mode;
};
const handleDateSelection = ({ start }) =>
    (selectedDate.value = new Date(start));
function handleSlotsSelection(slots) {
    selectedSlots.value = slots;
}

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

// Direkt-Buchung für Admin
async function submitAdminBooking() {
    if (!isAdmin.value || !selectedSlots.value.length) return;
    isSubmitting.value = true;
    submitError.value = null;
    const payload = {
        type: selectedType.value,
        mode: selectedMode.value,
        slots: selectedSlots.value.map((s) => ({
            start: new Date(s.start).toISOString(),
            end: new Date(s.end).toISOString(),
        })),
        name: bookingData.value.name,
        email: bookingData.value.email,
        topic: bookingData.value.topic,
    };
    try {
        await axios.post("/bookings/multi", payload);
        submitSuccess.value = true;
        setTimeout(() => emit("close"), 2000);
    } catch (_) {
        submitError.value = "Admin-Buchung fehlgeschlagen.";
    } finally {
        isSubmitting.value = false;
    }
}
</script>
