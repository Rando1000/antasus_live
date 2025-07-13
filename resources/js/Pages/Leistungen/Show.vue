<template>
    <Head>
        <title>{{ service.title }} | ANTASUS Infra</title>
        <meta name="description" :content="service.description" />
    </Head>

    <!-- 1️⃣ Breadcrumb Navigation -->
    <nav
        class="px-4 py-2 text-sm text-antasus-dark dark:text-antasus-neutral"
        aria-label="Breadcrumb"
    >
        <ol
            class="flex items-center space-x-2"
            itemscope
            itemtype="https://schema.org/BreadcrumbList"
        >
            <li
                itemprop="itemListElement"
                itemscope
                itemtype="https://schema.org/ListItem"
            >
                <Link href="/" title="Startseite" itemprop="item">
                    <span itemprop="name">Home</span>
                </Link>
                <meta itemprop="position" content="1" />
            </li>
            <li><span class="mx-2">/</span></li>
            <li
                itemprop="itemListElement"
                itemscope
                itemtype="https://schema.org/ListItem"
            >
                <Link href="/glasfaserbau" title="Glasfaserbau" itemprop="item">
                    <span itemprop="name">Glasfaserbau</span>
                </Link>
                <meta itemprop="position" content="2" />
            </li>
            <li><span class="mx-2">/</span></li>
            <li
                itemprop="itemListElement"
                itemscope
                itemtype="https://schema.org/ListItem"
            >
                <span class="font-medium" itemprop="name">{{
                    service.title
                }}</span>
                <meta itemprop="position" content="3" />
            </li>
        </ol>
    </nav>

    <GuestLayout :serviceArea="'dienstleistungen'">
        <!-- Header -->
        <section
            class="w-full px-4 text-center bg-gradient-to-br from-antasus-primary via-antasus-second to-antasus-dark backdrop-blur-md"
            aria-label="Service Header"
        >
            <div
                class="max-w-4xl py-10 mx-auto text-antasus-black dark:text-antasus-neutral"
            >
                <h1
                    class="mb-4 text-4xl font-extrabold md:text-5xl drop-shadow-lg"
                >
                    {{ service.title }}
                </h1>
                <p
                    class="text-lg md:text-xl text-antasus-black/90 dark:text-antasus-neutral/90 drop-shadow-sm"
                >
                    {{ service.description }}
                </p>
            </div>
        </section>

        <!-- Service-Expertise-Section -->
        <section
            class="py-12 bg-antasus-neutral dark:bg-antasus-dark"
            aria-labelledby="leistungen-expertise-headline"
        >
            <h2
                id="leistungen-expertise-headline"
                class="max-w-3xl p-4 mx-auto mt-10 mb-10 text-antasus-black dark:text-antasus-neutral rounded-2xl border-y-4 border-antasus-primary dark:border-antasus-primary"
            >
                <strong>{{ service.title }}</strong> - Wir begleiten Sie von der
                präzisen Planung über die fachgerechte Umsetzung bis zur
                vollständigen Dokumentation Ihrer Glasfaserprojekte und jeden
                <strong>Glasfaser Hausanschluss</strong>.<br />
                Unsere Prozesse sind auf DIN EN 1610 und DIN 18015-5 abgestimmt
                - für FTTx-Anschlüsse, POPs und Infrastrukturen in Wohn- und
                Gewerbeimmobilien.
            </h2>
            <div class="max-w-6xl px-4 mx-auto">
                <div class="grid gap-8 md:grid-cols-2">
                    <div
                        v-for="item in service.items"
                        :key="item.id"
                        @click="showModal(item)"
                        class="overflow-hidden transition border shadow cursor-pointer border-antasus-neutral dark:border-antasus-dark-border rounded-2xl hover:shadow-lg bg-antasus-bg dark:bg-antasus-dark-card focus-within:ring-2 focus-within:ring-antasus-primary"
                        tabindex="0"
                        @keyup.enter="showModal(item)"
                        aria-label="Details anzeigen"
                    >
                        <img
                            v-if="item.image_url"
                            :src="item.image_url"
                            :alt="`${
                                item.title
                            } – ANTASUS Infra: ${item.description.substring(
                                0,
                                40
                            )}...`"
                            loading="lazy"
                            decoding="async"
                            fetchpriority="low"
                            class="object-cover w-full h-48"
                        />
                        <div class="p-5">
                            <h3
                                class="mb-2 text-xl font-bold text-antasus-black dark:text-antasus-neutral"
                            >
                                {{ item.title }}
                            </h3>
                            <p
                                class="text-antasus-dark/80 dark:text-antasus-neutral/80 line-clamp-3"
                            >
                                {{ item.description }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA: Hauptangebot -->
        <section
            class="py-10 text-center bg-antasus-neutral dark:bg-antasus-dark"
            aria-label="Projektanfrage CTA"
        >
            <Link
                href="/glasfaserbau#ueberblick"
                class="inline-block px-6 py-3 font-semibold transition rounded-2xl bg-antasus-primary text-antasus-black hover:bg-antasus-second focus:outline-none focus-visible:ring-4 focus-visible:ring-antasus-primary/70 focus-visible:ring-offset-2"
                aria-label="Mehr zum Glasfaserbau – Angebot anfragen"
            >
                Mehr zum Glasfaserbau &rarr; Angebot anfragen
            </Link>
        </section>

        <!-- LSI/Erklärungstext -->
        <section
            class="py-10 bg-antasus-bg dark:bg-antasus-dark-card"
            aria-labelledby="technik-lsi-headline"
        >
            <div
                class="max-w-3xl p-4 mx-auto mb-12 text-antasus-black dark:text-antasus-neutral rounded-2xl"
            >
                <h2
                    id="technik-lsi-headline"
                    class="mb-4 text-xl font-semibold"
                >
                    Technik & Prozesse – Worauf ANTASUS Infra Wert legt:
                </h2>
                <p
                    class="mt-4 text-base md:text-lg text-antasus-dark dark:text-antasus-neutral/80"
                >
                    Unsere Teams verlegen ausschließlich
                    <strong>DIN EN 50618-zertifizierte Leerrohre</strong> und
                    setzen moderne <strong>Pipes &amp; Conduits</strong> für
                    dauerhafte Beständigkeit ein. Dank
                    <em>GPS-gestützter Trassenvermessung</em> sind alle Arbeiten
                    lückenlos dokumentiert.<br />
                    Jedes Projekt erhält eine vollständige
                    <strong>Fertigstellungsdokumentation</strong> inklusive
                    <strong>Abschlussprüfprotokoll</strong> und
                    <strong>FTTx-Netz-Abnahme</strong> für einen reibungslosen
                    Start Ihres Netzbetriebs.
                </p>
            </div>
        </section>

        <!-- CTA: Technologien -->
        <section
            class="pb-12 text-center bg-antasus-bg dark:bg-antasus-dark-card"
            aria-label="Technologien-CTA"
        >
            <Link
                href="/ratgeber/technologien"
                class="inline-block px-6 py-3 font-semibold transition rounded-2xl bg-antasus-indigo text-antasus-neutral hover:bg-antasus-primary focus:outline-none focus-visible:ring-4 focus-visible:ring-antasus-primary/70 focus-visible:ring-offset-2"
                aria-label="Technologien im Glasfaserbau entdecken"
            >
                Technologien im Glasfaserbau entdecken
            </Link>
        </section>

        <!-- FAQ – 100% SEO, AI, Barrierefreiheit -->
        <section
            class="py-16 border-t border-antasus-neutral dark:border-antasus-dark-border bg-antasus-neutral dark:bg-antasus-dark"
            aria-labelledby="faq-headline"
        >
            <div class="max-w-4xl px-4 mx-auto">
                <h2
                    id="faq-headline"
                    class="mb-10 text-3xl font-extrabold text-center text-antasus-black dark:text-antasus-neutral"
                >
                    Häufige Fragen zum Glasfaseranschluss
                </h2>
                <ul class="space-y-4">
                    <li v-for="(faq, idx) in faqs" :key="idx">
                        <details
                            class="p-4 border rounded-2xl group bg-antasus-bg dark:bg-antasus-dark-card border-antasus-neutral dark:border-antasus-dark-border focus-within:ring-2 focus-within:ring-antasus-primary"
                        >
                            <summary
                                class="text-lg font-semibold rounded cursor-pointer text-antasus-black dark:text-antasus-neutral focus:outline-none focus-visible:ring-2 focus-visible:ring-antasus-primary"
                                :aria-expanded="false"
                                tabindex="0"
                                @keyup.enter="$event.target.click()"
                                @keyup.space="$event.target.click()"
                            >
                                {{ faq.frage }}
                            </summary>
                            <div
                                class="mt-2 leading-relaxed text-antasus-dark/80 dark:text-antasus-neutral"
                            >
                                {{ faq.antwort }}
                            </div>
                        </details>
                    </li>
                </ul>
            </div>
        </section>

        <!-- Interne Verlinkung: Weitere Leistungen -->
        <section
            class="py-8 bg-antasus-neutral dark:bg-antasus-dark"
            aria-labelledby="related-services-headline"
        >
            <div class="max-w-4xl px-4 mx-auto">
                <h2
                    id="related-services-headline"
                    class="mb-4 text-2xl font-semibold text-center text-antasus-black dark:text-antasus-neutral"
                >
                    Weitere Glasfaser-Leistungen von ANTASUS
                </h2>
                <div class="flex flex-wrap justify-center gap-4">
                    <Link
                        v-for="other in relatedItems"
                        :key="other.id"
                        :href="`/leistungen/${service.slug}/item/${other.id}`"
                        class="px-4 py-2 font-semibold rounded-2xl bg-antasus-primary text-antasus-black hover:bg-antasus-second focus:outline-none focus-visible:ring-2 focus-visible:ring-antasus-primary"
                        :title="`Details zu ${other.title}`"
                    >
                        {{ other.title }}
                    </Link>
                </div>
            </div>
        </section>

        <!-- MODAL (Accessibility, SEO, AI Mode) -->
        <Transition name="fade-slide">
            <div
                v-if="selectedItem"
                class="fixed inset-0 z-50 flex items-center justify-center bg-antasus-black/60 backdrop-blur-sm"
                @click.self="closeModal"
                aria-modal="true"
                role="dialog"
            >
                <div
                    class="relative w-full max-w-2xl mx-4 bg-antasus-bg dark:bg-antasus-dark-card rounded-2xl shadow-xl animate-fade-in-up flex flex-col max-h-[90vh]"
                >
                    <!-- Schließen -->
                    <button
                        @click="closeModal"
                        class="absolute rounded-full text-antasus-dark dark:text-antasus-neutral top-3 right-3 hover:text-antasus-primary focus:outline-none focus-visible:ring-2 focus-visible:ring-antasus-primary"
                        aria-label="Schließen"
                    >
                        &times;
                    </button>
                    <div class="p-6">
                        <h2
                            class="mb-4 text-2xl font-bold text-antasus-black dark:text-antasus-neutral"
                        >
                            {{ selectedItem.title }}
                        </h2>
                        <img
                            v-if="selectedItem.image_url"
                            :src="selectedItem.image_url"
                            :alt="`${selectedItem.title} – Detailansicht, ANTASUS Infra`"
                            class="object-cover w-full h-64 mb-4 rounded-2xl"
                        />
                    </div>
                    <div
                        class="px-6 overflow-y-auto text-antasus-dark dark:text-antasus-neutral whitespace-pre-line max-h-[40vh]"
                    >
                        {{ selectedItem.description }}
                    </div>
                    <div
                        class="p-6 mt-auto border-t border-antasus-neutral dark:border-antasus-dark-border bg-antasus-neutral dark:bg-antasus-dark-card rounded-b-2xl"
                    >
                        <div
                            class="flex flex-col items-start justify-between gap-4 md:flex-row md:items-center"
                        >
                            <Link
                                :href="`/leistungen/${props.service.slug}/item/${selectedItem.id}`"
                                class="text-sm font-semibold text-antasus-indigo hover:underline focus-visible:outline-2 focus-visible:outline-antasus-primary"
                                aria-label="Vollständige Projektbeschreibung ansehen"
                            >
                                Vollständige Projektbeschreibung ansehen →
                            </Link>
                            <Link
                                href="/kontakt"
                                class="inline-block px-6 py-3 font-semibold shadow rounded-2xl bg-antasus-primary text-antasus-black hover:bg-antasus-second focus:outline-none focus-visible:ring-4 focus-visible:ring-antasus-primary/60 focus-visible:ring-offset-2"
                                aria-label="Projekt anfragen"
                            >
                                Projekt anfragen
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </Transition>

        <!-- CTA Footer – Kontakt/Trust -->
        <section
            class="py-16 text-center text-antasus-neutral bg-gradient-to-r from-antasus-primary to-antasus-dark"
            aria-label="Projekt-Kontakt CTA"
        >
            <h3 class="mb-4 text-2xl font-bold">
                Bereit für Ihr Glasfaserprojekt? Lassen Sie sich beraten!
            </h3>
            <Link
                href="/glasfaserbau#kontakt"
                class="inline-block px-8 py-4 font-semibold transition rounded-2xl bg-antasus-dark-neutral text-antasus-neutral dark:text-antasus-primary hover:opacity-90 focus:outline-none focus-visible:ring-2 focus-visible:ring-antasus-primary"
                aria-label="Jetzt kostenlos anfragen"
            >
                Jetzt kostenlos anfragen
            </Link>
            <p class="mt-4 text-base opacity-70">
                ANTASUS Infra GmbH &ndash; Ihr zertifizierter Partner für
                Glasfaser-Infrastruktur, Hausanschluss und
                Netzbetreiber-Projekte in NRW.
            </p>
        </section>
    </GuestLayout>
</template>

<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import { Head, Link, usePage, router } from "@inertiajs/vue3";
import { ref, onMounted, onUnmounted, computed } from "vue";

const props = defineProps({
    service: Object,
});

const selectedItem = ref(null);
const page = usePage();

function showModal(item) {
    selectedItem.value = item;
    router.push({
        replace: false,
        preserveScroll: true,
        preserveState: true,
        url: `/leistungen/${props.service.slug}/item/${item.slug}`,
    });
}

function closeModal() {
    selectedItem.value = null;
    router.replace({
        replace: true,
        preserveState: true,
        url: `/leistungen/${props.service.slug}`,
    });
}

function handleEscape(event) {
    if (event.key === "Escape" && selectedItem.value) {
        closeModal();
    }
}

onMounted(() => {
    document.addEventListener("keydown", handleEscape);

    // Modal-Logik, falls per URL geöffnet
    const segments = page.url.split("/");
    const itemId =
        segments.includes("item") &&
        segments.length > segments.indexOf("item") + 1
            ? segments[segments.indexOf("item") + 1]
            : null;
    if (itemId) {
        const item = props.service.items.find(
            (i) => i.id.toString() === itemId || i.slug === itemId
        );
        if (item) {
            selectedItem.value = item;
        }
    }

    // BreadcrumbList JSON-LD ins <head>
    const breadcrumbJsonLd = {
        "@context": "https://schema.org",
        "@type": "BreadcrumbList",
        itemListElement: [
            {
                "@type": "ListItem",
                position: 1,
                name: "Home",
                item: "https://www.antasus.de/",
            },
            {
                "@type": "ListItem",
                position: 2,
                name: "Glasfaserbau",
                item: "https://www.antasus.de/glasfaserbau",
            },
            {
                "@type": "ListItem",
                position: 3,
                name: props.service.title,
                item: `https://www.antasus.de/leistungen/${props.service.slug}`,
            },
        ],
    };
    const breadcrumbTag = document.createElement("script");
    breadcrumbTag.type = "application/ld+json";
    breadcrumbTag.text = JSON.stringify(breadcrumbJsonLd, null, 2);
    document.head.appendChild(breadcrumbTag);

    // Service + HowTo JSON-LD
    const serviceTag = document.createElement("script");
    serviceTag.type = "application/ld+json";
    serviceTag.text = JSON.stringify(servicesJsonLd.value, null, 2);
    document.head.appendChild(serviceTag);

    const howToTag = document.createElement("script");
    howToTag.type = "application/ld+json";
    howToTag.text = JSON.stringify(howToJsonLd.value, null, 2);
    document.head.appendChild(howToTag);
});

