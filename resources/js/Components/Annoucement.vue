<script setup>
defineProps({
  description: {
    type: String,
    default:
      "lorem ipsum dolor sit amet, consectetur adipiscing elit lorem ipsum dolor sit amet, consectetur adipiscing elit lorem ipsum dolor sit amet, consectetur adipiscing elit elit lorem ipsum dolor sit amet, consectetur adipiscing elit ",
  },
});
</script>

<template>
  <Transition>
    <div class="bg-black">
      <div class="max-w-7xl mx-auto">
        <div class="hidden md:block overflow-hidden py-2">
          <div
            class="animate-slide uppercase text-md font-poppins whitespace-nowrap inline-block text-white"
          >
            <span>
              {{ description }}
            </span>
          </div>
        </div>
      </div>
    </div>
  </Transition>
</template>

<style scoped>
@keyframes slide {
  0% {
    transform: translateX(30%);
  }

  100% {
    transform: translateX(-100%);
  }
}

.animate-slide {
  animation: slide 50s linear infinite;
}
</style>
