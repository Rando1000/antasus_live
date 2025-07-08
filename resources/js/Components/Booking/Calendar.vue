<template>
    <div class="calendar-container">
        <div class="toolbar">
            <button
                @click="$emit('back')"
                class="btn-glass"
                aria-label="Zurück zur Auswahl"
            >
                ← Zurück zur letzten Auswahl
            </button>
            <div class="current-title" aria-live="polite">
                {{ currentTitle }}
            </div>
        </div>

        <div class="toolbar-sub">
            <div class="labels" aria-label="Terminübersicht">
                <span
                    >Agenda: <strong>{{ typeLabel }}</strong></span
                >
                <span
                    >Modus: <strong>{{ modeLabel }}</strong></span
                >
            </div>
            <div
                class="nav-buttons"
                role="group"
                aria-label="Kalendernavigation"
            >
                <button @click="goToToday" class="btn-gradient">Heute</button>
                <button
                    @click="goToPrev"
                    class="btn-glass-small"
                    aria-label="Vorheriger Zeitraum"
                >
                    ◀
                </button>
                <button
                    @click="goToNext"
                    class="btn-glass-small"
                    aria-label="Nächster Zeitraum"
                >
                    ▶
                </button>
            </div>
        </div>

        <FullCalendar ref="calendarRef" :options="calendarOptions" />
    </div>
</template>

<script setup>
import { ref, computed, onMounted } from "vue";
import FullCalendar from "@fullcalendar/vue3";
import dayGridPlugin from "@fullcalendar/daygrid";
import timeGridPlugin from "@fullcalendar/timegrid";
import interactionPlugin from "@fullcalendar/interaction";
import deLocale from "@fullcalendar/core/locales/de";
import axios from "axios";

// Props
const props = defineProps({
    type: { type: String, required: true },
    mode: { type: String, required: true },
    typeLabel: { type: String, required: true },
    modeLabel: { type: String, required: true },
    initialDate: { type: String, default: null },
    initialView: { type: String, default: "timeGridWeek" },
    slotDuration: { type: String, default: "00:30:00" },
    admin: { type: Boolean, default: false }, // hier einschalten
});

// Emits
const emit = defineEmits([
    "dateSelected", // für Single-Slot
    "slotsSelected", // für Multi-Slot
    "back", // zurück-Button
]);

// State
const bookedSlots = ref([]);
const calendarRef = ref(null);
const currentTitle = ref("");
const isMobile = ref(false);
const dateSelected = ref(null);
const selectedSlots = ref([]); // sammelt für Admin

// Lifecycle
onMounted(() => {
    detectMobile();
    updateTitle();
    window.addEventListener("resize", detectMobile);
});

// Helpers
function detectMobile() {
    isMobile.value = window.innerWidth < 640;
}
function updateTitle() {
    const api = calendarRef.value?.getApi();
    if (api) currentTitle.value = api.view.title;
}
function goToToday() {
    calendarRef.value.getApi().today();
    updateTitle();
}
function goToPrev() {
    calendarRef.value.getApi().prev();
    updateTitle();
}
function goToNext() {
    calendarRef.value.getApi().next();
    updateTitle();
}

// Highlight (nur Single-Slot)
function highlightSelection() {
    const api = calendarRef.value?.getApi();
    if (!api) return;
    const ev = api.getEventById("selected-slot");
    if (ev) ev.remove();
    if (dateSelected.value) {
        api.addEvent({
            id: "selected-slot",
            title: "Ausgewählt",
            start: dateSelected.value.start,
            end: dateSelected.value.end,
            display: "background",
            backgroundColor: document.documentElement.classList.contains("dark")
                ? "#002f2b"
                : "#ccffff",
            borderColor: "#00fdcf",
        });
    }
}

