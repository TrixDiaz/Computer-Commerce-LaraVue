<script setup>
import { ref } from 'vue';
const isRowLayout = ref(false);
const setRowLayout = () => {
  isRowLayout.value = true;
};  
const setBlockLayout = () => {
  isRowLayout.value = false;
};
import PrimaryButton from '@/Components/PrimaryButton.vue';
const response = ref([
  {
    id: 1,
    name: 'Motherboard powerful server motherboard',
    rating: '5',
    username: 'John Doe',
    feedback: 'This is a great product This is a great product This is a great product',
    title: 'Motherboard powerful server motherboard',
  },
  {
    id: 2,
    name: 'Motherboard powerful server motherboard',
    rating: '3',
    username: 'John Doe',
    feedback: 'This is a great product This is a great product This is a great product This is a great product This is a great product',
    title: 'Motherboard powerful server motherboard',
  },
  {
    id: 3,
    name: 'Motherboard powerful server motherboard',
    rating: '3',
    username: 'John Doe',
    feedback: 'This is a great product This is a great product This is a great product This is a great product This is a great product',
    title: 'Motherboard powerful server motherboard',
  },
  {
    id: 4,
    name: 'Motherboard powerful server motherboard',
    rating: '1',
    username: 'John Doe',
    feedback: 'This is a great product This is a great product This is a great product This is a great productThis is a great product',
    title: 'Motherboard powerful server motherboard',
  },
  {
    id: 5,
    name: 'Motherboard powerful server motherboard',
    rating: '3',
    username: 'John Doe',
    feedback: 'This is a great product This is a great product This is a great product This is a great productThis is a great product',
    title: 'Motherboard powerful server motherboard',
  },
  {
    id: 6,
    name: 'Motherboard powerful server motherboard',
    rating: '3',
    username: 'John Doe',
    feedback: 'This is a great product This is a great product This is a great product This is a great product',
    title: 'Motherboard powerful server motherboard',
  },
  {
    id: 7,
    name: 'Motherboard powerful server motherboard',
    rating: '3',
    username: 'John Doe',
    feedback: 'This is a great product This is a great product This is a great product This is a great product',
    title: 'Motherboard powerful server motherboard',
  },
  {
    id: 8,
    name: 'Motherboard powerful server motherboard',
    rating: '3',
    username: 'John Doe',
    feedback: 'This is a great product This is a great product This is a great product This is a great product',
    title: 'Motherboard powerful server motherboard',
  },
  {
    id: 9,
    name: 'Motherboard powerful server motherboard',
    rating: '3',
    username: 'John Doe',
    feedback: 'This is a great product This is a great product This is a great product This is a great product',
    title: 'Motherboard powerful server motherboard',
  },
  {
    id: 10,
    name: 'Motherboard powerful server motherboard',
    rating: '3',
    username: 'John Doe',
    feedback: 'This is a great product This is a great product This is a great product This is a great product',
    title: 'Motherboard powerful server motherboard',
  },
  {
    id: 10,
    name: 'Motherboard powerful server motherboard',
    rating: '3',
    username: 'John Doe',
    feedback: 'This is a great product This is a great product This is a great product This is a great product',
    title: 'Motherboard powerful server motherboard',
  },
  {
    id: 10,
    name: 'Motherboard powerful server motherboard',
    rating: '3',
    username: 'John Doe',
    feedback: 'This is a great product This is a great product This is a great product This is a great product',
    title: 'Motherboard powerful server motherboard',
  },
  {
    id: 10,
    name: 'Motherboard powerful server motherboard',
    rating: '3',
    username: 'John Doe',
    feedback: 'This is a great product This is a great product This is a great product This is a great product',
    title: 'Motherboard powerful server motherboard',
  },
  {
    id: 10,
    name: 'Motherboard powerful server motherboard',
    rating: '3',
    username: 'John Doe',
    feedback: 'This is a great product This is a great product This is a great product This is a great product',
    title: 'Motherboard powerful server motherboard',
  },
  {
    id: 10,
    name: 'Motherboard powerful server motherboard',
    rating: '3',
    username: 'John Doe',
    feedback: 'This is a great product This is a great product This is a great product This is a great product',
    title: 'Motherboard powerful server motherboard',
  },
  {
    id: 10,
    name: 'Motherboard powerful server motherboard',
    rating: '3',
    username: 'John Doe',
    feedback: 'This is a great product This is a great product This is a great product This is a great product',
    title: 'Motherboard powerful server motherboard',
  },
]);
</script>

