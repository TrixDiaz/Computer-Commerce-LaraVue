<script setup>
import { Link } from "@inertiajs/vue3";
import { ref } from "vue";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import AuthenticatedDropdown from "@/Layouts/AuthenticatedDropdown.vue";
import X from "@/Components/Icons/X.vue";
import MagnifyingGlass from "@/Components/Icons/MagnifyingGlass.vue";
import Cart from "@/Components/Icons/Cart.vue";
import Login from "@/Components/Icons/Login.vue";
import Menu from "@/Components/Icons/Menu.vue";
const isOpen = ref(false);

defineProps({
  canLogin: {
    type: Boolean,
  },
});
</script>

<template>
  <div class="relative flex max-w-7xl flex-col m-4 sm:mx-auto sm:flex-row z-20">
    <!-- Icon -->
    <p class="ml-2">
      <ApplicationLogo />
    </p>
    <input type="checkbox" class="peer hidden" id="navbar-open" />
    <label class="absolute right-4 top-2 cursor-pointer lg:hidden" for="navbar-open">
      <span class="sr-only">Toggle menu</span>
      <Menu />
    </label>
    <nav
      aria-labelledby="header-navigation"
      class="lg:peer-checked:mt-0 peer-checked:max-h-full flex max-h-0 w-full flex-col items-center justify-between transition-all lg:ml-24 lg:max-h-full lg:flex-row lg:items-start"
    >
      <div class="flex flex-none" v-if="isOpen === false">
        <ul class="flex flex-col items-center sm:flex-row sm:gap-4 lg:mt-2">
          <li class="text-gray-800 cursor-pointer font-bold">Products</li>
          <li class="text-gray-800 cursor-pointer">Laptop</li>
          <li class="text-gray-800 cursor-pointer">Desktop</li>
          <li class="text-gray-800 cursor-pointer">Components</li>
          <li class="text-gray-800 cursor-pointer">Peripherals</li>
        </ul>
      </div>
      <div class="grow">
        <Transition name="slide-fade">
          <form v-if="isOpen" action="">
            <div
              class="relative mb-2 w-full flex items-center justify-between rounded-md"
            >
              <MagnifyingGlass class="absolute left-2 block h-5 w-5 text-gray-400" />
              <input
                type="name"
                name="search"
                class="h-8 w-full cursor-text border border-gray-200 bg-gray-200 py-4 pr-40 pl-12 shadow-sm outline-none rounded-full"
                placeholder="Search..."
                aria-autocomplete="inline"
                autofocus
              />
            </div>
          </form>
        </Transition>
      </div>
      <div class="mt-0.5">
        <ul class="flex flex-none space-x-2">
          <li
            v-if="isOpen === false"
            @click="isOpen = true"
            class="flex ml-2 h-8 w-8 cursor-pointer items-center justify-center rounded-xl text-gray-600 hover:text-black hover:shadow"
          >
            <!-- Search Icon -->
            <MagnifyingGlass />
          </li>
          <li
            v-if="isOpen"
            @click="isOpen = false"
            class="flex ml-2 h-8 w-8 cursor-pointer items-center justify-center rounded-xl text-gray-600 hover:text-black hover:shadow"
          >
            <!-- X Icon -->
            <X />
          </li>
          <li
            class="flex h-8 w-8 cursor-pointer items-center justify-center rounded-xl text-gray-600 hover:text-black"
          >
            <!-- Cart Icon -->
            <div class="relative me-4">
              <Link :href="route('cart.index')">
                <Cart />
                <span
                  class="absolute z-0 inline-flex items-center justify-center w-5 h-5 text-xs font-bold text-white bg-blue-600 rounded-full top-0 end-0 transform translate-x-1/2 -translate-y-1/2"
                >
                  5</span
                >
              </Link>
            </div>
          </li>
          <!-- User Icon -->
          <li v-if="$page.props.auth.user">
            <AuthenticatedDropdown />
          </li>
          <li
            v-else
            class="flex h-8 w-8 cursor-pointer items-center justify-center rounded-xl text-gray-600 hover:text-black hover:shadow"
          >
            <Link :href="route('login')">
              <Login />
            </Link>
          </li>
        </ul>
      </div>
    </nav>
  </div>
  <hr />
</template>

<style>
/*
  Enter and leave animations can use different
  durations and timing functions.
*/
.slide-fade-enter-active {
  transition: all 0.3s ease-out;
}

.slide-fade-leave-active {
  transition: all 0.3s cubic-bezier(1, 0.5, 0.8, 1);
}

.slide-fade-enter-from,
.slide-fade-leave-to {
  transform: translateX(20px);
  opacity: 0;
}
</style>
