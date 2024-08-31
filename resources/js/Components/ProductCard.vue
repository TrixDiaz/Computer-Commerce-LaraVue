<script setup>
defineProps({
    product: {
        type: Object,
        required: true,
    },
});
</script>

<template>
    <div class="group/item relative rounded bg-white p-4 mb-6 max-w-60 hover:border hover:border-gray-200 hover:shadow">
        <div class="relative h-32 w-auto">
            <a href="#">
                <img class="mx-auto h-full group-hover/item:hidden" src="/images/laptop-image.png"
                    alt="Product Image" />

                <img class="mx-auto h-full hidden group-hover/item:block" src="/images/hover-image.png"
                    alt="Product Image" />
            </a>
        </div>
        <div>
            <div class="absolute top-2 right-2 hidden group-hover/item:block">
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

            <div class="mt-3 flex items-center justify-between gap-2">
                <p class="text-xl font-bold text-gray-900">₱1,699</p>
                <div class="hidden group-hover/item:block group-hover/item:duration-1000">
                    <button type="button"
                        class="inline-flex items-center rounded-full border border-blue-500 px-2 py-2 text-xs text-blue-600 hover:bg-blue-800 hover:text-white">
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
</template>

