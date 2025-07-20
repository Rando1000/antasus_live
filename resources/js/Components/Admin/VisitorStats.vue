<template>
    <section
        aria-labelledby="visitorstats-heading"
        class="p-6 mt-10 bg-white border border-teal-100 shadow-lg dark:bg-gray-900 dark:border-teal-900/30 rounded-2xl"
    >
        <header class="flex flex-wrap items-center justify-between gap-2 mb-4">
            <h1
                id="visitorstats-heading"
                class="text-2xl font-bold text-teal-700 dark:text-teal-400"
            >
                Besucherstatistik (Cache)
            </h1>
            <button
                @click="showBulkDeleteModal = true"
                class="px-4 py-2 text-xs font-semibold text-white bg-red-600 rounded shadow hover:bg-red-700 focus-visible:ring-2 focus-visible:ring-red-300"
                :aria-disabled="loading"
                :disabled="loading"
            >
                Alle Statistik-Einträge löschen
            </button>
        </header>

        <!-- Info -->
        <p class="mb-3 text-sm text-gray-600 dark:text-gray-300">
            Die folgende Übersicht zeigt alle gecachten Besucherstatistiken. Du
            kannst Einträge einzeln inspizieren, löschen oder als JSON öffnen.
        </p>

        <!-- Loading -->
        <div
            v-if="loading"
            class="py-8 text-center text-gray-400 animate-pulse"
        >
            <span class="inline-flex items-center gap-2">
                <svg
                    class="w-5 h-5 animate-spin"
                    fill="none"
                    viewBox="0 0 24 24"
                >
                    <circle
                        class="opacity-30"
                        cx="12"
                        cy="12"
                        r="10"
                        stroke="currentColor"
                        stroke-width="4"
                    />
                    <path
                        class="opacity-70"
                        fill="currentColor"
                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"
                    />
                </svg>
                Lade Statistikdaten...
            </span>
        </div>

        <!-- Fehler -->
        <div v-if="error" class="py-6 font-medium text-center text-red-500">
            Fehler beim Laden: <span class="text-xs">{{ error }}</span>
        </div>

        <!-- Tabelle -->
        <div v-if="!loading && !error">
            <div
                class="overflow-x-auto border border-teal-100 rounded-lg shadow-sm dark:border-teal-900/10"
            >
                <table class="min-w-full text-xs text-left align-middle">
                    <thead>
                        <tr class="bg-teal-50 dark:bg-teal-950/30">
                            <th class="px-2 py-2 font-semibold">Key</th>
                            <th class="px-2 py-2 font-semibold">Wert</th>
                            <th class="px-2 py-2 font-semibold">Ablauf</th>
                            <th class="px-2 py-2 font-semibold">Aktion</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="entry in sortedStats"
                            :key="entry.key"
                            class="transition border-t hover:bg-teal-50/70 dark:hover:bg-teal-900/20 group"
                        >
                            <td class="max-w-xs px-2 py-2 font-mono break-all">
                                <span
                                    class="inline-block cursor-pointer hover:underline"
                                    :title="entry.key"
                                    @click="copyToClipboard(entry.key)"
                                >
                                    {{ truncate(entry.key, 48) }}
                                </span>
                            </td>
                            <td class="max-w-xs px-2 py-2 font-mono">
                                <span v-if="isJson(entry.value)">
                                    <details>
                                        <summary>JSON öffnen</summary>
                                        <pre
                                            class="p-2 mt-1 text-xs break-all whitespace-pre-wrap rounded bg-gray-50 dark:bg-gray-800"
                                            >{{ prettyJson(entry.value) }}</pre
                                        >
                                    </details>
                                </span>
                                <span v-else>
                                    {{ truncate(entry.value, 64) }}
                                </span>
                            </td>
                            <td class="px-2 py-2">
                                {{ formatExpiration(entry.expiration) }}
                            </td>
                            <td class="px-2 py-2">
                                <button
                                    @click="deleteEntry(entry.key)"
                                    class="text-red-600 hover:underline focus-visible:ring-2 focus-visible:ring-red-300 rounded px-1 py-0.5"
                                    :aria-label="
                                        'Eintrag ' + entry.key + ' löschen'
                                    "
                                    :disabled="loading"
                                >
                                    Löschen
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div
                v-if="!stats.length && !loading"
                class="mt-8 text-center text-gray-400"
            >
                Keine Statistikdaten gefunden.
            </div>
        </div>

        <!-- Modal für Bulk-Löschung -->
        <div
            v-if="showBulkDeleteModal"
            class="fixed inset-0 z-50 flex items-center justify-center bg-black/40"
            role="dialog"
            aria-modal="true"
        >
            <div
                class="flex flex-col w-full max-w-md gap-5 p-6 bg-white border border-teal-100 shadow-xl dark:bg-gray-800 rounded-2xl dark:border-teal-900/30"
            >
                <h3 class="text-lg font-bold text-red-700 dark:text-red-400">
                    Alle Statistik-Einträge löschen?
                </h3>
                <p class="text-gray-700 dark:text-gray-200">
                    Das löscht <b>alle</b> Besucherstatistiken im Cache
                    unwiderruflich.
                </p>
                <div class="flex justify-end gap-3">
                    <button
                        @click="showBulkDeleteModal = false"
                        class="px-4 py-1 text-sm font-semibold text-gray-600 bg-gray-100 border rounded dark:border-gray-700 dark:text-gray-300 dark:bg-gray-900 hover:bg-gray-200 focus-visible:ring-2 focus-visible:ring-teal-300"
                    >
                        Abbrechen
                    </button>
                    <button
                        @click="bulkDelete"
                        class="px-4 py-1 text-sm font-semibold text-white bg-red-600 rounded shadow hover:bg-red-700 focus-visible:ring-2 focus-visible:ring-red-300"
                        :disabled="loading"
                    >
                        Löschen
                    </button>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
