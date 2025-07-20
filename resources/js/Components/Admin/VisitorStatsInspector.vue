<template>
    <section
        aria-labelledby="visitorstats-heading"
        class="p-6 bg-white border border-teal-100 shadow-lg mt-14 dark:bg-gray-900 dark:border-teal-900/30 rounded-2xl animate-fade-in-up"
    >
        <h2
            id="visitorstats-heading"
            class="mb-4 text-2xl font-bold text-teal-700 dark:text-teal-400"
        >
            Besucherstatistik-Cache
        </h2>

        <div
            class="flex flex-col gap-2 mb-4 sm:flex-row sm:items-end sm:justify-between"
        >
            <!-- Filters -->
            <div class="flex flex-col w-full gap-2 sm:flex-row sm:w-auto">
                <input
                    v-model.trim="search"
                    type="search"
                    class="px-3 py-2 text-xs border border-teal-200 rounded bg-teal-50 dark:bg-teal-950/40 dark:border-teal-900 focus:outline-none focus:ring-2 focus:ring-teal-400"
                    placeholder="Suche nach Key, Wert oder Ablauf …"
                    aria-label="Volltextsuche"
                    @keydown.enter.prevent="page = 1"
                />
                <input
                    v-model.trim="keyFilter"
                    type="text"
                    class="px-3 py-2 text-xs border border-teal-200 rounded bg-teal-50 dark:bg-teal-950/40 dark:border-teal-900 focus:outline-none focus:ring-2 focus:ring-teal-400"
                    placeholder="Filter nach Key (z.B. visitors_stats:2025)"
                    aria-label="Key-Filter"
                    @keydown.enter.prevent="page = 1"
                />
                <button
                    @click="refresh"
                    :disabled="loading"
                    class="flex items-center px-3 py-2 text-xs font-semibold text-white rounded shadow bg-emerald-600 hover:bg-emerald-700 focus-visible:ring-2 focus-visible:ring-emerald-300 disabled:opacity-50"
                >
                    <svg
                        v-if="loading"
                        class="w-4 h-4 mr-1 animate-spin"
                        viewBox="0 0 20 20"
                        fill="none"
                        aria-hidden="true"
                    >
                        <circle
                            cx="10"
                            cy="10"
                            r="8"
                            stroke="currentColor"
                            stroke-width="3"
                        />
                    </svg>
                    <span>Neu laden</span>
                </button>
            </div>
            <!-- Actions -->
            <div class="flex flex-row gap-2">
                <button
                    @click="exportCSV"
                    :disabled="filteredStats.length === 0"
                    class="px-3 py-2 text-xs font-semibold text-white bg-indigo-600 rounded shadow hover:bg-indigo-700 focus-visible:ring-2 focus-visible:ring-indigo-300 disabled:opacity-50"
                >
                    Export als CSV
                </button>
                <button
                    @click="confirmBulkDelete"
                    :disabled="loading || filteredStats.length === 0"
                    class="px-3 py-2 text-xs font-semibold text-white bg-red-600 rounded shadow hover:bg-red-700 focus-visible:ring-2 focus-visible:ring-red-300 disabled:opacity-50"
                >
                    <span v-if="filteredStats.length === 0">Alle löschen</span>
                    <span v-else>Alle Gefilterten löschen</span>
                </button>
            </div>
        </div>

        <!-- Pagination -->
        <div v-if="pageCount > 1" class="flex items-center gap-2 mb-2 text-xs">
            <button
                class="px-2 py-1 rounded hover:bg-teal-50 dark:hover:bg-teal-900/10 focus:outline-none"
                :disabled="page === 1"
                @click="page--"
                aria-label="Zurück"
            >
                ◀
            </button>
            <span>Seite {{ page }} von {{ pageCount }}</span>
            <button
                class="px-2 py-1 rounded hover:bg-teal-50 dark:hover:bg-teal-900/10 focus:outline-none"
                :disabled="page === pageCount"
                @click="page++"
                aria-label="Vor"
            >
                ▶
            </button>
            <span class="ml-2 text-gray-500">Ergebnisse pro Seite:</span>
            <select
                v-model.number="perPage"
                class="px-2 py-1 ml-1 text-xs border rounded"
            >
                <option
                    v-for="size in [10, 20, 50, 100]"
                    :key="size"
                    :value="size"
                >
                    {{ size }}
                </option>
            </select>
        </div>

        <div v-if="loading" class="py-8 text-center text-gray-400">
            Lade Daten …
        </div>

        <div v-else>
            <table
                class="w-full mt-2 overflow-hidden text-xs border table-auto rounded-xl"
            >
                <thead>
                    <tr class="bg-teal-50 dark:bg-teal-950/30">
                        <th class="px-2 py-1 font-semibold text-left">Key</th>
                        <th class="px-2 py-1 font-semibold text-left">Wert</th>
                        <th class="px-2 py-1 font-semibold text-left">
                            Ablauf
                        </th>
                        <th class="px-2 py-1 font-semibold text-left">
                            Aktion
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        v-for="entry in paginatedStats"
                        :key="entry.key"
                        class="transition border-t hover:bg-teal-50/60 dark:hover:bg-teal-900/10 group"
                    >
                        <td class="px-2 py-1 font-mono break-all">
                            {{ entry.key }}
                        </td>
                        <td class="max-w-xs px-2 py-1 font-mono">
                            <template v-if="isObject(entry.value)">
                                <button
                                    class="px-1 py-0.5 mb-1 text-[10px] rounded bg-gray-200 dark:bg-gray-800 text-gray-800 dark:text-gray-100"
                                    @click="toggleExpand(entry)"
                                    :aria-expanded="entry._expanded || false"
                                >
                                    <span v-if="entry._expanded">Weniger</span>
                                    <span v-else>Mehr</span>
                                </button>
                                <pre
                                    v-if="entry._expanded"
                                    class="whitespace-pre-wrap max-w-[400px]"
                                    >{{ prettyJson(entry.value) }}</pre
                                >
                                <span
                                    v-else
                                    class="truncate max-w-[130px] inline-block align-top"
                                    >Objekt…</span
                                >
                            </template>
                            <template v-else>
                                {{ entry.value }}
                            </template>
                        </td>
                        <td class="px-2 py-1">
                            {{ formatExpiration(entry.expiration) }}
                        </td>
                        <td class="px-2 py-1">
                            <button
                                @click="deleteEntry(entry.key)"
                                :disabled="loading"
                                class="inline-flex items-center gap-1 font-semibold text-red-600 hover:underline focus:outline-none focus-visible:ring-2 focus-visible:ring-red-300 disabled:opacity-50"
                                title="Diesen Eintrag löschen"
                                :aria-label="`Eintrag ${entry.key} löschen`"
                            >
                                <svg
                                    class="w-4 h-4"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    viewBox="0 0 24 24"
                                >
                                    <path d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                <span class="sr-only">Löschen</span>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div
                v-if="filteredStats.length === 0"
                class="mt-6 text-sm text-center text-gray-400"
            >
                Keine Statistikdaten gefunden.
            </div>
        </div>
    </section>
