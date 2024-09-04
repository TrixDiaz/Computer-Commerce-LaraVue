<script setup>
import Welcome from "@/Pages/Welcome.vue";
import { Head, usePage } from "@inertiajs/vue3";

const { props } = usePage();
</script>

<template>
  <Head title="Dashboard" />
  <Welcome
    :products="props.products"
    :featuredProducts="props.featuredProducts"
    :saleProducts="props.saleProducts"
    :newProducts="props.newProducts"
  />
</template>