// FullCalendar-Konfiguration
const calendarOptions = computed(() => ({
    plugins: [dayGridPlugin, timeGridPlugin, interactionPlugin],
    locale: deLocale,
    initialView: isMobile.value ? "timeGridDay" : props.initialView,
    initialDate: props.initialDate,
    headerToolbar: false,
    selectable: true,
    selectMirror: true,
    allDaySlot: false,
    businessHours: {
        daysOfWeek: [1, 2, 3, 4, 5],
        startTime: "09:00",
        endTime: "17:00",
    },
    slotMinTime: "08:00:00",
    slotMaxTime: "18:00:00",
    slotDuration: props.slotDuration,
    handleWindowResize: true,
    height: "auto",

    // bereits gebuchte Slots nachladen
    events: async (info, onSuccess, onError) => {
        try {
            const { data } = await axios.get("/api/available-slots", {
                params: {
                    type: props.type,
                    start: info.startStr,
                    end: info.endStr,
                },
            });
            // roh als Date-Objekte für Kollisionstests merken
            bookedSlots.value = data.map((d) => ({
                start: new Date(d.start),
                end: new Date(d.end),
            }));

            const evs = data || [];

            // Admin-Selektion als Hintergrund-Events einzeichnen
            if (props.admin && selectedSlots.value.length) {
                selectedSlots.value.forEach((slot, i) => {
                    evs.push({
                        id: `admin-${i}`,
                        title: "Ausgewählt",
                        start: slot.start,
                        end: slot.end,
                        display: "background",
                        backgroundColor:
                            document.documentElement.classList.contains("dark")
                                ? "#002f2b"
                                : "#ccffff",
                        borderColor: "#00fdcf",
                    });
                });
            }

            onSuccess(evs);
        } catch (e) {
            onError(e);
        }
    },

    // Auswahl: Single vs. Multi
    select: (info) => {
        const slot = { start: info.startStr, end: info.endStr };
        const api = calendarRef.value.getApi();

        if (props.admin) {
            // Multi-Slot: push & emit
            selectedSlots.value.push(slot);
            api.addEvent({
                id: `admin-${selectedSlots.value.length - 1}`,
                title: "Ausgewählt",
                start: info.start,
                end: info.end,
                display: "background",
                backgroundColor: document.documentElement.classList.contains(
                    "dark"
                )
                    ? "#002f2b"
                    : "#ccffff",
                borderColor: "#00fdcf",
            });
            emit("slotsSelected", selectedSlots.value);
        } else {
            // Single-Slot
            dateSelected.value = slot;
            emit("dateSelected", slot);
            highlightSelection();
        }

        api.unselect();
    },

    // keine Vergangenheit UND keine Überlappung mit einem gebuchten Slot
    selectAllow: (sel) => {
        const start = sel.start;
        const end = sel.end;

        // 1) nicht in der Vergangenheit
        if (start < new Date()) return false;

        // 2) Kollisionstest mit jedem bookedSlots-Eintrag
        for (let b of bookedSlots.value) {
            if (start < b.end && end > b.start) {
                // Überschneidung → Auswahl nicht erlaubt
                return false;
            }
        }
        return true;
    },
}));
</script>

<style scoped>
/* ... Eure Styles wie gehabt ... */
</style>

<style scoped>
.calendar-container {
    font-family: "Inter", sans-serif;
    padding: 1rem;
}
.toolbar,
.toolbar-sub {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    margin-bottom: 1rem;
}
.current-title {
    font-size: 1.125rem;
    font-weight: 600;
    color: #000;
}
.labels span {
    display: block;
    margin-right: 1rem;
    color: #000;
}
.nav-buttons {
    display: flex;
    gap: 0.5rem;
}

/* Dark mode support */
.dark .calendar-container {
    background: #000;
    color: #fff;
}
.dark .calendar-container .current-title,
.dark .labels span {
    color: #fff;
}
.dark .calendar-container .fc {
    background: #000 !important;
    color: #fff !important;
}

/* Buttons */
.btn-gradient {
    padding: 0.375rem 0.75rem;
    font-size: 0.875rem;
    font-weight: 500;
    color: #fff;
    background: linear-gradient(135deg, #00fdcf, #000);
    border: none;
    border-radius: 0.375rem;
    backdrop-filter: blur(10px);
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
    transition: opacity 0.2s;
}
.btn-gradient:hover {
    opacity: 0.85;
}
.btn-glass {
    padding: 0.375rem 0.75rem;
    font-size: 0.875rem;
    font-weight: 500;
    color: #000;
    background: rgba(255, 255, 255, 0.2);
    border: 1px solid rgba(255, 255, 255, 0.3);
    border-radius: 0.375rem;
    backdrop-filter: blur(8px);
    transition: opacity 0.2s;
}
.dark .btn-glass {
    color: #fff;
    background: rgba(0, 0, 0, 0.4);
}
.btn-glass-small {
    padding: 0.25rem 0.5rem;
}
</style>
