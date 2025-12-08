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
        id="bg"
    >
        <!-- Header + Navigation -->
        <header
            class="sticky top-0 z-50 border-b shadow bg-white/80 dark:bg-antasus-dark/80 backdrop-blur-md border-antasus-neutral dark:border-antasus-dark-border nav-snow"
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
                        class="text-xl font-bold transition-colors holiday-nav-link hover:text-antasus-primary dark:hover:text-antasus-primary"
                    />
                    <NavLink
                        href="/glasfaserbau"
                        label="Glasfaserbau"
                        class="text-xl font-bold transition-colors holiday-nav-link hover:text-antasus-primary dark:hover:text-antasus-primary"
                    />
                    <NavLink
                        href="/leistungen"
                        label="Dienstleistungen"
                        class="text-2xl font-extrabold transition-colors holiday-nav-link holiday-nav-link-highlight hover:text-antasus-primary dark:hover:text-antasus-primary"
                    />
                    <NavLink
                        href="/referenzen"
                        label="Referenzen"
                        class="text-xl font-bold transition-colors holiday-nav-link hover:text-antasus-primary dark:hover:text-antasus-primary"
                    />
                    <NavLink
                        href="/ratgeber"
                        label="Glasfaser Ratgeber"
                        class="text-xl font-bold transition-colors holiday-nav-link hover:text-antasus-primary dark:hover:text-antasus-primary"
                    />
                    <NavLink
                        href="/inprogress"
                        label="History"
                        class="text-xl font-bold transition-colors holiday-nav-link hover:text-antasus-primary dark:hover:text-antasus-primary"
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
                        class="text-2xl font-extrabold text-gray-900 transition-colors holiday-nav-link holiday-nav-link-highlight hover:text-teal-600"
                    />
                    <button
                        @click="showBookingModal = true"
                        class="px-4 py-2 text-white transition rounded-lg bg-gradient-to-r from-antasus-primary to-antasus-black hover:shadow-lg focus-visible:ring-2 focus-visible:ring-antasus-primary holiday-cta-main"
                        aria-label="Jetzt Termin buchen"
                    >
                        Termin sofort buchen
                    </button>
                    <Link
                        href="/kontakt"
                        class="px-4 py-2 text-white transition rounded-lg bg-gradient-to-r from-antasus-primary to-antasus-indigo hover:shadow-lg focus-visible:ring-2 focus-visible:ring-antasus-primary holiday-cta-secondary"
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
                        class="text-2xl font-extrabold transition-colors holiday-nav-link hover:text-antasus-primary dark:hover:text-antasus-primary"
                    />
                    <NavLink
                        href="/referenzen"
                        label="Referenzen"
                        class="text-xl font-bold transition-colors holiday-nav-link hover:text-antasus-primary dark:hover:text-antasus-primary"
                    />
                    <NavLink
                        href="/ratgeber"
                        label="Glasfaser Ratgeber"
                        class="text-xl font-bold transition-colors holiday-nav-link hover:text-antasus-primary dark:hover:text-antasus-primary"
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
                            href="/leistungen"
                            label="Dienstleistungen"
                            class="text-2xl font-extrabold transition-colors hover:text-antasus-primary dark:hover:text-antasus-primary"
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
    <CookieConsent />
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
import CookieConsent from "@/Components/CookieConsent.vue";

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
    const bg = document.getElementById("bg");
    if (bg) {
        for (let i = 0; i < 80; i++) {
            const snow = document.createElement("div");
            snow.classList.add("snow");

            // Zufällige Startposition
            snow.style.left = Math.random() * 100 + "vw";
            snow.style.top = -(Math.random() * 100) + "px";

            // Unterschiedliche Größe
            const size = Math.random() * 5 + 3; // 3–8 px
            snow.style.width = size + "px";
            snow.style.height = size + "px";

            // Unterschiedliche Dauer
            snow.style.animationDuration = 6 + Math.random() * 6 + "s";

            // Leichte horizontale Drift
            snow.style.animationDelay = Math.random() * 5 + "s";

            bg.appendChild(snow);
        }
    }

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
/* Gesamt-Navi: dezenter weihnachtlicher Glow + Glas */
.holiday-nav {
    position: sticky;
    top: 0;
    backdrop-filter: blur(18px) saturate(160%);
    -webkit-backdrop-filter: blur(18px) saturate(160%);
    background-image: linear-gradient(
        to right,
        rgba(0, 253, 207, 0.18),
        rgba(79, 70, 229, 0.16),
        rgba(0, 0, 0, 0.35)
    );
    background-blend-mode: soft-light;
}

