<template>
    <div class="print:hidden overflow-hidden sm:rounded-lg">
        <table class="overflow-hidden border border-gray-200 min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
            <tr>
                <th scope="col" class="px-3 py-2 text-left text-xs font-bold bg-gray-100 text-gray-500 uppercase tracking-wider">
                    Tran ID
                </th>
                <th scope="col" class="px-3 py-2 text-left text-xs font-bold bg-gray-100 text-gray-500 uppercase tracking-wider">
                    Date
                </th>
                <th scope="col" class="px-3 py-2 text-center text-xs font-bold bg-gray-100 text-gray-500 uppercase tracking-wider">
                    Status
                </th>
                <th scope="col" class="px-3 py-2 text-left text-xs font-bold bg-gray-100 text-gray-500 uppercase tracking-wider">
                    Amount
                </th>
            </tr>
            </thead>
            <tbody class="bg-white text-sm divide-y divide-gray-200">
            <tr v-for="payment in payments" :key="payment.id">
                <td class="px-3 py-2">{{ payment.tran_id }}</td>
                <td class="px-3 py-2">{{ payment.tran_date }}</td>
                <td class="px-3 py-2 whitespace-nowrap">
                    <a class="px-2 py-1 -my-1 bg-gray-700 rounded-sm text-center text-white block" :href="payment.status === 'PAID' ? '' : payment.gateway_url">{{ payment.status }}</a>
                </td>
                <td class="px-3 py-2 whitespace-nowrap">{{ moneyFormat(payment.amount) }}</td>
            </tr>
            </tbody>
            <tfoot class="bg-gray-100">
            <tr class="border-b">
                <th scope="col" colspan="2" class="px-3 py-2 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Total</th>
                <th scope="col" class="px-3 py-2 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">PAID</th>
                <th scope="col" class="px-3 py-2 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">{{ moneyFormat(paid) }}</th>
            </tr>
            <tr>
                <th scope="col" colspan="2" class="px-3 py-2 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Total</th>
                <th scope="col" class="px-3 py-2 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">DUE</th>
                <th scope="col" class="px-3 py-2 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">{{ moneyFormat(due) }}</th>
            </tr>
            </tfoot>
        </table>
    </div>
</template>

<script>
export default {
    name: "PaymentHistory",
    props: ['payments', 'paid', 'due']
}
</script>
