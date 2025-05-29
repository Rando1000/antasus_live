<template>
    <nav
        class="fixed inset-x-0 bottom-0 z-50 bg-white border-t shadow md:hidden"
    >
        <ul class="flex items-center justify-around h-16">
            <li>
                <Link
                    href="/"
                    class="flex flex-col items-center text-gray-500 hover:text-teal-600"
                >
                    <HomeIcon class="w-6 h-6" />
                    <span class="mt-1 text-xs">Start</span>
                </Link>
            </li>
            <li>
                <Link
                    href="/leistungen"
                    class="flex flex-col items-center text-gray-500 hover:text-teal-600"
                >
                    <ListIcon class="w-6 h-6" />
                    <span class="mt-1 text-xs">Leistungen</span>
                </Link>
            </li>
            <li>
                <Link
                    href="/referenzen"
                    class="flex flex-col items-center text-gray-500 hover:text-teal-600"
                >
                    <BriefcaseIcon class="w-6 h-6" />
                    <span class="mt-1 text-xs">Referenzen</span>
                </Link>
            </li>
            <li>
                <Link
                    href="/kontakt"
                    class="flex flex-col items-center text-gray-500 hover:text-teal-600"
                >
                    <MailIcon class="w-6 h-6" />
                    <span class="mt-1 text-xs">Kontakt</span>
                </Link>
            </li>
        </ul>
    </nav>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import { HomeIcon, ListIcon, MailIcon, BriefcaseIcon } from "lucide-vue-next";
</script>