<template>
    <div class="max-w-7xl mx-auto pt-2">
      <div class="flex flex-none justify-center items-center my-2 gap-2">
        <div class="hidden lg:flex flex-none w-64 justify-center items-center cursor-pointer">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="lucide lucide-chevron-left">
            <path d="m15 18-6-6 6-6" />
          </svg>
          <p class="text-lg font-bold">Back</p>
        </div>
        <div class="flex flex-col md:flex-row flex-1 justify-between items-center">
          <p class="text-gray-400 text-sm tracking-tight">Items 1-35 of 61</p>
          <!-- Dropdowns Container -->
          <div class="flex flex-col md:flex-row items-center gap-4">
            <!-- Left Dropdown -->
            <div class="relative">
              <div class="relative w-56">
                <input class="peer hidden" type="checkbox" name="select-1" id="select-1" />
                <label for="select-1"
                  class="flex w-full cursor-pointer select-none rounded-lg border p-2 px-3 text-sm text-gray-700 ">Select
                  Option </label>
                <svg xmlns="http://www.w3.org/2000/svg"
                  class="pointer-events-none absolute right-0 top-3 ml-auto mr-5 h-4 text-gray-600 transition peer-checked:rotate-180"
                  fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                </svg>
                <ul
                  class="absolute z-50 bg-white w-full rounded-b-lg shadow-xl transition-all duration-300 peer-checked:max-h-56 peer-checked:py-3 overflow-hidden max-h-0 flex-col">
                  <li class="cursor-pointer px-3 py-2 text-sm text-gray-500 hover:bg-blue-500 hover:text-white">Nikola
                    Tesla
                  </li>
                  <li class="cursor-pointer px-3 py-2 text-sm text-gray-500 hover:bg-blue-500 hover:text-white">Lorem
                    Ipsanum</li>
                  <li class="cursor-pointer px-3 py-2 text-sm text-gray-500 hover:bg-blue-500 hover:text-white">Albert
                    Einstein</li>
                </ul>
              </div>
            </div>
  
            <!-- Right Dropdown -->
            <div class="relative">
              <div class="relative w-56">
                <input class="peer hidden" type="checkbox" name="select-2" id="select-2" />
                <label for="select-2"
                  class="flex w-full cursor-pointer select-none rounded-lg border p-2 px-3 text-sm text-gray-700 ">Select
                  Option 2 </label>
                <svg xmlns="http://www.w3.org/2000/svg"
                  class="pointer-events-none absolute right-0 top-3 ml-auto mr-5 h-4 text-gray-600 transition peer-checked:rotate-180"
                  fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                </svg>
                <ul
                  class="absolute z-50 bg-white w-full rounded-b-lg shadow-xl transition-all duration-300 peer-checked:max-h-56 peer-checked:py-3 overflow-hidden max-h-0 flex-col">
                  <li class="cursor-pointer px-3 py-2 text-sm text-gray-500 hover:bg-blue-500 hover:text-white">Isaac
                    Newton
                  </li>
                  <li class="cursor-pointer px-3 py-2 text-sm text-gray-500 hover:bg-blue-500 hover:text-white">Marie
                    Curie</li>
                  <li class="cursor-pointer px-3 py-2 text-sm text-gray-500 hover:bg-blue-500 hover:text-white">Galileo
                    Galilei</li>
                </ul>
              </div>
            </div>
            <!-- Layout Button -->
            <div class="flex flex-row space-x-4">
              <!-- Layout Block Icon-->
              <svg @click="setBlockLayout" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-grip cursor-pointer hover:bg-gray-200 rounded-md p-0.5">
                <circle cx="12" cy="5" r="1" />
                <circle cx="19" cy="5" r="1" />
                <circle cx="5" cy="5" r="1" />
                <circle cx="12" cy="12" r="1" />
                <circle cx="19" cy="12" r="1" />
                <circle cx="5" cy="12" r="1" />
                <circle cx="12" cy="19" r="1" />
                <circle cx="19" cy="19" r="1" />
                <circle cx="5" cy="19" r="1" />
              </svg>
              <!-- Layout Row Icon-->
              <svg @click="setRowLayout" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-align-left cursor-pointer hover:bg-gray-200 rounded-md p-0.5">
                <line x1="21" x2="3" y1="6" y2="6" />
                <line x1="15" x2="3" y1="12" y2="12" />
                <line x1="17" x2="3" y1="18" y2="18" />
              </svg>
            </div>
          </div>
          <!-- End of Dropdowns Container -->
        </div>
      </div>
    </div>
    <div class="max-w-7xl mx-auto flex min-h-screen my-4">
      <!-- Sidebar -->
      <aside class="hidden lg:block w-64">
        <!-- Sidebar content (e.g., filters) -->
        <slot name="sidebar">
          <div class="bg-blue-50 border-r border-gray-400 p-4 mb-2">
            <h3 class="font-bold text-lg text-center mb-4 capitalize">Filters</h3>
            <PrimaryButton class="w-full rounded-full bg-transparent border border-gray-400 text-gray-400">Clear Filter
            </PrimaryButton>
            <!-- Category Dropdown -->
            <div class="relative">
              <div class="relative w-56">
                <input class="peer hidden" checked type="checkbox" name="select-3" id="select-3" />
                <label for="select-3"
                  class="flex w-full cursor-pointer select-none rounded-lg p-2 px-3 text-md font-bold text-gray-700 mt-4">Category</label>
                <svg xmlns="http://www.w3.org/2000/svg"
                  class="pointer-events-none absolute right-0 top-3 ml-auto mr-3 h-4 text-gray-600 transition peer-checked:rotate-180"
                  fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                </svg>
                <ul
                  class="relative w-full transition-all duration-300 peer-checked:max-h-56 peer-checked:py-0 overflow-hidden max-h-0 flex-col">
                  <li
                    class="flex flex-row justify-between items-center cursor-pointer px-3 py-1 text-sm text-gray-500 hover:bg-blue-500 hover:text-white">
                    <p>Isaac newton</p>
                    <p>56</p>
                  </li>
                  <li
                    class="flex flex-row justify-between items-center cursor-pointer px-3 py-1 text-sm text-gray-500 hover:bg-blue-500 hover:text-white">
                    <p>Isaac newton</p>
                    <p>56</p>
                  </li>
                  <li
                    class="flex flex-row justify-between items-center cursor-pointer px-3 py-1 text-sm text-gray-500 hover:bg-blue-500 hover:text-white">
                    <p>Isaac newton</p>
                    <p>56</p>
                  </li>
                </ul>
              </div>
            </div>
            <!-- Price Dropdown -->
            <div class="relative">
              <div class="relative w-56">
                <input class="peer hidden" checked type="checkbox" name="select-4" id="select-4" />
                <label for="select-4"
                  class="flex w-full cursor-pointer select-none rounded-lg p-2 px-3 text-md font-bold text-gray-700 mt-4">Category</label>
                <svg xmlns="http://www.w3.org/2000/svg"
                  class="pointer-events-none absolute right-0 top-3 ml-auto mr-3 h-4 text-gray-600 transition peer-checked:rotate-180"
                  fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                </svg>
                <ul
                  class="relative w-full transition-all duration-300 peer-checked:max-h-56 peer-checked:py-0 overflow-hidden max-h-0 flex-col">
                  <li
                    class="flex flex-row justify-between items-center cursor-pointer px-3 py-1 text-sm text-gray-500 hover:bg-blue-500 hover:text-white">
                    <p>Isaac newton</p>
                    <p>56</p>
                  </li>
                  <li
                    class="flex flex-row justify-between items-center cursor-pointer px-3 py-1 text-sm text-gray-500 hover:bg-blue-500 hover:text-white">
                    <p>Isaac newton</p>
                    <p>56</p>
                  </li>
                  <li
                    class="flex flex-row justify-between items-center cursor-pointer px-3 py-1 text-sm text-gray-500 hover:bg-blue-500 hover:text-white">
                    <p>Isaac newton</p>
                    <p>56</p>
                  </li>
                </ul>
              </div>
            </div>
            <!-- Button Dropdown -->
            <div class="relative">
              <div class="relative w-56">
                <input class="peer hidden" checked type="checkbox" name="select-5" id="select-5" />
                <label for="select-5"
                  class="flex w-full cursor-pointer select-none rounded-lg p-2 px-3 text-md font-bold text-gray-700 mt-4">Category</label>
                <svg xmlns="http://www.w3.org/2000/svg"
                  class="pointer-events-none absolute right-0 top-3 ml-auto mr-3 h-4 text-gray-600 transition peer-checked:rotate-180"
                  fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                </svg>
                <ul
                  class="relative w-full transition-all duration-300 peer-checked:max-h-56 peer-checked:py-0 overflow-hidden max-h-0 flex-col">
                  <li>
                    <PrimaryButton class="bg-blue-500 text-white w-full rounded-full">Apply Filter (2)</PrimaryButton>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="bg-blue-50 border-r border-gray-400 p-4">
            <h3 class="font-bold text-lg text-center my-4 capitalize">Brands</h3>
            <PrimaryButton class="w-full rounded-full bg-transparent border border-gray-400 text-gray-400">All Brands
            </PrimaryButton>
          </div>
          <div class="max-w-sm mx-auto place-content-center">
            <div class="grid grid-cols-2 place-content-center">
              <img src="/images/roccat.png" class="w-24" alt="Roccat logo">
              <img src="/images/msi.png" class="w-24" alt="MSI logo">
              <img src="/images/razer.png" class="w-24" alt="Razer logo">
              <img src="/images/melmet.png" class="w-24" alt="Melmet logo">
              <img src="/images/adata.png" class="w-24" alt="Adata logo">
              <img src="/images/hp.png" class="w-24" alt="HP logo">
              <img src="/images/gigabyte.png" class="w-24" alt="Gigabyte logo">
            </div>
          </div>
          <div>
            <img src="/images/noblechair.png" class="w-full h-full object-contain" alt="Roccat logo">
          </div>
        </slot>
      </aside>
  
      <!-- Main content area -->
      <main class="flex-1 px-2">
        <slot name="content">
          <!-- Filter Section -->
          <div class="hidden">
            <div class="flex flex-row gap-2">
              <div class="flex flex-row border px-4 py-2 space-x-1">
                <p class="text-black font-bold capitalize">Custom PCS(24)</p>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="#dc2626"
                  stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                  class="lucide lucide-circle-x text-white">
                  <circle cx="12" cy="12" r="10" />
                  <path d="m15 9-6 6" />
                  <path d="m9 9 6 6" />
                </svg>
              </div>
              <div class="flex flex-row border px-4 py-2 space-x-1">
                <p class="text-black font-bold capitalize">HP/COMPAC PCS(24)</p>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="#dc2626"
                  stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                  class="lucide lucide-circle-x text-white">
                  <circle cx="12" cy="12" r="10" />
                  <path d="m15 9-6 6" />
                  <path d="m9 9 6 6" />
                </svg>
              </div>
              <div class="flex flex-row border px-4 py-2 space-x-1">
                <p class="text-black font-bold capitalize">clear all</p>
              </div>
            </div>
          </div>
          <!-- End Filter Section -->
          <!-- This will be where the main content (e.g., product cards) goes -->
          <main class="flex-1 px-2">
            <div
              :class="isRowLayout ? 'grid grid-cols-1 w-full relative' : 'relative grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4'"
              class="place-items-center gap-2 p-1 lg:p-4 w-full">
              <!-- Product Card -->
              <div v-for="product in response.slice(0, 5)" :key="product.id"
                :class="isRowLayout ? 'flex flex-row items-center bg-white p-1 lg:p-4 shadow rounded mb-4 w-full' : 'group/item relative bg-white p-4 mb-6 max-w-60 hover:border hover:border-gray-200 hover:shadow w-full'"
                class="group/item">
                <!-- Image -->
                <div class="relative h-32 w-auto">
                  <a href="#">
                    <img class="mx-auto h-full group-hover/item:hidden" src="/images/laptop-image.png"
                      alt="Product Image" />
  
                    <img class="mx-auto h-full hidden group-hover/item:block" src="/images/hover-image.png"
                      alt="Product Image" />
                  </a>
                </div>
                <!-- Add to Card and Eye Icon -->
                <div
                  :class="isRowLayout
                   ? 'group-hover/item:block absolute top-8 right-8' 
                   : 'absolute top-2 right-2 group-hover/item:block'"
                  class="hidden"
                  >
                  <div class="flex flex-col items-center gap-1">
                    <button type="button"
                      class="p-1 text-gray-500 border rounded-full hover:bg-gray-100 hover:text-gray-900">
                      <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 6C6.5 1 1 8 5.8 13l6.2 7 6.2-7C23 8 17.5 1 12 6Z" />
                      </svg>
                    </button>
                    <button type="button"
                      class="p-1 text-gray-500 border rounded-full hover:bg-gray-100 hover:text-gray-900">
                      <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-width="2"
                          d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z" />
                        <path stroke="currentColor" stroke-width="2" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                      </svg>
                    </button>
                  </div>
                </div>
                <!-- Description -->
                <div class="relative">
                  <!-- Use the product data -->
                  <a href="#"
                    class="text-sm text-wrap font-semibold leading-tight tracking-tight line-clamp-2 text-gray-900 hover:underline">
                    {{ product.name }}
                  </a>
  
                  <div class="my-2 flex items-center justify-between gap-2">
                    <span class="rounded bg-primary-100 py-0.5 text-xs font-medium text-primary-800">Up to 35%
                      off</span>
                  </div>
  
                  <div class="mt-2 flex items-center gap-1">
                    <div class="flex items-center">
                      <!-- Example of showing the rating -->
                      <svg v-for="i in parseInt(product.rating)" :key="i" class="h-3 w-3 text-yellow-400"
                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                        <path
                          d="M13.8 4.2a2 2 0 0 0-3.6 0L8.4 8.4l-4.6.3a2 2 0 0 0-1.1 3.5l3.5 3-1 4.4c-.5 1.7 1.4 3 2.9 2.1l3.9-2.3 3.9 2.3c1.5 1 3.4-.4 3-2.1l-1-4.4 3.4-3a2 2 0 0 0-1.1-3.5l-4.6-.3-1.8-4.2Z" />
                      </svg>
                    </div>
                    <p class="text-xs font-medium text-gray-900">{{ product.rating }}</p>
                  </div>
  
                  <ul class="mt-2 flex items-center gap-2">
                    <li class="flex items-center gap-1">
                      <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="lucide lucide-info">
                        <circle cx="12" cy="12" r="10" />
                        <path d="M12 16v-4" />
                        <path d="M12 8h.01" />
                      </svg>
                      <p class="text-xs font-medium text-gray-500 capitalize">in stock</p>
                    </li>
                  </ul>
  
                  <div class="mt-3 flex justify-start items-center gap-2 space-x-2 w-full">
                    <p class="text-xl font-bold text-gray-900">₱1,699</p>
                    <div :class="isRowLayout ? ' flex flex-row items-center gap-2' : 'hidden group-hover/item:block'"
                      class="">
                      <button type="button"
                        class="inline-flex items-center rounded-full border border-blue-500 px-2 py-2 text-xs text-blue-600 hover:bg-blue-800 hover:text-white w-full">
                        <svg class="me-1 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 4h1.5L8 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm.75-3H7.5M11 7H6.312M17 4v6m-3-3h6" />
                        </svg>
                        Add to cart
                      </button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- End of Product Card -->
            </div>
            <!-- Pagination -->
            <div class="container mx-auto px-4">
              <nav class="flex flex-row flex-nowrap justify-between md:justify-center items-center space-x-4"
                aria-label="Pagination">
                <!-- Previous Page Button -->
                <a class="flex w-10 h-10 mr-1 justify-center items-center rounded-full border border-gray-400" href="#"
                  title="Previous Page">
                  <span class="sr-only">Previous Page</span>
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="block w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                  </svg>
                </a>
                <!-- Page Buttons (1 to 5) -->
                <a class="hidden md:flex w-10 h-10 mx-1 justify-center items-center rounded-full border border-gray-400"
                  href="#" title="Page 1">
                  1
                </a>
                <a class="hidden md:flex w-10 h-10 mx-1 justify-center items-center rounded-full border border-gray-400"
                  href="#" title="Page 2">
                  2
                </a>
                <a class="hidden md:flex w-10 h-10 mx-1 justify-center items-center rounded-full border border-gray-400 bg-gray-300"
                  href="#" aria-current="page" title="Page 3">
                  3
                </a>
                <a class="hidden md:flex w-10 h-10 mx-1 justify-center items-center rounded-full border border-gray-400"
                  href="#" title="Page 4">
                  4
                </a>
                <a class="hidden md:flex w-10 h-10 mx-1 justify-center items-center rounded-full border border-gray-400"
                  href="#" title="Page 5">
                  5
                </a>
                <!-- Next Page Button -->
                <a class="flex w-10 h-10 ml-1 justify-center items-center rounded-full border border-gray-400" href="#"
                  title="Next Page">
                  <span class="sr-only">Next Page</span>
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="block w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                  </svg>
                </a>
              </nav>
            </div>
            <!-- End of Pagination -->
          </main>
        </slot>
      </main>
    </div>
  </template>
  
  