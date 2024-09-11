<script setup>
import { defineProps, ref, computed } from "vue";
import ProductCard from "@/Components/ProductCard.vue";
import VueCarousel from "@/Components/VueCarousel.vue";

const props = defineProps({
  products: {
    type: Array,
    required: true,
  },
  categories: {
    type: Array,
    required: true,
  },
});

const openTab = ref(props.categories[0]?.id || null);

const productsByCategory = computed(() => {
  return props.products.filter((product) => product.category.id === openTab.value);
});
</script>

<template>
  <div class="max-w-7xl mx-auto mb-2">
    <div>
      <!-- Dynamic Tab Buttons -->
      <div class="flex flex-row space-x-2 rounded-lg mb-1 overflow-x-auto">
        <button
          v-for="category in categories"
          :key="category.id"
          @click="openTab = category.id"
          :class="{ 'font-semibold': openTab === category.id }"
          class="flex-shrink-0 px-2 py-1 text-nowrap"
        >
          {{ category.name }}
        </button>
      </div>

      <!-- Dynamic Tab Content -->
      <div v-if="productsByCategory.length > 0">
        <div class="flex flex-row">
          <div class="flex flex-row">
            <div class="relative flex flex-col justify-center items-center">
              <img src="/images/msi-image.png" alt="picture" class="max-w-60 h-full" />
              <div
                class="absolute text-2xl text-white font-bold tracking-wider text-center"
              >
                <span class="block">Custom</span>
                <span class="block">Builds</span>
                <p
                  class="absolute mt-20 text-xs text-nowrap capitalize underline text-white"
                >
                  see all products
                </p>
              </div>
            </div>
            <div class="flex-1 overflow-hidden">
              <VueCarousel :products="productsByCategory">
                <template #default="{ product }">
                  <ProductCard :product="product" />
                </template>
              </VueCarousel>
            </div>
          </div>
        </div>
      </div>
      <div v-else class="text-center py-4">No products found for this category.</div>
    </div>
  </div>
</template>
