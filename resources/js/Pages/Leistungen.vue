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

    <GuestLayout :serviceArea="'dienstleistungen'">
        <template #header>
            <section
                class="w-full px-4 text-center animate-fade-in"
                role="banner"
                aria-label="Leistungen Header"
            >
                <div class="max-w-4xl mx-auto">
                    <h1
                        class="mb-6 text-4xl font-extrabold text-white sr-only md:text-5xl drop-shadow-xl"
                    >
                        Glasfaser-Leistungen von Antasus Infra
                    </h1>
                    <h2
                        class="mb-6 text-4xl font-extrabold text-white md:text-5xl drop-shadow-xl"
                    >
                        Unsere Glasfaser-Leistungen
                        <span
                            class="block w-full h-1 mt-1 rounded bg-antasus-primary/70"
                            aria-hidden="true"
                        ></span>
                    </h2>
                    <p
                        class="mb-8 text-lg md:text-xl text-white/90 drop-shadow-md"
                    >
                        Wir bieten <strong>Glasfaser-Tiefbau</strong>,
                        <strong>Hausanschluss</strong> &amp;
                        <strong>Projektplanung</strong> nach DIN/VDE -
                        termintreu, zuverlässig und partnerschaftlich.
                    </p>
                    <Link
                        href="/kontakt"
                        class="inline-block px-6 py-3 font-semibold transition shadow rounded-2xl bg-antasus-primary text-antasus-black hover:bg-antasus-second focus:outline-none focus-visible:ring-4 focus-visible:ring-antasus-primary/70 focus-visible:ring-offset-2"
                        aria-label="Projekt anfragen"
                    >
                        Projekt anfragen
                    </Link>
                </div>
            </section>
        </template>

        <main
            class="w-full bg-antasus-neutral dark:bg-antasus-dark rounded-b-2xl"
            tabindex="-1"
        >
            <section class="pt-12 text-antasus-black dark:text-antasus-neutral">
                <div class="max-w-4xl px-6 mx-auto">
                    <p class="text-lg text-center">
                        ANTASUS Infra realisiert professionelle
                        <strong>Glasfaser Hausanschlüsse</strong> und
                        <strong>Glasfaser Tiefbauprojekte</strong> gemäß DIN
                        18220 und DIN EN 50173 in NRW. Von der Planung über
                        <em>GIS-Dokumentation</em> bis zur Inbetriebnahme.
                    </p>
                </div>
            </section>

            <section aria-labelledby="leistungen-ueberblick">
                <h2
                    id="leistungen-ueberblick"
                    class="pt-20 pb-10 text-4xl font-extrabold text-center underline place-self-center text-antasus-black dark:text-antasus-primary"
                >
                    Unsere Leistungen im Überblick
                </h2>
                <ArticleCard :services="services" @select="selectService" />
            </section>

            <section
                class="p-6 mt-12 text-center rounded-2xl bg-antasus-primary/10 dark:bg-antasus-dark-card"
                aria-label="Weitere Informationen"
            >
                <p
                    class="mb-4 font-medium text-antasus-black dark:text-antasus-neutral"
                >
                    Sie möchten tiefer ins Thema Glasfaser eintauchen?
                </p>
                <Link
                    href="/ratgeber/glasfaser"
                    class="px-5 py-2 font-semibold rounded-2xl bg-antasus-primary text-antasus-black hover:bg-antasus-second focus:outline-none focus-visible:ring-4 focus-visible:ring-antasus-primary/60 focus-visible:ring-offset-2"
                    aria-label="Zum Glasfaser Ratgeber & Wissen"
                >
                    Zum Ratgeber & Wissen
                </Link>
            </section>

            <!-- FAQ – 100% CI/CD + A11y -->
            <section
                class="py-16 border-t border-antasus-neutral dark:border-antasus-dark-border bg-antasus-neutral dark:bg-antasus-dark"
                aria-labelledby="faq-headline"
            >
                <div class="max-w-4xl px-4 mx-auto">
                    <h2
                        id="faq-headline"
                        class="mb-10 text-3xl font-extrabold text-center text-antasus-black dark:text-antasus-neutral"
                    >
                        Häufige Fragen
                    </h2>
                    <ul class="space-y-4">
                        <li v-for="(faq, index) in faqs" :key="index">
                            <details
                                class="p-4 border rounded-2xl group bg-antasus-bg dark:bg-antasus-dark-card border-antasus-neutral dark:border-antasus-dark-border focus-within:ring-2 focus-within:ring-antasus-primary"
                                :open="index === 0"
                            >
                                <summary
                                    class="text-lg font-semibold rounded cursor-pointer text-antasus-black dark:text-antasus-neutral focus:outline-none focus-visible:ring-2 focus-visible:ring-antasus-primary"
                                    :aria-expanded="
                                        index === 0 ? 'true' : 'false'
                                    "
                                    tabindex="0"
                                    @keyup.enter="$event.target.click()"
                                    @keyup.space="$event.target.click()"
                                >
                                    {{ faq.frage }}
                                </summary>
                                <div
                                    class="mt-2 leading-relaxed text-antasus-black/80 dark:text-antasus-neutral"
                                >
                                    {{ faq.antwort }}
                                </div>
                            </details>
                        </li>
                    </ul>
                </div>
            </section>

            <section class="py-20 bg-antasus-neutral dark:bg-antasus-dark">
                <div class="max-w-4xl px-4 mx-auto text-center">
                    <h2
                        class="mb-4 text-2xl font-bold text-antasus-black dark:text-antasus-neutral"
                    >
                        WIR sind bereit für Ihre Projekte!
                    </h2>
                    <Link
                        href="/kontakt"
                        class="inline-block px-6 py-3 mt-4 font-semibold rounded-2xl bg-antasus-primary text-antasus-black hover:bg-antasus-second focus:outline-none focus-visible:ring-4 focus-visible:ring-antasus-primary/70 focus-visible:ring-offset-2"
                        aria-label="Jetzt Kontakt aufnehmen"
                    >
                        Jetzt Kontakt aufnehmen
                    </Link>
                </div>
            </section>
        </main>
    </GuestLayout>
