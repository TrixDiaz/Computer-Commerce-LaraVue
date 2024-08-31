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
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Eveniet,
        quam magni. Odio quibusdam quia commodi illum quidem placeat
        dolorem nemo temporibus, sapiente id excepturi quasi officia
        maxime et voluptate corporis.
    </Announcement>
    
    <Header />

    <main>
        <slot />
    </main>

    <Footer />
</template>