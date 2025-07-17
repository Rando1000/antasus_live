<template>
    <AdminLayout title="E-Mail-Kampagnen">
        <div class="max-w-6xl px-4 py-10 mx-auto">
            <div class="flex flex-wrap items-center justify-between gap-3 mb-6">
                <h1
                    class="text-3xl font-extrabold tracking-tight text-gray-900 dark:text-white"
                >
                    E-Mail-Kampagnen-Übersicht
                </h1>
                <div class="flex gap-2">
                    <button
                        v-if="selectedIds.length"
                        @click="openDeleteModal"
                        class="flex items-center gap-1 px-4 py-2 text-sm font-semibold text-white bg-red-600 rounded shadow hover:bg-red-700 focus-visible:outline focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-red-400"
                        :disabled="deleting"
                        aria-label="Ausgewählte Kampagnen löschen"
                    >
                        <svg
                            class="w-4 h-4"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"
                            />
                        </svg>
                        Löschen ({{ selectedIds.length }})
                    </button>
                    <Link
                        href="/admin/emailcampaign/create"
                        class="px-5 py-2 text-white bg-teal-600 rounded-lg shadow hover:bg-teal-700"
                        aria-label="Neue Kampagne anlegen"
                        >+ Neue Kampagne</Link
                    >
                </div>
            </div>

            <!-- ANALYTICS DASHBOARD -->
            <div
                class="grid grid-cols-1 gap-6 mb-10 sm:grid-cols-2 lg:grid-cols-4"
            >
                <div
                    class="flex flex-col items-center p-6 bg-white shadow rounded-xl dark:bg-gray-900"
                >
                    <span
                        class="mb-1 text-xs font-medium text-gray-400 uppercase"
                        >Kampagnen</span
                    >
                    <span
                        class="text-2xl font-bold text-gray-900 dark:text-white"
                        >{{ kpi.total }}</span
                    >
                </div>
                <div
                    class="flex flex-col items-center p-6 bg-white shadow rounded-xl dark:bg-gray-900"
                >
                    <span
                        class="mb-1 text-xs font-medium text-gray-400 uppercase"
                        >Geöffnet</span
                    >
                    <span class="text-2xl font-bold text-teal-600">{{
                        kpi.opens
                    }}</span>
                    <span class="mt-1 text-xs text-gray-400"
                        >{{ kpi.openRate }}% Öffnungsrate</span
                    >
                </div>
                <div
                    class="flex flex-col items-center p-6 bg-white shadow rounded-xl dark:bg-gray-900"
                >
                    <span
                        class="mb-1 text-xs font-medium text-gray-400 uppercase"
                        >Klicks</span
                    >
                    <span class="text-2xl font-bold text-indigo-600">{{
                        kpi.clicks
                    }}</span>
                    <span class="mt-1 text-xs text-gray-400"
                        >{{ kpi.clickRate }}% Klickrate</span
                    >
                </div>
                <div
                    class="flex flex-col items-center p-6 bg-white shadow rounded-xl dark:bg-gray-900"
                >
                    <span
                        class="mb-2 text-xs font-medium text-gray-400 uppercase"
                        >Visualisierung</span
                    >
                    <canvas ref="analyticsChart" height="60"></canvas>
                </div>
            </div>

            <!-- Leerer Zustand -->
            <transition name="fade">
                <div
                    v-if="safeCampaigns.length === 0"
                    class="py-24 text-center opacity-80"
                >
                    <img
                        src="/images/empty-state.svg"
                        alt=""
                        class="w-32 mx-auto mb-4"
                    />
                    <div class="mb-2 text-lg font-semibold text-gray-500">
                        Noch keine Kampagnen versendet.
                    </div>
                    <Link
                        href="/admin/emailcampaign/create"
                        class="inline-block px-6 py-2 mt-3 text-white bg-teal-600 rounded-lg shadow hover:bg-teal-700"
                        >Jetzt anlegen</Link
                    >
                </div>
            </transition>

            <!-- Table -->
            <div
                v-if="safeCampaigns.length"
                class="overflow-x-auto bg-white shadow rounded-xl dark:bg-gray-900 ring-1 ring-black/5"
            >
                <table
                    class="min-w-full text-sm border-separate table-auto"
                    style="border-spacing: 0"
                >
                    <thead
                        class="sticky top-0 z-10 text-gray-700 bg-gray-50 dark:bg-gray-800 dark:text-gray-200"
                    >
                        <tr>
                            <th class="w-8 px-2 py-3 text-center">
                                <input
                                    type="checkbox"
                                    :checked="allSelected"
                                    @change="toggleSelectAll"
                                    aria-label="Alle auswählen"
                                />
                            </th>
                            <th class="px-4 py-3 text-left">Empfänger</th>
                            <th class="px-4 py-3 text-left">Betreff</th>
                            <th class="px-4 py-3 text-left">Gesendet</th>
                            <th class="px-4 py-3 text-left">Status</th>
                            <th class="px-4 py-3 text-left">Aktion</th>
                            <th class="px-4 py-3 text-left">Öffnung</th>
                            <th class="px-4 py-3 text-left">Klicks</th>
                            <th class="w-8 px-2 py-3 text-center"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="camp in safeCampaigns"
                            :key="camp.id"
                            :tabindex="0"
                            :class="{
                                'bg-green-50 dark:bg-green-900/10':
                                    camp.responded,
                                'focus:outline-none focus:ring-2 focus:ring-teal-400': true,
                            }"
                        >
                            <td class="px-2 py-3 text-center">
                                <input
                                    type="checkbox"
                                    :value="camp.id"
                                    v-model="selectedIds"
                                    :aria-label="`Kampagne ${camp.id} auswählen`"
                                />
                            </td>
                            <td class="px-4 py-3">
                                <span class="font-medium">{{
                                    camp.recipient_email
                                }}</span>
                                <span
                                    v-if="camp.contact_name"
                                    class="block text-xs text-gray-400"
                                    >{{ camp.contact_name }}</span
                                >
                            </td>
                            <td class="px-4 py-3">
                                <span
                                    class="text-gray-900 dark:text-gray-100"
                                    >{{ camp.subject }}</span
                                >
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap">
                                {{ formatDateTime(camp.sent_at) }}
                            </td>
                            <td class="px-4 py-3">
                                <span
                                    class="inline-block px-3 py-1 text-xs font-semibold rounded-full"
                                    :class="
                                        camp.responded
                                            ? 'bg-green-100 text-green-700 dark:bg-green-700/30 dark:text-green-300'
                                            : 'bg-gray-100 text-gray-600 dark:bg-gray-700/30 dark:text-gray-300'
                                    "
                                >
                                    {{
                                        camp.responded
                                            ? "Antwort erhalten"
                                            : "Offen"
                                    }}
                                </span>
                            </td>
                            <td class="px-4 py-3">
                                <button
                                    v-if="!camp.responded"
                                    @click="openModal(camp)"
                                    class="px-3 py-1 text-sm font-medium text-white rounded-lg shadow bg-gradient-to-r from-teal-500 to-indigo-700 hover:from-teal-600 hover:to-indigo-900 focus:outline-none focus-visible:ring-2 focus-visible:ring-teal-400"
                                    aria-label="Als beantwortet markieren"
                                >
                                    Als beantwortet
                                </button>
                                <span v-else class="text-sm text-gray-400"
                                    >—</span
                                >
                            </td>
                            <td class="px-4 py-3">
                                <span
                                    v-if="camp.opened_at"
                                    class="text-green-700"
                                    >Geöffnet</span
                                >
                                <span v-else class="text-gray-400">-</span>
                            </td>
                            <td class="px-4 py-3">
                                <ul>
                                    <li
                                        v-for="(
                                            dt, url
                                        ) in camp.clicked_links || {}"
                                        :key="url"
                                    >
                                        <a
                                            :href="url"
                                            class="text-teal-700 underline break-all"
                                            target="_blank"
                                            rel="noopener"
                                            tabindex="0"
                                            >{{ url }}</a
                                        >
                                        <span class="ml-1 text-xs text-gray-500"
                                            >({{ formatDateTime(dt) }})</span
                                        >
                                    </li>
                                    <li
                                        v-if="
                                            !camp.clicked_links ||
                                            Object.keys(camp.clicked_links)
                                                .length === 0
                                        "
                                    >
                                        <span class="text-gray-400">–</span>
                                    </li>
                                </ul>
                            </td>
                            <td class="px-2 py-3 text-center">
                                <button
                                    @click="deleteSingle(camp.id)"
                                    class="text-red-500 hover:text-red-700 focus:outline-none"
                                    aria-label="Kampagne löschen"
                                    :title="`Kampagne löschen (${camp.subject})`"
                                >
                                    <svg
                                        class="w-5 h-5"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="2"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M6 18L18 6M6 6l12 12"
                                        />
                                    </svg>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- MODAL Antwortdaten -->
        <Transition name="fade">
            <div
                v-if="editing"
                class="fixed inset-0 z-[200] flex items-center justify-center bg-black/60 backdrop-blur-sm"
                aria-modal="true"
                role="dialog"
                tabindex="-1"
            >
                <div
                    class="relative w-full max-w-md px-6 py-8 bg-white shadow-2xl dark:bg-gray-900 rounded-2xl animate-pop-up"
                >
                    <button
                        @click="editing = false"
                        class="absolute text-gray-500 top-3 right-3 hover:text-teal-600 focus:outline-none"
                        aria-label="Dialog schließen"
                    >
                        <svg
                            class="w-6 h-6"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M6 18L18 6M6 6l12 12"
                            />
                        </svg>
                    </button>
                    <h2
                        class="mb-6 text-2xl font-bold text-gray-800 dark:text-white"
                    >
                        Antwortdaten eintragen
                    </h2>
                    <form @submit.prevent="submit">
                        <div class="mb-4">
                            <label
                                class="block mb-1 font-medium"
                                for="contact_name"
                                >Name Ansprechpartner</label
                            >
                            <input
                                v-model="form.contact_name"
                                id="contact_name"
                                type="text"
                                class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-teal-400 focus:outline-none"
                                autocomplete="off"
                                :autofocus="true"
                            />
                        </div>
                        <div class="mb-4">
                            <label
                                class="block mb-1 font-medium"
                                for="contact_email"
                                >E-Mail Ansprechpartner</label
                            >
                            <input
                                v-model="form.contact_email"
                                id="contact_email"
                                type="email"
                                class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-teal-400 focus:outline-none"
                                autocomplete="off"
                            />
                        </div>
                        <div class="mb-4">
                            <label
                                class="block mb-1 font-medium"
                                for="contact_phone"
                                >Telefon</label
                            >
                            <input
                                v-model="form.contact_phone"
                                id="contact_phone"
                                type="text"
                                class="w-full px-3 py-2 border rounded focus:ring-2 focus:ring-teal-400 focus:outline-none"
                                autocomplete="off"
                            />
                        </div>
                        <div class="flex justify-end gap-3 mt-4">
                            <button
                                type="button"
                                @click="editing = false"
                                class="px-4 py-2 font-medium border rounded hover:bg-gray-50 dark:hover:bg-gray-800 focus:outline-none"
                            >
                                Abbrechen
                            </button>
                            <button
                                type="submit"
                                class="px-6 py-2 font-semibold text-white rounded-lg shadow bg-gradient-to-r from-teal-500 to-indigo-700 hover:from-teal-600 hover:to-indigo-900 focus:outline-none focus-visible:ring-2 focus-visible:ring-teal-400"
                            >
                                Speichern
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </Transition>

        <!-- Delete Modal/Undo Snackbar -->
        <Transition name="fade">
            <div
                v-if="showDeleteModal"
                class="fixed inset-0 z-[300] flex items-center justify-center bg-black/60 backdrop-blur-sm"
                aria-modal="true"
                role="dialog"
            >
                <div
                    class="w-full max-w-sm p-8 text-center bg-white shadow-2xl dark:bg-gray-900 rounded-xl"
                >
                    <h3
                        class="mb-4 text-xl font-bold text-gray-900 dark:text-white"
                    >
                        Kampagnen löschen
                    </h3>
                    <div class="mb-4 text-gray-700 dark:text-gray-200">
                        Möchtest du <b>{{ selectedIds.length }}</b> Kampagnen
                        unwiderruflich löschen?
                    </div>
                    <div class="flex justify-center gap-3 mt-4">
                        <button
                            @click="showDeleteModal = false"
                            class="px-4 py-2 border rounded focus:outline-none"
                        >
                            Abbrechen
                        </button>
                        <button
                            @click="deleteSelected"
                            class="px-6 py-2 font-semibold text-white bg-red-600 rounded hover:bg-red-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-red-400"
                            :disabled="deleting"
                        >
                            Löschen
                        </button>
                    </div>
                </div>
            </div>
        </Transition>
        <transition name="fade">
            <div
                v-if="snackbar"
                class="fixed bottom-6 right-8 z-[500] bg-teal-700 text-white px-5 py-3 rounded-lg shadow-lg font-semibold text-sm"
            >
                {{ snackbar }}
            </div>
        </transition>
    </AdminLayout>
