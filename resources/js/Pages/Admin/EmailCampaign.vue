<template>
    <div class="max-w-2xl py-10 mx-auto">
        <h1 class="mb-6 text-3xl font-extrabold text-gray-900 dark:text-white">
            Werbe-Mail versenden
        </h1>

        <form @submit.prevent="submit" class="space-y-6">
            <!-- Empfänger -->
            <div>
                <label for="to_email" class="block mb-1 font-semibold">
                    Empfänger-E-Mail <span class="text-red-500">*</span>
                </label>
                <input
                    v-model="form.to_email"
                    type="email"
                    id="to_email"
                    autocomplete="email"
                    required
                    class="w-full px-4 py-2 border rounded focus:ring-2 focus:ring-teal-400"
                    placeholder="beispiel@firma.de"
                />
                <span
                    v-if="errors.to_email"
                    class="block mt-1 text-xs text-red-600"
                >
                    {{ errors.to_email }}
                </span>
            </div>
            <div>
                <label for="to_name" class="block mb-1 font-semibold">
                    Empfänger-Name
                </label>
                <input
                    v-model="form.to_name"
                    type="text"
                    id="to_name"
                    autocomplete="name"
                    class="w-full px-4 py-2 border rounded focus:ring-2 focus:ring-teal-400"
                    placeholder="Max Mustermann"
                />
            </div>

            <!-- Vorlage Auswahl -->
            <div>
                <label for="template_key" class="block mb-1 font-semibold">
                    Vorlage <span class="text-red-500">*</span>
                </label>
                <select
                    v-model="form.template_key"
                    id="template_key"
                    @change="applyTemplate"
                    required
                    class="w-full px-4 py-2 border rounded focus:ring-2 focus:ring-teal-400"
                >
                    <option value="">– Bitte wählen –</option>
                    <option
                        v-for="tpl in templates"
                        :key="tpl.key"
                        :value="tpl.key"
                    >
                        {{ tpl.label }}
                    </option>
                </select>
                <span
                    v-if="errors.template_key"
                    class="block mt-1 text-xs text-red-600"
                >
                    {{ errors.template_key }}
                </span>
            </div>

            <!-- Betreff -->
            <div>
                <label for="subject" class="block mb-1 font-semibold">
                    Betreff <span class="text-red-500">*</span>
                </label>
                <input
                    v-model="form.subject"
                    type="text"
                    id="subject"
                    required
                    class="w-full px-4 py-2 border rounded focus:ring-2 focus:ring-teal-400"
                    placeholder="Betreff der E-Mail"
                />
                <span
                    v-if="errors.subject"
                    class="block mt-1 text-xs text-red-600"
                >
                    {{ errors.subject }}
                </span>
            </div>

            <!-- Body (HTML) -->
            <div>
                <label for="body" class="block mb-1 font-semibold">
                    E-Mail-Text (HTML) <span class="text-red-500">*</span>
                </label>
                <textarea
                    v-model="form.body"
                    id="body"
                    rows="9"
                    required
                    class="w-full px-4 py-2 font-mono border rounded focus:ring-2 focus:ring-teal-400"
                    placeholder="E-Mail-Inhalt mit HTML"
                ></textarea>
                <span
                    v-if="errors.body"
                    class="block mt-1 text-xs text-red-600"
                >
                    {{ errors.body }}
                </span>
            </div>

            <!-- Live Preview -->
            <div v-if="form.body" class="mt-6">
                <div
                    class="mb-1 font-semibold text-gray-700 dark:text-gray-300"
                >
                    Live-Vorschau
                </div>
                <div
                    class="p-4 prose-sm prose border rounded bg-gray-50 dark:bg-gray-800 max-w-none dark:prose-invert"
                    v-html="form.body"
                ></div>
            </div>

            <div class="flex flex-wrap items-center gap-4 mt-6">
                <button
                    type="submit"
                    class="py-2 font-semibold text-white transition rounded shadow px-7 bg-gradient-to-r from-teal-500 to-indigo-700 hover:scale-105"
                    :disabled="sending"
                >
                    <span v-if="sending">Wird gesendet…</span>
                    <span v-else>E-Mail versenden</span>
                </button>
                <button
                    type="button"
                    @click="resetForm"
                    class="px-6 py-2 text-gray-700 bg-gray-100 border border-gray-300 rounded hover:bg-gray-200 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-gray-200"
                >
                    Zurücksetzen
                </button>
                <span v-if="success" class="font-medium text-green-600">
                    E-Mail erfolgreich gesendet!
                </span>
            </div>
        </form>
    </div>
</template>

<script setup>
import { ref, reactive, watch, nextTick } from "vue";
import { Inertia } from "@inertiajs/inertia";

const props = defineProps({
    templates: Array,
    fullTemplates: Object,
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
const sending = ref(false);

// Flash-Feedback initial
if (props.flash?.success) success.value = true;
if (props.flash?.errors) errors.value = props.flash.errors;

// Template-Auswahl und Personalisierung
watch(
    () => form.template_key,
    (val) => {
        if (val) applyTemplate();
    }
);
watch(
    () => form.to_name,
    (val) => {
        if (form.template_key && props.fullTemplates[form.template_key]) {
            form.body = props.fullTemplates[form.template_key].body.replaceAll(
                "{{ recipient_name }}",
                val || ""
            );
        }
    }
);

function applyTemplate() {
    if (!form.template_key) {
        form.subject = "";
        form.body = "";
        return;
    }
    const tpl = props.fullTemplates[form.template_key];
    form.subject = tpl.subject;
    form.body = tpl.body.replaceAll("{{ recipient_name }}", form.to_name || "");
}

function resetForm() {
    form.to_email = "";
    form.to_name = "";
    form.template_key = "";
    form.subject = "";
    form.body = "";
    errors.value = {};
    success.value = false;
}

function submit() {
    sending.value = true;
    Inertia.post(route("admin.emailcampaign.send"), form, {
        onError(page) {
            errors.value = page.props.flash.errors || {};
            sending.value = false;
            success.value = false;
        },
        onSuccess() {
            errors.value = {};
            success.value = true;
            sending.value = false;
            nextTick(resetForm);
        },
    });
}
</script>
