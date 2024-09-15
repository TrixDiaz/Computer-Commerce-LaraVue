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
  featuredProducts: Object,
  saleProducts: Object,
  newProducts: Object,
  categories: {
    type: Object,
    default: () => ({}),
  },
});
</script>

<template>
  <UserLayout title="Welcome">
    <Hero />

    <div class="max-w-7xl mx-auto">
      <div class="flex flex-col sm:flex-row justify-between items-center">
        <p class="text-xl font-bold my-4">New Products</p>
        <Link
          :href="route('catalog.index', { page: 1, sort: 'new_products' })"
          class="text-blue-600 underline capitalize text-sm"
          >See all new product</Link
        >
      </div>
      <VueCarousel :products="props.newProducts.data" :itemsToShow="6">
        <template v-slot:default="{ product }">
          <ProductCard :product="product" />
        </template>
      </VueCarousel>
    </div>

    <Banner class="bg-white" title="Featured" />

    <Products
      :products="props.featuredProducts.data"
      class="mb-4"
      :link="route('catalog.index', { page: 1, sort: 'featured_products' })"
    />

    <TabsProduct :products="props.products.data" />

    <Products
      :products="props.saleProducts.data"
      title="Sale"
      :link="route('catalog.index', { page: 1, sort: 'sale_products' })"
    />

    <Brands />

    <Promotion />

    <Support />

    <Accordion />
  </UserLayout>
</template>