</template>

<script setup>
import { ref, computed, watch, onMounted } from "vue";

const stats = ref([]);
const loading = ref(false);

const search = ref("");
const keyFilter = ref("");
const page = ref(1);
const perPage = ref(20);

function fetchStats() {
    loading.value = true;
    fetch("/admin/visitor-stats?inertia=0")
        .then((r) => r.json())
        .then((data) => {
            stats.value = data.stats ?? [];
            loading.value = false;
            page.value = 1;
        })
        .catch(() => {
            stats.value = [];
            loading.value = false;
        });
}
function refresh() {
    fetchStats();
}

const filteredStats = computed(() => {
    let list = stats.value;
    if (keyFilter.value) {
        list = list.filter((e) =>
            (e.key || "").toLowerCase().includes(keyFilter.value.toLowerCase())
        );
    }
    if (search.value) {
        const s = search.value.toLowerCase();
        list = list.filter(
            (e) =>
                (e.key && e.key.toLowerCase().includes(s)) ||
                (typeof e.value === "string" &&
                    e.value.toLowerCase().includes(s)) ||
                (isObject(e.value) &&
                    JSON.stringify(e.value).toLowerCase().includes(s)) ||
                (e.expiration &&
                    formatExpiration(e.expiration).toLowerCase().includes(s))
        );
    }
    return list;
});

