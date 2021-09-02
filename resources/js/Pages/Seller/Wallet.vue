<template>
    <seller-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Orders
            </h2>
        </template>
        <div class="py-6">
            <div class="flex flex-col overflow-hidden">
                <div class="align-middle inline-block min-w-full">
                    <div class="flex flex-wrap text-xs text-white font-bold">
                        <inertia-link class="rounded-sm m-1 p-2" :class="[active ? 'bg-gray-500' : 'bg-primary']" :href="route('seller.wallet', {period: ''})" preserve-scroll>ALL</inertia-link>
                        <inertia-link v-for="period in periods" class="rounded-sm m-1 p-2" :class="[active === period ? 'bg-primary' : 'bg-gray-500']" :href="route('seller.wallet', {period: period})" preserve-scroll>{{ period }}</inertia-link>
                    </div>
                    <div class="overflow-hidden border border-gray-200">
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
                    <pagination :links="transactions.meta.links" />
                </div>
            </div>
        </div>
    </seller-layout>
</template>

<script>
import SellerLayout from "@/Layouts/SellerLayout";
import Pagination from "@/Components/Pagination";
export default {
    name: "Wallet",
    props: ['transactions', 'periods', 'active'],
    components: {
        Pagination,
        SellerLayout,
    },
}
</script>
