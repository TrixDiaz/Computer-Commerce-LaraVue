<script setup>
import Cart from "@/Components/Cart.vue";
import UserLayout from "@/Layouts/UserLayout.vue";

const subtotal = 13407.0;
const shipping = 21.0;
const tax = 1.91;
const total = 13608.0;
</script>

<template>
  <UserLayout title="Cart">
    <Cart />
  </UserLayout>
</template>
