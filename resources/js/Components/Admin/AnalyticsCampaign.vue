<template>
    <div class="max-w-4xl p-8 mx-auto">
        <h1 class="mb-6 text-2xl font-bold">E-Mail Kampagnen Analytics</h1>
        <table class="w-full mb-6 border rounded">
            <thead>
                <tr class="bg-gray-50">
                    <th class="p-2">Empfänger</th>
                    <th class="p-2">Betreff</th>
                    <th class="p-2">Gesendet</th>
                    <th class="p-2">Geöffnet</th>
                    <th class="p-2">Klicks</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="mail in safeCampaigns" :key="mail.id">
                    <td class="p-2">{{ mail.recipient_email || "—" }}</td>
                    <td class="p-2">{{ mail.subject || "—" }}</td>
                    <td class="p-2">{{ formatSafe(mail.sent_at) }}</td>
                    <td class="p-2">
                        <span v-if="mail.opened_at" class="text-green-600">
                            {{ formatSafe(mail.opened_at) }}
                        </span>
                        <span v-else class="text-gray-400">–</span>
                    </td>
                    <td class="p-2">
                        <ul>
                            <li
                                v-for="(dt, url) in mail.clicked_links || {}"
                                :key="url"
                            >
                                <a
                                    :href="url"
                                    class="text-teal-700 underline"
                                    target="_blank"
                                    >{{ url }}</a
                                >
                                <span class="ml-1 text-xs text-gray-500">
                                    ({{ formatSafe(dt) }})
                                </span>
                            </li>
                            <li
                                v-if="
                                    !mail.clicked_links ||
                                    Object.keys(mail.clicked_links).length === 0
                                "
                            >
                                <span class="text-gray-400">–</span>
                            </li>
                        </ul>
                    </td>
                </tr>
                <tr v-if="safeCampaigns.length === 0">
                    <td colspan="5" class="p-4 text-center text-gray-400">
                        Keine Kampagnen gefunden.
                    </td>
                </tr>
            </tbody>
        </table>
        <!-- Optional: Öffnungs-/Klickrate als Chart -->
        <div v-if="safeCampaigns.length">
            <canvas ref="analyticsChart" height="100"></canvas>
        </div>
    </div>
</template>

<script setup>
import { onMounted, computed, ref } from "vue";
import { format } from "date-fns";

const props = defineProps({
    campaigns: {
        type: Array,
        default: () => [],
    },
});

const safeCampaigns = computed(() =>
    Array.isArray(props.campaigns) ? props.campaigns : []
);

function formatSafe(date) {
    if (!date) return "—";
    try {
        return format(new Date(date), "dd.MM.yyyy HH:mm");
    } catch {
        return "—";
    }
}

const analyticsChart = ref(null);

onMounted(() => {
    if (window.Chart && safeCampaigns.value.length && analyticsChart.value) {
        const ctx = analyticsChart.value.getContext("2d");
        const opens = safeCampaigns.value.filter((c) => !!c.opened_at).length;
        const clicks = safeCampaigns.value.reduce(
            (sum, c) =>
                sum +
                (c.clicked_links ? Object.keys(c.clicked_links).length : 0),
            0
        );
        new window.Chart(ctx, {
            type: "doughnut",
            data: {
                labels: ["Geöffnet", "Klicks", "Nicht geöffnet"],
                datasets: [
                    {
                        data: [
                            opens,
                            clicks,
                            safeCampaigns.value.length - opens,
                        ],
                        backgroundColor: ["#14b8a6", "#6366f1", "#e5e7eb"],
                    },
                ],
            },
            options: {
                plugins: {
                    legend: {
                        display: true,
                        position: "bottom",
                    },
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
});
</script>
