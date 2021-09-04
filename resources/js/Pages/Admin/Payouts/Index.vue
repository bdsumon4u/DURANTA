<template>
    <admin-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Payouts
            </h2>
        </template>

        <div class="flex flex-col overflow-hidden">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
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
                                    Balance
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    PayNow
                                </th>
                                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Action
                                </th>
                            </tr>
                            </thead>
                            <tbody class="bg-white text-sm divide-y divide-gray-200">
                            <tr v-for="seller in sellers.data" :key="seller.id">
                                <td class="px-6 py-4 whitespace-nowrap text-blue-500 hover:underline hover:text-blue-600">
                                    <inertia-link :href="route('admin.sellers.show', seller)">{{ seller.name }}</inertia-link>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ seller.phone }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <ul>
                                        <li>Name: <strong>{{ seller.model_settings?.settings?.withdraw?.method_name }}</strong></li>
                                        <template v-if="seller.model_settings?.settings?.withdraw?.method_name === 'Bank'">
                                            <li>Bank Name: {{ seller.model_settings?.settings?.withdraw?.bank_name }}</li>
                                            <li>Account Name: {{ seller.model_settings?.settings?.withdraw?.account_name }}</li>
                                            <li>Branch: {{ seller.model_settings?.settings?.withdraw?.branch }}</li>
                                            <li>Routing No: {{ seller.model_settings?.settings?.withdraw?.routing_no }}</li>
                                        </template>
                                        <li>Account Type: <strong>{{ seller.model_settings?.settings?.withdraw?.account_type }}</strong></li>
                                        <li>Account Number: <strong>{{ seller.model_settings?.settings?.withdraw?.account_number }}</strong></li>
                                    </ul>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ moneyFormat(seller.wallet.balance) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ moneyFormat(seller.transactions[0]?.meta?.balance ?? 0) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <inertia-link class="bg-primary block text-center px-2 py-2 rounded-sm text-white font-bold" :href="route('admin.payouts.paid', {seller_id: seller.id})">Paid {{ moneyFormat(seller.transactions[0]?.meta?.balance ?? 0) }}</inertia-link>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <pagination :links="sellers.links" />
                </div>
            </div>
        </div>
    </admin-layout>
</template>

<script>
import AdminLayout from "@/Layouts/AdminLayout";
import Pagination from "@/Components/Pagination";

export default {
    name: "Index",
    props: ['sellers'],
    components: {
        Pagination,
        AdminLayout,
    },
}
</script>
