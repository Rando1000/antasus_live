<template>
    <Head>
        <title>
            Kontaktieren Sie ANTASUS Infra | Subunternehmer für Glasfaser &
            Tiefbau
        </title>
        <meta
            name="description"
            content="Fragen zu Projekten oder Kooperationsanfragen? Nehmen Sie Kontakt auf mit ANTASUS Infra – Ihr zuverlässiger Subunternehmer für normgerechten Glasfaserausbau."
        />
        <meta
            name="keywords"
            content="Glasfaser Kontakt, Tiefbau Subunternehmer, Kooperation, Anfrage Glasfaserausbau, Kontakt ANTASUS Infra"
        />
        <!-- OG & Canonical -->
        <meta
            property="og:title"
            content="Jetzt Kontakt aufnehmen – ANTASUS Infra"
        />
        <meta
            property="og:description"
            content="Planen Sie ein Glasfaserprojekt? Sichern Sie sich einen starken Partner im Tiefbau: ANTASUS Infra."
        />
        <meta
            property="og:image"
            content="https://www.antasus.de/images/og-kontakt.webp"
        />
        <meta property="og:url" content="https://www.antasus.de/kontakt" />
        <meta property="og:type" content="website" />
        <link rel="canonical" href="https://www.antasus.de/kontakt" />
    </Head>

    <GuestLayout title="Kontakt">
        <section class="py-24 transition bg-white dark:bg-slate-900">
            <div class="max-w-3xl px-4 mx-auto text-center">
                <h1
                    class="mb-4 text-4xl font-extrabold text-gray-900 dark:text-white"
                >
                    Kontaktieren Sie uns
                </h1>
                <p class="mb-10 text-gray-600 dark:text-gray-300">
                    Haben Sie Fragen oder möchten ein Projekt starten? Wir
                    freuen uns auf Ihre Nachricht.
                </p>
            </div>

            <div class="max-w-3xl px-4 mx-auto">
                <form
                    @submit.prevent="submitForm"
                    class="p-8 space-y-6 shadow bg-gray-50 dark:bg-slate-800 rounded-xl"
                    aria-label="Kontaktformular"
                    autocomplete="off"
                >
                    <!-- Name -->
                    <div>
                        <label
                            for="name"
                            class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300"
                            >Name *</label
                        >
                        <input
                            v-model="form.name"
                            type="text"
                            id="name"
                            name="name"
                            required
                            autocomplete="name"
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-400 dark:bg-slate-700 dark:border-slate-600 dark:text-white"
                            :aria-invalid="!!form.errors.name"
                            :aria-describedby="
                                form.errors.name ? 'error-name' : null
                            "
                        />
                        <span
                            v-if="form.errors.name"
                            id="error-name"
                            class="text-sm text-red-600"
                            >{{ form.errors.name }}</span
                        >
                    </div>

                    <!-- E-Mail -->
                    <div>
                        <label
                            for="email"
                            class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300"
                            >E-Mail *</label
                        >
                        <input
                            v-model="form.email"
                            type="email"
                            id="email"
                            name="email"
                            required
                            autocomplete="email"
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-400 dark:bg-slate-700 dark:border-slate-600 dark:text-white"
                            :aria-invalid="!!form.errors.email"
                            :aria-describedby="
                                form.errors.email ? 'error-email' : null
                            "
                        />
                        <span
                            v-if="form.errors.email"
                            id="error-email"
                            class="text-sm text-red-600"
                            >{{ form.errors.email }}</span
                        >
                    </div>

                    <!-- Telefon (optional) -->
                    <div>
                        <label
                            for="phone"
                            class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300"
                        >
                            Telefonnummer
                            <span class="text-gray-500 dark:text-gray-400"
                                >(optional)</span
                            >
                        </label>
                        <input
                            v-model="form.phone"
                            type="tel"
                            id="phone"
                            name="phone"
                            inputmode="tel"
                            autocomplete="tel"
                            placeholder="+49 176 ..."
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-400 dark:bg-slate-700 dark:border-slate-600 dark:text-white"
                            :aria-invalid="!!form.errors.phone"
                            :aria-describedby="
                                form.errors.phone ? 'error-phone' : null
                            "
                        />
                        <span
                            v-if="form.errors.phone"
                            id="error-phone"
                            class="text-sm text-red-600"
                            >{{ form.errors.phone }}</span
                        >
                    </div>

                    <!-- Rückruf-Wunsch -->
                    <div class="flex items-center">
                        <input
                            type="checkbox"
                            id="callback"
                            v-model="form.callback"
                            class="text-teal-600 border-gray-300 rounded shadow-sm focus:ring-teal-400"
                        />
                        <label
                            for="callback"
                            class="ml-2 text-sm text-gray-700 dark:text-gray-300"
                        >
                            Bitte um telefonischen Rückruf
                        </label>
                    </div>

                    <!-- Nachricht -->
                    <div v-if="!form.callback">
                        <label
                            for="message"
                            class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300"
                            >Nachricht *</label
                        >
                        <textarea
                            v-model="form.message"
                            id="message"
                            name="message"
                            rows="5"
                            required
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-400 dark:bg-slate-700 dark:border-slate-600 dark:text-white"
                            :aria-invalid="!!form.errors.message"
                            :aria-describedby="
                                form.errors.message ? 'error-message' : null
                            "
                        ></textarea>
                        <span
                            v-if="form.errors.message"
                            id="error-message"
                            class="text-sm text-red-600"
                            >{{ form.errors.message }}</span
                        >
                    </div>

                    <!-- Datenschutz -->
                    <div class="flex items-center">
                        <input
                            type="checkbox"
                            id="privacy"
                            v-model="form.agree"
                            required
                            class="text-teal-600 border-gray-300 rounded shadow-sm focus:ring-teal-400"
                        />
                        <label
                            for="privacy"
                            class="ml-2 text-sm text-gray-700 dark:text-gray-300"
                        >
                            Ich akzeptiere die
                            <Link
                                href="/datenschutz"
                                class="text-teal-600 underline dark:text-teal-300"
                                >Datenschutzbestimmungen</Link
                            >.
                        </label>
                    </div>
                    <span
                        v-if="form.errors.agree"
                        class="text-sm text-red-600"
                        >{{ form.errors.agree }}</span
                    >

                    <!-- Senden -->
                    <div class="flex flex-col gap-2">
                        <button
                            type="submit"
                            :disabled="form.processing"
                            class="px-6 py-3 font-semibold text-white transition rounded-lg bg-gradient-to-r from-teal-500 to-indigo-700 hover:brightness-110 focus:outline-none focus:ring-2 focus:ring-teal-400 disabled:opacity-60"
                        >
                            <span v-if="form.processing" class="animate-pulse"
                                >Nachricht wird gesendet...</span
                            >
                            <span v-else>Nachricht senden</span>
                        </button>
                        <transition name="fade">
                            <p
                                v-if="form.recentlySuccessful"
                                class="mt-2 text-sm text-green-600 animate-fade-in"
                            >
                                Vielen Dank für Ihre Nachricht! Wir melden uns
                                zeitnah.
                            </p>
                        </transition>
                    </div>
                </form>
            </div>
        </section>
    </GuestLayout>
