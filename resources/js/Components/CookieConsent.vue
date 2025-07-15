<template>
    <transition name="fade">
        <div
            v-if="shouldShow"
            class="fixed z-[100] inset-0 flex items-end justify-center pointer-events-none"
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
                    Erlebnis zu bieten...
                </p>
                <div class="flex flex-wrap gap-2 mt-2">
                    <button
                        @click="acceptAll"
                        class="px-5 py-2 font-medium text-white transition rounded-lg shadow bg-gradient-to-r from-teal-500 to-indigo-600 hover:scale-105"
                    >
                        Alle akzeptieren
                    </button>
                    <button
                        @click="acceptEssentials"
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
                <!-- Granularer Detailbereich mit explizitem Speichern -->
                <div
                    v-if="showDetails"
                    class="px-4 py-3 mt-3 text-xs text-gray-500 bg-gray-100 dark:text-gray-400 rounded-xl dark:bg-gray-800"
                >
                    <form @submit.prevent="saveGranularConsent">
                        <div class="mb-2">
                            <label
                                class="flex items-center gap-2 font-semibold"
                            >
                                <input type="checkbox" checked disabled />
                                Essenzielle Cookies
                                <span class="ml-1 text-xs text-gray-400"
                                    >(immer aktiv)</span
                                >
                            </label>
                        </div>
                        <div class="mb-2">
                            <label class="flex items-center gap-2">
                                <input
                                    type="checkbox"
                                    v-model="categories.analytics"
                                />
                                Statistik (z.B. Google Analytics)
                            </label>
                        </div>
                        <div class="mb-2">
                            <label class="flex items-center gap-2">
                                <input
                                    type="checkbox"
                                    v-model="categories.marketing"
                                />
                                Marketing (z.B. Retargeting)
                            </label>
                        </div>
                        <div class="mb-2">
                            <label class="flex items-center gap-2">
                                <input
                                    type="checkbox"
                                    v-model="categories.external"
                                />
                                Externe Inhalte (z.B. YouTube)
                            </label>
                        </div>
                        <div class="flex gap-2 mt-4">
                            <button
                                type="submit"
                                class="px-5 py-2 font-medium text-white transition rounded-lg shadow bg-gradient-to-r from-teal-500 to-indigo-600 hover:scale-105"
                            >
                                Auswahl speichern
                            </button>
                            <a
                                href="/datenschutz"
                                class="px-5 py-2 font-medium text-teal-600 bg-transparent rounded-lg dark:text-teal-300 hover:underline"
                                @click.prevent="goToPrivacy"
                            >
                                Mehr erfahren
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </transition>
</template>

<script setup>
import { ref, computed, onMounted, watch, reactive } from "vue";
import { useConsentStore } from "@/stores/consent";
import { router } from "@inertiajs/vue3";

const store = useConsentStore();
const showDetails = ref(false);
const categories = reactive({ ...store.categories });

// Banner ist NUR ausgeblendet, wenn Consent gesetzt (egal ob all/essentials), oder auf /datenschutz
const shouldShow = computed(
    () => !store.hasConsent && !store.privacyTemporarilyHidden
);

function acceptAll() {
    store.setConsentAll(true);
    window.dispatchEvent(new Event("cookie:accepted"));
    showDetails.value = false;
}
function acceptEssentials() {
    store.acceptEssentialsOnly();
    window.dispatchEvent(new Event("cookie:declined"));
    showDetails.value = false;
}
function saveGranularConsent() {
    Object.keys(categories).forEach((cat) => {
        if (cat !== "essential") store.setCategory(cat, categories[cat]);
    });
    store.wasExplicitlySet = true;
    store.privacyTemporarilyHidden = false;
    showDetails.value = false;
}
function goToPrivacy() {
    store.temporarilyHideOnPrivacy();
    router.visit("/datenschutz");
}
const checkVisibility = () => {
    if (window.location.pathname === "/datenschutz" && !store.hasConsent) {
        store.privacyTemporarilyHidden = true;
    } else if (!store.hasConsent) {
        store.privacyTemporarilyHidden = false;
    }
};
onMounted(() => {
    checkVisibility();
    router.on("navigate", checkVisibility);
});
watch(() => store.hasConsent, checkVisibility);
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
