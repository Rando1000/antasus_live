<template>
    <footer
        class="bg-gray-900 text-white relative z-10 border-t border-[#23272f]"
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
                    <a
                        href="https://linkedin.com/"
                        target="_blank"
                        rel="noopener"
                        aria-label="LinkedIn"
                        class="text-gray-400 transition-colors rounded group hover:text-teal-400 focus:outline-none focus-visible:ring-2 focus-visible:ring-teal-400"
                    >
                        <!-- LinkedIn SVG Icon -->
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
                    <a
                        href="https://twitter.com/"
                        target="_blank"
                        rel="noopener"
                        aria-label="X / Twitter"
                        class="text-gray-400 transition-colors rounded group hover:text-teal-400 focus:outline-none focus-visible:ring-2 focus-visible:ring-teal-400"
                    >
                        <!-- X / Twitter SVG Icon -->
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

<!-- <template>
  <footer class="mt-10 text-white bg-gradient-to-b from-teal-500 to-teal-900">
    <div class="relative grid gap-8 px-6 py-12 mx-auto max-w-7xl sm:grid-cols-2 lg:grid-cols-4">
      <div class="absolute inset-0 bg-[url('/path/to/subtle-pattern.png')] opacity-5"></div>
       Branding -->
<!--
      <div class="space-y-4 text-center lg:text-left">
        <h1 class="text-2xl font-bold uppercase">ANTASUS</h1>
        <ApplicationLogo2 class="h-16 mx-auto lg:mx-0" />
        <p class="text-sm text-gray-300">
          Bringing innovation to your garden and beyond.
        </p>
      </div>

       Links Sections -->
<!--
      <div>
        <h2 class="mb-4 text-xl font-semibold uppercase">Company</h2>
        <ul class="space-y-2 text-gray-300">
          <li><a href="#" class="hover:text-[#00fdcf]">About Us</a></li>
          <li><a href="/team" class="hover:text-[#00fdcf]">Team</a></li>
          <li><a href="#" class="hover:text-[#00fdcf]">App</a></li>
        </ul>
      </div>

      <div>
        <h2 class="mb-4 text-xl font-semibold uppercase">Information</h2>
        <ul class="space-y-2 text-gray-300">
          <li><a href="#" class="hover:text-[#00fdcf]">Support</a></li>
          <li><a href="/docs" class="hover:text-[#00fdcf]">Documentation</a></li>
          <li><a href="/faq" class="hover:text-[#00fdcf]">FAQ</a></li>
        </ul>
      </div>

      <div>
        <h2 class="mb-4 text-xl font-semibold uppercase">Legal</h2>
        <ul class="space-y-2 text-gray-300">
          <li><a href="/terms" class="hover:text-[#00fdcf]">Terms & Conditions</a></li>
          <li><a href="/imprint" class="hover:text-[#00fdcf]">Imprint</a></li>
          <li><a href="/privacy" class="hover:text-[#00fdcf]">Privacy</a></li>
        </ul>
         Social Media -->
<!--
        <div class="flex justify-center mt-6 space-x-4 lg:justify-start">
          <a
            href="https://tiktok.com"
            class="w-8 h-8 flex items-center justify-center border border-[#00fdcf] rounded-full hover:bg-[#00fdcf] hover:text-black transition-colors"
            aria-label="tiktok"
          >
            <i class="fab fa-tiktok"></i>
          </a>
          <a
            href="https://instagram.com"
            class="w-8 h-8 flex items-center justify-center border border-[#00fdcf] rounded-full hover:bg-[#00fdcf] hover:text-black transition-colors"
            aria-label="instagram"
          >
            <i class="fab fa-instagram"></i>
          </a>
          <a
            href="https://facebook.com"
            class="w-8 h-8 flex items-center justify-center border border-[#00fdcf] rounded-full hover:bg-[#00fdcf] hover:text-black transition-colors"
            aria-label="Facebook"
          >
            <i class="fab fa-facebook-f"></i>
          </a>
          <a
            href="https://youtube.com"
            class="w-8 h-8 flex items-center justify-center border border-[#00fdcf] rounded-full hover:bg-[#00fdcf] hover:text-black transition-colors"
            aria-label="YouTube"
          >
            <i class="fab fa-youtube"></i>
          </a>
        </div>
      </div>
    </div>

    Footer Bottom -->
<!--
    <div class="py-4 text-sm text-center text-teal-200 border-t border-teal-700">
      <p>&copy; 2025 ANTASUS. All rights reserved.</p>
    </div>
  </footer>
</template>

<script setup>
import { defineAsyncComponent } from 'vue';
const ApplicationLogo2 = defineAsyncComponent(() => import('@/Components/ApplicationLogo2.vue'));
</script> -->
