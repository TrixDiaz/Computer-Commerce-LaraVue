<script setup>
import {computed, onMounted, onUnmounted, ref} from 'vue';

const images = [
  '/images/carousel1.png',
  '/images/carousel2.png',
  '/images/carousel3.png',
  '/images/carousel1.png',
  '/images/carousel2.png',
  '/images/carousel3.png',
];
const currentIndex = ref(0);

const backgroundImage = computed(() => `url(${images[currentIndex.value]})`);

let intervalId;

const startCarousel = () => {
  intervalId = setInterval(() => {
    currentIndex.value = (currentIndex.value + 1) % images.length;
  }, 3000); // Change image every 3 seconds
};

const stopCarousel = () => {
  clearInterval(intervalId);
};

onMounted(() => {
  startCarousel();
});

onUnmounted(() => {
  stopCarousel();
});

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
            v-for="(image, index) in images"
            :key="index"
            :aria-current="currentIndex === index"
            :aria-label="'Slide ' + (index + 1)"
            :class="[
            'h-2 md:h-4 rounded-full transition-all duration-500 transform',
            currentIndex === index ? 'w-16 bg-teal-500 opacity-75' : 'w-4 bg-teal-500 opacity-50 hover:w-16 hover:bg-teal-500 hover:opacity-100'
          ]"
            @click="changeSlide(index)"
        >
        </button>
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