</template>

<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import { useForm, Link, Head } from "@inertiajs/vue3";
import { onMounted } from "vue";

// Strukturierte Kontaktdaten für Google AI & SEO
const contactStructuredData = {
    "@context": "https://schema.org",
    "@type": "ContactPage",
    name: "Kontakt | ANTASUS Infra",
    description:
        "Kontaktieren Sie ANTASUS Infra – Ihr Subunternehmer für Glasfaser-Tiefbau, Hausanschlüsse & Projektmanagement.",
    url: "https://www.antasus.de/kontakt",
    mainEntity: {
        "@type": "LocalBusiness",
        name: "ANTASUS Infra",
        url: "https://www.antasus.de",
        logo: "https://www.antasus.de/images/antasus-logo2.svg",
        telephone: "+49 176 24757616",
        email: "info@antasus.de",
        address: {
            "@type": "PostalAddress",
            streetAddress: "Norrenbergstraße 122",
            postalCode: "42289",
            addressLocality: "Wuppertal",
            addressCountry: "DE",
        },
    },
};

onMounted(() => {
    // Alte Scripte entfernen, um mehrfachen Anhang zu vermeiden
    document
        .querySelectorAll('script[type="application/ld+json"].kontakt-jsonld')
        .forEach((e) => e.remove());
    const script = document.createElement("script");
    script.type = "application/ld+json";
    script.className = "kontakt-jsonld";
    script.text = JSON.stringify(contactStructuredData);
    document.head.appendChild(script);
});

// Inertia form (mit State für Feedback etc.)
const form = useForm({
    name: "",
    email: "",
    phone: "",
    message: "",
    callback: false,
    agree: false,
});

// UX: Feldvalidierung & Bestätigung
const submitForm = () => {
    form.post(route("kontakt.store"), {
        preserveScroll: true,
        onSuccess: () => {
            // Optionale Actions nach Erfolg
        },
    });
};
</script>

<style scoped>
.fade-enter-active,
.fade-leave-active,
.animate-fade-in {
    transition: opacity 0.3s cubic-bezier(0.5, 0, 0.2, 1);
}
.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
</style>
