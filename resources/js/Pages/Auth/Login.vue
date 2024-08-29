<script setup>
import { ref } from 'vue';
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import Eye from '@/Components/Icons/Eye.vue';
import CloseEye from '@/Components/Icons/CloseEye.vue';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};

const showPassword = ref(false);
</script>

<template>
    <GuestLayout>

        <Head title="Log in" />

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="email" value="Email" />

                <TextInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required autofocus
                    autocomplete="username" />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="relative mt-4">
                <InputLabel for="password" value="Password" />

                <TextInput id="password" :type="showPassword ? 'text' : 'password'" class="mt-1 block w-full" v-model="form.password" required
                    autocomplete="current-password" />

                <InputError class="mt-2" :message="form.errors.password" />
                <CloseEye v-if="showPassword" @click="showPassword = !showPassword" class="absolute top-9 right-4" />
                <Eye @click="showPassword = !showPassword" class="absolute top-9 right-4" />
            </div>
            <div class="block mt-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <Checkbox name="remember" v-model:checked="form.remember" />
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="remember" class="text-gray-500 dark:text-gray-300">Remember me</label>
                        </div>
                    </div>
                    <Link v-if="canResetPassword" :href="route('password.request')"
                        class="text-sm font-medium text-primary-600 hover:underline dark:text-primary-500">Forgot
                    password?</Link>
                </div>
            </div>

            <div class="block mt-4">
                <PrimaryButton class="w-full" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Log in
                </PrimaryButton>
            </div>

            <div class="block mt-4">
                <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                    Don’t have an account yet? <Link :href="route('register')"
                        class="font-medium text-red-600 hover:underline dark:text-primary-500">Sign up</Link>
                </p>
            </div>

        </form>
    </GuestLayout>
</template>
