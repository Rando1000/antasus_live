<template>
    <Head>
        <title>{{ metaTitle }}</title>
        <meta name="description" :content="metaDescription" />
        <meta
            name="keywords"
            content="Glasfaser Tiefbau, Hausanschlüsse, Subunternehmer, Generalunternehmen, DIN VDE, Glasfaserbau NRW, Partner Glasfaserprojekt"
        />
        <meta property="og:title" :content="metaTitle" />
        <meta property="og:description" :content="metaDescription" />
        <meta
            property="og:image"
            content="https://www.antasus.de/images/og-leistungen.webp"
        />
        <meta property="og:url" content="https://www.antasus.de/leistungen" />
        <meta property="og:type" content="website" />
    </Head>
    <div v-if="servicesJsonLd" v-html="jsonLdScriptTag" />
    <!-- JSON-LD für Services im Body -->

    <GuestLayout :serviceArea="'dienstleistungen'">
        <template #header>
            <section class="w-full px-4 text-center animate-fade-in">
                <div class="max-w-4xl mx-auto">
                    <h1
                        class="mb-6 text-4xl font-extrabold text-white md:text-5xl drop-shadow-xl"
                    >
                        <span class="relative inline-block">
                            Unsere Glasfaser-Leistungen
                            <span
                                class="absolute left-0 w-full h-1 rounded -bottom-1 bg-antasus-primary/70"
                            ></span>
                        </span>
                    </h1>
                    <p
                        class="mb-8 text-lg md:text-xl text-white/90 drop-shadow-md"
                    >
                        Wir bieten <strong>Glasfaser-Tiefbau</strong>,
                        <strong>Hausanschluss</strong> &
                        <strong>Projektplanung</strong> nach DIN/VDE –
                        termintreu, zuverlässig und partnerschaftlich.
                    </p>
                    <Link
                        href="/kontakt"
                        class="inline-block px-6 py-3 font-semibold text-white transition rounded-lg shadow-lg bg-antasus-primary hover:bg-antasus-dark"
                    >
                        Projekt anfragen
                    </Link>
                </div>
            </section>
        </template>

        <section class="py-12 text-white bg-gray-800 rounded-b">
            <div class="max-w-4xl px-6 mx-auto">
                <p class="text-lg text-center">
                    ANTASUS Infra realisiert professionelle
                    <strong>Glasfaser Hausanschlüsse</strong> und
                    <strong>Glasfaser Tiefbauprojekte</strong> gemäß DIN 18220
                    und DIN EN 50173 in NRW. Von der Planung über
                    <em>GIS-Dokumentation</em> bis zur Inbetriebnahme. Hier
                    erfahren Sie mehr über unsere
                    <Link href="/leistungen" class="underline">
                        Leistungen </Link
                    >.
                </p>
            </div>
        </section>
        <h2
            class="pt-20 pb-10 text-4xl font-extrabold text-center underline transition place-self-center"
        >
            Unsere Leistungen im Überblick
        </h2>
        <ArticleCard :services="services" @select="selectService" />

        <!-- → DETAILSECTION (wenn Service ausgewählt) ←
        <section

            class="py-16 bg-white border-t border-gray-100"
        >
            <div class="max-w-6xl px-4 mx-auto">
                <h2
                    class="mb-10 text-3xl font-extrabold text-center text-gray-900"
                >
                    Details zu "{{
                        services.find((s) => s.id === activeService)?.title
                    }}"
                </h2>
                <p class="mb-8 text-gray-600">
                    {{
                        services.find((s) => s.id === activeService)
                            ?.description
                    }}
                </p>
                <div class="grid gap-8 md:grid-cols-2">
                    <ServiceItemCard
                        v-for="item in services.find(
                            (s) => s.id === activeService
                        )?.items || []"
                        :key="item.id"
                        :item="item"
                        @select="showModal"
                    />
                </div>
            </div>
        </section> -->

        <section class="py-16 border-t border-gray-100 bg-gray-50">
            <div class="max-w-4xl px-4 mx-auto">
                <h2
                    class="mb-10 text-3xl font-extrabold text-center text-gray-900"
                >
                    Häufige Fragen
                </h2>
                <div v-for="(faq, index) in faqs" :key="index" class="mb-6">
                    <details class="p-4 border rounded-lg group">
                        <summary
                            class="text-lg font-semibold text-gray-800 cursor-pointer"
                        >
                            {{ faq.frage }}
                        </summary>
                        <p class="mt-2 leading-relaxed text-gray-600">
                            {{ faq.antwort }}
                        </p>
                    </details>
                </div>
            </div>
        </section>

        <section class="py-20 bg-white">
            <div class="max-w-4xl px-4 mx-auto text-center">
                <h2 class="mb-4 text-2xl font-bold text-gray-900">
                    WIR sind Bereit für Ihre Projekte!
                </h2>
                <Link
                    href="/kontakt"
                    class="inline-block px-6 py-3 mt-4 text-white transition bg-teal-600 rounded-lg hover:bg-teal-700"
                >
                    Jetzt Kontakt aufnehmen
                </Link>
            </div>
        </section>
    </GuestLayout>
</template>

