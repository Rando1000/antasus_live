<template>
    <Head>
        <title>{{ metaTitle }}</title>
        <meta name="description" :content="metaDescription" />
        <link rel="canonical" href="https://www.antasus.de/technologien" />
    </Head>

    <!-- Breadcrumb -->
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
                <Link href="/" itemprop="item" title="Home"
                    ><span itemprop="name">Home</span></Link
                >
                <meta itemprop="position" content="1" />
            </li>
            <li><span class="mx-2">/</span></li>
            <li
                itemprop="itemListElement"
                itemscope
                itemtype="https://schema.org/ListItem"
            >
                <Link href="/glasfaserbau" itemprop="item" title="Glasfaserbau"
                    ><span itemprop="name">Glasfaserbau</span></Link
                >
                <meta itemprop="position" content="2" />
            </li>
            <li><span class="mx-2">/</span></li>
            <li
                itemprop="itemListElement"
                itemscope
                itemtype="https://schema.org/ListItem"
            >
                <span class="font-medium" itemprop="name">Technologien</span>
                <meta itemprop="position" content="3" />
            </li>
        </ol>
    </nav>

    <GuestLayout :serviceArea="'dienstleistungen'">
        <!-- HERO -->
        <section
            aria-labelledby="technologien-hero-headline"
            class="py-16 text-center text-antasus-neutral bg-gradient-to-br from-antasus-primary to-antasus-second"
        >
            <h1
                id="technologien-hero-headline"
                class="mb-4 text-4xl font-extrabold"
            >
                High-End-Verfahren im Glasfaserausbau
            </h1>
            <p class="max-w-2xl mx-auto">
                Von Erdrakete & Spülbohrtechnik bis Mikrotunneling - modernste
                Verfahren für Hausanschluss & Tiefbau. Profitieren Sie von
                sicheren, schnellen und nachhaltigen Technologien.
            </p>
        </section>

        <!-- 1. Erdrakete -->
        <section
            aria-labelledby="erdrakete-headline"
            class="py-16 bg-antasus-bg dark:bg-antasus-dark-card"
        >
            <div class="max-w-4xl px-4 mx-auto">
                <h2
                    id="erdrakete-headline"
                    class="mb-4 text-3xl font-bold text-antasus-black dark:text-antasus-neutral"
                >
                    1. Erdrakete & Horizontal-Ram-Boring
                </h2>
                <p class="mb-6 text-antasus-dark dark:text-antasus-neutral/90">
                    Die Erdrakete (auch Horizontal-Ram-Boring) ist das
                    bevorzugte Verfahren für enge, kurze Trassen unter Gehwegen
                    oder Zufahrten - schnell, erschütterungsarm und ohne offene
                    Gräben.
                </p>
                <ul
                    class="space-y-2 list-disc list-inside text-antasus-dark dark:text-antasus-neutral"
                >
                    <li>
                        <strong>Vibrationsfreies Einrammen</strong> dank
                        pneumatischer Kolbeneinheit
                    </li>
                    <li>
                        <strong>Ø 40-120 mm Leerrohre</strong> in einem Zug bis
                        10 m Länge
                    </li>
                    <li>
                        <strong>Geeignet für Asphalt & Pflaster</strong> - keine
                        großen Aufgrabungen
                    </li>
                    <li>
                        <strong>Rückverpressung</strong> verhindert Setzungen im
                        Untergrund
                    </li>
                </ul>
                <Link
                    href="/kontakt"
                    class="inline-block px-6 py-3 mt-6 text-antasus-bg rounded-2xl bg-antasus-primary hover:bg-antasus-dark focus:outline-none focus-visible:ring-2 focus-visible:ring-antasus-primary"
                    aria-label="Erdrakete anfragen"
                >
                    Erdrakete anfragen
                </Link>
            </div>
        </section>

        <!-- 2. Spülbohrtechnik (HDD) -->
        <section
            aria-labelledby="hdd-headline"
            class="py-16 bg-antasus-neutral dark:bg-antasus-dark"
        >
            <div class="max-w-4xl px-4 mx-auto">
                <h2
                    id="hdd-headline"
                    class="mb-4 text-3xl font-bold text-antasus-black dark:text-antasus-neutral"
                >
                    2. Spülbohrtechnik (Horizontal Directional Drilling)
                </h2>
                <p class="mb-6 text-antasus-dark dark:text-antasus-neutral/90">
                    HDD ermöglicht das grabenlose Verlegen von Leitungen unter
                    Straßen, Flüssen oder Bahnstrecken - ideal für
                    anspruchsvolle Infrastrukturprojekte mit hohen Sicherheits-
                    und Umweltstandards.
                </p>
                <ul
                    class="space-y-2 list-disc list-inside text-antasus-dark dark:text-antasus-neutral"
                >
                    <li>
                        <strong>Zielgesteuerte Pilotbohrung</strong> mit über
                        90% Präzision
                    </li>
                    <li>
                        <strong>Leerrohre bis Ø 300 mm</strong> und Bohrlängen
                        bis 200 m
                    </li>
                    <li>
                        <strong>Bentonit-Spülung</strong> sorgt für stabile
                        Bohrungen und optimale Kabelverlegung
                    </li>
                    <li>
                        <strong>Reaming & Pull-Back</strong> für spannungsfreie
                        Einziehung selbst in schwierigen Böden
                    </li>
                </ul>
                <Link
                    href="/kontakt"
                    class="inline-block px-6 py-3 mt-6 text-antasus-bg rounded-2xl bg-antasus-primary hover:bg-antasus-dark focus:outline-none focus-visible:ring-2 focus-visible:ring-antasus-primary"
                    aria-label="HDD-Verfahren anfragen"
                >
                    HDD-Verfahren anfragen
                </Link>
            </div>
        </section>

        <!-- 3. Mikrotunneling -->
        <section
            aria-labelledby="mikrotunneling-headline"
            class="py-16 bg-antasus-bg dark:bg-antasus-dark-card"
        >
            <div class="max-w-4xl px-4 mx-auto">
                <h2
                    id="mikrotunneling-headline"
                    class="mb-4 text-3xl font-bold text-antasus-black dark:text-antasus-neutral"
                >
                    3. Mikrotunneling
                </h2>
                <p class="mb-6 text-antasus-dark dark:text-antasus-neutral/90">
                    Für große Querschnitte und lange Distanzen setzen wir auf
                    Mikrotunneling - gesteuerte Tunnelvortriebe mit höchster
                    Genauigkeit und minimaler Oberflächenbelastung.
                </p>
                <ul
                    class="space-y-2 list-disc list-inside text-antasus-dark dark:text-antasus-neutral"
                >
                    <li>
                        <strong>Hydraulischer Schildvortrieb</strong> für
                        präzise Tunnelprofile
                    </li>
                    <li>
                        <strong>NT-Tunnelrohre ⌀ 600-1500 mm</strong> für
                        Multikabel-Trassen
                    </li>
                    <li>
                        <strong>Grabendrainage & Rückführung</strong> des
                        Aushubs
                    </li>
                    <li>
                        <strong>Schlag- & Schneidwerkzeuge</strong> für jeden
                        Bodentyp
                    </li>
                </ul>
                <Link
                    href="/kontakt"
                    class="inline-block px-6 py-3 mt-6 text-antasus-bg rounded-2xl bg-antasus-primary hover:bg-antasus-dark focus:outline-none focus-visible:ring-2 focus-visible:ring-antasus-primary"
                    aria-label="Mikrotunneling anfragen"
                >
                    Mikrotunneling anfragen
                </Link>
            </div>
        </section>

        <!-- 4. GPS-Vermessung & GIS-Dokumentation -->
        <section
            aria-labelledby="gps-gis-headline"
            class="py-16 bg-antasus-neutral dark:bg-antasus-dark"
        >
            <div class="max-w-4xl px-4 mx-auto">
                <h2
                    id="gps-gis-headline"
                    class="mb-4 text-3xl font-bold text-antasus-black dark:text-antasus-neutral"
                >
                    4. GPS-Vermessung & GIS-Dokumentation
                </h2>
                <p class="mb-6 text-antasus-dark dark:text-antasus-neutral/90">
                    Alle Trassenpunkte und Schachtstandorte werden
                    vollautomatisch und millimetergenau erfasst. So profitieren
                    Sie von lückenloser Dokumentation, Rechtssicherheit und
                    einfacher Wartung.
                </p>
                <ul
                    class="space-y-2 list-disc list-inside text-antasus-dark dark:text-antasus-neutral"
                >
                    <li>
                        <strong>RTK-GNSS</strong> für Zentimeter-Genauigkeit
                    </li>
                    <li>
                        Export in <strong>Shapefile, GeoJSON & PDF-Plan</strong>
                    </li>
                    <li>
                        <strong>Cloud-GIS</strong> für Live-Monitoring &
                        Echtzeit-Freigaben
                    </li>
                    <li>
                        <strong>API-Schnittstellen</strong> zu Stadt- und
                        Versorgungsnetzen
                    </li>
                </ul>
                <Link
                    href="/kontakt"
                    class="inline-block px-6 py-3 mt-6 text-antasus-bg rounded-2xl bg-antasus-primary hover:bg-antasus-dark focus:outline-none focus-visible:ring-2 focus-visible:ring-antasus-primary"
                    aria-label="Vermessung anfragen"
                >
                    Vermessung anfragen
                </Link>
            </div>
        </section>

        <!-- PDF-Leitfaden -->
        <section
            aria-labelledby="pdf-headline"
            class="py-16 text-center bg-antasus-bg dark:bg-antasus-dark-card"
        >
            <div class="max-w-3xl px-4 mx-auto">
                <h2
                    id="pdf-headline"
                    class="mb-4 text-2xl font-bold text-antasus-black dark:text-antasus-neutral"
                >
                    Gratis PDF-Leitfaden
                </h2>
                <p class="mb-6 text-antasus-dark dark:text-antasus-neutral">
                    Technik-Charts & Best Practices zum FTTx-Trassenaufbau.
                    Laden Sie sich den exklusiven Leitfaden kostenfrei herunter.
                </p>
                <a
                    href="/downloads/FTTx-Technologie-Leitfaden.pdf"
                    target="_blank"
                    class="px-6 py-3 text-antasus-bg bg-antasus-primary rounded-2xl hover:bg-antasus-second focus:outline-none focus-visible:ring-2 focus-visible:ring-antasus-primary"
                    title="PDF-Leitfaden Glasfaser-Technologie herunterladen"
                    aria-label="PDF-Leitfaden Glasfaser-Technologie herunterladen"
                >
                    Jetzt PDF herunterladen
                </a>
            </div>
            <!-- Weitere Ratgeber -->
            <section
                class="pt-8 mt-16 border-t border-antasus-neutral dark:border-antasus-dark-border"
            >
                <h3
                    class="mb-4 text-xl font-semibold text-antasus-black dark:text-antasus-neutral"
                >
                    Weitere Ratgeber & Wissensseiten
                </h3>
                <ul class="space-y-2">
                    <li>
                        <Link
                            href="/ratgeber/how-to-get-ftth"
                            class="text-antasus-primary hover:underline"
                        >
                            Wie bekomme ich meinen Glasfaser Hausanschluss?
                        </Link>
                    </li>
                    <li>
                        <Link
                            href="/ratgeber/ftth-fiber-to-the-home"
                            class="text-antasus-primary hover:underline"
                        >
                            FTTH - Glasfaser bis ins Haus: Technik & Förderung
                        </Link>
                    </li>
                    <li>
                        <Link
                            href="/glasfaserbau"
                            class="text-antasus-primary hover:underline"
                        >
                            Glasfaserbau: Tiefbau & Infrastruktur
                        </Link>
                    </li>
                    <li>
                        <Link
                            href="/ratgeber/dsl-vs-glasfaser"
                            class="text-antasus-primary hover:underline"
                        >
                            DSL vs. Glasfaser: Speed, Stabilität & Kosten
                        </Link>
                    </li>
                    <li>
                        <Link
                            href="/ratgeber/glasfaser"
                            class="text-antasus-primary hover:underline"
                        >
                            Technik, Vorteile & Varianten
                        </Link>
                    </li>
                </ul>
            </section>
        </section>
    </GuestLayout>
