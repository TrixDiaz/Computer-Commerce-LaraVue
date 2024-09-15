<script setup>
import { ref, onMounted } from "vue";
import { Head, usePage, router } from "@inertiajs/vue3";
import Annoucement from "@/Components/Annoucement.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import HeroCard from "@/Components/HeroCard.vue";
import Breadcrumbs from "@/Components/Breadcrumbs.vue";
import HeaderNav from "@/Layouts/Header.vue";
import Footer from "@/Layouts/Footer.vue";
import Banner from "@/Components/Banner.vue";
import { useCartStore } from "@/Store/CartStore";
import axios from "axios";

const openTab = ref(1);
const product = ref(null);
const cartStore = useCartStore();

onMounted(() => {
  const { props } = usePage();
  product.value = props.product.data;
});

const addToCart = () => {
  if (product.value) {
    cartStore.addItem(product.value);
  }
};

const processGcashPayment = async () => {
  if (product.value) {
    try {
      const response = await axios.post("/api/product/gcash-payment", {
        product_id: product.value.id,
        amount: product.value.is_sale ? product.value.sale_price : product.value.price,
      });

      if (response.data.success) {
        // Redirect to the PayMongo checkout URL
        window.location.href = response.data.checkout_url;
      } else {
        alert("GCash payment session creation failed: " + response.data.message);
      }
    } catch (error) {
      console.error("Error processing GCash payment:", error);
      alert("An error occurred while processing your payment. Please try again.");
    }
  }
};
</script>

