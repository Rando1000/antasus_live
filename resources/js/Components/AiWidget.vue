<template>
    <section
        id="ai-assistant"
        class="py-10 sm:py-16 px-2 bg-gradient-to-b from-white via-gray-50 to-teal-50 dark:from-black dark:via-gray-900 dark:to-[#003A37]"
    >
        <div
            class="max-w-md p-4 mx-auto space-y-4 border border-gray-100 shadow-xl bg-white/95 dark:bg-gray-900/90 rounded-2xl sm:p-6 dark:border-gray-800"
        >
            <h3
                class="mb-2 text-2xl font-extrabold tracking-tight text-center text-antasus-primary drop-shadow-sm"
            >
                <span class="inline-block align-middle">🤖</span>
                Antasus KI-Ratgeber
            </h3>

            <!-- Quick-Tipps -->
            <div class="flex flex-wrap gap-2 mb-2">
                <button
                    v-for="tip in tips"
                    :key="tip"
                    @click="useTip(tip)"
                    class="px-3 py-1 text-xs font-medium transition rounded-full shadow bg-antasus-primary/10 text-antasus-primary hover:bg-antasus-primary/20"
                >
                    {{ tip }}
                </button>
            </div>

            <!-- Chatverlauf -->
            <div class="pr-2 space-y-2 overflow-y-auto max-h-80" ref="chatList">
                <template v-for="(msg, i) in chat" :key="i">
                    <div
                        class="flex items-end"
                        :class="
                            msg.role === 'user'
                                ? 'justify-end'
                                : 'justify-start'
                        "
                    >
                        <div
                            class="flex flex-col items-end max-w-[82%]"
                            v-if="msg.role === 'user'"
                        >
                            <div
                                class="flex items-center gap-1 mb-1 text-xs text-gray-400"
                            >
                                <span>{{ msg.time }}</span>
                                <span
                                    class="font-semibold text-gray-600 dark:text-gray-300"
                                    >Du</span
                                >
                                <span>🧑‍💼</span>
                            </div>
                            <div
                                class="p-2 px-3 text-sm font-medium text-white break-words shadow rounded-xl bg-gradient-to-r from-antasus-primary to-black"
                            >
                                {{ msg.content }}
                            </div>
                        </div>
                        <div
                            class="flex flex-col items-start max-w-[90%]"
                            v-else
                        >
                            <div
                                class="flex items-center gap-1 mb-1 text-xs text-gray-400"
                            >
                                <span>🤖</span>
                                <span class="font-semibold text-antasus-primary"
                                    >Antasus KI</span
                                >
                                <span>{{ msg.time }}</span>
                            </div>
                            <div
                                class="p-2 px-3 text-sm prose-sm prose text-gray-900 break-words shadow rounded-xl bg-antasus-primary/10 dark:bg-gray-900/70 dark:text-gray-100 dark:prose-invert"
                                v-html="msg.content"
                            ></div>
                        </div>
                    </div>
                </template>
                <div
                    v-if="loading"
                    class="flex items-center gap-2 mt-2 text-xs text-antasus-primary/70"
                >
                    <span class="inline-block animate-spin"
                        ><svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="w-4 h-4"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <circle
                                cx="12"
                                cy="12"
                                r="10"
                                stroke="currentColor"
                                stroke-width="4"
                                fill="none"
                                opacity=".15"
                            />
                            <path
                                d="M4 12a8 8 0 018-8"
                                stroke="currentColor"
                                stroke-width="4"
                                stroke-linecap="round"
                            /></svg
                    ></span>
                    Antasus KI denkt nach…
                </div>
            </div>

            <!-- Fragefeld -->
            <form
                @submit.prevent="askAI"
                class="flex flex-col gap-2 mt-1 sm:flex-row"
            >
                <input
                    v-model="question"
                    type="text"
                    maxlength="200"
                    placeholder="Fragen Sie alles zu Glasfaser, FTTH, Bau…"
                    class="flex-1 px-4 py-2 text-gray-900 transition border border-gray-300 rounded-lg focus:ring-2 focus:ring-antasus-primary focus:border-antasus-primary dark:bg-gray-800 dark:text-white dark:border-gray-700"
                    :disabled="loading"
                    autocomplete="off"
                    required
                />
                <button
                    type="submit"
                    :disabled="loading || !question.trim()"
                    class="px-4 py-2 font-bold text-white transition rounded-lg shadow-lg bg-gradient-to-r from-antasus-primary to-black hover:opacity-90 focus:ring-2 focus:ring-antasus-primary"
                >
                    <span
                        v-if="loading"
                        class="inline-block mr-1 align-middle animate-spin"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="w-5 h-5 text-white"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <circle
                                cx="12"
                                cy="12"
                                r="10"
                                stroke="currentColor"
                                stroke-width="4"
                                fill="none"
                                opacity=".2"
                            />
                            <path
                                d="M4 12a8 8 0 018-8"
                                stroke="currentColor"
                                stroke-width="4"
                                stroke-linecap="round"
                            />
                        </svg>
                    </span>
                    {{ loading ? "..." : "Fragen" }}
                </button>
            </form>
        </div>
    </section>
