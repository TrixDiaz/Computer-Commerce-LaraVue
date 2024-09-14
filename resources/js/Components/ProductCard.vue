<script setup>
import { computed } from "vue";
import { useCartStore } from "@/Store/CartStore";
import Heart from "@/Components/Icons/Heart.vue";
import Info from "@/Components/Icons/Info.vue";

const cartStore = useCartStore();

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

const addToCart = () => {
  cartStore.addItem({
    id: props.product.id,
    name: props.product.name,
    price: props.product.is_sale === 1 ? props.product.sale_price : props.product.price,
    image: props.product.image_url || "/images/laptop-image.png",
    url: `/products/${props.product.id}`, // Adjust this URL as needed
  });
};
</script>

<template>
  <div
    class="group/item relative bg-white p-6 mb-6 max-w-72 rounded-lg transition-all duration-300 hover:shadow-lg hover:scale-105 w-full"
  >
    <div class="relative h-48 w-full overflow-hidden">
      <a href="#" class="block h-full w-full">
        <img
          v-if="product.image_url === null"
          class="w-full h-full object-cover group-hover/item:opacity-0 transition-opacity duration-300 ease-in-out"
          src="/images/laptop-image.png"
          alt="Product Image"
        />
        <img
          v-else
          class="w-full h-full object-cover group-hover/item:opacity-0 transition-opacity duration-300 ease-in-out"
          :src="product.image_url"
          alt="Product Image"
        />

        <img
          v-if="product.hover_image_url === null"
          class="w-full h-full object-cover opacity-0 group-hover/item:opacity-100 absolute inset-0 transition-opacity duration-300 ease-in-out"
          src="/images/hover-image.png"
          alt="Product Image"
        />
        <img
          v-else
          class="w-full h-full object-cover opacity-0 group-hover/item:opacity-100 absolute inset-0 transition-opacity duration-300 ease-in-out"
          :src="product.hover_image_url"
          alt="Product Image"
        />
      </a>
    </div>
    <div>
      <div
        class="absolute top-2 right-2 opacity-0 group-hover/item:opacity-100 transition-opacity duration-300 ease-in-out"
      >
        <div class="flex flex-col items-center gap-1">
          <button
            type="button"
            class="p-1 text-transparent rounded-full hover:bg-red-300"
          >
            <Heart class="w-7 h-7" />
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
        <div
          class="opacity-0 group-hover/item:opacity-100 transition-opacity duration-300 ease-in-out"
        >
          <button
            type="button"
            @click="addToCart"
            class="w-full items-center rounded-full border border-blue-500 px-2 py-2 text-xs text-blue-600 hover:bg-blue-800 hover:text-white transition-colors duration-300 ease-in-out"
          >
            Add to cart
          </button>
        </div>
      </div>
    </div>
  </div>
</template>
