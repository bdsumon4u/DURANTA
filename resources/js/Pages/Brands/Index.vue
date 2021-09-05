<template>
    <app-layout>
        <div class="container pb-16">
            <div class="flex flex-col justify-between flex-1 p-4 my-8 bg-white rounded-lg shadow-md md:flex-row">
                <div class="flex items-center justify-center mb-4 md:mb-0">
                    <h2 class="text-xl md:text-2xl font-medium font-roboto text-gray-800 uppercase">Brands</h2>
                </div>
                <div class="flex items-center justify-center">
                    <div class="flex rounded">
                        <input type="text" v-model="form.query" @keyup.enter="search" class="px-4 py-2 border border-black focus:border-black rounded-l-md" placeholder="Search...">
                        <button @click.prevent="search" class="flex items-center justify-center px-8 bg-gray-700 hover:bg-black border-2 border-black rounded-r-md">
                            <svg class="w-6 h-6 text-white" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path d="M16.32 14.9l5.39 5.4a1 1 0 0 1-1.42 1.4l-5.38-5.38a8 8 0 1 1 1.41-1.41zM10 16a6 6 0 1 0 0-12 6 6 0 0 0 0 12z" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <div class="grid lg:grid-cols-8 md:grid-cols-6 grid-cols-3 lg:gap-6 md:gap-4 gap-2">
                <!-- single brand -->
                <div v-for="brand in brands.data" class="group flex flex-col rounded bg-white shadow overflow-hidden">
                    <!-- brand image -->
                    <div class="relative p-2">
                        <img :src="brand.image" class="w-full">
                        <div class="absolute inset-0 bg-gray-100 bg-opacity-40 flex items-center justify-center gap-2 opacity-0 group-hover:opacity-100 transition"></div>
                    </div>
                    <!-- brand image end -->
                    <inertia-link :href="route('brands.show', brand.slug)">
                        <h4 class="font-medium text-sm text-center font-roboto line-clamp-2 mb-2 text-gray-800 hover:text-primary transition">{{ brand.name }}</h4>
                    </inertia-link>
                </div>
                <!-- single brand end -->
            </div>

            <template v-if="brands.meta.total > brands.meta.per_page">
                <pagination :links="brands.meta.links" />
            </template>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import Pagination from "@/Components/Pagination";

export default {
    name: "Index",
    props: ['search', 'brands'],
    components: {
        Pagination,
        AppLayout,
    },
    methods: {
        search() {
            this.form.get(route('brands'));
        }
    },
    data() {
        return {
            form: this.$inertia.form({
                query: this.search,
            }),
        }
    }
}
</script>
