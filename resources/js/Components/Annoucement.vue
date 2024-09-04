<script setup>
import { ref, onMounted } from "vue";

const title = ref("");
const description = ref("");

const fetchAnnouncementDescription = async () => {
  try {
    const response = await fetch(`/api/announcement`);
    if (!response.ok) {
      if (response.status === 404) {
        console.log("No active announcement found");
        return;
      }
      throw new Error("Network response was not ok");
    }
    const data = await response.json();
    if (data.announcement) {
      title.value = data.announcement.title;
      description.value = data.announcement.description;
    }
  } catch (error) {
    console.error("Error fetching announcement:", error);
  }
};

onMounted(() => {
  fetchAnnouncementDescription();
});
</script>

<template>
  <Transition>
    <div v-if="description" class="bg-black">
      <div class="max-w-7xl mx-auto">
        <div class="hidden md:block overflow-hidden py-2">
          <div
            class="animate-slide uppercase text-md font-poppins whitespace-nowrap inline-block text-white"
          >
            <span>{{ description }}</span>
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
  animation: slide 60s linear infinite;
}
</style>
