import { ref, watch } from 'vue';

const isDark = ref(localStorage.getItem('theme') === 'dark');

watch(isDark, (value) => {
    localStorage.setItem('theme', value ? 'dark' : 'light');
    document.documentElement.classList.toggle('dark', value);
});

export function useTheme() {
    return {
        isDark,
        toggleTheme: () => (isDark.value = !isDark.value),
    };
}
