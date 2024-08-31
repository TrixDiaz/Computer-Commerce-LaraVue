<script setup>
import { Link, router } from '@inertiajs/vue3';

const logout = () => {
    router.post(route('logout'));
};
</script>

<template>
    <span class="inline-flex rounded-md">
        <button type="button" id="user-menu-button" aria-expanded="false" data-dropdown-toggle="dropdown">
            <div
                class="relative inline-flex items-center justify-center w-8 h-8 overflow-hidden bg-gray-200 rounded-full">
                <span class="text-black capitalize">{{ $page.props.auth.user.name.charAt(0) }}</span>
            </div>
        </button>
    </span>
    <!-- Dropdown menu -->
    <div class="hidden relative z-50 my-4 w-56 text-base list-none bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600"
        id="dropdown">
        <div class="py-3 px-4">
            <span class="block text-sm font-semibold text-gray-900 dark:text-white">{{ $page.props.auth.user.name }}</span>
            <span class="block text-sm text-gray-500 truncate dark:text-gray-400">{{ $page.props.auth.user.email }}</span>
        </div>
        <ul class="py-1 text-gray-500 dark:text-gray-400" aria-labelledby="dropdown">
            <li>
                <Link :href="route('profile.edit')"
                    class="block py-2 px-4 text-sm hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-400 dark:hover:text-white">
                    My profile
                </Link>
            </li>
            <li class="cursor-pointer">
                <form @submit.prevent="logout">
                    <Link href="#" @click.prevent="logout" class="block py-2 px-4 text-sm hover:bg-gray-200 ">
                    Sign out
                    </Link>
                </form>
            </li>
        </ul>
    </div>
</template>