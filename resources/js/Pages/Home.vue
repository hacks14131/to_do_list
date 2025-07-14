<template>
    <Head title="Home" />
    <div class="m-2 bg-[#D1D8BE]">
        <div class="flex justify-end p-4">
            <button
                @click="openNewTaskModal"
                class="bg-[#819A91] p-2 font-inter rounded text-white hover:bg-[#A7C1A8]"
            >
                <span class="text-[EEEFE0]"> NEW TASK </span>
            </button>
            <AddTasksModal v-model="showModal" :task="selectedTask" />
        </div>
        <div class="p-6 min-h-screen border-t-1 border-[#819A91]">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                <TaskCard
                    v-for="task in tasks"
                    :key="task.id"
                    :task="task"
                    source="home-component"
                    @prioritize="taskPrioritize"
                    @done="markAsDone"
                    @delete="deleteTask"
                    @edit="openEditModal"
                />
            </div>
        </div>
    </div>
</template>
<script setup>
import { ref } from "vue";
import AddTasksModal from "./Components/AddTasksModal.vue";
import TaskCard from "./Components/TaskCard.vue";
import { router } from "@inertiajs/vue3";

defineProps({
    tasks: Object,
});

const showModal = ref(false);
const selectedTask = ref(null);

const openNewTaskModal = () => {
    selectedTask.value = null;
    showModal.value = true;
};

const openEditModal = (task) => {
    selectedTask.value = task;
    showModal.value = true;
};

const taskPrioritize = (task) => {
    router.patch(route("tasks.prioritize", task.id));
};

const markAsDone = (task) => {
    router.patch(route("tasks.complete", task.id));
};

const deleteTask = (task) => {
    router.delete(route("tasks.destroy", task.id));
};
</script>
