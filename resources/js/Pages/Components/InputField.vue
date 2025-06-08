<script setup>
    defineProps({
        label: String,
        type: {
            type: String,
            default: 'text'
        },
        name: String,
        id: String,
        autocomplete: String,
        modelValue: String,
        error: String,
    })

    defineEmits(['update:modelValue'])
</script>
<template>
    <div class="mb-6">
        <label :for="id" class="block mb-2 text-sm font-medium text-[#819A91]">
            {{ label }}
        </label>
        <input 
            :type="type"
            :name="name"
            :id="id"
            :autocomplete="autocomplete"
            :value="modelValue"
            @input="$emit('update:modelValue', $event.target.value)"
            class="w-full px-4 py-2 border border-[#A7C1A8] rounded text-sm focus:outline-none focus:ring-2 focus:ring-[#819A91]"
        />
        <small v-if="error" class="text-red-600">{{ error }}</small>
    </div>
</template>