<script setup>
import { ref } from 'vue';

const items = ref([
  {
    title: 'Follow us on Instagram for News, Offers & More',
    image: '/images/promotion.png',
    description: 'If you’ve recently made a desktop PC or laptop purchase, you might want to consider adding peripherals to enhance your home...',
    date: '01.09.2020',
  },
  {
    title: 'Special Discounts on Gaming Accessories',
    image: '/images/promotion.png',
    description: 'Get the best deals on gaming accessories, perfect for upgrading your setup and enhancing your gaming experience...',
    date: '05.10.2020',
  },
  {
    title: 'New Arrivals in Tech Gadgets',
    image: '/images/promotion.png',
    description: 'Check out the latest arrivals in tech gadgets, from smartwatches to wireless earbuds...',
    date: '15.11.2020',
  },
  {
    title: 'Exclusive Offers on Home Appliances',
    image: '/images/promotion.png',
    description: 'Upgrade your home with our exclusive offers on home appliances...',
    date: '20.12.2020',
  },
  {
    title: 'Join Our Newsletter for Updates',
    image: '/images/promotion.png',
    description: 'Stay updated with the latest news and offers by joining our newsletter...',
    date: '25.12.2020',
  }
]);
</script>

<template>
    <div class="max-w-7xl mx-auto hidden lg:block">
        <p class="text-xl font-semibold my-4">Follow us on Instagram for News, Offers & More</p>
      <div class="grid gap-4 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5">
        <div v-for="(item, index) in items" :key="index" class="p-4 rounded">
          <div class="flex flex-col justify-center items-center gap-2">
            <img :src="item.image" alt="Promotion image" class="w-full">
            <div class="flex flex-col justify-center items-center gap-2">
              <p class="text-center text-wrap px-4">{{ item.description }}</p>
              <p class="text-gray-400">{{ item.date }}</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </template>
  
 
  