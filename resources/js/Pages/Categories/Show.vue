<template>
    <app-layout>
        <div class="container">
            <div class="flex flex-col justify-between flex-1 p-4 my-8 bg-white rounded-lg shadow-md md:flex-row">
                <div class="flex items-center justify-center mb-4 md:mb-0">
                    <img class="w-20 h-20 mr-2 border border-solid" :src="category.data.image" />
                    <div class="ml-4">
                        <h1 class="text-xl md:text-3xl font-semibold">{{ category.data.name }}</h1>
                        <span class="text-gray-600">products found in {{ category.data.name }}</span>
                    </div>
                </div>
                <div class="flex items-center justify-center">
                    <div class="flex rounded">
                        <input type="text" v-model="form.query" @keyup.enter="search" class="px-4 py-2 border border-black focus:border-black rounded-l-md w-40 md:w-auto" placeholder="Search...">
                        <button @click.prevent="search" class="flex items-center justify-center px-8 bg-gray-700 hover:bg-black border-2 border-black rounded-r-md">
                            <svg class="w-6 h-6 text-white" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path d="M16.32 14.9l5.39 5.4a1 1 0 0 1-1.42 1.4l-5.38-5.38a8 8 0 1 1 1.41-1.41zM10 16a6 6 0 1 0 0-12 6 6 0 0 0 0 12z" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- product wrapper -->
            <div class="mb-8">
                <div class="mb-8 grid lg:grid-cols-6 sm:grid-cols-3 grid-cols-2 lg:gap-6 md:gap-4 gap-2">
                    <!-- single product -->
                    <template v-for="product in products.data">
                        <product :product="product" />
                    </template>
                    <!-- single product end -->
                </div>
                <template v-if="products.meta.total > products.meta.per_page">
                    <pagination :links="products.meta.links" />
                </template>
            </div>
            <!-- product wrapper end -->
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import Product from "@/Components/Site/Product";
import Pagination from "@/Components/Pagination";

export default {
    name: "Show",
    props: ['query', 'products', 'category'],
    components: {
        Pagination,
        Product,
        AppLayout,
    },
    methods: {
        search() {
            this.form.get(route('categories.show', this.category.data.slug));
        }
    },
    data() {
        return {
            form: this.$inertia.form({
                query: this.query,
            }),
        }
    },
    created() {
        this.makeTitle(this.category.data.name)
    }
}
</script>
