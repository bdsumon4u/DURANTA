<template>
    <admin-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                View Seller
            </h2>
        </template>
        <div class="max-w-7xl mx-auto flex flex-col">
            <div class="border shadow-md">
                <div class="bg-white flex justify-between text-sm text-gray-500 font-semibold px-5 py-2 shadow border-b border-gray-300">
                    <div>Profile: <span class="font-bold">{{ seller.data.name }}</span></div>
                    <div>Balance: <span class="font-bold">{{ moneyFormat(seller.data.wallet.balance) }}</span></div>
                </div>

                <div class="w-full overflow-hidden bg-white p-2">
                    <table class="table w-full">
                        <tbody>
                        <tr>
                            <th class="border whitespace-nowrap text-left text-xs md:text-sm px-4 py-2">
                                <inertia-link class="hover:underline" :href="route('admin.orders.index', {seller: seller.data.id})">Total Orders</inertia-link>
                            </th>
                            <td class="border px-4 py-2 text-sm"></td>
                            <td rowspan="4" class="h-40 w-40 border">
                                <img class="h-40 w-40 rounded-sm border object-cover" :src="seller.data.profile_photo_url" :alt="seller.data.name" />
                                <div class="block text-xs text-center font-bold uppercase">Seller Photo</div>
                            </td>
                        </tr>
                        <tr>
                            <th class="border whitespace-nowrap text-left text-xs md:text-sm px-4 py-2">
                                <inertia-link class="hover:underline" :href="route('admin.orders.index', {seller: seller.data.id, status: 'PENDING'})">Pending Orders</inertia-link>
                            </th>
                            <td class="border px-4 py-2 text-sm"></td>
                        </tr>
                        <tr>
                            <th class="border whitespace-nowrap text-left text-xs md:text-sm px-4 py-2">
                                <inertia-link class="hover:underline" :href="route('admin.orders.index', {seller: seller.data.id, status: 'PROCESSING'})">Processing Orders</inertia-link>
                            </th>
                            <td class="border px-4 py-2 text-sm"></td>
                        </tr>
                        <tr>
                            <th class="border whitespace-nowrap text-left text-xs md:text-sm px-4 py-2">
                                <inertia-link class="hover:underline" :href="route('admin.orders.index', {seller: seller.data.id, status: 'PICKED'})">Picked Orders</inertia-link>
                            </th>
                            <td class="border px-4 py-2 text-sm"></td>
                        </tr>
                        <tr>
                            <th class="border whitespace-nowrap text-left text-xs md:text-sm px-4 py-2">
                                <inertia-link class="hover:underline" :href="route('admin.orders.index', {seller: seller.data.id, status: 'SHIPPING'})">Shipping Orders</inertia-link>
                            </th>
                            <td colspan="2" class="border px-4 py-2 text-sm"></td>
                        </tr>
                        <tr>
                            <th class="border whitespace-nowrap text-left text-xs md:text-sm px-4 py-2">
                                <inertia-link class="hover:underline" :href="route('admin.orders.index', {seller: seller.data.id, status: 'DELIVERED'})">Delivered Orders</inertia-link>
                            </th>
                            <td class="border px-4 py-2 text-sm"></td>
                            <td rowspan="4" class="h-40 w-40 border">
                                <img class="h-40 w-40 rounded-sm border object-cover" :src="seller.data.store_logo" :alt="seller.data.store_name" />
                                <div class="block text-xs text-center font-bold uppercase">Store Logo</div>
                            </td>
                        </tr>
                        <tr>
                            <th class="border whitespace-nowrap text-left text-xs md:text-sm px-4 py-2">
                                <inertia-link class="hover:underline" :href="route('admin.orders.index', {seller: seller.data.id, status: 'COMPLETED'})">Completed Orders</inertia-link>
                            </th>
                            <td class="border px-4 py-2 text-sm"></td>
                        </tr>
                        <tr>
                            <th class="border whitespace-nowrap text-left text-xs md:text-sm px-4 py-2">
                                <inertia-link class="hover:underline" :href="route('admin.orders.index', {seller: seller.data.id, status: 'RETURNED'})">Returned Orders</inertia-link>
                            </th>
                            <td class="border px-4 py-2 text-sm"></td>
                        </tr>
                        <tr>
                            <th class="border whitespace-nowrap text-left text-xs md:text-sm px-4 py-2">
                                <inertia-link class="hover:underline" :href="route('admin.orders.index', {seller: seller.data.id, status: 'REFUNDED'})">Refunded Orders</inertia-link>
                            </th>
                            <td class="border px-4 py-2 text-sm"></td>
                        </tr>

                        <tr>
                            <th class="border whitespace-nowrap text-left text-xs md:text-sm px-4 py-2">Wallet History:</th>
                            <td colspan="2" class="text-white border px-1 text-xs font-bold">
                                <div class="flex flex-wrap justify-center md:justify-start">
                                    <inertia-link class="rounded-sm m-1 p-2" :class="[active ? 'bg-gray-500' : 'bg-primary']" :href="route('admin.sellers.show', {seller: seller.data.id, period: ''})" preserve-scroll>ALL</inertia-link>
                                    <inertia-link v-for="period in periods" class="rounded-sm m-1 p-2" :class="[active === period ? 'bg-primary' : 'bg-gray-500']" :href="route('admin.sellers.show', {seller: seller.data.id, period: period})" preserve-scroll>{{ period }}</inertia-link>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <div class="overflow-hidden border border-gray-200">
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        #ID
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Amount
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Balance
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Message
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Date
                                    </th>
                                </tr>
                                </thead>
                                <tbody class="bg-white text-sm divide-y divide-gray-200">
                                <tr v-for="transaction in transactions.data" :key="transaction.id">
                                    <td class="px-6 py-4 whitespace-nowrap">#{{ transaction.id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ moneyFormat(transaction.amount) }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ moneyFormat(transaction.meta.balance) }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ transaction.meta.message }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ transaction.created_at }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <pagination :links="transactions.meta.links" />
                </div>
            </div>
        </div>
    </admin-layout>
</template>

<script>
import AdminLayout from "@/Layouts/AdminLayout";
import Pagination from "@/Components/Pagination";

export default {
    name: "Show",
    components: {
        Pagination,
        AdminLayout,
    },
    props: ['transactions', 'seller', 'periods', 'active'],
    created() {
        this.makeTitle('View Seller')
    }
}
</script>