<script setup>
import ArticleCard from "@/Components/ArticleCard_Slug.vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import ServiceItemCard from "@/Components/Services/ServiceItemCard.vue";
import { Head, Link } from "@inertiajs/vue3";
import { onMounted, ref, computed, watch } from "vue";

const props = defineProps({
    services: Array,
    metaTitle: {
        type: String,
        default: "Unsere Glasfaser-Leistungen – Antasus Infra",
    },
    metaDescription: {
        type: String,
        default:
            "Erfahren Sie alles über Glasfaser-Tiefbau, Hausanschlüsse und Projektplanung von Antasus Infra – professionell, termintreu.",
    },
});

const activeService = ref(null);
const selectService = (service) => {
    activeService.value = service.id;
};

const jsonLd = {
    "@context": "https://schema.org",
    "@type": "LocalBusiness",
    name: "ANTASUS Infra",
    image: "https://www.antasus.de/images/antasus-logo2.svg",
    "@id": "https://www.antasus.de",
    url: "https://www.antasus.de",
    telephone: "+49 176 24757616",
    email: "info@antasus.de",
    address: {
        "@type": "PostalAddress",
        streetAddress: "Norrenbergstraße 122",
        addressLocality: "Wuppertal",
        postalCode: "42289",
        addressCountry: "DE",
    },
    description:
        "Ihr Subunternehmer für Glasfaser-Tiefbau, Hausanschlüsse und technische Projektabwicklung nach DIN/VDE – partnerschaftlich & termintreu.",
    areaServed: {
        "@type": "GeoCircle",
        geoMidpoint: {
            "@type": "GeoCoordinates",
            latitude: 51.2562,
            longitude: 7.1508,
        },
        geoRadius: 150,
    },
    priceRange: "Auf Anfrage",
    sameAs: [
        "https://www.linkedin.com/company/antasus",
        "https://www.xing.com/pages/antasus-infra",
    ],
};

onMounted(() => {
    const script = document.createElement("script");
    script.type = "application/ld+json";
    script.text = JSON.stringify(jsonLd);
    document.head.appendChild(script);
});

const faqs = [
    {
        frage: "Was kostet ein Glasfaser Hausanschluss mit Antasus?",
        antwort:
            "Die Kosten hängen von Lage, Länge der Trasse und Technik ab. Für Generalunternehmen kalkulieren wir individuell. Privatkunden erhalten ein Festpreisangebot nach Vor-Ort-Besichtigung.",
    },
    {
        frage: "Wie lange dauert ein Tiefbauprojekt?",
        antwort:
            "Die Dauer variiert je nach Umfang. Kleinere Projekte (1–2 Hausanschlüsse) sind in 2–4 Tagen abgeschlossen. Großprojekte werden termingerecht nach Bauzeitenplan umgesetzt.",
    },
    {
        frage: "Arbeitet Antasus normkonform nach deutschen Vorgaben und Richtlinien?",
        antwort:
            "Ja, unsere Leistungen erfüllen die aktuellen Normen und Richtlinien (z.B. DIN EN 50173, DIN EN 61386), dokumentiert nach Vorgaben der Netzbetreiber.",
    },
    {
        frage: "Wer ist Ansprechpartner während der Umsetzung?",
        antwort:
            "Ein deutschsprachiger Bauleiter oder technischer Ansprechpartner ist während der gesamten Umsetzung für Sie erreichbar, telefonisch oder vor Ort.",
    },
];

const structuredDataFAQ = {
    "@context": "https://schema.org",
    "@type": "FAQPage",
    mainEntity: faqs.map((faq) => ({
        "@type": "Question",
        name: faq.frage,
        acceptedAnswer: {
            "@type": "Answer",
            text: faq.antwort,
        },
    })),
};

onMounted(() => {
    const faqScript = document.createElement("script");
    faqScript.type = "application/ld+json";
    faqScript.text = JSON.stringify(structuredDataFAQ);
    document.head.appendChild(faqScript);
});

const servicesJsonLd = computed(() => ({
    "@context": "https://schema.org",
    "@graph": props.services.map((srv) => ({
        "@type": "Service",
        "@id": `https://www.antasus.de/leistungen/${srv.slug}#service`,
        name: srv.title,
        description: srv.description,
        provider: {
            "@type": "Organization",
            name: "Antasus Infra",
            url: "https://www.antasus.de",
        },
        areaServed: {
            "@type": "Country",
            name: "Deutschland",
        },
        offers: {
            "@type": "Offer",
            priceCurrency: "EUR",
            // Bei Bedarf können hier weitere Angebotsfelder ergänzt werden:
            // price: "0.00",
            // priceSpecification: { … }
        },
        url: `https://www.antasus.de/leistungen/${srv.slug}`,
    })),
}));

// 2) Baue das <script>-Tag aus dem JSON-LD-Objekt zusammen
const jsonLdScriptTag = `<script type="application/ld+json">
${JSON.stringify(servicesJsonLd.value, null, 2)}`;

// 3) Füge das Script bei Bedarf (z. B. in onMounted) ins <head> ein
onMounted(() => {
    const tag = document.createElement("script");
    tag.type = "application/ld+json";
    tag.text = JSON.stringify(servicesJsonLd.value, null, 2);
    document.head.appendChild(tag);
});
</script>
