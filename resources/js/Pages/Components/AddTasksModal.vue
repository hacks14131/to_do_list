<template>
  <TransitionRoot as="template" :show="modelValue">
    <Dialog class="relative z-10" @close="$emit('update:modelValue', false)">
      <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0" enter-to="opacity-100"
        leave="ease-in duration-200" leave-from="opacity-100" leave-to="opacity-0">
        <div class="fixed inset-0 bg-gray-500/75 transition-opacity" />
      </TransitionChild>

      <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
        <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
          <TransitionChild as="template" enter="ease-out duration-300"
            enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            enter-to="opacity-100 translate-y-0 sm:scale-100" leave="ease-in duration-200"
            leave-from="opacity-100 translate-y-0 sm:scale-100"
            leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
            <DialogPanel
              class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
              <form @submit.prevent="submitForm">
                <div class="bg-white px-6 py-5">
                  <DialogTitle as="h3" class="text-lg font-semibold text-gray-900 mb-4">
                    Add New Task
                  </DialogTitle>

                  <div class="mb-4">
                    <label for="task-title" class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                    <input id="task-title" name="title" v-model="form.title" type="text"
                      class="w-full rounded border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500"
                      required />
                  </div>

                  <div class="mb-4">
                    <label for="task-description"
                      class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                    <textarea id="task-description" name="description" v-model="form.description"
                      class="w-full rounded border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500"
                      rows="3" required></textarea>
                  </div>

                  <div>
                    <label for="task-deadline" class="block text-sm font-medium text-gray-700 mb-1">Deadline
                      Date</label>
                    <input id="task-deadline" name="deadline" v-model="form.deadline" type="date"
                      class="w-full rounded border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500"
                      required />
                  </div>
                </div>

                <div class="bg-gray-50 px-6 py-3 sm:flex sm:flex-row-reverse">
                  <button type="submit"
                    class="inline-flex w-full justify-center rounded-md bg-blue-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 sm:ml-3 sm:w-auto">
                    Save
                  </button>
                  <button type="submit"
                    class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-4 py-2 text-sm font-semibold text-gray-700 shadow-sm ring-1 ring-gray-300 hover:bg-gray-100 sm:mt-0 sm:w-auto"
                    @click="
                      $emit('update:modelValue', false)
                      ">
                    Cancel
                  </button>
                </div>
              </form>
            </DialogPanel>
          </TransitionChild>
        </div>
      </div>
    </Dialog>
  </TransitionRoot>
</template>
<script setup>
import { useForm } from "@inertiajs/vue3";
import { watch } from "vue";
import {
  Dialog,
  DialogPanel,
  DialogTitle,
  TransitionChild,
  TransitionRoot,
} from "@headlessui/vue";

const props = defineProps({
  modelValue: Boolean,
  task: {
    type: Object,
    default: null,
  },
});

const emit = defineEmits(["update:modelValue", "submit"]);

const form = useForm({
  title: null,
  description: null,
  deadline: null,
});

watch(
  () => props.task,             // Watch the task prop
  (newTask) => {                // 'newTask' is the updated value
    if (newTask) {
      form.title = newTask.title ?? '';
      form.description = newTask.description ?? '';
      form.deadline = newTask.deadlineDate?.split('T')[0] ?? '';
    } else {
      form.reset(); // or manually clear the fields
    }
  },
  { immediate: true }
);

function submitForm() {
  if (props.task && props.task.id) {
    form.patch(`/tasks/${props.task.id}`, {
      onSuccess: () => emit("update:modelValue", false),
    });
  } else {
    form.post(`/add-new-tasks`, {
      onSuccess: () => emit("update:modelValue", false),
    });
  }
}
</script>
