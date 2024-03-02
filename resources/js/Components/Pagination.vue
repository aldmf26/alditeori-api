<template>
    <nav class="flex p-4 items-center flex-column flex-wrap md:flex-row justify-between pt-4"
        aria-label="Table navigation">
        <div class="text-sm font-normal text-gray-500 dark:text-gray-400 mb-4 md:mb-0 block w-full md:inline md:w-auto">
            Showing
            <span class="font-semibold text-gray-900 dark:text-white">{{ blog.from }}-{{ blog.to }}</span>
            of
            <span class="font-semibold text-gray-900 dark:text-white">{{ blog.total }}</span>
        </div>
        <ul class="inline-flex -space-x-px rtl:space-x-reverse text-sm h-8">
            <li v-for="(link, index) in blog.links" :key="index">
                <div v-if="link.url === null" />
                <Link v-else :href="link.url" :class="{ 'bg-cyan-400 text-white': link.active }"
                    class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-cyan-400 hover:text-white"
                    v-html="link.label">
                </Link>
            </li>
        </ul>
    </nav>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";


defineProps({
    blog: Object,
})
</script>