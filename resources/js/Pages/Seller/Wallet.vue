<template>
    <seller-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Orders
            </h2>
        </template>
        <div class="py-6">
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
                </div>
            </div>
        </div>
    </seller-layout>
</template>

<script>
import SellerLayout from "@/Layouts/SellerLayout";
export default {
    name: "Wallet",
    props: ['transactions'],
    components: {
        SellerLayout,
    },
}
</script>
