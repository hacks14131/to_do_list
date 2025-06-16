<template>

    <Head title="Home" />
    <div class="m-2 bg-[#D1D8BE]">
        <div class="flex justify-end p-4">
            <button @click="showModal = true" class="bg-[#819A91] p-2 font-inter rounded text-white hover:bg-[#A7C1A8]">
                <span class="text-[EEEFE0]">
                    NEW TASK
                </span>
            </button>
            <AddTasksModal v-model="showModal" />
        </div>
        <div class="p-6 min-h-screen border-t-1 border-[#819A91]">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                <div v-for="task in tasks" :key="task.id"
                    class="bg-[#A7C1A8] text-[#EEEFE0] rounded-lg shadow-md p-4 flex flex-col">
                    <h2 class="text-lg font-bold text-center mb-2">
                        {{ task.title }}
                    </h2>
                    <p class="text-sm text-gray-700 mb-4 text-center">
                        {{ task.description }}
                    </p>
                    <div class="text-xs text-gray-600 mt-auto border-b-1 border-[#819A91]">
                        <p><strong>Status:</strong> {{ task.status }}</p>
                        <p><strong>Deadline:</strong> {{ dayjs(task.deadlineDate).format('MMMM D, YYYY') }}</p>
                        <p><strong>Created:</strong> {{ dayjs(task.created_at).format('MMMM D, YYYY') }}</p>
                    </div>
                    <div class="flex justify-center space-x-2 mb-4 m-2 p-1">
                        <button
                            class="text-xs bg-orange-400 hover:bg-orange-500 text-white w-24 h-7 rounded transition-colors duration-200"
                            @click="taskPrioritize(task)">
                            ⭐ Priority
                        </button>

                        <button
                            class="text-xs bg-blue-400 hover:bg-blue-500 text-white w-24 h-7 rounded transition-colors duration-200">
                            ✏ Edit
                        </button>

                        <button
                            class="text-xs bg-green-400 hover:bg-green-500 text-white w-24 h-7 rounded transition-colors duration-200"
                            @click="markAsDone(task)">
                            ✔ Done
                        </button>

                        <button
                            class="text-xs bg-red-400 hover:bg-red-500 text-white w-24 h-7 rounded transition-colors duration-200"
                            @click="deleteTask(task)">
                            🗑 Delete
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
import { ref } from 'vue';
import dayjs from 'dayjs';
import AddTasksModal from './Components/AddTasksModal.vue';
import { router } from '@inertiajs/vue3';

const showModal = ref(false)
defineProps({
    tasks: Object,
});

const taskPrioritize = (task) => {
    router.patch(route('tasks.prioritize', task.id));
}

const markAsDone = (task) => {
    router.patch(route('tasks.complete', task.id));
}

const deleteTask = (task) => {
    router.delete(route('tasks.destroy', task.id));
}
</script>