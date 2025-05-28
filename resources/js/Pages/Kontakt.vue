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

        <!-- OpenGraph -->
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
    </Head>

    <GuestLayout title="Kontakt">
        <section class="py-24 bg-white">
            <div class="max-w-3xl px-4 mx-auto text-center">
                <h1 class="mb-4 text-4xl font-extrabold text-gray-900">
                    Kontaktieren Sie uns
                </h1>
                <p class="mb-10 text-gray-600">
                    Haben Sie Fragen oder möchten ein Projekt starten? Wir
                    freuen uns auf Ihre Nachricht.
                </p>
            </div>

            <div class="max-w-3xl px-4 mx-auto">
                <form
                    @submit.prevent="submitForm"
                    class="p-8 space-y-6 shadow bg-gray-50 rounded-xl"
                >
                    <!-- Name -->
                    <div>
                        <label
                            for="name"
                            class="block mb-2 text-sm font-medium text-gray-700"
                            >Name</label
                        >
                        <input
                            v-model="form.name"
                            type="text"
                            id="name"
                            required
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-teal-300"
                        />
                        <span
                            v-if="form.errors.name"
                            class="text-sm text-red-600"
                            >{{ form.errors.name }}</span
                        >
                    </div>

                    <!-- E-Mail -->
                    <div>
                        <label
                            for="email"
                            class="block mb-2 text-sm font-medium text-gray-700"
                            >E-Mail</label
                        >
                        <input
                            v-model="form.email"
                            type="email"
                            id="email"
                            required
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-teal-300"
                        />
                        <span
                            v-if="form.errors.email"
                            class="text-sm text-red-600"
                            >{{ form.errors.email }}</span
                        >
                    </div>

                    <!-- Telefon (optional) -->
                    <div>
                        <label
                            for="phone"
                            class="block mb-2 text-sm font-medium text-gray-700"
                        >
                            Telefonnummer
                            <span class="text-gray-500"
                                >(für dringende Rückfragen – optional)</span
                            >
                        </label>
                        <input
                            v-model="form.phone"
                            type="tel"
                            id="phone"
                            placeholder="+49 176 ..."
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-teal-300"
                        />
                        <span
                            v-if="form.errors.phone"
                            class="text-sm text-red-600"
                            >{{ form.errors.phone }}</span
                        >
                    </div>

                    <!-- Rückruf-Wunsch -->
                    <div class="flex items-start">
                        <input
                            type="checkbox"
                            id="callback"
                            v-model="form.callback"
                            class="mt-1 mr-2"
                        />
                        <label for="callback" class="text-sm text-gray-600">
                            Bitte um telefonischen Rückruf
                        </label>
                    </div>

                    <!-- Nachricht -->
                    <div v-if="!form.callback">
                        <label
                            for="message"
                            class="block mb-2 text-sm font-medium text-gray-700"
                            >Nachricht</label
                        >
                        <textarea
                            v-model="form.message"
                            id="message"
                            rows="5"
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-teal-300"
                        ></textarea>
                        <span
                            v-if="form.errors.message"
                            class="text-sm text-red-600"
                            >{{ form.errors.message }}</span
                        >
                    </div>

                    <!-- Datenschutz -->
                    <div class="flex items-start">
                        <input
                            type="checkbox"
                            id="privacy"
                            v-model="form.agree"
                            required
                            class="mt-1 mr-2"
                        />
                        <label for="privacy" class="text-sm text-gray-600">
                            Ich akzeptiere die
                            <Link
                                href="/datenschutz"
                                class="text-teal-600 underline"
                            >
                                Datenschutzbestimmungen </Link
                            >.
                        </label>
                        <span
                            v-if="form.errors.agree"
                            class="ml-2 text-sm text-red-600"
                            >{{ form.errors.agree }}</span
                        >
                    </div>

                    <!-- Senden -->
                    <div>
                        <button
                            type="submit"
                            :disabled="form.processing"
                            class="px-6 py-3 text-white transition bg-teal-600 rounded-lg hover:bg-teal-700 disabled:opacity-50"
                        >
                            Nachricht senden
                        </button>
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
    const script = document.createElement("script");
    script.type = "application/ld+json";
    script.text = JSON.stringify(contactStructuredData);
    document.head.appendChild(script);
});

const form = useForm({
    name: "",
    email: "",
    phone: "",
    message: "",
    callback: false,
    agree: false,
});

const submitForm = () => {
    form.post(route("kontakt.store"), {
        preserveScroll: true,
    });
};
</script>
