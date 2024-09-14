<script setup>
import X from "@/Components/Icons/X.vue";
import Minus from "@/Components/Icons/Minus.vue";
import Plus from "@/Components/Icons/Plus.vue";
import { Link } from "@inertiajs/vue3";
</script>
<template>
  <div class="max-w-7xl mx-auto my-8">
    <section class="bg-white py-8 antialiased dark:bg-gray-900 md:py-16">
      <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
        <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">
          Shopping Cart
        </h2>

        <div class="mt-6 sm:mt-8 md:gap-6 lg:flex lg:items-start xl:gap-8">
          <div class="mx-auto w-full flex-none lg:max-w-2xl xl:max-w-4xl">
            <div class="space-y-6">
              <div
                class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800 md:p-6"
              >
                <div
                  class="space-y-4 md:flex md:items-center md:justify-between md:gap-6 md:space-y-0"
                >
                  <Link href="#" class="w-20 shrink-0 md:order-1">
                    <img
                      class="h-20 w-20 dark:hidden"
                      src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/iphone-light.svg"
                      alt="imac image"
                    />
                    <img
                      class="hidden h-20 w-20 dark:block"
                      src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/iphone-dark.svg"
                      alt="imac image"
                    />
                  </Link>

                  <label for="counter-input" class="sr-only">Choose quantity:</label>
                  <div
                    class="flex items-center justify-between md:order-3 md:justify-end"
                  >
                    <div class="flex items-center">
                      <button
                        type="button"
                        id="decrement-button-5"
                        data-input-counter-decrement="counter-input-5"
                        class="inline-flex h-5 w-5 shrink-0 items-center justify-center rounded-md border border-gray-300 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700"
                      >
                        <Minus class="h-2.5 w-2.5 text-gray-900 dark:text-white" />
                      </button>
                      <input
                        type="text"
                        id="counter-input-5"
                        data-input-counter
                        class="w-10 shrink-0 border-0 bg-transparent text-center text-sm font-medium text-gray-900 focus:outline-none focus:ring-0 dark:text-white"
                        placeholder=""
                        value="3"
                        required
                      />
                      <button
                        type="button"
                        id="increment-button-5"
                        data-input-counter-increment="counter-input-5"
                        class="inline-flex h-5 w-5 shrink-0 items-center justify-center rounded-md border border-gray-300 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700"
                      >
                        <Plus class="h-2.5 w-2.5 text-gray-900 dark:text-white" />
                      </button>
                    </div>
                    <div class="text-end md:order-4 md:w-32">
                      <p class="text-base font-bold text-gray-900 dark:text-white">
                        $2,997
                      </p>
                    </div>
                  </div>

                  <div class="w-full min-w-0 flex-1 space-y-4 md:order-2 md:max-w-md">
                    <a
                      href="#"
                      class="text-base font-medium text-gray-900 hover:underline dark:text-white"
                      >APPLE iPhone 15 5G phone, 256GB, Gold</a
                    >

                    <div class="flex items-center gap-4">
                      <button
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
                <div class="space-y-2">
                  <dl class="flex items-center justify-between gap-4">
                    <dt class="text-base font-normal text-gray-500 dark:text-gray-400">
                      Original price
                    </dt>
                    <dd class="text-base font-medium text-gray-900 dark:text-white">
                      $7,592.00
                    </dd>
                  </dl>

                  <dl class="flex items-center justify-between gap-4">
                    <dt class="text-base font-normal text-gray-500 dark:text-gray-400">
                      Savings
                    </dt>
                    <dd class="text-base font-medium text-green-600">-$299.00</dd>
                  </dl>

                  <dl class="flex items-center justify-between gap-4">
                    <dt class="text-base font-normal text-gray-500 dark:text-gray-400">
                      Store Pickup
                    </dt>
                    <dd class="text-base font-medium text-gray-900 dark:text-white">
                      $99
                    </dd>
                  </dl>

                  <dl class="flex items-center justify-between gap-4">
                    <dt class="text-base font-normal text-gray-500 dark:text-gray-400">
                      Tax
                    </dt>
                    <dd class="text-base font-medium text-gray-900 dark:text-white">
                      $799
                    </dd>
                  </dl>
                </div>

                <dl
                  class="flex items-center justify-between gap-4 border-t border-gray-200 pt-2 dark:border-gray-700"
                >
                  <dt class="text-base font-bold text-gray-900 dark:text-white">Total</dt>
                  <dd class="text-base font-bold text-gray-900 dark:text-white">
                    $8,191.00
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
                  href="#"
                  title=""
                  class="inline-flex items-center gap-2 text-sm font-medium text-slate-700 underline hover:no-underline dark:text-slate-500"
                >
                  Continue Shopping
                </a>
              </div>
            </div>

            <div
              class="space-y-4 rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800 sm:p-6"
            >
              <form class="space-y-4">
                <div>
                  <label
                    for="voucher"
                    class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"
                  >
                    Do you have a voucher or gift card?
                  </label>
                  <input
                    type="text"
                    id="voucher"
                    class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-slate-500 focus:ring-slate-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-slate-500 dark:focus:ring-slate-500"
                    placeholder=""
                    required
                  />
                </div>
                <button
                  type="submit"
                  class="flex w-full items-center justify-center rounded-lg bg-slate-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-slate-800 focus:outline-none focus:ring-4 focus:ring-slate-300 dark:bg-slate-600 dark:hover:bg-slate-700 dark:focus:ring-slate-800"
                >
                  Apply Code
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>
