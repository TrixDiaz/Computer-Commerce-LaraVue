<script setup>
import { ref, computed } from "vue";
import { Link } from "@inertiajs/vue3";
import UserLayout from "@/Layouts/UserLayout.vue";
import Hero from "@/Components/Hero.vue";
import VueCarousel from "@/Components/VueCarousel.vue";
import ProductCard from "@/Components/ProductCard.vue";
import Banner from "@/Components/Banner.vue";
import Products from "@/Components/Products.vue";
import TabsProduct from "@/Components/TabsProduct.vue";
import Brands from "@/Components/Brands.vue";
import Promotion from "@/Components/Promotion.vue";
import Support from "@/Components/Support.vue";
import Accordion from "@/Components/Accordion.vue";

const props = defineProps({
  products: Object,
});

const newProducts = computed(() => {
  return props.products.data.filter(
    (product) => product.is_new === 1 && product.is_active === 1
  );
});
</script>

<template>
  <UserLayout title="Welcome">
    <Hero />

    <div class="max-w-7xl mx-auto">
      <div class="flex flex-col sm:flex-row justify-between items-center">
        <p class="text-xl font-bold my-4">New Products</p>
        <Link href="#" class="text-blue-600 underline capitalize text-sm"
          >See all new product</Link
        >
      </div>
      <VueCarousel :products="newProducts" :itemsToShow="6">
        <template v-slot:default="{ product }">
          <ProductCard :product="product" />
        </template>
      </VueCarousel>
    </div>

    <Banner class="bg-white" />

    <Products :products="props.products.data" />

    <TabsProduct :products="props.products.data" />

    <TabsProduct :products="props.products.data" />

    <Products :products="props.products.data" />

    <Brands />

    <Promotion />

    <Support />

    <Accordion />
  </UserLayout>
</template>
