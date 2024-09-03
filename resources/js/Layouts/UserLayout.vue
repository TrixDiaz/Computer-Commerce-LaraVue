<script setup>
import { onMounted } from "vue";
import { Head } from "@inertiajs/vue3";
import { initFlowbite } from "flowbite";
import Header from "@/Layouts/Header.vue";
import Footer from "@/Layouts/Footer.vue";
import Annoucement from "@/Components/Annoucement.vue";

defineProps({
  title: String,
});

// initialize components based on data attribute selectors
onMounted(() => {
  initFlowbite();
});
</script>

<template>
  <Head :title="title" />

  <Annoucement />

  <Header />

  <main>
    <slot />
  </main>

  <Footer />
</template>
