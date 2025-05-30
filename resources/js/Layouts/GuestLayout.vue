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
    </Head>

    <div class="min-h-screen bg-white">
        <!-- Sticky Header mit Glaseffekt -->

        <div class="container px-4 mx-auto my-auto">
            <div class="flex items-center justify-between h-16 md:h-36">
                <Link href="/" class="flex items-center h-40">
                    <ApplicationLogo2 class="h-36 md:h-80" />
                </Link>

                <nav
                    v-if="$page.url !== '/kontakt'"
                    class="items-center hidden space-x-12 md:flex"
                >
                    <!-- <NavLink
                        href="/History"
                        label="Über Uns"
                        class="font-bold text-gray-900 transition-colors hover:text-teal-600"
                    ></NavLink> -->
                    <NavLink
                        href="/History"
                        label="History"
                        class="font-bold text-gray-900 transition-colors hover:text-teal-600"
                    >
                    </NavLink>
                    <NavLink
                        href="/leistungen"
                        label="Projects"
                        class="font-bold text-gray-900 transition-colors hover:text-teal-600"
                    >
                    </NavLink>
                    <NavLink
                        href="/leistungen"
                        label="Dienstleistungen"
                        class="font-bold text-gray-900 transition-colors hover:text-teal-600"
                    >
                    </NavLink>
                    <NavLink
                        href="/referenzen"
                        label="Referenzen"
                        class="font-bold text-gray-900 transition-colors hover:text-teal-600"
                    >
                    </NavLink>
                    <Link
                        href="/kontakt"
                        class="px-4 py-2 text-white transition-all rounded-lg bg-gradient-to-r from-teal-600 to-black hover:shadow-lg"
                    >
                        Termin sofort buchen
                    </Link>
                    <Link
                        v-if="$page.url !== '/kontakt'"
                        href="/kontakt"
                        class="px-4 py-2 text-white transition-all rounded-lg bg-gradient-to-r from-teal-600 to-indigo-600 hover:shadow-lg"
                    >
                        Kontakt
                    </Link>
                </nav>

                <!-- Kontakt-Seite Navigationsleiste ohne Kontakt Button -->

                <nav
                    v-if="$page.url === '/kontakt'"
                    class="items-center hidden space-x-12 md:flex"
                >
                    <ResponsiveNavLink
                        href="/leistungen"
                        class="font-bold text-gray-900 transition-colors hover:text-teal-600"
                    >
                        Projects
                    </ResponsiveNavLink>
                    <ResponsiveNavLink
                        href="/leistungen"
                        class="font-bold text-gray-900 transition-colors hover:text-teal-600"
                    >
                        Leistungen
                    </ResponsiveNavLink>
                    <ResponsiveNavLink
                        href="/referenzen"
                        class="font-bold text-gray-900 transition-colors hover:text-teal-600"
                    >
                        Referenzen
                    </ResponsiveNavLink>
                    <Link
                        href="/kontakt"
                        class="px-4 py-2 text-white transition-all rounded-lg bg-gradient-to-r from-teal-600 to-black hover:shadow-lg"
                    >
                        Termin sofort buchen
                    </Link>
                </nav>

                <!-- Mobile Menu Button -->
                <button
                    class="text-gray-900 md:hidden"
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
            </div>

            <Transition name="slide-fade">
                <nav
                    v-if="mobileMenuOpen"
                    class="fixed inset-0 z-50 flex flex-col px-6 py-8 bg-white md:hidden"
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
                                href="/leistungen"
                                label="Dienstleistungen"
                                class="block hover:text-teal-600"
                                >Leistungen</NavLink
                            >
                        </li>
                        <li>
                            <NavLink
                                href="/leistungen"
                                label="Projects"
                                class="block hover:text-teal-600"
                                >Leistungen</NavLink
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
                                href="/leistungen"
                                label="History"
                                class="block hover:text-teal-600"
                                >Leistungen</NavLink
                            >
                        </li>
                        <li>
                            <NavLink
                                href="/kontakt"
                                label="kontakt"
                                class="block hover:text-teal-600"
                                >Kontakt</NavLink
                            >
                        </li>
                    </ul>

                    <div class="mt-10">
                        <Link
                            href="/kontakt"
                            class="block w-full px-6 py-3 text-center text-white rounded-lg shadow bg-gradient-to-r from-teal-600 to-black hover:opacity-90"
                        >
                            Termin sofort buchen
                        </Link>
                    </div>
                </nav>
            </Transition>
        </div>
        <!-- <header class="relative overflow-hidden shadow-xl h-96 rounded-xl">
            <img
                src="/images/leistungheader.webp"
                alt="Header Bild"
                class="absolute inset-0 object-cover w-full h-full"
            />
            <div class="absolute inset-0 bg-black/30 backdrop-blur-sm"></div>

            <div
                class="relative z-10 flex flex-col items-center justify-center h-full px-4 text-center text-white"
            >
                <slot name="header" />
            </div>
        </header> -->

        <header
            v-if="$slots.header"
            class="relative w-full overflow-hidden shadow-xl h-96 rounded-xl"
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
import { Head, usePage, Link } from "@inertiajs/vue3";
import Footer from "@/Components/Footer.vue";
import ApplicationLogo2 from "@/Components/ApplicationLogo2.vue";
import NavLink from "@/Components/NavLink.vue";
import ResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";
import { computed, ref } from "vue";
import MobileNav from "@/Components/MobileNav.vue";
import { useHead } from "@vueuse/head";
import BottomNav from "@/Components/BottomNav.vue";

const page = usePage();
const canonicalUrl = computed(() => {
    const currentPath = page.url.replace(/\?.*$/, ""); // Strip query
    return `https://www.antasus.de${currentPath}`;
});

useHead({
    script: [
        {
            type: "application/ld+json",
            children: JSON.stringify({
                "@context": "https://schema.org",
                "@type": "LocalBusiness",
                name: "Antasus Infra",
                url: "https://www.antasus.de",
                logo: "https://www.antasus.de/logo.png",
                image: "https://www.antasus.de/images/Header_welcome.webp",
                description:
                    "Antasus Infra ist Ihr Partner für professionelle Glasfaserprojekte – vom Hausanschluss bis zur Projektdokumentation.",
                address: {
                    "@type": "PostalAddress",
                    streetAddress: "Norrenbergstraße 122",
                    addressLocality: "Wuppertal",
                    postalCode: "42289",
                    addressCountry: "DE",
                },
                telephone: "+49 202 42988411",
                email: "info@antasus.de",
            }),
        },
    ],
});

const mobileMenuOpen = ref(false);

function toggleMobileMenu() {
    mobileMenuOpen.value = !mobileMenuOpen.value;
}
const isMobile = computed(() => window.innerWidth <= 768);
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
                "default",
            ].includes(value),
    },
});

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
