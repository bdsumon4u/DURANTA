<template>
    <seller-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Products
            </h2>
        </template>
        <product-table :products="products" />
    </seller-layout>
</template>

<script>
import ProductTable from "@/Components/ProductTable";
import SellerLayout from "@/Layouts/SellerLayout";

export default {
    name: "Index",
    props: ['products'],
    components: {
        ProductTable,
        SellerLayout,
    },
    methods: {
        destroy (product) {
            this.$inertia.delete(route('seller.products.destroy', product));
        }
    },
}
</script>