onUnmounted(() => {
    document.removeEventListener("keydown", handleEscape);
});

const servicesJsonLd = computed(() => ({
    "@context": "https://schema.org",
    "@type": "Service",
    "@id": `https://www.antasus.de/leistungen/${props.service.slug}#service`,
    name: props.service.title,
    description: props.service.description,
    serviceType: "Glasfaserinstallation",
    provider: {
        "@type": "Organization",
        name: "ANTASUS Infra",
        url: "https://www.antasus.de",
        address: {
            "@type": "PostalAddress",
            streetAddress: "Norrenbergstraße 122",
            addressLocality: "Wuppertal",
            postalCode: "42289",
            addressCountry: "DE",
        },
        contactPoint: {
            "@type": "ContactPoint",
            telephone: "+49 176 24757616",
            contactType: "customer service",
        },
    },
    areaServed: {
        "@type": "Country",
        name: "Deutschland",
    },
    image:
        props.service.image_url ||
        "https://www.antasus.de/images/services/standard.jpg",
    hasOfferCatalog: {
        "@type": "OfferCatalog",
        name: "Leistungspakete von " + props.service.title,
        itemListElement: props.service.items.map((item, index) => ({
            "@type": "ListItem",
            position: index + 1,
            item: {
                "@type": "Service",
                name: item.title,
                description: item.description,
                image: item.image_url,
                serviceType: "Glasfaserinstallation",
                url: `https://www.antasus.de/leistungen/${props.service.slug}/item/${item.id}#item`,
            },
        })),
    },
}));

