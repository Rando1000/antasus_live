<template>
    <TransitionRoot appear :show="open" as="template">
        <Dialog as="div" class="relative z-50" @close="$emit('close')">
            <div
                class="fixed inset-0 bg-black/50 backdrop-blur-sm"
                aria-hidden="true"
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
                                type="button"
                                class="text-gray-400 bg-white rounded-md hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-teal-500"
                                @click="$emit('close')"
                                aria-label="Schließen"
                            >
                                <span class="sr-only">Schließen</span>
                                <svg
                                    class="w-6 h-6"
                                    xmlns="http://www.w3.org/2000/svg"
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
                                    as="h2"
                                    id="booking-modal-title"
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

                        <!-- Step 1: Terminart wählen -->
                        <div v-if="(currentStep = !selectedType)" class="mt-4">
                            <h3 class="mb-3 text-lg font-medium">
                                Wählen Sie die Art des Termins:
                            </h3>
                            <ul class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                <li>
                                    <button
                                        @click="selectType('beratung')"
                                        class="flex flex-col items-center justify-center w-full p-4 text-left transition border rounded-lg hover:bg-teal-50 hover:border-teal-500 focus:outline-none focus:ring-2 focus:ring-teal-500"
                                        type="button"
                                    >
                                        <span
                                            class="flex items-center justify-center w-12 h-12 mb-3 text-white rounded-full bg-gradient-to-r from-teal-600 to-indigo-600"
                                        >
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                class="w-6 h-6"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke="currentColor"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"
                                                />
                                            </svg>
                                        </span>
                                        <div class="text-lg font-medium">
                                            Beratungsgespräch
                                        </div>
                                        <p class="mt-1 text-sm text-gray-500">
                                            Individuelle Beratung zu
                                            Glasfaserprojekten
                                        </p>
                                    </button>
                                </li>
                                <li>
                                    <button
                                        @click="selectType('angebot')"
                                        class="flex flex-col items-center justify-center w-full p-4 text-left transition border rounded-lg hover:bg-teal-50 hover:border-teal-500 focus:outline-none focus:ring-2 focus:ring-teal-500"
                                        type="button"
                                    >
                                        <span
                                            class="flex items-center justify-center w-12 h-12 mb-3 text-white rounded-full bg-gradient-to-r from-teal-600 to-indigo-600"
                                        >
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                class="w-6 h-6"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke="currentColor"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"
                                                />
                                            </svg>
                                        </span>
                                        <div class="text-lg font-medium">
                                            Angebotserstellung
                                        </div>
                                        <p class="mt-1 text-sm text-gray-500">
                                            Kostenlose Angebotserstellung für
                                            Ihr Projekt
                                        </p>
                                    </button>
                                </li>
                                <li>
                                    <button
                                        @click="selectType('hausanschluss')"
                                        class="flex flex-col items-center justify-center w-full p-4 text-left transition border rounded-lg hover:bg-teal-50 hover:border-teal-500 focus:outline-none focus:ring-2 focus:ring-teal-500"
                                        type="button"
                                    >
                                        <span
                                            class="flex items-center justify-center w-12 h-12 mb-3 text-white rounded-full bg-gradient-to-r from-teal-600 to-indigo-600"
                                        >
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                class="w-6 h-6"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke="currentColor"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"
                                                />
                                            </svg>
                                        </span>
                                        <div class="text-lg font-medium">
                                            Hausanschluss
                                        </div>
                                        <p class="mt-1 text-sm text-gray-500">
                                            Terminvereinbarung für
                                            Glasfaser-Hausanschluss
                                        </p>
                                    </button>
                                </li>
                                <li>
                                    <button
                                        @click="selectType('projektplanung')"
                                        class="flex flex-col items-center justify-center w-full p-4 text-left transition border rounded-lg hover:bg-teal-50 hover:border-teal-500 focus:outline-none focus:ring-2 focus:ring-teal-500"
                                        type="button"
                                    >
                                        <span
                                            class="flex items-center justify-center w-12 h-12 mb-3 text-white rounded-full bg-gradient-to-r from-teal-600 to-indigo-600"
                                        >
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
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
                                            Projektplanung
                                        </div>
                                        <p class="mt-1 text-sm text-gray-500">
                                            Planung und Koordination größerer
                                            Projekte
                                        </p>
                                    </button>
                                </li>
                            </ul>
                        </div>

                        <div v-else-if="!selectedMode" class="mt-6">
                            <h3
                                class="mb-4 text-lg font-semibold text-gray-900"
                            >
                                Wie möchten Sie den Termin wahrnehmen?
                            </h3>
                            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                <button
                                    @click="selectMode('online')"
                                    class="relative p-5 transition-all duration-200 border rounded-lg shadow-sm group hover:shadow-md hover:border-teal-500 focus:outline-none focus:ring-2 focus:ring-teal-500"
                                >
                                    <div class="flex items-center space-x-4">
                                        <div
                                            class="flex items-center justify-center w-12 h-12 text-white rounded-full bg-gradient-to-r from-teal-600 to-indigo-600"
                                        >
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                class="w-6 h-6"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke="currentColor"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M9.75 17h4.5m-6.75 4h9a2.25 2.25 0 002.25-2.25V5.25A2.25 2.25 0 0016.5 3h-9A2.25 2.25 0 005.25 5.25v13.5A2.25 2.25 0 007.5 21z"
                                                />
                                            </svg>
                                        </div>
                                        <div class="text-left">
                                            <div
                                                class="text-base font-medium text-gray-900"
                                            >
                                                Online-Termin
                                            </div>
                                            <div class="text-sm text-gray-500">
                                                Per Video-Konferenz bequem von
                                                überall
                                            </div>
                                        </div>
                                    </div>
                                </button>
                                <button
                                    @click="selectMode('praesenz')"
                                    class="relative p-5 transition-all duration-200 border rounded-lg shadow-sm group hover:shadow-md hover:border-teal-500 focus:outline-none focus:ring-2 focus:ring-teal-500"
                                >
                                    <div class="flex items-center space-x-4">
                                        <div
                                            class="flex items-center justify-center w-12 h-12 text-white rounded-full bg-gradient-to-r from-teal-600 to-indigo-600"
                                        >
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                class="w-6 h-6"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke="currentColor"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M8 7V3m8 4V3m-9 8h10m-12 4h14m-3 4H7a2 2 0 01-2-2V5a2 2 0 012-2h10a2 2 0 012 2v10a2 2 0 01-2 2z"
                                                />
                                            </svg>
                                        </div>
                                        <div class="text-left">
                                            <div
                                                class="text-base font-medium text-gray-900"
                                            >
                                                Präsenz-Termin
                                            </div>
                                            <div class="text-sm text-gray-500">
                                                Persönlich vor Ort bei Ihnen
                                                oder auf der Baustelle
                                            </div>
                                        </div>
                                    </div>
                                </button>
                            </div>
                            <div class="mt-4">
                                <button
                                    @click="selectedType = null"
                                    class="text-sm text-teal-600 hover:text-teal-800 focus:outline-none focus:underline"
                                >
                                    Zurück zur Auswahl
                                </button>
                            </div>
                        </div>

                        <!-- Step 2: Kalender -->
                        <div v-if="selectedType && selectedMode" class="mt-4">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-lg font-medium">
                                    Termin auswählen:
                                    {{ typeLabels[selectedType] }}
                                </h3>
                                <button
                                    @click="selectedMode = null"
                                    class="text-sm text-teal-600 hover:text-teal-800 focus:outline-none focus:underline"
                                    type="button"
                                >
                                    Zurück zur Auswahl
                                </button>
                            </div>
                            <div
                                ref="calendarEl"
                                class="mt-4 overflow-hidden rounded-lg shadow-sm"
                            ></div>

                            <!-- Step 3: Formular -->
                            <form
                                v-if="selectedDate"
                                @submit.prevent="submitBooking"
                                class="mt-6 space-y-4"
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
                                            type="text"
                                            id="name"
                                            v-model="bookingData.name"
                                            required
                                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500"
                                        />
                                    </div>
                                    <div>
                                        <label
                                            for="email"
                                            class="block text-sm font-medium text-gray-700"
                                            >E-Mail</label
                                        >
                                        <input
                                            type="email"
                                            id="email"
                                            v-model="bookingData.email"
                                            required
                                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500"
                                        />
                                    </div>
                                    <div>
                                        <label
                                            for="topic"
                                            class="block text-sm font-medium text-gray-700"
                                            >Thema (optional)</label
                                        >
                                        <input
                                            type="text"
                                            id="topic"
                                            v-model="bookingData.topic"
                                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500"
                                        />
                                    </div>
                                </div>
                                <!-- Zusammenfassung und Buttons wie gehabt -->
                                <div class="p-4 rounded-md bg-gray-50">
                                    <h4
                                        class="text-sm font-medium text-gray-700"
                                    >
                                        Termindetails:
                                    </h4>
                                    <p class="mt-1 text-sm text-gray-900">
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
                                        class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-teal-500"
                                    >
                                        Abbrechen
                                    </button>
                                    <button
                                        type="submit"
                                        class="px-4 py-2 text-sm font-medium text-white border border-transparent rounded-md shadow-sm bg-gradient-to-r from-teal-600 to-indigo-600 hover:from-teal-700 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-teal-500"
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
                            </form>
                        </div>
                    </DialogPanel>
                </div>
            </div>
        </Dialog>
    </TransitionRoot>