</template>

<script setup>
import ArticleCard from "@/Components/ArticleCard_Slug.vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
import { onMounted, ref, computed } from "vue";

const props = defineProps({
    services: Array,
    metaTitle: {
        type: String,
        default: "Unsere Glasfaser-Leistungen - Antasus Infra",
    },
    metaDescription: {
        type: String,
        default:
            "Erfahren Sie alles über Glasfaser-Tiefbau, Hausanschlüsse und Projektplanung von Antasus Infra. Professionell, termintreu.",
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
        "Ihr Subunternehmer für Glasfaser-Tiefbau, Hausanschlüsse und technische Projektabwicklung nach DIN/VDE - partnerschaftlich & termintreu.",
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
        "https://www.xing.com/pages/antasus",
    ],
};

onMounted(() => {
    const script = document.createElement("script");
    script.type = "application/ld+json";
    script.text = JSON.stringify(jsonLd);
    document.head.appendChild(script);
});

// FAQ
const faqs = [
    {
        frage: "Was kostet ein Glasfaser Hausanschluss mit Antasus?",
        antwort:
            "Die Kosten hängen von Lage, Länge der Trasse und Technik ab. Für Generalunternehmen kalkulieren wir individuell. Privatkunden erhalten ein Festpreisangebot nach Vor-Ort-Besichtigung.",
    },
    {
        frage: "Wie lange dauert ein Tiefbauprojekt?",
        antwort:
            "Die Dauer variiert je nach Umfang. Kleinere Projekte (1-2 Hausanschlüsse) sind in 2-4 Tagen abgeschlossen. Großprojekte werden termingerecht nach Bauzeitenplan umgesetzt.",
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
    "@graph": props.services.map((service) => ({
        "@type": "Service",
        "@id": `https://www.antasus.de/leistungen`,
        name: service.title,
        description: service.description,
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
        },
        url: `https://www.antasus.de/leistungen`,
    })),
}));

// 2) Baue das <script>-Tag aus dem JSON-LD-Objekt zusammen
const jsonLdScriptTag = `<script type="application/ld+json">
${JSON.stringify(servicesJsonLd.value, null, 2)}`;

onMounted(() => {
    const tag = document.createElement("script");
    tag.type = "application/ld+json";
    tag.text = JSON.stringify(servicesJsonLd.value, null, 2);
    document.head.appendChild(tag);
});
</script>
