<script setup>
import { Link } from '@inertiajs/vue3';
import { ref } from 'vue';
import UserLayout from '@/Layouts/UserLayout.vue';
import Hero from '@/Components/Hero.vue';
import VueCarousel from '@/Components/VueCarousel.vue';
import ProductCard from '@/Components/ProductCard.vue';
import Banner from '@/Components/Banner.vue';
import Products from '@/Components/Products.vue';
import TabsProduct from '@/Components/TabsProduct.vue';
import Brands from '@/Components/Brands.vue';
import Promotion from '@/Components/Promotion.vue';
import Support from '@/Components/Support.vue';
import Accordion from '@/Components/Accordion.vue';

const response = ref([
  {
    id: 1,
    name: 'Motherboard powerful server motherboard',
    rating: '5',
    username: 'John Doe',
    feedback: 'This is a great product This is a great product This is a great product',
    title: 'Motherboard powerful server motherboard',
  },
  {
    id: 2,
    name: 'Motherboard powerful server motherboard',
    rating: '3',
    username: 'John Doe',
    feedback: 'This is a great product This is a great product This is a great product This is a great product This is a great product',
    title: 'Motherboard powerful server motherboard',
  },
  {
    id: 3,
    name: 'Motherboard powerful server motherboard',
    rating: '3',
    username: 'John Doe',
    feedback: 'This is a great product This is a great product This is a great product This is a great product This is a great product',
    title: 'Motherboard powerful server motherboard',
  },
  {
    id: 4,
    name: 'Motherboard powerful server motherboard',
    rating: '1',
    username: 'John Doe',
    feedback: 'This is a great product This is a great product This is a great product This is a great productThis is a great product',
    title: 'Motherboard powerful server motherboard',
  },
  {
    id: 5,
    name: 'Motherboard powerful server motherboard',
    rating: '3',
    username: 'John Doe',
    feedback: 'This is a great product This is a great product This is a great product This is a great productThis is a great product',
    title: 'Motherboard powerful server motherboard',
  },
  {
    id: 6,
    name: 'Motherboard powerful server motherboard',
    rating: '3',
    username: 'John Doe',
    feedback: 'This is a great product This is a great product This is a great product This is a great product',
    title: 'Motherboard powerful server motherboard',
  },
  {
    id: 7,
    name: 'Motherboard powerful server motherboard',
    rating: '3',
    username: 'John Doe',
    feedback: 'This is a great product This is a great product This is a great product This is a great product',
    title: 'Motherboard powerful server motherboard',
  },
]);

</script>

<template>
    <UserLayout title="Welcome">
        <Hero />

        <div class="max-w-7xl mx-auto">
            <div class="flex flex-col sm:flex-row justify-between items-center">
                <p class="text-xl font-bold my-4">New Products</p>
                <Link href="#" class="text-blue-600 underline capitalize text-sm">See all new product</Link>
            </div>
            <VueCarousel :products="response">
                <template v-slot:default="{ product }">
                    <ProductCard :product="product" />
                </template>
            </VueCarousel>
        </div>

        <Banner class="bg-white" />

        <Products/>

        <TabsProduct/>

        <TabsProduct/>
        
        <Products/>

        <Brands/>

        <Promotion/>

        <Support/>

        <Accordion/>

    </UserLayout>
</template>