</template>

<script setup>
import { ref, nextTick, watch, onUnmounted } from "vue";
import {
    Dialog,
    DialogPanel,
    DialogTitle,
    TransitionRoot,
} from "@headlessui/vue";
import { Calendar } from "@fullcalendar/core";
import dayGridPlugin from "@fullcalendar/daygrid";
import timeGridPlugin from "@fullcalendar/timegrid";
import interactionPlugin from "@fullcalendar/interaction";
import deLocale from "@fullcalendar/core/locales/de";
import { format } from "date-fns";
import { de } from "date-fns/locale";
import axios from "axios";

// Icons als SFCs oder direkt als Komponenten importieren
// import BeratungIcon from "./icons/BeratungIcon.vue";
// import AngebotIcon from "./icons/AngebotIcon.vue";
// import HausanschlussIcon from "./icons/HausanschlussIcon.vue";
// import ProjektplanungIcon from "./icons/ProjektplanungIcon.vue";

const props = defineProps({
    open: Boolean,
});

const selectedType = ref(null);
const selectedMode = ref(null);
const selectedDate = ref(null);
const calendarEl = ref(null);
const calendar = ref(null);
const isSubmitting = ref(false);
const submitSuccess = ref(false);
const submitError = ref(null);
const currentStep = ref(1);
const bookingData = ref({
    type: "",
    mode: "", // "online" oder "praesenz"
    start: null, // Timestamp-String, z.B. "2025-06-18T10:00:00"
    end: null, // Timestamp-String, z.B. "2025-06-18T10:30:00"
    name: "",
    email: "",
    topic: "",
});

