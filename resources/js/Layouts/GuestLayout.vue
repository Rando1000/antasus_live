<template>
    <Head>
        <link
            rel="icon"
            type="image/png"
            href="/favicon-96x96.png"
            sizes="96x96"
        />
        <link rel="icon" type="image/svg+xml" href="/favicon.svg" />
        <link rel="shortcut icon" href="/favicon.ico" />
        <link
            rel="apple-touch-icon"
            sizes="180x180"
            href="/apple-touch-icon.png"
        />
        <link rel="manifest" href="/manifest.webmanifest" />
        <meta name="theme-color" content="#14b8a6" />
        <meta
            name="description"
            content="ANTASUS Infra - Ihr zuverlässiger Subunternehmer für Glasfaser-Tiefbau, Hausanschlüsse & Projektabwicklung nach DIN/VDE. Termintreu, normkonform & partnerschaftlich."
        />
        <meta
            property="og:description"
            content="ANTASUS Infra - Ihr zuverlässiger Subunternehmer für Glasfaser-Tiefbau, Hausanschlüsse & Projektabwicklung nach DIN/VDE. Termintreu, normkonform & partnerschaftlich."
        />
    </Head>
    <a
        href="#main-content"
        class="z-50 px-3 py-2 text-white rounded sr-only focus:not-sr-only focus:absolute focus:top-4 focus:left-4 bg-antasus-primary"
        tabindex="0"
    >
        Zum Hauptinhalt springen
    </a>

    <div v-if="localBusinessJsonLd" v-html="jsonLdScriptTag" />

    <div
        class="min-h-screen transition-colors duration-200 bg-antasus-bg dark:bg-antasus-dark text-antasus-black dark:text-white"
    >
        <!-- Header + Navigation -->
        <header
            class="sticky top-0 z-50 border-b shadow bg-white/80 dark:bg-antasus-dark/80 backdrop-blur-md border-antasus-neutral dark:border-antasus-dark-border"
        >
            <div
                class="container flex items-center justify-between px-4 py-2 mx-auto md:py-4"
            >
                <!-- Logo -->
                <Link
                    href="/"
                    class="flex items-center rounded-lg focus-visible:ring-2 focus-visible:ring-antasus-primary"
                    aria-label="Zur Startseite"
                >
                    <ApplicationLogo
                        class="h-20 sm:h-28 md:h-32 lg:h-36 xl:h-40 2xl:h-40"
                    />
                </Link>

                <!-- Desktop Navigation -->
                <nav
                    v-if="$page.url !== '/kontakt'"
                    class="items-center hidden gap-1 xl:flex 2xl:gap-2"
                    aria-label="Hauptnavigation"
                >
                    <NavLink
                        href="/ratgeber/technologien"
                        label="Technologien"
                        class="text-xl font-bold transition-colors hover:text-antasus-primary dark:hover:text-antasus-primary"
                    />
                    <NavLink
                        href="/glasfaserbau"
                        label="Glasfaserbau"
                        class="text-xl font-bold transition-colors hover:text-antasus-primary dark:hover:text-antasus-primary"
                    />
                    <NavLink
                        href="/leistungen"
                        label="Dienstleistungen"
                        class="text-2xl font-extrabold transition-colors hover:text-antasus-primary dark:hover:text-antasus-primary"
                    />
                    <NavLink
                        href="/referenzen"
                        label="Referenzen"
                        class="text-xl font-bold transition-colors hover:text-antasus-primary dark:hover:text-antasus-primary"
                    />
                    <NavLink
                        href="/ratgeber"
                        label="Glasfaser Ratgeber"
                        class="text-xl font-bold transition-colors hover:text-antasus-primary dark:hover:text-antasus-primary"
                    />
                    <NavLink
                        href="/inprogress"
                        label="History"
                        class="text-xl font-bold transition-colors hover:text-antasus-primary dark:hover:text-antasus-primary"
                    />
                    <button
                        @click="showBookingModal = true"
                        class="px-4 py-2 text-white transition rounded-lg bg-gradient-to-r from-antasus-primary to-antasus-black hover:shadow-lg focus-visible:ring-2 focus-visible:ring-antasus-primary"
                        aria-label="Jetzt Termin buchen"
                    >
                        Termin sofort buchen
                    </button>
                    <Link
                        href="/kontakt"
                        class="px-4 py-2 text-white transition rounded-lg bg-gradient-to-r from-antasus-primary to-antasus-indigo hover:shadow-lg focus-visible:ring-2 focus-visible:ring-antasus-primary"
                        aria-label="Kontakt"
                        >Kontakt</Link
                    >
                </nav>

                <!-- Reduzierte Navigation unter xl -->
                <nav
                    v-if="$page.url !== '/kontakt'"
                    class="items-center hidden space-x-4 md:flex xl:hidden"
                    aria-label="Hauptnavigation reduziert"
                >
                    <NavLink
                        href="/leistungen"
                        label="Dienstleistungen"
                        class="text-2xl font-extrabold text-gray-900 transition-colors hover:text-teal-600"
                    />
                    <button
                        @click="showBookingModal = true"
                        class="px-4 py-2 text-white transition rounded-lg bg-gradient-to-r from-teal-600 to-black hover:shadow-lg focus-visible:ring-2 focus-visible:ring-antasus-primary"
                        aria-label="Jetzt Termin buchen"
                    >
                        Termin sofort buchen
                    </button>
                    <Link
                        href="/kontakt"
                        class="px-4 py-2 text-white transition-all rounded-lg bg-gradient-to-r from-teal-600 to-indigo-600 hover:shadow-lg focus-visible:ring-2 focus-visible:ring-antasus-primary"
                        aria-label="Kontakt"
                        >Kontakt</Link
                    >
                </nav>

                <!-- Burger-Menü Mobile -->
                <button
                    class="ml-2 rounded-lg xl:hidden text-antasus-black dark:text-white focus-visible:ring-2 focus-visible:ring-antasus-primary"
                    @click="toggleMobileMenu"
                    aria-label="Menü öffnen/schließen"
                    aria-controls="mobile-menu"
                    :aria-expanded="mobileMenuOpen.toString()"
                >
                    <svg
                        class="w-8 h-8"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"
                        />
                    </svg>
                </button>

                <!-- Kontakt-Seite Navigation -->
                <nav
                    v-if="$page.url === '/kontakt'"
                    class="items-center hidden space-x-4 md:flex xl:space-x-8"
                    aria-label="Navigation Kontakt"
                >
                    <NavLink
                        href="/leistungen"
                        label="Dienstleistungen"
                        class="text-2xl font-extrabold transition-colors hover:text-antasus-primary dark:hover:text-antasus-primary"
                    />
                    <NavLink
                        href="/referenzen"
                        label="Referenzen"
                        class="text-xl font-bold transition-colors hover:text-antasus-primary dark:hover:text-antasus-primary"
                    />
                    <NavLink
                        href="/ratgeber"
                        label="Glasfaser Ratgeber"
                        class="text-xl font-bold transition-colors hover:text-antasus-primary dark:hover:text-antasus-primary"
                    />
                    <button
                        @click="showBookingModal = true"
                        class="px-4 py-2 text-white transition rounded-lg bg-gradient-to-r from-teal-600 to-black hover:shadow-lg focus-visible:ring-2 focus-visible:ring-antasus-primary"
                        aria-label="Jetzt Termin buchen"
                    >
                        Termin sofort buchen
                    </button>
                </nav>
                <div class="ml-3">
                    <DarkModeToggle />
                </div>
            </div>
        </header>

        <!-- Mobile Navigation Drawer -->
        <Transition name="slide-fade">
            <nav
                v-if="mobileMenuOpen"
                id="mobile-menu"
                class="fixed inset-0 z-50 flex flex-col px-6 py-8 transition-colors bg-white shadow-xl dark:bg-antasus-dark xl:hidden"
                role="dialog"
                aria-modal="true"
                aria-label="Mobiles Hauptmenü"
                tabindex="-1"
            >
                <div class="flex items-center justify-between mb-6">
                    <Link href="/" aria-label="Zur Startseite">
                        <ApplicationLogo2 class="h-12" />
                    </Link>
                    <button
                        @click="toggleMobileMenu"
                        class="rounded-lg text-antasus-black dark:text-white focus-visible:ring-2 focus-visible:ring-antasus-primary"
                        aria-label="Menü schließen"
                    >
                        <svg
                            class="w-8 h-8"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"
                            />
                        </svg>
                    </button>
                </div>
                <ul class="space-y-4 text-lg font-semibold">
                    <li>
                        <NavLink
                            href="/ratgeber/technologien"
                            label="Technologien"
                            class="block hover:text-antasus-primary dark:hover:text-antasus-primary"
                        />
                    </li>
                    <li>
                        <NavLink
                            href="/glasfaserbau"
                            label="Glasfaserbau"
                            class="block hover:text-antasus-primary dark:hover:text-antasus-primary"
                        />
                    </li>
                    <li>
                        <NavLink
                            href="/referenzen"
                            label="Referenzen"
                            class="block hover:text-antasus-primary dark:hover:text-antasus-primary"
                        />
                    </li>
                    <li>
                        <NavLink
                            href="/ratgeber"
                            label="Ratgeber"
                            class="block hover:text-antasus-primary dark:hover:text-antasus-primary"
                        />
                    </li>
                    <li>
                        <NavLink
                            href="/inprogress"
                            label="History"
                            class="block hover:text-antasus-primary dark:hover:text-antasus-primary"
                        />
                    </li>
                    <li>
                        <NavLink
                            href="/kontakt"
                            label="Kontakt"
                            class="block hover:text-antasus-primary dark:hover:text-antasus-primary"
                        />
                    </li>
                </ul>
                <div class="flex flex-col gap-2 mt-10">
                    <button
                        @click="showBookingModal = true"
                        class="px-4 py-2 text-white transition rounded-lg bg-gradient-to-r from-antasus-primary to-antasus-black hover:shadow-lg focus-visible:ring-2 focus-visible:ring-antasus-primary"
                        aria-label="Jetzt Termin buchen"
                    >
                        Termin sofort buchen
                    </button>
                </div>
            </nav>
        </Transition>

        <!-- Booking Modal -->
        <BookingModal
            v-if="showBookingModal"
            :open="true"
            @close="showBookingModal = false"
            @typeSelected="handleMeetingType"
        />

        <!-- Page Header mit Bild, wenn Slot vorhanden -->
        <header
            v-if="$slots.header"
            class="relative w-full overflow-hidden rounded-t-lg shadow-xl h-96"
        >
            <img
                :src="headerBackgroundImage"
                alt="Glasfaser Tiefbau"
                width="1920"
                height="800"
                fetchpriority="high"
                class="absolute inset-0 object-cover w-full h-full"
            />
            <div class="absolute inset-0 bg-black/10 backdrop-blur-sm"></div>
            <div
                class="relative z-10 flex flex-col items-center justify-center h-full px-4 text-center text-white"
            >
                <slot name="header" />
            </div>
        </header>

        <!-- Main Content -->
        <main id="main-content" tabindex="-1">
            <slot />
        </main>

        <Footer />
    </div>