import { ref, computed, onMounted } from "vue";
import { router } from "@inertiajs/vue3";

const props = defineProps({
    stats: { type: Array, default: () => [] },
});

const loading = ref(false);
const error = ref("");
const showBulkDeleteModal = ref(false);
const sortKey = ref("expiration");
const sortDesc = ref(true);

// Sortierte Ausgabe, immer mit letztem Ablauf vorn
const sortedStats = computed(() =>
    [...props.stats].sort((a, b) =>
        sortDesc.value
            ? (b[sortKey.value] || 0) - (a[sortKey.value] || 0)
            : (a[sortKey.value] || 0) - (b[sortKey.value] || 0)
    )
);

// UX Hilfsfunktionen
function truncate(str, n = 32) {
    if (!str) return "";
    return str.length > n ? str.substring(0, n - 1) + "…" : str;
}
function formatExpiration(ts) {
    if (!ts) return "-";
    const date = new Date(ts * 1000);
    return date.toLocaleString();
}
function isJson(val) {
    try {
        JSON.parse(val);
        return true;
    } catch {
        return false;
    }
}
function prettyJson(val) {
    try {
        return JSON.stringify(JSON.parse(val), null, 2);
    } catch {
        return val;
    }
}
function copyToClipboard(text) {
    navigator.clipboard?.writeText(text);
}

// Einzel-Löschung mit UX
function deleteEntry(key) {
    if (!key || loading.value) return;
    if (confirm(`Diesen Cache-Eintrag wirklich löschen?\n\nKey:\n${key}`)) {
        loading.value = true;
        router.delete(route("admin.visitor-stats.destroy", key), {
            onFinish: () => (loading.value = false),
            onError: (e) => {
                error.value = e?.message || "Fehler beim Löschen";
                loading.value = false;
            },
        });
    }
}
function bulkDelete() {
    showBulkDeleteModal.value = false;
    loading.value = true;
    router.delete(route("admin.visitor-stats.destroyBulk"), {
        onFinish: () => (loading.value = false),
        onError: (e) => {
            error.value = e?.message || "Fehler beim Löschen";
            loading.value = false;
        },
    });
}

onMounted(() => {
    // Optional: stats könnten hier reaktiv nachgeladen werden
    //fetchStats()
});
</script>
