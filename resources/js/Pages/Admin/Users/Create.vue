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

defineProps({
    roles: {
        type: Object,
        required: true,
    },
});

const form = useForm({
    name: '',
    email: '',
    password: 'password',
    role_id: 1,
});

const createUser = () => {
    form.post(route('users.store'), {
        onSuccess: () => {
            form.reset();
        },
    });
};

const showPassword = ref(false);

</script>

<template>
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="lg:grid lg:grid-cols-12 lg:gap-x-5">
            <div class="space-y-6 sm:px-6 lg:px-0 lg:col-span-12">
                <form @submit.prevent="createUser">
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
                                    <TextInput id="name" v-model="form.name" type="text" class="mt-1 block w-full" />
                                    <InputError class="mt-2" :message="form.errors.name" />
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <InputLabel for="email" value="Email" />
                                    <TextInput id="email" v-model="form.email" type="email" class="mt-1 block w-full" />
                                    <InputError class="mt-2" :message="form.errors.email" />
                                </div>

                                <div class="relative col-span-6 sm:col-span-3">
                                    <InputLabel for="password" value="password" />
                                    <TextInput id="password" v-model="form.password"
                                        :type="showPassword ? 'text' : 'password'" class="mt-1 block w-full" />
                                    <InputError class="mt-2" :message="form.errors.password" />
                                    <CloseEye v-if="showPassword" @click="showPassword = !showPassword"
                                        class="absolute top-9 right-4" />
                                    <Eye @click="showPassword = !showPassword" class="absolute top-9 right-4" />
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <label for="class_id" class="block text-sm font-medium text-gray-700">Role</label>
                                    <select v-model="form.role_id" placeholder="Select Role"
                                        class="mt-1 block w-full bg-white border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-red-500 focus:border-red-500">
                                        <option disabled>Select Role</option>
                                        <option v-for="role in roles.data" :key="role.id" :value="role.id"
                                            class="capitalize">{{ role.name }}</option>
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