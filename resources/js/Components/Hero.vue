<script setup>
import { computed, onMounted, ref, watch } from "vue";
import { useTrendingStore } from "@/Store/TrendShow";

const trendingStore = useTrendingStore();

const currentIndex = ref(0);

const backgroundImage = computed(() => {
  if (trendingStore.images.length > 0) {
    return `url(${trendingStore.images[currentIndex.value]})`;
  }
  return "url('https://placehold.co/600x400')";
});
let intervalId;

const startCarousel = () => {
  stopCarousel(); // Stop any existing interval
  intervalId = setInterval(() => {
    currentIndex.value = (currentIndex.value + 1) % trendingStore.images.length;
  }, 3000);
};

const stopCarousel = () => {
  clearInterval(intervalId);
};

// Fetch trending items when the component is mounted
onMounted(() => {
  trendingStore.fetchTrendingItems();
  // Remove startCarousel() from here
});

watch(
  () => trendingStore.images,
  (newImages) => {
    if (newImages.length > 0) {
      currentIndex.value = 0; // Reset to first image when new images are loaded
      startCarousel(); // Move startCarousel() here
    } else {
      stopCarousel();
    }
  },
  { immediate: true } // Add this option
);

const changeSlide = (index) => {
  currentIndex.value = index;
};
</script>

<template>
  <section
    :style="{ backgroundImage: backgroundImage }"
    class="bg-center bg-no-repeat bg-cover relative h-full flex items-center justify-center rounded-sm mb-2 max-w-7xl mx-auto z-0"
  >
    <div class="absolute inset-0 z-10"></div>
    <div
      class="relative z-20 text-center text-white pt-80 md:pt-60 md:mt-56 mb-6 md:mx-8 md:text-start text-wrap max-w-xl"
    >
      <div class="z-30 space-x-3 rtl:space-x-reverse flex justify-center">
        <button
          v-for="(image, index) in trendingStore.images"
          :key="index"
          :aria-current="currentIndex === index"
          :aria-label="'Slide ' + (index + 1)"
          :class="[
            'h-2 md:h-4 rounded-full transition-all duration-500 transform',
            currentIndex === index
              ? 'w-16 bg-teal-500 opacity-75'
              : 'w-4 bg-teal-500 opacity-50 hover:w-16 hover:bg-teal-500 hover:opacity-100',
          ]"
          @click="changeSlide(index)"
        ></button>
      </div>
    </div>
  </section>
</template>

<style scoped>
/* Ensure the background image transitions smoothly */
section {
  transition: background-image 1s ease-in-out;
}
</style>
