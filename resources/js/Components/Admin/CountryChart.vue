<script setup>
import { ref, watch, onMounted, onUnmounted } from "vue";
import ApexCharts from "apexcharts";

const props = defineProps({
    // Immer ein Array, default = leeres Array
    series: { type: Array, required: true, default: () => [] },
    categories: { type: Array, required: true, default: () => [] },
});

const chartRef = ref(null);
let chart = null;

// Hilfsfunktion für defensive Datenvalidierung
function safeSeries(series) {
    // series: [{ name: "Besucher", data: [...] }]
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
    // Defensive Datenaufbereitung
    const series = safeSeries(props.series);
    const categories = safeCategories(props.categories);

    // Destroy alt-Chart
    if (chart) chart.destroy();

    chart = new ApexCharts(chartRef.value, {
        chart: {
            type: "bar",
            height: 220,
            toolbar: { show: false },
            foreColor: "#334155",
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
        colors: ["#6366f1"],
        grid: { borderColor: "#e2e8f0", strokeDashArray: 4 },
        plotOptions: {
            bar: { borderRadius: 4, horizontal: true },
        },
        tooltip: {
            theme: document.documentElement.classList.contains("dark")
                ? "dark"
                : "light",
        },
        noData: {
            text: "Keine Daten für Länder verfügbar",
            align: "center",
            verticalAlign: "middle",
            style: {
                color: "#a0aec0",
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

// Re-Render bei Prop-Änderung
watch(() => [props.series, props.categories], renderChart, { deep: true });
</script>

<template>
    <div
        ref="chartRef"
        class="w-full"
        tabindex="0"
        aria-label="Diagramm Top-Länder"
    ></div>
</template>
