<template>
    <div class="max-w-7xl mx-auto mb-4">
        <div class="flex flex-col sm:flex-row justify-center items-center p-4 rounded-lg space-x-2 text-center">
            <ApplicationLogo class=""/>
            <span class="hidden sm:block bg-cyan-300 w-0.5 h-4"></span>
            <p>own it now, up to 6 months interest free</p>
            <Link href="#" class="text-blue-600 underline">learn more</Link>
        </div>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import ApplicationLogo from '@/Components/ApplicationLogo.vue'; 
</script>
