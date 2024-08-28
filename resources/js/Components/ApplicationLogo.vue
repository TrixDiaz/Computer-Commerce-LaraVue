<template>
    <Link :href="route('welcome')">
        <img src="/images/Logo.png" alt="logo" class="w-14 h-14 object-cover drop-shadow-lg" >
    </Link>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
</script>
