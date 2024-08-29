<script setup>
import { ref } from 'vue';
import { Link, useForm, usePage } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';

defineProps({
    roles: {
        type: Object,
        required: true,
    },
    users: {
        type: Object,
        required: true,
    },
});

let user = usePage().props.users.data;

const form = useForm({
    name: user.name,
    email: user.email,
    role_id: user.role.id,
});

const updateUser = () => {
    form.put(route('users.update', user.id));
};

</script>

<template>
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="lg:grid lg:grid-cols-12 lg:gap-x-5">
            <div class="space-y-6 sm:px-6 lg:px-0 lg:col-span-12">
                <form @submit.prevent="updateUser">
                    <div class="shadow sm:rounded-md sm:overflow-hidden">
                        <div class="bg-white py-6 px-4 space-y-6 sm:p-6">
                            <div>
                                <h3 class="text-lg leading-6 font-medium text-gray-900">
                                    Edit User Information
                                </h3>
                                <p class="mt-1 text-sm text-gray-500">
                                    Use this form to edit a user information.
                                </p>
                            </div>

                            <div class="grid grid-cols-6 gap-6">
                                <div class="col-span-6 sm:col-span-3">
                                    <InputLabel for="name" value="Name" />
                                    <TextInput id="name" v-model="form.name" type="text" class="mt-1 block w-full" />
                                    <InputError class="mt-2" :message="form.errors.name" />
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <InputLabel for="email" value="Email" />
                                    <TextInput id="email" v-model="form.email" type="email" class="mt-1 block w-full" />
                                    <InputError class="mt-2" :message="form.errors.email" />
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <label for="class_id" class="block text-sm font-medium text-gray-700">Role</label>
                                    <select v-model="form.role_id" 
                                        class="mt-1 block w-full bg-white border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500">
                                        <option disabled>Select Role</option>
                                        <option v-for="role in roles.data" :key="role.id" :value="role.id"
                                            :selected="role.id === form.role_id" class="capitalize">{{ role.name }}
                                        </option>
                                    </select>
                                </div>

                            </div>
                        </div>
                        <div class="px-4 py-3 bg-gray-50 text-right sm:px-6 space-x-2">
                            <Link :href="route('users.index')">
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
</template>