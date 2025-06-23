<template>
    <Head>
        <link rel="canonical" :href="canonicalUrl" />
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

        <!-- 👇 Strukturierte LocalBusiness-Daten -->
    </Head>
    <div v-if="localBusinessJsonLd" v-html="jsonLdScriptTag" />
    <div class="min-h-screen bg-white">
        <!-- Sticky Header mit Glaseffekt -->

        <div class="container px-4 mx-auto my-auto">
            <div
                class="flex items-center justify-between min-h-[5rem] md:min-h-[9rem]"
            >
                <!-- Logo optimiert auf alle Größen -->
                <Link href="/" class="flex items-center">
                    <ApplicationLogo2
                        class="w-auto h-24 sm:h-28 md:h-32 lg:h-36 xl:h-40 2xl:h-36"
                    />
                </Link>

                <!-- Desktop Navigation -->
                <nav
                    v-if="$page.url !== '/kontakt'"
                    class="items-center hidden space-x-6 xl:flex 2xl:space-x-4"
                >
                    <NavLink
                        href="/technologien"
                        label="Technologies"
                        class="text-xl font-bold text-gray-900 transition-colors hover:text-teal-600"
                    ></NavLink>
                    <NavLink
                        href="/glasfaserbau"
                        label="Glasfaserbau"
                        class="text-xl font-bold text-gray-900 transition-colors hover:text-teal-600"
                    ></NavLink>
                    <NavLink
                        href="/leistungen"
                        label="Dienstleistungen"
                        class="text-2xl font-extrabold text-gray-900 transition-colors hover:text-teal-600"
                    ></NavLink>
                    <NavLink
                        href="/referenzen"
                        label="Referenzen"
                        class="text-xl font-bold text-gray-900 transition-colors hover:text-teal-600"
                    ></NavLink>
                    <NavLink
                        href="/ratgeber"
                        label="Glasfaser Ratgeber"
                        class="text-xl font-bold text-gray-900 transition-colors hover:text-teal-600"
                    ></NavLink>
                    <NavLink
                        href="/inprogress"
                        label="History"
                        class="text-xl font-bold text-gray-900 transition-colors hover:text-teal-600"
                    ></NavLink>
                    <button
                        @click="showBookingModal = true"
                        class="px-4 py-2 text-white transition rounded-lg bg-gradient-to-r from-teal-600 to-black hover:shadow-lg"
                    >
                        Termin sofort buchen
                    </button>

                    <Link
                        href="/kontakt"
                        class="px-4 py-2 text-white transition-all rounded-lg bg-gradient-to-r from-teal-600 to-indigo-600 hover:shadow-lg"
                        >Kontakt</Link
                    >
                </nav>

                <!-- Reduzierte Navigation unter xl -->
                <nav
                    v-if="$page.url !== '/kontakt'"
                    class="items-center hidden space-x-4 md:flex xl:hidden"
                >
                    <NavLink
                        href="/leistungen"
                        label="Dienstleistungen"
                        class="text-2xl font-extrabold text-gray-900 transition-colors hover:text-teal-600"
                    ></NavLink>
                    <button
                        @click="showBookingModal = true"
                        class="px-4 py-2 text-white transition rounded-lg bg-gradient-to-r from-teal-600 to-black hover:shadow-lg"
                    >
                        Termin sofort buchen
                    </button>
                    <Link
                        href="/kontakt"
                        class="px-4 py-2 text-white transition-all rounded-lg bg-gradient-to-r from-teal-600 to-indigo-600 hover:shadow-lg"
                        >Kontakt</Link
                    >
                </nav>
                <!-- Mobile Menu Button sichtbar unterhalb xl -->
                <button
                    class="text-gray-900 xl:hidden"
                    @click="toggleMobileMenu"
                    aria-label="Menü öffnen/schließen"
                >
                    <svg
                        class="w-6 h-6"
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
                >
                    <ResponsiveNavLink
                        href="/leistungen"
                        class="font-bold text-gray-900 transition-colors hover:text-teal-600"
                        >Projects</ResponsiveNavLink
                    >
                    <ResponsiveNavLink
                        href="/leistungen"
                        class="font-bold text-gray-900 transition-colors hover:text-teal-600"
                        >Leistungen</ResponsiveNavLink
                    >
                    <ResponsiveNavLink
                        href="/referenzen"
                        class="font-bold text-gray-900 transition-colors hover:text-teal-600"
                        >Referenzen</ResponsiveNavLink
                    >
                    <button
                        @click="showBookingModal = true"
                        class="px-4 py-2 text-white transition rounded-lg bg-gradient-to-r from-teal-600 to-black hover:shadow-lg"
                    >
                        Termin sofort buchen
                    </button>
                </nav>
            </div>

            <!-- Mobile Navigation -->
            <Transition name="slide-fade">
                <nav
                    v-if="mobileMenuOpen"
                    class="fixed inset-0 z-50 flex flex-col px-6 py-8 bg-white xl:hidden"
                    role="dialog"
                    aria-label="Hauptmenü"
                >
                    <div class="flex items-center justify-between mb-6">
                        <Link href="/" aria-label="Zur Startseite">
                            <ApplicationLogo2 class="h-12" />
                        </Link>
                        <button
                            @click="toggleMobileMenu"
                            class="text-gray-700 hover:text-teal-600"
                            aria-label="Menü schließen"
                            aria-expanded="true"
                        >
                            <svg
                                class="w-6 h-6"
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

                    <ul class="space-y-4 text-lg font-semibold text-gray-900">
                        <li>
                            <NavLink
                                href="/technologien"
                                label="Technologies"
                                class="block hover:text-teal-600"
                                >Technologies</NavLink
                            >
                        </li>
                        <li>
                            <NavLink
                                href="/glasfaserbau"
                                label="Glasfaserbau"
                                class="block hover:text-teal-600"
                                >Glasfaserbau</NavLink
                            >
                        </li>
                        <li>
                            <NavLink
                                href="/referenzen"
                                label="Referenzen"
                                class="block hover:text-teal-600"
                                >Referenzen</NavLink
                            >
                        </li>
                        <li>
                            <NavLink
                                href="/inprogress"
                                label="History"
                                class="block hover:text-teal-600"
                                >History</NavLink
                            >
                        </li>
                        <li>
                            <NavLink
                                href="/in-arbeit"
                                label="Projects"
                                class="block hover:text-teal-600"
                                >Projects</NavLink
                            >
                        </li>
                        <li>
                            <NavLink
                                href="/kontakt"
                                label="Kontakt"
                                class="block hover:text-teal-600"
                                >Kontakt</NavLink
                            >
                        </li>
                    </ul>

                    <div class="mt-10">
                        <button
                            @click="showBookingModal = true"
                            class="px-4 py-2 text-white transition rounded-lg bg-gradient-to-r from-teal-600 to-black hover:shadow-lg"
                        >
                            Termin sofort buchen
                        </button>
                    </div>
                </nav>
            </Transition>
            <BookingModal
                v-if="showBookingModal"
                :open="true"
                @close="showBookingModal = false"
                @typeSelected="handleMeetingType"
            />
        </div>

        <header
            v-if="$slots.header"
            class="relative w-full overflow-hidden rounded-t-lg shadow-xl h-96"
        >
            <!-- Bild ersetzt das CSS-Background -->
            <img
                :src="headerBackgroundImage"
                alt="Glasfaser Tiefbau"
                width="1920"
                height="800"
                fetchpriority="high"
                class="absolute inset-0 object-cover w-full h-full"
            />

            <!-- Overlay -->
            <div class="absolute inset-0 bg-black/10 backdrop-blur-sm"></div>

            <!-- Header-Inhalt -->
            <div
                class="relative z-10 flex flex-col items-center justify-center h-full px-4 text-center text-white"
            >
                <slot name="header" />
            </div>
        </header>

        <!--Original <header
            v-if="$slots.header"
            :style="{ backgroundImage: `url(${headerBackgroundImage})` }"
            class="relative w-full bg-center bg-cover shadow-xl h-96 rounded-xl"
            alt="Header background"
        >
            <div class="absolute inset-0 bg-black/10 backdrop-blur-sm"></div>
            <div
                class="relative z-10 flex flex-col items-center justify-center h-full px-4 text-center text-white"
            >
                <slot name="header" />
            </div>
        </header> -->
        <main>
            <slot />
        </main>
        <MobileNav v-if="isMobile" />

        <Footer />
    </div>