.dark .holiday-nav {
    background-image: linear-gradient(
        to right,
        rgba(0, 253, 207, 0.2),
        rgba(15, 23, 42, 0.9),
        rgba(0, 0, 0, 0.9)
    );
}

/* Kleine "Lichterkette" im Header */
.holiday-nav::after {
    content: "";
    position: absolute;
    inset-inline: 0.5rem;
    top: 0.1rem;
    height: 2px;
    pointer-events: none;
    background-image: radial-gradient(circle, #ffffff 0, transparent 55%),
        radial-gradient(circle, #00fdcf 0, transparent 55%),
        radial-gradient(circle, #facc15 0, transparent 55%),
        radial-gradient(circle, #4f46e5 0, transparent 55%);
    background-size: 18px 2px, 28px 2px, 22px 2px, 32px 2px;
    background-position: 0 0, 25% 0, 55% 0, 85% 0;
    opacity: 0.6;
    mix-blend-mode: screen;
}

/* Navi-Links mit Unterstrich-Gradient */
.holiday-nav-link {
    position: relative;
}

.holiday-nav-link::after {
    content: "";
    position: absolute;
    left: 50%;
    bottom: -0.35rem;
    width: 0;
    height: 2px;
    border-radius: 9999px;
    background-image: linear-gradient(to right, #00fdcf, #4f46e5);
    opacity: 0;
    transform: translateX(-50%);
    transition: width 0.22s ease-out, opacity 0.22s ease-out;
}

/* Hover + aktive / hervorgehobene Links */
.holiday-nav-link:hover::after,
.holiday-nav-link-highlight::after {
    width: 80%;
    opacity: 1;
}

/* Haupt-CTA: weihnachtlicher Glas-/Glow-Effekt */
.holiday-cta-main {
    position: relative;
    overflow: hidden;
    box-shadow: 0 0 0 1px rgba(255, 255, 255, 0.25),
        0 10px 30px rgba(0, 0, 0, 0.45), 0 0 25px rgba(0, 253, 207, 0.35);
}

.holiday-cta-main::before {
    content: "";
    position: absolute;
    inset: 0;
    background: radial-gradient(
        circle at 0 0,
        rgba(255, 255, 255, 0.45),
        transparent 55%
    );
    mix-blend-mode: screen;
    opacity: 0;
    transition: opacity 0.25s ease-out;
}

.holiday-cta-main:hover::before {
    opacity: 1;
}

/* Sekundäre CTA: etwas subtiler */
.holiday-cta-secondary {
    position: relative;
    overflow: hidden;
    box-shadow: 0 0 0 1px rgba(255, 255, 255, 0.18),
        0 6px 20px rgba(15, 23, 42, 0.5);
}

.holiday-cta-secondary::before {
    content: "";
    position: absolute;
    inset: 0;
    background: radial-gradient(
        circle at 100% 0,
        rgba(255, 255, 255, 0.28),
        transparent 60%
    );
    mix-blend-mode: screen;
    opacity: 0;
    transition: opacity 0.25s ease-out;
}

.holiday-cta-secondary:hover::before {
    opacity: 1;
}

.snow {
    position: absolute;
    width: 6px;
    height: 6px;
    background: white;
    border-radius: 50%;
    opacity: 0.9;
    top: -10px;
    left: 50%;
    animation: fall 8s linear infinite;
}

/* ❄ Animations-Loop */
@keyframes fall {
    0% {
        transform: translateX(0) translateY(0);
        opacity: 1;
    }
    100% {
        transform: translateX(-50px) translateY(120vh);
        opacity: 0;
    }
}

#bg {
    position: relative;
    overflow: hidden;
}
</style>
<style>
/* Container, in den die Schneeflocken eingefügt werden */
#bg {
    position: relative;
    overflow: hidden;
}

/* Sichtbare Schneeflocken mit Animation */
.snow {
    position: fixed; /* über der Seite „schwebend“ */
    top: -10px;
    width: 6px;
    height: 6px;
    border-radius: 9999px;
    background-color: rgba(255, 255, 255, 0.9);
    box-shadow: 0 0 8px rgba(255, 255, 255, 0.9);
    opacity: 0.9;
    pointer-events: none;
    animation-name: snow-fall;
    animation-timing-function: linear;
    animation-iteration-count: infinite;
    z-index: 1000;
}

/* Fall-Animation */
@keyframes snow-fall {
    0% {
        transform: translate3d(0, -10vh, 0);
        opacity: 1;
    }
    100% {
        transform: translate3d(0, 120vh, 0);
        opacity: 0;
    }
}
</style>
