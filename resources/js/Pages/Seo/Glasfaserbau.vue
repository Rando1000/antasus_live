<template>
    <Head>
        <title>Glasfaserbau: Der Komplett-Leitfaden | ANTASUS Infra</title>
        <meta
            name="description"
            content="Der umfassende Leitfaden zu Glasfaserbau: Planung, Tiefbauverfahren, Hausanschluss, Messtechnik & Dokumentation – mit Best Practices & PDF-Download."
        />
        <link rel="canonical" href="https://www.antasus.de/glasfaserbau" />
    </Head>

    <GuestLayout :serviceArea="'dienstleistungen'">
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
                    <span class="font-medium" itemprop="name"
                        >Glasfaserbau</span
                    >
                    <meta itemprop="position" content="2" />
                </li>
            </ol>
        </nav>

        <!-- Hero -->
        <section
            aria-labelledby="glasfaserbau-hero-headline"
            class="py-20 text-center text-antasus-neutral bg-gradient-to-br from-antasus-primary via-antasus-second to-antasus-dark"
        >
            <h1
                id="glasfaserbau-hero-headline"
                class="mb-4 text-5xl font-extrabold tracking-tight drop-shadow-xl"
            >
                Glasfaserbau: Der Komplett-Leitfaden
            </h1>
            <p class="max-w-3xl mx-auto text-lg">
                Alles von Netzplanung über Tiefbauverfahren bis zu Mess- &amp;
                Dokumentationsstandards - für Ingenieure, Bauträger & Planer.
                <span class="block mt-2 font-medium"
                    >Mit Checklisten, Praxis-Tipps und kostenlosem
                    PDF-Download.</span
                >
            </p>
            <Link
                href="/kontakt"
                class="inline-block px-6 py-3 mt-8 font-semibold rounded-2xl text-antasus-primary bg-antasus-bg hover:bg-antasus-neutral focus:outline-none focus-visible:ring-2 focus-visible:ring-antasus-primary"
                aria-label="Projektanfrage starten"
            >
                Projektanfrage starten
            </Link>
        </section>

        <!-- 1. Netzplanung & Trassenkalkulation -->
        <section
            aria-labelledby="netzplanung-headline"
            class="py-16 bg-antasus-bg dark:bg-antasus-dark-card"
        >
            <div class="max-w-4xl px-4 mx-auto">
                <h2
                    id="netzplanung-headline"
                    class="mb-4 text-3xl font-bold text-antasus-black dark:text-antasus-neutral"
                >
                    1. Netzplanung &amp; Trassenkalkulation
                </h2>
                <p class="mb-6 text-antasus-dark dark:text-antasus-neutral/90">
                    Präzise Bedarfsanalyse, Simulation und Kostenplanung sind
                    der Grundstein für jeden Glasfaserbau:
                </p>
                <ul
                    class="space-y-2 list-disc list-inside text-antasus-dark dark:text-antasus-neutral"
                >
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
                    class="inline-block px-6 py-3 mt-6 text-antasus-bg bg-antasus-primary rounded-2xl hover:bg-antasus-second focus:outline-none focus-visible:ring-2 focus-visible:ring-antasus-primary"
                >
                    Checkliste herunterladen
                </Link>
            </div>
        </section>

        <!-- 2. Tiefbau-Verfahren & Technologien -->
        <section
            aria-labelledby="tiefbau-headline"
            class="py-16 bg-antasus-neutral dark:bg-antasus-dark"
        >
            <div class="max-w-4xl px-4 mx-auto">
                <h2
                    id="tiefbau-headline"
                    class="mb-4 text-3xl font-bold text-antasus-black dark:text-antasus-neutral"
                >
                    2. Tiefbau-Verfahren &amp; Technologien
                </h2>
                <p class="mb-6 text-antasus-dark dark:text-antasus-neutral/90">
                    Welches Verfahren für Ihr Projekt? Unsere Übersicht:
                </p>
                <ul
                    class="space-y-2 list-disc list-inside text-antasus-dark dark:text-antasus-neutral"
                >
                    <li>
                        <strong>Erdrakete / Horizontal-Ram</strong> - schonend
                        für kurze Distanzen
                    </li>
                    <li>
                        <strong>Spülbohrtechnik (HDD)</strong> - ideal für
                        Unterquerungen von Straßen und Gewässern
                    </li>
                    <li>
                        <strong>Mikrotunneling</strong> - für lange Strecken und
                        große Durchmesser
                    </li>
                    <li>
                        <strong>Offene Grabenbauweise</strong> gemäß DIN 18322 /
                        VDE 0100
                    </li>
                </ul>
                <Link
                    href="/leistungen/glasfaser-tiefbau"
                    class="inline-block px-6 py-3 mt-6 text-antasus-bg bg-antasus-primary rounded-2xl hover:bg-antasus-second focus:outline-none focus-visible:ring-2 focus-visible:ring-antasus-primary"
                >
                    Mehr über Tiefbau erfahren
                </Link>
            </div>
        </section>

        <!-- 3. Hausanschluss & Innenmontage -->
        <section
            aria-labelledby="hausanschluss-headline"
            class="py-16 bg-antasus-bg dark:bg-antasus-dark-card"
        >
            <div class="max-w-4xl px-4 mx-auto">
                <h2
                    id="hausanschluss-headline"
                    class="mb-4 text-3xl font-bold text-antasus-black dark:text-antasus-neutral"
                >
                    3. Hausanschluss &amp; Innenmontage
                </h2>
                <p class="mb-6 text-antasus-dark dark:text-antasus-neutral/90">
                    Von der Hauseinführung bis zum Patchfeld - alles nach DIN
                    18015-5, mit dokumentierter Spleißtechnik:
                </p>
                <ul
                    class="space-y-2 list-disc list-inside text-antasus-dark dark:text-antasus-neutral"
                >
                    <li><strong>DIN 18015-5-konforme Installation</strong></li>
                    <li>
                        <strong>Faserspleißung</strong> (Fusion &amp;
                        mechanisch)
                    </li>
                    <li>
                        <strong>OTDR-Messung</strong> &amp; Dämpfungsprotokoll
                    </li>
                    <li>
                        <strong>Übergabeprüfung</strong> inkl.
                        Inbetriebnahmebericht
                    </li>
                </ul>
                <Link
                    href="/leistungen/hausanschlusse"
                    class="inline-block px-6 py-3 mt-6 text-antasus-bg bg-antasus-primary rounded-2xl hover:bg-antasus-second focus:outline-none focus-visible:ring-2 focus-visible:ring-antasus-primary"
                >
                    Hausanschluss-Services
                </Link>
            </div>
        </section>

        <!-- 4. Messtechnik & Dokumentation -->
        <section
            aria-labelledby="messtechnik-headline"
            class="py-16 bg-antasus-neutral dark:bg-antasus-dark"
        >
            <div class="max-w-4xl px-4 mx-auto">
                <h2
                    id="messtechnik-headline"
                    class="mb-4 text-3xl font-bold text-antasus-black dark:text-antasus-neutral"
                >
                    4. Messtechnik &amp; Dokumentation
                </h2>
                <p class="mb-6 text-antasus-dark dark:text-antasus-neutral/90">
                    Lückenlose Protokollierung für Netzbetreiber &amp; Audits -
                    von OTDR-Sweep bis GIS-Export.
                </p>
                <ul
                    class="space-y-2 list-disc list-inside text-antasus-dark dark:text-antasus-neutral"
                >
                    <li>
                        <strong>OTDR-Sweep</strong> für LWL-Strecke &amp;
                        Dämpfung
                    </li>
                    <li>
                        <strong>Einfügungsdämpfung (IL)</strong> &amp;
                        Rückflussdämpfung (RL)
                    </li>
                    <li><strong>GIS-Export</strong> (Shapefile, GeoJSON)</li>
                    <li>
                        Erstellung von <strong>Netzbetriebshandbüchern</strong>
                    </li>
                </ul>
                <Link
                    href="/kontakt"
                    class="inline-block px-6 py-3 mt-6 text-antasus-bg bg-antasus-primary rounded-2xl hover:bg-antasus-second focus:outline-none focus-visible:ring-2 focus-visible:ring-antasus-primary"
                >
                    Dokumentation anfragen
                </Link>
            </div>
        </section>

        <!-- 5. Best Practices & Normen -->
        <section
            aria-labelledby="normen-headline"
            class="py-16 bg-antasus-bg dark:bg-antasus-dark-border"
        >
            <div class="max-w-4xl px-4 mx-auto">
                <h2
                    id="normen-headline"
                    class="mb-4 text-3xl font-bold text-antasus-black dark:text-antasus-neutral"
                >
                    5. Best Practices &amp; Normen
                </h2>
                <p class="mb-6 text-antasus-dark dark:text-antasus-neutral/90">
                    Unsere Checkliste für höchste Qualität und Sicherheit im
                    Glasfaserbau:
                </p>
                <ul
                    class="space-y-2 list-disc list-inside text-antasus-dark dark:text-antasus-neutral"
                >
                    <li>
                        <strong>DIN EN 1610</strong> (Bau &amp; Prüfung von
                        Leitungsbauwerken)
                    </li>
                    <li><strong>DIN VDE 0100</strong> (Elektroinstallation)</li>
                    <li><strong>DVGW G 459-2</strong> (HÜP-Montage)</li>
                    <li>
                        <strong>Qualitätskontrolle</strong> durch unabhängige
                        Gutachter
                    </li>
                </ul>
                <Link
                    href="/downloads/FTTx-Best-Practices.pdf"
                    target="_blank"
                    class="inline-block px-6 py-3 mt-6 text-antasus-bg bg-antasus-primary rounded-2xl hover:bg-antasus-second focus:outline-none focus-visible:ring-2 focus-visible:ring-antasus-primary"
                >
                    Leitfaden downloaden
                </Link>
                <section
                    class="pt-8 mt-16 border-t border-antasus-neutral dark:border-antasus-dark-border"
                >
                    <h3
                        class="mb-4 text-xl font-semibold text-antasus-black dark:text-antasus-neutral"
                    >
                        Weitere Ratgeber &amp; Wissen
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
                                FTTH - Glasfaser bis ins Haus: Technik &amp;
                                Förderung
                            </Link>
                        </li>
                        <li>
                            <Link
                                href="/ratgeber/glasfaser"
                                class="text-antasus-primary hover:underline"
                            >
                                Technik, Vorteile &amp; Varianten
                            </Link>
                        </li>
                        <li>
                            <Link
                                href="/ratgeber/dsl-vs-glasfaser"
                                class="text-antasus-primary hover:underline"
                            >
                                DSL vs. Glasfaser: Speed, Stabilität &amp;
                                Kosten
                            </Link>
                        </li>
                        <li>
                            <Link
                                href="/ratgeber/technologien"
                                class="text-antasus-primary hover:underline"
                            >
                                Techniken und Technologien im FTTX
                            </Link>
                        </li>
                    </ul>
                </section>
            </div>
        </section>

        <!-- FAQ Section -->
        <section
            aria-labelledby="faq-headline"
            class="py-16 bg-antasus-neutral dark:bg-antasus-dark"
        >
            <div class="max-w-4xl px-4 mx-auto">
                <h2
                    id="faq-headline"
                    class="mb-10 text-3xl font-extrabold text-center text-antasus-black dark:text-antasus-neutral"
                >
                    Häufige Fragen zum Glasfaserbau
                </h2>
                <ul class="space-y-4">
                    <li v-for="(faq, i) in faqs" :key="i">
                        <details
                            class="p-4 transition border rounded-2xl group bg-antasus-bg dark:bg-antasus-dark-card border-antasus-neutral dark:border-antasus-dark-border focus-within:ring-2 focus-within:ring-antasus-primary"
                        >
                            <summary
                                class="text-lg font-semibold transition rounded cursor-pointer text-antasus-black dark:text-antasus-neutral focus:outline-none focus-visible:ring-2 focus-visible:ring-antasus-primary"
                                :aria-expanded="false"
                                tabindex="0"
                                @keyup.enter="$event.target.click()"
                                @keyup.space="$event.target.click()"
                            >
                                {{ faq.question }}
                            </summary>
                            <div
                                class="mt-2 leading-relaxed text-antasus-dark/80 dark:text-antasus-neutral"
                            >
                                {{ faq.answer }}
                            </div>
                        </details>
                    </li>
                </ul>
            </div>
        </section>
    </GuestLayout>
