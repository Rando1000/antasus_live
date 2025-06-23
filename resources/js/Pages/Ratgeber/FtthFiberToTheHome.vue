<template>
    <Head>
        <title>
            FTTH – Glasfaser bis ins Haus: Technik, Kosten & Förderung – Antasus
        </title>
        <meta
            name="description"
            content="Alles zu FTTH: Aufbau, Kosten, Förderprogramme und Praxis­tipps für Glasfaser bis ins Home oder Büro."
        />
        <meta name="robots" content="index,follow" />
        <meta
            name="keywords"
            content="FTTH, Fiber to the Home, Glasfaser Förderung, Hausanschluss Technik, Antasus"
        />
        <meta property="og:type" content="article" />
        <meta
            property="og:url"
            content="https://www.antasus.de/ratgeber/ftth-fiber-to-the-home"
        />
        <meta
            property="og:title"
            content="FTTH – Glasfaser bis ins Haus: Technik, Kosten & Förderung"
        />
        <meta
            property="og:description"
            content="Alles zu FTTH: Wie Glasfaser bis ins Gebäude verlegt wird, welche Kosten anfallen & welche Förderprogramme es gibt."
        />
        <meta
            property="og:image"
            content="https://www.antasus.de/images/og-ftth.webp"
        />
    </Head>

    <GuestLayout serviceArea="ratgeber">
        <!-- Breadcrumb -->
        <nav
            aria-label="Breadcrumb"
            class="container px-4 py-4 mx-auto text-sm text-gray-600 dark:text-gray-400"
        >
            <ol class="inline-flex space-x-1">
                <li>
                    <Link href="/" class="hover:underline">Startseite</Link>
                </li>
                <li>/</li>
                <li>
                    <Link href="/ratgeber" class="hover:underline"
                        >Ratgeber</Link
                    >
                </li>
                <li>/</li>
                <li class="font-semibold" aria-current="page">FTTH</li>
            </ol>
        </nav>

        <article
            class="container px-4 py-8 mx-auto prose prose-lg dark:prose-invert"
        >
            <header class="mb-12 text-center">
                <h1
                    class="mb-4 text-4xl font-extrabold md:text-5xl dark:text-white"
                >
                    FTTH – Fiber to the Home<br />
                    <span class="gradient-text"
                        >Technik, Kosten & Förderung</span
                    >
                </h1>
                <p class="text-gray-600 dark:text-gray-400">
                    <time :datetime="publishedAt">{{
                        formatDate(publishedAt)
                    }}</time>
                </p>
            </header>

            <h2>FTTH - Ihr Glasfaser-Turbo für die digitale Zukunft</h2>
            <p>
                Willkommen im Gigabit-Zeitalter!
                <strong>FTTH (Fiber to the Home)</strong> ist der Schlüssel zu
                blitzschnellem Internet und maximaler Zukunftssicherheit.
                Schluss mit ruckelnden Videocalls, Streaming in Pixelqualität
                oder langsamen Uploads: Mit einer durchgehenden Glasfaserleitung
                bis direkt in Ihr Haus oder Ihre Firma erleben Sie Bandbreite,
                Stabilität und Zuverlässigkeit auf einem ganz neuen Level.
            </p>
            <p>
                Warum ist das so revolutionär? Während klassische
                Kupferleitungen an ihre Grenzen stoßen, transportiert Glasfaser
                Daten mit Lichtgeschwindigkeit. Und das störungsfrei,
                energiesparend und bereit für alle kommenden digitalen
                Anwendungen. Egal ob Homeoffice, Gaming, Telemedizin oder Smart
                Home: FTTH ist die Basis für Ihren digitalen Alltag von morgen.
            </p>

            <h2>So kommt das Licht ins Haus: Der technische Aufbau</h2>
            <ul>
                <li>
                    <strong>Erdverlegte Glasfaser:</strong> Die Leitung wird per
                    Micro-Trenching oder klassischem Tiefbau bis an Ihr Gebäude
                    geführt. Sicher in Leerrohren verpackt, damit auch künftige
                    Upgrades kein Problem sind.
                </li>
                <li>
                    <strong>Gebäudeeinführung:</strong> Durch eine gas- und
                    wasserdichte Hauseinführung gelangt die Faser ins Innere.
                    Hier endet die Verlegung der Glasfaser, nach fachgerechter
                    Montage, und Ihr Highspeed-Erlebnis beginnt.
                </li>
                <li>
                    <strong>ONT (Optical Network Termination):</strong> Im Haus
                    wird die Faser an einen optischen Abschluss angeschlossen,
                    der das Lichtsignal in ein elektrisches umwandelt. Der
                    Startpunkt für Ihr eigenes Netzwerk.
                </li>
                <li>
                    <strong>Router & Heimnetz:</strong> Vom ONT geht es per
                    Netzwerkkabel oder Patchkabel weiter zum Router, der das
                    Signal im ganzen Haus verteilt. Per LAN oder WLAN.
                </li>
                <li>
                    <strong>Stromversorgung & Notstrom:</strong> ONT und Router
                    brauchen Strom. Für kritische Anwendungen gibt es auf Wunsch
                    auch Notstromlösungen.
                </li>
            </ul>

            <h2>Was kostet FTTH? Und wie wird gefördert?</h2>
            <ul>
                <li>
                    <strong>Installationskosten:</strong> Je nach Aufwand und
                    Region kostet der Anschluss meist zwischen 800 und 2.500
                    Euro. Faktoren wie die Länge der Zuleitung,
                    Bodenbeschaffenheit oder vorhandene Leerrohre spielen eine
                    Rolle.
                </li>
                <li>
                    <strong>Förderprogramme:</strong> Bund, Länder und EU
                    unterstützen den Glasfaserausbau großzügig. Zuschüsse von 50
                    bis 90 Prozent sind möglich! Gerade in ländlichen Regionen
                    oder bei sogenannten „weißen Flecken“. Förderanträge laufen
                    meist über die Kommune oder direkt beim Netzbetreiber.
                </li>
                <li>
                    <strong>Langfristige Vorteile:</strong> Ein FTTH-Anschluss
                    steigert den Wert Ihrer Immobilie und spart dauerhaft
                    Betriebskosten, da keine Kupfermiete mehr anfällt und die
                    Technik äußerst energieeffizient ist.
                </li>
            </ul>

            <h2>Der Weg zum Glasfaseranschluss: Schritt für Schritt</h2>
            <ol>
                <li>
                    <strong>Vor-Ort-Begehung & Angebot:</strong> Experten prüfen
                    Ihre Gegebenheiten und erstellen ein individuelles Angebot.
                </li>
                <li>
                    <strong>Genehmigungen & Förderung:</strong> Falls nötig,
                    werden Genehmigungen eingeholt und Fördermittel beantragt.
                </li>
                <li>
                    <strong>Tiefbau & Verlegung:</strong> Die Glasfaser wird per
                    Erdrakete, Spülbohrung oder Graben bis ans Haus gebracht.
                </li>
                <li>
                    <strong>Gebäudeeinführung & ONT-Montage:</strong> Die Faser
                    wird ins Haus geführt und der optische Abschluss
                    installiert.
                </li>
                <li>
                    <strong>Inbetriebnahme & Test:</strong> Nach Abschluss aller
                    Arbeiten wird die Verbindung geprüft und dokumentiert.
                </li>
                <li>
                    <strong>Dokumentation & Einweisung:</strong> Sie erhalten
                    eine ausführliche Dokumentation und werden in die Nutzung
                    eingewiesen.
                </li>
            </ol>

            <h2>Warum FTTH? Die Vorteile auf einen Blick</h2>
            <ul>
                <li>
                    <strong>Gigabit-Geschwindigkeiten:</strong> Symmetrisch,
                    also gleich schnell im Upload wie im Download. Perfekt für
                    Cloud, Streaming, Homeoffice und mehr.
                </li>
                <li>
                    <strong>Minimale Latenz:</strong> Ideal für Online-Gaming,
                    Echtzeitanwendungen und Videokonferenzen ohne Verzögerung.
                </li>
                <li>
                    <strong>Zukunftssicher:</strong> Glasfaserleitungen halten
                    50 Jahre und mehr, und können mit neuen Technologien immer
                    schneller werden.
                </li>
                <li>
                    <strong>Störungsfrei & zuverlässig:</strong> Unempfindlich
                    gegen elektromagnetische Einflüsse, Feuchtigkeit und
                    Temperaturschwankungen.
                </li>
                <li>
                    <strong>Wertsteigernd:</strong> Ein FTTH-Anschluss ist heute
                    ein echtes Plus für jede Immobilie, und ein wichtiges
                    Argument beim Verkauf oder der Vermietung.
                </li>
            </ul>

            <h2>Fazit: FTTH ist Ihr Ticket in die digitale Zukunft</h2>
            <p>
                Ein Glasfaseranschluss ist längst kein Luxus mehr, sondern die
                Eintrittskarte in die digitale Welt von morgen. Wer jetzt
                investiert, profitiert doppelt: von maximaler Geschwindigkeit
                und von langfristiger Wertsteigerung. <br />
                <strong>Tipp:</strong> Informieren Sie sich frühzeitig über
                Fördermöglichkeiten und sprechen Sie mit zertifizierten
                Fachbetrieben, damit Ihr Gebäude fit für das Gigabit-Zeitalter
                ist!
            </p>
            <p class="text-xs text-gray-400">
                Quellen: Bundesministerium für Digitales und Verkehr, BREKO,
                VATM, Bundesnetzagentur, eigene Recherchen (Stand Juni 2025).
            </p>

            <div class="text-center">
                <button
                    @click="showBookingModal = true"
                    class="btn-xl focus:outline-none focus:ring-2 focus:ring-[#00fdcf]"
                >
                    Jetzt FTTH-Anschluss sichern
                </button>
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
                            href="/ratgeber/glasfaser"
                            class="text-antasus-primary hover:underline"
                        >
                            FTTH – Glasfaser bis ins Haus: Technik & Förderung
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
                            href="/ratgeber/technologien"
                            class="text-antasus-primary hover:underline"
                        >
                            Techniken und Technologien Im FTTX
                        </Link>
                    </li>
                </ul>
            </section>
        </article>
        <BookingModal
            v-if="showBookingModal"
            :open="true"
            @close="showBookingModal = false"
            @typeSelected="handleMeetingType"
        />

        <!-- FAQ -->
        <section class="py-16 mb-10 border-t border-gray-100 bg-gray-50">
            <div class="max-w-4xl px-4 mx-auto">
                <h2
                    class="mb-10 text-3xl font-extrabold text-center text-gray-900"
                >
                    Häufige Fragen
                </h2>
                <div class="space-y-4">
                    <details
                        v-for="(item, index) in faqItems"
                        :key="index"
                        class="p-4 bg-white border rounded-lg group dark:bg-gray-800"
                    >
                        <summary
                            class="text-lg font-semibold text-gray-800 cursor-pointer focus:outline-none focus:ring-2 focus:ring-primary dark:text-white"
                        >
                            {{ item.q }}
                        </summary>
                        <div
                            class="mt-2 leading-relaxed text-gray-600 dark:text-gray-300"
                        >
                            {{ item.a }}
                        </div>
                    </details>
                </div>
            </div>
        </section>
    </GuestLayout>
