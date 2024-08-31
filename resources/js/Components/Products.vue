<script setup>
import { ref } from 'vue';
import VueCarousel from '@/Components/VueCarousel.vue';
import ProductCard from '@/Components/ProductCard.vue';

const response = ref([
  { id: 1, name: 'Motherboard powerful server motherboard', rating: '5' },
  { id: 2, name: 'Motherboard powerful server motherboard', rating: '3' },
  { id: 3, name: 'Motherboard powerful server motherboard', rating: '3' },
  { id: 4, name: 'Motherboard powerful server motherboard', rating: '1' },
  { id: 5, name: 'Motherboard powerful server motherboard', rating: '3' },
  { id: 5, name: 'Motherboard powerful server motherboard', rating: '3' },
]);
</script>

<template>
    <div class="max-w-7xl mx-auto mb-2">
      <div class="flex flex-col sm:flex-row gap-2">
        <div class="relative flex flex-col justify-center items-center">
          <img src="/images/custom-build.png" alt="picture" class="mx-auto h-full">
          <div class="absolute text-2xl text-white font-bold tracking-wider text-center">
            <span class="block">Custom</span>
            <span class="block">Builds</span>
            <p class="absolute mt-20 text-xs text-nowrap capitalize underline text-white">see all products</p>
          </div>
        </div>
        <div class="flex-1">
          <VueCarousel :products="response">
            <template #default="{ product }">
              <ProductCard :product="product" />
            </template>
          </VueCarousel>
        </div>
      </div>
    </div>
  </template>
  
 
  