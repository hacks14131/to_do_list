<template>
    <Head title="Login" />
    <div class="min-h-screen flex items-center justify-center bg-[#A7C1A8] px-4">
    <div class="w-full max-w-md bg-white rounded-lg shadow-lg p-8">
      <h2 class="text-2xl font-bold text-center text-[#A7C1A8] mb-6">Drake Task Manager</h2>

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

        <div class="mt-6">
          <button 
            type="submit"
            class="w-full bg-[#A7C1A8] hover:bg-[#819A91] text-white font-semibold py-2 px-4 rounded transition duration-200"
            :disabled="form.processing"
          >
            Login
          </button>
        </div>
      </form>
    </div>
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