<script setup>
import { computed, onMounted, ref, watch } from "vue";
import { Link, useForm, router, usePage } from "@inertiajs/vue3";
import { initFlowbite } from "flowbite";
import MagnifyingGlass from "@/Components/Icons/MagnifyingGlass.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import Pagination from "@/Components/Pagination.vue";
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import ArrowDown from "@/Components/Icons/ArrowDown.vue";
import Filter from "@/Components/Icons/Filter.vue";
import Check from "@/Components/Icons/Check.vue";
import X from "@/Components/Icons/X.vue";

onMounted(() => {
  initFlowbite();
});

defineProps({
  products: {
    type: Object,
  },
  categories: {
    type: Object,
  },
  brands: {
    type: Object,
  },
});

let search = ref(usePage().props.search ?? "");
let sort = ref("");
let filterCategory = ref([]);
let filterBrand = ref([]);
let pageNumber = ref(1);
let showOnly = ref("");

let productsUrl = computed(() => {
  let url = new URL(route("products.index"));

  url.searchParams.set("page", pageNumber.value);

  if (search.value) {
    url.searchParams.set("search", search.value);
  }

  if (sort.value) {
    url.searchParams.set("sort", sort.value);
  }

  if (filterCategory.value.length > 0) {
    url.searchParams.set("filterCategory", filterCategory.value.join(","));
  }

  if (filterBrand.value.length > 0) {
    url.searchParams.set("filterBrand", filterBrand.value.join(","));
  }

  if (showOnly.value) {
    url.searchParams.set("showOnly", showOnly.value);
  }

  return url;
});

