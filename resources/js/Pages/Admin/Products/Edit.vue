<script setup>
import { ref, computed } from "vue";
import { Link, useForm, usePage } from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import AdminLayout from "@/Layouts/AdminLayout.vue";

defineProps({
  categories: {
    type: Object,
    required: true,
  },
  brands: {
    type: Object,
    required: true,
  },
  product: {
    type: Object,
    required: true,
  },
  series: {
    type: Object,
    required: true,
  },
});

let product = usePage().props.product.data;

const form = useForm({
  _method: "PUT",
  name: product.name,
  description: product.description,
  price: product.price,
  sale_price: product.sale_price,
  stocks: String(product.stocks),
  image: null,
  category_id: product.category.id,
  brand_id: product.brand.id,
  series_id: product.series.id,
  is_featured: product.is_featured,
  is_sale: product.is_sale,
  is_new: product.is_new,
  is_active: product.is_active,
});

const imagePreview = ref(product.image ? `/storage/${product.image}` : null);

const currentImageUrl = computed(() => {
  if (product.image) {
    return `/storage/${product.image}`;
  }
  return null;
});

const handleImageChange = (event) => {
  const file = event.target.files[0];
  form.image = file;

  if (file) {
    const reader = new FileReader();
    reader.onload = (e) => {
      imagePreview.value = e.target.result;
    };
    reader.readAsDataURL(file);
  } else {
    imagePreview.value = null;
  }
};

const updateProduct = () => {
  // Remove the image field if it's null (no new image selected)
  if (form.image === null) {
    const formData = { ...form };
    delete formData.image;

    form.post(route("products.update", product.id), {
      preserveScroll: true,
      preserveState: true,
      data: formData,
    });
  } else {
    form.post(route("products.update", product.id), {
      preserveScroll: true,
      preserveState: true,
      forceFormData: true,
    });
  }
};
</script>

