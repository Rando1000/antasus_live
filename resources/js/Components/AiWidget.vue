<template>
    <section
        id="ai-assistant"
        class="ai-section bg-gradient-to-b from-white via-gray-50 to-teal-50 dark:from-black dark:via-gray-900 dark:to-[#003A37] py-10 sm:py-16"
        aria-labelledby="ai-assistant-title"
    >
        <div
            class="flex flex-col gap-4 p-3 mx-auto border border-gray-100 shadow-2xl ai-container dark:border-gray-800 rounded-2xl bg-white/95 dark:bg-gray-900/90 sm:p-8"
            tabindex="0"
            aria-label="Antasus KI-Ratgeber Chatbereich"
            role="region"
        >
            <!-- Headline -->
            <header class="mb-3">
                <h2
                    id="ai-assistant-title"
                    class="text-3xl font-extrabold tracking-tight text-center md:text-4xl text-antasus-primary drop-shadow"
                >
                    <span
                        aria-hidden="true"
                        class="inline-block text-4xl align-middle"
                        >🤖</span
                    >
                    <span class="sr-only">Antasus KI-Ratgeber</span>
                    <span aria-label="Antasus KI-Ratgeber"
                        >Antasus KI-Ratgeber</span
                    >
                </h2>
                <p
                    class="mt-2 text-base text-center text-gray-500 dark:text-gray-400"
                    id="ai-intro-desc"
                >
                    Ihr interaktiver Assistent für Glasfaser, Hausanschluss
                    &amp; Telekommunikation. 100 % datenschutzkonform,
                    barrierefrei, jederzeit verfügbar.
                </p>
            </header>

            <!-- Quick-Tipps -->
            <nav aria-label="Schnellzugriff Fragen">
                <ul class="flex flex-wrap justify-center gap-2 mb-1">
                    <li v-for="tip in tips" :key="tip">
                        <button
                            @click="useTip(tip)"
                            class="quick-tip"
                            type="button"
                            :aria-label="'Vorschlag: ' + tip"
                        >
                            {{ tip }}
                        </button>
                    </li>
                </ul>
            </nav>

            <!-- Chatverlauf -->
            <div
                class="chat-list overflow-y-auto max-h-[52vh] min-h-[180px] sm:max-h-[380px] px-1 pr-2 sm:px-2"
                ref="chatList"
                tabindex="0"
                role="log"
                aria-live="polite"
                aria-label="Chatverlauf mit KI"
            >
                <ul class="space-y-4 sm:space-y-5">
                    <li
                        v-for="(msg, i) in chat"
                        :key="i"
                        :aria-label="
                            msg.role === 'assistant'
                                ? 'Antwort von Antasus KI'
                                : 'Ihre Eingabe'
                        "
                    >
                        <div
                            class="flex items-end"
                            :class="
                                msg.role === 'user'
                                    ? 'justify-end'
                                    : 'justify-start'
                            "
                        >
                            <div
                                v-if="msg.role === 'user'"
                                class="flex flex-col items-end w-full max-w-[82%]"
                            >
                                <div
                                    class="flex items-center gap-1 mb-1 text-xs text-gray-400"
                                >
                                    <span>{{ msg.time }}</span>
                                    <span
                                        class="font-semibold text-gray-600 dark:text-gray-300"
                                        >Du</span
                                    >
                                    <span aria-label="Sie">🧑‍💼</span>
                                </div>
                                <div
                                    class="bubble bubble-user"
                                    :tabindex="0"
                                    :aria-label="
                                        'Deine Nachricht: ' + msg.content
                                    "
                                >
                                    {{ msg.content }}
                                </div>
                            </div>
                            <div
                                v-else
                                class="flex flex-col items-start w-full max-w-[90%]"
                            >
                                <div
                                    class="flex items-center gap-1 mb-1 text-xs text-gray-400"
                                >
                                    <span aria-label="Bot">🤖</span>
                                    <span
                                        class="font-semibold text-antasus-primary"
                                        >Antasus KI</span
                                    >
                                    <span>{{ msg.time }}</span>
                                </div>
                                <div
                                    class="prose-sm prose text-gray-900 bubble bubble-bot dark:text-gray-100 dark:prose-invert"
                                    v-html="msg.content"
                                    :tabindex="0"
                                    aria-live="polite"
                                    lang="de"
                                ></div>
                            </div>
                        </div>
                    </li>
                    <li v-if="loading">
                        <div
                            class="flex items-center gap-2 mt-2 text-xs text-antasus-primary/70"
                        >
                            <span
                                class="inline-block animate-spin"
                                aria-hidden="true"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="w-4 h-4"
                                    fill="none"
                                    viewBox="0 0 24 24"
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
                                    />
                                </svg>
                            </span>
                            <span>Antasus KI denkt nach…</span>
                        </div>
                    </li>
                </ul>
            </div>

            <!-- Fragefeld -->
            <form
                @submit.prevent="askAI"
                class="sticky bottom-0 z-10 flex flex-col gap-2 pt-2 mt-1 sm:flex-row bg-white/95 dark:bg-gray-900/80 rounded-xl sm:pt-0"
                aria-label="Fragefeld"
                autocomplete="off"
            >
                <label for="ai-question" class="sr-only">Ihre Frage</label>
                <input
                    v-model="question"
                    type="text"
                    id="ai-question"
                    maxlength="200"
                    :placeholder="inputPlaceholder"
                    class="flex-1 px-4 py-2 text-gray-900 transition border border-gray-300 rounded-lg focus:ring-2 focus:ring-antasus-primary focus:border-antasus-primary dark:bg-gray-800 dark:text-white dark:border-gray-700"
                    :disabled="loading"
                    autocomplete="off"
                    required
                    aria-required="true"
                />
                <button
                    type="submit"
                    :disabled="loading || !question.trim()"
                    class="submit-btn"
                    aria-label="Frage absenden"
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
                    <span>{{ loading ? "..." : "Fragen" }}</span>
                </button>
            </form>
        </div>
    </section>
