<template>
    <footer class="text-white bg-gray-900">
        <div
            class="grid gap-8 px-6 py-12 mx-auto max-w-7xl sm:grid-cols-2 lg:grid-cols-5"
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

            <div>
                <h3
                    class="mb-4 text-sm font-semibold tracking-wider text-gray-300 uppercase"
                >
                    Links
                </h3>
                <ul class="space-y-3 text-gray-400">
                    <li>
                        <Link
                            href="/ratgeber"
                            class="transition-colors hover:text-teal-300"
                            >Ratgeber</Link
                        >
                    </li>
                    <li>
                        <Link
                            href="/glasfaserbau"
                            class="transition-colors hover:text-teal-300"
                            >Glasfaserbau</Link
                        >
                    </li>
                    <li>
                        <Link
                            href="/technologien"
                            class="transition-colors hover:text-teal-300"
                            >Technologies</Link
                        >
                    </li>
                    <li>
                        <Link
                            href="/impressum"
                            class="transition-colors hover:text-teal-300"
                            >About Us</Link
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
                    <p>Hohenstein 150<br />42283 Wuppertal</p>
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
