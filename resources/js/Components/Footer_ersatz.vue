<template>
    <footer class="pt-20 pb-10 text-white bg-gray-900">
        <div class="container px-6 mx-auto">
            <div class="grid grid-cols-1 gap-12 md:grid-cols-4">
                <!-- Logo & Beschreibung -->
                <div class="md:col-span-2">
                    <div class="flex items-center mb-6">
                        <ApplicationLogo class="h-8 mr-3" />
                        <span
                            class="text-xl font-bold text-transparent bg-gradient-to-r from-teal-400 to-indigo-400 bg-clip-text"
                        >
                            ANTASUS INFRA
                        </span>
                    </div>
                    <p class="mb-6 text-gray-400">
                        Ihr Partner für zukunftssichere Glasfaserinfrastrukturen
                        in Deutschland.
                    </p>
                    <div class="flex space-x-4">
                        <a
                            href="#"
                            class="flex items-center justify-center w-10 h-10 transition-colors bg-gray-800 rounded-full hover:bg-teal-600"
                        >
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a
                            href="#"
                            class="flex items-center justify-center w-10 h-10 transition-colors bg-gray-800 rounded-full hover:bg-teal-600"
                        >
                            <i class="fab fa-x-twitter"></i>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h3 class="mb-6 text-lg font-semibold text-white">
                        Navigation
                    </h3>
                    <ul class="space-y-3">
                        <li>
                            <Link
                                href="/leistungen"
                                class="text-gray-400 transition-colors hover:text-teal-400"
                                >Leistungen</Link
                            >
                        </li>
                        <li>
                            <Link
                                href="/referenzen"
                                class="text-gray-400 transition-colors hover:text-teal-400"
                                >Referenzen</Link
                            >
                        </li>
                        <li>
                            <Link
                                href="/team"
                                class="text-gray-400 transition-colors hover:text-teal-400"
                                >Team</Link
                            >
                        </li>
                    </ul>
                </div>

                <!-- Kontakt -->
                <div>
                    <h3 class="mb-6 text-lg font-semibold text-white">
                        Kontakt
                    </h3>
                    <address class="space-y-3 not-italic text-gray-400">
                        <p>Norrenbergstraße 122<br />42289 Wuppertal</p>
                        <p>
                            <a
                                href="tel:+4917624757616"
                                class="transition-colors hover:text-teal-400"
                                >+49 176 24757616</a
                            >
                        </p>
                        <p>
                            <a
                                href="mailto:info@antasus.de"
                                class="transition-colors hover:text-teal-400"
                                >info@antasus.de</a
                            >
                        </p>
                    </address>
                </div>

                <!-- Newsletter -->
                <div>
                    <h3 class="mb-6 text-lg font-semibold text-white">
                        Newsletter
                    </h3>
                    <p class="mb-4 text-gray-400">
                        Bleiben Sie informiert über Neuigkeiten
                    </p>
                    <form class="flex">
                        <input
                            type="email"
                            placeholder="Ihre E-Mail"
                            class="w-full px-4 py-3 text-gray-900 rounded-l focus:outline-none focus:ring-2 focus:ring-teal-500"
                        />
                        <button
                            type="submit"
                            class="px-4 py-3 text-white transition-all rounded-r bg-gradient-to-r from-teal-600 to-indigo-600 hover:shadow-lg"
                        >
                            <i class="fas fa-arrow-right"></i>
                        </button>
                    </form>
                </div>
            </div>

            <div
                class="flex flex-col items-center justify-between pt-8 mt-12 border-t border-gray-800 md:flex-row"
            >
                <p class="mb-4 text-sm text-gray-500 md:mb-0">
                    &copy; {{ new Date().getFullYear() }} ANTASUS Infra. Alle
                    Rechte vorbehalten.
                </p>
                <div class="flex space-x-6">
                    <Link
                        href="/datenschutz"
                        class="text-sm text-gray-500 transition-colors hover:text-teal-400"
                        >Datenschutz</Link
                    >
                    <Link
                        href="/impressum"
                        class="text-sm text-gray-500 transition-colors hover:text-teal-400"
                        >Impressum</Link
                    >
                    <Link
                        href="/agb"
                        class="text-sm text-gray-500 transition-colors hover:text-teal-400"
                        >AGB</Link
                    >
                </div>
            </div>
        </div>
    </footer>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import ApplicationLogo2 from "@/Components/ApplicationLogo2.vue";
</script>
