<script setup>
import { ref, watch, onMounted, onUnmounted } from "vue";
import ApexCharts from "apexcharts";

const props = defineProps({
    series: { type: Array, required: true },
    categories: { type: Array, required: true },
});

const chartRef = ref(null);
let chart = null;

function renderChart() {
    if (chart) chart.destroy();
    chart = new ApexCharts(chartRef.value, {
        chart: {
            type: "bar",
            height: 220,
            toolbar: { show: false },
            foreColor: "#334155",
            fontFamily: "inherit",
        },
        theme: {
            mode: document.documentElement.classList.contains("dark")
                ? "dark"
                : "light",
        },
        series: props.series,
        xaxis: {
            categories: props.categories,
            labels: { show: true, rotate: -25 },
        },
        yaxis: { labels: { show: true } },
        colors: ["#6366f1"],
        grid: { borderColor: "#e2e8f0", strokeDashArray: 4 },
        plotOptions: { bar: { borderRadius: 4, horizontal: true } },
        tooltip: {
            theme: document.documentElement.classList.contains("dark")
                ? "dark"
                : "light",
        },
    });
    chart.render();
}

onMounted(renderChart);
onUnmounted(() => chart && chart.destroy());

watch(() => [props.series, props.categories], renderChart, { deep: true });
</script>

<template>
    <div ref="chartRef" class="w-full"></div>
</template>
