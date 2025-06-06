<template>
    <div class="max-w-2xl p-6 mx-auto bg-white rounded shadow">
        <h1 class="mb-4 text-2xl font-bold">Werbe-E-Mail versenden</h1>

        <form @submit.prevent="submitMail">
            <div class="mb-4">
                <label class="block mb-1 font-semibold">Empfänger-E-Mail</label>
                <input
                    v-model="form.email"
                    type="email"
                    required
                    class="w-full px-3 py-2 border rounded"
                    placeholder="max.mustermann@firma.de"
                />
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-semibold">Betrefflinie</label>
                <input
                    v-model="form.subject"
                    type="text"
                    required
                    class="w-full px-3 py-2 border rounded"
                    placeholder="Ihr Glasfaser-Angebot von ANTASUS"
                />
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-semibold"
                    >Template auswählen</label
                >
                <select
                    v-model="form.template"
                    required
                    class="w-full px-3 py-2 border rounded"
                >
                    <option
                        v-for="(tpl, index) in templateOptions"
                        :key="index"
                        :value="tpl.view"
                    >
                        {{ tpl.label }}
                    </option>
                </select>
            </div>

            <!-- Optional: Vorab-Vorschau oder Bearbeitung -->
            <div class="mb-6">
                <label class="block mb-1 font-semibold"
                    >E-Mail-Vorschau / Anpassungen (HTML)</label
                >
                <textarea
                    v-model="form.customHtml"
                    rows="8"
                    class="w-full p-3 font-mono border rounded"
                ></textarea>
                <p class="mt-1 text-sm text-gray-500">
                    (Falls leer gelassen, wird das gewählte Template unverändert
                    versandt)
                </p>
            </div>

            <button
                type="submit"
                class="px-6 py-2 font-semibold text-white bg-teal-600 rounded hover:bg-teal-700"
            >
                E-Mail senden
            </button>
        </form>
    </div>
</template>

<script setup>
import { ref } from "vue";
import { Inertia } from "@inertiajs/inertia";

const templateOptions = [
    { label: "Hausanschluss-Angebot", view: "emails.promotions.template1" },
    { label: "Glasfaser-Tiefbau", view: "emails.promotions.template2" },
    // Bei Bedarf weitere Templates hinzufügen …
];

const form = ref({
    email: "",
    subject: "",
    template: templateOptions[0].view,
    customHtml: "",
});

function submitMail() {
    // Wir übermitteln eMail, Betreff, Template-Name und ggf. override-HTML an den Controller
    Inertia.post("/admin/email/send", {
        email: form.value.email,
        subject: form.value.subject,
        template: form.value.template,
        customHtml: form.value.customHtml,
    });
}
</script>