</template>

<script setup>
import { ref, nextTick } from "vue";
import axios from "axios";

// Beispiel-Quick-Tipps
const tips = [
    "Was ist Glasfaser?",
    "Wie läuft der Hausanschluss ab?",
    "Welche Vorteile bietet FTTH?",
    "Was kostet ein Glasfaseranschluss?",
    "Wie funktioniert die Montage?",
];

const question = ref("");
const loading = ref(false);
const chat = ref([
    {
        role: "assistant",
        content:
            "Willkommen! 👋<br>Stellen Sie Ihre Frage rund um Glasfaser, FTTH, Hausanschluss, Bau oder Telekommunikation. Ich helfe gern weiter.",
        time: new Date().toLocaleTimeString([], {
            hour: "2-digit",
            minute: "2-digit",
        }),
    },
]);
const chatList = ref(null);

// Quick-Tipp nutzen
function useTip(tip) {
    question.value = tip;
    // Direkt losschicken, falls gewünscht:
    // askAI();
}

// Abschicken & Verlauf ergänzen
async function askAI() {
    if (!question.value.trim()) return;
    loading.value = true;

    // Frage in Verlauf aufnehmen
    const time = new Date().toLocaleTimeString([], {
        hour: "2-digit",
        minute: "2-digit",
    });
    chat.value.push({
        role: "user",
        content: question.value.trim(),
        time,
    });
    const userQuestion = question.value;
    question.value = "";

    try {
        const { data } = await axios.post("/api/ai/answer", {
            question: userQuestion,
        });
        chat.value.push({
            role: "assistant",
            content: data.answer || "Leider keine Antwort erhalten.",
            time: new Date().toLocaleTimeString([], {
                hour: "2-digit",
                minute: "2-digit",
            }),
        });
        await nextTick();
        // Nach unten scrollen (bei neuer Antwort)
        chatList.value?.scrollTo({
            top: chatList.value.scrollHeight,
            behavior: "smooth",
        });
    } catch (err) {
        chat.value.push({
            role: "assistant",
            content:
                "Fehler beim Abruf der Antwort. Bitte später erneut versuchen.",
            time: new Date().toLocaleTimeString([], {
                hour: "2-digit",
                minute: "2-digit",
            }),
        });
    } finally {
        loading.value = false;
        await nextTick();
        chatList.value?.scrollTo({
            top: chatList.value.scrollHeight,
            behavior: "smooth",
        });
    }
}
</script>

<style scoped>
.bg-antasus-primary {
    background: #00fdcf !important;
}
.text-antasus-primary {
    color: #00fdcf !important;
}
/* Scrollbar modern (optional) */
.max-h-80::-webkit-scrollbar {
    width: 6px;
}
.max-h-80::-webkit-scrollbar-thumb {
    background: #00fdcf44;
    border-radius: 4px;
}
/* "Chat-Bubbles" */
.rounded-xl {
    border-radius: 1.1rem !important;
}
.prose a {
    color: #00fdcf !important;
    text-decoration: underline;
}
/* Optional Animation */
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.3s;
}
.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
</style>
