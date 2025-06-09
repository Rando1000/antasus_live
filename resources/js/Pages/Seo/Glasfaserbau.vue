<template>
    <Head>
        <title>Glasfaserbau: Der Komplett-Leitfaden | ANTASUS Infra</title>
        <meta
            name="description"
            content="Der umfassende Leitfaden zu Glasfaserbau: Planung, Tiefbau-verfahren, Hausanschluss, Messtechnik & Dokumentation – mit Best Practices & PDF-Download."
        />
        <link rel="canonical" href="https://www.antasus.de/glasfaserbau" />
    </Head>

    <GuestLayout :serviceArea="'dienstleistungen'">
        <!-- Breadcrumb -->
        <nav class="px-4 py-2 text-sm text-gray-600">
            <Link href="/">Home</Link>
            <span class="mx-2">/</span>
            <span class="font-medium">Glasfaserbau</span>
        </nav>

        <!-- Hero -->
        <section
            class="py-20 text-center text-white bg-gradient-to-br from-teal-600 via-antasus-primary to-teal-800"
        >
            <h1 class="mb-4 text-5xl font-extrabold">
                Glasfaserbau: Der Komplett-Leitfaden
            </h1>
            <p class="max-w-3xl mx-auto text-lg">
                Alles von Netzplanung über Tiefbau-verfahren bis zu Mess- &
                Dokumentationsstandards – für Ingenieure & Planer.
            </p>
            <Link
                href="/kontakt"
                class="inline-block px-6 py-3 mt-8 font-semibold text-teal-700 bg-white rounded-lg hover:bg-gray-100"
            >
                Projektanfrage starten
            </Link>
        </section>

        <!-- 1. Netzplanung & Trassenkalkulation -->
        <section class="py-16 bg-white">
            <div class="max-w-4xl px-4 mx-auto">
                <h2 class="mb-4 text-3xl font-bold">
                    1. Netzplanung & Trassenkalkulation
                </h2>
                <p class="mb-6 text-gray-700">
                    Exakte Bedarfsanalyse und Simulationsmodelle sind der
                    Schlüssel:
                </p>
                <ul class="space-y-2 text-gray-700 list-disc list-inside">
                    <li>
                        <strong>CAD-gestützte Netzsimulation</strong> (AutoCAD,
                        MicroStation)
                    </li>
                    <li>
                        <strong>FTTx-Topologien</strong>: GPON vs. Active
                        Ethernet
                    </li>
                    <li>
                        <strong>Kostenprognose</strong> mit BOQ und „Material
                        Take-Off“
                    </li>
                </ul>
                <Link
                    href="/downloads/Netzplanung-FTTx-Checkliste.pdf"
                    target="_blank"
                    class="inline-block px-6 py-3 mt-6 text-white bg-teal-600 rounded-lg hover:bg-teal-700"
                >
                    Checkliste herunterladen
                </Link>
            </div>
        </section>

        <!-- 2. Tiefbau-Verfahren & Technologien -->
        <section class="py-16 bg-gray-50">
            <div class="max-w-4xl px-4 mx-auto">
                <h2 class="mb-4 text-3xl font-bold">
                    2. Tiefbau-Verfahren & Technologien
                </h2>
                <p class="mb-6 text-gray-700">
                    Wahl des optimalen Verfahrens je nach Geologie, Strecke &
                    Kosten:
                </p>
                <ul class="space-y-2 text-gray-700 list-disc list-inside">
                    <li>
                        <strong>Erdrakete / Horizontal-Ram</strong> für kurze
                        Distanzen
                    </li>
                    <li>
                        <strong>Spülbohrtechnik (HDD)</strong> für
                        Gewässer­querungen
                    </li>
                    <li>
                        <strong>Mikrotunneling</strong> für große Querschnitte &
                        lange Strecken
                    </li>
                    <li>
                        <strong>Offene Grabenbauweise</strong> gemäß DIN 18322 /
                        VDE 0100
                    </li>
                </ul>
                <Link
                    href="/leistungen/glasfaser-tiefbau"
                    class="inline-block px-6 py-3 mt-6 text-white rounded-lg bg-antasus-primary hover:bg-antasus-dark"
                >
                    Mehr über Tiefbau erfahren
                </Link>
            </div>
        </section>

        <!-- 3. Hausanschluss & Innenmontage -->
        <section class="py-16 bg-white">
            <div class="max-w-4xl px-4 mx-auto">
                <h2 class="mb-4 text-3xl font-bold">
                    3. Hausanschluss & Innenmontage
                </h2>
                <p class="mb-6 text-gray-700">
                    Von Hausübergabepunkt (HÜP) bis Patchfeld – normgerecht &
                    termingenau:
                </p>
                <ul class="space-y-2 text-gray-700 list-disc list-inside">
                    <li><strong>DIN 18015-5-konforme Installation</strong></li>
                    <li>
                        <strong>Faser­spleißung</strong> (Fusion-Splicer,
                        mechanisch)
                    </li>
                    <li><strong>OTDR-Messung</strong> & Dämpfungsprotokoll</li>
                    <li>
                        <strong>Übergabe­prüfung</strong> inkl.
                        Inbetriebnahme­bericht
                    </li>
                </ul>
                <Link
                    href="/leistungen/hausanschlusse"
                    class="inline-block px-6 py-3 mt-6 text-white rounded-lg bg-antasus-primary hover:bg-antasus-dark"
                >
                    Hausanschluss-Services
                </Link>
            </div>
        </section>

        <!-- 4. Messtechnik & Dokumentation -->
        <section class="py-16 bg-gray-50">
            <div class="max-w-4xl px-4 mx-auto">
                <h2 class="mb-4 text-3xl font-bold">
                    4. Messtechnik & Dokumentation
                </h2>
                <p class="mb-6 text-gray-700">
                    Lückenlose Protokollierung für Netzbetreiber & Audits:
                </p>
                <ul class="space-y-2 text-gray-700 list-disc list-inside">
                    <li>
                        <strong>OTDR-Sweep</strong> für LWL-Strecke & Dämpfung
                    </li>
                    <li>
                        <strong>Ein­fügungs­dämpfung (IL)</strong> &
                        Rückfluss­dämpfung (RL)
                    </li>
                    <li><strong>GIS-export</strong> (Shapefile, GeoJSON)</li>
                    <li>
                        Erstellung von
                        <strong>Netz­betriebs­handbüchern</strong>
                    </li>
                </ul>
                <Link
                    href="/kontakt"
                    class="inline-block px-6 py-3 mt-6 text-white bg-teal-600 rounded-lg hover:bg-teal-700"
                >
                    Dokumentation anfragen
                </Link>
            </div>
        </section>

        <!-- 5. Best Practices & Normen -->
        <section class="py-16 bg-white">
            <div class="max-w-4xl px-4 mx-auto">
                <h2 class="mb-4 text-3xl font-bold">
                    5. Best Practices & Normen
                </h2>
                <p class="mb-6 text-gray-700">
                    Unsere Checkliste für höchste Qualität und Sicherheit:
                </p>
                <ul class="space-y-2 text-gray-700 list-disc list-inside">
                    <li>
                        <strong>DIN EN 1610</strong> (Bau & Prüfung von
                        Leitungsbauwerken)
                    </li>
                    <li><strong>DIN VDE 0100</strong> (Elektroinstallation)</li>
                    <li><strong>DVGW G 459-2</strong> (HÜP-Montage)</li>
                    <li>
                        <strong>Qualitäts­kontrolle</strong> durch unabhängige
                        Gutachter
                    </li>
                </ul>
                <Link
                    href="/downloads/FTTx-Best-Practices.pdf"
                    target="_blank"
                    class="inline-block px-6 py-3 mt-6 text-white bg-teal-600 rounded-lg hover:bg-teal-700"
                >
                    Leitfaden downloaden
                </Link>
            </div>
        </section>

        <!-- FAQ Section -->
        <section class="py-16 bg-gray-50">
            <div class="max-w-4xl px-4 mx-auto">
                <h2 class="mb-6 text-3xl font-bold text-center">
                    Häufige Fragen
                </h2>
                <div v-for="(faq, i) in faqs" :key="i" class="mb-4">
                    <details class="p-4 border rounded-lg">
                        <summary class="font-semibold cursor-pointer">
                            {{ faq.question }}
                        </summary>
                        <p class="mt-2 text-gray-700">{{ faq.answer }}</p>
                    </details>
                </div>
            </div>
        </section>
    </GuestLayout>