</template>

<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { ref, computed, onMounted, watch } from "vue";
import { Inertia } from "@inertiajs/inertia";
import { Link } from "@inertiajs/vue3";

// KPI-Card als Subkomponente
const KpiCard = {
    props: { label: String, value: [String, Number], color: String },
    template: `
      <div class="flex flex-col items-center p-6 bg-white shadow rounded-xl dark:bg-gray-900">
        <span class="mb-1 text-xs font-medium text-gray-400 uppercase">{{label}}</span>
        <span :class="colorClass" class="text-2xl font-bold">{{ value }}</span>
        <slot name="extra"></slot>
      </div>
    `,
    computed: {
        colorClass() {
            if (this.color === "teal") return "text-teal-600";
            if (this.color === "indigo") return "text-indigo-600";
            return "text-gray-900 dark:text-white";
        },
    },
};

const props = defineProps({
    campaigns: {
        type: Array,
        default: () => [],
    },
});
const safeCampaigns = computed(() =>
    Array.isArray(props.campaigns) ? props.campaigns : []
);
const selectedIds = ref([]);
const deleting = ref(false);
const snackbar = ref("");
const showDeleteModal = ref(false);

// Select all
const allSelected = computed(
    () =>
        safeCampaigns.value.length > 0 &&
        selectedIds.value.length === safeCampaigns.value.length
);
function toggleSelectAll(e) {
    if (e.target.checked) {
        selectedIds.value = safeCampaigns.value.map((c) => c.id);
    } else {
        selectedIds.value = [];
    }
}

