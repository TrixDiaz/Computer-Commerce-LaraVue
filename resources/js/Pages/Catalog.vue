<script setup>
import UserLayout from "@/Layouts/UserLayout.vue";
import HeroCard from "@/Components/HeroCard.vue";
import ProductCatalog from "@/Components/Catalog.vue";
import Support from "@/Components/Support.vue";

const props = defineProps({
  products: {
    type: Object,
    required: true,
  },
  categories: {
    type: Object,
    required: true,
  },
  brands: {
    type: Object,
    required: true,
  },
});
</script>

<template>
  <UserLayout title="Catalog">
    <HeroCard class="hidden lg:block" />

    <ProductCatalog :products="props.products" :categories="props.categories" :brands="props.brands" />

    <Support />
  </UserLayout>
</template>