const typeLabels = {
    beratung: "Beratungsgespräch",
    angebot: "Angebotserstellung",
    hausanschluss: "Hausanschluss",
    projektplanung: "Projektplanung",
};
const modeLabels = {
    online: "Online-Termin",
    praesenz: "Präsenztermin",
};

const typeList = [
    {
        value: "beratung",
        label: "Beratungsgespräch",
        desc: "Individuelle Beratung zu Glasfaserprojekten",
        // icon: BeratungIcon,
    },
    {
        value: "angebot",
        label: "Angebotserstellung",
        desc: "Kostenlose Angebotserstellung für Ihr Projekt",
        // icon: AngebotIcon,
    },
    {
        value: "hausanschluss",
        label: "Hausanschluss",
        desc: "Terminvereinbarung für Glasfaser-Hausanschluss",
        // icon: HausanschlussIcon,
    },
    {
        value: "projektplanung",
        label: "Projektplanung",
        desc: "Planung und Koordination größerer Projekte",
        // icon: ProjektplanungIcon,
    },
];

const selectType = (type) => {
    selectedType.value = type;
};

const selectMode = (mode) => {
    selectedMode.value = mode;
    nextTick(() => initCalendar());
};

const initCalendar = () => {
    if (calendarEl.value) {
        calendar.value = new Calendar(calendarEl.value, {
            plugins: [dayGridPlugin, timeGridPlugin, interactionPlugin],
            initialView: "timeGridWeek",
            headerToolbar: {
                left: "prev,next today",
                center: "title",
                right: "timeGridWeek,timeGridDay",
            },
            locale: deLocale,
            locale: "de",
            selectable: true,
            selectMirror: true,
            dayMaxEvents: true,
            weekends: true,
            businessHours: {
                daysOfWeek: [1, 2, 3, 4, 5],
                startTime: "09:00",
                endTime: "17:00",
            },
            slotMinTime: "09:00",
            slotMaxTime: "17:00",
            allDaySlot: false,
            slotDuration: "00:30:00",
            eventLongPressDelay: 0,
            selectLongPressDelay: 0,
            handleWindowResize: true,
            height: "auto",
            events: (info, successCallback, failureCallback) => {
                axios
                    .get("/api/available-slots", {
                        params: {
                            type: selectedType.value,
                            mode: selectedMode.value,
                            start: info.startStr,
                            end: info.endStr,
                        },
                    })
                    .then((response) => successCallback(response.data))
                    .catch((error) => failureCallback(error));
            },
            select: (info) => {
                selectedDate.value = info.start;

                // Entferne vorheriges Dummy-Event (falls vorhanden)
                const existing = calendar.value.getEventById("selected-slot");
                if (existing) {
                    existing.remove();
                }

                // Füge neuen Dummy-Event hinzu
                calendar.value.addEvent({
                    id: "selected-slot",
                    title: info.start,
                    start: info.start,
                    end: new Date(info.start.getTime() + 30 * 60000),
                    backgroundColor: "#14b8a6", // Teal 500
                    borderColor: "#0f766e", // Teal 700
                    textColor: "#ffffff",
                    editable: false,
                    display: "background",
                });

                calendar.value.unselect();
            },
            longPressDelay: 0,
        });
        calendar.value.render();
    }
};

