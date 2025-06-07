<script setup>
    import { Link, Head } from '@inertiajs/vue3'
    import { Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue'
    import { ChevronDownIcon } from '@heroicons/vue/20/solid'

    const user = {
        avatar: 'images/cat avatar.jpg',
    };

</script>
<template>
    <Head>
        <title>
            To Do List
        </title>
    </Head>
    <div class="min-h-screen flex flex-col bg-[#D1D8BE]">
        <header class="bg-[#A7C1A8] text-white">
            <nav class="flex items-center justify-between p-4 max-w-screen-lg mx-auto">
                <div class="space-x-6">
                    <Link :href="route('all-tasks')">Home</Link>
                    <Link :href="route('prioritized-tasks')">Priority</Link>
                    <Link :href="route('completed-tasks')">Completed</Link>
                </div>
                <div class="relative flex items-center gap-3 cursor-pointer" @click="toggleDropdown">
                    <img 
                        :src="$page.props.auth.avatar"
                        alt="avatar"
                        class="w-10 h-10 rounded-full border-2 border-white object-cover"
                    />
                    <span>
                        {{ $page.props.auth.user }}
                    </span>
                    <Menu as="div" class="relative inline-block text-left bg-[#A7C1A8]">
                        <div>
                            <MenuButton class="inline-flex w-full justify-center gap-x-1.5 rounded-md bg-[#A7C1A8] px-3 py-2 text-sm font-semibold text-gray-900 ring-1 ring-[#A7C1A8] ring-inset hover:bg-[#A7C1A8]">
                                <ChevronDownIcon class="-mr-1 size-5 text-[#EEEFE0]" aria-hidden="true" />
                            </MenuButton>
                        </div>

                        <transition enter-active-class="transition ease-out duration-100" enter-from-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100" leave-active-class="transition ease-in duration-75" leave-from-class="transform opacity-100 scale-100" leave-to-class="transform opacity-0 scale-95">
                            <MenuItems class="absolute right-0 z-10 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black/5 focus:outline-hidden">
                                <div class="py-1">
                                <form method="POST" action="#">
                                    <MenuItem v-slot="{ active }">
                                    <button type="submit" :class="[active ? 'bg-gray-100 text-gray-900 outline-hidden' : 'text-gray-700', 'block w-full px-4 py-2 text-left text-sm']">Sign out</button>
                                    </MenuItem>
                                </form>
                                </div>
                            </MenuItems>
                        </transition>
                    </Menu>
                </div>  
            </nav>
        </header>
        <main class="p-4 flex-1">
            <slot />
        </main>
    </div>    
</template>