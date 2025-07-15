<template>
    <footer
        class="bg-gray-900 text-white relative z-10 border-t border-[#23272f]"
        aria-label="Footer"
    >
        <div
            class="grid gap-8 px-4 py-12 mx-auto max-w-7xl sm:grid-cols-2 lg:grid-cols-5"
        >
            <!-- Branding -->
            <div class="space-y-4">
                <Link
                    href="/"
                    aria-label="Startseite ANTASUS Infra"
                    class="flex items-center gap-2 px-4 py-2 text-2xl font-extrabold tracking-tight transition bg-white shadow-lg rounded-xl ring-1 ring-white/10 backdrop-blur hover:bg-teal-900/20 focus:outline-none focus-visible:ring-2 focus-visible:ring-teal-400"
                >
                    <ApplicationLogo2 class="w-12 h-12" />
                    <span class="text-antasus-black">
                        ANTASUS <span class="text-teal-400">Infra</span>
                    </span>
                </Link>
                <p class="max-w-xs text-sm text-gray-400">
                    Ihr Partner für Glasfaserinfrastruktur und
                    Zukunftstechnologie.
                </p>
                <nav aria-label="Social Media" class="flex mt-2 space-x-3">
                    <!-- LinkedIn -->
                    <a
                        href="https://linkedin.com/"
                        target="_blank"
                        rel="noopener"
                        aria-label="LinkedIn"
                        class="text-gray-400 transition-colors rounded group hover:text-teal-400 focus:outline-none focus-visible:ring-2 focus-visible:ring-teal-400"
                    >
                        <svg
                            class="w-6 h-6"
                            fill="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <title>LinkedIn</title>
                            <path
                                d="M19 0h-14c-2.76 0-5 2.24-5 5v14c0 2.76 2.24 5 5 5h14c2.76 0 5-2.24 5-5v-14c0-2.76-2.24-5-5-5zm-11.7 20h-3.3v-10h3.3v10zm-1.65-11.5c-1.07 0-1.95-.88-1.95-1.95 0-1.07.88-1.95 1.95-1.95s1.95.88 1.95 1.95c0 1.07-.88 1.95-1.95 1.95zm14.15 11.5h-3.3v-5.6c0-1.33-.03-3.05-1.86-3.05-1.87 0-2.16 1.46-2.16 2.97v5.68h-3.3v-10h3.17v1.36h.05c.44-.83 1.52-1.7 3.13-1.7 3.35 0 3.97 2.2 3.97 5.07v5.27z"
                            />
                        </svg>
                    </a>
                    <!-- Twitter/X -->
                    <a
                        href="https://twitter.com/"
                        target="_blank"
                        rel="noopener"
                        aria-label="X / Twitter"
                        class="text-gray-400 transition-colors rounded group hover:text-teal-400 focus:outline-none focus-visible:ring-2 focus-visible:ring-teal-400"
                    >
                        <svg
                            class="w-6 h-6"
                            fill="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <title>Twitter/X</title>
                            <path
                                d="M17.53 2.47c.32.32.32.84 0 1.17l-5.96 5.96 5.96 5.96c.32.32.32.84 0 1.17-.16.16-.36.23-.58.23s-.42-.08-.58-.23l-5.96-5.96-5.96 5.96c-.32.32-.84.32-1.17 0-.32-.32-.32-.84 0-1.17l5.96-5.96-5.96-5.96c-.32-.32-.32-.84 0-1.17s.84-.32 1.17 0l5.96 5.96 5.96-5.96c.32-.32.84-.32 1.17 0z"
                            />
                        </svg>
                    </a>
                </nav>
            </div>

            <!-- Rechtliches -->
            <div>
                <h3 class="footer-title">Rechtliches</h3>
                <ul class="footer-links">
                    <li>
                        <Link href="/impressum" class="footer-link"
                            >Impressum</Link
                        >
                    </li>
                    <li>
                        <Link href="/datenschutz" class="footer-link"
                            >Datenschutz</Link
                        >
                    </li>
                    <li>
                        <Link href="/agb" class="footer-link">AGB</Link>
                    </li>
                </ul>
            </div>

            <!-- Links -->
            <div>
                <h3 class="footer-title">Links</h3>
                <ul class="footer-links">
                    <li>
                        <Link href="/ratgeber" class="footer-link"
                            >Ratgeber</Link
                        >
                    </li>
                    <li>
                        <Link href="/glasfaserbau" class="footer-link"
                            >Glasfaserbau</Link
                        >
                    </li>
                    <li>
                        <Link href="/technologien" class="footer-link"
                            >Technologien</Link
                        >
                    </li>
                    <li>
                        <Link href="/impressum" class="footer-link"
                            >Über uns</Link
                        >
                    </li>
                </ul>
            </div>

            <!-- Kontakt -->
            <div>
                <h3 class="footer-title">Kontakt</h3>
                <address class="not-italic space-y-1.5 text-gray-400">
                    <p>Norrenbergstraße 122<br />42289 Wuppertal</p>
                    <p>
                        <a href="tel:+4920242988411" class="footer-link"
                            >Telefon: +49 202 42988411</a
                        >
                    </p>
                    <p>
                        <a href="tel:+4917624757616" class="footer-link"
                            >Mobil: +49 176 24757616</a
                        >
                    </p>
                    <p>
                        <a href="mailto:info@antasus.de" class="footer-link"
                            >info@antasus.de</a
                        >
                    </p>
                </address>
            </div>

            <!-- Newsletter -->
            <div>
                <h3 class="footer-title">Updates</h3>
                <p class="mb-4 text-gray-400">Bleiben Sie informiert!</p>
                <form class="flex group" autocomplete="off">
                    <input
                        type="email"
                        placeholder="Ihre E-Mail"
                        aria-label="E-Mail Adresse für Updates"
                        required
                        class="w-full px-4 py-2 text-gray-900 rounded-l bg-white/80 focus:outline-none focus:ring-2 focus:ring-teal-400"
                    />
                    <button
                        type="submit"
                        class="px-4 py-2 text-white transition-all duration-200 rounded-r bg-gradient-to-br from-teal-400 to-indigo-800 hover:scale-105 hover:from-teal-500 hover:to-indigo-900 focus:outline-none focus-visible:ring-2 focus-visible:ring-teal-400"
                        aria-label="Newsletter abonnieren"
                    >
                        <span class="sr-only">Abschicken</span>
                        <!-- Pfeil-Icon -->
                        <svg
                            class="w-5 h-5"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M17 8l4 4m0 0l-4 4m4-4H3"
                            />
                        </svg>
                    </button>
                </form>
                <!-- Cookie Einstellungen Button -->
                <div class="mt-5">
                    <button
                        type="button"
                        @click="openConsentBanner"
                        class="flex items-center justify-center w-full gap-2 px-3 py-2 mt-2 text-sm font-semibold text-gray-900 transition rounded-lg shadow outline-none bg-white/80 dark:bg-slate-800 dark:text-teal-300 hover:bg-teal-100 dark:hover:bg-teal-700 hover:text-teal-900 focus-visible:ring-2 focus-visible:ring-teal-400"
                        aria-label="Cookie-Einstellungen ändern"
                    >
                        <svg
                            class="w-5 h-5"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            viewBox="0 0 24 24"
                            aria-hidden="true"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M9.75 3.75v1.5m4.5-1.5v1.5m-7.204 2.954l-1.06 1.06m13.019-1.06l-1.06 1.06m-10.43 7.036h-1.5m15 0h-1.5m-2.955 4.5l1.06 1.06m-13.02-1.06l1.06 1.06M12 8.25a3.75 3.75 0 100 7.5 3.75 3.75 0 000-7.5z"
                            />
                        </svg>
                        Cookie-Einstellungen ändern
                    </button>
                </div>
            </div>
        </div>

        <!-- Copyright -->
        <div
            class="py-6 text-sm text-center text-teal-300 border-t border-gray-800"
        >
            <p>
                &copy; {{ new Date().getFullYear() }} ANTASUS Infra. Alle Rechte
                vorbehalten.
            </p>
        </div>
    </footer>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import ApplicationLogo2 from "@/Components/ApplicationLogo2.vue";
