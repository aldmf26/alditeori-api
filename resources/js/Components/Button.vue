<script setup>
import { Link } from '@inertiajs/vue3';
const props = defineProps({
    href: {
        type: String,
    },
    title: {
        type: String,
        required: true,
    }
});


</script>
<template>
    <Link :href="href" class="flex cursor-pointer border-2xl rounded-lg hover:bg-lime-100  p-2">
    <slot />
    <h2>
        {{ title }}
    </h2>
    </Link>
</template>