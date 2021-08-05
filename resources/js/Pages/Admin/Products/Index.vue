<template>
    <seller-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Products
            </h2>
        </template>
        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow-md overflow-hidden border-b border-gray-200 sm:rounded-md">
                        <table class="min-w-full divide-y divide-gray-200">
                            <tbody class="bg-white divide-y divide-gray-200">
                            <tr class="hover:bg-gray-200" v-for="product in products.data" :key="product.id">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 border w-20 md:w-28 h-20 md:h-28">
                                            <img class="h-full w-full object-fill rounded-sm" :src="product.first_media" alt="Product Image" />
                                        </div>
                                        <div class="ml-4">
                                            <inertia-link href="" class="text-lg font-bold text-gray-800 mb-1">{{ product.name }}</inertia-link>
                                            <div class="text-sm text-gray-600">
                                                {{ (product.stock_track ? product.stock_count : '') + ' In Stock' }}
                                            </div>
                                            <div class="text-sm uppercase text-gray-600">
                                                {{ product.status }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap w-40">
                                    <div class="text-sm font-bold text-gray-900"><span class="text-gray-500 underline">Price:</span> <strong>{{ product.price }}</strong></div>
                                    <template v-if="product.discount">
                                        <div class="text-sm font-bold text-gray-800"><span class="text-gray-500 underline">Discount:</span> {{ product.discount_amount + (product.discount_type === 'percent' ? '%' : '') }}</div>
                                        <div class="text-sm font-bold text-gray-800"><span class="text-gray-500 underline">Selling:</span> {{ product.price - product.discount }}</div>
                                    </template>
                                    <div class="text-sm font-bold text-gray-900"><span class="text-gray-500 underline">Fee:</span> {{ product.commission }}</div>
                                </td>
                                <td class="px-3 py-3 whitespace-nowrap text-sm text-center font-medium w-28">
                                    <div class="flex flex-col space-y-2">
                                        <inertia-link class="px-4 py-2 border rounded-md bg-blue-600 text-gray-100 hover:bg-blue-700 hover:text-white" :href="route('admin.products.edit', product.id)">Edit</inertia-link>
                                        <button class="px-4 py-2 border rounded-md bg-red-600 text-gray-100 hover:bg-red-700 hover:text-white" type="button" @click.prevent="destroy(product)">Delete</button>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </seller-layout>
</template>

<script>
import SellerLayout from "@/Layouts/SellerLayout";

export default {
    name: "Index",
    props: ['products'],
    components: {
        SellerLayout,
    },
    methods: {
        destroy (product) {
            this.$inertia.delete(route('admin.products.destroy', product));
        }
    },
}
</script>
