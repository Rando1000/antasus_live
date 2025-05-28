<template>
    <Head>
        <title>
            Glasfaser-Tiefbau & Hausanschlüsse | Subunternehmer für
            Generalunternehmen
        </title>
        <meta
            name="description"
            content="ANTASUS Infra ist Ihr zuverlässiger Subunternehmer für Glasfaser-Tiefbau, Hausanschlüsse und Projektabwicklung nach DIN/VDE – termintreu, normkonform und partnerschaftlich."
        />
        <meta
            name="keywords"
            content="Glasfaser Tiefbau, Hausanschlüsse, Subunternehmer, Generalunternehmen, DIN VDE, Glasfaserbau NRW, Partner Glasfaserprojekt"
        />

        <!-- Open Graph -->
        <meta
            property="og:title"
            content="Ihr Glasfaser-Partner für Tiefbau & Hausanschlüsse – ANTASUS Infra"
        />
        <meta
            property="og:description"
            content="Subunternehmer für Generalunternehmen: Planung, Bau & Dokumentation von Glasfaser-Infrastruktur."
        />
        <meta
            property="og:image"
            content="https://www.antasus.de/images/og-leistungen.webp"
        />
        <meta property="og:url" content="https://www.antasus.de/leistungen" />
        <meta property="og:type" content="website" />
    </Head>
    <GuestLayout :serviceArea="'dienstleistungen'">
        <!-- Intro -->
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
        <!-- Leistungen Grid -->
        <ArticleCard :services="services" @select="selectService" />

        <!-- Service Items -->
        <section
            v-if="activeService"
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
                <div class="grid gap-8 md:grid-cols-2">
                    <ServiceItemCard
                        v-for="item in services.find(
                            (s) => s.id === activeService
                        )?.items || []"
                        :key="item.id"
                        :item="item"
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

        <!-- Call to Action -->
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
import { onMounted, ref } from "vue";

defineProps({
    services: Array,
});
const activeService = ref(null); // Zustand
const selectService = (service) => {
    activeService.value = service.id;
};

const structuredData = {
    "@context": "https://schema.org",
    "@type": "Service",
    serviceType:
        "Projektmangement für Glasfaserprojekte, Glasfaser-Tiefbau & Hausanschlüsse",
    provider: {
        "@type": "LocalBusiness",
        name: "ANTASUS Infra",
        url: "https://www.antasus.de",
        telephone: "+49 176 24757616",
        address: {
            "@type": "PostalAddress",
            streetAddress: "Norrenbergstraße 122",
            addressLocality: "Wuppertal",
            postalCode: "42289",
            addressCountry: "DE",
        },
    },
    areaServed: {
        "@type": "Place",
        name: "Deutschland",
    },
    description:
        "Komplettlösungen im Glasfaserausbau: Hausanschlüsse, Tiefbau, Projektplanung & technische Dokumentation – nach DIN- & VDE-Vorgaben.",
    hasOfferCatalog: {
        "@type": "OfferCatalog",
        name: "Leistungen",
        itemListElement: [
            {
                "@type": "Offer",
                itemOffered: {
                    "@type": "Service",
                    name: "Hausanschlüsse",
                    description:
                        "Trasse, Bohrung & Innenmontage mit deutscher Präzision",
                },
            },
            {
                "@type": "Offer",
                itemOffered: {
                    "@type": "Service",
                    name: "Tiefbau & Leerrohrverlegung",
                    description:
                        "Normkonforme Tiefbauleistungen nach DIN & VDE",
                },
            },
            {
                "@type": "Offer",
                itemOffered: {
                    "@type": "Service",
                    name: "Projektberatung & Planung",
                    description:
                        "Technische Konzeption & Beratung für Generalunternehmen",
                },
            },
        ],
    },
};

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
            "Ja – unsere Leistungen erfüllen die aktuellen Normen und Richtlinien (z. B. DIN 18322, VDE 0100), dokumentiert nach Vorgaben der Netzbetreiber.",
    },
    {
        frage: "Wer ist Ansprechpartner während der Umsetzung?",
        antwort:
            "Ein deutschsprachiger Bauleiter oder technischer Ansprechpartner ist während der gesamten Umsetzung für Sie erreichbar – telefonisch oder vor Ort.",
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
    const script = document.createElement("script");
    script.type = "application/ld+json";
    script.text = JSON.stringify(structuredData);
    document.head.appendChild(script);

    const faqScript = document.createElement("script");
    faqScript.type = "application/ld+json";
    faqScript.text = JSON.stringify(structuredDataFAQ);
    document.head.appendChild(faqScript);
});
</script>
