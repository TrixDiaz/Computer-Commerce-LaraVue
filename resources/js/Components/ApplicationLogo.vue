<template>
  <a :href="route('welcome')">
    <img
      src="/images/Logo.png"
      alt="logo"
      class="w-10 h-10 object-cover drop-shadow-lg"
    />
  </a>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
</script>