const emit = defineEmits(["close"]);
const closeModal = () => emit("close");

const formatDate = (date) =>
    date ? format(date, "EEEE, d. MMMM yyyy", { locale: de }) : "";
const formatTime = (date) =>
    date ? format(date, "HH:mm", { locale: de }) : "";

const submitBooking = async () => {
    if (!selectedDate.value || !selectedType.value) return;
    isSubmitting.value = true;
    submitError.value = null;
    submitSuccess.value = false;
    try {
        // Setze die Werte passend
        bookingData.value.type = selectedType.value;
        bookingData.value.mode = selectedMode.value;
        bookingData.value.start = selectedDate.value.toISOString();
        bookingData.value.end = new Date(
            selectedDate.value.getTime() + 30 * 60000
        ).toISOString();

        await axios.post("/api/bookings/pending", bookingData.value);
        submitSuccess.value = true;

        // Optional: Nach kurzer Zeit Modal schließen
        setTimeout(() => {
            closeModal();
            resetForm();
        }, 2000);
        // alert("Ihre Buchung wurde erfolgreich übermittelt.");
        // $emit("close");
    } catch (error) {
        alert("Bei der Buchung ist ein Fehler aufgetreten.");
    } finally {
        isSubmitting.value = false;
    }
};

watch(
    () => props.open,
    (newVal) => {
        if (!newVal && calendar.value) {
            calendar.value.destroy();
            calendar.value = null;
        }
    }
);

