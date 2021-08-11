<template>
    <seller-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ product ? 'Edit Product' : 'Add Product' }}
            </h2>
        </template>

        <product-editor :brands="brands" :categories="categories" :product="product" />
    </seller-layout>
</template>

<script>
import ProductEditor from '@/Components/ProductEditor/Editor';
import SellerLayout from '@/Layouts/SellerLayout';

export default {
    name: "Editor",
    props: ['product', 'brands', 'categories'],
    components: {
        ProductEditor,
        SellerLayout,
    },
}
</script>
