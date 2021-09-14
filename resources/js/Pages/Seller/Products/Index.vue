<template>
    <seller-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Products
            </h2>
        </template>
        <div class="pt-6">
            <div class="flex mb-1 text-xs text-white font-bold">
                <inertia-link href="" @click.prevent="search({status: ''})" class="rounded-sm m-1 p-2" :class="[active ? 'bg-gray-500' : 'bg-primary']" preserve-scroll>ALL</inertia-link>
                <inertia-link href="" v-for="status in ['PENDING', 'APPROVED', 'DISABLED', 'REJECTED']" @click.prevent="search({status})" class="rounded-sm m-1 p-2" :class="[active === status ? 'bg-primary' : 'bg-gray-500']" preserve-scroll>{{ status }}</inertia-link>
                <div class="ml-auto flex items-center justify-center">
                    <div class="flex rounded">
                        <input type="text" v-model="form.query" @keyup.enter="search" class="px-2 py-1 border border-black text-black focus:border-black rounded-l-md w-32 md:w-auto" placeholder="Search...">
                        <button @click.prevent="search" class="flex items-center justify-center px-4 bg-gray-700 hover:bg-black border border-black rounded-r-md">
                            <svg class="w-5 h-5 text-white" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path d="M16.32 14.9l5.39 5.4a1 1 0 0 1-1.42 1.4l-5.38-5.38a8 8 0 1 1 1.41-1.41zM10 16a6 6 0 1 0 0-12 6 6 0 0 0 0 12z" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <product-table :products="products" />
    </seller-layout>
</template>

<script>
import ProductTable from "@/Components/ProductTable";
import SellerLayout from "@/Layouts/SellerLayout";

export default {
    name: "Index",
    props: ['products', 'query', 'active'],
    components: {
        ProductTable,
        SellerLayout,
    },
    methods: {
        destroy (product) {
            this.$inertia.delete(route('seller.products.destroy', product));
        },
        search(extra) {
            this.form.transform(data => ({...data, ...extra})).get(route('seller.products.index'))
        }
    },
    data() {
        return {
            form: this.$inertia.form({
                query: this.query,
                status: this.active,
            })
        }
    },
    created() {
        this.makeTitle('Seller Products')
    }
}
</script>