</template>

<script setup>
import { Head, usePage, Link, router } from "@inertiajs/vue3";
import Footer from "@/Components/Footer.vue";
import ApplicationLogo2 from "@/Components/ApplicationLogo2.vue";
import NavLink from "@/Components/NavLink.vue";
import BookingModal from "@/Components/BookingModal.vue";
import DarkModeToggle from "@/Components/DarkModeToggle.vue";
import { computed, onMounted, ref } from "vue";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";

const props = defineProps({
    serviceArea: {
        type: String,
        default: "default",
        validator: (value) =>
            [
                "dienstleistungen",
                "referenz",
                "impressum",
                "datenschutz",
                "agb",
                "home",
                "ratgeber",
                "default",
            ].includes(value),
    },
    TrackEvent,
});

const showBookingModal = ref(false);
const mobileMenuOpen = ref(false);

function toggleMobileMenu() {
    mobileMenuOpen.value = !mobileMenuOpen.value;
    // Fokus auf Menü-Container setzen (Barrierefreiheit)
    setTimeout(() => {
        if (mobileMenuOpen.value) {
            const menu = document.getElementById("mobile-menu");
            menu && menu.focus && menu.focus();
        }
    }, 30);
}

const handleMeetingType = (type) => {
    showBookingModal.value = false;
    router.visit(`/buchen?type=${type}`);
};

