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
  announcement: {
    type: Object,
    required: true,
  },
});

let announcement = usePage().props.announcement.data;

const form = useForm({
  title: announcement.title,
  description: announcement.description,
  is_active: announcement.is_active,
});

const updateannouncement = () => {
  form.put(route("announcement.update", announcement.id));
};
</script>

<template>
  <AdminLayout>
    <div class="max-w-full mx-auto">
      <div class="lg:grid lg:grid-cols-12 lg:gap-x-5">
        <div class="space-y-6 sm:px-6 lg:px-0 lg:col-span-12">
          <form @submit.prevent="updateannouncement">
            <div class="shadow sm:rounded-md sm:overflow-hidden">
              <div class="bg-white py-6 px-4 space-y-6 sm:p-6">
                <div>
                  <h3 class="text-lg leading-6 font-medium text-gray-900">
                    Announcement Information
                  </h3>
                  <p class="mt-1 text-sm text-gray-500">
                    Use this form to create a new announcement.
                  </p>
                </div>

                <div class="grid grid-cols-6 gap-6">
                  <div class="col-span-6 sm:col-span-3">
                    <InputLabel for="title" value="Title" />
                    <TextInput
                      id="title"
                      v-model="form.title"
                      type="text"
                      class="mt-1 block w-full"
                    />
                    <InputError class="mt-2" :message="form.errors.title" />
                  </div>
                  <div class="col-span-6 sm:col-span-3">
                    <InputLabel for="description" value="Description" />
                    <TextInput
                      id="description"
                      v-model="form.description"
                      type="text"
                      class="mt-1 block w-full"
                    />
                    <InputError class="mt-2" :message="form.errors.description" />
                  </div>
                </div>
              </div>
              <div class="px-4 py-3 bg-gray-50 text-right sm:px-6 space-x-2">
                <Link :href="route('announcement.index')">
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
