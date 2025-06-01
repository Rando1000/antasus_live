<template>
    <Head>
        <!-- Standard-Meta-Tags -->
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

        <!-- EIN SCRIPT-BLOCK mit rohem JSON-LD (LocalBusiness + FAQPage + optional Service) -->
        <script type="application/ld+json" v-html="jsonLdRaw"></script>
    </Head>

    <GuestLayout :serviceArea="'dienstleistungen'">
        <!-- HEADER -->
        <template #header>
            <section class="w-full px-4 text-center animate-fade-in">
                <div class="max-w-4xl mx-auto">
                    <h1
                        class="mb-6 text-4xl font-extrabold text-white md:text-5xl drop-shadow-xl"
                    >
                        <span class="relative inline-block">
                            Unsere Leistungen
                            <span
                                class="absolute left-0 w-full h-1 rounded -bottom-1 bg-antasus-primary/70"
                            ></span>
                        </span>
                    </h1>
                    <p
                        class="mb-8 text-lg md:text-xl text-white/90 drop-shadow-md"
                    >
                        Wir bieten Komplettlösungen im Glasfaserausbau –
                        <span class="font-semibold text-white"
                            >fachgerecht, zuverlässig und normkonform</span
                        >.
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

        <!-- Auswahlbereich: Artikelkarten -->
        <ArticleCard :services="services" @select="selectService" />

        <!-- Detailabschnitt für eine einzelne Leistung -->
        <section
            v-if="activeServiceObject"
            class="py-16 bg-white border-t border-gray-100"
        >
            <div class="max-w-6xl px-4 mx-auto">
                <h2
                    class="mb-10 text-3xl font-extrabold text-center text-gray-900"
                >
                    Details zu "{{ activeServiceObject.title }}"
                </h2>
                <div class="grid gap-8 md:grid-cols-2">
                    <ServiceItemCard
                        v-for="item in activeServiceObject.items"
                        :key="item.id"
                        :item="item"
                        @select="showModal"
                    />
                </div>
            </div>
        </section>

        <!-- FAQ-Bereich -->
        <section class="py-16 bg-white border-t border-gray-100">
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

        <!-- Call-to-Action am Seitenende -->
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
import { ref, computed } from "vue";
import { Head, Link } from "@inertiajs/vue3";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import ArticleCard from "@/Components/ArticleCard_Slug.vue";
import ServiceItemCard from "@/Components/Services/ServiceItemCard.vue";

// 1) Props: Array aller Services aus dem Controller
const props = defineProps({
    services: Array,
});

// 2) State: aktuell ausgewählte Service-ID
const activeService = ref(null);
const selectService = (service) => {
    activeService.value = service.id;
};

// 3) Computed: Objekt der aktiven Service (oder null)
const activeServiceObject = computed(() => {
    return props.services.find((s) => s.id === activeService.value) || null;
});

// 4) Meta-Title & Description
const metaTitle = computed(() =>
    activeServiceObject.value
        ? `Leistung: ${activeServiceObject.value.title} | ANTASUS Infra`
        : "Glasfaser-Tiefbau & Hausanschlüsse | Subunternehmer für Generalunternehmen"
);
const metaDescription = computed(() =>
    activeServiceObject.value
        ? activeServiceObject.value.description
        : "ANTASUS Infra ist Ihr zuverlässiger Subunternehmer für Glasfaser-Tiefbau, Hausanschlüsse und Projektabwicklung nach DIN/VDE – termintreu, normkonform und partnerschaftlich."
);

// 5) LocalBusiness-Schema (immer mitgeben)
const localBusinessLd = {
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

// 6) FAQPage-Schema (immer mitgeben)
const faqs = [
    {
        frage: "Was kostet ein Glasfaser-Hausanschluss mit Antasus?",
        antwort:
            "Die Kosten hängen von Lage, Länge der Trasse und Technik ab. Für Generalunternehmen kalkulieren wir individuell. Privatkunden erhalten ein Festpreisangebot nach Vor-Ort-Besichtigung.",
    },
    {
        frage: "Wie lange dauert ein Tiefbauprojekt?",
        antwort:
            "Die Dauer variiert je nach Umfang. Kleinere Projekte (1–2 Hausanschlüsse) sind in 2–4 Tagen abgeschlossen. Großprojekte werden termingerecht nach Bauzeitenplan umgesetzt.",
    },
    {
        frage: "Arbeitet Antasus normkonform nach VDE & DIN?",
        antwort:
            "Ja – unsere Leistungen erfüllen die aktuellen Normen und Richtlinien (z. B. DIN 18322, VDE 0100), dokumentiert nach Vorgaben der Netzbetreiber.",
    },
    {
        frage: "Wer ist Ansprechpartner während der Umsetzung?",
        antwort:
            "Ein deutschsprachiger Bauleiter oder technischer Ansprechpartner ist während der gesamten Umsetzung für Sie erreichbar – telefonisch oder vor Ort.",
    },
];
const faqLd = {
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

// 7) Service-Schema (nur, wenn eine einzelne Service gewählt ist)
function makeServiceLd(service) {
    return {
        "@type": "Service",
        name: service.title,
        description: service.description,
        provider: {
            "@type": "Organization",
            name: "ANTASUS Infra",
            url: "https://www.antasus.de",
            contactPoint: {
                "@type": "ContactPoint",
                telephone: "+49 202 42988411",
                contactType: "customer support",
            },
        },
        areaServed: {
            "@type": "Place",
            name: "Deutschland",
        },
    };
}

// 8) Zusammensetzen von @graph in EINEM einzigen JSON-LD-Block
const fullGraphLd = computed(() => {
    // LocalBusiness + FAQPage immer
    const arr = [localBusinessLd, faqLd];

    // Falls ein Service aktiv, Service-Schema hinzufügen
    if (activeServiceObject.value) {
        arr.push(makeServiceLd(activeServiceObject.value));
    }

    return {
        "@context": "https://schema.org",
        "@graph": arr,
    };
});

// 9) Wir brauchen die JSON-LD als **unescaped** String, damit Vue es exakt so in den <script>-Block schreibt
const jsonLdRaw = computed(() => {
    // JSON.stringify … ohne zusätzliche Escape-Zeichen
    return JSON.stringify(fullGraphLd.value);
});
</script>
