<template>
    <admin-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Payouts
            </h2>
        </template>

        <div class="flex flex-col overflow-hidden">
            <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow-md overflow-hidden border border-gray-200 sm:rounded-md">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Name
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Phone
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Method
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Amount
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    TRX ID
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Date
                                </th>
                            </tr>
                            </thead>
                            <tbody class="bg-white text-sm divide-y divide-gray-200">
                            <tr v-for="payout in payouts.data" :key="payout.id">
                                <td class="px-6 py-4 whitespace-nowrap text-blue-500 hover:underline hover:text-blue-600">
                                    <inertia-link :href="route('admin.sellers.show', payout.payable.id)">{{ payout.payable.name }}</inertia-link>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ payout.payable.phone }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <ul>
                                        <li>Name: {{ payout.meta.method_name }}</li>
                                        <template v-if="payout.meta.method_name === 'Bank'">
                                            <li>Bank Name: {{ payout.meta.bank_name }}</li>
                                            <li>Account Name: {{ payout.meta.account_name }}</li>
                                            <li>Branch: {{ payout.meta.branch }}</li>
                                            <li>Routing No: {{ payout.meta.routing_no }}</li>
                                        </template>
                                        <li>Account Type: {{ payout.meta.account_type }}</li>
                                        <li>Account Number: {{ payout.meta.account_number }}</li>
                                    </ul>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ moneyFormat(-payout.amount) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ payout.meta.trx_id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ payout.created_at }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <pagination :links="payouts.meta.links" />
        </div>
    </admin-layout>
</template>

<script>
import AdminLayout from "@/Layouts/AdminLayout";
import Pagination from "@/Components/Pagination";

export default {
    name: "Index",
    props: ['payouts'],
    components: {
        Pagination,
        AdminLayout,
    },
}
</script>
