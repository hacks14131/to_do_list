<template>
    <Head title="Completed Tasks" />
    <div>
        <div class="p-6 min-h-screen border-t-1 border-[#819A91]">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                <TaskCard
                    v-for="task in tasks"
                    :key="task.id"
                    :task="task"
                    source="completed-component"
                    @done="markAsDone"
                />
            </div>
        </div>
    </div>
</template>
<script setup>
    import { router } from "@inertiajs/vue3";
    import TaskCard from "./Components/TaskCard.vue";

    const props = defineProps({
        tasks: Object,
    });

    const markAsDone = (task) => {
        router.patch(route("tasks.reopen", task.id));
    };
</script>