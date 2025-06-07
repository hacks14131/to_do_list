<script setup>
const tasks = [
    {
        id: 1,
        title: 'Buy groceries',
        description: 'Milk, Bread, Eggs, Fruits',
        status: 'Pending',
        deadline: '2025-06-10',
        created: '2025-06-07',
    },
    {
        id: 2,
        title: 'Finish Vue component',
        description: 'Render tasks dynamically',
        status: 'In Progress',
        deadline: '2025-06-09',
        created: '2025-06-06',
    },
    {
        id: 3,
        title: 'Call supplier',
        description: 'Follow up on delivery issues',
        status: 'Completed',
        deadline: '2025-06-08',
        created: '2025-06-04',
    },
    {
        id: 4,
        title: 'Write report',
        description: 'Draft weekly performance summary',
        status: 'Pending',
        deadline: '2025-06-12',
        created: '2025-06-07',
    },
    {
        id: 5,
        title: 'Clean workspace',
        description: 'Organize files and clean desk',
        status: 'In Progress',
        deadline: '2025-06-11',
        created: '2025-06-06',
    },
    {
        id: 6,
        title: 'Pay bills',
        description: 'Electricity and internet bills',
        status: 'Pending',
        deadline: '2025-06-10',
        created: '2025-06-05',
    },
];
</script>
<template>
    <div>
        <div class="p-6 min-h-screen">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                <div v-for="task in tasks" :key="task.id" class="bg-white rounded-lg shadow-md p-4 flex flex-col">
                    <h2 class="text-lg font-bold text-center mb-2">
                        {{ task.title }}
                    </h2>
                    <p class="text-sm text-gray-700 mb-4 text-center">
                        {{ task.description }}
                    </p>
                    <div class="text-xs text-gray-600 mt-auto">
                        <p><strong>Status:</strong> {{ task.status }}</p>
                        <p><strong>Deadline:</strong> {{ task.deadline }}</p>
                        <p><strong>Created:</strong> {{ task.created }}</p>
                    </div>
                    <div class="flex justify-end space-x-2 mb-4 border-t-1 border-[#819A91] m-1 p-1">
                        <button class="text-xs bg-orange-500 text-white px-2 py-1 rounded">⭐ Priority</button>
                        <button class="text-xs bg-blue-500 text-white px-2 py-1 rounded">✏ Edit</button>
                        <button class="text-xs bg-green-500 text-white px-2 py-1 rounded">✔ Done</button>
                        <button class="text-xs bg-red-500 text-white px-2 py-1 rounded">🗑 Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>