</template>

<script setup>
import { Head, Link } from "@inertiajs/vue3";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import { ref } from "vue";

const faqs = ref([
    {
        question:
            "Wie tief ist der Graben, wenn eine Glasfaserleitung verlegt wird?",
        answer: "Beim traditionellen Glasfaserbau werden die Gräben in der Regel zwischen 60 und 125 cm tief angelegt. Die Breite richtet sich nach den jeweiligen Vorgaben und liegt für Mikrorohr-Gräben meist bei mindestens 30 cm. In bestimmten Situationen kann es jedoch notwendig sein, noch breitere Gräben auszuheben. In solchen Fällen greifen die Vorschriften der Zusätzlichen Technischen Vertragsbedingungen (ZTV). Der benötigte Arbeitsstreifen beim klassischen Tiefbau kann zudem über 2,5 Meter hinausgehen, da ausreichend Platz für Maschinen und Materialtransport erforderlich ist.",
    },
    {
        question: "Welche Trassenvarianten gibt es?",
        answer: "Die im August 2023 veröffentlichte DIN 18220 ist die zentrale Norm für moderne Verlegeverfahren wie Trenching-, Fräs- und Pflugverfahren. Sie definiert detailliert die Anforderungen an Planung, Ausführung, Mindestabstände, Dokumentation und die Wiederherstellung der Oberflächen. Die Norm stellt sicher, dass diese alternativen Methoden rechtssicher und nach einheitlichen Standards durchgeführt werden. Für Gräben mit einer Breite ab 30 cm kommen zudem die Zusätzlichen Technischen Vertragsbedingungen (ZTV A1) zur Anwendung, die weitere Vorgaben für Bauausführung und Qualitätssicherung enthalten.Neben der DIN 18220 und den ZTV sind auch die Vorgaben des Telekommunikationsgesetzes (§ 126 TKG) zu beachten. Dieses schreibt vor, dass Telekommunikationslinien nach den anerkannten Regeln der Technik zu errichten und zu betreiben sind",
    },
    {
        question: "Wie lange dauert ein FTTH Glasfaser Hausanschluss?",
        answer: "Die DIN 18220 legt klare Anforderungen an Planung, Bauausführung und Dokumentation fest und trägt dazu bei, Genehmigungsprozesse zu beschleunigen und die Bauzeit vor Ort zu verkürzen.In der Praxis kann der eigentliche Anschluss eines Hauses, also die Herstellung der Verbindung vom öffentlichen Netz bis in das Gebäude, oft innerhalb eines Tages erfolgen, sofern alle Vorarbeiten (wie Planung, Abstimmung mit Leitungsbetreibern und Genehmigungen) abgeschlossen sind. Die Norm sorgt dafür, dass die Prozesse standardisiert und effizient ablaufen, was zu einer insgesamt schnelleren Versorgung führt.",
    },
    {
        question: "Wer übernimmt die Dokumentation?",
        answer: "Im Rahmen geförderter Ausbauprojekte ist die Gebietskörperschaft als Erstzuwendungsempfängerin in der Pflicht, die vollständige Dokumentation für den Verwendungsnachweis einzureichen. Im sogenannten Wirtschaftlichkeitslückenmodell wird diese Aufgabe in der Regel per Vertrag auf das ausbauende Telekommunikationsunternehmen übertragen. Im Betreibermodell verbleibt die Verantwortung für die ordnungsgemäße Dokumentation hingegen meist beim Bauherrn und Eigentümer der passiven Infrastruktur. In beiden Fällen ist es üblich, dass die ausführenden Unternehmen, also die Bau- und Telekommunikationsfirmen, die technische Dokumentation (wie Netzpläne, Fotodokumentationen, Messprotokolle) erstellen und an die zuständige Stelle weitergeben.",
    },
]);
</script>

<style scoped>
details > summary {
    list-style: none;
}
details > summary::marker {
    content: "";
}
</style>
