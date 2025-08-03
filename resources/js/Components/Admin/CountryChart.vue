<script setup>
import { ref, watch, onMounted, onUnmounted } from "vue";
import ApexCharts from "apexcharts";
import { countryCodeMap } from "@/utils/countryCodeMap.js";

const props = defineProps({
    series: { type: Array, required: true, default: () => [] },
    categories: { type: Array, required: true, default: () => [] },
});

const emit = defineEmits(["export"]);
const chartRef = ref(null);
let chart = null;

// Dynamische Farbe aus Ländercode generieren
function getColorFromCountry(country) {
    const hash = country
        .split("")
        .reduce((acc, char) => acc + char.charCodeAt(0), 0);
    const hue = hash % 360;
    return `hsl(${hue}, 70%, 50%)`;
}

function safeSeries(series) {
    if (!Array.isArray(series)) return [{ name: "Besucher", data: [] }];
    return series.map((s) => ({
        name: s?.name ?? "Besucher",
        data: Array.isArray(s?.data) ? s.data : [],
    }));
}
function safeCategories(categories) {
    return Array.isArray(categories) ? categories.filter(Boolean) : [];
}

function renderChart() {
    if (chart) chart.destroy();

    const series = safeSeries(props.series);
    const categories = safeCategories(props.categories);

    chart = new ApexCharts(chartRef.value, {
        chart: {
            type: "bar",
            height: 260,
            toolbar: {
                show: true,
                tools: {
                    download: true,
                    selection: false,
                    zoom: false,
                    zoomin: false,
                    zoomout: false,
                    pan: false,
                    reset: false,
                },
            },
            foreColor: "#0f172a",
            fontFamily: "inherit",
            animations: { enabled: true },
        },
        theme: {
            mode: document.documentElement.classList.contains("dark")
                ? "dark"
                : "light",
        },
        series,
        xaxis: {
            categories,
            labels: { show: true, rotate: -25 },
            title: { text: "Land", style: { fontWeight: 600 } },
        },
        yaxis: {
            labels: { show: true },
            title: { text: "Besucher", style: { fontWeight: 600 } },
        },
        colors: categories.map(getColorFromCountry),
        grid: { borderColor: "#e2e8f0", strokeDashArray: 4 },
        plotOptions: {
            bar: { borderRadius: 4, horizontal: true },
        },
        tooltip: {
            custom: ({ series, seriesIndex, dataPointIndex, w }) => {
                const country = w.globals.labels[dataPointIndex];
                const code = countryCodeMap[country]?.toLowerCase() || "";
                const flag = code
                    ? `<img src="https://flagcdn.com/24x18/${code}.png" style="width:20px;height:14px;border-radius:2px;margin-right:6px;vertical-align:middle"/>`
                    : "🏳️";
                const count = series[seriesIndex][dataPointIndex];
                return `<div style="padding:4px 8px;font-size:13px;">
                    ${flag} <strong>${country}</strong><br/>
                    Besucher: <b>${count}</b>
                </div>`;
            },
        },
        noData: {
            text: "Keine Länderstatistik verfügbar",
            align: "center",
            verticalAlign: "middle",
            style: {
                color: "#94a3b8",
                fontSize: "15px",
            },
        },
        accessibility: {
            enabled: true,
            keyboardNavigation: { enabled: true },
        },
    });

    chart.render();
}

onMounted(renderChart);
onUnmounted(() => {
    if (chart) chart.destroy();
});
watch(() => [props.series, props.categories], renderChart, { deep: true });

// Optionaler Export als PNG
function exportPNG() {
    chart?.dataURI().then(({ imgURI }) => {
        const a = document.createElement("a");
        a.href = imgURI;
        a.download = "chart.png";
        a.click();
    });
}
</script>

<template>
    <div class="space-y-4">
        <!-- Slot für eigene Überschrift -->
        <slot name="title">
            <h3 class="mb-2 font-semibold text-teal-600 dark:text-teal-400">
                Besucher nach Ländern
            </h3>
        </slot>

        <!-- Chart-Wrapper -->
        <div class="relative">
            <div
                ref="chartRef"
                class="w-full"
                tabindex="0"
                aria-label="Top Länder Chart"
            ></div>
            <button
                @click="exportPNG"
                class="absolute top-0 right-0 px-3 py-1 mt-2 mr-2 text-xs font-semibold text-white bg-black rounded bg-opacity-60 hover:bg-opacity-80"
                title="Diagramm als PNG exportieren"
            >
                PNG-Export
            </button>
        </div>

        <!-- Flaggen-Legende -->
        <div class="grid grid-cols-2 gap-2 text-sm md:grid-cols-3">
            <div
                v-for="country in props.categories"
                :key="country"
                class="flex items-center gap-2"
            >
                <img
                    v-if="countryCodeMap[country]"
                    :src="`https://flagcdn.com/24x18/${countryCodeMap[
                        country
                    ].toLowerCase()}.png`"
                    :alt="`${country} Flagge`"
                    class="w-5 h-3 rounded-sm shadow"
                />
                <div class="truncate" :title="country">{{ country }}</div>
            </div>
        </div>
    </div>
</template>

<style scoped>
:deep(.apexcharts-tooltip) {
    font-size: 13px;
}
</style>
