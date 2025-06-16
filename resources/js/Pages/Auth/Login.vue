<template>
    <Head title="Login" />
    <div class="w-2/4 mx-auto bg-[#EEEFE0] p-8 rounded shadow mt-48">
        <h1 class="text-center text-2xl font-bold text-[#819A91] my-6">
        </h1>
    
        <form @submit.prevent="submit" autocomplete="off">
            <InputField 
                label="Username"
                id="username"
                name="username"
                autocomplete="on"
                v-model="form.username"
                :error="form.errors.username"
            />

            <InputField 
                label="Password"
                id="password"
                name="password"
                type="password"
                autocomplete="off"
                v-model="form.password"
                :error="form.errors.password"
            />
            <div class="mt-8">
                <button 
                    type="submit"
                    class="w-full bg-[#A7C1A8] hover:bg-[#819A91] text-white font-semibold py-2 px-4 rounded"
                    :disabled="form.processing"
                    >
                    Login
                </button>
            </div>
        </form>
    </div>
</template>
<script setup>
    import { useForm } from '@inertiajs/vue3';
    import InputField from '../Components/InputField.vue';
    import Login from '../../Layouts/Login.vue';

    defineOptions({
        layout: Login
    })
    
    const form = useForm({
        username: null,
        password: null,
    });

    const submit = () => {
        form.post(route('login'), {
            onError: () => form.reset('password')
        });
    };

</script>