<template>
  <Head :title="product ? product.name : 'Product'" />

  <div>
    <!-- Announcement Header -->
    <Annoucement />

    <!-- Navigation Header -->
    <HeaderNav />

    <div class="max-w-7xl mx-auto" v-if="product">
      <!-- Product Information Section -->
      <div class="flex flex-col sm:flex-row justify-between items-center py-8 mx-2">
        <!-- Tab Buttons -->
        <div>
          <div class="flex flex-row space-x-4 rounded-lg w-52 mb-1">
            <button
              @click="openTab = 1"
              :class="{ 'font-semibold text-black underline': openTab === 1 }"
              class="flex-1 text-nowrap"
              aria-controls="about-product"
              aria-selected="openTab === 1"
            >
              About Product
            </button>
            <button
              @click="openTab = 2"
              :class="{ 'font-semibold text-black underline': openTab === 2 }"
              class="flex-1 text-nowrap"
              aria-controls="product-details"
              aria-selected="openTab === 2"
            >
              Details
            </button>
            <button
              @click="openTab = 3"
              :class="{ 'font-semibold text-black underline': openTab === 3 }"
              class="flex-1 text-nowrap"
              aria-controls="product-specs"
              aria-selected="openTab === 3"
            >
              Specs
            </button>
          </div>
        </div>

        <!-- Purchase Section -->
        <div
          class="flex flex-col-reverse sm:flex-row justify-center items-center space-y-2 md:space-y-0 gap-4"
        >
          <p class="capitalize">
            <span class="text-black mr-1" v-if="product.is_sale">On sale from</span>
            <span class="text-black font-semibold"
              >₱{{ product.is_sale ? product.sale_price : product.price }}</span
            >
          </p>
          <SecondaryButton @click="addToCart">Add to Cart</SecondaryButton>
          <PrimaryButton
            @click="processGcashPayment"
            class="rounded-full bg-blue-500 text-white"
            >Pay with GCash</PrimaryButton
          >
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
            <div
              class="flex flex-col justify-start items-start max-w-xl mx-auto gap-2 mt-4"
            >
              <p class="text-5xl font-semibold my-4">{{ product.name }}</p>
              <div class="flex flex-row justify-center items-center my-0.5">
                <div v-if="product.is_featured" class="text-sm">
                  <span
                    class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300"
                    >Featured</span
                  >
                </div>
                <div v-if="product.is_sale" class="text-sm">
                  <span
                    class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300"
                    >Sale</span
                  >
                </div>
                <div v-if="product.is_new" class="text-sm">
                  <span
                    class="bg-yellow-100 text-yellow-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300"
                    >New</span
                  >
                </div>
              </div>
              <p class="text-blue-500 underline text-sm cursor-pointer">
                Be the first to review this product
              </p>
              <p>{{ product.description }}</p>
            </div>
          </div>

          <!-- Details Tab -->
          <div v-show="openTab === 2" id="product-details">
            <div
              class="flex flex-col justify-start items-start max-w-xl mx-auto gap-2 mt-4"
            >
              <p class="text-5xl font-semibold my-4">MSI MPG Trident 2</p>
              <p class="text-blue-500 underline text-sm cursor-pointer">
                Be the first to review this product
              </p>
              <p>
                MSI MPG Trident 3 10SC-005AU Intel i7 10700F, 2060 SUPER, 16GB RAM, 512GB
                SSD, 2TB HDD, Windows 10 Home, Gaming Keyboard and Mouse, 3 Years Warranty
                Gaming Desktop.
              </p>
            </div>
          </div>

          <!-- Specs Tab -->
          <div v-show="openTab === 3" id="product-specs">
            <div
              class="flex flex-col justify-start items-start max-w-xl mx-auto gap-2 mt-4"
            >
              <p class="text-5xl font-semibold my-4">MSI MPG Trident 1</p>
              <p class="text-blue-500 underline text-sm cursor-pointer">
                Be the first to review this product
              </p>
              <p>
                MSI MPG Trident 3 10SC-005AU Intel i7 10700F, 2060 SUPER, 16GB RAM, 512GB
                SSD, 2TB HDD, Windows 10 Home, Gaming Keyboard and Mouse, 3 Years Warranty
                Gaming Desktop.
              </p>
            </div>
          </div>

          <!-- Contact Us Link -->
          <div class="mt-4">
            <a href="#" class="text-blue-500 underline">Contact Us</a>
          </div>
        </div>

        <!-- Image Section -->
        <div
          class="group relative flex flex-col justify-center items-center bg-white h-full overflow-hidden"
        >
          <img
            v-if="product.image_url"
            :src="product.image_url"
            :alt="product.name"
            class="w-full max-h-80 object-contain transition-opacity duration-300 ease-in-out group-hover:opacity-0"
            loading="lazy"
          />
          <img
            v-else
            src="/images/msilaptop.png"
            alt="Default Product Image"
            class="w-full max-h-80 object-contain transition-opacity duration-300 ease-in-out group-hover:opacity-0"
            loading="lazy"
          />

          <img
            v-if="product.hover_image_url"
            :src="product.hover_image_url"
            :alt="`${product.name} - Hover Image`"
            class="absolute inset-0 w-full max-h-80 object-contain opacity-0 transition-opacity duration-300 ease-in-out group-hover:opacity-100"
          />
          <img
            v-else
            src="/images/laptop-image2.png"
            alt="Default Hover Image"
            class="absolute inset-0 w-full max-h-80 object-contain opacity-0 transition-opacity duration-300 ease-in-out group-hover:opacity-100"
          />

          <!-- <div
            class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex justify-center items-center gap-2"
          >
            <div
              class="w-2 h-2 bg-gray-300 rounded-full transition-colors duration-300 group-hover:bg-gray-600"
            ></div>
            <div
              class="w-2 h-2 bg-gray-300 rounded-full transition-colors duration-300 group-hover:bg-gray-600"
            ></div>
            <div
              class="w-2 h-2 bg-gray-300 rounded-full transition-colors duration-300 group-hover:bg-gray-600"
            ></div>
          </div> -->
        </div>
      </div>
      <Banner class="relativebottom-0 left-0 right-0" />
    </div>

    <!-- Footer -->
    <Footer />
  </div>
</template>
