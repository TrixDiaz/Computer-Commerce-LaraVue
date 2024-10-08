<script setup>
import { computed, onMounted, ref, watch } from 'vue'
import { Head, Link, useForm, router, usePage } from "@inertiajs/vue3";
import { initFlowbite } from 'flowbite'
import AdminLayout from '@/Layouts/AdminLayout.vue';
import MagnifyingGlass from "@/Components/Icons/MagnifyingGlass.vue";
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import Pagination from "@/Components/Pagination.vue";
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import ArrowDown from '@/Components/Icons/ArrowDown.vue';
import Filter from '@/Components/Icons/Filter.vue';

onMounted(() => {
    initFlowbite();
})

defineProps({
    users: {
        type: Object,
    },

});

let search = ref(usePage().props.search ?? '');
let sort = ref('');
let filter = ref([]);
let pageNumber = ref(1);

let usersUrl = computed(() => {
    let url = new URL(route('users.index'));

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
    () => usersUrl.value,
    (updateUserUrl) => {
        router.visit(updateUserUrl, {
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

const sortUsers = (order) => {
    sort.value = order;
};

const filterUsers = (roleId) => {
    if (filter.value.includes(roleId)) {
        filter.value = filter.value.filter(id => id !== roleId);
    } else {
        filter.value.push(roleId);
    }
};


const deleteForm = useForm({});

const deleteStudent = (userId) => {
    if (confirm('Are you sure you want to delete this user?')) {
        deleteForm.delete(route('users.destroy', userId));
    }
}
</script>

<template>
    <AdminLayout title="Users">
        <div class="overflow-hidden">
            <div class="mx-auto max-w-full">
                <section class="flex items-center">
                    <div class="w-full">
                        <p class="px-2 pb-2 font-medium text-xl Capitalize">View all Users</p>
                        <div class="relative bg-white shadow-md sm:rounded-lg">
                            <div
                                class="flex flex-col items-center justify-between p-4 space-y-2 md:flex-row md:space-y-0 md:space-x-4">
                                <div class="w-full md:w-1/2">
                                    <form class="flex items-center gap-2">
                                        <InputLabel for="simple-search" class="sr-only">Search</InputLabel>
                                        <div class="relative w-full">
                                            <div
                                                class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                <MagnifyingGlass class="w-5 h-5 text-gray-400" />
                                            </div>
                                            <TextInput v-model="search" type="text" placeholder="Search"
                                                class="block w-full p-2 pl-10 text-sm" />
                                        </div>
                                        <Link :href="route('users.index')">Reset</Link>
                                    </form>
                                </div>
                                <div
                                    class="flex flex-col items-stretch justify-end flex-shrink-0 w-full space-y-2 md:w-auto md:flex-row md:space-y-0 md:items-center md:space-x-2">
                                    <!-- <Link :href="route('users.create')">
                                    <PrimaryButton>
                                        Add User
                                    </PrimaryButton>
                                    </Link> -->

                                    <div class="flex items-center w-full space-x-2 md:w-auto">
                                        <SecondaryButton id="actionsDropdownButton"
                                            data-dropdown-toggle="actionsDropdown"
                                            class="flex items-center justify-center w-full px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg md:w-auto hover:bg-gray-100 hover:text-primary-700"
                                            type="button">
                                            <ArrowDown />
                                            Sort
                                        </SecondaryButton>
                                        <div id="actionsDropdown"
                                            class="z-10 hidden bg-white divide-y divide-gray-100 rounded shadow w-44">
                                            <ul class="py-1 text-sm text-gray-700"
                                                aria-labelledby="actionsDropdownButton">
                                                <li>
                                                    <Link @click.prevent="sortUsers('asc')" href="#"
                                                        class="block px-4 py-2 hover:bg-gray-100 capitalize">sort by a-z
                                                    </Link>
                                                </li>
                                                <li>
                                                    <Link @click.prevent="sortUsers('desc')" href="#"
                                                        class="block px-4 py-2 hover:bg-gray-100 capitalize">sort by z-a
                                                    </Link>
                                                </li>
                                            </ul>
                                        </div>

                                        <SecondaryButton id="filterDropdownButton" data-dropdown-toggle="filterDropdown"
                                            class="flex items-center justify-center w-full px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg md:w-auto hover:bg-gray-100 hover:text-primary-700"
                                            type="button">
                                            <Filter />
                                            Filter
                                            <ArrowDown />
                                        </SecondaryButton>

                                        <!-- Dropdown menu -->
                                        <div id="filterDropdown"
                                            class="z-10 hidden w-48 p-3 bg-white rounded-lg shadow">
                                            <h6 class="mb-3 text-sm font-medium text-gray-900">
                                                Category
                                            </h6>
                                            <ul class="space-y-2 text-sm" aria-labelledby="dropdownDefault">
                                                <li class="flex items-center">
                                                    <input @change="filterUsers(1)" id="users" type="checkbox" value=""
                                                        class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600" />
                                                    <InputLabel for="users"
                                                        class="ml-2 text-sm font-medium text-gray-900">
                                                        Users
                                                    </InputLabel>
                                                </li>
                                                <li class="flex items-center">
                                                    <input @change="filterUsers(2)" id="editors" type="checkbox"
                                                        value=""
                                                        class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600" />
                                                    <InputLabel for="editors"
                                                        class="ml-2 text-sm font-medium text-gray-900">
                                                        Editors
                                                    </InputLabel>
                                                </li>
                                                <li class="flex items-center">
                                                    <input @change="filterUsers(3)" id="admins" type="checkbox" value=""
                                                        class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600" />
                                                    <InputLabel for="admins"
                                                        class="ml-2 text-sm font-medium text-gray-900">
                                                        Admins
                                                    </InputLabel>
                                                </li>
                                                <li class="flex items-center">
                                                    <input id="deleted" type="checkbox" value=""
                                                        class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600" />
                                                    <InputLabel for="deleted"
                                                        class="ml-2 text-sm font-medium text-gray-900">
                                                        Deleted Users
                                                    </InputLabel>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Table -->
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
                                                Name
                                            </th>
                                            <th scope="col"
                                                class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                                                Email
                                            </th>
                                            <th scope="col"
                                                class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                                Role
                                            </th>
                                            <th scope="col"
                                                class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                                Created At
                                            </th>
                                            <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6" />
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200 bg-white">
                                        <tr v-for="user in users.data" :key="user.id">
                                            <td
                                                class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                                {{ user.id }}
                                            </td>
                                            <td
                                                class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                                {{ user.name }}
                                            </td>
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                {{ user.email }}
                                            </td>
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 capitalize">
                                                {{ user.role?.name || 'No Role Assigned' }}
                                            </td>
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                                {{ user.created_at }}
                                            </td>

                                            <td
                                                class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                                <Link :href="route('users.edit', user.id)"
                                                    class="text-slate-600 hover:text-slate-900">
                                                Edit
                                                </Link>
                                                <button @click="deleteStudent(user.id)"
                                                    class="ml-2 text-red-600 hover:text-red-900">
                                                    Delete
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <Pagination :data="users" :pageNumberUpdated="pageNumberUpdated" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>