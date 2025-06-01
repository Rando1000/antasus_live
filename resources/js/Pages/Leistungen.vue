<template>
    <GuestLayout :serviceArea="'dienstleistungen'">
        <!-- Header-Slot -->
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

        <!-- Listing aller Services -->
        <ArticleCard :services="services" @select="selectService" />

        <!-- Detailbereich für aktuell ausgewählte Service‐Kategorie -->
        <section
            v-if="activeService"
            class="py-16 bg-white border-t border-gray-100"
        >
            <div class="max-w-6xl px-4 mx-auto">
                <h2
                    class="mb-10 text-3xl font-extrabold text-center text-gray-900"
                >
                    Details zu “{{ currentService.title }}”
                </h2>
                <div class="grid gap-8 md:grid-cols-2">
                    <ServiceItemCard
                        v-for="item in currentService.items"
                        :key="item.id"
                        :item="item"
                        @select="openItemDetail"
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
                <div v-for="(faq, idx) in faqs" :key="idx" class="mb-6">
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

        <!-- Call-to-Action -->
        <section class="py-20 bg-white">
            <div class="max-w-4xl px-4 mx-auto text-center">
                <h2 class="mb-4 text-2xl font-bold text-gray-900">
                    WIR sind bereit für Ihre Projekte!
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
import GuestLayout from "@/Layouts/GuestLayout.vue";
import ArticleCard from "@/Components/ArticleCard_Slug.vue";
import ServiceItemCard from "@/Components/Services/ServiceItemCard.vue";
import { Link, router } from "@inertiajs/vue3";
import { ref, computed, onMounted } from "vue";
import { useHead } from "@vueuse/head";

// Props mit allen Services (Array)
const props = defineProps({
    services: { type: Array, required: true },
});

// Aktuell ausgewählte Service‐Kategorie (ID)
const activeService = ref(null);
const selectService = (service) => {
    activeService.value = service.id;
};

// Den Service‐Eintrag anhand der ID zurückgeben
const currentService = computed(
    () => props.services.find((s) => s.id === activeService.value) || {}
);

// FAQs (statisch)
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

// Öffnet Detailseite eines einzelnen Service-Items (Modal oder Route)
const openItemDetail = (item) => {
    if (!currentService.value.slug) return;
    const url = `/leistungen/${currentService.value.slug}/${item.slug}/${item.id}`;
    router.push({
        url,
        replace: false,
        preserveScroll: true,
        preserveState: true,
    });
};

//--------------
// Structured Data via useHead
//--------------

// 1) LocalBusiness (immer einbauen)
const localBusinessLd = {
    "@context": "https://schema.org",
    "@type": "LocalBusiness",
    name: "ANTASUS Infra",
    image: "https://www.antasus.de/images/antasus-logo2.svg",
    "@id": "https://www.antasus.de/#organization",
    url: "https://www.antasus.de",
    telephone: "+49 202 42988411",
    email: "info@antasus.de",
    address: {
        "@type": "PostalAddress",
        streetAddress: "Norrenbergstraße 122",
        postalCode: "42289",
        addressLocality: "Wuppertal",
        addressCountry: "DE",
    },
    description:
        "ANTASUS Infra ist Ihr zuverlässiger Subunternehmer für Glasfaser-Tiefbau, Hausanschlüsse und Projektabwicklung nach DIN/VDE.",
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

// 2) Alle Services als JSON-LD im Graph (jedes Service-Objekt als eigenes Service-Element)
const servicesLd = {
    "@context": "https://schema.org",
    "@graph": props.services.map((s) => ({
        "@type": "Service",
        name: s.title,
        description: s.description,
        provider: {
            "@type": "LocalBusiness",
            name: "ANTASUS Infra",
            url: "https://www.antasus.de",
        },
        areaServed: {
            "@type": "GeoCircle",
            geoMidpoint: {
                "@type": "GeoCoordinates",
                latitude: 51.2562,
                longitude: 7.1508,
            },
            geoRadius: 150,
        },
        url: `https://www.antasus.de/leistungen/${s.slug}`,
    })),
};

// 3) FAQPage (mit allen Fragen)
const faqPageLd = {
    "@context": "https://schema.org",
    "@type": "FAQPage",
    mainEntity: faqs.map((f) => ({
        "@type": "Question",
        name: f.frage,
        acceptedAnswer: {
            "@type": "Answer",
            text: f.antwort,
        },
    })),
};

// 4) Metadaten (Titel/Description/OG/Canonical) – statisch oder ohne activeService-Abhängigkeit
const metaTitle = computed(() =>
    activeService.value
        ? `Leistung: ${currentService.value.title} | ANTASUS Infra`
        : "Glasfaser-Tiefbau & Hausanschlüsse | ANTASUS Infra"
);
const metaDescription = computed(() =>
    activeService.value
        ? currentService.value.description || ""
        : "ANTASUS Infra ist Ihr zuverlässiger Subunternehmer für Glasfaser-Tiefbau, Hausanschlüsse und Projektabwicklung nach DIN/VDE – termintreu, normkonform und partnerschaftlich."
);

// Einmalig im head injizieren
useHead({
    title: metaTitle,
    meta: [
        { name: "description", content: metaDescription.value },
        {
            name: "keywords",
            content:
                "Glasfaser Tiefbau, Hausanschlüsse, Subunternehmer, Generalunternehmen, DIN VDE, Glasfaserbau NRW, Partner Glasfaserprojekt",
        },
        { property: "og:title", content: metaTitle.value },
        { property: "og:description", content: metaDescription.value },
        {
            property: "og:image",
            content: "https://www.antasus.de/images/og-leistungen.webp",
        },
        { property: "og:url", content: "https://www.antasus.de/leistungen" },
        { property: "og:type", content: "website" },
    ],
    link: [{ rel: "canonical", href: "https://www.antasus.de/leistungen" }],
    script: [
        {
            type: "application/ld+json",
            children: JSON.stringify(localBusinessLd),
        },
        {
            type: "application/ld+json",
            children: JSON.stringify(servicesLd),
        },
        {
            type: "application/ld+json",
            children: JSON.stringify(faqPageLd),
        },
    ],
});

// Falls gewünscht, könnte man später bei activeService auch noch ein einzelnes Service-JSON-LD nachladen.
// Hier haben wir allerdings bereits alle Services in servicesLd eingebaut, so dass Google sofort alle erkennt.
</script>

<style scoped>
/* (Bereits vorhanden, keine Änderung nötig) */
</style>