</template>

<script setup>
import { ref, nextTick } from "vue";
import axios from "axios";

// Accessibility + UI
const inputPlaceholder = "Fragen Sie alles zu Glasfaser, FTTH, Bau …";

const tips = [
    "Was ist Glasfaser?",
    "Wie läuft der Hausanschluss ab?",
    "Welche Vorteile bietet FTTH?",
    "Was kostet ein Glasfaseranschluss?",
    "Wie funktioniert die Montage?",
    "Wie läuft die Verlegung bei Antasus ab?",
    "Ist Glasfaser besser als DSL?",
];

const question = ref("");
const loading = ref(false);
const chat = ref([
    {
        role: "assistant",
        content:
            "Willkommen! 👋<br>Stellen Sie Ihre Frage rund um <strong>Glasfaser, FTTH, Hausanschluss, Bau oder Telekommunikation</strong>. Ich helfe gern weiter – powered by <b>Antasus Infra</b>.",
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
    // Automatisch losschicken? askAI();
}

// Abschicken & Verlauf ergänzen
async function askAI() {
    if (!question.value.trim()) return;
    loading.value = true;
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
/* Container & Section */
.ai-section {
    min-height: 100px;
    padding-left: 2vw;
    padding-right: 2vw;
    margin-left: auto;
    margin-right: auto;
}
.ai-container {
    max-width: 100vw;
    width: 100%;
    margin: 0 auto;
    box-sizing: border-box;
}
@media (min-width: 640px) {
    .ai-container {
        max-width: 520px;
    }
}
@media (min-width: 1024px) {
    .ai-container {
        max-width: 780px;
    }
}
@media (min-width: 1280px) {
    .ai-container {
        max-width: 950px;
    }
}

/* Quick-Tip Buttons */
.quick-tip {
    background: #00fdcf22;
    color: #5e7f7f;
    font-size: 0.96rem;
    font-weight: 600;
    padding: 0.47rem 1.2rem;
    border-radius: 9999px;
    transition: all 0.15s;
    box-shadow: 0 1px 7px #00fdcf0c;
    outline: none;
    border: none;
    cursor: pointer;
}
.quick-tip:hover,
.quick-tip:focus {
    background: #00fdcf44;
    color: #000;
    outline: 2px solid #00fdcf;
}

/* Chat-Bubbles */
.bubble {
    border-radius: 1.2rem !important;
    word-break: break-word;
    padding: 0.8rem 1.15rem;
    font-size: 1rem;
    box-shadow: 0 1.5px 10px #0001;
    margin-bottom: 0.25rem;
    outline: none;
}
.bubble-user {
    background: linear-gradient(100deg, #00fdcf 65%, #000 100%);
    color: #fff;
    border-bottom-right-radius: 0.4rem !important;
}
.bubble-bot {
    background: #00fdcf11;
    color: #111;
    border-bottom-left-radius: 0.4rem !important;
}
.dark .bubble-bot {
    background: #003a3733;
    color: #fff;
}

/* Submit-Button */
.submit-btn {
    font-size: 1.1rem;
    font-weight: 700;
    color: #fff;
    background: linear-gradient(270deg, #00fdcf, #000);
    border: none;
    border-radius: 0.8rem;
    box-shadow: 0 1.5px 10px #0002;
    padding: 0.83rem 2.1rem;
    transition: all 0.17s;
    outline: none;
    cursor: pointer;
    min-width: 120px;
}
.submit-btn:hover,
.submit-btn:focus {
    background: linear-gradient(135deg, #00fdcf 70%, #222 100%);
    outline: 2px solid #00fdcf;
    color: #000;
}

/* Focus states überall sichtbar! */
input:focus,
.bubble:focus,
.quick-tip:focus,
.submit-btn:focus {
    outline: 2.5px solid #00fdcf;
    outline-offset: 1px;
}
input,
.quick-tip,
.submit-btn,
.bubble {
    transition: outline 0.16s, box-shadow 0.16s;
}

/* Scrollbar Modern */
.chat-list::-webkit-scrollbar {
    width: 8px;
}
.chat-list::-webkit-scrollbar-thumb {
    background: #00fdcf33;
    border-radius: 6px;
}

/* Mobile Anpassungen */
@media (max-width: 600px) {
    .ai-container {
        max-width: 99vw !important;
        padding: 0.7rem !important;
    }
    .bubble {
        font-size: 0.98rem;
        padding: 0.68rem 0.95rem;
    }
    .submit-btn {
        font-size: 1rem;
        padding: 0.66rem 1.4rem;
    }
}
</style>