// KPIs und Chart
const kpi = computed(() => {
    const total = safeCampaigns.value.length;
    const opens = safeCampaigns.value.filter((c) => !!c.opened_at).length;
    const clicks = safeCampaigns.value.reduce(
        (sum, c) =>
            sum + (c.clicked_links ? Object.keys(c.clicked_links).length : 0),
        0
    );
    const openRate = total ? Math.round((opens / total) * 100) : 0;
    const clickRate = total ? Math.round((clicks / total) * 100) : 0;
    return { total, opens, clicks, openRate, clickRate };
});

const analyticsChart = ref(null);
let chartInstance = null;
function buildChart() {
    if (!window.Chart || !analyticsChart.value) return;
    if (chartInstance) chartInstance.destroy();
    chartInstance = new window.Chart(analyticsChart.value.getContext("2d"), {
        type: "doughnut",
        data: {
            labels: ["Geöffnet", "Klicks", "Nicht geöffnet"],
            datasets: [
                {
                    data: [
                        kpi.value.opens,
                        kpi.value.clicks,
                        kpi.value.total - kpi.value.opens,
                    ],
                    backgroundColor: ["#14b8a6", "#6366f1", "#e5e7eb"],
                    borderWidth: 2,
                },
            ],
        },
        options: {
            cutout: "70%",
            plugins: {
                legend: { display: false },
                tooltip: {
                    callbacks: {
                        label: function (context) {
                            return context.label + ": " + context.raw;
                        },
                    },
                },
            },
        },
    });
}
onMounted(() => {
    if (safeCampaigns.value.length && window.Chart) {
        buildChart();
    }
});
watch(kpi, buildChart);

