<script setup>
import { ref, computed, watch, onMounted } from "vue";
import { usePage, router, Link } from "@inertiajs/vue3";
import { initFlowbite } from "flowbite";
import { useCartStore } from "@/Store/CartStore";
import ArrowDown from "@/Components/Icons/ArrowDown.vue";
import InputLabel from "@/Components/InputLabel.vue";
import ArrowLeft from "@/Components/Icons/ArrowLeft.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import BlockLayout from "@/Components/Icons/BlockLayout.vue";
import RowLayout from "@/Components/Icons/RowLayout.vue";
import Pagination from "@/Components/Pagination.vue";
import Info from "@/Components/Icons/Info.vue";
import Heart from "@/Components/Icons/Heart.vue";
import X from "@/Components/Icons/X.vue";
import Catalog from "@/Pages/Catalog.vue";

onMounted(() => {
  initFlowbite();
  filterCategory.value = selectedCategories.value;
  filterBrand.value = selectedBrands.value;
  selectedSort.value = selectedSorts.value;
});

const props = defineProps({
  products: {
    type: Object,
    required: true,
  },
  categories: {
    type: Object,
    required: true,
  },
  brands: {
    type: Object,
    required: true,
  },
});

const cartStore = useCartStore();
const isRowLayout = ref(false);
let search = ref(usePage().props.search ?? "");
let sort = ref("");
let pageNumber = ref(1);
let filterCategory = ref([]);
let filterBrand = ref([]);
const selectedSortLabel = ref("Sort by");
const urlParams = computed(() => new URLSearchParams(window.location.search));

const selectedCategories = computed(() => {
  const categoryParam = urlParams.value.get("filterCategory");
  return categoryParam ? categoryParam.split(",").map(Number) : [];
});

const selectedBrands = computed(() => {
  const brandParam = urlParams.value.get("filterBrand");
  return brandParam ? brandParam.split(",").map(Number) : [];
});

let productsUrl = computed(() => {
  let url = new URL(route("catalog.index"));

  url.searchParams.set("page", pageNumber.value);

  if (sort.value) {
    url.searchParams.set("sort", sort.value);
  }

  if (filterCategory.value.length > 0) {
    url.searchParams.set("filterCategory", filterCategory.value.join(","));
  }

  if (filterBrand.value.length > 0) {
    url.searchParams.set("filterBrand", filterBrand.value.join(","));
  }

  return url.toString();
});

const setRowLayout = () => {
  isRowLayout.value = true;
};
const setBlockLayout = () => {
  isRowLayout.value = false;
};

const pageNumberUpdated = (link) => {
  pageNumber.value = link.url.split("=")[1];
};

const sortProducts = (order, label) => {
  sort.value = order;
  selectedSortLabel.value = label;
};

const filterCategories = (activeId) => {
  if (filterCategory.value.includes(activeId)) {
    filterCategory.value = filterCategory.value.filter((id) => id !== activeId);
  } else {
    filterCategory.value.push(activeId);
  }
  updateUrl();
};

const filterBrands = (activeId) => {
  if (filterBrand.value.includes(activeId)) {
    filterBrand.value = filterBrand.value.filter((id) => id !== activeId);
  } else {
    filterBrand.value.push(activeId);
  }
  updateUrl();
};

const updateUrl = () => {
  const url = new URL(window.location);
  url.searchParams.set("filterCategory", filterCategory.value.join(","));
  url.searchParams.set("filterBrand", filterBrand.value.join(","));
  window.history.pushState({}, "", url);
};

const salePercentage = (product) => {
  if (product.is_sale === 1 && product.price && product.sale_price) {
    const discount = product.price - product.sale_price;
    return Math.round((discount / product.price) * 100) + "%";
  }
  return null;
};

const getCategoryName = (categoryId) => {
  const category = props.categories.data.find((cat) => cat.id === categoryId);
  return category ? category.name : "";
};

