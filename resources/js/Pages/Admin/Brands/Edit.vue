<script setup>
import { ref } from "vue";
import { Link, useForm, usePage } from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import AdminLayout from "@/Layouts/AdminLayout.vue";

defineProps({
  brand: {
    type: Object,
    required: true,
  },
});

let brand = usePage().props.brand.data;

const form = useForm({
  name: brand.name,
  is_active: brand.is_active,
});

const updateBrand = () => {
  form.put(route("brands.update", brand.id));
};
</script>

<template>
  <AdminLayout title="Edit Brand">
    <div class="max-w-full mx-auto">
      <div class="lg:grid lg:grid-cols-12 lg:gap-x-5">
        <div class="space-y-6 sm:px-6 lg:px-0 lg:col-span-12">
          <form @submit.prevent="updateBrand">
            <div class="shadow sm:rounded-md sm:overflow-hidden">
              <div class="bg-white py-6 px-4 space-y-6 sm:p-6">
                <div>
                  <h3 class="text-lg leading-6 font-medium text-gray-900">
                    Brand Information
                  </h3>
                  <p class="mt-1 text-sm text-gray-500">
                    Use this form to create a new brand.
                  </p>
                </div>

                <div
                  class="grid grid-cols-12 gap-6 border rounded-md shadow-md px-4 py-6"
                >
                  <!-- Left column (existing fields) -->
                  <div class="col-span-8 grid grid-cols-8 gap-6">
                    <div class="col-span-6 sm:col-span-4">
                      <InputLabel for="name" value="Name" />
                      <TextInput
                        id="name"
                        v-model="form.name"
                        type="text"
                        class="mt-1 block w-full"
                      />
                      <InputError class="mt-2" :message="form.errors.name" />
                    </div>

                    <div class="col-span-6 sm:col-span-4">
                      <label
                        for="class_id"
                        class="block text-sm font-medium text-gray-700"
                        >Status</label
                      >
                      <select
                        v-model="form.is_active"
                        placeholder="Select Status"
                        class="mt-1 block w-full bg-white border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500"
                      >
                        <option disabled>Select Status</option>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                      </select>
                    </div>
                  </div>

                  <!-- Right column (new fields) -->
                  <div class="col-span-4 space-y-6 rounded-md shadow-md p-4">
                    <div class="">
                      <InputLabel for="created_at" value="Created At" />
                      <TextInput
                        id="created_at"
                        v-model="brand.created_at"
                        type="text"
                        class="mt-1 block w-full border-none bg-gray-100"
                        disabled
                      />
                    </div>

                    <div>
                      <InputLabel for="updated_at" value="Updated At" />
                      <TextInput
                        id="updated_at"
                        v-model="brand.updated_at"
                        type="text"
                        class="mt-1 block w-full border-none bg-gray-100"
                        disabled
                      />
                    </div>
                  </div>
                </div>
              </div>
              <div class="px-4 py-3 bg-gray-50 text-right sm:px-6 space-x-2">
                <Link :href="route('brands.index')">
                  <SecondaryButton> Cancel </SecondaryButton>
                </Link>
                <PrimaryButton> Save </PrimaryButton>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </AdminLayout>
</template>
