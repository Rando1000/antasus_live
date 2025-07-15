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

        <div class="relative mb-3">
            <FullCalendar ref="calendarRef" :options="calendarOptions" />
            <!-- Custom Legende direkt unter dem Kalender -->
            <div class="calendar-legend" aria-label="Legende Terminstatus">
                <div class="legend-entry">
                    <span class="legend-slot free"></span> Frei buchbar
                </div>
                <div class="legend-entry">
                    <span class="legend-slot booked"></span> Bereits gebucht
                </div>
                <div class="legend-entry">
                    <span class="legend-slot selected"></span> Ihre Auswahl
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, computed, onMounted, nextTick } from "vue";
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
    admin: { type: Boolean, default: false },
});

// Emits
const emit = defineEmits(["dateSelected", "slotsSelected", "back"]);

// State
const bookedSlots = ref([]);
const calendarRef = ref(null);
const currentTitle = ref("");
const isMobile = ref(false);
const dateSelected = ref(null);
const selectedSlots = ref([]); // für Admin-Mehrfachauswahl

onMounted(() => {
    detectMobile();
    updateTitle();
    window.addEventListener("resize", detectMobile);

    // Styling optimieren nach dem Mount
    nextTick(() => {
        styleSlots();
    });
});

// UX: Responsive
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

// Eigener Slot-Glow für ausgewählte Slots
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
            backgroundColor: "rgba(0,253,207,0.22)",
            borderColor: "#00fdcf",
            classNames: ["fc-slot-selected"],
        });
        nextTick(() => styleSlots());
    }
}

// UX: Extra Styling nach jeder Auswahl oder Calendar-Render
function styleSlots() {
    // Helle freie Slots, dunkle gebuchte Slots, Glow für Auswahl
    const slotEls = document.querySelectorAll(
        ".fc-timegrid-slot, .fc-timegrid-slot-lane"
    );
    slotEls.forEach((el) => {
        el.classList.remove("slot-free", "slot-booked", "slot-selected");
        // Free
        el.classList.add("slot-free");
    });
    // Booked (Data aus bookedSlots)
    bookedSlots.value.forEach((slot) => {
        const start = new Date(slot.start);
        const hour = String(start.getHours()).padStart(2, "0");
        const minute = String(start.getMinutes()).padStart(2, "0");
        const query = `.fc-timegrid-slot[data-time="${hour}:${minute}:00"]`;
        document.querySelectorAll(query).forEach((el) => {
            el.classList.add("slot-booked");
        });
    });
    // Selected
    if (dateSelected.value) {
        const start = new Date(dateSelected.value.start);
        const hour = String(start.getHours()).padStart(2, "0");
        const minute = String(start.getMinutes()).padStart(2, "0");
        const query = `.fc-timegrid-slot[data-time="${hour}:${minute}:00"]`;
        document.querySelectorAll(query).forEach((el) => {
            el.classList.add("slot-selected");
        });
    }
}

// FullCalendar Optionen
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

    // Buchungen nachladen
    events: async (info, onSuccess, onError) => {
        try {
            const { data } = await axios.get("/api/available-slots", {
                params: {
                    type: props.type,
                    start: info.startStr,
                    end: info.endStr,
                },
            });
            bookedSlots.value = data.map((d) => ({
                start: new Date(d.start),
                end: new Date(d.end),
            }));
            const evs = data || [];
            if (props.admin && selectedSlots.value.length) {
                selectedSlots.value.forEach((slot, i) => {
                    evs.push({
                        id: `admin-${i}`,
                        title: "Ausgewählt",
                        start: slot.start,
                        end: slot.end,
                        display: "background",
                        backgroundColor: "rgba(0,253,207,0.22)",
                        borderColor: "#00fdcf",
                    });
                });
            }
            onSuccess(evs);
            nextTick(() => styleSlots());
        } catch (e) {
            onError(e);
        }
    },

    select: (info) => {
        const slot = { start: info.startStr, end: info.endStr };
        const api = calendarRef.value.getApi();

        if (props.admin) {
            selectedSlots.value.push(slot);
            api.addEvent({
                id: `admin-${selectedSlots.value.length - 1}`,
                title: "Ausgewählt",
                start: info.start,
                end: info.end,
                display: "background",
                backgroundColor: "rgba(0,253,207,0.22)",
                borderColor: "#00fdcf",
            });
            emit("slotsSelected", selectedSlots.value);
        } else {
            dateSelected.value = slot;
            emit("dateSelected", slot);
            highlightSelection();
        }
        api.unselect();
        nextTick(() => styleSlots());
    },

    selectAllow: (sel) => {
        const start = sel.start;
        const end = sel.end;
        if (start < new Date()) return false;
        for (let b of bookedSlots.value) {
            if (start < b.end && end > b.start) {
                return false;
            }
        }
        return true;
    },
}));
</script>

<style scoped>
.calendar-container {
    font-family: "Inter", sans-serif;
    padding: 1rem;
    background: #fff;
    color: #000;
    border-radius: 1.25rem;
    box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.1);
    transition: background 0.3s, color 0.3s;
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

