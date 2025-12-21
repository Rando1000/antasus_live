<template>
    <section
        aria-labelledby="visitoranalytics-heading"
        class="p-8 bg-white shadow-lg dark:bg-gray-900 rounded-2xl"
    >
        <h2
            id="visitoranalytics-heading"
            class="mb-6 text-3xl font-extrabold text-antasus-black dark:text-white"
        >
            Besucher-Analytics
        </h2>

        <!-- KPI-Boxen -->
        <div class="grid gap-6 mb-8 md:grid-cols-4">
            <div
                class="p-5 text-center shadow bg-teal-50 dark:bg-teal-950/30 rounded-xl"
            >
                <div class="text-2xl font-bold">{{ kpis.total_visits }}</div>
                <div class="text-sm text-teal-800 dark:text-teal-300">
                    Besuche (Zeitraum)
                </div>
            </div>
            <div
                class="p-5 text-center shadow bg-indigo-50 dark:bg-indigo-950/30 rounded-xl"
            >
                <div class="text-2xl font-bold">{{ kpis.unique_visitors }}</div>
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
                    {{ kpis.unique_devices ?? "-" }}
                </div>
                <div class="text-sm text-rose-800 dark:text-rose-300">
                    Geräte insgesamt
                </div>
            </div>
        </div>

        <!-- Filter/Export/Löschen -->
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

            <button class="btn-primary" type="submit" :disabled="loading">
                {{ loading ? "Lade..." : "Filtern" }}
            </button>

            <button
                class="btn-secondary"
                type="button"
                @click="exportCSV"
                :disabled="loading"
            >
                CSV-Export
            </button>

            <button
                v-if="selectedIds.length"
                class="btn-danger"
                type="button"
                @click="deleteBulk(selectedIds)"
                :disabled="loading"
            >
                Auswahl löschen ({{ selectedIds.length }})
            </button>

            <button
                class="btn-danger"
                type="button"
                @click="deleteAll"
                v-if="stats.data.length"
                :disabled="loading"
            >
                Alle Tracks löschen
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
                >
                    <template #title>
                        <h2
                            class="text-lg font-bold text-antasus-black dark:text-white"
                        >
                            📊 Länderstatistik mit Flaggen & Export
                        </h2>
                    </template>
                </CountryChart>
            </div>
        </div>

        <!-- Tabelle -->
        <div class="overflow-x-auto">
            <table class="min-w-full text-xs border table-auto">
                <thead>
                    <tr class="bg-teal-50 dark:bg-teal-950/30">
                        <th>
                            <input
                                type="checkbox"
                                :checked="allSelected"
                                @change="toggleAll"
                            />
                        </th>
                        <th class="px-2 py-1">Datum</th>
                        <th class="px-2 py-1">IP</th>
                        <th class="px-2 py-1">Land</th>
                        <th class="px-2 py-1">Stadt</th>
                        <th class="px-2 py-1">Gerät</th>
                        <th class="px-2 py-1">URL</th>
                        <th class="px-2 py-1">Referrer</th>
                        <th class="px-2 py-1">UserAgent</th>
                        <th class="px-2 py-1">Aktion</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="row in stats.data" :key="row.id">
                        <td>
                            <input
                                type="checkbox"
                                :value="row.id"
                                v-model="selectedIds"
                                :aria-label="
                                    'Auswahl für ' + formatDate(row.visited_at)
                                "
                            />
                        </td>
                        <td class="px-2 py-1">
                            {{ formatDate(row.visited_at) }}
                        </td>
                        <td class="px-2 py-1">{{ row.ip_address }}</td>
                        <td class="flex items-center gap-2 px-2 py-1">
                            <img
                                v-if="
                                    row.country_code ||
                                    countryCodeMap[row.country]
                                "
                                :src="`https://flagcdn.com/24x18/${(
                                    row.country_code ||
                                    countryCodeMap[row.country]
                                ).toLowerCase()}.png`"
                                :alt="
                                    (row.country || row.country_code) +
                                    ' Flagge'
                                "
                                class="inline w-5 h-3 rounded-sm shadow"
                            />
                            <span>{{ row.country || "-" }}</span>
                        </td>
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
                        <td class="px-2 py-1">
                            <button
                                class="font-semibold text-red-600 hover:underline focus:outline-none"
                                title="Diesen Datensatz löschen"
                                @click="deleteVisitor(row.id)"
                                :disabled="loading"
                            >
                                Löschen
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>

            <div
                v-if="stats.data.length === 0 && !loading"
                class="mt-6 text-sm text-center text-gray-400"
            >
                Keine Statistikdaten gefunden.
            </div>

            <!-- Pagination -->
            <div class="flex flex-wrap items-center gap-2 mt-6">
                <button
                    class="btn-secondary"
                    @click="fetchStats(stats.current_page - 1)"
                    :disabled="loading || stats.current_page <= 1"
                >
                    ‹ Zurück
                </button>

                <span class="px-3 py-2">
                    {{ stats.current_page }} / {{ stats.last_page }}
                </span>

                <button
                    class="btn-secondary"
                    @click="fetchStats(stats.current_page + 1)"
                    :disabled="loading || stats.current_page >= stats.last_page"
                >
                    Weiter ›
                </button>
            </div>

            <div v-if="error" class="mt-4 text-sm text-red-600">
                {{ error }}
            </div>
        </div>
    </section>
</template>

<script setup>
import { ref, onMounted, watch, computed } from "vue";
import axios from "axios";
import TrafficChart from "./TrafficChart.vue";
import CountryChart from "./CountryChart.vue";
import { countryCodeMap } from "@/utils/countryCodeMap.js";

const defaultKpis = {
    total_visits: 0,
    unique_visitors: 0,
    top_countries: [],
    unique_devices: 0,
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
const selectedIds = ref([]);
const loading = ref(false);
const error = ref(null);

const allSelected = computed(
    () =>
        stats.value.data.length > 0 &&
        selectedIds.value.length === stats.value.data.length
);

function toggleAll(e) {
    selectedIds.value = e.target.checked
        ? stats.value.data.map((row) => row.id)
        : [];
}

function onSubmit() {
    fetchStats(1);
}

function formatDate(date) {
    return date ? new Date(date).toLocaleString() : "";
}

function prepareCharts() {
    const byHour = kpis.value.by_hour || [];
    chartData.value.byHour = {
        categories: byHour.map((e) => e.hour),
        series: [{ name: "Besucher", data: byHour.map((e) => e.count) }],
    };

    const countries = kpis.value.top_countries || [];
    chartData.value.countries = {
        categories: countries.map((e) => e.country),
        series: [{ name: "Besucher", data: countries.map((e) => e.count) }],
    };
}

/**
 * High-End Pagination: wir paginieren über "page", NICHT über prev/next URL.
 * Dadurch keine doppelten Querystrings mehr.
 */
async function fetchStats(page = 1) {
    loading.value = true;
    error.value = null;

    try {
        const res = await axios.get(endpoint, {
            params: { ...filters.value, page },
            headers: { "X-Requested-With": "XMLHttpRequest" },
            withCredentials: true,
        });

        kpis.value = res.data.kpis ?? { ...defaultKpis };
        stats.value = res.data.stats ?? {
            data: [],
            current_page: 1,
            last_page: 1,
        };
        dropdowns.value = res.data.dropdowns ?? {
            countries: [],
            cities: [],
            devices: [],
        };
        selectedIds.value = [];

        prepareCharts();
    } catch (e) {
        console.error(e);
        error.value =
            e?.response?.status === 403
                ? "Zugriff verweigert (403)."
                : "Fehler beim Laden der Visitor-Analytics.";
    } finally {
        loading.value = false;
    }
}

/**
 * CSV Download: kein window.open (Popup). Stabiler: Browser-Download via location.
 * Auth Cookies bleiben same-origin, kein Blob-Stress.
 */
function exportCSV() {
    const params = new URLSearchParams({ ...filters.value }).toString();
    window.location.href = `/admin/visitor-analytics/export?${params}`;
}

function csrfToken() {
    return document.querySelector('meta[name="csrf-token"]')?.content ?? "";
}

async function deleteVisitor(id) {
    if (!confirm("Diesen Datensatz wirklich löschen?")) return;

    loading.value = true;
    error.value = null;

    try {
        const res = await axios.delete(`/admin/visitor-analytics/${id}`, {
            headers: {
                "X-CSRF-TOKEN": csrfToken(),
                "X-Requested-With": "XMLHttpRequest",
            },
            withCredentials: true,
        });

        if (res.data?.success) fetchStats(stats.value.current_page);
        else alert("Löschen fehlgeschlagen!");
    } catch (e) {
        console.error(e);
        error.value = "Fehler beim Löschen.";
    } finally {
        loading.value = false;
    }
}

async function deleteBulk(ids) {
    if (!ids.length) return;
    if (!confirm("Wirklich alle ausgewählten Datensätze löschen?")) return;

    loading.value = true;
    error.value = null;

    try {
        const res = await axios.post(
            "/admin/visitor-analytics/bulk-delete",
            { ids },
            {
                headers: {
                    "X-CSRF-TOKEN": csrfToken(),
                    "X-Requested-With": "XMLHttpRequest",
                },
                withCredentials: true,
            }
        );

        if (res.data?.success) fetchStats(1);
        else alert("Löschen fehlgeschlagen!");
    } catch (e) {
        console.error(e);
        error.value = "Fehler beim Bulk-Löschen.";
    } finally {
        loading.value = false;
    }
}

async function deleteAll() {
    if (!confirm("Wirklich ALLE Besucherstatistiken unwiderruflich löschen?"))
        return;

    loading.value = true;
    error.value = null;

    try {
        const res = await axios.post(
            "/admin/visitor-analytics/delete-all",
            {},
            {
                headers: {
                    "X-CSRF-TOKEN": csrfToken(),
                    "X-Requested-With": "XMLHttpRequest",
                },
                withCredentials: true,
            }
        );

        if (res.data?.success) fetchStats(1);
        else alert("Löschen fehlgeschlagen!");
    } catch (e) {
        console.error(e);
        error.value = "Fehler beim Löschen aller Daten.";
    } finally {
        loading.value = false;
    }
}

/**
 * Debounce, damit watch(filters) nicht bei jedem Keypress spammt
 */
function debounce(fn, wait = 350) {
    let t;
    return (...args) => {
        clearTimeout(t);
        t = setTimeout(() => fn(...args), wait);
    };
}
const debouncedReload = debounce(() => fetchStats(1), 400);

onMounted(() => fetchStats(1));
watch(filters, () => debouncedReload(), { deep: true });
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
.btn-danger {
    @apply px-4 py-2 rounded bg-red-600 text-white font-bold hover:bg-red-700 transition;
}
.truncate {
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}
</style>