<template>
  <AdminLayout title="Create Products">
    <div class="max-w-full mx-auto">
      <div class="lg:grid lg:grid-cols-12 lg:gap-x-5">
        <div class="space-y-6 sm:px-6 lg:px-0 lg:col-span-12">
          <form @submit.prevent="updateProduct" enctype="multipart/form-data">
            <div class="shadow sm:rounded-md sm:overflow-hidden">
              <div class="bg-white py-6 px-4 space-y-6 sm:p-6">
                <div>
                  <h3 class="text-lg leading-6 font-medium text-gray-900">
                    User Information
                  </h3>
                  <p class="mt-1 text-sm text-gray-500">
                    Use this form to create a new user.
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
                      <InputLabel for="price" value="Price" />
                      <TextInput
                        id="price"
                        v-model="form.price"
                        type="text"
                        class="mt-1 block w-full"
                      />
                      <InputError class="mt-2" :message="form.errors.price" />
                    </div>

                    <div class="col-span-6 sm:col-span-8">
                      <InputLabel for="description" value="Description" />
                      <TextInput
                        id="description"
                        v-model="form.description"
                        type="text"
                        class="mt-1 block w-full"
                      />
                      <InputError class="mt-2" :message="form.errors.description" />
                    </div>

                    <div class="col-span-6 sm:col-span-4">
                      <InputLabel for="sale_price" value="Sale Price" />
                      <TextInput
                        id="sale_price"
                        v-model="form.sale_price"
                        type="text"
                        class="mt-1 block w-full"
                      />
                      <InputError class="mt-2" :message="form.errors.sale_price" />
                    </div>

                    <div class="col-span-6 sm:col-span-4">
                      <InputLabel for="stock" value="Stock" />
                      <TextInput
                        id="stock"
                        v-model="form.stocks"
                        type="text"
                        class="mt-1 block w-full"
                      />
                      <InputError class="mt-2" :message="form.errors.stock" />
                    </div>

                    <div class="col-span-6 sm:col-span-4">
                      <label
                        for="category_id"
                        class="block text-sm font-medium text-gray-700"
                        >Category</label
                      >
                      <select
                        v-model="form.category_id"
                        placeholder="Select Category"
                        class="mt-1 block w-full bg-white border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500"
                      >
                        <option disabled>Select Category</option>
                        <option
                          v-for="category in categories.data"
                          :key="category.id"
                          :value="category.id"
                          class="capitalize"
                        >
                          {{ category.name }}
                        </option>
                      </select>
                    </div>

                    <div class="col-span-6 sm:col-span-4">
                      <label
                        for="brand_id"
                        class="block text-sm font-medium text-gray-700"
                        >Brand</label
                      >
                      <select
                        v-model="form.brand_id"
                        placeholder="Select Category"
                        class="mt-1 block w-full bg-white border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500"
                      >
                        <option disabled>Select Brand</option>
                        <option
                          v-for="brand in brands.data"
                          :key="brand.id"
                          :value="brand.id"
                          class="capitalize"
                        >
                          {{ brand.name }}
                        </option>
                      </select>
                    </div>

                    <div class="col-span-6 sm:col-span-4">
                      <label
                        for="series_id"
                        class="block text-sm font-medium text-gray-700"
                        >Series</label
                      >
                      <select
                        v-model="form.series_id"
                        placeholder="Select Category"
                        class="mt-1 block w-full bg-white border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500"
                      >
                        <option disabled>Select Series</option>
                        <option
                          v-for="series in series.data"
                          :key="series.id"
                          :value="series.id"
                          class="capitalize"
                        >
                          {{ series.name }}
                        </option>
                      </select>
                    </div>

                    <div class="col-span-6 sm:col-span-4">
                      <label
                        for="class_id"
                        class="block text-sm font-medium text-gray-700"
                        >Featured</label
                      >
                      <select
                        v-model="form.is_featured"
                        placeholder="Select Featured"
                        class="mt-1 block w-full bg-white border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500"
                      >
                        <option disabled>Select Featured</option>
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                      </select>
                    </div>

                    <div class="col-span-6 sm:col-span-4">
                      <label
                        for="class_id"
                        class="block text-sm font-medium text-gray-700"
                        >Sale</label
                      >
                      <select
                        v-model="form.is_sale"
                        placeholder="Select Featured"
                        class="mt-1 block w-full bg-white border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500"
                      >
                        <option disabled>Select Sale</option>
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                      </select>
                    </div>

                    <div class="col-span-6 sm:col-span-4">
                      <label
                        for="class_id"
                        class="block text-sm font-medium text-gray-700"
                        >New</label
                      >
                      <select
                        v-model="form.is_new"
                        placeholder="Select New"
                        class="mt-1 block w-full bg-white border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500"
                      >
                        <option disabled>Select New</option>
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                      </select>
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
                    <div class="col-span-6 sm:col-span-3">
                      <InputLabel for="Image" value="Image" />
                      <input
                        type="file"
                        @input="handleImageChange"
                        class="w-full border"
                        accept="image/*"
                      />
                      <progress
                        v-if="form.progress"
                        :value="form.progress.percentage"
                        max="100"
                      >
                        {{ form.progress.percentage }}%
                      </progress>
                      <InputError class="mt-2" :message="form.errors.image" />
                    </div>

                    <div class="col-span-6 sm:col-span-3">
                      <img
                        v-if="currentImageUrl && !imagePreview"
                        :src="currentImageUrl"
                        alt="Current Product Image"
                        class="max-w-full max-h-full mx-auto rounded-md"
                      />
                      <img
                        v-if="imagePreview"
                        :src="imagePreview"
                        alt="New Product Image"
                        class="max-w-full max-h-full mx-auto rounded-md"
                      />
                    </div>
                    <div class="">
                      <InputLabel for="created_at" value="Created At" />
                      <TextInput
                        id="created_at"
                        v-model="product.created_at"
                        type="text"
                        class="mt-1 block w-full border-none bg-gray-100"
                        disabled
                      />
                    </div>

                    <div>
                      <InputLabel for="updated_at" value="Updated At" />
                      <TextInput
                        id="updated_at"
                        v-model="product.updated_at"
                        type="text"
                        class="mt-1 block w-full border-none bg-gray-100"
                        disabled
                      />
                    </div>
                  </div>
                </div>
              </div>
              <div class="px-4 py-3 bg-gray-50 text-right sm:px-6 space-x-2">
                <Link :href="route('products.index')">
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
