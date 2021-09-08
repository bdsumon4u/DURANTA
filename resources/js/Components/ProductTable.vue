<template>
    <div class="flex flex-col overflow-hidden">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow-md overflow-hidden border border-gray-200 sm:rounded-md">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Image
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Product
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                SKU
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Price
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Discount
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Selling
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Fee
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Action
                            </th>
                        </tr>
                        </thead>
                        <tbody class="bg-white text-sm divide-y divide-gray-200">
                        <tr v-for="product in products.data" :key="product.id">
                            <td class="px-3 py-2 border-r w-20 md:w-28 h-20 md:h-28">
                                <img class="h-full w-full object-fill rounded-sm" :src="product.first_media" alt="Product Image" />
                            </td>
                            <td class="px-6 py-4">
                                <a :href="route('products.show', product.slug)" target="_blank" class="text-lg font-bold text-gray-800 hover:underline mb-1">{{ product.name }}</a>
                                <div class="text-sm text-gray-600">
                                    {{ (product.stock_track ? product.stock_count : '') + ' In Stock' }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ product.sku }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ moneyFormat(product.price) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ product.discount_type === 'percent' ? product.discount_amount + '%' : moneyFormat(product.discount) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ moneyFormat(product.price - product.discount) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ moneyFormat(product.commission) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                  <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full uppercase bg-green-100 text-green-800">
                                    {{ product.status }}
                                  </span>
                            </td>
                            <td class="px-3 py-3 whitespace-nowrap text-sm text-center font-medium w-28 border-l">
                                <div class="flex flex-col space-y-2">
                                    <inertia-link class="px-4 py-2 border rounded-md bg-blue-600 text-gray-100 hover:bg-blue-700 hover:text-white" :href="route('admin.products.edit', product.id)">Edit</inertia-link>
                                    <button class="px-4 py-2 border rounded-md bg-red-600 text-gray-100 hover:bg-red-700 hover:text-white" type="button" @click.prevent="destroy(product)">Delete</button>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <pagination :links="products.meta.links" />
            </div>
        </div>
    </div>
</template>

<script>
import Pagination from "./Pagination";

export default {
    name: "ProductTable",
    components: {
        Pagination,
    },
    props: ['products'],
    computed: {
        is_admin() {
            return this.$page.props.is_admin;
        },
        routePrefix() {
            return this.is_admin ? 'admin' : 'seller';
        }
    },
    methods: {
        destroy (product) {
            this.$inertia.delete(route(this.routePrefix + '.products.destroy', product));
        }
    },
}
</script>
