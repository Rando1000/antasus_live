<template>
    <div class="calendar-container">
        <div class="toolbar">
            <button
                @click="$emit('back')"
                type="button"
                class="btn-glass"
                aria-label="Zurück zur Auswahl"
            >
                ←
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
                <button @click="goToToday" type="button" class="btn-gradient">
                    Heute
                </button>
                <button
                    @click="goToPrev"
                    type="button"
                    class="btn-glass-small"
                    aria-label="Vorheriger Zeitraum"
                >
                    ◀
                </button>
                <button
                    @click="goToNext"
                    type="button"
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

const props = defineProps({
    type: { type: String, required: true },
    mode: { type: String, required: true },
    typeLabel: { type: String, required: true },
    modeLabel: { type: String, required: true },
    initialDate: { type: String, default: null },
    initialView: { type: String, default: "timeGridWeek" },
    slotDuration: { type: String, default: "00:30:00" },
});
const emit = defineEmits(["dateSelected", "back"]);

const calendarRef = ref(null);
const currentTitle = ref("");
const isMobile = ref(false);
const dateSelected = ref(null);

onMounted(() => {
    updateTitle();
    detectMobile();
    window.addEventListener("resize", detectMobile);
});

const detectMobile = () => {
    isMobile.value = window.innerWidth < 640;
};

const updateTitle = () => {
    const api = calendarRef.value?.getApi();
    if (api) currentTitle.value = api.view.title;
};

const goToToday = () => {
    calendarRef.value?.getApi()?.today();
    updateTitle();
};

const goToPrev = () => {
    calendarRef.value?.getApi()?.prev();
    updateTitle();
};

const goToNext = () => {
    calendarRef.value?.getApi()?.next();
    updateTitle();
};

const calendarOptions = computed(() => ({
    plugins: [dayGridPlugin, timeGridPlugin, interactionPlugin],
    locale: deLocale,
    initialView: isMobile.value ? "timeGridDay" : props.initialView,
    initialDate: props.initialDate,
    headerToolbar: false,
    selectable: true,
    editable: false,
    selectMirror: true,
    businessHours: {
        daysOfWeek: [1, 2, 3, 4, 5],
        startTime: "09:00",
        endTime: "17:00",
    },
    slotMinTime: "08:00:00",
    slotMaxTime: "18:00:00",
    slotDuration: props.slotDuration,
    allDaySlot: false,
    eventLongPressDelay: 0,
    selectLongPressDelay: 0,
    handleWindowResize: true,
    height: "auto",
    events: async (info, onSuccess, onError) => {
        try {
            const res = await axios.get("/api/available-slots", {
                params: {
                    type: props.type,
                    start: info.startStr,
                    end: info.endStr,
                },
            });
            const evs = res.data || [];
            if (dateSelected.value) {
                evs.push({
                    id: "selected-slot",
                    title: "Ausgewählt",
                    start: dateSelected.value.start,
                    end: dateSelected.value.end,
                    display: "background",
                    backgroundColor:
                        document.documentElement.classList.contains("dark")
                            ? "#002f2b"
                            : "#ccffff",
                    borderColor: "#00fdcf",
                });
            }
            onSuccess(evs);
        } catch (e) {
            onError(e);
        }
    },
    select: (info) => {
        dateSelected.value = {
            start: info.startStr,
            end: info.endStr,
        };
        emit("dateSelected", dateSelected.value);
        highlightSelection();
    },
    selectAllow: (sel) => sel.start >= new Date(),
}));

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
</script>

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