import { useConsentStore } from "@/stores/consent";
const store = useConsentStore();

function openConsentBanner() {
    store.resetConsent(); // Banner wird sofort wieder angezeigt
}
</script>

<style scoped>
.footer-title {
    @apply mb-4 text-sm font-semibold tracking-wider text-gray-300 uppercase;
    letter-spacing: 0.08em;
}
.footer-links {
    @apply space-y-3 text-gray-400;
    list-style: none;
    padding: 0;
    margin: 0;
}
.footer-link {
    @apply transition-colors hover:text-teal-300 focus:outline-none focus-visible:text-teal-200;
    position: relative;
}
.footer-link:focus-visible {
    outline: 2px solid #00fdcf;
    outline-offset: 2px;
    border-radius: 0.25rem;
}
.footer-link:after {
    content: "";
    display: block;
    width: 0;
    height: 2px;
    background: linear-gradient(90deg, #00fdcf 0, #008090 100%);
    transition: width 0.2s;
    position: absolute;
    left: 0;
    bottom: -2px;
}
.footer-link:hover:after,
.footer-link:focus-visible:after {
    width: 100%;
}
@media (max-width: 640px) {
    .footer-title {
        font-size: 0.98rem;
    }
    .calendar-legend {
        gap: 1.2rem;
    }
    .footer-links {
        font-size: 0.99rem;
    }
    .footer-link {
        padding-bottom: 0.25rem;
    }
}
</style>
