<template>
    <div
        class="bg-[#A7C1A8] text-[#EEEFE0] rounded-lg shadow-md p-4 flex flex-col"
    >
        <h2 class="text-lg font-bold text-center mb-2">
            {{ task.title }}
        </h2>
        <p class="text-sm text-gray-700 mb-4 text-center">
            {{ task.description }}
        </p>
        <div class="text-xs text-gray-600 mt-auto border-b-1 border-[#819A91]">
            <p><strong>Status:</strong> {{ task.status }}</p>
            <p>
                <strong>Deadline:</strong>
                {{ formatDate(task.deadlineDate) }}
            </p>
            <p><strong>Created:</strong> {{ formatDate(task.created_at) }}</p>
        </div>
        <div class="flex justify-center space-x-2 mb-4 m-2 p-1">
            <button
                v-if="props.source !== 'priority-component'"
                class="text-xs bg-orange-400 hover:bg-orange-500 text-white w-24 h-7 rounded transition-colors duration-200"
                @click="$emit('prioritize', props.task)"
            >
                ⭐ Priority
            </button>

            <button
                class="text-xs bg-blue-400 hover:bg-blue-500 text-white w-24 h-7 rounded transition-colors duration-200"
                @click="$emit('edit', task)"
            >
                ✏ Edit
            </button>

            <button
                class="text-xs bg-green-400 hover:bg-green-500 text-white w-24 h-7 rounded transition-colors duration-200"
                @click="$emit('done', task)"
            >
                ✔ Done
            </button>

            <button
                class="text-xs bg-red-400 hover:bg-red-500 text-white w-24 h-7 rounded transition-colors duration-200"
                @click="$emit('delete', task)"
            >
                🗑 Delete
            </button>
        </div>
    </div>
</template>

<script setup>
import dayjs from "dayjs";

const props = defineProps({
    task: Object,
    source: {
        type: String,
        default: null,
    },
});

const formatDate = (date) => dayjs(date).format("MMMM D, YYYY");
</script>