</template>

<script setup>
import { Head, Link } from "@inertiajs/vue3";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import { ref, onMounted } from "vue";

// FAQ-Daten
const faqs = ref([
    {
        question:
            "Wie tief ist der Graben, wenn eine Glasfaserleitung verlegt wird?",
        answer: "Beim traditionellen Glasfaserbau werden die Gräben in der Regel zwischen 60 und 125 cm tief angelegt. Die Breite richtet sich nach den jeweiligen Vorgaben und liegt für Mikrorohr-Gräben meist bei mindestens 30 cm. In bestimmten Situationen kann es jedoch notwendig sein, noch breitere Gräben auszuheben. In solchen Fällen greifen die Vorschriften der Zusätzlichen Technischen Vertragsbedingungen (ZTV). Der benötigte Arbeitsstreifen beim klassischen Tiefbau kann zudem über 2,5 Meter hinausgehen, da ausreichend Platz für Maschinen und Materialtransport erforderlich ist.",
    },
    {
        question: "Welche Trassenvarianten gibt es?",
        answer: "Die im August 2023 veröffentlichte DIN 18220 ist die zentrale Norm für moderne Verlegeverfahren wie Trenching-, Fräs- und Pflugverfahren. Sie definiert detailliert die Anforderungen an Planung, Ausführung, Mindestabstände, Dokumentation und die Wiederherstellung der Oberflächen. Die Norm stellt sicher, dass diese alternativen Methoden rechtssicher und nach einheitlichen Standards durchgeführt werden. Für Gräben mit einer Breite ab 30 cm kommen zudem die Zusätzlichen Technischen Vertragsbedingungen (ZTV A1) zur Anwendung, die weitere Vorgaben für Bauausführung und Qualitätssicherung enthalten. Neben der DIN 18220 und den ZTV sind auch die Vorgaben des Telekommunikationsgesetzes (§ 126 TKG) zu beachten. Dieses schreibt vor, dass Telekommunikationslinien nach den anerkannten Regeln der Technik zu errichten und zu betreiben sind.",
    },
    {
        question: "Wie lange dauert ein FTTH Glasfaser Hausanschluss?",
        answer: "Die DIN 18220 legt klare Anforderungen an Planung, Bauausführung und Dokumentation fest und trägt dazu bei, Genehmigungsprozesse zu beschleunigen und die Bauzeit vor Ort zu verkürzen. In der Praxis kann der eigentliche Anschluss eines Hauses, also die Herstellung der Verbindung vom öffentlichen Netz bis in das Gebäude, oft innerhalb eines Tages erfolgen, sofern alle Vorarbeiten (wie Planung, Abstimmung mit Leitungsbetreibern und Genehmigungen) abgeschlossen sind. Die Norm sorgt dafür, dass die Prozesse standardisiert und effizient ablaufen, was zu einer insgesamt schnelleren Versorgung führt.",
    },
    {
        question: "Wer übernimmt die Dokumentation?",
        answer: "Im Rahmen geförderter Ausbauprojekte ist die Gebietskörperschaft als Erstzuwendungsempfängerin in der Pflicht, die vollständige Dokumentation für den Verwendungsnachweis einzureichen. Im sogenannten Wirtschaftlichkeitslückenmodell wird diese Aufgabe in der Regel per Vertrag auf das ausbauende Telekommunikationsunternehmen übertragen. Im Betreibermodell verbleibt die Verantwortung für die ordnungsgemäße Dokumentation hingegen meist beim Bauherrn und Eigentümer der passiven Infrastruktur. In beiden Fällen ist es üblich, dass die ausführenden Unternehmen, also die Bau- und Telekommunikationsfirmen, die technische Dokumentation (wie Netzpläne, Fotodokumentationen, Messprotokolle) erstellen und an die zuständige Stelle weitergeben.",
    },
]);