</template>

<script setup>
import { Head, usePage, Link, router } from "@inertiajs/vue3";
import Footer from "@/Components/Footer.vue";
import ApplicationLogo2 from "@/Components/ApplicationLogo2.vue";
import NavLink from "@/Components/NavLink.vue";
import ResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";
import { computed, ref } from "vue";
import MobileNav from "@/Components/MobileNav.vue";
import BookingModal from "@/Components/BookingModal.vue";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";

const props = defineProps({
    title: String,
    user: Object,
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
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
});

const showBookingModal = ref(false);

const handleMeetingType = (type) => {
    showBookingModal.value = false;
    router.visit(`/buchen?type=${type}`);
};

const page = usePage();
const canonicalUrl = computed(() => {
    const currentPath = page.url.replace(/\?.*$/, ""); // Strip query
    return `https://www.antasus.de${currentPath}`;
});

const localBusinessJsonLd = {
    "@context": "https://schema.org",
    "@type": "LocalBusiness",
    name: "Antasus Infra",
    url: "https://www.antasus.de",
    logo: "https://www.antasus.de/logo.png",
    image: "https://www.antasus.de/images/favicon.svg",
    description:
        "Antasus Infra ist Ihr Partner für professionelle Glasfaserprojekte – vom Hausanschluss bis zur Projektdokumentation.",
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

const mobileMenuOpen = ref(false);

function toggleMobileMenu() {
    mobileMenuOpen.value = !mobileMenuOpen.value;
}
const isMobile = computed(() => window.innerWidth <= 768);

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
