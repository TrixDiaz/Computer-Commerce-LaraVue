<script setup>
import { computed } from "vue";
import Heart from "@/Components/Icons/Heart.vue";
import Eye from "@/Components/Icons/Eye.vue";
import Info from "@/Components/Icons/Info.vue";

const props = defineProps({
  product: {
    type: Object,
    required: true,
  },
});

const salePercentage = computed(() => {
  if (props.product.is_sale === 1 && props.product.price && props.product.sale_price) {
    const discount = props.product.price - props.product.sale_price;
    return Math.round((discount / props.product.price) * 100) + "%";
  }
  return null;
});
</script>

<template>
  <div
    class="group/item relative rounded bg-white p-4 mb-6 max-w-60 hover:border hover:border-gray-200 hover:shadow"
  >
    <div class="relative h-32 w-auto">
      <a href="#">
        <img
          v-if="product.image === null"
          class="mx-auto h-full group-hover/item:hidden"
          src="/images/laptop-image.png"
        />
        <img
          v-else
          class="mx-auto h-full group-hover/item:hidden"
          :src="'/storage/' + product.image"
        />

        <img
          class="mx-auto h-full hidden group-hover/item:block"
          src="/images/hover-image.png"
          alt="Product Image"
        />
      </a>
    </div>
    <div>
      <div class="absolute top-2 right-2 hidden group-hover/item:block">
        <div class="flex flex-col items-center gap-1">
          <button
            type="button"
            class="p-1 text-gray-500 border rounded-full hover:bg-gray-100 hover:text-gray-900"
          >
            <Heart />
          </button>
          <button
            type="button"
            class="p-1 text-gray-500 border rounded-full hover:bg-gray-100 hover:text-gray-900"
          >
            <Eye />
          </button>
        </div>
      </div>
      <a
        href="#"
        class="text-sm text-wrap font-semibold leading-tight tracking-tight line-clamp-2 text-gray-900 hover:underline"
      >
        {{ product.name }}
      </a>

      <div class="my-2 flex items-center justify-between gap-2">
        <span
          v-if="salePercentage"
          class="rounded bg-primary-100 py-0.5 px-1.5 text-xs font-medium text-primary-800 capitalize"
        >
          {{ salePercentage }} off
        </span>
      </div>

      <div class="mt-2 flex items-center gap-1">
        <div class="flex items-center">
          <svg
            v-for="i in parseInt(product.rating ?? 0)"
            :key="i"
            class="h-3 w-3 text-yellow-400"
            xmlns="http://www.w3.org/2000/svg"
            fill="currentColor"
            viewBox="0 0 24 24"
          >
            <path
              d="M13.8 4.2a2 2 0 0 0-3.6 0L8.4 8.4l-4.6.3a2 2 0 0 0-1.1 3.5l3.5 3-1 4.4c-.5 1.7 1.4 3 2.9 2.1l3.9-2.3 3.9 2.3c1.5 1 3.4-.4 3-2.1l-1-4.4 3.4-3a2 2 0 0 0-1.1-3.5l-4.6-.3-1.8-4.2Z"
            />
          </svg>
        </div>
        <p class="text-xs font-medium text-gray-900">
          {{ product.rating ?? "No rating yet" }}
        </p>
      </div>

      <ul class="mt-2 flex items-center gap-2">
        <li class="flex items-center gap-1">
          <Info />
          <p class="text-xs font-medium text-gray-500 capitalize">in stock</p>
        </li>
      </ul>

      <div class="mt-3 *:first-letter:flex items-center justify-between">
        <p class="text-xl font-bold text-gray-900">
          <span class="leading-2" v-if="product.is_sale === 1">
            ₱ {{ product.sale_price }}
            <span class="text-xs line-through text-gray-500">{{ product.price }}</span>
          </span>
          <span v-else>₱ {{ product.price }}</span>
        </p>
        <div class="hidden group-hover/item:block group-hover/item:duration-1000">
          <button
            type="button"
            class="w-full items-center rounded-full border border-blue-500 px-2 py-2 text-xs text-blue-600 hover:bg-blue-800 hover:text-white"
          >
            Add to cart
          </button>
        </div>
      </div>
    </div>
  </div>
</template>
