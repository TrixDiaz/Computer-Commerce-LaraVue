<script setup>
import { computed, onMounted, ref, watch } from 'vue'
import { Head, Link, useForm, router, usePage } from "@inertiajs/vue3";
import { initFlowbite } from 'flowbite'
import MagnifyingGlass from "@/Components/Icons/MagnifyingGlass.vue";
import PrimaryButton from '@/Components/PrimaryButton.vue';
import Pagination from "@/Components/Pagination.vue";
import TextInput from '@/Components/TextInput.vue';

onMounted(() => {
    initFlowbite();
})

defineProps({
    brands: {
        type: Object,
    },

});

let search = ref(usePage().props.search ?? '');
let sort = ref('');
let filter = ref([]);
let pageNumber = ref(1);

let brandsUrl = computed(() => {
    let url = new URL(route('brands.index'));

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
    () => brandsUrl.value,
    (updatebrandUrl) => {
        router.visit(updatebrandUrl, {
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

const sortbrands = (order) => {
    sort.value = order;
};

const filterbrands = (roleId) => {
    if (filter.value.includes(roleId)) {
        filter.value = filter.value.filter(id => id !== roleId);
    } else {
        filter.value.push(roleId);
    }
};


const deleteForm = useForm({});

const deleteStudent = (brandId) => {
    if (confirm('Are you sure you want to delete this brand?')) {
        deleteForm.delete(route('brands.destroy', brandId));
    }
}
</script>

<template>
    <Head title="brands" />
    <div class="bg-gray-100 py-10">
        <div class="mx-auto max-w-7xl">
            <section class="flex items-center">
                <div class="w-full">
                    <p class="p-4 font-medium text-xl Capitalize">View all brands</p>
                    <div class="relative bg-white shadow-md sm:rounded-lg">
                        <div
                            class="flex flex-col items-center justify-between p-4 space-y-2 md:flex-row md:space-y-0 md:space-x-4">
                            <div class="w-full md:w-1/2">
                                <form class="flex items-center">
                                    <label for="simple-search" class="sr-only">Search</label>
                                    <div class="relative w-full">
                                        <div
                                            class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                            <svg aria-hidden="true" class="w-5 h-5 text-gray-500" fill="currentColor"
                                                viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <TextInput v-model="search" type="text" placeholder="Search"
                                            class="block w-full p-2 pl-10 text-sm" />
                                    </div>
                                </form>
                            </div>
                            <div
                                class="flex flex-col items-stretch justify-end flex-shrink-0 w-full space-y-2 md:w-auto md:flex-row md:space-y-0 md:items-center md:space-x-2">
                                <Link :href="route('brands.create')">
                                    <PrimaryButton>
                                        Add Brand
                                    </PrimaryButton>
                                </Link>

                                <div class="flex items-center w-full space-x-2 md:w-auto">
                                    <button id="actionsDropdownButton" data-dropdown-toggle="actionsDropdown"
                                        class="flex items-center justify-center w-full px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg md:w-auto hover:bg-gray-100 hover:text-primary-700"
                                        type="button">
                                        <svg class="-ml-1 mr-1.5 w-5 h-5" fill="currentColor" viewbox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                            <path clip-rule="evenodd" fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                                        </svg>
                                        Sort
                                    </button>
                                    <div id="actionsDropdown"
                                        class="z-10 hidden bg-white divide-y divide-gray-100 rounded shadow w-44">
                                        <ul class="py-1 text-sm text-gray-700" aria-labelledby="actionsDropdownButton">
                                            <li>
                                                <Link @click.prevent="sortbrands('asc')" href="#"
                                                    class="block px-4 py-2 hover:bg-gray-100 capitalize">sort by a-z
                                                </Link>
                                            </li>
                                            <li>
                                                <Link @click.prevent="sortbrands('desc')" href="#"
                                                    class="block px-4 py-2 hover:bg-gray-100 capitalize">sort by z-a
                                                </Link>
                                            </li>
                                        </ul>
                                    </div>

                                    <button id="filterDropdownButton" data-dropdown-toggle="filterDropdown"
                                        class="flex items-center justify-center w-full px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg md:w-auto hover:bg-gray-100 hover:text-primary-700"
                                        type="button">
                                        <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                                            class="w-4 h-4 mr-2 text-gray-400" viewbox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        Filter
                                        <svg class="-mr-1 ml-1.5 w-5 h-5" fill="currentColor" viewbox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                            <path clip-rule="evenodd" fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                                        </svg>
                                    </button>

                                    <!-- Dropdown menu -->
                                    <div id="filterDropdown" class="z-10 hidden w-48 p-3 bg-white rounded-lg shadow">
                                        <h6 class="mb-3 text-sm font-medium text-gray-900">
                                            Category
                                        </h6>
                                        <ul class="space-y-2 text-sm" aria-labelledby="dropdownDefault">
                                            <li class="flex items-center">
                                                <input @change="filterbrands(1)" id="brands" type="checkbox"
                                                    value=""
                                                    class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600" />
                                                <label for="brands" class="ml-2 text-sm font-medium text-gray-900">
                                                    brands
                                                </label>
                                            </li>
                                            <li class="flex items-center">
                                                <input @change="filterbrands(2)" id="editors" type="checkbox" value=""
                                                    class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600" />
                                                <label for="editors" class="ml-2 text-sm font-medium text-gray-900">
                                                    Editors
                                                </label>
                                            </li>
                                            <li class="flex items-center">
                                                <input @change="filterbrands(3)" id="admins" type="checkbox" value=""
                                                    class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600" />
                                                <label for="admins" class="ml-2 text-sm font-medium text-gray-900">
                                                    Admins
                                                </label>
                                            </li>
                                            <li class="flex items-center">
                                                <input id="deleted" type="checkbox" value=""
                                                    class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600" />
                                                <label for="deleted" class="ml-2 text-sm font-medium text-gray-900">
                                                    Deleted brands
                                                </label>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
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
                                            ID
                                        </th>
                                        <th scope="col"
                                            class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                            Brand Name
                                        </th>
                                        <th scope="col"
                                            class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                            Slug
                                        </th>
                                        <th scope="col"
                                            class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                            Created At
                                        </th>
                                        <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6" />
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 bg-white">
                                    <tr v-for="brand in brands.data" :key="brand.id">
                                        <td
                                            class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                            {{ brand.id }}
                                        </td>
                                        <td
                                            class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                            {{ brand.name }}
                                        </td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                            {{ brand.slug }}
                                        </td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                            {{ brand.created_at }}
                                        </td>

                                        <td
                                            class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                            <Link :href="route('brands.edit', brand.id)"
                                                class="text-slate-600 hover:text-slate-900">
                                            Edit
                                            </Link>
                                            <button @click="deleteStudent(brand.id)"
                                                class="ml-2 text-red-600 hover:text-red-900">
                                                Delete
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <Pagination :data="brands" :pageNumberUpdated="pageNumberUpdated" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>