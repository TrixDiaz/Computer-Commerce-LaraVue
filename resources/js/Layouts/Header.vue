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
import { useCartStore } from "@/Store/CartStore";

const isOpen = ref(false);
const isMobileMenuOpen = ref(false);
const cartStore = useCartStore();

defineProps({
  canLogin: {
    type: Boolean,
  },
});
</script>

<template>
  <div class="relative flex flex-col m-4 z-20 md:max-w-7xl md:mx-auto md:flex-row">
    <!-- Logo and mobile menu button -->
    <div class="flex justify-between items-center">
      <ApplicationLogo class="ml-2" />
      <button @click="isMobileMenuOpen = !isMobileMenuOpen" class="md:hidden">
        <Menu class="h-6 w-6" />
      </button>
    </div>

    <!-- Navigation menu -->
    <nav
      :class="{ hidden: !isMobileMenuOpen, flex: isMobileMenuOpen }"
      class="flex-col w-full mt-4 md:flex md:flex-row md:justify-between md:items-center md:mt-0 md:ml-6"
    >
      <!-- Product categories -->
      <ul v-if="!isOpen" class="flex flex-col md:flex-row md:space-x-4 mb-4 md:mb-0">
        <li class="text-gray-800 cursor-pointer font-bold py-2 md:py-0">
          <Link :href="route('catalog.index')">Products</Link>
        </li>
        <li class="text-gray-800 cursor-pointer py-2 md:py-0">
          <Link :href="route('catalog.index', { filterCategory: '1' })">Laptop</Link>
        </li>
        <li class="text-gray-800 cursor-pointer py-2 md:py-0">
          <Link :href="route('catalog.index', { filterCategory: '2' })">Desktop</Link>
        </li>
        <li class="text-gray-800 cursor-pointer py-2 md:py-0">
          <Link :href="route('catalog.index', { filterCategory: '3' })">Components</Link>
        </li>
        <li class="text-gray-800 cursor-pointer py-2 md:py-0">
          <Link :href="route('catalog.index', { filterCategory: '4' })">Peripherals</Link>
        </li>
      </ul>

      <!-- Search form -->
      <div class="grow mb-4 md:mb-0">
        <Transition name="slide-fade">
          <form v-if="isOpen" action="">
            <div class="relative w-full flex items-center justify-between rounded-md">
              <MagnifyingGlass class="absolute left-2 block h-5 w-5 text-gray-400" />
              <input
                type="name"
                name="search"
                class="h-10 w-full cursor-text border border-gray-200 bg-gray-200 py-2 pr-4 pl-10 shadow-sm outline-none rounded-full"
                placeholder="Search..."
                aria-autocomplete="inline"
                autofocus
              />
            </div>
          </form>
        </Transition>
      </div>

      <!-- Icons -->
      <ul class="flex items-center space-x-4">
        <li
          v-if="!isOpen"
          @click="isOpen = true"
          class="cursor-pointer text-gray-600 hover:text-black"
        >
          <MagnifyingGlass class="h-6 w-6" />
        </li>
        <li
          v-else
          @click="isOpen = false"
          class="cursor-pointer text-gray-600 hover:text-black"
        >
          <X class="h-6 w-6" />
        </li>
        <li class="cursor-pointer text-gray-600 hover:text-black">
          <div class="relative">
            <Link :href="route('cart.index')">
              <Cart class="h-6 w-6" />
              <span
                v-if="cartStore.items.length > 0"
                class="absolute -top-2 -right-2 inline-flex items-center justify-center w-5 h-4 text-xs font-bold text-white bg-blue-600 rounded-full"
              >
                {{ cartStore.items.length }}
              </span>
            </Link>
          </div>
        </li>
        <li v-if="$page.props.auth.user">
          <AuthenticatedDropdown />
        </li>
        <li v-else class="cursor-pointer text-gray-600 hover:text-black">
          <Link :href="route('login')">
            <Login class="h-6 w-6" />
          </Link>
        </li>
      </ul>
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