// JSON-LD: BreadcrumbList
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
    ],
};

// JSON-LD: Article für AI/SGE
const articleJsonLd = {
    "@context": "https://schema.org",
    "@type": "Article",
    headline: "Glasfaserbau: Der Komplett-Leitfaden",
    description:
        "Alle Phasen des Glasfaserbaus: Netzplanung, Tiefbau, Hausanschluss, Messtechnik, Normen, Qualität - inkl. PDF-Downloads und FAQ.",
    author: { "@type": "Organization", name: "ANTASUS Infra" },
    publisher: { "@type": "Organization", name: "ANTASUS Infra" },
    url: "https://www.antasus.de/glasfaserbau",
    mainEntityOfPage: "https://www.antasus.de/glasfaserbau",
    datePublished: "2024-01-01",
    dateModified: "2025-07-13",
    image: "https://www.antasus.de/images/og-glasfaserbau.webp",
};

// JSON-LD: FAQPage für Google SGE/AI
const faqJsonLd = {
    "@context": "https://schema.org",
    "@type": "FAQPage",
    mainEntity: faqs.value.map((faq) => ({
        "@type": "Question",
        name: faq.question,
        acceptedAnswer: { "@type": "Answer", text: faq.answer },
    })),
};

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

    // FAQPage
    const faqTag = document.createElement("script");
    faqTag.type = "application/ld+json";
    faqTag.text = JSON.stringify(faqJsonLd, null, 2);
    document.head.appendChild(faqTag);
});
</script>

<style scoped>
.list-disc li {
    margin-bottom: 0.5rem;
}
</style>
