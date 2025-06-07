<template>
    <div class="p-6 bg-white rounded-lg shadow">
        <h1 class="mb-4 text-2xl font-bold">Versendete Werbe-Mails</h1>

        <table class="w-full border-collapse">
            <thead>
                <tr>
                    <th class="px-3 py-2 text-left border">Empfänger</th>
                    <th class="px-3 py-2 text-left border">Betreff</th>
                    <th class="px-3 py-2 text-left border">Gesendet am</th>
                    <th class="px-3 py-2 text-left border">Status</th>
                    <th class="px-3 py-2 text-left border">Aktion</th>
                </tr>
            </thead>
            <tbody>
                <tr
                    v-for="camp in campaigns"
                    :key="camp.id"
                    :class="camp.responded ? 'bg-green-50' : ''"
                >
                    <td class="px-3 py-2 border">{{ camp.recipient_email }}</td>
                    <td class="px-3 py-2 border">{{ camp.subject }}</td>
                    <td class="px-3 py-2 border">
                        {{ new Date(camp.sent_at).toLocaleString() }}
                    </td>
                    <td class="px-3 py-2 border">
                        <span
                            :class="
                                camp.responded
                                    ? 'text-green-700'
                                    : 'text-gray-500'
                            "
                        >
                            {{ camp.responded ? "Antwort erhalten" : "Offen" }}
                        </span>
                    </td>
                    <td class="px-3 py-2 border">
                        <button
                            v-if="!camp.responded"
                            @click="openModal(camp)"
                            class="px-2 py-1 text-sm text-white bg-teal-600 rounded hover:bg-teal-700"
                        >
                            Als beantwortet markieren
                        </button>
                        <span v-else class="text-sm text-gray-600">—</span>
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- Modal für Antwort-Daten -->
        <Dialog
            v-model="editing"
            class="fixed inset-0 z-50 flex items-center justify-center bg-black/50"
        >
            <div class="w-full max-w-md p-6 bg-white rounded-lg">
                <h2 class="mb-4 text-xl font-bold">Antwort-Daten eintragen</h2>
                <form @submit.prevent="submit">
                    <div class="mb-3">
                        <label class="block text-sm font-medium"
                            >Name Ansprechpartner</label
                        >
                        <input
                            v-model="form.contact_name"
                            type="text"
                            class="w-full px-2 py-1 border rounded"
                        />
                    </div>
                    <div class="mb-3">
                        <label class="block text-sm font-medium"
                            >E-Mail Ansprechpartner</label
                        >
                        <input
                            v-model="form.contact_email"
                            type="email"
                            class="w-full px-2 py-1 border rounded"
                        />
                    </div>
                    <div class="mb-3">
                        <label class="block text-sm font-medium">Telefon</label>
                        <input
                            v-model="form.contact_phone"
                            type="text"
                            class="w-full px-2 py-1 border rounded"
                        />
                    </div>
                    <div class="flex justify-end gap-2 mt-4">
                        <button
                            type="button"
                            @click="editing = false"
                            class="px-4 py-2 border rounded"
                        >
                            Abbrechen
                        </button>
                        <button
                            type="submit"
                            class="px-4 py-2 text-white bg-teal-600 rounded hover:bg-teal-700"
                        >
                            Speichern
                        </button>
                    </div>
                </form>
            </div>
        </Dialog>
    </div>
</template>

<script setup>
import { ref } from "vue";
import { Inertia } from "@inertiajs/inertia";
import Dialog from "@/Components/Dialog.vue"; // oder dein Modal-Component

const props = defineProps({
    campaigns: Array,
});

const editing = ref(false);
const current = ref(null);
const form = ref({
    contact_name: "",
    contact_email: "",
    contact_phone: "",
});

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