</template>

<script setup>
import { ref, onMounted } from "vue";
import { Head, Link } from "@inertiajs/vue3";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import BookingModal from "@/Components/BookingModal.vue";
import { format } from "date-fns";
import { de } from "date-fns/locale";
import { Inertia } from "@inertiajs/inertia";

const showBookingModal = ref(false);

function handleMeetingType(type) {
    showBookingModal.value = false;
    Inertia.visit(`/buchen?type=${type}`);
}

const publishedAt = ref("2025-06-22");
const formatDate = (d) => format(new Date(d), "d. MMMM yyyy", { locale: de });

const faqItems = [
    {
        q: "Welche Förderprogramme gibt es für FTTH?",
        a: "Bund und Länder erstatten meist 50–90 % der Installationskosten.",
    },
    {
        q: "Wie lange dauert die FTTH-Installation?",
        a: "Typisch 1–3 Werktage, je nach örtlichen Gegebenheiten.",
    },
    {
        q: "Brauche ich spezielle Hardware?",
        a: "Sie benötigen ein ONT und einen Glasfaser-fähigen Router, z. B. FRITZ!Box.",
    },
];

onMounted(() => {
    const jsonLd = {
        "@context": "https://schema.org",
        "@graph": [
            {
                "@type": "BreadcrumbList",
                itemListElement: [
                    {
                        "@type": "ListItem",
                        position: 1,
                        name: "Startseite",
                        item: "https://www.antasus.de/",
                    },
                    {
                        "@type": "ListItem",
                        position: 2,
                        name: "Ratgeber",
                        item: "https://www.antasus.de/ratgeber",
                    },
                    {
                        "@type": "ListItem",
                        position: 3,
                        name: "FTTH",
                        item: "https://www.antasus.de/ratgeber/ftth-fiber-to-the-home",
                    },
                ],
            },
            {
                "@type": "Article",
                mainEntityOfPage: {
                    "@type": "WebPage",
                    "@id": "https://www.antasus.de/ratgeber/ftth-fiber-to-the-home",
                },
                headline:
                    "FTTH – Glasfaser bis ins Haus: Technik, Kosten & Förderung – Antasus",
                description:
                    "Alles zu FTTH: Aufbau, Kosten, Förderprogramme und Praxis­tipps für Glasfaser bis ins Gebäude.",
                datePublished: publishedAt.value,
                author: { "@type": "Person", name: "R. Jouini" },
                publisher: {
                    "@type": "Organization",
                    name: "ANTASUS Infra",
                    logo: {
                        "@type": "ImageObject",
                        url: "https://www.antasus.de/images/antasus-logo2.svg",
                    },
                },
            },
            {
                "@type": "FAQPage",
                mainEntity: faqItems.map(({ q, a }) => ({
                    "@type": "Question",
                    name: q,
                    acceptedAnswer: { "@type": "Answer", text: a },
                })),
            },
        ],
    };
    const s = document.createElement("script");
    s.type = "application/ld+json";
    s.text = JSON.stringify(jsonLd, null, 2);
    document.head.appendChild(s);
});
</script>

<style scoped>
.gradient-text {
    background: linear-gradient(135deg, #00fdcf, #000);
    -webkit-background-clip: text;
    color: transparent;
}
.btn-xl {
    display: inline-block;
    padding: 0.75rem 1.5rem;
    font-weight: 600;
    color: #fff;
    background: linear-gradient(135deg, #00fdcf, #000);
    border-radius: 0.375rem;
    transition: opacity 0.2s;
}
.btn-xl:hover {
    opacity: 0.9;
}
</style>
