<script setup>
import { useCartStore } from "@/Store/CartStore";
import { storeToRefs } from "pinia";
import X from "@/Components/Icons/X.vue";
import Minus from "@/Components/Icons/Minus.vue";
import Plus from "@/Components/Icons/Plus.vue";
import { Link } from "@inertiajs/vue3";

const cartStore = useCartStore();
const { items, totalPrice } = storeToRefs(cartStore);

const updateQuantity = (productId, newQuantity) => {
  if (newQuantity > 0) {
    cartStore.updateQuantity(productId, newQuantity);
  }
};
</script>

<template>
  <div class="max-w-7xl mx-auto my-8">
    <section class="bg-white py-8 antialiased dark:bg-gray-900 md:py-16">
      <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
        <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">
          Shopping Cart
        </h2>

        <div
          v-if="items.length > 0"
          class="mt-6 sm:mt-8 md:gap-6 lg:flex lg:items-start xl:gap-8"
        >
          <div class="mx-auto w-full flex-none lg:max-w-2xl xl:max-w-4xl">
            <div class="space-y-6">
              <div
                v-for="item in items"
                :key="item.id"
                class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800 md:p-6"
              >
                <div
                  class="space-y-4 md:flex md:items-center md:justify-between md:gap-6 md:space-y-0"
                >
                  <Link :href="item.url" class="group/item w-20 shrink-0 md:order-1">
                    <div class="relative w-20 h-20 overflow-hidden">
                      <img
                        v-if="item.image_url === null"
                        class="w-full h-full object-cover group-hover/item:opacity-0 transition-opacity duration-300 ease-in-out"
                        src="/images/laptop-image.png"
                        alt="Product Image"
                      />
                      <img
                        v-else
                        class="w-full h-full object-cover group-hover/item:opacity-0 transition-opacity duration-300 ease-in-out"
                        :src="item.image_url"
                        alt="Product Image"
                      />

                      <img
                        v-if="item.hover_image_url === null"
                        class="w-full h-full object-cover opacity-0 group-hover/item:opacity-100 absolute inset-0 transition-opacity duration-300 ease-in-out"
                        src="/images/hover-image.png"
                        alt="Product Image"
                      />
                      <img
                        v-else
                        class="w-full h-full object-cover opacity-0 group-hover/item:opacity-100 absolute inset-0 transition-opacity duration-300 ease-in-out"
                        :src="item.hover_image_url"
                        alt="Product Image"
                      />
                    </div>
                  </Link>

                  <div
                    class="flex items-center justify-between md:order-3 md:justify-end"
                  >
                    <div class="flex items-center">
                      <button
                        @click="updateQuantity(item.id, item.quantity - 1)"
                        class="inline-flex h-5 w-5 shrink-0 items-center justify-center rounded-md border border-gray-300 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700"
                      >
                        <Minus class="h-2.5 w-2.5 text-gray-900 dark:text-white" />
                      </button>
                      <input
                        type="text"
                        :value="item.quantity"
                        @input="updateQuantity(item.id, $event.target.value)"
                        class="w-10 shrink-0 border-0 bg-transparent text-center text-sm font-medium text-gray-900 focus:outline-none focus:ring-0 dark:text-white"
                      />
                      <button
                        @click="updateQuantity(item.id, item.quantity + 1)"
                        class="inline-flex h-5 w-5 shrink-0 items-center justify-center rounded-md border border-gray-300 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700"
                      >
                        <Plus class="h-2.5 w-2.5 text-gray-900 dark:text-white" />
                      </button>
                    </div>
                    <div class="text-end md:order-4 md:w-32">
                      <p class="text-base font-bold text-gray-900 dark:text-white">
                        ${{ item.price }}
                      </p>
                    </div>
                  </div>

                  <div class="w-full min-w-0 flex-1 space-y-4 md:order-2 md:max-w-md">
                    <a
                      :href="item.url"
                      class="text-base font-medium text-gray-900 hover:underline dark:text-white"
                      >{{ item.name }}</a
                    >

                    <div class="flex items-center gap-4">
                      <button
                        @click="cartStore.removeItem(item.id)"
                        type="button"
                        class="inline-flex items-center text-sm font-medium text-red-600 hover:underline dark:text-red-500"
                      >
                        <X class="me-1.5 h-5 w-5" />
                        Remove
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="mx-auto mt-6 max-w-4xl flex-1 space-y-6 lg:mt-0 lg:w-full">
            <div
              class="space-y-4 rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800 sm:p-6"
            >
              <p class="text-xl font-semibold text-gray-900 dark:text-white">
                Order summary
              </p>

              <div class="space-y-4">
                <dl
                  class="flex items-center justify-between gap-4 border-t border-gray-200 pt-2 dark:border-gray-700"
                >
                  <dt class="text-base font-bold text-gray-900 dark:text-white">Total</dt>
                  <dd class="text-base font-bold text-gray-900 dark:text-white">
                    ${{ totalPrice.toFixed(2) }}
                  </dd>
                </dl>
              </div>

              <Link
                href="#"
                class="flex w-full items-center justify-center rounded-lg bg-slate-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-slate-800 focus:outline-none focus:ring-4 focus:ring-slate-300 dark:bg-slate-600 dark:hover:bg-slate-700 dark:focus:ring-slate-800"
                >Proceed to Checkout</Link
              >

              <div class="flex items-center justify-center gap-2">
                <span class="text-sm font-normal text-gray-500 dark:text-gray-400">
                  or
                </span>
                <a
                  :href="route('catalog.index')"
                  title=""
                  class="inline-flex items-center gap-2 text-sm font-medium text-slate-700 underline hover:no-underline dark:text-slate-500"
                >
                  Continue Shopping
                </a>
              </div>
            </div>

            <!-- Voucher form (unchanged) -->
          </div>
        </div>

        <div v-else class="mt-6 text-center">
          <p class="text-lg text-gray-600 dark:text-gray-400">Your cart is empty.</p>
        </div>
      </div>
    </section>
  </div>
</template>
