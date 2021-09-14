<template>
    <admin-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Paid
            </h2>
        </template>

        <div class="max-w-3xl mx-auto mt-10 sm:mt-0">
            <form @submit.prevent="submit" method="POST">
                <div class="border shadow overflow-hidden sm:rounded-md">
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <div class="mb-3">
                            <validation-errors />
                        </div>
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6 sm:col-span-2">
                                <label for="method-name" class="block text-sm font-medium text-gray-700">Method Name</label>
                                <input disabled type="text" v-model="form.method_name" id="method-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                            </div>

                            <template v-if="form.method_name === 'Bank'">
                                <div class="col-span-6 sm:col-span-2">
                                    <label for="bank-name" class="block text-sm font-medium text-gray-700">Bank Name</label>
                                    <input disabled type="text" v-model="form.bank_name" id="bank-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                                </div>

                                <div class="col-span-6 sm:col-span-2">
                                    <label for="account-name" class="block text-sm font-medium text-gray-700">Account Name</label>
                                    <input disabled type="text" v-model="form.account_name" id="account-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                                </div>

                                <div class="col-span-6 sm:col-span-1">
                                    <label for="branch" class="block text-sm font-medium text-gray-700">Branch</label>
                                    <input disabled type="text" v-model="form.branch" id="branch" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                                </div>

                                <div class="col-span-6 sm:col-span-1">
                                    <label for="routing-no" class="block text-sm font-medium text-gray-700">Routing No</label>
                                    <input disabled type="text" v-model="form.routing_no" id="routing-no" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                                </div>
                            </template>

                            <div class="col-span-6 sm:col-span-1">
                                <label for="account-type" class="block text-sm font-medium text-gray-700">Account Type</label>
                                <input disabled type="text" v-model="form.account_type" id="account-type" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <label for="account-number" class="block text-sm font-medium text-gray-700">Account Number</label>
                                <input disabled type="text" v-model="form.account_number" id="account-number" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                            </div>

                            <div class="col-span-6 sm:col-span-2">
                                <label for="seller-name" class="block text-sm font-medium text-gray-700">Seller Name</label>
                                <input disabled type="text" v-model="form.seller_name" id="seller-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                            </div>

                            <div class="col-span-6 sm:col-span-1">
                                <label for="paid-amount" class="block text-sm font-medium text-gray-700">Paid Amount</label>
                                <input type="text" v-model="form.paid_amount" id="paid-amount" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <label for="trx-id" class="block text-sm font-medium text-gray-700">TRX ID</label>
                                <input type="text" v-model="form.trx_id" id="trx-id" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                            </div>
                        </div>
                    </div>
                    <div class="px-4 pb-3 bg-gray-50 text-right sm:px-6">
                        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            We've Paid
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </admin-layout>
</template>

<script>
import AdminLayout from "@/Layouts/AdminLayout";
import ValidationErrors from "@/Jetstream/ValidationErrors";

export default {
    name: "Paid",
    props: ['seller'],
    components: {
        AdminLayout,
        ValidationErrors,
    },
    methods: {
        submit() {
            this.form.post(route('admin.payouts.paid'));
        }
    },
    data() {
        return {
            form: this.$inertia.form({
                method_name: 'Bank',
                bank_name: '',
                account_name: '',
                branch: '',
                routing_no: '',
                account_type: '',
                account_number: '',
                seller_id: this.seller.id,
                seller_name: this.seller.name,
                paid_amount: this.seller.transactions[0].meta.balance,
                trx_id: '',
                ...(this.seller.model_settings?.settings?.withdraw ?? {})
            }),
        };
    },
    created() {
        this.makeTitle('Admin Payout')
    }
}
</script>
