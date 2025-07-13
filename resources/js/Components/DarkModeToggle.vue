<template>
    <button
        @click="toggleTheme"
        :aria-pressed="isDark"
        class="flex items-center gap-2 px-3 py-1 text-sm font-semibold transition bg-white border rounded-lg shadow border-antasus-primary dark:bg-antasus-dark dark:border-antasus-primary focus:outline-none focus:ring-2 focus:ring-antasus-primary"
        aria-label="Farbmodus wechseln"
    >
        <span v-if="isDark">🌙</span>
        <span v-else>☀️</span>
        <span class="sr-only">Dark Mode wechseln</span>
    </button>
</template>

<script setup>
import { ref, onMounted } from "vue";
const isDark = ref(false);
function toggleTheme() {
    isDark.value = !isDark.value;
    if (isDark.value) {
        document.documentElement.classList.add("dark");
        localStorage.setItem("theme", "dark");
    } else {
        document.documentElement.classList.remove("dark");
        localStorage.setItem("theme", "light");
    }
}
onMounted(() => {
    const saved = localStorage.getItem("theme");
    if (
        saved === "dark" ||
        (!saved && window.matchMedia("(prefers-color-scheme: dark)").matches)
    ) {
        document.documentElement.classList.add("dark");
        isDark.value = true;
    }
});
</script>
