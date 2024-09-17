<script setup>
import { watch, onMounted } from "vue";
import { router, usePage } from "@inertiajs/vue3";
import UserLayout from "@/Layouts/UserLayout.vue";
import HeroCard from "@/Components/HeroCard.vue";
import Breadcrumbs from "@/Components/Breadcrumbs.vue";
import ProductCatalog from "@/Components/Catalog.vue";
import Support from "@/Components/Support.vue";
import { useSearchStore } from "@/Store/SearchStore";

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

const searchStore = useSearchStore();

onMounted(() => {
  // Update search value when page loads
  if (usePage().props.search) {
    searchStore.searchQuery = usePage().props.search;
  }
});

watch(() => searchStore.searchResults, (newSearchResults) => {
  if (newSearchResults.length > 0) {
    router.get(
      route("catalog.index"),
      { search: searchStore.searchQuery },
      {
        preserveState: true,
        replace: true,
      }
    );
  }
});
</script>

<template>
  <UserLayout title="Catalog">
    <HeroCard class="hidden lg:block" />

    <div class="relative flex justify-center lg:justify-start">
      <Breadcrumbs />
    </div>

    <div class="max-w-7xl mx-auto">
      <p class="text-center md:text-start mt-5 text-2xl font-bold leading-7">
        MSI GT SERIES (20)
      </p>
    </div>

     <ProductCatalog 
      :products="props.products" 
      :categories="props.categories" 
      :brands="props.brands"
    /> 

    <Support />
  </UserLayout>
</template>