// MODAL/CRUD
const editing = ref(false);
const current = ref(null);
const form = ref({
    contact_name: "",
    contact_email: "",
    contact_phone: "",
});
function formatDateTime(date) {
    if (!date) return "";
    const d = new Date(date);
    return (
        d.toLocaleDateString("de-DE", {
            year: "numeric",
            month: "2-digit",
            day: "2-digit",
        }) +
        " " +
        d.toLocaleTimeString("de-DE", { hour: "2-digit", minute: "2-digit" })
    );
}
function openModal(camp) {
    current.value = camp;
    form.value = {
        contact_name: camp.contact_name || "",
        contact_email: camp.contact_email || "",
        contact_phone: camp.contact_phone || "",
    };
    editing.value = true;
}
function submit() {
    Inertia.put(`/admin/emailkonverse/${current.value.id}`, form.value, {
        onSuccess: () => {
            editing.value = false;
            snackbar.value = "Antwortdaten gespeichert!";
            setTimeout(() => (snackbar.value = ""), 2600);
        },
    });
}

// Löschen (einzeln + mehrfach)
function deleteSingle(id) {
    if (!confirm("Diese Kampagne wirklich löschen?")) return;
    deleting.value = true;
    Inertia.delete(`/admin/emailcampaign/${id}`, {
        onSuccess: () => {
            deleting.value = false;
            snackbar.value = "Kampagne gelöscht!";
            setTimeout(() => (snackbar.value = ""), 2600);
            // Optional aus der Selection entfernen:
            selectedIds.value = selectedIds.value.filter((v) => v !== id);
        },
    });
}
function openDeleteModal() {
    showDeleteModal.value = true;
}
function deleteSelected() {
    if (!selectedIds.value.length) return;
    deleting.value = true;
    Inertia.post(
        `/admin/emailcampaign/bulk-delete`,
        { ids: selectedIds.value },
        {
            onSuccess: () => {
                deleting.value = false;
                showDeleteModal.value = false;
                snackbar.value = `${selectedIds.value.length} Kampagnen gelöscht!`;
                setTimeout(() => (snackbar.value = ""), 2600);
                selectedIds.value = [];
            },
            onError: () => {
                deleting.value = false;
                showDeleteModal.value = false;
            },
        }
    );
}
</script>

<style scoped>
canvas {
    display: block;
    margin: 0 auto;
    max-width: 120px;
}
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.2s;
}
.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
.animate-pop-up {
    animation: popup 0.38s cubic-bezier(0.33, 1.6, 0.6, 1) both;
}
@keyframes popup {
    0% {
        opacity: 0;
        transform: translateY(50px) scale(0.97);
    }
    80% {
        transform: translateY(-7px) scale(1.03);
    }
    100% {
        opacity: 1;
        transform: translateY(0) scale(1);
    }
}
</style>
