<template>
    <div class="max-w-2xl py-10 mx-auto">
        <!-- 1) Alle vollständigen Templates für JS parsen -->
        <div
            id="js-email-templates-json"
            style="display: none"
            v-text="JSON.stringify(fullTemplates)"
        ></div>

        <h1 class="mb-6 text-2xl font-bold">Werbe-Mail versenden</h1>

        <form @submit.prevent="submit">
            <!-- Empfänger-E-Mail -->
            <div class="mb-4">
                <label class="block mb-1 font-semibold" for="to_email"
                    >Empfänger-E-Mail</label
                >
                <input
                    v-model="form.to_email"
                    type="email"
                    id="to_email"
                    class="w-full px-3 py-2 border rounded"
                    placeholder="beispiel@firma.de"
                />
                <span v-if="errors.to_email" class="text-sm text-red-600">{{
                    errors.to_email
                }}</span>
            </div>

            <!-- Empfänger-Name (optional) -->
            <div class="mb-4">
                <label class="block mb-1 font-semibold" for="to_name"
                    >Empfänger-Name (optional)</label
                >
                <input
                    v-model="form.to_name"
                    type="text"
                    id="to_name"
                    class="w-full px-3 py-2 border rounded"
                    placeholder="Max Mustermann"
                />
            </div>

            <!-- Vorlage Auswahl -->
            <div class="mb-4">
                <label for="template_key" class="block mb-1 font-semibold"
                    >Vorlage</label
                >
                <select
                    v-model="form.template_key"
                    id="template_key"
                    @change="applyTemplate"
                    class="w-full px-3 py-2 border rounded"
                >
                    <option value="">– bitte wählen –</option>
                    <option
                        v-for="tpl in templates"
                        :key="tpl.key"
                        :value="tpl.key"
                    >
                        {{ tpl.label }}
                    </option>
                </select>
                <span v-if="errors.template_key" class="text-sm text-red-600">{{
                    errors.template_key
                }}</span>
            </div>

            <!-- Betreff -->
            <div class="mb-4">
                <label class="block mb-1 font-semibold" for="subject"
                    >Betreff</label
                >
                <input
                    v-model="form.subject"
                    type="text"
                    id="subject"
                    class="w-full px-3 py-2 border rounded"
                    placeholder="Betreff der E-Mail"
                />
                <span v-if="errors.subject" class="text-sm text-red-600">{{
                    errors.subject
                }}</span>
            </div>

            <!-- Body -->
            <div class="mb-6">
                <label class="block mb-1 font-semibold" for="body"
                    >E-Mail-Text (HTML)</label
                >
                <textarea
                    v-model="form.body"
                    id="body"
                    class="w-full px-3 py-2 border rounded"
                    rows="10"
                ></textarea>
                <span v-if="errors.body" class="text-sm text-red-600">{{
                    errors.body
                }}</span>
            </div>

            <!-- Senden -->
            <div class="flex items-center space-x-4">
                <button
                    type="submit"
                    class="px-6 py-2 text-white transition bg-teal-600 rounded hover:bg-teal-700"
                >
                    E-Mail versenden
                </button>
                <span v-if="success" class="text-green-600"
                    >E-Mail erfolgreich gesendet!</span
                >
            </div>
        </form>
    </div>
</template>

<script setup>
import { ref, reactive } from "vue";
import { Inertia } from "@inertiajs/inertia";

const props = defineProps({
    templates: Array, // [{ key,label }, …]
    fullTemplates: Object, // vollständiges template-Array (Subject+Body)
    flash: Object,
});

const form = reactive({
    to_email: "",
    to_name: "",
    template_key: "",
    subject: "",
    body: "",
});

const errors = ref({});
const success = ref(false);

if (props.flash?.success) {
    success.value = true;
}
if (props.flash?.errors) {
    errors.value = props.flash.errors;
}

function applyTemplate() {
    if (!form.template_key) {
        form.subject = "";
        form.body = "";
        return;
    }
    const tpl = props.fullTemplates[form.template_key];
    form.subject = tpl.subject;
    // Platzhalter für recipient_name direkt setzen
    form.body = tpl.body.replace("{{ recipient_name }}", form.to_name || "");
}

function submit() {
    Inertia.post(route("admin.emailcampaign.send"), form, {
        onError(page) {
            errors.value = page.props.flash.errors || {};
            success.value = false;
        },
        onSuccess() {
            errors.value = {};
            success.value = true;
        },
    });
}
</script>
