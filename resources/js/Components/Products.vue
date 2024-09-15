<script setup>
import { defineProps } from "vue";
import VueCarousel from "@/Components/VueCarousel.vue";
import ProductCard from "@/Components/ProductCard.vue";
import { Link } from "@inertiajs/vue3";

const props = defineProps({
  products: {
    type: Array,
    required: true,
  },
  title: {
    type: String,
    default: "Featured",
  },
  link: {
    type: String,
    required: false,
  },
});
</script>

<template>
  <div class="max-w-7xl mx-auto">
    <div class="flex flex-row">
      <div class="relative flex flex-col justify-center items-center mr-2">
        <img src="/images/custom-build.png" alt="picture" class="max-w-60 h-full" />
        <div class="absolute text-2xl text-white font-bold tracking-wider text-center">
          <span class="block">{{ title }}</span>
          <span class="block">Products</span>
          <p class="absolute mt-20 text-xs text-nowrap capitalize underline text-white">
            <Link :href="link">see all products </Link>
          </p>
        </div>
      </div>
      <div class="flex-1 overflow-hidden">
        <VueCarousel :products="products">
          <template #default="{ product }">
            <ProductCard :product="product" />
          </template>
        </VueCarousel>
      </div>
    </div>
  </div>
</template>