const faqs = [
    {
        frage: "Wie schnell kann mein Haus angeschlossen werden?",
        antwort:
            "In der Regel erfolgt der Anschluss innerhalb von 2 bis 4 Wochen nach Beauftragung – inklusive aller Tiefbau- und Einblasarbeiten. Je nach Auslastung und örtlichen Vorgaben kann die Dauer variieren.",
    },
    {
        frage: "Ist ein Glasfaseranschluss auch im Altbau möglich?",
        antwort:
            "Ja! Unsere Teams sind spezialisiert auf die Nachrüstung in bestehenden Gebäuden und passen die Installation an die baulichen Gegebenheiten vor Ort an.",
    },
    {
        frage: "Welche Normen und Standards setzt ANTASUS Infra um?",
        antwort:
            "Wir arbeiten nach allen einschlägigen DIN- und EN-Normen, insbesondere DIN EN 1610, DIN 18015-5 und DIN EN 50173. So ist Ihr Netz zukunftssicher und betreiberkonform.",
    },
    {
        frage: "Erhalte ich eine Dokumentation für meine Installation?",
        antwort:
            "Selbstverständlich! Sie erhalten eine vollständige Abschlussdokumentation inklusive Messprotokoll, Plänen und Abnahmebestätigung für Ihren Glasfaseranschluss.",
    },
];
const faqJsonLd = computed(() => ({
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
}));
onMounted(() => {
    // ... deine bisherigen JSON-LDs ...
    const faqTag = document.createElement("script");
    faqTag.type = "application/ld+json";
    faqTag.text = JSON.stringify(faqJsonLd.value, null, 2);
    document.head.appendChild(faqTag);
});

