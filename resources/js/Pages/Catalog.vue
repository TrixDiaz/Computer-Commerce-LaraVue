<script setup>
import { Head } from "@inertiajs/vue3";
import Annoucement from "@/Components/Annoucement.vue";
import Header from "@/Layouts/Header.vue";
import HeroCard from "@/Components/HeroCard.vue";
import Breadcrumbs from "@/Components/Breadcrumbs.vue";
import ProductCatalog from "@/Components/Catalog.vue";
import Support from "@/Components/Support.vue";
import Footer from "@/Layouts/Footer.vue";

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
  <Head title="Catalog" />

  <div>
    <Annoucement>
      This is default text for Announcement header This is default text for Announcement
      header This is default text for Announcement header This is default text for
      Announcement header
    </Annoucement>

    <Header />

    <HeroCard class="hidden lg:block" />

    <div class="flex justify-center lg:justify-start">
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

    <Footer />
  </div>
</template>
