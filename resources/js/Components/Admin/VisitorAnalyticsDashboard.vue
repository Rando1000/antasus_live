<template>
    <section class="p-8 bg-white shadow-lg dark:bg-gray-900 rounded-2xl">
        <h2
            class="mb-6 text-3xl font-extrabold text-antasus-black dark:text-white"
        >
            Besucher-Analytics
        </h2>

        <!-- KPIs -->
        <div class="grid gap-6 mb-8 md:grid-cols-4">
            <div
                class="p-5 text-center shadow bg-teal-50 dark:bg-teal-950/30 rounded-xl"
            >
                <div class="text-2xl font-bold">
                    {{ kpis.total_visits }}
                </div>
                <div class="text-sm text-teal-800 dark:text-teal-300">
                    Besuche (Zeitraum)
                </div>
            </div>
            <div
                class="p-5 text-center shadow bg-indigo-50 dark:bg-indigo-950/30 rounded-xl"
            >
                <div class="text-2xl font-bold">
                    {{ kpis.unique_visitors }}
                </div>
                <div class="text-sm text-indigo-800 dark:text-indigo-300">
                    Eindeutige Besucher
                </div>
            </div>
            <div
                class="p-5 text-center shadow bg-emerald-50 dark:bg-emerald-950/30 rounded-xl"
            >
                <div class="text-2xl font-bold">
                    {{ kpis.top_countries?.[0]?.country || "-" }}
                </div>
                <div class="text-sm text-emerald-800 dark:text-emerald-300">
                    Top-Land
                </div>
            </div>
            <div
                class="p-5 text-center shadow bg-rose-50 dark:bg-rose-950/30 rounded-xl"
            >
                <div class="text-2xl font-bold">
                    {{ kpis.unique_devices?.count || "-" }}
                </div>
                <div class="text-sm text-rose-800 dark:text-rose-300">
                    Geräte insgesamt
                </div>
            </div>
        </div>

        <!-- Filter + Export -->
        <form
            class="flex flex-wrap items-end gap-3 mb-8"
            @submit.prevent="onSubmit"
        >
            <input
                v-model="filters.search"
                class="input"
                placeholder="Suche IP, Stadt, URL, etc."
            />
            <select v-model="filters.country" class="input">
                <option value="">Land</option>
                <option v-for="c in dropdowns.countries" :key="c" :value="c">
                    {{ c }}
                </option>
            </select>
            <select v-model="filters.city" class="input">
                <option value="">Stadt</option>
                <option v-for="c in dropdowns.cities" :key="c" :value="c">
                    {{ c }}
                </option>
            </select>
            <select v-model="filters.device_type" class="input">
                <option value="">Gerät</option>
                <option v-for="d in dropdowns.devices" :key="d" :value="d">
                    {{ d }}
                </option>
            </select>
            <input type="date" v-model="filters.from" class="input" />
            <input type="date" v-model="filters.to" class="input" />
            <button class="btn-primary" type="submit">Filtern</button>
            <button class="btn-secondary" @click.prevent="exportCSV">
                CSV-Export
            </button>
        </form>

        <!-- Charts -->
        <div class="grid gap-6 mb-8 md:grid-cols-2">
            <div class="p-3 bg-white rounded shadow dark:bg-gray-800">
                <h3 class="mb-2 font-semibold text-teal-600 dark:text-teal-400">
                    Traffic Verlauf
                </h3>
                <TrafficChart
                    :series="chartData.byHour.series"
                    :categories="chartData.byHour.categories"
                />
            </div>
            <div class="p-3 bg-white rounded shadow dark:bg-gray-800">
                <h3 class="mb-2 font-semibold text-teal-600 dark:text-teal-400">
                    Top Länder
                </h3>
                <CountryChart
                    :series="chartData.countries.series"
                    :categories="chartData.countries.categories"
                />
            </div>
        </div>

        <!-- Tabelle -->
        <div class="overflow-x-auto">
            <table class="min-w-full text-xs border table-auto">
                <thead>
                    <tr class="bg-teal-50 dark:bg-teal-950/30">
                        <th class="px-2 py-1">Datum</th>
                        <th class="px-2 py-1">IP</th>
                        <th class="px-2 py-1">Land</th>
                        <th class="px-2 py-1">Stadt</th>
                        <th class="px-2 py-1">Gerät</th>
                        <th class="px-2 py-1">URL</th>
                        <th class="px-2 py-1">Referrer</th>
                        <th class="px-2 py-1">UserAgent</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="row in stats.data" :key="row.id">
                        <td class="px-2 py-1">
                            {{ formatDate(row.visited_at) }}
                        </td>
                        <td class="px-2 py-1">{{ row.ip_address }}</td>
                        <td class="px-2 py-1">{{ row.country }}</td>
                        <td class="px-2 py-1">{{ row.city }}</td>
                        <td class="px-2 py-1">{{ row.device_type }}</td>
                        <td
                            class="px-2 py-1 truncate max-w-[150px]"
                            :title="row.url"
                        >
                            {{ row.url }}
                        </td>
                        <td
                            class="px-2 py-1 truncate max-w-[150px]"
                            :title="row.referer"
                        >
                            {{ row.referer }}
                        </td>
                        <td
                            class="px-2 py-1 truncate max-w-[200px]"
                            :title="row.user_agent"
                        >
                            {{ row.user_agent }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <!-- Pagination -->
            <div class="flex flex-wrap gap-2 mt-6">
                <button
                    class="btn-secondary"
                    @click="changePage(stats.prev_page_url)"
                    :disabled="!stats.prev_page_url"
                >
                    ‹ Zurück
                </button>
                <span class="px-3 py-2"
                    >{{ stats.current_page }} / {{ stats.last_page }}</span
                >
                <button
                    class="btn-secondary"
                    @click="changePage(stats.next_page_url)"
                    :disabled="!stats.next_page_url"
                >
                    Weiter ›
                </button>
            </div>
        </div>
    </section>
</template>

<script setup>
import { ref, onMounted, watch } from "vue";
import TrafficChart from "./TrafficChart.vue";
import CountryChart from "./CountryChart.vue";

const defaultKpis = {
    total_visits: 0,
    unique_visitors: 0,
    top_countries: [],
    devices: [],
    by_hour: [],
};

const kpis = ref({ ...defaultKpis });
const stats = ref({ data: [], current_page: 1, last_page: 1 });
const chartData = ref({
    byHour: { series: [], categories: [] },
    countries: { series: [], categories: [] },
});
const dropdowns = ref({ countries: [], cities: [], devices: [] });
const filters = ref({
    from: new Date().toISOString().slice(0, 10),
    to: new Date().toISOString().slice(0, 10),
    search: "",
    country: "",
    city: "",
    device_type: "",
    per_page: 30,
});
const endpoint = "/admin/visitor-analytics";

function onSubmit(e) {
    fetchStats();
}

function fetchStats(param) {
    // Wenn das erste Argument ein SubmitEvent ist, dann verwende das endpoint!
    if (param && typeof param.preventDefault === "function") {
        param.preventDefault();
        param = undefined;
    }
    const url = typeof param === "string" ? param : endpoint;
    const params = new URLSearchParams(filters.value).toString();
    fetch(`${url}?${params}`)
        .then((res) => res.json())
        .then((data) => {
            kpis.value = data.kpis;
            stats.value = data.stats;
            dropdowns.value = data.dropdowns;
            prepareCharts();
        });
}

function changePage(url) {
    if (url) fetchStats(url);
}

function exportCSV() {
    const params = new URLSearchParams(filters.value).toString();
    window.open(`/admin/visitor-analytics/export?${params}`, "_blank");
}

function formatDate(date) {
    return date ? new Date(date).toLocaleString() : "";
}

function prepareCharts() {
    // Prepare TrafficChart
    const byHour = kpis.value.by_hour || [];
    chartData.value.byHour = {
        categories: byHour.map((e) => e.hour),
        series: [{ name: "Besucher", data: byHour.map((e) => e.count) }],
    };
    // Prepare CountryChart
    const countries = kpis.value.top_countries || [];
    chartData.value.countries = {
        categories: countries.map((e) => e.country),
        series: [{ name: "Besucher", data: countries.map((e) => e.count) }],
    };
}

onMounted(fetchStats);
watch(filters, () => fetchStats(), { deep: true });
</script>

<style scoped>
.input {
    @apply px-3 py-2 rounded border border-gray-200 dark:bg-gray-800 dark:border-gray-700 text-sm;
}
.btn-primary {
    @apply px-4 py-2 rounded bg-teal-600 text-white font-bold hover:bg-teal-700 transition;
}
.btn-secondary {
    @apply px-4 py-2 rounded bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 font-semibold hover:bg-gray-300 dark:hover:bg-gray-600 transition;
}
.truncate {
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}
</style>
