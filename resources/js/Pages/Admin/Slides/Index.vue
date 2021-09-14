<template>
    <admin-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                All Slides
            </h2>
        </template>

        <div class="py-6">
            <div class="overflow-hidden">
                <div class="flex flex-wrap py-3 lg:px-5 lg:py-7">
                    <div v-for="(slide, i) in slides.data" class="w-full sm:w-1/2 xl:w-1/3 overflow-hidden rounded border shadow p-3">
                        <div class="bg-white">
                            <div class="relative">
                                <div class="h-48 bg-cover bg-no-repeat bg-center" :style="`background-image: url('${slide.image}')`"></div>
                                <div style="background-color: rgba(0,0,0,0.6)" class="absolute top-0 mt-2 ml-3 px-2 py-1 rounded text-sm text-white">{{ i + 1 }}</div>
                            </div>
                            <div class="p-3">
                                <div class="mb-2 flex flex-wrap justify-between m-auto">
                                    <inertia-link class="rounded px-2 py-1 m-1 text-xs border-b-4 border-l-2 shadow-lg bg-blue-700 border-blue-800" :href="route('admin.slides.edit', slide)">
                                        <svg role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white fill-current text-center">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                        </svg>
                                    </inertia-link>
                                    <form @submit.prevent="destroy(slide)">
                                        <button type="submit" class="rounded px-2 py-1 m-1 text-xs border-b-4 border-l-2 shadow-lg bg-red-700 border-red-800">
                                            <svg role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white fill-current text-center">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </admin-layout>
</template>

<script>
import AdminLayout from '@/Layouts/AdminLayout'

export default {
    name: "Index",
    props: ['slides'],
    components: {
        AdminLayout,
    },
    methods: {
        destroy(slide) {
            this.$inertia.delete(route('admin.slides.destroy', slide));
        }
    },
    created() {
        this.makeTitle('Admin Slides')
    }
}
</script>