const page = usePage();
const canonicalUrl = computed(() => `https://www.antasus.de${page.url}`);

const localBusinessJsonLd = {
    "@context": "https://schema.org",
    "@type": "LocalBusiness",
    name: "Antasus Infra",
    url: "https://www.antasus.de",
    logo: "https://www.antasus.de/logo.png",
    image: "https://www.antasus.de/images/favicon.svg",
    description:
        "Antasus Infra ist Ihr Partner für professionelle Glasfaserprojekte - vom Hausanschluss bis zur Projektdokumentation.",
    address: {
        "@type": "PostalAddress",
        streetAddress: "Norrenbergstrasse 122",
        addressLocality: "Wuppertal",
        postalCode: "42289",
        addressCountry: "DE",
    },
    telephone: "+49 176 24757616",
    email: "info@antasus.de",
    makesOffer: {
        "@type": "Offer",
        itemOffered: {
            "@type": "Service",
            name: "Online-Terminbuchung",
            description:
                "Buchen Sie jetzt online einen Termin für Glasfaser-Tiefbau, Hausanschluss oder Projektberatung.",
            provider: {
                "@type": "LocalBusiness",
                name: "Antasus Infra",
                address: {
                    "@type": "PostalAddress",
                    streetAddress: "Norrenbergstrasse 122",
                    addressLocality: "Wuppertal",
                    postalCode: "42289",
                    addressCountry: "DE",
                },
            },
        },
        availability: "https://schema.org/InStock",
        url: "https://www.antasus.de",
    },
    potentialAction: {
        "@type": "ReserveAction",
        target: {
            "@type": "EntryPoint",
            urlTemplate: "https://www.antasus.de",
            inLanguage: "de",
            actionPlatform: [
                "http://schema.org/DesktopWebPlatform",
                "http://schema.org/MobileWebPlatform",
            ],
        },
        result: {
            "@type": "Reservation",
            name: "Terminbuchung",
        },
    },
};

