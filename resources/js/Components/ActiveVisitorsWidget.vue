<!-- Components/Admin/ActiveVisitorsWidget.vue -->
<template>
    <div
        class="flex flex-col items-center gap-4 p-6 bg-white border border-teal-100 shadow-lg rounded-2xl dark:bg-gray-900 dark:border-teal-900/30"
    >
        <div class="flex items-center w-full gap-3">
            <span
                class="inline-flex items-center justify-center text-white rounded-full shadow w-14 h-14 bg-gradient-to-br from-teal-400 to-indigo-600"
                aria-hidden="true"
            >
                <EyeIcon class="w-7 h-7" />
            </span>
            <div class="flex-1 min-w-0">
                <div class="mb-1 text-xs font-semibold text-gray-400 uppercase">
                    Aktive Besucher
                    <span
                        class="font-normal text-[10px] text-gray-300 dark:text-gray-600"
                        >(letzte 10 min)</span
                    >
                </div>
                <div
                    class="flex items-end gap-1 text-4xl font-extrabold leading-none text-antasus-black dark:text-white animate-pulse"
                >
                    <transition name="counter" mode="out-in">
                        <span
                            :key="current"
                            class="transition-all ease-out duration-400"
                            >{{ current }}</span
                        >
                    </transition>
                </div>
            </div>
        </div>
        <div class="flex items-center justify-between w-full mt-2">
            <div class="flex items-center gap-2">
                <span
                    v-for="option in ranges"
                    :key="option.value"
                    @click="setRange(option.value)"
                    :tabindex="0"
                    @keydown.enter="setRange(option.value)"
                    :class="[
                        'px-3 py-1 text-xs rounded-lg cursor-pointer font-semibold transition',
                        selectedRange === option.value
                            ? 'bg-teal-500 text-white shadow ring-2 ring-teal-400 dark:ring-teal-700'
                            : 'bg-teal-50 text-teal-700 hover:bg-teal-100 dark:bg-teal-800/60 dark:text-teal-200 dark:hover:bg-teal-800/80',
                    ]"
                    :aria-current="selectedRange === option.value"
                    :aria-label="`Zeitraum: ${option.label}`"
                >
                    {{ option.label }}
                </span>
            </div>
            <span
                class="mr-1 text-xs text-gray-400 select-none dark:text-gray-500"
                >{{ chartLabel }}</span
            >
        </div>
        <div class="relative w-full mt-1 h-28">
            <canvas ref="chartRef" class="h-full"></canvas>
            <!-- Dezent am Chart-Ende: Min/Max-Beschriftung -->
            <span
                v-if="history.length"
                class="absolute bottom-1 left-2 text-[10px] text-gray-400 dark:text-gray-600"
                >{{ history[0].time }}</span
            >
            <span
                v-if="history.length"
                class="absolute bottom-1 right-2 text-[10px] text-gray-400 dark:text-gray-600"
                >{{ history[history.length - 1].time }}</span
            >
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted, watch, computed } from "vue";
import { EyeIcon } from "@heroicons/vue/24/solid";

const chartRef = ref(null);
const chartInstance = ref(null);
const current = ref(0);
const history = ref([]);
const selectedRange = ref("1h");
const ranges = [
    { value: "1h", label: "1h" },
    { value: "6h", label: "6h" },
    { value: "24h", label: "24h" },
];

const chartLabel = computed(() =>
    selectedRange.value === "1h"
        ? "letzte Stunde (2 min)"
        : selectedRange.value === "6h"
        ? "letzte 6 Stunden (10 min)"
        : "letzte 24h (60 min)"
);

function setRange(r) {
    if (selectedRange.value !== r) {
        selectedRange.value = r;
    }
}

async function fetchData() {
    try {
        const r = await fetch(
            `/admin/active-visitors-history?range=${selectedRange.value}`
        );
        const data = await r.json();
        // Mini-Animation bei Wertänderung
        if (current.value !== (data.current ?? 0)) {
            current.value = 0;
            setTimeout(() => {
                current.value = data.current ?? 0;
            }, 100); // Animation reset
        } else {
            current.value = data.current ?? 0;
        }
        history.value = data.history ?? [];
        renderChart();
    } catch {
        current.value = 0;
        history.value = [];
        renderChart();
    }
}

function renderChart() {
    if (!window.Chart || !chartRef.value) return;
    if (chartInstance.value) chartInstance.value.destroy();
    const ctx = chartRef.value.getContext("2d");
    // Verlauf: dynamisch, CI/CD-konform
    const gradient = ctx.createLinearGradient(0, 0, 0, 120);
    gradient.addColorStop(0, "#00fdcf99"); // teal, 60%
    gradient.addColorStop(0.7, "#6366f155"); // indigo, 33%
    gradient.addColorStop(1, "#fff0"); // transparent

    chartInstance.value = new window.Chart(ctx, {
        type: "line",
        data: {
            labels: history.value.map((h) => h.time),
            datasets: [
                {
                    label: "Besucher",
                    data: history.value.map((h) => h.count),
                    borderColor: "#00fdcf",
                    backgroundColor: gradient,
                    pointRadius: 2.5,
                    pointHoverRadius: 7,
                    tension: 0.34,
                    fill: true,
                    borderWidth: 2.2,
                    pointBackgroundColor: "#00fdcf",
                },
            ],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: {
                    grid: { display: false },
                    ticks: { autoSkip: true, maxTicksLimit: 9 },
                },
                y: {
                    beginAtZero: true,
                    grid: { color: "#e5e7eb22" },
                    ticks: { stepSize: 1, precision: 0, font: { size: 10 } },
                },
            },
            plugins: {
                legend: { display: false },
                tooltip: {
                    enabled: true,
                    backgroundColor: "#18181b",
                    borderColor: "#00fdcf",
                    borderWidth: 1.2,
                    bodyColor: "#fff",
                    titleColor: "#00fdcf",
                    padding: 10,
                    callbacks: {
                        title: (ctx) => `Zeit: ${ctx[0].label}`,
                        label: (ctx) => `Besucher: ${ctx.parsed.y}`,
                    },
                    displayColors: false,
                },
            },
            animation: {
                duration: 650,
                easing: "cubicBezier(.22,1,.36,1)",
            },
        },
    });
}

// Polling & Update bei Range-Wechsel
onMounted(() => {
    fetchData();
    setInterval(fetchData, 14000);
});
watch(selectedRange, fetchData);
</script>

<style scoped>
.counter-enter-active,
.counter-leave-active {
    transition: opacity 0.4s cubic-bezier(0.4, 1.6, 0.6, 1),
        transform 0.4s cubic-bezier(0.4, 1.6, 0.6, 1);
}
.counter-enter-from,
.counter-leave-to {
    opacity: 0;
    transform: translateY(-8px) scale(0.95);
}
.counter-enter-to,
.counter-leave-from {
    opacity: 1;
    transform: translateY(0) scale(1);
}
</style>
