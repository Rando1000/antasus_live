<template>
    <div class="container px-4 mx-auto my-auto">
        <div
            class="flex items-center justify-between min-h-[5rem] md:min-h-[9rem]"
        >
            <!-- Logo optimiert auf alle Größen -->
            <Link href="/" class="flex items-center">
                <ApplicationLogo
                    class="w-auto h-24 sm:h-28 md:h-32 lg:h-36 xl:h-40 2xl:h-48"
                />
            </Link>

            <!-- Desktop Navigation -->
            <nav
                v-if="$page.url !== '/kontakt'"
                class="items-center hidden space-x-6 lg:space-x-8 xl:space-x-10 2xl:space-x-12 md:flex"
            >
                <NavLink
                    href="/technologien"
                    label="Technologies"
                    class="hidden font-bold text-gray-900 transition-colors hover:text-teal-600 xl:inline"
                ></NavLink>
                <NavLink
                    href="/glasfaserbau"
                    label="Glasfaserbau"
                    class="hidden font-bold text-gray-900 transition-colors hover:text-teal-600 xl:inline"
                ></NavLink>
                <NavLink
                    href="/leistungen"
                    label="Dienstleistungen"
                    class="text-2xl font-extrabold text-gray-900 transition-colors hover:text-teal-600"
                ></NavLink>
                <NavLink
                    href="/referenzen"
                    label="Referenzen"
                    class="hidden font-bold text-gray-900 transition-colors hover:text-teal-600 xl:inline"
                ></NavLink>
                <NavLink
                    href="/inprogress"
                    label="History"
                    class="hidden font-bold text-gray-900 transition-colors hover:text-teal-600 xl:inline"
                ></NavLink>
                <NavLink
                    href="/in-arbeit"
                    label="Projects"
                    class="hidden font-bold text-gray-900 transition-colors hover:text-teal-600 xl:inline"
                ></NavLink>

                <button
                    @click="showBookingModal = true"
                    class="px-4 py-2 text-white transition rounded-lg bg-gradient-to-r from-teal-600 to-black hover:shadow-lg"
                >
                    Termin sofort buchen
                </button>
                <BookingModal
                    v-if="showBookingModal"
                    :open="true"
                    @close="showBookingModal = false"
                    @typeSelected="handleMeetingType"
                />
                <Link
                    v-if="$page.url !== '/kontakt'"
                    href="/kontakt"
                    class="px-4 py-2 text-white transition-all rounded-lg bg-gradient-to-r from-teal-600 to-indigo-600 hover:shadow-lg"
                >
                    Kontakt
                </Link>
            </nav>

            <!-- Kontakt-Seite Navigation -->
            <nav
                v-if="$page.url === '/kontakt'"
                class="items-center hidden space-x-6 lg:space-x-8 xl:space-x-10 2xl:space-x-12 md:flex"
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
                <button
                    @click="showBookingModal = true"
                    class="px-4 py-2 text-white transition rounded-lg bg-gradient-to-r from-teal-600 to-black hover:shadow-lg"
                >
                    Termin sofort buchen
                </button>
                <BookingModal
                    v-if="showBookingModal"
                    :open="true"
                    @close="showBookingModal = false"
                    @typeSelected="handleMeetingType"
                />
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

        <!-- Mobile Navigation -->
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
                            href="/leistungen"
                            label="Dienstleistungen"
                            class="block hover:text-teal-600"
                            >Dienstleistungen</NavLink
                        >
                    </li>
                    <li>
                        <NavLink
                            href="/leistungen"
                            label="Projects"
                            class="block hover:text-teal-600"
                            >Projects</NavLink
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
                            >History</NavLink
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
                    <button
                        @click="showBookingModal = true"
                        class="px-4 py-2 text-white transition rounded-lg bg-gradient-to-r from-teal-600 to-black hover:shadow-lg"
                    >
                        Termin sofort buchen
                    </button>
                    <BookingModal
                        v-if="showBookingModal"
                        :open="true"
                        @close="showBookingModal = false"
                        @typeSelected="handleMeetingType"
                    />
                </div>
            </nav>
        </Transition>
    </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from "vue";
import { Link } from "@inertiajs/vue3";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import ApplicationLogo2 from "@/Components/ApplicationLogo2.vue";
import NavLink from "@/Components/NavLink.vue";
import ResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";
import BookingModal from "@/Components/BookingModal.vue";

const showBookingModal = ref(false);
const mobileMenuOpen = ref(false);
const isNarrow = ref(false);

function toggleMobileMenu() {
    mobileMenuOpen.value = !mobileMenuOpen.value;
}

function handleMeetingType(type) {
    showBookingModal.value = false;
    window.location.href = `/buchen?type=${type}`;
}

function updateIsNarrow() {
    const width = window.innerWidth;
    const container = document.querySelector(".container");
    const nav = container?.querySelector("nav");
    const kontakt = container?.querySelector('a[href="/kontakt"]');
    if (nav && kontakt) {
        const kontaktRight = kontakt.getBoundingClientRect().right;
        const navRight = nav.getBoundingClientRect().right;
        isNarrow.value = navRight > kontaktRight;
    }
}

onMounted(() => {
    updateIsNarrow();
    window.addEventListener("resize", updateIsNarrow);
});

onUnmounted(() => {
    window.removeEventListener("resize", updateIsNarrow);
});
</script>
