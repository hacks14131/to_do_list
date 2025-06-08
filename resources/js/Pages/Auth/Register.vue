<script setup>
import { ref } from "vue";
import { useForm } from '@inertiajs/vue3';
import InputField from '../Components/InputField.vue';

const form = useForm({
    username: null,
    password: null,
    password_confirmation: null,
    firstName: null,
    middleName: null,
    familyName: null,
    role: 'user',
    imageFile: null,
    imageURL: null,
});

function handleImageChange(event) {
    const file = event.target.files[0];
    if (file) {
        form.imageFile = file;
        form.imageUrl = URL.createObjectURL(file);
    }
}

function triggerFileInput() {
    document.getElementById("image").click();
}



const submit = () => {
    form.post('/register')
}

</script>
<template>

    <Head title="Register" />

    <h1 class="text-center text-2xl font-bold text-[#819A91] my-6">
        Register a New Account
    </h1>

    <div class="w-2/4 mx-auto bg-[#EEEFE0] p-8 rounded shadow">
        <form @submit.prevent="submit" autocomplete="on">
            <div class="flex justify-center mb-6">
                <input type="file" name="image" id="image" accept="image/*" class="hidden"
                    @change="handleImageChange" />

                <div v-if="form.imageUrl" @click="triggerFileInput" class="cursor-pointer">
                    <img :src="form.imageUrl" alt="Avatar Preview"
                        class="w-24 h-24 rounded-full object-cover border-2 border-[#A7C1A8] shadow" />
                </div>

                <button v-else type="button" @click="triggerFileInput"
                    class="text-sm text-gray-700 bg-gray-100 border border-gray-300 rounded px-4 py-2 hover:bg-gray-200">
                    Upload Image
                </button>
                <small v-if="form.errors.avatar" class="text-red-600">{{ form.errors.avatar }}</small>
            </div>

            <InputField
                label="Username"
                id="username"
                name="username"
                type="text"
                autocomplete="true"
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

            <InputField
                label="Confirm Password"
                id="password_confirmation"
                name="password_confirmation"
                type="password"
                autocomplete="off"
                v-model="form.password_confirmation"
            />

            <InputField
                label="First Name"
                id="firstName"
                name="firstName"
                type="text"
                autocomplete="true"
                v-model="form.firstName"
                :error="form.errors.firstName"
            />

            <InputField
                label="Middle Name"
                id="middleName"
                name="middleName"
                type="text"
                autocomplete="true"
                v-model="form.middleName"
                :error="form.errors.middleName"
            />

            <InputField
                label="Family Name"
                id="familyName"
                name="familyName"
                type="text"
                autocomplete="true"
                v-model="form.familyName"
                :error="form.errors.familyName"
            />

            <div class="mb-6">
                <label for="role" class="block mb-2 text-sm font-medium text-[#819A91]">
                    Role
                </label>
                <select name="role" id="role" v-model="form.role" :error="form.errors.role" autocomplete="off"
                    class="w-full px-4 py-2 border border-[#A7C1A8] text-[#819A91] rounded text-sm focus:outline-none focus:ring-2 focus:ring-[#819A91] bg-[#EEEFE0]">
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>
                <small v-if="form.errors.role" class="text-red-600">{{ form.errors.role }}</small>
            </div>

            <div class="mt-8">
                <button 
                    type="submit"
                    class="w-full bg-[#A7C1A8] hover:bg-[#819A91] text-white font-semibold py-2 px-4 rounded"
                    :disabled="form.processing"
                    >
                    Register
                </button>
            </div>
        </form>
    </div>
</template>
