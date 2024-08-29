<script setup>
import { ref } from 'vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import Checkbox from '@/Components/Checkbox.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import Eye from '@/Components/Icons/Eye.vue';
import CloseEye from '@/Components/Icons/CloseEye.vue';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    terms: false,
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};

const validateName = (event) => {
    form.name = event.target.value.replace(/[^a-zA-Z\s]/g, '');
};

const showPassword = ref(false);
const showConfirmPassword = ref(false);
</script>

<template>
    <GuestLayout>

        <Head title="Register" />

        <form @submit.prevent="submit">
            <h1 class="text-xl font-bold leading-tight tracking-tight text-slate-700 md:text-2xl my-4">
                Create an account
            </h1>
            <div>
                <InputLabel for="name" value="Name" />

                <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus
                    autocomplete="name" @input="validateName" />

                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div class="mt-4">
                <InputLabel for="email" value="Email" />

                <TextInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required
                    autocomplete="username" />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="relative mt-4">
                <InputLabel for="password" value="Password" />

                <TextInput id="password" :type="showPassword ? 'text' : 'password'" class="mt-1 block w-full"
                    v-model="form.password" required autocomplete="new-password" pattern=".{8,}"
                    title="8 characters minimum" />

                <InputError class="mt-2" :message="form.errors.password" />
                <CloseEye v-if="showPassword" @click="showPassword = !showPassword" class="absolute top-9 right-4" />
                <Eye @click="showPassword = !showPassword" class="absolute top-9 right-4" />
            </div>

            <div class="relative mt-4">
                <InputLabel for="password_confirmation" value="Confirm Password" />

                <TextInput id="password_confirmation" :type="showConfirmPassword ? 'text' : 'password'" class="mt-1 block w-full"
                    v-model="form.password_confirmation" required autocomplete="new-password" pattern=".{8,}"
                    title="8 characters minimum" />

                <InputError class="mt-2" :message="form.errors.password_confirmation" />

                <CloseEye v-if="showConfirmPassword" @click="showConfirmPassword = !showConfirmPassword" class="absolute top-9 right-4" />
                <Eye @click="showConfirmPassword = !showConfirmPassword" class="absolute top-9 right-4" />
            </div>

            <div class="mt-2">
                <div class="flex items-start">
                    <div class="flex items-center h-5">
                        <checkbox v-model="form.terms" />
                    </div>
                    <div class="ml-3 text-sm">
                        <label for="terms" class="font-light text-slate-500">I accept the <a
                                class="font-medium text-red-600 hover:underline" href="#">Terms
                                and Conditions</a></label>
                    </div>
                </div>
            </div>
            <div v-if="form.errors.terms" class="text-red-500 text-xs">{{ form.errors.terms }}</div>

            <div class="mt-4">
                <PrimaryButton class="w-full" :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing || !form.terms">
                    Register
                </PrimaryButton>
            </div>

            <div class="mt-2">
                <p class="text-sm font-light text-slate-500 ">
                    Already have an account?
                    <Link :href="route('login')" class="font-medium text-red-600 hover:underline">
                    Login here</Link>
                </p>
            </div>
        </form>
    </GuestLayout>
</template>