</template>

<script setup>
import { Head, Link } from "@inertiajs/vue3";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import { onMounted } from "vue";

// BreadcrumbList JSON-LD
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
            name: "Technologien",
            item: "https://www.antasus.de/technologien",
        },
    ],
};

// Article JSON-LD (SGE/AI)
const articleJsonLd = {
    "@context": "https://schema.org",
    "@type": "Article",
    headline:
        "High-End-Verfahren im Glasfaserausbau - Technologien von ANTASUS",
    description:
        "Modernste Glasfaser-Technologien: Erdrakete, Spülbohrung, Mikrotunneling und GPS-Vermessung. Technik- und Best-Practice-Leitfaden für Tiefbau und Hausanschluss.",
    author: { "@type": "Organization", name: "ANTASUS Infra" },
    publisher: { "@type": "Organization", name: "ANTASUS Infra" },
    url: "https://www.antasus.de/technologien",
    mainEntityOfPage: "https://www.antasus.de/technologien",
    datePublished: "2024-01-01",
    dateModified: "2025-07-13",
    image: "https://www.antasus.de/images/og-technologien.webp",
    hasPart: [
        {
            "@type": "TechArticle",
            name: "Erdrakete",
            url: "https://www.antasus.de/technologien#erdrakete-headline",
        },
        {
            "@type": "TechArticle",
            name: "Spülbohrtechnik",
            url: "https://www.antasus.de/technologien#hdd-headline",
        },
        {
            "@type": "TechArticle",
            name: "Mikrotunneling",
            url: "https://www.antasus.de/technologien#mikrotunneling-headline",
        },
        {
            "@type": "TechArticle",
            name: "GPS-Vermessung",
            url: "https://www.antasus.de/technologien#gps-gis-headline",
        },
    ],
};

const props = defineProps({
    metaTitle: String,
    metaDescription: String,
});

onMounted(() => {
    // Breadcrumb
    const breadcrumbTag = document.createElement("script");
    breadcrumbTag.type = "application/ld+json";
    breadcrumbTag.text = JSON.stringify(breadcrumbJsonLd, null, 2);
    document.head.appendChild(breadcrumbTag);

    // Article
    const articleTag = document.createElement("script");
    articleTag.type = "application/ld+json";
    articleTag.text = JSON.stringify(articleJsonLd, null, 2);
    document.head.appendChild(articleTag);
});
</script>

<style scoped>
.list-disc li {
    margin-bottom: 0.5rem;
}
</style>
