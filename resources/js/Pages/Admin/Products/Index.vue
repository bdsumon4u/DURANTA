<template>
    <admin-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Products
            </h2>
        </template>
        <product-table :products="products" />
    </admin-layout>
</template>

<script>
import AdminLayout from "@/Layouts/AdminLayout";
import ProductTable from "@/Components/ProductTable";

export default {
    name: "Index",
    props: ['products'],
    components: {
        AdminLayout,
        ProductTable,
    },
}
</script>
