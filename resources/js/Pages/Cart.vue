<script setup>
import { Head } from "@inertiajs/vue3";
import Annoucement from "@/Components/Annoucement.vue";
import Header from "@/Layouts/Header.vue";
import Breadcrumbs from "@/Components/Breadcrumbs.vue";
import Cart from "@/Components/Cart.vue";
import Footer from "@/Layouts/Footer.vue";

const subtotal = 13407.0;
const shipping = 21.0;
const tax = 1.91;
const total = 13608.0;
</script>

<template>
  <Head title="Cart" />

  <Annoucement>
    This is default text for Announcement header This is default text for Announcement
    header This is default text for Announcement header This is default text for
    Announcement header
  </Annoucement>

  <Header />

  <Breadcrumps />

  <Cart />

  <Footer />
</template>
