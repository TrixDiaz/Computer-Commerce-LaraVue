<script setup>
import { ref } from 'vue';
import { Head } from '@inertiajs/vue3';
import Annoucement from '@/Components/Annoucement.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import HeroCard from '@/Components/HeroCard.vue';
import Breadcrumbs from '@/Components/Breadcrumbs.vue';
import HeaderNav from '@/Layouts/Header.vue';
import Footer from '@/Layouts/Footer.vue';

const openTab = ref(1);
</script>

<template>

    <Head title="Product" />

    <div>
        <!-- Announcement Header -->
        <Annoucement>
            This is default text for Announcement header
            This is default text for Announcement header
            This is default text for Announcement header
            This is default text for Announcement header
        </Annoucement>

        <!-- Navigation Header -->
        <HeaderNav />

        <div class="max-w-7xl mx-auto">
            <!-- Product Information Section -->
            <div class="flex flex-col sm:flex-row justify-between items-center py-8 mx-2">
                <!-- Tab Buttons -->
                <div>
                    <div class="flex flex-row space-x-4 rounded-lg w-52 mb-1">
                        <button @click="openTab = 1" :class="{ 'font-semibold text-black underline': openTab === 1 }"
                            class="flex-1 text-nowrap" aria-controls="about-product" aria-selected="openTab === 1">
                            About Product
                        </button>
                        <button @click="openTab = 2" :class="{ 'font-semibold text-black underline': openTab === 2 }"
                            class="flex-1 text-nowrap" aria-controls="product-details" aria-selected="openTab === 2">
                            Details
                        </button>
                        <button @click="openTab = 3" :class="{ 'font-semibold text-black underline': openTab === 3 }"
                            class="flex-1 text-nowrap" aria-controls="product-specs" aria-selected="openTab === 3">
                            Specs
                        </button>
                    </div>
                </div>

                <!-- Purchase Section -->
                <div class="flex flex-col-reverse sm:flex-row justify-center items-center space-y-2 md:space-y-0 gap-4">
                    <p class="capitalize">
                        On sale from
                        <span class="text-black font-semibold">₱3,299.00</span>
                    </p>
                    <input type="number" value="1" min="1" class="w-16 bg-blue-50 rounded-md border-transparent"
                        aria-label="Quantity" />
                    <SecondaryButton>Add to Cart</SecondaryButton>
                    <PrimaryButton class="rounded-full bg-blue-500 text-white">GCash</PrimaryButton>
                </div>
            </div>

            <!-- Tab Content and Image Section -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                <!-- Tab Content -->
                <div class="flex flex-col justify-start items-start h-full w-full px-8 py-4">
                    <div>
                        <Breadcrumps />
                    </div>

                    <!-- About Product Tab -->
                    <div v-show="openTab === 1" id="about-product">
                        <div class="flex flex-col justify-start items-start max-w-xl mx-auto gap-2 mt-4">
                            <p class="text-5xl font-semibold my-4">MSI MPG Trident 3</p>
                            <p class="text-blue-500 underline text-sm cursor-pointer">Be the first to review this
                                product</p>
                            <p>
                                MSI MPG Trident 3 10SC-005AU Intel i7 10700F, 2060 SUPER, 16GB RAM, 512GB SSD, 2TB HDD,
                                Windows 10 Home,
                                Gaming Keyboard and Mouse, 3 Years Warranty Gaming Desktop.
                            </p>
                        </div>
                    </div>

                    <!-- Details Tab -->
                    <div v-show="openTab === 2" id="product-details">
                        <div class="flex flex-col justify-start items-start max-w-xl mx-auto gap-2 mt-4">
                            <p class="text-5xl font-semibold my-4">MSI MPG Trident 2</p>
                            <p class="text-blue-500 underline text-sm cursor-pointer">Be the first to review this
                                product</p>
                            <p>
                                MSI MPG Trident 3 10SC-005AU Intel i7 10700F, 2060 SUPER, 16GB RAM, 512GB SSD, 2TB HDD,
                                Windows 10 Home,
                                Gaming Keyboard and Mouse, 3 Years Warranty Gaming Desktop.
                            </p>
                        </div>
                    </div>

                    <!-- Specs Tab -->
                    <div v-show="openTab === 3" id="product-specs">
                        <div class="flex flex-col justify-start items-start max-w-xl mx-auto gap-2 mt-4">
                            <p class="text-5xl font-semibold my-4">MSI MPG Trident 1</p>
                            <p class="text-blue-500 underline text-sm cursor-pointer">Be the first to review this
                                product</p>
                            <p>
                                MSI MPG Trident 3 10SC-005AU Intel i7 10700F, 2060 SUPER, 16GB RAM, 512GB SSD, 2TB HDD,
                                Windows 10 Home,
                                Gaming Keyboard and Mouse, 3 Years Warranty Gaming Desktop.
                            </p>
                        </div>
                    </div>

                    <!-- Contact Us Link -->
                    <div class="mt-4">
                        <a href="#" class="text-blue-500 underline">Contact Us</a>
                    </div>

                    
                </div>

                <!-- Image Section -->
                <div class="flex flex-col justify-center items-center bg-white gap-2 h-full">
                    <img src="/images/msilaptop.png" alt="MSI MPG Trident 3" class="max-w-xs h-full object-cover" />
                    <div class="flex justify-center items-center gap-2">
                        <div class="w-2 h-2 bg-gray-500 rounded-full"></div>
                        <div class="w-2 h-2 bg-gray-500 rounded-full"></div>
                        <div class="w-2 h-2 bg-gray-500 rounded-full"></div>
                    </div>
                    <PromotionalBanner />
                </div>
                
            </div>
        </div>

        <!-- Footer -->
        <Footer />
    </div>
</template>