/* Legende unter Kalender */
.calendar-legend {
    display: flex;
    justify-content: flex-start;
    gap: 2rem;
    margin-top: 1.5rem;
    margin-bottom: 0.5rem;
}
.legend-entry {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.95rem;
}
.legend-slot {
    display: inline-block;
    width: 1.35em;
    height: 1.1em;
    border-radius: 0.35em;
    border: 1.5px solid #00fdcf;
    margin-right: 0.4em;
    box-shadow: 0 0 4px #00fdcf40;
}
.legend-slot.free {
    background: linear-gradient(90deg, #e6fffa 80%, #ffffff 100%);
    border-color: #00fdcf;
}
.legend-slot.booked {
    background: linear-gradient(90deg, #e9e9ee 80%, #cacace 100%);
    border-color: #b2b7bd;
}
.legend-slot.selected {
    background: #00fdcf;
    border-color: #00fdcf;
    box-shadow: 0 0 12px 3px #00fdcf99, 0 0 0 2px #fff inset;
    animation: pulse-slot-glow 1.5s cubic-bezier(0.6, 0, 0.4, 1) infinite;
}

@keyframes pulse-slot-glow {
    0% {
        box-shadow: 0 0 12px 3px #00fdcf88, 0 0 0 2px #fff inset;
    }
    60% {
        box-shadow: 0 0 28px 8px #00fdcfcc, 0 0 0 2px #fff inset;
    }
    100% {
        box-shadow: 0 0 12px 3px #00fdcf88, 0 0 0 2px #fff inset;
    }
}

/* FullCalendar: Slots */
:deep(.fc-timegrid-slot) {
    background: linear-gradient(90deg, #e9fff9 80%, #fff 100%);
    cursor: pointer;
    border-bottom: 1px solid #eef4f3;
    transition: background 0.15s;
}
:deep(.fc-timegrid-slot.slot-free) {
    background: linear-gradient(90deg, #e9fff9 80%, #fff 100%) !important;
}
:deep(.fc-timegrid-slot.slot-booked) {
    background: repeating-linear-gradient(
        90deg,
        #e0e3e8 0%,
        #d5d7dc 80%,
        #c0c4c7 100%
    ) !important;
    opacity: 0.65 !important;
    pointer-events: none;
}
:deep(.fc-timegrid-slot.slot-selected),
:deep(.fc-slot-selected) {
    background: #00fdcf !important;
    box-shadow: 0 0 12px 3px #00fdcf77, 0 0 0 2px #fff inset;
    z-index: 2;
    animation: pulse-slot-glow 1.5s cubic-bezier(0.6, 0, 0.4, 1) infinite;
}

/* Dark mode support */
.dark .calendar-container {
    background: #181d27;
    color: #fff;
    box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.45);
}
.dark .calendar-container .current-title,
.dark .labels span {
    color: #fff;
}
.dark .calendar-container .fc {
    background: #181d27 !important;
    color: #080808 !important;
}
.dark :deep(.fc-timegrid-slot) {
    background: linear-gradient(90deg, #243c39 60%, #181d27 100%);
    border-bottom: 1px solid #23272f;
    color: #060606 !important;
}
.dark :deep(.fc-timegrid-slot.slot-free) {
    background: linear-gradient(90deg, #1c4740 80%, #22292f 100%) !important;
}
.dark :deep(.fc-timegrid-slot.slot-booked) {
    background: repeating-linear-gradient(
        90deg,
        #232b32 0%,
        #252c38 80%,
        #353c45 100%
    ) !important;
    opacity: 0.5 !important;
    pointer-events: none;
}
.dark :deep(.fc-timegrid-slot.slot-selected),
.dark :deep(.fc-slot-selected) {
    background: #00fdcf !important;
    box-shadow: 0 0 12px 3px #00fdcf77, 0 0 0 2px #181d27 inset;
    z-index: 2;
    animation: pulse-slot-glow 1.5s cubic-bezier(0.6, 0, 0.4, 1) infinite;
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
    transition: opacity 0.2s, box-shadow 0.2s;
}
.btn-gradient:hover {
    opacity: 0.85;
    box-shadow: 0 4px 16px 0 rgba(0, 0, 0, 0.15);
}
.btn-glass {
    padding: 0.375rem 0.75rem;
    font-size: 0.875rem;
    font-weight: 500;
    color: #000;
    background: rgba(255, 255, 255, 0.35);
    border: 1px solid rgba(0, 0, 0, 0.07);
    border-radius: 0.375rem;
    backdrop-filter: blur(8px);
    transition: opacity 0.2s;
}
.dark .btn-glass {
    color: #fff;
    background: rgba(30, 30, 35, 0.55);
    border: 1px solid rgba(0, 0, 0, 0.18);
}
.btn-glass-small {
    padding: 0.25rem 0.5rem;
    font-size: 0.875rem;
    color: inherit;
    background: transparent;
    border: 1px solid rgba(0, 0, 0, 0.07);
    border-radius: 0.375rem;
    transition: background 0.2s, border 0.2s;
}
.btn-glass-small:hover {
    background: rgba(0, 0, 0, 0.05);
}
.dark .btn-glass-small {
    border: 1px solid rgba(255, 255, 255, 0.13);
}
.dark .btn-glass-small:hover {
    background: rgba(255, 255, 255, 0.07);
}
</style>
