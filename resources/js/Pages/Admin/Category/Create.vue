<script setup>
import { ref } from 'vue';
import { Link, useForm } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import Eye from '@/Components/Icons/Eye.vue';
import CloseEye from '@/Components/Icons/CloseEye.vue';
import AdminLayout from '@/Layouts/AdminLayout.vue';

defineProps({
    categories: {
        type: Object,
        required: true,
    },
});

const form = useForm({
    name: '',
    is_active: true,
});

const createBrand = () => {
    form.post(route('categories.store'), {
        onSuccess: () => {
            form.reset();
        },
    });
};




</script>

<template>
    <AdminLayout>
        <div class="max-w-full mx-auto">
            <div class="lg:grid lg:grid-cols-12 lg:gap-x-5">
                <div class="space-y-6 sm:px-6 lg:px-0 lg:col-span-12">
                    <form @submit.prevent="createBrand">
                        <div class="shadow sm:rounded-md sm:overflow-hidden">
                            <div class="bg-white py-6 px-4 space-y-6 sm:p-6">
                                <div>
                                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                                        Category Information
                                    </h3>
                                    <p class="mt-1 text-sm text-gray-500">
                                        Use this form to create a new category.
                                    </p>
                                </div>

                                <div class="grid grid-cols-6 gap-6">
                                    <div class="col-span-6 sm:col-span-3">
                                        <InputLabel for="name" value="Name" />
                                        <TextInput id="name" v-model="form.name" type="text"
                                            class="mt-1 block w-full" />
                                        <InputError class="mt-2" :message="form.errors.name" />
                                    </div>
                                </div>

                            </div>
                            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6 space-x-2">
                                <Link :href="route('categories.index')">
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