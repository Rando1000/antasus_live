<template>
    <span
        :title="`${country} (${countryCode})`"
        class="text-lg select-none"
        role="img"
        aria-label="Länderkürzel"
    >
        {{ flag }}
    </span>
</template>

<script setup>
import { computed } from "vue";
import {
    getFlagEmojiFromCountry,
    countryCodeMap,
} from "@/utils/countryCodeMap.js";

const props = defineProps({
    country: {
        type: String,
        required: true,
    },
});

const flag = computed(() => getFlagEmojiFromCountry(props.country));
const countryCode = computed(() => countryCodeMap[props.country] ?? "??");
</script>