const jsonLdScriptTag = `<script type="application/ld+json">${JSON.stringify(
    localBusinessJsonLd,
    null,
    2
)}`;

const headerBackgroundImage = computed(() => {
    const map = {
        default: "Header3.avif",
        dienstleistungen: "leistungheader.avif",
        referenz: "referenzheader.avif",
        impressum: "impressumheader.avif",
        datenschutz: "datenschutz.avif",
        agb: "agb.avif",
    };
    return `/images/${map[props.serviceArea] || map.default}`;
});

// GTAG initialisieren (nur einmal beim Mount)
onMounted(() => {
    const s1 = document.createElement("script");
    s1.src = "https://www.googletagmanager.com/gtag/js?id=G-WFXB4YWS1W";
    s1.async = true;
    document.head.appendChild(s1);

    const s2 = document.createElement("script");
    s2.innerHTML = `
    window.dataLayer = window.dataLayer || [];
    function gtag(){ dataLayer.push(arguments); }
    gtag('js', new Date());
    gtag('config', 'G-WFXB4YWS1W');
  `;
    document.head.appendChild(s2);
});
</script>

<style scoped>
.slide-fade-enter-active,
.slide-fade-leave-active {
    transition: all 0.3s ease;
}
.slide-fade-enter-from,
.slide-fade-leave-to {
    transform: translateY(-10px);
    opacity: 0;
}
</style>
