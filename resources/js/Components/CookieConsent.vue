<template>
    <transition name="fade">
        <div
            v-if="shouldShow"
            class="fixed z-[100] inset-0 flex items-end opacity-95 dark:opacity-85 justify-center pointer-events-none"
        >
            <div
                class="flex flex-col w-full max-w-3xl gap-4 p-6 mx-4 mb-8 border border-teal-300 shadow-xl pointer-events-auto bg-white/95 dark:bg-black/95 dark:border-teal-800 rounded-2xl animate-pop-up"
                role="dialog"
                aria-modal="true"
                aria-label="Cookie-Einwilligung"
            >
                <div class="flex items-center gap-4 mb-1">
                    <img src="/favicon.svg" alt="ANTASUS" class="w-8 h-8" />
                    <h2
                        class="text-lg font-semibold text-black dark:text-white"
                    >
                        Datenschutzeinstellungen
                    </h2>
                </div>
                <p class="text-sm text-gray-700 dark:text-gray-300">
                    Wir nutzen Cookies und Technologien, um Ihnen ein optimales
                    Erlebnis zu bieten. Essenzielle Cookies sind notwendig;
                    Statistik- & Marketing-Cookies (z.B. Analytics) werden nur
                    mit Ihrer Zustimmung geladen.
                </p>
                <div class="flex flex-wrap gap-2 mt-2">
                    <button
                        @click="acceptAll"
                        class="px-5 py-2 font-medium text-white transition rounded-lg shadow bg-gradient-to-r from-teal-500 to-indigo-600 hover:scale-105"
                    >
                        Alle akzeptieren
                    </button>
                    <button
                        @click="decline"
                        class="px-5 py-2 font-medium text-black transition border border-teal-300 rounded-lg dark:text-white bg-white/70 dark:bg-slate-700 dark:border-teal-600 hover:bg-teal-50 dark:hover:bg-teal-700"
                    >
                        Nur Essenzielle
                    </button>
                    <button
                        @click="showDetails = !showDetails"
                        class="px-5 py-2 font-medium text-teal-600 bg-transparent rounded-lg dark:text-teal-300 hover:underline"
                    >
                        Details
                    </button>
                </div>
                <div
                    v-if="showDetails"
                    class="px-4 py-3 mt-3 text-xs text-gray-500 bg-gray-100 dark:text-gray-400 rounded-xl dark:bg-gray-800"
                >
                    <strong>Essenzielle:</strong> Unbedingt für die
                    Funktionalität erforderlich.<br />
                    <strong>Statistik/Marketing:</strong> z.B. Google Analytics,
                    wird erst nach Zustimmung geladen.<br />
                    <strong>Widerruf:</strong> Sie können Ihre Einstellungen
                    jederzeit im Footer anpassen.<br />
                    <!-- Anpassung hier: -->
                    <a
                        href="/datenschutz"
                        class="text-teal-600 underline dark:text-teal-300"
                        @click.prevent="goToPrivacy"
                        >Mehr erfahren</a
                    >
                </div>
            </div>
        </div>
    </transition>
</template>

<script setup>
import { ref, onMounted, watch } from "vue";
import { usePage, router } from "@inertiajs/vue3";
import axios from "axios";

const visible = ref(false);
const showDetails = ref(false);

function getConsent() {
    return (
        document.cookie.match(/cookie_consent=(all|essentials)/)?.[1] ||
        localStorage.getItem("cookie_consent")
    );
}
function setConsent(value) {
    localStorage.setItem("cookie_consent", value);
    document.cookie = `cookie_consent=${value}; path=/; max-age=31536000; SameSite=Lax`;
}
function getSeen() {
    return localStorage.getItem("cookie_consent_seen") === "1";
}
function setSeen() {
    localStorage.setItem("cookie_consent_seen", "1");
}

function clearSeen() {
    localStorage.removeItem("cookie_consent_seen");
}

const shouldShow = ref(false);

function updateVisibility() {
    shouldShow.value = !getConsent() && !getSeen();
}

onMounted(() => {
    updateVisibility();
    // Watch page changes (Inertia navigation):
    router.on("navigate", () => {
        // Wenn KEIN Consent, KEINE Auswahl, dann Banner wieder anzeigen!
        if (!getConsent() && !isOnPrivacyPage()) {
            clearSeen(); // Auf allen Seiten außer Datenschutzseite, Banner wieder aktivierbar!
            updateVisibility();
        }
        // Wenn man direkt auf /datenschutz ist, Banner ausgeblendet (nur, wenn vorher per goToPrivacy dort hin navigiert)
        if (isOnPrivacyPage() && !getConsent()) {
            shouldShow.value = false;
        }
    });
});

function isOnPrivacyPage() {
    const path = window.location.pathname;
    return path === "/datenschutz";
}

// ** Ausführlich: ** Beim Klick auf "Mehr erfahren"
function goToPrivacy() {
    setSeen(); // Banner bewusst ausgeblendet, aber keine Auswahl getroffen!
    shouldShow.value = false;
    router.visit("/datenschutz");
}

async function acceptAll() {
    setConsent("all");
    await axios.post("/cookie-consent/accept");
    clearSeen();
    shouldShow.value = false;
    window.dispatchEvent(new Event("cookie:accepted"));
}
async function decline() {
    setConsent("essentials");
    await axios.post("/cookie-consent/decline");
    clearSeen();
    shouldShow.value = false;
    window.dispatchEvent(new Event("cookie:declined"));
}

watch([visible, showDetails], updateVisibility);
</script>

<style scoped>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.3s;
}
.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
.animate-pop-up {
    animation: popup 0.45s cubic-bezier(0.3, 1.4, 0.6, 1) 1;
}
@keyframes popup {
    0% {
        transform: translateY(100px) scale(0.95);
        opacity: 0;
    }
    60% {
        transform: translateY(-10px) scale(1.03);
    }
    100% {
        transform: translateY(0) scale(1);
        opacity: 1;
    }
}
</style>
