<template>
    <Head>
        <title>{{ service.title }} | ANTASUS Infra</title>
        <meta name="description" :content="service.description" />
        <link
            rel="canonical"
            :href="`https://www.antasus.de/leistungen/${service.slug}`"
        />
    </Head>

    <!-- JSON-LD-Script für Service-Schema -->
    <div v-if="servicesJsonLd" v-html="jsonLdScriptTag" />

    <GuestLayout :serviceArea="'dienstleistungen'">
        <!-- Header -->
        <section
            class="w-full px-4 text-center bg-gradient-to-br from-antasus-primary via-teal-600 to-antasus-dark/90 backdrop-blur-md"
        >
            <div class="max-w-4xl py-10 mx-auto text-white">
                <h1
                    class="mb-4 text-4xl font-extrabold md:text-5xl drop-shadow-lg"
                >
                    {{ service.title }}
                </h1>
                <p class="text-lg md:text-xl text-white/90 drop-shadow-sm">
                    {{ service.description }}
                </p>
                <p class="max-w-2xl mx-auto mb-12 text-white">
                    Unsere Expertise für
                    <strong>{{ service.title }}</strong> umfasst die komplette
                    Planung, Umsetzung und Dokumentation von
                    <em>FTTx-Anschlüssen</em> &amp; <em>POPs</em> gemäß DIN EN
                    1610 und DIN 18015-5. Egal ob
                    <strong>Glasfaser Hausanschluss</strong> in Neubauten oder
                    <strong>Glasfaser-Netzbau</strong> in Gewerbegebieten. Wir
                    garantieren termingerechte Projektabwicklung,
                    georeferenzierte Kartierung und normgerechte Abschlusstests.
                </p>
            </div>
        </section>

        <!-- Items Grid -->
        <section class="py-12 bg-white">
            <h2
                class="max-w-3xl p-4 mx-auto mb-12 text-black rounded-lg border-y-4 md:grid-cols-1"
            >
                Unsere Expertise für
                <strong>{{ service.title }}</strong> umfasst die komplette
                Planung, Umsetzung und Dokumentation von
                <em>FTTx Anschlüssen</em> &amp; <em>POPs</em> gemäß DIN EN 1610
                und DIN 18015-5. Egal ob
                <strong>Hausanschluss Glasfaser</strong> in Neubauten oder
                <strong>Glasfaserausbau</strong> in Gewerbegebieten, wir
                garantieren termingerechte Projektabwicklung, georeferenzierte
                Kartierung und normgerechte Abschlusstests.
            </h2>
            <div class="max-w-6xl px-4 mx-auto">
                <div class="grid gap-8 md:grid-cols-2">
                    <div
                        v-for="item in service.items"
                        :key="item.id"
                        @click="showModal(item)"
                        class="overflow-hidden transition border border-gray-200 shadow cursor-pointer rounded-xl hover:shadow-lg"
                    >
                        <img
                            v-if="item.image_url"
                            :src="item.image_url"
                            :alt="`${item.title} – ANTASUS Infra`"
                            loading="lazy"
                            decoding="async"
                            fetchpriority="low"
                            class="object-cover w-full h-48"
                        />
                        <div class="p-5">
                            <h3 class="mb-2 text-xl font-bold text-gray-900">
                                {{ item.title }}
                            </h3>
                            <p class="text-gray-600 line-clamp-3">
                                {{ item.description }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Semantische Nachbarn (LSI) → hier erweitert um einen weiteren Satz -->
        <section class="py-12 bg-white">
            <div
                class="max-w-3xl p-4 mx-auto mb-12 text-black rounded-lg md:grid-cols-1"
            >
                <p class="mt-4 text-gray-600">
                    Unsere Teams verlegen
                    <strong>DIN EN 50618-zertifizierte Leerrohre</strong> und
                    setzen modernste <strong>Pipes &amp; Conduits</strong> ein.
                    Von der <em>GPS-gestützten Trassenvermessung</em> bis zur
                    <em>Fertigstellungsdokumentation im PDF-Format.</em> Wir
                    kennen jeden Schritt der
                    <strong>Glasfaser-Installation</strong> im Detail.
                    Zusätzlich sorgen wir für eine lückenlose Übergabe inklusive
                    <strong>Abschlussprüfprotokoll</strong> und
                    <strong>FTTx-Netz-Abnahme</strong>, damit Ihr Netzbetrieb
                    sofort starten kann!
                </p>
            </div>
        </section>

        <!-- Interne Verlinkung stärken: → “Weitere verwandte Leistungen” -->
        <section class="py-8 bg-gray-50">
            <div class="max-w-4xl px-4 mx-auto">
                <h2
                    class="mb-4 text-2xl font-semibold text-center text-gray-900"
                >
                    Weitere verwandte Leistungen
                </h2>
                <div class="flex flex-wrap justify-center gap-4">
                    <!-- Loop über alle Service-Items außer dem aktuellen -->
                    <Link
                        v-for="other in relatedItems"
                        :key="other.id"
                        :href="`/leistungen/${service.slug}/item/${other.id}`"
                        class="px-4 py-2 text-white transition bg-teal-600 rounded-lg hover:bg-teal-700"
                    >
                        {{ other.title }}
                    </Link>
                </div>
            </div>
        </section>

        <!-- Modal -->
        <Transition name="fade-slide">
            <div
                v-if="selectedItem"
                class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm"
                @click.self="closeModal"
            >
                <div
                    class="relative w-full max-w-2xl mx-4 bg-white rounded-lg shadow-xl animate-fade-in-up flex flex-col max-h-[90vh]"
                >
                    <!-- Schließen -->
                    <button
                        @click="closeModal"
                        class="absolute text-gray-400 top-3 right-3 hover:text-gray-600"
                        aria-label="Schließen"
                    >
                        &times;
                    </button>

                    <!-- Titel & Bild -->
                    <div class="p-6">
                        <h2 class="mb-4 text-2xl font-bold text-gray-900">
                            {{ selectedItem.title }}
                        </h2>

                        <img
                            v-if="selectedItem.image_url"
                            :src="selectedItem.image_url"
                            :alt="selectedItem.title"
                            class="object-cover w-full h-64 mb-4 rounded"
                        />
                    </div>

                    <!-- Scrollbarer Textbereich -->
                    <div
                        class="px-6 overflow-y-auto text-gray-700 whitespace-pre-line max-h-[40vh]"
                    >
                        {{ selectedItem.description }}
                    </div>

                    <!-- Aktionen unten -->
                    <div class="p-6 mt-auto border-t bg-gray-50">
                        <div
                            class="flex flex-col items-start justify-between gap-4 md:flex-row md:items-center"
                        >
                            <Link
                                :href="`/leistungen/${props.service.slug}/item/${selectedItem.id}`"
                                class="text-sm font-semibold text-teal-700 hover:underline"
                            >
                                Vollständige Projektbeschreibung ansehen →
                            </Link>
                            <Link
                                href="/kontakt"
                                class="inline-block px-6 py-3 text-white rounded shadow bg-antasus-primary hover:bg-antasus-dark"
                            >
                                Projekt anfragen
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </Transition>
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
        url: `/leistungen/${props.service.slug}/item/${item.id}`,
    });
}

function closeModal() {
    selectedItem.value = null;
    router.push({
        replace: false,
        preserveScroll: true,
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
            (i) => i.id.toString() === itemId
        );
        if (item) {
            selectedItem.value = item;
        }
    }
});

onUnmounted(() => {
    document.removeEventListener("keydown", handleEscape);
});

// JSON-LD für diesen Service (inkl. OfferCatalog)
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

// Fügt das JSON-LD ins <head> ein
const jsonLdScriptTag = `<script type="application/ld+json">
${JSON.stringify(servicesJsonLd.value, null, 2)}
/>`;

onMounted(() => {
    const tag = document.createElement("script");
    tag.type = "application/ld+json";
    tag.text = JSON.stringify(servicesJsonLd.value, null, 2);
    document.head.appendChild(tag);
});

// ### Interne Verlinkung: Liste der “Verwandten” Items (alle außer das aktuelle Detail)
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
