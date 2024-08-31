<script setup>
import { onMounted } from 'vue';
import { Head } from '@inertiajs/vue3';
import { initFlowbite } from 'flowbite'
import Header from '@/Layouts/Header.vue';
import Footer from '@/Layouts/Footer.vue';
import Announcement from '@/Components/Annoucement.vue';

defineProps({
    title: String
});

// initialize components based on data attribute selectors
onMounted(() => {
    initFlowbite();
})
</script>

<template>
    <Head :title="title" />
    
    <Announcement>
        This is default text for Announcement header
        This is default text for Announcement header
        This is default text for Announcement header
        This is default text for Announcement header
    </Announcement>
    <Header />

    <main>
        <slot />
    </main>

    <Footer />  
</template>