const getBrandName = (brandId) => {
  const brand = props.brands.data.find((b) => b.id === brandId);
  return brand ? brand.name : "";
};

const addToCart = (product) => {
  cartStore.addItem({
    id: product.id,
    name: product.name,
    price: product.is_sale === 1 ? product.sale_price : product.price,
    image: product.image_url || "/images/laptop-image.png",
    url: `/products/${product.id}`, // Adjust this URL as needed
  });
};

watch(
  () => productsUrl.value,
  (updateproductUrl) => {
    router.visit(updateproductUrl, {
      preserveScroll: true,
      preserveState: true,
      replace: true,
    });
  }
);

watch(
  () => search.value,
  (value) => {
    if (value) {
      pageNumber.value = 1;
    }
  }
);
</script>

<template>
  <div class="max-w-7xl mx-auto pt-2">
    <div class="flex flex-none justify-center items-center my-2 gap-2">
      <!-- Back to home  -->
      <div
        class="hidden lg:flex flex-none w-64 justify-center items-center cursor-pointer"
      >
        <Link
          href="/"
          class="flex flex-row justify-center items-center text-lg font-bold"
        >
          <ArrowLeft /> Back</Link
        >
      </div>
      <div class="flex flex-col md:flex-row flex-1 justify-between items-center">
        <p class="text-gray-400 text-sm tracking-tight">
          Items {{ products.meta.from }} - {{ products.meta.to }} of
          {{ products.meta.total }}
        </p>
        <!-- Dropdowns Container -->
        <div class="flex flex-col md:flex-row items-center gap-4">
          <!-- Left Dropdown -->
          <div class="relative">
            <div class="relative w-56">
              <input class="peer hidden" type="checkbox" name="select-1" id="select-1" />
              <label
                for="select-1"
                class="flex w-full cursor-pointer select-none rounded-lg border p-2 px-3 text-sm text-gray-700"
                >{{ selectedSortLabel }}
              </label>
              <ArrowDown
                class="pointer-events-none absolute right-0 top-3 ml-auto mr-5 h-4 text-gray-600 transition peer-checked:rotate-180"
              />
              <ul
                class="absolute z-50 bg-white w-full rounded-b-lg shadow-xl transition-all duration-300 peer-checked:max-h-96 peer-checked:py-3 overflow-hidden max-h-0 flex-col"
              >
                <li
                  @click.prevent="sortProducts('name_asc', 'Sort by A - Z')"
                  class="cursor-pointer px-3 py-2 text-sm text-gray-500 hover:bg-blue-500 hover:text-white"
                >
                  Sort by A - Z
                </li>
                <li
                  @click.prevent="sortProducts('name_desc', 'Sort by Z - A')"
                  class="cursor-pointer px-3 py-2 text-sm text-gray-500 hover:bg-blue-500 hover:text-white"
                >
                  Sort by Z - A
                </li>
                <li
                  @click.prevent="sortProducts('price_asc', 'Price: Low to High')"
                  class="cursor-pointer px-3 py-2 text-sm text-gray-500 hover:bg-blue-500 hover:text-white"
                >
                  Price: Low to High
                </li>
                <li
                  @click.prevent="sortProducts('price_desc', 'Price: High to Low')"
                  class="cursor-pointer px-3 py-2 text-sm text-gray-500 hover:bg-blue-500 hover:text-white"
                >
                  Price: High to Low
                </li>
                <li
                  @click.prevent="sortProducts('date_desc', 'Date: New to Old')"
                  class="cursor-pointer px-3 py-2 text-sm text-gray-500 hover:bg-blue-500 hover:text-white"
                >
                  Date: New to Old
                </li>
                <li
                  @click.prevent="sortProducts('date_asc', 'Date: Old to New')"
                  class="cursor-pointer px-3 py-2 text-sm text-gray-500 hover:bg-blue-500 hover:text-white"
                >
                  Date: Old to New
                </li>
                <li
                  @click.prevent="sortProducts('discount_desc', 'Discount: High to Low')"
                  class="cursor-pointer px-3 py-2 text-sm text-gray-500 hover:bg-blue-500 hover:text-white"
                >
                  Discount: High to Low
                </li>
                <li
                  @click.prevent="sortProducts('featured_products', 'Featured Products')"
                  class="cursor-pointer px-3 py-2 text-sm text-gray-500 hover:bg-blue-500 hover:text-white"
                >
                  Featured Products
                </li>
                <li
                  @click.prevent="sortProducts('new_products', 'New Products')"
                  class="cursor-pointer px-3 py-2 text-sm text-gray-500 hover:bg-blue-500 hover:text-white"
                >
                  New Products
                </li>
                <li
                  @click.prevent="sortProducts('sale_products', 'Sale Products')"
                  class="cursor-pointer px-3 py-2 text-sm text-gray-500 hover:bg-blue-500 hover:text-white"
                >
                  Sale Products
                </li>
              </ul>
            </div>
          </div>
          <!-- Layout Button -->
          <div class="flex flex-row space-x-4">
            <!-- Layout Block Icon-->
            <BlockLayout @click="setBlockLayout" />
            <!-- Layout Row Icon-->
            <RowLayout @click="setRowLayout" />
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
          <Link :href="route('catalog.index')">
            <PrimaryButton class="w-full rounded-full border border-gray-400"
              >Clear Filter
            </PrimaryButton></Link
          >
          <!-- Category Dropdown -->
          <div class="relative">
            <div class="relative w-56">
              <input
                class="peer hidden"
                checked
                type="checkbox"
                name="select-3"
                id="select-3"
              />
              <label
                for="select-3"
                class="flex w-full cursor-pointer select-none rounded-lg p-2 px-3 text-md font-bold text-gray-700 mt-4"
                >Brands</label
              >
              <ArrowDown
                class="pointer-events-none absolute right-0 top-3 ml-auto mr-3 h-4 text-gray-600 transition peer-checked:rotate-180"
              />
              <ul
                class="relative w-full transition-all duration-300 peer-checked:max-h-56 peer-checked:py-0 overflow-hidden max-h-0 flex-col"
              >
                <li
                  v-for="brand in props.brands.data"
                  :key="brand.id"
                  class="flex flex-row justify-start items-center cursor-pointer px-3 py-1 text-sm text-gray-500 hover:bg-gray-300 hover:text-white"
                >
                  <input
                    @change="filterBrands(brand.id)"
                    :id="brand.id"
                    type="checkbox"
                    :value="brand.id"
                    :checked="selectedBrands.includes(brand.id)"
                    class="w-4 h-4 text-red-600 bg-gray-100 border-gray-300 rounded focus:ring-red-500 dark:focus:ring-red-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                  />
                  <InputLabel
                    :for="brand.id"
                    class="ml-2 text-sm font-medium text-gray-900"
                  >
                    {{ brand.name }}
                  </InputLabel>
                </li>
              </ul>
            </div>
          </div>
          <!-- Price Dropdown -->
          <div class="relative">
            <div class="relative w-56">
              <input
                class="peer hidden"
                checked
                type="checkbox"
                name="select-4"
                id="select-4"
              />
              <label
                for="select-4"
                class="flex w-full cursor-pointer select-none rounded-lg p-2 px-3 text-md font-bold text-gray-700 mt-4"
                >Category</label
              >
              <ArrowDown
                class="pointer-events-none absolute right-0 top-3 ml-auto mr-3 h-4 text-gray-600 transition peer-checked:rotate-180"
              />
              <ul
                class="relative w-full transition-all duration-300 peer-checked:max-h-56 peer-checked:py-0 overflow-hidden max-h-0 flex-col"
              >
                <li
                  v-for="category in props.categories.data"
                  :key="category.id"
                  class="flex flex-row justify-start items-center cursor-pointer px-3 py-1 text-sm text-gray-500 hover:bg-gray-300 hover:text-white"
                >
                  <input
                    @change="filterCategories(category.id)"
                    :id="category.id"
                    type="checkbox"
                    :value="category.id"
                    :checked="selectedCategories.includes(category.id)"
                    class="w-4 h-4 text-red-600 bg-gray-100 border-gray-300 rounded focus:ring-red-500 dark:focus:ring-red-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                  />
                  <InputLabel
                    :for="category.id"
                    class="ml-2 text-sm font-medium text-gray-900"
                  >
                    {{ category.name }}
                  </InputLabel>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="bg-blue-50 border-r border-gray-400 p-4">
          <h3 class="font-bold text-lg text-center my-2 capitalize">Brands</h3>
        </div>
        <!-- Brands -->
        <div class="max-w-sm mx-auto place-content-center">
          <div class="grid grid-cols-2 place-content-center">
            <img src="/images/roccat.png" class="w-24" alt="Roccat logo" />
            <img src="/images/msi.png" class="w-24" alt="MSI logo" />
            <img src="/images/razer.png" class="w-24" alt="Razer logo" />
            <img src="/images/melmet.png" class="w-24" alt="Melmet logo" />
            <img src="/images/adata.png" class="w-24" alt="Adata logo" />
            <img src="/images/hp.png" class="w-24" alt="HP logo" />
            <img src="/images/gigabyte.png" class="w-24" alt="Gigabyte logo" />
          </div>
        </div>
        <div>
          <img
            src="/images/noblechair.png"
            class="w-full h-full object-contain"
            alt="Roccat logo"
          />
        </div>
      </slot>
    </aside>

    <!-- Main content area -->
    <main class="flex-1 px-2">
      <slot name="content">
        <!-- Filter Section -->
        <div class="mb-4">
          <div class="flex flex-row flex-wrap gap-2">
            <!-- Display selected category filters -->
            <div
              v-for="categoryId in filterCategory"
              :key="`category-${categoryId}`"
              class="flex flex-row border px-4 py-2 space-x-1"
            >
              <p class="text-black font-bold capitalize">
                {{ getCategoryName(categoryId) }}
              </p>
            </div>

            <!-- Display selected brand filters -->
            <div
              v-for="brandId in filterBrand"
              :key="`brand-${brandId}`"
              class="flex flex-row border px-4 py-2 space-x-1"
            >
              <p class="text-black font-bold capitalize">{{ getBrandName(brandId) }}</p>
            </div>
          </div>
        </div>
        <!-- End Filter Section -->
        <!-- Pagination -->
        <Pagination
          :data="props.products"
          :pageNumberUpdated="pageNumberUpdated"
          :preserveState="true"
          :preserveScroll="true"
          :replace="true"
        />
        <!-- End of Pagination -->
        <!-- This will be where the main content (e.g., product cards) goes -->
        <main class="flex-1 px-2">
          <div
            :class="
              isRowLayout
                ? 'grid grid-cols-1 w-full relative'
                : 'relative grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4'
            "
            class="place-items-center gap-4 p-1 lg:p-4 w-full"
          >
            <!-- Product Card -->
            <div
              v-for="product in props.products.data"
              :key="product.id"
              :class="
                isRowLayout
                  ? 'flex flex-row items-center bg-white p-4 shadow-md rounded-lg mb-4 w-full'
                  : 'group/item relative bg-white p-6 mb-6 max-w-72 rounded-lg transition-all duration-300 hover:shadow-lg hover:scale-105 w-full'
              "
              class="group/item"
            >
              <!-- Image -->
              <div :class="isRowLayout ? 'w-1/3' : 'w-full'" class="relative h-48">
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

              <!-- Add to Card and Heart Icon -->
              <div
                :class="
                  isRowLayout
                    ? 'flex flex-row items-center gap-2 mt-4'
                    : 'hidden group-hover/item:flex absolute top-4 right-4 flex-col items-center gap-2'
                "
              >
                <button
                  v-if="!isRowLayout"
                  type="button"
                  class="p-1 text-transparent rounded-full hover:bg-red-300"
                >
                  <Heart class="w-7 h-7" />
                </button>
              </div>

              <!-- Description -->
              <div :class="isRowLayout ? 'w-2/3 pl-6' : 'w-full mt-4'" class="relative">
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
                <Link
                  href="#"
                  class="text-lg font-semibold leading-tight tracking-tight line-clamp-2 text-gray-900 hover:text-blue-600 transition-colors duration-300"
                >
                  {{ product.name }}
                </Link>

                <div class="flex items-center gap-2">
                  <span
                    v-if="salePercentage(product)"
                    class="text-sm font-medium text-red-600"
                  >
                    {{ salePercentage(product) }} Off
                  </span>
                </div>

                <div class="uppercase text-gray-400 text-sm">
                  {{ product.brand.name }} - {{ product.category.name }}
                </div>

                <div class="mt-1 flex items-center gap-1">
                  <div class="flex items-center">
                    <svg
                      v-for="i in parseInt(product.rating ?? 0)"
                      :key="i"
                      class="h-4 w-4 text-yellow-400"
                      xmlns="http://www.w3.org/2000/svg"
                      fill="currentColor"
                      viewBox="0 0 24 24"
                    >
                      <path
                        d="M13.8 4.2a2 2 0 0 0-3.6 0L8.4 8.4l-4.6.3a2 2 0 0 0-1.1 3.5l3.5 3-1 4.4c-.5 1.7 1.4 3 2.9 2.1l3.9-2.3 3.9 2.3c1.5 1 3.4-.4 3-2.1l-1-4.4 3.4-3a2 2 0 0 0-1.1-3.5l-4.6-.3-1.8-4.2Z"
                      />
                    </svg>
                  </div>
                  <p class="text-sm font-medium text-gray-700">
                    {{ product.rating ?? "No rating yet" }}
                  </p>
                </div>

                <div class="mt-1 flex items-center gap-1">
                  <Info class="w-2 h-2 text-green-500" />
                  <p class="text-sm font-medium text-green-600 capitalize">
                    stock {{ product.stocks }}
                  </p>
                </div>

                <div
                  :class="
                    isRowLayout
                      ? 'mt-4 flex justify-between items-center w-full'
                      : 'mt-4 flex flex-col items-center'
                  "
                >
                  <div
                    :class="
                      isRowLayout
                        ? 'flex items-center gap-2'
                        : 'flex items-center gap-4 mb-3'
                    "
                  >
                    <p class="text-2xl font-bold text-gray-900">
                      ₱{{ product.is_sale === 1 ? product.sale_price : product.price }}
                    </p>
                    <p
                      v-if="product.is_sale === 1"
                      class="text-lg text-gray-500 line-through"
                    >
                      ₱{{ product.price }}
                    </p>
                  </div>
                  <div :class="isRowLayout ? 'flex items-center gap-2' : 'w-full'">
                    <button
                      type="button"
                      @click="addToCart(product)"
                      :class="
                        isRowLayout
                          ? 'flex items-center'
                          : 'w-full opacity-0 group-hover/item:opacity-100 transition-opacity duration-300'
                      "
                      class="rounded-full bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700 transition-colors duration-300"
                    >
                      Add to cart
                    </button>
                    <button
                      v-if="isRowLayout"
                      type="button"
                      class="p-1 text-transparent rounded-full hover:bg-red-300"
                    >
                      <Heart class="w-7 h-7" />
                    </button>
                  </div>
                </div>
              </div>
            </div>
            <!-- End of Product Card -->
          </div>
          <!-- Pagination -->
          <Pagination
            :data="props.products"
            :pageNumberUpdated="pageNumberUpdated"
            :preserveState="true"
            :preserveScroll="true"
            :replace="true"
          />
          <!-- End of Pagination -->
        </main>
      </slot>
    </main>
  </div>
</template>
