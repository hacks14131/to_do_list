<template>
    <Head title="Priority Tasks" />
    <div>
        <AddTasksModal v-model="showModal" :task="selectedTask" />
        <div class="p-6 min-h-screen border-t-1 border-[#819A91]">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                <TaskCard
                    v-for="task in tasks"
                    :key="task.id"
                    :task="task"
                    source="priority-component"
                    @edit="openEditModal"
                    @done="markAsDone"
                    @delete="deleteTask"
                />
            </div>
        </div>
    </div>
</template>
<script setup>
import { ref } from "vue";
import TaskCard from "./Components/TaskCard.vue";
import AddTasksModal from "./Components/AddTasksModal.vue";
import { router } from "@inertiajs/vue3";
const props = defineProps({
    tasks: Object,
});
const showModal = ref(false);
const selectedTask = ref(null);
const openEditModal = (task) => {
    selectedTask.value = task;
    showModal.value = true;
};

const markAsDone = (task) => {
    router.patch(route("tasks.complete", task.id));
};

const deleteTask = (task) => {
    router.delete(route("tasks.destroy", task.id));
};
</script>