onUnmounted(() => {
    if (calendar.value) calendar.value.destroy();
});
const highlightSelectedSlot = () => {
    nextTick(() => {
        const selectedEls =
            calendarEl.value?.querySelectorAll(".fc-slot-selected");
        selectedEls?.forEach((el) => el.classList.remove("fc-slot-selected"));

        if (!selectedDate.value) return;
        const slotSelector = `[data-time="${format(
            selectedDate.value,
            "HH:mm:ss"
        )}"]`;
        const dayCell = calendarEl.value?.querySelector(
            `.fc-timegrid-slot[data-date="${format(
                selectedDate.value,
                "yyyy-MM-dd"
            )}T${format(selectedDate.value, "HH:mm:ss")}"]`
        );

        if (dayCell) {
            dayCell.classList.add("fc-slot-selected");
        }
    });
};

watch(selectedDate, () => {
    highlightSelectedSlot();
});

function resetForm() {
    selectedType.value = null;
    selectedMode.value = null;
    selectedDate.value = null;
    bookingData.value = {
        type: "",
        mode: "", // "online" oder "praesenz"
        start: null, // Timestamp-String, z.B. "2025-06-18T10:00:00"
        end: null, // Timestamp-String, z.B. "2025-06-18T10:30:00"
        name: "",
        email: "",
        topic: "",
    };
    currentStep.value = 1;
}
</script>

<!-- <style scoped>
.modal-fade-enter-active,
.modal-fade-leave-active {
    transition: opacity 0.3s ease;
}

.modal-fade-enter-from,
.modal-fade-leave-to {
    opacity: 0;
}

/* 🟢 Kalendergrundfarben – CI-konform */
:deep(.fc) {
    font-family: "Inter", sans-serif;
    --fc-border-color: #e5e7eb; /* Tailwind gray-200 */
    --fc-now-indicator-color: #14b8a6; /* Tailwind teal-500 */
    --fc-today-bg-color: #f0fdfa; /* Tailwind teal-50 */
}

/* 🕓 Zeitslots und Hover */
:deep(.fc-timegrid-slot) {
    transition: background-color 0.2s ease;
}
:deep(.fc-timegrid-slot:hover) {
    background-color: #f0fdfa !important;
    cursor: pointer;
}

/* ✅ Markierter Slot dauerhaft sichtbar (wenn ausgewählt) */
:deep(.fc-slot-selected) {
    background-color: #99f6e4 !important; /* Tailwind teal-200 */
    border: 2px solid #14b8a6 !important; /* Tailwind teal-500 */
    box-shadow: 0 0 0 2px rgba(20, 184, 166, 0.3);
    transition: all 0.2s ease;
}
/* 📆 Buttons */
:deep(.fc-button) {
    background-color: #14b8a6;
    border: none;
    padding: 0.4rem 0.75rem;
    font-size: 0.875rem;
    font-weight: 500;
    transition: background-color 0.2s ease;
}
:deep(.fc-button:hover),
:deep(.fc-button:focus) {
    background-color: #0d9488; /* Tailwind teal-600 */
    outline: none;
}
:deep(.fc-button-primary:not(:disabled).fc-button-active),
:deep(.fc-button-primary:not(:disabled):active) {
    background-color: #0f766e !important;
}

/* FullCalendar Mobile Optimierungen */
:deep(.fc-event) {
    cursor: pointer;
    padding: 2px;
}

/* 📅 Toolbar Titel */
:deep(.fc-toolbar-title) {
    font-size: 1.25rem;
    font-weight: 600;
    color: #0f172a; /* Tailwind slate-900 */
}

@media (max-width: 640px) {
    :deep(.fc-header-toolbar) {
        flex-direction: column;
        gap: 0.5rem;
        align-items: flex-start;
    }

    :deep(.fc-toolbar-title) {
        font-size: 1rem;
    }

    :deep(.fc-button) {
        padding: 0.3rem 0.6rem;
    }
}
</style> -->
