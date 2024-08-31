<script setup>
import { Head } from '@inertiajs/vue3';
import Annoucement from '@/Components/Annoucement.vue';
import Header from '@/Layouts/Header.vue';
import Breadcrumbs from '@/Components/Breadcrumbs.vue';
import Checkout from '@/Components/Checkout.vue';
import Footer from '@/Layouts/Footer.vue';
</script>

<template>
    <Head title="Cart" />

    <Annoucement>
        This is default text for Announcement header
        This is default text for Announcement header
        This is default text for Announcement header
        This is default text for Announcement header
    </Annoucement>

    <Header />

    <Breadcrumps />

    <Checkout/>

    <Footer />
</template>