const pageNumberUpdated = (link) => {
  pageNumber.value = link.url.split("=")[1];
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

const sortproducts = (order) => {
  sort.value = order;
};

const filterCategories = (activeId) => {
  if (filterCategory.value.includes(activeId)) {
    filterCategory.value = filterCategory.value.filter((id) => id !== activeId);
  } else {
    filterCategory.value.push(activeId);
  }
};

const filterBrands = (activeId) => {
  if (filterBrand.value.includes(activeId)) {
    filterBrand.value = filterBrand.value.filter((id) => id !== activeId);
  } else {
    filterBrand.value.push(activeId);
  }
};

const deleteForm = useForm({});

const deleteStudent = (productId) => {
  if (confirm("Are you sure you want to delete this product?")) {
    deleteForm.delete(route("products.destroy", productId));
  }
};
</script>

<template>
  <AdminLayout title="Products">
    <div>
      <div class="mx-auto max-w-full">
        <section class="flex items-center">
          <div class="w-full">
            <p class="p-4 font-medium text-xl Capitalize">View all Products</p>
            <div class="relative bg-white shadow-md sm:rounded-lg">
              <div
                class="flex flex-col items-center justify-between p-4 space-y-2 md:flex-row md:space-y-0 md:space-x-4"
              >
                <div class="w-full md:w-1/2">
                  <form class="flex flex-row items-center gap-2">
                    <InputLabel for="simple-search" class="sr-only">Search</InputLabel>
                    <div class="relative w-full">
                      <div
                        class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none"
                      >
                        <MagnifyingGlass class="w-5 h-5 text-gray-400" />
                      </div>
                      <TextInput
                        v-model="search"
                        type="text"
                        placeholder="Search"
                        class="block w-full p-2 pl-10 text-sm"
                      />
                    </div>
                    <Link :href="route('products.index')">Reset</Link>
                  </form>
                </div>
                <div
                  class="flex flex-col items-stretch justify-end flex-shrink-0 w-full space-y-2 md:w-auto md:flex-row md:space-y-0 md:items-center md:space-x-2"
                >
                  <Link :href="route('products.create')">
                    <PrimaryButton> Add product </PrimaryButton>
                  </Link>

                  <div class="flex items-center w-full space-x-2 md:w-auto">
                    <SecondaryButton
                      id="actionsDropdownButton"
                      data-dropdown-toggle="actionsDropdown"
                    >
                      <ArrowDown />
                      Sort
                    </SecondaryButton>
                    <div
                      id="actionsDropdown"
                      class="z-10 hidden bg-white divide-y divide-gray-100 rounded shadow w-44"
                    >
                      <ul
                        class="py-1 text-sm text-gray-700"
                        aria-labelledby="actionsDropdownButton"
                      >
                        <li>
                          <Link
                            @click.prevent="sortproducts('asc')"
                            href="#"
                            class="block px-4 py-2 hover:bg-gray-100 capitalize"
                            >sort by a-z
                          </Link>
                        </li>
                        <li>
                          <Link
                            @click.prevent="sortproducts('desc')"
                            href="#"
                            class="block px-4 py-2 hover:bg-gray-100 capitalize"
                            >sort by z-a
                          </Link>
                        </li>
                      </ul>
                    </div>

                    <SecondaryButton
                      id="filterDropdownButton"
                      data-dropdown-toggle="filterDropdown"
                    >
                      <Filter />
                      Category
                      <ArrowDown />
                    </SecondaryButton>

                    <!--Category Dropdown menu -->
                    <div
                      id="filterDropdown"
                      class="z-10 hidden max-w-full p-3 bg-white rounded-lg shadow"
                    >
                      <div class="flex flex-col w-full">
                        <h6 class="mb-3 text-sm font-medium text-gray-900">Category</h6>
                        <div class="max-h-72 overflow-y-auto">
                          <ul
                            class="grid grid-cols-3 gap-2 text-sm"
                            aria-labelledby="dropdownDefault"
                          >
                            <li
                              v-for="category in categories.data"
                              :key="category.id"
                              class="flex items-center"
                            >
                              <input
                                @change="filterCategories(category.id)"
                                :id="category.id"
                                type="checkbox"
                                :value="category.id"
                                class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600"
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

                    <SecondaryButton
                      id="brandfilterDropdownButton"
                      data-dropdown-toggle="brandfilterDropdown"
                    >
                      <Filter />
                      Brand
                      <ArrowDown />
                    </SecondaryButton>

                    <!-- Brand Dropdown Menu -->
                    <div
                      id="brandfilterDropdown"
                      class="z-10 hidden max-w-full p-3 bg-white rounded-lg shadow"
                    >
                      <div class="flex flex-col w-full">
                        <h6 class="mb-3 text-sm font-medium text-gray-900">Brands</h6>
                        <div class="max-h-72 overflow-y-auto">
                          <ul
                            class="grid grid-cols-3 gap-2 text-sm"
                            aria-labelledby="dropdownDefault"
                          >
                            <li
                              v-for="brands in brands.data"
                              :key="brands.id"
                              class="flex items-center"
                            >
                              <input
                                @change="filterBrands(brands.id)"
                                :id="brands.id"
                                type="checkbox"
                                :value="brands.id"
                                class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600"
                              />
                              <InputLabel
                                :for="brands.id"
                                class="ml-2 text-sm font-medium text-gray-900"
                              >
                                {{ brands.name }}
                              </InputLabel>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="px-4 pb-3">
                <hr />
              </div>
              <div class="flex items-center px-4 pb-4 space-x-2">
                <p class="font-meduim font-bold text-sm">Show only:</p>
                <div class="flex flex-row items-center">
                  <input
                    id="featured"
                    type="radio"
                    value="featured"
                    v-model="showOnly"
                    name="showOnly"
                    class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600"
                  />
                  <InputLabel
                    for="featured"
                    class="ml-2 text-sm font-medium text-gray-900"
                  >
                    Featured Products
                  </InputLabel>
                </div>
                <div class="flex flex-row items-center">
                  <input
                    id="sale"
                    type="radio"
                    value="sale"
                    v-model="showOnly"
                    name="showOnly"
                    class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600"
                  />
                  <InputLabel for="sale" class="ml-2 text-sm font-medium text-gray-900">
                    Sale Products
                  </InputLabel>
                </div>
                <div class="flex flex-row items-center">
                  <input
                    id="new"
                    type="radio"
                    value="new"
                    v-model="showOnly"
                    name="showOnly"
                    class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600"
                  />
                  <InputLabel for="new" class="ml-2 text-sm font-medium text-gray-900">
                    New Products
                  </InputLabel>
                </div>
                <div class="flex flex-row items-center">
                  <input
                    id="active"
                    type="radio"
                    value="active"
                    v-model="showOnly"
                    name="showOnly"
                    class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600"
                  />
                  <InputLabel for="active" class="ml-2 text-sm font-medium text-gray-900">
                    Active Products
                  </InputLabel>
                </div>
                <div class="flex flex-row items-center">
                  <input
                    id="inactive"
                    type="radio"
                    value="inactive"
                    v-model="showOnly"
                    name="showOnly"
                    class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600"
                  />
                  <InputLabel
                    for="inactive"
                    class="ml-2 text-sm font-medium text-gray-900"
                  >
                    Inactive Products
                  </InputLabel>
                </div>
              </div>
            </div>
          </div>
        </section>

        <div class="mt-4 flex flex-col">
          <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
              <Pagination :data="products" :pageNumberUpdated="pageNumberUpdated" />
              <div
                class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg relative"
              >
                <table class="min-w-full divide-y divide-gray-300">
                  <thead class="bg-gray-50">
                    <tr>
                      <th
                        scope="col"
                        class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6"
                      >
                        Image
                      </th>
                      <th
                        scope="col"
                        class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6"
                      >
                        Name
                      </th>
                      <th
                        scope="col"
                        class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6"
                      >
                        Price
                      </th>
                      <th
                        scope="col"
                        class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                      >
                        Stocks
                      </th>
                      <th
                        scope="col"
                        class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                      >
                        Category
                      </th>
                      <th
                        scope="col"
                        class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                      >
                        Brand
                      </th>
                      <th
                        scope="col"
                        class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                      >
                        Featured
                      </th>
                      <th
                        scope="col"
                        class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                      >
                        Sale
                      </th>
                      <th
                        scope="col"
                        class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                      >
                        New
                      </th>
                      <th
                        scope="col"
                        class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                      >
                        Status
                      </th>
                      <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6" />
                    </tr>
                  </thead>
                  <tbody class="divide-y divide-gray-200 bg-white">
                    <tr v-for="product in products.data" :key="product.id">
                      <td class="py-4 pl-2 text-sm font-medium text-gray-900">
                        <img
                          v-if="product.image"
                          :src="`/storage/${product.image}`"
                          alt="Product Image"
                          class="max-w-96 min-h-72 object-cover rounded-md"
                        />
                        <img
                          v-else
                          src="https://placehold.co/800x500"
                          alt="Placeholder Image"
                          class="max-w-96 min-h-72 object-cover rounded-md"
                        />
                      </td>
                      <td
                        class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6"
                      >
                        {{ product.name }}
                      </td>
                      <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                        {{ product.price }}
                      </td>
                      <td
                        class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 capitalize"
                      >
                        {{ product.stocks }}
                      </td>
                      <td
                        class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 capitalize"
                      >
                        {{ product.category.name }}
                      </td>
                      <td
                        class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 capitalize"
                      >
                        {{ product.brand.name }}
                      </td>
                      <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                        <span v-if="product.is_featured === 1"><Check /></span>
                        <span v-else><X /></span>
                      </td>
                      <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                        <span v-if="product.is_sale === 1"><Check /></span>
                        <span v-else><X /></span>
                      </td>
                      <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                        <span v-if="product.is_new === 1"><Check /></span>
                        <span v-else><X /></span>
                      </td>
                      <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                        <span v-if="product.is_active === 1"><Check /></span>
                        <span v-else><X /></span>
                      </td>

                      <td
                        class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6"
                      >
                        <Link
                          :href="route('products.edit', product.id)"
                          class="text-slate-600 hover:text-slate-900"
                        >
                          Edit
                        </Link>
                        <button
                          @click="deleteStudent(product.id)"
                          class="ml-2 text-red-600 hover:text-red-900"
                        >
                          Delete
                        </button>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <Pagination :data="products" :pageNumberUpdated="pageNumberUpdated" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </AdminLayout>
</template>
