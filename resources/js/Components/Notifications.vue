<template>
    <div class="relative">
        <div @click="open = ! open">
            <button class="relative h-10 w-10 bg-gray-200 focus:outline-none hover:bg-gray-300 border-transparent rounded-md focus:outline-none focus:border-gray-300 transition flex items-center justify-center">
                <svg class="w-4 h-4 lg:w-6 lg:h-6 fill-current text-gray-600 stroke-current " xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#b0b0b0" stroke-width="2" stroke-linecap="square" stroke-linejoin="round">
                    <path d="M22 17H2a3 3 0 0 0 3-3V9a7 7 0 0 1 14 0v5a3 3 0 0 0 3 3zm-8.27 4a2 2 0 0 1-3.46 0"></path>
                </svg>
                <div v-if="count" class="absolute top-0 right-0 w-6 h-6 text-white -mr-2 rounded-full bg-red-500">{{ count }}</div>
            </button>
        </div>

        <!-- Full Screen Dropdown Overlay -->
        <div v-show="open" class="fixed inset-0 z-40" @click="open = false">
        </div>

        <transition
            enter-active-class="transition ease-out duration-200"
            enter-from-class="transform opacity-0 scale-95"
            enter-to-class="transform opacity-100 scale-100"
            leave-active-class="transition ease-in duration-75"
            leave-from-class="transform opacity-100 scale-100"
            leave-to-class="transform opacity-0 scale-95">
            <div v-show="open"
                 class="absolute z-50 mt-2 rounded-md shadow-lg w-72 -mr-16 md:mr-0 origin-top-right right-0"
                 style="display: none;"
                 @click="open = false">
                <div class="rounded-md ring-1 ring-black ring-opacity-5 py-1 bg-white">
                    <div class="hu z-10 aw fo right-0 sz pu uk ff">
                        <div class="text-sm font-bold fy uppercase py-2 px-4">Notifications</div>
                        <ul class="pt-1 px-2">
                            <li class="bg-yellow-100 hover:bg-gray-200 my-1 rounded-sm">
                                <inertia-link class="block px-2 py-2 nc" href="">
                                    <span class="block text-sm mb-2">📣 <span class="rx text-gray-800">Edit your information in a swipe</span> Sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim.</span>
                                    <span class="block text-xs font-weight-500 opacity-75">Feb 12, 2021</span>
                                </inertia-link>
                            </li>
                            <li class="bg-gray-100 hover:bg-gray-200 my-1 rounded-sm">
                                <inertia-link class="block px-2 py-2 nc" href="">
                                    <span class="block text-sm mb-2">📣 <span class="rx text-gray-800">Edit your information in a swipe</span> Sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim.</span>
                                    <span class="block text-xs font-weight-500 opacity-75">Feb 9, 2021</span>
                                </inertia-link>
                            </li>
                            <li class="bg-gray-100 hover:bg-gray-200 my-1 rounded-sm">
                                <inertia-link class="block px-2 py-2 nc" href="">
                                    <span class="block text-sm mb-2">🚀<span class="rx text-gray-800">Say goodbye to paper receipts!</span> Sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim.</span>
                                    <span class="block text-xs font-weight-500 opacity-75">Jan 24, 2020</span>
                                </inertia-link>
                            </li>
                            <li v-if="count > 3" class="flex items-center justify-center">
                                <small class="text-xs -mt-1">.......</small>
                            </li>
                            <li class="flex mt-2 mb-1 space-x-1">
                                <inertia-link v-if="count > 0" class="p-2 bg-gray-200 hover:bg-gray-300 w-full text-sm grid place-content-center font-bold rounded-sm" href="">Mark All As Read</inertia-link>
                                <inertia-link v-if="count > 3" class="p-2 bg-gray-200 hover:bg-gray-300 w-full text-sm grid place-content-center font-bold rounded-sm" href="">View All</inertia-link>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </transition>
    </div>
</template>

<script>
import { onMounted, onUnmounted, ref } from "vue";

export default {
    name: "Notifications",

    setup() {
        let open = ref(false),
            count = ref(1);

        const closeOnEscape = (e) => {
            if (open.value && e.keyCode === 27) {
                open.value = false
            }
        }

        onMounted(() => document.addEventListener('keydown', closeOnEscape))
        onUnmounted(() => document.removeEventListener('keydown', closeOnEscape))

        return {
            open,
            count,
        }
    },
}
</script>
