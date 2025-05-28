<template>
    <footer class="text-white bg-gray-900">
        <div
            class="grid gap-8 px-6 py-12 mx-auto max-w-7xl sm:grid-cols-2 lg:grid-cols-4"
        >
            <!-- Branding -->
            <div class="space-y-4">
                <Link
                    href="/"
                    class="text-2xl font-bold text-white transition-colors hover:text-indigo-400"
                >
                    ANTASUS <span class="text-teal-400">Infra</span>
                </Link>
                <p class="text-sm text-gray-400">
                    Ihr Partner für Glasfaserinfrastruktur
                </p>
                <div class="flex space-x-4">
                    <a
                        href="#"
                        class="text-gray-400 transition-colors hover:text-white"
                    >
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a
                        href="#"
                        class="text-gray-400 transition-colors hover:text-white"
                    >
                        <i class="fab fa-x-twitter"></i>
                    </a>
                </div>
            </div>

            <!-- Rechtliches -->
            <div>
                <h3
                    class="mb-4 text-sm font-semibold tracking-wider text-gray-300 uppercase"
                >
                    Rechtliches
                </h3>
                <ul class="space-y-3 text-gray-400">
                    <li>
                        <Link
                            href="/impressum"
                            class="transition-colors hover:text-teal-300"
                            >Impressum</Link
                        >
                    </li>
                    <li>
                        <Link
                            href="/datenschutz"
                            class="transition-colors hover:text-teal-300"
                            >Datenschutz</Link
                        >
                    </li>
                    <li>
                        <Link
                            href="/agb"
                            class="transition-colors hover:text-teal-300"
                            >AGB</Link
                        >
                    </li>
                </ul>
            </div>

            <!-- Kontakt -->
            <div>
                <h3
                    class="mb-4 text-sm font-semibold tracking-wider text-gray-300 uppercase"
                >
                    Kontakt
                </h3>
                <address class="space-y-1.5 not-italic text-gray-400">
                    <p>Norrenbergstraße 122<br />42289 Wuppertal</p>
                    <p>
                        <a href="+49 202 42988411" class="hover:text-teal-300"
                            >Telefon: +49 202 42988411</a
                        >
                    </p>
                    <p>
                        <a href="tel:+4917624757616" class="hover:text-teal-300"
                            >Mobil: +49 176 24757616</a
                        >
                    </p>
                    <p>
                        <a
                            href="mailto:info@antasus.de"
                            class="hover:text-teal-300"
                            >info@antasus.de</a
                        >
                    </p>
                </address>
            </div>

            <!-- Newsletter -->
            <div>
                <h3
                    class="mb-4 text-sm font-semibold tracking-wider text-gray-300 uppercase"
                >
                    Updates
                </h3>
                <p class="mb-4 text-gray-400">Bleiben Sie informiert!</p>
                <form class="flex">
                    <input
                        type="email"
                        placeholder="Ihre E-Mail"
                        class="w-full px-4 py-2 text-gray-900 rounded-l focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    />
                    <button
                        type="submit"
                        class="px-4 py-2 text-white transition-colors bg-teal-400 rounded-r hover:bg-indigo-700"
                    >
                        →
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
