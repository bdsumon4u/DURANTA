<template>
    <seller-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Orders
            </h2>
        </template>
        <div class="py-6">
            <div class="flex mb-1 text-xs text-white font-bold">
                <inertia-link href="" @click.prevent="search({status: ''})" class="rounded-sm m-1 p-2" :class="[active ? 'bg-gray-500' : 'bg-primary']" preserve-scroll>ALL</inertia-link>
                <inertia-link href="" v-for="status in ['PENDING', 'PROCESSING', 'COMPLETED']" @click.prevent="search({status})" class="rounded-sm m-1 p-2" :class="[active === status ? 'bg-primary' : 'bg-gray-500']" preserve-scroll>{{ status }}</inertia-link>
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
            <div class="shadow sm:rounded-md flex flex-col overflow-hidden">
                <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="overflow-hidden border border-gray-200">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        #ID
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Products
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Total
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Fee
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Date
                                    </th>
                                </tr>
                                </thead>
                                <tbody class="bg-white text-sm divide-y divide-gray-200">
                                <tr v-for="order in orders.data" :key="order.id">
                                    <td class="px-6 py-4 whitespace-nowrap">#{{ order.id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <ul class="flex w-full md:max-w-2xl flex-col -my-3">
                                            <li v-for="(product, i) in order.products" class="bg-white my-1 shadow border">
                                                <h2
                                                    @click="toggleTab(`tab_${order.id}_p_${product.id}`)"
                                                    class="flex flex-row justify-between items-center font-semibold px-3 py-1 cursor-pointer"
                                                >
                                                    <span>{{ product.name }} x{{ product.pivot.quantity }}</span>
                                                    <div class="flex items-center ml-3">
                                                        <span>{{ product.pivot.status }}</span>
                                                        <svg
                                                            class="fill-current text-purple-700 h-6 w-6 ml-2 transform transition-transform duration-500"
                                                            viewBox="0 0 20 20"
                                                        >
                                                            <path d="M13.962,8.885l-3.736,3.739c-0.086,0.086-0.201,0.13-0.314,0.13S9.686,12.71,9.6,12.624l-3.562-3.56C5.863,8.892,5.863,8.611,6.036,8.438c0.175-0.173,0.454-0.173,0.626,0l3.25,3.247l3.426-3.424c0.173-0.172,0.451-0.172,0.624,0C14.137,8.434,14.137,8.712,13.962,8.885 M18.406,10c0,4.644-3.763,8.406-8.406,8.406S1.594,14.644,1.594,10S5.356,1.594,10,1.594S18.406,5.356,18.406,10 M17.521,10c0-4.148-3.373-7.521-7.521-7.521c-4.148,0-7.521,3.374-7.521,7.521c0,4.147,3.374,7.521,7.521,7.521C14.148,17.521,17.521,14.147,17.521,10"></path>
                                                        </svg>
                                                    </div>
                                                </h2>
                                                <div
                                                    :ref="`tab_${order.id}_p_${product.id}`"
                                                    :style="toggleStyle(`tab_${order.id}_p_${product.id}`)"
                                                    class="border-l-2 border-purple-600 max-h-0 overflow-hidden duration-500 transition-all"
                                                >
                                                    <div class="flex p-3 pt-1">
                                                        <div class="border rounded-sm w-20 md:w-28 h-20 md:h-28">
                                                            <img class="object-fill w-20 md:w-28 h-20 md:h-28 mx-auto" :src="product.pivot.first_media" alt="Product Image">
                                                        </div>
                                                        <div class="flex items-center mx-3">
                                                            <ul class="font-bold">
                                                                <li>ID: #{{ product.id }}</li>
                                                                <li>Price: {{ moneyFormat(product.price) }}</li>
                                                                <li>Discount: {{ moneyFormat(product.pivot.discount) }}</li>
                                                                <li>Selling: {{ moneyFormat(product.pivot.price - product.pivot.discount) }}</li>
                                                                <li>Fee: {{ moneyFormat(product.pivot.commission ?? product.commission) }}</li>
                                                                <li>Stock: {{ (product.stock_track ? product.stock_count : '') + ' In Stock' }}</li>
                                                            </ul>
                                                        </div>
                                                        <div v-if="product.product_type === 'card'" class="flex flex-col justify-center align-center font-bold text-primary mx-3">
                                                            <div class="border p-2">
                                                                <div class="text-center">You've to deliver it yourself.</div>
                                                                <div v-if="order.due > 0">We're waiting for payment.</div>
                                                                <template v-else>
                                                                    <div class="text-center">Contact "{{ order.contact_name }}".</div>
                                                                    <div class="text-center">Phone: {{ order.contact_phone }}.</div>
                                                                </template>
                                                            </div>
                                                            <a v-if="order.due <= 0" href="" @click.prevent="delivered(order.id, product.id)" class="bg-primary text-gray-100 hover:text-white text-center font-bold px-4 py-2 rounded-sm">I've Delivered</a>
                                                        </div>
                                                        <div class="flex flex-col justify-around ml-auto">
                                                            <inertia-link class="bg-primary text-gray-100 hover:text-white text-center font-bold px-4 py-2 rounded-sm" :href="route('seller.products.edit', product)">Open As Seller</inertia-link>
                                                            <inertia-link class="bg-primary text-gray-100 hover:text-white text-center font-bold px-4 py-2 rounded-sm" :href="route('products.show', product.slug)">Open As User</inertia-link>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                      <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full uppercase bg-green-100 text-green-800">
                                        {{ order.status }}
                                      </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ moneyFormat(order.total) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ moneyFormat(order.commission) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ order.created_at }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <pagination :links="orders.meta.links" />
        </div>
    </seller-layout>
</template>

<script>
import SellerLayout from "@/Layouts/SellerLayout";
import Pagination from "@/Components/Pagination";
export default {
    name: "Index",
    props: ['orders', 'active', 'query'],
    components: {
        Pagination,
        SellerLayout,
    },
    methods: {
        toggleStyle(i) {
            return i === this.tab ? `max-height: initial` : '';
        },
        toggleTab(i) {
            this.tab = i === this.tab ? 0 : i;
        },
        search(extra) {
            this.form.transform(data => ({...data, ...extra})).get(route('seller.orders.index'))
        },
        delivered(order_id, product_id) {
            this.$inertia.form({product_id}).patch(route('seller.orders.update', order_id));
        }
    },
    data() {
        return {
            tab: 0,
            form: this.$inertia.form({
                query: this.query,
                status: this.active,
            })
        }
    },
    created() {
        this.makeTitle('Seller Orders')
    }
}
</script>
