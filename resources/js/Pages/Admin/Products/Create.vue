<script setup>
import { ref } from 'vue';
import { Link, useForm } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import AdminLayout from '@/Layouts/AdminLayout.vue';

defineProps({
    categories: {
        type: Object,
        required: true,
    },
    brands: {
        type: Object,
        required: true,
    },
});

const form = useForm({
    name: '',
    description: '',
    price: '',
    sale_price: '',
    stocks: '',
    image: null,
    category_id: '',
    brand_id: '',
    is_featured: true,
    is_sale: false,
    is_new: true,
    is_active: true,
});

const imagePreview = ref(null);

const handleImageSelection = (event) => {
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

const createProducts = () => {
    form.post(route('products.store'), {
        onSuccess: () => {
            form.reset();
        },
    });
};


</script>

<template>
    <AdminLayout title="Create Products">
        <div class="max-w-full mx-auto">
            <div class="lg:grid lg:grid-cols-12 lg:gap-x-5">
                <div class="space-y-6 sm:px-6 lg:px-0 lg:col-span-12">
                    <form @submit.prevent="createProducts">
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

                                <div class="grid grid-cols-6 gap-6">

                                    <div class="col-span-6 sm:col-span-3">
                                        <InputLabel for="name" value="Name" />
                                        <TextInput id="name" v-model="form.name" type="text"
                                            class="mt-1 block w-full" />
                                        <InputError class="mt-2" :message="form.errors.name" />
                                    </div>

                                    <div class="col-span-6 sm:col-span-3">
                                        <InputLabel for="price" value="Price" />
                                        <TextInput id="price" v-model="form.price" type="text"
                                            class="mt-1 block w-full" />
                                        <InputError class="mt-2" :message="form.errors.price" />
                                    </div>

                                    <div class="col-span-6 sm:col-span-full">
                                        <InputLabel for="description" value="Description" />
                                        <TextInput id="description" v-model="form.description" type="text"
                                            class="mt-1 block w-full" />
                                        <InputError class="mt-2" :message="form.errors.description" />
                                    </div>

                                    <div class="col-span-6 sm:col-span-3">
                                        <InputLabel for="sale_price" value="Sale Price" />
                                        <TextInput id="sale_price" v-model="form.sale_price" type="text"
                                            class="mt-1 block w-full" />
                                        <InputError class="mt-2" :message="form.errors.sale_price" />
                                    </div>

                                    <div class="col-span-6 sm:col-span-3">
                                        <InputLabel for="stock" value="Stock" />
                                        <TextInput id="stock" v-model="form.stocks" type="text"
                                            class="mt-1 block w-full" />
                                        <InputError class="mt-2" :message="form.errors.stock" />
                                    </div>

                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="category_id"
                                            class="block text-sm font-medium text-gray-700">Category</label>
                                        <select v-model="form.category_id" placeholder="Select Category"
                                            class="mt-1 block w-full bg-white border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500">
                                            <option disabled>Select Category</option>
                                            <option v-for="category in categories.data" :key="category.id"
                                                :value="category.id" class="capitalize">{{ category.name }}</option>
                                        </select>
                                    </div>

                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="brand_id"
                                            class="block text-sm font-medium text-gray-700">Brand</label>
                                        <select v-model="form.brand_id" placeholder="Select Category"
                                            class="mt-1 block w-full bg-white border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500">
                                            <option disabled>Select Brand</option>
                                            <option v-for="brand in brands.data" :key="brand.id" :value="brand.id"
                                                class="capitalize">{{ brand.name }}</option>
                                        </select>
                                    </div>

                                    <div class="col-span-6 sm:col-span-3">
                                        <InputLabel for="Image" value="Image" />
                                        <input type="file" @input="handleImageSelection" accept="image/*"
                                            class="mt-1 block w-full border border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm" />
                                        <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                                            {{ form.progress.percentage }}%
                                        </progress>
                                        <InputError class="mt-2" :message="form.errors.image" />
                                    </div>

                                    <div v-if="imagePreview" class="col-span-6 sm:col-span-3">
                                        <img :src="imagePreview" alt="Image preview"
                                            class="max-w-full max-h-full mx-auto rounded-md" />
                                    </div>

                                </div>
                            </div>
                            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6 space-x-2">
                                <Link :href="route('products.index')">
                                <SecondaryButton>
                                    Cancel
                                </SecondaryButton>
                                </Link>
                                <PrimaryButton>
                                    Save
                                </PrimaryButton>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>