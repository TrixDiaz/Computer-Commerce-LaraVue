<script setup>
import { computed, onMounted, ref, watch } from 'vue'
import { Link, useForm, router, usePage } from "@inertiajs/vue3";
import { initFlowbite } from 'flowbite'
import MagnifyingGlass from "@/Components/Icons/MagnifyingGlass.vue";
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import Pagination from "@/Components/Pagination.vue";
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import ArrowDown from '@/Components/Icons/ArrowDown.vue';
import Filter from '@/Components/Icons/Filter.vue';

onMounted(() => {
    initFlowbite();
})

defineProps({
    products: {
        type: Object,
    },
    categories: {
        type: Object,
    },
    brands: {
        type: Object,
    }
});

let search = ref(usePage().props.search ?? '');
let sort = ref('');
let filter = ref([]);
let pageNumber = ref(1);

let productsUrl = computed(() => {
    let url = new URL(route('products.index'));

    url.searchParams.set('page', pageNumber.value);

    if (search.value) {
        url.searchParams.set('search', search.value);
    }

    if (sort.value) {
        url.searchParams.set('sort', sort.value);
    }

    if (filter.value.length > 0) {
        url.searchParams.set('filter', filter.value.join(','));
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
    });

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

const filterproducts = (activeId) => {
    if (filter.value.includes(activeId)) {
        filter.value = filter.value.filter(id => id !== activeId);
    } else {
        filter.value.push(activeId);
    }
};

const deleteForm = useForm({});

const deleteStudent = (productId) => {
    if (confirm('Are you sure you want to delete this product?')) {
        deleteForm.delete(route('products.destroy', productId));
    }
}
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
                                class="flex flex-col items-center justify-between p-4 space-y-2 md:flex-row md:space-y-0 md:space-x-4">
                                <div class="w-full md:w-1/2">
                                    <form class="flex flex-row items-center gap-2">
                                        <InputLabel for="simple-search" class="sr-only">Search</InputLabel>
                                        <div class="relative w-full">
                                            <div
                                                class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                <MagnifyingGlass class="w-5 h-5 text-gray-400" />
                                            </div>
                                            <TextInput v-model="search" type="text" placeholder="Search"
                                                class="block w-full p-2 pl-10 text-sm" />
                                        </div>
                                        <Link :href="route('products.index')">Reset</Link>
                                    </form>
                                </div>
                                <div
                                    class="flex flex-col items-stretch justify-end flex-shrink-0 w-full space-y-2 md:w-auto md:flex-row md:space-y-0 md:items-center md:space-x-2">
                                    <Link :href="route('products.create')">
                                    <PrimaryButton>
                                        Add product
                                    </PrimaryButton>
                                    </Link>

                                    <div class="flex items-center w-full space-x-2 md:w-auto">
                                        <SecondaryButton id="actionsDropdownButton"
                                            data-dropdown-toggle="actionsDropdown">
                                            <ArrowDown />
                                            Sort
                                        </SecondaryButton>
                                        <div id="actionsDropdown"
                                            class="z-10 hidden bg-white divide-y divide-gray-100 rounded shadow w-44">
                                            <ul class="py-1 text-sm text-gray-700"
                                                aria-labelledby="actionsDropdownButton">
                                                <li>
                                                    <Link @click.prevent="sortproducts('asc')" href="#"
                                                        class="block px-4 py-2 hover:bg-gray-100 capitalize">sort by a-z
                                                    </Link>
                                                </li>
                                                <li>
                                                    <Link @click.prevent="sortproducts('desc')" href="#"
                                                        class="block px-4 py-2 hover:bg-gray-100 capitalize">sort by z-a
                                                    </Link>
                                                </li>
                                            </ul>
                                        </div>

                                        <SecondaryButton id="filterDropdownButton"
                                            data-dropdown-toggle="filterDropdown">
                                            <Filter />
                                            Filter
                                            <ArrowDown />
                                        </SecondaryButton>

                                        <!-- Dropdown menu -->
                                        <div id="filterDropdown"
                                            class="z-10 hidden max-w-60 p-3 bg-white rounded-lg shadow">
                                            <div class="flex flex-row justify-center items-center w-full gap-2">
                                                <ul class="space-y-2 text-sm" aria-labelledby="dropdownDefault">
                                                    <h6 class="mb-3 text-sm font-medium text-gray-900">
                                                        Category
                                                    </h6>
                                                    <li v-for="category in categories.data" :key="category.id"
                                                        class="flex items-center">
                                                        <input @change="filterproducts(category.id)" :id="category.id"
                                                            type="checkbox" :value="category.id"
                                                            class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600" />
                                                        <InputLabel for="active"
                                                            class="ml-2 text-sm font-medium text-gray-900">
                                                            {{ category.name }}
                                                        </InputLabel>
                                                    </li>
                                                </ul>
                                                <ul class="space-y-2 text-sm" aria-labelledby="dropdownDefault">
                                                    <h6 class="mb-3 text-sm font-medium text-gray-900">
                                                        Brand
                                                    </h6>
                                                    <li v-for="brand in brands.data" :key="brand.id"
                                                        class="flex items-center">
                                                        <input @change="filterproducts(brand.id)" :id="brand.id"
                                                            type="checkbox" :value="brand.id"
                                                            class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600" />
                                                        <InputLabel for="active"
                                                            class="ml-2 text-sm font-medium text-gray-900">
                                                            {{ brand.name }}
                                                        </InputLabel>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="px-4 pb-3">
                                <hr>
                            </div>
                            <div class="flex items-center px-4 pb-4 space-x-2">
                                <p class="font-meduim font-bold text-sm">Show only:</p>
                                <div class="flex flex-row items-center">
                                    <input id="featured" type="checkbox" value=""
                                        class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600" />
                                    <InputLabel for="featured" class="ml-2 text-sm font-medium text-gray-900">
                                        Featured Products
                                    </InputLabel>
                                </div>
                                <div class="flex flex-row items-center">
                                    <input id="sale" type="checkbox" value=""
                                        class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600" />
                                    <InputLabel for="sale" class="ml-2 text-sm font-medium text-gray-900">
                                        Sale Products
                                    </InputLabel>
                                </div>
                                <div class="flex flex-row items-center">
                                    <input id="new" type="checkbox" value=""
                                        class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600" />
                                    <InputLabel for="new" class="ml-2 text-sm font-medium text-gray-900">
                                        New Products
                                    </InputLabel>
                                </div>
                                <div class="flex flex-row items-center">
                                    <input id="active" type="checkbox" value=""
                                        class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600" />
                                    <InputLabel for="active" class="ml-2 text-sm font-medium text-gray-900">
                                        Active Products
                                    </InputLabel>
                                </div>
                                <div class="flex flex-row items-center">
                                    <input id="inactive" type="checkbox" value=""
                                        class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600" />
                                    <InputLabel for="inactive" class="ml-2 text-sm font-medium text-gray-900">
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
                            <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg relative">
                                <table class="min-w-full divide-y divide-gray-300">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col"
                                                class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                                Image
                                            </th>
                                            <th scope="col"
                                                class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                                Product Name
                                            </th>
                                            <th scope="col"
                                                class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                                Price
                                            </th>
                                            <th scope="col"
                                                class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                                Stocks
                                            </th>
                                            <th scope="col"
                                                class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                                Category Name
                                            </th>
                                            <th scope="col"
                                                class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                                Brand Name
                                            </th>
                                            <th scope="col"
                                                class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                                Status
                                            </th>
                                            <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6" />
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200 bg-white">
                                        <tr v-for="product in products.data" :key="product.id">
                                            <td
                                                class="py-4 pl-2 text-sm font-medium text-gray-900">
                                                <img v-if="product.image" :src="`/storage/${product.image}`" alt="Product Image"
                                                    class="w-56 h-24 object-contain rounded-md">
                                                <img v-else src="https://placehold.co/1000x500" alt="Placeholder Image"
                                                    class="w-72 h-32 object-contain rounded-md">
                                            </td>
                                            <td
                                                class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                                {{ product.name }}
                                            </td>
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                {{ product.price }}
                                            </td>
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 capitalize">
                                                {{ product.stocks }}
                                            </td>
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 capitalize">
                                                {{ product.category.name }}
                                            </td>
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 capitalize">
                                                {{ product.brand.name }}
                                            </td>
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                {{ product.is_active === 1 ? 'Active' : 'Inactive' }}
                                            </td>

                                            <td
                                                class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                                <Link :href="route('products.edit', product.id)"
                                                    class="text-slate-600 hover:text-slate-900">
                                                Edit
                                                </Link>
                                                <button @click="deleteStudent(product.id)"
                                                    class="ml-2 text-red-600 hover:text-red-900">
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