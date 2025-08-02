<script setup>
import { ref, watch, onMounted, onUnmounted } from "vue";
import ApexCharts from "apexcharts";

const props = defineProps({
    series: { type: Array, default: () => [] },
    categories: { type: Array, default: () => [] },
});

const chartRef = ref(null);
let chart = null;

function safeSeries(series) {
    if (
        !Array.isArray(series) ||
        !series.length ||
        !series[0] ||
        !Array.isArray(series[0].data)
    ) {
        return [{ name: "Besucher", data: [] }];
    }
    const cleanedData = series[0].data.map((x) =>
        typeof x === "number" && isFinite(x) ? x : 0
    );
    return [{ name: series[0].name || "Besucher", data: cleanedData }];
}

function safeCategories(categories) {
    if (!Array.isArray(categories)) return [];
    return categories.map((x) => x ?? "");
}

function renderChart() {
    if (!chartRef.value) return;
    if (chart) {
        chart.destroy();
        chart = null;
    }
    const finalSeries = safeSeries(props.series);
    const finalCategories = safeCategories(props.categories);

    chart = new ApexCharts(chartRef.value, {
        chart: {
            type: "line",
            height: 220,
            toolbar: { show: false },
            foreColor: "#334155",
            fontFamily: "inherit",
            animations: { enabled: true, easing: "easeinout", speed: 450 },
        },
        theme: {
            mode: document.documentElement.classList.contains("dark")
                ? "dark"
                : "light",
        },
        series: finalSeries,
        xaxis: {
            categories: finalCategories,
            labels: { show: true, rotate: -45 },
        },
        yaxis: { labels: { show: true } },
        stroke: { curve: "smooth", width: 3 },
        grid: { borderColor: "#e2e8f0", strokeDashArray: 4 },
        colors: ["#00fdcf"],
        markers: { size: 3, colors: ["#00fdcf"], strokeColors: "#000" },
        tooltip: {
            theme: document.documentElement.classList.contains("dark")
                ? "dark"
                : "light",
        },
        noData: {
            text: "Keine Daten verfügbar",
            align: "center",
            verticalAlign: "middle",
            style: {
                color: "#94a3b8",
                fontSize: "16px",
            },
        },
        responsive: [
            {
                breakpoint: 640,
                options: { chart: { height: 160 } },
            },
        ],
    });
    chart.render();
}

onUnmounted(() => {
    if (chart) chart.destroy();
});
watch(() => [props.series, props.categories], renderChart, { deep: true });
onMounted(renderChart);
</script>

<template>
    <div ref="chartRef" class="w-full" aria-label="Traffic Verlauf Chart"></div>
</template>
