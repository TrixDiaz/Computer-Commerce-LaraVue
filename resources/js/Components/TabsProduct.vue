<script setup>
import { ref } from 'vue';
import ProductCard from '@/Components/ProductCard.vue';
import VueCarousel from '@/Components/VueCarousel.vue';

const openTab = ref(1);
const response = ref([
    { id: 1, name: 'Motherboard powerful server motherboard', rating: '5' },
    { id: 2, name: 'Motherboard powerful server motherboard', rating: '3' },
    { id: 3, name: 'Motherboard powerful server motherboard', rating: '3' },
    { id: 4, name: 'Motherboard powerful server motherboard', rating: '1' },
    { id: 5, name: 'Motherboard powerful server motherboard', rating: '3' },
    { id: 5, name: 'Motherboard powerful server motherboard', rating: '3' },
]);
</script>

<template>
    <div class="max-w-7xl mx-auto mb-2">
        <div>
            <!-- Tab Buttons -->
            <div class="flex flex-row space-x-2 rounded-lg w-24 mb-1">
                <button @click="openTab = 1" :class="{ 'font-semibold': openTab === 1 }" class="flex-1 text-nowrap">
                    MSI GS Series
                </button>
                <button @click="openTab = 2" :class="{ 'font-semibold': openTab === 2 }" class="flex-1 text-nowrap">
                    MSI GT Series
                </button>
                <button @click="openTab = 3" :class="{ 'font-semibold': openTab === 3 }" class="flex-1 text-nowrap">
                    MSI GL Series
                </button>
            </div>

            <!-- Tab Content -->
            <div v-show="openTab === 1">
                <div class="flex flex-col sm:flex-row gap-2">
                    <!-- Image and Text -->
                    <div class="flex flex-col justify-center items-center h-full relative">
                        <img src="/images/msi-image.png" alt="MSI Laptops" class="mx-auto h-full">
                        <div class="absolute text-2xl text-white font-bold tracking-wider text-center">
                            <span class="block">MSI</span>
                            <span class="block">Laptops</span>
                            <p class="absolute mt-20 text-xs text-nowrap capitalize underline text-white">see all
                                products</p>
                        </div>
                    </div>

                    <!-- Carousel -->
                    <div class="flex-1">
                        <vueCarousel :products="response">
                            <template #default="{ product }">
                                <ProductCard :product="product" />
                            </template>
                        </vueCarousel>
                    </div>
                </div>
            </div>

            <div v-show="openTab === 2">
                <div class="flex flex-col sm:flex-row gap-2">
                    <div class="flex flex-col justify-center items-center h-full relative">
                        <img src="/images/msi-image.png" alt="MSI Laptops" class="mx-auto h-full">
                        <div class="absolute text-2xl text-white font-bold tracking-wider text-center">
                            <span class="block">Custom</span>
                            <span class="block">Builds</span>
                            <p class="absolute mt-20 text-xs text-nowrap capitalize underline text-white">see all
                                products</p>
                        </div>
                    </div>
                    <div class="flex-1">
                        <vueCarousel :products="response">
                            <template #default="{ product }">
                                <ProductCard :product="product" />
                            </template>
                        </vueCarousel>
                    </div>
                </div>
            </div>

            <div v-show="openTab === 3">
                <div class="flex flex-col sm:flex-row gap-2">
                    <div class="flex flex-col justify-center items-center h-full relative">
                        <img src="/images/msi-image.png" alt="MSI Laptops" class="mx-auto h-full">
                        <div class="absolute text-2xl text-white font-bold tracking-wider text-center">
                            <span class="block">Custom</span>
                            <span class="block">Builds</span>
                            <p class="absolute mt-20 text-xs text-nowrap capitalize underline text-white">see all
                                products</p>
                        </div>
                    </div>
                    <div class="flex-1">
                        <VueCarousel :products="response">
                            <template #default="{ product }">
                                <ProductCard :product="product" />
                            </template>
                        </VueCarousel>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

