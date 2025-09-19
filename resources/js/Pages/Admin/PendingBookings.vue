<script setup>
import { ref, watch, computed } from "vue";
import { router, usePage } from "@inertiajs/vue3";

const props = defineProps({
    filters: Object,
    pending: Object, // Laravel LengthAwarePaginator
});

const q = ref(props.filters?.q ?? "");
const date_from = ref(props.filters?.date_from ?? "");
const date_to = ref(props.filters?.date_to ?? "");
const per_page = ref(props.filters?.per_page ?? 15);

function applyFilters() {
    router.get(
        route("admin.pending.index"),
        {
            q: q.value || undefined,
            date_from: date_from.value || undefined,
            date_to: date_to.value || undefined,
            per_page: per_page.value || undefined,
        },
        { preserveState: true, replace: true }
    );
}

function confirm(id) {
    router.post(
        route("admin.pending.confirm", id),
        {},
        {
            onSuccess: () => {},
        }
    );
}
function resend(id) {
    router.post(
        route("admin.pending.resend", id),
        {},
        {
            onSuccess: () => {},
        }
    );
}
function destroyRow(id) {
    if (!confirm("Diese Pending-Buchung wirklich löschen?")) return;
    router.delete(route("admin.pending.destroy", id));
}

const pendingData = computed(() => props.pending?.data || []);
</script>

<template>
    <div class="min-h-screen text-white bg-black">
        <div class="p-6 mx-auto max-w-7xl">
            <header class="mb-6">
                <h1 class="text-2xl font-semibold tracking-tight md:text-3xl">
                    Pending-Buchungen
                </h1>
                <p class="text-white/70">
                    Buchungen, die noch auf E-Mail-Bestätigung warten
                </p>
            </header>

            <!-- Filter -->
            <div class="grid gap-3 mb-6 md:grid-cols-5">
                <input
                    v-model="q"
                    type="text"
                    placeholder="Suche (Name, E-Mail, Thema, Typ, Modus)"
                    class="px-3 py-2 border md:col-span-2 rounded-2xl bg-white/5 border-white/10 focus:outline-none focus:ring focus:ring-teal-400/30"
                />
                <input
                    v-model="date_from"
                    type="date"
                    class="px-3 py-2 border rounded-2xl bg-white/5 border-white/10 focus:outline-none focus:ring focus:ring-teal-400/30"
                />
                <input
                    v-model="date_to"
                    type="date"
                    class="px-3 py-2 border rounded-2xl bg-white/5 border-white/10 focus:outline-none focus:ring focus:ring-teal-400/30"
                />
                <div class="flex items-center gap-2">
                    <select
                        v-model="per_page"
                        class="flex-1 px-3 py-2 border rounded-2xl bg-white/5 border-white/10 focus:outline-none"
                    >
                        <option :value="10">10</option>
                        <option :value="15">15</option>
                        <option :value="25">25</option>
                        <option :value="50">50</option>
                    </select>
                    <button
                        @click="applyFilters"
                        class="px-4 py-2 rounded-2xl bg-gradient-to-r from-[#00fdcf] to-black shadow-lg hover:opacity-90 transition"
                    >
                        Filtern
                    </button>
                </div>
            </div>

            <!-- Table -->
            <div
                class="overflow-x-auto border rounded-2xl border-white/10 bg-white/5 backdrop-blur-sm"
            >
                <table class="min-w-full text-sm">
                    <thead class="text-left bg-white/10">
                        <tr>
                            <th class="px-4 py-3">Start</th>
                            <th class="px-4 py-3">Ende</th>
                            <th class="px-4 py-3">Typ/Modus</th>
                            <th class="px-4 py-3">Name</th>
                            <th class="px-4 py-3">E-Mail</th>
                            <th class="px-4 py-3">Thema</th>
                            <th class="px-4 py-3 text-right">Aktionen</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-if="pendingData.length === 0">
                            <td
                                colspan="7"
                                class="px-4 py-6 text-center text-white/70"
                            >
                                Keine Pending-Buchungen gefunden.
                            </td>
                        </tr>

                        <tr
                            v-for="row in pendingData"
                            :key="row.id"
                            class="border-t border-white/10"
                        >
                            <td class="px-4 py-3 whitespace-nowrap">
                                {{ new Date(row.start).toLocaleString() }}
                            </td>
                            <td class="px-4 py-3 whitespace-nowrap">
                                {{ new Date(row.end).toLocaleString() }}
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex flex-col">
                                    <span class="font-medium">{{
                                        row.type
                                    }}</span>
                                    <span class="text-white/60">{{
                                        row.mode
                                    }}</span>
                                </div>
                            </td>
                            <td class="px-4 py-3">{{ row.name }}</td>
                            <td class="px-4 py-3">{{ row.email }}</td>
                            <td
                                class="px-4 py-3 max-w-[24ch] truncate"
                                :title="row.topic"
                            >
                                {{ row.topic }}
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex justify-end gap-2">
                                    <button
                                        @click="resend(row.id)"
                                        class="px-3 py-1 border rounded-xl border-white/20 hover:bg-white/10"
                                    >
                                        Mail erneut
                                    </button>
                                    <button
                                        @click="confirm(row.id)"
                                        class="px-3 py-1 font-semibold text-black rounded-xl bg-teal-500/90 hover:bg-teal-400"
                                    >
                                        Manuell bestätigen
                                    </button>
                                    <button
                                        @click="destroyRow(row.id)"
                                        class="px-3 py-1 text-red-300 border rounded-xl border-red-400/40 hover:bg-red-500/10"
                                    >
                                        Löschen
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div
                v-if="props.pending?.links?.length"
                class="flex flex-wrap gap-2 mt-4"
            >
                <template v-for="(link, i) in props.pending.links" :key="i">
                    <button
                        v-if="link.url"
                        @click="
                            router.get(
                                link.url,
                                {},
                                { preserveState: true, replace: true }
                            )
                        "
                        class="px-3 py-1 border rounded-xl border-white/20"
                        :class="{ 'bg-white/20': link.active }"
                        v-html="link.label"
                    />
                    <span
                        v-else
                        class="px-3 py-1 text-white/40"
                        v-html="link.label"
                    />
                </template>
            </div>
        </div>
    </div>
</template>