const howToJsonLd = computed(() => ({
    "@context": "https://schema.org",
    "@type": "HowTo",
    name: `Anleitung: ${props.service.title}`,
    description: props.service.description,
    totalTime: "P1DT2H",
    supply: [
        { "@type": "HowToSupply", name: "Leerrohr" },
        { "@type": "HowToSupply", name: "Glasfaserkabel" },
    ],
    tool: [
        { "@type": "HowToTool", name: "Spaten" },
        { "@type": "HowToTool", name: "Einblasgerät" },
    ],
    step: [
        {
            "@type": "HowToStep",
            url: "https://www.antasus.de/leistungen/hausanschluss#step1",
            name: "Planung & Vermessung",
            text: "Wir prüfen die Trassenführung und holen Genehmigungen ein.",
            image: "https://www.antasus.de/images/hausanschluss-planung.jpg",
            position: 1,
        },
        {
            "@type": "HowToStep",
            url: "https://www.antasus.de/leistungen/hausanschluss#step2",
            name: "Graben und Leerrohr verlegen",
            text: "Das Leerrohr wird DIN-konform entlang der Trasse verlegt.",
            position: 2,
        },
        {
            "@type": "HowToStep",
            url: "https://www.antasus.de/leistungen/hausanschluss#step3",
            name: "Kabel einblasen",
            text: "Mittels Hochdrucktechnik wird das Glasfaserkabel eingezogen.",
            position: 3,
        },
        {
            "@type": "HowToStep",
            url: "https://www.antasus.de/leistungen/hausanschluss#step4",
            name: "Anschluss und Test",
            text: "Der Switch wird angeschlossen und mit einem OTDR getestet.",
            position: 4,
        },
    ],
}));

const relatedItems = computed(() =>
    props.service.items.filter((item) => item.id !== selectedItem.value?.id)
);
</script>

<style scoped>
.fade-slide-enter-active,
.fade-slide-leave-active {
    transition: all 0.3s ease;
}
.fade-slide-enter-from,
.fade-slide-leave-to {
    opacity: 0;
    transform: translateY(20px);
}
.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
