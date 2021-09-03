<template>
    <layout :tabs="tabs" active="withdraw">
        <div class="mt-10 sm:mt-0">
            <form @submit.prevent="submit" method="POST">
                <div class="border shadow overflow-hidden sm:rounded-md">
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6 sm:col-span-2">
                                <label for="method-name" class="block text-sm font-medium text-gray-700">Method Name</label>
                                <select id="method-name" v-model="form.method_name" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    <option>Bank</option>
                                    <option>bKash</option>
                                    <option>Nagad</option>
                                    <option>Rocket</option>
                                </select>
                            </div>

                            <template v-if="form.method_name === 'Bank'">
                                <div class="col-span-6 sm:col-span-2">
                                    <label for="bank-name" class="block text-sm font-medium text-gray-700">Bank Name</label>
                                    <input type="text" v-model="form.bank_name" id="bank-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                                </div>

                                <div class="col-span-6 sm:col-span-2">
                                    <label for="account-name" class="block text-sm font-medium text-gray-700">Account Name</label>
                                    <input type="text" v-model="form.account_name" id="account-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                                </div>

                                <div class="col-span-6 sm:col-span-1">
                                    <label for="branch" class="block text-sm font-medium text-gray-700">Branch</label>
                                    <input type="text" v-model="form.branch" id="branch" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                                </div>

                                <div class="col-span-6 sm:col-span-1">
                                    <label for="routing-no" class="block text-sm font-medium text-gray-700">Routing No</label>
                                    <input type="text" v-model="form.routing_no" id="routing-no" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                                </div>
                            </template>

                            <div class="col-span-6 sm:col-span-1">
                                <label for="account-type" class="block text-sm font-medium text-gray-700">Account Type</label>
                                <input type="text" v-model="form.account_type" id="account-type" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <label for="account-number" class="block text-sm font-medium text-gray-700">Account Number</label>
                                <input type="text" v-model="form.account_number" id="account-number" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" />
                            </div>
                        </div>
                    </div>
                    <div class="px-4 pb-3 bg-gray-50 text-right sm:px-6">
                        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Save
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </layout>
</template>

<script>
import Layout from "./Layout";

export default {
    name: "Withdraw",

    props: {
        tabs: Array,
        settings: {
            type: Object,
            default: {
                method_name: 'Bank',
                bank_name: '',
                account_name: '',
                branch: '',
                routing_no: '',
                account_type: '',
                account_number: '',
            },
        },
    },

    components: {
        Layout
    },

    methods: {
        submit() {
            this.form.post(route('seller.settings', 'withdraw'));
        }
    },

    data() {
        return {
            form: this.$inertia.form(this.settings)
        }
    }
}
</script>