const pageCount = computed(() =>
    Math.max(1, Math.ceil(filteredStats.value.length / perPage.value))
);
const paginatedStats = computed(() => {
    const start = (page.value - 1) * perPage.value;
    return filteredStats.value.slice(start, start + perPage.value);
});
watch([search, keyFilter, perPage], () => {
    page.value = 1;
});

function exportCSV() {
    if (!filteredStats.value.length) return;
    const csvRows = [["Key", "Wert", "Ablauf"]];
    filteredStats.value.forEach((entry) => {
        csvRows.push([
            entry.key,
            isObject(entry.value) ? JSON.stringify(entry.value) : entry.value,
            formatExpiration(entry.expiration),
        ]);
    });
    const blob = new Blob(
        [
            csvRows
                .map((r) =>
                    r.map((f) => `"${String(f).replace(/"/g, '""')}"`).join(";")
                )
                .join("\n"),
        ],
        { type: "text/csv;charset=utf-8" }
    );
    const link = document.createElement("a");
    link.href = URL.createObjectURL(blob);
    link.download = "visitor_stats.csv";
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}

// === Actions
async function deleteEntry(key) {
    if (!confirm("Diesen Cache-Eintrag wirklich löschen?")) return;
    loading.value = true;
    try {
        const response = await fetch("/admin/visitor-stats/delete", {
            method: "delete",
            headers: {
                "Content-Type": "application/json",
                "X-Requested-With": "XMLHttpRequest",
                "X-CSRF-TOKEN": document.querySelector(
                    'meta[name="csrf-token"]'
                ).content,
            },
            body: JSON.stringify({ key }),
        });
        const result = await response.json();
        if (result.success) {
            // Sofort lokal entfernen für Top-UX
            stats.value = stats.value.filter((e) => e.key !== key);
        } else {
            alert("Löschen fehlgeschlagen!");
        }
    } catch (e) {
        alert("Löschen fehlgeschlagen!");
    } finally {
        loading.value = false;
    }
}
function confirmBulkDelete() {
    if (
        filteredStats.value.length === 0 &&
        !confirm("Wirklich ALLE Statistik-Einträge löschen?")
    )
        return;
    if (
        filteredStats.value.length > 0 &&
        !confirm("Wirklich ALLE gefilterten Einträge löschen?")
    )
        return;
    loading.value = true;
    const csrf = document
        .querySelector('meta[name="csrf-token"]')
        ?.getAttribute("content");
    const keys =
        filteredStats.value.length > 0
            ? filteredStats.value.map((e) => e.key)
            : [];
    fetch("/admin/visitor-stats/bulk-delete", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": csrf,
            "X-Requested-With": "XMLHttpRequest",
        },
        body: JSON.stringify({ keys }),
    })
        .then((r) => r.json())
        .then((data) => {
            loading.value = false;
            if (data.success) {
                // Sofort lokal filtern statt reload
                if (keys.length > 0) {
                    stats.value = stats.value.filter(
                        (e) => !keys.includes(e.key)
                    );
                } else {
                    stats.value = [];
                }
                alert(`${data.deleted} Einträge wurden gelöscht.`);
            } else {
                alert("Fehler beim Löschen!");
            }
        })
        .catch(() => {
            loading.value = false;
            alert("Fehler beim Löschen!");
        });
}

function formatExpiration(ts) {
    if (!ts) return "-";
    const date = new Date(ts * 1000);
    return date.toLocaleString("de-DE");
}
function prettyJson(obj) {
    try {
        return JSON.stringify(obj, null, 2);
    } catch {
        return obj;
    }
}
function isObject(val) {
    return val && typeof val === "object" && !Array.isArray(val);
}
function toggleExpand(entry) {
    entry._expanded = !entry._expanded;
}

onMounted(fetchStats);
</script>

<style scoped>
@keyframes fade-in-up {
    from {
        opacity: 0;
        transform: translateY(24px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
.animate-fade-in-up {
    animation: fade-in-up 0.7s cubic-bezier(0.33, 1, 0.68, 1) both;
}
.truncate {
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}
</style>
