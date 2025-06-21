<template>
    <div class="p-4">
        <FullCalendar :options="calendarOptions" class="z-50 rounded-lg shadow">
            <template v-slot:eventContent="arg">
                <b>{{ arg.event.title }}</b>
            </template>
        </FullCalendar>
    </div>
</template>

<script setup>
import { ref, computed } from "vue";
import FullCalendar from "@fullcalendar/vue3";
import dayGridPlugin from "@fullcalendar/daygrid";
import timeGridPlugin from "@fullcalendar/timegrid";
import interactionPlugin from "@fullcalendar/interaction";

const emit = defineEmits(["dateSelected"]);

const calendarOptions = computed(() => ({
    plugins: [dayGridPlugin, timeGridPlugin, interactionPlugin],
    initialView: "timeGridWeek",
    headerToolbar: {
        left: "prev,next today",
        center: "title",
        right: "dayGridMonth,timeGridWeek,timeGridDay",
    },
    eventLongPressDelay: 0, // Sofortige Reaktion auf Touch
    selectLongPressDelay: 0,
    handleWindowResize: true, // Reagiert auf Größenänderungen
    selectable: true,
    editable: false,
    allDaySlot: false,
    slotMinTime: "08:00:00",
    slotMaxTime: "18:00:00",
    select: (info) => {
        const start = info.startStr;
        const end = info.endStr;
        emit("dateSelected", { start, end });
    },
    events: [],
    locale: "de",
    firstDay: 1,
}));
</script>
<style>
.fc {
    position: relative;
    z-index: 1000;
}
.fc-timegrid-slot,
.fc-event {
    pointer-events: auto !important;
    user-select: auto !important;
}
</style>
