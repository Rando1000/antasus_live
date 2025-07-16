<template>
    <AdminLayout title="Versendete Kampagnen-E-Mails">
        <div class="max-w-5xl px-4 py-12 mx-auto">
            <h1
                class="mb-8 text-3xl font-extrabold tracking-tight text-gray-900 dark:text-white"
            >
                E-Mail-Kampagnen-Übersicht
            </h1>

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

            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold">Versendete Werbe-Mails</h2>
                <Link
                    href="/admin/emailcampaign/create"
                    class="px-5 py-2 text-white bg-teal-600 rounded-lg shadow hover:bg-teal-700"
                >
                    + Neue Kampagne
                </Link>
            </div>
            <div
                class="overflow-x-auto bg-white shadow rounded-xl dark:bg-gray-900 ring-1 ring-black/5"
            >
                <table class="w-full text-sm table-auto">
                    <thead
                        class="text-gray-700 bg-gray-50 dark:bg-gray-800 dark:text-gray-200"
                    >
                        <tr>
                            <th class="px-4 py-3 font-semibold text-left">
                                Empfänger
                            </th>
                            <th class="px-4 py-3 font-semibold text-left">
                                Betreff
                            </th>
                            <th class="px-4 py-3 font-semibold text-left">
                                Gesendet
                            </th>
                            <th class="px-4 py-3 font-semibold text-left">
                                Status
                            </th>
                            <th class="px-4 py-3 font-semibold text-left">
                                Aktion
                            </th>
                            <th class="px-4 py-3 font-semibold text-left">
                                Öffnung
                            </th>
                            <th class="px-4 py-3 font-semibold text-left">
                                Klicks
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="camp in safeCampaigns"
                            :key="camp.id"
                            :class="{
                                'bg-green-50 dark:bg-green-900/10':
                                    camp.responded,
                                'transition-colors': true,
                            }"
                        >
                            <td
                                class="px-4 py-3 border-b border-gray-100 dark:border-gray-800"
                            >
                                <span class="font-medium">{{
                                    camp.recipient_email
                                }}</span>
                                <span
                                    v-if="camp.contact_name"
                                    class="block text-xs text-gray-400"
                                >
                                    {{ camp.contact_name }}
                                </span>
                            </td>
                            <td
                                class="px-4 py-3 border-b border-gray-100 dark:border-gray-800"
                            >
                                <span
                                    class="text-gray-900 dark:text-gray-100"
                                    >{{ camp.subject }}</span
                                >
                            </td>
                            <td
                                class="px-4 py-3 border-b border-gray-100 dark:border-gray-800 whitespace-nowrap"
                            >
                                {{ formatDateTime(camp.sent_at) }}
                            </td>
                            <td
                                class="px-4 py-3 border-b border-gray-100 dark:border-gray-800"
                            >
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
                            <td
                                class="px-4 py-3 border-b border-gray-100 dark:border-gray-800"
                            >
                                <button
                                    v-if="!camp.responded"
                                    @click="openModal(camp)"
                                    class="px-3 py-1 text-sm font-medium text-white rounded-lg shadow bg-gradient-to-r from-teal-500 to-indigo-700 hover:from-teal-600 hover:to-indigo-900 focus:outline-none focus-visible:ring-2 focus-visible:ring-teal-400"
                                >
                                    Als beantwortet markieren
                                </button>
                                <span v-else class="text-sm text-gray-400"
                                    >—</span
                                >
                            </td>
                            <td
                                class="px-4 py-3 border-b border-gray-100 dark:border-gray-800"
                            >
                                <span
                                    v-if="camp.opened_at"
                                    class="text-green-700"
                                    >Geöffnet</span
                                >
                                <span v-else class="text-gray-400">-</span>
                            </td>
                            <td
                                class="px-4 py-3 border-b border-gray-100 dark:border-gray-800"
                            >
                                <ul>
                                    <li
                                        v-for="(
                                            dt, url
                                        ) in camp.clicked_links || {}"
                                        :key="url"
                                    >
                                        <a
                                            :href="url"
                                            class="text-teal-700 underline"
                                            target="_blank"
                                            >{{ url }}</a
                                        >
                                        <span
                                            class="ml-1 text-xs text-gray-500"
                                        >
                                            ({{ formatDateTime(dt) }})
                                        </span>
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
                        </tr>
                        <tr v-if="safeCampaigns.length === 0">
                            <td
                                colspan="7"
                                class="p-4 text-center text-gray-400"
                            >
                                Es wurden noch keine Kampagnen versendet.
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- MODAL -->
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
    </AdminLayout>
</template>

<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { ref, computed, onMounted, watch } from "vue";
import { Inertia } from "@inertiajs/inertia";
import { Link } from "@inertiajs/vue3";

// Props absichern
const props = defineProps({
    campaigns: {
        type: Array,
        default: () => [],
    },
});
const safeCampaigns = computed(() =>
    Array.isArray(props.campaigns) ? props.campaigns : []
);

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
        },
    });
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
