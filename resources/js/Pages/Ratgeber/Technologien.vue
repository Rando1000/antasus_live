<template>
    <Head>
        <title>{{ metaTitle }}</title>
        <meta name="description" :content="metaDescription" />
        <link rel="canonical" href="https://www.antasus.de/technologien" />
    </Head>

    <GuestLayout :serviceArea="'dienstleistungen'">
        <!-- Breadcrumb -->
        <nav class="px-4 py-2 text-sm text-gray-600">
            <Link href="/">Home</Link>
            <span class="mx-2">/</span>
            <Link href="/glasfaserbau">Glasfaserbau</Link>
            <span class="mx-2">/</span>
            <span class="font-medium">Technologien</span>
        </nav>

        <!-- Hero -->
        <section
            class="py-16 text-center text-white bg-gradient-to-br from-antasus-primary to-teal-600"
        >
            <h1 class="mb-4 text-4xl font-extrabold">
                High-End-Verfahren im Glasfaserausbau
            </h1>
            <p class="max-w-2xl mx-auto">
                Von Erdrakete & Spülbohrtechnik bis Mikrotunneling – modernste
                Verfahren für Hausanschluss & Tiefbau.
            </p>
        </section>

        <!-- 1. Erdrakete (Earth-Pushing) -->
        <section class="py-16 bg-white">
            <div class="max-w-4xl px-4 mx-auto">
                <h2 class="mb-4 text-3xl font-bold">
                    1. Erdrakete & Horizontal-Ram-Boring
                </h2>
                <p class="mb-6 text-gray-700">
                    Die Erdrakete (auch Horizontal-Ram-Boring) ist ideal für
                    enge, kurze Trassen unter Gehwegen und Einfahrten:
                </p>
                <ul class="space-y-2 text-gray-700 list-disc list-inside">
                    <li>
                        <strong>Vibrationsfreies Einrammen</strong> dank
                        pneumatischer Kolbeneinheit
                    </li>
                    <li>
                        <strong>Ø 40–120 mm Leerrohre</strong> in einem Zug bis
                        10 m Länge
                    </li>
                    <li>
                        <strong>Geeignet für Asphalt & Pflaster</strong> – keine
                        großen Aufgrabungen
                    </li>
                    <li>
                        <strong>Rückverpressung</strong> verhindert Setzungen im
                        Untergrund
                    </li>
                </ul>
                <Link
                    href="/kontakt"
                    class="inline-block px-6 py-3 mt-6 text-white rounded-lg bg-antasus-primary hover:bg-antasus-dark"
                >
                    Erdrakete anfragen
                </Link>
            </div>
        </section>

        <!-- 2. Spülbohrtechnik (HDD) -->
        <section class="py-16 bg-gray-50">
            <div class="max-w-4xl px-4 mx-auto">
                <h2 class="mb-4 text-3xl font-bold">
                    2. Spülbohrtechnik (Horizontal Directional Drilling)
                </h2>
                <p class="mb-6 text-gray-700">
                    HDD ermöglicht grabenloses Verlegen unter Straßen, Gewässern
                    und Gleisanlagen:
                </p>
                <ul class="space-y-2 text-gray-700 list-disc list-inside">
                    <li>
                        <strong>Zielgesteuerte Pilotbohrung</strong> mit 90 %
                        Trennleistung
                    </li>
                    <li>
                        <strong>Ø bis 300 mm</strong> und Bohrlängen bis 200 m
                    </li>
                    <li>
                        <strong>Spülmedium</strong>: Bentonit­Schlämme für
                        Kühlschmier- und Stützfunktion
                    </li>
                    <li>
                        <strong>Reaming & Pull-Back</strong> für sichere,
                        spannungsfreie Kabelverlegung
                    </li>
                </ul>
                <Link
                    href="/kontakt"
                    class="inline-block px-6 py-3 mt-6 text-white rounded-lg bg-antasus-primary hover:bg-antasus-dark"
                >
                    HDD-Verfahren anfragen
                </Link>
            </div>
        </section>

        <!-- 3. Mikrotunneling & Micro-Tunneling -->
        <section class="py-16 bg-white">
            <div class="max-w-4xl px-4 mx-auto">
                <h2 class="mb-4 text-3xl font-bold">3. Mikrotunneling</h2>
                <p class="mb-6 text-gray-700">
                    Für große Querschnitte und lange Distanzen setzen wir auf
                    gesteuertes Mikrotunneling:
                </p>
                <ul class="space-y-2 text-gray-700 list-disc list-inside">
                    <li>
                        <strong>Shield-vortrieb</strong> mit hydraulisch
                        gesteuertem Schild
                    </li>
                    <li>
                        <strong>NT-Tunnelrohre ⌀ 600–1500 mm</strong> für
                        Multikabel-Trassen
                    </li>
                    <li>
                        <strong>Hydraulische Grabendrainage</strong> und
                        Rückführung des Aushubs
                    </li>
                    <li>
                        <strong>Schlag- & Schneidwerkzeuge</strong> für Fels-
                        und bindige Böden
                    </li>
                </ul>
                <Link
                    href="/kontakt"
                    class="inline-block px-6 py-3 mt-6 text-white rounded-lg bg-antasus-primary hover:bg-antasus-dark"
                >
                    Mikrotunneling anfragen
                </Link>
            </div>
        </section>

        <!-- 4. GPS-Vermessung & GIS-Dokumentation -->
        <section class="py-16 bg-gray-50">
            <div class="max-w-4xl px-4 mx-auto">
                <h2 class="mb-4 text-3xl font-bold">
                    4. GPS-Vermessung & GIS-Dokumentation
                </h2>
                <p class="mb-6 text-gray-700">
                    Vollautomatische Erfassung aller Trassenpunkte und
                    Schachtstandorte:
                </p>
                <ul class="space-y-2 text-gray-700 list-disc list-inside">
                    <li>
                        <strong>RTK-GNSS</strong> für Zentimeter-Genauigkeit
                    </li>
                    <li>
                        Export in <strong>Shapefile, GeoJSON & PDF-Plan</strong>
                    </li>
                    <li>
                        <strong>Cloud-basiertes GIS</strong> für Live-Monitoring
                    </li>
                    <li>
                        <strong>Integrationsschnittstellen</strong> zu Stadt-
                        und Versorgungsnetzen
                    </li>
                </ul>
                <Link
                    href="/kontakt"
                    class="inline-block px-6 py-3 mt-6 text-white rounded-lg bg-antasus-primary hover:bg-antasus-dark"
                >
                    Vermessung anfragen
                </Link>
            </div>
        </section>

        <!-- 5. PDF-Leitfaden zum Download -->
        <section class="py-16 text-center bg-white">
            <div class="max-w-3xl px-4 mx-auto">
                <h2 class="mb-4 text-2xl font-bold">Gratis PDF-Leitfaden</h2>
                <p class="mb-6 text-gray-700">
                    Detaillierte Technik-Charts & Best Practices zum Thema
                    FTTx-Trassenaufbau.
                </p>
                <a
                    href="/downloads/FTTx-Technologie-Leitfaden.pdf"
                    target="_blank"
                    class="px-6 py-3 text-white bg-teal-600 rounded-lg hover:bg-teal-700"
                >
                    Jetzt PDF herunterladen
                </a>
            </div>
            <section class="pt-8 mt-16 border-t">
                <h3 class="mb-4 text-xl font-semibold">Weitere Ratgeber</h3>
                <ul class="space-y-2">
                    <li>
                        <Link
                            href="/ratgeber/how-to-get-ftth"
                            class="text-antasus-primary hover:underline"
                        >
                            Wie bekomme ich meinen Glasfaser Hausanschluss
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

const props = defineProps({
    metaTitle: String,
    metaDescription: String,
});
</script>

<style scoped>
.list-disc li {
    margin-bottom: 0.5rem;
}
</style>
